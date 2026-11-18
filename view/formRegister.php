<?php
ob_start();
?>
<div class="row justify-content-center py-4">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow border-0 rounded-lg">
            <div class="card-header bg-primary text-white text-center py-3">
                <h4 class="font-weight-bold mb-0"><i class="fa fa-user-plus mr-2"></i><?php echo __('reg_user_title'); ?></h4>
            </div>
            <div class="card-body p-4 p-md-5">
                <form action="registerAnswer" method="POST">
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-secondary"><?php echo __('your_name'); ?> *</label>
                        <input type="text" name="name" class="form-control form-control-lg" required placeholder="nt. Karl Kask">
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-secondary"><?php echo __('reg_email'); ?> *</label>
                        <input type="email" name="email" class="form-control form-control-lg" required placeholder="nimi@e-post.ee">
                    </div>
                    <div class="form-group mb-3">
                        <label class="font-weight-bold text-secondary"><?php echo __('password'); ?> *</label>
                        <input type="password" name="password" class="form-control form-control-lg" minlength="6" required placeholder="••••••••">
                    </div>
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-secondary"><?php echo __('confirm_password'); ?> *</label>
                        <input type="password" name="confirm" class="form-control form-control-lg" minlength="6" required placeholder="••••••••">
                    </div>
                    <button type="submit" name="save" class="btn btn-warning btn-lg btn-block font-weight-bold shadow-sm py-3">
                        <i class="fa fa-check-circle mr-1"></i> <?php echo __('nav_register'); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include_once 'view/layout.php';
?>
