<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>병의원세무지원센터::신승세무법인</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta property="og:type" content="website">
		<meta property="og:title" content="병의원세무지원센터">
		<meta property="og:url" content="http://medi-tax.kr/m/">
		<meta property="og:description" content="대한의사협회 세무회계부문 공식제휴 세무법인">
		<meta property="og:image" content="/resources/images/sum.png">
		<meta name="format-detection" content="telephone=no"/>
		<link rel="stylesheet" href="resources_/css/basic.css">
		<link rel="stylesheet" href="resources_/css/swiper.css">
		<link rel="stylesheet" href="resources_/css/common.css">
		<link rel="stylesheet" href="resources_/css/animate.css">
		<link rel="shortcut icon" href="resources_/images/icon.ico">
		<script type="text/javascript" src="resources_/js/libs.js"></script>
		<script type="text/javascript" src="resources_/js/jquery-swiper.js"></script>
		<script type="text/javascript" src="resources_/js/jquery-scrollbox.js"></script>
		<script type="text/javascript" src="resources_/js/TweenMax.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">


<!-- 2019.12.13 einvention -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5S9MNPM');</script>
<!-- End Google Tag Manager -->

<!-- 2019.11.12 einvention -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PGF2JVZ');</script>
<!-- End Google Tag Manager -->

	</head>
<!-- Channel Plugin Scripts -->
<script>
  (function() {
    var w = window;
    if (w.ChannelIO) {
      return (window.console.error || window.console.log || function(){})('ChannelIO script included twice.');
    }
    var d = window.document;
    var ch = function() {
      ch.c(arguments);
    };
    ch.q = [];
    ch.c = function(args) {
      ch.q.push(args);
    };
    w.ChannelIO = ch;
    function l() {
      if (w.ChannelIOInitialized) {
        return;
      }
      w.ChannelIOInitialized = true;
      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.async = true;
      s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
      s.charset = 'UTF-8';
      var x = document.getElementsByTagName('script')[0];
      x.parentNode.insertBefore(s, x);
    }
    if (document.readyState === 'complete') {
      l();
    } else if (window.attachEvent) {
      window.attachEvent('onload', l);
    } else {
      window.addEventListener('DOMContentLoaded', l, false);
      window.addEventListener('load', l, false);
    }
  })();
  ChannelIO('boot', {
    "pluginKey": "9c36349c-b1f2-454b-9853-f1d4994800a5"
  });
</script>

<!-- End Channel Plugin -->
<script type="text/javascript">

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

</script>
<!-- End Channel Plugin -->
<body>

<!-- 2019.12.13 einvention -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5S9MNPM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<!-- 2019.11.12 einvention -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PGF2JVZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<section class="mquick">
			<h1>무엇을 도와드릴까요?</h1>
			<h2>전화상담
				<a href="tel:1899-3582"></a>
			</h2>
			<div>
				<h3>채팅상담</h3>
				<img src="resources/images/mquickMan.png" style="width:50% !important;">
			</div>
		<a  href="http://pf.kakao.com/_vexexkC/chat" target="_blank"></a>
			<ul>
				<li>쉽고빠른<span></span></li>
				<li>세무상담<span></span></li>
				<li>증빙자료<span></span></li>
				<li>전송가능<span></span></li>
			</ul>

		</section>
	<script>
		var man = $(".mquick div").find('img');
	
		var quickMan =  new TimelineMax({repeat:-1, repeatDelay: 3});

		quickMan.delay(2).to(man, 0.2, { y: -10 })
		.to(man, 0.1, {y: 5 })
		.to(man, 0.1, { y: 0 });
		
		var elem = $(".mquick ul").find('li');
		var items = elem.length;
		var index = 0;

		var quickbubble =  new TimelineLite();

		function bubbleMoving() {
			setTimeout(function() {
				if (index < items) {
					quickbubble.to(elem.eq(index), 0.5, {opacity:1, ease: Power2.easeIn, y:-15})
					.to(elem.eq(index), 1.5, {opacity:1, ease: Power2.easeIn, y:-15})
					.to(elem.eq(index), 0.5, {opacity:0, ease: Power2.easeIn, y:30});
					index++;
					bubbleMoving();
					
				}
				if (index == items) {
					index = 0;
					}
				}, 3000);
		};
		bubbleMoving();
		
	</script>

	
	<div class="wrap">


		<header>
			<a href="index.php"><img src="resources/images/logo.png"></a><span class="logotitle">병의원세무지원센터</span>
			<a href="#" class="mgnbTop" title="모바일 메뉴 열기">
				<div>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</a>
		</header>

		<section class="subvisual sub_newsbg">
			<h1>뉴스톡</h1>
		</section>

		<div class="s_news">

			<section class="write">
			<h1>* 필수입력항목입니다</h1>
			<table>
				<colgroup>
					<col width="20%"></col>
					<col width="30%"></col>
					<col width="20%"></col>
					<col width="30%"></col>
				</colgroup>
				<tbody>
					<tr>
						<th>성함</th>
						<td colspan="3"><input type="text"  name="CSTNAME" id="CSTNAME" style="width:250px;"></td>
					</tr>
					<tr>
						<th>핸드폰<span>*</span></th>
						<td colspan="3"><input type="text" name="PHONE" id="PHONE" style="width:250px;"></td>
					</tr>
					<tr>
						<th>이메일</th>
						<td colspan="3"><input type="text" name="EMAIL" id="EMAIL" style="width:250px;"></td>
					</tr>
					<tr>
						<th>문의내용</th>
						<td colspan="3">
						 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea cols="33" rows="10" id="CONTENTS" name="CONTENTS"></textarea>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="write_div">
				<button class="write_btn" name="action" id="action">전 송</button>
			</div>
			</section>

		</div>


		<?php include("bottom.php");?>

		
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


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var CSTNAME = $('#CSTNAME').val();
		var PHONE = $('#PHONE').val();
		var EMAIL= $('#EMAIL').val();
		var contents =  $('#CONTENTS').val();
		var action = "추가";//$('#action').text();
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
		var time = today.getTime();
		var now = yyyy+""+mm+""+dd+""+time

		//성과 이름이 올바르게 입력이 되면
		if(CSTNAME !='' && PHONE != '' && contents !=''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action_qna.php", 
				method:"POST",
				data:{now:now,CSTNAME:CSTNAME,PHONE:PHONE,EMAIL:EMAIL,contents:contents,action:action },
				success:function(data){
					alert(data);
					window.location.href="sub_write_complate.php";
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}



	});

});



</script>