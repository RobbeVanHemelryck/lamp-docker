<?php

include ("Entities/MinidagboekEntity.php");
include ("Entities/backupEntity.php");
class MinidagboekModel {
    static function filter($str){
        $str = MinidagboekModel::vervang($str, "xxAMPxx", "&");
        $str = MinidagboekModel::vervang($str, "xxAANxx", "'");
        $str = MinidagboekModel::vervang($str, "xBCKSLx", "\\");
        $str = MinidagboekModel::vervang($str, "xKLNDNx", "<");
        $str = MinidagboekModel::vervang($str, "xGRTDNx", ">");
        $str = MinidagboekModel::vervang($str, "xPIJLxx", "");
        return $str;
    }
    static function vervang($str, $wat, $doorwat){
        if($str != ""){
            $blijvegoan = true;
            while($blijvegoan != false){
                $WAAR = strpos($str, $wat, $blijvegoan);
                if($WAAR != false){
                    $str = substr($str, 0, $WAAR) . $doorwat . substr($str, $WAAR+7, strlen($str));
                }
                $blijvegoan = $WAAR;
            }
            return $str;
        }
    }
    
    
    static function getAll() {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("SELECT * FROM minidagboek ORDER BY datum");
        $dagen = array();

        while ($row = mysqli_fetch_array($result)) {
            $datum = MinidagboekModel::filter($row[0]);
            $weekdag = MinidagboekModel::filter($row[1]);
            $muziek = MinidagboekModel::filter($row[2]);
            $gebeurtenis = MinidagboekModel::filter($row[3]);

            $dag = new MinidagboekEntity($datum, $weekdag, $muziek, $gebeurtenis);
            array_push($dagen, $dag);
        }

        mysqli_close($mysqli);
        return $dagen;
    }
    static function getAllByWeekdag($weekdag) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("SELECT * FROM minidagboek WHERE weekdag = '$weekdag' ORDER BY datum");
        $dagen = array();

        while ($row = mysqli_fetch_array($result)) {
            $datum = MinidagboekModel::filter($row[0]);
            $weekdag = MinidagboekModel::filter($row[1]);
            $muziek = MinidagboekModel::filter($row[2]);
            $gebeurtenis = MinidagboekModel::filter($row[3]);

            $dag = new MinidagboekEntity($datum, $weekdag, $muziek, $gebeurtenis);
            array_push($dagen, $dag);
        }

        mysqli_close($mysqli);
        return $dagen;
    }
    static function getEntry($datum) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("SELECT * FROM minidagboek WHERE datum = '$datum'");
        $dag = "";

        if ($row = mysqli_fetch_array($result)) {
            $datum = MinidagboekModel::filter($row[0]);
            $weekdag = MinidagboekModel::filter($row[1]);
            $muziek = MinidagboekModel::filter($row[2]);
            $gebeurtenis = MinidagboekModel::filter($row[3]);

            $dag  = new MinidagboekEntity($datum, $weekdag, $muziek, $gebeurtenis);
        }
        else{
            return $dag;
        }

        mysqli_close($mysqli);
        return $dag;
    }
    static function getAllByMaand($maand) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("SELECT * FROM minidagboek WHERE datum LIKE '%/$maand/%' ORDER BY datum");
        $dagen = array();

        while ($row = mysqli_fetch_array($result)) {
            $datum = MinidagboekModel::filter($row[0]);
            $weekdag = MinidagboekModel::filter($row[1]);
            $muziek = MinidagboekModel::filter($row[2]);
            $gebeurtenis = MinidagboekModel::filter($row[3]);

            $dag = new MinidagboekEntity($datum, $weekdag, $muziek, $gebeurtenis);
            array_push($dagen, $dag);
        }

        mysqli_close($mysqli);
        return $dagen;
    }
    static function getAllByMaandAndJaar($maand, $jaar) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("SELECT * FROM minidagboek WHERE datum LIKE '%/$maand/$jaar' ORDER BY datum");
        $dagen = array();

        while ($row = mysqli_fetch_array($result)) {
            $datum = MinidagboekModel::filter($row[0]);
            $weekdag = MinidagboekModel::filter($row[1]);
            $muziek = MinidagboekModel::filter($row[2]);
            $gebeurtenis = MinidagboekModel::filter($row[3]);

            $dag = new MinidagboekEntity($datum, $weekdag, $muziek, $gebeurtenis);
            array_push($dagen, $dag);
        }

        mysqli_close($mysqli);
        return $dagen;
    }
    static function getAllByJaar($jaar) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("SELECT * FROM minidagboek WHERE datum LIKE '%/$jaar' ORDER BY datum");
        $dagen = array();

        while ($row = mysqli_fetch_array($result)) {
            $datum = MinidagboekModel::filter($row[0]);
            $weekdag = MinidagboekModel::filter($row[1]);
            $muziek = MinidagboekModel::filter($row[2]);
            $gebeurtenis = MinidagboekModel::filter($row[3]);

            $dag = new MinidagboekEntity($datum, $weekdag, $muziek, $gebeurtenis);
            array_push($dagen, $dag);
        }

        mysqli_close($mysqli);
        return $dagen;
    }
    static function saveMDentry($datum, $weekdag, $muziek, $gebeurtenis){
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("INSERT INTO minidagboek VALUES ('$datum', '$weekdag', '$muziek', '$gebeurtenis')");
        if(!($result)) {
            die(mysqli_error());
            return false;
        }
        mysqli_close($mysqli);
        return true;
    }
    static function deleteDag($datum){
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("DELETE FROM minidagboek WHERE datum = '$datum'");
        if(!($result)) {
            die(mysqli_error());
            return false;
        }
        mysqli_close($mysqli);
        return true;
    }
    static function deleteMaand($maand){
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("DELETE FROM minidagboek WHERE datum LIKE '__/$maand'");
        if(!($result)) {
            die(mysqli_error());
            return false;
        }
        mysqli_close($mysqli);
        return true;
    }
    static function deleteJaar($jaar){
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("DELETE FROM minidagboek WHERE datum LIKE '__/__/$jaar'");
        if(!($result)) {
            die(mysqli_error());
            return false;
        }
        mysqli_close($mysqli);
        return true;
    }
    static function setBackup($naam, $datum, $opmerking){
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("INSERT INTO md_backups VALUES (NULL, '$naam', '$datum', '$opmerking')");
        if(!($result)) {
            die(mysqli_error());
            return false;
        }
        mysqli_close($mysqli);
        return true;
    }
    static function getBackup($naam) {
        require 'Credentials.php';
        $mysqli = new mysqli($host, $user, $passwd, "life_of_taltiko");
        $result = $mysqli->query("SELECT * FROM md_backups WHERE naam = '$naam'");
        $backup = "";

        if ($row = mysqli_fetch_array($result)) {
            $backup  = new backupEntity($row[0], $row[1], $row[2], $row[3]);
        }
        else{
            return $backup;
        }

        mysqli_close($mysqli);
        return $backup;
    }
}

?>
