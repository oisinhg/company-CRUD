<?php 
require_once '../etc/global.php';
require_once '../etc/config.php';

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

    $validator = new ProjectFormValidator($_POST);
    $valid = $validator->validate();

    if ($valid) {
        $data = $validator->data();

        $project->title = $data["title"];
        $project->description = $data["description"];
        $project->start_date = $data["start_date"];
        $project->end_date = $data["end_date"];

        $project->save();
        redirect('../success.php');
    }
    else {
        $errors = $validator->errors();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['form-data'] = $_POST;
        $_SESSION['form-errors'] = $errors;

        redirect("project_edit.php?id=$id");
    }
}
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>