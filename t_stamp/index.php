<!doctype html>
<html>

<head>
	<title>세무톡 - 쉽고 간편한 세무업무</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="세무톡 - 쉽고 간편한 세무업무">
	<meta property="og:url" content="http://sostax.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="/resources/images/sum.png">
	<link rel="stylesheet" href="resources/css/basic.css" />
	<link rel="stylesheet" href="resources/css/swiper.css">
	<link rel="stylesheet" href="resources/css/main.css" />
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script type="text/javascript" src="resources/js/libs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources/js/jquery-slick.js"></script>
	<script type="text/javascript" src="resources/js/jquery-swiper.js"></script>
	<script type="text/javascript" src="resources/js/SimpleTabs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-counterup.js"></script>
	<script type="text/javascript" src="resources/js/TweenMax.js"></script>
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

	if (request.getParameter("pc") == "y") {
		var test = "1";
	} else {
		for (var word in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
				window.location.href = "m/index.php";
				break;
			}
		}
	}
</script>

<body>
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

		<header class="subhead">
			<section class="subnavi">
				<div>
					<a href="index.php"></a>
					<ul>
						<a href="sub_transfertax.php">
							<li class="on">양도/상속/증여</li>
						</a>
						<a href="sub_tax.php">
							<li>기장/신고 </li>
						</a>
						<!-- <a href="sub_review.php">
								<li>사용자리뷰</li>
							</a> -->
						<a href="sub_price.php">
							<li>서비스가격</li>
						</a>
						<a href="sub_smart.php">
							<li>스마트세무</li>
						</a>
						<a href="sub_member.php">
							<li>구성원</li>
						</a>
						<!-- <a href="sub_save.php">
								<li>절세꿀팁</li>
							</a> -->
					</ul>
				</div>
			</section>
			<script>

				//따라다니는 서브네비
				$(window).scroll(function () {

					var mainchange = $('.subvisual').height();

					if ($(this).scrollTop() > mainchange) {
						TweenLite.to('.subnavi', 0.1, { css: { background: "#fff", position: "fixed", width: "100%", paddingTop: "0px", boxShadow: "-1px -2px 9px rgba(230,230,230,.9)" } });
					}
					else {
						TweenLite.to('.subnavi', 0, { css: { background: "none", position: "absolute", paddingTop: "30px", boxShadow: "none" } });
					}

				})
			</script>

			<section class="subvisual s_memberbg">
			</section>

			<section class="subtext">
				<h1>기장/신고</h1>
				<h2>혁신적인 세무회계 서비스 세무톡이 선도합니다</h2>
			</section>
		</header>

		<div class="s_tax">
			<!-- 01 -->
			<section class="subtitle">
				<h1>세무기장 장부작성</h1>
				<h2>Tax BOOKKEEPING</h2>
				<img src="resources/images/subtaxBg01.png">
				<div>
					<p>사업자는 세법이 정하는 바에 따라 사업과 관련된 거래내역을 간편장부 또는 복식부기에 의하여 기록 비치하고 이를 기초로 세금신고를 하여야 합니다.</p>
					<p>신승세무법인은 각종 회계장부의 작성을 대행하고, 이에 대한 세무조정을 함으로써 각종 세무신고에 대한 업무 부담 뿐만 아니라 비용 부담을 덜어 드리고, 업무의 효율성을
						제공해드립니다.</p>
					<p>원칙적으로 모든 사업자는 장부를 작성해야 합니다. 특히, 법인사업자는 규모와 상관없이 복식부기 대상입니다.<br>다만, 세법에서는 소규모사업자의 장부작성의무를 덜어주기 위하여
						일정 규모
						미만의 사업자에게는 간편장부 작성을 허용하고 있습니다.</p>
				</div>
			</section>
			<section class="subbox">
				<h1>서비스 제공내역</h1>
				<div>
					<ul>
						<li>전담 인력 배정</li>
						<li>장부 기장 대행 및 친절 상담</li>
						<li>매월 장부기장을 통한 내역 관리</li>
						<li>부가가치세 신고결과 보고</li>
						<li>매월 인건비 및 원천세 신고결과 보고</li>
						<li>4대보험 취득/ 상실 신고 관리</li>
						<li>연말정산 및 퇴직금 계산</li>
						<li>증빙자료 전송 및 보관</li>
						<li>신고서 및 납부서 전송 및 보관</li>
						<li>위하고 T edge APP / WEB 사용</li>
					</ul>
				</div>
			</section>
			<section class="s_text">
				<h1>장부 미기장시 불이익</h1>
				<ul>
					<li><strong>복식부기 의무자</strong> : 무신고가산세 또는 무기장가산세 중 큰 금액을 가산세로 부담</li>
					<li><strong>간편장부 대상자</strong> : 무기장가산세 부담 </li>
					<li>결손금액이 발생하더라도 이를 인정받지 못합니다</li>
				</ul>
			</section>
			<section class="s_text">
				<h1>무기장 가산세 미적용 사업자</h1>
				<ul>
					<li>해당 과세기간에 신규로 사업을 개시한 사업자 (전문직 종사자 제외)</li>
					<li>직전 과세기간의 수입금액이 4,800만원에 미달하는 사업자 등</li>
				</ul>
			</section>

			<!-- 02 -->
			<section class="subtitle">
				<h1>종합소득세 신고대행</h1>
				<h2>Taxation on aggregate income</h2>
				<img src="resources/images/subtaxBg02.png">
				<div>
					<p>종합소득세는 개인이 지난해 1년간의 경제활동으로 얻은 소득에 대하여 납부하는 세금으로서 모든 과세대상 소득을 합산하여 계산하고,
						다음해 5월 1일부터 5월 31일까지 주소지 관할 세무서에 신고·납부하여야 합니다.</p>
					<p>신승세무법인은 사업자 스스로 본인의 소득을 계산하여 신고·납부하기 번거롭기 때문에 이를 대행해드림으로써 신고 업무 부담 뿐만
						아니라 전문적인 노하우를 바탕으로 절세혜택을 높여드립니다.</p>
				</div>
			</section>
			<section class="subbox">
				<h1>서비스 제공내역</h1>
				<div>
					<ul>
						<li>전담 인력 배정</li>
						<li>소득금액 계산 및 절세방안 상담</li>
						<li>종합소득세 신고 대행</li>
						<li>종합소득세 신고결과 보고</li>
						<li>증빙자료 전송 및 보관</li>
						<li>신고서 및 납부서 전송 및 보관</li>
					</ul>
				</div>
			</section>
			<section class="s_text">
				<h1>종합소득세 미신고시 불이익</h1>
				<ul>
					<li>각종 세액공제 및 감면을 받을 수 없습니다.</li>
					<li>무신고 가산세와 납부불성실 가산세 등 무거운 가산세를 부담하게 됩니다.</li>
				</ul>
			</section>

			<!-- 03 -->
			<section class="subtitle">
				<h1>부가가치세 신고대행</h1>
				<h2>SURTAX</h2>
				<img src="resources/images/subtaxBg03.png">
				<div>
					<p>부가가치세란 상품(재화)의 거래나 서비스(용역)의 제공과정에서 얻어지는 부가가치(이윤)에 대하여 과세하는 세금이며, 부가가치세 과세대상
						사업자는 상품을 판매하거나 서비스를 제공할 때 거래금액에 일정금액의 부가가치세를 징수하여 납부해야 합니다.<br>
						일반적인 경우 법인사업자는 1년에 4회, 개인사업자는 2회, 개인 간이과세자는 1회 신고하게 됩니다.</p>
					<p>부가가치세의 납부세액을 줄이기 위해서는 세금계산서, 신용카드매입전표, 계산서, 현금영수증 등의 적격증빙을 반드시 수취하고 이를 장부에 명확히 계상하여야 합니다.</p>
				</div>
			</section>
			<section class="subbox">
				<h1>서비스 제공내역</h1>
				<div>
					<ul class="li3">
						<li>전담 인력 배정</li>
						<li>부가가치세 신고 대행</li>
						<li>부가가치세 신고결과 보고</li>
						<li>증빙자료 전송 및 보관</li>
						<li>신고서 및 납부서 전송 및 보관</li>
					</ul>
				</div>
			</section>
		</div>

		<section class="customer">
			<ul>
				<li>
					<h1>전화상담</h1>
					<h2>평일 오전 10시 ~ 오후 6시<br>토,일,공휴일 휴무</h2>
					<h3><img src="resources/images/call.png"><span>1899-3582</span></h3>
				</li>
				<li>
					<h1>채팅상담 </h1>
					<h2>쉽고 빠른 전문상담 및 자료 전송까지 OK! </h2>
					<a href="javascript:ChannelIO('show');">상담하기</a>
				</li>
				<li>
					<h1>제휴문의</h1>
					<h2>단체/협회/프랜차이즈 본사 제휴 </h2>
					<a href=" https://taxtoc.channel.io">문의하기</a>
				</li>
			</ul>
		</section>

		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>대표자 : 변기영</li>
				<li>개인정보보호책임자 : 정혜숙</li>
				<li>대표번호 : 1899-3582(세무빨리)</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li>서울특별시 강남구 테헤란로4길 6, 1층 117호 (역삼동, 강남역 센트럴 푸르지오 시티)</li>
			</ul>
			<h3>Copyright(c) 2019 shinseung rights reserved</h3>
		</footer>
	</div>

</body>

<script>

	//지점안내 레이어팝업
	$('.wrap').prepend('<div class="mask"></div>');

	//레이어팝업닫기
	$(".locationPop .close,.videoPop .close,.counselingPop .close ").click(function () {
		$(".locationPop").css("display", "none");
		$(".videoPop").css("display", "none");
		$(".mask").css("display", "none");
		$(".counselingPop").css("display", "none");
		$('.counselingPop').find('span').css("display", "inline-block");
		player.stopVideo();
		//$('.modalVideo ul > a').removeClass('active');			
	});

</script>

</html>