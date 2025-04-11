<?php

class EmployeeProject
{

    public $employee_id;
    public $project_id;

    // creates object from table row
    public function __construct($props = null)
    {
        if ($props != null) {
            $this->employee_id = $props["employee_id"];
            $this->project_id = $props["project_id"];
        }
    }

    public static function findById($employee_id) {
        $employee_projects = null;
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT * FROM employee_project WHERE employee_id = :employee_id";

            $params = [
                ":employee_id" => $employee_id
            ];

            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = sprintf(
                    "SQLSTATE error code: %d; error message: %s",
                    $error_info[0],
                    $error_info[2]
                );
                throw new Exception($message);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    $employee_project = new EmployeeProject($row);
                    $employee_projects[] = $employee_project;

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        }
        finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }

        return $employee_projects;
    }

    // Gets entire contents of the table as an array of row objects
    public static function findAll() {
        $employee_projects = array();
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT * FROM employee_project";
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute();
            
            if (!$status) {
                $error_info = $stmt->errorInfo();
                throw new Exception("Error executing SQL: " . $error_info[2]);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    $employee_project = new EmployeeProject($row);
                    $employee_projects[] = $employee_project;

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        }
        finally {
            if ($db !== null && $db->open()) {
                $db->close();
            }
        }
        return $employee_projects;
    }

}

?>