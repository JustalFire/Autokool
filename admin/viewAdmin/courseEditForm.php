<?php
ob_start();
?>
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 font-weight-bold"><i class="fa fa-pencil"></i> Koolituse muutmine: #<?php echo $detail['id'] ?? ''; ?></h4>
                <a href="courseAdmin" class="btn btn-sm btn-light font-weight-bold"><i class="fa fa-arrow-left"></i> Tagasi nimekirja</a>
            </div>
            <div class="card-body p-4">
                <?php
                if (isset($test)) {
                    if ($test == true) {
                        echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Koolituse andmed edukalt uuendatud! <a href="courseAdmin" class="font-weight-bold">Tagasi nimekirja</a></div>';
                    } else {
                        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Viga uuendamisel! Kontrollige välju.</div>';
                    }
                }
                ?>
                <form action="courseEditResult?id=<?php echo $detail['id']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Kursuse nimetus (ET) *</label>
                            <input type="text" name="title_et" class="form-control" required value="<?php echo htmlspecialchars($detail['title_et'] ?? $detail['title'] ?? ''); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Kursuse nimetus (RU)</label>
                            <input type="text" name="title_ru" class="form-control" value="<?php echo htmlspecialchars($detail['title_ru'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Kategooria *</label>
                            <select name="idCategory" class="form-control" required>
                                <?php if (!empty($arr)): ?>
                                    <?php foreach ($arr as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == ($detail['category_id'] ?? 0)) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($cat['name_et'] ?? $cat['name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Hind (€) *</label>
                            <input type="number" step="0.01" name="price" class="form-control" required value="<?php echo htmlspecialchars($detail['price'] ?? '0.00'); ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Käigukast (ET)</label>
                            <select name="transmission_et" class="form-control">
                                <option value="Manuaal" <?php echo (($detail['transmission_et'] ?? $detail['transmission'] ?? '') == 'Manuaal') ? 'selected' : ''; ?>>Manuaal</option>
                                <option value="Automaat" <?php echo (($detail['transmission_et'] ?? $detail['transmission'] ?? '') == 'Automaat') ? 'selected' : ''; ?>>Automaat</option>
                                <option value="Mootorratas" <?php echo (($detail['transmission_et'] ?? $detail['transmission'] ?? '') == 'Mootorratas') ? 'selected' : ''; ?>>Mootorratas</option>
                                <option value="Veoauto" <?php echo (($detail['transmission_et'] ?? $detail['transmission'] ?? '') == 'Veoauto') ? 'selected' : ''; ?>>Veoauto</option>
                                <option value="Kõik käigukastid" <?php echo (($detail['transmission_et'] ?? $detail['transmission'] ?? '') == 'Kõik käigukastid') ? 'selected' : ''; ?>>Kõik käigukastid</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Kestus ja maht (ET)</label>
                            <input type="text" name="duration_et" class="form-control" value="<?php echo htmlspecialchars($detail['duration_et'] ?? $detail['duration'] ?? ''); ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="font-weight-bold">Kestus ja maht (RU)</label>
                            <input type="text" name="duration_ru" class="form-control" value="<?php echo htmlspecialchars($detail['duration_ru'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Kirjeldus eesti keeles (ET) *</label>
                        <textarea name="description_et" class="form-control" rows="4" required><?php echo htmlspecialchars($detail['description_et'] ?? $detail['description'] ?? ''); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Kirjeldus vene keeles (RU)</label>
                        <textarea name="description_ru" class="form-control" rows="4"><?php echo htmlspecialchars($detail['description_ru'] ?? ''); ?></textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Praegune pilt</label>
                        <div class="mb-2">
                            <?php if (!empty($detail['picture'])): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($detail['picture']); ?>" class="img-thumbnail" style="max-height: 120px;">
                            <?php else: ?>
                                <span class="badge badge-secondary">Pilti pole üles laaditud</span>
                            <?php endif; ?>
                        </div>
                        <label class="font-weight-bold">Uus pilt (kui soovid asendada)</label>
                        <input type="file" name="picture" class="form-control-file">
                    </div>

                    <hr class="my-4">

                    <button type="submit" name="save" class="btn btn-primary btn-lg px-4 font-weight-bold">
                        <i class="fa fa-save"></i> Salvesta muudatused
                    </button>
                    <a href="courseAdmin" class="btn btn-outline-secondary btn-lg px-4 ml-2">Loobu</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include_once 'viewAdmin/templates/layout.php';
?>
