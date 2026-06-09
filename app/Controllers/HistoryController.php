<?php

require_once __DIR__ . '/../Models/HistoryModel.php';
require_once __DIR__ . '/../Models/UserModel.php';

class HistoryController {

    public function viewHistory(): void
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: auth/login');
            exit;
        }

        $userId = $_SESSION['user_id'];
        $history = HistoryModel::getHistoryByUserId($userId);
        require __DIR__ . '/../Views/history/history.php';
    }
}

?>