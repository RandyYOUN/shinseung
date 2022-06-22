<!doctype html>
<html>

<head>
	<title>신승세무법인 안양</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="국세청 33년 경력">
	<meta property="og:url" content="http://sostax.co.kr/ss3/">
	<meta property="og:description" content="쉽고 편한 세무상담센터">
	<meta property="og:image" content="/resources/images/sum.png">
	<meta name="description" content="신승세무법인 안양">
	<link rel="stylesheet" href="resources/css/basic.css" />
	<link rel="stylesheet" href="resources/css/swiper.css">
	<link rel="stylesheet" href="resources/css/main.css" />
	<link rel="stylesheet" href="resources/css/sub.css" />
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script type="text/javascript" src="resources/js/libs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources/js/jquery-slick.js"></script>
	<script type="text/javascript" src="resources/js/jquery-swiper.js"></script>
	<script type="text/javascript" src="resources/js/SimpleTabs.js"></script>
	<script type="text/javascript" src="resources/js/TweenMax.js"></script>

<!-- 2020.01.22 yes@einvention -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WZVJDT9');</script>
<!-- End Google Tag Manager -->

</head>
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
	var url = window.location.href;

	if (request.getParameter("pc") == "y") {
		var test = "1";
	} else {
		for (var word in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
//				window.location.href = "m/index.php";
				if(url.indexOf("sub_newsview.php")>0){
					window.location.href = "m/sub_newsview.php?id="+id;				
				}else if(url.indexOf("sub_newsview_.php")>0){
					window.location.href = "m/sub_newsview_.php?id="+id;				
				}else{
					window.location.href = "m/index.php";
				}

				break;
			}
		}
	}
	

	function go_kakao(){
	
		window.open("http://pf.kakao.com/_eLLxkT/chat");
	}

	
	function go_page(num){

		if(num == 0){
			alert("마지막 페이지입니다");
			//break;
		}else{
			window.location.href="sub_newsview.php?id="+num;
		}
	}

	
</script>

<script>
$(document).ready(function(){
    
   $("a[data-toggle='sns_share']").click(function(e){
		e.preventDefault();
		
		var _this = $(this);
		var sns_type = _this.attr('data-service');
		var href = $(location).attr('href');
		var title = _this.attr('data-title');
		var loc = "";
		var img = $("meta[name='og:image']").attr('content');
		
		if( ! sns_type || !href || !title) return;
		
		if( sns_type == 'facebook' ) {
			loc = 'http://www.facebook.com/sharer/sharer.php?u='+href+'&t='+title;
		}
		else if ( sns_type == 'twitter' ) {
			loc = 'http://twitter.com/home?status='+encodeURIComponent(title)+' '+href;
		}
		else if ( sns_type == 'google' ) {
			loc = 'http://plus.google.com/share?url='+href;
		}
		else if ( sns_type == 'pinterest' ) {
			
			loc = 'http://www.pinterest.com/pin/create/button/?url='+href+'&media='+img+'&description='+encodeURIComponent(title);
		}
		else if ( sns_type == 'kakaostory') {
			loc = 'https://story.kakao.com/share?url='+encodeURIComponent(href);
		}
		else if ( sns_type == 'band' ) {
			loc = 'http://www.band.us/plugin/share?body='+encodeURIComponent(title)+'%0A'+encodeURIComponent(href);
		}
		else if ( sns_type == 'naver' ) {
			loc = "http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(href)+"&title="+encodeURIComponent(title);
		}
		else {
			return false;
		}
		
		window.open(loc);
		return false;
	});
    
    
});
</script>
<body>

<!-- 2020.01.22 yes@einvention -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZVJDT9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<div class="wrap">
		<section class="quick">
			<div>
				<h1>국세청 33년 경력</h1>
				<h2>믿고 맡길 수 있는 신승세무법인</h2>
			</div>
			<ul>
				<li>쉽고빠른<span></span></li>
				<li>세무상담<span></span></li>
				<li>증빙자료<span></span></li>
				<li>전송가능<span></span></li>
			</ul>
			<a href="http://pf.kakao.com/_eLLxkT/chat" target="_blank"></a>
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

		
		<section class="locationPop">
			<h1></h1>
			<h2></h2>
			<a href="javascript:go_kakao();" class="chat"><span>채팅상담</span></a>
			<!--<a class="call"><span>전화상담</span></a>-->
			<p class="close"></p>
		</section>
