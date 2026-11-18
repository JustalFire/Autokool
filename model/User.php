<?php
class User {

    const MAX_LOGIN_ATTEMPTS = 5;
    const LOCKOUT_MINUTES = 10;

    public static function login() {
        $isRu = (class_exists('Lang') && Lang::current() === 'ru');
        $lockoutSeconds = self::LOCKOUT_MINUTES * 60;

        if (!isset($_SESSION['login_attempts'])) {
            $_SESSION['login_attempts'] = 0;
        }

        // 1. Check if user is currently locked out
        if ($_SESSION['login_attempts'] >= self::MAX_LOGIN_ATTEMPTS) {
            $lastAttempt = $_SESSION['last_login_attempt_time'] ?? time();
            $elapsed = time() - $lastAttempt;
            if ($elapsed < $lockoutSeconds) {
                $remainingMinutes = ceil(($lockoutSeconds - $elapsed) / 60);
                $msg = $isRu
                    ? "Слишком много неверных попыток (более 5). Вход заблокирован в целях безопасности. Пожалуйста, повторите попытку через $remainingMinutes мин."
                    : "Liiga palju ebaõnnestunud katseid (üle 5). Sisselogimine on turvalisuse huvides lukustatud. Proovige uuesti $remainingMinutes min pärast.";
                return [false, $msg];
            } else {
                // Lockout time expired, reset counter
                $_SESSION['login_attempts'] = 0;
                unset($_SESSION['last_login_attempt_time']);
            }
        }

        // 2. Validate input fields
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = $_POST['password'] ?? '';

        if (!$email || empty($password)) {
            return [false, $isRu ? "Пожалуйста, введите корректный e-mail и пароль." : "Palun sisestage kehtiv e-post ja parool."];
        }

        // 3. Find user in database
        $db = new Database();
        $user = $db->getOne("SELECT * FROM `users` WHERE LOWER(`email`) = ? LIMIT 1", [strtolower($email)]);

        $authenticated = false;
        if ($user) {
            if (password_verify($password, $user['password']) || $password === ($user['pass'] ?? '')) {
                $authenticated = true;
            }
        }

        if ($authenticated) {
            // Reset attempts on successful login
            $_SESSION['login_attempts'] = 0;
            unset($_SESSION['last_login_attempt_time']);

            $_SESSION['userId'] = $user['id'];
            $_SESSION['name'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['status'] = $user['status'];
            $_SESSION['sessionId'] = session_id();

            return [true, $user];
        } else {
            $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;
            $_SESSION['last_login_attempt_time'] = time();

            $remainingAttempts = self::MAX_LOGIN_ATTEMPTS - $_SESSION['login_attempts'];

            if ($remainingAttempts > 0) {
                $msg = $isRu
                    ? "Неверный e-mail или пароль! Осталось попыток: $remainingAttempts из " . self::MAX_LOGIN_ATTEMPTS . "."
                    : "Vale e-post või parool! Jäänud katseid: $remainingAttempts " . self::MAX_LOGIN_ATTEMPTS . "-st.";
            } else {
                $msg = $isRu
                    ? "Вы ввели неверный пароль 5 раз. Вход заблокирован на " . self::LOCKOUT_MINUTES . " минут!"
                    : "Olete sisestanud vale parooli 5 korda järjest. Sisselogimine on lukustatud " . self::LOCKOUT_MINUTES . " minutiks!";
            }

            return [false, $msg];
        }
    }

    public static function logout() {
        unset($_SESSION['userId']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['status']);
        unset($_SESSION['sessionId']);
    }

    public static function isLoggedIn() {
        return !empty($_SESSION['userId']) && !empty($_SESSION['sessionId']);
    }

    public static function currentUser() {
        if (self::isLoggedIn()) {
            return [
                'id' => $_SESSION['userId'],
                'name' => $_SESSION['name'] ?? '',
                'email' => $_SESSION['email'] ?? '',
                'status' => $_SESSION['status'] ?? 'user'
            ];
        }
        return null;
    }
}
?>