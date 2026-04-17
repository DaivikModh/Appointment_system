<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/homepage', [AppointmentController::class, 'index'])->name('homepage');
Route::get('/admin_dashboard', [AppointmentController::class, 'admin'])->name('admin_dashboard');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/create_appointment', [AppointmentController::class, 'create'])->name('create_appointment');
Route::post('/create_user', [UserController::class, 'create_user'])->name('create_user');
Route::post('/validate', [UserController::class, 'validate'])->name('validate');

Route::get('/user_appointments', [AppointmentController::class, 'display'])->name('user_appointments');
Route::get('/edit_note/{id}', [AppointmentController::class, 'edit_note'])->name('edit_note');
Route::post('/change_note', [AppointmentController::class, 'change_note'])->name('change_note');
Route::get('/appointments', [AppointmentController::class, 'appointments'])->name('appointments');
