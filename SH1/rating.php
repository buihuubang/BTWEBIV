<?php 
   $user = 'root';
	$password = 'root';
	$db = 'student_db';
	$host = 'localhost';
	$port = 8889;
		
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

	//$name = $_POST['nameP'];
	//$email = $_POST['emailP'];
	//$rate = $_POST['ratingP'];
	//
	///*$conn = mysqli_connect('localhost','root','','student_db');*/
	//$stmt = "INSERT INTO records(name,email,rating) VALUES(\'".$name."\',\'".$email."\',".$rate.")";
	//$result = mysqli_query($link,$stmt);
	//if($result){
	//	echo "1";	
	//	mysqli_free_result($result);
	//}else{
	//	die('Query:'.mysqli_error());
	//}
   

    //Process search
   $name = $_POST['nameP'];
	$email = $_POST['emailP'];
	$rate = $_POST['ratingP'];
   
   $sql = "INSERT INTO records(name,email,rating) VALUES('".$name."','".$email."',".$rate.")";
            
   $result = mysqli_query($link, $sql);
   if ($result) {
       echo "1";
       mysqli_free_result($result);
   } else {
       echo "0";
       die('Query failed: ' . mysqli_error());
   }
    
   mysqli_close($link);
   
}
?>