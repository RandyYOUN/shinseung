<!doctype html>
<html>
<head>
	<title>병의원세무지원센터:신승세무법인</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
    <meta property="og:title" content="병의원세무지원센터">
    <meta property="og:url" content="http://medi-tax.kr/">
    <meta property="og:description" content="대한의사협회 세무회계부문 공식제휴 세무법인">
    <meta property="og:image" content="/resources/images/sum.png">
	<link rel="stylesheet" href="resources/css/basic.css" />
	<link rel="stylesheet" href="resources/css/swiper.css">
	<link rel="stylesheet" href="resources/css/main_.css" />	
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script type="text/javascript" src="resources/js/libs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources/js/jquery-slick.js"></script>
	<script type="text/javascript" src="resources/js/jquery-swiper.js"></script>
	<script type="text/javascript" src="resources/js/SimpleTabs.js"></script>	
	<script type="text/javascript" src="resources/js/TweenMax.js"></script>

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
	var url = window.location.href;
	var id = request.getParameter("id")

	if (request.getParameter("pc") == "y") {
		var test = "1";
	} else {
		for (var word in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
				if(url.indexOf("sub_newsview.php")>0){
					window.location.href = "m/sub_newsview.php?id="+id;	
					break;
				}else if(url.indexOf("sub_qnaview.php")>0){
					window.location.href = "m/sub_qnaview.php?id="+id;	
					break;
				}else if(url.indexOf("sub_qnawrite.php")>0){
					window.location.href = "m/sub_qnawrite.php";	
					break;
				}else{
					window.location.href = "m/index.php";
					break;
				}
			}
		}
	}
	
	
