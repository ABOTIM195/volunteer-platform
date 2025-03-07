<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ParticipationRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampaignController::class, 'index'])->name('home');

Route::get('/user-check', function () {
    return view('user-check');
})->name('user-check');

Route::get('/change-user-type', [UserController::class, 'showChangeTypeForm'])->name('show-change-user-type');
Route::post('/change-user-type', [UserController::class, 'changeType'])->name('change-user-type');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public campaign routes
Route::resource('campaigns', CampaignController::class)->only(['index', 'show']);

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
    // Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
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
    
});

require __DIR__ . '/auth.php';
