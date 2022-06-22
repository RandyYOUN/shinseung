		<?php include_once 'top.php'; ?>

		<section id="promotionBanner" class="popup">
				<div class="popContents">
					<a href="javascript:kakao();">
					<h1>혼자서 세금신고 하시려면 힘드시죠? </h1>
					<h2>신승이 알아서 해드립니다</h2>
					<h3>CLICK</h3>
					</a>
					<input type="checkbox" value="checkbox" name="chkbox" id="chkday"  onClick="javascript:closeWinAt00('popContents', 1);" /><label for="chkday">오늘 하루 그만보기
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

		<section class="kakaoLink">
        <div>
            <a href="javascript:kakaoClose();" class="close"></a>
            <h1>카카오톡 상담하기</h1>
            <h2>상담분야를 선택해주세요</h2>
            <ul>
                <li>
                    <a href="javascript:window.open('http://pf.kakao.com/_eLLxkT/chat');">기장/신고</a>
                    <dl>
                        <dd>세무 기장 문의</dd>
                        <dd>종합소득세 신고문의</dd>
                        <dd>부가가치세 신고문의</dd>
                        <dd>법인세 신고문의</dd>
                    </dl>
                </li>
                <li>
                    <a href="javascript:window.open('http://pf.kakao.com/_xmxjIHK/chat');">절세컨설팅</a>
                    <dl>
                        <dd>양도세 상담 및 신고</dd>
                        <dd>상속세 상담 및 신고</dd>
                        <dd>증여세 상담 및 신고</dd>
                        <dd>세무조사 및 조세불복</dd>
                    </dl>
                </li>
            </ul>
        </div>
    </section>

		<script>
			//카카오톡 레이어팝업
			function kakao () {
				var win_W = $(window).width();
				var win_H = $(window).height();
				var pop_W = $(".kakaoLink").width();
				var pop_H = $(".kakaoLink").height();
				$(".kakaoLink").css({'left':(win_W-pop_W)/2, 'top':(win_H-pop_H)/2});

				$(".mask").fadeIn();
				$(".mask").css("z-index","888");
				$(".kakaoLink").fadeIn();
			}

			function kakaoClose(){
				$(".mask").css("display","none");
				$(".kakaoLink").css("display","none");
			}
		</script>

		<header>			
			<section class="navi">
				<a href="index.php">
					<h1>신승세무법인 안양</h1>
				</a>
				<?php include_once 'navi.php'; ?>
			</section>

			<section class="mainVisual">
				<ul>
					<li><img src="resources/images/mainVisual01.png">
						<div>
							<h2>국세청 33년 경력</h2>
							<h3>세무 과목별 전문 세무사의 섬세한 진단과 세무처리</h3>
						</div>
					</li>
					<li><img src="resources/images/mainVisual02.png">
						<div>
							<h2>쉽고 편한 세무상담센터</h2>
							<h3>언제 어디서나 클릭 한번으로 연결되는 스마트한 세무상담센터</h3>
						</div>
					</li>
					<li><img src="resources/images/mainVisual03.png">
						<div>
							<h2>20년간 축적된 세무 전문노하우</h2>
							<h3>믿고 맡길 수 있는 세무 전문가 그룹</h3>
						</div>
					</li>
					<li><img src="resources/images/mainVisual04.png">
						<div>
							<h2>수도권 15개 지점</h2>
							<h3>지역 밀착 & 맞춤 세무 서비스 지원</h3>
						</div>
					</li>
				</ul>
			</section>
			<section class="mainVlink">
				<ul>
					<a href="javascript:window.open('http://pf.kakao.com/_eLLxkT/chat');">
						<li><img src="resources/images/mainVlink01.png"><span>세무 상담센터</span></li>
					</a>
					<a href="sub_tax.php">
						<li><img src="resources/images/mainVlink02.png"><span>스마트 세무기장</span></li>
					</a>
					<a href="sub_tax.php">
						<li><img src="resources/images/mainVlink03.png"><span>종합소득세 / 부가세신고</span></li>
					</a>
					<a href="sub_consulting.php">
						<li><img src="resources/images/mainVlink04.png"><span>양도 / 증여 / 상속세</span></li>
					</a>
					<a href="sub_investigation.php">
						<li><img src="resources/images/mainVlink05.png"><span>세무조사 / 조세불복</span></li>
					</a>
				</ul>
			</section>
		</header>

		<section class="taxtSchedul">
			<h2><span>세무 주요일정</span><!-- <a href="" class="more"></a> -->
			</h2>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					
