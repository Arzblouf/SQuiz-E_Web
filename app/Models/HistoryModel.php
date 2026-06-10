<?php

require_once __DIR__ . '/Database.php';

class HistoryModel {

    public static function getHistoryByUserId(int $userId): array
    {
        $db = Database::getConnection();

        $stmt = $db->prepare('SELECT survey.title AS survey_title, theme.name AS theme_name, users.username AS user_name, history.consult_date AS consult_date FROM history JOIN users ON history.id_user = users.id JOIN survey ON history.id_survey = survey.id JOIN theme ON survey.id_theme = theme.id WHERE history.id_user = :userId ORDER BY consult_date DESC');
        $stmt->execute([':userId' => $userId]);
        return $stmt->fetchAll() ?: [];
    }

    public static function addEntry(int $userId, int $surveyId, DateTime $consultDate): bool
    {
        $db = Database::getConnection();

        $stmt = $db->prepare('INSERT INTO history (id_user, id_survey, consult_date) VALUES (:userId, :surveyId, :consultDate);');
        return $stmt->execute([':userId' => $userId, ':surveyId' => $surveyId, ':consultDate' => $consultDate->format('Y-m-d H:i:s')]);
    }

    //Fonction pour lister les utilisateurs ainsi que le nombre de questionnaire qu'ils ont créer
    public static function getSurveyCountByUser(): array
    {
        $db = Database::getConnection();

        $stmt = $db->query('SELECT users.username AS user_name, COUNT(survey.id) AS survey_count FROM users LEFT JOIN survey ON users.id = survey.id_user GROUP BY users.id ORDER BY user_name ASC');
        return $stmt->fetchAll() ?: [];
    }
}

?>