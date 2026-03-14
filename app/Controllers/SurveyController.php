<?php

require_once __DIR__ . '/../Models/SurveyModel.php';
require_once __DIR__ . '/../Models/QuestionModel.php';

class SurveyController {

    public function list(): void
    {
        $this->requireAuth();
        $surveys = SurveyModel::getAllPublished();
        require __DIR__ . '/../Views/survey/list.php';
    }

    public function show(int $id): void
    {
        $this->requireAuth();

        $survey = SurveyModel::getById($id);
        if (!$survey)
        {
            http_response_code(404);
            echo 'Survey not found';
            return;
        }

        $questions = QuestionModel::getBySurveyId($id);
        for ($i = 0; $i < count($questions); $i++)
        {
            $questions[$i]['answers'] = QuestionModel::getAnswer($questions[$i]['id']);
        }

        require __DIR__ . '/../Views/survey/show.php';
    }

    public function submit(int $id): void
    {
        $this->requireAuth();

        $survey = SurveyModel::getById($id);
        $questions = QuestionModel::getBySurveyId($id);

        $score = 0;
        $maxScore = 0;

        foreach ($questions as $question)
        {
            $answers = QuestionModel::getAnswer($question['id']);
            $submitted = $_POST['question_' . $question['id']] ?? null;

            foreach ($answers as $answer)
            {
                if ($answer['valid_answer'])
                {
                    $maxScore += $answer['weight'];
                }
                if ((string)$answer['id'] === (string)$submitted && $answer['valid_answer'])
                {
                    $score += $answer['weight'];
                }
            }
        }

        require __DIR__ . '/../Views/survey/result.php';
    }

    private function requireAuth(): void
    {
        if (empty($_SESSION['user_id']))
        {
            header('Location: auth/login');
            exit;
        }
    }
}

?>