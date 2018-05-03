<?php
    /**
     * upload selected file into uploads/ directory
     */
    function uploadFile() {
        if ( 0 < $_FILES['file']['error'] ) {
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = 'data.' . end($temp);
            move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $newfilename);
            include "readExcel.php"; //read file and add entries into database
        }
    }

    $extension = explode(".",$_FILES["file"]["name"]);
    if(strlen($_FILES["file"]["name"]) > 0 && ($extension[1] == 'xlsx' || $extension[1] == 'xls')) {
        uploadFile(); //upload file into directory
        echo "success";
    }
    else
        echo "Please select an excel file";

