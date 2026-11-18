<?php
class controllerAdminCourse {

    // Access control check for all course admin operations
    private static function checkAdminAuth() {
        $isRu = (class_exists('Lang') && Lang::current() === 'ru');
        if (empty($_SESSION['sessionId']) || empty($_SESSION['userId']) || ($_SESSION['status'] ?? '') !== 'admin') {
            $_SESSION['errorString'] = $isRu 
                ? 'Доступ запрещен. Необходима авторизация с правами администратора.' 
                : 'Juurdepääs keelatud. Nõutav administraatori sisselogimine.';
            header('Location: ./');
            exit();
        }
    }

    // List Courses
    public static function courseList() {
        self::checkAdminAuth();
        $arr = modelAdminCourse::getCourseList();
        include_once 'viewAdmin/courseList.php';
    }

    // Add Course
    public static function courseAddForm() {
        self::checkAdminAuth();
        $arr = modelAdminCategory::getCategoryList();
        include_once 'viewAdmin/courseAddForm.php';
    }

    public static function courseAddResult() {
        self::checkAdminAuth();
        $test = modelAdminCourse::getCourseAdd();
        include_once 'viewAdmin/courseAddForm.php';
    }

    // Edit Course
    public static function courseEditForm($id) {
        self::checkAdminAuth();
        $arr = modelAdminCategory::getCategoryList();
        $detail = modelAdminCourse::getCourseDetail($id);
        include_once 'viewAdmin/courseEditForm.php';
    }

    public static function courseEditResult($id) {
        self::checkAdminAuth();
        $test = modelAdminCourse::getCourseEdit($id);
        include_once 'viewAdmin/courseEditForm.php';
    }

    // Delete Course
    public static function courseDeleteForm($id) {
        self::checkAdminAuth();
        $arr = modelAdminCategory::getCategoryList();
        $detail = modelAdminCourse::getCourseDetail($id);
        include_once 'viewAdmin/courseDeleteForm.php';
    }

    public static function courseDeleteResult($id) {
        self::checkAdminAuth();
        $test = modelAdminCourse::getCourseDelete($id);
        include_once 'viewAdmin/courseDeleteForm.php';
    }

    // View Online Registrations
    public static function registrationsList() {
        self::checkAdminAuth();
        $db = new Database();
        $lang = Lang::current();
        $registrations = $db->getAll("SELECT r.*, 
            (CASE WHEN '$lang' = 'ru' THEN c.title_ru ELSE c.title_et END) AS title 
            FROM `registrations` r 
            LEFT JOIN `courses` c ON r.course_id = c.id 
            ORDER BY r.id DESC");
        include_once 'viewAdmin/registrationList.php';
    }
}
?>
