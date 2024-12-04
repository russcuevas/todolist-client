<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;


// AUTH
Route::get('/', [AuthController::class, 'LoginPage'])->name('login');
Route::get('/login', [AuthController::class, 'LoginPage'])->name('login');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('register');


Route::post('login', [AuthController::class, 'login'])->name('loginrequest');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('register', [AuthController::class, 'register'])->name('registerrequest');


// TODO
Route::get('/todos', [TodoController::class, 'TodoPage'])->name('todos.page');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
Route::put('/todos/{todo}', [TodoController::class, 'edit'])->name('todos.edit');
Route::post('/todos/{todo}/update-status', [TodoController::class, 'update'])->name('todos.update');
