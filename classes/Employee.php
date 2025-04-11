<?php

class Employee
{

    public $id;
    public $name;
    public $ppsn;
    public $salary;
    public $department_id;

    // creates object from table row
    public function __construct($props = null)
    {
        if ($props != null) {
            if (array_key_exists("id", $props)) {
                $this->id = $props["id"];
            }
            $this->name = $props["name"];
            $this->ppsn = $props["ppsn"];
            $this->salary = $props["salary"];
            $this->department_id = $props["department_id"];
        }
    }

    public function save()
    {
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $params = [
                ":name" => $this->name,
                ":ppsn" => $this->ppsn,
                ":salary" => $this->salary,
                ":department_id" => $this->department_id
            ];

            if ($this->id === null) {
                $sql =
                    "INSERT INTO employees " .
                    "(name, ppsn, salary, department_id) VALUES " .
                    "(:name, :ppsn, :salary, :department_id)";
            } else {
                $sql = "UPDATE employees SET " .
                    "name = :name, " .
                    "ppsn = :ppsn, " .
                    "salary = :salary, " .
                    "department_id = :department_id " .
                    "WHERE id = :id";

                $params[":id"] = $this->id;
            }

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

            if ($stmt->rowCount() !== 1) {
                throw new Exception("Failed to save employee.");
            }

            if ($this->id === null) {
                $this->id = $conn->lastInsertId();
            }
        } finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }
    }

    public function delete()
    {
        $db = null;

        try {
            if ($this->id !== null) {
                $db = new DB();
                $conn = $db->open();

                // check if exists in employee_project first then delete
                $employee_projects = EmployeeProject::findById($this->id);

                if ($employee_projects !== null) {
                    $sql = "DELETE FROM employee_project WHERE employee_id = :employee_id";
                    $params = [
                        ":employee_id" => $this->id
                    ];

                    $stmt = $conn->prepare($sql);
                    $status = $stmt->execute($params);
                }

                // delete
                $sql = "DELETE FROM employees WHERE id = :id";
                $params = [
                    ":id" => $this->id
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

                if ($stmt->rowCount() !== 1) {
                    throw new Exception("Failed to delete employee.");
                }

                $this->id = null;
            }
        } finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }
    }

    // Gets entire contents of the table as an array of row objects
    public static function findAll()
    {
        $employees = array();
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT * FROM employees";
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute();

            if (!$status) {
                $error_info = $stmt->errorInfo();
                throw new Exception("Error executing SQL: " . $error_info[2]);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    $employee = new Employee($row);
                    $employees[] = $employee;

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->open()) {
                $db->close();
            }
        }
        return $employees;
    }

    public static function findById($id)
    {
        $employee = null;
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT * FROM employees WHERE id = :id";

            $params = [
                ":id" => $id
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
                $employee = new Employee($row);
            }
        } finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }

        return $employee;
    }
}

?>