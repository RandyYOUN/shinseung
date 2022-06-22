<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>체납면책지원센터::신승세무법인</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta property="og:type" content="website">
		<meta property="og:title" content="체납면책지원센터">
		<meta property="og:url" content="http://tax-free.kr/">
		<meta property="og:description" content="세금면책, 체납소멸, 출국금지 해제신청">
		<meta property="og:image" content="/resources/images/sum.png">
		<meta name="format-detection" content="telephone=no"/>
		<link rel="stylesheet" href="resources/css/basic.css">
		<link rel="stylesheet" href="resources/css/swiper.css">
		<link rel="stylesheet" href="resources/css/common.css">
		<link rel="stylesheet" href="resources/css/animate.css">
		<link rel="shortcut icon" href="resources/images/icon.ico">
		<meta property="og:image" content="http://tax-free.kr/resources/images/thumb.png">
		<script type="text/javascript" src="resources/js/libs.js"></script>
		<script type="text/javascript" src="resources/js/jquery-swiper.js"></script>
		<script type="text/javascript" src="resources/js/jquery-scrollbox.js"></script>
		<script type="text/javascript" src="resources/js/jquery-tweenMax.js"></script>

<!-- 2019.12.18 yes@einvention -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MK55N95');</script>
<!-- End Google Tag Manager -->

<!-- 2019.11.21 yes@einvention -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-W6N9VZ9');</script>
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

<body>

