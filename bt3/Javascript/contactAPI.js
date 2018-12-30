$(document).ready(function () {

    //Lấy toàn bộ cổ phiếu trong stock
    getShare();
    //Ẩn các chức năng trước khi login
    $("#LoginFunc").hide();
    $("#LoginOut").show();

    $("#frmBtnSearch").click(findShare);

    $("#frmBtnReturn").click(getShare);

    $("#frmBtnLogin").click(loginShare);

    $("#frmBtnAdd").click(addShare);

    $("#frmBtnUpdate").click(updateShare);

    $("#frmBtnDelete").click(deleteShare);

});

function getShare(){
    $.ajax({
        type: 'POST',
        url: 'api/get.php',
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success: function (response) {
            var responseJSON = response.shareInfo;
            $("#jsonTable").html("");
            for (var i = 0; i < responseJSON.length; i++) {
                $("#jsonTable").append(
                    '<tr onclick=\"calculateShare('+responseJSON[i].Thang+','+responseJSON[i].Mua+','+responseJSON[i].Ban+')\"><td>'+responseJSON[i].Thang+'</td><td>'+responseJSON[i].MaCT+'</td><td>'+responseJSON[i].TenCT+'</td><td>'+responseJSON[i].Mua+'</td><td>'+responseJSON[i].Ban+'</td></tr>'
                );
                // alert(responseJSON[i].Thang);
            }
        },
        error: function (error) {
            alert(error);
        }
    });
}

function calculateShare(Thang,Mua,Ban) {
    (Mua > Ban)? alert("Bạn nên mua loại cổ phiếu này trong tháng " + Thang) : alert("Bạn nên bán loại cổ phiếu này trong tháng "+ Thang);
}

function findShare(){
    var Thang = "T0" + $("#findThang").val().toString();
    var MaCT = $("#frmMaCT").val().toString();

    if (MaCT != "") {

        sendData = {
            "Thang": Thang,
            "MaCT": MaCT
        }
        // alert(Thang);
        $.ajax({
            type: 'POST',
            url: 'api/find.php',
            dataType: 'json',
            data: JSON.stringify(sendData),
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                if (response != 0) {
                    var responseJSON = response.shareInfo;
                    $("#jsonTable").html(
                        '<tr onclick=\"calculateShare(' + responseJSON[0].Thang + ',' + responseJSON[0].Mua + ',' + responseJSON[0].Ban + ')\"><td>' + responseJSON[0].Thang + '</td><td>' + responseJSON[0].MaCT + '</td><td>' + responseJSON[0].TenCT + '</td><td>' + responseJSON[0].Mua + '</td><td>' + responseJSON[0].Ban + '</td></tr>'
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

function loginShare() {
    $.ajax({
        url: "login.php",
        type: "POST",
        dataType: "text",
        data: {
            pageLoad: true,
            usrName: $('#frmUsr').val(),
            psword: $('#frmPsw').val()
        }
    }).done(function (response) {
        if (response == "1") {
            $("#LoginFunc").show();
            $("#LoginOut").hide();
            alert("Login successful!");
        } else {
            alert("Wrong username or password!");
        }
    }).fail(function () {
        alert("Login unsuccessful!");
    });
}

function addShare(){
    var MaCT = $("#createMaCT").val().toString();
    var TenCT = $("#createTenCT").val().toString();
    var Mua = $("#createMua").val();
    var Ban = $("#createBan").val();
    var ThangNhan = "T0" + $("#createThang").val().toString();
    if (MaCT != "" && TenCT !="" && Mua !="" && Ban != "") {

        sendData = {
            "Thang": ThangNhan,
            "MaCT": MaCT,
            "TenCT": TenCT,
            "Mua": Mua,
            "Ban":Ban
        }
        // alert(Thang);
        $.ajax({
            type: 'POST',
            url: 'api/create.php',
            dataType: 'json',
            data: JSON.stringify(sendData),
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                if(response == 1){
                    alert("Thêm công ty thành công");
                    getShare();
                } else {
                    alert("Thêm không thành công");
                }
            },
            error: function (error) {
                alert("Lỗi:" +error);
            }
        });

    } else {
        alert("Bạn nhập thiếu rồi!");
    }
}

function updateShare() {
    var MaCT = $("#createMaCT").val().toString();
    var ThangNhan = "T0" + $("#createThang").val().toString();
    var Mua = $("#createMua").val();
    var Ban = $("#createBan").val();
    if (MaCT != "" && Mua != "" && Ban != "") {

        sendData = {
            "Thang": ThangNhan,
            "MaCT": MaCT,
            "Mua": Mua,
            "Ban":Ban
        }
        // alert(Thang);
        $.ajax({
            type: 'POST',
            url: 'api/update.php',
            dataType: 'json',
            data: JSON.stringify(sendData),
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                if (response == 1) {
                    alert("Sửa cổ phiếu thành công");
                    getShare();
                } else {
                    alert("Sửa cổ phiếu không thành công");
                }
            },
            error: function (error) {
                alert("Lỗi:" + error);
            }
        });

    } else {
        alert("Bạn nhập thiếu rồi!");
    }
}

function deleteShare() {
    var MaCT = $("#createMaCT").val().toString();
    var ThangNhan = "T0" + $("#createThang").val().toString();
    if (MaCT != "") {

        sendData = {
            "Thang": ThangNhan,
            "MaCT": MaCT
        }
        // alert(Thang);
        $.ajax({
            type: 'POST',
            url: 'api/delete.php',
            dataType: 'json',
            data: JSON.stringify(sendData),
            contentType: 'application/json; charset=utf-8',
            success: function (response) {
                if (response == 1) {
                    alert("Xoá cổ phiếu thành công");
                    getShare();
                } else {
                    alert("Xoá cổ phiếu không thành công");
                }
            },
            error: function (error) {
                alert("Lỗi:" + error);
            }
        });

    } else {
        alert("Bạn nhập thiếu rồi!");
    }
}
