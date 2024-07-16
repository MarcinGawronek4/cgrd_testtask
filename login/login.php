<?php

require_once 'database.php';
session_start();
class LoginController {

    private $pdo;
    private $twig;


    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->getPdo();
        $this->twig = TwigConfig::getTwig();
    }

    public function renderLogin(){
        $error = '';
        if(!empty($_SESSION['error'])){
            $error = $_SESSION['error'];
        }
        session_unset();
        echo $this->twig->render('login.html.twig', ['error' => $error]);
    }

    public function login(){
        try {
            if($this->authenticate()){
                header('Location: /cgrd/news/list');
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            header('Location: /cgrd/l');
        }
    }

    public function authenticate(){
        if ( !isset($_POST['username'], $_POST['password']) ) {
            throw new Exception('Please fill both the username and password fields!');
        }

        $stmt = $this->pdo->prepare("SELECT id, password FROM user WHERE username = :username");
        if ($stmt->execute(['username' => $_POST['username']])) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($_POST['password'] === $result['password']) {
                    return true;
                } else {
                    throw new Exception('Wrong Login Data!');
                }
            } else {
                throw new Exception('Wrong Login Data!');
            }
    }
    
}