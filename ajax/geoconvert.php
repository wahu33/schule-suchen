<?php


function calculate($GKRight,$GKHeight) {

    //Falls nicht alle GK-Werte eingegeben wurden -> Meldung, Verlassen
    if (!(($GKRight > 1000000) && ( $GKHeight > 1000000)))
            {
            echo("Es wurde kein gültiger Gauß-Krüger-Code eingegeben. Bitte überprüfen Sie Ihre Eingaben!");
            return;
            }
    //$bII, $bf, $co, $g2, $g1, $t, $fa, $dl, $min, $sek, $rho,
    $e2 = 0.0067192188;
    $c = 6398786.849;
    $rho = 180.0 / pi();
    $bII = ($GKHeight / 10000855.7646) * ($GKHeight / 10000855.7646);

    $bf = 325632.08677 * ($GKHeight / 10000855.7646) * ((((((0.00000562025 * $bII + 0.00022976983) * $bII - 0.00113566119) * $bII + 0.00424914906) * $bII - 0.00831729565) * $bII + 1));

    $bf /= 3600 * $rho;

    $co = cos($bf);

    $g2 = $e2 * ($co * $co);

    $g1 = $c / sqrt(1 + $g2);

    $t = tan($bf);

    $fa = ($GKRight - floor($GKRight / 1000000) * 1000000 - 500000) / $g1;

    $GeoDezRight = (($bf - $fa * $fa * $t * (1 + $g2) / 2 + $fa * $fa * $fa * $fa * $t * (5 + 3 * $t * $t + 6 * $g2 - 6 * $g2 * $t * $t) / 24) * $rho);

    $dl = $fa - $fa * $fa * $fa * (1 + 2 * $t * $t + $g2) / 6 + $fa * $fa * $fa * $fa * $fa * (1 + 28 * $t * $t + 24 * $t * $t * $t * $t) / 120;

    //echo "FA:".$fa."<br>";
    //echo "dl:".$dl."<br>";
    //echo "rho:".$rho."<br>";
    //echo "co:".$co."<br>";

    $GeoDezHeight = $dl * $rho / $co + floor($GKRight / 1000000) * 3;

    //echo "Height ".$GeoDezHeight."<br>";
    //echo "Right ".$GeoDezRight."<br>";

    $GeoSystemEll = "WGS84";

    if ($GeoSystemEll == "WGS84")
            {
            //var CartesianXMeters, CartesianYMeters, CartesianZMeters, n,
            $aBessel = 6377397.155;
            $eeBessel = 0.0066743722296294277832;
            $CartOutputXMeters;
            //CartOutputYMeters, CartOutputZMeters,
            $ScaleFactor = 0.00000982;
            $RotXRad = -7.16069806998785E-06;
            $RotYRad = 3.56822869296619E-07;
            $RotZRad = 7.06858347057704E-06;
            $ShiftXMeters = 591.28;
            $ShiftYMeters = 81.35;
            $ShiftZMeters = 396.39;
            $aWGS84 = 6378137;
            $eeWGS84 = 0.0066943799;
            //var Latitude, LatitudeIt;

            $GeoDezRight = ($GeoDezRight / 180) * pi();
            $GeoDezHeight= ($GeoDezHeight / 180) * pi();

            $n = $eeBessel * sin($GeoDezRight) * sin($GeoDezRight);
            $n = 1 - $n;
            $n = sqrt($n);
            $n = $aBessel / $n;
            //window.alert(n);
            $CartesianXMeters = $n * cos($GeoDezRight) * cos($GeoDezHeight);
            $CartesianYMeters = $n * cos($GeoDezRight) * sin($GeoDezHeight);
            $CartesianZMeters = $n * (1 - $eeBessel) * sin($GeoDezRight);

            $CartOutputXMeters = (1 + $ScaleFactor) * $CartesianXMeters + $RotZRad * $CartesianYMeters - $RotYRad * $CartesianZMeters + $ShiftXMeters;
            $CartOutputYMeters = -$RotZRad * $CartesianXMeters + (1 + $ScaleFactor) * $CartesianYMeters + $RotXRad * $CartesianZMeters + $ShiftYMeters;
            $CartOutputZMeters = $RotYRad * $CartesianXMeters - $RotXRad * $CartesianYMeters + (1 + $ScaleFactor) * $CartesianZMeters + $ShiftZMeters;

            $GeoDezHeight = atan(($CartOutputYMeters / $CartOutputXMeters));

            $Latitude = ($CartOutputXMeters * $CartOutputXMeters) + ($CartOutputYMeters * $CartOutputYMeters);
            $Latitude = sqrt($Latitude);
            $Latitude = $CartOutputZMeters / $Latitude;
            //window.alert("First");
            $Latitude =  atan($Latitude);
            //window.alert(Latitude);
            $LatitudeIt = 99999999;
            do
            {
                $LatitudeIt = $Latitude;

                $n = 1 - $eeWGS84 * sin($Latitude) * sin($Latitude);
                $n = sqrt($n);
                $n = $aWGS84 / $n;
                $Latitude = $CartOutputXMeters * $CartOutputXMeters + $CartOutputYMeters * $CartOutputYMeters;
                $Latitude = sqrt($Latitude);
                $Latitude = ($CartOutputZMeters + $eeWGS84 * $n * sin($LatitudeIt)) / $Latitude;
                //window.alert("Atan-Test");
                //window.alert(Latitude);
                $Latitude = atan($Latitude);
                //window.alert(Latitude);
                }
            while (abs($Latitude - $LatitudeIt) >= 0.000000000000001);

            $numLat = $Latitude / pi() * 180;
            $numLong = $GeoDezHeight / pi() * 180;

            return array($numLat,$numLong);
            }

  }
// ===============================================================================================

/*
Calculate(3419148,5727132);
echo $numLong;
echo "<br>";
echo $numLat;
*/

?>
