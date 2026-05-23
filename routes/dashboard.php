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
use App\Http\Controllers\RequestStatusController;
use App\Http\Controllers\ReportController;
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
use App\Models\User;
use App\Repositories\AuditCountRepository;
use App\Repositories\SettingThemeRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
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
            Route::patch('/{id}/status', [RegistryServiceRequestDashboardController::class, 'updateStatus'])->name('updateStatus');
            Route::post('/{id}/internal-note', [RegistryServiceRequestDashboardController::class, 'addInternalNote'])->name('addInternalNote');
            Route::post('/{id}/assign-user', [RegistryServiceRequestDashboardController::class, 'assignUser'])->name('assignUser');
            Route::post('/{id}/request-documents', [RegistryServiceRequestDashboardController::class, 'requestDocuments'])->name('requestDocuments');
            Route::post('/{id}/approve-documents', [RegistryServiceRequestDashboardController::class, 'approveDocuments'])->name('approveDocuments');
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


    // Em routes/web.php (admin)
// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::prefix('dashboard')->group(function () {
//         // Rotas para gerenciar serviços
//         Route::resource('registryService', RegistryServiceController::class);
//     });
// });

// // Em routes/api.php (para o frontend)
// Route::prefix('api')->group(function () {
//     Route::get('registry-services', [RegistryServiceController::class, 'apiIndex']);
//     Route::get('registry-services/{id}', [RegistryServiceController::class, 'apiShow']);
//     Route::post('registry-service-requests', [RegistryServiceRequestController::class, 'apiStore']);
// });

        // Route::resource('registryService', RegistryServiceController::class);

        // Route::prefix('registry-services')->group(function () {
        //     Route::get('/', [RegistryServiceController::class, 'index']);
        //     Route::get('/active', [RegistryServiceController::class, 'getActiveServices']);
        //     Route::post('/bulk', [RegistryServiceController::class, 'bulkStore']);
        //     Route::post('/', [RegistryServiceController::class, 'store']);
        //     Route::get('/{id}', [RegistryServiceController::class, 'show']);
        //     Route::put('/{id}', [RegistryServiceController::class, 'update']);
        //     Route::delete('/{id}', [RegistryServiceController::class, 'destroy']);
        //     Route::patch('/{id}/status', [RegistryServiceController::class, 'updateStatus']);
        //     Route::patch('/{id}/restore', [RegistryServiceController::class, 'restore']);
        // });













        Route::resource('pop-up', PopUpController::class)
        ->names('admin.dashboard.popUp')
        ->parameters(['pop-up'=>'popUp']);
        //AUDITORIA
        Route::resource('auditorias', AuditActivityController::class)
        ->names('admin.dashboard.audit')
        ->parameters(['auditorias'=>'activitie']);
        Route::post('auditorias/{id}/mark-as-read', [AuditActivityController::class, 'markAsRead']);
        Route::post('/auditorias/mark-all-as-read', [AuditActivityController::class, 'markAllAsRead']);
        //SLIDES
        Route::resource('slides', SlideController::class)
        ->names('admin.dashboard.slide')
        ->parameters(['slides'=>'slide']);
        Route::post('slides/delete', [SlideController::class, 'destroySelected'])
        ->name('admin.dashboard.slide.destroySelected');
        Route::post('slides/sorting', [SlideController::class, 'sorting'])
        ->name('admin.dashboard.slide.sorting');
        //TOPICOS
        Route::resource('topico', TopicController::class)
        ->names('admin.dashboard.topic')
        ->parameters(['topico'=>'topic']);
        Route::post('topico/delete', [TopicController::class, 'destroySelected'])
        ->name('admin.dashboard.topic.destroySelected');
        Route::post('topico/sorting', [TopicController::class, 'sorting'])
        ->name('admin.dashboard.topic.sorting');
        //Parametro
        Route::resource('parametro', BenefitTopicController::class)
        ->names('admin.dashboard.benefitTopic')
        ->parameters(['parametro'=>'benefitTopic']);
        Route::post('parametro/delete', [BenefitTopicController::class, 'destroySelected'])
        ->name('admin.dashboard.benefitTopic.destroySelected');
        Route::post('parametro/sorting', [BenefitTopicController::class, 'sorting'])
        ->name('admin.dashboard.benefitTopic.sorting');
        //Passo a passo
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
        //ANUNCIO
        Route::resource('anuncio', AnnouncementController::class)
        ->names('admin.dashboard.announcement')
        ->parameters(['anuncio'=>'announcement']);
        Route::post('anuncio/delete', [AnnouncementController::class, 'destroySelected'])
        ->name('admin.dashboard.announcement.destroySelected');
        Route::post('anuncio/sorting', [AnnouncementController::class, 'sorting'])
        ->name('admin.dashboard.announcement.sorting');

        //BLOG
        Route::resource('blog', BlogController::class)
        ->parameters(['blog' => 'blog'])
        ->names('admin.dashboard.blog');
        Route::post('blog/delete', [BlogController::class, 'destroySelected'])
        ->name('admin.dashboard.blog.destroySelected');
        Route::post('blog/sorting', [BlogController::class, 'sorting'])
        ->name('admin.dashboard.blog.sorting');
        Route::post('blog/uploadImageCkeditor', [BlogController::class, 'uploadImageCkeditor'])
        ->name('admin.dashboard.blog.uploadImageCkeditor');
        //CATEGORIA BLOG
        Route::resource('categoria-do-blog', BlogCategoryController::class)
        ->parameters(['categoria-do-blog' => 'blogCategory'])
        ->names('admin.dashboard.blogCategory');
        Route::post('categoria-do-blog/delete', [BlogCategoryController::class, 'destroySelected'])
        ->name('admin.dashboard.blogCategory.destroySelected');
        Route::post('categoria-do-blog/sorting', [BlogCategoryController::class, 'sorting'])
        ->name('admin.dashboard.blogCategory.sorting');
        //REPORT
        Route::resource('missao-visao-e-valores', ReportController::class)
        ->names('admin.dashboard.report')
        ->parameters(['missao-visao-e-valores'=>'report']);
        //LETSGO
        Route::resource('sessao-lets-go', LetsgoController::class)
        ->names('admin.dashboard.letsgo')
        ->parameters(['sessao-lets-go'=>'letsgo']);
        //ONDE ATENDEMOS
        Route::resource('onde-atendemos', ServiceLocationController::class)
        ->names('admin.dashboard.serviceLocation')
        ->parameters(['onde-atendemos'=>'serviceLocation']);
        //CATEGORIA PRODUTO
        Route::resource('categoria-de-produtos', ProductCategoryController::class)
        ->parameters(['categoria-de-produtos' => 'productCategory'])
        ->names('admin.dashboard.productCategory');
        Route::post('categoria-de-produtos/delete', [ProductCategoryController::class, 'destroySelected'])
        ->name('admin.dashboard.productCategory.destroySelected');
        Route::post('categoria-de-produtos/sorting', [ProductCategoryController::class, 'sorting'])
        ->name('admin.dashboard.productCategory.sorting');
        //DEPOIMENT
        Route::resource('depoimento', DepoimentController::class)
        ->parameters(['depoimento' => 'depoiment'])
        ->names('admin.dashboard.depoiment');
        Route::post('depoimento/delete', [DepoimentController::class, 'destroySelected'])
        ->name('admin.dashboard.depoiment.destroySelected');
        Route::post('depoimento/sorting', [DepoimentController::class, 'sorting'])
        ->name('admin.dashboard.depoiment.sorting');
        //SESSAO FAQ
        Route::resource('sessao-faq', SessaoFaqController::class)
        ->names('admin.dashboard.sessaoFaq')
        ->parameters(['sessao-faq'=>'sessaoFaq']);
        //FAQ
        Route::resource('pergunta', FaqController::class)
        ->parameters(['pergunta' => 'faq'])
        ->names('admin.dashboard.faq');
        Route::post('pergunta/delete', [FaqController::class, 'destroySelected'])
        ->name('admin.dashboard.faq.destroySelected');
        Route::post('pergunta/sorting', [FaqController::class, 'sorting'])
        ->name('admin.dashboard.faq.sorting');
        //PRODUTOS
        Route::resource('produtos', ProductController::class)
        ->parameters(['produtos' => 'product'])
        ->names('admin.dashboard.product');
        Route::post('produtos/delete', [ProductController::class, 'destroySelected'])
        ->name('admin.dashboard.product.destroySelected');
        Route::post('produtos/sorting', [ProductController::class, 'sorting'])
        ->name('admin.dashboard.product.sorting');
        Route::post('produtos/uploadImageCkeditor', [ProductController::class, 'uploadImageCkeditor'])
        ->name('admin.dashboard.product.uploadImageCkeditor');
        //MARCAS
        Route::resource('marca', BrandController::class)
        ->parameters(['marca' => 'brand'])
        ->names('admin.dashboard.brand');
        Route::post('marca/delete', [BrandController::class, 'destroySelected'])
        ->name('admin.dashboard.brand.destroySelected');
        Route::post('marca/sorting', [BrandController::class, 'sorting'])
        ->name('admin.dashboard.brand.sorting');
        //GALERIA PRODUTO
        Route::resource('galeria/arquivo', ProductGalleryController::class)
        ->names('admin.dashboard.gallery.productGallery')
        ->parameters(['arquivo' => 'productGallery']);
        Route::post('galeria/sorting', [ProductGalleryController::class, 'sorting'])
        ->name('admin.dashboard.gallery.productGallery.sorting');
        //DIRECTION
        Route::resource('representantes', DirectionController::class)
        ->parameters(['representantes' => 'direction'])
        ->names('admin.dashboard.direction');
        Route::post('representantes/delete', [DirectionController::class, 'destroySelected'])
        ->name('admin.dashboard.direction.destroySelected');
        Route::post('representantes/sorting', [DirectionController::class, 'sorting'])
        ->name('admin.dashboard.direction.sorting');
        //VIDEO
        Route::resource('videos', VideoController::class)
        ->names('admin.dashboard.video')
        ->parameters(['videos'=>'video']);
        Route::post('videos/delete', [VideoController::class, 'destroySelected'])
        ->name('admin.dashboard.video.destroySelected');
        Route::post('videos/sorting', [VideoController::class, 'sorting'])
        ->name('admin.dashboard.video.sorting');
        //ABOUT
        Route::resource('sobre', AboutController::class)
        ->names('admin.dashboard.about')
        ->parameters(['sobre'=>'about']);
        Route::post('sobre/delete', [AboutController::class, 'destroySelected'])
        ->name('admin.dashboard.about.destroySelected');
        Route::post('sobre/sorting', [AboutController::class, 'sorting'])
        ->name('admin.dashboard.about.sorting');
        Route::post('sobre/uploadImageCkeditorAbout', [AboutController::class, 'uploadImageCkeditorAbout'])
        ->name('admin.dashboard.about.uploadImageCkeditorAbout');
        //EVENT
        Route::resource('agenda', EventController::class)
        ->names('admin.dashboard.event')
        ->parameters(['agenda'=>'event']);
        Route::post('agenda/delete', [EventController::class, 'destroySelected'])
        ->name('admin.dashboard.event.destroySelected');
        Route::post('agenda/sorting', [EventController::class, 'sorting'])
        ->name('admin.dashboard.event.sorting');
        Route::post('agenda/store', [EventController::class, 'storeTheBlog'])
        ->name('admin.dashboard.event.storeTheBlog');

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
        
        //DESATIVAR COMENTARIO
        Route::put('/desativa-comentario/{comment}', [CommentController::class, 'desactiveComment'])
        ->name('comment.desactive.update');
        //ATIVAR COMENTARIO
        Route::put('/ativar-comentario/{comment}', [CommentController::class, 'activeComment'])
        ->name('comment.active.update');
        //DELETAR COMENTARIO
        Route::delete('/deletar-comentario/{comment}', [CommentController::class, 'destroy'])
        ->name('comment.delete');

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

    return $view->with('settingTheme', $settingTheme)->with('user', $user)->with('auditorias', $auditorias)->with('auditCount', $auditCount);
});
