<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Home')->name('home');

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/inventories', [InventoryController::class, 'index']);

Route::get('/companies', [CompanyController::class, 'index'])->name('companies.index');
Route::get('/companies/{company}', [CompanyController::class, 'show']);
Route::get('/companies/{company}/campaigns', [CampaignController::class, 'index']);
Route::get('/companies/{company}/campaigns/{campaign}', [CampaignController::class, 'show'])->scopeBindings();
Route::get('/companies/{company}/campaigns/{campaign}/items', [CampaignController::class, 'index'])->scopeBindings();

Route::post('/companies/{company}/campaigns/{campaign}/items', [ItemController::class, 'store'])->scopeBindings();
Route::post('/companies/{company}/campaigns/{campaign}/assignments', [AssignmentController::class, 'store'])->scopeBindings();
