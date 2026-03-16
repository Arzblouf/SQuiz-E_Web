<?php ob_start(); ?>

<h1>Inscription</h1>

<?php if(!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="/auth/register">
    <label>Email
        <input type="email" name="email" required>
    </label>
    <label>Pseudonyme
        <input type="text" name="username" required>
    </label>
    <label>Mot de passe (minimum 8 caractères)
        <input type="password" name="password" minlength="8" required>
    </label>
    <label>Confirmez votre mot de passe
        <input type="password" name="confirm_password" required>
    </label>
    <button type="submit">Créer son compte</button>
</form>

<p>Vous avez déjà un compte ? <a href="/auth/login">Connectez vous ici</a></p>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>