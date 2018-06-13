<?php
    /**
     * This file validates "create competition" form data.
     */

    //store errors
    $errors = array("comp-name" => "", "selected-level" => "", "judges" => "", "add-participant" => "");
    $success = true;

    //form submitted?
    if (isset($_POST['submit'])) {
        //competition field is empty?
        if(empty($_POST['comp-name'])) {
           $errors['comp-name'] = "Competition name is required";
           $success = false;
        }
        //make sure user selected level
        if($_POST['selected-level'] == "none") {
            $errors['selected-level'] = "Please select a level";
            $success = false;
        }
        //make sure user selected at least one judge
        if(!isset($_POST['judges'])) {
            $errors['judges'] = "Need at least one judge";
            $success = false;
        }
        //make sure user adding participants
        if(!isset($_SESSION['participants']) && !isset($_POST['add-excel'])) {
            $errors['add-participant'] = "Participants are required for competition";
            $success = false;
        }
    }

    if (!$success) {
        //send errors in json format to admin.js
        echo json_encode($errors);
    }