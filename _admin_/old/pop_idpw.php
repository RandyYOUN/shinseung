<?php
include "db_info.php";

   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 ADMIN</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="신승세무법인 ADMIN">
	<meta property="og:url" content="https://taxtok.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="resources/images/sum2.png">
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
<script type="text/javascript" src="../news/se2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
-->
<!-- Bootstrap -->



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border-radius:5px;
margin-top:100px;


}

.paging { width: 1400px; margin: 0 auto 100px; }
.paging div { font-size: 0; text-align: center; margin: 30px 0 0 0; }
.paging div a.prev { display: inline-block; width: 52px; font-size: 15px; line-height: 15px; color: #777; font-weight: bold; text-align: right; margin: 0 20px 0 0; padding: 10px 0px 10px 0px; background: url("../images/pagingleft.png") 0px 50% no-repeat; }
.paging div a.prev:hover { color: #444; background: url("../images/pagingleftOn.png") 0px 50% no-repeat; }
.paging div span { display: inline-block; }
.paging div span a { width: 32px; display: inline-block; font-size: 15px; line-height: 15px; color: #999; font-weight: bold; text-align: center; padding: 10px 0px 10px 0px; }
.paging div span a.active { position: relative; width: 32px; display: inline-block; color: #444; }
.paging div span a.active:after { content: ''; position: absolute; left: 0px; bottom: 6px; width: 80%; height: 1px; background: #444; }
.paging div a.next { display: inline-block; width: 52px; font-size: 15px; line-height: 15px; color: #777; font-weight: bold; text-align: left; margin: 0 0 0 20px; padding: 10px 0px 10px 0px; background: url("../images/pagingright.png") 100% 50% no-repeat; }
.paging div a.next:hover { color: #444; background: url("../images/pagingrightOn.png") 100% 50% no-repeat; }


</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 


</head>
<body style="font-size:14px;">
<form method="post" onsubmit="return checkit()">
<div class="container box" style="margin:0 0 0 50px;">
<span>
<img src="resources/images/new_logo.png">
</span>
<br><br>

<div class="table-responsive"  style="width:640px;" >

<B>등록</B>
<TABLE class="table table-bordered" style="width:640px;">
	<TR><TD COLSPAN=5><b>id/pw 입력</b></TD></TR>
	<TR>
		<TD WIDTH="20%"><SPAN STYLE="COLOR:RED;">※</SPAN>&nbsp;ID 
		</td>
		<td><input type="text" name="HomeTaxID" id="HomeTaxID" class="" STYLE="PADDING:6px 12px;width:200px;" />
		</TD>
	</tr>
	<tr>
		<TD WIDTH="20%"><SPAN STYLE="COLOR:RED;">※</SPAN>&nbsp;PW </td>
		<td><input type="text" name="HomeTaxPW" id="HomeTaxPW" class="" STYLE="PADDING:6px 12px;width:200px;" />
		</TD>
	</TR>
	<tr>
		<TD WIDTH="20%"><SPAN STYLE="COLOR:RED;">※</SPAN>&nbsp;주민등록번호(하이픈 '-'없이 숫자만 입력) </td>
		<td>
			<p><input type="TEXT" id="RESIDENT_ID" name="RESIDENT_ID" STYLE="PADDING:6px 12px;width:200px;" numberOnly ></p>
		</td>
	</tr>
</TABLE>



<button type="button" name="action" id="action" class="btn btn-warning">등록</button>
<BR><BR>

</div>
</form>
</body>


<script>



function Request() {
	var requestParam = "";

	//getParameter 펑션
	this.getParameter = function (param) {
		//현재 주소를 decoding
		var url = unescape(location.href);
		//파라미터만 자르고, 다시 &그분자를 잘라서 배열에 넣는다. 
		var paramArr = (url.substring(url.indexOf("?") + 1, url.length)).split("&");

		for (var i = 0; i < paramArr.length; i++) {
			var temp = paramArr[i].split("="); //파라미터 변수명을 담음

			if (temp[0].toUpperCase() == param.toUpperCase()) {
				// 변수명과 일치할 경우 데이터 삽입
				requestParam = paramArr[i].split("=")[1];
				break;
			}
		}
		return requestParam;
	}
}





$(document).ready(function(){


$("input:text[numberOnly]").on("focus", function() {
    var x = $(this).val();
    x = removeCommas(x);
    $(this).val(x);
}).on("focusout", function() {
    var x = $(this).val();
    if(x && x.length > 0) {
        if(!$.isNumeric(x)) {
            x = x.replace(/[^0-9]/g,"");
        }
        x = addCommas(x);
        $(this).val(x);
    }
}).on("keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g,""));
});

//6자리 단위마다 '-'하이픈 생성
function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{7})+(?!\d))/g, "-");
}
 
//모든 콤마 제거
function removeCommas(x) {
    if(!x || x.length == 0) return "";
    else return x.split("-").join("");
}


$("input:text[numberOnly]").on("keyup", function() {
    $(this).val(addCommas($(this).val().replace(/[^0-9]/g,"")));
});
 

	
	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		var hometaxid = $('#HomeTaxID').val();
		var hometaxpw = $('#HomeTaxPW').val();
		var residentid = $('#RESIDENT_ID').val();
		var action = "팝업등록";
		
		if(hometaxid !='' && hometaxpw !='' ) {

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{hometaxid:hometaxid,hometaxpw:hometaxpw ,residentid:residentid ,action:action},
				success:function(data){
					alert(data);
					location.reload();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}
	});		


	$('#HomeTaxPW2').keyup(function () {



		var pwd1=$("#HomeTaxPW1").val(); 
		var pwd2=$("#HomeTaxPW2").val(); 
		if(pwd1 != "" || pwd2 != ""){
			if(pwd1 == pwd2){ 
				$("#alert-success").show(); $("#alert-danger").hide(); $("#submit").removeAttr("disabled"); }else{ $("#alert-success").hide(); $("#alert-danger").show(); $("#submit").attr("disabled", "disabled"); 
			} 
		}

	});


});





</script>


</body>
</html>