<?php

namespace App\Models;

use App\Converter\ObraSocial\PrimitiveToObraSocialConverter;
use App\Dto\Request\ObraSocial\ObraSocialFilterRequest;
use App\Entity\ObraSocial\ObraSocial;
use CodeIgniter\Database\BaseConnection;
use Config\Database;

final class ObraSocialModel
{
    private BaseConnection $db;
    private PrimitiveToObraSocialConverter $converter;

    public function __construct()
    {
        $this->db        = Database::connect();
        $this->converter = new PrimitiveToObraSocialConverter();
    }

    public function find(int $id): ?ObraSocial
    {
        $result    = $this->db->query('SELECT * FROM obras_sociales WHERE id = ?', [$id]);
        $primitive = $result->getRow();

        if (is_null($primitive)) {
            return null;
        }

        return $this->converter->convert($primitive);
    }

    public function buscarPorNombre(string $nombre): ?ObraSocial
    {
        $result    = $this->db->query('SELECT * FROM obras_sociales WHERE nombre = ?', [$nombre]);
        $primitive = $result->getRow();

        if (is_null($primitive)) {
            return null;
        }

        return $this->converter->convert($primitive);
    }

    public function search(ObraSocialFilterRequest $request): array
    {
        $parameters = [];

        $query = 'SELECT * FROM obras_sociales WHERE 1 = 1 ';

        if ($request->hasNombre()) {
            $query .= 'AND nombre LIKE ? ';
            $parameters[] = '%' . $request->getNombre() . '%';
        }

        $query .= 'ORDER BY nombre ASC ';
        $query .= 'LIMIT ?, ? ';
        $parameters[] = $request->getPagination()->getOffset();
        $parameters[] = $request->getPagination()->getLimit();

        $result     = $this->db->query($query, $parameters);
        $primitives = $result->getResult();

        $entities = [];
        foreach ($primitives as $primitive) {
            $entities[] = $this->converter->convert($primitive);
        }

        return $entities;
    }

    public function listarActivas(): array
    {
        $result     = $this->db->query('SELECT * FROM obras_sociales ORDER BY nombre ASC');
        $primitives = $result->getResult();

        $entities = [];
        foreach ($primitives as $primitive) {
            $entities[] = $this->converter->convert($primitive);
        }

        return $entities;
    }

    public function insert(ObraSocial $obraSocial): ObraSocial
    {
        $this->db->query(
            'INSERT INTO obras_sociales (nombre) VALUES (?)',
            [$obraSocial->getNombre()]
        );

        return $this->find($this->db->insertID());
    }

    public function update(ObraSocial $obraSocial): ObraSocial
    {
        $this->db->query(
            'UPDATE obras_sociales SET nombre = ? WHERE id = ?',
            [$obraSocial->getNombre(), $obraSocial->getId()]
        );

        return $obraSocial;
    }

    public function delete(int $id): void
    {
        $this->db->query('DELETE FROM obras_sociales WHERE id = ?', [$id]);
    }
}
