<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h1 class="page-title">Student <span>Records</span></h1>
</div>

<div class="actions-bar">
    <div class="actions-left">
        <a href="<?= site_url('students') ?>" class="btn btn-ghost">← Back to List</a>
    </div>
</div>

<?php if (isset($validation)): ?>
    <div class="alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>

<div class="form-card">
    <div class="form-title">Add <span>Student</span></div>
    <p class="form-sub">// Fill in the student details below</p>

    <form method="post" action="<?= site_url('students/store') ?>">
        <?= csrf_field() ?>

        <div class="form-group">
            <label class="form-label">Student Number</label>
            <input type="text" name="student_number" class="form-control"
                   placeholder="e.g. 2021-00001"
                   value="<?= set_value('student_number') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control"
                   placeholder="e.g. Juan"
                   value="<?= set_value('first_name') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control"
                   placeholder="e.g. dela Cruz"
                   value="<?= set_value('last_name') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   placeholder="e.g. juan@email.com"
                   value="<?= set_value('email') ?>">
        </div>

        <div class="form-group">
            <label class="form-label">Course</label>
            <input type="text" name="course" class="form-control"
                   placeholder="e.g. BSIT"
                   value="<?= set_value('course') ?>">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">+ Save Student</button>
            <a href="<?= site_url('students') ?>" class="btn btn-cancel">Cancel</a>
        </div>

    </form>
</div>

<?= $this->endSection() ?>