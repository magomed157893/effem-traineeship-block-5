<?php

namespace App;

class UserRepository
{
    private \PDO $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->conn->query('SELECT id, name, email FROM users');
        $users = [];

        while ($row = $stmt->fetch()) {
            $users[] = new User($row['id'], $row['name'], $row['email']);
        }

        return $users;
    }
}
