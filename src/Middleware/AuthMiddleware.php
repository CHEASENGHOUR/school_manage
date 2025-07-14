<?php

namespace App\Middleware;

use App\Core\Auth;

class AuthMiddleware
{
    public function handle(): void
    {
        if (!Auth::check()) {
            // If user is not logged in, redirect to login
            header("Location: /login");
            exit;
        }
    }
}
