<?php

require_once('vendor/autoload.php');

class DatabaseConfig
{
    private const DB_HOST = 'localhost';
    private const DB_PORT = '3307';
    private const DB_DATABASE = 'cgrd_testtask';
    private const DB_USERNAME = 'root';
    private const DB_PASSWORD = '';

    public static function getConnectionUrl()
    {
        return sprintf(
            'mysql:host=%s;port=%s;dbname=%s',
            self::DB_HOST,
            self::DB_PORT,
            self::DB_DATABASE,
        );
    }

    public static function getUsername()
    {
        return self::DB_USERNAME;
    }

    public static function getPassword()
    {
        return self::DB_PASSWORD;
    }
}

class TwigConfig
{
    public static function getTwig()
    {
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
        $twig = new \Twig\Environment($loader, [
            'cache' => __DIR__ . '/cache',
            'debug' => true
        ]);

        return $twig;
    }
}
?>