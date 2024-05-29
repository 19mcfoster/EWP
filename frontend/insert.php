<?php header('Access-Control-Allow-Origin: *');

$name = $_POST['name'];
$textbox = $_POST['textbox'];
$email = $_POST['email'];

$image = $_FILES['image']['tmp_name'];
$imgContent = file_get_contents($image);

$imgur_client_id = "f701777b491f655";
$imgur_data = array();

$imgName = rand(100,10000). '-'. basename($_FILES['image']['name']);
$tmp_name = $_FILES['image']['tmp_name'];

$postFields = array('image' => base64_encode($imgContent));
$postFields['title'] = $imgName;
$postFields['description'] = "EWP post image: " . $imgName;
$imgUrl = "";


$host = "ewp-0.cl8c2gu6g6li.us-east-1.rds.amazonaws.com";
$dbname = "ewpdb";
$username = "PublicView";
$password = "Public";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_errno());
}

$sql = "INSERT INTO imgurhost (name, textbox, email, imgName, imgUrl)
        VALUES (?,?,?,?,?)";

$stmt = mysqli_stmt_init($conn);
if ( ! mysqli_stmt_prepare($stmt, $sql)){
    die(mysqli_error($conn));
}


$gur = curl_init();
curl_setopt($gur, CURLOPT_URL, 'https://api.imgur.com/3/image');
curl_setopt($gur, CURLOPT_POST, TRUE);
curl_setopt($gur, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($gur, CURLOPT_HTTPHEADER, array('Authorization: Client-ID '.$imgur_client_id));
curl_setopt($gur, CURLOPT_POSTFIELDS, $postFields);
$response = curl_exec($gur);

$responseArr = json_decode($response);

$imgUrl = $responseArr->data->link;

mysqli_stmt_bind_param($stmt, "sssss", $name, $textbox, $email, $imgName, $imgUrl);
mysqli_stmt_execute($stmt);

echo json_encode("Saved");

?>
