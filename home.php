<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"  />
<link rel="stylesheet" href="common.css">
<style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
<link rel="stylesheet" href="style.css" type="text/css"  />
<title>Kickbacks - <?php print($userRow['userName']); ?></title>
</head>

<body>
<div class="container">
    <div class="navbar-header">
      <nav class="nav nav-inline">
        <div class="col-md-8">Logged in as: <?php print($userRow['userName']); ?></div>
        <a class="nav-link active" href="home.php">Home</a>
        <a class="nav-link active" href="profile.php">Profile</a>
        <a class="nav-link active" href="#">Notifications</a>
        <a class="nav-link active" href="#">Post</a>
        <a class="nav-link active" href="logout.php?logout=true">Logout</a>
      </nav>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group input-group">
          <input type="text" class="form-control" placeholder="Find Kikbacks">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button">Go!</button>
          </span>
    </div>
  </div>
  <div class="wrapper">
  <div class="content-main"> <div class="row">
<div class="col-lg-12">
<div id="map"></div>
  <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
  function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
         center: {lat: 39, lng: -95},
          zoom: 10
        });

          var contentString = '<div id="marker_content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading"><?php print($userRow['userName']); ?></h1>'+
            '<div id="bodyContent">'+
            '<p>Kikback content</p>'+
            '</div>'+
            '</div>';

        var infoWindow = new google.maps.InfoWindow(map);
        var infowindow = new google.maps.InfoWindow({content: contentString});


        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
          map.setCenter(pos);
          var marker = new google.maps.Marker({
          position: pos,
          map: map,
        });
            marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
            
            //map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
      }
  </script>
  <script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_3S4gqLg1YOMXc1M88LN3SUIzKf8bnOA&callback=initMap">
</script>
<div class="content-secondary">Trending Kikbacks</div>
</div>
  <div class="row">
  <div class="col-md-2">.col-md-2</div>
  <div class="col-md-2">.col-md-2</div>
  <div class="col-md-2">.col-md-2</div>
  <div class="col-md-2">.col-md-2</div>
  <div class="col-md-2">.col-md-2</div>
  <div class="col-md-2">.col-md-2</div>
</div>
</div>
 
</div>
</body>
</html>
