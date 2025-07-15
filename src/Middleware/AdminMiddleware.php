<?php

namespace App\Middleware;

use App\Core\Auth;

class AdminMiddleware
{
    public function handle(): void
    {
        if (!Auth::check() || !Auth::isAdmin()) {
            http_response_code(403);
            header("Location: /login");
            exit;
        }
    }
}
