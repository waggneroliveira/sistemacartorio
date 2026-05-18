<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RegistryService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RegistryServicePageController extends Controller
{
    /**
     * Exibe a página de solicitação de serviços
     */
    public function index()
    {
        return view('client.blades.index');
    }

    /**
     * Retorna os serviços ativos em formato JSON para o frontend
     */
    public function getServices(Request $request): JsonResponse
    {
        try {
            $services = RegistryService::where('is_active', true)
                ->orderBy('display_order')
                ->orderBy('name')
                ->get()
                ->map(function ($service) {
                    return [
                        'id' => $service->id,
                        'nome' => $service->name,
                        'icone' => $service->icon ?? 'bi-file-earmark',
                        'documentos' => $service->required_documents ?? [],
                        'camposDinamicos' => $service->dynamic_fields ?? [],
                        'instrucoes' => $service->instructions ?? '',
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $services,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar serviços: ' . $e->getMessage(),
            ], 500);
        }
    }
}

