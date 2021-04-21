<?php
  /* *******************************************************************
   * get_schule.php
   * Schuldaten als JSON-Record
   * Walter Hupfeld
   * wh: 21.08.2017
   *********************************************************************/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    error_reporting(1);
    require("../refresh/config.php");
    require_once("geoconvert.php");

    if (isset($_GET['snr'])) {
	  $strSchulnr = $_GET['snr'];
    $arrSchule = array();
    unset($arrSchule);

    $query="select adr.*,sbetrieb.Bezeichnung as Schulbetrieb,
               sform.Bezeichnung as SchulformBez,
               srechtsform.Bezeichnung as RechtsformBez,
               straeger.Kurzbezeichnung as TraegerBez,
               sgemeinde.Bezeichnung as GemeindeBez,
               sbetrieb.Bezeichnung as Schulbetrieb,
               sschuelerzahl.Anzahl as Schuelerzahl
            from $strAdressDB adr,
               $strBetriebDB sbetrieb,
               $strSchulformDB sform,
               $strRechtsformDB srechtsform,
               $strTraegerDB straeger,
               $strGemeindeDB sgemeinde,
               $strSchuelerzahlenDB sschuelerzahl
            where
              adr.Schulbetriebsschluessel=sbetrieb.Schluessel and
              adr.Schulform=sform.Schluessel and
              adr.Rechtsform=srechtsform.Schluessel and
              adr.Traegernummer=straeger.Traegernummer and
              adr.Gemeindeschluessel=sgemeinde.Schluessel and
              adr.Schulnummer=sschuelerzahl.Schulnummer and
              adr.Schulnummer='$strSchulnr'";

     $result=$db->query($query);
  	 if ($schulen=$result->fetch(PDO::FETCH_ASSOC)) {
    	    $arrSchule['sf'] = $schulen['Schulform'];
          $arrSchule['Schulformbezeichnung'] = $schulen['SchulformBez'];
    	    $arrSchule['Name'] = trim($schulen['Schulbezeichnung_1']);
    		  $arrSchule['Adresse'] =  $schulen['PLZ']." ".trim($schulen['Ort'])." ".trim($schulen['Strasse']);
          $arrSchule['Kurzbezeichnung'] = $schulen['Kurzbezeichnung'];
          $arrSchule['Schulbezeichnung_1'] = $schulen['Schulbezeichnung_1'];
          $arrSchule['Schulbezeichnung_2'] = $schulen['Schulbezeichnung_2'];
          $arrSchule['Schulbezeichnung_3'] = $schulen['Schulbezeichnung_3'];
          $arrSchule['PLZ'] = $schulen['PLZ'];
          $arrSchule['Ort'] = $schulen['Ort'];
          $arrSchule['Strasse'] = $schulen['Strasse'];
          $arrSchule['Telefon'] = $schulen['Telefonvorwahl']."/".$schulen['Telefon'];
          $arrSchule['Fax'] = $schulen['Faxvorwahl']."/".$schulen['Fax'];
          $arrSchule['Email'] = $schulen['E_Mail'];
          $arrSchule['Homepage'] = $schulen['Homepage'];
          $arrSchule['Schuelerzahl'] = $schulen['Schuelerzahl'];

          $arrSchule['Schulnummer'] = $schulen['Schulnummer'];
          $arrSchule['Schulbetrieb'] = $schulen['Schulbetrieb'];
          $arrSchule['Betriebsdatum'] = $schulen['Schulbetriebsdatum'];
          $arrSchule['Traeger'] = $schulen['TraegerBez'];
          $arrSchule['Gemeinde'] = $schulen['GemeindeBez'];
          $numEasting=$schulen['KoordinatenRechtswert'];#/10;Änderung 14.10.17
          $numNorthing=$schulen['KoordinatenHochwert'];#/10;Änderung 14.10.17
          list($numLat,$numLong)=calculate($numEasting,$numNorthing);
          $arrSchule['latitude'] = $numLat;
          $arrSchule['longitude'] = $numLong;
      }
    }
    $response = json_encode($arrSchule);
    echo $response;
