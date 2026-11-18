<?php
echo '<a class="dropdown-item font-weight-bold" href="courses"><i class="fa fa-th-large text-primary mr-2"></i>Kõik kategooriad</a>';
echo '<div class="dropdown-divider"></div>';

if (!empty($arr)) {
    foreach ($arr as $value) {
        $catName = htmlspecialchars($value['name']);
        echo '<a class="dropdown-item" href="category?id=' . intval($value['id']) . '">';
        echo '<i class="fa fa-angle-right text-muted mr-2"></i>' . $catName;
        echo '</a>';
    }
}
?>
