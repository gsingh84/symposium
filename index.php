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

        $participants = getAllParticipants();

        $f3->set('participants', $participants);

        $template = new Template();
        //render
        echo $template->render('views/judge.html');
    });

    //Run fat free
    $f3->run();