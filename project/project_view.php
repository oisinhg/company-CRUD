<?php
require_once '../etc/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['last-page'] = "project/project_view.php";

$projects = Project::findAll();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <title>Projects</title>
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/container.css">
</head>

<body>
    <div class="navbar-container">
        <a class="navbar-home" href="../index.php">Home</a>
        <a class="navbar-button" href="../employee/employee_view.php">Employees</a>
        <a class="navbar-button" href="../department/department_view.php">Departments</a>
        <a class="navbar-button" href="project_view.php">Projects</a>
    </div>

    <div class="container">
        <h1>Projects</h1>
        <p><a href="project_create.php"><button>Add another project</button></a></p>
        <?php if (count($projects) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?= $project->title ?></td>
                            <td><?= $project->description ?></td>
                            <td><?= $project->start_date ?></td>
                            <td><?= $project->end_date ?></td>
                            <td>
                                <a href="project_edit.php?id=<?= $project->id ?>"><button>Edit</button></a>
                                <form class="form-delete" action="project_delete.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $project->id ?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No projects found</p>
        <?php endif; ?>
    </div>
</body>

</html>