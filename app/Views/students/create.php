<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    .form-error { color: var(--red); font-size: 11px; margin-top: 4px; }
    .form-control.error { border-color: var(--red) !important; background: var(--red-dim); }
</style>

<div class="page-header">
    <h1 class="page-title">Student <span>Records</span></h1>
</div>

<div class="actions-bar">
    <div class="actions-left">
        <a href="<?= site_url('students') ?>" class="btn btn-ghost">← Back to List</a>
    </div>
</div>

<div class="form-card">
    <div class="form-title">Add <span>Student</span></div>
    <p class="form-sub">// Fill in the student details below</p>

    <form method="post" action="<?= site_url('students/store') ?>" onsubmit="return validateForm(this)">
        <?= csrf_field() ?>

        <div class="form-group">
            <label class="form-label">Student Number</label>
            <input type="text" name="student_number" class="form-control"
                   placeholder="e.g. 2021-00001"
                   value="<?= set_value('student_number') ?>"
                   id="student_number">
            <?php if (isset($validation) && $validation->hasError('student_number')): ?>
                <div class="form-error"><?= $validation->getError('student_number') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control"
                   placeholder="e.g. Juan"
                   value="<?= set_value('first_name') ?>"
                   id="first_name">
            <?php if (isset($validation) && $validation->hasError('first_name')): ?>
                <div class="form-error"><?= $validation->getError('first_name') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control"
                   placeholder="e.g. dela Cruz"
                   value="<?= set_value('last_name') ?>"
                   id="last_name">
            <?php if (isset($validation) && $validation->hasError('last_name')): ?>
                <div class="form-error"><?= $validation->getError('last_name') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control"
                   placeholder="e.g. juan@email.com"
                   value="<?= set_value('email') ?>"
                   id="email">
            <?php if (isset($validation) && $validation->hasError('email')): ?>
                <div class="form-error"><?= $validation->getError('email') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label class="form-label">Course</label>
            <input type="text" name="course" class="form-control"
                   placeholder="e.g. BSIT"
                   value="<?= set_value('course') ?>"
                   id="course">
            <?php if (isset($validation) && $validation->hasError('course')): ?>
                <div class="form-error"><?= $validation->getError('course') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">+ Save Student</button>
            <a href="<?= site_url('students') ?>" class="btn btn-cancel">Cancel</a>
        </div>

    </form>
</div>

<script>
    function validateForm(form) {
        // Reset error states
        document.querySelectorAll('.form-control').forEach(input => {
            input.classList.remove('error');
        });

        let isValid = true;
        const fields = {
            'student_number': form.student_number.value.trim(),
            'first_name': form.first_name.value.trim(),
            'last_name': form.last_name.value.trim(),
            'email': form.email.value.trim(),
            'course': form.course.value.trim()
        };

        // Check for empty fields
        for (const [key, value] of Object.entries(fields)) {
            if (!value) {
                const input = form.querySelector(`#${key}`);
                input.classList.add('error');
                showToast(`${key.replace(/_/g, ' ').toUpperCase()} is required`, 'error');
                isValid = false;
            }
        }

        return isValid;
    }
</script>

<?= $this->endSection() ?>