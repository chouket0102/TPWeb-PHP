<?php

class SessionManager {
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function get($key) {
        if (!isset($_SESSION[$key])) {
            return null;
        }
        return $_SESSION[$key];
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function destroy() {
        session_unset();
        session_destroy();
    }

    public function incrementVisitCount() {
        $visits = $this->get('visits') ?? 0;
        $visits++;
        $this->set('visits', $visits);
        return $visits;
    }
    public function resetCount(){
        $this->destroy();
        header("Location: index.php");
        exit;
    }
}
?>
