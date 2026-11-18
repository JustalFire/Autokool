<?php
ob_start();
?>
<div class="text-center py-5">
    <div class="display-1 font-weight-bold text-primary mb-3">404</div>
    <h2 class="font-weight-bold text-dark mb-3"><?php echo __('not_found_title'); ?></h2>
    <p class="lead text-muted mb-4"><?php echo __('not_found_desc'); ?></p>
    <a href="./" class="btn btn-warning btn-lg font-weight-bold px-4 shadow">
        <i class="fa fa-home mr-1"></i> <?php echo __('back_to_home'); ?>
    </a>
</div>
<?php
$content = ob_get_clean();
include_once 'view/layout.php';
?>
