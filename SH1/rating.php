<?php 
if(isset($_POST)){
$user = 'root';
$password = 'root';
$db = 'student_db';
$host = 'localhost';
$port = 3306;

$link = mysqli_init();
$conn = mysqli_real_connect(
   $link, 
   $host, 
   $user, 
   $password, 
   $db,
   $port
);

	$name = $_POST['nameP'];
	$email = $_POST['emailP'];
	$rate = $_POST['ratingP'];
	
	/*$conn = mysqli_connect('localhost','root','','student_db');*/
	$stmt = "INSERT INTO records(name,email,rating) VALUES(\'".$name."\',\'".$email."\',".$rate.")";
	$result = mysqli_query($link,$stmt);
	if($result){
		echo "1";	
		mysqli_free_result($result);
	}else{
		die('Query:'.mysqli_error());
	}
}
?>