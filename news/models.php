<?php
require_once 'database.php';

class News
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPdo();
    }

    // Select all news
    public function selectAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM news");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get a single news item by id
    public function getById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Insert a new news item
    public function insert(string $title, string $description): bool
    {
        if(empty($title) || empty($description)){
            throw new Exception("Title or description cannot be empty");
        }
        $stmt = $this->pdo->prepare("INSERT INTO news (title, description) VALUES (:title, :description)");
        return $stmt->execute(['title' => $title, 'description' => $description]);
    }

    // Update a news item by id
    public function update(int $id, string $title, string $description): bool
    {
        if (empty($id)) {
            throw new Exception("ID not provided");
        }
        if(empty($title) || empty($description)){
            throw new Exception("Title or description cannot be empty");
        }
        $stmt = $this->pdo->prepare("UPDATE news SET title = :title, description = :description WHERE id = :id");
        return $stmt->execute(['id' => $id, 'title' => $title, 'description' => $description]);
    }

    // Delete a news item by id
    public function delete(int $id): bool
    {
        if (!$id) {
            throw new Exception("ID not provided");
        }
        $stmt = $this->pdo->prepare("DELETE FROM news WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>