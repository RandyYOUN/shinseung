<!doctype html>
<html>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WZ6LQ7D');</script>
<!-- End Google Tag Manager -->
	<title>세무톡 - 부가세 신고전문</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="세무톡 - 부가세 신고전문센터">
	<meta property="og:description" content="쉽고 편한 부가세 신고">
	<meta property="og:image" content="resources/images/sum_vat.jpg">
	<link rel="stylesheet" href="resources/css/basic.css" />
	<link rel="stylesheet" href="resources/css/swiper.css">
	<link rel="stylesheet" href="resources/css/main.css" />

	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>

	</head>
	<body>
<br><br>
STEP3..<br>

<label>신고대행수수료 : </label>
<label id="est_fee" name="est_fee"></label> 원<br>

<br><br>
<input type="button" id="action1" name="action1" value="입금예정" /><br>
<input type="button" id="action2" name="action2" value="입금완료" /><br>
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
	var request = new Request();
	var cstid = request.getParameter("id");
	var bizid = request.getParameter("id2");
	var estfee = request.getParameter("fee");

	fetchUser();
	function fetchUser()
	{
		if(estfee) $('#est_fee').html(estfee);
	}

	
	$('#action1').click(function(){
		var action = "upt_vatfee_complate_check";
		var seq = "I";
		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
			method:"POST",
			data:{action:action,seq:seq,bizid:bizid},
			success:function(data){
				alert(data);
				window.location.href="index_dev04.php?id="+cstid+"&id2="+bizid;
			}
		});
	}); // [2]끝


	
	$('#action2').click(function(){
		var action = "upt_vatfee_complate_check";
		var seq = "Y";
		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
			method:"POST",
			data:{action:action,seq:seq,bizid:bizid},
			success:function(data){
				alert(data);
				window.location.href="index_dev04.php?id="+cstid+"&id2="+bizid;
			}
		});
	}); // [2]끝


});


</script>
