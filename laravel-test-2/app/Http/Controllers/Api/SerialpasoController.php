<?php

namespace App\Http\Controllers\Api;

use App\Enums\AppEnv;
use App\Enums\ContractServer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ShowSerialpasoRequest;

class SerialpasoController extends Controller
{
    public function showSerialpaso(ShowSerialpasoRequest $request)
    {
        $dataValidated = $request->validated();

        $dataValidated['app_env']         = AppEnv::fromValue($dataValidated['app_env'])->description;
        $dataValidated['contract_server'] = ContractServer::fromValue($dataValidated['contract_server'])->description;

        $filePath = base_path() . '/imprints_html_file/' . $dataValidated['app_env'] . '/' . $dataValidated['contract_server'] . '/' . $dataValidated['file'] . '.html';

        if (file_exists($filePath)) {
            $fileContent = file_get_contents($filePath);
            return response()->json([
                'success'  => true,
                'filename' => $dataValidated['file'] . '.html',
                'content'  => $fileContent,
                'message'  => 'Seal info response successfully',
            ]);
        } else {
            return response()->json([
                'success'  => false,
                'filename' => '',
                'message'  => 'Seal info response fail',
            ], 404);
        }
    }
}
