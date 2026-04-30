<?php /** @var array<int, array<string, mixed>> $students */ ?>

<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<style>
    /* Futuristic Search Styling */
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
        background: rgba(15, 23, 42, 0.6); /* Dark glass effect */
        border: 1px solid #6366f1; /* Indigo border */
        border-radius: 10px;
        padding: 4px 12px;
        box-shadow: 0 0 15px rgba(99, 102, 241, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        max-width: 350px;
    }

    .search-wrapper:focus-within {
        box-shadow: 0 0 25px rgba(99, 102, 241, 0.5);
        border-color: #a5b4fc;
        transform: translateY(-1px);
    }

    .search-input {
        background: transparent;
        border: none;
        color: #f8fafc;
        padding: 10px;
        outline: none;
        width: 100%;
        font-family: 'JetBrains Mono', 'Courier New', monospace;
        letter-spacing: 0.5px;
    }

    .btn-search {
        background: transparent;
        border: none;
        color: #818cf8;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .btn-search:hover { transform: scale(1.1); color: #fff; }

    .btn-clear-scan {
        color: #94a3b8;
        text-decoration: none;
        margin-right: 8px;
        font-size: 1.2rem;
        transition: color 0.2s;
    }

    .btn-clear-scan:hover { color: #f43f5e; }

    /* Empty search result styling */
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
            <a href="<?= site_url('students') ?>" class="btn-clear-scan" title="Reset Search">×</a>
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
        <span class="badge badge-gray"><?= count($students) ?> Record(s)</span>
        <span class="badge badge-purple">ACCESS_GRANTED</span>
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
                    <tr>
                        <td colspan="6" class="no-results">
                            [!] NO MATCHING RECORDS FOUND IN DATABASE
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
    <?= $pager->links() ?>
</div>

<?= $this->endSection() ?>