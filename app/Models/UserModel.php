<?php

require_once __DIR__ . '/Database.php';

class UserModel {

    public static function register(string $email, string $username, string $password): bool
    {
        $db = Database::getConnection();
        
        $stmt = $db->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('INSERT INTO users (email, username, passwordHash) VALUES (:email, :username, :hashedPassword)');

        return $stmt->execute([
            ':email' => $email,
            ':username' => $username,
            ':passwordHash' => $hashedPassword
        ]);

        return true;
    }

    public static function login(string $email, string $password): ?array
    {
        $db = Database::getConnection();
        
        $stmt = $db->prepare('SELECT id, email, username, passwordHash FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['passwordHash'])) {
            unset($user['passwordHash']);
            return $user;
        }

        return null;
    }
}