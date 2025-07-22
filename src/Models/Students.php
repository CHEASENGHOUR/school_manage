<?php

namespace App\Models;

use App\Core\Database;

class Students{
    public static function getAll(int $class_id): array
    {
        $conn = Database::connect();
        $result = $conn->prepare("SELECT * FROM students WHERE class_id = ? ");
        $result->bind_param("i", $class_id);
        $result->execute();
        return $result->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    public static function create(string $name, string $email, string $gender, int $class_id):bool{
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO students (name, email, gender, class_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $name, $email, $gender, $class_id);
        return $stmt->execute();
    }
}

?>