<?php

  /* *******************************************************************
   * get_statistic.php
   * Schulstatistik als JSON-Record
   * Walter Hupfeld
   * wh: 02.09.2017
   *********************************************************************/
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   error_reporting(1);
   require("../refresh/config.php");

   $numGemeinde= (!empty($_GET['gmd'])) ? (int)$_GET['gmd'] : "";
   $strWhere = (!empty($numGemeinde)) ? " and adr.Gemeindeschluessel=$numGemeinde " : "";

   $query="select sform.Bezeichnung as Schulform,
                  count(Schulform) as Anzahl, sum(Anzahl) as SAnzahl
            from $strAdressDB adr,
                 $strSchulformDB sform,
                 $strSchuelerzahlenDB sschuelerzahl
            where
              adr.Schulform=sform.Schluessel and
              adr.Schulnummer=sschuelerzahl.Schulnummer $strWhere
            group by adr.Schulform
            order by Anzahl DESC, SAnzahl DESC";
    //DEBUG: echo $query;
    $result = $db->query($query);
    $sfstatistik = $result->fetchall(PDO::FETCH_ASSOC);


    $query= "select srechtsform.Bezeichnung as Rechtsform,
                    count(Schulform) as Anzahl, sum(Anzahl) as SAnzahl
              from $strAdressDB adr,
                   $strSchulformDB sform,
                   $strSchuelerzahlenDB sschuelerzahl,
                   $strRechtsformDB srechtsform
              where
                adr.Rechtsform=srechtsform.Schluessel and
                adr.Schulform=sform.Schluessel and
                adr.Schulnummer=sschuelerzahl.Schulnummer $strWhere
              group by adr.Rechtsform";
      $result = $db->query($query);
      $rfstatistik = $result->fetchall(PDO::FETCH_ASSOC);

    $responseSF = json_encode($sfstatistik);
    $responseRF = json_encode($rfstatistik);
    echo '{"sfstatistik":'.$responseSF.',"rfstatistik":'.$responseRF.'}';


