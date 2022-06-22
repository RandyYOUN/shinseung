<?php
include "../db_info.php";

#include "top.php";
$TITLE = "신승 DISC체크";
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$TITLE?></title>
	<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="../js/common.js"></script>
	<link rel="shortcut icon" href="images/icon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <link href="css/reset.css" rel="stylesheet" data-description="리셋">
    <link href="css/contents.css" rel="stylesheet" data-description="공통">

</head>

<body>
    <div id="wrap">
        <div id="content">
            <div class="login_section">
                <h1><img src="img/logo.png" alt="신승세무법인"></h1>
                <h2>DISK CHECK</h2>
                <div class="feildset">
                    <div class="input_row">
                        <input title="이름"  maxlength=12 type="text" placeholder="이름" name="username" id="username" >
                    </div>
                    <div class="input_row">
                        <input title="이름" type="tel" numberOnly placeholder="전화번호" name="mobile" id="mobile"  maxlength=11 onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
                    </div>
                    <button id="b_save" name="b_save"  onclick="javascript:submit();">START</button>
                </div>
            </div>
        </div>
        <!--// content-->
    </div>
    <!--// wrap-->
</body>

<script>
function submit(){
	var username = $('#username').val();
	var mobile = $('#mobile').val();
	var action = "action_insert_disc_basic"

	if(username !="" && mobile !=""){
		$.ajax({
			url:"../action.php",
			method:"POST",
			dataType:"json",
			data:{action:action,username:username,mobile:mobile},
			success:function(data){
				//alert(data);
				//fetchUser();
				window.location.replace("write_disc1.php?id="+data.TMP_ID);
			}
		})
	}else{
		alert("기존정보를 입력하여 주세요");
		$('#username').focus();
	}
}


</script>
</html>​