<?php require_once __DIR__ . '/layout/header.php'; ?>
<?php require_once __DIR__ . '/layout/sidebar.php'; ?>

<div class="w-100 p-4">
    <h1>My Class</h1>
    
    <!-- Display session messages -->
    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($data['error']); ?>
        </div>
    <?php endif; ?>
    <?php if (isset($data['success'])): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($data['success']); ?>
        </div>
    <?php endif; ?>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>List Class</h2>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#CreateClass">Create Class</button>
    </div>

    <!-- Classes Table -->
    <?php if (!empty($data['classes'])): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Class ID</th>
                    <th>Course</th>
                    <th>Teacher ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['classes'] as $class): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($class['class_id']); ?></td>
                        <td><?php echo htmlspecialchars($class['courses']); ?></td>
                        <td><?php echo htmlspecialchars($class['teacher_id']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-muted">No classes found.</p>
    <?php endif; ?>
</div>

<!-- Create Class Modal -->
<div class="modal fade" id="CreateClass" tabindex="-1" aria-labelledby="CreateClassLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="/class/create" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="CreateClassLabel">Create New Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="courses" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="courses" name="courses" placeholder="Enter course name" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>