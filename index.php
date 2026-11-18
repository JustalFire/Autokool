<?php
session_start();

require_once 'inc/Database.php';

require_once 'model/Category.php';
require_once 'model/Course.php';
require_once 'model/Review.php';
require_once 'model/Enrollment.php';
require_once 'model/Register.php';

require_once 'view/courses.php';
require_once 'view/reviews.php';

require_once 'controller/Controller.php';
require_once 'route/routing.php';

echo $response ?? '';
?>
