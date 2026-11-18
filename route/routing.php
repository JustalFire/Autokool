<?php

$host = explode('?', $_SERVER['REQUEST_URI'])[0];
$num = substr_count($host, '/');
$path = explode('/', $host)[$num];

if ($path == '' || $path == 'index' || $path == 'index.php') {
    $response = Controller::StartSite();
}
elseif ($path == 'courses' || $path == 'all') {
    $response = Controller::AllCourses();
}
elseif ($path == 'category' && isset($_GET['id'])) {
    $response = Controller::CoursesByCatID($_GET['id']);
}
elseif ($path == 'course' && isset($_GET['id'])) {
    $response = Controller::CourseByID($_GET['id']);
}
elseif ($path == 'calculator') {
    $response = Controller::Calculator();
}
elseif ($path == 'search') {
    $term = $_GET['otsi'] ?? '';
    $response = Controller::Search($term);
}
elseif ($path == 'insertreview') {
    $course_id = $_POST['course_id'] ?? ($_GET['id'] ?? 0);
    $author = $_POST['author'] ?? 'Õpilane';
    $rating = $_POST['rating'] ?? 5;
    $comment = $_POST['comment'] ?? ($_GET['comment'] ?? '');
    $response = Controller::InsertReview($course_id, $author, $rating, $comment);
}
elseif ($path == 'enroll') {
    $response = Controller::EnrollCourse();
}
elseif ($path == 'lang' && isset($_GET['lang'])) {
    $response = Controller::ChangeLang($_GET['lang']);
}
elseif ($path == 'registerForm') {
    $response = Controller::registerForm();
}
elseif ($path == 'registerAnswer') {
    $response = Controller::registerUser();
}
else {
    $response = Controller::error404();
}
?>
