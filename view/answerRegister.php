<?php
ob_start();
?>
<div class="row justify-content-center py-5">
    <div class="col-md-7">
        <div class="card shadow border-0 rounded-lg text-center p-4">
            <div class="card-body">
                <?php if (isset($result) && $result[0] == true): ?>
                    <div class="text-success mb-3"><i class="fa fa-check-circle fa-4x"></i></div>
                    <h3 class="font-weight-bold text-success mb-3">Registreerimine õnnestus edukalt!</h3>
                    <p class="text-muted mb-4">Saate nüüd oma andmetega sisse logida.</p>
                    <a href="admin/" class="btn btn-primary btn-lg font-weight-bold px-4">Sisselogimine</a>
                <?php else: ?>
                    <div class="text-danger mb-3"><i class="fa fa-exclamation-triangle fa-4x"></i></div>
                    <h3 class="font-weight-bold text-danger mb-3">Viga registreerimisel</h3>
                    <div class="alert alert-danger text-left">
                        <?php echo $result[1] ?? 'Tundmatu viga'; ?>
                    </div>
                    <a href="registerForm" class="btn btn-outline-secondary font-weight-bold px-4">Tagasi</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include_once 'view/layout.php';
?>