<!-- 2019.12.18 yes@einvention -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MK55N95"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- 2019.11.21 yes@einvention -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-W6N9VZ9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<div id="wrap">

		<section class="mquick">
			<p></p>
			<div>
				<img src="resources/images/mquickMan.png">
			</div>
			<ul>
				<li>세금면책<span></span></li>
				<li>채팅상담<span></span></li>
				<li>체납소멸<span></span></li>
				<li>바로상담<span></span></li>
				<li>출국금지<span></span></li>
				<li>해제신청<span></span></li>
			</ul>
			<a  href="javascript:ChannelIO('show');"></a>
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

		<section class="mainVisual">
			<header>
				<h1><img src="resources/images/logo.png"></h1>
				<navi></navi>
			</header>
			
			<div class="swiper-container">
				<ul class="swiper-wrapper">
					<li class="swiper-slide">						
						<h2>국세청 33년 경력<br>체납면책지원센터</h2>
						<h3>고통받는 체납자를 위해<br>세금면책, 체납소멸, 출국금지 해제신청</h3>
						<img src="resources/images/mainVisual01.png">
					</li>
					<li class="swiper-slide">
						<h2>5년만 지나면<br>국세가 소멸 된다고?</h2>
						<h3>단순히 시간만 흐른다고 해서<br>세금이 면책되거나 소멸되지 않습니다</h3>
						<img src="resources/images/mainVisual02.png">
					</li>
					<li class="swiper-slide">
						<h2>단순 고액체납으로 인한<br>출국금지 처분</h2>
						<h4>은닉재산의 해외 유출의도가 없다면 헌법상<br>기본권을 보장하여야 한다는 대법원 판례 위반입니다</h4>
						<img src="resources/images/mainVisual03.png">
					</li>
				</ul>				
				<div class="swiper-pagination"></div>
			</div>

			<div class="mainlink">
				<div>
					<a href="#">세금면책</a>
					<a href="#">체납소멸</a>
					<a href="#">출국금지 해제신청</a>
					<a href="#">체납자 권리구제</a>
				</div>
			</div>
		</section>

		<section class="twopower">
			<li>
				<h1>국세청 33년 경력</h1>
				<dl>
					<dd><span class="on">국세청 실무담당 출신 경력자 1:1 담당 지정</span></dd>
					<dd><span class="on">세금면책, 체납소멸 관련 업무 경험 풍부</span></dd>
					<dd><span>체납 상황별 적법한 면책 지원방안 제시</span></dd>
					<dd><span>적법한 재산압류 해제 지원방안 제시</span></dd>
				</dl>
			</li>
			<li>
				<h1>무방문 비밀보장</h1>
				<dl>
					<dd><span class="on">전국 어디서나 쉽고 빠르게 상담 가능</span></dd>
					<dd><span class="on">가족, 지인, 직장에 상담내용 완벽 비밀보장</span></dd>
					<dd><span>쉽고 편하게 온라인으로 서류 전송 가능</span></dd>
					<dd><span>체납소멸 처리상황 단계별 알림 서비스</span></dd>						
				</dl>	
			</li>
		</section>
		
		<section class="recommend">
			<h1>강력히 권해드립니다</h1>
			<ul>
				<li><img src="resources/images/check.png">체납세금으로 인해 <span>신용 불량 되신 분</span></li>
				<li><img src="resources/images/check.png">자식에게 <span>체납세금 상속될까 걱정되시는 분</span></li>
				<li><img src="resources/images/check.png">체납세금으로 인해 <span>재산이 압류되신 분</span></li>
				<li><img src="resources/images/check.png">체납세금으로 인해 <span>출국정지 되신 분</span></li>
				<li><img src="resources/images/check.png">체납세금으로 인해 <span>차명으로 사업하시는 분</span></li>
				<li><img src="resources/images/check.png">체납세금으로 인해 <span>대출이 안되시는 분</span></li>
			</ul>
		</section>

		<section class="exemption">
			<h1>세금면책 프로세스</h1>
			<ul>
				<li>
					<h2>세금면책 상담</h2>
					<ol>체납사실증명</ol>
					<ol>폐업사실증명(사업자인 경우)</ol>
				</li>
				<li>
					<h2>체납자 권리구제 신청</h2>
					<ol>면밀한 상태조회 및 사전 검토 후<br>체납 소멸 신청 진행여부 판단</ol>
				</li>
				<li>
					<h2>체납자 권리구제 신청</h2>
					<ol>체납기록 전산삭제 확인</ol>
				</li>
			</ul>
		</section>

		<section class="period">
				<h1>세금체납 소멸시효</h1>
				<h2>납세의무의 소멸 청구는 까다로운 조건과 법리로 인해 세법 및 세무행정에 밝은 전문가와 상담하여 면책여부를 사전 검토 받으시길 권해드립니다</h2>
				<ul>
					<li>
						<h3>국세 기본법 제27조</h3>
						<h4>국세를 징수할 수 있는 권리를 일정 기간동안 행사하지 않으면 소멸시효가 완성하여 국세징수권은 소멸한다</h4>
						<h5>5억원 이상의 국세 : 10년<br>그 외의 국세 : 5년</h5>
					</li>
					<li>
						<h3>소멸시효의 중단</h3>
						<h4>국세청 및 세무서에서 납세고지, 독촉, 납부 최고, 교부 청구, 압류 등을 진행하면 소멸시효는 중단된다</h4>
					</li>
					<li>
						<h3>소멸시효의 정지</h3>
						<h4>분납 기간, 징수 유예기간, 체납처분 유예기간,  연부 연납기간, 소송기간, 체납자의 국외 체류기간 중에는 소멸시효가 진행되지 않는다</h4>
					</li>
				</ul>
			</section>

			<section class="review">
				<h1>더 이상 혼자 고민하지 마세요</h1>
				<h2>많은 고객분들이 세금면책 혜택을 경험하고 있습니다</h2>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<h3>세금면책사례</h3>
							<h4>체납세금 5억원 면책</h4>
							<ul>
								<li><strong>체납세목</strong>법인세, 부가가치세</li>
								<li><strong>체납금액</strong>약 5억원</li>
								<li><strong>압류채권</strong>보험, 은행계좌</li>
							</ul>
							<a></a>
						</div>	
						<div class="swiper-slide">
							<h3>출국금지 해제사례</h3>
							<h4>체납세금 3억원 해외 출국금지 해제 </h4>
							<ul>
								<li><strong>체납세목</strong>법인세, 부가가치세</li>
								<li><strong>체납금액</strong>약 3억원</li>
							</ul>
							<a></a>
						</div>		
						<div class="swiper-slide">
							<h3>세금면책사례</h3>
							<h4>체납세금 7억원 면책</h4>
							<ul>
								<li><strong>체납세목</strong>법인세, 부가가치세</li>
								<li><strong>체납금액</strong>약 7억원</li>
								<li><strong>압류채권</strong>보험, 은행계좌</li>
							</ul>
							<a></a>
						</div>	
						<div class="swiper-slide">
							<h3>출국금지 해제사례</h3>
							<h4>체납세금 1억원 해외 출국금지 해제</h4>
							<ul>
								<li><strong>체납세목</strong>부가가치세</li>
								<li><strong>체납금액</strong>약 1억원</li>
							</ul>
							<a></a>
						</div>	
						<div class="swiper-slide">
							<h3>세금면제사례</h3>
							<h4>체납세금 2억원 면책</h4>
							<ul>
								<li><strong>체납세목</strong>부가가치세, 지방세</li>
								<li><strong>체납금액</strong>약 2억원</li>
								<li><strong>압류채권</strong>은행계좌, 신용카드</li>
							</ul>
							<a></a>
						</div>
						<div class="swiper-slide">
							<h3>세금면제사례</h3>
							<h4>체납세금 7천만원 면책</h4>
							<ul>
								<li><strong>체납세목</strong>부가가치세, 지방세</li>
								<li><strong>체납금액</strong>약 7천만원</li>
								<li><strong>압류채권</strong>비상장주식, 보험</li>
							</ul>
							<a></a>
						</div>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			</section>

			<section class="tax">
					<div>							
						<li class="active">
							 <a href="#none">세금면책 대상<span></span></a>
							<ul>			
								<li class="active">
									<a href="#none">납세의무 소멸 청구 대상요건</a>
									<ul>
										<dl>
											<dt>아래의 3가지 요건을 모두 충족하는 대상자에 한해 신청가능</dt>
											<dd>1. 세무서 결손처분일로부터 5년이 경과한 경우</dd>
											<dd>2. 부동산이 압류되어 공매처분 후 5년이 경과한 경우</dd>
											<dd>3. 세무서에 압류 처분된 재산이 있는 경우</dd>
											<dd>은행예금, 보험금, 비상장주식, 매출채권으로서 그 금액이 일정액 미만이거나 예외적인 경우</dd>
										</dl>
										<h4>국민의 기초생활보장을 위한 관련 규정상 일정한 요건을 갖춘 대상자에게 예외적으로 체납된 세금의 납세의무를 소멸시켜준다.</h4>
									</ul>
								</li>

								<li>
									<a href="#none">TIP. 세금면책 가능성을 높이는 요건</a>
									<ul>
										<dl>
											<dt>아래의 요건 중 어느 하나에 해당하는 경우 세금면책 확률이 높아집니다</dt>
											<dd>무재산으로 5년 이상 장기체납하고 있는 경우<br>장기체납 상태로 재산이 압류되어 있는 경우<br>명의대여로 인한 체납인 경우</dd>
										</dl>
										<h4>국세징수법 2008년 2월 22일 개정으로 과거의 압류처분에 대한 위법성을 판단하여 소급 적용 및 세금면책 가능합니다.<br>
											세금면책 청구 및 처리는 평균 1~3개월 소요됩니다.</h4>
									</ul>
								</li>
							</ul> 
						</li>

						<li>
							<a href="#none">압류 불가재산<span></span></a>
							<ul>
								<h2>국민기초생활 보장법 제35조</h2>
								<h3>금감원 채무자 생존 직결된 재산 “압류불가”</h3>
								<h4>금감원은 기초 생활 급여 및 한달 최저 생계비에 해당하는 개인당 180만원 이하의 예금 및 일정금액 이하의 보장성 보험금은 압류할 수 없다.</h4>
		
							</ul>
						</li>

						<li>
							<a href="#none">출국금지 해제신청<span></span></a>
							<ul>
								<h2>대법원 판례 위반</h2>
								<h3>단순 고액체납으로 인한 출국금지 처분</h3>
								<h4>고액체납자의 출국금지처분의 목적은 은닉재산의 해외 유출 방지에 있기 때문에 단순 고액체납의 이유로 출국금지 처분을 받은 경우 
								대법원 판례와 중앙행정심판위원회 재결례에서는 국세청과 법무부가 재량권의 한계를 일탈한 위법한 처분이므로 취소되어야 한다고 판시하고 있다.</h4>
							</ul>
						</li>
					</div>
			</section>

			<section class="people">
				<h1>국세청 33년 경력</h1>
				<h2>체납면책 지원센터에서 전문적인 상담을 받아보세요</h2>
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<p><img src="resources/images/people0102.png"></p>
							<div>
								<h3>대표세무사</h3>
								<h4>황재윤</h4>
							</div>
							<a></a>
						</div>
						<div class="swiper-slide">
							<p><img src="resources/images/people0101.png"></p>
							<div>
								<h3>대표세무사</h3>
								<h4>양해운</h4>
							</div>
							<a></a>
						</div>						
						<div class="swiper-slide">
							<p><img src="resources/images/people0103.png"></p>
							<div>
								<h3>대표세무사</h3>
								<h4>변기영</h4>
							</div>
							<a></a>
						</div>
						<div class="swiper-slide">
							<p><img src="resources/images/people0104.png"></p>
							<div>
								<h3>대표세무사</h3>
								<h4>전명호</h4>
							</div>
							<a></a>
						</div>
						<div class="swiper-slide">
							<p><img src="resources/images/people0105.png"></p>
							<div>
								<h3>대표세무사</h3>
								<h4>박호열</h4>
							</div>
							<a></a>
						</div>
						<div class="swiper-slide">
							<p><img src="resources/images/people0111.png"></p>
							<div>
								<h3>회계사</h3>
								<h4>오종석</h4>
							</div>
							<a></a>
						</div>
						<div class="swiper-slide">
							<p><img src="resources/images/people0110.png"></p>
							<div>
								<h3>회계사</h3>
								<h4>안장순</h4>
							</div>
							<a></a>
						</div>
						<div class="swiper-slide">
							<p><img src="resources/images/people0106.png"></p>
							<div>
								<h3>주식평가전문</h3>
								<h4>이명진</h4>
							</div>
							<a></a>
						</div>						
						<div class="swiper-slide">
							<p><img src="resources/images/people0108.png"></p>
							<div>
								<h3>양도세전문</h3>
								<h4>김진규</h4>
							</div>
							<a></a>
						</div>
						<div class="swiper-slide">
							<p><img src="resources/images/people0109.png"></p>
							<div>
								<h3>상속세전문</h3>
								<h4>한성민</h4>
							</div>
							<a></a>
						</div>
						<div class="swiper-slide">
							<p><img src="resources/images/people0107.png"></p>
							<div>
								<h3>중국세무전문</h3>
								<h4>한은진</h4>
							</div>
							<a></a>
						</div>
					</div>
				</div>
			</section>

			<section class="qna">
				<h1>자주하는 질문</h1>
				<ul>
					<li class="active">
						<a><span>Q</span><span>세금면책 업무는 관할 세무서 근방에서 해야 하나요?</span></a>
						<div>
							세금면책, 체납소멸, 출국금지 해제신청 등의 모든 업무가 관할세무서와 서면으로 이뤄지기 때문에 직접 방문하지 않으셔도 전국 어디서나 전화 또는 온라인을 통해 상담받고, 서류를 구비하여 처리가 가능합니다.<br> 
							<strong>그렇기 때문에 관할세무서 주변이 아닌 세금면책 및 체납소멸 전문가와 상담하시는게 매우 중요합니다.</strong>
						</div>
					</li>
					<li>
						<a><span>Q</span><span>체납소멸 및 세금면책 직접 혼자서는 못하나요?</span></a>
						<div>
							<strong>세금면책 또는 체납소멸완성은 일반인이 혼자 해결하기에는 매우 힘이 듭니다.</strong>
							세법 및 세무행정에 밝고 실제 국세청 근무경험을 바탕으로 숙련된 노하우가 있는 세무사의 도움이 필수적이라 할 수 있습니다.<br> 
							저희 신승세무법인 체납면책지원센터는 <strong>국세청 33년 경력과 수많은 면책실적을 바탕으로 체납으로 고통받는 분들께 큰 도움을 드릴 수 있습니다.</strong>
						</div>
					</li>
					<li>
						<a><span>Q</span><span>세금 면책 업무는 관할 세무서 근방에서 해야 하나요?</span></a>
						<div>국세 체납액으로 경제활동 재개에 어려움을 겪고 있는 분들을 구제하고자 국세청에서는 체납액 납부의무 소멸제도를 시행하고 있습니다. 
							일정 요건을 충족하는 개인납세자를 대상으로 3천만원을 한도로 체납액의 납부의무를 면제해주는 제도입니다.<br>
							<strong>2017년 12월31일 이전에 폐업한 납세자로서 최종 폐업일이 속하는 과세연도를 포함하여 직전 3개 과세연도 총수입금액 평균 금액이 성실신고 확인대상 기준금액 미만인자가
							2018년 기간 중 새로 사업을 하기위해 사업자등록을 신청하거나 신청일 현재 3개월 이상 상용근로자로 근무한 경우에 신청가능합니다.</strong></div>
					</li>
					<li>
						<a><span>Q</span><span>체납기간이 5년이 지나면 자동으로 세금면책이 되나요?</span></a>
						<div>
							자동으로 세금면책이 되지는 않습니다.
							소멸시효 기산일로부터 5년이 경과하였다 하더라도 과세관청은 자발적으로 체납액에 대해 소멸완성의 조치를 하지 않을 뿐 아니라 체납자가 소멸완성을 주장하지 않으면 소멸이익 주장을 포기한 것으로 간주합니다.<br>
							<strong>그렇기때문에 체납자는 세무사를 대리인으로 지정하여 과세관청을 상대로 소멸시효 완성을 주장하여야 합니다.</strong>
						</div>
					</li>
					<li>
						<a><span>Q</span><span>본인 명의로 사업을 하고 있는데 체납으로 인해 압류된 재산을 면책 받을 수 없나요?</span></a>
						<div><strong>계속사업자는 면책의 대상이 되지 않습니다.</strong> 즉, 사업이 부도 등으로 인해 폐업한 사람으로, 정리보류(결손처분) 되어 5년이 경과된 경우만을 한정합니다.</div>
					</li>
					<li>
						<a><span>Q</span><span>세금면책을 위해서는 결손처분일자를 확인해야 한다는데 어떻게 알 수 있나요?</span></a>
						<div>세무서에서 사실증명서 발급 또는 국세청 홈페이지를 통해 체납액과 결손처분여부를 확인하실 수 있습니다.<br>
								<strong>다만, 결손처분일자를 알고자 한다면 직접 세무서를 방문하여 확인하셔야 합니다.</strong></div>
					</li>
					<li>
						<a><span>Q</span><span>세금면책 먼저 받는 게 좋나요? 개인회생 신청부터 하는게 나은가요?</span></a>
						<div>
							세금은 개인회생인가결정을 받더라도 탕감의 대상이 되지 않습니다.<br>
							그렇기 때문에 세금면책을 먼저 받아 개인회생을 신청하게 되면 변제하여야 할 세금이 전액 소멸되므로, 세금체납액이 있는 경우에는 <strong>세금면책을 먼저 받는 것이 절대적으로 유리합니다.</strong>
						</div>
					</li>
					<li>
						<a><span>Q</span><span>세금 체납으로 통장이 압류되었습니다. 풀 방법이 없나요?</span></a>
						<div><strong>통장 잔액이 180만 원 이하인 경우에는 잔액증명서</strong>를 준비해 세무서나 시청, 구청을 찾아 가압류의 해제를 요청하시면 즉시 해제가 됩니다. 다만, 180만원을 초과하는 경우 압류해제가 어렵습니다. </div>
					</li>
					<li>
						<a><span>Q</span><span>세금 체납자도 사업자등록을 발급받을 수 있나요?</span></a>
						<div>
							<strong>신용불량자나 국세를 미납한 경우에도 사업자등록을 신청할 수 있습니다.</strong><br> 
							고액체납이나 결손이 있는 경우 세무서 민원봉사실에서 사업자등록신청서를 접수 후 담당과에 사전확인을 의뢰하여 정상 사업자로 판단되면 사업자등록증 교부가 가능합니다.
							체납된 세금은 체납담당자와 상의하여 분납하여 납부할 수 있습니다. 
						</div>
					</li>
					<li>
						<a><span>Q</span><span>세금 체납으로 인한 출국금지를 분납으로 출국금지 해제가능한가요?</span></a>
						<div>
							<strong>체납액을 5,000만원 미만이 되도록 납부하거나, 압류가능 재산을 제공해야 합니다.</strong> 
						</div>
					</li>
				</ul>
				<a>더보기</a>

			</section>			

			<section class="customer">
				<h1>재기를 위한 첫걸음</h1>
				<h2>더 이상 고민말고 체납면책 지원센터에 문의하세요</h2>
				<ul>
					<li class="call">
						<h2>전화상담</h2>
						<h3>평일 오전 10시 ~ 오후 6시<br>토,일 공휴일 휴무</h3>
						<h4>1899-9533</h4>
						<a href="tel:1899-9533">전화걸기</a>
					</li>
					<li class="chat">
						<h2>채팅상담</h2>
						<h3>쉽고 빠른 전문상담! 자료 전송까지 OK!</h3>
						<h4>상담하러가기</h4>
						<a href="javascript:ChannelIO('show');"></a>
					</li>
				</ul>
			</section>

			<footer>
				<ul>
					<li>신승세무법인</li>
					<li>개인정보보호책임자 : 정혜숙 </li>
					<li>대표자 : 변기영</li>
					<li>사업자등록번호 : 214-87-25178</li>
					<li>전화번호 : 1899-9533</li>
					<li><span>서울특별시 강남구 테헤란로 114 14층 (역삼빌딩, 역삼세무서)</span></li>				
					<li>Copyright(c) 2019 shinseung rights reserved</li>
				</ul>
			</footer>
	</div>
