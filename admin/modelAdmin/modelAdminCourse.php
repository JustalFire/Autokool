<?php
class modelAdminCourse {

    public static function getCourseList() {
        $query = "SELECT c.*, cat.name AS category_name, u.username 
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  LEFT JOIN `users` u ON c.user_id = u.id 
                  ORDER BY c.id DESC";
        $db = new Database();
        return $db->getAll($query);
    }

    public static function getCourseAdd() {
        $test = false;
        if (isset($_POST['save'])) {
            if (!empty($_POST['title']) && !empty($_POST['description']) && isset($_POST['idCategory'])) {
                $title = addslashes($_POST['title']);
                $desc = addslashes($_POST['description']);
                $price = floatval($_POST['price'] ?? 0);
                $duration = addslashes($_POST['duration'] ?? '6 nädalat');
                $transmission = addslashes($_POST['transmission'] ?? 'Manuaal');
                $idCategory = intval($_POST['idCategory']);
                $userId = intval($_SESSION['userId'] ?? 1);

                $image = "";
                if (isset($_FILES['picture']) && !empty($_FILES['picture']['tmp_name'])) {
                    $image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
                }

                $sql = "INSERT INTO `courses` 
                        (`id`, `title`, `description`, `price`, `duration`, `transmission`, `picture`, `category_id`, `user_id`) 
                        VALUES (NULL, '$title', '$desc', '$price', '$duration', '$transmission', '$image', '$idCategory', '$userId')";
                $db = new Database();
                $item = $db->executeRun($sql);
                if ($item) {
                    $test = true;
                }
            }
        }
        return $test;
    }

    public static function getCourseDetail($id) {
        $id = intval($id);
        $query = "SELECT c.*, cat.name AS category_name, u.username 
                  FROM `courses` c 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  LEFT JOIN `users` u ON c.user_id = u.id 
                  WHERE c.id = " . $id;
        $db = new Database();
        return $db->getOne($query);
    }

    public static function getCourseEdit($id) {
        $id = intval($id);
        $test = false;
        if (isset($_POST['save'])) {
            if (!empty($_POST['title']) && !empty($_POST['description']) && isset($_POST['idCategory'])) {
                $title = addslashes($_POST['title']);
                $desc = addslashes($_POST['description']);
                $price = floatval($_POST['price'] ?? 0);
                $duration = addslashes($_POST['duration'] ?? '6 nädalat');
                $transmission = addslashes($_POST['transmission'] ?? 'Manuaal');
                $idCategory = intval($_POST['idCategory']);

                $image = "";
                if (isset($_FILES['picture']) && !empty($_FILES['picture']['tmp_name'])) {
                    $image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
                }

                if ($image === "") {
                    $sql = "UPDATE `courses` SET 
                            `title` = '$title', 
                            `description` = '$desc', 
                            `price` = '$price', 
                            `duration` = '$duration', 
                            `transmission` = '$transmission', 
                            `category_id` = '$idCategory' 
                            WHERE `id` = " . $id;
                } else {
                    $sql = "UPDATE `courses` SET 
                            `title` = '$title', 
                            `description` = '$desc', 
                            `price` = '$price', 
                            `duration` = '$duration', 
                            `transmission` = '$transmission', 
                            `picture` = '$image', 
                            `category_id` = '$idCategory' 
                            WHERE `id` = " . $id;
                }

                $db = new Database();
                $item = $db->executeRun($sql);
                if ($item) {
                    $test = true;
                }
            }
        }
        return $test;
    }

    public static function getCourseDelete($id) {
        $id = intval($id);
        $test = false;
        if (isset($_POST['save'])) {
            $db = new Database();
            $db->executeRun("DELETE FROM `reviews` WHERE `course_id` = " . $id);
            $db->executeRun("DELETE FROM `registrations` WHERE `course_id` = " . $id);
            $sql = "DELETE FROM `courses` WHERE `id` = " . $id;
            $item = $db->executeRun($sql);
            if ($item) {
                $test = true;
            }
        }
        return $test;
    }
}
?>
