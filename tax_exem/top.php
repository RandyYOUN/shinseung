<!doctype html>
<html>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NQ59PMS');</script>
<!-- End Google Tag Manager -->

	<title>세무톡 - 면세사업장현황 신고센터</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="세무톡 - 면세사업장현황 신고전문센터">
	<meta property="og:description" content="면세사업장현황 신고전문센터">
	<meta property="og:image" content="resources/images/sum_home.jpg">
	<link rel="stylesheet" href="resources/css/basic.css" />
	<link rel="stylesheet" href="resources/css/swiper.css">
	<link rel="stylesheet" href="resources/css/main.css" />
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script src="http://code.jquery.com/jquery-3.5.1.js" ></script>
	<script type="text/javascript" src="resources/js/libs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources/js/jquery-slick.js"></script>
	<script type="text/javascript" src="resources/js/jquery-swiper.js"></script>
	<script type="text/javascript" src="resources/js/SimpleTabs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-counterup.js"></script>
	<script type="text/javascript" src="resources/js/TweenMax.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

</head>

<!-- Channel Plugin Scripts -->
<script>
	(function () {
		var w = window;
		if (w.ChannelIO) {
			return (window.console.error || window.console.log || function () { })('ChannelIO script included twice.');
		}
		var d = window.document;
		var ch = function () {
			ch.c(arguments);
		};
		ch.q = [];
		ch.c = function (args) {
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

	function none() {
		var test = "1";
	}

	//모바일체크
	var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');

	var request = new Request();
	var id = request.getParameter("id")
	var cate = request.getParameter("cate")
	var url = window.location.href;

	if (request.getParameter("pc") == "y") {
		var test = "1";
	} else {
		for (var word in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
//				window.location.href = "m/index.php";
				if(url.indexOf("sub_newsview.php")>0  ){
					window.location.href = "m/sub_newsview.php?id="+id;				
				}else if(url.indexOf("sub_news.php")>0){
					window.location.href = "m/sub_news.php?cate="+cate;		
				}else if(url.indexOf("link2")>0){
					window.location.href = "m/index.php?link2=Y";		
				}else{
					window.location.href = "m/index.php";
				}

				break;
			}
		}
	}


	//쿠키저장 함수
	function setCookie(name, value, expiredays) {
		var todayDate = new Date();
		todayDate.setDate(todayDate.getDate() + expiredays);
		document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	}
	
	function go_page(num){
		if(num == 0){
			alert("마지막페이지입니다");
		}else if(num == -1){
			alert("첫페이지입니다");
		}else{
			window.location.href="sub_newsview.php?id="+num;
		}
	}


	$(document).ready(function () {
		$("#promotionBanner .btnclose").click(function () {
			//오늘만 보기 체크박스의 체크 여부를 확인 해서 체크되어 있으면 쿠키를 생성한다.
			if ($("#chkday").is(':checked')) {
				setCookie("topPop", "done", 1);
				//alert("쿠키를 생성하였습니다.");

			}
			//팝업창을 위로 애니메이트 시킨다. 혹은 slideUp()
			//$('#promotionBanner').animate({ height: 0 }, 500);
			$('#promotionBanner').slideUp(500);
		});
	});
</script>


<body>

	<section class="quick">
			<div>
				<h1>쉽고 편한 세무톡</h1>
				<h2>무엇을 도와드릴까요?</h2>
			</div>
			<ul>
				<li>쉽고빠른<span></span></li>
				<li>세무상담<span></span></li>
				<li>증빙자료<span></span></li>
				<li>전송가능<span></span></li>
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


				<script>
			//$('.newsview').css("border","1px solid red");
			$('.newsview h4').find('*').css("height","auto");
			$('.newsview h4').find('*').css("width","100%");
			$('.newsview h4').find('img').css("width","auto");
			$('.newsview h4').find('img').css("width","auto");
		</script>

