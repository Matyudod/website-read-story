<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['email', 'password', 'user_token'];

    public static function validate(array $data)
    {
        $errors = [];

        if (!$data['email']) {
            $errors['email'] = 'Email không hợp lệ.';
        } elseif (static::where('email', $data['email'])->count() > 0) {
            $errors['email'] = 'Email đã được sử dụng.';
        }

        if (strlen($data['password']) < 6) {
            $errors['password'] = 'Mật khẩu tối thiểu phải 6 kí tự.';
        } elseif ($data['password'] != $data['password_confirmation']) {
            $errors['password'] = 'Mật khẩu không khớp.';
        }

        return $errors;
    }
}