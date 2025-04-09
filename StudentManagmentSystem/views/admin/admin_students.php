<?php

require_once '../../isAuthentificated.php';
//requireAdmin();

require_once '../../controllers/AdminController.php';


$adminController = new AdminController();
$students = $adminController->getStudents();


function formatDate($dateString) {
    if (empty($dateString)) {
        return '—';
    }
    try {
        $date = new DateTime($dateString);
        return $date->format('M d, Y');
    } catch (Exception $e) {
        return '—';
    }
}

require_once '../../includes/header.php';

echo '<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">';
?>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5 fw-bold text-primary">
            <i class="bi bi-people-fill me-2"></i>Manage Students
        </h1>
        <?php if ($_SESSION['user']['role'] == 'admin'): ?>
        <a href="admin_create_student.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Add New Student
        </a>
        <?php endif; ?>
        <div class="btn-group" role="group" aria-label="Export buttons">
            <a href="export_student_excel.php?type=students" class="btn btn-success me-2">
                <i class="bi bi-file-earmark-excel me-2"></i>Excel
            </a>
            <a href="export_student_csv.php?type=students" class="btn btn-info me-2">
                <i class="bi bi-filetype-csv me-2"></i>CSV
            </a>
            <a href="export_student_pdf.php?type=students" class="btn btn-danger">
                <i class="bi bi-file-earmark-pdf me-2"></i>PDF
            </a>
        </div>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <table id="studentsTable" class="table table-striped table-hover" style="width:100%">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Birthday</th>
                        <th>Section</th>
                        <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                        <th class="text-center" style="width: 180px;">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                    <tr>
                        <td class="align-middle"><?= $student->getId(); ?></td>

                        <td class="align-middle">
                            <?php if (!empty($student->getImage())): ?>
                                <img src="../../public/uploads/<?= htmlspecialchars($student->getImage()); ?>" 
                                     alt="<?= htmlspecialchars($student->getName()); ?>" 
                                     class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                            <?php else: ?>
                                <div class="text-center bg-light rounded-circle" 
                                     style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-person-fill text-secondary" style="font-size: 1.5rem;"></i>
                                </div>
                            <?php endif; ?>
                        </td>


                        <td class="align-middle fw-semibold"><?= htmlspecialchars($student->getName()); ?></td>


                        <td class="align-middle">
                            <?= formatDate($student->getBirthday()); ?>
                        </td>


                        <td class="align-middle">
                            
                            <?php $sectionid = $student->getSectionId(); 
                            $section = $adminController->getSectionById($sectionid); ?>

                            
                            <span class="badge bg-info text-dark"><?= htmlspecialchars($section->getDesignation()); ?></span>
                        </td>
                        <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                        <td class="text-center">
                            <div class="btn-group" role="group" aria-label="Student actions">
                                <a href="admin_update_student.php?id=<?= $student->getId(); ?>" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDelete(<?= $student->getId(); ?>, '<?= htmlspecialchars($student->getName()); ?>')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Delete confirmation modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete the student <span id="studentName" class="fw-bold"></span>?
        <p class="text-danger mt-2 mb-0"><small>This action cannot be undone.</small></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST" action="admin_delete_student.php">
            <input type="hidden" id="deleteId" name="id" value="">
            <button type="submit" class="btn btn-danger">Delete Student</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<!-- DataTables and Bootstrap 5 JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Initialize DataTable
    $(document).ready(function() {
        $('#studentsTable').DataTable({
            "responsive": true,
            "language": {
                "search": "Filter records:",
                "zeroRecords": "No matching students found",
                "info": "Showing _START_ to _END_ of _TOTAL_ students",
                "infoEmpty": "No students available",
                "infoFiltered": "(filtered from _MAX_ total students)"
            },
            "pagingType": "full_numbers",
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
        });
    });
    
    // Handle delete confirmation
    function confirmDelete(id, name) {
        document.getElementById('studentName').textContent = name;
        document.getElementById('deleteId').value = id;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>

<style>
/* Additional custom styles */
.table {
    vertical-align: middle;
}
.table thead th {
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.875rem;
}
.btn-group .btn {
    border-radius: 4px;
    margin: 0 2px;
}
.dataTables_wrapper .dataTables_length, 
.dataTables_wrapper .dataTables_filter {
    margin-bottom: 1rem;
}
.dataTables_info, .dataTables_paginate {
    margin-top: 1rem;
}
.page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
}
</style>

<?php
// Include footer
require_once '../../includes/footer.php';
?>