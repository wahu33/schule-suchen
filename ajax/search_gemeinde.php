<?php

/* *******************************************************************
 * search_gemeinde.php
 * Gemeinden als JSON-Record
 * Walter Hupfeld
 * wh: 04.09.2017
 *********************************************************************/

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  error_reporting(1);
  require("../refresh/config.php");

  $strGemeinde=(!empty($_GET)) ? $_GET['q'] : "";

  $stmt = $db->prepare("select Schluessel,Bezeichnung  from ".$strGemeindeDB.
                       " where Bezeichnung like ?  limit 30");
  $stmt->execute(array( '%'.$strGemeinde.'%' ));

  $arrGemeinde=$stmt->fetchAll(PDO::FETCH_ASSOC);
  $response = json_encode($arrGemeinde);
  echo '{"gemeinden":'.$response.'}';
