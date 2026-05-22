<?php

use App\Http\Controllers\Auth\AuthClientController;
use App\Http\Controllers\Auth\EmailVerificationClientController;
use App\Http\Controllers\Auth\PasswordEmailClientController;
use App\Http\Controllers\Auth\ResetPasswordClientController;
use App\Http\Controllers\Client\AboutPageController;
use App\Http\Controllers\Client\BenefitPageController;
use App\Http\Controllers\Client\BlogPageController;
use App\Http\Controllers\Client\ContactPageController;
use App\Http\Controllers\Client\EventPageController;
use App\Http\Controllers\Client\HomePageController;
use App\Http\Controllers\Client\JuridicoPageController;
use App\Http\Controllers\Client\NoticiesPageController;
use App\Http\Controllers\Client\OrdersPageController;
use App\Http\Controllers\Client\ProductPageController;
use App\Http\Controllers\Client\RegionPageController;
use App\Http\Controllers\Client\RegistryServicePageController;
use App\Http\Controllers\Client\RegistryServiceRequestController;
use App\Http\Controllers\Client\ComplementaryRegistrationController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DownloadFichaController;
use App\Http\Controllers\FormIndexController;
use App\Http\Controllers\NewsletterController;
use App\Http\Middleware\AuthClientMiddleware;
use App\Models\About;
use App\Models\Agreement;
use App\Models\Announcement;
use App\Models\BenefitTopic;
use App\Models\BlogCategory;
use App\Models\Contact;
use App\Models\Direction;
use App\Models\RegistryService;
use App\Models\Report;
use App\Models\Statute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;

require __DIR__ . '/dashboard.php';

Route::get('/', function () {
    return redirect()->route('index');
});


Route::get('/meus-pedidos', [OrdersPageController::class, 'index'])->name('orders');
Route::get('/meus-perfil', function () {
    return view('client.blades.profile');
})->name('profile');
Route::get('/pagamentos', function () {
    return view('client.blades.payment');
})->name('payment');

Route::get('/termos-lgpd', function () {
    return view('client.blades.term-lgpd');
})->name('lgpd-index');
Route::get('/login', function () {
    return view('client.auth.pre_registration');
})->name('login');
Route::get('/login-1', function () {
    return view('client.auth.verification');
})->name('login-1');



// API Routes para serviços de cartório
Route::get('/api/registry-services', [RegistryServicePageController::class, 'getServices'])->name('api.registry-services');
Route::get('/api/registry-services/{id}', [RegistryServicePageController::class, 'getServiceById'])->name('api.registry-services.show');

// API Routes para solicitações de serviço
Route::post('/api/registry-service-requests', [RegistryServiceRequestController::class, 'store'])->name('api.registry-service-requests.store');
Route::get('/api/registry-service-requests/{id}', [RegistryServiceRequestController::class, 'show'])->name('api.registry-service-requests.show');
Route::get('/api/user-requests/{email}', [RegistryServiceRequestController::class, 'getUserRequests'])->name('api.user-requests');

Route::get('produto/{category}/{slug}', [ProductPageController::class, 'productView'])->name('client.product');
Route::get('produtos', [ProductPageController::class, 'productAll'])->name('products');

Route::post('login.do', [AuthClientController::class, 'authenticate'])
->name('client.user.authenticate');

// Email Verification Routes
Route::get('/email/verify/{token}', [EmailVerificationClientController::class, 'verify'])
    ->name('client.email.verify');

Route::get('/email/verification-pending', [EmailVerificationClientController::class, 'pending'])
    ->name('client.email.pending');

Route::get('/reenviar-confirmacao', [EmailVerificationClientController::class, 'showResendForm'])
    ->name('client.email.resend-form');

Route::post('/reenviar-confirmacao', [EmailVerificationClientController::class, 'resend'])
    ->name('client.email.resend');

// Rota para processar o formulário "Esqueci a senha"
Route::post('/password/email', [PasswordEmailClientController::class, 'passwordEmail'])
->name('client.password.email');

Route::get('/email-enviado-com-sucesso', [PasswordEmailClientController::class, 'showSuccess'])
->name('send-success-client');

