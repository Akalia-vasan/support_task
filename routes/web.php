<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SupportTicketController;
use App\Http\Controllers\Agent\AgentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('post-login', [LoginController::class, 'post'])->name('login.post');

Route::post('support-ticket', [SupportTicketController::class, 'post'])->name('ticket.store');
Route::get('support-ticket/search', [SupportTicketController::class, 'search'])->name('search');
Route::post('support-ticket/search', [SupportTicketController::class, 'postSeach'])->name('search.post');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [LoginController::class, 'dashboard'])->name('dashboard'); 
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('tickets', [AgentController::class, 'index'])->name('agent.index');
    Route::get('tickets/{id}', [AgentController::class, 'show'])->name('agent.show');
    Route::post('reply', [AgentController::class, 'reply'])->name('reply');
});