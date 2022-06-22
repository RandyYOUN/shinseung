<?php include("top.php");?>

		<section id="promotionBanner" class="popup">
				<div class="popContents">
					<h2>상속보다 증여 - 성급히 판단하지 마시고 전문가의 상담을 받아보세요</h2>
					<h3>CLICK</h3>
					<input type="checkbox" value="checkbox" name="chkbox" id="chkday" onClick="javascript:closeWinAt00('popContents', 1);" /><label for="chkday">오늘 하루 그만보기
					</label>
					<a href="#none" class="btnclose"></a>
				</div>
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

					var mainchange = $('.difference').offset().top;

					if ($(this).scrollTop() > mainchange) {
						TweenLite.to('.mainnavi', 0.1, { css: { background: "#fff", position: "fixed", width: "100%", paddingTop: "0px", boxShadow: "-1px -2px 9px rgba(230,230,230,.9)" } });
						TweenLite.to('.mainnavi div ul a li', 0, { css: { color: "#333" } });
						TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/sublogo.png)',color: "#194581" });
					}
					else {
						TweenLite.to('.mainnavi', 0, { css: { background: "none", position: "absolute", paddingTop: "30px", boxShadow: "none" } });
						TweenLite.to('.mainnavi ul a li', 0, { css: { color: "#fff" } });
						TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/logo.png)',color: "#fff"  });
					}
				});

				$(function () {
					$('#myVideo').get(0).load();
					$('#myVideo').get(0).play();

				});

			</script>	
			
			<video muted loop id="myVideo">
				<source src="resources/images/video_yhy03.mp4" type="video/mp4">
				</source>
			</video>
			<div class="mainblack"></div>

			<section class="mainVisual">
				<div>
					<h1>국세청 경력 41년</h1>
					<h2>국세공무원 교육원 상속세, 증여세법 교수 역임</h2>
					<h3>최고의 전문가 양해운 세무사에게 직접 문의하세요</h3>
					<ul>
						<h4><span>양해운 세무사 이력</span><span></span></h4>
						<li>
							<span>국세공무원 교육원 상속세, 증여세법 교수 역임</span>
							<span>국세청 재산제세 분야 26년 근무</span>
							<span>국세청 법규과 법령 해석 담당</span>
						</li>
						<li>
							<span>국세청 재산세과 기획 담당</span>
							<span>국세청 심사1과 불복심리 담당</span>
							<span>증여세, 양도소득세, 상속세 법령해석</span>
						</li>
						<li>
							<span>1세대 1주택 비과세 검증프로그램 개발 (국세청)</span>
							<span>일선 세무서 재산세과 실무 담당</span>
						</li>
					</ul>
					<ul>
						<h4><span>양해운 세무사 저서</span><span></span></h4>
						<li>
							<span>증여세, 양도세, 상속세 세법집행기준 발간 (국세청)</span>
							<span>비사업용 토지에 대한 가이드북 발간 (국세청)</span>
						</li>
						<li>
							<span>비사업용 토지의 세무실무 발간 (2009년)</span>
							<span>양도소득세 법령 해석 발간 (2015년, 2016년 개정판)</span>
						</li>
					</ul>
				</div>
			</section>
		</header>

		<section class="difference">
			<h1>전문가는 뭐가 달라도 확실히 다릅니다</h1>
			<h2>번거롭고, 복잡한 증여세 세무톡이 알아서 다 해드릴께요</h2>
			<ul>
				<li>
					<h3><span><img src="resources/images/difference01.png"></span><span>압도적인 수임 사례</span></h3>
					<h4>증여세 관련 수많은 상담 및 다양한 사례 수임으로 전문성을 갖추고 있어 믿을 수 있습니다</h4>
				</li>
				<li>
					<h3><span><img src="resources/images/difference02.png"></span><span>사전 절세컨설팅 지원</span></h3>
					<h4>증여, 양도, 상속 관련 합법적인 절세 극대화방안은 전문 세무사와 사전에 충분히 상담하시는 것입니다</h4>
				</li>
				<li>
					<h3><span><img src="resources/images/difference03.png"></span><span>전문세무사 전담 배정 </span></h3>
					<h4>증여세, 양도세, 상속세별 최적의 세무전문가를 전담으로 배정하여 면밀하게 절세방안을 수립합니다</h4>
				</li>
				<li>
					<h3><span><img src="resources/images/difference04.png"></span><span>전담팀 2차 절세방안 검토 </span></h3>
					<h4>1차 산출세액을 기초로 전담팀이 구성되어 면밀하게 검토하여 2차 절세방안을 극대화합니다</h4>
				</li>
				<li>
					<h3><span><img src="resources/images/difference05.png"></span><span>실시간 알림 서비스 </span></h3>
					<h4>처리 단계별 예상 납부세액도 절세방안도 그때 그때 알려드립니다</h4>
				</li>
			</ul>
		</section>

		<section class="transfertax">

			<div class="title">
				<h1>증여세 상담 및 신고 프로세스</h1>
				<h2>증여세란 타인으로부터 재산을 무상으로 받은 경우에 당해 증여재산에 대하여 부과되는 세금을 말합니다. 증여를 받은 사람, 즉 수증자는 증여세 납세의무가 있으므로 증여받은 날이 속하는 달의 말일부터 3개월 이내에 주소지 관할세무서에 증여세를 신고.납부하여야 합니다.</h2>
				<h2>자연인의 사망으로 인하여 피상속인의 소유 재산이 무상으로 이전되는 상속, 유증 및 사인증여의 경우에는 상속세를 부과하고 있으며, 자연인이 사망하기 전에 민법상 증여계약 등을 통하여 무상으로 이전하는 재산에 대해서는 증여세를 부과하고 있습니다. 자연인의 사망으로 인하여 재산의 소유권이 무상 이전되는 경우에만 상속세를 부과한다면 살아있을 때 모든 재산을 무상 이전하여 상속세를 회피할 수 있으므로 이를 방지하기 위하여 상속세에 보완적으로 부과하는 조세가 증여세라 할 수 있습니다.</h2>

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
		</section>



		<section class="link">
			<img src="resources/images/linkpeople.png">
			<div>
				<h1>국세청 33년 경력</h1>
				<h2>복잡한 증여세! 혼자 고민하지 마시고 전문가에게 상담 받아보세요</h2>
				<input type="text" name="NEW_HP1" id="NEW_HP1" placeholder="핸드폰번호를 입력해주세요"
					onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
				<button type="button" name="action1" id="action1">전화상담 요청</button>
				<a href="javascript:ChannelIO('show');">채팅상담</a>
			</div>
		</section>



		<section class="price" style="margin:100px 0 0 0;">
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
					<h2>증여세 </h2>
					<h3>고액 절세액 발생시 추가 수수료 별도 협의 </h3>
					<div>
						<span class="pricebg02">건별</span>
						<span>20</span>
						<span>만원</span>
					</div>
					<a href="sub_price.php"></a>
				</li>
			</ul>
		</section>


		<section class="case">
			<h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
			<h2>이미 많은 고객분들이 세무톡으로 탁월한 절세혜택을 경험하고 계십니다 </h2>
			<section class="case01">
				<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide contents">
								<h3><span>6,800만원</span> 절세 혜택!</h3>
								<h4>증여세 신고 / 주택 </h4>
								<ul>
									<li>증여대상 : 자금출처 증여추정</li>
									<li>증여재산가액 : 4억원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>6,800만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>0만원</strong></p>
								</ul>
								<h5>-6,800만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>2,580만원</span> 절세 혜택!</h3>
								<h4>증여세 신고 / 아파트 </h4>
								<ul>
									<li>증여대상 : 아파트</li>
									<li>증여재산가액 : 5억원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>8,760만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>6,180만원 </strong></p>
								</ul>
								<h5>-2,580만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>1,350만원</span> 절세 혜택!</h3>
								<h4>증여세 신고 / 분양권 </h4>
								<ul>
									<li>증여대상 : 아파트 분양권</li>
									<li>증여재산가액 : 7억 3천만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>4,319만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>2,969만원 </strong></p>
								</ul>
								<h5>-1,350만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>1,283만원</span> 절세 혜택!</h3>
								<h4>증여세 신고 / 주택 </h4>
								<ul>
									<li>증여대상 : 연립주택</li>
									<li>증여재산가액 : 2억 2천만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>1,283만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>0만원</strong></p>
								</ul>
								<h5>-1,283만원 </h5>
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
				<h1>TAX SEMINAR</h1>
				<ul>
					<li id="axNY67zTwUI"><span></span> <span>1세대 1주택 비과세 개념정리</span></li>
					<li id="ox9AWkrzvrQ"><span></span> <span>1세대 1주택 비과세<br>(주택의 개념 및 1주택 판단)</span></li>
					<li id="kH-QIec-zmk"><span></span> <span>1세대 1주택 비과세 조건</span></li>
					<li id="It3DEHwGxqw"><span></span> <span>1세대 1주택 비과세 특례</span></li>
					<li id="W-GXhtRLUSo"><span></span> <span>다주택자 중과세</span></li>
					<li id="CT1YBSWxouM"><span></span> <span>비사업자용 토지</span></li>
					<li id="KEmbShfakIY"><span></span> <span>[핵심요약] 1세대 1주택 비과세</span></li>
					<li id="lZot990sBU0"><span></span> <span>[핵심요약] 1세대 1주택 비과세<br>(1주택 판단)</span></li>
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
					<a href="javascript:ChannelIO('show');"></a>
				</li>
				<li>
					<img src="resources/images/benefit03.png">
					<h3>편리한 자료전송 </h3>
					<h4>이메일이나 팩스가 아닌 스마트폰으로도<br> 바로 전송 가능합니다</h4>
					<h5>자료 전송하기</h5>
					<a href="javascript:ChannelIO('show');"></a>
				</li>
				<li class="letter">
					<img src="resources/images/benefit04.png">
					<h3>맞춤정보 제공 </h3>
					<h4>문자로 증여세, 카톡, 양도세, 상속세 등<br> 유용한 정보를 무료로 제공해드립니다. </h4>
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
include "db_info.php";



