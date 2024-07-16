<?php
require_once 'models.php';
require_once 'config.php';

class NewsController
{
    private $newsModel;
    private $twig;

    public function __construct()
    {
        $this->newsModel = new News();
        $this->twig = TwigConfig::getTwig();
    }

    public function list()
    {
        $news = $this->newsModel->selectAll();
        $error = '';
        $success = '';
        if(!empty($_SESSION['error'])){
            $error = $_SESSION['error'];
        } elseif (!empty($_SESSION['success'])) {
            $success = $_SESSION['success'];
        }
        session_unset();
        echo $this->twig->render('news.html.twig', ['news' => $news, 'error' => $error, 'success' => $success]);
    }

    public function create()
    {
        try{
            $title = $_POST['title'];
            $description = $_POST['description'];
            $result = $this->newsModel->insert($title, $description);
            $_SESSION['success'] = 'Creation was successful';
            return $result;
        } catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return true;
        }
    }

    public function edit()
    {
        try{
            $id = $_POST['id'] ?? null;
            $title = $_POST['title'];
            $description = $_POST['description'];
            $result = $this->newsModel->update($id, $title, $description);
            $_SESSION['success'] = 'Editing was successful';
            return $result;
        } catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return true;
        }
    }

    public function delete()
    {
        try {
            $id = $_POST['id'] ?? null;
            $result = $this->newsModel->delete($id);
            $_SESSION['success'] = 'Deletion was successful';
            return $result;
        } catch(Exception $e){
            $_SESSION['error'] = $e->getMessage();
            return true;
        }
    }
}
?>