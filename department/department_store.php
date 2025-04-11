<?php
require_once "../etc/config.php";
require_once "../etc/global.php";

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        throw new Exception("Invalid request method");
    }

    $validator = new DepartmentFormValidator($_POST);
    $valid = $validator->validate();

    if ($valid) {
        $data = $validator->data();
        $department = new Department($data);
        $department->save();
        redirect('../success.php');
    }
    else {
        $errors = $validator->errors();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['form-data'] = $_POST;
        $_SESSION['form-errors'] = $errors;

        redirect('department_create.php');

    }
}
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>