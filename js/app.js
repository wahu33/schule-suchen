var app = angular.module('myApp', ['angular-loading-bar', 'leaflet-directive']);

app.filter('array', function() {
    //Wandelt ein Object in ein Array, damit Filter anwendbar ist.
    return function(items) {
        var filtered = [];
        angular.forEach(items, function(item) {
            filtered.push(item)
        });
        return filtered;
    };
})

app.controller('customersCtrl', function($scope, $http) {

    angular.extend($scope, {
        center: {
            lat: 52.095,
            lng: 6.823,
            zoom: 16
        },
        markers: {
            schule: {
                lat: 52.095,
                lng: 6.823,
                message: "Name der Schule ",
                focus: false,
                draggable: false
            }
        },
        legend: {
            position: 'bottomleft',
            colors: ['#00ff00', '#0000ee', '#ff0000', 'violet', '#FFFF00'],
            labels: ['Grundschule', 'Förderschule', 'Hauptschule', 'Gesamtschule', 'Gymnasium']
        },
        defaults: {
            scrollWheelZoom: false,
            tileLayer: 'https://{s}.tile.osm.org/{z}/{x}/{y}.png'
        },
        bounds: {
            northEast: { lat: 52.0, lng: 7.0 },
            southWest: { lat: 51.0, lng: 8.7 }
        },
        iconRed: {
            iconUrl: 'js/images/marker-icon-2x-red.png',
            shadowUrl: 'js/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        },
        iconBlue: {
            iconUrl: 'js/images/marker-icon-2x-blue.png',
            shadowUrl: 'js/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        },
        iconGreen: {
            iconUrl: 'js/images/marker-icon-2x-green.png',
            shadowUrl: 'js/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        },
        iconViolet: {
            iconUrl: 'js/images/marker-icon-2x-violet.png',
            shadowUrl: 'js/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        },
        iconYellow: {
            iconUrl: 'js/images/marker-icon-2x-yellow.png',
            shadowUrl: 'js/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        },
        iconGrey: {
            iconUrl: 'js/images/marker-icon-2x-grey.png',
            shadowUrl: 'js/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        },
        iconOrange: {
            iconUrl: 'js/images/marker-icon-2x-orange.png',
            shadowUrl: 'js/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        },
        iconBlack: {
            iconUrl: 'js/images/marker-icon-2x-black.png',
            shadowUrl: 'js/images/marker-shadow.png',
            iconSize: [25, 41],
            iconAnchor: [12, 41],
            popupAnchor: [1, -34],
            shadowSize: [41, 41]
        },
    });


    $scope.search = function() {
        if (!$scope.searchstr) { $scope.errortext = "Surchstring leer."; return; } else {
            $http.get("ajax/search.php?q=" + $scope.searchstr)
                .then(function(response) {
                    $scope.start = false;
                    $scope.names = response.data.records;
                    delete $scope.schule;
                    delete $scope.gemeinden;
                    delete $scope.gem_schulen;
                });
        }
    }

    $scope.searchgm = function() {
        if (!$scope.searchgmstr) { $scope.errortext = "Surchstring leer."; return; } else {
            $http.get("ajax/search_gemeinde.php?q=" + $scope.searchgmstr)
                .then(function(response) {
                    $scope.start = false;
                    $scope.gemeinden = response.data.gemeinden;
                    delete $scope.schule;
                    delete $scope.names;
                    delete $scope.gem_schulen;

                });
        }
    }

    $scope.show = function(snr) {
        //console.log("get_school_json.php?snr="+snr);
        $http.get("ajax/get_schule.php?snr=" + snr)
            .then(function successCallback(response) {
                    $scope.schule = response.data;
                    $scope.fbilingual($scope.schule.Schulnummer);
                    $scope.ffsp($scope.schule.Schulnummer);
                    $scope.fik($scope.schule.Schulnummer);

                    $scope.center.lat = response.data.latitude;
                    $scope.center.lng = response.data.longitude;
                    $scope.center.zoom = 16;
                    $scope.markers = {};
                    $scope.markers.schule = {
                        lat: response.data.latitude,
                        lng: response.data.longitude,
                        message: message = response.data.Schulbezeichnung_1 + "<br>" + response.data.PLZ + " " + response.data.Ort,
                        focus: false,
                        draggable: false
                    }
                },
                function errorCallback(response) { alert(response) });
    }

    $scope.showgm = function(gemschluessel) {
        $http.get("ajax/get_gm_schulen.php?gem=" + gemschluessel)
            .then(function successCallback(response) {
                $scope.gem_schulen = response.data;

                $scope.center.lat = response.data[1].latitude;
                $scope.center.lng = response.data[1].longitude;
                $scope.center.zoom = 10;
                num = Object.keys(response.data).length;
                $scope.markers = {};
                $scope.bounds = {};
                //$scope.maxbounds = $scope.region.defaults;
                minlat = 100;
                maxlat = 0;
                minlng = 100;
                maxlng = 0;
                for (var i = 1; i <= num; i++) {
                    var latitude = response.data[i].latitude;
                    var longitude = response.data[i].longitude;
                    var Schulnummer = response.data[i].Schulnummer;
                    var sf = response.data[i].sf;
                    maxlat = Math.max(latitude, maxlat);
                    minlat = Math.min(latitude, minlat);
                    maxlng = Math.max(longitude, maxlng);
                    minlng = Math.min(longitude, minlng);
                    switch (sf) {
                        case "02":
                            sficon = $scope.iconGreen;
                            break;
                        case "04":
                            sficon = $scope.iconRed;
                            break;
                        case "08":
                            sficon = $scope.iconOrange;
                        case "10":
                            sficon = $scope.iconBlue;
                            break;
                        case "14":
                        case "15":
                            sficon = $scope.iconViolet;
                            break;
                        case "20":
                            sficon = $scope.iconYellow;
                            break;
                        case "30":
                            sficon = $scope.iconBlack;
                            break;
                        default:
                            sficon = $scope.iconGrey;
                    }
                    var html = response.data[i].Schulbezeichnung_1 +
                        '<br>' + response.data[i].Schulbezeichnung_2 +
                        '<br>' + response.data[i].PLZ + ' ' + response.data[i].Ort;
                    //  + '<br><a href="#" ng-click="show(Schulnummer)">Details</a>';
                    $scope.markers['m' + i] = {
                        lat: latitude,
                        lng: longitude,
                        getMessageScope: function() { return $scope; },
                        message: html,
                        compileMessage: true,
                        draggable: false,
                        icon: sficon
                    }
                }
                $scope.bounds = {
                    northEast: { lat: maxlat, lng: minlng },
                    southWest: {
                        lat: minlat,
                        lng: maxlng
                    }
                }

                console.log($scope.markers);
                console.log($scope.bounds);
            })
    }

    $scope.statistik = function(gemeinde) {
        $http.get("ajax/get_statistic.php?gmd=" + gemeinde)
            .then(function(response) {
                $scope.anzSchulen = response.data.sfstatistik;
                $scope.rechtsformen = response.data.rfstatistik;
            })
    }

    $scope.kursangebot = function(snr) {
        $http.get("ajax/get_kurse.php?snr=" + snr)
            .then(function(response) {
                $scope.gkef = response.data.gkef;
                $scope.gkq1 = response.data.gkq1;
                $scope.lkq1 = response.data.lkq1;
                $scope.gkq2 = response.data.gkq2;
                $scope.lkq2 = response.data.lkq2;
            })
    }

    $scope.fbilingual = function(snr) {
        $http.get("ajax/get_bilingual.php?snr=" + snr)
            .then(function(response) {
                $scope.bilingual = response.data.bilingual;
            })
    }

    $scope.ffsp = function(snr) {
        $http.get("ajax/get_fsp.php?snr=" + snr)
            .then(function(response) {
                $scope.fsp = response.data.fsp;
            })
    }

    $scope.fik = function(snr) {
        $http.get("ajax/get_internationale_kontakte.php?snr=" + snr)
            .then(function(response) {
                $scope.ik = response.data.ik;
            })
    }


    $scope.start = 1;
});