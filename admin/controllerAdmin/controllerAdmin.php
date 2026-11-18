<?php
class controllerAdmin {

    public static function formLoginSite() {
        if (!empty($_SESSION['sessionId']) && !empty($_SESSION['userId']) && ($_SESSION['status'] ?? '') === 'admin') {
            header('Location: courseAdmin');
            exit();
        }
        include_once('viewAdmin/formLogin.php');
    }

    // Форма авторизации админа
    public static function loginAction() {
        $logIn = modelAdmin::userAuthentication();
        if (isset($logIn) && $logIn === true) {
            if (($_SESSION['status'] ?? '') === 'admin') {
                header('Location: courseAdmin');
                exit();
            } else {
                modelAdmin::userLogout();
                $isRu = (class_exists('Lang') && Lang::current() === 'ru');
                $_SESSION['errorString'] = $isRu 
                    ? 'У вас нет прав администратора для входа в панель.' 
                    : 'Teil puuduvad administraatori õigused.';
                include_once('viewAdmin/formLogin.php');
            }
        }
        else {
            $isRu = (class_exists('Lang') && Lang::current() === 'ru');
            $_SESSION['errorString'] = $isRu 
                ? 'Неправильное имя пользователя или пароль' 
                : 'Vale kasutajanimi või parool';
            include_once('viewAdmin/formLogin.php');
        }
    }

    // Выход из админ панели
    public static function logoutAction() {
        modelAdmin::userLogout();
        include_once('viewAdmin/formLogin.php');
    }

    // Страница Error
    public static function error404() {
        include_once('viewAdmin/error404.php');
    }

}
?>
