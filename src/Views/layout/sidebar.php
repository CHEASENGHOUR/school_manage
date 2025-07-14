<?php
$currentUser = $_SESSION['user'] ?? null;
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
?>

<aside class="sidebar bg-dark text-white" style="width: 250px; min-height: 100vh;">
    <div class="sidebar-header p-3 d-flex align-items-center h-25">
        <h4 class="m-0">School System</h4>
    </div>

    <ul class=" d-flex flex-column list-unstyled justify-content-between h-75">
        <?php if ($currentUser): ?>
            <!-- Common menu items for all logged-in users -->
            <li class="">
                <a class="nav-link <?= str_starts_with($currentPath, '/') ? 'active' : '' ?>"
                    href="/">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
            </li>

            <?php if ($currentUser['role'] === 'admin'): ?>
                <!-- Admin-only menu items -->
                <li class="">
                    <a class="nav-link <?= str_starts_with($currentPath, '/users') ? 'active' : '' ?>"
                        href="/users">
                        <i class="fas fa-users me-2"></i> List Users
                    </a>
                </li>
            <?php endif; ?>

            <!-- Student/Teacher menu items -->
            <li class="">
                <a class="nav-link <?= str_starts_with($currentPath, '/my-courses') ? 'active' : '' ?>"
                    href="/my-courses">
                    <i class="fas fa-graduation-cap me-2"></i> My Courses
                </a>
            </li>

            <!-- Logout -->
            <li class=" mt-auto">
                <a class="nav-link text-danger" href="/logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </a>
            </li>

        <?php else: ?>
            <!-- Menu items for guests -->
            <li class="nav-item">
                <a class="nav-link <?= $currentPath === '/login' ? 'active' : '' ?>" href="/login">
                    <i class="fas fa-sign-in-alt me-2"></i> Login
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= $currentPath === '/register' ? 'active' : '' ?>" href="/register">
                    <i class="fas fa-user-plus me-2"></i> Register
                </a>
            </li>
        <?php endif; ?>
    </ul>
</aside>