<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuditActivityController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordEmailController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\BenefitTopicController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepoimentController;
use App\Http\Controllers\DirectionController;
use App\Http\Controllers\DownloadFichaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FormIndexController;
use App\Http\Controllers\LetsgoController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PopUpController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\RegistryServiceController;
use App\Http\Controllers\RegistryServiceRequestDashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestStatusController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceLocationController;
use App\Http\Controllers\SessaoFaqController;
use App\Http\Controllers\SettingEmailController;
use App\Http\Controllers\SettingThemeController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\StatuteController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Middleware\Authenticate;
use App\Models\RegistryServiceRequest;
use App\Models\User;
use App\Repositories\AuditCountRepository;
use App\Repositories\SettingThemeRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('painel/', function () {
    return redirect()->route('admin.dashboard.painel');
});

Route::prefix('painel/')->group(function () {
    Route::get('login', function () {
        return view('admin.auth.login');
    })->name('admin.dashboard.painel');

    Route::get('/success-logout', function () {
        return view('admin.success.success-logout');
    })->name('success-logout');

    Route::post('login.do', [AuthController::class, 'authenticate'])
    ->name('admin.user.authenticate');

    /*=====================REDEFINICAO DE SENHA=========================*/

    // Rota para exibir o formulário "Esqueci a senha"
    Route::get('password/reset', function(){
        return view('admin.auth.recover-password');
    })->name('password.request');

    // Rota para processar o formulário "Esqueci a senha"
    Route::post('/password/email', [PasswordEmailController::class, 'passwordEmail'])
    ->name('password.email');

    // Rota para exibir o formulário de redefinição de senha
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');
    
    // Rota para processar a redefinição de senha
    Route::post('/password/reset', [ResetPasswordController::class, 'processPasswordReset'])
    ->name('password.update');
    
    Route::get('/send-success', [PasswordEmailController::class, 'showSuccess'])
    ->name('send-success');

    Route::get('/password-success-reset', function () {
        return view('emails.password-success-reset');
    })->name('success-reset-password');

    /*=====================FINAL REDEFINICAO DE SENHA=========================*/

    Route::middleware([Authenticate::class])->group(function(){ 
        Route::get('documentation', function () {
            return view('admin.documentation.introduction');
        })->name('admin.dashboard.documentation.introduction');

        Route::get('/loading', function () {
            return view('admin.loadPage.loading');
        })->name('loading');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('registry-services', RegistryServiceController::class)
        ->names('admin.dashboard.registryService')
        ->parameters(['registry-services'=>'registryService']);
        Route::post('registry-services/delete', [RegistryServiceController::class, 'destroySelected'])
        ->name('admin.dashboard.registryService.destroySelected');
        Route::post('registry-services/sorting', [RegistryServiceController::class, 'sorting'])
        ->name('admin.dashboard.registryService.sorting');

        // SOLICITAÇÕES DE SERVIÇOS
        Route::prefix('solicitacoes-de-servicos')->name('admin.dashboard.registryServiceRequest.')->group(function() {
            Route::get('/', [RegistryServiceRequestDashboardController::class, 'index'])->name('index');
            Route::get('/{id}', [RegistryServiceRequestDashboardController::class, 'show'])->name('show');
            Route::post('/{id}/status', [RegistryServiceRequestDashboardController::class, 'updateStatus'])->name('updateStatus');
            Route::post('/{id}/internal-note', [RegistryServiceRequestDashboardController::class, 'addInternalNote'])->name('addInternalNote');
            Route::post('/{id}/assign-user', [RegistryServiceRequestDashboardController::class, 'assignUser'])->name('assignUser');
            Route::post('/{id}/request-documents', [RegistryServiceRequestDashboardController::class, 'requestDocuments'])->name('requestDocuments');
            Route::post('/{id}/approve-documents', [RegistryServiceRequestDashboardController::class, 'approveDocuments'])->name('approveDocuments');
            Route::post('/{id}/confirm-payment', [RegistryServiceRequestDashboardController::class, 'confirmPayment'])->name('confirmPayment');
            Route::post('/{id}/close', [RegistryServiceRequestDashboardController::class, 'closeRequest'])->name('closeRequest');
            Route::post('/{id}/reopen', [RegistryServiceRequestDashboardController::class, 'reopenRequest'])->name('reopenRequest');
            Route::post('/bulk-action', [RegistryServiceRequestDashboardController::class, 'bulkAction'])->name('bulkAction');
            Route::get('/export', [RegistryServiceRequestDashboardController::class, 'export'])->name('export');
        });

        // STATUS DAS SOLICITAÇÕES (Gerenciamento)
        Route::prefix('status-solicitacoes')->name('admin.dashboard.requestStatus.')->group(function() {
            Route::get('/', [RequestStatusController::class, 'index'])->name('index');
            Route::get('/create', [RequestStatusController::class, 'create'])->name('create');
            Route::post('/', [RequestStatusController::class, 'store'])->name('store');
            Route::get('/{requestStatus}/edit', [RequestStatusController::class, 'edit'])->name('edit');
            Route::put('/{requestStatus}', [RequestStatusController::class, 'update'])->name('update');
            Route::delete('/{requestStatus}', [RequestStatusController::class, 'destroy'])->name('destroy');
            Route::post('/{requestStatus}/deactivate', [RequestStatusController::class, 'deactivate'])->name('deactivate');
            Route::post('/{requestStatus}/activate', [RequestStatusController::class, 'activate'])->name('activate');
        });

        //AUDITORIA
        Route::resource('auditorias', AuditActivityController::class)
        ->names('admin.dashboard.audit')
        ->parameters(['auditorias'=>'activitie']);
        Route::post('auditorias/{id}/mark-as-read', [AuditActivityController::class, 'markAsRead']);
        Route::post('/auditorias/mark-all-as-read', [AuditActivityController::class, 'markAllAsRead']);

        Route::resource('passo-a-passo', StatuteController::class)
        ->names('admin.dashboard.statute')
        ->parameters(['passo-a-passo'=>'statute']);
        //LEAD
        Route::resource('lead', FormIndexController::class)
        ->names('admin.dashboard.formIndex')
        ->parameters(['lead'=>'formIndex']);
        //CONTATO
        Route::resource('contato', ContactController::class)
        ->names('admin.dashboard.contact')
        ->parameters(['contato'=>'contact']);
        //NEWSLTTER
        Route::resource('newsletter', NewsletterController::class)
        ->names('admin.dashboard.newsletter')
        ->parameters(['newsletter'=>'newsletter']);
        Route::post('newsletter/delete', [NewsletterController::class, 'destroySelected'])
        ->name('admin.dashboard.newsletter.destroySelected');
        //LEAD DOWNLOAD
        Route::resource('lead-download', DownloadFichaController::class)
        ->names('admin.dashboard.leadDownload')
        ->parameters(['lead-download'=>'downloadFicha']);
        Route::post('lead-download/delete', [DownloadFichaController::class, 'destroySelected'])
        ->name('admin.dashboard.leadDownload.destroySelected');
        //E-MAIL CONFIG
        Route::resource('configuracao-de-email', SettingEmailController::class)
        ->names('admin.dashboard.settingEmail')
        ->parameters(['configuracao-de-email' => 'settingEmail']);
        Route::post('configuracoes/smtp/verify', [SettingEmailController::class, 'smtpVerify'])->name('admin.dashboard.settingEmail.smtpVerify');
        //GRUPOS
        Route::resource('grupos', RoleController::class)
        ->names('admin.dashboard.group')
        ->parameters(['grupos' => 'role']);
        Route::post('grupos/delete', [RoleController::class, 'destroySelected'])
        ->name('admin.dashboard.group.destroySelected');
        //USUARIOS
        Route::resource('usuario', UserController::class)
        ->names('admin.dashboard.user')
        ->parameters(['usuario'=>'user']);
        Route::post('usuario/delete', [UserController::class, 'destroySelected'])
        ->name('admin.dashboard.user.destroySelected');
        Route::post('usuario/sorting', [UserController::class, 'sorting'])
        ->name('admin.dashboard.user.sorting');

        // SETTINGS THEME
        Route::post('setting', [SettingThemeController::class, 'setting'])->name('admin.dashboard.settingTheme'); 
        Route::post('setting/update', [SettingThemeController::class, 'settingUpdate'])->name('admin.dashboard.settingThemeUpdate'); 
    });

    // LANGUAGES
    Route::get('/lang/{locale}', function (string $locale) {
        if (! in_array($locale, ['en', 'es', 'pt'])) {
            abort(400);
        }
        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back();
    })->name('change.language');
    // LOGOUT
    Route::get('logout', [AuthController::class, 'logout'])->name('admin.dashboard.user.logout');
});

