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

    $employees = Employee::findAll();

    foreach ($employees as $emp_match) {
        if ($emp_match->department_id == $id) {
            $emp_match->delete();
        }
    }

    $department = Department::findById($id);

    if ($department === null) {
        throw new Exception("Department not found");
    }

    $department->delete();

    redirect("../success.php");
}
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>