$QUERY = "SELECT *,LEFT( fnStripTags(CONTENTS_),100) AS CONTENTS_, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' ORDER BY rand() DESC  LIMIT 0, 3 ;";

$QUERY2 = "SELECT *,LEFT( fnStripTags(CONTENTS_),100) AS CONTENTS_, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' AND CATE = 'QNA' ORDER BY rand() DESC  LIMIT 0, 3 ;";


$result = @mysql_query($QUERY) or die("SQL error");

while ($row = mysql_fetch_array($result)) {

?>
				<li>
					<a href="sub_newsview.php?id=<?php echo $row["ID"]?>">
					<h2><?PHP echo mb_strimwidth($row["SUBJECT"],'0','35','...','utf-8')?></h2>
					<h3><?PHP ECHO mb_strimwidth($row["CONTENTS_"],'0','170','...','utf-8')?></h3>
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

$result2 = @mysql_query($QUERY2) or die("SQL error");

while ($row = mysql_fetch_array($result2)) {

?>
				<li>
					<a href="sub_newsview.php?id=<?php echo $row["ID"]?>">
					<h2><?PHP echo mb_strimwidth($row["SUBJECT"],'0','30','...','utf-8')?> </h2>
					<h3><?PHP ECHO mb_strimwidth($row["CONTENTS_"],'0','150','...','utf-8')?></h3>
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
					//$(this).children('h3').html((textA.substring(0, 100) + "..."));
				}
				if ($(this).closest('section').hasClass('column')) {
					//$(this).children('h3').html((textA.substring(0, 100) + "..."));
				}
/*
				$(this).click(function () {
					$(".mask").fadeIn();
					$(".counselingPop").fadeIn();
					$('.counselingPop h1').html(textQ);
					$('.counselingPop h2').html(textA);
					$('.counselingPop h3').html(textTag);

					
				})*/
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

<?php include("bottom.php");?>

