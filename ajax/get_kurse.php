<?php

  /* *******************************************************************
   * get_kurse.php
   * Kursdaten als JSON-Record
   * Walter Hupfeld
   * wh: 02.09.2017
   *********************************************************************/
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   error_reporting(1);
   require("../refresh/config.php");

   $strSchulnr=(!empty($_GET)) ? (int)$_GET['snr'] : "";

   $strSQL="select k.schulnummer, f.Fachtext, GKEF,GKQ1,GKQ2, LKQ1, LKQ2
                from $strKurseDB k, $strFachSchluesselDB f
                where  k.Fachschluessel=f.Fachschluessel
                       and k.schulnummer='$strSchulnr'
                order by f.Fachtext";

    $stmt=$db->query($strSQL);
    if ($arrKurse=$stmt->fetchAll(PDO::FETCH_ASSOC)) {
  	   //DEBUG: echo "<pre>"; print_r($arrKurse); echo "</pre>";
  	   for ($i=0; $i < sizeof($arrKurse); $i++)   { if ($arrKurse[$i]['GKEF']==1) $arrGKEF[]=$arrKurse[$i]['Fachtext']; }
  	   for ($i=0; $i < sizeof($arrKurse); $i++)   { if ($arrKurse[$i]['GKQ1']==1) $arrGKQ1[]=$arrKurse[$i]['Fachtext']; }
  	   for ($i=0; $i < sizeof($arrKurse); $i++)   { if ($arrKurse[$i]['LKQ1']==1) $arrLKQ1[]=$arrKurse[$i]['Fachtext']; }
  	   for ($i=0; $i < sizeof($arrKurse); $i++)   { if ($arrKurse[$i]['GKQ2']==1) $arrGKQ2[]=$arrKurse[$i]['Fachtext']; }
  	   for ($i=0; $i < sizeof($arrKurse); $i++)   { if ($arrKurse[$i]['LKQ2']==1) $arrLKQ2[]=$arrKurse[$i]['Fachtext']; }
    }
    $responseGKEF = json_encode($arrGKEF);
    $responseGKQ1 = json_encode($arrGKQ1);
    $responseLKQ1 = json_encode($arrLKQ1);
    $responseGKQ2 = json_encode($arrGKQ2);
    $responseLKQ2 = json_encode($arrLKQ2);

    echo '{"gkef":'.$responseGKEF.',
           "gkq1":'.$responseGKQ1.',
           "lkq1":'.$responseLKQ1.',
           "gkq2":'.$responseGKQ2.',
           "lkq2":'.$responseLKQ2.'}';

 ?>
