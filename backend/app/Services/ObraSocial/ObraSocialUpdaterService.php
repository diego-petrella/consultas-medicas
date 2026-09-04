<?php

namespace App\Services\ObraSocial;

use App\Converter\ObraSocial\ObraSocialToObraSocialResponseConverter;
use App\Dto\Request\ObraSocial\ObraSocialRequest;
use App\Dto\Response\ObraSocial\ObraSocialResponse;
use App\Models\ObraSocialModel;

final class ObraSocialUpdaterService
{
    private ObraSocialModel $obraSocialModel;
    private ObraSocialFinderService $obraSocialFinderService;
    private ObraSocialToObraSocialResponseConverter $converter;

    public function __construct()
    {
        $this->obraSocialModel         = new ObraSocialModel();
        $this->obraSocialFinderService = new ObraSocialFinderService();
        $this->converter               = new ObraSocialToObraSocialResponseConverter();
    }

    public function update(ObraSocialRequest $request, int $id): ObraSocialResponse
    {
        $obraSocial = $this->obraSocialFinderService->find($id);

        $obraSocial->update($request);

        $updatedObraSocial = $this->obraSocialModel->update($obraSocial);

        return $this->converter->convert($updatedObraSocial);
    }
}
