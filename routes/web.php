<?php

use App\Http\Livewire\Eventos\ShowEvents;
use App\Http\Livewire\usuarios\ShowUser;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    
    //usuarios
    Route::get('/users', ShowUser::class )->name('users');

   //Eventos
    Route::get('/events', ShowEvents::class )->name('events');

    //settings acount
    Route::get('/settings/account', function () {
        return view('profile/account');
    })->name('account');  

    Route::get('/settings/notifications', function () {
        return view('profile/notifications');
    })->name('notifications');

    Route::get('/settings/plans', function () {
        return view('profile/plans');
    })->name('plans');  

});
