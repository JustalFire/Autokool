<?php
class Course {

    public static function getFeaturedCourses() {
        $lang = Lang::current();
        $query = "SELECT c.id, c.price, c.picture, c.category_id, c.user_id, c.created_at,
                  (CASE WHEN '$lang' = 'ru' THEN c.title_ru ELSE c.title_et END) AS title,
                  (CASE WHEN '$lang' = 'ru' THEN c.description_ru ELSE c.description_et END) AS description,
                  (CASE WHEN '$lang' = 'ru' THEN c.duration_ru ELSE c.duration_et END) AS duration,
                  (CASE WHEN '$lang' = 'ru' THEN c.transmission_ru ELSE c.transmission_et END) AS transmission,
                  (CASE WHEN '$lang' = 'ru' THEN cat.name_ru ELSE cat.name_et END) AS category_name
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  ORDER BY c.id ASC LIMIT 3";
        $db = new Database();
        return $db->getAll($query);
    }

    public static function getAllCourses() {
        $lang = Lang::current();
        $query = "SELECT c.id, c.price, c.picture, c.category_id, c.user_id, c.created_at,
                  (CASE WHEN '$lang' = 'ru' THEN c.title_ru ELSE c.title_et END) AS title,
                  (CASE WHEN '$lang' = 'ru' THEN c.description_ru ELSE c.description_et END) AS description,
                  (CASE WHEN '$lang' = 'ru' THEN c.duration_ru ELSE c.duration_et END) AS duration,
                  (CASE WHEN '$lang' = 'ru' THEN c.transmission_ru ELSE c.transmission_et END) AS transmission,
                  (CASE WHEN '$lang' = 'ru' THEN cat.name_ru ELSE cat.name_et END) AS category_name
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  ORDER BY c.id ASC";
        $db = new Database();
        return $db->getAll($query);
    }

    public static function getCoursesByCategoryID($id) {
        $id = intval($id);
        $lang = Lang::current();
        $query = "SELECT c.id, c.price, c.picture, c.category_id, c.user_id, c.created_at,
                  (CASE WHEN '$lang' = 'ru' THEN c.title_ru ELSE c.title_et END) AS title,
                  (CASE WHEN '$lang' = 'ru' THEN c.description_ru ELSE c.description_et END) AS description,
                  (CASE WHEN '$lang' = 'ru' THEN c.duration_ru ELSE c.duration_et END) AS duration,
                  (CASE WHEN '$lang' = 'ru' THEN c.transmission_ru ELSE c.transmission_et END) AS transmission,
                  (CASE WHEN '$lang' = 'ru' THEN cat.name_ru ELSE cat.name_et END) AS category_name
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  WHERE c.category_id = ? 
                  ORDER BY c.id ASC";
        $db = new Database();
        return $db->getAll($query, [$id]);
    }

    public static function getCourseByID($id) {
        $id = intval($id);
        $lang = Lang::current();
        $query = "SELECT c.id, c.price, c.picture, c.category_id, c.user_id, c.created_at,
                  (CASE WHEN '$lang' = 'ru' THEN c.title_ru ELSE c.title_et END) AS title,
                  (CASE WHEN '$lang' = 'ru' THEN c.description_ru ELSE c.description_et END) AS description,
                  (CASE WHEN '$lang' = 'ru' THEN c.duration_ru ELSE c.duration_et END) AS duration,
                  (CASE WHEN '$lang' = 'ru' THEN c.transmission_ru ELSE c.transmission_et END) AS transmission,
                  (CASE WHEN '$lang' = 'ru' THEN cat.name_ru ELSE cat.name_et END) AS category_name,
                  u.username 
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  LEFT JOIN `users` u ON c.user_id = u.id 
                  WHERE c.id = ?";
        $db = new Database();
        return $db->getOne($query, [$id]);
    }

    public static function searchCourses($keyword) {
        $lang = Lang::current();
        $like = '%' . trim($keyword) . '%';
        $query = "SELECT c.id, c.price, c.picture, c.category_id, c.user_id, c.created_at,
                  (CASE WHEN '$lang' = 'ru' THEN c.title_ru ELSE c.title_et END) AS title,
                  (CASE WHEN '$lang' = 'ru' THEN c.description_ru ELSE c.description_et END) AS description,
                  (CASE WHEN '$lang' = 'ru' THEN c.duration_ru ELSE c.duration_et END) AS duration,
                  (CASE WHEN '$lang' = 'ru' THEN c.transmission_ru ELSE c.transmission_et END) AS transmission,
                  (CASE WHEN '$lang' = 'ru' THEN cat.name_ru ELSE cat.name_et END) AS category_name
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  WHERE c.title_et LIKE ? 
                     OR c.title_ru LIKE ? 
                     OR c.description_et LIKE ? 
                     OR c.description_ru LIKE ? 
                  ORDER BY c.id ASC";
        $db = new Database();
        return $db->getAll($query, [$like, $like, $like, $like]);
    }
}
?>
