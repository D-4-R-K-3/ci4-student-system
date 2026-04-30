<?php $this->extend('layout'); ?>

<?php $this->section('content'); ?>
<div class="container mt-5">
    <h2>Add New Student</h2>
    
    <form action="/students/store" method="POST">
        <?= csrf_field(); ?>
        
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="course">Course</label>
            <input type="text" class="form-control" id="course" name="course" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="section">Section</label>
            <input type="text" class="form-control" id="section" name="section" required>
        </div>
        
        <button type="submit" class="btn btn-success">Save</button>
        <a href="/students" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $this->endSection(); ?>
