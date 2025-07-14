<?php require_once __DIR__ . '/layout/header.php'; ?>
<?php require_once __DIR__ . '/layout/sidebar.php'; ?>
<div class="d-flex justify-content-between align-items-center">
  <h2>Welcome, <?= $_SESSION['user']['email'] ?? 'User' ?> 👋</h2>

  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title">User Tools</h5>
      <p class="card-text">This is your user dashboard. You can add tools like profile, settings, etc.</p>
    </div>
  </div>
  <!-- 🔘 Logout button -->
  <a href="/logout" class="btn btn-danger">Logout</a>
</div>



<?php require_once __DIR__ . '/layout/footer.php'; ?>