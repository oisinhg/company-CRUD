<?php
class ProjectFormValidator extends FormValidator
{

    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    public function validate()
    {
        // validate the form fields, placing any error messages in
        // $this->errors array

        // title
        if (!$this->isPresent("title")) {
            $this->errors['title'] = "You must enter a title";
        } else if (!$this->minLength("title", 4)) {
            $this->errors['title'] = "Title must be at least 4 characters";
        }

        // description
        if (!$this->isPresent("description")) {
            $this->errors['description'] = "You must enter a description";
        }

        // start date 
        if (!$this->isPresent("start_date")) {
            $this->errors['start_date'] = "You must enter a starting date";
        }
        else if (!$this->isMatch("start_date", '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/')) {
            $this->errors['start_date'] = "Invalid date format";
        }

        // end date 
        if (!$this->isPresent("end_date")) {
            $this->errors['end_date'] = "You must enter an ending date";
        }
        else if (!$this->isMatch("end_date", '/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/')) {
            $this->errors['end_date'] = "Invalid date format";
        }
        
        return count($this->errors) === 0;
    }
}
?>