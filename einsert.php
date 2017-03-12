<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

$servername = "";
$username = "";
$password = "";
$dbname = "";

if(isset($_POST['btn-event']))
{
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
	$edate  = strip_tags($_POST['date-event']);
        $etime  = strip_tags($_POST['time-event']);
        $edesc  = strip_tags($_POST['desc-event']);
        $eprice = strip_tags($_POST['price-event']);
        $eopen  = strip_tags($_POST['open-event']);
        $epri   = strip_tags($_POST['priv-event']);

// Attempt insert query execution
try{
    // create prepared statement
    $sql = "INSERT INTO Events (date, eventTime, eventDesc, eventPrice, eventOpen, eventPrivate) VALUES (:edate, :etime, :edesc, :eprice, :eopen, :epri)";
    $stmt = $pdo->prepare($sql);

    // bind parameters to statement
    $stmt->bindParam(':edate', $_REQUEST['edate']);
    $stmt->bindParam(':etime', $_REQUEST['etime']);
    $stmt->bindParam(':edesc', $_REQUEST['edesc']);
    $stmt->bindParam(':eprice', $_REQUEST['eprice']);
    $stmt->bindParam(':eopen', $_REQUEST['eopen']);
    $stmt->bindParam(':epri', $_REQUEST['epri']);
    // execute the prepared statement
    $stmt->execute(array(":edate" => $edate, ":etime" => $etime, ":edesc" => $edesc, ":eprice" => $eprice, ":eopen" => $eopen, ":epri" => $epri));
    echo "Records inserted successfully.";
} catch(PDOException $error){
    die("ERROR: Not able to execute $sql. " . $error->getMessage());
}
}
// Close connection
unset($pdo);
?>
