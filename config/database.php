<?php

class Database
{
    private static $instance = null;

    public static function connect()
    {
        if (self::$instance === null) {

            $host = "localhost";
            $db = "eventsys";
            $user = "root";
            $pass = "";

            try {

                self::$instance = new PDO(
                    "mysql:host=localhost;dbname=$db;charset=utf8mb4",
                    $user,
                    $pass
                );

                self::$instance->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                self::$instance->setAttribute(
                    PDO::ATTR_DEFAULT_FETCH_MODE,
                    PDO::FETCH_ASSOC
                );

            } catch (PDOException $e) {

                die("Erro de conexão: " . $e->getMessage());

            }

        }

        return self::$instance;
    }
}