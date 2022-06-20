<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Minidagboek;

class MinidagboekController extends Controller {
	public static function renderDatum($datum){
		$datum = preg_replace("/\s|\t|\r|\n|\r\n/", "", $datum);
		$datum = preg_replace("/\/|-/", "-", $datum);

		$tempdatum = explode("-", $datum);
		if(count($tempdatum) != 3){
			return false;
		}
		if(strlen($tempdatum[0]) == 4){
			return $datum;
		}
        $dag = $tempdatum[0];
        $maand = $tempdatum[1];
        $jaar = "20" . substr($tempdatum[2],-2,2);
        if(strlen($dag) == 1) $dag = "0" . $dag;
        if(strlen($maand) == 1) $maand = "0" . $maand;
        $datum = $dag . "-" . $maand . "-" . $jaar;




		//exception vangen
		$SQLdatum = date('Y-m-d', strtotime($datum));
		if($SQLdatum == "1970-01-01"){
			return false;
		}

		return $SQLdatum;
	}
	public static function addEntry($datum, $weekdag, $muziek, $gebeurtenis){
		$entry = new Minidagboek(array(
			'datum' => self::renderDatum($datum), 
			'weekdag' => $weekdag, 
			'muziek' => $muziek, 
			'gebeurtenis' => $gebeurtenis));
		try{
			$entry->save();
		}
		catch (QueryException $e){
		    $errorCode = $e->errorInfo[1];
		    if($errorCode == 1062){
		        return false;
		    }
		}
		return true;
	}

	public static function addEntryMetRequest(Request $request){
		$duplicateDatums = [];
		$sessionDuplicates = [];
		if(!self::addEntry($request->datum, $request->weekdag, $request->muziek, $request->gebeurtenis)){
			array_push($duplicateDatums, $request->datum);
			array_push($sessionDuplicates, new Minidagboek(array(
											'datum' => self::renderDatum($request->datum), 
											'weekdag' => $request->weekdag, 
											'muziek' => $request->muziek, 
											'gebeurtenis' => $request->gebeurtenis)));
		}
		session(['duplicates' => $sessionDuplicates]);
		return $duplicateDatums;
	}

