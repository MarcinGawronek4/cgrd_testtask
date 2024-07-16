<?php
require_once 'config.php';

class Database
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO(
                DatabaseConfig::getConnectionUrl(),
                DatabaseConfig::getUsername(),
                DatabaseConfig::getPassword()
            );

            // Set the PDO error mode to exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    // Method to get the PDO instance
    public function getPdo()
    {
        return $this->pdo;
    }
}
?>