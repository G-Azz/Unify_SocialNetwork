<?php

class Config
{
    private static $pdo = null;

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=localhost;port=3307;dbname=unify_post',
                    'pma',
                    '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
        return self::$pdo;
    }
}

// Use this line where you need the database connection
// $db = Config::getConnexion();
?>
