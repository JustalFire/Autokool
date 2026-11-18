<?php
class modelAdminCourse {

    public static function getCourseList() {
        $query = "SELECT c.*, 
                  c.title_et AS title, 
                  c.duration_et AS duration, 
                  c.transmission_et AS transmission, 
                  cat.name_et AS category_name, u.username 
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
            if (!empty($_POST['title_et']) && !empty($_POST['description_et']) && isset($_POST['idCategory'])) {
                $title_et = addslashes($_POST['title_et']);
                $title_ru = addslashes(!empty($_POST['title_ru']) ? $_POST['title_ru'] : $_POST['title_et']);
                $desc_et = addslashes($_POST['description_et']);
                $desc_ru = addslashes(!empty($_POST['description_ru']) ? $_POST['description_ru'] : $_POST['description_et']);
                $price = floatval($_POST['price'] ?? 0);
                $duration_et = addslashes($_POST['duration_et'] ?? '6 nädalat');
                $duration_ru = addslashes($_POST['duration_ru'] ?? '6 недель');
                $trans_et = addslashes($_POST['transmission_et'] ?? 'Manuaal');
                $trans_ru = addslashes($_POST['transmission_ru'] ?? 'Механика');
                $idCategory = intval($_POST['idCategory']);
                $userId = intval($_SESSION['userId'] ?? 1);

                $image = "";
                if (isset($_FILES['picture']) && !empty($_FILES['picture']['tmp_name'])) {
                    $image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
                }

                $sql = "INSERT INTO `courses` 
                        (`id`, `title_et`, `title_ru`, `description_et`, `description_ru`, `price`, `duration_et`, `duration_ru`, `transmission_et`, `transmission_ru`, `picture`, `category_id`, `user_id`) 
                        VALUES (NULL, '$title_et', '$title_ru', '$desc_et', '$desc_ru', '$price', '$duration_et', '$duration_ru', '$trans_et', '$trans_ru', '$image', '$idCategory', '$userId')";
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
        $query = "SELECT c.*, cat.name_et AS category_name, u.username 
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
            if (!empty($_POST['title_et']) && !empty($_POST['description_et']) && isset($_POST['idCategory'])) {
                $title_et = addslashes($_POST['title_et']);
                $title_ru = addslashes(!empty($_POST['title_ru']) ? $_POST['title_ru'] : $_POST['title_et']);
                $desc_et = addslashes($_POST['description_et']);
                $desc_ru = addslashes(!empty($_POST['description_ru']) ? $_POST['description_ru'] : $_POST['description_et']);
                $price = floatval($_POST['price'] ?? 0);
                $duration_et = addslashes($_POST['duration_et'] ?? '6 nädalat');
                $duration_ru = addslashes($_POST['duration_ru'] ?? '6 недель');
                $trans_et = addslashes($_POST['transmission_et'] ?? 'Manuaal');
                $trans_ru = addslashes($_POST['transmission_ru'] ?? 'Механика');
                $idCategory = intval($_POST['idCategory']);

                $image = "";
                if (isset($_FILES['picture']) && !empty($_FILES['picture']['tmp_name'])) {
                    $image = addslashes(file_get_contents($_FILES['picture']['tmp_name']));
                }

                if ($image === "") {
                    $sql = "UPDATE `courses` SET 
                            `title_et` = '$title_et', 
                            `title_ru` = '$title_ru', 
                            `description_et` = '$desc_et', 
                            `description_ru` = '$desc_ru', 
                            `price` = '$price', 
                            `duration_et` = '$duration_et', 
                            `duration_ru` = '$duration_ru', 
                            `transmission_et` = '$trans_et', 
                            `transmission_ru` = '$trans_ru', 
                            `category_id` = '$idCategory' 
                            WHERE `id` = " . $id;
                } else {
                    $sql = "UPDATE `courses` SET 
                            `title_et` = '$title_et', 
                            `title_ru` = '$title_ru', 
                            `description_et` = '$desc_et', 
                            `description_ru` = '$desc_ru', 
                            `price` = '$price', 
                            `duration_et` = '$duration_et', 
                            `duration_ru` = '$duration_ru', 
                            `transmission_et` = '$trans_et', 
                            `transmission_ru` = '$trans_ru', 
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
