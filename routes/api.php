<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

// Route lấy danh sách tất cả tài khoản, tôi  muốn tách biệt các route này với các route khác

Route::get('/accounts', [AccountController::class, 'index']);
    
// Route lấy thông tin một tài khoản

Route::get('/accounts/login', [AccountController::class, 'getAccount'])->name('accounts.get');;

// Route tạo mới một tài khoản
Route::post('/accounts/create', [AccountController::class, 'store']);

// Route sửa đổi thông tin tài khoản (dùng cho tính năng đổi mật khẩu)
Route::Patch('/accounts/edit/{id}', [AccountController::class, 'update']);
