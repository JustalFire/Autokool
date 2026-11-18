<?php
$host = explode('?', $_SERVER['REQUEST_URI'])[0];
$num = substr_count($host, '/');
$path = explode('/', $host)[$num];

if ($path == '' || $path == 'index.php') {
    $response = controllerAdmin::formLoginSite();
}
elseif ($path == 'login') {
    $response = controllerAdmin::loginAction();
}
elseif ($path == 'logout') {
    $response = controllerAdmin::logoutAction();
}
// Courses CRUD
elseif ($path == 'courseAdmin') {
    $response = controllerAdminCourse::courseList();
}
elseif ($path == 'courseAdd') {
    $response = controllerAdminCourse::courseAddForm();
}
elseif ($path == 'courseAddResult') {
    $response = controllerAdminCourse::courseAddResult();
}
elseif ($path == 'courseEdit' && isset($_GET['id'])) {
    $response = controllerAdminCourse::courseEditForm($_GET['id']);
}
elseif ($path == 'courseEditResult' && isset($_GET['id'])) {
    $response = controllerAdminCourse::courseEditResult($_GET['id']);
}
elseif ($path == 'courseDel' && isset($_GET['id'])) {
    $response = controllerAdminCourse::courseDeleteForm($_GET['id']);
}
elseif ($path == 'courseDelResult' && isset($_GET['id'])) {
    $response = controllerAdminCourse::courseDeleteResult($_GET['id']);
}
elseif ($path == 'registrationsAdmin') {
    $response = controllerAdminCourse::registrationsList();
}
else {
    $response = controllerAdmin::error404();
}
?>
