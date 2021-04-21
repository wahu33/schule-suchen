<?php

/* *******************************************************************
 * get_bilingual.php
 * Bilinguale Angebote als JSON-Record
 * Walter Hupfeld
 * wh: 02.09.2017
 *********************************************************************/

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  error_reporting(1);
  require("../refresh/config.php");

  $strSchulnr=(!empty($_GET)) ? (int)$_GET['snr'] : "";

  $strSQL="select sprache.U_Sprache_Text,fach.Fachtext
      from $strBilingualDB bilingual,
           $strUSpracheDB sprache,
           $strFachSchluesselDB fach
      where bilingual.U_Fach=fach.Fachschluessel
            and bilingual.U_Sprache=sprache.U_Sprache_Schluessel
            and bilingual.Schulnummer='$strSchulnr'";

  $stmt=$db->query($strSQL);
  $arrBilingual=$stmt->fetchAll(PDO::FETCH_ASSOC);
  $response = json_encode($arrBilingual);
  echo '{"bilingual":'.$response.'}';
 