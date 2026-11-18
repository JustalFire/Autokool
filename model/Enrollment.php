<?php
class Enrollment {

    public static function createEnrollment($course_id, $name, $email, $phone, $message = '') {
        $course_id = intval($course_id);
        $name = strip_tags(trim($name));
        $email = filter_var(trim($email), FILTER_VALIDATE_EMAIL);
        $phone = strip_tags(trim($phone));
        $message = strip_tags(trim($message));

        if (empty($name) || !$email || empty($phone)) {
            return false;
        }

        $nameEsc = addslashes($name);
        $emailEsc = addslashes($email);
        $phoneEsc = addslashes($phone);
        $msgEsc = addslashes($message);

        $query = "INSERT INTO `registrations` (`id`, `course_id`, `name`, `email`, `phone`, `message`, `status`, `created_at`) 
                  VALUES (NULL, '$course_id', '$nameEsc', '$emailEsc', '$phoneEsc', '$msgEsc', 'uus', CURRENT_TIMESTAMP)";
        $db = new Database();
        return $db->executeRun($query);
    }

    public static function getAllEnrollments() {
        $query = "SELECT r.*, c.title 
                  FROM `registrations` r 
                  LEFT JOIN `courses` c ON r.course_id = c.id 
                  ORDER BY r.id DESC";
        $db = new Database();
        return $db->getAll($query);
    }
}
?>
