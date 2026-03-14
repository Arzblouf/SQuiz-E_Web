<?php

require_once __DIR__ . '/../Models/UserModel.php';

class AuthController {

    public function loginForm(): void
    {
        $error = null;
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = UserModel::login($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            include __DIR__ . '/../Views/survey/list.php';
            exit;
        }

        $error = 'Invalid email or password.';
        require __DIR__ . '/../Views/auth/login.php';
    }

    public function registerForm(): void
    {
        if (!empty($_SESSION['user_id'])){
            include __DIR__ . "/../Views/survey/list.php";
        }

        $error = null;
        require __DIR__ . '/../Views/auth/register.php';
    }

    public function register(): void
    {
        $email = trim($_POST['email'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        if ($password !== $confirmPassword) {
            $error = 'Passwords do not match.';
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }

        if (strlen($password) < 8) {
            $error = 'Password must be at least 8 characters long.';
            require __DIR__ . '/../Views/auth/register.php';
            return;
        }

        if (UserModel::register($email, $username, $password)) {
            include __DIR__ . '/../Views/auth/login.php';
            exit;
        }

        $error = 'This email is already registered.';
        require __DIR__ . '/../Views/auth/register.php';
    }

    public function logout(): void
    {
        session_destroy();
        include __DIR__ . '/../Views/auth/login.php';
        exit;
    }
}