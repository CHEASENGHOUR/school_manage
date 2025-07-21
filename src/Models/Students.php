<?php

namespace App\Models;

use App\Core\Database;

class Students{
    public static function getAll(): array
    {
        $conn = Database::connect();
        $result = $conn->query("SELECT * FROM students");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public static function create(string $name, string $email, int $class_id):bool{
        $conn = Database::connect();
        $stmt = $conn->prepare("INSERT INTO students (name, email, class_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $email, $class_id);
        return $stmt->execute();
    }
}

?>