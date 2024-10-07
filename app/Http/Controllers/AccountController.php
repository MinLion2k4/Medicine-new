<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // Model User hiện tại đại diện cho bảng accounts
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    // Lấy danh sách tất cả tài khoản
    public function index()
    {
        $accounts = User::all();
        return response()->json($accounts);
    }

    // Tạo mới một tài khoản
    public function store(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:100',
            'email' => 'nullable|email|max:100|unique:accounts,email',
            'password' => 'required|string|min:6|max:100',
            'phone' => 'nullable|string|max:10',
            'role_id' => 'nullable|string|max:10',
            'status' => 'nullable|string|max:25',
        ]);

        $account = new User();
        $account->id = Str::uuid()->toString();  // Tạo UUID cho id
        $account->fullName = $request->fullName;
        $account->email = $request->email;
        $account->password = Hash::make($request->password);  // Hash mật khẩu
        $account->token = 'tokentestabcxyz';  // Token mặc định
        $account->phone = $request->phone;
        $account->role_id = $request->role_id;
        $account->status = $request->status;
        $account->save();

        return response()->json($account, 201);  // Trả về dữ liệu tài khoản vừa tạo với mã 201 (Created)
    }

    // Sửa đổi thông tin tài khoản (ví dụ: đổi mật khẩu)
    public function update(Request $request, $id)
    {
        $account = User::findOrFail($id);

        $request->validate([
            'password' => 'nullable|string|min:6|max:100',
        ]);

        if ($request->password) {
            $account->password = Hash::make($request->password);  // Cập nhật mật khẩu
        }

        $account->save();

        return response()->json($account);  // Trả về dữ liệu tài khoản đã cập nhật
    }
    //lấy 1 tài khaon theo email hoac password accounts ? email = nguyenvana@example.com & password = 123456
        public function getAccount(Request $request)
        {
            $email = $request->query('email');
            $password = $request->query('password');

            // Tìm người dùng dựa trên email và mật khẩu
            $user = User::where('email', $email)->first();

            // Kiểm tra mật khẩu
            if ($user && $password == $user->password) {
                return response()->json([
                    // 'status' => 'success',
                     $user
                ]);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Invalid email or password'
            ], 401);
        }

}
