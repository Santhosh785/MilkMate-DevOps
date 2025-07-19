<?php

class Session
{
    public static function Start()
    {

        session_start();
    }

    public static function Unset()
    {
        session_unset();
    }
    public static function Destroy()
    {

        session_destroy();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function delete($key)
    {
        unset($_SERVER[$key]);
    }
    public static function isset($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function get($key, $default = false)
    {
        if (Session::isset($key)) {
            return $_SESSION[$key];
        } else {
            return $default;
        }
    }
}
