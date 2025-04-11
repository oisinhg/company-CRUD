<?php
class DepartmentFormValidator extends FormValidator {

    public function __construct($data = []) {
        parent::__construct($data);
    }

    public function validate() {
        // validate the form fields, placing any error messages in
        // $this->errors array

        // title
        if (!$this->isPresent("title")) {
            $this->errors['title'] = "You must enter a title";
        }
        else if (!$this->minLength("title", 4)){
            $this->errors['title'] = "Title must be at least 4 characters";
        }

        // location
        if (!$this->isPresent("location")) {
            $this->errors['location'] = "You must enter a location";
        }
        else if (!$this->minLength("location", 6)){
            $this->errors['location'] = "Location must be at least 6 characters";
        }

        // website 
        if (!$this->isPresent("website")) {
            $this->errors['website'] = "You must enter a website";
        }
        else if (!$this->isMatch("website", '/.com|.org|.co.uk|.ie/')) {
            $this->errors['website'] = "Web address in wrong format";
        }

        return count($this->errors) === 0;
    }
} 
?>