<?php
include "db_info.php";


$QUERY3 = "
SELECT date_format(TAXDATE,'%m') as  'DATE_m' ,
date_format(TAXDATE,'%d') as  'DATE_d' , CONTENT
FROM SS_TAXDATE 
WHERE VISIBLE = 'Y'
AND date_format(TAXDATE,'%m') = date_format(NOW(),'%m');";


$result3 = @mysqli_query($connect,$QUERY3) or die("SQL error");

while ($row = mysqli_fetch_array($result3)) {
?>
				
					<div class="swiper-slide scheduleDiv">
						<h3><?php echo $row["DATE_m"]?>.<?php echo $row["DATE_d"]?></h3>
						<h4><?php echo $row["CONTENT"]?> </h4>
						<!--h5><span>대상</span><strong>2019.7~9월분</strong></h5-->
						<a href="/sub_news.php?cate=SCH"></a>
					</div>
<?php
}
?>


				</div>
				<!-- <div class="swiper-pagination"></div> -->
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
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

		<section class="column">
			<div>
				<p></p>
				<h1>절세꿀팁</h1>
				<!--<a href="" class="more"></a>-->
			</div>
			<ul>
<?php



$QUERY = "SELECT * FROM (
SELECT *,LEFT(REGEXP_REPLACE(CONTENTS_, '<[^>]+>',''),200) AS CONTENTS_1, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS 
WHERE VISIBLE='Y' LIMIT 20
) AS A 
ORDER BY rand() DESC  LIMIT 0, 3 ;

";

$result = @mysqli_query($connect,$QUERY) or die("SQL error");

