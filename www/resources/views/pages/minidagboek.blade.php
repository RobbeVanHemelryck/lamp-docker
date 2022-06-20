@extends('main')

@section('title', 'Moodboek')

@section('stylesheets')

    <style id="RKstijl"></style>

@endsection

@section('content')

<div id="MD">
	@include('partials._nav')
	
	
	<!-- INHOUD -->
    <section>
       
        <!-- INHOUD -->
        <div id="inhoud">
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
                                <td><textarea type="text" name="datum" id="datum" size="30" value="" class="text-input" placeholder="01/01/70"></textarea></td>
                                <td><textarea type="text" name="weekdag" id="weekdag" size="30" value="" class="text-input" placeholder="ma"></textarea></td>
                                <td><textarea type="text" name="muziek" id="muziek" size="30" value="" class="text-input" placeholder="Naar wat heb je geluisterd?"></textarea></td>
                                <td><textarea type="text" name="gebeurtenis" id="gebeurtenis" size="30" value="" class="text-input" placeholder="Wat heb je beleefd?"></textarea></td>
                            </tr>
                        </table>
                        <div id="upload">
                            <fakeA name="submit" class="button" id="KB_button" onclick="verzendEntry()">Upload</fakeA>
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
                            <fakeA name="submit" class="button" id="KBM_button" onclick="verzendEntries()">Upload</fakeA>
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
                        <li class="RKli"><fakeA id="RKedit" class="RKa"><span class='helper'></span><img  class="RKimg" src="/{{env('APP_PREFIX')}}images/edit-zwt.png">Bewerk</fakeA></li>
                        <li class="RKli"><fakeA id="RKdelete" class="RKa"><span class='helper'></span><img class="RKimg" src="/{{env('APP_PREFIX')}}images/delete-zwt.png">Verwijder</fakeA></li>
                        <li class="RKli"><fakeA id="RKstat" class="RKa"><span class='helper'></span><img class="RKimg" src="/{{env('APP_PREFIX')}}images/statistieken-zwt.png">Statistieken</fakeA></li>
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
                    <li class="backnavli"><span class='helper'></span><img id="backsettings" src="/{{env('APP_PREFIX')}}images/settings2.png"></li>
                </ul>
                <div class="backuplayers" id="back1">
                    <div id="layer1-1">
                        <p1>Selecteer de items waarvan je een backup wil maken</p1>
                            <div id="backupitemscont">
                                <div id="backupitemscont2">
                                    <div id="backupitemscont3">
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
                                /*
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
                                    */
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
            /*
                $backups = scandir('./backups');
                array_splice($backups, 0, 2);
                $opmerkingencontent = "";
                for($i = 0; $i < count($backups); $i++){
                    $pureNaam = substr($backups[$i],0, count($backups[$i])-5);
                    $currentbackup = MinidagboekModel::getBackup($pureNaam);

                    $opmerkingencontent = $opmerkingencontent . "<div class='backupopmerking' id='opmerking-" . $pureNaam . "'>" . $currentbackup->opmerking . "</div>";
                }
                echo $opmerkingencontent;
                */
            ?>  
        </div>

        <!-- POPUP: ERROR -->
        <div class="togglepopup" id="errorpopup">
            <div id="errorcontent">
                <div id="errortitel">Error</div>
                <div id="errorcont">
                    <div>Er bestaan al entries voor onderstaande dagen. Kies welke je wilt overschrijven.</div>
                    <div id="errorDuplicateSelectAll">
                        Selecteer alles  <fakeA id="errorDuplicateSelectAllCheck" onclick="selectAllDuplicates(this)"></fakeA>
                    </div>
                    <div id="errorDuplicateEntryCont">
                    </div>
                    <div id="errorDuplicateSubmitCont">
                        <div id="errorDuplicateSubmit">
                            <tekst onclick="overrideDuplicates()">Doorgaan</tekst>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- LINKERBALK MENU -->
    <div id="menu">
        <div id="functies">
            <ul class="ul1">
                <li class="li1"><fakeA class="a1">Dag toevoegen</fakeA>
                    <ul class="ul2">
                        <li class="li2"><fakeA onclick="toonMenu('entry')" class="a2">Nieuwe entry</fakeA>
                            <ul class="ul3">
                                <li class="li3"><fakeA onclick="toonMenu('backpopup', 'backup')" class="a3">Backups</fakeA></li>
                                <li class="li3"><fakeA onclick="toonMenu('KBM')" class="a3">Toevoegen via kladblok</fakeA></li>
                            </ul>    
                        </li>
                        <li class="li2"><fakeA onclick="toonMenu('KBM')" class="a2">Toevoegen via kladblok</fakeA></li>
                    </ul>
                </li>
                <li class="li1"><fakeA class="a1b">Dagen vergelijken</fakeA></li>
                <li class="li1"><fakeA class="a1">Extra</fakeA>
                    <ul class="ul2">
                        <li class="li2"><fakeA onclick="toonMenu('backpopup', 'backup')" class="a2">Backups</fakeA></li>
                        <li class="li2"><fakeA onclick="toonMenu('KBM')" class="a2">Toevoegen via kladblok</fakeA></li>
                    </ul>
                </li>
            </ul>
            
        </div>
        <lijn></lijn>
        <div id="navigatie">
        </div>
    </div>

	
</div>

@endsection