<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>세무톡 - 쉽고 간편한 세무업무</title>
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta property="og:type" content="website">
	<meta property="og:title" content="세무톡 - 쉽고 간편한 세무업무">
	<meta property="og:url" content="http://sostax.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="/resources/images/sum.png">
	<meta name="format-detection" content="telephone=no" />
	<link rel="stylesheet" href="resources/css/basic.css">
	<link rel="stylesheet" href="resources/css/swiper.css">
	<link rel="stylesheet" href="resources/css/common.css">
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script type="text/javascript" src="resources/js/libs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources/js/jquery-slick.js"></script>
	<script type="text/javascript" src="resources/js/jquery-swiper.js"></script>
	<script type="text/javascript" src="resources/js/SimpleTabs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-counterup.js"></script>
	<script type="text/javascript" src="resources/js/TweenMax.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">
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

</script>

<body>
	<div class="wrap">

	<section class="mquick">
			<h1>무엇을 도와드릴까요?</h1>
			<h2>전화상담
				<a href="tel:1899-3582"></a>
			</h2>
			<div>
				<h3>채팅상담</h3>
				<img src="resources/images/mquickMan.png">
			</div>
			<a href="javascript:ChannelIO('show');"></a>
			<ul>
				<li>쉽고빠른<span></span></li>
				<li>세무상담<span></span></li>
				<li>증빙자료<span></span></li>
				<li>전송가능<span></span></li>
			</ul>

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

		</script>

		<header>
			<a href="index.php"><img src="resources/images/logo.png"></a>
			<a href="#" class="mgnbTop" title="모바일 메뉴 열기">
				<div>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</a>
		</header>

		<section class="subvisual sub_smartbg">
			<h1>구성원</h1>
		</section>

		<div class="s_smart">
			<div class="tabsWrap">
				<ul class="tabtop">
					<li class="tabmenu active"><span class="smarttab01"></span><span>세무회계지원</span></li>
					<li class="tabmenu"><span class="smarttab02"></span><span>경영혁신지원</span></li>
					<li class="tabmenu"><span class="smarttab03"></span><span>거래내역관리</span></li>
					<li class="tabmenu"><span class="smarttab04"></span><span>인사/급여지원</span></li>
				</ul>
				<section class="tabarea">
					<div>
						<h1>BEST 1<span>381명 사용자 추천</span></h1>
						<h2><span>급여대장 및 급여세액 간편 요청 속 썩이던 직원 & 급여관리
								이젠 훨씬 편해집니다</span></h2>
						<img src="resources/images/s_smartcon0101.png" style="right:-50px; bottom:150px; width: 370px;">
						<ul>
							<li class="highlight">경영관리 데이터 기반 미수금 내역 보고 및 관리 </li>
							<li>미수금 회수 가능여부 사전체크 지원 </li>
							<li>은행과 연계한 채권 선불지급 서비스 지원 </li>
							<li>신용평가기관과 채권추심관리 서비스 연계 </li>
						</ul>
					</div>
					<div>
						<h1>BEST 2<span>295명 사용자 추천</span></h1>
						<h2><span>편리한 증빙자료 전송! 번거롭게 챙기던 증빙자료 이메일이나 팩스로 보낼 필요 없이 바로 전송이 가능합니다 </span></h2>
						<img src="resources/images/s_smartcon0102.png" style="right:-50px; bottom:170px; width: 400px;">
						<ul>
							<li>채탕장에서 파일 전송 가능 </li>
							<li>스마트폰에선 바로 촬영 전송 가능 </li>
							<li>종이 영수증, 세금계산서 스마트폰 촬영시 자동 인식 </li>
							<li class="highlight">따로 챙길 필요 없는 증빙자료 자동화 </li>
						</ul>
					</div>
					<div>
						<h1>BEST 3<span>265명 사용자 추천</span></h1>
						<h2><span>세무처리결과 실시간 안내 세무업무 다 알아서 해드리니 결과만 확인하시면 됩니다</span></h2>
						<img src="resources/images/s_smartcon0103.png" style="right:-30px; bottom:140px; width: 370px;">
						<ul>
							<li class="highlight">다 알아서 해주는 속편한 세무서비스 </li>
							<li>스마트폰으로 세무 상담 답변 안내 </li>
							<li>스마트폰으로 세무 진행사항 자동 알림 </li>
							<li class="highlight">실시간 세무 업무진행상황 알림 전송 </li>
						</ul>
					</div>
					<div>
						<h3><span>요청 버튼만 누르면 민원 서류 도착 신청만 하면 바로 발급 더 이상 기다릴 필요가 없습니다</span></h3>
						<img src="resources/images/s_smartcon0104.png" style="right:-50px; bottom:150px; width: 370px;">
						<ul>
							<li>민원/증명서류 간편 발급 시스템 </li>
							<li>서류 발급 진행상황 실시간 확인 </li>
							<li class="highlight">초스피드 신속한 서류 발급 가능 </li>
							<li>발급서류 조회 및 관리 가능 </li>
						</ul>
					</div>
					<div>
						<h1>BEST 5<span>194명 사용자 추천</span></h1>
						<h2><span>모바일 뉴스레터 : 뉴스톡 세무소식은 물론 바쁘더라도 꼭 아셔야 할 뉴스를 맞춤으로 챙겨드립니다</span></h2>
						<img src="resources/images/s_smartcon0105.png" style="right:-50px; bottom:150px; width: 420px;">
						<ul>
							<li class="highlight">세무 & 맞춤뉴스 매월 정기 발송 </li>
							<li>대상자별 관심 뉴스 맞춤 제공 </li>
							<li>세무, 노무, 법률, 경영, 정책 등 다양한 정보 </li>
							<li>사업에 도움을 드리는 맞춤정보 제공 </li>
						</ul>
					</div>
					<div>
						<h3><span>세무자료 안전보관 서비스 무료로 제공되는 공유 폴더에 중요한 세무자료를 안전하게 보관해 드립니다</span></h3>
						<img src="resources/images/s_smartcon0106.png" style="right:-50px; bottom:155px; width: 390px;">
						<ul>
							<li class="highlight">세무 주요 서류 안전 보관 </li>
							<li>공유문서 업로드/다운로드 및 문서 미리보기 </li>
							<li>세무담당자와 주고 받은 문서 자동 보관 </li>
							<li>문서 정렬, 검색 등 관리 기능 </li>
						</ul>
					</div>
				</section>

				<section class="tabarea">
					<div>
						<h1> BEST 4 <span>235명 사용자 추천</span> </h1>
						<h2><span>한 눈에 보이는 사업현황 금융, 재무, 세무현황을 일목요연하게 정리해서 경영 및 매출 관리가 편해집니다</span></h2>
						<img src="resources/images/s_smartcon0201.png" style="right:-50px; bottom:170px; width: 390px;">
						<ul>
							<li class="highlight">매일 업데이트되는 데일리 경영리포트 </li>
							<li>기간별 매출/매입과 입금/출금 내역 확인 </li>
							<li>계좌의 잔액을 실시간으로 확인 </li>
							<li>신용카드, 세금계산서 등 유형별 매출/매입 현황 확인 </li>
						</ul>

					</div>
					<div>
						<h3><span>모든 통장 입출금현황을 한번에 전 은행 계좌의 잔액을 실시간으로 확인할 수 있습니다</span></h3>
						<img src="resources/images/s_smartcon0202.png" style="right:-50px; bottom:130px; width: 400px;">
						<ul>
							<li class="highlight">자동 스크래핑으로 통장내역 조회 </li>
							<li>기간별/조건검색을 통한 특정 내역 조회 </li>
							<li>통장 거래내역에 메모 가능 </li>
							<li>입금/출금내역 관리 </li>
						</ul>
					</div>
					<div>
						<h3><span>한 손에 들어오는 매출 / 매입 관리 기간 및 증빙, 유형별로 매출·매입 현황을 확인할 수 있습니다</span></h3>
						<img src="resources/images/s_smartcon0203.png" style="right:-50px; bottom:155px; width: 370px;">
						<ul>
							<li class="highlight fontshort">신용카드, 현금영수증, 세금계산서 등 유형별 매출·매입현황 조회 </li>
							<li>그래프로 한눈에 보는 매출·매입현황 </li>
							<li>매출/매입별 상세내역 조회 </li>
							<li class="highlight">세무 담당자와 연동하여 자동전표 처리 </li>
						</ul>
					</div>
					<div>
						<h3><span>미수금 내역 바로 확인 및 입금 요청 거래처 입금 누락을 방지하는 정중한 입금 요청 알림 서비스를 시작해보세요</span></h3>
						<img src="resources/images/s_smartcon0204.png" style="right:-50px; bottom:180px; width: 390px;">
						<ul>
							<li class="highlight">경영관리 데이터 기반 미수금 내역 보고 및 관리 </li>
							<li>미수금 회수 가능여부 사전체크 지원 </li>
							<li>은행과 연계한 채권 선불지급 서비스 지원 </li>
							<li>신용평가기관과 채권추심관리 서비스 연계 </li>
						</ul>
					</div>
					<div>
						<h3><span>파워풀한 사업자 지원 서비스 아무도 해주지 않던 특별한 세무회계경영 컨설팅 먼저 시작합니다</span></h3>
						<img src="resources/images/s_smartcon0205.png" style="right:-50px; bottom:155px; width: 400px;">
						<ul>
							<li class="highlight">빅데이터를 통한 동종업체와 비교분석 </li>
							<li>미수금 분석 및 미수금 회수 지원 서비스 </li>
							<li>특혜, 우대금리 대출지원 및 정책자금조달 자문 </li>
							<li>일목요연한 경영/재무지표 제공 </li>
						</ul>
					</div>
				</section>

				<section class="tabarea">
					<div>
						<h3><span>소중한 내 카드매출 누락알림 매번 확인하기 어려운 카드매출 이젠 걱정하지 않으셔도됩니다</span></h3>
						<img src="resources/images/s_smartcon0301.png" style="right:-50px; bottom:160px; width: 380px;">
						<ul>
							<li class="highlight">카드매출 입금예정 일자와 금액 확인 </li>
							<li>기간별 / 카드사별 카드매출 입금내역 관리 </li>
							<li>매출액 / 입금예정액 / 실입금액 실시간 확인 </li>
							<li>카드매출 누락 사유 및 보류 알림 </li>
						</ul>
					</div>
					<div>
						<h3><span>절세를 위한 완벽한 통장정리 그동안 번거롭던 통장 내역 확인 쉽고 편하고 정확하게 통장정리를 해드립니다</span></h3>
						<img src="resources/images/s_smartcon0302.png" style="right:-50px; bottom:160px; width: 380px;">
						<ul>
							<li class="highlight">세무 담당자가 처리한 통장내역 확인 </li>
							<li>통장내역에 대한 메모 작성으로 정확한 회계처리 요청 </li>
							<li>실시간 화면공유로 편리하고 정확한 통장정리 </li>
							<li>통장의 입·출금 내역 조회 및 관리 </li>
						</ul>
					</div>
					<div>
						<h3><span>간편한 전자세금계산서 발행 세금계산서를 쉽고 빠르게 발행할 수 있고 거래처의 기업신용정보도 확인 가능합니다</span></h3>
						<img src="resources/images/s_smartcon0303.png" style="right:-50px; bottom:120px; width: 400px;">
						<ul>
							<li class="highlight">상태별로 한눈에 보는 세금계산서 상태 조회 </li>
							<li>거래명세서, 입금표 등 부속문서도 전자문서로 발행 </li>
							<li>월평균 발행량이 많은 기업을 위한 대량발행 기능 </li>
							<li>전자세금계산서 자동완성 입력 기능 제공 </li>
						</ul>
					</div>
				</section>
				<section class=" tabarea">
					<div>
						<h3><span>급여대장 및 급여세액 간편 요청 속 썩이던 직원 & 급여관리 이젠 훨씬 편해집니다</span></h3>
						<img src="resources/images/s_smartcon0401.png" style="right:-50px; bottom:155px; width: 400px;">
						<ul>
							<li>더 쉽고 빨라진 급여세액계산 요청 </li>
							<li>급여 입력 및 내역 확인 </li>
							<li>국민은행 계좌연동시 손쉬운 급여 이체 </li>
							<li class="highlight">급여대장 출력 및 급여명세서 이메일 전송 </li>
						</ul>
					</div>
					<div>
						<h3><span>4대보험 및 직원관리 효율성 향상 직원을 간편하게 등록하여 모든 직원 정보를 한번에 관리할 수 있습니다</span></h3>
						<img src="resources/images/s_smartcon0402.png" style="right:-50px; bottom:150px; width: 390px;">
						<ul>
							<li class="highlight">편리한 직원등록 및 정보 조회 </li>
							<li>증빙서류 업로드 및 파일 미리보기 </li>
							<li>모바일로 더욱 간편한 직원등록 기능 </li>
							<li>등록한 직원정보 세무담당자와 화면 공유 </li>
						</ul>
					</div>
				</section>

			</div>
		</div>

		<section class="customer">
			<a><span>거래처 상담</span><span>신규 계약 상담</span><img src="resources/images/customerarrow.png"></a>
			<a><span>세무 상담</span><span>양도소득세.증여상속세</span><img src="resources/images/customerarrow.png"></a>
			<div>
				<h1>전화상담</h1>
				<h2>평일 오전 10시 ~ 오후 6시<br>
					토,일,공휴일 휴무
				</h2>
				<h3>1899-3582</h3>
				<a class="call" a href="tel:1899-3582">전화걸기</a>
			</div>
		</section>

		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>개인정보보호책임자 : 정혜숙 </li>
				<li>대표자 : 변기영</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li>전화번호 : 1899-3582</li>
				<li>서울특별시 강남구 테헤란로4길 6, 1층 117호 (역삼동, 강남역 센트럴 푸르지오 시티)</li>
				<li>Copyright(c) 2019 shinseung rights reserved</li>
			</ul>
		</footer>
	</div>
	<!--wrap-->

	<div class="mgnb">
		<a href="index.php">
			<h1><img src="resources/images/logo.png"></h1>
		</a>
		<ul>
			<li class="on">
				<a href="sub_transfertax.php">양도/상속/증여 </a>
			</li>
			<li>
				<a href="sub_tax.php">기장/신고 </a>
			</li>
			<!-- <li>
				<a href="sub_review.php">사용자리뷰 </a>
			</li> -->
			<li>
				<a href="sub_price.php"> 서비스가격 </a>
			</li>
			<li>
				<a href="sub_smart.php"> 스마트세무 </a>
			</li>
			<li>
				<a href="sub_member.php"> 구성원 </a>
			</li>
			<!-- <li>
				<a href="sub_save.php"> 절세꿀팁 </a>
			</li> -->
		</ul>
		<a href="javascript:mGnbClose();" class="mGnbClose"><i></i></a>
	</div>

</body>

<script>

	//메인페이징 첫번째 움직임
	$(window).load(function () {
		$(".bx-pager-item a").eq(0).addClass("active");
	});

	$('.counter').counterUp();

	//이런서비스
	$(".best .review-main02").slick({
		infinite: true,
		fade: true
	});

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

	//모바일오픈
	$(".mgnbTop").click(function () {
		$(".mgnb").css("display", "block");
		$(".mgnb").animate({ right: 0 }, 300);
		$(".wrap").animate({ left: "-80%" }, 300);
		$(".mask").fadeIn(300);
	});

	//모바일네비 닫기
	function mGnbClose() {
		$(".mgnb").animate({ right: "-80%" }, 300);
		$(".mgnb").fadeOut(300);
		$(".wrap").animate({ left: 0 }, 300);
		$(".mask").fadeOut(300);
	};

</script>

</html>