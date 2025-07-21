<?php require_once __DIR__ . '/layout/header.php'; ?>
<?php require_once __DIR__ . '/layout/sidebar.php'; ?>

<div class="w-100 p-4">
    <h1>Student Attendance</h1>
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
        <h2>List Students</h2>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>
    </div>
    <?php if (!empty($data['students'])): ?>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Class</th>
                    <th>Attendance</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['students'] as $index => $student): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['class_name']) ?></td>
                        <td>
                            <form action="/attendance/mark" method="POST" class="d-flex gap-2">
                                <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                                <input type="hidden" name="class_id" value="<?= $student['class_id'] ?>">
                                
                                <select name="status" class="form-select form-select-sm w-auto" required>
                                    <option value="Present">Present</option>
                                    <option value="Absent">Absent</option>
                                    <option value="Late">Late</option>
                                </select>

                                <button type="submit" class="btn btn-sm btn-success">Submit</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-warning">No students found.</div>
    <?php endif; ?>
</div>
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/student/create" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="studentName" class="form-label">Student Name</label>
            <input type="text" class="form-control" id="studentName" name="name" required>
          </div>

          <div class="mb-3">
            <label for="classId" class="form-label">Class</label>
            <select class="form-select" id="classId" name="class_id" required>
              <option value="" selected disabled>Select class</option>
              <?php foreach ($data['classes'] as $class): ?>
                <option value="<?= $class['id'] ?>"><?= htmlspecialchars($class['name']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save Student</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>