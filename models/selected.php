<?php


//turning on the error reporting
error_reporting(E_ALL);
ini_set('display_errors', TRUE);

$element = $_POST['element'];

require_once '/home2/fastwebg/symposiumConfig.php';


require_once 'dbFunctions.php';

require '../vendor/autoload.php';
$f3 = Base :: instance();
$f3->set('DEBUG', 3);


$dbh;
connect();


$f3->route('GET|POST model/judge', function ($f3)
{

    $result = getParticipant(1);

    $f3->set('selected', $result);


});
echo "jd";

//Run fat free
$f3->run();