</body>

<script>

$(document).ready(function() {	

	$(".tax li.active > ul").css("display","block");

	$(".tax a").click(function(){
		if( $(this).closest('li').hasClass('active')) {
			$(this).closest('li').children('ul').slideUp();
			$(this).parent().removeClass('active');
		}				
			
		else {						
			$(this).closest('li').children('ul').slideDown()
			$(this).closest('li').addClass('active');
			$(this).parent().siblings().removeClass('active');
			$(this).parent().siblings().children('ul').slideUp();	
			}	
		});

	//세무사 세부 위치 링크
	$('.people .swiper-slide').append("<a></a>");
	$('.people a').click(function(){		
		var arr = $(this).siblings().children('img').attr('src').replace(/[^0-9]/g,"");		
		$(this).attr("href","people.html?id=#people"+arr);	
	});

	//자주하는질문
	$('.qna li:lt(3)').show();

	$(".qna li.active div").slideDown();
	$(".qna li a").click(function(){					
		$(".qna div").slideUp();
		$(this).parent().siblings().removeClass('active');
		if(!$(this).next().is(":visible"))
		{
			$(this).parent().addClass('active');
			$(this).next().slideDown();
		}
		else{
			$(".qna div").slideUp();
			$(this).parent().removeClass('active');	
		}
	});

	$('.qna li:lt(3)').show(); 
	var items =  $('.qna li').length;				
	var shown =  $('.qna li:visible').length;	
	$('.qna > a').prepend('<span>'+shown+'/'+items+'</span>');

	$('.qna > a').click(function (){
	
		shown = shown + 3;

		if(shown < items) {
			$('.qna li:lt('+shown+')').slideDown();
			$('.qna > a span').text(shown+'/'+items);
			}
		else {
			$('.qna li:lt('+items+')').slideDown();
			$('.qna > a span').text(items+'/'+items);
		}				
	});
		

});
</script>

