<?php
   $ip_ck= $_SERVER["REMOTE_ADDR"];

   if($ip_ck != "183.98.163.168"){
		//echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }

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

.wrap-loading{ /*화면 전체를 어둡게 합니다.*/

    position: fixed;
    left:0;
    right:0;
    top:0;
    bottom:0;
    background: rgba(0,0,0,0.2); /*not in ie */

    filter: progid:DXImageTransform.Microsoft.Gradient(startColorstr='#20000000',endColorstr='#20000000');    /* ie */

    

}

    .wrap-loading div{ /*로딩 이미지*/
        position: fixed;
        top:50%;
        left:50%;
        margin-left: -21px;
        margin-top: -21px;
    }

    .display-none{ /*감추기*/
        display:none;
    }


.container {
    width: 1500px;
}
</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 


</head>
<body>
<div class="wrap-loading display-none">

    <div><img src="./images/6.gif" /></div>

</div> 


<form method="post" >

<div class="container box" >
<span>
<img src="resources/images/new_logo.png">
</span>
<br>
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
	<span style="font-size:20px;">
		<a href="https://taxtok.kr/admin/list_cst.php">&nbsp;<B>[고객리스트's]</B>&nbsp;</a>
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
<div>
	<button type="button" id="newfounder">N지도등록</button>
	<button type="button" id="channel">채널톡</button>
	<button type="button" id="iq200_3">IQ200_3월</button>
	<button type="button" id="iq200_2">IQ200_2월</button>
	<button type="button" id="callback">콜백리스트</button>
	<button type="button" id="douzone1">더존거래처1</button>
	<button type="button" id="douzone2">더존거래처2</button>
	<button type="button" id="douzone3">더존거래처3</button>
	<button type="button" id="fran">프랜차이즈</button>
</div>



<br><br>
<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<div id="result" class="table-responsive">
</div>
<br/><br/><br/><br/><br/><br/> 
</div>
</form>
<input type="hidden" id="s_sort">
<input type="hidden" id="s_flag">

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

	var req = new Request();
	var flag = req.getParameter("flag");
	var sort = req.getParameter("sort");

	if(flag != ""){
		$('#s_flag').val(flag);	
	}

	if(sort != ""){
		$('#s_sort').val(sort);
	}



	fetchUser('newfounder');
	
	function fetchUser(str)
	{

		var action = str;
		var txt = "";

		var req = new Request();
		var sort = req.getParameter("sort");
		var flag = req.getParameter("flag");
		

		switch(str){
			case "newfounder" : txt = "신규창업자";
			break;
			case "channel" : txt = "채널톡";
			break;
			case "iq200_3" : txt = "IQ200 3월";
			break;
			case "iq200_2" : txt = "IQ200 2월";
			break;
			case "callback" : txt = "콜백리스트";
			break;
			case "douzone1" : txt = "더존거래처1";
			break;
			case "douzone2" : txt = "더존거래처2";
			break;
			case "douzone3" : txt = "더존거래처3";
			break;
			case "fran" : txt = "프랜차이즈";
			break;
			default : txt = "신규창업자"; 
		}
			
		$.ajax({
			url:"select_cst.php",
			method:"POST",
			data:{action:action,txt:txt,sort:sort,flag:flag},
			success:function(data){
	//			alert('조회완료');
				$('#result').html(data);
			}
			,beforeSend:function(){//로딩이미지 노출
				$('.wrap-loading').removeClass('display-none');
			}
			,complete:function(){//로딩이미지 가리기
					$('.wrap-loading').addClass('display-none');
			}
			,error:function(e){//에러
				alert('error!! 개발자에게 문의해주세요.');
			}
		})
	}


	$('#newfounder').click(function(){
		fetchUser('newfounder');
	});

	$('#channel').click(function(){
		fetchUser('channel');
	});

	$('#iq200_2').click(function(){
		fetchUser('iq200_2');
	});

	$('#iq200_3').click(function(){
		fetchUser('iq200_3');
	});

	$('#callback').click(function(){
		fetchUser('callback');
	});

	$('#douzone1').click(function(){
		fetchUser('douzone1');
	});

	$('#douzone2').click(function(){
		fetchUser('douzone2');
	});

	$('#douzone3').click(function(){
		fetchUser('douzone3');
	});

	$('#fran').click(function(){
		fetchUser('fran');
	});

	$(document).on('click','.more',function(){

			var action = str;
			var txt = "";

			var req = new Request();
			var sort = req.getParameter("sort");
			var flag = req.getParameter("flag");
			

			switch(str){
				case "newfounder" : txt = "신규창업자";
				break;
				case "channel" : txt = "채널톡";
				break;
				case "iq200_3" : txt = "IQ200 3월";
				break;
				case "iq200_2" : txt = "IQ200 2월";
				break;
				case "callback" : txt = "콜백리스트";
				break;
				case "douzone1" : txt = "더존거래처1";
				break;
				case "douzone2" : txt = "더존거래처2";
				break;
				case "douzone3" : txt = "더존거래처3";
				break;
				case "fran" : txt = "프랜차이즈";
				break;
				default : txt = "신규창업자"; 
			}
				
			$.ajax({
				url:"select_cst.php",
				method:"POST",
				data:{action:action,txt:txt,sort:sort,flag:flag},
				success:function(data){
		//			alert('조회완료');
					$('#result').html(data);
				}
				,beforeSend:function(){//로딩이미지 노출
					$('.wrap-loading').removeClass('display-none');
				}
				,complete:function(){//로딩이미지 가리기
						$('.wrap-loading').addClass('display-none');
				}
				,error:function(e){//에러
					alert('error!! 개발자에게 문의해주세요.');
				}
			})

		});

	$(document).on('click','.go_top',function(){

		var offset = $("#new_beta").offset();
		$('html').animate({scrollTop : offset.top}, 200);

	});


});


function sort(str){

	var req = new Request();
	var sort = req.getParameter("sort");

	switch(sort){
		case "" : 
			sort = "desc";
			break;
		case "asc" : 
			sort = "desc";
			break;
		case "desc" : 
			sort = "asc";
			break;
		default:"";
	}

	window.location.href="?sort="+sort+"&flag="+str;
}


function sort_onload() {
	var req = new Request();
	var sort = req.getParameter("sort");
	var flag = req.getParameter("flag");
	
	switch(sort){
		case "desc" :
		document.getElementById("sort_"+flag).innerHTML="▼";
		break;
		case "asc" :
		document.getElementById("sort_"+flag).innerHTML="▲";
		break;
	}
}
</script>


</body>
</html>