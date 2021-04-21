<?php
/* ************************************
* Walter Hupfeld
* Konfigurationsdatei für Schle suchen
*
************************************** */

   $db_server="localhost";
   $db_user="schuladressen";
   $db_passwd="zuYfGEwAVA8F4Ga2";
   $db_name="schuladressen";

    $db = new PDO('mysql:host=localhost;dbname='.$db_name.';charset=utf8mb4', $db_user, $db_passwd);

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);


   $strAdressDB     = "t01_schuladressen";
   $strTraegerDB    = "t02_schultraeger";
   $strBetriebDB    = "t03_schulbetriebsschluessel";
   $strSchulformDB  = "t04_schulformschluessel";
   $strRechtsformDB = "t05_rechtsformschluessel";
   $strGemeindeDB   = "t06_gemeindeschluessel";
   $strKurseDB      = "t10_kurse";
   $strFachSchluesselDB = "t11_fachschluessel";
   $strSchuelerzahlenDB = "t15_schuelerzahlen";
   $strBilingualDB  = "t16_bilingual";
   $strUSpracheDB   = "t12_usprache";
   $strFSKeyDB      = "t17_foerderschwerpunkteschluessel";
   $strLaenderDB    = "t18_laenderschluessel";
   $strFoerderSpDB  = "t19_foerderschwerpunkte";
   $strInternationeKontakteDB = "t20_internationale_kontakte";

   $strFileAdressen   = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/schuldaten.xml";
   $strFileTraeger    = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/key_traeger.xml";
   $strFileBetrieb    = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/key_schulbetriebsschluessel.xml";
   $strFileSchulform  = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/key_schulformschluessel.xml";
   $strFileRechtsform = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/key_rechtsform.xml";
   $strFileGemeine    = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/key_gemeinde.xml";
   $strFileKurse      = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/GymGeGOst/kurse.xml";
   $strFileFachSchluessel = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/GymGeGOst/key_fach.xml";
   $strFileSchuelerzahlen = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/SchuelerGesamtZahl/anzahlen.xml";
   $strFileBilingual   = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/bilinguales/bilingualeAngebote.xml";
   $strFileUSprache    = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/bilinguales/key_U_Sprache.xml";
   $strFileIntKontakte = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/inko/internationaleKontakte.xml";
   $strFileLaender     = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/inko/key_land.xml";
   $strFileFoerdersp  =  "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/gemfoerder/genehmigteFoerderschwerpunkte.xml";
   $strFileFoerderspKey ="https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/gemfoerder/key_foerderschwerpunkte.xml";
   $strFileInternationleKontakte = "https://www.schulministerium.nrw.de/BiPo/OpenData/Schuldaten/inko/internationaleKontakte.xml";

   $arrData = array ();
   $arrData[1] = ["db" => $strAdressDB, "xml" => $strFileAdressen];
   $arrData[2] = ["db" => $strTraegerDB, "xml" => $strFileTraeger];
   $arrData[3] = ["db" => $strBetriebDB, "xml" => $strFileBetrieb];
   $arrData[4] = ["db" => $strSchulformDB, "xml" => $strFileSchulform];
   $arrData[5] = ["db" => $strRechtsformDB, "xml" => $strFileRechtsform];
   $arrData[6] = ["db" => $strKurseDB, "xml" => $strFileKurse];
   $arrData[7] = ["db" => $strFachSchluesselDB, "xml" => $strFileFachSchluessel];
   $arrData[8] = ["db" => $strGemeindeDB, "xml" => $strFileGemeine];
   $arrData[9] = ["db" => $strSchuelerzahlenDB, "xml" => $strFileSchuelerzahlen];
   $arrData[10] = ["db" => $strBilingualDB, "xml" => $strFileBilingual];
   $arrData[11] = ["db" => $strUSpracheDB, "xml" => $strFileUSprache];
   $arrData[12] = ["db" => $strLaenderDB, "xml" => $strFileLaender];
   $arrData[13] = ["db" => $strFSKeyDB, "xml" => $strFileFoerderspKey];
   $arrData[14] = ["db" => $strFoerderSpDB, "xml" => $strFileFoerdersp];
   $arrData[15] = ["db" => $strInternationeKontakteDB, "xml" => $strFileInternationleKontakte];
   
