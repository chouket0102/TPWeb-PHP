<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
<!-- Navbar -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">Student Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
                    
                    <?php if (isset($_SESSION['user'])): ?>
                        <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link" href="/views/admin/admin_students.php">Students</a></li>
                            <li class="nav-item"><a class="nav-link" href="/views/admin/admin_sections.php">Sections</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="/views/admin/admin_students.php">Students</a></li>
                            <li class="nav-item"><a class="nav-link" href="/views/admin/admin_sections.php">Sections</a></li>

                        <?php endif; ?>
                        <li class="nav-item"><a class="nav-link" href="/views/auth/logout.php">Logout</a></li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/views/auth/login.php">Login</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>


<main class="container mt-4">
