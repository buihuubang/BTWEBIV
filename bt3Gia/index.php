<!DOCTYPE html>
<html>
<head>
	<title>QUAN LY SINH VIEN</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- jQuery callAjax -->
    <script type="text/javascript" src="javascript/callAPI.js"></script>
	<!-- font awesome -->
  	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">
</head>
<body class="container">
<div class="row">
<div class="col-md-12">
    <label style="margin-top:20px;">QUẢN LÝ SINH VIÊN</label>
	<div class="form-group">
		<div class="form-group has-success has-feedback">
		    <label for="svcode">Nhập mã sinh viên :</label>
		    <input type="text" class="form-control" id="svcode">		    
	  	</div>
	  	<div class="form-group has-success has-feedback">
		    <label for="svhk">Nhập học kì :</label>
		    <input class="form-control" id="svhk">		    
	  	</div>
        <div class="form-group has-success has-feedback">
		    <label for="svyear">Nhập năm :</label>
		    <input class="form-control" id="svyear">		    
	  	</div> <br>
	  	<button id="findStudent" class="btn btn-success" > Tìm sinh viên </button>
	</div>	
</div>

<hr>
<!-- show the student -->
<h2>Bảng kết quả sinh viên</h2>
<table class="table table-condensed">
	<thead>
	  <tr>
	    <th>Mã sinh viên</th>
	    <th>Tên sinh viên</th>
	    <th>Địa chỉ</th>
        <th>Tên Môn Học</th>
        <th>Điểm</th>
        <th>Học Kì</th>
        <th>Năm</th>
        <th>Đạt</th>
	  </tr>
	</thead>
	<tbody id="tableUsr">
	<!--Thông tin sinh viên-->
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
	var namePost = $('#name').val();
	var emailPost = $('#email').val();
	//alert(rate);
	//alert(namePost);
	//alert(emailPost);
	$.ajax({		
        url: 'rating.php',
        type: 'POST',
		dataType: 'text',
        data: {nameP: namePost, emailP: emailPost, ratingP: rate},
        success: function (status) {
        	if(status == "1"){
							var star;
            	$('.msg').html('<b>Student Inserted !</b>');
							if(rate==1){ star = "<td><i class='fa fa-star'></i></td>"; }
							if(rate==2){ star = "<td><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
							if(rate==3){ star = "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
							if(rate==4){ star = "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
							if(rate==5){ star = "<td><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i><i class='fa fa-star'></i></td>"; }
							$('#tableUsr').append('<tr> <td>'+namePost+'</td> <td>'+emailPost+'</td>'+star+'</tr>');
        	}else{
            	$('.msg').html('<b>Server side error !</b>');
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