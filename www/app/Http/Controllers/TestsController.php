<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MinidagboekController;
use App\Http\Controllers\ContentController;
use App\Minidagboek;

class TestsController extends Controller {
	public function testRenderDatum(){
		$datum0 = "10/12/16";
		echo "<h2>$datum0</h2>";
		$SQLdatum0 = MinidagboekController::renderDatum($datum0);
		if($SQLdatum0== false){
			echo "<b>$datum0</b> is mislukt";
		}
		else echo $SQLdatum0;
		

		echo "<br><br><hr>";


		$datum1 = "1		f0/1
		2/1   5		
			";
		echo "<h2>$datum1</h2>";
		$SQLdatum1 = MinidagboekController::renderDatum($datum1);
		if($SQLdatum1 == false){
			echo "<b>$datum1</b> is mislukt";
		}
		else echo $SQLdatum1;
		

		echo "<br><br><hr>";

		
		$datum2 = "10-12-15 ";
		echo "<h2>$datum2</h2>";
		$SQLdatum2 = MinidagboekController::renderDatum($datum2);
		if($SQLdatum2 == false){
			echo "<b>$datum2</b> is mislukt";
		}
		else echo $SQLdatum2;


		echo "<br><br><hr>";


		$datum3 = "1-2-2015";
		echo "<h2>$datum3</h2>";
		$SQLdatum3 = MinidagboekController::renderDatum($datum3);
		if($SQLdatum3 == false){
			echo "<b>$datum3</b> is mislukt";
		}
		else echo $SQLdatum3;


		echo "<br><br><hr>";

		
		$datum4 = "2015-02-03";
		echo "<h2>$datum4</h2>";
		$SQLdatum4 = MinidagboekController::renderDatum($datum4);
		if($SQLdatum4 == false){
			echo "<b>$datum4</b> is mislukt";
		}
		else echo $SQLdatum4;
	}
	public function testOverride(){
		$string = "18/8/16
Vanalles	do	Opgestaan rond 8u30, lame, ni plezant me jirka, beslote om weer ni te gaan douchen, nr weide, daar nog gedjangeld me jirka enkel, coely gezien, 2e deel bezocht, baraque future, raadsel ‘date’ me meisjes, jolien en dries erbij, nr gili the mentalist gegaan, zalige show, buikspreken enzo, jirka door, me lisa en tillo nr spar, voor de rest wast ni echt plezant, louche EDWARD SHARPE & THE MAGNETIC ZEROS, in avond beter en beter dankzij pintjes xd, rihanna 40m te laat, dan TLP, weggegaan, heel pkp ook vaak enkel me jirka gedjangeld omda tillo en lisa vaak verdwenen, reet deed ziek veel pijn
19/8/16
Vanalles
	vr	Deze keer keigoeie ochtend me jirka, weekly discover, goblin’s song enzeu, compact disk dummies, echt zalig, gili zen show, me  deez nuts xd, begonnen me regenen, stick to your guns, mik en sasha tegegekomen, noel gallagher, depri geworden, droog geciao’d, tillo en jirka tegegekome tho xd, dan ff gedjangeld, dan chemical brothers, zalig, echt megalouche muziek en drops enzo, dan vooraan bij marble sounds, megamoe en megachill, op terugweg me megaperdu dude op de bus da aant kakken was op de walen, reet deed nog steeds ziek veel pijn
20/8/16
Vanalles	za	Cava ochtend, hollanders da ravioli zaten te zingen xd, me jirka nr fleddy melculy, lachen, jirka heel de dag keiveel bonnekes zitte opdoen, 3x whisky gekocht enzo xd, trok echt op niks, ma iedereen nr baraque future, boulet(te) met mayo badges enzo laten maken, nr gili, warhola, kankerwarm, gedjangeld me iedereen aan de overvolle marquee, echt MEGAplezant me sahsa en mik erbij, tom was er ook, ikke strak van de redbull, video gefilmt voor sasha over naakt bungeejumpen enzo, lcs soundsystem, echt goe, dan zoon van bob marley, dan oscar and the wolf, da geciao’d voor pendulum, die was ook ZALIG, daarna 2e stuk afgesloten dus echt KANKERdruk, gedjangeld me iedereen, bonneke sprobere spenderen, dude tegegekomen da vrouw kwijt was xd, voor kamping a gechilled, iedereen keigoe gezind, sasha en lisa echt plat laten gaan over het binnendringen van kamping A enzo, jirka deed heel de avond wa plakkerig, echt spijtig, ballen deed ziek veel pijn
21/8/16
Journey To The End, metal	zo	Halfacht opgestaan, ZIEKE REGEN, alles ingepakt, bus gepakt, VOORBIJ kamping a, rip, in station hasselt nr panos gegaan, ma van jirka gebeld, zondre tillo en lisa nr huis dus omda we hen ni konden bereiken, thuisgekomen, gegeten, csgo me tristan, CANCERgames, elo shift ofzo, we kunnen nimr winnen, aoe gespeeld, verder gesukkeld aan camera roll te fixen, gn slapen rond 1
22/8/16
Journey To The End, Beat Bizarre	ma	5 opgestaan, nr delhaize, awkward";



	}
	public function testAddEntries(Request $request){
		if($request->mode == "KB"){
			$data = "12/10/15	ma	Ewa te laat opgestaan (kwart vo zeven), keihard moete ahatsen, tande ni kunne poetse, it fund en prog gehad, tristan alles verteld over tillolisacara, drna nr tristan, badmintonne, pixels gekeken, dual gekeken xd, dan nr kag, gedangeld, tillo goe gezind (het is uit tss cara en tillo sinds vorig weekend), lisa ook, toen iedereen buiten zij door was, begon ik ook in te pakken, tillo ook, omda ik geen zin ha do die twee te zien kussen, dan nr huis, mob of the deda gekocht, me jirka gespeeld, ziek gelache, gerecord
13/10/15	di	Nr school gegaan,, weeral beke te laat vertrokke dus weer fiets vn pa moete gebruike, ni nr kag gegaan omda lisa 7e had en ni lang ging blijve plakke :/, daarna keihard verveeld, dag niks gedaan, gagemed me tillo (deed awkward) en jirka
14/10/15	wo	Om 10 opgestaan, trein van 12u02 gepakt, 1 later dan die van tris, in ochtend getwijfeld om blazeer aan te doen, ni gedaan, fml 50 euro weggegooid xd, na school milkshake gaan halen, dan nr huis, verveeld, tristan slechtgezind heel de dag lang (en ook zo die belachelijke arrogante mood), beke gegamed me jirka op original op tranzit = gefaald xd, me lisa afgesproken om nr hara this te gaan, direct echter afgezegd door haar, omda het al te laat was, HUGE PUIST HOLY SHIT, watchmojo gekeken, gaan slapen";
			MinidagboekController::addEntriesMetRequest($request, $data);

			//12/1/15 testen
			echo "<h2>12/10/15</h2><hr>";
			$output = Minidagboek::where('datum', "2015-10-13")->get();
			if(count($output) == 0){
				echo "2015-10-12 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2015-10-12" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}

			//13/10/15 testen
			echo "<h2>13/10/15</h2><hr>";
			$output = Minidagboek::where('datum', "2015-10-13")->get();
			if(count($output) == 0){
				echo "2015-10-13 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2015-10-13" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}

			//14/10/15 testen
			echo "<h2>14/10/15</h2><hr>";
			$output = Minidagboek::where('datum', "2015-10-14")->get();
			if(count($output) == 0){
				echo "2015-10-14 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2015-10-14" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}
		}
		else if($request->mode == "KBM"){
			$data = "27/5/16
Deadhead, Aurorae	vr	Djangeldag, naar post gegaan voor sara bikini af te halen, beslist om te gaan lopen, gigantische toer (10km+) in zieke hitte, legit nog nooit mentala zo hard afgezien, die laatste afstand tss humbeek en hier wqaren fucked up, bon naar pa gegaan, bien macaroni gegeten van delhaize, databases samengevat tot sql
28/5/16
Metal, Have You Ever Been Mellow	za	Gewerkt in delhaize, wa vroeger gegaan om te kunne djangelen me tristan, goeie dag, luc was al afwezig hahahaha, gevraag dvoor lisa tillo evelien en margot aan an, ging ni zo goe, behjalve voor lisa mss, tijdens middag me jirka nr ma, djangelmetal geluisterd, in aovnd naar alex agnew me nic, was echt bien, dan naar louche snackbar, negers tegegekomen da wouden bellen me onze gsm’s, fucking suspicious, gn slapen rond 2
29/5/16
Goa, Doom, Looperoonis	zo	In ochtend van ‘fuuuuk men dagboek is outdated’, gedacht om er mee te stoppe, Ma nope HUEHUE xd, sql samengevat, begonnen me leren, veel problemen met NF3 en BCNF, ma hulp gevraagd, nr ma rond 8u30, geleerd, me tobias gesnapchat";
			MinidagboekController::addEntriesMetRequest($request, $data);

			//27/5/16 testen
			echo "<h2>27/5/16</h2><hr>";
			$output = Minidagboek::where('datum', "2016-05-27")->get();
			if(count($output) == 0){
				echo "2016-05-27 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2015-10-12" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}

			//28/5/16 testen
			echo "<h2>28/5/16</h2><hr>";
			$output = Minidagboek::where('datum', "2016-05-28")->get();
			if(count($output) == 0){
				echo "2016-05-28 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2015-10-13" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}

			//29/5/16 testen
			echo "<h2>29/5/16</h2><hr>";
			$output = Minidagboek::where('datum', "2016-05-29")->get();
			if(count($output) == 0){
				echo "2016-05-29 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2016-05-29" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}
		}
		else if($request->mode == "BEIDE"){
			$data = "19/2/16	vr	Dagske gebrost, database ginge we sws brossen en operating systems is gecancelled dus jah we gaan ni gwn naar school gaan voor 2 uur engels hoorcoleege ehhh xd, bon wa verveeld, dan me mus gaan wandelene, ondertweg fuck it gedacht en besloten om erna wa te gana fietsen xd, da was amazing, zon cheen, echt me men backpack enzo, echt zalig, zo hetgeen wara ik in Istro aan dacht, da was wa ik nu aan het doen was, helemaal tot voorbij de carrefour in zemst gereden en dna terug, dan thuis wa tomaten gesneden me ma fors ome reaosn, dna nr lisa voor wa en het gecassed zonder iets te zegge, ff me jolien geprata buiten, zij terug nr binne, ik nr huis, gn slape rond 2, playlist metal opgezet
20/2/16	za	Gewerkt in delhaize, ZALIG, ging keigoe, vooral hete erste deel, keisociaal me iedereen, op het einde wa minder ma tegewoordig heb ik iets tege afscheid neme ofzo dus jah xd, bon w/e ookd e late me somaya ipv karine :o, dan nr pa, daar wa geprata me jolien over wa er gistere gebeurd was, dan room gekeken me pa, IZKE film, amazing echt, jup gedornken (voordien alcoholvrije jup ook d, viel ng wel mee), gn slapen rond halftwee
21/2/16
Heavy metal	zo	Dag niks gedaan, rond 4 uur een dik uur gaan fietsen, nr humbeek via beigem, tobais zne huis gepasseerd ezo, dan gegeten bij els, wah ara imkerhoningkaartje gephooshopped, pa zien ragen over het uploaden van zijn fotos op dropbox, dan nr ma, wa csgo gespeeld, wa me lisa  gesms’t over vrijdag
22/2/16
Heavy metal	ma	Nr school, 3 uur OO WE, eig maar 1 oef gemaakt xd, wa me hassan gelachen tijdens zen ziek gesprek me tobias over wolverine xd, dan nr macdo me thibaut senne tobias en tristan, dan meh halve moodswing in senne zen auto, nr huis, keiveel csgo gesqpeeld, ziek geowned, ophet einde zieke mirage comeback naar 15-15, veel me bram gechat over onze  game voor OO";
			MinidagboekController::addEntriesMetRequest($request, $data);

			//19/2/16 testen
			echo "<h2>19/2/16</h2><hr>";
			$output = Minidagboek::where('datum', "2016-02-19")->get();
			if(count($output) == 0){
				echo "2016-02-19 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2016-02-19" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}

			//20/2/16 testen
			echo "<h2>20/2/16</h2><hr>";
			$output = Minidagboek::where('datum', "2016-02-20")->get();
			if(count($output) == 0){
				echo "2016-02-20 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2016-02-20" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}

			//21/2/16 testen
			echo "<h2>21/2/16</h2><hr>";
			$output = Minidagboek::where('datum', "2016-02-21")->get();
			if(count($output) == 0){
				echo "2016-02-21 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2016-02-21" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}

			//22/2/16 testen
			echo "<h2>22/2/16</h2><hr>";
			$output = Minidagboek::where('datum', "2016-02-22")->get();
			if(count($output) == 0){
				echo "2016-02-22 is niet opgeslagen";
			}
			else if(count($output) == 1){
				echo "<ul>";
				echo "<li>Datum: " . "2016-02-22" . "</li>";
				echo "<li>Muziek: " . $output[0]->muziek . "</li>";
				echo "<li>Weekdag: " . $output[0]->weekdag . "</li>";
				echo "<li>Gebeurtenis: " . $output[0]->gebeurtenis . "</li>";
				echo "</ul>";
			}
			else{
				echo "Meerdere models gevonden voor deze datum";
			}
		}
	}

}