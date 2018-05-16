<?php

    //turning on the error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);

    //Require the files (fat-free)
    require_once('vendor/autoload.php');

    require "models/dbFunctions.php";

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
    $f3->route('GET|POST /', function ()
    {
        $template = new Template();
        //render
        echo $template->render('views/admin.html');
    });

    $f3->route('GET|POST /add-participant', function ()
    {
        $template = new Template();
        //render
        echo $template->render('views/add-participant.html');
    });

    $f3->route('GET|POST /judge', function ($f3)
    {
        session_start();
        $participants = getAllRows("participants");
        $scores = getAllRows("scores");

        $f3->set('participants', $participants);
        $f3->set('scores', $scores);
//        print_r($scores);

        $template = new Template();

        //render
        echo $template->render('views/judge.html');
    });

    $f3->route('GET|POST /judge/@id', function ($f3,$params)
    {
        $id = $params['id'];

        $participants = getParticipant($id);

        $f3->set('participants', $participants);

        if (isset($_POST["submit"]))
        {
            session_start();
            $q1 = $_POST["question-1"];
            $q2 = $_POST["question-2"];
            $q3 = $_POST["question-3"];

            $delivery = $_POST["delivery"];
            $eyeContact = $_POST["eye-contact"];
            $voice = $_POST["voice"];
            $language = $_POST["language"];
            $effectiveness = $_POST["effectiveness"];

            $total = $q1 + $q3 + $q2 + $delivery + $eyeContact + $voice + $language + $effectiveness;


            $result = insertScores($id,$total);

            if ($result)
            {
                $_SESSION["score"] = $total;
                header("Location: http://fastweb.greenriverdev.com/355/symposium/judge");
            }
        }

        $template = new Template();
        //render
        echo $template->render('views/participant.html');
    });

    //manage levels
    $f3->route('GET|POST /levels', function ($f3)
    {
        $data = getLevels();
        $f3->set('levels', $data);

        $levels = $_POST['data'];
        $levelName =  $_POST['input'];

        //insert level
        if(strlen($levelName) > 0 && sizeof($levels) > 0) {
            $id = insertLevels($levelName);

            foreach ($levels as $criteria) {
                insertCriteria($criteria, $id);
            }
        }

        $template = new Template();
        //render
        echo $template->render('views/levels.html');
    });

    //edit levels
    $f3->route("GET /levels/@level_id", function ($f3, $params){

        $f3->set('criteria', getCriteria($params['level_id']));
        $template = new Template();
        //render
        echo $template->render('views/edit-levels.html');
    });


    //manage judges
    $f3->route('GET|POST /judges', function ($f3)
    {
        $judges = getAllRows("judges");

        $f3->set('judges', $judges);
        $template = new Template();

        if ($_POST['delete-judge'] > 0) {
            deleteJudge($_POST['delete-judge']);
        }

        if (!empty($_POST['insert-judge'])) {
            insertJudge($_POST['insert-judge']);
        }

        //render
        echo $template->render('views/judges.html');

    });


    //Run fat free
    $f3->run();