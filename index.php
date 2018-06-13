<?php

    //turning on the error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);

    //Require the files (fat-free)
    require_once('vendor/autoload.php');

    require_once '/home/gsinghgr/config.php';
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

        $db = new Database();
        $competitions = $db->getCompAndLevels("competitions.id");

        //get competitions and levels
        $f3->set('competitions', $competitions);

        //render
        $template = new Template();
        echo $template->render('views/add-more.html');
    });


    //create competition route
    $f3->route('GET|POST /create', function ($f3)
    {
        session_start();

        //get all levels and judges list
        $db = new Database();
        $levels = $db->getLevels();
        $judges = $db->getJudges();
        $f3->set('levels', $levels);
        $f3->set('judges', $judges);

        //set session for making form sticky
        if (isset($_POST['next'])) {
            $_SESSION['form'] = $_POST;
        }

        //form submitted?
        if(isset($_POST['submit'])) {

            //validate user inputs
            require_once "models/createCompValidation.php";

            //insert data if there is no error
            if ($success) {

                $comp_id = $_POST['comp-name'];
                if (!is_numeric($_POST['comp-name'])) {
                    //insert competition
                    $comp_id = $db->insertCompetition(array($_POST['comp-name']));
                }

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
            }
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
        echo $template->render('views/add-participant.html');
    });

    $f3->route('GET|POST /judge', function ($f3)
    {

        $participants = getAllRows("participants");
        $scores = getAllRows("scores");

        $f3->set('participants', $participants);
        $f3->set('scores', $scores);

        if (isset($_POST["submit"]))
        {
            session_start();

            $username = $_POST["username"];
            $password = $_POST["password"];

            $id = getJudgeId($username);
            $judgeid = $id['id'];
            $competitions = getAllCompetitions($judgeid);

            $_SESSION["competitions"] = $competitions;

            $location = "Location: http://asingh.greenriverdev.com/355/symposium/judge/".$judgeid;
//            $location = "/judge/".$judgeid;
//            $f3->reroute($location);
            header($location);
        }

        $template = new Template();

        //render
        echo $template->render('views/judgeLog.html');
    });

    $f3->route('GET|POST /judge/@judgeid', function ($f3,$params)
    {
        $id = $params['id'];

        session_start();
        $competitions = $_SESSION["competitions"];

        $competitionArray = array();

        $id = $params['judgeid'];
        $f3->set('judgeid', $id);

        foreach($competitions as $comp => $item) {

            array_push($competitionArray, $item["competition_name"]);
        }
        $f3->set('competitions', $competitionArray);

        $template = new Template();
        //render
        echo $template->render('views/competitions.html');
    });

    $f3->route('GET|POST /judge/@judgeid/@level', function ($f3,$params)
    {
        $level = $params['level'];
        $f3->set('level', $level);

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

//        echo $level;

        $participant = getParticipant($level);
        $f3->set('participant',$participant);

//        print_r($participant);

        $template = new Template();
         //render
         echo $template->render('views/participant.html');
     });

    //    $f3->route('GET|POST /judge/@id', function ($f3,$params)
    //    {
    //        $id = $params['id'];
    //
    //        $participants = getParticipant($id);
    //
    //        $f3->set('participants', $participants);
    //
    //        if (isset($_POST["submit"]))
    //        {
    //            $q1 = $_POST["question-1"];
    //            $q2 = $_POST["question-2"];
    //            $q3 = $_POST["question-3"];
    //
    //            $delivery = $_POST["delivery"];
    //            $eyeContact = $_POST["eye-contact"];
    //            $voice = $_POST["voice"];
    //            $language = $_POST["language"];
    //            $effectiveness = $_POST["effectiveness"];
    //
    //            $total = $q1 + $q3 + $q2 + $delivery + $eyeContact + $voice + $language + $effectiveness;
    //
    //
    //            $result = insertScores($id,$total);
    //
    //            if ($result)
    //            {
    //                $_SESSION["score"] = $total;
    //                header("Location: http://fastweb.greenriverdev.com/355/symposium/judge");
    //            }
    //        }
    //
    //        $template = new Template();
    //        //render
    //        echo $template->render('views/participant.html');
    //    });

    //manage levels OLD
    $f3->route('GET|POST /levels', function ($f3)
    {
        //get all levels list
        $db = new Database();
        $data = $db->getLevels();
        $f3->set('levels', $data);

        //update levels "active" column
        if(strlen($_POST["level_id"]) > 0 && strlen($_POST["active"]) > 0) {
            $active = $_POST["active"];
            return $db->updateLevel(array("active" => $active), $_POST['level_id']);
        }

        //get criteria by level
        if(isset($_POST['get_criteria'])) {
            echo json_encode($db->getCriteriaByLevelId($_POST['select_from']));
            return;
        }

        //insert level and criteria
        if (isset($_POST['submit'])) {

            require_once "models/validateLevels.php";

            if ($success) {
                $id = "";
                if (!isset($_POST['im_questions'])) {
                    //insert level name first and get id
                    $id = $db->insertLevel(array($_POST['level-name'], floatval($_POST['time-allowed'])));
                    echo $id;
                }

                if (!empty($_POST['c-ques'][0]) || !empty($_POST['p-ques'][0])) {
                    $index = 0;
                    while ($index < sizeof($_POST['c-ques'])) {

                        //question and its weight
                        $content_question = $_POST['c-ques'][$index];
                        $weight = $_POST['c-weight'][$index];

                        //insert content type question in the database
                        $db->insertCriteria(array($content_question, $id, $weight));
                        $index++;
                    }

                    $index = 0;
                    while ($index < sizeof($_POST['p-ques'])) {

                        //question and its weight
                        $presentation_question = $_POST['p-ques'][$index];
                        $weight = $_POST['p-weight'][$index];

                        //insert presentation type question in the database
                        $db->insertCriteria(array($presentation_question, $id, $weight, "0"));
                        $index++;
                    }
                }
            }

//            $_POST = array(); //clear form data after inserting
            return;
        }

        //insert imported questions from existing levels
        if (isset($_POST['im_questions'])) {
            foreach ($_POST['im_questions'] as $questions) {
                $array = array();
                foreach ($questions as $key => $val) {
                    if ($key == "weigh") {
                        array_push($array, $_POST['im_level']);
                    }
                    array_push($array, $val);
                }
                $db->insertCriteria($array);
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

    //list of levels
    $f3->route('GET|POST /participants/@comp_id', function($f3, $params){

        $db = new Database();
        $f3->set('levels', $db->getCompAndLevelsByCompId($params['comp_id'],"level_id"));

        //render
        $template = new Template();
        echo $template->render('views/list-levels.html');
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

    //list of levels
    $f3->route('GET|POST /sign-in', function($f3, $params){

        //render
        $template = new Template();
        echo $template->render('views/sign-in.html');
    });

    //Run fat free
    $f3->run();