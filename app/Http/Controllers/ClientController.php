<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\SettingEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Mail\ConfirmEmailClient;
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

            // Gera um token de verificação
            $token = Str::random(64);

            $client = Client::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'whatsapp' => $validated['whatsapp'] ?? null,
                'password' => Hash::make($validated['password']),
                
                // Campos de status
                'active' => 0, // Começa inativo até confirmar email
                'profile_completed' => 0,
                'lgpd_accept' => $request->has('lgpd_accept'),
                
                // Campos de verificação de email
                'email_verified_at' => null,
                'email_verification_token' => $token,
                'email_verification_requested_at' => now(),
            ]);

            // Configura as credenciais de email
            $emailSettings = SettingEmail::first();
            
            Config::set([
                'mail.default' => $emailSettings->mail_mailer ?? 'smtp',
                'mail.mailers.smtp.transport' => $emailSettings->mail_mailer ?? 'smtp',
                'mail.mailers.smtp.host' => $emailSettings->mail_host ?? 'smtp.gmail.com',
                'mail.mailers.smtp.port' => $emailSettings->mail_port ?? 465,
                'mail.mailers.smtp.encryption' => $emailSettings->mail_encryption ?? 'ssl',
                'mail.mailers.smtp.username' => $emailSettings->mail_username ?? 'waggner.447@gmail.com',
                'mail.mailers.smtp.password' => $emailSettings->mail_password ?? 'aggd cvvg ljkp gxli',
                'mail.from.address' => $emailSettings->mail_from_address ?? 'waggner.447@gmail.com',
                'mail.from.name' => $emailSettings->mail_from_name ?? 'WHI - Web de Alta inspiração',
            ]);

            // Envia o email de confirmação
            Mail::to($client->email)->send(new ConfirmEmailClient($client, $token));

            DB::commit();

            return redirect()
            ->route('login')
            ->with([
                'cadastro_success' => true,
                'cadastro_email' => $validated['email'],
                'success' => 'Pré-cadastro realizado! Verifique seu e-mail para confirmar e ativar a conta.'
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
