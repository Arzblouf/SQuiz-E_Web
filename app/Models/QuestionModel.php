<?php

require_once __DIR__ . '/Database.php';

class QuestionModel {

    public static function getBySurveyId(int $surveyId): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT DISTINCT question.id, question.caption, question_type.label, include.num_question FROM include JOIN question ON include.id_question = question.id JOIN question_type ON question.id_type = question_type.id WHERE include.id_survey = :surveyId ORDER BY include.num_question ASC');
        $stmt->execute([':surveyId' => $surveyId]);
        $rows = $stmt->fetchAll();

        $unique = [];
        foreach ($rows as $row){
            if (!isset($unique[$row['id']])){
                $unique[$row['id']] = $row;
            }
        }
        return array_values($unique);
    }

    public static function getAnswer(int $questionId): array
    {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT answer.id, answer.content, answering.valid_answer, answering.num_answer, answering.weight FROM answering JOIN answer ON answering.id_answer = answer.id WHERE answering.id_question = :questionId ORDER BY answering.num_answer ASC');
        $stmt->execute([':questionId' => $questionId]);
        return $stmt->fetchAll();
    }
}

?>