while ($row = mysqli_fetch_array($result)) {

?>
				<li>
					<a href="../sub_newsview.php?id=<?php echo $row["ID"]?>">
					<h2><?PHP echo mb_strimwidth($row["SUBJECT"],'0','28','...','utf-8')?></h2>
					<h3><?PHP ECHO mb_strimwidth($row["CONTENTS_1"],'0','160','...','utf-8')?></h3>
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

$result2 = @mysqli_query($connect,$QUERY) or die("SQL error");

while ($row = mysqli_fetch_array($result2)) {

?>
				<li>
					<a href="../sub_newsview.php?id=<?php echo $row["ID"]?>">
					<h2><?PHP echo mb_strimwidth($row["SUBJECT"],'0','24','...','utf-8')?> </h2>
					<h3><?PHP ECHO mb_strimwidth($row["CONTENTS_1"],'0','145','...','utf-8')?></h3>
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
					$(this).children('h3').html((textA.substring(0, 75) + "..."));
				}
				if ($(this).closest('section').hasClass('column')) {
					$(this).children('h3').html((textA.substring(0, 66) + "..."));
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

		<section class="review">
			<div class="title">
				<h1>REVIEW</h1>
				<h2>함께 성장하는 고객님들의 진솔한 이야기를 나눕니다</h2>
			</div>

			<div class="review-con">
				<div class="review-main slider" data-sizes="50vw">
					<div>
						<img src="resources/images/reviewMain01.png">
					</div>
					<div>
						<img src="resources/images/reviewMain03.png">
					</div>
					<div>
						<img src="resources/images/reviewMain06.png">
					</div>
					<div>
						<img src="resources/images/reviewMain010.png">
					</div>
					<div>
						<img src="resources/images/reviewMain05.png">
					</div>
					<div>
						<img src="resources/images/reviewMain07.png">
					</div>
					<div>
						<img src="resources/images/reviewMain08.png">
					</div>
					<div>
						<img src="resources/images/reviewMain04.png">
					</div>
					<div>
						<img src="resources/images/reviewMain02.png">
					</div>
					<div>
						<img src="resources/images/reviewMain09.png">
					</div>
				</div>

				<div class="review-text slider">
					<div>
						<h1>건설업 / 조*훈 대표님</h1>
						<h3>사업에만 전념할 수 있어 감사해요</h3>
						<h4>영수증, 기부금내역 등 그때그때 찍어만 주면 알아서 해주시니 마음도 편하고, 손도 편하고, 세무 신경을 딱 끊어도 되니 너무 편해요.</h4>
					</div>
					<div>
						<h1>어학원 / 김*현 강사님</h1>
						<h3>지인분들께도 추천드렸어요</h3>
						<h4>저렴한 수수료에 친절하고 빠른 답변까지 게다가 일처리도 신속해서 정말 맘에 쏙 들어요.</h4>
					</div>
					<div>
						<h1>도소매업 / 최*일 대표님</h1>
						<h3>세무 때문에 더 이상 고민하지 않아요</h3>
						<h4>세무 신경 쓸 여력이 없었는데, 친절하게 하나하나 알려주시고,꼼꼼히 챙겨주시니 세무업무 다 맡겨놓고 있어요.</h4>
					</div>
					<div>
						<h1>프리랜서 / 차*철 고객님</h1>
						<h3>세번 놀라게 하는 신승세무법인</h3>
						<h4>저렴한수수료에 한번 놀라고 문의사항에 친절하고 빠른 답변에 두번 놀라고 신속한 일처리에 세번 놀랐습니다</h4>
					</div>
					<div>
						<h1>도소매업 / 최*일 대표님</h1>
						<h3>세무 때문에 더 이상 고민하지 않아요</h3>
						<h4>세무 신경 쓸 여력이 없었는데, 친절하게 하나하나 알려주시고,꼼꼼히 챙겨주시니 세무업무 다 맡겨놓고 있어요.</h4>
					</div>
					<div>
						<h1>복합운송업 / 김*경 이사님</h1>
						<h3>전문성이 높고 경험이 많아 안심이 되요</h3>
						<h4>국세청 33년 경력에 세무법인 설립 20년 많은 세무전문가분이 책임져주시니 정말 안심하고 사업하고 있어요.</h4>
					</div>
					<div>
						<h1>제조업 / 정*나 대표님</h1>
						<h3>믿고 맡길 수 있어서 좋아요</h3>
						<h4>그때 그때 궁금한 것이 있을때 마다 연락하면 늘 친절하게 답변해주시고 세무 뿐만 아니라 노무까지 하나하나 관리해주시니 복잡한 세무 신경 쓸 필요없이 맘편히 믿고
							맡기고 있어요. </h4>
					</div>
					<div>
						<h1>카페 / 정*웅 사장님</h1>
						<h3>가게하는 분들께 강추합니다</h3>
						<h4>늘 바쁘다 보니 번거로운 세무업무는 정말 손이 안가더라구요. 그런데 이곳에 일을 맡기고부터는 정말 편해졌어요.</h4>
					</div>
					<div>
						<h1>미용실 / 임*녕 원장님</h1>
						<h3>알아서 착착 다 해주니 정말 편해요</h3>
						<h4>일일이 말하거나 입력할 필요 없이 종이 증빙만 찍어 주면 기장부터 신고까지 다 알아서 해주니 이렇게 편할 수가 없어요.</h4>
					</div>
					<div>
						<h1>부동산업 / 홍*범 고객님</h1>
						<h3>세금이 대폭 축소되는 신승세무법인</h3>
						<h4>처음으로 세무신고를 신승세무법인에 의뢰하였는데 생각보다 쉽고 간단하게 제출 작성이 가능했던 것 같았으며 무엇보다 세금이 이렇게나 대폭 축소할수 있는 기법에 놀라움을 금치 못하였습니다.</h4>
					</div>
				</div>

				<div class="review-sub slider">
					<div>
						<img src="resources/images/review01.png">
					</div>
					<div>
						<img src="resources/images/review03.png">
					</div>
					<div>
						<img src="resources/images/review06.png">
					</div>
					<div>
						<img src="resources/images/review010.png">
					</div>
					<div>
						<img src="resources/images/review05.png">
					</div>
					<div>
						<img src="resources/images/review07.png">
					</div>
					<div>
						<img src="resources/images/review08.png">
					</div>
					<div>
						<img src="resources/images/review04.png">
					</div>
					<div>
						<img src="resources/images/review02.png">
					</div>
					<div>
						<img src="resources/images/review09.png">
					</div>
				</div>
			</div>

		</section>

		<section class="company">
			<p></p>
			<div>
				<img src="resources/images/mbc.png">
				<h2><strong>사업에만 전념하세요</strong><br>신승세무법인이 함께 합니다</h2>
				<h3>신승세무법인은 기장대리, 세무조정, 양도소득세, 상속세, 증여세신고, 세무관련 문제에 대한 컨설팅, 세무조사대행, 심판청구 등 불복청구, 기업진단 업무 등 분야별로 전문성을 살려
					고객에게 충분한 세무서비스를 제공하고 있습니다.</h3>
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
					<li style="border-color: tomato;">안양지점<span>MAP</span></li>
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
			<a class="chat"><span>채팅상담</span></a>
			<!--<a class="call"><span>전화상담</span></a>-->
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

			var locationChatclear = function () {
				$(".locationPop").find('.chat').css("display", "none");
			}

			var Location = function () {
				$(".locationCon").find('li').each(function () {
					$(this).on("click", function () {

						//초기화
						$('.locationPop h1, .locationPop h2').html('');
						$(".locationPop").find('.chat').css("display", "block");

						//버튼값 불러오기
						var linkName = $(this).text().replace(/[a-z]/gi, '');

						var locationTitle = ['지점', '주소', '위치', '주차', 'tel', 'fax', 'mail'];

						switch (linkName) {
							case "강남본사":
								locationContents = ["강남본사", "서울시 강남구 테헤란로 114 (역삼동) 역삼빌딩 14층", "2호선 강남역 1번 출구 역삼세무서 맞은편", "센트럴프루지오시티 지하 주차 가능 (무료)", "02-3452-0608", "02-3452-0866", "ss1@sostax.co.kr"]
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
								locationContents = ["기흥지점", "경기도 용인시 기흥구 흥덕2로117번길 15", "기흥세무서 건물내 1층 (무료)", "건물내 지하주차", "031-211-0608", "031-213-0688", "ss9@sostax.co.kr"]
								$(".locationPop").find('.chat').attr("href","javascript:go_kakao('기흥');");
								break;

							case "일산지점":
								locationContents = ["일산지점", "경기도 고양시 일산동구 중앙로 1305-30 일산마이다스오피스텔 112호", "3호선 정발산역 2번 출구 고양세무서 맞은편", "일산마이다스빌딩 지하 주차 가능 (주차권 제공)", "031-932-0863", "031-932-0869", "ss5@sostax.co.kr"]
								$(".locationPop").find('.chat').attr("href","javascript:go_kakao('일산');");
								break;

							case "신사지점":
								locationContents = ["신사지점", "서울시 강남구 강남대로 150길 9 삼우빌딩 203호", "신사역 3번출구 신한은행 뒷건물", "건물 1층 지상주차장 (30분 무료제공)", "02-569-5596", "02-6442-5501", "5695596@hanmail.net"]
								locationChatclear();
								break;

							case "용산지점":
								locationContents = ["용산지점", "서울시 용산구 서빙고로24길16 1층", "용산세무서 맞은편", "용산세무서 이용", "02-3785-2243", "02-3785-2248", "ssin2243@hanmail.net"]
								locationChatclear();
								break;

							case "안산지점":
								locationContents = ["안산지점", "경기도 안산시 단원구 화랑로358 (고잔동) 110호", "안산세무서 후문 맞은편 1층", "안산세무서 주차 가능 (무료)", "031-405-9415,9425", "031-405-9421", "asshinseung@hanmail.net"]
								locationChatclear();
								break;

							case "안산법원지점":
								locationContents = ["안산법원지점", "경기도 안산시 광덕서로86, 122호(고잔동,안산법조타운)", "수원지방법원안산지원 맞은편", "안산법조타운 지하 주차 가능 (최대 3시간 주차권 지급)", "031-508-3636", "031-508-3638", "ssbeopwon@hanmil.net"]
								locationChatclear();
								break;

							case "시흥지점":
								locationContents = ["시흥지점", "경기도 시흥시 비둘기공원7길 51, 대명프라자 301호", "시흥세무서 대야동민원실 맞은편", "대명프라자 건물 내 기계식 주차장 이용 (무료)", "031-311-3360", "031-311-5942", "ss3360@hanmail.net"]
								locationChatclear();
								break;

							case "시흥정왕지점":
								locationContents = ["시흥정왕지점", "경기도 시흥시 봉우재로 23-29 ,101호(정왕동)", "정왕보건지소 맞은편", "정왕보건지소 주차가능 (무료)", "031-432-9415-7", "031-432-9418", "ss4919@hanmail.net"]
								locationChatclear();
								break;
						}

						//팝업오픈
						$(".mask").fadeIn();
						$(".locationPop").fadeIn();

						$(".locationPop").find('h1').append(locationContents[0] + '<span>신승세무법인</span>');
						for (i = 0; i < locationTitle.length; i++) {
							$(".locationPop").find('h2').append('<li><strong>' + locationTitle[i] + '</strong><span>' + locationContents[i] + '</span></li>');
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
					<!--li class="tabBlock-tab">
						<span><strong>양도/증여전문</strong>이명진</span>
						<span><strong>양도/증여전문</strong>김진규</span>						
					</li>
					<li class="tabBlock-tab">						
						<span><strong>양도/증여전문</strong>한성민</span>
						<span><strong>양도/증여전문</strong>한은진</span>
					</li-->
				</ul>

				<div class="tabBlock-content">
					
					<!--tabBlock-pane-->

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
								<li><strong>세무회계 컨설팅 20년</strong></li>
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
					</div>
					<!--tabBlock-pane-->

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
					</div>
					<!--tabBlock-pane-->

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
					</div>
					<!--tabBlock-pane-->

					
				</div>
				<!--tabBlock-content-->
			</div>
			<!--tabBlock-->
		</section>

		<section class="allpeople">
			<div>
				<h1>복잡한 세무업무를 알아서 해드립니다</h1>
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

		<section class="medi">
			<a href="http://medi-tax.kr" target="_blank"><img src="resources/images/medi.png"></a>
		</section>

		<section class="catalogue">
			<ul>
				<li>신승세무법인 브로셔
					<a href="">PDF 다운로드 <img src="resources/images/downIcon.png"></a>
				</li>
				<li>절세칼럼 & 상담사례집
					<a href="">PDF 다운로드 <img src="resources/images/downIcon.png"></a>
				</li>
				<li>신승차이나 브로셔
					<a href="https://sostax.cn/down/shinseung_consulting_group_ver_1.0.0.pdf">국문 PDF 다운로드 <img
							src="resources/images/downIcon.png"></a>
					<a href="https://sostax.cn/down/shinseung_consulting_group_ver_old_kor.pdf">중문 PDF 다운로드 <img
							src="resources/images/downIcon.png"></a>
					<a style="visibility:hidden;;"  href="https://sostax.cn/down/shinseung_consulting_group_ver_old_kor.pdf">중문 PDF 다운로드 <img 
							src="resources/images/downIcon.png"></a>
					<a style="visibility:hidden;" href="https://sostax.cn/down/shinseung_consulting_group_ver_old_kor.pdf">중문 PDF 다운로드 <img src="resources/images/downIcon.png"></a>
				</li>
				<li>1세대 1주택 비과세
					<a href="https://sostax.cn/down/양도소득세_1세대1주택_비과세_001_200331.pdf">PDF 다운로드 <img src="resources/images/downIcon.png"></a>
					<a href="https://sostax.cn/down/양도소득세_1세대1주택_비과세_002_200331.pdf">PDF 다운로드 <img src="resources/images/downIcon.png"></a>
					<a href="https://sostax.cn/down/양도소득세_1세대1주택_비과세_003_200331.pdf">PDF 다운로드 <img src="resources/images/downIcon.png"></a>
					<a href="https://sostax.cn/down/양도소득세_1세대1주택_비과세_004_200331.pdf">PDF 다운로드 <img src="resources/images/downIcon.png"></a>
				</li>
			</ul>
		</section>



<?php include_once 'bottom.php'; ?>