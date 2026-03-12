<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OptionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (Auth::check()) {

        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard.index');
        }

        return redirect()->route('user.index');
    }

    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Guest (Belum Login)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard.index');

        Route::get('/dashboard/{id}', [DashboardController::class, 'report'])
            ->name('dashboard.report');

        Route::get('/options', [OptionController::class, 'index'])
            ->name('options.index');

        Route::post('/options', [OptionController::class, 'store'])
            ->name('options.store');

        Route::put('/options/{id}', [OptionController::class, 'update'])
            ->name('options.update');

        Route::delete('/options/{id}', [OptionController::class, 'destroy'])
            ->name('options.destroy');
    });


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/user', [UserController::class, 'index'])
        ->name('user.index');
});


/*
|--------------------------------------------------------------------------
| Logbook
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/logbook/create', [LogbookController::class, 'create'])
        ->name('logbook.create');

    Route::post('/logbook/store', [LogbookController::class, 'store'])
        ->name('logbook.store');

    Route::get('/logbook/{id}', [LogbookController::class, 'show'])
        ->name('logbook.show');

    Route::get('/logbook/{id}/edit', [LogbookController::class, 'edit'])
        ->name('logbook.edit');
        
    Route::put('/logbook/{id}', [LogbookController::class, 'update'])
        ->name('logbook.update');
});
