<?php
        require_once("session.php");
        require_once("class.user.php");
        $auth_user = new USER();
        $user_id = $_SESSION['user_session'];
$servername = "45.33.93.45";
$username = "taylony";
$password = "*Q3-r0!_LnD";
$dbname = "dblogin";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Attempt insert query execution
try{
    // create prepared statement
    $sql = "INSERT INTO photos (imagePath) VALUES (:target_file)";
    $stmt = $pdo->prepare($sql);

    // bind parameters to statement
    $stmt->bindParam(':target_file', $_REQUEST['target_file']);
    // execute the prepared statement
    $stmt->execute(array(":target_file" => $target_file));
    echo "Records inserted successfully.";
} catch(PDOException $error){
    die("ERROR: Not able to execute $sql. " . $error->getMessage());
}
}
   echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
     } 
// Close connection
unset($pdo);
?>
