<?php ob_start(); ?>

<h1>Resultats: <?= htmlspecialchars($survey['title']) ?></h1>

<p>Votre score : <strong><?= $score ?> / <?= $maxScore ?></strong></p>

<?php if ($maxScore > 0): ?>
    <p>Pourcentage: <?= round(($score / $maxScore) * 100, 2) ?>%</p>
<?php endif; ?>

<a href="/survey/list">Retour aux questionnaires.</a>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>