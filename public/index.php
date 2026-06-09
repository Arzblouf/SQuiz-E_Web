<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$url = trim($_GET['url'] ?? '', '/');

if ($url === '') {
    include __DIR__ . '/../app/Views/auth/login.php';
    exit;
}

$parts = explode('/', $url);

$controllerName = $parts[0] ?? 'auth';
$action = $parts[1] ?? 'index';
$param = $parts[2] ?? null;

switch ($controllerName) {
    case 'auth':
        require_once __DIR__ . '/../app/Controllers/AuthController.php';
        $controller = new AuthController();

        match ($action) {
            'login' => ($_SERVER['REQUEST_METHOD'] === 'POST') ? $controller->login() : $controller->loginForm(),
            'register' => ($_SERVER['REQUEST_METHOD'] === 'POST') ? $controller->register() : $controller->registerForm(),
            'logout' => $controller->logout(),
            default => $controller->loginForm(),
        };
        break;

    case 'survey':
        require_once __DIR__ . '/../app/Controllers/SurveyController.php';
        $controller = new SurveyController();

        match ($action) {
            'list' => $controller->list(),
            'show' => $controller->show((int)$param),
            'submit' => $controller->submit((int)$param),
            default => $controller->list(),
        };
        break;

    case 'issue':
        require_once __DIR__ . '/../app/Controllers/ProblemeController.php';
        $controller = new ProblemeController();

        match ($action) {
            'issue' => ($_SERVER['REQUEST_METHOD'] === 'POST') ? $controller->addIssue() : $controller->addIssueForm(),
            default => $controller->addIssue(),
        };
        break;

    case 'history':
        require_once __DIR__ . '/../app/Controllers/HistoryController.php';
        $controller = new HistoryController();
        
        match ($action) {
            'history' => $controller->viewHistory(),
            default => $controller->viewHistory(),
        };
        break;

    default:
        include __DIR__ . '/../app/Views/auth/login.php';
        exit;
}

?>