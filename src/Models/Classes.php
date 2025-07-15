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
}