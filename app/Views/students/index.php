<?php /** @var array<int, array<string, mixed>> $students */ ?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    /* Futuristic Search & Action Bar */
    .actions-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 20px;
    }

    .search-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        background: rgba(15, 23, 42, 0.6);
        border: 1px solid #6366f1;
        border-radius: 10px;
        padding: 4px 12px;
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        max-width: 350px;
    }

    .search-input {
        background: transparent;
        border: none;
        color: #f8fafc;
        padding: 10px;
        outline: none;
        width: 100%;
        font-family: 'JetBrains Mono', monospace;
    }

    .btn-search { background: transparent; border: none; color: #818cf8; cursor: pointer; }

    /* Custom Pagination Styling */
    .pagination-bar {
        margin-top: 30px;
        display: flex;
        justify-content: center;
    }

    /* Target CI4's default pager list */
    .pagination-bar ul {
        display: flex;
        list-style: none;
        gap: 8px;
        padding: 0;
    }

    .pagination-bar li a, .pagination-bar li span {
        padding: 8px 16px;
        background: rgba(30, 41, 59, 0.7);
        border: 1px solid #334155;
        color: #94a3b8;
        text-decoration: none;
        border-radius: 6px;
        transition: all 0.2s;
        font-family: 'JetBrains Mono', monospace;
    }

    .pagination-bar li.active span {
        background: #6366f1;
        color: white;
        border-color: #818cf8;
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.4);
    }

    .pagination-bar li a:hover {
        background: #334155;
        color: #fff;
        border-color: #6366f1;
    }

    .no-results {
        text-align: center;
        padding: 40px;
        color: #94a3b8;
        font-style: italic;
    }
</style>

<div class="page-header">
    <h1 class="page-title">Student <span>Records</span></h1>
</div>

<div class="actions-bar">
    <div class="actions-left">
        <a href="<?= site_url('students') ?>" class="btn btn-ghost">≡ All Students</a>
        <a href="<?= site_url('students/create') ?>" class="btn btn-primary">+ Add Student</a>
    </div>

    <form action="<?= site_url('students') ?>" method="get" class="search-wrapper">
        <?php if(request()->getGet('search')): ?>
            <a href="<?= site_url('students') ?>" style="color:#f43f5e; text-decoration:none; margin-right:8px;" title="Reset Search">×</a>
        <?php endif; ?>
        
        <input type="text" name="search" class="search-input" 
               placeholder="SCAN DATABASE..." 
               value="<?= esc((string)request()->getGet('search')) ?>">
        
        <button type="submit" class="btn-search">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
        </button>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Student List</span>
        <span class="badge badge-purple">ACCESS_GRANTED</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Student Number</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="5" class="no-results">
                            [!] NO MATCHING RECORDS FOUND IN DATABASE
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= esc((string) $student['student_number']) ?></td>
                            <td class="td-main"><?= esc((string) $student['first_name']) . ' ' . esc((string) $student['last_name']) ?></td>
                            <td><?= esc((string) $student['email']) ?></td>
                            <td><?= esc((string) $student['course']) ?></td>
                            <td>
                                <div class="td-actions">
                                    <a href="<?= site_url('students/edit/' . $student['id']) ?>" class="btn btn-sm btn-edit">Edit</a>
                                    <a href="<?= site_url('students/delete/' . $student['id']) ?>" 
                                       class="btn btn-sm btn-delete" 
                                       onclick="return confirm('Execute deletion?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="pagination-bar">
    <?= isset($pager) ? $pager->links() : '' ?>
</div>

<?= $this->endSection() ?>