<?php

namespace App\Exception\ObraSocial;

use Exception;

final class ObraSocialNotFoundException extends Exception
{
    public function __construct(int $id)
    {
        parent::__construct("ObraSocial with id {$id} not found", 404);
    }
}
