<?php include("top.php");?>

		<section id="promotionBanner" class="popup">
				<a href="javascript:go_kakao();">
				<div class="popContents">
					<h2>다주택자 양도세 중과 여부판단 및 바로 상담 </h2>
					<h3>CLICK</h3>
					<input type="checkbox" value="checkbox" name="chkbox" id="chkday" onClick="javascript:closeWinAt00('popContents', 1);" /><label for="chkday">오늘 하루 그만보기
					</label>
					<a href="#none" class="btnclose"></a>
				</div></a>
		</section>

		<script language="Javascript">
			//저장된 해당 쿠키가 있으면 창을 안 띄운다 없으면 뛰운다.
			cookiedata = document.cookie;
			if (cookiedata.indexOf("topPop=done") < 0) {
				window.onload = function () {
					setTimeout(function () {
						$('.popup').slideDown(500);
					}, 500);
				}
			}
			else {
				document.all['promotionBanner'].style.display = "none";
			}
		</script>

		<header>
			<section class="mainnavi">
				<?php include("navi.php");?>
			</section>

			<script>

				//따라다니는 네비
				$(window).scroll(function () {

					var mainchange = $('.number').offset().top;

					if ($(this).scrollTop() > mainchange) {
						TweenLite.to('.mainnavi', 0.1, { css: { background: "#fff", position: "fixed", width: "100%", paddingTop: "0px", boxShadow: "-1px -2px 9px rgba(230,230,230,.9)" } });
						TweenLite.to('.mainnavi div ul a li', 0, { css: { color: "#333" } });
						TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/sublogo.png)',color: "#194581" });
					}
					else {
						TweenLite.to('.mainnavi', 0, { css: { background: "none", position: "absolute", paddingTop: "30px", boxShadow: "none" } });
						TweenLite.to('.mainnavi ul a li', 0, { css: { color: "#fff" } });
						TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/logo.png)',color: "#fff" });
					}
				});

				$(function () {
					$('#myVideo').get(0).load();
					$('#myVideo').get(0).play();

				});

			</script>	

			<video muted loop id="myVideo">
				<source src="" type="video/mp4">
				</source>
			</video>
			<section class="mainVisual">				
				<div>
					<h1>국세청 33년 경력</h1>
					<h2>양도소득세 국내 최다 상담 및 신고처리</h2>
				</div>
			</section>
		</header>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<section class="number">
			<h1>세금을 줄일 수 있는 최고의 선택 세무톡이 도와드립니다
			</h1>
			<ul>
				<li>
					<span>양도소득세 처리건수</span>
					<span class="counter">4,919</span>
					<span>건</span>
				</li>
				<li>
					<span>누적 거래관리 금액</span>
					<span class="counter">46.9</span>
					<span>조</span>
				</li>
				<li>
					<span>양도소득세 상담건수</span>
					<span class="counter">103,785</span>
					<span>건</span>
				</li>
			</ul>
		</section>


		<section class="price"  style="margin:100px 0 0 0;">
			<h1>서비스 가격안내</h1>
			<ul>
				<li>
					<p></p>
					<h2>사전 절세컨설팅 </h2>
					<h3>사전 절세방안 검토 및 세액 산출 서비스 기준 </h3>
					<div>
						<span class="pricebg01">건별</span>
						<span>10</span>
						<span>만원</span>
					</div>
					<a href="sub_price.php"></a>
				</li>
				<li>
					<p></p>
					<h2>양도소득세 </h2>
					<h3>고액 절세액 발생시 추가 수수료 별도 협의 </h3>
					<div>
						<span class="pricebg02">건별</span>
						<span>20</span>
						<span>만원~</span>
					</div>
					<a href="sub_price.php"></a>
				</li>
			</ul>
		</section>


		<section class="link">
			<img src="resources/images/linkpeople.png">
			<div>
				<h1>국세청 33년 경력</h1>
				<h2>복잡한 양도소득세! 혼자 고민하지 마시고 전문가에게 상담 받아보세요</h2>
				<input type="text" name="NEW_HP1" id="NEW_HP1" placeholder="핸드폰번호를 입력해주세요"
					onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
				<button type="button" name="action1" id="action1"  class='IfdoVirtualPage' data-url='tel_request.html' data-title='전화상담 요청'>전화상담 요청</button>
				<a href="javascript:go_kakao();"  class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'>채팅상담</a>
			</div>
		</section>

		<section class="heavytax">
			<div>
				<h1>양도세 중과 "다주택자 빨리 집 파세요"</h1>
				<h2>다주택자 이번 기회에 집 안팔면 더 센 '세금폭탄'이 기다립니다</h2>
				<h3>2020년 6월 말까지 10년이상 보유 다주택자 양도세 중과 한시 면제</h3>
				<h4>
					<a href="sub_newsview.php?id=122">관련뉴스 보기</a> <a href="javascript:go_kakao();"  class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'>채팅상담</a>
				</h4>
			</div>
		</section>

		<section class="case">
			<h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
			<h2>이미 많은 고객분들이 세무톡으로 탁월한 절세혜택을 경험하고 계십니다 </h2>
			<section class="case01">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide contents">
							<h3><span>2,124만원</span> 절세 혜택!</h3>
							<h4>양도소득세 신고 / 토지 </h4>
							<ul>
								<li>양도대상 : 토지</li>
								<li>양도가액 : 5억 6천만원</li>
								<p class="taxbefore"><span>일반 예상 세액</span><strong class="small">1억 5,739만원 </strong>
								</p>
								<p class="taxafter"><span>세무톡 예상 세액</span><strong class="small">1억 3,615만원 </strong>
								</p>
							</ul>
							<h5>-2,124만원 </h5>
							<a></a>
						</div>
						<div class="swiper-slide contents">
							<h3><span>1,499만원</span> 절세 혜택!</h3>
							<h4>양도소득세 신고 / 토지 </h4>
							<ul>
								<li>양도대상 : 토지</li>
								<li>양도가액 : 2억 4천만원</li>
								<p class="taxbefore"><span>일반 예상 세액</span><strong>5,113만원 </strong> </p>
								<p class="taxafter"><span>세무톡 예상 세액</span><strong>3,614만원 </strong></p>
							</ul>
							<h5>-1,499만원 </h5>
							<a></a>
						</div>
						<div class="swiper-slide contents">
							<h3><span>1,217만원</span> 절세 혜택!</h3>
							<h4>양도소득세 신고 / 주택 </h4>
							<ul>
								<li>양도대상 : 주택</li>
								<li>양도가액 : 4억 7천만원</li>
								<p class="taxbefore"><span>일반 예상 세액</span><strong>3,834만원 </strong> </p>
								<p class="taxafter"><span>세무톡 예상 세액</span><strong>2,617만원 </strong></p>
							</ul>
							<h5>-1,217만원 </h5>
							<a></a>
						</div>
						<div class="swiper-slide contents">
							<h3><span>448만원</span> 절세 혜택!</h3>
							<h4>양도소득세 신고 / 토지 </h4>
							<ul>
								<li>양도대상 : 토지</li>
								<li>양도가액 : 1억원</li>
								<p class="taxbefore"><span>일반 예상 세액</span><strong>977만원 </strong> </p>
								<p class="taxafter"><span>세무톡 예상 세액</span><strong>529만원 </strong></p>
							</ul>
							<h5>-448만원 </h5>
							<a></a>
						</div>
					</div>
					<!-- <div class="swiper-pagination"></div> -->
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</section>
		</section>

		<section class="video">
			<div>
				<div>
					<h1>TAX SEMINAR</h1>
					<ul>
						<li class="videoMain" id="AfZ_Ob_zcRg"><img
								src="resources/images/videoIcon_white.png"><span>중국기업 실무자<br>한국세무세미나</span></li>
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
			$('.video li').click(function () {
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

		<section class="benefits">
			<h1>비교불가</h1>
			<h2>혁신적인 세무회계 서비스 세무톡이 선도합니다</h2>
			<ul>
				<li>
					<img src="resources/images/benefit01.png">
					<h3>저렴한 가격</h3>
					<h4>스마트한 세무서비스<br> 일반 세무사무소와 비교가 안됩니다</h4>
					<h5>가격 문의하기</h5>
					<a href="sub_price.php"></a>
				</li>
				<li>
					<img src="resources/images/benefit02.png">
					<h3>실시간 상담 </h3>
					<h4>가입없이 클릭 한번으로 <br>바로 상담이 가능합니다</h4>
					<h5>세무 상담하기</h5>
					<a href="javascript:go_kakao();"  class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
				<li>
					<img src="resources/images/benefit03.png">
					<h3>편리한 자료전송 </h3>
					<h4>이메일이나 팩스가 아닌 스마트폰으로도<br> 바로 전송 가능합니다</h4>
					<h5>자료 전송하기</h5>
					<a href="javascript:go_kakao();"  class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
				<li class="letter">
					<img src="resources/images/benefit04.png">
					<h3>맞춤정보 제공 </h3>
					<h4>카톡, 양도세, 문자로 증여세, 상속세 등<br> 유용한 정보를 무료로 제공해드립니다. </h4>
					<input type="tel" name="NEW_HP3" id="NEW_HP3" placeholder="핸드폰번호를 입력해주세요"
						onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
					<button type="button" name="action3" id="action3">세무소식 무료 구독신청</button>
				</li>
			</ul>
		</section>

		<section class="anywhere">
			<h1>전국 어디에서나 쉽고 빠르고 정확하게 </h1>
			<h2>세무톡은 방문하지 않으셔도 전문적인 세무업무가 가능합니다<br>
				지역에 상관없이 편하게 상담받아보세요.
				<img src="resources/images/anywhereImg.png">
			</h2>
		</section>

		<section class="column">
			<div>
				<p></p>
				<h1>절세꿀팁</h1>
				<!--<a href="" class="more"></a>-->
			</div>
			<ul>
<?php
include "../db_info.php";


$QUERY = "SELECT * FROM (
SELECT *,LEFT(REGEXP_REPLACE(CONTENTS_, '<[^>]+>',''),100) AS CONTENTS_1 , date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS 
WHERE VISIBLE='Y' LIMIT 20
) AS A 
ORDER BY RAND() DESC  LIMIT 0, 3;";

$QUERY2 = "SELECT * FROM (
SELECT *,LEFT(REGEXP_REPLACE(CONTENTS_, '<[^>]+>',''),100) AS CONTENTS_1 , date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS 
WHERE VISIBLE='Y' AND CATE = 'QNA' LIMIT 20 
) AS A 
ORDER BY RAND() DESC  LIMIT 0, 3;";