View::composer('admin.core.admin', function ($view) {
    $currentUser = Auth::user();
    $user = User::where('id', $currentUser->id)->active()->first();
    
    $notifications = (new AuditCountRepository());
    $auditorias = $notifications->allAudit();
    $auditCount = $notifications->auditCount();
    $settingTheme = (new SettingThemeRepository())->settingTheme();

    $services = RegistryServiceRequest::selectRaw('registry_service_id, COUNT(*) as total')
    ->with('service:id,name')
    ->groupBy('registry_service_id')
    ->get();

    $chartData = [];

    foreach ($services as $item) {
        $chartData[] = [
            $item->service->name,
            $item->total
        ];
    }

    // Pega os anos dinamicamente
    $currentYear = date('Y');  // 2026
    $previousYear = $currentYear - 1;  // 2025

    $requests = RegistryServiceRequest::selectRaw("
        YEAR(created_at) as year,
        MONTH(created_at) as month,
        COUNT(*) as total")
        ->whereIn(DB::raw('YEAR(created_at)'), [$previousYear, $currentYear])
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    $months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

    $chartYear = [];

    foreach ($months as $index => $month) {
        $monthNumber = $index + 1;
        
        $chartYear[] = [
            'month' => $month,
            'previous_year' => optional(
                $requests->where('year', $previousYear)->where('month', $monthNumber)->first()
            )->total ?? 0,
            'current_year' => optional(
                $requests->where('year', $currentYear)->where('month', $monthNumber)->first()
            )->total ?? 0,
        ];
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

    return $view->with('settingTheme', $settingTheme)
    ->with('user', $user)
    ->with('auditorias', $auditorias)
    ->with('chartData', $chartData)
    ->with('chartYear', $chartYear)
    ->with('currentYear', $currentYear)
    ->with('previousYear', $previousYear)
    ->with('topServicesMonth', $topServicesMonth)
    ->with('auditCount', $auditCount);
});
