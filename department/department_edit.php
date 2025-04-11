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
    $department = Department::findById($id);

    if ($department === null) {
        throw new Exception("Department not found");
    }
} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../css/container.css">
    <title>Edit Department</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Department</h2>
        <form action="department_update.php" method="POST">
            <input type="hidden" name="id" value="<?= $department->id ?>">

            <p>
                Title:
                <input type="text" name="title" value="<?= old("title", $department->title) ?>">
                <span class="error"><?= error('title') ?></span>
            </p>
            <p>
                Location:
                <input type="text" name="location" value="<?= old("location", $department->location) ?>">
                <span class="error"><?= error('location') ?></span>
            </p>
            <p>
                Website:
                <input type="text" name="website" value="<?= old("website", $department->website) ?>">
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