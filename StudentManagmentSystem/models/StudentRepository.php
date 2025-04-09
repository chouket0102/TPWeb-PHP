<?php

require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/../config/database.php';

class StudentRepository {

    public static function getAllStudents() {
        $pdo = getDBConnection();
        $stmt = $pdo->query('SELECT * FROM students');
        $students = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $students[] = new Student($row['id'], $row['name'], $row['birthday'], $row['image'], $row['section_id']);
        }
        return $students;
    }

    public static function createStudent($name, $birthday, $image, $section_id) {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('INSERT INTO students (name, birthday, image, section_id) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$name, $birthday, $image, $section_id]);
    }

    public static function getStudentById($id) {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('SELECT * FROM students WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Student($row['id'], $row['name'], $row['birthday'], $row['image'], $row['section_id']);
        }
        return null;
    }

    public static function updateStudent($id, $name, $birthday, $image, $section_id) {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('UPDATE students SET name = ?, birthday = ?, image = ?, section_id = ? WHERE id = ?');
        return $stmt->execute([$name, $birthday, $image, $section_id, $id]);
    }

    public static function deleteStudent($id) {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('DELETE FROM students WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>