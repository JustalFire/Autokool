<?php
class Register {

    public static function registerUser() {
        $control = [0 => false, 1 => 'error'];
        if (isset($_POST['save'])) {
            $errorString = "";
            $name = trim(strip_tags($_POST['name'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $isRu = (class_exists('Lang') && Lang::current() === 'ru');
            
            if (empty($name)) {
                $errorString .= $isRu ? "Пожалуйста, укажите ваше имя.<br />" : "Palun sisestage oma nimi.<br />";
            }
            if (!$email) {
                $errorString .= $isRu ? "Укажите корректный адрес электронной почты.<br />" : "Palun sisestage kehtiv e-posti aadress.<br />";
            } else {
                // Pre-check for duplicate email in database
                $db = new Database();
                $existingUser = $db->getOne("SELECT `id`, `username` FROM `users` WHERE LOWER(`email`) = ? LIMIT 1", [strtolower($email)]);
                if ($existingUser) {
                    $errorString .= $isRu 
                        ? "Пользователь с адресом <strong>" . htmlspecialchars($email) . "</strong> уже зарегистрирован. Пожалуйста, используйте другой e-mail или выполните вход.<br />" 
                        : "Selle e-posti aadressiga (<strong>" . htmlspecialchars($email) . "</strong>) kasutaja on juba registreeritud. Palun logige sisse või kasutage teist e-posti.<br />";
                }
            }

            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm'] ?? '';
            if (!$password || mb_strlen($password) < 6) {
                $errorString .= $isRu ? "Пароль должен содержать не менее 6 символов.<br />" : "Parool peab olema vähemalt 6 sümbolit pikk.<br />";
            }
            if ($password !== $confirm) {
                $errorString .= $isRu ? "Пароли не совпадают.<br />" : "Paroolid ei kattu.<br />";
            }

            if (mb_strlen($errorString) === 0) {
                try {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $date = date("Y-m-d");

                    $sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`, `registration_date`) 
                            VALUES (NULL, ?, ?, ?, 'user', ?)";
                    $db = new Database();
                    $item = $db->executeRun($sql, [
                        $name,
                        strtolower($email),
                        $passwordHash,
                        $date
                    ]);
                    if ($item) {
                        $control = [0 => true];
                    } else {
                        $control = [0 => false, 1 => $isRu ? 'Ошибка сохранения данных в базе.' : 'Viga andmete salvestamisel andmebaasi.'];
                    }
                } catch (PDOException $e) {
                    // Catch integrity constraint violation (duplicate key 1062)
                    if ($e->getCode() == 23000 || strpos($e->getMessage(), '1062') !== false) {
                        $control = [0 => false, 1 => $isRu 
                            ? 'Пользователь с таким e-mail адресом уже существует в системе.' 
                            : 'Selle e-posti aadressiga kasutaja on juba süsteemis olemas.'];
                    } else {
                        $control = [0 => false, 1 => $isRu 
                            ? 'Произошла ошибка при сохранении: ' . htmlspecialchars($e->getMessage()) 
                            : 'Viga andmebaasiga suhtlemisel: ' . htmlspecialchars($e->getMessage())];
                    }
                }
            } else {
                $control = [0 => false, 1 => $errorString];
            }
        }
        return $control;
    }
}
?>