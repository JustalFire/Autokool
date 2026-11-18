<?php
ob_start();
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="font-weight-bold text-dark mb-0"><i class="fa fa-users text-primary"></i> Veebilehelt saabunud kursuste avaldused</h2>
    <a href="courseAdmin" class="btn btn-outline-primary"><i class="fa fa-arrow-left"></i> Kursuste haldus</a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Soovitud kursus</th>
                        <th>Kandidaadi nimi</th>
                        <th>E-post</th>
                        <th>Telefon</th>
                        <th>Lisainfo / Sõnum</th>
                        <th>Staatus</th>
                        <th>Kuupäev</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($registrations)): ?>
                        <?php foreach ($registrations as $r): ?>
                            <tr>
                                <td class="font-weight-bold text-muted"><?php echo $r['id']; ?></td>
                                <td>
                                    <strong class="text-primary"><?php echo htmlspecialchars($r['title'] ?? 'Üldine'); ?></strong>
                                </td>
                                <td><strong class="text-dark"><?php echo htmlspecialchars($r['name']); ?></strong></td>
                                <td><a href="mailto:<?php echo htmlspecialchars($r['email']); ?>"><?php echo htmlspecialchars($r['email']); ?></a></td>
                                <td><a href="tel:<?php echo htmlspecialchars($r['phone']); ?>"><?php echo htmlspecialchars($r['phone']); ?></a></td>
                                <td><small class="text-muted"><?php echo htmlspecialchars($r['message'] ?? '-'); ?></small></td>
                                <td>
                                    <?php if ($r['status'] == 'uus'): ?>
                                        <span class="badge badge-warning text-dark font-weight-bold">Uus</span>
                                    <?php else: ?>
                                        <span class="badge badge-success font-weight-bold">Kinnitatud</span>
                                    <?php endif; ?>
                                </td>
                                <td><small class="text-muted"><?php echo date('d.m.Y H:i', strtotime($r['created_at'])); ?></small></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Avaldusi ei ole veel laekunud.</td>
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
