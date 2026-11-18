<?php
ob_start();
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold text-dark mb-0"><i class="fa fa-list text-primary"></i> Koolituste ja kursuste nimekiri</h2>
    <a href="courseAdd" class="btn btn-success font-weight-bold"><i class="fa fa-plus"></i> Lisa uus koolitus</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 80px;">Pilt</th>
                        <th>Koolituse nimetus</th>
                        <th>Kategooria</th>
                        <th>Hind</th>
                        <th>Kestus</th>
                        <th>Käigukast</th>
                        <th style="width: 150px;" class="text-center">Tegevused</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($arr)): ?>
                        <?php foreach ($arr as $row): ?>
                            <tr>
                                <td class="font-weight-bold text-muted"><?php echo $row['id']; ?></td>
                                <td>
                                    <?php if (!empty($row['picture'])): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['picture']); ?>" class="img-thumbnail" style="width: 65px; height: 45px; object-fit: cover;">
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Puudub</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong class="d-block text-dark"><?php echo htmlspecialchars(!empty($row['title_et']) ? $row['title_et'] : ($row['title'] ?? '')); ?></strong>
                                    <?php if (!empty($row['title_ru'])): ?>
                                        <small class="text-muted"><i class="fa fa-globe text-warning"></i> <?php echo htmlspecialchars($row['title_ru']); ?></small>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-info"><?php echo htmlspecialchars($row['category_name'] ?? 'Määramata'); ?></span></td>
                                <td><strong class="text-primary"><?php echo number_format($row['price'], 2); ?> €</strong></td>
                                <td><small><?php echo htmlspecialchars(!empty($row['duration_et']) ? $row['duration_et'] : ($row['duration'] ?? '')); ?></small></td>
                                <td><span class="badge badge-light border"><?php echo htmlspecialchars(!empty($row['transmission_et']) ? $row['transmission_et'] : ($row['transmission'] ?? 'Manuaal')); ?></span></td>
                                <td class="text-center">
                                    <a href="courseEdit?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary mr-1" title="Muuda"><i class="fa fa-pencil"></i></a>
                                    <a href="courseDel?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" title="Kustuta"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Ühtegi kursust ei leitud.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include_once 'viewAdmin/templates/layout.php';
?>
