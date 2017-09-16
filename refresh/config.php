<?php
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



?>
