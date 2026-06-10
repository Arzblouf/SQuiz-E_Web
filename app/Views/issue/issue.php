<?php ob_start(); ?>

<h1> Vous avez une remarque ? </h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/issue/issue">
    <label>Ecrivez votre remarque ici :
        <input type="text" name="description" required>
    </label>
    <button type="submit">Remarquer.</button>
</form>
<br>
<br>
<p><a href="/survey/list">Si vous n'avez rien à dire, vous pouvez revenir aux questionnaires (émoji sourire)</a></p>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>