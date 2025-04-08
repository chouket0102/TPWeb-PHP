<?php
require_once __DIR__ . '/User.php';
require_once __DIR__ . '/../config/database.php';

class UserRepository {
    private $pdo;

    public function __construct() {
        $this->pdo = getDBConnection();
    }

    public function getUserByUsername($username) {
        $stmt = $this->pdo->prepare("
            SELECT id, username, password_hash, role 
            FROM users 
            WHERE username = ?
        ");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT * FROM users");
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User(
                $row['id'],
                $row['username'],
                $row['email'],
                $row['role']
            );
        }
        return $users;
    }
}