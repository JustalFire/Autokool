<?php
class modelAdminCategory {

    public static function getCategoryList() {
        $sql = "SELECT * FROM `categories` ORDER BY `name` ASC";
        $db = new Database();
        return $db->getAll($sql);
    }
}
?>
