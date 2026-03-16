<?php

require_once __DIR__ . '/Database.php';

class ProblemeModel {

    public static function AddIssue(string $texte, int $userID) :bool
    {
        $db = Database::getConnection();

        $stmt = $db->prepare('INSERT INTO Probleme (description, id_user) VALUES (:texte, :userID);');
        return $stmt->execute([':texte' => $texte, ':userID' => $userID]);
    }
}

?>