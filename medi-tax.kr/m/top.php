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
		<link rel="stylesheet" href="resources/css/basic.css">
		<link rel="stylesheet" href="resources/css/swiper.css">
		<link rel="stylesheet" href="resources/css/common.css">
		<link rel="stylesheet" href="resources/css/animate.css">
		<link rel="shortcut icon" href="resources/images/icon.ico">
		<script type="text/javascript" src="resources/js/libs.js"></script>
		<script type="text/javascript" src="resources/js/jquery-swiper.js"></script>
		<script type="text/javascript" src="resources/js/jquery-scrollbox.js"></script>
		<script type="text/javascript" src="resources/js/aa.js"></script>

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
		<p></p>
		<div>
			<img src="resources/images/mquickMan.png">
		</div>
		<ul>
			<li>쉽고빠른<span></span></li>
			<li>세무상담<span></span></li>
			<li>증빙자료<span></span></li>
			<li>전송가능<span></span></li>
		</ul>
		<a  href="http://medi-tax.kr/sub_qnawrite.php" target="_blank"></a>
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

		<section class="mainVisual">
			<header>
				<a href="index.php"><img src="resources/images/logo.png"><span class="logotitle">병의원세무지원센터</span></a>
				<a href="#" class="mgnbTop" title="모바일 메뉴 열기">
					<div>
						<span></span>
						<span></span>
						<span></span>
					</div>
				</a>
			</header>