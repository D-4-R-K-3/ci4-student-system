<?php $this->extend('layout'); ?>

<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2>Students List</h2>
    <a href="/students/create" class="btn btn-primary mb-3">Add New Student</a>
    
    <?php if ($students): ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
            <tr>
                <td><?= $student['id']; ?></td>
                <td><?= $student['name']; ?></td>
                <td><?= $student['email']; ?></td>
                <td><?= $student['course']; ?></td>
                <td><?= $student['section']; ?></td>
                <td>
                    <a href="/students/edit/<?= $student['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/students/delete/<?= $student['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <!-- Pagination -->
    <?php if ($pager): ?>
    <nav aria-label="Page navigation">
        <?= $pager->links(); ?>
    </nav>
    <?php endif; ?>
    
    <?php else: ?>
    <p>No students found. <a href="/students/create">Add one now!</a></p>
    <?php endif; ?>
</div>
<?php $this->endSection(); ?>
