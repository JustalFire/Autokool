<?php
ob_start();
$db = new Database();
$coursesCount = $db->getOne("SELECT COUNT(*) as c FROM `courses`")['c'] ?? 0;
$catCount = $db->getOne("SELECT COUNT(*) as c FROM `categories`")['c'] ?? 0;
$regCount = $db->getOne("SELECT COUNT(*) as c FROM `registrations`")['c'] ?? 0;
$revCount = $db->getOne("SELECT COUNT(*) as c FROM `reviews`")['c'] ?? 0;
?>
<div class="admin-dashboard-welcome mb-4">
    <h2 class="font-weight-bold text-dark mb-1"><i class="fa fa-tachometer text-primary"></i> Tere tulemast, <?php echo htmlspecialchars($_SESSION['name'] ?? 'Admin'); ?>!</h2>
    <p class="text-muted">DrivePro Autokooli juhtimissüsteemi ülevaade ja kiirstatistika</p>
</div>

<!-- Stat Cards -->
<div class="row mb-4">
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card shadow-sm border-0 bg-primary text-white p-3 rounded">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-white-50 small font-weight-bold">Aktiivsed kursused</h6>
                    <h2 class="font-weight-bold mb-0"><?php echo $coursesCount; ?></h2>
                </div>
                <i class="fa fa-car fa-3x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card shadow-sm border-0 bg-success text-white p-3 rounded">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-white-50 small font-weight-bold">Kategooriad</h6>
                    <h2 class="font-weight-bold mb-0"><?php echo $catCount; ?></h2>
                </div>
                <i class="fa fa-folder-open fa-3x text-white-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card shadow-sm border-0 bg-warning text-dark p-3 rounded">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-dark small font-weight-bold">Uued avaldused</h6>
                    <h2 class="font-weight-bold mb-0"><?php echo $regCount; ?></h2>
                </div>
                <i class="fa fa-users fa-3x text-dark" style="opacity: 0.4;"></i>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 mb-3">
        <div class="card shadow-sm border-0 bg-info text-white p-3 rounded">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-uppercase text-white-50 small font-weight-bold">Arvustused</h6>
                    <h2 class="font-weight-bold mb-0"><?php echo $revCount; ?></h2>
                </div>
                <i class="fa fa-comments fa-3x text-white-50"></i>
            </div>
        </div>
    </div>
</div>

<!-- Quick actions -->
<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0 h-100 p-4">
            <h5 class="font-weight-bold text-dark mb-3"><i class="fa fa-bolt text-warning mr-1"></i> Kiirtoimingud</h5>
            <div class="d-flex flex-wrap gap-2">
                <a href="courseAdd" class="btn btn-primary mr-2 mb-2 font-weight-bold"><i class="fa fa-plus"></i> Lisa uus koolitus</a>
                <a href="courseAdmin" class="btn btn-outline-primary mr-2 mb-2 font-weight-bold"><i class="fa fa-list"></i> Kursuste nimekiri</a>
                <a href="registrationsAdmin" class="btn btn-outline-warning text-dark mr-2 mb-2 font-weight-bold"><i class="fa fa-envelope"></i> Vaata avaldusi</a>
                <a href="../" target="_blank" class="btn btn-outline-secondary mb-2 font-weight-bold"><i class="fa fa-external-link"></i> Ava veebileht</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card shadow-sm border-0 h-100 p-4">
            <h5 class="font-weight-bold text-dark mb-3"><i class="fa fa-info-circle text-info mr-1"></i> Süsteemi info</h5>
            <ul class="list-unstyled mb-0 small text-muted">
                <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> Andmebaas: <strong>autokool</strong> (MySQL utf8mb4)</li>
                <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> Mitmekeelsus: <strong>Eesti keel (ET) / Vene keel (RU)</strong></li>
                <li class="mb-2"><i class="fa fa-check text-success mr-2"></i> Standardid: <strong>ISO-29148 / ISO-26514</strong></li>
                <li><i class="fa fa-check text-success mr-2"></i> Versioon: <strong>Autokool MVC v2.0</strong></li>
            </ul>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
include "viewAdmin/templates/layout.php";
?>
