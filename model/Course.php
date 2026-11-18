<?php
class Course {

    public static function getFeaturedCourses() {
        $query = "SELECT c.*, cat.name AS category_name 
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  ORDER BY c.id ASC LIMIT 3";
        $db = new Database();
        return $db->getAll($query);
    }

    public static function getAllCourses() {
        $query = "SELECT c.*, cat.name AS category_name 
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  ORDER BY c.id ASC";
        $db = new Database();
        return $db->getAll($query);
    }

    public static function getCoursesByCategoryID($id) {
        $id = intval($id);
        $query = "SELECT c.*, cat.name AS category_name 
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  WHERE c.category_id = " . $id . " 
                  ORDER BY c.id ASC";
        $db = new Database();
        return $db->getAll($query);
    }

    public static function getCourseByID($id) {
        $id = intval($id);
        $query = "SELECT c.*, cat.name AS category_name, u.username 
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  LEFT JOIN `users` u ON c.user_id = u.id 
                  WHERE c.id = " . $id;
        $db = new Database();
        return $db->getOne($query);
    }

    public static function searchCourses($keyword) {
        $clean = addslashes($keyword);
        $query = "SELECT c.*, cat.name AS category_name 
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  WHERE c.title LIKE '%$clean%' 
                     OR c.description LIKE '%$clean%' 
                  ORDER BY c.id ASC";
        $db = new Database();
        return $db->getAll($query);
    }
}
?>
