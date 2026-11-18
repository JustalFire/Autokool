<?php
ob_start();

ViewCourses::ReadCourse($c);

echo '<div class="row"><div class="col-lg-8">';
ViewReviews::ReviewsForm($_GET['id']);
ViewReviews::ReviewsList($reviews);
echo '</div></div>';

$content = ob_get_clean();
include_once 'view/layout.php';
?>
