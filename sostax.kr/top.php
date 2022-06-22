<!DOCTYPE html>
<html lang="ko">
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-N95LR9H');</script>
<!-- End Google Tag Manager -->


<meta charset="utf-8">
	<title>신승차이나컨설팅</title>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta property="og:type" content="website">
    <meta property="og:title" content="한국투자기업지원센터">
    <meta property="og:url" content="http://sostax.kr/">
    <meta property="og:description" content="한국에서의 사업이 편해집니다">
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
<?php
// Connect DB & CONNECTION STANDARD
include ("db_info.php");
	
//$result = @mysql_query() or die("SQL error");
$result = mysqli_query($connect, "call selectCompany();");


?>
<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WDS6NRF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

 
	<div class="mask"></div>
	<header>
		<section>
			<h1><a href="index.php"><span>중국진출기업지원센터</span><img src="resources/images/logo.png"><span>신승차이나컨설팅</span></a></h1>
			<div>
				<a href="http://sostax.cn" target="_self"><img src="resources/images/langChina.png"></a>
				<a href="http://sostax.kr" target="_self"><img src="resources/images/langKorea.png"></a>
			</div>
			<?php
			  $activePage = basename($_SERVER['PHP_SELF'], ".php");
			?>
			<navi>
				<a href="invest.php" class="<?= ($activePage == 'invest') ? 'active':''; ?>"><span>투자&설립</span></a>
				<a href="tax.php" class="<?= ($activePage == 'tax') ? 'active':''; ?>"><span>세무회계</span></a>
				<a href="labor.php" class="<?= ($activePage == 'labor') ? 'active':''; ?>"><span>노무자문</span></a>
				<a href="company.php" class="<?= ($activePage == 'company') ? 'active':''; ?>"><span>회사소개</span></a>
			</navi>
		</section>
	</header>	
	
	<section class="quick">
		<div>
			<h1>원스톱서비스</h1>
			<h2>중국어 실시간 상담가능</h2>
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


	
	