<?php

namespace App\Controllers;

class AdminController
{
    public function index(): void
    {
        require_once __DIR__ . '/../Views/admin.php';
    }
}
