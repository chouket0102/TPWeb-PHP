<?php

require_once __DIR__ . '/../models/StudentRepository.php';
require_once __DIR__ . '/../models/SectionRepository.php';

class AdminController {
    
    public function getStudents() {
        return StudentRepository::getAllStudents();
    }
    
    

    public function createStudent() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $birthday = $_POST['birthday'];
            
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . '/../public/uploads/';
                $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
                $targetFilePath = $targetDir . $fileName;
                
                
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                
                
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                $fileType = $_FILES['image']['type'];
                
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                        $image = $fileName;
                    } else {
                        $error = "Error uploading file.";
                    }
                } else {
                    $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
                }
            }
            
            $section_id = $_POST['section_id'];
            
            if (!isset($error) && StudentRepository::createStudent($name, $birthday, $image, $section_id)) {
                header('Location: /admin/students');
                exit();
            } else {
                
                $error = isset($error) ? $error : "Failed to create student";
                $sections = SectionRepository::getAllSections();
                include __DIR__ . '/../views/admin/admin_create_student.php';
            }
        } else {
            $sections = SectionRepository::getAllSections();
            include __DIR__ . '/../views/admin/admin_create_student.php';
        }
    }

   

    public function updateStudent($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $birthday = $_POST['birthday'];
            
            
            $currentStudent = StudentRepository::getStudentById($id);
            $image = $currentStudent->getImage();
            
            
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . '/../public/uploads/';
                $fileName = uniqid() . '_' . basename($_FILES['image']['name']);// nom unique pour éviter les conflits
                $targetFilePath = $targetDir . $fileName;
                
                
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                
                
                $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
                $fileType = $_FILES['image']['type'];
                
                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                       //supprimer l'ancienne image si elle existe
                        if (!empty($image) && file_exists($targetDir . $image)) {
                            unlink($targetDir . $image);
                        }
                        $image = $fileName;
                    } else {
                        $error = "Error uploading file.";
                    }
                } else {
                    $error = "Only JPG, JPEG, PNG & GIF files are allowed.";
                }
            }
            
            $section_id = $_POST['section_id'];
            
            if (!isset($error) && StudentRepository::updateStudent($id, $name, $birthday, $image, $section_id)) {
                header('Location: /admin/students');
                exit();
            } else {
                
                $error = isset($error) ? $error : "Failed to update student";
                $student = $currentStudent;
                $sections = SectionRepository::getAllSections();
                include __DIR__ . '/../views/admin/admin_update_student.php';
            }
        }
    }

    public function deleteStudent($id) {
        
        $student = StudentRepository::getStudentById($id);
        
        if ($student && StudentRepository::deleteStudent($id)) {
            
            if (!empty($student->getImage())) {
                $imagePath = __DIR__ . '/../public/uploads/' . $student->getImage();
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
            
            header('Location: /admin/students');
            exit();
        } else {
            
            $error = "Failed to delete student";
            $this->showStudents();
        }
    }

    
    public function getSections() {
        return SectionRepository::getAllSections(); 
    }

    public function createSection() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $designation = $_POST['designation'];
            $description = $_POST['description'];
            
            if (SectionRepository::createSection($designation, $description)) {
                header('Location: /admin/sections');
                exit();
            } else {
            
                $error = "Failed to create section";
                include __DIR__ . '/../views/admin/admin_create_section.php';
            }
        } else {
            include __DIR__ . '/../views/admin/admin_create_section.php';
        }
    }

   
    public function updateSection($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $designation = $_POST['designation'];
            $description = $_POST['description'];
            
            if (SectionRepository::updateSection($id, $designation, $description)) {
                header('Location: /admin/sections');
                exit();
            } else {
                
                $error = "Failed to update section";
                $section = SectionRepository::getSectionById($id);
                include __DIR__ . '/../views/admin/admin_update_section.php';
            }
        }
    }

    public function deleteSection($id) {
        if (SectionRepository::deleteSection($id)) {
            header('Location: /admin/sections');
            exit();
        } else {
            
            $error = "Failed to delete section";
            $this->showSections();
        }
    }
    public function getSectionById($id) {
        return SectionRepository::getSectionById($id);
    }
}
?>