<?php
ob_start();
?>
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0 font-weight-bold"><i class="fa fa-plus-circle"></i> Uue koolituse / kursuse lisamine</h4>
                <a href="courseAdmin" class="btn btn-sm btn-light font-weight-bold"><i class="fa fa-arrow-left"></i> Tagasi nimekirja</a>
            </div>
            <div class="card-body p-4">
                <?php
                if (isset($test)) {
                    if ($test == true) {
                        echo '<div class="alert alert-success"><i class="fa fa-check-circle"></i> Koolitus edukalt lisatud andmebaasi! <a href="courseAdmin" class="font-weight-bold">Vaata nimekirja</a></div>';
                    } else {
                        echo '<div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> Viga koolituse lisamisel! Kontrollige välju.</div>';
                    }
                }
                ?>
                <form action="courseAddResult" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="font-weight-bold">Kursuse nimetus *</label>
                        <input type="text" name="title" class="form-control" required placeholder="nt. B-kategooria põhikursus (Manuaal)">
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Kategooria *</label>
                            <select name="idCategory" class="form-control" required>
                                <?php if (!empty($arr)): ?>
                                    <?php foreach ($arr as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Hind (€) *</label>
                            <input type="number" step="0.01" name="price" class="form-control" required placeholder="680.00">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="font-weight-bold">Käigukast</label>
                            <select name="transmission" class="form-control">
                                <option value="Manuaal">Manuaal</option>
                                <option value="Automaat">Automaat</option>
                                <option value="Mootorratas">Mootorratas</option>
                                <option value="Veoauto">Veoauto</option>
                                <option value="Kõik käigukastid">Kõik käigukastid</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Kestus ja maht</label>
                        <input type="text" name="duration" class="form-control" placeholder="nt. 6-8 nädalat (28h teooria + 30 sõidutundi)">
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Kirjeldus *</label>
                        <textarea name="description" class="form-control" rows="5" required placeholder="Koolituse programmi kirjeldus ja sisu..."></textarea>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Kaanepilt (JPG, PNG)</label>
                        <input type="file" name="picture" class="form-control-file">
                    </div>

                    <hr class="my-4">

                    <button type="submit" name="save" class="btn btn-success btn-lg px-4 font-weight-bold">
                        <i class="fa fa-save"></i> Salvesta koolitus
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
