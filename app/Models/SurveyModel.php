<?php

require_once __DIR__ . '/Database.php';

class SurveyModel {
    
    public static function getAllPublished(): array
    {
        $db = Database::getConnection();
        
        $stmt = $db->query('SELECT survey.id, survey.title, survey.nb_questions, theme.name FROM survey JOIN theme ON survey.id_theme = theme.id WHERE survey.publish = true ORDER BY survey.id DESC');
        return $stmt->fetchAll();
    }

    public static function getById(int $id): ?array
    {
        $db = Database::getConnection();
        
        $stmt = $db->prepare('SELECT survey.id, survey.title, survey.nb_questions, theme.name FROM survey JOIN theme ON survey.id_theme = theme.id WHERE survey.id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }
}

?>