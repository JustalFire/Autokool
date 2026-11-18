<?php

class Controller {

    public static function StartSite() {
        $arr = Course::getFeaturedCourses();
        include_once 'view/start.php';
    }

    public static function AllCategories() {
        $arr = Category::getAllCategory();
        include_once 'view/category.php';
    }

    public static function AllCourses() {
        $arr = Course::getAllCourses();
        include_once 'view/allcourses.php';
    }

    public static function CoursesByCatID($id) {
        $arr = Course::getCoursesByCategoryID($id);
        include_once 'view/catcourses.php';
    }

    public static function CourseByID($id) {
        $c = Course::getCourseByID($id);
        $reviews = Review::getReviewsByCourseID($id);
        include_once 'view/readcourse.php';
    }

    public static function Calculator() {
        include_once 'view/calculator.php';
    }

    public static function Search($term) {
        $arr = Course::searchCourses($term);
        include_once 'view/allcourses.php';
    }

    public static function InsertReview($course_id, $author, $rating, $comment) {
        Review::insertReview($course_id, $author, $rating, $comment);
        $_SESSION['flash_success'] = 'Täname tagasiside eest!';
        header('Location: course?id=' . intval($course_id) . '#reviews-section');
        exit();
    }

    public static function EnrollCourse() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $course_id = $_POST['course_id'] ?? 1;
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            $message = $_POST['message'] ?? '';

            $res = Enrollment::createEnrollment($course_id, $name, $email, $phone, $message);
            if ($res) {
                $_SESSION['flash_success'] = 'Registreerimine edukalt vastu võetud! Meie konsultant võtab Teiega peagi ühendust.';
            } else {
                $_SESSION['flash_error'] = 'Palun täitke kõik kohustuslikud väljad korrektselt.';
            }
        }
        $referer = $_SERVER['HTTP_REFERER'] ?? './';
        header('Location: ' . $referer);
        exit();
    }

    public static function registerForm() {
        include_once 'view/formRegister.php';
    }

    public static function registerUser() {
        $result = Register::registerUser();
        include_once 'view/answerRegister.php';
    }

    public static function error404() {
        include_once 'view/error404.php';
    }
}
?>
