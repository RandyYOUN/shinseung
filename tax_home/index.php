<?php 
include("top.php");
include "../db_info.php";
?>

	<div class="wrap">
				<section id="promotionBanner" class="popup">
				<div class="popContents">
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'>
					<h1>주택임대 소득신고 고민이신가요? </h1>
					<h2>세무톡에서 저렴하게 끝내세요</h2>
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
					<?php include("navi.php");?>					
				</div>
			</section>

			<video muted loop id="myVideo">
				<source src="http://taxtok.kr/tax_transfer/resources/images/video_yhy.mp4" type="video/mp4">
				</source>
			</video>
			<span id="currentTime">0</span>
			<section class="maintext">
				<div class="slider">
					<div class="maintextBox maintext01">
						<div>
							<h2>국세청 33년 경력</h2>
							<h3>주택임대소득 신고 최다 상담 및 신고처리</h3>
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
					<span class="counter">8,378</span>
					<span>개</span>
				</li>
				<li>
					<span>누적 거래관리 금액</span>
					<span class="counter">49.7</span>
					<span>조</span>
				</li>
				<li>
					<span>누적 접수문의 수 </span>
					<span class="counter">170,505</span>
					<span>건</span>
				</li>
			</ul>
		</section>
		<section class="price">
			<h1>서비스 가격안내</h1>
			<ul>
				<li>
					<p></p>
					<h2>주택임대소득 신고대행</h2>
					<h3>1주택~2주택</h3>
				</li>
				<li>
					<!--span class="pricebg01">건별</span-->
					<span>10</span>
					<span>10만원</span>
				</li>				
			</ul>
			<a href="sub_price.php"></a>
		</section>

		<section class="link">
			<img src="resources/images/linkpeople.png">
			<div>
				<h1>주택임대신고 전문 세무톡 </h1>
				<h2>번거로운 주택임대신고 신고 세무톡에 맡기고 일에만 전념하세요!</h2>
				<!--input type="text" name="NEW_HP1" id="NEW_HP1" placeholder="핸드폰번호를 입력해주세요"
					onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
				<button type="button" name="action1" id="action1">전화상담 요청</button-->
				<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청' style="width:500px;">채팅상담</a>
			</div>
		</section>



		<section class="link2" name="link2" id="link2">
			<h1>주택임대소득신고 간편 안내서비스 </h1>
			<h2><B>기본정보<B/>를 입력해주시면 검토하여 <B>세액, 환급금, 수수료를 안내해드립니다.</B></h2>

			<div class="wrapDiv">
				<input type="text" name="CSTNAME" id="CSTNAME" placeholder="성함을 입력해주세요" style="width:472px;"><BR><BR>
				<input type="text" name="MOBILE" id="MOBILE" placeholder="핸드폰번호를 입력해주세요"					onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width:472px;"><br><BR>
				
				<b><span style="color:red;">부부합산 보유 주택 수</span></b>&nbsp;[답변 예시 : 2주택] <BR>
				<input type="text" name="HOME_Q1" id="HOME_Q1" placeholder="" style="width:472px;"><BR><BR>
				<b><span style="color:red;">연간 주택임대소득</span> </b>&nbsp;[답변 예시 : 1번 월세 30만원 보증금 1억] <BR>
				<textarea name="HOME_Q2" id="HOME_Q2" placeholder="" style="width:500px;font-size:18px; height:100px;"></textarea><BR><BR>
				<b><span style="color:red;">공동명의 여부</span></b>&nbsp;[답변 예시: 1번 단독/2번 공동] <BR>
				<input type="text" name="HOME_Q3" id="HOME_Q3" placeholder="" style="width:472px;"><BR><BR>
				
				<button style="width:510px;" type="button" name="action" id="action">검토신청</button>		

			</div>
			<h4>불편한 임대소득신고 <strong>이젠 안녕!</strong></h4>
		</section>

		<section class="heavytax">
			<div>
				<h1>주택임대 소득 신고 해야 하나? 말아야 하나?</h1>
				<h2></h2>
				<h3>2019년에 발생한 임대소득부터는<br> 소액임대소득도 세금을 신고하고 납부해야할 의무가 생겼습니다.</h3>
				<h4>
					<a href="sub_newsview.php?id=634">관련뉴스 보기</a> <a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'>채팅상담</a>
				</h4>
				<h5>주택임대소득 과세기준</h5>
				<ul>
					<li>
						<h1>과세요건(2019년 귀속분 기준)</h1>
						<table>
							<colgroup>
								<col width="25%">
								<col width="50%">
								<col>
							</colgroup>
							<thead>
								<tr>
									<th>소유주택수<b>(부부 합산)</b></th>
									<th>월세소득</th>
									<th>보증금 소득</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td><b>1주택</b></td>
									<td>비과세기준시가 <B>9억원 초과</B> <br>주택임대소득은 <B>과세</B> </td>
									<td>비과세</td>
								</tr>
								<tr>
									<td><b>2주택</b></td>
									<td>과세</td>
									<td>비과세</td>
								</tr>
								<tr>
									<td><b>3주택</b></td>
									<td>과세</td>
									<td><B>간주임대료과세</B><br>(소형주택 제외)</td>
								</tr>
							</tbody>
						</table>
					</li>
					<li>
						<h1>과세방법</h1>
						<table>
							<colgroup>
								<col width="30%">
								<col>
							</colgroup>
							<thead>
								<tr>
									<th>수입금액</th>
									<th>보증금 소득 </th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>2천만원 이하</td>
									<td>종합 / 분리과세 중 선택</td>
								</tr>
								<tr>
									<td>2천만원 초과</td>
									<td>종합과세</td>
								</tr>
							</tbody>
						</table>
					</li>
				</ul>
				<dl>
					<dt>주택임대소득 대상 체크</dt>
					<dd>전월세 거주하면서 1주택을 월세 받는 다면 <b>비과세</b></dd> 
					<dd>전월세 거주하면서 2주택을 월세 받는 다면 <b>신고 및 납부 대상</b></dd> 
					<dd>거주(소유)하는 주택 외에 1주택 월세를 받는 다면 <b>신고 및 납부 대상</b></dd> 
					<dd>거주(소유)하는 주택 외에 1주택 전세를 주고 있다면 <b>비과세</b></dd> 
					<dd>거주(소유)하는 주택 외에 2채 주택 전세(보증금 합계 3억 초과)를 주고 있다면 <b>신고 및 납부 대상</b><br>(단, 전용면적 40㎡ 이하이고 시가가 2억원 이하인 소형주택은 과세 대상 주택에서 제외됩니다)</dd>
				</dl>
			</div>
		</section>


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
			<h2>똑똑한 주택임대소득 신고로 절세혜택을 받아보세요</h2>
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
						<br>알아보면 주택임대소득 신고 수수료는 비싸고
						<br>요청서류도 많고
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
							<h5>주택임대소득 신고대행<br>
							<span>수수료 10만원 ~</span>
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
							<h5>세금을 아낄 수 있도록 
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

		<section class="column">
			<div>
				<p></p>
				<h1>절세꿀팁</h1>
				<!--<a href="" class="more"></a>-->
			</div>
			<ul>
