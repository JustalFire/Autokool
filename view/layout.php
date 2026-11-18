<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DrivePro Autokool - Professionaalne Sõiduõpe</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<!-- TOP HEADER BAR -->
<div class="top-bar py-2 bg-dark text-white-50 border-bottom border-secondary small">
    <div class="container d-flex justify-content-between align-items-center flex-wrap">
        <div class="top-contact">
            <span class="mr-3"><i class="fa fa-phone text-warning"></i> +372 555 1234</span>
            <span class="mr-3"><i class="fa fa-envelope text-warning"></i> info@drivepro-autokool.ee</span>
            <span class="d-none d-md-inline"><i class="fa fa-map-marker text-warning"></i> Mustamäe tee 4, Tallinn</span>
        </div>
        <div class="top-right d-flex align-items-center">
            <!-- ADMIN LINK -->
            <a href="admin/" class="btn btn-outline-warning btn-sm py-0 px-2 font-weight-bold" style="font-size: 0.8rem;">
                <i class="fa fa-lock"></i> Administratsioon
            </a>
        </div>
    </div>
</div>

<!-- MAIN NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-navy sticky-top shadow-sm main-nav">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center font-weight-bold" href="./">
            <span class="brand-icon-box mr-2"><i class="fa fa-car"></i></span>
            <span class="brand-text">Drive<span class="text-warning">Pro</span> <small class="text-white-50 d-block font-weight-normal" style="font-size: 0.65rem; letter-spacing: 1px;">AUTOKOOL</small></span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbarNav" aria-controls="mainNavbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-uppercase" href="./">Avaleht</a>
                </li>
                <!-- Category Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold text-uppercase" href="#" id="coursesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Koolitused
                    </a>
                    <div class="dropdown-menu shadow-lg border-0 py-2" aria-labelledby="coursesDropdown">
                        <?php
                            Controller::AllCategories();
                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-uppercase" href="calculator">
                        <i class="fa fa-calculator text-warning"></i> Hinnakalkulaator
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link font-weight-bold text-uppercase" href="registerForm">Registreerimine</a>
                </li>
            </ul>

            <!-- Search Form -->
            <form class="form-inline my-2 my-lg-0 search-form" action="search" method="GET">
                <div class="input-group">
                    <input class="form-control form-control-sm border-0" type="search" name="otsi" placeholder="Otsi kursust..." aria-label="Otsi">
                    <div class="input-group-append">
                        <button class="btn btn-warning btn-sm" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>

