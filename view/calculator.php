<?php
ob_start();
?>
<div class="calculator-page py-4">
    <div class="text-center mb-5">
        <span class="badge badge-warning text-dark font-weight-bold px-3 py-2 mb-2 uppercase tracking-wide">
            <i class="fa fa-calculator"></i> DrivePro Interaktiivne Tööriist
        </span>
        <h1 class="font-weight-bold display-5 text-dark">Interaktiivne Sõiduõppe Hinnakalkulaator</h1>
        <p class="lead text-muted mx-auto" style="max-width: 700px;">Koosta oma personaalne koolituspakett ja arvuta täpne maksumus reaalajas</p>
    </div>

    <div class="row">
        <!-- Calculator Form -->
        <div class="col-lg-7 mb-4">
            <div class="card shadow border-0 rounded-lg">
                <div class="card-body p-4 p-md-5">
                    <!-- Step 1: Category -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark h5 mb-3">
                            <span class="badge badge-primary rounded-circle mr-2" style="width: 28px; height: 28px; line-height: 20px;">1</span>
                            Vali soovitud kategooria
                        </label>
                        <div class="row">
                            <div class="col-sm-6 mb-2">
                                <label class="card category-choice-card p-3 border rounded cursor-pointer h-100 mb-0">
                                    <input type="radio" name="calc_cat" value="680" data-catname="B-kategooria" checked onchange="calculateTuition()">
                                    <strong class="d-block mt-2">B-kategooria (Sõiduauto)</strong>
                                    <small class="text-muted">Baashind alates 680 €</small>
                                </label>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="card category-choice-card p-3 border rounded cursor-pointer h-100 mb-0">
                                    <input type="radio" name="calc_cat" value="550" data-catname="A-kategooria" onchange="calculateTuition()">
                                    <strong class="d-block mt-2">A-kategooria (Mootorratas)</strong>
                                    <small class="text-muted">Baashind alates 550 €</small>
                                </label>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="card category-choice-card p-3 border rounded cursor-pointer h-100 mb-0">
                                    <input type="radio" name="calc_cat" value="790" data-catname="C-kategooria" onchange="calculateTuition()">
                                    <strong class="d-block mt-2">C-kategooria (Veoauto)</strong>
                                    <small class="text-muted">Baashind alates 790 €</small>
                                </label>
                            </div>
                            <div class="col-sm-6 mb-2">
                                <label class="card category-choice-card p-3 border rounded cursor-pointer h-100 mb-0">
                                    <input type="radio" name="calc_cat" value="140" data-catname="Lõppastmekoolitus" onchange="calculateTuition()">
                                    <strong class="d-block mt-2">Lõppastmekoolitus</strong>
                                    <small class="text-muted">Hind 140 €</small>
                                </label>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Step 2: Transmission -->
                    <div class="form-group mb-4">
                        <label class="font-weight-bold text-dark h5 mb-3">
                            <span class="badge badge-primary rounded-circle mr-2" style="width: 28px; height: 28px; line-height: 20px;">2</span>
                            Käigukast
                        </label>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gearManual" name="calc_gear" value="0" class="custom-control-input" checked onchange="calculateTuition()">
                            <label class="custom-control-label font-weight-bold" for="gearManual">Manuaalkäigukast (+0 €)</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="gearAuto" name="calc_gear" value="40" class="custom-control-input" onchange="calculateTuition()">
                            <label class="custom-control-label font-weight-bold" for="gearAuto">Automaatkäigukast (+40 €)</label>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Step 3: Extra driving lessons slider -->
                    <div class="form-group mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="font-weight-bold text-dark h5 mb-0">
                                <span class="badge badge-primary rounded-circle mr-2" style="width: 28px; height: 28px; line-height: 20px;">3</span>
                                Täiendavad sõidutunnid
                            </label>
                            <span class="badge badge-info p-2 font-weight-bold" id="lessonsCounterBadge">0 lisatundi (0 €)</span>
                        </div>
                        <p class="text-muted small mb-2">1 lisatund = 35 €</p>
                        <input type="range" class="custom-range" id="extraLessonsRange" min="0" max="15" step="1" value="0" oninput="calculateTuition()">
                        <div class="d-flex justify-content-between text-muted small">
                            <span>0 tundi</span>
                            <span>5 tundi</span>
                            <span>10 tundi</span>
                            <span>15 tundi</span>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Step 4: Add-on modules -->
                    <div class="form-group mb-2">
                        <label class="font-weight-bold text-dark h5 mb-3">
                            <span class="badge badge-primary rounded-circle mr-2" style="width: 28px; height: 28px; line-height: 20px;">4</span>
                            Lisamoodulid &amp; teenused
                        </label>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="addonFirstAid" value="55" onchange="calculateTuition()">
                            <label class="custom-control-label" for="addonFirstAid">
                                Esmaabikoolitus (16h) (+55 €)
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="addonSlippery" value="140" onchange="calculateTuition()">
                            <label class="custom-control-label" for="addonSlippery">
                                Pimeda ja libedasõidu riskivältimise koolitus (+140 €)
                            </label>
                        </div>
                        <div class="custom-control custom-checkbox mb-2">
                            <input type="checkbox" class="custom-control-input" id="addonTheory" value="0" checked disabled>
                            <label class="custom-control-label" for="addonTheory">
                                E-autokooli ligipääs ja õppematerjalid <span class="badge badge-success">Tasuta</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Result Summary Box -->
        <div class="col-lg-5">
            <div class="card shadow border-primary sticky-top" style="top: 25px;">
                <div class="card-header bg-dark text-white p-4 text-center">
                    <h5 class="text-warning text-uppercase tracking-wider mb-1 font-weight-bold">Kalkulatsiooni Kokkuvõte</h5>
                    <p class="small text-white-50 mb-0">Hinnale lisandub tasuta eksamikonsultatsioon</p>
                </div>
                <div class="card-body p-4">
                    <div class="text-center py-4 bg-light rounded mb-4 border">
                        <span class="text-muted d-block small mb-1">Kalkulatsiooni kogumaksumus:</span>
                        <div class="display-4 font-weight-bold text-primary mb-2" id="calcTotalPriceDisplay">680 €</div>
                        <div class="text-muted small">
                            Või osamaksetena alates: <strong class="text-dark" id="calcInstallmentDisplay">170.00 €</strong> / kuus (4 osamakset)
                        </div>
                    </div>

                    <ul class="list-group list-group-flush mb-4 small">
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Valitud kategooria baashind:</span>
                            <strong id="summaryBasePrice">680 €</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Käigukasti lisatasu:</span>
                            <strong id="summaryGearPrice">0 €</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Lisatunnid:</span>
                            <strong id="summaryLessonsPrice">0 €</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between px-0">
                            <span>Lisamoodulid (esmaabi / libedasõit):</span>
                            <strong id="summaryAddonsPrice">0 €</strong>
                        </li>
                    </ul>

                    <button type="button" class="btn btn-warning btn-lg btn-block font-weight-bold py-3 shadow" onclick="applyCalculatedPackage()">
                        <i class="fa fa-check-circle"></i> Registreeru selle paketiga
                    </button>
                    <p class="text-center text-muted small mt-3 mb-0">
                        <i class="fa fa-lock"></i> Registreerumine ei kohusta koheseks maksmiseks.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calculateTuition() {
    let basePrice = 680;
    let selectedCatName = 'B-kategooria';
    let catRadios = document.getElementsByName('calc_cat');
    for (let radio of catRadios) {
        if (radio.checked) {
            basePrice = parseFloat(radio.value);
            selectedCatName = radio.getAttribute('data-catname');
            break;
        }
    }

    let gearAddon = 0;
    let gearRadios = document.getElementsByName('calc_gear');
    for (let radio of gearRadios) {
        if (radio.checked) {
            gearAddon = parseFloat(radio.value);
            break;
        }
    }

    let lessonsCount = parseInt(document.getElementById('extraLessonsRange').value);
    let lessonsPrice = lessonsCount * 35;
    document.getElementById('lessonsCounterBadge').innerText = lessonsCount + ' lisatundi (' + lessonsPrice + ' €)';

    let addonsPrice = 0;
    if (document.getElementById('addonFirstAid').checked) addonsPrice += 55;
    if (document.getElementById('addonSlippery').checked) addonsPrice += 140;

    let total = basePrice + gearAddon + lessonsPrice + addonsPrice;
    let installment = (total / 4).toFixed(2);

    document.getElementById('calcTotalPriceDisplay').innerText = total + ' €';
    document.getElementById('calcInstallmentDisplay').innerText = installment + ' €';

    document.getElementById('summaryBasePrice').innerText = basePrice + ' €';
    document.getElementById('summaryGearPrice').innerText = gearAddon + ' €';
    document.getElementById('summaryLessonsPrice').innerText = lessonsPrice + ' €';
    document.getElementById('summaryAddonsPrice').innerText = addonsPrice + ' €';
}

function applyCalculatedPackage() {
    let catRadios = document.getElementsByName('calc_cat');
    let selectedCat = 'B-kategooria';
    for (let radio of catRadios) {
        if (radio.checked) {
            selectedCat = radio.getAttribute('data-catname');
            break;
        }
    }
    let total = document.getElementById('calcTotalPriceDisplay').innerText;
    let msg = 'Kalkulaatori pakett: ' + selectedCat + ', kogumaksumus ' + total + '.';

    let modal = $('#quickEnrollModal');
    if (modal.length) {
        modal.find('#enrollMessage').val(msg);
        modal.modal('show');
    } else {
        window.location.href = 'courses';
    }
}
</script>

<?php
$content = ob_get_clean();
include_once 'view/layout.php';
?>
