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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
       <a class="navbar-brand" href="#">Kikbacks</a>
         <button type="button" class="navbar-toggle glyphicon-plus" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="home.php">Home</a></li>
        <li><a class="active" href="profile.php">Profile</a></li>
        <li><a  href="#">Notifications</a></li>
        <li><a  href="#">Post</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"> </span><?php print($userRow['userName']); ?></a></li>
        <li><a href="logout.php?logout=true">Logout</a></li>
      </ul>
      <div class="input-group col-md-4" style="margin-top:9px;" >
      		<input class="form-control" placeholder="Search for..." type="text">
      		<span class="input-group-btn">
        	<button class="btn btn-default" type="button">Go!</button>
     	 	</span>
    	</div><!-- /input-group -->
      <hr><!-- horizontal line -->
    </div>
  </div>
</nav>

<div class="container-fluid" id="main_content" style="margin-top:25px;">
            <div class="row">
             <div class="col-lg-12 col-md-8 col-sm-4">
                <img src="<?php print($userRow['imagePath']); ?>" class="img-circle" width="304" height="236">
<form action="upload.php" method="post" enctype="multipart/form-data">
<label>Select image to upload:</label>
<input type="file" name="fileToUpload" id="fileToUpload">
<input type="submit" value="Upload Image" name="submit">
</form>
            </div>
            </div>
            <div class="col-lg-12 col-md-8 col-sm-4">

            </div>
</div><!-- main_content -->
</body>
</html>
