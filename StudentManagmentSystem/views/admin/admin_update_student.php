<?php

require_once '../../isAuthentificated.php';
requireAdmin();

require_once '../../controllers/AdminController.php';

$adminController = new AdminController();

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $adminController->updateStudent($id);
} else {
    
    $student = StudentRepository::getStudentById($id);
    
    if (!$student) {
        
        $_SESSION['error'] = "Student not found";
        header('Location: admin_students.php');
        exit();
    }
    
    $sections = SectionRepository::getAllSections();
}


require_once '../../includes/header.php';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary">
            <i class="bi bi-pencil-square me-2"></i>Edit Student
        </h1>
        <a href="admin_students.php" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i>Back to Students
        </a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <?php if (isset($error)): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i><?= $error ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text" class="form-control" id="name" name="name" required
                           value="<?= htmlspecialchars($student->getName()) ?>">
                </div>
                
                <div class="mb-3">
                    <label for="birthday" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="birthday" name="birthday"
                           value="<?= htmlspecialchars($student->getBirthday()) ?>">
                </div>
                
                <div class="mb-3">
                    <label for="image" class="form-label">Student Photo</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    <div class="form-text">Allowed formats: JPG, JPEG, PNG, GIF</div>
                    
                    <div class="mt-3">
                        <div class="image-preview" id="imagePreview">
                            <?php if (!empty($student->getImage())): ?>
                                <div class="current-image mb-2">
                                    <p class="form-text">Current photo:</p>
                                    <img src="../../public/uploads/<?= htmlspecialchars($student->getImage()) ?>" 
                                         alt="Current photo" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            <?php else: ?>
                                <div class="text-center bg-light rounded p-3" id="defaultPreview">
                                    <i class="bi bi-person-badge text-secondary" style="font-size: 3rem;"></i>
                                    <p class="mt-2 mb-0">No image currently set</p>
                                </div>
                            <?php endif; ?>
                            <img src="" alt="New Image Preview" class="img-thumbnail d-none mt-3" id="imgPreview" style="max-height: 200px;">
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="section_id" class="form-label">Section *</label>
                    <select class="form-select" id="section_id" name="section_id" required>
                        <option value="">Select Section</option>
                        <?php foreach ($sections as $section): ?>
                            <option value="<?= $section->getId() ?>" 
                                <?= ($student->getSectionId() == $section->getId()) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($section->getDesignation()) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="admin_students.php" class="btn btn-outline-secondary me-md-2">
                        <i class="bi bi-x-circle me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>Update Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    
    document.getElementById('image').addEventListener('change', function(e) {
        const imgPreview = document.getElementById('imgPreview');
        
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const fileReader = new FileReader();
            
            fileReader.onload = function(e) {
                imgPreview.src = e.target.result;
                imgPreview.classList.remove('d-none');
            };
            
            fileReader.readAsDataURL(file);
        } else {
            imgPreview.classList.add('d-none');
        }
    });
</script>

<?php

require_once '../../includes/footer.php';
?>