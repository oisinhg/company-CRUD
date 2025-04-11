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
    $employee = Employee::findById($id);

    if ($employee === null) {
        throw new Exception("Employee not found");
    }

    $validator = new EmployeeFormValidator($_POST);
    $valid = $validator->validate();

    if ($valid) {
        $data = $validator->data();

        $employee->name = $data["name"];
        $employee->ppsn = $data["ppsn"];
        $employee->salary = $data["salary"];
        $employee->department_id = $data["department_id"];

        $employee->save();

        redirect('../success.php');
    }
    else {
        $errors = $validator->errors();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['form-data'] = $_POST;
        $_SESSION['form-errors'] = $errors;

        redirect("employee_edit.php?id=$id");
    }
}
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>