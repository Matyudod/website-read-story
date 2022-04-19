<?php

namespace App;

use App\Models\User;

class SessionGuard
{
    protected static $user;

    public static function login(User $user, array $credentials)
    {
        $verified = password_verify($credentials['password'], $user->password);
        if ($verified) {
            $token = bin2hex(random_bytes(16));
            $_SESSION['user'] = $token;
            $user->update([
                "user_token" =>  $token,
            ]);
        }
        return $verified;
    }

    public static function user()
    {
        if (!static::$user && static::isUserLoggedIn()) {
            static::$user = User::where("user_token", $_SESSION['user']);
        }
        return static::$user;
    }

    public static function logout()
    {
        static::$user = null;
        session_unset();
        session_destroy();
    }

    public static function isUserLoggedIn()
    {
        return isset($_SESSION['user']);
    }
}