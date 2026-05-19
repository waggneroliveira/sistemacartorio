<?php

use App\Http\Controllers\Client\AboutPageController;
use App\Http\Controllers\Client\BenefitPageController;
use App\Http\Controllers\Client\BlogPageController;
use App\Http\Controllers\Client\ContactPageController;
use App\Http\Controllers\Client\EventPageController;
use App\Http\Controllers\Client\HomePageController;
use App\Http\Controllers\Client\JuridicoPageController;
use App\Http\Controllers\Client\NoticiesPageController;
use App\Http\Controllers\Client\ProductPageController;
use App\Http\Controllers\Client\RegionPageController;
use App\Http\Controllers\Client\RegistryServicePageController;
use App\Http\Controllers\Client\RegistryServiceRequestController;
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
use App\Models\Report;
use App\Models\Statute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;

require __DIR__ . '/dashboard.php';

Route::get('/', function () {
    return redirect()->route('index');
});
Route::get('/meus-pedidos', function () {
    return view('client.blades.orders');
})->name('orders');
Route::get('/meus-perfil', function () {
    return view('client.blades.profile');
})->name('profile');

// Rota para página de serviços de cartório
Route::get('/servicos-cartorio', [RegistryServicePageController::class, 'index'])->name('registry-services');

// API Routes para serviços de cartório
Route::get('/api/registry-services', [RegistryServicePageController::class, 'getServices'])->name('api.registry-services');

// API Routes para solicitações de serviço
Route::post('/api/registry-service-requests', [RegistryServiceRequestController::class, 'store'])->name('api.registry-service-requests.store');
Route::get('/api/registry-service-requests/{id}', [RegistryServiceRequestController::class, 'show'])->name('api.registry-service-requests.show');
Route::get('/api/user-requests/{email}', [RegistryServiceRequestController::class, 'getUserRequests'])->name('api.user-requests');

Route::get('produto/{category}/{slug}', [ProductPageController::class, 'productView'])->name('client.product');
Route::get('produtos', [ProductPageController::class, 'productAll'])->name('products');

Route::post('login.do', [AuthClientController::class, 'authenticate'])
->name('client.user.authenticate');

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
Route::get('/', [HomePageController::class, 'index'])->name('index');
Route::get('sobre', [AboutPageController::class, 'index'])->name('about');
Route::get('eventos', [EventPageController::class, 'index'])->name('client.event');
Route::get('blog/filter/{category?}', [HomePageController::class, 'filterByCategory'])
    ->name('blog.filter');
Route::post('/download-ficha/store', [DownloadFichaController::class, 'store'])
->name('download.ficha.store');

View::composer('client.core.client', function ($view) {
    $blogCategories = BlogCategory::whereHas('blogs')
    ->active()
    ->sorting()
    ->limit(10)
    ->get();
    $announcements = Announcement::select(
        'exhibition',
        'link',
        'exhibition',
        'path_image',
        'active',
        'sorting',
    )
    ->where('exhibition', '=', 'mobile')
    ->orWhere('exhibition', '=', 'horizontal')
    ->active()
    ->sorting()
    ->get();
    $contact = Contact::first();
    $abouts = About::active()->sorting()->get();
    $directions = Direction::active()->sorting()->count();
    $benefitTopics = BenefitTopic::active()->sorting()->count();
    $report = Report::active()->count();

    return $view->with('blogCategories', $blogCategories)
    ->with('announcements', $announcements)
    ->with('contact', $contact)
    ->with('directions', $directions)
    ->with('benefitTopics', $benefitTopics)
    ->with('report', $report)
    ->with('abouts', $abouts);
});
