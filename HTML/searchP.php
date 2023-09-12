<?php
    session_start();

    $search_play = $_GET['search'];

    $storagePath = '../jsonFiles/Users.json';
	$storage = json_decode(file_get_contents($storagePath), true);
    $Plays = $storage['Plays'];

    $results = array();
    foreach($Plays as $Play){
        if(strpos($Play['title'], $search_Play)!== false){
            $results[] = $Play;
        }
    }
    include 'search.php';
    exit();
?>