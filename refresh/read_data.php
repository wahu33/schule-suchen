<?php
  /* *******************************************************************
   * Import von Schuldaten vom Bildundportal des MSW
   * Walter Hupfeld
   * wh: 31.01.2017 - Einfügen von Testschulen, try-catch für Datenbank
   * wh: 01.02.2017 - Optik
   *********************************************************************/

   require("config.php");
   $numS = $_GET['s'];
   $numS = (empty($numS)) ? 1 : $numS;
   $numS = (int)$numS;

   $file= $arrData[$numS]['xml'];
   $strDB= $arrData[$numS]['db'];

?>
<!doctype html>
<html lang="de">
<head>
  <title>Schulen einlesen</title>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h2>Schuldaten importieren</h2>
    <div class="alert alert-info" role="alert"><strong>Lese Datei <?=$file?> </strong></div>
    <div class="alert alert-info" role="alert"><strong>Importiere in Tabelle <?=$strDB?></strong></div>

<?php

	if (($response_xml_data = file_get_contents($file))===false){
		echo "Error fetching XML\n";
	} else {
	   libxml_use_internal_errors(true);
	   $data = simplexml_load_string($response_xml_data);
	   //DEBUG: echo "<pre>"; print_r($data);echo "</pre>";
	   if (!$data) {
		   echo "Error loading XML\n";
		   foreach(libxml_get_errors() as $error) {
			   echo "\t", $error->message;
		   }
	   } else {

	   $db->query("truncate $strDB");
	   $numCounter=1;
	   foreach ($data as $key => $value) {
			//DEBUG: echo $key ." => ".print_r($value) ."<br>";
			$strSQL="insert into $strDB set ";
			foreach ($value as $key2 => $value2) {
			   if ($key2=="E-Mail") $key2="E_Mail";
			   $strSQL .= $key2 ."='". addslashes($value2) ."',";
			}
			$strSQL=rtrim($strSQL,",");
			//DEBUG: echo $strSQL."<br><br>";
			if ($numCounter%100==0) echo ".";
			$numCounter++;
			try {
			   $db->query($strSQL);
		   } catch (PDOException $e) { echo $e->getMessage(); }
	   }
	 echo "<p>". $numCounter. " Datensätze eingelesen</p>";
  }
}
?>
 <p><a class="btn btn-primary" href="index.html">zurück</a></p>
  </div>
</body>
</html>
