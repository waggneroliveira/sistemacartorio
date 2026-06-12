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

        // Pega os anos dinamicamente
        $currentYear = date('Y');  // 2026
        $previousYear = $currentYear - 1;  // 2025

        $totalAnoAtual = RegistryServiceRequest::whereYear('created_at', $currentYear)
        ->count();

        $totalAnoAnterior = RegistryServiceRequest::whereYear('created_at', $previousYear)
            ->count();

        $crescimentoAnual = 0;
        if ($totalAnoAnterior > 0) {        
            if ($totalAnoAtual > 0) {
                $crescimentoAnual = round(
                    (($totalAnoAtual - $totalAnoAnterior) / $totalAnoAnterior) * 100,
                    1
                );            
            } else {
                $crescimentoAnual = -100; // Queda de 100% se não há registros no ano atual
            }
        } elseif ($totalAnoAtual > 0) {
            $crescimentoAnual = 100; // Crescimento de 100% se não havia registros no ano anterior
        }

        $topServicesMonth = RegistryServiceRequest::selectRaw("
        registry_services.name as service,
        COUNT(*) as total
        ")
        ->join('registry_services', 'registry_services.id', '=', 'registry_service_requests.registry_service_id')
        ->whereMonth('registry_service_requests.created_at', now()->month)
        ->whereYear('registry_service_requests.created_at', now()->year)
        ->groupBy('registry_services.id', 'registry_services.name')
        ->orderByDesc('total')
        ->limit(10)
        ->get();

        if (isset($user)) {
            return view('admin.dashboard', compact(
                'settingTheme',
                'lastRequestServices',
                'stats',
                'todayRequestServices',
                'crescimentoAnual',
                'topServicesMonth',
            ));
        }

        return redirect()->route('admin.dashboard.painel');
    }

    public function getTopServices(Request $request)
    {
        $query = RegistryServiceRequest::selectRaw("
                registry_services.name as service,
                COUNT(*) as total
            ")
            ->join(
                'registry_services',
                'registry_services.id',
                '=',
                'registry_service_requests.registry_service_id'
            );

        if ($request->year) {
            $query->whereYear(
                'registry_service_requests.created_at',
                $request->year
            );
        }

        if ($request->month) {
            $query->whereMonth(
                'registry_service_requests.created_at',
                $request->month
            );
        }

        $data = $query
            ->groupBy(
                'registry_services.id',
                'registry_services.name'
            )
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return response()->json($data);
    }
}
