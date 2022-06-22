<?php 
include("../db_info.php");
?>
<!doctype html>
<html>
<head>
	<title>이용약관</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="imagetoolbar" content="no" />
	<meta http-equiv="Cache-Control" content="No-Cache" />
	<meta HTTP-EQUIV="Pragma" CONTENT="no-cache"/>
	<meta HTTP-EQUIV="Expires" CONTENT="-1"/>

	<meta name="description" content=""/>
	<meta name="naver-site-verification" content="f0f3fa240a340044b4171667d244f914eeda8a20"/>

	<!-- START OPEN GRAPH -->
	<meta property="og:locale" content="ko_KR"/>
	<meta property="og:image" content="http://img.godo.co.kr/godomall/etc/ci.png"/>
	<meta property="og:image:width" content="600"/>
	<meta property="og:image:height" content="315"/>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="https://www.godo.co.kr/etc/agreement/join-agreement.gd"/>
	<meta property="og:title" content="회원가입 이용약관"/>
	<meta property="og:description" content=""/>
	<!-- END OPEN GRAPH -->

	<link type="text/css" rel="stylesheet" href="//static.godo.co.kr/css/common.css" />
	<link type="text/css" rel="stylesheet" href="//static.godo.co.kr/css/gnb.css?20200325" />
	<link type="text/css" rel="stylesheet" href="//static.godo.co.kr/css/page.css" />
	<script type="text/javascript" src="//static.godo.co.kr/extern/jquery/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="//static.godo.co.kr/extern/jquery-cookie/jquery.cookie-1.4.1.min.js"></script>
	
	
<link type="text/css" rel="stylesheet" href="//static.godo.co.kr/css/agreement.css" />

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


	$(document).ready(function () {
		
		$('#confirm').click(function () {
			if(		$("input:checkbox[id='agree1']").is(":checked") == true && 		$("input:checkbox[id='agree2']").is(":checked") == true){
				var req = new Request();
				var cstname = req.getParameter("cstname");
				var mobile = req.getParameter("mobile");
				var action = "동의";

				//성과 이름이 올바르게 입력이 되면
				if(cstname !='' && mobile!= ''){

					$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
						url:"action.php", 
						method:"POST",
						data:{cstname:cstname,mobile:mobile,action:action},
						success:function(data){
							alert(data);
							self.close();
						}
					});

				}else{
					alert('빈칸을 입력해 주세요');
				}

			}else{
				alert("약관에 동의해주세요.");
				return false;
			}
				
		});


		$('#agree1_span').click(function () {
			$("input:checkbox[id='agree1']").prop("checked", true); 
		});

		$('#agree2_span').click(function () {
			$("input:checkbox[id='agree2']").prop("checked", true); 
		});


	});



</script>

</head>
<body>




<div class="agreement-wrap" style="margin:0 0 0 0; min-width:500px;">
	<div class="agreement-page" id="top" style="margin:0 0 0 0; width:500px;">
		
		
		<div class="content-section" style="margin:0 0 0 0; width:500px;">
			
<div class="content-head" style="margin:0 0 0 0; width:500px;">
	<h1 class="content-title" style="margin:0 0 0 0; width:200px;">
		이용약관
	</h1>
	<p style="margin:0 0 0 1px;">
		시행일자 : 2020년 05월 19일
	</p>
</div>
<div class="content-body" style="margin:30px 30px 30px 30px;">
	<div class="content-text-include">
<b>【 개인정보 수집 ․ 이용 동의서 】</b>
「개인정보보호법」에 의거하여, 아래와 같은 내용으로 개인정보를 수집하고 있습니다.
귀하께서는 아래 내용을 자세히 읽어 보시고, 모든 내용을 이해하신 후에 동의 여부를 결정해 주시기 바랍니다.

본인은 세무법인 신승이 아래의 내용과 같이 본인의 개인정보를 수집·이용하는 것에 동의합니다.

- 개인정보 수집 ․ 이용에 관한 사항 -

□ 수집․이용할 정보의 내용

- 성명, 연락처(휴대폰), 종합소득세 안내문 

□ 수집․이용목적

- 세무관련 세액, 환급금, 수수료 안내 및 상담

□ 개인정보의 보유․이용기간

- 수집·이용에 관한 동의일로부터 사업 종료일까지

□ 동의를 거부할 권리 및 동의를 거부할 경우의 불이익

- 귀하는 위 사항에 대하여 동의를 거부할 수 있습니다. 다만, 위 개인정보의 수집·이용에 관한 동의는 세무관련 세액, 환급금, 수수료 안내 및 상담과 지속적인 세무뉴스 서비스를 위하여 필수적이므로, 위 사항에 동의하여야만 서비스 수신 대상자가 될 수 있음.

※ 세무법인 신승이 위와 같이 본인의 개인정보를 수집·이용하는 것에 동의합니다.

( <input type="checkbox" name="agree1" id="agree1" style="width:30px;"> <span id="agree1_span" name="agree1_span" onclick="javascript:check1();"><b>동의함</b></span> <input type="checkbox" name="disagree1" id="disagree1" style="width:30px;"> 동의하지 않음 )


※ 세무법인 신승이 위와 같이 본인의 고유식별정보 수집·이용하는 것에 동의합니다.

( <input type="checkbox" name="agree2" id="agree2" style="width:30px;"> <span id="agree2_span" name="agree2_span"><b>동의함</b></span> <input type="checkbox" name="disagree2" id="disagree2" style="width:30px;"> 동의하지 않음 )
</div>
<br>
<div style="margin:35px 0 0 0;">
<button style="display:inline-block;width:80px;height:30px;background:#184067;font-size:16px;line-height:30px;color:#fff;font-weigth:normal;text-align:center;margin:0 15px 0 210px; vertical-align:middle;" name="confirm" id="confirm">확인</button>
</div>
</body>
</html>