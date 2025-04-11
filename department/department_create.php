<?php
require_once '../etc/config.php';
require_once "../etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../css/container.css">
    <title>Department Entry Form</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Department Entry Form</h2>
        <form action="department_store.php" method="POST">
            <p>
                Title:
                <input type="text" name="title" value="<?= old('title') ?>">
                <span class="error"><?= error('title') ?></span>
            </p>

            <p>
                Location:
                <input type="text" name="location" value="<?= old('location') ?>">
                <span class="error"><?= error('location') ?></span>
            </p>

            <p>
                Website:
                <input type="text" name="website" value="<?= old('website') ?>">
                <span class="error"><?= error('website') ?></span>
            </p>

            <p>
                <a href="department_view.php"><button type="button">Cancel</button></a>
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