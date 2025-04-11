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

    $employee = Employee::findById($id);

    if ($employee === null) {
        throw new Exception("Employee not found");
    }

    $employee->delete();

    redirect("../success.php");
}
catch (Exception $ex) {
    echo $ex->getMessage();
    exit();
}
?>