<?php
$currentUri = $_SERVER['REQUEST_URI'];
$uriParts = parse_url($currentUri);
parse_str($uriParts['query'] ?? '', $queryArr);
$queryArrEt = array_merge($queryArr, ['lang' => 'et']);
$queryArrRu = array_merge($queryArr, ['lang' => 'ru']);
$urlEt = ($uriParts['path'] ?? '') . '?' . http_build_query($queryArrEt);
$urlRu = ($uriParts['path'] ?? '') . '?' . http_build_query($queryArrRu);
$curLang = Lang::current();
?>
<!DOCTYPE html>
<html lang="<?php echo $curLang; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo __('admin_panel_title'); ?></title>
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
        .lang-switcher .lang-link { color: #cbd5e1; font-weight: 700; font-size: 0.85rem; padding: 3px 8px; border-radius: 4px; text-decoration: none; }
        .lang-switcher .lang-link:hover { color: #ffffff; background: rgba(255,255,255,0.15); }
        .lang-switcher .active-lang { color: #0f1e36 !important; background: #f59e0b !important; }
        .footer { margin-top: 50px; padding: 20px 0; border-top: 1px solid #e2e8f0; color: #64748b; font-size: 0.9rem; }
    </style>
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION["userId"]) && isset($_SESSION["sessionId"])): ?>
            <div class="admin-header clearfix d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center mb-2 mb-md-0 flex-wrap">
                    <span class="text-warning font-weight-bold mr-3" style="font-size: 1.2rem;">
                        <i class="fa fa-car mr-1"></i> <?php echo __('admin_brand'); ?>
                    </span>
                    <div class="admin-nav-links d-inline">
                        <a href="../" target="_blank"><i class="fa fa-globe"></i> <?php echo __('admin_nav_site'); ?></a>
                        <a href="courseAdmin"><i class="fa fa-book"></i> <?php echo __('admin_nav_courses'); ?></a>
                        <a href="courseAdd"><i class="fa fa-plus-circle"></i> <?php echo __('admin_nav_add_course'); ?></a>
                        <a href="registrationsAdmin"><i class="fa fa-users"></i> <?php echo __('admin_nav_registrations'); ?></a>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <!-- LANGUAGE SWITCHER -->
                    <div class="lang-switcher mr-3">
                        <i class="fa fa-globe text-warning mr-1"></i>
                        <a href="<?php echo htmlspecialchars($urlEt); ?>" class="lang-link <?php echo $curLang === 'et' ? 'active-lang' : ''; ?>">EST</a>
                        <span class="text-secondary">|</span>
                        <a href="<?php echo htmlspecialchars($urlRu); ?>" class="lang-link <?php echo $curLang === 'ru' ? 'active-lang' : ''; ?>">RUS</a>
                    </div>
                    <span class="text-white mr-3"><i class="fa fa-user-circle"></i> <?php echo htmlspecialchars($_SESSION["name"] ?? 'Admin'); ?></span>
                    <a href="logout" class="btn btn-sm btn-outline-warning"><i class="fa fa-sign-out"></i> <?php echo __('admin_nav_logout'); ?></a>
                </div>
            </div>
        <?php endif; ?>

        <div id="content">
            <?php echo $content ?? ''; ?>
        </div>

        <footer class="footer text-center">
            <p>&copy; <?php echo date('Y'); ?> DrivePro Autokool - <?php echo __('admin_login_title'); ?> (PHP MVC)</p>
        </footer>
    </div>
</body>
</html>
