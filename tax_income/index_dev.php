<?php 
include "session_inc.php";
include("top.php");

?>


	<div class="wrap">
				<section id="promotionBanner" class="popup">
				<div class="popContents">
					<a href="javascript:ChannelIO('show');">
					<h1>종합소득세 신고 고민이신가요? </h1>
					<h2>세무톡에서 간편하게 끝내세요</h2>
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
		</script>

		<header>
			<section class="mainnavi">
				<div>
					<?php include("navi02.php");?>					
				</div>
			</section>

			<video muted loop id="myVideo">
				<source src="resources/images/video.mp4" type="video/mp4">
				</source>
			</video>
			<span id="currentTime">0</span>
			<section class="maintext">
				<div class="slider">
					<div class="maintextBox maintext01">
						<div>
							<h2>방문할 필요없이 세금신고는 기본이고,<br>
								매출 누락까지 꼭 필요한 서비스에요!</h2>
							<h3>카페 / 정*웅 사장님 </h3>
						</div>
					</div>
					<div class="maintextBox maintext02">
						<div>
							<h2>일일이 말하거나 입력할 필요없이 <br>
								기장부터 신고까지 다 알아서 해주니 정말 편해요</h2>
							<h3>미용실 / 임*녕 원장님 </h3>
						</div>
					</div>
					<div class="maintextBox maintext03">
						<div>
							<h2>영수증 그때 그때 찍어만 주면 알아서 해주시니 <br>
								마음도 편하고, 손도 편하고, 너무 편해요</h2>
							<h3>건설업 / 조*훈 대표님 </h3>
						</div>
					</div>
				</div>

			</section>
		</header>
		<script>

			var slider = $('.maintext .slider');

			slider.slick({
				autoplay: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				prevArrow: '',
				nextArrow: '',
				fade: true,
				speed: 1000
			});


			$(".maintext .slider").on("beforeChange", function () {
				TweenMax.fromTo('.maintext h2', 2, { x: 300, opacity: 0 }, { x: 0, opacity: 1, ease: Power4.easeOut });
				TweenMax.fromTo('.maintext h3', 2, { x: 300, opacity: 0 }, { x: 0, opacity: 1, ease: Power4.easeOut });

			});

			$(function () {
				$('#myVideo').get(0).load();
				$('#myVideo').get(0).play();

			});

			setInterval(function () {

				$('#currentTime').text(parseInt($('#myVideo').get(0).currentTime));

				var change = Number(parseInt($('#myVideo').get(0).currentTime));

				if ((change == 12) || (change == 21)) {
					slider.slick('slickNext');
					// $('.maintext h2').css("color", "red");
				}
				else if ((change == 28)) {
					setTimeout(function () {
						slider.slick('slickNext');
					}, 1000);
				}
			}, 1000)

		</script>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
		<section class="number">
			<h1>이미 많은 분들이 세무톡과 함께 하고 있습니다
			</h1>
			<ul>
				<li>
					<span>현재 거래처수</span>
					<span class="counter">7,143</span>
					<span>개</span>
				</li>
				<li>
					<span>누적 거래관리 금액</span>
					<span class="counter">47.2</span>
					<span>조</span>
				</li>
				<li>
					<span>누적 접수문의 수 </span>
					<span class="counter">162,505</span>
					<span>건</span>
				</li>
			</ul>
		</section>
		<section class="price">
			<h1>서비스 가격안내</h1>
			<ul>
				<li>
					<p></p>
					<h2>종합소득세 신고대행</h2>
					<h3>단순경비율</h3>
				</li>
				<li>
					<span>10</span>
					<span>5만원</span>
				</li>				
			</ul>
			<a href="sub_price.php"></a>
		</section>

		<!-- 종소세신고 임시배너 -->
		<section class="buMain">
			<div class="buMainCon">
				<div>
					<h1>쉽고, 싸고, 편한 종합소득세 신고 </h1>
					<h2>불편한 종합소득계산기 안녕 ~<br>
						간단한 기초정보만 입력하면 전문가가 검토하여 납부세액, 환급금, 신고대행 수수료를 안내해드립니다.
					</h2>
					<p><input type="text" placeholder="이름을 입력해주세요" id="CSTNAME" name="CSTNAME"><span></span><input type="text"
							placeholder="핸드폰번호를 입력해주세요" id="MOBILE" name="MOBILE"></p>
					<div class="checkbox">
						<input id="new_inc_agreement_check" name="new_inc_agreement_check" type="checkbox">
						<label for="new_inc_agreement_check"><A href="javascript:window.open('../Terms_Conditions.php');"><b>이용약관</b></A> 및 <A href="javascript:window.open('../Privacy_Policy.php');"><b>개인정보처리방침</b></A>에 동의합니다. 입력하신 정보는 종합소득세 안내 및 신고를 위한 용도로만 사용됩니다.</label>
					</div>
					<input type="button" value="종합소득세 간편 안내받기" id="action_inc_new_cst" name="action_inc_new_cst">
				</div>
			</div>

		</section>
		<!-- 종소세신고 임시배너-->


		<section class="link">
			<img src="resources/images/linkpeople.png">
			<div>
				<h1>종합소득세 신고 전문 세무톡 </h1>
				<h2>번거로운 소득세 신고 세무톡에 맡기고 일에만 전념하세요!</h2>
				
				<a href="javascript:ChannelIO('show');" style="width:500px;">채팅상담</a>
			</div>
		</section>

		<script>

		

		</script>

		<section class="case">
			<h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
			<h2>이미 많은 고객분들이 세무톡으로 탁월한 절세혜택을 경험하고 계십니다 </h2>
			<div class="tabsWrap">
				<ul class="tabtop">
					<li class="tabmenu active"><span>종합소득세</span></li>
				</ul>
				
				<section class=" tabarea case02">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide contents">
								<h3><span>515만원</span> 절세 혜택</h3>
								<h4>종합소득세 신고 </h4>
								<ul>
									<li>기장의무 : 간편장부대상자</li>
									<li>신고유형 : D유형 (안내문)</li>
									<li>업종코드 : 742104</li>
									<li>수입금액 : 1억 4,582만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>1,106만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>591만원 </strong></p>
								</ul>
								<h5>-515만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>376만원</span> 절세 혜택!</h3>
								<h4>종합소득세 신고</h4>
								<ul>
									<li>기장의무 : 간편장부대상자</li>
									<li>신고유형 : D유형 (안내문)</li>
									<li>업종코드 : 940909/940600</li>
									<li>수입금액 : 6,082만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>411만원</strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>35만원</strong></p>
								</ul>
								<h5>-376만원</h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>185만원</span> 절세 혜택!</h3>
								<h4>종합소득세 신고</h4>
								<ul>
									<li>기장의무 : 간편장부대상자</li>
									<li>신고유형 : E유형 (안내문)</li>
									<li>업종코드 : 701201</li>
									<li>수입금액 1억 5,230원</li>

									<p class="taxbefore"><span>일반 예상 세액</span><strong>452만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>267만원 </strong></p>
								</ul>
								<h5>-185만원</h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>121만원</span> 절세 혜택!</h3>
								<h4>종합소득세 신고</h4>
								<ul>
									<li>기장의무 : 간편장부대상자</li>
									<li>신고유형 : D유형 (안내문)</li>
									<li>업종코드 : 525101</li>
									<li>수입금액 : 4,538만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>166만원</strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>45만원</strong></p>
								</ul>
								<h5>-121만원</h5>
								<a></a>
							</div></a>
						</div>
					</div>
				</section>
			</div>
		</section>

		<section class="compare">
			<h1>더 이상 고민말고</h1>
			<h2>똑똑한 종합소득세 신고로 절세혜택을 받아보세요</h2>
			<ul>
				<li>
					<h3>세무톡을 모르면</h3>
					<h4>
						<p>번거롭고, 고민되고~</p>
						<p>직접하긴 번거롭고
						<br> 하면서도 제대로 한건지 알수가 없고
						<br> 혹여 세금을 더 낸건지 영 찜찜하고
						</p>
						<p>맡기려니<br>어디에 맡겨야 할지 알 수가 없고
						<br>비싼 수수료에 내야할 서류도 많고
						<br>각종 증빙자료 전달도 불편하고</p>
						<p>이리저리 고민만 되네요</p>
					</h4>
				</li>
				<li>
					<h3>세무톡을 알면</h3>
					<dl>
						<dt>
							<h4>저렴한 비용</h4>
							<!--h5>매출, 매입, 손익, 카드매출 누락까지 <span>한눈에 보이는 사업현황</span></h5-->
							<h5><span>수수료 10만원 ~</span>
							<br>일반 세무수수료 <span>1/3 수준</span></h5>
						</dt>
						<dt>
							<h4>쉽고 편한 자료전송</h4>
							<h5>이메일이나 팩스가 아닌<br><span>스마트폰에서도 바로 전송가능</span></h5>
							<!--h4>자료제출 NO</h4>
							<h5>인공지능 AI로 번거롭게 챙기던 세무 증빙자료<br><span>이젠 따로 챙길 필요 없이 자동수집</span></h5-->
						</dt>
						<dt>
							<h4>꼼꼼한 절세검토</h4>
							<h5>환급 또는 세금을 아낄 수 있도록 
								<Br>하나하나 <span>꼼꼼히 검토 및 신고</span></h5>
						</dt>
						<dt>
							<h4>실시간 상담 및 안내</h4>
							<h5>카톡 및 채팅으로
							<br><span>빠른 상담 및 안내</span></h5>
						</dt>
					</dl>
				</li>
			</ul>
		</section>

		<section class="recommendation">
			<h1>종합소득세 신고 대상자</h1>
			<h2>세무톡 이런 분께 강력히 권해드립니다</h2>
			<ul>
				<li>
					<h2>소규모 사업자</h2>
					<br>
					<h3>
					</h3>
					<h4 style="font-size:10pt;color:black;line-height: 25px;font-family: Georgia, '맑은 고딕', serif;"><b>
					프랜차이즈 가맹점
					<br>온라인쇼핑몰
					<br>게스트하우스
					<br>임대사업자
					<br>까페
					<br>스튜디오
					<br>네일샵
					<br>운수 및 화물업</b>
					</h4>
				</li>
				<li>
					<h2>프리랜서</h2>
					<h4 style="font-size:10pt;color:black;line-height: 25px;font-family: Georgia, '맑은 고딕', serif;">
					<b>
					강사<br>학원강사<br>학습지교사<br>PT/요가강사<br><br>
					IT<br>프로그래머<br>웹디자이너<br><br>
					방송<br>유튜버/비제이<br>가수/모델/배우
					</b>
					</h4>
				</li>
				<li>
					<h4 style="font-size:10pt;color:black;line-height: 25px;font-family: Georgia, '맑은 고딕', serif;">
					<b>
					세일즈<br>보험모집인<br>자동차판매사<br>방문판매원<br><br>
					스포츠<br>운동선수<br>감독/코치<br>골프장 캐디<br><br>
					아티스트<br>헤어디자이너<br>출장메이크업
					</b>
					</h4>
				</li>
			</ul>
		</section>

		<section class="review">
			<div class="title">
				<h1>세무톡 이용후기 </h1>
				<h5><span>세무걱정끝!</span>세무톡 #기장 #양도소득세<Br>#세무톡으로 한번에 해결 #기장</h5>
				<i></i>
				<!-- <a href="sub_review.php"></a> -->
			</div>

			<div class="review-main slider">
				<div class="contents">
					<img src="resources/images/review01.png">
					<h2>어학원 / 김*현 강사님</h2>
					<h3>지인분들께도 추천드렸어요</h3>
					<h4>저렴한 수수료에 친절하고 빠른 답변까지 게다가 일처리도 신속해서 정말 맘에 쏙 들어요.</h4>
					<a href="sub_review.php"></a>
				</div>
				<div class="contents">
					<img src="resources/images/review02.png">
					<h2>카페 / 정*웅 사장님</h2>
					<h3>가게하는 분들께 강추합니다</h3>
					<h4>늘 바쁘다 보니 번거로운 세무업무는 정말 손이 안가더라구요. 그런데 이곳에 일을 맡기고부터는 정말 편해졌어요.</h4>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/review03.png">
					<h2>무역업 / 서*희 대표님</h2>
					<h3>늘 친절해서 정말 좋아요</h3>
					<h4>사업을 하다보면 세무, 노무 관려해서 이것 저것 물어보게 되는데,언제나 친절하게 답변해주시니 부담없이 문의하게 되네요.</h4>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/review010.png">
					<h2>프리랜서 / 차*철 고객님</h2>
					<h3>세번 놀라게 하는 세무톡</h3>
					<h4>저렴한수수료에 한번 놀라고 문의사항에 친절하고 빠른 답변에 두번 놀라고 신속한 일처리에 세번 놀랐습니다</h4>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/review04.png">
					<h2>미용실 / 임*녕 원장님</h2>
					<h3>알아서 착착 다 해주니 정말 편해요</h3>
					<h4>일일이 말하거나 입력할 필요 없이 종이 증빙만 찍어 주면 기장부터 신고까지 다 알아서 해주니 이렇게 편할 수가 없어요.</h4>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/review05.png">
					<h2>건설업 / 조*훈 대표님</h2>
					<h3>사업에만 전념할 수 있어 감사해요</h3>
					<h4>영수증, 기부금내역 등 그때그때 찍어만 주면 알아서 해주시니 마음도 편하고, 손도 편하고, 세무 신경을 딱 끊어도 되니 너무 편해요.</h4>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/review06.png">
					<h2>도소매업 / 최*일 대표님</h2>
					<h3>세무 때문에 더 이상 고민하지 않아요</h3>
					<h4>세무 신경 쓸 여력이 없었는데, 친절하게 하나하나 알려주시고,꼼꼼히 챙겨주시니 세무업무 다 맡겨놓고 있어요.</h4>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/review07.png">
					<h2>복합운송업 / 김*경 이사님</h2>
					<h3>전문성이 높고 경험이 많아 안심돼요</h3>
					<h4>국세청 33년 경력에 세무법인 설립 20년 많은 세무전문가분이 책임져주시니 정말 안심하고 사업하고 있어요.</h4>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/review08.png">
					<h2>제조업 / 정*나 대표님</h2>
					<h3>믿고 맡길 수 있어서 좋아요</h3>
					<h4>그때 그때 궁금한 것이 있을때 마다 연락하면 늘 친절하게 답변해주시고 세무 뿐만 아니라 노무까지 하나하나 관리해주시니 복잡한 세무 신경 쓸 필요없이 맘편히 믿고 맡기고
						있어요. </h4>
					<a></a>
				</div>
				<div class="contents">
					<img src="resources/images/review09.png">
					<h2>부동산업 / 홍*범 고객님</h2>
					<h3>세금이 대폭 축소되는 세무톡</h3>
					<h4>처음으로 세무신고를 세무톡으로 의뢰하였는데 생각보다 쉽고 간단하게 제출 작성이 가능했던 것 같았으며 무엇보다 세금이 이렇게나 대폭 축소할수 있는 기법에 놀라움을 금치 못하였습니다.</h4>
					<a></a>
				</div>
			</div>

		</section>
