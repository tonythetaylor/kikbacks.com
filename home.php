<?php
	require_once("session.php");
	require_once("class.user.php");
	$auth_user = new USER();
	$user_id = $_SESSION['user_session'];
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE userId=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Kickbacks - <?php print($userRow['userName']); ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--meta http-equiv="Content-Type" content="text/html; charset=utf-8" /-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="common.css">
<style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
<!--link rel="stylesheet" href="style.css" type="text/css"  /-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
       <a class="navbar-brand" href="#">Kikbacks</a>
	 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a class="active" href="home.php">Home</a></li>
        <li><a  href="profile.php">Profile</a></li>
        <li><a  href="#">Notifications</a></li>
        <li><a  href="#">Post</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php print($userRow['userName']); ?></a></li>
        <li><a href="logout.php?logout=true">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">
<div class"row">
    <div class="">
    <div class="input-group">
      <input type="text" class="form-control" placeholder="Search for...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Add</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div>

<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Event</h4>
        </div>
         <div class="modal-body">
        <form action="einsert.php "method="post">
          <div class="form-group">
            <label for="date">Date: mm/dd/yyyy</label>
            <input name="date-event" type="text" class="form-control" id="date">
          </div>
          <div class="form-group">
            <label for="time">Time</label>
            <input name="time-event" type="" class="form-control" id="time">
          </div>
          <div class="form-group">
            <label for="location">Location</label>
            <input name="loc-event" type="" class="form-control" id="location">
          </div>
          <div class="form-group">
            <label for="desc">Description</label>
            <textarea name="desc-event" class="form-control" rows="5" id="desc"></textarea>
          </div>
          <div class="form-group">
            <label for="price">Price</label>
            <input name="price-event" type="" class="form-control" id="price">
          </div>
          <div class="checkbox">
 	    <label><input name="open-event" type="checkbox" value="">Open</label>
	  </div>
 	  <div class="checkbox">
  	    <label><input name="priv-event" type="checkbox" value="">Private</label>
	  </div>
          <button name="btn-event" type="submit" class="btn btn-default">Submit</button>
        </form>
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<br>
<div class="row">
  <div class="col-lg-12">
   <div id="map"></div>
  <script>
$( "#datepicker" ).datepicker();
</script>
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
            '<h3 id="firstHeading" class="firstHeading"><?php print($userRow['userName']); ?> is throwing a Kikback</h3>'+
 	    '<p>Date: TBD</p>'+
	    '<p>Starts: TBD Ends: TBD</p>'+
	    '<p>Description: N/A</p>'+
	    '<p>Cover: TBD </p>'+
            '<div class="row">'+
            '<div class="col-md-1"><img style="width:70px;height:70px;" src="/if/img1.jpg" class="img-responsive" alt="Responsive image"></div>'+
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
  </div>
</div>

<div class="row">
  <div class="content-secondary">Trending Kikbacks</div>
  </div>  

<div class="row">
  <div class="col-md-2"><img src="/if/img1.jpg" class="img-responsive" alt="Responsive image"></div>
  <div class="col-md-2"><img src="/if/img2.jpg" class="img-responsive" alt="Responsive image"></div>
  <div class="col-md-2"><img src="/if/img3.jpg" class="img-responsive" alt="Responsive image"></div>
  <div class="col-md-2"><img src="/if/img4.jpg" class="img-responsive" alt="Responsive image"></div>
  <div class="col-md-2"><img src="/if/img5.jpg" class="img-responsive" alt="Responsive image"></div>
  <div class="col-md-2"><img src="/if/img6.jpg" class="img-responsive" alt="Responsive image"></div>
</div>
</div>
</body>
</html>
