<?php
class Review {

    public static function insertReview($course_id, $author_name, $rating, $comment_text) {
        $course_id = intval($course_id);
        $author_name = strip_tags(trim($author_name));
        if (empty($author_name)) {
            $author_name = 'Anonüümne õpilane';
        }
        $rating = intval($rating);
        if ($rating < 1 || $rating > 5) {
            $rating = 5;
        }
        $comment_text = strip_tags(trim($comment_text));
        if (empty($comment_text)) {
            return false;
        }

        $query = "INSERT INTO `reviews` (`id`, `course_id`, `author_name`, `rating`, `text`, `date`) 
                  VALUES (NULL, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
        $db = new Database();
        return $db->executeRun($query, [$course_id, $author_name, $rating, $comment_text]);
    }

    public static function getReviewsByCourseID($course_id) {
        $course_id = intval($course_id);
        $query = "SELECT * FROM `reviews` WHERE `course_id` = ? ORDER BY `id` DESC";
        $db = new Database();
        return $db->getAll($query, [$course_id]);
    }

    public static function getReviewsCountByCourseID($course_id) {
        $course_id = intval($course_id);
        $query = "SELECT count(id) as 'count', ROUND(AVG(rating), 1) as 'avg_rating' 
                  FROM `reviews` WHERE `course_id` = ?";
        $db = new Database();
        return $db->getOne($query, [$course_id]);
    }
}
?>
