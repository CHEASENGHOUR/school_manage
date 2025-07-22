<?php

namespace App\Controllers;

use App\Models\Students;
use App\Core\Auth;
use App\Models\Classes;

class StudentsController
{
    public function index(): void
    {
        $user = Auth::user();
        $teacher_id = $user['id'] ?? null;
        $classes = new Classes();
        $class_id = $classes->findById($teacher_id);
        $id = $class_id['class_id'];
        if($id){
            $students = Students::getAll($id);
        }
        $data = [
            'students' => $students,
            'error' => $_SESSION['error'] ?? null,
            'success' => $_SESSION['success'] ?? null
        ];
        // Clear session messages to prevent repeated display
        unset($_SESSION['error'], $_SESSION['success']);
        require_once __DIR__ . '/../Views/student.php';
    }
    public function create(): void
    {
        $user = Auth::user();
        $teacher_id = $user['id'] ?? null;
        $classes = new Classes();
        $class_id = $classes->findById($teacher_id);
        $id = $class_id['class_id'];
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;
        $gender = $_POST['gender'] ?? null;
        if (empty($name) && empty($email) && empty($gender)) {
            session_start();
            $_SESSION['error'] = 'Error Students Form!!!';
            header("Location: /students");
            exit;
        }
        try {
            $success = Students::create($name, $email, $gender, $id);
            if ($success) {
                session_start();
                $_SESSION['success'] = 'Class created successfully.';
                header("Location: /students");
            } else {
                session_start();
                $_SESSION['error'] = 'Failed to create class.';
                header("Location: /students");
            }
        } catch (\Exception $e) {
            session_start();
            $_SESSION['error'] = 'An error occurred: ' . $e->getMessage();
            header("Location: /students");
        }
        exit;
    }
}