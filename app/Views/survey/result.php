<?php ob_start(); ?>

<h1>Resultats: <?= htmlspecialchars($survey['title'] ?? 'Questionnaire') ?></h1>

<?php
$score = $score ?? 0;
$maxScore = $maxScore ?? 0;
$correct = $correct ?? 0;
$incorrect = $incorrect ?? 0;
?>

<p>Votre score : <strong><?= htmlspecialchars($score) ?> / <?= htmlspecialchars($maxScore) ?></strong></p>

<?php if ($maxScore > 0): ?>
    <p>Pourcentage: <?= round(($score / $maxScore) * 100, 2) ?>%</p>
<?php endif; ?>

<h2>Résumé de vos réponses</h2>
<canvas id="resultChart" width="400" height="200"></canvas>

<a href="/survey/list">Retour aux questionnaires.</a>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const chartData = {
        correct: <?= $correct ?>,
        incorrect: <?= $incorrect ?>
    };
    
    new Chart(document.getElementById('resultChart'), {
        type: 'pie',
        data: {
            labels: ['Correctes', 'Incorrectes'],
            datasets: [{
                label: 'Nombre de réponses',
                data: [chartData.correct, chartData.incorrect],
                backgroundColor: ['#4CAF50', '#FF6B6B'],
                borderColor: '#333',
                borderWidth: 1
            }]
        }
    });
</script>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>