<?php
include "../db_info.php";


?>

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
			</div>
			<ul>
<?php

$QUERY = "SELECT *,LEFT(REGEXP_REPLACE(CONTENTS_, '<[^>]+>',''),100) AS CONTENTS_, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' and cate='CIT' ORDER BY REGDATE DESC  LIMIT 0, 3 ;";

$QUERY2 = "SELECT *,LEFT(REGEXP_REPLACE(CONTENTS_, '<[^>]+>',''),100) AS CONTENTS_, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' ORDER BY REGDATE DESC  LIMIT 0, 3 ;";


$result = @mysqli_query($connect,$QUERY) or die("SQL error");

while ($row = mysqli_fetch_array($result)) {

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

		<script>
			$('.counseling ul li,.column ul li').each(function () {

				var textQ = $(this).children('h2').html();
				var textA = $(this).children('h3').html();
				var textTag = $(this).children('h4').html();

				if ($(this).closest('section').hasClass('counseling')) {
					//$(this).children('h3').html((textA.substring(0, 40) + "..."));
				}
				if ($(this).closest('section').hasClass('column')) {
					//$(this).children('h3').html((textA.substring(0, 40) + "..."));
				}
			});

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
					<h3>신속한 신고</h3>
					<h4>편리한 자료전송으로 <br>신고대행이 가능합니다</h4>
					<h5>자료 전송하기</h5>
					<a href="javascript:ChannelIO('show');"></a>
				</li>
				
			</ul>
		</section>

		<section class="people">
			<div>
				<h1>세무톡은 국세청 33년 경력 믿고 맡길 수 있는 신승세무법인의 스마트 세무회계 서비스 브랜드입니다</h1>
				<h2>세무회계 전문가 자세히 보기</h2>
				<a href="sub_member.php"></a>
			</div>
		</section>

		<section class="download">
			<div>
				<h1>지금 다운로드 해보세요<br>세무가 너무 편해집니다</h1>
				<a href="https://play.google.com/store/apps/details?id=com.duzon.android.lulubizpotal&hl=ko"
					class="google">구글플레이 다운로드<span></span></a>
				<a href="https://itunes.apple.com/kr/app/apple-store/id1363039300" class="apple">애플스토어
					다운로드<span></span></a>
			</div>
		</section>		

		<?php include("footer.php");?>

	

<script>
	
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


window.onload=function(){
	
	var req = new Request();
	var link2 = req.getParameter("link2");
	if(link2=='Y'){
		var offset = $('#link2').offset();
	    $('html').animate({scrollTop : offset.top}, 5);
	}

}


	$('.counter').counterUp();

	//따라다니는 네비
	$(window).scroll(function () {

		var mainchange = $('.number').offset().top;

		if ($(this).scrollTop() > mainchange) {
			TweenLite.to('.mainnavi', 0.1, { css: { background: "#fff", position: "fixed", width: "100%", paddingTop: "0px", boxShadow: "-1px -2px 9px rgba(230,230,230,.9)" } });
			TweenLite.to('.mainnavi div ul a li', 0, { css: { color: "#333" } });
			TweenLite.to('.mainnavi div ul p span', 0, { css: { color: "#333" } });
			TweenLite.to('.mainnavi div ul p strong b', 0, { css: { color: "#333" } });
			TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/sublogo.png)',color: "#194581"  });
		}
		else {
			TweenLite.to('.mainnavi', 0, { css: { background: "none", position: "absolute", paddingTop: "30px", boxShadow: "none" } });
			TweenLite.to('.mainnavi ul a li', 0, { css: { color: "#fff" } });
			TweenLite.to('.mainnavi div ul p span', 0, { css: { color: "#fff" } });
			TweenLite.to('.mainnavi div ul p strong b', 0, { css: { color: "#fff" } });
			TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/logo.png)',color: "#fff"  });
		}
	});

	//메인롤링
	$('.mainVisual ul').bxSlider({
		pager: true,
		auto: true,
		autoControls: false,
		speed: 500,
		pause: 3000,
		controls: true,
	});

	var swiper = new Swiper('.case01 .swiper-container', {
		autoplay: false,
		slidesPerView: 4,
		spaceBetween: 30,
		freeMode: true,
		navigation: {
			nextEl: '.case01 .swiper-button-next',
			prevEl: '.case01 .swiper-button-prev',
		},
	});

	var swiper = new Swiper('.case02 .swiper-container', {
		autoplay: false,
		slidesPerView: 4,
		spaceBetween: 30,
		freeMode: true,
		navigation: {
			nextEl: '.case02 .swiper-button-next',
			prevEl: '.case02 .swiper-button-prev',
		},
	});

	//리뷰
	$(".review .review-main").slick({
		autoplay: true,
		autoplaySpeed: 1500,
		dots: false,
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 1,
		variableWidth: true
	});

	//세무일정롤링
	var swiper = new Swiper('.taxtSchedul .swiper-container', {
		autoplay: true,
		slidesPerView: 5,
		spaceBetween: 10,
		freeMode: true,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			type: 'progressbar',
			clickable: true,
		},
	});

	//이런서비스
	$(".best .review-main02").slick({
		autoplay: true,
		autoplaySpeed: 4000,
		infinite: true,
		speed: 2000,
		fade: true
	});






