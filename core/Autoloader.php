<?php
//namespace Core;

class Autoloader {

    public function register() {
        spl_autoload_register(function ($class) {
            $class = str_replace('\\', '/', $class);
            require ROOT . '/' . $class . '.php';
        });
    }

}