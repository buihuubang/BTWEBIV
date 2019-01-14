<?php 
if(isset($_POST)){
   $user = 'root'; //Thay user trong mamp vao
	$password = 'root'; //Thay password vao
	$db = 'student_db';
	$host = 'localhost';
	$port = 8889; //Thay port vao 
		
	$link = mysqli_init();
	$con = mysqli_real_connect(
	 $link,
	 $host,
	 $user,
	 $password,
	 $db,
	 $port
	);
	if(!$con){
      die("Connect Error: " . mysqli_connect_error());
   }

   $mssv = $_POST['mssvP'];
	$name = $_POST['nameP'];
	$email = $_POST['emailP'];
	$rate = $_POST['ratingP'];
	
	/*$conn = mysqli_connect('localhost','root','','student_db');*/
	$stmt = "INSERT INTO records(mssv,name,email,rating) VALUES(".$mssv.",'".$name."','".$email."',".$rate.")";
	$result = mysqli_query($link,$stmt);
	if($result){
		echo "1";	
		mysqli_free_result($result);
	}else{
      echo "0";
		die('Query:'.mysqli_error());
	}
}
?>