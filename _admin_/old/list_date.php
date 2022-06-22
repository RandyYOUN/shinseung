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

</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

</head>
<body>
<form method="post" >

<div class="container box" style="width:1400px;">
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
	<span style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_date.php">&nbsp;<B>[세무일정]</B>&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_cst.php">&nbsp;[고객리스트's]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_home.php">&nbsp;[주택임대]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_income.php">&nbsp;[종합소득세 신청]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_callback.php">&nbsp;[콜백리스트]&nbsp;</a>
	</span>
		<span>
		<a href="https://taxtok.kr/admin/list_RPA_inc.php">&nbsp;[RPA_종소세]&nbsp;</a>
	</span>
	<span>
		<a href="https://taxtok.kr/admin/list_RPA_vat.php">&nbsp;[RPA_부가세]&nbsp;</a>
	</span>
	<span >
		<a href="https://taxtok.kr/admin/list_dev.php">&nbsp;[Dev]&nbsp;</a>
	</span>

</div>

<br>
<br>
<button type="button" name="new" id="new" class="new">신규등록</button>
<br><br>

<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<div class="table-responsive" >
	<table class="table table-bordered" >
		<tbody id="result">
		</tbody>
	</table>
	<div style="margin:0 0 0 97%;font-size:20px;"><a href="#" class="go_top">top</a></div>
</div>
<br/><br/><br/><br/><br/><br/> 

<input type="hidden" id="s_sort">
<input type="hidden" id="s_flag">
</div>
</form>
</body>

<script>


var first = "Y";


$(document).ready(function(){

	fetchUser();
	function fetchUser()
	{
	
		var action = "select";
		var first = "Y";

		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select_date.php",
			method:"POST",
			data:{action:action,first:first},
			success:function(data){
				//$('#action').text("추가");
				$('#result').html(data);
			}
		})

	}

		//[3]수정 버튼을 클릭했을 때 작동되는 함수
		$(document).on('click', '.update', function(){


		//id속성값을 가져오기 - 클릭한 행의 id 값 - 즉 user_id 값이다.
			var id = $(this).attr("id");
			
			//window.location.href="modify.php?id="+id;
			window.open("insert_taxdate.php?id="+id);

		});



		//[4]삭제 버튼을 클릭했을 때 작동되는 함수
		$(document).on('click','.delete',function(){

			var id = $(this).attr("id");

			if(confirm("삭제 하시겠습니까?"))
			{
			//구분자
			var action = "delete";
				$.ajax({
					url:"action_date.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data){
						//리스트 다시 조회
						fetchUser();
						alert(data);
					}
				});
			}else
			{
				return false;
			}

		});


		$(document).on('click','.new',function(){

			var id = $(this).attr("id");

			window.location.href="insert_taxdate.php";

		});

		$(document).on('click','.more',function(){

			var action = "select";
			var first = "N";
			var lastid = $(this).attr("id");//more버튼용id값가져오기

			$("#more"+lastid).html('<img src="https://demos.9lessons.info/moreajax.gif" />');

			var offset = $("#more"+lastid).offset();//more버튼위치셋팅
			
			//users 리스트를 select.php 에서 받아온다.
			$.ajax({
				url:"select_date.php",
				method:"POST",
				data:{action:action,first:first,lastid:lastid},
				success:function(data){
					//$('#action').text("추가");
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


</script>


</body>
</html>