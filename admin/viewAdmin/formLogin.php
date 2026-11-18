<?php
if (!empty($_SESSION['userId']) && !empty($_SESSION['sessionId']) && ($_SESSION['status'] ?? '') === 'admin') {
    header('Location: courseAdmin');
    exit();
}
$curLang = Lang::current();
?>
<!DOCTYPE html>
<html lang="<?php echo $curLang; ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo __('admin_panel_title'); ?> - <?php echo __('admin_login_btn'); ?></title>
    <link href="public/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body { background: #0f1e36; height: 100vh; display: flex; align-items: center; justify-content: center; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        .login-box { max-width: 420px; width: 100%; padding: 35px; background: #ffffff; border-radius: 12px; box-shadow: 0 15px 35px rgba(0,0,0,0.3); position: relative; }
        .brand-logo { font-size: 2.2rem; color: #1e3a8a; }
        .lang-switch { position: absolute; top: 15px; right: 15px; font-size: 0.8rem; }
        .lang-switch a { padding: 2px 6px; border-radius: 4px; text-decoration: none; font-weight: 700; color: #64748b; }
        .lang-switch a.active { background: #f59e0b; color: #0f1e36; }
    </style>
</head>
<body>
    <div class="login-box">
        <div class="lang-switch">
            <a href="?lang=et" class="<?php echo $curLang === 'et' ? 'active' : ''; ?>">EST</a>
            <span class="text-muted">|</span>
            <a href="?lang=ru" class="<?php echo $curLang === 'ru' ? 'active' : ''; ?>">RUS</a>
        </div>
        <div class="text-center mb-4">
            <div class="brand-logo mb-1"><i class="fa fa-car text-warning"></i></div>
            <h4 class="font-weight-bold text-dark mb-1">DrivePro Autokool</h4>
            <p class="text-muted small"><?php echo __('admin_login_title'); ?></p>
        </div>

        <?php if (isset($_SESSION['errorString'])): ?>
            <div class="alert alert-danger py-2 small">
                <i class="fa fa-exclamation-circle"></i> <?php echo $_SESSION['errorString']; unset($_SESSION['errorString']); ?>
            </div>
        <?php endif; ?>

        <form action="login" method="POST">
            <div class="form-group mb-3">
                <label class="font-weight-bold text-secondary small"><?php echo __('email'); ?></label>
                <input type="email" name="email" class="form-control" required placeholder="admin@autokool.ee" autofocus value="admin@autokool.ee">
            </div>
            <div class="form-group mb-4">
                <label class="font-weight-bold text-secondary small"><?php echo __('password'); ?></label>
                <input type="password" name="password" class="form-control" required placeholder="••••••••" value="123456">
            </div>
            <button class="btn btn-warning btn-block font-weight-bold py-2 shadow-sm" type="submit" name="btnLogin">
                <i class="fa fa-sign-in"></i> <?php echo __('admin_login_btn'); ?>
            </button>
        </form>

        <div class="mt-4 pt-3 border-top text-center small text-muted">
            <a href="../" class="text-primary font-weight-bold"><i class="fa fa-arrow-left"></i> <?php echo __('admin_back_to_site'); ?></a>
        </div>
    </div>
</body>
</html>
