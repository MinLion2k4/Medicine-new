<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Tên bảng sẽ được sử dụng bởi model này.
     *
     * @var string
     */
    protected $table = 'accounts'; // Sử dụng bảng 'accounts' thay vì 'users'

    /**
     * Khóa chính của bảng.
     *
     * @var string
     */
    protected $primaryKey = 'id';  // Đặt 'id' làm khóa chính

    /**
     * Khóa chính không tự động tăng.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Kiểu của khóa chính.
     *
     * @var string
     */
    protected $keyType = 'string';  // Vì id là kiểu varchar

    /**
     * Các thuộc tính có thể gán giá trị hàng loạt.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',          // ID của người dùng
        'fullName',    // Tên đầy đủ
        'email',       // Email
        'password',    // Mật khẩu
        'token',       // Token (mặc định hoặc người dùng tạo)
        'phone',       // Số điện thoại
        'role_id',     // Vai trò của người dùng
        'status',      // Trạng thái của tài khoản
    ];

    /**
     * Các thuộc tính cần được ẩn khi trả về kết quả JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',         // Mật khẩu không nên được hiển thị
        'remember_token',   // Token ghi nhớ phiên làm việc
    ];

    /**
     * Định dạng các thuộc tính cần được cast (chuyển kiểu).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',  // Nếu bạn dùng xác thực email
            'password' => 'hashed',             // Hash mật khẩu khi lưu vào database
        ];
    }
}
