<?php
class ViewCourses {

    public static function CoursesCards($arr) {
        if (empty($arr)) {
            echo '<div class="alert alert-info">Ühtegi kursust ei leitud.</div>';
            return;
        }

        echo '<div class="row course-grid">';
        foreach ($arr as $value) {
            $title = htmlspecialchars($value['title']);
            $desc = htmlspecialchars(mb_substr(strip_tags($value['description']), 0, 140)) . '...';
            $catName = htmlspecialchars($value['category_name'] ?? 'Määramata');
            $price = number_format((float)$value['price'], 2, '.', ' ') . ' €';
            $duration = htmlspecialchars($value['duration']);
            $transmission = htmlspecialchars($value['transmission'] ?? 'Manuaal');
            $id = intval($value['id']);

            $imgSrc = 'public/images/course_b_manual.jpg';
            if (!empty($value['picture'])) {
                $imgSrc = 'data:image/jpeg;base64,' . base64_encode($value['picture']);
            }

            $revData = Review::getReviewsCountByCourseID($id);
            $revCount = $revData['count'] ?? 0;
            $avgRating = $revData['avg_rating'] ?? 5.0;

            echo '
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm course-card">
                    <div class="position-relative">
                        <img src="' . $imgSrc . '" class="card-img-top" alt="' . $title . '">
                        <span class="badge badge-primary category-badge">' . $catName . '</span>
                        <div class="price-tag">' . $price . '</div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="rating-bar mb-2">
                            <span class="text-warning">★ ' . ($revCount > 0 ? $avgRating : '5.0') . '</span>
                            <small class="text-muted ml-1">(' . $revCount . ' ' . __('reviews_word') . ')</small>
                        </div>
                        <h5 class="card-title font-weight-bold">' . $title . '</h5>
                        <p class="card-text text-muted flex-grow-1">' . $desc . '</p>
                        <div class="course-meta small text-muted mb-3">
                            <div><i class="fa fa-clock-o text-primary"></i> <strong>' . __('duration') . ':</strong> ' . $duration . '</div>
                            <div><i class="fa fa-cogs text-primary"></i> <strong>' . __('transmission') . ':</strong> ' . $transmission . '</div>
                        </div>
                        <div class="card-buttons mt-auto d-flex gap-2">
                            <a href="course?id=' . $id . '" class="btn btn-outline-primary btn-sm flex-fill font-weight-bold">' . __('btn_read_more') . '</a>
                            <button type="button" class="btn btn-warning btn-sm flex-fill font-weight-bold btn-quick-enroll" data-id="' . $id . '" data-title="' . $title . '">
                                <i class="fa fa-pencil-square-o"></i> ' . __('btn_register_now') . '
                            </button>
                        </div>
                    </div>
                </div>
            </div>';
        }
        echo '</div>';
    }

    public static function AllCourses($arr) {
        self::CoursesCards($arr);
    }

    public static function ReadCourse($c) {
        if (!$c) {
            echo '<h2>Lehekülge ei leitud</h2>';
            return;
        }

        $id = intval($c['id']);
        $title = htmlspecialchars($c['title']);
        $desc = nl2br(htmlspecialchars($c['description']));
        $catName = htmlspecialchars($c['category_name'] ?? 'Määramata');
        $price = number_format((float)$c['price'], 2, '.', ' ') . ' €';
        $duration = htmlspecialchars($c['duration']);
        $transmission = htmlspecialchars($c['transmission'] ?? 'Manuaal');

        $imgSrc = 'public/images/course_b_manual.jpg';
        if (!empty($c['picture'])) {
            $imgSrc = 'data:image/jpeg;base64,' . base64_encode($c['picture']);
        }

        $revData = Review::getReviewsCountByCourseID($id);
        $revCount = $revData['count'] ?? 0;
        $avgRating = $revData['avg_rating'] ?? 5.0;

        echo '
        <div class="course-detail-container mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-light">
                    <li class="breadcrumb-item"><a href="./">' . __('nav_home') . '</a></li>
                    <li class="breadcrumb-item"><a href="courses">' . __('nav_courses') . '</a></li>
                    <li class="breadcrumb-item active" aria-current="page">' . $title . '</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col-lg-7">
                    <div class="course-image-wrapper mb-4 shadow rounded overflow-hidden">
                        <img src="' . $imgSrc . '" class="img-fluid w-100" alt="' . $title . '">
                    </div>
                    <h2 class="font-weight-bold text-dark">' . $title . '</h2>
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge badge-info mr-2 py-1 px-2">' . $catName . '</span>
                        <span class="text-warning font-weight-bold mr-2">★ ' . ($revCount > 0 ? $avgRating : '5.0') . '</span>
                        <a href="#reviews-section" class="text-muted small">(' . $revCount . ' ' . __('reviews_word') . ')</a>
                    </div>
                    <hr>
                    <h4 class="font-weight-bold mb-3">' . __('course_program') . '</h4>
                    <div class="course-description-text text-secondary mb-4 leading-relaxed">' . $desc . '</div>

                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h5 class="font-weight-bold mb-3"><i class="fa fa-check-circle text-success"></i> ' . __('course_includes') . ':</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> ' . __('course_inc_1') . '</li>
                                <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> ' . __('course_inc_2') . '</li>
                                <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> ' . __('course_inc_3') . '</li>
                                <li><i class="fa fa-check text-success mr-2"></i> ' . __('course_inc_4') . ' (' . __('calc_free') . ')</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card shadow border-primary sticky-top" style="top: 20px;">
                        <div class="card-header bg-primary text-white text-center py-3">
                            <h4 class="my-0 font-weight-bold">' . __('course_details') . '</h4>
                        </div>
                        <div class="card-body p-4">
                            <div class="price-box text-center p-3 mb-4 rounded bg-light border">
                                <span class="text-muted small d-block uppercase">' . __('price') . '</span>
                                <h2 class="text-primary font-weight-bold mb-0">' . $price . '</h2>
                                <small class="text-muted">' . __('calc_installment') . ' <strong>' . number_format($c['price'] / 4, 2) . ' €/' . __('calc_month') . '</strong></small>
                            </div>

                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span><i class="fa fa-folder-open text-primary mr-2"></i> ' . __('category') . '</span>
                                    <strong>' . $catName . '</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span><i class="fa fa-clock-o text-primary mr-2"></i> ' . __('duration') . '</span>
                                    <strong>' . $duration . '</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span><i class="fa fa-cogs text-primary mr-2"></i> ' . __('transmission') . '</span>
                                    <strong>' . $transmission . '</strong>
                                </li>
                            </ul>

                            <button type="button" class="btn btn-warning btn-lg btn-block font-weight-bold py-3 shadow-sm btn-quick-enroll" data-id="' . $id . '" data-title="' . $title . '">
                                <i class="fa fa-pencil-square-o"></i> ' . __('btn_register_now') . '
                            </button>
                            <a href="courses" class="btn btn-outline-secondary btn-block mt-2">' . __('btn_back') . '</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }
}
?>
