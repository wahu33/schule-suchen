<?php

/* *******************************************************************
 * get_jsp.php
 * Förderschwerpunkte als JSON-Record
 * Walter Hupfeld
 * wh: 29.05.2018
 *********************************************************************/

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  error_reporting(1);
  require("../refresh/config.php");

  $strSchulnr=(!empty($_GET)) ? (int)$_GET['snr'] : "";

  $strSQL="select bez.FSPtext
      from $strFoerderSpDB  fs,
           $strFSKeyDB bez
      where fs.Foerderschwerpunkt=bez.FSPschluessel
            and fs.Schulnummer='$strSchulnr'";

  $stmt=$db->query($strSQL);
  $arrFSP=$stmt->fetchAll(PDO::FETCH_ASSOC);
  $response = json_encode($arrFSP);
  echo '{"fsp":'.$response.'}';
 