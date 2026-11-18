<?php
ob_start();
?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0 font-weight-bold"><i class="fa fa-exclamation-triangle"></i> <?php echo __('admin_del_course_title'); ?></h4>
            </div>
            <div class="card-body p-4 text-center">
                <?php
                if (isset($test)) {
                    if ($test == true) {
                        echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' . __('msg_success', 'Koolitus edukalt kustutatud!') . ' <a href="courseAdmin" class="font-weight-bold">' . __('admin_btn_back_list') . '</a></div>';
                    } else {
                        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> ' . __('msg_error', 'Viga kustutamisel!') . '</div>';
                    }
                } else {
                ?>
                    <h5 class="text-dark mb-3"><?php echo __('admin_confirm_delete_msg'); ?></h5>
                    <div class="alert alert-light border p-3 text-left mb-4">
                        <strong class="d-block text-dark h5 mb-1"><?php echo htmlspecialchars(!empty($detail['title_et']) ? $detail['title_et'] : ($detail['title'] ?? '')); ?></strong>
                        <?php if (!empty($detail['title_ru'])): ?>
                            <div class="text-muted small mb-2"><i class="fa fa-globe text-warning"></i> <?php echo htmlspecialchars($detail['title_ru']); ?></div>
                        <?php endif; ?>
                        <div><strong><?php echo __('admin_th_category'); ?>:</strong> <?php echo htmlspecialchars($detail['category_name'] ?? ''); ?></div>
                        <div><strong><?php echo __('admin_th_price'); ?>:</strong> <?php echo number_format($detail['price'] ?? 0, 2); ?> €</div>
                    </div>
                    <form action="courseDelResult?id=<?php echo $detail['id']; ?>" method="POST">
                        <button type="submit" name="save" class="btn btn-danger btn-lg px-4 font-weight-bold">
                            <i class="fa fa-trash"></i> <?php echo __('admin_btn_confirm_delete'); ?>
                        </button>
                        <a href="courseAdmin" class="btn btn-outline-secondary btn-lg px-4 ml-2"><?php echo __('admin_btn_cancel'); ?></a>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include_once 'viewAdmin/templates/layout.php';
?>
