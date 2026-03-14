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
            <span>Hello, <?= htmlspecialchars($_SESSION['username'] ?? '') ?></span>
            <a href="/auth/logout">Logout</a>
            <a href="/survey/list">Surveys</a>
        <?php endif; ?>
    </nav>

    <main>
        <?= $content ?>
    </main>
</body>
</html>