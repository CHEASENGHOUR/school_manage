<?php

namespace App\Models;

use App\Core\Database;

class Classes {
    public static function create(string $courses, int $teacher_id): bool
    {
        $conn = Database::connect();

        $stmt = $conn->prepare("INSERT INTO classes (courses, teacher_id) VALUES (?, ?)");
        $stmt->bind_param("si", $courses, $teacher_id);

        return $stmt->execute();
    }

    public function getTeacherClasses(int $teacher_id) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT * FROM classes WHERE teacher_id = ? ORDER BY courses");
        $stmt->bind_param("i", $teacher_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public static function update(int $class_id, string $courses): bool
    {
        $conn = Database::connect();

        $stmt = $conn->prepare("UPDATE classes SET courses = ? WHERE class_id = ?");
        $stmt->bind_param("si", $courses, $class_id);

        return $stmt->execute();
    }

    public static function delete(int $class_id): bool
    {
        $conn = Database::connect();

        $stmt = $conn->prepare("DELETE FROM classes WHERE class_id = ?");
        $stmt->bind_param("i", $class_id);

        return $stmt->execute();
    }
    public static function findById(int $teacher_id){
        $conn = Database::connect();

        $stmt = $conn->prepare("SELECT * FROM classes WHERE teacher_id = ? LIMIT 1");
        $stmt->bind_param("i", $teacher_id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result ?: null;
    }
}