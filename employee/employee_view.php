<?php
require_once '../etc/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['last-page'] = "employee/employee_view.php";

$employees = Employee::findAll();
$departments = Department::findAll();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/container.css">

    <title>Employees</title>

    <style>
        a {
            color: #1e52c2;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        a:visited {
            color: #2753b4;
        }
    </style>
</head>

<body>
    <div class="navbar-container">
        <a class="navbar-home" href="../index.php">Home</a>
        <a class="navbar-button" href="employee_view.php">Employees</a>
        <a class="navbar-button" href="../department/department_view.php">Departments</a>
        <a class="navbar-button" href="../project/project_view.php">Projects</a>
    </div>

    <div class="container">
        <h1>Employees</h1>
        <p><a href="employee_create.php"><button>Add another employee</button></a></p>
        <?php if (count($employees) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>PPSN</th>
                        <th>Salary</th>
                        <th>Department</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><a href="employee_info.php?id=<?= $employee->id ?>"><?= $employee->name ?></a></td>
                            <td><?= $employee->ppsn ?></td>
                            <td><?= $employee->salary ?></td>
                            <td>
                                <?= $departments[$employee->department_id]->title ?>
                            </td>
                            <td>
                                <a href="employee_edit.php?id=<?= $employee->id ?>"><button>Edit</button></a>
                                <form class="form-delete" action="employee_delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= $employee->id ?>">
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