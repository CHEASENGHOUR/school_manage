<?php
namespace App\Core;

use App\Models\User;

class Auth {
    public static function attempt($email, $password): bool {
        $user = User::findByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            return true;
        }
        return false;
    }
        public static function user() {
            return $_SESSION['user'] ?? null;
        }

    public static function check(): bool {
        return isset($_SESSION['user']);
    }

    public static function isAdmin(): bool {
        return self::check() && $_SESSION['user']['role'] === 'admin';
    }

    public static function logout() {
        session_destroy();
    }
}