$(document).ready(function(){

	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var cstname = $('#CSTNAME').val();
		var mobile= $('#MOBILE').val();
		var quest= $('#QUEST').val();
		var action = "등록";

		//성과 이름이 올바르게 입력이 되면
		if(cstname !='' && mobile!= ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action_income.php", 
				method:"POST",
				data:{cstname:cstname,mobile:mobile,quest:quest,action:action},
				success:function(data){
					alert(data);
					location.reload();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}
	}); // [2]끝
	

	$('#action_inc_new_cst').click(function(){
		var mobile = document.getElementById('MOBILE').value;
		var cstname = document.getElementById('CSTNAME').value;
		var action = "add_new_inc_cst";
		var inf_path = "종소톡";

		if(mobile =="" || cstname ==""){
			alert("성함과 핸드폰번호 입력이 필요합니다.");
			if(cstname==''){
				document.getElementById('CSTNAME').focus();
			}else if(mobile==''){
				document.getElementById('MOBILE').focus();
			}else{
				document.getElementById('CSTNAME').focus();
			}

		}else{
			if($('input:checkbox[id="new_inc_agreement_check"]').is(":checked") != true){
				alert("약관에 동의하여주세요.");
				return false;
			}else{

				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"action.php", 
					method:"POST",
					dataType:"json",
					data:{cstname:cstname,mobile:mobile,action:action,inf_path:inf_path},
					success:function(data){
						window.location.href="sub_step01.php?id="+data.CSTID;
					}
				});

			}			
		}
	}); // [2]끝

	$('#upfile').on('click', function(e){
		var mobile = document.getElementById('MOBILE').value;
		var cstname = document.getElementById('CSTNAME').value;
		
		if(mobile =="" && cstname ==""){
			alert("업로드하시기전 성함과 핸드폰번호 입력이 필요합니다.");
			if(cstname==''){
				document.getElementById('CSTNAME').focus();
			}else if(mobile==''){
				document.getElementById('MOBILE').focus();
			}else{
				document.getElementById('CSTNAME').focus();
			}

			return false;
		}else{
			return true;
		}

	});


