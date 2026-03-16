<?php ob_start(); ?>

<h1> Quel est votre problème ? </h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/issue/issue">
    <label>Descrivez votre problème :
        <input type="text" name="description" required>
    </label>
    <button type="submit">Signaler.</button>
</form>
<br>
<br>
<p><a href="/survey/list">Si vous n'avez pas de problème, vous pouvez revenir aux questionnaires (émoji sourire)</a></p>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>