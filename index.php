<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
	$login->redirect('home.php');
}

if(isset($_POST['btn-login']))
{
	$uname = strip_tags($_POST['txt_uname_email']);
	$umail = strip_tags($_POST['txt_uname_email']);
	$upass = strip_tags($_POST['txt_password']);
		
	if($login->doLogin($uname,$umail,$upass))
	{
		$login->redirect('home.php');
	}
	else
	{
		$error = "Wrong Details !";
	}	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kikbacks | Login In or Sign Up</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="common.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css"  />
</head>
<body>
<div class="bg">
<div class="container">
     <div class="form-container">
        <form method="post">
            <div class="logintext"><h2>Kikbacks</h2>Find the hottest kick backs and parties near you!</div><hr />
            <?php
            if(isset($error))
            {
                  ?>
                  <div class="alert alert-danger">
                      <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                  </div>
                  <?php
            }
            ?>
            <div class="form-group">
             <input type="text" class="form-control" name="txt_uname_email" placeholder="Username or Email" required />
            </div>
            <div class="form-group">
             <input type="password" class="form-control" name="txt_password" placeholder="Password" required />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
             <button type="submit" name="btn-login" class="btn btn-block btn-primary">
                 <i class="glyphicon glyphicon-log-in"></i>&nbsp;Log In
                </button>
            </div>
            <br />
            <label>Start an account today! <a href="sign-up.php">Sign Up</a></label>
        </form>
       </div>
</div>
</div>
</body>
</html>