$result = @mysqli_query($connect,$QUERY) or die("SQL error");

while ($row = mysqli_fetch_array($result)) {

?>
				<li>
					<a href="sub_newsview.php?id=<?php echo $row["ID"]?>">
					<h2><?PHP echo mb_strimwidth($row["SUBJECT"],'0','35','...','utf-8')?></h2>
					<h3><?PHP ECHO mb_strimwidth($row["CONTENTS_1"],'0','170','...','utf-8')?></h3>
					<!--h4>#창업 #절세 #창업세무 #권리금</h4-->
					<span></span>
					</a>
				</li>
<?php
}
?>
				
			</ul>
		</section>

		<section class="counseling">
			<div>
				<p></p>
				<h1>상담사례</h1>
				<!--<a href="" class="more"></a>-->
			</div>
			<ul>
				<?php

$result2 = @mysqli_query($connect,$QUERY2) or die("SQL error");

while ($row = mysqli_fetch_array($result2)) {

?>
				<li>
					<a href="sub_newsview.php?id=<?php echo $row["ID"]?>">
					<h2><?PHP echo mb_strimwidth($row["SUBJECT"],'0','30','...','utf-8')?> </h2>
					<h3><?PHP ECHO mb_strimwidth($row["CONTENTS_1"],'0','170','...','utf-8')?></h3>
					<!--h4>#상속세 #사망보험금</h4-->
					<span></span>
					</a>
				</li>
<?php
}
?>
			</ul>
		</section>

		<script>
			$('.counseling ul li,.column ul li').each(function () {

				var textQ = $(this).children('h2').html();
				var textA = $(this).children('h3').html();
				var textTag = $(this).children('h4').html();

				if ($(this).closest('section').hasClass('counseling')) {
					$(this).children('h3').html((textA.substring(0, 40) + "..."));
				}
				if ($(this).closest('section').hasClass('column')) {
					$(this).children('h3').html((textA.substring(0, 40) + "..."));
				}

				$(this).click(function () {
					$(".mask").fadeIn();
					$(".counselingPop").fadeIn();
					$('.counselingPop h1').html(textQ);
					$('.counselingPop h2').html(textA);
					$('.counselingPop h3').html(textTag);

					if ($(this).closest('section').hasClass('column')) {
						$('.counselingPop').find('span').css("display", "none");
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

		<section class="best">
			<h1>지금까지 이런 서비스는 없었다</h1>
			<h2>사용자가 써보고 놀란 세무톡 스마트 세무회계 서비스 BEST 5</h2>

			<div class="review-main02 slider" data-sizes=" 50vw">
				<div class="contents">
					<img src="resources/images/bestbg01.png" style="left:50px; top:50px;">
					<ul>
						<h5><span>381</span><span>명 사용자 추천</span></h5>
						<h3>가입없이 클릭 한번으로 가능한</h3>
						<h4>실시간 세무 채팅상담</h4>
						<li>친절한 세무 채팅 상담 지원 </li>
						<li>빠른 상담이 가능한 챗봇 시스템 </li>
						<div class="label">
							<span>1</span><strong>BEST</strong>
						</div>
					</ul>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/bestbg02.png" style="left:50px; top:50px;">
					<ul>
						<h5><span>295</span><span>명 사용자 추천</span></h5>
						<h3>이메일이나 팩스가 아닌 <br>스마트폰으로 바로 보낼 수 있는 </h3>
						<h4>편리한 증빙자료 전송</h4>
						<li>컴퓨터에서 채팅창에 파일 전송 가능 </li>
						<li>스마트폰에서 바로 촬영 전송 가능 </li>
						<div class="label">
							<span>2</span><strong>BEST</strong>
						</div>
					</ul>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/bestbg03.png" style="left:20px; top:50px;">
					<ul>
						<h5><span>263</span><span>명 사용자 추천</span></h5>
						<h3>로그인 하지 않아도 스마트폰으로 안내되는</h3>
						<h4>진행사항 자동 알림</h4>
						<li>카톡, SMS를 통해 세무업무 </li>
						<li>처리단계별 친절하게 자동 안내 </li>
						<div class="label">
							<span>3</span><strong>BEST</strong>
						</div>
					</ul>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/bestbg05.png" style="left:50px; top:50px;">
					<ul>
						<h5><span>194</span><span>명 사용자 추천</span></h5>
						<h3>세무 & 맞춤뉴스가 매달 정기적으로 제공되는</h3>
						<h4>모바일 뉴스레터</h4>
						<li>세무, 노무, 법률, 경영, 정책 등 사업에 도움을 드리는 맞춤정보 제공 </li>
						<div class="label">
							<span>4</span><strong>BEST</strong>
						</div>
					</ul>
					<a></a>
				</div>
			</div>

		</section>

		<section class="people">
			<div>
				<h1>세무톡은 국세청 33년 경력 믿고 맡길 수 있는 신승세무법인의 스마트 세무회계 서비스 브랜드입니다</h1>
				<h2>세무회계 전문가 자세히 보기</h2>
				<a href="sub_member.php"></a>
			</div>
		</section>

		<section class="transfertax">

			<div class="title">
				<h1>양도소득세 상담 및 신고 프로세스</h1>
				<h2>양도소득세란 부동산 등 자산의 양도에 따라 발생한 소득에 과세되는 세금입니다.<br> 부동산을 양도한 경우 양도소득세 납세의무자는 양도일이 속하는 달의 말일부터 2개월 이내에
					주소지 관할세무서에 양도소득세를 예정 신고ㆍ납부하여야 합니다.</h2>
				<h2>양도소득세는 부동산 경기나 국가 경제적 상황에 따라 자주 세법이 개정되고, 양도인의 재산보유현황 및 소재지, 취득시기,
					취득방법 등에 따라 산출세액이 크게 달라질 수 있어<span>수임사례가 월등히 많은 저희 신승세무법인이라면 믿고 맡기실 수 있습니다.</span></h2>
			</div>

			<ul>
				<li>
					<p></p><i></i>
					<div>
						<h2>온라인 / 전화 접수 계약금 입금요청</h2>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<div>
						<h2>1 : 1 전담 전문 세무사 배정</h2>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<a><span>안내<br>알림</span></a>
					<div>
						<h3>기초 세무 상담 준비 자료 접수 </h3>
						<h4>기초 세무 상담 및 절차 적합성 검토</h4>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<div>
						<h3>대상 자산 및 기초 현황분석 </h3>
						<h4>자료 검토 및 대상 자산 분석</h4>
					</div>
				</li>

				<li>
					<p></p><i></i>
					<a><span>안내<br>알림</span></a>
					<div>
						<h3>절세방안 / 대안 검토</h3>
						<h4>다양한 사례 적용 절세방안 검토</h4>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<div>
						<h2>세액 1차 산출</h2>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<a><span>안내<br>알림</span></a>
					<div>
						<h3>예상 세액 안내 추가 자료 요청</h3>
						<h4>쉽게 설명드리는 재산제세 계산 근거</h4>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<div>
						<h2>세액 1차 조정</h2>
					</div>
				</li>

				<li>
					<p></p><i></i>
					<div>
						<h3>사례별 시뮬레이션 추가 절세방안 모색</h3>
						<h4>시뮬레이션을 통한 효과적인 절세방안 모색</h4>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<div>
						<h3>전담팀 2차 세액 산출</h3>
						<h4>5인 전담팀 의견 및 팀회의를 통한 절세방안 극대화</h4>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<a><span>안내<br>알림</span></a>
					<div>
						<h3>예상 세액 안내 추가 자료 요청</h3>
						<h4>쉽게 설명드리는 재산제세 계산 근거</h4>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<a><span>안내<br>알림</span></a>
					<div>
						<h2>세액 산정완료 잔금 입금요청</h2>
					</div>
				</li>

				<li>
					<p></p><i></i>
					<div>
						<h2>잔금 입금확인</h2>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<div>
						<h2>세무서 신고</h2>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<a><span>안내<br>알림</span></a>
					<div>
						<h3>신고서 / 납부서 전송<br>산출세액 및 자료 전달</h3>
					</div>
				</li>
				<li>
					<p></p><i></i>
					<div>
						<h3>사후 관리 지원</h3>
						<h4>자산 구성에 따른 단기, 중기 절세전략 안내</h4>
					</div>
				</li>
			</ul>

			<div class="box">
				<h1>서비스 제공내역</h1>
				<ul>
					<li>전담 전문 세무사 1:1 배정</li>
					<li>양도세 관련 친절 상담</li>
					<li>편리한 증빙자료 전송 및 보관</li>
					<li>세액 1차 산출 및 조정 협의</li>
					<li>전담팀 2차 산출 및 조정 협의</li>
					<li>처리 단계별 실시간 알림 서비스</li>
					<li>산출세액 및 산출조정자료 전달</li>
					<li>신고서 및 납부서 전송 및 보관</li>
					<li>사후관리 지원</li>
				</ul>
			</div>
		</section>

		<section class="difference">
			<h1>전문가는 뭐가 달라도 확실히 다릅니다</h1>
			<h2>번거롭고, 복잡한 양도소득세 세무톡이 알아서 다 해드릴께요</h2>
			<ul>
				<li>
					<h3><span><img src="resources/images/difference01.png"></span><span>압도적인 수임 사례</span></h3>
					<h4>양도소득세관련 수많은 상담 및 다양한 사례 <br>수임으로 전문성을 갖추고 있어 믿을 수 있습니다</h4>
				</li>
				<li>
					<h3><span><img src="resources/images/difference02.png"></span><span>사전 절세컨설팅 지원</span></h3>
					<h4>양도, 증여, 상속관련 합법적인 절세 극대화방안은 <br>전문 세무사와 사전에 충분히 상담하시는 것입니다</h4>
				</li>
				<li>
					<h3><span><img src="resources/images/difference03.png"></span><span>전문세무사 전담 배정 </span></h3>
					<h4>양도세, 증여세, 상속세별 최적의 세무전문가를 <br>전담으로 배정하여 면밀하게 절세방안을 수립합니다</h4>
				</li>
				<li>
					<h3><span><img src="resources/images/difference04.png"></span><span>전담팀 2차 절세방안 검토 </span></h3>
					<h4>1차 산출세액을 기초로 전담팀이 구성되어 면밀하게 <br>검토하여 2차 절세방안을 극대화합니다</h4>
				</li>
				<li>
					<h3><span><img src="resources/images/difference05.png"></span><span>실시간 알림 서비스 </span></h3>
					<h4>처리 단계별 예상 납부세액도 절세방안도 그때 그때 알려드립니다</h4>
				</li>
			</ul>
		</section>
		<section class="catalogue">
			<ul>
				<li>1세대 1주택 비과세
					<a href="https://sostax.cn/down/양도소득세_1세대1주택_비과세_001_200331.pdf">1세대 개념 PDF <img src="resources/images/downIcon.png"></a>
					<a href="https://sostax.cn/down/양도소득세_1세대1주택_비과세_002_200331.pdf">주택의 개념 PDF <img src="resources/images/downIcon.png"></a>
					<a href="https://sostax.cn/down/양도소득세_1세대1주택_비과세_003_200331.pdf"> 비과세 조건 PDF  <img src="resources/images/downIcon.png"></a>
					<a href="https://sostax.cn/down/양도소득세_1세대1주택_비과세_004_200331.pdf">1세대 1주택특례 PDF <img src="resources/images/downIcon.png"></a>
				</li>
			</ul>
		</section>

<?php include("bottom.php");?>

