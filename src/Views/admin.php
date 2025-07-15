<?php require_once __DIR__ . '/layout/header.php'; ?>
<?php require_once __DIR__ . '/layout/sidebar.php'; ?>
<div class=" w-100 d-flex justify-content-center align-items-center flex-column">
  <h2>Welcome, <?= $_SESSION['user']['email'] ?? 'Admin' ?> 👋</h2>

  <div class="card mt-4 text-center">
    <div class="card-body">
      <h5 class="card-title">Admin</h5>
      
    </div>
  </div>
  <!-- 🔘 Logout button -->
  <a href="/logout" class="btn btn-danger">Logout</a>
</div>



<?php require_once __DIR__ . '/layout/footer.php'; ?>