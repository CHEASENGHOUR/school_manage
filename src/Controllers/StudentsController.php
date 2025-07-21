<?php

namespace App\Controllers;

class StudentsController
{
    public function index(): void
    {
        require_once __DIR__ . '/../Views/student.php';
    }
}