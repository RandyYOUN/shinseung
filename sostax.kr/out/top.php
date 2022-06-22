<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>신승차이나컨설팅</title>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta property="og:type" content="website">
    <meta property="og:title" content="중국진출기업지원센터">
    <meta property="og:url" content="http://sostax.kr/out/index.php">
    <meta property="og:description" content="중국진출의 모든것">
    <meta property="og:image" content="/resources/images/sum.png">
	<link rel="stylesheet" href="resources/css/common.css" />	
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script type="text/javascript" src="/out/resources/js/libs.js"></script>
	<script type="text/javascript" src="/out/resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="/out/resources/js/jquery-scrollbox.js"></script>
	<script type="text/javascript" src="/out/resources/js/jquery-touchSlider.js"></script>
	<script type="text/javascript" src="/out/resources/js/SimpleTabs.js"></script>
	<script type="text/javascript" src="resources/js/TweenMax.min.js"></script>


	<!-- Channel Plugin Scripts -->
	<script>
		  ;window.channelPluginSettings = {
			"pluginKey": "74bf39db-4f97-4c5f-8b37-4a6d59a93f14"
		  };
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
		</script>
	<!-- End Channel Plugin -->
	<script type="text/javascript">

		function Request(){
		 var requestParam ="";

		 //getParameter 펑션
		  this.getParameter = function(param){
		  //현재 주소를 decoding
		  var url = unescape(location.href); 
		  //파라미터만 자르고, 다시 &그분자를 잘라서 배열에 넣는다. 
		   var paramArr = (url.substring(url.indexOf("?")+1,url.length)).split("&"); 

		   for(var i = 0 ; i < paramArr.length ; i++){
			 var temp = paramArr[i].split("="); //파라미터 변수명을 담음

			 if(temp[0].toUpperCase() == param.toUpperCase()){
			   // 변수명과 일치할 경우 데이터 삽입
			   requestParam = paramArr[i].split("=")[1]; 
			   break;
			 }
		   }
		   return requestParam;
		 }
		}




		function none(){
			var test = "1";
		}

		//모바일체크
		var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');

		var request = new Request();


		if(request.getParameter("pc") == "y"){
			var test = "1";
		}else{
			for (var word in mobileKeyWords){
			   if (navigator.userAgent.match(mobileKeyWords[word]) != null){
						 window.location.href = "m/index.php";
				   break;
				}
			}
		}

	</script>	
</head>

<body>
	<div class="mask"></div>
	<header>
		<section>
			<h1><a href="index.php"><span>중국진출기업지원센터</span><img src="resources/images/logo.png"><span>신승차이나컨설팅</span></a></h1>
			<?php
			  $activePage = basename($_SERVER['PHP_SELF'], ".php");
			?>
			<navi>
				<a href="strategy.php" class="<?= ($activePage == 'strategy') ? 'active':''; ?>"><span>중국진출전략</span></a>
				<a href="tax.php" class="<?= ($activePage == 'tax') ? 'active':''; ?>"><span>중국세무회계</span></a>
				<a href="law.php" class="<?= ($activePage == 'law') ? 'active':''; ?>"><span>중국법률노무</span></a>
				<a href="company.php" class="<?= ($activePage == 'company') ? 'active':''; ?>"><span>회사소개</span></a>
			</navi>
		</section>
	</header>	
	
	<section class="quick">
		<div>
			<h1>국내 1위 차이나컨설팅</h1>
			<h2>중국진출 원스톱서비스</h2>
		</div>
		<ul>
			<li>바로상담<span></span></li>
			<li>商务洽谈<span></span></li>
		</ul>
		<a href="javascript:ChannelIO('show');"></a>
	</section>

	<script>
		//퀵바
		var elem = $(".quick ul").find('li');
		var items = elem.length;
		var index = 0;

		var quickbubble = new TimelineLite();

		function bubbleMoving() {
			setTimeout(function () {
				if (index < items) {
					quickbubble.to(elem.eq(index), 0.5, { opacity: 1, ease: Power2.easeIn, y: -25 })
						.to(elem.eq(index), 1.5, { opacity: 1, ease: Power2.easeIn, y: -25 })
						.to(elem.eq(index), 0.5, { opacity: 0, ease: Power2.easeIn, y: 30 });
					index++;
					bubbleMoving();

				}
				if (index == items) {
					index = 0;
				}
			}, 3000);
		};
		bubbleMoving();

		var quickpop = new TimelineMax({ repeat: -1, repeatDelay: 5, yoyo: true, })
			.delay(2).to($(".quick").find('div'), 0.5, { width: 310, borderRadius: 25, backgroundPosition: "-85px -50px" })
			.to($(".quick div h1"), 0.5, { opacity: 1, x: -40 })
			.to($(".quick div h2"), 0.2, { opacity: 1, x: -40 });

	</script>
	
	