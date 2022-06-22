		<?php include_once 'top.php'; ?>

	 <section class="kakaoLink">
        <div>
            <a href="javascript:kakaoClose();" class="close"></a>
            <h1>카카오톡 상담하기</h1>
            <h2>상담지점을 선택해주세요</h2>
            <ul>
                <li>
                    <a href="http://pf.kakao.com/_aIxmYT/chat" target="_blank">기장/신고</a>
                    <dl>
                        <dd>세무 기장 문의</dd>
                        <dd>종합소득세 신고문의</dd>
                        <dd>부가가치세 신고문의</dd>
                        <dd>법인세 신고문의</dd>
                    </dl>
                </li>
                <li>
                    <a href="http://pf.kakao.com/_xmxjIHK/chat" target="_blank">절세컨설팅</a>
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
			function kakao() {
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

		<section class="mainVisual">
			<header>
				<h1><a href="index.php"><img src="resources/images/logo.png"></a></h1>
				<a href="#" class="mMenu" title="모바일 메뉴 열기">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</header>

			<div class="swiper-container">
				<ul class="swiper-wrapper">
					<li class="swiper-slide">
						<h2 class="js-words">국세청 33년 경력<br>과목별 전문세무사</h2>
						<img src="resources/images/mainVisual01.png">
					</li>
					<li class="swiper-slide">
						<h2 class="js-words">쉽고 편한<br>스마트한 세무상담센터</h2>
						<img src="resources/images/mainVisual02.png">
					</li>
					<li class="swiper-slide">
						<h2 class="js-words">20년간 축적된<br> 세무전문 노하우</h2>
						<img src="resources/images/mainVisual03.png">
					</li>
					<li class="swiper-slide">
						<h2 class="js-words">수도권 15개 지점<br>맞춤 세무서비스 지원</h2>
						<img src="resources/images/mainVisual04.png">
					</li>
				</ul>
				<div class="swiper-pagination"></div>
			</div>

			<div class="mainlink">
				<div>
					<a href="#">스마트 세무기장</a>
					<a href="#">종합소득세/부가신고세</a>
					<a href="#">양도/증여/상속세</a>
					<a href="#">스마트 세무기장</a>
					<a href="#">스마트상담센터</a>
				</div>

			</div>
		</section>

		<section class="schedule">
			<h1>세무주요일정</h1>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<?php
include "../db_info.php";


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
				<div class="swiper-pagination"></div>
			</div>
		</section>

		<section class="video">
			<h1>TAX SEMINAR</h1>
			<div class="videoTitle" id="AfZ_Ob_zcRg">
				<img src="resources/images/videoIcon_white.png">
				<h2>중국기업 실무자 한국세무 세미나</h2>
				<h3>황재윤 대표세무사</h3>
			</div>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide scheduleDiv">
						<li id="axNY67zTwUI"><span>EP01.</span> 1세대 1주택 비과세 개념정리</li>
						<li id="ox9AWkrzvrQ"><span>EP02.</span> 1세대 1주택 비과세 (주택의 개념 및 1주택 판단)</li>
						<li id="kH-QIec-zmk"><span>EP03.</span> 1세대 1주택 비과세 조건</li>
					</div>
					<div class="swiper-slide scheduleDiv">
						<li id="It3DEHwGxqw"><span>EP04.</span> 1세대 1주택 비과세 특혜</li>
						<li id="W-GXhtRLUSo"><span>EP05.</span> 다주택자 중과세</li>
						<li id="CT1YBSWxouM"><span>EP06.</span> 비사업자용 토지</li>
					</div>
					<div class="swiper-slide scheduleDiv">
						<li id="GW_1HlujVVE"><span>EP07.</span> 상속세 & 증여세 개념정리</li>
						<li id="fUqQqcIMpaA"><span>EP08.</span> 사전증여 개념정리</li>
						<li id="L-FlUMjm9Lg"><span>EP09.</span> 상속세 & 증여세 공제</li>
					</div>
					<div class="swiper-slide scheduleDiv">
						<li id="Xf04Y0cSans"><span>EP10.</span> 상속세 & 증여세 재산평가</li>
						<li id="KEmbShfakIY"><span>EP11.</span> [핵심요약] 1세대 1주택 비과세</li>
						<li id="lZot990sBU0"><span>EP12.</span> [핵심요약] 1세대 1주택 비과세 (1주택 판단)</li>
					</div>
				</div>
				<div class="swiper-pagination"></div>
			</div>

		</section>

		<section class="videoPop">
			<p class="close"></p>
			<div id="player"></div>
		</section>

		<script>

			//레이어팝업 세마나영상 
			$('.video li, .video .videoTitle').click(function () {
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
					height: '185',
					width: '100%',
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
			<h1>절세컬럼</h1>
			<div id="column">
				<ul>
					<li><a href="#">창업자를 위한 절세꿀팁</a></li>
					<li><a href="#">1가구 2주택 양도소득세 면제조건</a></li>
					<li><a href="#">상속세 낼 것도 없어도 신고하는게 절세노하우</a></li>
				</ul>
			</div>
			<a></a>
		</section>

		<section class="example">
			<h1>상담사례</h1>
			<div id="example">
				<ul>
					<li><a href="#">사망보험금을 수령하였는데 상속세 과세대상에..</a></li>
					<li><a href="#">상속개시 전에 증여받은 재산도 상속세 계산할때..</a></li>
					<li><a href="#">다가구주택은 어떻게 비과세를 판정하나요?</a></li>
				</ul>
			</div>
			<a></a>
		</section>

		<section class="review">
			<h1>이용후기</h1>
			<div class="reviewwrap">
				<div class="swiper-container">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<img src="resources/images/review01.png">
							<h2>어학원 / 김*현 강사님</h2>
							<h3>지인분들께도 추천드렸어요</h3>
							<h4>저렴한 수수료에 친절하고 빠른 답변까지 게다가 일처리도 신속해서 정말 맘에 쏙 들어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review02.png">
							<h2>카페 / 정*웅 사장님</h2>
							<h3>가게하는 분들께 강추합니다</h3>
							<h4>늘 바쁘다 보니 번거로운 세무업무는 정말 손이 안가더라구요. 그런데 이곳에 일을 맡기고부터는 정말 편해졌어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review03.png">
							<h2>무역업 / 서*희 대표님</h2>
							<h3>늘 친절해서 정말 좋아요</h3>
							<h4>사업을 하다보면 세무, 노무 관려해서 이것 저것 물어보게 되는데,언제나 친절하게 답변해주시니 부담없이 문의하게 되네요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review010.png">
							<h2>프리랜서 / 차*철 고객님</h2>
							<h3>세번 놀라게 하는 세무톡</h3>
							<h4>저렴한수수료에 한번 놀라고 문의사항에 친절하고 빠른 답변에 두번 놀라고 신속한 일처리에 세번 놀랐습니다.</h4>								
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review04.png">
							<h2>미용실 / 임*녕 원장님</h2>
							<h3>알아서 착착 다 해주니 정말 편해요</h3>
							<h4>일일이 말하거나 입력할 필요 없이 종이 증빙만 찍어 주면 기장부터 신고까지 다 알아서 해주니 이렇게 편할 수가 없어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review05.png">
							<h2>건설업 / 조*훈 대표님</h2>
							<h3>사업에만 전념할 수 있어 감사해요</h3>
							<h4>영수증, 기부금내역 등 그때그때 찍어만 주면 알아서 해주시니 마음도 편하고, 손도 편하고, 세무 신경을 딱 끊어도 되니 너무 편해요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review06.png">
							<h2>도소매업 / 최*일 대표님</h2>
							<h3>세무 때문에 더 이상 고민하지 않아요</h3>
							<h4>세무 신경 쓸 여력이 없었는데, 친절하게 하나하나 알려주시고,꼼꼼히 챙겨주시니 세무업무 다 맡겨놓고 있어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review07.png">
							<h2>복합운송업 / 김*경 이사님</h2>
							<h3>전문성이 높고 경험이 많아 안심돼요</h3>
							<h4>국세청 33년 경력에 세무법인 설립 20년 많은 세무전문가분이 책임져주시니 정말 안심하고 사업하고 있어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review08.png">
							<h2>제조업 / 정*나 대표님</h2>
							<h3>믿고 맡길 수 있어서 좋아요</h3>
							<h4>그때 그때 궁금한 것이 있을때 마다 연락하면 늘 친절하게 답변해주시고 세무 뿐만 아니라 노무까지 관리해주시니 복잡한 세무 신경 쓸 필요없이 맘편히
								믿고 맡기고 있어요. </h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review09.png">							
							<h2>부동산업 / 홍*범 고객님</h2>
							<h3>세금이 대폭 축소되는 세무톡</h3>
							<h4>처음으로 세무신고를 세무톡으로 의뢰하였는데 생각보다 쉽고 간단하게 제출 작성이 가능했던 것 같았으며 무엇보다 세금이 이렇게나 대폭 축소할수 있는 기법에 놀라움을 금치 못하였습니다. </h4>							
							<a></a>
						</div>
					</div>
					<div class="swiper-pagination"></div>
					<div class="swiper-button-next"></div>
					<div class="swiper-button-prev"></div>
				</div>
			</div>
		</section>

		<section class="shinseung">
			<img src="resources/images/mbc.png">
			<h2>사업에만 전념하세요<br>신승세무법인이 함께 합니다</h2>
			<h3>신승세무법인은 기장대리, 세무조정, 양도소득세, 상속세, 증여세신고, 세무관련 문제에 대한 컨설팅, 세무조사대행, 심판청구 등 불복청구, 기업진단 업무 등 분야별로 전문성을 살려 고객에게
				충분한 세무서비스를 제공하고 있습니다</h3>
		</section>

		<section class="location">
			<div class="locationCon">
				<h1>신승세무법인 지점안내</h1>
				<h2>글로벌 세무전문 그룹 신승세무법인 수도권 15개 지점</h2>
				<ul>
					<li>강남본사</li>
					<li>부천지점</li>
					<li>용인지점</li>
					<li style="border-color: tomato;">광주지점</li>
					<li>안양지점</li>
					<li>분당지점</li>
					<li>수원지점</li>
					<li>기흥지점</li>
					<li>일산지점</li>
					<li>신사지점</li>
					<li>용산지점</li>
					<li>안산지점</li>
					<li>안산법원지점</li>
					<li>시흥지점</li>
					<li>시흥정왕지점</li>
				</ul>
			</div>
		</section>

		<section class="people">
			<h1>신승세무법인 세무사</h1>
			<h2>20년 이상 경력의 숙련된 전문가로 구성</h2>
			<div>
				<ul>
					<li>
						<p><img src="resources/images/people0102.png"></p>
						<div>
							<h3>대표세무사</h3>
							<h4>황재윤</h4>
						</div>
						<a></a>
					</li>
					<li>
						<p><img src="resources/images/people0103.png"></p>
						<div>
							<h3>대표세무사</h3>
							<h4>변기영</h4>
						</div>
						<a></a>
					</li>
					<li>
						<p><img src="resources/images/people0104.png"></p>
						<div>
							<h3>대표세무사</h3>
							<h4>전명호</h4>
						</div>
						<a></a>
					</li>
					<li>
						<p><img src="resources/images/people0105.png"></p>
						<div>
							<h3>대표세무사</h3>
							<h4>박호열</h4>
						</div>
						<a></a>
					</li>
					<li>
						<p><img src="resources/images/people0111.png"></p>
						<div>
							<h3>회계사</h3>
							<h4>오종석</h4>
						</div>
						<a></a>
					</li>
					<li>
						<p><img src="resources/images/people0110.png"></p>
						<div>
							<h3>회계사</h3>
							<h4>안장순</h4>
						</div>
						<a></a>
					</li>
					
				</ul>
			</div>
			<a href="people.php">신승세무법인 세무사 전체 보기</a>
		</section>
		<script>
			//세무사 세부 위치 링크
			$('.people ul li a').click(function () {
				var arr = $(this).siblings().children('img').attr('src').replace(/[^0-9]/g, "");
				$(this).attr("href", "people.php?id=#people" + arr);
			});
		</script>

		<section class="allpeople">
			<h1>20여년 노하우를 갖춘<br>70여명의 세무회계 및 경영컨설팅<br>전문가와 함께 하세요</h1>
		</section>

		<section class="china">
			<h1>신승차이나컨설팅</h1>
			<h2>중국관련 원스톱 기업지원센터 운영</h2>
			<ul>
				<li>중국진출/한국투자 컨설팅</li>
				<li>중국경영컨설팅 한국법인설립지원</li>
				<li>중국세무/한국세무 컨설팅</li>
				<li>중국법률/한국노무 컨설팅</li>
				<li>중국마케팅/한국마케팅 컨설팅</li>
			</ul>
		</section>		

		<section class="institute">
			<img src="resources/images/instituteImg.png">
			<div>
				<h1><img src="resources/images/doctorLogo.png"></h1>
			</div>
			<a href="http://medi-tax.kr/" target="_blank"></a>
		</section>

		<section class="catalouge">
			<div>
				<a href="#">신승세무법인 브로셔</a>
				<a href="#">절세칼럼 & 상담사례집</a>
				<a href="https://sostax.cn/down/shinseung_consulting_group_ver_1.0.0.pdf">신승차이나 브로셔 <span>국문</span></a>
				<a href="https://sostax.cn/down/shinseung_consulting_group_ver_old_kor.pdf">신승차이나 브로셔
					<span>중문</span></a>
			</div>
		</section>
		<?php include_once 'bottom.php'; ?>