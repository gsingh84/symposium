<?php
/**
 * Created by PhpStorm.
 * User: Gursimran Singh
 * Date: 5/16/18
 * Time: 10:37 PM
 */

class DbObject
{
    //define database handle
    protected  $dbh;

    /**
     * create new database object
     */
    public function __construct()
    {
        $this->dbh = $this->connect();
    }

    /**
     * Method for creating a db connection and
     * connecting to database.
     * @return PDO
     */
    public function connect()
    {
        try{
            //Instantiate a database object
            $dbh = new PDO(DB_DSN,DB_USERNAME, DB_PASSWORD);
        }
        catch(PDOException $e){
            echo "fail: " . $e->getMessage();
        }

        return $dbh;
    }


    public function update($tableName, $columns, $options, $data)
    {
        if(empty($tableName) || empty($columns) || empty($data)
            || !is_array($columns) || !is_array($data))
            die("Method " . __METHOD__ . ": parameters error.");

        //create update query string
        $update = "";
        foreach ($data as $key => $value) {
            if(in_array($key, $columns))
                $update .= $key . '=:' . $key . ', ';
        }
        $update = rtrim($update, ', ');

        $where = ""; //create where condition
        foreach ($options as $key => $value) {
            $where .= $key . '=:' . $key . ' AND ';
        }
        $where = empty($where) ? '': ' WHERE ' . rtrim($where, ' AND ');

        //define query
        $sql = "UPDATE $tableName SET {$update} {$where}";

        //prepare statement
        $statement = $this->dbh->prepare($sql);

        //bind params
        foreach ($data as $key => &$value) {
            $statement->bindParam(':'.$key, $value);
        }
        foreach ($options as $key => &$value) {
            $statement->bindParam(':'.$key, $value);
        }

        //execute statement
        $result = $statement->execute();

        return $result;
    }

    /**
     * Select rows from given table name
     * @param $tableName name of the table
     * @param $options columns to look for
     * @return PDOStatement
     */
    public function select($tableName, $options)
    {
        $where = "";
        foreach($options as $key => $value) {
                $where .= $key . '=:' . $key . ' AND ';
        }

        //check where condition
        $where = empty($where) ? '': ' WHERE ' . rtrim($where, ' AND ');

        //define query
        $sql = "SELECT * FROM {$tableName} {$where}";

        //prepare statement
        $statement = $this->dbh->prepare($sql);

        //bind params
        foreach ($options as $key => &$value) {
            $statement->bindParam(':'.$key, $value);
        }

        //execute statement
        $statement->execute();

        return $statement;
    }

    /**
     * Method that insert the data into the database
     * @param $tableName name of the table
     * @param $columns columns name
     * @param $data need to insert
     * @return PDOStatement
     */
    public function insert($tableName, $columns, $data)
    {
        if(empty($tableName) || empty($columns) || empty($data)
            || !is_array($columns) || !is_array($data))
            die("Method " . __METHOD__ . ": parameters error.");

        $placeHolders = "";
        $columnsName = "";

        //loop over to get all placeholders and columns in variables
        for($i = 0; $i < sizeof($data); $i++) {
            if($data[$i] != end($data)) {
                $columnsName .= $columns[$i].',';
                $placeHolders .= ':'.$columns[$i].',';
            } else {
                $columnsName .= $columns[$i];
                $placeHolders .= ':'.$columns[$i];
            }
        }

        //define query
        $sql = "INSERT INTO $tableName($columnsName) VALUES ($placeHolders)";

        //prepare the statements
        $statement = $this->dbh->prepare($sql);

        //bind parameters
        for($i = 0; $i < sizeof($data); $i++) {
            $statement->bindParam(':'.$columns[$i], $data[$i]);
        }

        //execute statement
        $statement->execute();

        //return last inserted id
        return $this->dbh->lastInsertId();
    }
}