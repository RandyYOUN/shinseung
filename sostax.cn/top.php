<!DOCTYPE html>
<html lang="ko">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MP6LNWF');</script>
<!-- End Google Tag Manager -->

	<meta charset="utf-8">
	<title>韩国外资企业支援中心</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta property="og:type" content="website">
    <meta property="og:title" content="新承IPS">
    <meta property="og:url" content="http://sostax.cn/index.php">
    <meta property="og:description" content="便捷的税务咨询中心">
    <meta property="og:image" content="/resources/images/sum.png">
	<link rel="stylesheet" href="resources/css/common.css" />
	<link rel="stylesheet" href="resources/css/swiper.css" />
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script type="text/javascript" src="resources/js/libs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources/js/jquery-swiper.js"></script>
	<script type="text/javascript" src="resources/js/jquery-scrollbox.js"></script>
	<script type="text/javascript" src="resources/js/jquery-touchSlider.js"></script>
	<script type="text/javascript" src="resources/js/SimpleTabs.js"></script>
	<script type="text/javascript" src="resources/js/TweenMax.min.js"></script>



</head>

<script type="text/javascript">
// Channel Plugin Scripts

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
//   <!-- End Channel Plugin -->


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
<body>
<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
	
$result = @mysqli_query($connect,"call selectCompany();") or die("SQL error");


?>
	<header>
		<section>
			<h1><a href="index.php"><img src="resources/images/logo_verC.png"></a></h1>
			<div>
				<a href="http://sostax.cn" target="_self"><img src="resources/images/langChina.png"></a>
				<a href="http://sostax.kr" target="_self"><img src="resources/images/langKorea.png"></a>
			</div>
			<navi>
				<a href="invest.php"><span>投资&注册</span></a>
				<a href="tax.php"><span>税务会计</span></a>
				<a href="labor.php"><span>劳务咨询</span></a>
				<a href="company.php"><span>关于我们</span></a>
			</navi>
		</section>		
	</header>
	
	<a href="javascript:ChannelIO('show');">
		<section class="quick">
			<div>
				<h1>一站式服务</h1>
				<h2>可实时咨询中文</h2>
			</div>
			<ul>
				<li>바로상담<span></span></li>
				<li>商务洽谈<span></span></li>
			</ul>
			
		</section>
	</a>
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
