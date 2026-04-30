<!DOCTYPE html>
<html>
<head>
    <title>Student System</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Student List</h2>
    <a href="/students/create" class="btn btn-primary mb-3">Add Student</a>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($students as $s): ?>
            <tr>
                <td><?= $s['id'] ?></td>
                <td><?= $s['name'] ?></td>
                <td><?= $s['email'] ?></td>
                <td>
                    <a href="/students/edit/<?= $s['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/students/delete/<?= $s['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-3">
        <?= $pager->links() ?>
    </div>
</body>
</html>