	public static function addEntriesMetRequest(Request $request, $testData = 0){
		//FILTEREN
		if($testData){
	    	$beta = $testData;
	    }
	    else $beta = $request->entries;
	    $data = "";
	    $duplicateDatums = [];
	    $sessionDuplicates = [];

	    

	    if(strpos($beta, ";......;")){
	        $data = explode(";......;", $beta);
	        for($i = 0; $i < count($data); $i++){
	            $entry = preg_split("/[\t]/", $data[$i]);
	            $datum = $entry[0];
	            $weekdag = $entry[1];
	            $muziek = $entry[2];
	            $gebeurtenis = $entry[3];
	            
	            if(!self::addEntry($datum, $weekdag, $muziek, $gebeurtenis)){
	            	array_push($duplicateDatums, $datum);
	            	array_push($sessionDuplicates, new Minidagboek(array(
											'datum' => self::renderDatum($datum), 
											'weekdag' => $weekdag, 
											'muziek' => $muziek, 
											'gebeurtenis' => $gebeurtenis)));
	            }
	        }
	    }
	    else{
	        $lijnen = explode("\n", $beta);
	        for($i = 0; $i < count($lijnen); $i++){
	            $shit = false;
	            for($j = 2000; $j <= 2030; $j++){
	                if($lijnen[$i] == $j) $shit = true;
	            }
	            $toLowerLijnen = strtolower($lijnen[$i]);
	            if($toLowerLijnen == "skitalia") $shit = true;
	            else if($toLowerLijnen == "januari") $shit = true;
	            else if($toLowerLijnen == "februari") $shit = true;
	            else if($toLowerLijnen == "maart") $shit = true;
	            else if($toLowerLijnen == "april") $shit = true;
	            else if($toLowerLijnen == "mei") $shit = true;
	            else if($toLowerLijnen == "juni") $shit = true;
	            else if($toLowerLijnen == "juli") $shit = true;
	            else if($toLowerLijnen == "augustus") $shit = true;
	            else if($toLowerLijnen == "september") $shit = true;
	            else if($toLowerLijnen == "oktober") $shit = true;
	            else if($toLowerLijnen == "november") $shit = true;
	            else if($toLowerLijnen == "december") $shit = true;
	            if(substr($lijnen[$i],0,5) == "Datum" && strlen($lijnen[$i]) >= 20 && strlen($lijnen[$i]) <= 30) $shit = true;
	            if($shit == false){
	                $data = $data . "\n" . $lijnen[$i];
	            }
	        }
	        //OPSPLITSEN IN ENTRIES
	        $preg_split = preg_split("/(\n\d\d?\/\d\d?\/\d\d[\t\r\n])/", $data, -1, PREG_SPLIT_DELIM_CAPTURE);
			$entries = [];

			//De entries maken
			for($j = 1; $j < count($preg_split); $j += 2){
				$datum = $preg_split[$j];
				$rest = $preg_split[$j+1];


				//Overbodige tabs en enters verwijderen
				$datum = str_replace("\n", "", $datum);
				$datum = str_replace("\t", "", $datum);
				$rest = trim($rest, "\t");
				$rest = trim($rest, "\n");
				if(!is_numeric($datum[strlen($datum)-1])){
					$datum = substr($datum, 0, -1);
				}


				array_push($entries, $datum . "\t" . $rest);
			}
			//De data saven / duplicate models aanmaken
			for($j = 0; $j < count($entries); $j++){
	            $parts = preg_split("/[\t]/", $entries[$j]);

	            $datum = "";
	            $muziek = "";
	            $weekdag = "";
	            $gebeurtenis = "";
	            if(count($parts) == 3){
	            	$datum = $parts[0];
		            $weekdag = $parts[1];
		            $gebeurtenis = $parts[2];
	            }
	            else if(count($parts) == 4){
	            	$datum = $parts[0];
		            $muziek = $parts[1];
		            $weekdag = $parts[2];
		            $gebeurtenis = $parts[3];
	            }

	        	if(!self::addEntry($datum, $weekdag, $muziek, $gebeurtenis)){
	            	array_push($duplicateDatums, $datum);
	            	array_push($sessionDuplicates, new Minidagboek(array(
											'datum' => self::renderDatum($datum), 
											'weekdag' => $weekdag, 
											'muziek' => $muziek, 
											'gebeurtenis' => $gebeurtenis)));
	            }
	            
	        }
	    }
	    session(['duplicates' => $sessionDuplicates]);
	    return $duplicateDatums;
	}

	public static function getAllByJaar($jaar){
		return Minidagboek::where('datum', 'like', $jaar . '%')->orderBy('datum', 'asc')->get();
	}

	public static function getAllByJaarAndMaand($jaar, $maand){
		return Minidagboek::where('datum', 'like', $jaar . '-' . $maand . '%')->orderBy('datum', 'asc')->get();
	}
	public static function deleteAllByJaar($jaar){
		return Minidagboek::where('datum', 'like', $jaar . '%')->delete();
	}

	public static function deleteAllByJaarAndMaand($jaar, $maand){
		return Minidagboek::where('datum', 'like', $jaar . '-' . $maand . '%')->delete();
	}

	public static function getAllEntries(Request $request){
		return Minidagboek::all()->sortBy('datum');
	}

	public static function deleteEntries(Request $request){
	    $delitem = $request->delitem;
	    $strlen = strlen($delitem);
	    if($strlen == 4){
	        return self::deleteAllByJaar($delitem);
	    }
	    if($strlen == 7){
	        return self::deleteAllByJaarAndMaand(substr($delitem, 0, 4), substr($delitem, 5));
	    }
	    if($strlen == 10){
	        return Minidagboek::destroy($delitem);
	    }
	}
	public static function overrideDuplicates(Request $request){
		$returnarray = [];
	    $datums = $request->duplicates;
	    for($i = 0; $i < count($datums); $i++){
	    	$datums[$i] = self::renderDatum($datums[$i]);
	    }
	    $duplicateEntries = session('duplicates');

	    foreach($duplicateEntries as $nieuweEntry){
	    	$nieuweEntryDatum = date('Y-m-d', strtotime($nieuweEntry["attributes"]["datum"]));


	    	if(in_array($nieuweEntryDatum, $datums)){
	    		Minidagboek::destroy($nieuweEntryDatum);
	    		$nieuweEntry->save();
	    	}
	    }
	    //session_unregister("duplicates");
	}
}