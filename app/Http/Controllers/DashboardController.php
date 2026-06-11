<?php

namespace App\Http\Controllers;

use App\Models\RegistryService;
use App\Models\RegistryServiceRequest;
use App\Models\User;
use App\Repositories\SettingThemeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        $todayRequestServices = RegistryServiceRequest::whereDate('created_at', Carbon::today())->count();

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

            'aguardandoDocumento' => RegistryServiceRequest::whereIn('status', [
                'awaiting_documents'
            ])->count(),
        ];

        if (isset($user)) {
            return view('admin.dashboard', compact(
                'settingTheme',
                'lastRequestServices',
                'stats',
                'todayRequestServices',
            ));
        }

        return redirect()->route('admin.dashboard.painel');
    }
}
