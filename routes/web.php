<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LINELoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingController::class)
    ->middleware(['guest'])
    ->name('landing');

Route::get('/line-login', [LINELoginController::class, 'create'])
    ->middleware(['guest'])
    ->name('login');
Route::get('/line-login-store', [LINELoginController::class, 'store'])
    ->middleware(['guest'])
    ->name('login.store');
Route::delete('/logout', [LINELoginController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('logout');
Route::get('/register', [RegisterController::class, 'create'])
    ->middleware(['guest'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware(['guest'])
    ->name('register.store');

Route::get('/home', HomeController::class)
    ->middleware(['auth'])
    ->name('home');

Route::get('/upload-user-excel', function (Illuminate\Http\Request $request) {
    if (!in_array($request->user()->id, [1,2,3])) {
        abort(403);
    }

    return view('upload');
})->middleware(['auth']);
Route::post('/upload-user-excel', function (Illuminate\Http\Request $request) {
    if (!in_array($request->user()->id, [1,2,3])) {
        abort(403);
    }

    $request->validate(['upload' => ['required', 'file']]);

    $path = \Illuminate\Support\Facades\Storage::disk('local')
        ->put('uploads/excel', $request->file('upload'));

    if (! \Illuminate\Support\Facades\Storage::disk('local')
        ->move($path, 'uploads/excel/users.xlsx')) {
        return back()->withErrors(['upload' => 'server errors']);
    }

    cache()->put('user-list', (new Rap2hpoutre\FastExcel\FastExcel())->import(storage_path('app/uploads/excel/users.xlsx')));

    return back()->with(['message' => 'OK']);
})->middleware(['auth'])
->name('upload.store');
