<?php
    //store errors
    $errors = array("level-name" => "none", "time-allowed" => "none");
    $success = true;

    if (isset($_POST['submit'])) {
        //level name field is empty?
        if(empty($_POST['level-name'])) {
            $errors['level-name'] = "1px solid red";
            $success = false;
        }
        //time allowed field is empty?
        if(empty($_POST['time-allowed'])) {
            $errors['time-allowed'] = "1px solid red";
            $success = false;
        }
    }

    if (!$success) {
        //send errors in json format to admin.js
        echo json_encode($errors);
    }