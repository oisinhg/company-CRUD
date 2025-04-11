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
} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/container.css">
    <title>Edit Employee</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Employee</h2>
        <form action="employee_update.php" method="POST">
            <input type="hidden" name="id" value="<?= $employee->id ?>">
            <p>
                Name:
                <input type="text" name="name" value="<?= old("name", $employee->name) ?>">
                <span class="error"><?= error('name') ?></span>
            </p>
            <p>
                PPSN:
                <input type="text" name="ppsn" value="<?= old("ppsn", $employee->ppsn) ?>">
                <span class="error"><?= error('ppsn') ?></span>
            </p>
            <p>
                Salary:
                <input type="text" name="salary" value="<?= old("salary", $employee->salary) ?>">
                <span class="error"><?= error('salary') ?></span>
            </p>
            <p>
                Department:
                <select name="department_id">
                    <option value="">Please choose the department....</option>
                    <option value="1" <?= chosen("department_id", "1", $employee->department_id) ? "selected" : "" ?>>
                        Outdoors & Shoes
                    </option>
                    <option value="2" <?= chosen("department_id", "2", $employee->department_id) ? "selected" : "" ?>>
                        Toys
                    </option>
                    <option value="3" <?= chosen("department_id", "3", $employee->department_id) ? "selected" : "" ?>>
                        Garden & Shoes
                    </option>
                </select>
                <span class="error"><?= error('department_id') ?></span>
            </p>

            <a href="employee_view.php"><button type="button">Cancel</button></a>
            <button type="submit">Update</button>
        </form>
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