<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// --- 🌐 User Landing & Voting Portal ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/candidate/{id}', [HomeController::class, 'show'])->name('candidate.show');

// --- 💳 Voting & Payment Flow ---
Route::post('/vote/checkout', [PaymentController::class, 'checkout'])->name('vote.checkout');
Route::post('/vote/callback', [PaymentController::class, 'callback'])->name('vote.callback');
Route::post('/vote/simulate-success', [PaymentController::class, 'simulateSuccess'])->name('vote.simulate');
Route::get('/vote/status/{invoice_id}', [PaymentController::class, 'checkStatus'])->name('vote.status');
Route::get('/vote/receipt/{invoice_id}', [PaymentController::class, 'receipt'])->name('vote.receipt');

// --- 🔐 Authenticated Admin Portal ---
Route::get('/admin/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Admin User CRUD Management
    Route::get('/users', [AdminController::class, 'listUsers'])->name('users');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    // Candidates CRUD Management
    Route::get('/candidates', [AdminController::class, 'listCandidates'])->name('candidates');
    Route::post('/candidates', [AdminController::class, 'storeCandidate'])->name('candidates.store');
    Route::put('/candidates/{id}', [AdminController::class, 'updateCandidate'])->name('candidates.update');
    Route::delete('/candidates/{id}', [AdminController::class, 'deleteCandidate'])->name('candidates.delete');
    
    // Offline Vote Injector
    Route::post('/votes/manual-add', [AdminController::class, 'injectVotes'])->name('votes.inject');

    // Transactions Log ("Siapa Memilih Siapa")
    Route::get('/transactions', [AdminController::class, 'listTransactions'])->name('transactions');
});

