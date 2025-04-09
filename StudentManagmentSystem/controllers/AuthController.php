<?php
require_once __DIR__ . '/../models/UserRepository.php';

class AuthController {
    private $userRepo;

    public function __construct() {
        $this->userRepo = new UserRepository();
    }

    public function login($username, $password) {
        $user = $this->userRepo->getUserByUsername($username);
        
        if ($user && password_verify($password, $user['password_hash'])) {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];
            return true;
        }
        return false;
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
        header('Location: /views/auth/login.php');
        exit();
    }
}