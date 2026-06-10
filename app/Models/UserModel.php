<?php

require_once __DIR__ . '/Database.php';

class UserModel {

    public static function register(string $email, string $username, int $role, string $password): bool
    {
        $db = Database::getConnection();
        
        $stmt = $db->prepare('SELECT id FROM users WHERE email = :email;');
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            return false;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare('INSERT INTO users (email, username, id_role, passwordHash) VALUES (:email, :username, :roleID, :hashedPassword);');

        return $stmt->execute([
            ':email' => $email,
            ':username' => $username,
            ':roleID' => $role,
            ':hashedPassword' => $hashedPassword
        ]);

        return true;
    }

    public static function login(string $email, string $password): ?array
    {
        $db = Database::getConnection();
        
        $stmt = $db->prepare('SELECT id, email, username, passwordHash FROM users WHERE email = :email;');
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['passwordHash'])) {
            unset($user['passwordHash']);
            return $user;
        }

        return null;
    }

    public static function getIdByMail(string $email): int
    {
        $db = Database::getConnection();

        $stmt = $db->prepare('SELECT id FROM users WHERE email = :email;');
        $stmt->execute([':email' => $email]);
        $userID = $stmt->fetch();

        return $userID;
    }

    //Fonction pour récuperer le role d'un utilisateur à partir de son ID
    public static function getLevelById(int $id): ?string
    {
        $db = Database::getConnection();

        $stmt = $db->prepare('SELECT role.id, role.level FROM role JOIN users ON role.id = users.id_role WHERE users.id = :id;');
        $stmt->execute([':id' => $id]);
        $roleUser = $stmt->fetch();

        return $roleUser ? $roleUser['level'] : null;
    }

    //Fonction pour récuperer tout les noms des roles
    public static function getAllRoles(): array
    {
        $db = Database::getConnection();

        $stmt = $db->query('SELECT id, name, level FROM role;');
        return $stmt->fetchAll();
    }
}

?>