</script>

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
			<a href="http://medi-tax.kr/sub_qnawrite.php"></a>
		</section>

		
	<script>
	//퀵바
	var elem = $(".quick ul").find('li');
	var items = elem.length;
	var index = 0;

	var quickbubble =  new TimelineLite();

	function bubbleMoving() {
		setTimeout(function() {
			if (index < items) {
				quickbubble.to(elem.eq(index), 0.5, {opacity:1, ease: Power2.easeIn, y:-25})
				.to(elem.eq(index), 1.5, {opacity:1, ease: Power2.easeIn, y:-25})
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

	var quickpop =  new TimelineMax({repeat:-1, repeatDelay: 5, yoyo:true,})
	.delay(2).to($(".quick").find('div'), 0.5, {width:310, borderRadius:25, backgroundPosition: "-85px -50px" })
	.to($(".quick div h1"), 0.5, {opacity:1, x:-40})
	.to($(".quick div h2"), 0.2, {opacity:1, x:-40});
			
	</script>

		<header>
			<section class="navi">
				<a href="index.php">
					<h1>신승세무법인</h1>
				</a>
				<ul>
					<a>
						<li class=""><span></span></li>
					</a>
					<a>
						<li class=""><span></span></li>
					</a>
					<a>
						<li class=""><span></span></li>
					</a>
					<a href="sub_smart.php">
						<li class="<?= ($activePage == 'sub_smart') ? 'on':''; ?>">스마트세무<span></span></li>
					</a>
					<a href="sub_member.php">
						<li class="<?= ($activePage == 'sub_member') ? 'on':''; ?>">구성원<span></span></li>
					</a>
					<a href="sub_news.php">
						<li class="<?= ($activePage == 'sub_news') ? 'on':''; ?>">세무뉴스<span></span></li>
					</a>
				</ul>
			</section>
			<section class="mainVisual">
				<ul>
					<li><img src="resources/images/mainVisual04.png">
						<div>
							<h2>대한의사협회 <br>회원전용 자문세무법인</h2>
							<h3>병의원 절세와 세무안전을 책임집니다</h3>
						</div>
					</li>
					<li><img src="resources/images/mainVisual01.png">
						<div>
							<h2>국세청 33년 경력</h2>
							<h3>믿고 맡길 수 있는 신승세무법인</h3>
						</div>
					</li>
					<li><img src="resources/images/mainVisual02.png">
						<div>
							<h2>비교불가</h2>
							<h3>병의원에 특화된 탁월한 전문성으로 병의원 세무혁신 스마트 경영지원서비스를 지원해드립니다</h3>
						</div>
					</li>
					<li><img src="resources/images/mainVisual03.png">
						<div>
							<h2>쉽고 편한 세무상담센터</h2>
							<h3>언제 어디서나 클릭 한번으로 연결되는 스마트한 세무상담센터를 만나보세요</h3>
						</div>
					</li>
				</ul>			
			</section>
			<section class="mainVlink">
				<ul>
					<a href=""><li><img src="resources/images/mainVlink01.png"><span>병의원 세무 상담센터</span></li></a>
					<a href=""><li><img src="resources/images/mainVlink02.png"><span>병의원 전문세무 지원</span></li></a>
					<a href=""><li><img src="resources/images/mainVlink03.png"><span>병의원 세무안전 점검</span></li></a>
					<a href=""><li><img src="resources/images/mainVlink04.png"><span>병의원 스마트 경영지원</span></li></a>
					<a href=""><li><img src="resources/images/mainVlink05.png"><span>자산관리 절세 컨설팅</span></li></a>
				</ul>
			</section>
		</header>

		<section class="institute">
			<div>
				<h1><img src="resources/images/doctorLogo.png"></h1>
				<h2><img src="resources/images/doctorText.png" alt=""></h2>
			</div>
		</section>

		<section class="system">
			<div>
				<h1>
					MEDICAL<br>TAX-CARE<br>SYSTEM
					<span>병의원 세무안전 검증 & 절세 병의원 전문 세무사가 직접 책임지고 도와드립니다</span>
				</h1>
				<h2><img src="resources/images/systemphone.png" alt=""></h2>
				<ul>
					<li>
						<h3>병의원 전문 세무지원</h3>
						<ol>
							<li>병의원 전문 세무전문가 전담 배정</li>
							<li>병의원 장부 (월별 / 분기별) 기장 서비스</li>
							<li>병의원 분기별 결산 & 손익보고 서비스</li>
							<li>병의원 법인세, 소득세 신고, 조정 서비스</li>
							<li>병의원 직원 급여, 상여 및 퇴직금  아웃소싱 서비스</li>
							<li>병의원 노무 & 4대보험 관리 서비스</li>
						</ol>
					</li>
					<li>
						<h3>병의원 세무안전 점검</h3>
						<ol>
							<li>국세청 실무담당 출신 세무사 1:1 배정</li>
							<li>세무조사 예방 사전점검 서비스</li>
							<li>국세청 매뉴얼 기준 병의원 모의 세무조사 서비스</li>
							<li>국세청 세무조사 대응 밀착 서비스</li>
							<li>병의원 세무진단 서비스</li>
							<li>병의원 특화 세무분석보고 서비스</li>
								
						</ol>
					</li>
					<li>
						<h3>병의원 스마트 세무경영지원</h3>
						<ol>
							<li>인공지능 AI 도입 매출 매입 손익 실시간 안내</li>
							<li>실시간 세무 업무 진행상황 및 신고결과 안내</li>
							<li>맞춤 세무 & 노무 & 마케팅 채팅상담 지원</li>
							<li>카드 매출 입금 실시간 안내 및 카드매출 누락 알림</li>
							<li>세무자료 자동 수집 및 증빙 자동 관리</li>
							<li>민원/증명서류 초스피드 간편발급 시스템</li>
							<li>병의원 마케팅 비용대비 효과 분석 서비스</li>
						</ol>
					</li>
					<li>
						<h3>절세 컨설팅</h3>
						<ol>
							<li>프리미엄 절세 컨시어지 서비스</li>
							<li>병의원 자산관리 전략 컨설팅</li>
							<li>양도/상속/증여 컨설팅</li>
							<li>병의원 신고자료 분석 절세방안 제안</li>
							<li>경비 과부족 해결방안 제시</li>
							<li>사업용 계좌 관리 및 활용방안 제시</li>
							<li>병의원 중국진출 & 중국 세무컨설팅</li>
						</ol>
					</li>
				</ul>
			</div>
		</section>

		<section class="video">
			<div>
				<div>
					<h1>TAX SEMINAR</h1>
					<ul>
						<li class="videoMain" id="AfZ_Ob_zcRg"><img src="resources/images/videoIcon_white.png"><span>중국기업 실무자<br>한국세무세미나</span></li>
						<li>
							<h2>황재윤 대표세무사<br>중국기업 실무자 한국세무 세미나</h2>
							
						</li>
					</ul>
				</div>

				<ul>
					<li id="axNY67zTwUI"><span>EP01.</span> 1세대 1주택 비과세 개념정리</li>
					<li id="ox9AWkrzvrQ"><span>EP02.</span> 1세대 1주택 비과세 (주택의 개념 및 1주택 판단)</li>
					<li id="kH-QIec-zmk"><span>EP03.</span> 1세대 1주택 비과세 조건</li>
					<li id="It3DEHwGxqw"><span>EP04.</span> 1세대 1주택 비과세 특례</li>
					<li id="W-GXhtRLUSo"><span>EP05.</span> 다주택자 중과세</li>
					<li id="CT1YBSWxouM"><span>EP06.</span> 비사업자용 토지</li>
					<li id="GW_1HlujVVE"><span>EP07.</span> 상속세 & 증여세 개념정리</li>
					<li id="fUqQqcIMpaA"><span>EP08.</span> 사전증여 개념정리</li>
					<li id="L-FlUMjm9Lg"><span>EP09.</span> 상속세 & 증여세 공제</li>
					<li id="Xf04Y0cSans"><span>EP10.</span> 상속세 & 증여세 재산평가</li>
					<li id="KEmbShfakIY"><span>EP11.</span> [핵심요약] 1세대 1주택 비과세</li>
					<li id="lZot990sBU0"><span>EP12.</span> [핵심요약] 1세대 1주택 비과세 (1주택 판단)</li>
				</ul>
			</div>
		</section>
		
		<section class="videoPop">
			<div id="player"></div>
			<p class="close"></p>			
		</section>
		
		<script>
			//세마나영상 레이어팝업
			$('.video li').click(function(){
				player.loadVideoById(this.id);
				$(".mask").fadeIn();
				$(".videoPop").fadeIn();		
			});	

			var tag = document.createElement('script');
		
			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		
			var player;
			function onYouTubeIframeAPIReady() {
				player = new YT.Player('player', {
				height: '540',
				width: '960',
				videoId: '',
				events: {
					'onReady': stopVideo
				}
				});
			}		  
			function onPlayerReady(event) {
				event.target.playVideo();
			}  		
			function stopVideo() {
				player.stopVideo();
			}
		</script>

		<section class="column">
			<div>
				<h1>절세꿀팁</h1>
				<!--<a href="" class="more"></a>-->
			</div>
			<ul>
				<li>
					<h2>창업자를 위한 절세꿀팁</h2>
					<h3>인테리어를 포함한 초기 투자비용이 높은 경우 일반과세자로 등록해야 초기 비용에 대한 세금계산서를 발급받아 매입세액공제를 받을 수 있습니다. 
							특히, 일반과세자는 창업 초기 인테리어비용에 대해 부가가치세 조기환급제도를 이용할 수도 있습니다. 
							<br>권리금도 처음 계약할때 잘 정리해두어야 손해가 없는데, 시설권리금을 주는 경우 꼭 세금계산서를 받고 줘야 하고, 바닥권리금은 기타소득세 8.8%를 원천징수 후에 지급하고 신고해야만 감가상각을 받아 절세 할 수 있습니다.</h3>
					<h4>#창업 #절세 #창업세무 #권리금</h4>
					<a></a>
				</li>
				<li>
					<h2>1가구 2주택 양도소득세 면제조건</h2>
					<h3><strong>이사를 위해 일시적 1가구 2주택이 된 경우</strong><br> 
							해당 기간 내 기존주택을 매도하게 되면 비과세를 받을 수 있습니다. 
							단, 9억 원을 초과하는 고가주택은 초과된 금액만큼 과세가 적용됩니다.<br> 							
							<strong>결혼하면서 1기구 2주택이 된 경우</strong> <br> 
							혼인신고일 기준 5년 이내 한 주택을 처분할 경우, 먼저 처분한 주택의 1가구 2주택 세금을 면제받을 수 있습니다. 
							더불어 60세 이상 노부모 부양 합가로 인한 1가구 2주택 양도소득세 면제조건은 10년 이내 주택을 팔면 해당이 될 수 있습니다.<br>
							상속으로 1가구 2주택이 된 경우</h3>
					<h4>양도세 #양도소득세 #1가구2주택 #비과세</h4>
					<a></a>
				</li>
				<li>
					<h2>상속세 낼 것도 없어도 신고하는게 절세노하우</h2>
					<h3>일반적으로 배우자가 있고 자녀가 있는 경우 상속재산 10억원까지는 전액 공제가 되므로 상속세 신고조차 하지 않는 경우가 대부분입니다.  
							그런데, 시간이 지나 상속 재산을 처분해야 하는 경우가 생기면 상속세를 신고하지 않아 양도소득세를 많이 내야 하는 경우가 있습니다. 
							이는 세무서는 상속재산에 대해 별도 신고를 하지 않은 경우 상속 당시 기준시가를 취득가액으로 보는데, 파는 가격은 실거래가액이다보니 
							그격차가 너무 커져서 발생하는 경우로 상속세를 낼 필요가 없는 경우라도 감정평가를 해 감정가액으로 상속세를 신고를 하면 미래의 양도세를 아낄 수 있습니다.</h3>
					<h4>#상속세 #상속세신고 #양도소득세 </h4>
					<a></a>
				</li>
			</ul>			
		</section>	

		<section class="counseling">
			<div>
				<h1>상담사례</h1>
				<!--<a href="" class="more"></a>-->
			</div>
			<ul>
				<li>
					<h2>사망보험금을 수령하였는데 상속세 과세대상에 해당하나요?  </h2>
					<h3>피상속인의 사망으로 인하여 지급받는 생명보험이나 손해보험 등의 보험금으로서 피상속인이 보험계약자이거나 실질적으로 보험료를 불입한 보험계약에 의하여 지급받는 경우 이를 상속재산으로 보아 상속세를 부과합니다.<br>
					- 상속세 과세대상 보험금 (상증법 8조)<br>
					다만, 보험료 계약자, 불입자, 피보험자, 보험금 수익자에 따져 상속세, 증여세로 구분되어집니다.</h3>
					<h4>#상속세 #사망보험금</h4>
					<a></a>
				</li>
				<li>
					<h2>상속개시 전에 증여받은 재산도 상속세 계산할때 합산하나요?</h2>
					<h3>5년 이내에 상속인 이외의 자에게 증여한 재산은 상속세 과세가액에 가산하여 상속세를 계산합니다.<br> 
						피상속인이 생전에 재산을 상속인 등에게 분할하여 증여함으로써 
						상속세의 누진세 부담을 회피하는 것을 방지하기 위해서입니다.<br> 
						이미 납부한 증여세는 일정 한도 내에서 상속세 산출세액에서 공제합니다.</h3>
					<h4>#상속세 #사전증여 #증여재산 #증여재산합산</h4>
					<a></a>
				</li>
				<li>
					<h2>다가구주택은 어떻게 비과세를 판정하나요?</h2>
					<h3>다가구주택은 원칙적으로 한 가구가 독립하여 거주할 수 있도록 구획된 부분을 하나의 주택으로 봅니다.<br>
						다만, 해당 다가구주택을 구획된 부분별로 양도하지 않고 하나의 매매단위로 하여 양도하는 경우에는 
						그 전체를 하나의 주택으로 보아 1세대 1주택 비과세를 판정하고, 
						양도가액 9억원을 초과하는 고가주택에 해당하는지 여부 또한 전체 양도가액을 기준으로 판단합니다.</h3>
					<h4>#상속세 #사망보험금</h4>
					<a></a>
				</li>
			</ul>			
		</section>
	
		<script>
			$('.counseling ul li,.column ul li').each(function(){
				
				var textQ =$(this).children('h2').html();	
				var textA =$(this).children('h3').html();
				var textTag =$(this).children('h4').html();		
				
				if($(this).closest('section').hasClass('counseling')){
					$(this).children('h3').html((textA.substring(0,75)+"..."));
				}
				if($(this).closest('section').hasClass('column')){
					$(this).children('h3').html((textA.substring(0,66)+"..."));
				}
				
				$(this).click(function(){
					$(".mask").fadeIn();
					$(".counselingPop").fadeIn();
					$('.counselingPop h1').html(textQ);
					$('.counselingPop h2').html(textA);
					$('.counselingPop h3').html(textTag);	
					
					if($(this).closest('section').hasClass('column')){
						$('.counselingPop').find('span').css("display","none");
					}
				})				
			});

		</script>
		
		<section class="counselingPop">
			<div class="qWrap">
				<span>Q</span>
				<h1></h1>
			</div>
			<div class="aWrap">
				<span>A</span>
				<h2></h2>
				<span class="blank"></span>
				<h3></h3>
			</div>
			<p class="close"></p>			
		</section>
		
		<section class="company">
			<p></p>			
			<div>				
				<img src="resources/images/mbc.png">
				<h2><strong>병원에만 전념하세요</strong><br>신승세무법인이 함께 합니다</h2>
				<h3>신승세무법인은 전문성과 노하우를 바탕으로 병의원 세무관련 예상납부세액, 세금신고, 세금내역은 물론 병원 경영에 필요한 많은 정보를 제공하고, 업무 소통을 빠르고 편리하게 도와드립니다.</h3>				
			</div>
		</section>
		
		<section class="location">
			<div class="locationCon">
				<h1>신승세무법인 지점안내</h1>
				<h2>글로벌 세무전문 그룹 신승세무법인 수도권 15개 지점</h2>
				<ul>
					<li>강남본사<span>MAP</span></li>
					<li>부천지점<span>MAP</span></li>
					<li>용인지점<span>MAP</span></li>
					<li>광주지점<span>MAP</span></li>
					<li>안양지점<span>MAP</span></li>
					<li>분당지점<span>MAP</span></li>
					<li>수원지점<span>MAP</span></li>
					<li>기흥지점<span>MAP</span></li>
					<li>일산지점<span>MAP</span></li>
					<li>신사지점<span>MAP</span></li>
					<li>용산지점<span>MAP</span></li>
					<li>안산지점<span>MAP</span></li>
					<li>안산법원지점<span>MAP</span></li>
					<li>시흥지점<span>MAP</span></li>
					<li>시흥정왕지점<span>MAP</span></li>
				</ul>
			</div>
		</section>

		<section class="locationPop">
			<h1></h1>
			<h2></h2>
			<a class="chat"><span>채팅상담</span></a><!--<a class="call"><span>전화상담</span></a>-->
			<p class="close"></p>			
		</section>	
		
		
	<script>
		function go_kakao(str){

			switch (str) {
				case "강남":
					window.open("http://pf.kakao.com/_vexexkC/chat");
					break;
				case "부천":
					window.open("http://pf.kakao.com/_mxkeYT/chat");
					break;
				case "용인":
					window.open("http://pf.kakao.com/_UGLxkT/chat");
					break;
				case "광주":
					window.open("http://pf.kakao.com/_aIxmYT/chat");
					break;
				case "안양":
					window.open("http://pf.kakao.com/_eLLxkT/chat");
					break;
				case "분당":
					window.open("http://pf.kakao.com/_GxaCzC/chat");
					break;
				case "수원":
					window.open("http://pf.kakao.com/_RQLxkT/chat");
					break;
				case "기흥":
					window.open("http://pf.kakao.com/_ZavYT/chat");
					break;
				case "일산":
					window.open("http://pf.kakao.com/_xdAtxkT/chat");
					break;
			}
		}

		var locationChatclear = function(){		
			$(".locationPop").find('.chat').css("display","none");				
		}	
		
		var Location = function(){	
			$(".locationCon").find('li').each(function(){
			$(this).on("click",function(){
				
				//초기화
				$('.locationPop h1, .locationPop h2').html('');
				$(".locationPop").find('.chat').css("display","block");	
				
				//버튼값 불러오기
				var linkName = $(this).text().replace(/[a-z]/gi,'');
				
				var locationTitle = ['지점','주소','위치','주차','tel','fax','mail'];
				
				switch(linkName){
					case "강남본사" :
					locationContents = ["강남본사", "서울시 강남구 테헤란로 114 (역삼동) 역삼빌딩 14층","2호선 강남역 1번 출구 역삼세무서 맞은편","센트럴프루지오시티 지하 주차 가능 (무료)", "02-3452-0608", "02-3452-0866", "ss1@sostax.co.kr"]
					//alert(0);
					$(".locationPop").find('.chat').attr("href","javascript:go_kakao('강남');");
					break;

					case "부천지점":
						locationContents = ["부천지점", "경기도 부천시 원미구 신흥로 266번길 화령빌딩 102호", "신중동역 6번출구 부천세무서 건너편", "건물 뒤 주차장 (무료)", "032-323-9620", "032-324-9620", "ss6@sostax.co.kr"]
						$(".locationPop").find('.chat').attr("href","javascript:go_kakao('부천');");
						break;

					case "용인지점":
						locationContents = ["용인지점", "경기도 용인시 처인구 금학로 155 (역북동)", "동부경찰서 밑", "사무실 앞 주차장 (무료)", "031-335-0608", "031-335-0708", "ss2@sostax.co.kr"]
						$(".locationPop").find('.chat').attr("href","javascript:go_kakao('용인');");
						break;

					case "광주지점":
						locationContents = ["광주지점", "경기도 광주시 문화로 123(탄벌동) 국제빌딩1층", "경기광주세무서 옆", "경기광주 공설운동장 (무료)", "031-763-3077", "031-763-3060", "ss7@sostax.co.kr"]
						$(".locationPop").find('.chat').attr("href","javascript:go_kakao('광주');");
						break;

					case "안양지점":
						locationContents = ["안양지점", "경기도 안양시 동안구 시민대로 277 108호 (관양동, 세방글로벌시티)", "4호선 평촌역 2번 출구 동안양세무서 맞은편", "세방글로벌시티 지하 주차 가능 (2시간 주차권 제공)", "031-387-0806", "031-387-0819", "ss3@sostax.co.kr"]
						$(".locationPop").find('.chat').attr("href","javascript:go_kakao('안양');");
						break;

					case "분당지점":
						locationContents = ["분당지점", "경기도 성남시 분당구 황새울로311번길 14, 서현리더스빌딩 1층 103호", "분당세무서후문 맞은편", "서현리더스빌딩 (주차권 제공)", "031-705-0608", "031-705-0688", "ss8@sostax.co.kr"]
						$(".locationPop").find('.chat').attr("href","javascript:go_kakao('분당');");
						break;

					case "수원지점":
						locationContents = ["수원지점", "수원시 영통구 청명남로 14번지 1층", "분당선영통역 1번,2번출구 동수원세무서 맞은편", "사무실 앞 도로변 공용주차장 (유료)", "031-202-9620~9622", "031-202-9608", "ss4@sostax.co.kr"]
						$(".locationPop").find('.chat').attr("href","javascript:go_kakao('수원');");
						break;

					case "기흥지점":
						locationContents = ["기흥지점", "경기도 용인시 기흥구 흥덕2로117번길 15", "기흥세무서 건물내 1층 (무료)", "건물내 지하주차", "031-211-0608", "031-213-0688", "ss99@sostax.co.kr"]
						$(".locationPop").find('.chat').attr("href","javascript:go_kakao('기흥');");
						break;

					case "일산지점":
						locationContents = ["일산지점", "경기도 고양시 일산동구 중앙로 1305-30 일산마이다스오피스텔 112호", "3호선 정발산역 2번 출구 고양세무서 맞은편", "일산마이다스빌딩 지하 주차 가능 (주차권 제공)", "031-932-0863", "031-932-0869", "ss5@sostax.co.kr"]
						$(".locationPop").find('.chat').attr("href","javascript:go_kakao('일산');");
						break;
						
					case "신사지점" :
					locationContents = ["신사지점", "서울시 강남구 강남대로 150길 9 삼우빌딩 203호",   "신사역 3번출구 신한은행 뒷건물",  "건물 1층 지상주차장 (30분 무료제공)", "02-569-5596", "02-6442-5501", "5695596@hanmail.net"]	
					locationChatclear();
					break;
						
					case "용산지점" :
					locationContents = ["용산지점", "서울시 용산구 서빙고로24길16 1층",   "용산세무서 맞은편",  "용산세무서 이용", "02-3785-2243", "02-3785-2248", "ssin2243@hanmail.net"]
					locationChatclear();
					break;
						
					case "안산지점" :
					locationContents = ["안산지점", "경기도 안산시 단원구 화랑로358 (고잔동) 110호",   "안산세무서 후문 맞은편 1층",  "안산세무서 주차 가능 (무료)", "031-405-9415,9425", "031-405-9421", "asshinseung@hanmail.net"]
					locationChatclear();
					break;
						
					case "안산법원지점" :
					locationContents = ["안산법원지점", "경기도 안산시 광덕서로86, 122호(고잔동,안산법조타운)",   "수원지방법원안산지원 맞은편",  "안산법조타운 지하 주차 가능 (최대 3시간 주차권 지급)", "031-508-3636", "031-508-3638", "ssbeopwon@hanmil.net"]
					locationChatclear();
					break;
						
					case "시흥지점" :
					locationContents = ["시흥지점", "경기도 시흥시 비둘기공원7길 51, 대명프라자 301호",   "시흥세무서 대야동민원실 맞은편",  "대명프라자 건물 내 기계식 주차장 이용 (무료)", "031-311-3360", "031-311-5942", "ss3360@hanmail.net"]
					locationChatclear();
					break;
						
					case "시흥정왕지점" :
					locationContents = ["시흥정왕지점", "경기도 시흥시 봉우재로 23-29 ,101호(정왕동)",   "정왕보건지소 맞은편",  "정왕보건지소 주차가능 (무료)", "031-432-9415-7", "031-432-9418", "ss4919@hanmail.net"]
					locationChatclear();
					break;
				}
				
			//팝업오픈
			$(".mask").fadeIn();	
			$(".locationPop").fadeIn();

			$(".locationPop").find('h1').append(locationContents[0]+'<span>신승세무법인</span>');	
			for(i=0; i<locationTitle.length; i++){
				$(".locationPop").find('h2').append('<li><strong>'+locationTitle[i]+'</strong><span>'+locationContents[i]+'</span></li>');
				}	
			})			
		})		
	}();
	</script>
	
		<section class="people">
			<h1>신승 세무법인 세무사</h1>
			<h2>신승 세무법인의 대표 세무사는 평균 20년 이상 경력의 숙련된 전문가로 구성되어 있습니다</h2>

			<div class="tabBlock">
				<ul class="tabBlock-tabs">
					
					<li class="tabBlock-tab is-active ">
						<span><strong>대표세무사</strong>황재윤</span>
						<span><strong>대표세무사</strong>변기영</span>
					</li>
					<li class="tabBlock-tab">
						<span><strong>대표세무사</strong>전명호</span>
						<span><strong>대표세무사</strong>박호열</span>
					</li>
					<li class="tabBlock-tab">
						<span><strong>회계사</strong>오종석</span>
						<span><strong>회계사</strong>안장순</span>
					</li>
					
				</ul>

				<div class="tabBlock-content">
					
					
					<div class="tabBlock-pane">
						<div>
							<img src="resources/images/people0102.png">
							<h3>대표세무사</h3>
							<h4>황재윤</h4>
							<h5>
								<li><strong>前 주중 한국대사관 세무협력관</strong></li>
								<li><strong>前 국세청 납세보호관 (국장) 직무대행</strong></li>
								<li><strong>前 중부청 국세심사위원</strong></li>
								<li><strong>前 국세청 심사 1 담당관</strong></li>
								<li>前 조세심판원 조사관</li>
								<li>前 국세청 부가세 과장</li>
								<li>前 대구청 조사1국장</li>
								<li>前 서울청 감사관, 조사과장</li>
								<li>前 중부청 조사, 특별조사과장</li>
							</h5>	
							<div class="label">
								<p>국세청경력</p>
								<span>27</span><span>년</span>	
							</div>
						</div>
						<div>
							<img src="resources/images/people0103.png">
							<h3>대표세무사</h3>
							<h4>변기영</h4>
							<h5>
								<li><strong>신승세무법인 대표</strong></li>
								<li><strong>세무회계 컨설팅 19년</strong></li>
								<li><strong>외국투자기업 세무조사 자문</strong></li>
								<li>절세 장단기 계획 수립</li>
								<li>기업 세무회계 컨설팅</li>
								<li>주요 계약 세무문제 검토 및 자문</li>
								<li>개인기업 법인전환 컨설팅</li>
							</h5>	
							<div class="label">
								<p>세무컨설팅</p>
								<span>20</span><span>년</span>
							</div>
						</div>
					</div><!--tabBlock-pane-->
					
					<div class="tabBlock-pane">													
						<div>
							<img src="resources/images/people0104.png">
							<h3>대표세무사</h3>
							<h4>전명호</2h4>
							<h5>
								<li><strong>심판, 감사 청구, 조세소송 자문</strong></li>
								<li><strong>前 중부지방국세청</strong></li>
								<li>前 화성세무서 재산세과장</li>
								<li>前 시흥세무서 부가세과장</li>
								<li>세무조정 및 성실신고 컨설팅</li>
								<li>재산취득원천 조사 대응</li>
								<li>ENTI 모의세무조사 컨설팅</li>
								<li>법인세 정기, 수시 세무조사 대응</li>
							</h5>	
							<div class="label">
								<p>국세청경력</p>
								<span>38</span><span>년</span>									
							</div>
						</div>	

						<div>
							<img src="resources/images/people0105.png">
							<h3>대표세무사</h3>
							<h4>박호열</h4>
							<h5>
								<li><strong>조세불복, 세금면책 자문</strong></li>
								<li><strong>前 국세청 소득세과</strong></li>
								<li>前 국세청 부가세과</li>
								<li>前 강남, 반포 세무서</li>
								<li>양도소득세 절세방안 컨설팅</li>
								<li>상속세 및 증여세 불복업무 자문</li>
								<li>개인 세무조사 대응 방안 자문</li>
								<li>개인제세 이의신청 및 과세전적부심사청구</li>
							</h5>	
							<div class="label">
								<p>국세청경력</p>
								<span>33</span><span>년</span>	
							</div>
						</div>						
					</div><!--tabBlock-pane-->

					<div class="tabBlock-pane">						
						<div>
							<img src="resources/images/people0111.png">
							<h3>회계사</h3>
							<h4>오종석</h4>
							<h5>
								<li><strong>공인회계사</strong></li>
								<li><strong>국제조세 & 해외 세무신고 자문</strong></li>
								<li>고려대학교 경제학 전공</li>
								<li>서울대학교 대학원 경영학 석사</li>
								<li>중국인민대학교 경제학 박사</li>
								<li>국내/해외 M&A 및 투자인수 자문</li>
								<li>세무진단, 세무조사, 세무자문</li>
								<li>세무회계컨설팅 22년 경력</li>									
							</h5>	
							<div class="label">
								<p>회계컨설팅</p>
								<span>22</span><span>년</span>	
							</div>
						</div>
						<div>
							<img src="resources/images/people0110.png">
							<h3>회계사</h3>
							<h4>안장순</h4>
							<h5>
								<li><strong>공인회계사</strong></li>
								<li><strong>법인감사 및 세무진단</strong></li>
								<li>M&A 및 투자인수 자문</li>
								<li>기업 설립 및 청산 자문</li>
								<li>기업 재무회계 자문</li>
								<li>세무조정 및 성실신고 컨설팅</li>
								<li>세무회계컨설팅 20년 경력</li>
							</h5>	
							<div class="label">
								<p>회계컨설팅</p>
								<span>20</span><span>년</span>	
							</div>
						</div>
					</div><!--tabBlock-pane-->
					
					
				</div><!--tabBlock-content-->
			</div><!--tabBlock-->
		</section>

		<section class="allpeople">
			<div>
				<h1>번거롭고 복잡한 병의원 세무업무를 책임져드립니다</h1>
				<h2>20여년 노하우를 갖춘 70여명의 세무회계 및 경영컨설팅 전문가와 함께 하세요</h2>
			</div>
		</section>

		<section class="china">
			<div>
				<img src="resources/images/chinaMap.png">
				<h1>신승차이나컨설팅</h1>
				<h2>한중 NO.1 중국관련 원스톱 기업지원센터 운영</h2>
				<h3>한국기업 중국진출 컨설팅 & 중국기업 한국투자 컨설팅<br>
				중국 선도 컨설팅 그룹 UNI-TAX Korea Member Firm<br>
				중국 23개 지역 지사 네트워크 인프라 구축<br>
				</h3>
				<ul>
					<li><span>중국진출/한국투자<br>컨설팅</span></li>
					<li><span>중국경영컨설팅<br>한국법인설립지원</span></li>
					<li><span>중국세무/한국세무<br>컨설팅</span></li>
					<li><span>중국법률/한국노무<br>컨설팅</span></li>
					<li><span>중국마케팅/한국마케팅<br>컨설팅</span></li>
				</ul>
				
			</div>
		</section>
		
		<section class="catalogue">
			<ul>
				<li>개원예정의가 꼭 알아야 할 병의원 세무 & 세테크
					<a href="https://sostax.cn/down/병의원_개원세무_006_200407.pdf">PDF 다운로드 <img src="resources/images/downIcon.png"></a>
				</li>
			</ul>
		</section>
		
		<section class="customer">
			<ul>
				<li class="tel">
					<img src="resources/images/customer.png">
					<h1>세무기장 및 신고 문의 </h1>
					<h2>세무상담은 전화로는 진행하지 않습니다</h2>
					<h2>평일 오전 10시 ~ 오후 6시 토,일,공휴일 휴무</h2>
					<h3><strong>강남본점</strong>02-3452-0608</h3>
				</li>
				<li>
					<h4>병의원 세무상담</h4>
					<h5>개원세무/병의원절세/세무조사</h5>
					<span>상담하기</span>
					<a href="http://medi-tax.kr/sub_qnawrite.php"></a>
				</li>
				<li>
					<h4>절세 컨설팅</h4>
					<h5>양도소득세, 증여상속세 문의</h5>
					<span>상담하기</span>
					<a href="javascript:ChannelIO('show');"></a>
				</li>
				
			</ul>
		</section>
		
		<section class="group">
			<ul>
				<a href="http://medi-tax.kr" target="_blank">
					<h1>신승세무법인</h1>
					<h2>병의원세무지원센터</h2>
				</a>
				<a href="http://tax-free.kr" target="_blank">
					<h1>신승세무법인</h1>
					<h2>체납면책지원센터</h2>
				</a>
				<a href="http://sostax.kr/out/" target="_blank">
					<h1>신승차이나컨설팅</h1>
					<h2>중국진출기업지원센터</h2>
				</a>
				<a href="http://sostax.kr/" target="_blank">
					<h1>신승차이나컨설팅</h1>
					<h2>한국투자기업지원센터</h2>
				</a>
			</ul>
		</section>
		
		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>대표자 : 변기영</li>
				<li>개인정보보호책임자 : 정혜숙</li>
				<li>대표번호 : 02-3452-1134</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li>서울특별시 강남구 테헤란로4길 6, 1층 117호 (역삼동, 강남역 센트럴 푸르지오 시티)</li>				
			</ul>
			<h3>Copyright(c) 2019 shinseung rights reserved</h3>
		</footer>
		
		
	</div>
	
	
	
	
</body>
	
<script>
	
	//메인페이징 첫번째 움직임
	$(window).load(function() {
		$(".bx-pager-item a").eq(0).addClass("active");
	});	
	
	//메인롤링		
	$('.mainVisual ul').bxSlider( {
		pager: true,				
		auto: true,
		autoControls : false,
		speed : 500,
		pause : 3000,
		controls : true,
    });

	//지점안내 레이어팝업
	$('.wrap').prepend('<div class="mask"></div>');

	//레이어팝업닫기
	$(".locationPop .close,.videoPop .close,.counselingPop .close ").click(function() {			
		$(".locationPop").css("display","none");
		$(".videoPop").css("display","none");
		$(".mask").css("display","none");	
		$(".counselingPop").css("display","none");
		$('.counselingPop').find('span').css("display","inline-block");
		player.stopVideo();
		//$('.modalVideo ul > a').removeClass('active');			
	});		

</script>

</html>