// Rota para processar a redefinição de senha
Route::post('/password/reset', [ResetPasswordClientController::class, 'processPasswordReset'])
->name('client-password.update');

// Rota para exibir o formulário de redefinição de senha
Route::get('password/reset/{token}', [ResetPasswordClientController::class, 'showResetForm'])
->name('client.password.reset');


Route::get('/senha-alterada-com-sucesso', function () {
    return view('emails.password-success-client-reset');
})->name('client-success-reset-password');


Route::middleware([AuthClientMiddleware::class])->group(function () {
    Route::get('/servicos-cartorio', [RegistryServicePageController::class, 'index'])->name('index');
    
    Route::get('/cadastro-complementar', [ComplementaryRegistrationController::class, 'show'])
        ->name('complementary-add-on');
    
    Route::post('/cadastro-complementar', [ComplementaryRegistrationController::class, 'store'])
        ->name('complementary-add-on.store');
    
    Route::post('/cadastro-complementar/skip', [ComplementaryRegistrationController::class, 'skip'])
        ->name('complementary-add-on.skip');

    Route::put('/client/update', [ClientController::class, 'update'])->name('client.update');

    Route::post('/client/comments', [CommentController::class, 'store'])
    ->name('blog.comment');

    Route::get('logout', [AuthClientController::class, 'logout'])->name('client.user.logout');
});

Route::get('contato', [ContactPageController::class, 'index'])
->name('contact');
Route::post('send-contact', [FormIndexController::class, 'store'])->name('send-contact');
Route::get('blog/{slug}', [BlogPageController::class, 'blogInner'])
->name('blog-inner');
Route::get('blog', [BlogPageController::class, 'index'])->name('blogAll');
Route::get('blog/categoria/{category?}', [BlogPageController::class, 'index'])->name('blog');
Route::post('blog/search', [BlogPageController::class, 'index'])->name('blog-search');
Route::post('send-newsletter', [NewsletterController::class, 'store'])->name('send-newsletter');

Route::post('cliente/cadastro', [ClientController::class, 'store'])->name('register-client');
Route::post('cliente/cadastro/verification', [ClientController::class, 'verification'])->name('resend.verification');


Route::get('sobre', [AboutPageController::class, 'index'])->name('about');
Route::get('eventos', [EventPageController::class, 'index'])->name('client.event');
Route::get('blog/filter/{category?}', [HomePageController::class, 'filterByCategory'])
    ->name('blog.filter');
Route::post('/download-ficha/store', [DownloadFichaController::class, 'store'])
->name('download.ficha.store');

// <?php

// use App\Http\Controllers\Client\Auth\PreRegistrationController;
// use App\Http\Controllers\Client\Auth\VerificationController;
// use App\Http\Controllers\Client\Auth\ComplementRegistrationController;

// Route::prefix('client')->name('client.')->group(function() {
    
//     // Pré-cadastro
//     Route::get('pre-registration', [PreRegistrationController::class, 'create'])->name('pre-registration');
//     Route::post('pre-registration', [PreRegistrationController::class, 'store'])->name('pre-registration.store');
    
//     // Verificação
//     Route::get('email/verify', [VerificationController::class, 'show'])->name('verification.notice');
//     Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
//     Route::post('email/verification-resend', [VerificationController::class, 'resend'])->name('verification.resend');
    
//     // Complementação cadastral
//     Route::get('complement-registration', [ComplementRegistrationController::class, 'create'])->name('complement-registration')->middleware(['auth', 'verified']);
//     Route::post('complement-registration', [ComplementRegistrationController::class, 'store'])->name('complement-registration.store')->middleware(['auth', 'verified']);
    
// });


View::composer('client.blades.index', function ($view) {
    $services = RegistryService::where('is_active', true)
    ->orderBy('display_order')
    ->get();
        
    // Pré-carregar templates dos campos dinâmicos para cada serviço
    $dynamicFieldsTemplates = [];
    foreach ($services as $service) {
        $dynamicFieldsTemplates[$service->id] = $service->dynamic_fields ?? [];
    }
        

    return $view->with('services', $services)
    ->with('dynamicFieldsTemplates', $dynamicFieldsTemplates);
});
