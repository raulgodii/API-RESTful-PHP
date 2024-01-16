<?php

namespace Utils;

class Utils
{
    /**
     * Elimina variable de sesión.
     *
     * @param string $name
     */
    public static function deleteSession(string $name): void
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
    }
}