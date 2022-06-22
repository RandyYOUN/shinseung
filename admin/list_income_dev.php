<?php
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
	<meta property="og:image" content="../resources/images/sum2.png">
	<link rel="shortcut icon" href="../resources/images/icon.ico">

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

</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>


<script src="summernote.js"></script>


</head>
<body style="font-size:14px;">
<form method="post" onsubmit="return checkit()">
<div class="container box" style="margin:0 0 0 300px;">
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
	<span style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_income.php">&nbsp;<b>[종합소득세 신청]</b>&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_callback.php">&nbsp;[콜백리스트]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_dev.php">&nbsp;[Dev]&nbsp;</a>
	</span>

</div>
<br>
<br>

<select name="s_option" id ="s_option" class="form-control" style="width:120px;display:table-cell;">
	<option value="" selected>선택</option>
	<option value="Q_TYPE">구분</option>
	<option value="NEW_HP">핸드폰</option>
</select>
<input type = "text" style="width:300px;height:34px;" id="s_str" name="s_str"></input>
<input type = "text" style="width:300px;height:34px;display:none;" id="s_str2" name="s_str2"></input>
<input type="button" value="검색" id="btn_search" name="btn_search" style="height:34px;">
<br><br>
<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<div class="table-responsive"  style="width:1440px;" >
<b><span style="color:red;">※ 첨부파일 다운로드시 팝업차단을 해제하여 주세요.</span></b>

	<table class="table table-bordered" style="width:1440px;" >
		<tbody id="result">
		</tbody>
	</table>
	<div style="margin:0 0 0 97%;font-size:20px;"><a href="#" class="go_top">top</a></div>
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



function select_cnt(obj){ //전화횟수 저장
	
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_ip_","");

	var select_val = obj.value;
		
	var memo_id = "memo_ip_"+id;
	var memo = document.getElementById(memo_id).value;
	var bran_id = "bran_"+id;
	var bran = document.getElementById(bran_id).value;
	var stat_id = "stat_"+id;
	var stat = document.getElementById(stat_id).value;
	var action = "등록";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_income_dev.php",
		method:"POST",
		data:{action:action,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
		success:function(data){
			//alert("저장완료");
		}
	})

}


function select_bran(obj){ //지점 저장
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("bran_","");
	
	var select_val = document.getElementById(id).value;
	
	var memo_id = "memo_ip_"+id;
	var memo = document.getElementById(memo_id).value;

	var bran = obj.value;

	var stat_id = "stat_"+id;
	var stat = document.getElementById(stat_id).value;
	var action = "등록";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_income_dev.php",
		method:"POST",
		data:{action:action,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
		success:function(data){
			//alert("저장완료");
		}
	})

}


function select_stat(obj){ //현황 저장
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("stat_","");

	var select_val = document.getElementById(id).value;

	var memo_id = "memo_ip_"+id;
	var memo = document.getElementById(memo_id).value;
	var bran_id = "bran_"+id;
	var bran = document.getElementById(bran_id).value;
	
	var stat = obj.value;

	var action = "등록";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_income_dev.php",
		method:"POST",
		data:{action:action,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
		success:function(data){
			//alert("저장완료");
		}
	})

}


function memo_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_ip_","");

	var memo_id = "memo_ip_"+id;
	var memo = document.getElementById(memo_id).value;
	var bran_id = "bran_"+id;
	var bran = document.getElementById(bran_id).value;
	var stat_id = "stat_"+id;
	var stat = document.getElementById(stat_id).value;

	var select_val = document.getElementById(id).value;
	var action = "등록";


	if(event.keyCode==13){

		$.ajax({
			url:"select_income_dev.php",
			method:"POST",
			data:{action:action,id:id,select_val:select_val,memo:memo, bran:bran, stat:stat},
			success:function(data){
				//alert("저장완료");
				location.reload();
			}
		})
	}

}



function switch_comp(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_lbl_","");

	document.getElementById("memo_lbl_"+id).style.display = "none";
	document.getElementById("memo_ip_"+id).style.display = "block";

	document.getElementById("memo_ip_"+id).focus();
}




$(document).ready(function(){

	var req = new Request();
	var s_option = req.getParameter("s_option");
	var s_str = req.getParameter("s_str");


	if (s_option != "") {
		switch (s_option)
		{
			case "Q_TYPE" : 	
				$('#s_option').val('Q_TYPE').attr('selected','selected');
				break;
			case "NEW_HP" : 		
				$('#s_option').val('NEW_HP').attr('selected','selected');
				break;
			default : alert("error");
		}
	} 

	if (req.getParameter("s_str") != "") {
		$('#s_str').val(req.getParameter("s_str"));;
	} 




//$('#btn_search').click(
	function checkit(){
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();

		if(s_option !="" && s_str !=""){
			window.location.href="?s_option="+s_option+"&s_str="+escape(s_str);
		}else{
			alert("검색 조건을 설정해주세요");
			if(s_option ==""){
				$('#s_option').focus();
			}else if(s_str ==""){
				$('#s_str').focus();
			}
		}
	}	


$("#s_str").keydown(
	function(key) {
		if (key.keyCode == 13) {
			checkit();
		}
	}
);


$('#btn_search').click(
	function() {
		var contact_cnt = $('#CONTACT_CNT option:selected').val();
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();

		alert(contact_cnt );

		if(s_option !="" && s_str !=""){
			window.location.href="?s_option="+s_option+"&s_str="+escape(s_str);
		}else{
			alert("검색 조건을 설정해주세요");
			if(s_option ==""){
				$('#s_option').focus();
			}else if(s_str ==""){
				$('#s_str').focus();
			}
		}
	}	
);

fetchUser();
function fetchUser()
{

	var action = "select";
	var s_option = $('#s_option').val();
	var s_str = $('#s_str').val();
	var first = "Y";

	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_income_dev.php",
		method:"POST",
		data:{action:action,s_str:s_str,s_option:s_option,first:first},
		success:function(data){
			$('#Q_TYPE').val('');
			//$('#news_regdate').val('');
			$('#NEW_HP').val('');
			$('#result').html(data);
			var modi_contents = "";
			$('#summernote').summernote('code', modi_contents);
		}
	})


}


		$(document).on('click','.more',function(){

			var action = "select";
			var s_option = $('#s_option').val();
			var s_str = $('#s_str').val();
			var first = "N";
			var lastid = $(this).attr("id");//more버튼용id값가져오기

			$("#more"+lastid).html('<img src="https://demos.9lessons.info/moreajax.gif" />');

			var offset = $("#more"+lastid).offset();//more버튼위치셋팅
			
			//users 리스트를 select.php 에서 받아온다.
			$.ajax({
				url:"select_income_dev.php",
				method:"POST",
				data:{action:action,s_str:s_str,s_option:s_option,first:first,lastid:lastid},
				success:function(data){
					$('#Q_TYPE').val('');
					//$('#news_regdate').val('');
					$('#NEW_HP').val('');
					$('#result').append(data);
					$("#more"+lastid).remove(); 
					//removing old more button
					$("#hidden_"+lastid).css("display","none");//more버튼으로 생기는 tr을 가리기
					$('html').animate({scrollTop : offset.top}, 50);
				}
			})

		});

		$(document).on('click','.go_top',function(){

			var offset = $("#new_beta").offset();
			$('html').animate({scrollTop : offset.top}, 200);

		});



});


function file_pop(id){
	window.open("https://taxtok.kr/admin/list_file.php?id="+id,"_blank","toolbar=no,scrollbars=no,resizable=no,width=500,height=600");
}
</script>


</body>
</html>