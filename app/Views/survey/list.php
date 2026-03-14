<?php ob_start(); ?>

<h1>Available Surveys</h1>

<?php if (empty($surveys)): ?>
    <p>No surveys available at the moment.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Themes</th>
                <th>Questions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($surveys as $survey): ?>
                <tr>
                    <td><?= htmlspecialchars($survey['title']) ?></td>
                    <td><?= htmlspecialchars($survey['name']) ?></td>
                    <td><?= htmlspecialchars($survey['nb_questions']) ?></td>
                    <td><a href="/survey/show/<?= $survey['id'] ?>">Take Survey</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>