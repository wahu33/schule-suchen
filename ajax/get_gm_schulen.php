<?php
  /* *******************************************************************
   * get_gm_schulen.php
   * Schulen einer Gemeinde als JSON-Record
   * Walter Hupfeld
   * wh: 04.09.2017
   *********************************************************************/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    error_reporting(1);
    require("../refresh/config.php");
    require_once("geoconvert.php");

    if (isset($_GET['gem'])) {
  	  $numGemeinde = (int)$_GET['gem'];
      $arrSchulen = array();
      unset($arrSchulen);

      $query="select adr.*,
               sform.Bezeichnung as SchulformBez,
               srechtsform.Bezeichnung as RechtsformBez
            from $strAdressDB adr,
               $strSchulformDB sform,
               $strRechtsformDB srechtsform,
               $strGemeindeDB sgemeinde
            where
              adr.Schulform=sform.Schluessel and
              adr.Rechtsform=srechtsform.Schluessel and
              adr.Gemeindeschluessel=sgemeinde.Schluessel and
              adr.Gemeindeschluessel=$numGemeinde
            order by  adr.Schulform";
      //DEBUG:echo $query;
       $i=1;
       $result=$db->query($query);
    	 while ($schulen=$result->fetch(PDO::FETCH_ASSOC)) {

      	  $arrSchulen[$i]['sf'] = $schulen['Schulform'];
          $arrSchulen[$i]['Schulformbezeichnung'] = $schulen['SchulformBez'];
    	    $arrSchulen[$i]['Name'] = trim($schulen['Schulbezeichnung_1']);
    		  //$arrSchulen[$i]['Adresse'] =  $schulen['PLZ']." ".trim($schulen['Ort'])." ".trim($schulen['Strasse']);
          $arrSchulen[$i]['Kurzbezeichnung'] = $schulen['Kurzbezeichnung'];
          $arrSchulen[$i]['Schulbezeichnung_1'] = $schulen['Schulbezeichnung_1'];
          $arrSchulen[$i]['Schulbezeichnung_2'] = $schulen['Schulbezeichnung_2'];
          $arrSchulen[$i]['Schulbezeichnung_3'] = $schulen['Schulbezeichnung_3'];
          $arrSchulen[$i]['PLZ'] = $schulen['PLZ'];
          $arrSchulen[$i]['Ort'] = $schulen['Ort'];
          $arrSchulen[$i]['Strasse'] = $schulen['Strasse'];
          //$arrSchulen[$i]['Telefon'] = $schulen['Telefonvorwahl']."/".$schulen['Telefon'];

          $arrSchulen[$i]['Schulnummer'] = $schulen['Schulnummer'];
          $arrSchulen[$i]['Gemeinde'] = $schulen['GemeindeBez'];
          $numEasting=$schulen['KoordinatenRechtswert'];///10;Änderung 14.10.17
          $numNorthing=$schulen['KoordinatenHochwert'];//10;Änderung 14.10.17
          list($numLat,$numLong)=calculate($numEasting,$numNorthing);
          $arrSchulen[$i]['latitude'] = $numLat;
          $arrSchulen[$i]['longitude'] = $numLong;
          $i++;
      }
    }
    $response = json_encode($arrSchulen);
    echo $response;