/*종합소득세 안내문 업로드 : S */
	$('#upfile').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;

		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		var mobile = document.getElementById('MOBILE').value;
		var cstname = document.getElementById('CSTNAME').value;
		var filelist_height = $('.upload-name').height();
		var link2_height = $('.link2').height();

		if(filelist_height != 35){
			filelist_height = 35; // 재첨부시 높이값 초기화
		}

		if(link2_height != 970){
			link2_height = 970; // 재첨부시 높이값 초기화
		}

		fileBuffer = [];
        const target = document.getElementsByName('files[]');
        
        Array.prototype.push.apply(fileBuffer, files);
        var html = '';
        $.each(files, function(index, file){
            const fileName = file.name;
            html += '<span style="color:black;">'+fileName+'</span><br>';
            const fileEx = fileName.slice(fileName.indexOf(".") + 1).toLowerCase();
			filelist_height += 30;
			link2_height += 30;

            
           
			$('.upload-name').css("height",filelist_height+"px");
			$('.link2').css("height",link2_height+"px");
			$('.upload-name').html(html);

        });



		 $.each(files, function(key, value)
		 {
		  data.append(key, value);
		 });

		

		 
		  $.ajax({
					
				 url: 'upload_process.php?files&mobile='+mobile+'&cstname='+encodeURI(cstname), //file을 저장할 소스 주소입니다.
				 type: 'POST',
				 data: data, //위에서 가공한 data를 전송합니다.
				 cache: false,
				 dataType: 'json',
				 processData: false, 
				 contentType: false,
				 success: function(data, textStatus, jqXHR)
				 {
					 alert(data);
				 },
				 error: function(jqXHR, textStatus, errorThrown)
				 {
				  console.log('ERRORS: ' + textStatus);
				 }
			 });
		
		 
	});
