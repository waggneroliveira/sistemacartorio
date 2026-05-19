<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RegistryService;
use Illuminate\Http\Request;

class RegistryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = RegistryService::orderBy('display_order')
            ->orderBy('name')
            ->paginate(15);
        
        return view('admin.blades.registryService.index', compact('services'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blades.registryService.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'instructions' => 'nullable|string',
            'required_documents' => 'nullable|array',
            'required_documents.*' => 'nullable|string|max:500',
            'dynamic_fields' => 'nullable|array',
            'dynamic_fields.*.name' => 'required|string|max:100',
            'dynamic_fields.*.label' => 'required|string|max:255',
            'dynamic_fields.*.type' => 'required|string|in:text,number,date,email,tel,select,textarea',
            'dynamic_fields.*.required' => 'required|boolean',
            'dynamic_fields.*.options' => 'nullable|string',
            'dynamic_fields.*.placeholder' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'display_order' => 'integer'
        ]);
        
        // Processar options dos campos select
        if (isset($validated['dynamic_fields'])) {
            foreach ($validated['dynamic_fields'] as $key => $field) {
                if (isset($field['options']) && !empty($field['options'])) {
                    // Converter string de opções para array
                    $options = explode(',', $field['options']);
                    $options = array_map('trim', $options);
                    $validated['dynamic_fields'][$key]['options'] = $options;
                } else {
                    $validated['dynamic_fields'][$key]['options'] = [];
                }
            }
        }
        
        $service = RegistryService::create($validated);
        
        return redirect()->route('admin.dashboard.registryService.index')
            ->with('success', 'Serviço criado com sucesso!');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = RegistryService::findOrFail($id);
        return view('admin.blades.registryService.show', compact('service'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $service = RegistryService::findOrFail($id);
        return view('admin.blades.registryService.edit', compact('service'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $service = RegistryService::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:50',
            'instructions' => 'nullable|string',
            'required_documents' => 'nullable|array',
            'required_documents.*' => 'nullable|string|max:500',
            'dynamic_fields' => 'nullable|array',
            'dynamic_fields.*.name' => 'required|string|max:100',
            'dynamic_fields.*.label' => 'required|string|max:255',
            'dynamic_fields.*.type' => 'required|string|in:text,number,date,email,tel,select,textarea',
            'dynamic_fields.*.required' => 'required|boolean',
            'dynamic_fields.*.options' => 'nullable|string',
            'dynamic_fields.*.placeholder' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'display_order' => 'integer'
        ]);
        
        // Processar options dos campos select
        if (isset($validated['dynamic_fields'])) {
            foreach ($validated['dynamic_fields'] as $key => $field) {
                if (isset($field['options']) && !empty($field['options'])) {
                    // Converter string de opções para array
                    $options = explode(',', $field['options']);
                    $options = array_map('trim', $options);
                    $validated['dynamic_fields'][$key]['options'] = $options;
                } else {
                    $validated['dynamic_fields'][$key]['options'] = [];
                }
            }
        }
        
        $service->update($validated);
        
        return redirect()->route('admin.dashboard.registryService.index')
            ->with('success', 'Serviço atualizado com sucesso!');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = RegistryService::findOrFail($id);
        
        // Verificar se existem solicitações relacionadas
        if ($service->requests()->count() > 0) {
            return redirect()->route('admin.dashboard.registryService.index')
                ->with('error', 'Não é possível excluir este serviço pois existem solicitações vinculadas.');
        }
        
        $service->delete();
        
        return redirect()->route('admin.dashboard.registryService.index')
            ->with('success', 'Serviço excluído com sucesso!');
    }
}