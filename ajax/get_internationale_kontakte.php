<?php

/* *******************************************************************
 * get_jsp.php
 * Internationale Kontakte als JSON-Record
 * Walter Hupfeld
 * wh: 30.05.2018
 *********************************************************************/

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  error_reporting(1);
  require("../refresh/config.php");

  $strSchulnr=(!empty($_GET)) ? (int)$_GET['snr'] : "";

  $strSQL="select land.Landtext
      from $strInternationeKontakteDB  ik,
           $strLaenderDB land
      where ik.Land=land.Landschluessel
            and ik.Schulnummer='$strSchulnr'";

  $stmt=$db->query($strSQL);
  $arrIK=$stmt->fetchAll(PDO::FETCH_ASSOC);
  $response = json_encode($arrIK);
  echo '{"ik":'.$response.'}';
 