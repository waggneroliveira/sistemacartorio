<?php

namespace App\Http\Controllers;

use App\Models\RegistryServiceRequest;
use App\Models\User;
use App\Repositories\SettingThemeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $currentUser = Auth::user();

        $user = User::where('id', $currentUser->id)
            ->active()
            ->first();

        $settingTheme = (new SettingThemeRepository())->settingTheme();

        $lastRequestServices = RegistryServiceRequest::with(['service', 'client'])
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'total' => RegistryServiceRequest::count(),

            'emAndamento' => RegistryServiceRequest::whereIn('status', [
                'in_progress',
                'awaiting_documents',
                'documents_approved'
            ])->count(),

            'concluidos' => RegistryServiceRequest::where('status', 'completed')
                ->count(),

            'aguardandoPagamento' => RegistryServiceRequest::whereIn('status', [
                'pending',
                'awaiting_payment'
            ])->count(),
        ];

        if (isset($user)) {
            return view('admin.dashboard', compact(
                'settingTheme',
                'lastRequestServices',
                'stats'
            ));
        }

        return redirect()->route('admin.dashboard.painel');
    }
}
