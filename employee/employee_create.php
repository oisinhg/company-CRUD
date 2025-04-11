<?php
require_once "../etc/config.php";
require_once "../etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$departments = Department::findAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/container.css">
    <title>Database Entry Form</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Employee Data Entry Form</h2>
        <form action="employee_store.php" method="POST">
            <p>
                Name:
                <input type="text" name="name" value="<?= old('name') ?>">
                <span class="error"><?= error('name') ?></span>
            </p>
            <p>
                PPSN:
                <input type="text" name="ppsn" value="<?= old('ppsn') ?>">
                <span class="error"><?= error('ppsn') ?></span>
            </p>
            <p>
                Salary:
                <input type="text" name="salary" value="<?= old('salary') ?>">
                <span class="error"><?= error('salary') ?></span>
            </p>
            <p>
                Department:
                <select name="department_id">
                    <option value="">Please choose the department...</option>
                    <?php foreach ($departments as $department): ?>
                        <option value=<?= $department->id ?> <?= chosen("department_id", $department->id) ? "selected" : ""; ?>> <?= $department->title ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="error"><?= error('department_id') ?></span>
            </p>
            <p>
                <a href="employee_view.php"><button type="button">Cancel</button></a>
                <button type="submit">Submit</button>
            </p>
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