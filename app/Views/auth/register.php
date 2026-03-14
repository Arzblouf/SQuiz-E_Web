<?php ob_start(); ?>

<h1>Register</h1>

<?php if(!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="/auth/register">
    <label>Email
        <input type="email" name="email" required>
    </label>
    <label>Username
        <input type="text" name="username" required>
    </label>
    <label>Password (min 8 characters)
        <input type="password" name="password" minlength="8" required>
    </label>
    <label>Confirm Password
        <input type="password" name="confirm_password" required>
    </label>
    <button type="submit">Create Account</button>
</form>

<p>Already have an account? <a href="/auth/login">Login here</a></p>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layout.php';
?>