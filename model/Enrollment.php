<?php
class Enrollment {

    public static function createEnrollment($course_id, $name, $email, $phone, $message = '', $user_id = null) {
        $course_id = intval($course_id);
        $name = strip_tags(trim($name));
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        $phone = strip_tags(trim($phone));
        $message = strip_tags(trim($message));
        $userIdVal = !empty($user_id) ? intval($user_id) : null;

        if (empty($name) || !$email || empty($phone)) {
            return false;
        }

        $query = "INSERT INTO `registrations` (`id`, `user_id`, `course_id`, `name`, `email`, `phone`, `message`, `status`, `created_at`) 
                  VALUES (NULL, ?, ?, ?, ?, ?, ?, 'uus', CURRENT_TIMESTAMP)";
        $db = new Database();
        return $db->executeRun($query, [
            $userIdVal,
            $course_id,
            $name,
            strtolower($email),
            $phone,
            $message
        ]);
    }

    public static function getUserEnrollments($user_id, $email = '') {
        $lang = class_exists('Lang') ? Lang::current() : 'et';
        $user_id = intval($user_id);
        $cleanEmail = strtolower(trim($email));

        $params = [$user_id];
        $where = "r.user_id = ?";
        if (!empty($cleanEmail)) {
            $where .= " OR (r.user_id IS NULL AND LOWER(r.email) = ?)";
            $params[] = $cleanEmail;
        }

        $query = "SELECT r.*, 
                  (CASE WHEN '$lang' = 'ru' THEN c.title_ru ELSE c.title_et END) AS course_title,
                  c.price,
                  (CASE WHEN '$lang' = 'ru' THEN c.duration_ru ELSE c.duration_et END) AS duration,
                  (CASE WHEN '$lang' = 'ru' THEN cat.name_ru ELSE cat.name_et END) AS category_name
                  FROM `registrations` r 
                  LEFT JOIN `courses` c ON r.course_id = c.id 
                  LEFT JOIN `categories` cat ON c.category_id = cat.id 
                  WHERE $where 
                  ORDER BY r.id DESC";
        $db = new Database();
        return $db->getAll($query, $params);
    }

    public static function cancelEnrollment($registration_id, $user_id, $email = '') {
        $registration_id = intval($registration_id);
        $user_id = intval($user_id);
        $cleanEmail = strtolower(trim($email));

        $params = ['tühistatud', $registration_id, $user_id];
        $where = "r.user_id = ?";
        if (!empty($cleanEmail)) {
            $where .= " OR (r.user_id IS NULL AND LOWER(r.email) = ?)";
            $params[] = $cleanEmail;
        }

        $query = "UPDATE `registrations` r 
                  SET r.status = ? 
                  WHERE r.id = ? AND ($where)";
        $db = new Database();
        return $db->executeRun($query, $params);
    }

    public static function getAllEnrollments() {
        $lang = class_exists('Lang') ? Lang::current() : 'et';
        $query = "SELECT r.*, 
                  (CASE WHEN '$lang' = 'ru' THEN c.title_ru ELSE c.title_et END) AS title 
                  FROM `registrations` r 
                  LEFT JOIN `courses` c ON r.course_id = c.id 
                  ORDER BY r.id DESC";
        $db = new Database();
        return $db->getAll($query);
    }
}
?>
