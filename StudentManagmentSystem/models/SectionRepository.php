<?php


require_once __DIR__ . '/Section.php';
require_once __DIR__ . '/../config/database.php';

class SectionRepository {

    public static function getAllSections() {
        $pdo = getDBConnection();
        $stmt = $pdo->query('SELECT * FROM sections');
        $sections = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $sections[] = new Section($row['id'], $row['designation'], $row['description']);
        }
        return $sections;
    }

    public static function createSection($designation, $description) {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('INSERT INTO sections (designation, description) VALUES (?, ?)');
        return $stmt->execute([$designation, $description]);
    }

    public static function getSectionById($id) {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('SELECT * FROM sections WHERE id = ?');
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Section($row['id'], $row['designation'], $row['description']);
        }
        return null;
    }

    public static function updateSection($id, $designation, $description) {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('UPDATE sections SET designation = ?, description = ? WHERE id = ?');
        return $stmt->execute([$designation, $description, $id]);
    }

    public static function deleteSection($id) {
        $pdo = getDBConnection();
        $stmt = $pdo->prepare('DELETE FROM sections WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>
