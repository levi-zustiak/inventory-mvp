<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{company}', [CompanyController::class, 'show']);
Route::get('/companies/{company}/campaigns', [CampaignController::class, 'index']);
Route::get('/companies/{company}/campaigns/{campaign}', [CampaignController::class, 'show'])->scopeBindings();
Route::get('/companies/{company}/campaigns/{campaign}/items', [CampaignController::class, 'index'])->scopeBindings();

Route::post('/companies/{company}/campaigns/{campaign}/items', [ItemController::class, 'store'])->scopeBindings();
