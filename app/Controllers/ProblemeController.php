<?php

require_once __DIR__ . '/../Models/ProblemeModel.php';
require_once __DIR__ . '/../Models/UserModel.php';

class ProblemeController{

    public function addIssueForm() : void
    {
        $error = null;
        require __DIR__ . '/../Views/issue/issue.php';
    }

    public function addIssue() : void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /auth/login');
            exit;
        }

        $texte = trim($_POST['description'] ?? '');
        $userID = $_SESSION['user_id'];

        if (strlen($texte) > 250){
            $error = 'La description doit être de 250 caractères maximum.';
            require __DIR__ . '/../Views/issue/issue.php';
            exit;
        }

        $issue = ProblemeModel::AddIssue($texte, $userID);
        header('Location: /survey/list');
        exit;
    }
}

?>