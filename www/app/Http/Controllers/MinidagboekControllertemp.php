<?php
include ("Model/MinidagboekModel.php");
if(isset($_POST['MD_input_submit'])){
    $datum = $_POST["datum"];
    $dag = explode( "/", $datum)[0];
    $maand = explode( "/", $datum)[1];
    $jaar = explode( "/", $datum)[2];
    if(strlen($dag) == 1) $dag = substr_replace($dag, "0", 0, 0);
    if(strlen($maand) == 1) $maand = substr_replace($maand, "0", 0, 0);
    
    $datum = $dag . "/" . $maand . "/" . $jaar;
    $datum = str_replace(' ', '', $datum);
    $weekdag = $_POST["weekdag"];
    $muziek = $_POST["muziek"];
    $gebeurtenis = $_POST["gebeurtenis"];
    MinidagboekModel::saveMDentry($datum, $weekdag, $muziek, $gebeurtenis);
}
if(isset($_POST['deleteItem'])){
    $wat = substr($_POST['deleteItem'], 0, 3);
    $rest = substr($_POST['deleteItem'], 3, strlen($_POST['deleteItem']));
    if($wat == "DAG"){
        MinidagboekModel::deleteDag($rest);
    }
    if($wat == "MAN"){
        MinidagboekModel::deleteMaand($rest);
    }
    if($wat == "JAA"){
        MinidagboekModel::deleteJaar($rest);
    }
}
if(isset($_POST['backup'])){
    $dagen = explode(";", $_POST['selectdagen']);
    $naam = $_POST['backupnaam'];
    $opmerking = $_POST['opmerking'];
    $totaal = "";
    for($i = 0; $i < count($dagen); $i++){
        $dag = MinidagboekModel::getEntry($dagen[$i]);
        $totaal = $totaal . $dag->datum . "\t" . $dag->weekdag . "\t" . $dag->muziek ."\t" . $dag->gebeurtenis . ";......;";
    }
    file_put_contents("D:/wamp/www/LOTtest/backups/$naam.txt", $totaal);
    
    date_default_timezone_set('Europe/Brussels');
    $datum = date("d/m/y") . " " . date("G") . "u" . date("i");
    MinidagboekModel::setBackup($naam, $datum, $opmerking);
}
if(isset($_POST['KBM'])){
    //FILTEREN
    $beta = $_POST['KBM'];
    $data = "";
    if(strpos($beta, ";......;")){
        $data = explode(";......;", $beta);
        for($i = 0; $i < count($data); $i++){
            $entry = preg_split("/[\t]/", $data[$i]);
            $datum = $entry[0];
            $weekdag = $entry[1];
            $muziek = $entry[2];
            $gebeurtenis = $entry[3];
            
            $datum = str_replace(' ', '', $datum);
            $tempdatum = explode("/", $datum);
            $dag = $tempdatum[0];
            $maand = $tempdatum[1];
            $jaar = $tempdatum[2];
            if(strlen($dag) == 1) $dag = "0" . $dag;
            if(strlen($maand) == 1) $maand = "0" . $maand;
            $datum = $dag . "/" . $maand . "/" . $jaar;
            MinidagboekModel::saveMDentry($datum, $weekdag, $muziek, $gebeurtenis);
        }
    }
    else{
        $lijnen = explode("\n", $beta);
        for($i = 0; $i < count($lijnen); $i++){
            $shit = false;
            for($j = 2010; $j <= 2020; $j++){
                if($lijnen[$i] == $j) $shit = true;
            }
            if($lijnen[$i] == "Skitalia") $shit = true;
            else if($lijnen[$i] == "Januari") $shit = true;
            else if($lijnen[$i] == "Februari") $shit = true;
            else if($lijnen[$i] == "Maart") $shit = true;
            else if($lijnen[$i] == "April") $shit = true;
            else if($lijnen[$i] == "Mei") $shit = true;
            else if($lijnen[$i] == "Juni") $shit = true;
            else if($lijnen[$i] == "Juli") $shit = true;
            else if($lijnen[$i] == "Augustus") $shit = true;
            else if($lijnen[$i] == "September") $shit = true;
            else if($lijnen[$i] == "Oktober") $shit = true;
            else if($lijnen[$i] == "November") $shit = true;
            else if($lijnen[$i] == "December") $shit = true;
            else if($lijnen[$i] == "JANUARI") $shit = true;
            else if($lijnen[$i] == "FEBRUARI") $shit = true;
            else if($lijnen[$i] == "MAART") $shit = true;
            else if($lijnen[$i] == "APRIL") $shit = true;
            else if($lijnen[$i] == "MEI") $shit = true;
            else if($lijnen[$i] == "JUNI") $shit = true;
            else if($lijnen[$i] == "JULI") $shit = true;
            else if($lijnen[$i] == "AUGUSTUS") $shit = true;
            else if($lijnen[$i] == "SEPTEMBER") $shit = true;
            else if($lijnen[$i] == "OKTOBER") $shit = true;
            else if($lijnen[$i] == "NOVEMBER") $shit = true;
            else if($lijnen[$i] == "DECEMBER") $shit = true;
            if(substr($lijnen[$i],0,5) == "Datum" && strlen($lijnen[$i]) >= 20 && strlen($lijnen[$i]) <= 30) $shit = true;
            if($shit == false){
                $data = $data . "\n" . $lijnen[$i];
            }
        }

        //OPSPLITSEN IN ENTRIES
        $checkpoints = array();
        for($i = 0; $i < strlen($data); $i++){
            if(is_numeric($data[$i])){

                if($data[$i+1] == "/"){
                    if($data[$i+3] == "/"){
                        if($i == 0 || $data[$i-1] == "\n"){
                            array_push($checkpoints, $i);
                            $i += 6;
                        }
                    }
                    if($data[$i+4] == "/"){
                        if($i == 0 || $data[$i-1] == "\n"){
                            array_push($checkpoints, $i);
                            $i += 7;
                        }
                    }
                }
                if($data[$i+2] == "/"){
                    if($data[$i+4] == "/"){
                        if($i == 0 || $data[$i-1] == "\n"){
                            array_push($checkpoints, $i);
                            $i += 7;
                        }
                    }
                    if($data[$i+5] == "/"){
                        if($i == 0 || $data[$i-1] == "\n"){
                            array_push($checkpoints, $i);
                            $i += 8;
                        }
                    }
                }
            }
        }
        $entries = array();
        for($i = 0; $i < count($checkpoints); $i++){
            if($i < count($checkpoints) - 1){
                array_push($entries, substr($data, $checkpoints[$i], $checkpoints[$i+1] - $checkpoints[$i]));
            }
            else{
                array_push($entries, substr($data, $checkpoints[$i], strlen($data) - $checkpoints[$i]));
            }
        }
        for($i = 0; $i < count($entries); $i++){
            $parts = preg_split("/[\t]/", $entries[$i]);
            $weekdag = $parts[1];
            $gebeurtenis = $parts[2];
            $muziek = "";

            $datumparts = explode("\n", $parts[0]);
            $datum = $datumparts[0];
            $datum = str_replace(' ', '', $datum);
            for($j = 1; $j < count($datumparts); $j++){
                $muziek = $muziek . $datumparts[$j];
            }
            $tempdatum = explode("/", $datum);
            $dag = $tempdatum[0];
            $maand = $tempdatum[1];
            $jaar = $tempdatum[2];
            if(strlen($dag) == 1) $dag = "0" . $dag;
            if(strlen($maand) == 1) $maand = "0" . $maand;
            $datum = $dag . "/" . $maand . "/" . $jaar;
            MinidagboekModel::saveMDentry($datum, $weekdag, $muziek, $gebeurtenis);
        }
    }
}

?>