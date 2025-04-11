<?php 

class Department {

    public $id;
    public $title;
    public $location;
    public $website;

    // creates object from table row
    public function __construct($props = null) {
        if ($props != null) {
            if (array_key_exists("id", $props)) {
                $this->id = $props["id"];
            }
            $this->title = $props["title"];
            $this->location  = $props["location"];
            $this->website = $props["website"];
        }
    }

    public function save() {
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $params = [
                ":title" => $this->title,
                ":location" => $this->location,
                ":website" => $this->website
            ];

            if ($this->id === null) {
                $sql = 
                    "INSERT INTO departments " . 
                    "(title, location, website) VALUES " . 
                    "(:title, :location, :website)";
            }
            else {
                $sql = "UPDATE departments SET " .
                        "title = :title, " . 
                        "location = :location, " . 
                        "website = :website " . 
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
                throw new Exception("Failed to save department.");
            }

            if ($this->id === null) {
                $this->id = $conn->lastInsertId();
            }
        }
        finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }
    }

    public function delete() {
        $db = null;

        try {
            if ($this->id !== null) {
                $db = new DB();
                $conn = $db->open();

                // delete
                $sql = "DELETE FROM departments WHERE id = :id";
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
                    throw new Exception("Failed to delete department.");
                }

                $this->id = null;
            }
        }
        finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }
    }

    // Gets entire contents of the table as an array of row objects
    public static function findAll() {
        $departments = array();
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT * FROM departments";
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute();
            
            if (!$status) {
                $error_info = $stmt->errorInfo();
                throw new Exception("Error executing SQL: " . $error_info[2]);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    $department = new Department($row);
                    $departments[$department->id] = $department;

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        }
        finally {
            if ($db !== null && $db->open()) {
                $db->close();
            }
        }
        return $departments;
    }

    public static function findById($id) {
        $department = null;
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT * FROM departments WHERE id = :id";

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
                $department = new Department($row);
            }
        }
        finally {
            if ($db !== null && $db->isOpen()) {
                $db->close();
            }
        }

        return $department;
    }

    public static function returnIDs() {
        $department_ids = array();
        $db = null;

        try {
            $db = new DB();
            $conn = $db->open();

            $sql = "SELECT id FROM departments";
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute();
            
            if (!$status) {
                $error_info = $stmt->errorInfo();
                throw new Exception("Error executing SQL: " . $error_info[2]);
            }

            if ($stmt->rowCount() !== 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                while ($row) {
                    $department_ids[] = $row["id"];

                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        }
        finally {
            if ($db !== null && $db->open()) {
                $db->close();
            }
        }
        return $department_ids;
    }
}

?>