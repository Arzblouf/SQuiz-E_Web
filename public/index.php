<?php

$url = trim($_GET['url'] ?? '', '/');

error_log("===REQUEST DEBUG===");
error_log("Raw URL : " . $url);

if ($url === '') {
    include __DIR__ . '/../app/Views/auth/login.php';
    exit;
}

$parts = explode('/', $url);

$controllerName = $parts[0] ?? 'auth';
$action = $parts[1] ?? 'index';
$param = $parts[2] ?? null;

error_log("Controller : " . $controllerName);
error_log("Action : " . $action);
error_log("===END DEBUG===");

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

    default:
        include __DIR__ . '/../app/Views/auth/login.php';
        exit;
}