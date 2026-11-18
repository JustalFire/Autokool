<?php
class ViewReviews {

    public static function ReviewsForm($course_id) {
        $course_id = intval($course_id);
        echo '
        <div class="card shadow-sm border-0 mb-4 bg-light">
            <div class="card-body p-4">
                <h4 class="font-weight-bold mb-3"><i class="fa fa-pencil text-primary"></i> Jäta oma tagasiside</h4>
                <form action="insertreview" method="POST">
                    <input type="hidden" name="course_id" value="' . $course_id . '">
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <label class="font-weight-bold">Teie nimi *</label>
                            <input type="text" name="author" class="form-control" required placeholder="nt. Anna Tamm">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Hinnang *</label>
                            <select name="rating" class="form-control">
                                <option value="5">★★★★★ (5/5) Suurepärane</option>
                                <option value="4">★★★★☆ (4/5) Väga hea</option>
                                <option value="3">★★★☆☆ (3/5) Rahuldav</option>
                                <option value="2">★★☆☆☆ (2/5) Kasin</option>
                                <option value="1">★☆☆☆☆ (1/5) Mitterahuldav</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Teie kommentaar / kogemus *</label>
                        <textarea name="comment" class="form-control" rows="3" required placeholder="Kirjuta oma muljetest sõiduõpetaja ja tundide kohta..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary px-4 font-weight-bold">
                        <i class="fa fa-paper-plane"></i> Saada arvustus
                    </button>
                </form>
            </div>
        </div>';
    }

    public static function ReviewsList($arr) {
        echo '<div id="reviews-section" class="reviews-wrapper mt-5">';
        echo '<h3 class="font-weight-bold mb-4"><i class="fa fa-comments text-primary"></i> Õpilaste tagasiside ja arvustused</h3>';

        if (empty($arr)) {
            echo '<div class="alert alert-secondary p-4 text-center">Sellel kursusel pole veel arvustusi. Ole esimene tagasiside jätja!</div>';
            return;
        }

        echo '<div class="reviews-list">';
        foreach ($arr as $rev) {
            $author = htmlspecialchars($rev['author_name'] ?? 'Õpilane');
            $date = date('d.m.Y H:i', strtotime($rev['date']));
            $text = nl2br(htmlspecialchars($rev['text']));
            $rating = intval($rev['rating'] ?? 5);
            $stars = str_repeat('★', $rating) . str_repeat('☆', 5 - $rating);

            echo '
            <div class="card mb-3 shadow-sm border-0 review-item">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle mr-3">' . mb_strtoupper(mb_substr($author, 0, 1)) . '</div>
                            <div>
                                <h6 class="font-weight-bold mb-0 text-dark">' . $author . '</h6>
                                <span class="text-warning small">' . $stars . '</span>
                            </div>
                        </div>
                        <small class="text-muted"><i class="fa fa-calendar-o"></i> ' . $date . '</small>
                    </div>
                    <p class="card-text text-secondary mb-0">' . $text . '</p>
                </div>
            </div>';
        }
        echo '</div></div>';
    }

    public static function ReviewsCount($revData) {
        $cnt = $revData['count'] ?? 0;
        if ($cnt > 0) {
            echo '<span class="badge badge-warning text-dark font-weight-bold ml-1">★ ' . ($revData['avg_rating'] ?? '5.0') . ' (' . $cnt . ')</span>';
        }
    }
}
?>
