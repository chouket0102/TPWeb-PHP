<?php
require_once '../../isAuthentificated.php';
requireAdmin();

require_once '../../controllers/AdminController.php';
require_once '../../models/SectionRepository.php';

$adminController = new AdminController();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminController->updateSection($id);
} else {
    // Fetch existing section data
    $section = SectionRepository::getSectionById($id);
    
    if (!$section) {
        $_SESSION['error'] = "Section not found";
        header('Location: admin_sections.php');
        exit();
    }
}

require_once '../../includes/header.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary">
            <i class="bi bi-pencil-square me-2"></i>Edit Section
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
                           value="<?= htmlspecialchars($section->getDesignation()) ?>">
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" 
                              rows="3"><?= htmlspecialchars($section->getDescription()) ?></textarea>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="admin_sections.php" class="btn btn-outline-secondary me-md-2">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Update Section
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once '../../includes/footer.php';
?>