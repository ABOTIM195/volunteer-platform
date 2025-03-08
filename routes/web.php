<?php

use App\Http\Controllers\BadgeController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ParticipationRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\LanguageController;
use App\Http\Middleware\CacheResponse;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

// Home page - added cache middleware with correct parameter passing
Route::get('/', [CampaignController::class, 'index'])
    ->name('home')
    ->middleware([CacheResponse::class . ':60']); // Cache for 60 minutes

Route::get('/user-check', function () {
    return view('user-check');
})->name('user-check');

Route::get('/change-user-type', [UserController::class, 'showChangeTypeForm'])->name('show-change-user-type');
Route::post('/change-user-type', [UserController::class, 'changeType'])->name('change-user-type');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Public campaign routes
Route::get('/campaigns', [CampaignController::class, 'index'])
    ->name('campaigns.index')
    ->middleware([CacheResponse::class . ':30']); // Cache for 30 minutes

Route::get('/campaigns/{campaign}', [CampaignController::class, 'show'])
    ->name('campaigns.show')
    ->middleware([CacheResponse::class . ':30']); // Cache for 30 minutes

// Auth routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // أضف هذا المسار للاختبار
    Route::get('/test-campaign-create', [CampaignController::class, 'create'])->name("campaigns.create");

    // Campaign routes for authorized users
    Route::get('/my-campaigns', [CampaignController::class, 'myCampaigns'])->name('campaigns.my');
    Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
    Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
    Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');

    // Comment routes
    Route::post('/campaigns/{campaign}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // Like routes
    Route::post('/campaigns/{campaign}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/campaigns/{campaign}/unlike', [LikeController::class, 'destroy'])->name('likes.destroy');

    // Donation routes
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::post('/campaigns/{campaign}/donations', [DonationController::class, 'store'])->name('donations.store');

    // Participation request routes
    Route::get('/participation-requests', [ParticipationRequestController::class, 'index'])->name('participation-requests.index');
    Route::get('/participation-requests/user', [ParticipationRequestController::class, 'userRequests'])->name('participation-requests.user');
    Route::post('/campaigns/{campaign}/participation-requests', [ParticipationRequestController::class, 'store'])->name('participation-requests.store');
    Route::patch('/participation-requests/{participationRequest}', [ParticipationRequestController::class, 'update'])->name('participation-requests.update');
    Route::delete('/participation-requests/{participationRequest}', [ParticipationRequestController::class, 'destroy'])->name('participation-requests.destroy');
    
    // Badges routes
    Route::get('/my-badges', [BadgeController::class, 'userBadges'])->name('badges.user');
    Route::post('/badges/{badge}/toggle-featured', [BadgeController::class, 'toggleFeatured'])->name('badges.toggle-featured');
});

// Badges public routes
Route::get('/badges', [BadgeController::class, 'index'])
    ->name('badges.index')
    ->middleware([CacheResponse::class . ':60']);
    
Route::get('/badges/{badge}', [BadgeController::class, 'show'])
    ->name('badges.show')
    ->middleware([CacheResponse::class . ':60']);

// مسارات لوحة المتصدرين
Route::get('/leaderboard', [LeaderboardController::class, 'index'])
    ->name('leaderboard.index')
    ->middleware([CacheResponse::class . ':15']);
    
Route::get('/leaderboard/participation', [LeaderboardController::class, 'participation'])
    ->name('leaderboard.participation')
    ->middleware([CacheResponse::class . ':15']);
    
Route::get('/leaderboard/donation', [LeaderboardController::class, 'donation'])
    ->name('leaderboard.donation')
    ->middleware([CacheResponse::class . ':15']);

Route::get('/leaderboard/search', [LeaderboardController::class, 'search'])
    ->name('leaderboard.search')
    ->middleware([CacheResponse::class . ':5']);

// طرق صفحات الموقع العامة - تطبيق التخزين المؤقت بشكل صحيح
Route::get('/about', function () {
    return view('about');
})->name('about')->middleware([CacheResponse::class . ':1440']);

Route::get('/faq', function () {
    return view('faq');
})->name('faq')->middleware([CacheResponse::class . ':1440']);

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy')->middleware([CacheResponse::class . ':1440']);

Route::get('/terms-of-service', function () {
    return view('terms');
})->name('terms-of-service')->middleware([CacheResponse::class . ':1440']);

// طرق صفحة الاتصال
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// طريق الاشتراك في النشرة البريدية
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// طرق تغيير اللغة
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');

require __DIR__ . '/auth.php';
