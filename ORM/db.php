<?php

namespace ORM;

class db
{
    private const hostname = 'localhost';
    private const username= 'root';
    private const password = '';
    private const database = 'kinopoiskdb';
    private static $instance;
    private function __construct()
    {
    }

    public static function getInstance() {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function connect() : \mysqli {
        return new \mysqli(self::hostname, self::username, self::password, self::database);
    }
}