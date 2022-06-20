<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MinidagboekController;
use App\Minidagboek;


class ContentController extends Controller {
	public static function initialise(Request $request){
        $returndata = [];
        array_push($returndata, self::getMainInhoud());
        array_push($returndata, self::getLinkerNavInhoud());
        return $returndata;
	}
    public static function getMainInhoud(){
        $allejaren = [];
        $result = "";
        //JAARLOOP
        for($j = 0; $j < 30; $j++){
            $jaartemp = 2000 + $j;
            $jaar = "$jaartemp";    
            if(count(MinidagboekController::getAllByJaar($jaar)) > 0){
                $allemaanden = [];
                
                $result .= "<div id='$jaar' class='jaar'><jaarnaam><h1>$jaar</h1></jaarnaam><div class='maanden'>";
                
                //MAANDLOOP
                for($i = 1; $i < 13; $i++){
                    $maand = $i;
                    if($i < 10) $maand = "0" . $maand;
                    $dagen = MinidagboekController::getAllByJaarAndMaand($jaar, $maand);
                    
                    if((count($dagen))!= 0){
                        $alledagen = [];
                        $welkemaand = explode('-', $dagen[0]["attributes"]["datum"])[1];
                        $maand = "";
                        if($welkemaand == "01") $maand = "Januari";
                        if($welkemaand == "02") $maand = "Februari";
                        if($welkemaand == "03") $maand = "Maart";
                        if($welkemaand == "04") $maand = "April";
                        if($welkemaand == "05") $maand = "Mei";
                        if($welkemaand == "06") $maand = "Juni";
                        if($welkemaand == "07") $maand = "Juli";
                        if($welkemaand == "08") $maand = "Augustus";
                        if($welkemaand == "09") $maand = "September";
                        if($welkemaand == "10") $maand = "Oktober";
                        if($welkemaand == "11") $maand = "November";
                        if($welkemaand == "12") $maand = "December";
                        $maandid = $welkemaand . "-" . $j;
                        $result .= "<div id='$maandid' class='maand'><maandnaam><h2>$maand</h2></maandnaam>";
                        $result .= "<div class='dagen'><table class='lottable'><tr><th>Datum</th><th>Dag</th><th>Gebeurtenis</th></tr>";
                        
                        //DAGLOOP
                        foreach($dagen as $key => $dag){
                            $phpdatum = date('d-m-y', strtotime($dag["attributes"]["datum"]));
                            $phpdatumslash = str_replace("-", "/", $phpdatum);
                            $result .= 
                                   "<tr id='$phpdatum'>
                                        <td class='datum'>$phpdatumslash<br>$dag->muziek</td>     
                                        <td class='weekdag'>$dag->weekdag</td> 
                                        <td class='gebeurtenis'>$dag->gebeurtenis</td>   
                                    </tr>";
                            array_push($alledagen, $phpdatumslash);
                        }
                        $result .= "</table></div></div>";  
                        array_push($allemaanden, $alledagen);
                    }
                }
                $result .= "</div></div>";
                array_push($allejaren, $allemaanden);
            }
        }
        session(['allejaren' => $allejaren]);
        return $result;
    }
    public static function getLinkerNavInhoud(){
        $allejaren = session('allejaren');
        $result = "<ul class='ul1'>";
        for($i = 0; $i < count($allejaren); $i++){
            $jaar = "20" . explode("/", $allejaren[$i][0][0])[2];
            $result = $result . "<li class='navjaar'><fakeA class='navjaarlink' name='#$jaar'>$jaar<span class='helper'></span><img onclick='toggleDropdownJaar(this)' src='" . env('APP_PREFIX') . "/images/expand_reverse.png' class='expand'></fakeA><ul class='navjaarInhoud'>";

            for($j = 0; $j < count($allejaren[$i]); $j++){
                $welkemaand = explode('/', $allejaren[$i][$j][0])[1];
                $maand = "";
                if($welkemaand == "01") $maand = "Januari";
                if($welkemaand == "02") $maand = "Februari";
                if($welkemaand == "03") $maand = "Maart";
                if($welkemaand == "04") $maand = "April";
                if($welkemaand == "05") $maand = "Mei";
                if($welkemaand == "06") $maand = "Juni";
                if($welkemaand == "07") $maand = "Juli";
                if($welkemaand == "08") $maand = "Augustus";
                if($welkemaand == "09") $maand = "September";
                if($welkemaand == "10") $maand = "Oktober";
                if($welkemaand == "11") $maand = "November";
                if($welkemaand == "12") $maand = "December";
                
                $jaarkort = explode('/', $allejaren[$i][$j][0])[2];
                $link = "#" . $welkemaand . "-" . $jaarkort;
                $result = $result . "<li class='navmaand'><fakeA class='navmaandlink' name='$link'>$maand<span class='helper'></span><img onclick='toggleDropdownMaand(this)' src='/" . env('APP_PREFIX') . "images/expand.png' class='expand'></fakeA><ul class='navmaandInhoud'>";
                for($k = 0; $k < count($allejaren[$i][$j]); $k++){
                    $ohgod = $allejaren[$i][$j][$k];
                    $daglink = explode("/", $allejaren[$i][$j][$k])[0] . "-" . explode("/", $allejaren[$i][$j][$k])[1] . "-" . explode("/", $allejaren[$i][$j][$k])[2]; 
                    $result = $result . "<li class='navdag'><fakeA class='navdaglink' name='#$daglink'>$ohgod</fakeA></li>";
                }
                $result = $result . "</ul></li>";
            }
            $result = $result . "</ul></li>";
        }
        $result = $result . "</ul>";
        return $result;
    }

