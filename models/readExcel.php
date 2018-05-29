<?php
    //set error reporting
    error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);

    //include excel reader library
    include("reader/Classes/PHPExcel/IOFactory.php");
    include("dbFunctions.php");

    //load excel file
    try {
        $objPHPExcel = PHPExcel_IOFactory::load("uploads/data.xlsx");
    } catch (PHPExcel_Reader_Exception $e) {
        echo "File not found!";
    }

    if(isset($_POST['comp_id'])) {
        //array for holding each row
        $output = array();

        //loop over to get file as worksheet
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
        {

            $highestRow = $worksheet->getHighestRow();
            $hCol = $worksheet->getHighestColumn();
            $nCol = ord(strtolower($hCol)) - 96;

            //get every row
            for($row=2; $row<=$highestRow; $row++)
            {
                //get every column
                for($col=0; $col<=$nCol; $col++)
                {
                    $data = $worksheet->getCellByColumnAndRow($col, $row)->getValue();

                    //check the cell is not empty
                    if(!empty($data)) {
                        //add each row into array
                        if($col == 0) {
                            $name = explode(" ", $data);

                            if(sizeof($name) == 2) {
                                array_push($output, $name[0], $name[1]);
                            } else{
                                array_push($output, $name[0], $name[sizeof($name) - 1]);
                            }
                        } else {
                            array_push($output, $data);
                        }
                    }
                }

                //insert row into database
                array_push($output, $_POST['comp_id'], $_POST['level_id']);
                insertParticipant($output);
                $output = array();
            }
        }
    }



