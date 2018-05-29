<?php
/**
 * Created by PhpStorm.
 * User: Gursimran Singh
 * Date: 5/16/18
 * Time: 11:47 PM
 */

class Database extends DbObject
{
    //table's column names
//    protected $participants_cols = array('first_name', 'last_name', 'dob', 'gender');

    /**
     * Update participant's information
     * @param $data
     * @param $id
     * @return bool
     */
    function updateParticipant($data, $id) {
        $tableName = "participants";
        $options = array("id" => $id);
        $columns = array("first_name", "last_name", "dob", "gender", "competition_id", "level_id");

        return $this->update($tableName, $columns, $options, $data);
    }

    /**
     * Update competition name
     * @param $data
     * @param $id
     * @return bool
     */
    function updateCompetition($data, $id)
    {
        $tableName = "competitions";
        $options = array("id" => $id);
        $columns = array("competition_name");

        return $this->update($tableName, $columns, $options, $data);
    }

    /**
     * Update criteria based on level id
     * @param $data
     * @param $id criteria id
     * @param $level_id
     * @return bool
     */
    function updateCriteria($data, $id, $level_id)
    {
        $tableName = "criteria";
        $options = array("id" => $id, "level_id" => $level_id);
        $columns = array("criteria", "level_id");

        return $this->update($tableName, $columns, $options, $data);
    }

    /**
     * Update level type
     * @param $data
     * @param $id
     * @return bool
     */
    function updateLevel($data, $id)
    {
        $tableName = "levels";
        $options = array("id"=>$id);
        $columns = array("level", "active");

        return $this->update($tableName, $columns, $options, $data);
    }

    function getCompetitions()
    {
        $tableName = "competitions";
        $options = array();

        $result = $this->select($tableName, $options);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all participants
     * @return array results
     */
    function getParticipants()
    {
        $tableName = "participants";
        $options = array();

        $result = $this->select($tableName, $options);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get participant by id
     * @return array results
     */
    function getParticipantById($id)
    {
        $tableName = "participants";
        $options = array("id" => $id);

        $result = $this->select($tableName, $options);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Get all levels
     * @return array results
     */
    function getLevels()
    {
        $tableName = "levels";
        $options = array();

        $result = $this->select($tableName, $options);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get all judges list
     * @return array results
     */
    function getJudges()
    {
        $tableName = "judges";
        $options = array();

        $result = $this->select($tableName, $options);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get criteria by id
     * @param $id
     * @return array
     */
    function getCriteriaByLevelId($id)
    {
        $tableName = "criteria";
        $options = array("level_id" => $id);

        $result = $this->select($tableName, $options);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get level by id
     * @param $id
     * @return array
     */
    function getLevelById($id)
    {
        $tableName = "levels";
        $options = array("id" => $id);

        $result = $this->select($tableName, $options);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get level by id
     * @return array
     */
    function getConnectedLevels()
    {
        $tableName = "levels,competitions,judges_levels";
        $options = array("levels.id" => "level_id", "competitions.id" => "competition_id");

        $result = $this->select($tableName, $options);

        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Insert name of competition
     * @param $data
     * @return PDOStatement
     */
    function insertCompetition($data)
    {
        $tableName = "competitions";
        $columns = array("competition_name");

        return $this->insert($tableName, $columns, $data);
    }

    function insertJudge_level_comp_ids($data)
    {
        $tableName = "judges_levels";
        $columns = array("judge_id", "level_id", "competition_id");

        return $this->insert($tableName, $columns, $data);
    }

    /**
     * Insert participants details
     * @param $data
     * @return PDOStatement
     */
    function insertParticipant($data)
    {
        $tableName = "participants";
        $columns = $participants_cols = array('first_name', 'last_name', 'dob',
            'gender', 'competition_id', 'level_id');

        return $this->insert($tableName, $columns, $data);
    }

    /**
     * Insert levels
     * @param $data
     * @return PDOStatement
     */
    function insertLevel($data)
    {
        $tableName = "levels";
        $columns = array("level", "active");

        return $this->insert($tableName, $columns, $data);
    }

    /**
     * Insert criteria
     * @param $data
     * @return PDOStatement
     */
    function insertCriteria($data)
    {
        $tableName = "criteria";
        $columns = array("criteria", "level_id");

        return $this->insert($tableName, $columns, $data);
    }

    /**
     * Insert judges details
     * @param $data
     * @return PDOStatement
     */
    function insertJudge($data)
    {
        $tableName = "judges";
        $columns = array("judge_name", "username", "password");

        $username = $this->generateUsername($data);
        $password = $this->generatePassword($data);
        //push username and password beside with judge name
        array_push($data, $username, $password);

        return $this->insert($tableName, $columns, $data);
    }

    //method for generating username for judge
    private function generateUsername($data)
    {
        //remove white space
        $name = str_replace(' ', '', $data[0]);
        $randomString = "";

        //create user name by selecting random letters from judge name
        for($i = 0; $i < 5; $i++) {
            $randomString .= $name[rand(0, strlen($name) - 1)];
        }

        //return username
        return strtolower($randomString);
    }

    //Method for generating password for judge
    private function generatePassword($data)
    {
        //remove white space
        $name = str_replace(' ', '', $data[0]);

        //get last four characters of the name
        $pass = substr($name, -4);
        $pass .= ".pass"; //end password with ".pass"

        //return password
        return strtolower($pass);
    }

    /**
     * Assign levels to participants
     * @param $participant_id
     * @param $level_id
     * @return PDOStatement
     */
    function assignLevelToParticipant($participant_id, $level_id)
    {
        $tableName = "participant_levels";
        $columns = array("participant_id", "level_id");
        $data = array($participant_id, $level_id);

        return $this->insert($tableName, $columns, $data);
    }

    /**
     * Assign levels and competitions to judges
     * @param $judge_id
     * @param $level_id
     * @param $competition_id
     * @return PDOStatement
     */
    function assignLev_CompToJudges($judge_id, $level_id, $competition_id)
    {
        $tableName = "judges_levels";
        $columns = array("judge_id", "level_id", "competition_id");
        $data = array($judge_id, $level_id, $competition_id);

        return $this->insert($tableName, $columns, $data);
    }

    /**
     * Delete participant from participants table
     * @param $id
     * @return bool
     */
    function deleteParticipant($id) {

        $tblName = 'participants';
        $options = array('id' => $id);

        return $this->delete($tblName, $options);
    }
}