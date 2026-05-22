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

        return view('client.auth.complementary-registration', compact('client'));
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
        ], [
            'cpf.unique' => 'Este CPF já está cadastrado.',
            'birth_date.before' => 'Data de nascimento inválida.',
        ]);

        try {
            DB::beginTransaction();

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
