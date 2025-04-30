<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccessRecordController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create', [TeacherController::class, 'create'])->name('create');
Route::get('delete/{id}', [TeacherController::class,'destroy']);
Route::put('/teachers/{id}', [TeacherController::class, 'update']);
Route::get('/teachers', [TeacherController::class, 'index']);
Route::get('/access', [AccessRecordController::class, 'index'])->name('access');
Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');


Route::resource('teachers', TeacherController::class);
Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');

Route::resource('teachers', TeacherController::class)->middleware('auth');

Route::get('/dashboard', function () {return redirect('/teachers');})->name('dashboard');





