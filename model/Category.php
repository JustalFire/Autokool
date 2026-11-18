<?php
class Category {

    public static function getAllCategory() {
        $lang = Lang::current();
        $query = "SELECT id, 
                  (CASE WHEN '$lang' = 'ru' THEN name_ru ELSE name_et END) AS name,
                  (CASE WHEN '$lang' = 'ru' THEN description_ru ELSE description_et END) AS description
                  FROM `categories` ORDER BY `id` ASC";
        $db = new Database();
        return $db->getAll($query);
    }

    public static function getCategoryByID($id) {
        $id = intval($id);
        $lang = Lang::current();
        $query = "SELECT id, 
                  (CASE WHEN '$lang' = 'ru' THEN name_ru ELSE name_et END) AS name,
                  (CASE WHEN '$lang' = 'ru' THEN description_ru ELSE description_et END) AS description
                  FROM `categories` WHERE `id` = ?";
        $db = new Database();
        return $db->getOne($query, [$id]);
    }
}
?>
