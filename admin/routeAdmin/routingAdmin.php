<?php
$host = explode('?', $_SERVER['REQUEST_URI'])[0];
$num = substr_count($host, '/');
$path = explode('/', $host)[$num];

// Security Guard: restrict all admin routes to authenticated admin users only
$publicPaths = ['', 'index', 'index.php', 'login', 'logout'];
if (!in_array($path, $publicPaths)) {
    if (empty($_SESSION['sessionId']) || empty($_SESSION['userId']) || ($_SESSION['status'] ?? '') !== 'admin') {
        $isRu = (class_exists('Lang') && Lang::current() === 'ru');
        $_SESSION['errorString'] = $isRu 
            ? 'Доступ запрещен. Необходима авторизация с правами администратора.' 
            : 'Juurdepääs keelatud. Nõutav administraatori sisselogimine.';
        header('Location: ./');
        exit();
    }
}

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