/*종합소득세 안내문 업로드 : E*/


/*부속서류 업로드 : S */
	$('#file2').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;
		 var data = new FormData();
		
		 $.each(files, function(key, value)
		 {
		  data.append(key, value);
		 });

		 
		  $.ajax({
					
				 url: 'upload_process.php?files&mobile='+mobile+'&cstname='+encodeURI(cstname), //file을 저장할 소스 주소입니다.
				 type: 'POST',
				 data: data, //위에서 가공한 data를 전송합니다.
				 cache: false,
				 dataType: 'json',
				 processData: false, 
				 contentType: false,
				 success: function(data, textStatus, jqXHR)
				 {
					 alert(data.error);
				  if(typeof data.error === 'undefined') //에러가 없다면
				  {

			   //저장된 파일의 정보를 통해 위에서 선언한 img_section이란 곳에 추가 할 코드입니다. 										  파일이 1개기 때문에 index가 0입니다.
				  //var source = '<img src ="'+data.files[0]+'" style="width:270px; height:160px" id="img_url" name="img_url">'

				  }
				  else//에러가 있다면
				  {
				   console.log('ERRORS: ' + data.error);
				  }
				 },
				 error: function(jqXHR, textStatus, errorThrown)
				 {
				  console.log('ERRORS: ' + textStatus);
				 }
			 });
	
		 
	});
/*부속서류 업로드 : E*/


});



</script>
