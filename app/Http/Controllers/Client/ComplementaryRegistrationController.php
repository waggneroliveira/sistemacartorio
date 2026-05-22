<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ComplementaryRegistrationController extends Controller
{
    /**
     * Mostra a página de cadastro complementar
     */
    public function show()
    {
        $client = auth('client')->user();

        if (!$client) {
            return redirect()->route('login');
        }

        // Se o perfil já foi completado, redireciona para a página inicial
        if ($client->profile_completed) {
            return redirect()->route('index');
        }

        return view('client.auth.complement_registration', compact('client'));
    }

    /**
     * Armazena os dados complementares
     */
    public function store(Request $request)
    {
        $client = auth('client')->user();

        if (!$client) {
            return redirect()->route('login');
        }
        
        $validated = $request->validate([
            'cpf' => 'nullable|string|max:14|unique:clients,cpf,' . $client->id,
            'birth_date' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'street' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:10',
            'complement' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'zip_code' => 'nullable|string|max:10',
            'rg_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'cpf_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'proof_address' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'other_documents' => 'nullable|array',
            'other_documents.*' => 'file|mimes:pdf,jpg,jpeg,png|max:5120',
        ], [
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'birth_date.before' => 'Data de nascimento inválida.',
            'rg_file.max' => 'O arquivo RG não pode exceder 5MB.',
            'cpf_file.max' => 'O arquivo CPF não pode exceder 5MB.',
            'proof_address.max' => 'O comprovante de residência não pode exceder 5MB.',
            'other_documents.*.max' => 'Os documentos não podem exceder 5MB cada.',
        ]);

        try {
            DB::beginTransaction();

            // Upload do RG
            if ($request->hasFile('rg_file')) {
                $rgPath = $request->file('rg_file')->store("clients/{$client->id}/documents/rg", 'public');
                $validated['rg_path'] = $rgPath;
            }

            // Upload do CPF
            if ($request->hasFile('cpf_file')) {
                $cpfPath = $request->file('cpf_file')->store("clients/{$client->id}/documents/cpf", 'public');
                $validated['cpf_path'] = $cpfPath;
            }

            // Upload do comprovante de residência
            if ($request->hasFile('proof_address')) {
                $proofPath = $request->file('proof_address')->store("clients/{$client->id}/documents/proof_address", 'public');
                $validated['proof_address_path'] = $proofPath;
            }

            // Upload de outros documentos
            $otherDocsPaths = [];
            if ($request->hasFile('other_documents')) {
                foreach ($request->file('other_documents') as $file) {
                    $path = $file->store("clients/{$client->id}/documents/others", 'public');
                    $otherDocsPaths[] = $path;
                }
                $validated['other_documents_paths'] = json_encode($otherDocsPaths);
            }

            $client->update([
                'cpf' => $validated['cpf'] ?? null,
                'birth_date' => $validated['birth_date'] ?? null,
                'gender' => $validated['gender'] ?? null,
                'street' => $validated['street'] ?? null,
                'number' => $validated['number'] ?? null,
                'complement' => $validated['complement'] ?? null,
                'city' => $validated['city'] ?? null,
                'state' => $validated['state'] ?? null,
                'zip_code' => $validated['zip_code'] ?? null,
                'profile_completed' => true,
                'profile_completed_at' => now(),
                'rg_path' => $validated['rg_path'] ?? null,
                'cpf_path' => $validated['cpf_path'] ?? null,
                'proof_address_path' => $validated['proof_address_path'] ?? null,
                'other_documents_paths' => $validated['other_documents_paths'] ?? null,
            ]);

            DB::commit();

            return redirect()
                ->route('index')
                ->with('success', 'Cadastro complementado com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro ao atualizar cadastro: ' . $e->getMessage());
        }
    }

    /**
     * Pula a etapa de cadastro complementar
     */
    public function skip()
    {
        $client = auth('client')->user();

        if (!$client) {
            return redirect()->route('login');
        }

        try {
            $client->update([
                'profile_completed' => true,
                'profile_completed_at' => now(),
            ]);

            return redirect()->route('index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao pular cadastro complementar.');
        }
    }
}