<!-- MAIN CONTENT WRAPPER -->
<main class="py-4 main-content">
    <div class="container">
        <?php
        if (isset($_SESSION['flash_success'])) {
            echo '<div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fa fa-check-circle"></i> ' . $_SESSION['flash_success'] . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Sulge">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            unset($_SESSION['flash_success']);
        }
        if (isset($_SESSION['flash_error'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fa fa-exclamation-triangle"></i> ' . $_SESSION['flash_error'] . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Sulge">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            unset($_SESSION['flash_error']);
        }

        if (isset($content)) {
            echo $content;
        } else {
            echo '<div class="alert alert-warning">Sisu puudub!</div>';
        }
        ?>
    </div>
</main>

<!-- QUICK ENROLLMENT MODAL -->
<div class="modal fade" id="quickEnrollModal" tabindex="-1" role="dialog" aria-labelledby="quickEnrollModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content shadow-lg border-0 rounded-lg">
            <div class="modal-header bg-navy text-white">
                <h5 class="modal-title font-weight-bold" id="quickEnrollModalLabel">
                    <i class="fa fa-pencil-square-o text-warning mr-1"></i> Kiire registreerimine kursusele
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Sulge">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="enroll" method="POST">
                <div class="modal-body p-4">
                    <div class="form-group">
                        <label class="font-weight-bold text-secondary">Vali kursus *</label>
                        <select name="course_id" id="enrollCourseSelect" class="form-control" required>
                            <?php
                            $allC = Course::getAllCourses();
                            if (!empty($allC)) {
                                foreach ($allC as $ac) {
                                    echo '<option value="' . $ac['id'] . '">' . htmlspecialchars($ac['title']) . ' (' . number_format($ac['price'], 2) . ' €)</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-secondary">Täisnimi *</label>
                        <input type="text" name="name" class="form-control" required placeholder="nt. Peeter Tamm">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-secondary">E-posti aadress *</label>
                        <input type="email" name="email" class="form-control" required placeholder="nimi@e-post.ee">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold text-secondary">Telefoninumber *</label>
                        <input type="tel" name="phone" class="form-control" required placeholder="+372 555 12345">
                    </div>
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-secondary">Küsimused või eelistatud õppeaeg</label>
                        <textarea name="message" id="enrollMessage" class="form-control" rows="2" placeholder="Küsimused või eelistatud aeg..."></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Sulge</button>
                    <button type="submit" class="btn btn-warning font-weight-bold shadow-sm">
                        <i class="fa fa-check"></i> Kinnita registreerimine
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer bg-navy text-white pt-5 pb-3 mt-5 border-top border-warning" style="border-top-width: 4px !important;">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="font-weight-bold text-warning mb-3">
                    <i class="fa fa-car mr-2"></i>DrivePro Autokool
                </h5>
                <p class="text-white-50 small leading-relaxed">
                    Kaasaegsed õppesõidukid, professionaalsed instruktorid ning paindlik õppegraafik. Meie õpilaste riiklike sõidueksamite sooritamise edukus on üle 92%!
                </p>
                <div class="footer-badges">
                    <span class="badge badge-secondary py-1 px-2 mr-1">Transpordiameti koolitusluba nr 142/2020</span>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 mb-4">
                <h6 class="font-weight-bold text-uppercase text-white mb-3" style="letter-spacing: 1px;">Koolitused</h6>
                <ul class="list-unstyled footer-links small">
                    <li class="mb-2"><a href="category?id=1" class="text-white-50 hover-white">B-kategooria</a></li>
                    <li class="mb-2"><a href="category?id=2" class="text-white-50 hover-white">A-kategooria</a></li>
                    <li class="mb-2"><a href="category?id=3" class="text-white-50 hover-white">C-kategooria</a></li>
                    <li class="mb-2"><a href="category?id=4" class="text-white-50 hover-white">Lõppaste &amp; Esmaabi</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="font-weight-bold text-uppercase text-white mb-3" style="letter-spacing: 1px;">Kiirlingid</h6>
                <ul class="list-unstyled footer-links small">
                    <li class="mb-2"><a href="calculator" class="text-white-50 hover-white">Hinnakalkulaator</a></li>
                    <li class="mb-2"><a href="registerForm" class="text-white-50 hover-white">Registreerimine</a></li>
                    <li class="mb-2"><a href="admin/" class="text-white-50 hover-white">Administratsioon</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <h6 class="font-weight-bold text-uppercase text-white mb-3" style="letter-spacing: 1px;">Kontakt</h6>
                <ul class="list-unstyled text-white-50 small">
                    <li class="mb-2"><i class="fa fa-map-marker text-warning mr-2"></i> Mustamäe tee 4, Tallinn</li>
                    <li class="mb-2"><i class="fa fa-phone text-warning mr-2"></i> +372 555 1234</li>
                    <li class="mb-2"><i class="fa fa-envelope text-warning mr-2"></i> info@drivepro-autokool.ee</li>
                    <li class="mb-2"><i class="fa fa-clock-o text-warning mr-2"></i> E-R 09:00 - 18:00</li>
                </ul>
            </div>
        </div>
        <hr class="border-secondary my-3">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-left text-white-50 small">
                DrivePro Autokool &copy; <?php echo date('Y'); ?>. Kõik õigused kaitstud.
            </div>
            <div class="col-md-6 text-center text-md-right text-white-50 small">
                Tarkvaraarenduse projekt (PHP MVC / ISO-29148 &amp; ISO-26514)
            </div>
        </div>
    </div>
</footer>

<!-- JavaScript Dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// Dynamic Quick Enrollment Modal handler
$(document).ready(function() {
    $('.btn-quick-enroll').on('click', function(e) {
        e.preventDefault();
        var courseId = $(this).data('id');
        if (courseId) {
            $('#enrollCourseSelect').val(courseId);
        }
        $('#quickEnrollModal').modal('show');
    });
});
</script>

</body>
</html>
