<?php ob_start(); ?>

<h1> Historique de vos consultations </h1>

<?php if (empty($history)): ?>
    <p>Vous n'avez pas encore consulté de questionnaire *snif snif* </p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Questionnaire</th>
                <th>Thème</th>
                <th>Date de consultation</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($history as $entry): ?>
                <tr>
                    <td><?= htmlspecialchars($entry['survey_title']) ?></td>
                    <td><?= htmlspecialchars($entry['theme_name']) ?></td>
                    <td><?= htmlspecialchars($entry['consult_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>