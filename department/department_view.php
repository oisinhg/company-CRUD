<?php
require_once '../etc/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['last-page'] = "department/department_view.php";

$departments = Department::findAll();

?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <title>Departments</title>
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/container.css">
</head>

<body>
    <div class="navbar-container">
        <a class="navbar-home" href="../index.php">Home</a>
        <a class="navbar-button" href="../employee/employee_view.php">Employees</a>
        <a class="navbar-button" href="department_view.php">Departments</a>
        <a class="navbar-button" href="../project/project_view.php">Projects</a>
    </div>
    <div class="container">
        <h1>Departments</h1>
        <p><a href="department_create.php"><button>Add another department</button></a></p>
        <?php if (count($departments) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($departments as $department): ?>
                        <tr>
                            <td><?= $department->title ?></td>
                            <td><?= $department->location ?></td>
                            <td><a href='https://www.<?= $department->website ?>'><?= $department->website ?></a></td>
                            <td>
                                <a href="department_edit.php?id=<?= $department->id ?>"><button>Edit</button></a>
                                <form class="form-delete" action="department_delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $department->id ?>">
                                    <input type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No profiles found</p>
        <?php endif; ?>
    </div>
</body>

</html>