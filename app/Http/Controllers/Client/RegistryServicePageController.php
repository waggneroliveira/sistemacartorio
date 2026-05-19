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
        $services = RegistryService::where('is_active', true)
            ->orderBy('display_order')
            ->get();
        
        // Pré-carregar templates dos campos dinâmicos para cada serviço
        $dynamicFieldsTemplates = [];
        foreach ($services as $service) {
            $dynamicFieldsTemplates[$service->id] = $service->dynamic_fields ?? [];
        }

        return view('client.blades.index', [
            'services' => $services,
            'dynamicFieldsTemplates' => $dynamicFieldsTemplates
        ]);
    }

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

    /**
     * Buscar um serviço específico por ID
     */
    public function getServiceById(Request $request, $id): JsonResponse
    {
        try {
            $service = RegistryService::where('is_active', true)
                ->where('id', $id)
                ->firstOrFail();
            
            $serviceData = [
                'id' => $service->id,
                'nome' => $service->name,
                'icone' => $service->icon ?? 'bi-file-earmark',
                'documentos' => $service->required_documents ?? [],
                'camposDinamicos' => $service->dynamic_fields ?? [],
                'instrucoes' => $service->instructions ?? '',
            ];

            return response()->json([
                'success' => true,
                'data' => $serviceData,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Serviço não encontrado',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar serviço: ' . $e->getMessage(),
            ], 500);
        }
    }
}

