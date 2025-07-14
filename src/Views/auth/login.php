<?php 
require_once __DIR__ . "/../layout/header.php";
?>
<div class="w-100 bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card p-4 shadow w-100" style="max-width: 400px;">
        <h3 class="mb-4 text-center">Login</h3>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="/login" method="POST" id="loginForm">
            <div class="mb-3">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="mt-3 text-center">
            Don't have an account? <a href="/register">Register</a>
        </p>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    const email = this.elements.email.value.trim();
    const password = this.elements.password.value;
    
    if (!email || !password) {
        alert('Both email and password are required');
        e.preventDefault();
        return;
    }
    
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        alert('Please enter a valid email address');
        e.preventDefault();
        return;
    }
});
</script>

<?php 
require_once __DIR__ . "/../layout/footer.php";
?>