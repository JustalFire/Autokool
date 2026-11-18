<?php
class controllerAdminCourse {

    // List Courses
    public static function courseList() {
        $arr = modelAdminCourse::getCourseList();
        include_once 'viewAdmin/courseList.php';
    }

    // Add Course
    public static function courseAddForm() {
        $arr = modelAdminCategory::getCategoryList();
        include_once 'viewAdmin/courseAddForm.php';
    }

    public static function courseAddResult() {
        $test = modelAdminCourse::getCourseAdd();
        include_once 'viewAdmin/courseAddForm.php';
    }

    // Edit Course
    public static function courseEditForm($id) {
        $arr = modelAdminCategory::getCategoryList();
        $detail = modelAdminCourse::getCourseDetail($id);
        include_once 'viewAdmin/courseEditForm.php';
    }

    public static function courseEditResult($id) {
        $test = modelAdminCourse::getCourseEdit($id);
        include_once 'viewAdmin/courseEditForm.php';
    }

    // Delete Course
    public static function courseDeleteForm($id) {
        $arr = modelAdminCategory::getCategoryList();
        $detail = modelAdminCourse::getCourseDetail($id);
        include_once 'viewAdmin/courseDeleteForm.php';
    }

    public static function courseDeleteResult($id) {
        $test = modelAdminCourse::getCourseDelete($id);
        include_once 'viewAdmin/courseDeleteForm.php';
    }

    // View Online Registrations
    public static function registrationsList() {
        $db = new Database();
        $registrations = $db->getAll("SELECT r.*, c.title FROM `registrations` r LEFT JOIN `courses` c ON r.course_id = c.id ORDER BY r.id DESC");
        include_once 'viewAdmin/registrationList.php';
    }
}
?>
