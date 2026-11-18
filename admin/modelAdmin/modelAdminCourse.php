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
                $title_et = trim($_POST['title_et']);
                $title_ru = trim(!empty($_POST['title_ru']) ? $_POST['title_ru'] : $_POST['title_et']);
                $desc_et = trim($_POST['description_et']);
                $desc_ru = trim(!empty($_POST['description_ru']) ? $_POST['description_ru'] : $_POST['description_et']);
                $price = floatval($_POST['price'] ?? 0);
                $duration_et = trim($_POST['duration_et'] ?? '6 nädalat');
                $duration_ru = trim($_POST['duration_ru'] ?? '6 недель');
                $trans_et = trim($_POST['transmission_et'] ?? 'Manuaal');
                $trans_ru = trim($_POST['transmission_ru'] ?? 'Механика');
                $idCategory = intval($_POST['idCategory']);
                $userId = intval($_SESSION['userId'] ?? 1);

                $image = "";
                if (isset($_FILES['picture']) && !empty($_FILES['picture']['tmp_name'])) {
                    $image = file_get_contents($_FILES['picture']['tmp_name']);
                }

                $sql = "INSERT INTO `courses` 
                        (`id`, `title_et`, `title_ru`, `description_et`, `description_ru`, `price`, `duration_et`, `duration_ru`, `transmission_et`, `transmission_ru`, `picture`, `category_id`, `user_id`) 
                        VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $db = new Database();
                $item = $db->executeRun($sql, [
                    $title_et, $title_ru, $desc_et, $desc_ru, $price, $duration_et, $duration_ru, $trans_et, $trans_ru, $image, $idCategory, $userId
                ]);
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
                  WHERE c.id = ?";
        $db = new Database();
        return $db->getOne($query, [$id]);
    }

    public static function getCourseEdit($id) {
        $id = intval($id);
        $test = false;
        if (isset($_POST['save'])) {
            if (!empty($_POST['title_et']) && !empty($_POST['description_et']) && isset($_POST['idCategory'])) {
                $title_et = trim($_POST['title_et']);
                $title_ru = trim(!empty($_POST['title_ru']) ? $_POST['title_ru'] : $_POST['title_et']);
                $desc_et = trim($_POST['description_et']);
                $desc_ru = trim(!empty($_POST['description_ru']) ? $_POST['description_ru'] : $_POST['description_et']);
                $price = floatval($_POST['price'] ?? 0);
                $duration_et = trim($_POST['duration_et'] ?? '6 nädalat');
                $duration_ru = trim($_POST['duration_ru'] ?? '6 недель');
                $trans_et = trim($_POST['transmission_et'] ?? 'Manuaal');
                $trans_ru = trim($_POST['transmission_ru'] ?? 'Механика');
                $idCategory = intval($_POST['idCategory']);

                $image = "";
                if (isset($_FILES['picture']) && !empty($_FILES['picture']['tmp_name'])) {
                    $image = file_get_contents($_FILES['picture']['tmp_name']);
                }

                $db = new Database();
                if ($image === "") {
                    $sql = "UPDATE `courses` SET 
                            `title_et` = ?, 
                            `title_ru` = ?, 
                            `description_et` = ?, 
                            `description_ru` = ?, 
                            `price` = ?, 
                            `duration_et` = ?, 
                            `duration_ru` = ?, 
                            `transmission_et` = ?, 
                            `transmission_ru` = ?, 
                            `category_id` = ? 
                            WHERE `id` = ?";
                    $params = [
                        $title_et, $title_ru, $desc_et, $desc_ru, $price, $duration_et, $duration_ru, $trans_et, $trans_ru, $idCategory, $id
                    ];
                } else {
                    $sql = "UPDATE `courses` SET 
                            `title_et` = ?, 
                            `title_ru` = ?, 
                            `description_et` = ?, 
                            `description_ru` = ?, 
                            `price` = ?, 
                            `duration_et` = ?, 
                            `duration_ru` = ?, 
                            `transmission_et` = ?, 
                            `transmission_ru` = ?, 
                            `picture` = ?, 
                            `category_id` = ? 
                            WHERE `id` = ?";
                    $params = [
                        $title_et, $title_ru, $desc_et, $desc_ru, $price, $duration_et, $duration_ru, $trans_et, $trans_ru, $image, $idCategory, $id
                    ];
                }

                $item = $db->executeRun($sql, $params);
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
            $db->executeRun("DELETE FROM `reviews` WHERE `course_id` = ?", [$id]);
            $db->executeRun("DELETE FROM `registrations` WHERE `course_id` = ?", [$id]);
            $item = $db->executeRun("DELETE FROM `courses` WHERE `id` = ?", [$id]);
            if ($item) {
                $test = true;
            }
        }
        return $test;
    }
}
?>
