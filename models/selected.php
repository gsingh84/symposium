<?php


//turning on the error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

$element = $_POST['element'];

require_once '/home2/fastwebg/symposiumConfig.php';

require_once 'dbFunctions.php';


require_once 'dbFunctions.php';

$dbh = connect();

$participant = getAllParticipants();
//echo "dj";
//
//echo $participant;













