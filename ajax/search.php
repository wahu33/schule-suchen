<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

 require_once("../refresh/config.php");
//get the q parameter from URL
$q= (!empty($_GET['q'])) ? $_GET['q'] : "be";

$arrSearch = explode(" ",$q);

$strSearch ="'%".$arrSearch[0]."%'";
$strWhere = " (Schulnummer like $strSearch or
	      Schulbezeichnung_1 like $strSearch or
	      Schulbezeichnung_2 like $strSearch or
	      Schulbezeichnung_3 like $strSearch or
	      PLZ like $strSearch or
	      Ort like $strSearch) ";

for ($i=1; $i<count($arrSearch); $i++) {
	$strSearch ="'%".$arrSearch[$i]."%'";
	$strWhere .= " and (Schulnummer like $strSearch or
			  Schulbezeichnung_1 like $strSearch or
			  Schulbezeichnung_2 like $strSearch or
			  Schulbezeichnung_3 like $strSearch or
			  PLZ like $strSearch or
			  Ort like $strSearch) ";
}
if (strlen($q)>0)
{

    $query="select distinct Schulnummer,Schulbezeichnung_1,PLZ,Ort from  $strAdressDB
	   where $strWhere
	   order by PLZ asc limit 30";
	   //DEBUG: echo $query;
     $stmt=$db->query($query);
     $result = $stmt->fetchall(PDO::FETCH_ASSOC);

}
     $response = json_encode($result);
     echo '{"records":'.$response.'}';

