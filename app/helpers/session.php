<?php
class SessionHelper {
    
    public static function start() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function destroy() {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }
    
    public static function set($key, $value) {
        self::start();
        $_SESSION[$key] = $value;
    }
    
    public static function get($key, $default = null) {
        self::start();
        return $_SESSION[$key] ?? $default;
    }
    
    public static function has($key) {
        self::start();
        return isset($_SESSION[$key]);
    }
    
    public static function remove($key) {
        self::start();
        unset($_SESSION[$key]);
    }
    
    public static function isLoggedIn() {
        return self::has('user_id');
    }
    
    public static function getUserRole() {
        return self::get('user_role');
    }
    
    public static function getUserId() {
        return self::get('user_id');
    }
    
    public static function getUserName() {
        return self::get('user_name');
    }
}
?>
