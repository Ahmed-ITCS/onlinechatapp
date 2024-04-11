<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userscontroller;

use App\Http\Controllers\MessagesController;

Route::get('/', [userscontroller::class, 'create']);

Route::post('usersubmit', [userscontroller::class, 'store']);

Route::get('/users', [userscontroller::class, 'index']);

Route::get('/chatbox', [MessagesController::class, 'index'])->name('chatbox');

Route::post('/chatbox/send-message', [MessagesController::class, 'sendMessage'])->name('chatbox.send-message');