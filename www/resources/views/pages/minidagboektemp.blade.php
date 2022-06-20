<!doctype html>
<?php
    require 'Controller/MinidagboekController.php';
    $minidagboekController = new MinidagboekController();
    $minidagboekModel = new MinidagboekModel();
?>
<html lang="nl">
<head>
    <link href="https://fonts.googleapis.com/css?family=Catamaran" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merienda" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100" rel="stylesheet">
    
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="./Styles/lifeoftaltiko.css">
    <script src="Plugins/jquery-3.0.0.min.js"></script>
    <script src="Plugins/jquery-color-master/jquery.color.js"></script>
    <script src="Plugins/jquery-color-master/jquery.color.svg-names.js"></script>
    <script src="Plugins/jquery.rotate.1-1.js"></script>
    
    <script src="lifeoftaltiko.js"></script>
    <style id="RKstijl"></style>
    <title>Minidagboek</title>
</head>
<body id="MD">
    <!-- BOVENBALK NAVIGATIE-->
    <div id="nav">
        <div id="navItems">
            <a href="index.php">Home</a>
            <a href="moodboek.php">Moodboek</a>
            <a href="minidagboek.php">Minidagboek</a>
            <a href="dagboek.php">Dagboek</a>
            <a>Andere</a>
        </div>
    </div>

    <!-- INHOUD -->
    <section>
       
        <!-- INHOUD -->
        <div id="inhoud">
        <?php
        $result = "";
        $allejaren = [];
        //JAARLOOP
        for($j = 10; $j < 30; $j++){
            if(count($minidagboekModel->getAllByJaar($j)) > 0){
                $allemaanden = [];
                $jaar = 2000 + $j;
                $result = $result . "<div id='$jaar' class='jaar'><jaarnaam><h1>" . $jaar . "</h1></jaarnaam><div class='maanden'>";
                
                //MAANDLOOP
                for($i = 1; $i < 13; $i++){
                    $maand = $i;
                    if($i < 10) $maand = "0" . $maand;
                    $dagen = $minidagboekModel->getAllByMaandAndJaar($maand, $j);
                    
                    if((count($dagen))!= 0){
                        $alledagen = [];
                        $welkemaand = explode('/', $dagen[0]->datum)[1];
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
                        $result = $result . "<div id='$maandid' class='maand'><maandnaam><h2>" . $maand . "</h2></maandnaam>";
                        $result = $result . "<div class='dagen'><table class='lottable'>" . "<tr><th>Datum</th><th>Dag</th><th>Gebeurtenis</th>";
                        
                        //DAGLOOP
                        foreach($dagen as $key => $dag){
                            $datumlink = explode("/", $dag->datum)[0] . "-" . explode("/", $dag->datum)[1] . "-" . explode("/", $dag->datum)[2]; 
                            $result = $result .
                                   "<tr id='$datumlink'>
                                        <td class='datum'>$dag->datum <br> $dag->muziek</td>     
                                        <td class='weekdag'>$dag->weekdag</td> 
                                        <td class='gebeurtenis'>$dag->gebeurtenis</td>   
                                    </tr>";
                            array_push($alledagen, $dag->datum);
                        }
                        $result = $result . "</table></div></div>";  
                        array_push($allemaanden, $alledagen);
                    }
                }
                $result = $result . "</div></div>";
                array_push($allejaren, $allemaanden);
            }
        }
        
        echo $result;
        ?>
            
        </div>
        <!-- POPUP: ENTRY -->
        <div class="togglepopup" id="entry">
            <div id="entrycontent">
                <div id="MD_entry_form">
                    <form name="form_name" action="">
                        <table id="MD_entry_table">
                            <tr>
                                <th for="datum" id="datum_label">DATUM</th>
                                <th for="weekdag" id="weekdag_label">DAG</th>
                                <th for="muziek" id="muziek_label">MUZIEK</th>
                                <th for="gebeurtenis" id="gebeurtenis_label">GEBEURTENIS</th>
                            </tr>
                            <tr>
                                <td><textarea type="text" name="datum" id="datum" size="30" value="" class="text-input"></textarea></td>
                                <td><textarea type="text" name="weekdag" id="weekdag" size="30" value="" class="text-input"></textarea></td>
                                <td><textarea type="text" name="muziek" id="muziek" size="30" value="" class="text-input"></textarea></td>
                                <td><textarea type="text" name="gebeurtenis" id="gebeurtenis" size="30" value="" class="text-input"></textarea></td>
                            </tr>
                        </table>
                        <div id="upload">
                            <input type="submit" name="submit" class="button" id="submit_btn" value="Upload" />
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        
        
        <!-- POPUP: KBM -->
        <div class="togglepopup" id="KBM">
            <div id="KBMcontent">
                <div id="KBM_entry_form">
                    <form name="form_name" action="">
                        <textarea id="KBM_area"></textarea>
                        <div id="upload">
                            <input type="submit" class="button3" id="KBM_button" value="Upload" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!--POPUP: DAG-->
        <div id="dagpopup">
           
        </div>
        
        <!--POPUP: RK-->
        <div id="RK">
            <div id="RKmenu">
                <div id="RKtop">
                    <h3 id="RKtitel"></h3>
                </div>
                <div id="RKbottom">
                    <ul id="RKul">
                        <li class="RKli"><fakeA id="RKedit" class="RKa"><span class='helper'></span><img  class="RKimg" src="{{env('APP_PREFIX')}}images/edit-zwt.png">Bewerk</fakeA></li>
                        <li class="RKli"><fakeA id="RKdelete" class="RKa"><span class='helper'></span><img class="RKimg" src="{{env('APP_PREFIX')}}images/delete-zwt.png">Verwijder</fakeA></li>
                        <li class="RKli"><fakeA id="RKstat" class="RKa"><span class='helper'></span><img class="RKimg" src="{{env('APP_PREFIX')}}images/statistieken-zwt.png">Statistieken</fakeA></li>
                    </ul>
                </div>
            </div>        
        </div>
        
        <!--POPUP: DELETE-->
        <div class="togglepopup" id="delpopup">
            <div id="delcontent">
                <div id="header">
                    
                </div>
                <div id="doorgaan">Doorgaan?</div>
                <fakeA id="ja" onclick="hideMenu('delpopup')">Ja</fakeA>
                <fakeA id="nee" onclick="hideMenu('delpopup')">Nee</fakeA>
            </div>
        </div>
        
        <!--POPUP: BACKUP-->
        <div class="togglepopup" id="backpopup">
            <div id="backcontent">
                <ul id="backnavul">
                    <li class="backnavli"><fakeA onclick="toggleBackupGUI(1,0)" class="backnava" id="makebackup">Backup maken</fakeA></li>
                    <li class="backnavli"><fakeA onclick="toggleBackupGUI(2,0)" class="backnava" id="putbackup">Backup terugzetten</fakeA></li>
                    <li class="backnavli"><span class='helper'></span><img id="backsettings" src="{{env('APP_PREFIX')}}images/settings2.png"></li>
                </ul>
                <div class="backuplayers" id="back1">
                    <div id="layer1-1">
                        <p1>Selecteer de items waarvan je een backup wil maken</p1>
                            <div id="backupitemscont">
                                <div id="backupitemscont2">
                                    <div id="backupitemscont3">
                                        <?php
                                            $allejaren = $GLOBALS['allejaren'];
                                            $result = "";

                                            for($i = 0; $i < count($allejaren); $i++){
                                                $result = $result . "<div class='backnavdeel'><ul class='ul1'>";
                                                $jaar = "20" . explode("/", $allejaren[$i][0][0])[2];
                                                $result = $result . "<li class='backnavjaar'><niks class='backnavjaarlink' name='$jaar'><div onclick='toggleBackup(this)' class='check'></div>$jaar<span class='helper'></span><img onclick='toggleDropdownJaar(this)' src='{{env('APP_PREFIX')}}images/expand_reverse.png' class='expand'></niks><ul class='backnavjaarInhoud'>";

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
                                                    $result = $result . "<li class='backnavmaand'><niks class='backnavmaandlink maand" . $jaar . "' name='$link'><div onclick='toggleBackup(this)' class='check'></div>$maand<span class='helper'></span><img onclick='toggleDropdownMaand(this)' src='{{env('APP_PREFIX')}}images/expand.png' class='expand'></niks><ul class='backnavmaandInhoud'>";
                                                    for($k = 0; $k < count($allejaren[$i][$j]); $k++){
                                                        $ohgod = $allejaren[$i][$j][$k];
                                                        $daglink = explode("/", $allejaren[$i][$j][$k])[0] . "-" . explode("/", $allejaren[$i][$j][$k])[1] . "-" . explode("/", $allejaren[$i][$j][$k])[2]; 
                                                        $result = $result . "<li class='backnavdag'><niks class='backnavdaglink dag" . $link . "' name='$daglink'><div onclick='toggleBackup(this)' class='check'></div>$ohgod</niks></li>";
                                                    }
                                                    $result = $result . "</ul></li>";
                                                }
                                                $result = $result . "</ul></li></ul></div>";
                                            }
                                            echo $result;
                                        ?>
                                        </div>
                                </div>
                            </div>
                            <div id="backselectcont">
                            </div>
                            <div class="volgendepijl" id="volgendepijl" onclick="toggleBackupGUI(1,2)"></div>
                    </div>
                 
                    <div id="layer1-2">
                        <div id="layer1-2content">
                            <p1>Geef een naam voor de backup</p1>
                            <error>Gelieve een naam in te vullen</error>
                            <div id="backupnaamcont"><input type="text" id="backupnaamtextarea"></input><div id="txtcont"><div id="txt">.txt</div></div></div>
                            <div class="volgendepijl" id="volgendepijl2" onclick="toggleBackupGUI(1,3)"></div>
                            <div class="vorigepijl" id="vorigepijl" onclick="toggleBackupGUI(1,1)"></div>
                        </div>

                    </div>
                    <div id="layer1-3">
                        <div id="layer1-3content">
                            <p1>Voeg een opmerking toe</p1>
                            <textarea id="opmerkingtextarea"></textarea>
                            <div class="volgendepijl" id="volgendepijl4" onclick="verzendBackup()"></div>
                            <div class="vorigepijl" id="vorigepijl2" onclick="toggleBackupGUI(1,2)"></div>
                        </div>

                    </div>
                </div> 
                <div class="backuplayers" id="back2">
                    <div id="layer2-1">
                        <p1>Kies een backup om terug te zetten</p1>
                        <div id="backuplistcont">
                            <div id="backuplistcont2">
                                <?php
                                    $content = "<table>";
                                    $backups = scandir('./backups');
                                    array_splice($backups, 0, 2);
                                    for($i = 0; $i < count($backups); $i++){
                                        $pureNaam = substr($backups[$i],0, count($backups[$i])-5);
                                        $currentbackup = MinidagboekModel::getBackup($pureNaam);
                                        
                                        $content = $content . "<tr onclick='selectBackup(this)' class='backups' id='backup-" . $pureNaam . "'><td class='backupvinkje'><div class='check'></div></td><td class='backupnaam'>" . $backups[$i] . "</td><td class='backupdatum'>" . $currentbackup->datum . "</td></tr>";
                                    }
                                    $content = $content . "</table>";
                                    echo $content;
                                    ?>
                                <error>Gelieve een of meerdere backups te selecteren</error>
                            </div>
                        </div>
                        <div class="volgendepijl" id="volgendepijl4" onclick="toggleBackupGUI(2,2)"></div>
                    </div>
                    <div id="layer2-2">
                        <p1>Duid aan in welke volgorde de backups elkaar moeten overschrijven (indien nodig). Je geselecteerde backups zijn <br><div id="selectedbackups"></div></p1>
                        <div id="volgordebackupscont">
                            <div id="volgordebackupscont2">
                                <table id="SBT">
                                </table>
                            </div>
                        </div>
                        <div class="vorigepijl" id="vorigepijl3" onclick="toggleBackupGUI(2,1)"></div>
                        <div class="volgendepijl" id="volgendepijl4" onclick="toggleBackupGUI(2,3)"></div>
                    </div>
                </div>
            </div>
            <?php
                $backups = scandir('./backups');
                array_splice($backups, 0, 2);
                $opmerkingencontent = "";
                for($i = 0; $i < count($backups); $i++){
                    $pureNaam = substr($backups[$i],0, count($backups[$i])-5);
                    $currentbackup = MinidagboekModel::getBackup($pureNaam);

                    $opmerkingencontent = $opmerkingencontent . "<div class='backupopmerking' id='opmerking-" . $pureNaam . "'>" . $currentbackup->opmerking . "</div>";
                }
                echo $opmerkingencontent;
            ?>  
        </div>
    </section>
    
    <!-- LINKERBALK MENU -->
    <div id="menu">
        <div id="functies">
            <ul class="ul1">
                <li class="li1"><fakeA class="a1">Dag toevoegen</fakeA>
                    <ul class="ul2">
                        <li class="li2"><fakeA onclick="toonMenu('entry')" class="a2">Nieuwe entry</fakeA></li>
                        <li class="li2"><fakeA onclick="toonMenu('KBM')" class="a2">Toevoegen via kladblok</fakeA></li>
                    </ul>
                </li>
                <li class="li1"><fakeA class="a1b">Dagen vergelijken</fakeA></li>
                <li class="li1"><fakeA class="a1">Extra</fakeA>
                    <ul class="ul2">
                        <li class="li2"><fakeA onclick="toonMenu('backpopup')" class="a2">Backups</fakeA></li>
                        <li class="li2"><fakeA onclick="toonMenu('KBM')" class="a2">Toevoegen via kladblok</fakeA></li>
                    </ul>
                </li>
            </ul>
            
        </div>
        <lijn></lijn>
        <div id="navigatie">
            <?php
                $allejaren = $GLOBALS['allejaren'];
                $result = "";
                $result = $result . "<ul class='ul1'>";
                for($i = 0; $i < count($allejaren); $i++){
                    $jaar = "20" . explode("/", $allejaren[$i][0][0])[2];
                    $result = $result . "<li class='navjaar'><a class='navjaarlink' href='#' name='#$jaar'>$jaar<span class='helper'></span><img onclick='toggleDropdownJaar(this)' src='{{env('APP_PREFIX')}}images/expand_reverse.png' class='expand'></a><ul class='navjaarInhoud'>";

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
                        $result = $result . "<li class='navmaand'><a class='navmaandlink' href='#' name='$link'>$maand<span class='helper'></span><img onclick='toggleDropdownMaand(this)' src='{{env('APP_PREFIX')}}images/expand.png' class='expand'></a><ul class='navmaandInhoud'>";
                        for($k = 0; $k < count($allejaren[$i][$j]); $k++){
                            $ohgod = $allejaren[$i][$j][$k];
                            $daglink = explode("/", $allejaren[$i][$j][$k])[0] . "-" . explode("/", $allejaren[$i][$j][$k])[1] . "-" . explode("/", $allejaren[$i][$j][$k])[2]; 
                            $result = $result . "<li class='navdag'><a class='navdaglink' href='#' name='#$daglink'>$ohgod</a></li>";
                        }
                        $result = $result . "</ul></li>";
                    }
                    $result = $result . "</ul></li>";
                }
                $result = $result . "</ul>";
                echo $result;
            ?>
        </div>
    </div>
</body>
</html>