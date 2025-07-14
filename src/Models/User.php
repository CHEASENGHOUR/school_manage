<?php

namespace App\Models;

use App\Core\Database;
// use mysqli;

class User
{
    // 🔍 Find user by email
    public static function findByEmail(string $email): ?array
    {
        $conn = Database::connect();

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        return $user ?: null;
    }

    // ➕ Create a new user
    public static function create(string $email, string $password, string $role = 'user'): bool
    {
        $conn = Database::connect();

        $stmt = $conn->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $email, $password, $role);

        return $stmt->execute();
    }

    // 📋 Optional: Get user by ID
    public static function findById(int $id): ?array
    {
        $conn = Database::connect();

        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        return $user ?: null;
    }
}
