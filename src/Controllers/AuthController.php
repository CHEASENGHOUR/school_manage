<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\User;

class AuthController
{
    public function loginView(): void
    {

        unset($_SESSION['login_error']);
        require_once __DIR__ . '/../Views/auth/login.php';
    }

    public function registerView(): void
    {
        unset($_SESSION['register_errors'], $_SESSION['old_register_data']);
        require_once __DIR__ . '/../Views/auth/register.php';
    }

    public function login(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        // Basic validation
        if (empty($email) || empty($password)) {
            $_SESSION['login_error'] = 'Email and password are required';
            header("Location: /login");
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['login_error'] = 'Invalid email format';
            header("Location: /login");
            exit;
        }

        if (Auth::attempt($email, $password)) {
            if ($_SESSION['user']['role'] === 'admin') {
                header("Location: /admin");
            } else {
                header("Location: /");
            }
            exit;
        }

        // echo "Invalid email or password.";
        $_SESSION['login_error'] = 'Invalid email or password';
        header("Location: /login");
        exit;
    }

    public function register(): void
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $role = $_POST['role'] ?? 'user';

        if (empty($email)) {
            $errors['email'] = 'Email is required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        } else {
            // Only check database if email is valid format
            try {
                if (User::findByEmail($email)) {
                    $errors['email'] = 'Email already registered';
                }
            } catch (\Exception $e) {
                // Log database error but don't show to user
                error_log('Database error: ' . $e->getMessage());
                $errors['email'] = 'Registration temporarily unavailable';
            }
        }

        // Password validation
        if (empty($password)) {
            $errors['password'] = 'Password is required';
        } elseif (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (!empty($errors)) {
            $_SESSION['register_errors'] = $errors;
            $_SESSION['old_register_data'] = [
                'email' => $email,
                'role' => $role
            ];
            header("Location: /register");
            exit;
        }
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        User::create($email, $hashed, $role);

        // echo "Registered successfully. <a href='/login'>Login now</a>";
        header("Location: /login");
        exit;
    }

    public function logout(): void
    {
        Auth::logout();
        header("Location: /login");
        exit;
    }
}
