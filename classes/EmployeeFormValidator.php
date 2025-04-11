<?php 
class EmployeeFormValidator extends FormValidator {

    public function __construct($data = []) {
        parent::__construct($data);
    }

    public function validate() {
        $department_ids = Department::returnIDs();

        // validate the form fields, placing any error messages in
        // $this->errors array

        // name
        if (!$this->isPresent("name")) {
            $this->errors['name'] = "You must enter a name";
        }
        else if (!$this->minLength("name", 6)){
            $this->errors['name'] = "Name must be at least 6 characters";
        }

        // ppsn
        if (!$this->isPresent("ppsn")) {
            $this->errors['ppsn'] = "You must enter a PPSN";
        }
        else if (!$this->minLength("ppsn", 8)){
            $this->errors['ppsn'] = "PPSN must be at least 8 characters";
        }
        else if (!$this->isMatch("ppsn", '/^[0-9]{7,}[A-Z]{1,2}$/')) {
            $this->errors['ppsn'] = "PPSN must have 7 digits followed by 1 or 2 letters";
        }

        // salary 
        if (!$this->isPresent("salary")) {
            $this->errors['salary'] = "You must enter a salary";
        }
        else if (!$this->isInteger("salary") && !$this->isFloat("salary")) {
            $this->errors['salary'] = "Salary must be a number";
        }

        if (!$this->isPresent("department_id")) {
            $this->errors['department_id'] = "You must choose a department";
        }
        else if (!in_array($this->data['department_id'], $department_ids)) {
            $this->errors['department_id'] = "Please choose a valid department";
        }

        return count($this->errors) === 0;
    }
}

?>
