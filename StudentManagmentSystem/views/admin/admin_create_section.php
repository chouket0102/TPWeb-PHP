<?php
require_once '../../isAuthentificated.php';
requireAdmin();

require_once '../../controllers/AdminController.php';

$adminController = new AdminController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminController->createSection();
} else {
  
    $designation = '';
    $description = '';
}


require_once '../../includes/header.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary">
            <i class="bi bi-folder-plus me-2"></i>Add New Section
        </h1>
        <a href="admin_sections.php" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Sections
        </a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $error ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="designation" class="form-label">Designation *</label>
                    <input type="text" class="form-control" id="designation" name="designation" required
                           value="<?= isset($_POST['designation']) ? htmlspecialchars($_POST['designation']) : '' ?>">
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="3"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="reset" class="btn btn-outline-secondary me-md-2">
                        <i class="bi bi-x-circle me-2"></i>Clear Form
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Save Section
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

require_once '../../includes/footer.php';
?>