    public static function getBackupInhoud(){
        $allejaren = session("allejaren");
        $result = "";

        for($i = 0; $i < count($allejaren); $i++){
            $result = $result . "<div class='backnavdeel'><ul class='ul1'>";
            $jaar = "20" . explode("/", $allejaren[$i][0][0])[2];
            $result = $result . "<li class='backnavjaar'><niks class='backnavjaarlink' name='$jaar'><div onclick='toggleBackup(this)' class='check'></div>$jaar<span class='helper'></span><img onclick='toggleDropdownJaar(this)' src='" . env('APP_PREFIX') . "/images/expand_reverse.png' class='expand'></niks><ul class='backnavjaarInhoud'>";

            for($j = 0; $j < count($allejaren[$i]); $j++){
                $welkemaand = explode('/', $allejaren[$i][$j][0])[1];
                $maand = "";
                if($welkemaand == "01") $maand = "Januari";
                if($welkemaand == "02") $maand = "Februari";
                if($welkemaand == "03") $maand = "Maart";
                if($welkemaand == "04") $maand = "April";
                if($welkemaand == "05") $maand = "Mei";
                if($welkemaand == "06") $maand = "Juni";
                if($welkemaand == "07") $maand = "Juli";
                if($welkemaand == "08") $maand = "Augustus";
                if($welkemaand == "09") $maand = "September";
                if($welkemaand == "10") $maand = "Oktober";
                if($welkemaand == "11") $maand = "November";
                if($welkemaand == "12") $maand = "December";

                $jaarkort = explode('/', $allejaren[$i][$j][0])[2];
                $link = $welkemaand . "-" . $jaarkort;
                $result = $result . "<li class='backnavmaand'><niks class='backnavmaandlink maand" . $jaar . "' name='$link'><div onclick='toggleBackup(this)' class='check'></div>$maand<span class='helper'></span><img onclick='toggleDropdownMaand(this)' src='" . env('APP_PREFIX') . "/images/expand.png' class='expand'></niks><ul class='backnavmaandInhoud'>";
                for($k = 0; $k < count($allejaren[$i][$j]); $k++){
                    $ohgod = $allejaren[$i][$j][$k];
                    $daglink = explode("/", $allejaren[$i][$j][$k])[0] . "-" . explode("/", $allejaren[$i][$j][$k])[1] . "-" . explode("/", $allejaren[$i][$j][$k])[2]; 
                    $result = $result . "<li class='backnavdag'><niks class='backnavdaglink dag" . $link . "' name='$daglink'><div onclick='toggleBackup(this)' class='check'></div>$ohgod</niks></li>";
                }
                $result = $result . "</ul></li>";
            }
            $result = $result . "</ul></li></ul></div>";
        }
        return $result;
    }
}