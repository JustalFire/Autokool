<?php
class Lang {
    private static $translations = [];
    private static $currentLang = 'et';

    public static function init() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_GET['lang']) && in_array($_GET['lang'], ['et', 'ru'])) {
            $_SESSION['lang'] = $_GET['lang'];
        }
        self::$currentLang = isset($_SESSION['lang']) && in_array($_SESSION['lang'], ['et', 'ru']) ? $_SESSION['lang'] : 'et';

        $file = __DIR__ . '/../lang/' . self::$currentLang . '.php';
        if (file_exists($file)) {
            self::$translations = include $file;
        } else {
            self::$translations = [];
        }
    }

    public static function get($key, $default = '') {
        return self::$translations[$key] ?? ($default !== '' ? $default : $key);
    }

    public static function current() {
        return self::$currentLang;
    }
}

if (!function_exists('__')) {
    function __($key, $default = '') {
        return Lang::get($key, $default);
    }
}
