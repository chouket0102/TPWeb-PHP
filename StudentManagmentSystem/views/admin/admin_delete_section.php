<?php


require_once '../../isAuthentificated.php';
requireAdmin();

require_once '../../controllers/AdminController.php';


$adminController = new AdminController();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $adminController->deleteSection($id);
} else {
    
    $_SESSION['error'] = "Invalid deletion request";
    header('Location: admin_sections.php');
    exit();
}
?>