<?php

$QUERY = "SELECT *,LEFT(REGEXP_REPLACE(CONTENTS_, '<[^>]+>',''),100) AS CONTENTS_, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, 
(CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' and cate='HOM' ORDER BY REGDATE DESC  LIMIT 0, 3 ;";

//$QUERY2 = "SELECT *,LEFT( fnStripTags(CONTENTS_),100) AS CONTENTS_, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/news/images/default.jpg' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' ORDER BY REGDATE DESC  LIMIT 0, 3 ;";


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
/*
				$(this).click(function () {
					$(".mask").fadeIn();
					$(".counselingPop").fadeIn();
					$('.counselingPop h1').html(textQ);
					$('.counselingPop h2').html(textA);
					$('.counselingPop h3').html(textTag);

					if ($(this).closest('section').hasClass('column')) {
						$('.counselingPop').find('span').css("display", "none");
					}
				})*/
			});

		</script>

		
		
		<section class="anywhere">
			<h1>전국 어디에서나 쉽고 빠르고 정확하게 </h1>
			<h2>세무톡은 방문하지 않으셔도 전문적인 세무업무가 가능합니다<br>
				지역에 상관없이 편하게 상담받아보세요.
				<img src="resources/images/anywhereImg.png">
			</h2>
		</section>

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
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
				<li>
					<img src="resources/images/benefit03.png">
					<h3>신속한 신고</h3>
					<h4>편리한 자료전송으로 <br>신고대행이 가능합니다</h4>
					<h5>자료 전송하기</h5>
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
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

	$('.counter').counterUp();

	//따라다니는 네비
	$(window).scroll(function () {

		var mainchange = $('.number').offset().top;

		if ($(this).scrollTop() > mainchange) {
			TweenLite.to('.mainnavi', 0.1, { css: { background: "#fff", position: "fixed", width: "100%", paddingTop: "0px", boxShadow: "-1px -2px 9px rgba(230,230,230,.9)" } });
			TweenLite.to('.mainnavi div ul a li', 0, { css: { color: "#333" } });
			TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/sublogo.png)',color: "#194581"  });
		}
		else {
			TweenLite.to('.mainnavi', 0, { css: { background: "none", position: "absolute", paddingTop: "30px", boxShadow: "none" } });
			TweenLite.to('.mainnavi ul a li', 0, { css: { color: "#fff" } });
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


window.onload=function(){
	
	var req = new Request();
	var link2 = req.getParameter("link2");
	if(link2=='Y'){
		var offset = $('#link2').offset();
	    $('html').animate({scrollTop : offset.top}, 5);
	}

}




$(document).ready(function(){

	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var cstname = $('#CSTNAME').val();
		var mobile= $('#MOBILE').val();
		var home_q1= $('#HOME_Q1').val();
		var home_q2= $('#HOME_Q2').val();
		var home_q3= $('#HOME_Q3').val();
		var action = "등록";

		//성과 이름이 올바르게 입력이 되면
		if(cstname !='' && mobile!= ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action_income.php", 
				method:"POST",
				data:{cstname:cstname,mobile:mobile,home_q1:home_q1,home_q2:home_q2,home_q3:home_q3,action:action},
				success:function(data){
					alert(data);
					location.reload();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
			if($('#CSTNAME').val() == ''){
				 $('#CSTNAME').focus();			
			}else if($('#MOBILE').val() == ''){
				 $('#MOBILE').focus();			
			}else{
				$('#CSTNAME').focus();
			}

			return false;
		}
	}); // [2]끝

		


/*종합소득세 안내문 업로드 : S */
	$('#upfile').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;

		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		 var mobile = document.getElementById('MOBILE').value;
		 var cstname = document.getElementById('CSTNAME').value;



		if(mobile =="" && cstname ==""){
			alert("업로드하시기전 성함과 핸드폰번호 입력이 필요합니다.");
			document.getElementById('upfile').value="";
			return false;
		}else{
			//만약 input에 multiple 속성을 추가한다면, 파일을 여러개 선택할 수 있는데, 저는 일단 1개로
			 //그 때의 파일을 배열로 만들어 주기 위한 작업입니다.
			 $.each(files, function(key, value)
			 {
			  //key는 다른 지정이 없다면 0부터 시작 할것이고, value는 파일 관련 정보입니다.
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
		}
		 
	});
/*종합소득세 안내문 업로드 : E*/


/*부속서류 업로드 : S */
	$('#upfile2').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;

		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		 var mobile = document.getElementById('MOBILE').value;
		 var cstname = document.getElementById('CSTNAME').value;



		if(mobile =="" && cstname ==""){
			alert("업로드하시기전 성함과 핸드폰번호 입력이 필요합니다.");
			document.getElementById('upfile').value="";
			return false;
		}else{
			//만약 input에 multiple 속성을 추가한다면, 파일을 여러개 선택할 수 있는데, 저는 일단 1개로
			 //그 때의 파일을 배열로 만들어 주기 위한 작업입니다.
			 $.each(files, function(key, value)
			 {
			  //key는 다른 지정이 없다면 0부터 시작 할것이고, value는 파일 관련 정보입니다.
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
		}
		 
	});
/*부속서류 업로드 : E*/




});


</script>
