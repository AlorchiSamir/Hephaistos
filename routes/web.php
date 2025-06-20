<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitDayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index.index');

Route::prefix('dashboard')->group(function()
{
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
});

Route::prefix('log')->group(function()
{
    Route::get('/', [LogController::class, 'index'])->name('log.index');
    Route::get('/json', [LogController::class, 'json'])->name('log.json');
    Route::get('/form/{day}', [LogController::class, 'form'])->name('log.form');
    Route::post('/store', [LogController::class, 'store'])->name('log.store');
});

Route::prefix('habits')->group(function()
{
    Route::get('/', [HabitController::class, 'index'])->name('habits.index');
    Route::get('/json', [HabitController::class, 'json'])->name('habits.json');
    Route::put('/update', [HabitController::class, 'update'])->name('habits.update');
    Route::get('/form/{habit?}', [HabitController::class, 'form'])->name('habits.form');
    Route::post('/', [HabitController::class, 'store'])->name('habits.store');
});

Route::prefix('habitday')->group(function()
{
    Route::get('/', [HabitDayController::class, 'index'])->name('habitday.index');
    Route::get('/json', [HabitDayController::class, 'json'])->name('habitday.json');
    Route::get('/view/{day}', [HabitDayController::class, 'view'])->name('habitday.view');
    Route::get('/view/json/{day}', [HabitDayController::class, 'view_json'])->name('habitday.view_json');
    Route::put('/{day}', [HabitDayController::class, 'update'])->name('habitday.update');
    //Route::post('/', [HabitDayController::class, 'store'])->name('habitday.store');
});

Route::prefix('test')->group(function()
{
    Route::get('/microsoft', [TestController::class, 'microsoft'])->name('test.microsoft');
});

Auth::routes();


