<?php
require_once "../etc/config.php";
require_once "../etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {

    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        throw new Exception("Invalid request method");
    }
    if (!array_key_exists("id", $_GET)) {
        throw new Exception("Invalid request parameters");
    }

    $id = $_GET["id"];
    $employee = Employee::findById($id);

    if ($employee === null) {
        throw new Exception("Employee not found");
    }

    $departments = Department::findAll();

    $projects = Project::findAll();

    $employee_projects = EmployeeProject::findById($id);

} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>

<!DOCTYPE>
<html lang="en">

<head>
    <title>EmployeeInfo</title>
    <link rel="stylesheet" href="../css/card.css">
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/container.css">
</head>

<body>
    <div class="container">
        <h1>Employee Info</h1>

        <p><a href="employee_view.php"><button>←Go Back</button></a></p>

        <!-- This card design taken from w3schools -->
        <div class="card">
            <img src="../images/avatar.png" alt="Avatar" style="width:100%">
            <div class="container">
                <h4><b>Name:</b></h4>
                <?= $employee->name ?>
                <h4><b>Department:</b></h4>
                <?= $departments[$employee->department_id]->title ?>
            </div>
        </div>

        <?php if ($employee_projects !== null): ?>
            <h3>Projects associated with this employee:</h3>
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Start</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employee_projects as $employee_project): ?>
                            <tr>
                                <td><?= $projects[$employee_project->project_id]->title ?></td>
                                <td><?= $projects[$employee_project->project_id]->description ?></td>
                                <td><?= $projects[$employee_project->project_id]->start_date ?></td>
                                <td><?= $projects[$employee_project->project_id]->end_date ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        <?php else: ?>
            <p><strong>No projects associated with this employee.</strong></p>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
if (array_key_exists("form-data", $_SESSION)) {
    unset($_SESSION["form-data"]);
}
if (array_key_exists("form-errors", $_SESSION)) {
    unset($_SESSION["form-errors"]);
}
?>