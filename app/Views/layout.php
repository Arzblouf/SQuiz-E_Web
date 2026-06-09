<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stadium Questionnaire</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <nav>
        <?php if (!empty($_SESSION['user_id'])): ?>
            <span>Bonjour, <?= htmlspecialchars($_SESSION['username'] ?? '') ?></span>
            <a href="/auth/logout">Déconnexion</a>
            <a href="/survey/list">Questionnaires</a>
            <a href="/issue/issue">Un problème à signaler ?</a>
            <a href="/history/history">Historique de vos consultations</a>
        <?php endif; ?>
    </nav>

    <main>
        <?= $content ?? '' ?>
    </main>
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    <script src="/js/app.js"></script>
</body>
</html>