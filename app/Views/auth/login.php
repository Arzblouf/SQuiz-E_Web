<?php ob_start(); ?>

<h1>Connexion</h1>

<?php if(!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/auth/login">
    <label>Email
        <input type="email" name="email" required>
    </label>
    <label>Mot de passe
        <input type="password" name="password" required>
    </label>
    <button type="submit">Connexion.</button>
</form>

<p>Pas de compte ?<a href="/auth/register">Inscrivez vous ici</a></p>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>