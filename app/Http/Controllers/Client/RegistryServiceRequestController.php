<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RegistryService;
use App\Models\RegistryServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegistryServiceRequestController extends Controller
{
    /**
     * Armazenar nova solicitação de serviço
     */
    public function store(Request $request): JsonResponse
    {
        try {

            // Validação básica
            $validator = Validator::make($request->all(), [
                'servico_id' => 'required|exists:registry_services,id',
                'nome'       => 'required|string|min:3|max:255',
                'email'      => 'required|email|max:255',
                'telefone'   => 'required|string|min:10|max:20',
            ]);

            if ($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Dados inválidos',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Buscar serviço
            $service = RegistryService::with(['requests' => function($query) {
                $query->select('registry_service_id', 'protocol_number');
            }])->find($request->servico_id);

            if (!$service) {

                return response()->json([
                    'success' => false,
                    'message' => 'Serviço não encontrado',
                ], 404);
            }

            /**
             * Validar campos dinâmicos
             */
            $dynamicFieldsData = [];

            if ($service->dynamic_fields && is_array($service->dynamic_fields)) {

                foreach ($service->dynamic_fields as $field) {

                    $fieldName  = $field['name'] ?? null;
                    $fieldLabel = $field['label'] ?? $fieldName;
                    $isRequired = $field['required'] ?? false;

                    if (!$fieldName) {
                        continue;
                    }

                    // Campo obrigatório
                    if (
                        $isRequired &&
                        (
                            !$request->has($fieldName) ||
                            empty($request->input($fieldName))
                        )
                    ) {

                        return response()->json([
                            'success' => false,
                            'message' => "O campo '{$fieldLabel}' é obrigatório",
                        ], 422);
                    }

                    // Salvar valor
                    if ($request->has($fieldName)) {

                        $dynamicFieldsData[$fieldName] = $request->input($fieldName);
                    }
                }
            }

            /**
             * Processar arquivos
             */
            $uploadedFilesInfo = [];

            foreach ($request->allFiles() as $key => $files) {

                // Apenas inputs documento_
                if (!str_starts_with($key, 'documento_')) {
                    continue;
                }

                // Garantir array
                $files = is_array($files) ? $files : [$files];

                foreach ($files as $file) {

                    if (!$file || !$file->isValid()) {
                        continue;
                    }

                    // Validar arquivo
                    if (!$this->isValidFile($file)) {

                        return response()->json([
                            'success' => false,
                            'message' => "Arquivo '{$file->getClientOriginalName()}' inválido. Permitidos: PDF, JPG e PNG. Máx: 10MB",
                        ], 422);
                    }

                    // Salvar arquivo
                    $storedPath = $file->store(
                        'uploads/registry-requests',
                        'public'
                    );

                    $uploadedFilesInfo[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'stored_name'   => $storedPath,
                        'mime_type'     => $file->getMimeType(),
                        'size'          => $file->getSize(),
                    ];
                }
            }

            /**
             * Verificar documentos obrigatórios
             * Só exigir documentos se o serviço tiver documentos obrigatórios
             */
            $hasRequiredDocuments = false;
            
            if ($service->documentos && is_array($service->documentos) && count($service->documentos) > 0) {
                $hasRequiredDocuments = true;
            } elseif ($service->documentos && is_string($service->documentos)) {
                try {
                    $docsArray = json_decode($service->documentos, true);
                    if (is_array($docsArray) && count($docsArray) > 0) {
                        $hasRequiredDocuments = true;
                    }
                } catch (\Exception $e) {
                    // Se não conseguir fazer parse, considera como sem documentos
                }
            }
            
            // Exigir documentos apenas se houver documentos obrigatórios
            if ($hasRequiredDocuments && empty($uploadedFilesInfo)) {

                return response()->json([
                    'success' => false,
                    'message' => 'Envie pelo menos um documento',
                ], 422);
            }

            /**
             * Criar solicitação
             */
            $registryRequest = RegistryServiceRequest::create([
                'registry_service_id' => $request->servico_id,
                'full_name'           => $request->nome,
                'email'               => $request->email,
                'phone'               => $request->telefone,
                'dynamic_fields_data' => $dynamicFieldsData,
                'uploaded_files'      => $uploadedFilesInfo,
                'status'              => 'pending',
            ]);

            return response()->json([
                'success'    => true,
                'message'    => 'Solicitação criada com sucesso!',
                'request_id' => $registryRequest->id,
                'protocol_number' => $registryRequest->protocol_number,
            ], 201);

        } catch (\Exception $e) {

            Log::error('Erro ao criar solicitação de serviço', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar solicitação. Tente novamente.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Validar arquivo
     */
    private function isValidFile($file): bool
    {
        $maxSize = 10 * 1024 * 1024; // 10MB

        $allowedMimes = [
            'application/pdf',
            'image/jpeg',
            'image/png',
        ];

        if ($file->getSize() > $maxSize) {
            return false;
        }

        return in_array($file->getMimeType(), $allowedMimes);
    }

    /**
     * Obter solicitações do usuário
     */
    public function getUserRequests(string $email): JsonResponse
    {
        try {

            $requests = RegistryServiceRequest::where('email', $email)
                ->with('service')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data'    => $requests,
            ]);

        } catch (\Exception $e) {

            Log::error('Erro ao buscar solicitações', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar solicitações',
            ], 500);
        }
    }

    /**
     * Detalhe da solicitação
     */
    public function show(int $id): JsonResponse
    {
        try {

            $requestData = RegistryServiceRequest::with('service')->find($id);

            if (!$requestData) {

                return response()->json([
                    'success' => false,
                    'message' => 'Solicitação não encontrada',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data'    => $requestData,
            ]);

        } catch (\Exception $e) {

            Log::error('Erro ao buscar solicitação', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar solicitação',
            ], 500);
        }
    }

    /**
     * Upload de documentos para uma solicitação existente (cliente)
     */
    public function uploadDocuments(Request $request, int $id): JsonResponse
    {
        try {
            $registryRequest = RegistryServiceRequest::findOrFail($id);

            $files = $request->file('documentos');
            if (!$files || count($files) === 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Nenhum arquivo enviado',
                ], 422);
            }

            $uploadedFilesInfo = $this->getUploadedFilesInfo($registryRequest);

            foreach ($files as $file) {
                if (!$file || !$file->isValid()) continue;

                if (!$this->isValidFile($file)) {
                    return response()->json([
                        'success' => false,
                        'message' => "Arquivo '{$file->getClientOriginalName()}' inválido. Permitidos: PDF, JPG e PNG. Máx: 10MB",
                    ], 422);
                }

                $storedPath = $file->store('uploads/registry-requests', 'public');

                $uploadedFilesInfo[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'stored_name' => $storedPath,
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize(),
                ];
            }

            // Atualizar registro
            $registryRequest->update(['uploaded_files' => $uploadedFilesInfo]);

            // Registrar auditoria
            if (class_exists('\App\Models\RequestAuditTrail')) {
                \App\Models\RequestAuditTrail::logAction(
                    $id,
                    'documents_uploaded',
                    null,
                    $uploadedFilesInfo,
                    ['files_count' => count($uploadedFilesInfo)]
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Documentos enviados com sucesso',
                'uploaded_files' => $uploadedFilesInfo,
            ]);

        } catch (\Exception $e) {
            Log::error('Erro ao enviar documentos para solicitação', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar upload de documentos',
            ], 500);
        }
    }

    /**
     * Helper: retorna os arquivos já enviados (array)
     */
    private function getUploadedFilesInfo($registryRequest)
    {
        if (isset($registryRequest->uploaded_files) && $registryRequest->uploaded_files) {
            if (is_string($registryRequest->uploaded_files)) {
                $files = json_decode($registryRequest->uploaded_files, true);
                return is_array($files) ? $files : [];
            }
            return is_array($registryRequest->uploaded_files) ? $registryRequest->uploaded_files : [];
        }
        return [];
    }
}