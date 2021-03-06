<!DOCTYPE html>
<html>
<head>
	<title>Rating system</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- font awesome -->
  	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
	<!-- rating star css -->
  	<link rel="stylesheet" href="js/ratingstar.css">  	
</head>
<body class="container">
<div class="row">
<div class="col-md-12">
	<div class="form-group">
			<div class="form-group has-success has-feedback">
		    <label for="mssv">Student ID :</label>
		    <input type="text" class="form-control" id="mssv">		    
	  	</div>
			<div class="form-group has-success has-feedback">
		    <label for="name">Student Name :</label>
		    <input type="text" class="form-control" id="name">		    
	  	</div>
	  	<div class="form-group has-success has-feedback">
		    <label for="email">Student Email :</label>
		    <input type="email" class="form-control" id="email">		    
	  	</div>	 
	    <label for="email">Studnet Rating :</label>	  	
	  	<div class='starrr' id='rating-student'></div> 	<br>
	  	<input type="button" id="submit" class="btn btn-success" value="Register Student">
	  	<div class="msg"></div>
	</div>	
</div>

<hr>
<!-- show the student -->
<h2>Student Details</h2>
<table class="table table-condensed">
	<thead>
	  <tr>
			<th>Student ID</th>
	    <th>Student Name</th>
	    <th>Student Email</th>
	    <th>Rating</th>
	  </tr>
	</thead>
	<tbody id="tableUsr">
	<?php 
		$user = 'root'; //Thay user database trong mamp nhu lan truoc vao
		$password = 'root'; //Thay password vao
		$db = 'student_db';
		$host = 'localhost';
		$port = 8889; //Thay port vao
		
		$link = mysqli_init();
		$conn = mysqli_real_connect(
			 $link,
			 $host,
			 $user,
			 $password,
			 $db,
			 $port
		);
		if(!$conn){
        die("Connect Error: " . mysqli_connect_error());
    }
		/*$conn = mysqli_connect('localhost','root','','student_db');*/
		if($qry = mysqli_query($link,"SELECT * FROM records")){
			while($show = mysqli_fetch_assoc($qry)){
				echo "<tr>";
					echo "<td>".$show['mssv']."</td>";
					echo "<td>".$show['name']."</td>";					
					echo "<td>".$show['email']."</td>";					
					if($show['rating']==1){ echo "<td><i class='fa fa-star'></i></td>"; }
					if($show['rating']==2){ echo "<td><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
					if($show['rating']==3){ echo "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
					if($show['rating']==4){ echo "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
					if($show['rating']==5){ echo "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
				echo "</tr>";
			}
		}
	?>
	</tbody>
</table>
	
</div>



<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- star js -->
<script src="js/ratingstar.js"></script>
<!-- ajax -->
<script>
// rating
var rate;
$('#rating-student').starrr({
  change: function(e, value){ 
  	rate = value;  	       
    if (value) {
      $('.your-choice-was').show();      
    } else {
      $('.your-choice-was').hide();
    }
  }
});
// ajax submit
$("#submit").click(function(){
	var mssvPost = $('#mssv').val();
	var namePost = $('#name').val();
	var emailPost = $('#email').val();
	//alert(rate);
	//alert(namePost);
	//alert(emailPost);
	$.ajax({		
        url: 'rating.php',
        type: 'POST',
		dataType: 'text',
        data: {mssvP: mssvPost,nameP: namePost, emailP: emailPost, ratingP: rate},
        success: function (status) {
        	if(status == "1"){
							var star;
            	$('.msg').html('<b>Student Inserted !</b>');
							if(rate==1){ star = "<td><i class='fa fa-star'></i></td>"; }
							if(rate==2){ star = "<td><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
							if(rate==3){ star = "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
							if(rate==4){ star = "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
							if(rate==5){ star = "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
							$('#tableUsr').append('<tr><td>'+mssvPost+'</td> <td>'+namePost+'</td> <td>'+emailPost+'</td>'+star+'</tr>');
        	}else{
            	$('.msg').html('<b>Student insert error!</b>');
							alert("Sinh viên đã đánh giá");
        	}
        },
		error: function(error){
			alert(error);
		}
    });

});
</script>
</body>
</html>