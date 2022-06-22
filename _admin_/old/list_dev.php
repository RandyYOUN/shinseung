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
<div>
	<span >
		<a href="https://taxtok.kr/admin/list.php">&nbsp;[뉴스톡]&nbsp;</a>
	</span>
	
	<span >
		<a href="https://taxtok.kr/admin/list_qna.php">&nbsp;[병의원QnA]&nbsp;</a>
	</span>
	
	<span >
		<a href="https://taxtok.kr/admin/list_cal.php">&nbsp;[조정료계산]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_date.php">&nbsp;[세무일정]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_cst.php">&nbsp;[고객리스트's]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_home.php">&nbsp;[주택임대]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_income.php">&nbsp;[종합소득세 신청]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_callback.php">&nbsp;[콜백리스트]&nbsp;</a>
	</span>
		<span>
		<a href="https://taxtok.kr/admin/list_RPA_inc.php">&nbsp;[RPA_종소세]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_RPA_vat.php">&nbsp;[RPA_부가세]&nbsp;</a>
	</span>
	<span style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_dev.php">&nbsp;<b>[Dev]</b>&nbsp;</a>
	</span>

</div>
<br>
<br>

<br><br>
<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<div class="table-responsive"  style="width:1440px;" >

<b><span style="color:red;">사용자 삭제는 영업본부에 문의</span></b>

	<table class="table table-bordered" style="width:1440px;" >
		<tbody id="result">
		</tbody>
	</table>

</div>
<br/><br/><br/><br/><br/><br/> 
</div>
</form>
</body>


<script>


var first = "Y";


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

	var req = new Request();
	

	fetchUser();
	function fetchUser()
	{

		var action = "select";
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select_smart_a.php",
			method:"POST",
			data:{action:action},
			success:function(data){
				$('#result').html(data);
			}
		})


	}

});



	function memo_submit(obj){ // 메모저장

		var id_tmp = $(obj).attr("id");
		var id = id_tmp.replace("ip_","");
		var ip_id = "ip_"+id;
		var pw = document.getElementById(ip_id).value;
		var action = "등록";


		if(event.keyCode==13){

			$.ajax({
				url:"select_smart_a.php",
				method:"POST",
				data:{action:action,id:id,pw:pw},
				success:function(data){
					//alert("저장완료");
					location.reload();
				}
			})
		}

	}



	function switch_comp(obj){ // 메모란 클릭시 입력창 노출함수
		var id_tmp = $(obj).attr("id");
		var id = id_tmp.replace("lbl_","");

		document.getElementById("lbl_"+id).style.display = "none";
		document.getElementById("ip_"+id).style.display = "block";

		document.getElementById("ip_"+id).focus();
	}


	function select_insert(obj){ //지점 저장
		var id = $(obj).attr("id");	
		var id = id.replace("ip_","");
		var id = id.replace("bran_","");
		var id = id.replace("useryn_","");


		var ip_id = "ip_"+id;
		var bran_id = "bran_"+id;
		var useryn_id = "useryn_"+id;

		var pw = document.getElementById(ip_id).value;
		var branch = document.getElementById(bran_id ).value;
		var useryn = document.getElementById(useryn_id ).value;
		var action = "등록";

		$.ajax({
				url:"select_smart_a.php",
				method:"POST",
				data:{action:action,id:id,pw:pw,branch:branch,useryn:useryn},
				success:function(data){
					//alert("저장완료");
					location.reload();
				}
			})
	}

</script>


</body>
</html>