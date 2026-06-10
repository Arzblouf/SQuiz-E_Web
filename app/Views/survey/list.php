<?php ob_start(); ?>

<h1>Questionnaire disponibles :</h1>

<?php if (empty($surveys)): ?>
    <p>Aucun questionnaire actuellement disponible (oopsie)</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Thème</th>
                <th>Questions</th>
                <th>Niveau</th>
                <th>Y répondre ?</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveys as $survey): ?>
                <tr>
                    <td><?= htmlspecialchars($survey['title']) ?></td>
                    <td><?= htmlspecialchars($survey['name']) ?></td>
                    <td><?= htmlspecialchars($survey['nb_questions']) ?></td>
                    <td><?= htmlspecialchars($survey['level']) ?></td>
                    <td><a href="/survey/show/<?= $survey['id'] ?>">Y répondre.</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>