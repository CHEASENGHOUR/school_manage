<?php

namespace App\Controllers;

class DashboardController
{
    public function index(): void
    {
        require_once __DIR__ . '/../Views/dashboard.php';
    }
}
