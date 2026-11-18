<?php
class modelAdmin{
    // Авторизация админа
    public static function userAuthentication()
    {
        if (isset($_SESSION['sessionId'])){$logIn=true;
        }
        else{
            $logIn=false;
            if(isset($_POST['btnLogin']))
            {
                if(isset($_POST['email']) && isset($_POST['password']) && $_POST['email']!="" && $_POST['password']!=""){
                    $email = strtolower(trim($_POST['email']));
                    $password = $_POST['password'];
                    $sql = "SELECT * FROM `users` WHERE LOWER(`email`) = ? LIMIT 1";
                    $db = new database();
                    $item = $db->getOne($sql, [$email]);

                    if($item != null){
                        if ($email == strtolower($item['email']) && (password_verify($password, $item['password']) || $password === ($item['pass'] ?? '')))
                        {
                            $_SESSION['sessionId'] = session_id();
                            $_SESSION['userId'] = $item['id'];
                            $_SESSION['name'] = $item['username'];
                            $_SESSION['status'] = $item['status'];
                            $logIn = true;
                        }
                    }
                }
            }
        }
        return $logIn;
        //https://php.ru/manual/function.password-hash.html
        //https://php.ru/manual/function.password-verify.html
    }

    // выход из админки
    public static function userLogout()
    {
        unset($_SESSION['sessionId']);
        unset($_SESSION['userId']);
        unset($_SESSION['name']);
        unset($_SESSION['status']);
        session_destroy();
        return ;
    }

}
?>