<?php
ob_start();
$catObj = Category::getCategoryByID($_GET['id'] ?? 0);
$catTitle = $catObj ? $catObj['name'] : 'Koolitused kategoorias';
$catDesc = $catObj ? $catObj['description'] : '';
?>
<div class="category-courses-page py-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-light">
            <li class="breadcrumb-item"><a href="./">Avaleht</a></li>
            <li class="breadcrumb-item"><a href="courses">Koolitused</a></li>
            <li class="breadcrumb-item active"><?php echo htmlspecialchars($catTitle); ?></li>
        </ol>
    </nav>

    <div class="category-header bg-light p-4 rounded mb-4 shadow-sm border-left border-primary" style="border-left-width: 6px !important;">
        <h2 class="font-weight-bold text-dark mb-2"><?php echo htmlspecialchars($catTitle); ?></h2>
        <?php if (!empty($catDesc)): ?>
            <p class="text-muted mb-0 lead" style="font-size: 1.05rem;"><?php echo htmlspecialchars($catDesc); ?></p>
        <?php endif; ?>
    </div>

    <?php
    ViewCourses::CoursesCards($arr);
    ?>
</div>

<?php
$content = ob_get_clean();
include_once 'view/layout.php';
?>
