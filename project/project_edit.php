<?php
require_once "../etc/config.php";
require_once "../etc/global.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    if ($_SERVER["REQUEST_METHOD"] !== "GET") {
        throw new Exception("Invalid request type");
    }
    if (!array_key_exists("id", $_GET)) {
        throw new Exception("Invalid request parameters");
    }

    $id = $_GET["id"];

    $project = Project::findById($id);

    if ($project === null) {
        throw new Exception("Project not found");
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
    <title>Edit Project</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Project</h2>
        <form action="project_update.php" method="POST">
            <input type="hidden" name="id" value="<?= $project->id ?>">
            <p>
                Title:
                <input type="text" name="title" value="<?= old('title', $project->title) ?>">
                <span class="error"><?= error('title') ?></span>
            </p>

            <p>
                Description:
                <input type="text" name="description" value="<?= old('description', $project->description) ?>">
                <span class="error"><?= error('description') ?></span>
            </p>

            <p>
                Start Date:
                <input type="date" name="start_date" value="<?= old('start_date', $project->start_date) ?>">
                <span class="error"><?= error('start_date') ?></span>
            </p>

            <p>
                End Date:
                <input type="date" name="end_date" value="<?= old('end_date', $project->end_date) ?>">
                <span class="error"><?= error('end_date') ?></span>
            </p>

            <p>
                <a href="project_view.php"><button type="button">Cancel</button></a>
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