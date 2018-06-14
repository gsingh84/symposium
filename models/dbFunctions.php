<?php
//    require_once '/home2/fastwebg/symposiumConfig.php';
require_once '/home/asinghgr/config.php';

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
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
    $columnsName = array('first_name', 'last_name', 'dob', 'gender', 'competition_id', 'level_id');
//        $columnsName = array('first_name', 'last_name', 'dob', 'gender');
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
    $sql = "INSERT INTO participants($columns) VALUES (:first_name, :last_name, :dob, :gender, :competition_id, :level_id)";
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

/**
 * get participants with same level
 *
 * @return participants
 */
function getParticipants($id) {
    //get all rows from db
    $sql = "SELECT * FROM participants WHERE level_id = :id ";
    global $dbh;
    //prepare statement
    $statement = $dbh->prepare($sql);
    //bind params
    $statement->bindParam(':id',$id, PDO::PARAM_INT);
    //execute statement
    $statement->execute();
    //fetch all rows
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //return data
    return $result;
}

/**
 * get judge id on log in
 *
 * @return selected judge id
 */
function getJudgeId($username) {
    //get all rows from db
    $sql = "SELECT * FROM judges WHERE username = :username ";
    global $dbh;
    //prepare statement
    $statement = $dbh->prepare($sql);
    //bind params
    $statement->bindParam(':username',$username, PDO::PARAM_INT);
    //execute statement
    $statement->execute();
    //fetch all rows
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //return data
    return $result;
}

/**
 * get all the competitions for the judge
 *
 * @return all the competitions for the judge
 */
function getAllCompetitions($id) {
    //get all rows from db
    $sql = "SELECT DISTINCT competitions.competition_name FROM judges, competitions, judges_levels WHERE judges.id = :id";
    global $dbh;
    //prepare statement
    $statement = $dbh->prepare($sql);
    //bind params
    $statement->bindParam(':id',$id, PDO::PARAM_INT);
    //execute statement
    $statement->execute();
    //fetch all rows
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //return data
    return $result;
}

/**
 * get all the levels for the judge
 *
 * @return all the levels for the judge
 */
function getAllLevels($compid) {
    //get all rows from db
    $sql = "SELECT DISTINCT levels.level, levels.active FROM levels, judges_levels WHERE level_id = levels.id AND competition_id = :compid";
    global $dbh;
    //prepare statement
    $statement = $dbh->prepare($sql);
    //bind params
    $statement->bindParam(':compid',$compid, PDO::PARAM_INT);
    //execute statement
    $statement->execute();
    //fetch all rows
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    //return data
    return $result;
}

/**
 * get comp id on
 *
 * @return selected comp id
 */
function getCommpid($compname) {
    //get all rows from db
    $sql = "SELECT id FROM competitions WHERE competition_name = :compname ";
    global $dbh;
    //prepare statement
    $statement = $dbh->prepare($sql);
    //bind params
    $statement->bindParam(':compname',$compname, PDO::PARAM_INT);
    //execute statement
    $statement->execute();
    //fetch all rows
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    //return data
    return $result;
}

/**
 * get level id on
 *
 * @return level comp id
 */
function getLevelid($levelName) {
    //get all rows from db
    $sql = "SELECT id FROM levels WHERE level = :levelName ";
    global $dbh;
    //prepare statement
    $statement = $dbh->prepare($sql);
    //bind params
    $statement->bindParam(':levelName',$levelName, PDO::PARAM_INT);
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

//select competitions and levels from multiple tables
function selectCompAndLevels($groupBy) {

    $table = "judges_levels";
    $inner_join1 = "levels";
    $joinIdFrom1 = "judges_levels.level_id = levels.id";
//    $joinIdTO1 = "levels.id";

    $inner_join2 = "competitions";
    $joinIdFrom2 = "judges_levels.competition_id";
    $joinIdTO2 = "competitions.id";


    $sql = "SELECT * FROM $table INNER JOIN $inner_join1 ON $joinIdFrom1
    INNER JOIN $inner_join2 ON $joinIdFrom2 = $joinIdTO2 GROUP BY $groupBy";


    //get all rows from db
//    $sql = "SELECT * FROM judges_levels INNER JOIN levels ON judges_levels.level_id = levels.id
//    INNER JOIN competitions ON judges_levels.competition_id = competitions.id GROUP BY $groupBy";

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


