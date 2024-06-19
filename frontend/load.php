<?php header("Access-Control-Allow-Origin: *");

$placeholder = $_POST[""]
 
$host = "ewp-0.cl8c2gu6g6li.us-east-1.rds.amazonaws.com";
$dbname = "ewpdb";
$username = "PublicView";
$password = "Public";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_errno());
} 

$query = mysqli_query($conn, "select * from imgurhost");
$entries = mysqli_num_rows($query);
$data = mysqli_fetch_all($query);
if ($entries > 0){
    echo json_encode($data);
} else {
    echo json_encode("Retrieval Failed");
}

?>