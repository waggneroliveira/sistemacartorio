<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver as GdDriver;

class ClientController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/perfil/';
    public function index()
    {
        $clients = Client::all();

        return view('admin.blades.client.index', compact('clients'));
    }

    public function store(Request $request)
    {   
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email',
            'lgpd_accept' => 'required|accepted',
            'whatsapp' => 'nullable|string|max:20',
            'password' => 'required|string|min:8',
            'active' => 'nullable|boolean',
        ], [
            'email.unique' => 'O e-mail informado já está sendo utilizado.',
        ]);

        try {
            DB::beginTransaction();

            Client::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'whatsapp' => $validated['whatsapp'] ?? null,
                'password' => Hash::make($validated['password']),
                'active' => $validated['active'] ?? 1,
                'lgpd_accept' => $request->has('lgpd_accept'),
            ]);

            DB::commit();

            return redirect()
            ->route('login')  // Vai para a página de login
            ->with([
                'cadastro_success' => true,      // Session que o modal espera
                'cadastro_email' => $validated['email'],  // Email para exibir no modal
                'success' => 'Pré-cadastro realizado! Verifique seu e-mail para ativar a conta.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Erro no cadastro: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Client $client)
    {
        $client = auth('client')->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email,' . $client->id,
            'whatsapp' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8',
            'path_image' => ['nullable', 'file', 'image', 'max:2048'],
        ]);

        try {

            DB::beginTransaction();

            if (!empty($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            } else {
                unset($validated['password']);
            }

            $manager = new ImageManager(GdDriver::class);

            if ($request->hasFile('path_image')) {

                $file = $request->file('path_image');

                $mime = $file->getMimeType();

                $filename = uniqid() . '.webp';

                // Remove imagem antiga
                if (!empty($client->path_image)) {

                    $oldPath = str_replace('storage/', '', $client->path_image);

                    Storage::disk('public')->delete($oldPath);
                }

                // SVG
                if ($mime === 'image/svg+xml') {

                    $file->storeAs($this->pathUpload, $filename, 'public');

                } else {

                    $image = $manager->read($file)
                        ->toWebp(quality: 95)
                        ->toString();

                    Storage::disk('public')->put(
                        $this->pathUpload . $filename,
                        $image
                    );
                }

                $validated['path_image'] = 'storage/' . $this->pathUpload . $filename;
            }

            // Excluir imagem manualmente
            if ($request->filled('delete_path_image')) {

                if (!empty($client->path_image)) {

                    $oldPath = str_replace('storage/', '', $client->path_image);

                    Storage::disk('public')->delete($oldPath);
                }

                $validated['path_image'] = null;
            }

            $client->update($validated);

            DB::commit();

            return back()->with(
                'success',
                'Dados atualizados com sucesso!'
            );

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Erro ao atualizar: ' . $e->getMessage());
        }
    }

    public function verification(){
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        Storage::delete(isset($client->path_image)??$client->path_image);
        $client->delete();
        Session::flash('success',__('dashboard.response_item_delete'));
        return redirect()->back();
    }
}
