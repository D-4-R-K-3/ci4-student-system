<?php /** @var array<int, array<string, mixed>> $students */ ?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h1 class="page-title">Student <span>Records</span></h1>
</div>

<div class="actions-bar">
    <div class="actions-left">
        <a href="<?= site_url('students') ?>" class="btn btn-ghost">≡ All Students</a>
        <a href="<?= site_url('students/create') ?>" class="btn btn-primary">+ Add Student</a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Student List</span>
        <span class="badge badge-gray"><?= count($students) ?> Record(s)</span>
        <span class="badge badge-purple">READ</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($students)): ?>
                    <tr class="empty-row">
                        <td colspan="6">
                            No students yet. Click <strong>+ Add Student</strong> to begin.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $i => $student): ?>
                        <tr>
                            <td class="td-num"><?= $i + 1 ?></td>
                            <td><?= esc((string) $student['student_number']) ?></td>
                            <td class="td-main"><?= esc((string) $student['first_name']) . ' ' . esc((string) $student['last_name']) ?></td>
                            <td><?= esc((string) $student['email']) ?></td>
                            <td><?= esc((string) $student['course']) ?></td>
                            <td>
                                <div class="td-actions">
                                                <a href="<?= site_url('students/edit/' . $student['id']) ?>"
                                       class="btn btn-sm btn-edit">Edit</a>
                                                <a href="<?= site_url('students/delete/' . $student['id']) ?>"
                                       class="btn btn-sm btn-delete"
                                       onclick="return confirm('Delete this student?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>