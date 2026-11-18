<?php
ob_start();
?>
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm border-danger">
            <div class="card-header bg-danger text-white">
                <h4 class="mb-0 font-weight-bold"><i class="fa fa-exclamation-triangle"></i> Koolituse kustutamise kinnitus</h4>
            </div>
            <div class="card-body p-4 text-center">
                <?php
                if (isset($test)) {
                    if ($test == true) {
                        echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Koolitus edukalt kustutatud! <a href="courseAdmin" class="font-weight-bold">Tagasi nimekirja</a></div>';
                    } else {
                        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Viga kustutamisel!</div>';
                    }
                } else {
                ?>
                    <h5 class="text-dark mb-3">Kas olete kindel, et soovite kustutada järgmise koolituse?</h5>
                    <div class="alert alert-light border p-3 text-left mb-4">
                        <strong class="d-block text-dark h5 mb-1"><?php echo htmlspecialchars(!empty($detail['title_et']) ? $detail['title_et'] : ($detail['title'] ?? '')); ?></strong>
                        <div><strong>Kategooria:</strong> <?php echo htmlspecialchars($detail['category_name'] ?? ''); ?></div>
                        <div><strong>Hind:</strong> <?php echo number_format($detail['price'] ?? 0, 2); ?> €</div>
                    </div>
                    <form action="courseDelResult?id=<?php echo $detail['id']; ?>" method="POST">
                        <button type="submit" name="save" class="btn btn-danger btn-lg px-4 font-weight-bold">
                            <i class="fa fa-trash"></i> Jah, kustuta koolitus
                        </button>
                        <a href="courseAdmin" class="btn btn-outline-secondary btn-lg px-4 ml-2">Loobu</a>
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
