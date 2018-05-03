<?php
    require_once '/home2/fastwebg/symposiumConfig.php';

    $dbh;
    connect();

    /**
     * Connect to database
     */
    function connect() {
        try{
            global $dbh;
            //Instantiate a database object
            $dbh = new PDO(DB_DSN,
                DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e){
            echo "fail: " . $e->getMessage();
            echo $e->getMessage();
        }
    }

    /**
     * Insert participant details into database
     */
    function insertParticipant($data) {
        //column names
        $columnsName = array('first_name', 'last_name', 'dob', 'gender');
        $columns = "";

        //loop over to get all columns
        foreach ($columnsName as $column) {
            if($column != end($columnsName)) {
                $columns .= $column.',';
            } else {
                $columns .= $column;
            }
        }

        //define query
        $sql = "INSERT INTO participants($columns) VALUES (:first_name, :last_name, :dob, :gender)";

        global $dbh;

        //prepare the statements
        $statement = $dbh->prepare($sql);

        //bind parameters
        for($i = 0; $i < sizeof($data); $i++) {
            $statement->bindParam(':'.$columnsName[$i], $data[$i], PDO::PARAM_STR);
        }

        //execute statement
        $statement->execute();
    }

    /**
     * get all candidates list from database
     *
     * @return all participants list
     */
    function getAllParticipants() {
        //get all rows from db
        $sql = "SELECT * FROM participants";

        global $dbh;

        //prepare statement
        $statement = $dbh->prepare($sql);

        //execute statement
        $statement->execute();

        //fetch all rows
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        //return data
        return $result;
    }

/**
 * get particular participant
 *
 * @return selected participant
 */
function getParticipant($id) {
    //get all rows from db
    $sql = "SELECT * FROM participants WHERE id = :id ";

    global $dbh;

    //prepare statement
    $statement = $dbh->prepare($sql);

    //bind params
    $statement->bindParam(':id',$id, PDO::PARAM_INT);

    //execute statement
    $statement->execute();

    //fetch all rows
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    //return data
    return $result;
}


