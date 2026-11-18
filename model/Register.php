<?php
class Register {

    public static function registerUser() {
        $control = [0 => false, 1 => 'error'];
        if (isset($_POST['save'])) {
            $errorString = "";
            $name = trim(strip_tags($_POST['name'] ?? ''));
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            
            if (empty($name)) {
                $errorString .= "Palun sisestage nimi.<br />";
            }
            if (!$email) {
                $errorString .= "Vigane e-posti aadress.<br />";
            }
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm'] ?? '';
            if (!$password || !$confirm || mb_strlen($password) < 6) {
                $errorString .= "Parool peab olema vähemalt 6 sümbolit pikk.<br />";
            }
            if ($password !== $confirm) {
                $errorString .= "Paroolid ei kattu.<br />";
            }

            if (mb_strlen($errorString) === 0) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $date = date("Y-m-d");
                $nameEsc = addslashes($name);
                $emailEsc = addslashes($email);
                $passEsc = addslashes($password);

                $sql = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `status`, `registration_date`, `pass`) 
                        VALUES (NULL, '$nameEsc', '$emailEsc', '$passwordHash', 'user', '$date', '$passEsc')";
                $db = new Database();
                $item = $db->executeRun($sql);
                if ($item) {
                    $control = [0 => true];
                } else {
                    $control = [0 => false, 1 => 'Viga salvestamisel andmebaasi.'];
                }
            } else {
                $control = [0 => false, 1 => $errorString];
            }
        }
        return $control;
    }
}
?>
