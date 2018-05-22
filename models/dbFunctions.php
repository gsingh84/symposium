<?php

//    require_once '/home2/fastwebg/symposiumConfig.php';
    require_once '/home/gsinghgr/config.php';



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

     * Insert level name
     * @param level new level to insert
     * @return last insert row id
     */
    function insertLevels($level){

        //define query
        $sql = "INSERT INTO levels(level) VALUES (:level)";

        global $dbh;

        //prepare the statement
        $statement = $dbh->prepare($sql);

        //bind parameters
        $statement->bindParam(':level', $level, PDO::PARAM_STR);

        //execute statement
        $statement->execute();
        $id = $dbh->lastInsertId();

        return $id;
    }



    function insertScores($id, $score) {

        global $dbh;

        //Define the query
        $sql = "INSERT INTO scores VALUES (:id, :score);";

        //Prepare the statement
        $statement = $dbh->prepare($sql);

        //3. Bind parameters
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->bindParam(':score', $score, PDO::PARAM_STR);

        //4. Execute the query
        $success = $statement->execute();

        //5. Return the result
        return $success;
    }


    /**
     * Insert criteria text into the database table
     *
     * @param $text some text
     * @param $id
     */
    function insertCriteria($text, $id){

        //define query
        $sql = "INSERT INTO criteria(criteria, level_id) VALUES (:criteria, (SELECT id FROM levels WHERE id = :level_id))";

        global $dbh;

        //prepare the statement
        $statement = $dbh->prepare($sql);

        //bind parameters
        $statement->bindParam(':criteria', $text, PDO::PARAM_STR);
        $statement->bindParam(':level_id', $id, PDO::PARAM_INT);

        //execute statement
        $statement->execute();
    }

    /**
     * get all candidates list from database
     *
     * @return all participants list
     */
    function getAllRows($tableName) {

        //get all rows from db
        $sql = "SELECT * FROM $tableName";

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



    function getLevels() {

        //get all rows from db
        $sql = "SELECT * FROM levels";

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



    //get criteria text by id
    function getCriteria($id) {

        //get all rows from db
        $sql = "SELECT * FROM criteria WHERE level_id = :id";

        global $dbh;

        //prepare statement
        $statement = $dbh->prepare($sql);

        //bind params
        $statement->bindParam(':id', $id, PDO::PARAM_INT);

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

    // Insert judges
    function insertJudge($name){

        //define query
        $sql = "INSERT INTO judges(name) VALUES (:name)";

        global $dbh;

        //prepare the statement
        $statement = $dbh->prepare($sql);

        //bind parameters
        $statement->bindParam(':name', $name, PDO::PARAM_STR);

        //execute statement
        $statement->execute();

        $id = $dbh->lastInsertId();
        return $id;
    }

    // delete judge
    function deleteJudge($id){

        //define query
        $sql = "DELETE FROM judges WHERE id = (:id)";

        global $dbh;

        //prepare the statement
        $statement = $dbh->prepare($sql);

        //bind parameters
        $statement->bindParam(':id', $id, PDO::PARAM_STR);

        //execute statement
        $statement->execute();
        $id = $dbh->lastInsertId();

        return $id;

    }

