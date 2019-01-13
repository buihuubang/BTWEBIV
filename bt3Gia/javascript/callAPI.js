$(document).ready(function () {

    //Lấy toàn bộ cổ phiếu trong stock
    getStudent();
    
    //Sự kiện bấm nút tìm sinh viên
    $("#findStudent").click(findSV);

});

function getStudent(){
    $.ajax({
        type: 'POST',
        url: 'api/get.php',
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            var responseJSON = response.svInfo;
            $("#tableUsr").html("");
            for (var i = 0; i < responseJSON.length; i++) {
                var rs;
                var Calculate = responseJSON[i].XepLoai;
                (Calculate == "1")? rs = "Đạt" : rs = "Không đạt";
                $("#tableUsr").append(
                    '<tr><td>'+responseJSON[i].MaSV+'</td><td>'+responseJSON[i].TenSV+'</td><td>'+responseJSON[i].DiaChi+'</td><td>'+responseJSON[i].TenMH+'</td><td>'+responseJSON[i].Diem+'</td><td>'+responseJSON[i].HocKi+'</td><td>'+responseJSON[i].Nam+'</td><td>'+rs+'</td></tr>'
                );
                // alert(responseJSON[i].Thang);
            }
        },
        error: function (error) {
            alert(error);
        }
    });
}

function findSV(){
    var MaSV = $("#svcode").val().toString();
    var HocKi = $("#svhk").val().toString();
    var Nam = $("#svyear").val().toString();

    if (MaSV != "") {

        sendData = {
            "MaSV": MaSV,
            "HocKi": HocKi,
            "Nam": Nam
        }
        // alert(Thang);
        $.ajax({
            type: 'POST',
            url: 'api/find.php',
            dataType: 'json',
            data: JSON.stringify(sendData),
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                alert("Tìm ra sinh viên");
                if (response != 0) {
                    var responseJSON = response.findSV;
                    var rs;
                    var Calculate = responseJSON[0].XepLoai;
                    (Calculate == "1")? rs = "Đạt" : rs = "Không đạt";
                    $("#tableUsr").html(
                        '<tr><td>'+responseJSON[0].MaSV+'</td><td>'+responseJSON[0].TenSV+'</td><td>'+responseJSON[0].DiaChi+'</td><td>'+responseJSON[0].TenMH+'</td><td>'+responseJSON[0].Diem+'</td><td>'+responseJSON[0].HocKi+'</td><td>'+responseJSON[0].Nam+'</td><td>'+rs+'</td></tr>'
                    );
                } else {
                    alert("Không tìm thấy");
                }
            },
            error: function (error) {
                alert("Không tìm thấy");
            }
        });

    } else {
        alert("Bạn nhập thiếu rồi!");
    }
}