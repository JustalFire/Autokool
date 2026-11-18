<?php
ob_start();
?>
<!-- HERO SECTION -->
<div class="jumbotron hero-section text-white p-4 p-md-5 rounded shadow mb-5">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <span class="badge badge-warning text-dark font-weight-bold px-3 py-2 mb-3 text-uppercase">
                <i class="fa fa-shield"></i> Tunnustatud ja litsentseeritud autokool Eestis
            </span>
            <h1 class="display-4 font-weight-bold mb-3">Õpi sõitma enesekindlalt, mugavalt ja turvaliselt</h1>
            <p class="lead mb-4 text-white-50">Kaasaegsed õppesõidukid, professionaalsed instruktorid ning paindlik õppegraafik. Meie õpilaste eksamite sooritamise edukus on üle 92%!</p>
            <div class="hero-actions d-flex flex-wrap gap-3">
                <a href="courses" class="btn btn-warning btn-lg font-weight-bold mr-3 mb-2 shadow">
                    <i class="fa fa-car"></i> Tutvu koolitustega
                </a>
                <a href="calculator" class="btn btn-outline-light btn-lg font-weight-bold mb-2">
                    <i class="fa fa-calculator"></i> Arvuta hind kalkulaatoris
                </a>
            </div>
        </div>
        <div class="col-lg-4 d-none d-lg-block text-center">
            <div class="hero-badge-card p-4 rounded bg-dark-translucent border border-secondary shadow-lg">
                <div class="display-3 font-weight-bold text-warning mb-1">92%</div>
                <div class="text-white font-weight-bold h5">Riikliku eksami sooritatavus</div>
                <hr class="border-secondary">
                <div class="small text-white-50"><i class="fa fa-users text-warning"></i> Üle 1500 rahuloleva lõpetaja</div>
            </div>
        </div>
    </div>
</div>

<!-- ADVANTAGES / FEATURES -->
<div class="features-section mb-5">
    <div class="row">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card h-100 border-0 shadow-sm feature-card p-3 text-center">
                <div class="feature-icon mb-2 text-primary"><i class="fa fa-car fa-2x"></i></div>
                <h6 class="font-weight-bold">Kaasaegne autopark</h6>
                <p class="text-muted small mb-0">Uued mugavad Toyota Corolla ja VW Golf õppesõidukid turvaliseks õppeks.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card h-100 border-0 shadow-sm feature-card p-3 text-center">
                <div class="feature-icon mb-2 text-success"><i class="fa fa-id-card-o fa-2x"></i></div>
                <h6 class="font-weight-bold">Kogenud instruktorid</h6>
                <p class="text-muted small mb-0">Kannatlikud ja professionaalsed sõiduõpetajad.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card h-100 border-0 shadow-sm feature-card p-3 text-center">
                <div class="feature-icon mb-2 text-warning"><i class="fa fa-clock-o fa-2x"></i></div>
                <h6 class="font-weight-bold">Paindlik ajagraafik</h6>
                <p class="text-muted small mb-0">Sõidutunnid hommikust õhtuni ning nädalavahetustel vastavalt teie ajale.</p>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card h-100 border-0 shadow-sm feature-card p-3 text-center">
                <div class="feature-icon mb-2 text-info"><i class="fa fa-credit-card fa-2x"></i></div>
                <h6 class="font-weight-bold">Osamaksete võimalus</h6>
                <p class="text-muted small mb-0">Tasuge koolituse eest mugavalt kuni neljas osas ilma lisaintressita.</p>
            </div>
        </div>
    </div>
</div>

<!-- POPULAR COURSES -->
<div class="courses-preview-section mb-5">
    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap">
        <div>
            <h2 class="font-weight-bold text-dark mb-1">Populaarsemad koolitused</h2>
            <p class="text-muted mb-0">Alusta sõiduõppega kõige nõutavamatel kategooriatel</p>
        </div>
        <a href="courses" class="btn btn-outline-primary font-weight-bold mt-2 mt-sm-0">
            Kõik kursused <i class="fa fa-arrow-right"></i>
        </a>
    </div>

    <?php
    ViewCourses::CoursesCards($arr);
    ?>
</div>

<!-- CALL TO ACTION BANNER -->
<div class="card bg-primary text-white border-0 shadow-lg p-4 p-md-5 mb-5 rounded-lg text-center position-relative overflow-hidden">
    <h2 class="font-weight-bold mb-3">Oled valmis rooli istuma?</h2>
    <p class="lead mb-4 mx-auto" style="max-width: 650px;">
        Registreeru esimesele sõidutunnile või vali endale sobiv koolituspakett juba täna!
    </p>
    <div>
        <button type="button" class="btn btn-warning btn-lg font-weight-bold px-4 py-3 shadow btn-quick-enroll" data-id="1" data-title="B-kategooria">
            <i class="fa fa-pencil-square-o"></i> Registreeru kursusele
        </button>
    </div>
</div>

<?php
$content = ob_get_clean();
include_once 'view/layout.php';
?>
