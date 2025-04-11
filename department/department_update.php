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
    $department = Department::findById($id);

    if ($department === null) {
        throw new Exception("Department not found");
    }

    $validator = new DepartmentFormValidator($_POST);
    $valid = $validator->validate();

    if($valid) {
        $data = $validator->data();

        $department->title = $data["title"];
        $department->location = $data["location"];
        $department->website = $data["website"];

        $department->save();

        redirect("../success.php");
    }
    else {
        $errors = $validator->errors();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION["form-data"] = $_POST;
        $_SESSION["form-errors"] = $errors;

        redirect("department_edit.php?id=$id");
    }

} catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>