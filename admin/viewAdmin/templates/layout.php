<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DrivePro Autokool - Administratsioon</title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/font-awesome.min.css" rel="stylesheet">
    <link href="public/css/mystyle.css" rel="stylesheet">
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <style>
        body { background-color: #f8fafc; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        .admin-header { background: #0f1e36; border-radius: 8px; margin-top: 15px; margin-bottom: 25px; padding: 15px 20px; }
        .admin-nav-links a { color: #e2e8f0; font-weight: 600; text-decoration: none; padding: 6px 14px; border-radius: 6px; margin-right: 5px; }
        .admin-nav-links a:hover { background: rgba(255,255,255,0.15); color: #f59e0b; }
        .footer { margin-top: 50px; padding: 20px 0; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION["userId"]) && isset($_SESSION["sessionId"])): ?>
            <div class="admin-header clearfix d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <span class="text-warning font-weight-bold mr-3" style="font-size: 1.2rem;">
                        <i class="fa fa-car mr-1"></i> DrivePro Admin
                    </span>
                    <div class="admin-nav-links d-inline">
                        <a href="../" target="_blank"><i class="fa fa-globe"></i> Veebisait</a>
                        <a href="courseAdmin"><i class="fa fa-book"></i> Kursuste haldus</a>
                        <a href="courseAdd"><i class="fa fa-plus-circle"></i> Lisa kursus</a>
                        <a href="registrationsAdmin"><i class="fa fa-users"></i> Avaldused</a>
                    </div>
                </div>
                <div>
                    <span class="text-white mr-2"><i class="fa fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION["name"] ?? 'Admin'); ?></span>
                    <a href="logout" class="btn btn-sm btn-outline-warning"><i class="fa fa-sign-out"></i> Välju</a>
                </div>
            </div>
        <?php endif; ?>

        <div id="content">
            <?php echo $content ?? ''; ?>
        </div>

        <footer class="footer text-center">
            <p>&copy; <?php echo date('Y'); ?> DrivePro Autokool - Administratiivne juhtpaneel (PHP MVC)</p>
        </footer>
    </div>
</body>
</html>
