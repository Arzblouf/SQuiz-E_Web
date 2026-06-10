<?php ob_start(); ?>

<h1> Tout les questionnaires que vous avez créer : </h1>

<?php if (empty($surveyCounts)): ?>
    <p>C'est pas sensé arriver ça...</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Utilisateur</th>
                <th>Nombre de questionnaire créé</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveyCounts as $entry): ?>
                <tr>
                    <td><?= htmlspecialchars($entry['user_name']) ?></td>
                    <td><?= htmlspecialchars($entry['survey_count']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


<?php 
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>