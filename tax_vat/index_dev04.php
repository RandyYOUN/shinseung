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
STEP4..<br>

<label>홈택스ID : </label>
<input type="text" id="hometax_id" name="hometax_id" maxlength=50/><br>
<label>홈택스PW : </label>
<input type="password" id="hometax_pw" name="hometax_pw" maxlength=50 /><br>
<label>주민등록번호 : </label>
<input type="text" numberOnly  id="resident_id1" name="resident_id1" maxlength=6 />-<input type="password" id="resident_id2" name="resident_id2" maxlength=7 /><br>

<br><br>
<input type="button" id="action1" name="action1" value="신고대행 의뢰 완료" /><br>

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
	// 특수문자 정규식 변수(공백 미포함)
	var replaceChar = /[\{\}\[\]\/?.,;:|\)*~`!^\-+&lt;&gt;@\#$%&amp;\\\=\(\'\"]/gi;
	//정규식
	var replaceNotFullKorean = /[^a-z0-9]/gi;
	
	
	$('#action1').click(function(){
		var action = "upt_hometax_idpw";
		var hometax_id = $('#hometax_id').val();
		var hometax_pw = $('#hometax_pw').val();
		var res_id1 = $('#resident_id1').val();
		var res_id2 = $('#resident_id2').val();
		var res_id = ''.concat(res_id1,res_id2);
		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
			method:"POST",
			data:{action:action,cstid:cstid,hometax_id:hometax_id,hometax_pw:hometax_pw,res_id,res_id},
			success:function(data){
				alert(data);
				location.reload();
			}
		});
	});

//* 특수문자 제거 *//
	$("#hometax_id").on("focusout", function() {
		var x = $(this).val();
			if (x.length > 0) {
				if (x.match(replaceChar) || x.match(replaceNotFullKorean)) {
					x = x.replace(replaceChar, "").replace(replaceNotFullKorean, "");
				}
				$(this).val(x);
			}
			}).on("keyup", function() {
				$(this).val($(this).val().replace(replaceNotFullKorean, ""));
    });

	$("#hometax_pw").on("focusout", function() {
		var x = $(this).val();
			if (x.length > 0) {
				if (x.match(replaceChar) || x.match(replaceNotFullKorean)) {
					x = x.replace(replaceChar, "").replace(replaceNotFullKorean, "");
				}
				$(this).val(x);
			}
			}).on("keyup", function() {
				$(this).val($(this).val().replace(replaceNotFullKorean, ""));
    });


   $("input:text[numberOnly]").on("keyup", function() {
      $(this).val($(this).val().replace(/[^0-9]/g,""));
   });
//* 특수문자 제거 *//


	

});


</script>
