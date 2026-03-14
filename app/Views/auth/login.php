<?php ob_start(); ?>

<h1>Login</h1>

<?php if(!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/auth/login">
    <label>Email
        <input type="email" name="email" required>
    </label>
    <label>Password
        <input type="password" name="password" required>
    </label>
    <button type="submit">Sign In</button>
</form>

<p>No account? <a href="/auth/register">Register here</a></p>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>