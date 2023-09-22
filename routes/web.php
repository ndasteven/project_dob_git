<?php

use App\Http\Controllers\test;
use App\Livewire\Drenindex;
use App\Livewire\EtablissementIndex;
use App\Livewire\StudentIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/phpinfo', function(){
dd(phpinfo());
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/student',StudentIndex::class)->name('student')->middleware('auth');
Route::get('/dren',Drenindex::class)->name('dren')->middleware('auth');
Route::get('/etablissement',EtablissementIndex::class)->name('etablissement')->middleware('auth');
Route::get('/test', [test::class, 'index']);
