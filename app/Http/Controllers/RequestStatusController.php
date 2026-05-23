<?php

namespace App\Http\Controllers;

use App\Models\RequestStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequestStatusController extends Controller
{
    /**
     * Listar todos os status
     */
    public function index(Request $request)
    {
        $query = RequestStatus::query();

        // Filtro por ativo
        if ($request->has('active')) {
            $query->where('is_active', $request->boolean('active'));
        }

        // Pesquisa por nome ou label
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('label', 'like', '%' . $request->search . '%');
            });
        }

        // Ordenar por ordem
        $statuses = $query->orderBy('order')->paginate(15);

        return view('admin.blades.requestStatus.index', compact('statuses'));
    }

    /**
     * Mostrar formulário de criação
     */
    public function create()
    {
        return view('admin.blades.requestStatus.create');
    }

    /**
     * Armazenar novo status
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:request_statuses,name|max:50',
            'label' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'is_final' => 'boolean',
        ]);

        // Garantir que apenas um status é padrão
        if ($validated['is_default']) {
            RequestStatus::where('is_default', true)->update(['is_default' => false]);
        }

        $status = RequestStatus::create($validated);

        return redirect()->route('admin.request-statuses.index')
                        ->with('success', 'Status criado com sucesso!');
    }

    /**
     * Mostrar formulário de edição
     */
    public function edit(RequestStatus $requestStatus)
    {
        return view('admin.blades.requestStatus.edit', compact('requestStatus'));
    }

    /**
     * Atualizar status
     */
    public function update(Request $request, RequestStatus $requestStatus)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:request_statuses,name,' . $requestStatus->id . '|max:50',
            'label' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'color' => 'required|string|regex:/^#[0-9A-F]{6}$/i',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
            'is_default' => 'boolean',
            'is_final' => 'boolean',
        ]);

        // Garantir que apenas um status é padrão
        if ($validated['is_default'] && !$requestStatus->is_default) {
            RequestStatus::where('is_default', true)->update(['is_default' => false]);
        }

        $requestStatus->update($validated);

        return redirect()->route('admin.request-statuses.index')
                        ->with('success', 'Status atualizado com sucesso!');
    }

    /**
     * Deletar status
     */
    public function destroy(RequestStatus $requestStatus)
    {
        // Não permitir deletar se existem solicitações com este status
        if ($requestStatus->requests()->exists()) {
            return back()->with('error', 'Não é possível deletar este status pois existem solicitações vinculadas.');
        }

        // Não permitir deletar o status padrão
        if ($requestStatus->is_default) {
            return back()->with('error', 'Não é possível deletar o status padrão.');
        }

        $requestStatus->delete();

        return redirect()->route('admin.request-statuses.index')
                        ->with('success', 'Status deletado com sucesso!');
    }

    /**
     * Desativar um status
     */
    public function deactivate(RequestStatus $requestStatus)
    {
        $requestStatus->update(['is_active' => false]);

        return back()->with('success', 'Status desativado com sucesso!');
    }

    /**
     * Ativar um status
     */
    public function activate(RequestStatus $requestStatus)
    {
        $requestStatus->update(['is_active' => true]);

        return back()->with('success', 'Status ativado com sucesso!');
    }

    /**
     * API: Obter todos os status ativos
     */
    public function api()
    {
        $statuses = RequestStatus::where('is_active', true)->orderBy('order')->get();
        return response()->json($statuses);
    }
}
