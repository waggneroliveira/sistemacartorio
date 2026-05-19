<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RegistryService;
use App\Models\RegistryServiceRequest;
use Illuminate\Http\Request;

class RegistryServiceRequestController extends Controller
{
    public function apiStore(Request $request)
    {
        // Validar dados básicos
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'required|string|max:20',
            'servico_id' => 'required|exists:registry_services,id',
        ]);
        
        $service = RegistryService::findOrFail($request->servico_id);
        
        // Coletar campos dinâmicos
        $dynamicFieldsData = [];
        if ($service->dynamic_fields) {
            foreach ($service->dynamic_fields as $field) {
                $fieldName = $field['name'];
                if ($request->has($fieldName)) {
                    $dynamicFieldsData[$fieldName] = $request->$fieldName;
                }
            }
        }
        
        // Processar arquivos
        $uploadedFiles = [];
        if ($request->hasFile('documentos')) {
            foreach ($request->file('documentos') as $file) {
                $path = $file->store('uploads/registry-requests', 'public');
                $uploadedFiles[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'stored_name' => $path,
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ];
            }
        }
        
        // Criar solicitação
        $registryRequest = RegistryServiceRequest::create([
            'registry_service_id' => $service->id,
            'full_name' => $request->nome,
            'email' => $request->email,
            'phone' => $request->telefone,
            'dynamic_fields_data' => $dynamicFieldsData,
            'uploaded_files' => $uploadedFiles,
            'status' => 'pending'
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Solicitação enviada com sucesso!',
            'request_id' => $registryRequest->id,
            'protocol' => $registryRequest->protocol_number ?? null
        ]);
    }
}