<script>
	//var aa = $(".review swiper-slide").index();	
	//세무사 세부 위치 링크
	$('.review a').click(function(){	
		var position = $(this).closest('div').index();
		$(this).attr("href","review.html?id=#"+position);	
	});

	//세무사 세부 위치 링크
	$('.people ul li a').click(function(){		
		var arr = $(this).siblings().children('img').attr('src').replace(/[^0-9]/g,"");		
		$(this).attr("href","people.html?id=#people"+arr);	
	});

	//메인롤링 네비아이콘 초기화
	$(document).ready(function() {
		$(".swiper-pagination span").removeClass("swiper-pagination-bullet-active");
	});
	$(window).load(function() {
		$(".swiper-pagination span").eq(0).addClass("swiper-pagination-bullet-active");
	});

	//메인롤링
	var mainswiper = new Swiper('.mainVisual .swiper-container', {
		speed:500,
		loop : true, 		
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.mainVisual .swiper-pagination',
			clickable : true,
		},	
	})

	//사례롤링
	var reviewswiper = new Swiper('.review .swiper-container', {
		slidesPerView: 'auto',
		spaceBetween: 10,
		autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
		pagination: {
			el: '.review .swiper-pagination',
			type: 'fraction',
		},
	});

	//세무사소개롤링
	var peopleswiper = new Swiper('.people .swiper-container', {
		slidesPerView: 'auto',
		spaceBetween: 5,
		pagination: {
			el: '.people .swiper-pagination',
			type: 'fraction',
		},
	});

</script>
</html>
