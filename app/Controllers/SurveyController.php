<?php

require_once __DIR__ . '/../Models/SurveyModel.php';
require_once __DIR__ . '/../Models/QuestionModel.php';
require_once __DIR__ . '/../Models/HistoryModel.php';

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

        if (!empty($_SESSION['user_id'])){
            HistoryModel::addEntry($_SESSION['user_id'], $id, new DateTime());
        }

        $survey = SurveyModel::getById($id);
        if (!$survey)
        {
            http_response_code(404);
            echo 'Survey not found';
            return;
        }

        $questions = QuestionModel::getBySurveyId($id);
        foreach ($questions as $key => $question)
        {
            $questions[$key]['answers'] = QuestionModel::getAnswer($question['id']);
        }

        require __DIR__ . '/../Views/survey/show.php';
    }

    public function submit(int $id): void
    {
        $this->requireAuth();

        $survey = SurveyModel::getById($id);
        if (!$survey) {
            http_response_code(404);
            echo 'Survey not found';
            return;
        }

        $questions = QuestionModel::getBySurveyId($id);

        $score = 0;
        $maxScore = 0;
        $correct = 0;
        $incorrect = 0;

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
                    $correct++;
                }
                elseif ((string)$answer['id'] === (string)$submitted && !$answer['valid_answer'])
                {
                    $incorrect++;
                }
            }
        }

        require __DIR__ . '/../Views/survey/result.php';
    }

    private function requireAuth(): void
    {
        if (empty($_SESSION['user_id']))
        {
            include __DIR__ . '/../Views/auth/login.php';
            exit;
        }
    }
}

?>