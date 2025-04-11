<?php
require_once "../etc/config.php";
require_once "../etc/global.php";

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }
    if (!array_key_exists("id", $_POST)) {
        throw new Exception("Invalid request parameters");
    }

    $id = $_POST["id"];

    $project = Project::findById($id);

    if ($project === null) {
        throw new Exception("Project not found");
    }

    $project->delete();

    redirect("../success.php");
} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>