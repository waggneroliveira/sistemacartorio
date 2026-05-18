<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\RegistryService;
use App\Models\RegistryServiceRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RegistryServiceRequestController extends Controller
{
    /**
     * Armazenar nova solicitação de serviço
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Validar dados básicos
            $validator = Validator::make($request->all(), [
                'servico_id' => 'required|exists:registry_services,id',
                'nome' => 'required|string|min:3|max:255',
                'email' => 'required|email|max:255',
                'telefone' => 'required|string|min:10|max:20',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dados inválidos',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Buscar o serviço para validar campos dinâmicos
            $service = RegistryService::find($request->servico_id);
            if (!$service) {
                return response()->json([
                    'success' => false,
                    'message' => 'Serviço não encontrado',
                ], 404);
            }

            // Validar campos dinâmicos
            $dynamicFieldsData = [];
            if ($service->dynamic_fields && is_array($service->dynamic_fields)) {
                foreach ($service->dynamic_fields as $field) {
                    $fieldName = $field['name'] ?? null;
                    $isRequired = $field['required'] ?? false;

                    if ($isRequired && !$request->has($fieldName)) {
                        return response()->json([
                            'success' => false,
                            'message' => "O campo '{$field['label']}' é obrigatório",
                        ], 422);
                    }

                    if ($request->has($fieldName)) {
                        $dynamicFieldsData[$fieldName] = $request->input($fieldName);
                    }
                }
            }

            // Processar arquivos enviados
            $uploadedFilesInfo = [];
            if ($request->hasAny(array_filter(array_keys($request->all()), fn($k) => str_starts_with($k, 'documento_')))) {
                $uploadDir = 'public/uploads/registry-requests';
                
                // Garantir que o diretório existe
                if (!Storage::exists($uploadDir)) {
                    Storage::makeDirectory($uploadDir, 0755, true);
                }

                foreach ($request->files as $key => $files) {
                    if (str_starts_with($key, 'documento_')) {
                        $file = is_array($files) ? $files[0] : $files;
                        
                        if ($file && $file->isValid()) {
                            // Validar tipo e tamanho do arquivo
                            if (!$this->isValidFile($file)) {
                                return response()->json([
                                    'success' => false,
                                    'message' => "Arquivo '{$file->getClientOriginalName()}' inválido. Permitidos: PDF, JPG, PNG. Máx: 10MB",
                                ], 422);
                            }

                            // Salvar arquivo
                            $fileName = $file->store($uploadDir, 'local');
                            $uploadedFilesInfo[] = [
                                'original_name' => $file->getClientOriginalName(),
                                'stored_name' => $fileName,
                                'mime_type' => $file->getMimeType(),
                                'size' => $file->getSize(),
                            ];
                        }
                    }
                }
            }

            // Verificar se há pelo menos um arquivo
            if (empty($uploadedFilesInfo)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Envie pelo menos um documento',
                ], 422);
            }

            // Criar solicitação no banco
            $registryRequest = RegistryServiceRequest::create([
                'registry_service_id' => $request->servico_id,
                'full_name' => $request->nome,
                'email' => $request->email,
                'phone' => $request->telefone,
                'dynamic_fields_data' => $dynamicFieldsData,
                'uploaded_files' => $uploadedFilesInfo,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Solicitação criada com sucesso!',
                'request_id' => $registryRequest->id,
            ], 201);

        } catch (\Exception $e) {
            \Log::error('Erro ao criar solicitação de serviço:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Erro ao processar solicitação. Tente novamente.',
            ], 500);
        }
    }

    /**
     * Validar arquivo
     */
    private function isValidFile($file): bool
    {
        $maxSize = 10 * 1024 * 1024; // 10MB
        $allowedMimes = ['application/pdf', 'image/jpeg', 'image/png'];

        if ($file->getSize() > $maxSize) {
            return false;
        }

        return in_array($file->getMimeType(), $allowedMimes);
    }

    /**
     * Obter solicitações do usuário (por email)
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
                'data' => $requests,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar solicitações',
            ], 500);
        }
    }

    /**
     * Obter detalhe de uma solicitação
     */
    public function show(int $id): JsonResponse
    {
        try {
            $request = RegistryServiceRequest::with('service')->find($id);

            if (!$request) {
                return response()->json([
                    'success' => false,
                    'message' => 'Solicitação não encontrada',
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $request,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar solicitação',
            ], 500);
        }
    }
}
