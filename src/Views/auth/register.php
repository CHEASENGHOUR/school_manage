<?php 
require_once __DIR__ . "/../layout/header.php";
?>
<div class=" w-100 bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow w-100" style="max-width: 400px;">
        <h3 class="mb-4 text-center">Register</h3>
        
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="/register" method="POST" id="registerForm">
            <div class="mb-3">
                <label>Email address</label>
                <input type="email" name="email" class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>" 
                       value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['email']) ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" required>
                <?php if (isset($errors['password'])): ?>
                    <div class="invalid-feedback"><?= htmlspecialchars($errors['password']) ?></div>
                <?php endif; ?>
                <small class="form-text text-muted">Minimum 6 characters</small>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" class="form-select">
                    <option value="user" <?= ($old['role'] ?? '') === 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= ($old['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success w-100">Register</button>
        </form>
        <p class="mt-3 text-center">
            Already have an account? <a href="/login">Login</a>
        </p>
    </div>
</div>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    const email = this.elements.email.value.trim();
    const password = this.elements.password.value;
    
    if (!email) {
        alert('Email is required');
        e.preventDefault();
        return;
    }
    
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert('Please enter a valid email address');
        e.preventDefault();
        return;
    }
    
    if (password.length < 6) {
        alert('Password must be at least 6 characters');
        e.preventDefault();
        return;
    }
});
</script>

<?php 
require_once __DIR__ . "/../layout/footer.php";
?>