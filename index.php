<?php
    //turning on the error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);

    //Require the files (fat-free)
    require_once('vendor/autoload.php');

    require_once '/home/asinghgr/config.php';
    require_once "models/dbFunctions.php";


    //Create an instance of the Base Class
    $f3 = Base :: instance();

    //Set debug level
    //will take care of php errors as well which gives 500 error
    $f3->set('DEBUG', 3);

    /**
     ***********************************************************************
     ******* Initial route *******
     *************************************************************************
     */

    //list of all competitions
    $f3->route('GET|POST /', function($f3){

        session_start();
        session_unset();

        //get competitions and levels
        $competitions = selectJoin();

        $f3->set('competitions', $competitions);

        //render
        $template = new Template();
        echo $template->render('views/add-more.html');
    });

//    $f3->route('GET|POST /', function ()
//    {
//        session_start();
//
//        session_unset();
//        $template = new Template();
//        //render
//        echo $template->render('views/admin-home.html');
//    });




    $f3->route('GET|POST /create', function ($f3)
    {
        session_start();

        //get all levels and judges list
        $db = new Database();
        $levels = $db->getLevels();
        $judges = $db->getJudges();
        $f3->set('levels', $levels);
        $f3->set('judges', $judges);

        if (isset($_POST['next'])) {
            $_SESSION['form'] = $_POST;
        }

        //form submitted?
        if(isset($_POST['submit'])) {
            //insert competition
            $comp_id = $db->insertCompetition(array($_POST['comp-name']));
            $level_id = $_POST['selected-level'];

            //insert selected judges
            foreach ($_POST['judges'] as $judge_id) {
                $db->insertJudge_level_comp_ids(array($judge_id, $level_id, $comp_id));
            }

            //insert manually added participants
            if(isset($_SESSION['participants'])) {
                $details = $_SESSION['participants'];

                //get each line from array
                foreach ($details as $line) {
                    $parts = explode("|", $line);

                    $info = array();
                    foreach ($parts as $item) {
                        array_push($info, $item);
                    }
                    array_push($info, $comp_id, $level_id);
                    //insert into db
                    $db->insertParticipant($info);
                }

                unset($_SESSION['participants']);
            }

            echo $comp_id; //return newly inserted competition id
            return;
        }

        $template = new Template();
        //render
        echo $template->render('views/create-comp.html');
    });



    $f3->route('GET|POST /add-participant', function ()
    {
        session_start();

        //check received data request from add-participant.js file
        if(isset($_POST['data'])) {
            unset($_SESSION['participants']);
            //hold data in session before adding into the database
            $_SESSION['participants'] = $_POST['data'];
            return;
        }

        $template = new Template();
        //render
        echo $template->render('views/add-participant2.html');
    });

    $f3->route('GET|POST /judge', function ($f3)
    {

        if (isset($_POST["submit"]))
        {
            session_start();

            $username = $_POST["username"];
            $password = $_POST["password"];

            $id = getJudgeId($username);
            $id = $id[0];
            $judgeid = $id['id'];
//            echo $judgeid;
//            $competitions = getAllCompetitions($judgeid);

            $_SESSION["judgeinfo"] = $id;

            $location = 'Location: http://asingh.greenriverdev.com/355/symposium/judge/'.$judgeid;
            header($location);
        }

        $template = new Template();

        //render
        echo $template->render('views/judgeLog.html');
    });



    $f3->route('GET|POST /judge/@judgeid', function ($f3,$params)
    {
        $id = $params['judgeid'];

        session_start();
        $judgeinfo = $_SESSION["judgeinfo"];
//        print_r($judgeinfo);
        $competitions = getAllCompetitions($id);
//        print_r($competitions);

        $competitionArray = array();

        $f3->set('judgeid', $id);

        foreach($competitions as $comp => $item) {

            array_push($competitionArray, $item["competition_name"]);
        }

        $f3->set('competitions', $competitionArray);
        $f3->set('judgeinfo', $judgeinfo);


        $template = new Template();
        //render
        echo $template->render('views/competitions.html');
    });



    $f3->route('GET|POST /judge/@judgeid/@level', function ($f3,$params)
    {
        $level = $params['level'];
        $f3->set('level', $level);

        session_start();
        $judgeinfo = $_SESSION["judgeinfo"];

        $compId = getCommpid($level);
        $compId = $compId["id"];

        $levels = getAllLevels($compId);

        $compLevelsArray  = array();

        foreach($levels as $lev => $item)
        {
            array_push($compLevelsArray, $item["level"]);
        }

        //        print_r($levels);
        $f3->set('compLevels', $levels);
        $f3->set('judgeinfo', $judgeinfo);

        $template = new Template();
        //render
        echo $template->render('views/judgeLevel.html');
    });



    $f3->route('GET|POST /participant/@level', function ($f3,$params)
    {
        $level = $params['level'];

        $levelId = getLevelid($level);
        $levelId = $levelId['id'];

        $participants = getParticipants($levelId);

        $f3->set('participants',$participants);

        $template = new Template();
        //render
        echo $template->render('views/judge.html');
    });



    $f3->route('GET|POST /score/@pid', function ($f3,$params)
    {
        $level = $params['pid'];

        $participant = getParticipant($level);
        $f3->set('participant',$participant);

        $levelid = $participant['level_id'];

        $info = new Database();

        //get the criteria from the database
        $criteria = $info->getCriteriaByLevelId($levelid);

        $f3->set('criteria',$criteria);

        if (isset($_POST['submit']))
        {
            $question1 = $_POST['Passing'];
            $question2 = $_POST['dancing'];
            $question3 = $_POST['delivery'];
            $question4 = $_POST['eye-contact'];
            $question5 = $_POST['voice'];
            $question6 = $_POST['language'];
            $question7 = $_POST['effectiveness'];


        }


        $template = new Template();
         //render
         echo $template->render('views/participant.html');
     });


    //manage levels OLD
    $f3->route('GET|POST /levels', function ($f3)
    {
        //get all levels list
        $db = new Database();
        $data = $db->getLevels();
        $f3->set('levels', $data);

        //get input data from levels.html
        $levels = $_POST['data'];
        $levelName =  $_POST['input'];

        if(strlen($_POST["level_id"]) > 0 && strlen($_POST["active"]) > 0) {
            $active = $_POST["active"];
            return $db->updateLevel(array("active" => $active), $_POST['level_id']);
        }

        //insert level and criteria
        if(strlen($levelName) > 0 && sizeof($levels) > 0) {
            $id = $db->insertLevel(array($levelName));

            foreach ($levels as $level) {
                $db->insertCriteria(array($level, $id));
            }
            return;
        }

        $template = new Template();
        //render
        echo $template->render('views/levels.html');
    });

    //edit levels
    $f3->route("GET /levels/@level_id", function ($f3, $params){

        //get criteria text from database
        $db = new Database();
        $data = $db->getCriteriaByLevelId($params['level_id']);

        //set data variable
        $f3->set('criteria', $data);

        $template = new Template();
        //render
        echo $template->render('views/edit-levels.html');
    });


    //manage judges
    $f3->route('GET|POST /judges', function ($f3)
    {
        //get judges from database
        $db = new Database();
        $judges = $db->getJudges();

        $f3->set('judges', $judges);

        if ($_POST['delete-judge'] > 0) {
            deleteJudge($_POST['delete-judge']); //write delete function in database class
        }

        if (!empty($_POST['insert-judge'])) {
            $db->insertJudge(array($_POST['insert-judge']));
        }

        //render
        $template = new Template();
        echo $template->render('views/judges.html');

    });

    //manage participants
    $f3->route('GET|POST /participants/@comp_id/@level_id', function($f3, $params){
        //get all participants by levels and competitions
        $db = new Database();
        $f3->set('participants', $db->getParticipantByLevelAndComp($params['comp_id'], $params['level_id']));

        //update participant name
        if(isset($_POST['p-id'])) {
            $pid = $_POST['p-id'];
            unset($_POST['p-id']);
            $db->updateParticipant($_POST, $pid);
            return;
        } //delete participant name
        else if(isset($_POST['del_id'])) {
            $db->deleteParticipant($_POST['del_id']);
            return;
        }

        //render
        $template = new Template();
        echo $template->render('views/manage-participants.html');
    });


    //Run fat free
    $f3->run();