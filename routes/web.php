<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ParticipationRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CampaignController::class, 'index'])->name('home');

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
    
    // Campaign routes for authorized users
    Route::get('/my-campaigns', [CampaignController::class, 'myCampaigns'])->name('campaigns.my');
    Route::resource('campaigns', CampaignController::class)->except(['index', 'show']);
    
    // Donation routes
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::get('/campaigns/{campaign}/donate', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/campaigns/{campaign}/donate', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{donation}', [DonationController::class, 'show'])->name('donations.show');
    Route::get('/donations/{donation}/receipt', [DonationController::class, 'receipt'])->name('donations.receipt');
    
    // Comment routes
    Route::post('/campaigns/{campaign}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Like routes
    Route::post('/campaigns/{campaign}/like', [LikeController::class, 'store'])->name('likes.store');
    Route::delete('/campaigns/{campaign}/unlike', [LikeController::class, 'destroy'])->name('likes.destroy');
    
    // Participation request routes
    Route::get('/participation-requests', [ParticipationRequestController::class, 'index'])->name('participation-requests.index');
    Route::get('/my-participation-requests', [ParticipationRequestController::class, 'userRequests'])->name('participation-requests.user');
    Route::post('/campaigns/{campaign}/participate', [ParticipationRequestController::class, 'store'])->name('participation-requests.store');
    Route::patch('/participation-requests/{participationRequest}/status', [ParticipationRequestController::class, 'updateStatus'])->name('participation-requests.update-status');
    Route::post('/participation-requests/{participationRequest}/approve', [ParticipationRequestController::class, 'approve'])->name('participation-requests.approve');
    Route::post('/participation-requests/{participationRequest}/reject', [ParticipationRequestController::class, 'reject'])->name('participation-requests.reject');
    Route::get('/participation-requests/{participationRequest}', [ParticipationRequestController::class, 'show'])->name('participation-requests.show');
    Route::delete('/participation-requests/{participationRequest}', [ParticipationRequestController::class, 'destroy'])->name('participation-requests.destroy');
});

require __DIR__.'/auth.php';
