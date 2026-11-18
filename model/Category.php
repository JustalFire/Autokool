<?php
class Category {

    public static function getAllCategory() {
        $query = "SELECT * FROM `categories` ORDER BY `id` ASC";
        $db = new Database();
        return $db->getAll($query);
    }

    public static function getCategoryByID($id) {
        $id = intval($id);
        $query = "SELECT * FROM `categories` WHERE `id` = " . $id;
        $db = new Database();
        return $db->getOne($query);
    }
}
?>
