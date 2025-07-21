<?php

namespace App\Controllers;

use App\Core\Auth;
use App\Models\Classes;

class ClassController{
    public function index(): void

    {
        // var_dump($_SESSION); // Check 'user'
        // var_dump(Auth::user());
        // Get the authenticated teacher's ID (assuming Auth provides this)
        $user = Auth::user();
        $teacher_id = $user['id'] ?? null;
    
        if ($teacher_id) {
            // Fetch classes for the teacher
            $classesModel = new Classes();
            $classes = $classesModel->getTeacherClasses($teacher_id);
        } else {
            // Handle case where teacher is not authenticated
            $classes = [];
            $_SESSION['error'] = 'Please log in to view your classes.';
        }

        // Pass data to the view
        $data = [
            'classes' => $classes,
            'error' => $_SESSION['error'] ?? null,
            'success' => $_SESSION['success'] ?? null
        ];
        
        // Clear session messages to prevent repeated display
        unset($_SESSION['error'], $_SESSION['success']);
        
        require_once __DIR__ . '/../Views/class.php';
    }
    public function create(): void
    {
        $user = Auth::user();
        $teacher_id = $user['id'] ?? null;
        $course = $_POST['courses'] ?? null;
        if (empty($course)) {
            session_start();
            $_SESSION['error'] = 'Course name is required.';
            header("Location: /class");
            exit;
        }

        // Attempt to create the class
        try {
            $success = Classes::create($course, $teacher_id);
            if ($success) {
                session_start();
                $_SESSION['success'] = 'Class created successfully.';
                header("Location: /class");
            } else {
                session_start();
                $_SESSION['error'] = 'Failed to create class.';
                header("Location: /class");
            }
        } catch (\Exception $e) {
            session_start();
            $_SESSION['error'] = 'An error occurred: ' . $e->getMessage();
            header("Location: /class");
        }
        exit;
    }
    public function update(): void
    {
        $user = Auth::user();
        // $teacher_id = $user['id'] ?? null;
        $class_id = $_POST['class_id'] ?? null;
        $course = $_POST['courses'] ?? null;

        if (empty($class_id) || empty($course)) {
            session_start();
            $_SESSION['error'] = 'Class ID and name are required.';
            header("Location: /class");
            exit;
        }

        try {
            $success = Classes::update($class_id, $course);
            session_start();
            if ($success) {
                $_SESSION['success'] = 'Class updated successfully.';
            } else {
                $_SESSION['error'] = 'Failed to update class.';
            }
        } catch (\Exception $e) {
            session_start();
            $_SESSION['error'] = 'An error occurred: ' . $e->getMessage();
        }

        header("Location: /class");
        exit;
    }

    public function delete(): void
    {
        $class_id = $_POST['class_id'] ?? null;

        if (empty($class_id)) {
            session_start();
            $_SESSION['error'] = 'Class ID is required.';
            header("Location: /class");
            exit;
        }

        try {
            $success = Classes::delete($class_id);
            session_start();
            if ($success) {
                $_SESSION['success'] = 'Class deleted successfully.';
            } else {
                $_SESSION['error'] = 'Failed to delete class.';
            }
        } catch (\Exception $e) {
            session_start();
            $_SESSION['error'] = 'An error occurred: ' . $e->getMessage();
        }

        header("Location: /class");
        exit;
    }
}