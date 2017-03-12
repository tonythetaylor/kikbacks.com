<?php

include_once("config.php");

class FETCH {
private $conn;
	
	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

public function fetchImage($imgId,$imgPath)
        {
                        $stmt = $this->conn->prepare("SELECT imageId, imagePath FROM photos WHERE imageId=:imgID OR imagePath=:imgPath ");
                        $stmt->execute(array(':imgId'=>$imgId, ':imgPath'=>$imgPath));
                        $userRow=$stmt->fetch(PDO::FETCH_ASSOC);

			$image_name=$userRow["imagePath"];
			echo "<img src=".$image_name." width=100 height=100/&gt>";
			echo "Something worked";


}

}
?>
