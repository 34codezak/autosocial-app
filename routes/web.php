<?php

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Livewire\Marketing\ContactPage;
use App\Http\Controllers\{RegisterController, LoginController};
use App\Http\Controllers\Auth\SocialAuthController;
use App\Livewire\{PostEditor, PostCalendar, AnalyticsDashboard};
use App\Services\DashboardMetricsService;


use Illuminate\Support\Facades\Auth;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

use App\Models\Post;
use App\Models\Interaction;

// ─────────────────────────────────────
// PUBLIC ROUTES
// ─────────────────────────────────────
Route::view('/', 'home')->name('home');

// Marketing pages
Route::prefix('marketing')->group(function () {
    Route::view('/product', 'pages.product')->name('product');
    Route::view('/features', 'pages.features')->name('features');
    Route::view('/pricing', 'pages.pricing')->name('pricing');
    Route::view('/demo', 'pages.demo')->name('demo');
    Route::view('/integrations', 'pages.integrations')->name('integrations');
    Route::view('/accessibility', 'pages.accessibility')->name('accessibility');
    Route::view('/about', 'pages.about')->name('about');
    Route::view('/faq', 'pages.faq')->name('faq');
    
    // Blog (with controller for dynamic content)
    // Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    // Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
});

// Auth pages (Volt for simple forms)
Volt::route('/register', 'auth.register')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

/*Route::controller(LoginController::class)->group(function () {

    Route::get('/login', 'showForm')
        ->name('login');

    Route::post('/login', 'handleForm')
        ->name('login.store');
});
*/

// Replace with Volt route:
Volt::route('/login', 'pages.auth.login')
    ->name('login');

// Keep the POST route for form submission if needed:
Route::post('/login', [LoginController::class, 'handleForm'])
    ->name('login.store');

// Rate limiter for auth attempts
RateLimiter::for('login', fn($request) => 
    Limit::perMinute(5)->by($request->email.$request->ip())
);

RateLimiter::for('two-factor', fn($request) => 
    Limit::perMinute(5)->by($request->session()->get('login.id'))
);


// Interactive marketing pages
Route::get('/contact', ContactPage::class)
    ->middleware(['throttle:30,1'])
    ->name('contact');

// ─────────────────────────────────────
// AUTHENTICATED ROUTES
// ─────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Main dashboard (redirect to default tab)
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        // Calculate metrics (replace with your actual logic)
        $totalViews = Post::where('user_id', $user->id)->sum('views') ?? 0;
        $totalLikes = Interaction::where('user_id', $user->id)->where('type', 'like')->count() ?? 0;
        $totalComments = Interaction::where('user_id', $user->id)->where('type', 'comment')->count() ?? 0;
        $totalShares = Interaction::where('user_id', $user->id)->where('type', 'share')->count() ?? 0;
        
        return view('livewire.dashboard', [
            'lastUpdated' => now()->format('M d, Y \a\t h:i A'),
            'userName' => $user->name,
            
            'metrics' => [
                'views' => [
                    'label' => 'Total Views',
                    'value' => number_format($totalViews),
                    'icon' => 'eye',
                    'trend' => '+12.5%',
                    'trendUp' => true,
                ],
                'likes' => [
                    'label' => 'Total Likes',
                    'value' => number_format($totalLikes),
                    'icon' => 'heart',
                    'trend' => '+8.2%',
                    'trendUp' => true,
                ],
                'comments' => [
                    'label' => 'Comments',
                    'value' => number_format($totalComments),
                    'icon' => 'chat',
                    'trend' => '-2.1%',
                    'trendUp' => false,
                ],
                'shares' => [
                    'label' => 'Shares',
                    'value' => number_format($totalShares),
                    'icon' => 'share',
                    'trend' => '+24.3%',
                    'trendUp' => true,
                ],
            ],
        ]);
    })->name('dashboard');
    // Dashboard sections (Livewire components)
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/editor', PostEditor::class)->name('editor');
        Route::get('/calendar', PostCalendar::class)->name('calendar');
        Route::get('/analytics', AnalyticsDashboard::class)->name('analytics');
    });
    
    // User profile & settings
    Route::view('/profile', 'profile')->name('profile');
    
    // Workspace & services
    Route::view('/workspace', 'workspace')->name('workspace');
    Route::view('/services', 'services')->name('services');
    
    // Social auth connections
    Route::get('/auth/{platform}/connect', [SocialAuthController::class, 'redirect'])
        ->name('social.connect');
    Route::get('/auth/{platform}/callback', [SocialAuthController::class, 'callback'])
        ->name('social.callback');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// ─────────────────────────────────────
// AUTH BOILERPLATE (Breeze)
// ─────────────────────────────────────
require __DIR__.'/auth.php';