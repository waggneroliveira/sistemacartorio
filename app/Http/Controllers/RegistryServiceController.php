<?php

namespace App\Http\Controllers;

use App\Models\RegistryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class RegistryServiceController extends Controller
{

    public function index(Request $request)
    {
        $query = RegistryService::query();

        // Filter by active status
        if ($request->has('active')) {
            $isActive = filter_var($request->active, FILTER_VALIDATE_BOOLEAN);
            if ($isActive) {
                $query->active();
            } elseif (!$isActive && $request->active === 'false') {
                $query->where('is_active', false);
            }
        }

        // Search by name
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('name', 'LIKE', "%{$search}%");
        }

        // Order by display order or created_at
        if ($request->has('order_by')) {
            $orderBy = $request->order_by;
            $direction = $request->get('direction', 'asc');
            
            if (in_array($orderBy, ['name', 'display_order', 'created_at', 'updated_at'])) {
                $query->orderBy($orderBy, $direction);
            }
        } else {
            $query->ordered();
        }

        $services = $query->get();
        // dd($services);

        return view('admin.blades.registryService.index', compact('services'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:registry_services,name',
            'icon' => 'nullable|string|max:100',
            'required_documents' => 'nullable|array',
            'required_documents.*' => 'string|max:500',
            'instructions' => 'nullable|string',
            'dynamic_fields' => 'nullable|array',
            'dynamic_fields.*.type' => 'required|in:text,textarea,select,date,number,email,tel',
            'dynamic_fields.*.name' => 'required|string|max:255|regex:/^[a-zA-Z_][a-zA-Z0-9_]*$/',
            'dynamic_fields.*.label' => 'required|string|max:255',
            'dynamic_fields.*.required' => 'boolean',
            'dynamic_fields.*.placeholder' => 'nullable|string|max:255',
            'dynamic_fields.*.options' => 'nullable|array',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            Alert::error('error', __('dashboard.response_item_error_create'));
            return redirect()->back();
        }

        $data = $validator->validated();
        
        // Process required_documents - remove empty values and reindex
        if (isset($data['required_documents']) && is_array($data['required_documents'])) {
            $documents = array_filter($data['required_documents'], function($value) {
                return !empty(trim($value));
            });
            $data['required_documents'] = array_values($documents);
        }
        
        // Process dynamic_fields - convert field names from Portuguese to English pattern
        if (isset($data['dynamic_fields']) && is_array($data['dynamic_fields'])) {
            $processedFields = [];
            foreach ($data['dynamic_fields'] as $field) {
                $processedField = [
                    'type' => $field['type'],
                    'name' => $field['name'],
                    'label' => $field['label'],
                    'required' => $field['required'] ?? false,
                ];
                
                if (isset($field['placeholder'])) {
                    $processedField['placeholder'] = $field['placeholder'];
                }
                
                if (isset($field['options']) && is_array($field['options'])) {
                    $processedField['options'] = $field['options'];
                }
                
                $processedFields[] = $processedField;
            }
            $data['dynamic_fields'] = $processedFields;
        }

        try {
            DB::beginTransaction();
                $service = RegistryService::create($data);
            DB::commit();
            session()->flash('success', __('dashboard.response_item_create'));
        } catch (\Exception $e) {
            DB::rollback();            
            Alert::error('error', __('dashboard.response_item_error_create'));
        }
        
        return redirect()->back();
    }

    public function show(int $id): JsonResponse
    {
        $service = RegistryService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Registry service not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $service,
            'message' => 'Registry service retrieved successfully'
        ]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $service = RegistryService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Registry service not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255|unique:registry_services,name,' . $id,
            'icon' => 'nullable|string|max:100',
            'required_documents' => 'nullable|array',
            'required_documents.*' => 'string|max:500',
            'instructions' => 'nullable|string',
            'dynamic_fields' => 'nullable|array',
            'dynamic_fields.*.type' => 'required|in:text,textarea,select,date,number,email,tel',
            'dynamic_fields.*.name' => 'required|string|max:255|regex:/^[a-zA-Z_][a-zA-Z0-9_]*$/',
            'dynamic_fields.*.label' => 'required|string|max:255',
            'dynamic_fields.*.required' => 'boolean',
            'dynamic_fields.*.placeholder' => 'nullable|string|max:255',
            'dynamic_fields.*.options' => 'nullable|array',
            'is_active' => 'boolean',
            'display_order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $validator->validated();
        
        // Process required_documents - remove empty values and reindex
        if (isset($data['required_documents']) && is_array($data['required_documents'])) {
            $documents = array_filter($data['required_documents'], function($value) {
                return !empty(trim($value));
            });
            $data['required_documents'] = array_values($documents);
        }
        
        // Process dynamic_fields - convert field names from Portuguese to English pattern
        if (isset($data['dynamic_fields']) && is_array($data['dynamic_fields'])) {
            $processedFields = [];
            foreach ($data['dynamic_fields'] as $field) {
                $processedField = [
                    'type' => $field['type'],
                    'name' => $field['name'],
                    'label' => $field['label'],
                    'required' => $field['required'] ?? false,
                ];
                
                if (isset($field['placeholder'])) {
                    $processedField['placeholder'] = $field['placeholder'];
                }
                
                if (isset($field['options']) && is_array($field['options'])) {
                    $processedField['options'] = $field['options'];
                }
                
                $processedFields[] = $processedField;
            }
            $data['dynamic_fields'] = $processedFields;
        }

        $service->update($data);

        return response()->json([
            'success' => true,
            'data' => $service,
            'message' => 'Registry service updated successfully'
        ]);
    }

    public function destroy(int $id)
    {
        $service = RegistryService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Registry service not found'
            ], 404);
        }

        $service->delete();

        Session::flash('success',__('dashboard.response_item_delete'));
        return redirect()->back();
    }

    /**
     * Restore a soft-deleted registry service.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function restore(int $id): JsonResponse
    {
        $service = RegistryService::withTrashed()->find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Registry service not found'
            ], 404);
        }

        if (!$service->trashed()) {
            return response()->json([
                'success' => false,
                'message' => 'Registry service is not deleted'
            ], 400);
        }

        $service->restore();

        return response()->json([
            'success' => true,
            'data' => $service,
            'message' => 'Registry service restored successfully'
        ]);
    }

    /**
     * Get active services list (simplified for frontend).
     *
     * @return JsonResponse
     */
    public function getActiveServices(): JsonResponse
    {
        $services = RegistryService::active()
            ->ordered()
            ->get(['id', 'name', 'icon', 'instructions', 'required_documents', 'dynamic_fields']);

        return response()->json([
            'success' => true,
            'data' => $services,
            'message' => 'Active registry services retrieved successfully'
        ]);
    }

    /**
     * Bulk insert registry services from array.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bulkStore(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'services' => 'required|array',
            'services.*.name' => 'required|string|max:255',
            'services.*.icon' => 'nullable|string|max:100',
            'services.*.documentos' => 'nullable|array',
            'services.*.instrucoes' => 'nullable|string',
            'services.*.camposDinamicos' => 'nullable|array',
            'services.*.display_order' => 'integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $servicesData = $request->input('services');
        $createdServices = [];

        foreach ($servicesData as $serviceData) {
            $createdServices[] = RegistryService::create([
                'name' => $serviceData['name'],
                'icon' => $serviceData['icon'] ?? null,
                'required_documents' => $serviceData['documentos'] ?? [],
                'instructions' => $serviceData['instrucoes'] ?? null,
                'dynamic_fields' => $serviceData['camposDinamicos'] ?? [],
                'display_order' => $serviceData['display_order'] ?? 0,
                'is_active' => true,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $createdServices,
            'message' => count($createdServices) . ' registry services created successfully'
        ], 201);
    }

    /**
     * Update service status (active/inactive).
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'is_active' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $service = RegistryService::find($id);

        if (!$service) {
            return response()->json([
                'success' => false,
                'message' => 'Registry service not found'
            ], 404);
        }

        $service->is_active = $request->is_active;
        $service->save();

        return response()->json([
            'success' => true,
            'data' => $service,
            'message' => 'Service status updated successfully'
        ]);
    }   

    /**
     * Destroy multiple selected services.
     */
    public function destroySelected(Request $request)
    {
        $ids = $request->input('ids');
        if ($ids) {
            RegistryService::whereIn('id', $ids)->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

    /**
     * Update sorting order.
     */
    public function sorting(Request $request)
    {
        $order = $request->input('order');
        if ($order) {
            foreach ($order as $index => $itemId) {
                RegistryService::where('id', $itemId)->update(['display_order' => $index]);
            }
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 400);
    }

}
