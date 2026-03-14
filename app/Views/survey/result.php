<?php ob_start(); ?>

<h1>Results: <?= htmlspecialchars($survey['title']) ?></h1>

<p>Your score : <strong><?= $score ?> / <?= $maxScore ?></strong></p>

<?php if ($maxScore > 0): ?>
    <p>Percentage: <?= round(($score / $maxScore) * 100, 2) ?>%</p>
<?php endif; ?>

<a href="/survey/list">Back to Surveys</a>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>