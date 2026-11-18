<?php
ob_start();
?>
<div class="courses-catalog-page py-3">
    <div class="row align-items-center mb-4">
        <div class="col-md-7">
            <h1 class="font-weight-bold text-dark">Kõik pakutavad koolitused ja teenused</h1>
            <p class="text-muted">Tutvu meie juhiloa kategooriate ja täiendkoolitustega</p>
        </div>
        <div class="col-md-5">
            <div class="input-group">
                <input type="text" id="courseFilterInput" class="form-control" placeholder="Otsi kursust..." onkeyup="filterCoursesLive()">
                <div class="input-group-append">
                    <span class="input-group-text bg-primary text-white"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Dynamic Category Filter Pills -->
    <div class="category-filter-pills mb-4 d-flex flex-wrap gap-2">
        <button class="btn btn-sm btn-primary active-pill mr-2 mb-2" onclick="filterByCategory('all', this)">Kõik kategooriad</button>
        <?php
        $cats = Category::getAllCategory();
        if (!empty($cats)) {
            foreach ($cats as $cat) {
                echo '<button class="btn btn-sm btn-outline-secondary mr-2 mb-2" onclick="filterByCategory(\'' . htmlspecialchars($cat['name']) . '\', this)">' . htmlspecialchars($cat['name']) . '</button>';
            }
        }
        ?>
    </div>

    <div id="coursesCatalogContainer">
        <?php
        ViewCourses::CoursesCards($arr);
        ?>
    </div>
</div>

<script>
function filterCoursesLive() {
    let input = document.getElementById('courseFilterInput').value.toLowerCase();
    let cards = document.querySelectorAll('.course-card');
    cards.forEach(card => {
        let title = card.querySelector('.card-title').innerText.toLowerCase();
        let desc = card.querySelector('.card-text').innerText.toLowerCase();
        let cat = card.querySelector('.category-badge').innerText.toLowerCase();
        if (title.includes(input) || desc.includes(input) || cat.includes(input)) {
            card.parentElement.style.display = '';
        } else {
            card.parentElement.style.display = 'none';
        }
    });
}

function filterByCategory(categoryName, btn) {
    document.querySelectorAll('.category-filter-pills button').forEach(b => {
        b.classList.remove('btn-primary');
        b.classList.add('btn-outline-secondary');
    });
    btn.classList.remove('btn-outline-secondary');
    btn.classList.add('btn-primary');

    let cards = document.querySelectorAll('.course-card');
    cards.forEach(card => {
        let cat = card.querySelector('.category-badge').innerText.trim();
        if (categoryName === 'all' || cat.toLowerCase().includes(categoryName.toLowerCase())) {
            card.parentElement.style.display = '';
        } else {
            card.parentElement.style.display = 'none';
        }
    });
}
</script>

<?php
$content = ob_get_clean();
include_once 'view/layout.php';
?>
