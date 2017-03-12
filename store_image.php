<?php
include_once("../config.php");
class UPLOAD {
private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

public function upload_image($imgID,$imgPath){
$folder = "uploads/";
$upload_image = $folder . basename($_FILES["fileToUpload"]["name"]);
if(isset($_POST["submit"])) {
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $upload_image)) {
echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
//store it in the dba_close
	
$stmt = $this->conn->prepare("INSERT INTO photos (imageID,  imagePath) VALUES(':imgID',':imgPath')");

//$con = new PDO( DB_Host, DB_Name, DB_Username, DB_Password );
$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
//$stmt = $con->prepare($insert_query);
$stmt->execute(array(':imgID'=>$imgID, ':imgPath'=>$imgPath));

//Navigate to display the image
header( 'Location: fetch_image.php' );

} else {
echo "Sorry, there was an error uploading your file.";
}
}
}

//public function fetchImage($imgId,$imgPath)
//	{
		
//			$stmt = $this->conn->prepare("SELECT imageId, imagePath FROM photos WHERE imageId=:imgId OR imagePath=:imgPath ");
//			$stmt->execute(array(':imgId'=>$imgId, ':imgPath'=>$imgPath));
//			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
				
		
//	}


}
?>
