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
	<title>신승컨설팅그룹</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta property="og:type" content="website">
    <meta property="og:title" content="한국투자기업지원센터">
    <meta property="og:url" content="http://sostax.kr/m/index.php">
    <meta property="og:description" content="한국에서의 사업이 편해집니다">
    <meta property="og:image" content="/resources/images/sum.png">
	<meta name="format-detection" content="telephone=no" />
	<link rel="stylesheet" href="resources/css/common.css" />
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script type="text/javascript" src="resources/js/libs.js"></script>
	<script type="text/javascript" src="resources/js/aa.js"></script>
	<script type="text/javascript" src="resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources/js/jquery-scrollbox.js"></script>
	<script type="text/javascript" src="resources/js/jquery-touchSlider.js"></script>
	<script type="text/javascript" src="resources/js/SimpleTabs.js"></script>

</head>
	<!-- Channel Plugin Scripts -->
<script>
  ;window.channelPluginSettings = {
    "pluginKey": "9c36349c-b1f2-454b-9853-f1d4994800a5"
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

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WDS6NRF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


	
<div id="wrap">
<div class="mask"></div>
	<header>
		<h1><a href="index.php"><img src="resources/images/logo.png"></a></h1>
		<h2>
			<a href="http://sostax.cn" target="_self"><img src="resources/images/langChina.png"></a>
		</h2>
	</header>

	<section class="mquick">
			<p></p>
			<div>
				<img src="resources/images/mquickMan.png">
			</div>
			<ul>
				<li>바로상담<span></span></li>
				<li>商务洽谈<span></span></li>
			</ul>
			<a href="javascript:ChannelIO('show');"></a>
		</section>

		<script>
			var man = $(".mquick div").find('img');

			var quickMan = new TimelineMax({ repeat: -1, repeatDelay: 3 });

			quickMan.delay(2).to(man, 0.2, { y: -10 })
				.to(man, 0.1, { y: 5 })
				.to(man, 0.1, { y: 0 });

			var elem = $(".mquick ul").find('li');
			var items = elem.length;
			var index = 0;

			var quickbubble = new TimelineLite();

			function bubbleMoving() {
				setTimeout(function () {
					if (index < items) {
						quickbubble.to(elem.eq(index), 0.5, { opacity: 1, ease: Power2.easeIn, y: -15 })
							.to(elem.eq(index), 1.5, { opacity: 1, ease: Power2.easeIn, y: -15 })
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

			function go_page(num){
				if(num == 0){
					alert("마지막페이지입니다");
				}else{
					window.location.href="/m/sub_newsview.php?id="+num;
				}
			}
		</script>