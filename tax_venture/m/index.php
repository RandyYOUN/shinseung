<?php include("top.php");?>

		<div class="mainplay"></div>

		<section class="mainvideo">
			<video muted loop playsinline autoplay id="myVideo">
				<source src="resources/images/video.mp4" type="video/mp4">
				</source>
			</video>
			<span id="currentTime">0</span>
		</section>

		<section class="maintext">
			<div class="slider">
				<div class="maintextBox maintext01">
					<div>
						<h2>방문할 필요없이 세금신고는 기본이고,<br>매출 누락까지 꼭 필요한 서비스에요!</h2>
						<h3>카페 / 정*웅 사장님 </h3>
					</div>
				</div>
				<div class="maintextBox maintext02">
					<div>
						<h2>일일이 말하거나 입력할 필요없이 기장부터 <br>신고까지 다 알아서 해주니 정말 편해요</h2>
						<h3>미용실 / 임*녕 원장님 </h3>
					</div>
				</div>
				<div class="maintextBox maintext03">
					<div>
						<h2>영수증 그때 그때 찍어만 주면 알아서 해주니 <br>마음도 편하고, 손도 편하고, 너무 편해요</h2>
						<h3>건설업 / 조*훈 대표님 </h3>
					</div>
				</div>
			</div>
		</section>

		<script>

			var slider = $('.maintext .slider');

			slider.slick({
				autoplay: false,
				slidesToShow: 1,
				slidesToScroll: 1,
				swipe: false,
				prevArrow: '',
				nextArrow: '',
				fade: true,
				speed: 1000
			});


			$(".maintext .slider").on("beforeChange", function () {
				TweenMax.fromTo('.maintext h2', 1, { x: 300, opacity: 0 }, { x: 0, opacity: 1, ease: Power4.easeOut });
				TweenMax.fromTo('.maintext h3', 1, { x: 300, opacity: 0 }, { x: 0, opacity: 1, ease: Power4.easeOut });

			});

			$(function () {
				$('#myVideo').get(0).load();
				$('#myVideo').get(0).play();

			});

			if ($('#myVideo').get(0).play) {
				$('.mainplay').removeClass("playon");
			} else {
				$('.mainplay').addClass("playon");
			}

			$('.mainplay').on('click', function () {
				if (!$('.mainplay').hasClass("playon")) {
					$('#myVideo').get(0).pause();
					$('.mainplay').addClass("playon");
				} else {
					$('#myVideo').get(0).play();
					$('.mainplay').removeClass("playon");
				}

			});

			setInterval(function () {

				$('#currentTime').text(parseInt($('#myVideo').get(0).currentTime));

				var change = Number(parseInt($('#myVideo').get(0).currentTime));
				if ((change == 13) || (change == 21)) {
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

		<section class="link">
			<img src="resources/images/linkpeople.png">
			<h1>스마트 세무회계</h1>
			<h2>혼자 고민하지 마시고 전문가에게 상담 받아보세요</h2>
			<div>
				<input type="tel" name="NEW_HP1" id="NEW_HP1" placeholder="핸드폰번호를 입력해주세요"
					onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
				<button type="button" name="action1" id="action1" class='IfdoVirtualPage' data-url='tel_request.html' data-title='전화상담 요청'>전화상담 요청</button>
				<a href="javascript:ChannelIO('show');" class='chatting IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'>채팅상담</a>
			</div>
		</section>

 		<section class="case">
			<h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
			<div class="tabsWrap">
				<ul class="tabtop">
					<li class="tabmenu active"><span>세무기장</span></li>
					<li class="tabmenu"><span>종합소득세</span></li>
				</ul>
				<section class=" tabarea case01">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<h4>세무기장 / 부동산중개업</h4>
								<ul>
									<li>업종코드 : 701201 (부동산)</li>
									<li>매출액 : 1억 80만원</li>
									<li><span>일반</span>예상 세액 2,128만원 </li>
									<li><span>세무톡</span>예상 세액 300만원</li>
								</ul>
								<h5><span>-1,828</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>세무기장 / 서비스업 </h4>
								<ul>
									<li>업종코드 : 940500 (서비스)</li>
									<li>매출액 : 1억 6,047만원</li>
									<li><span>일반</span>예상 세액 1,431만원 </li>
									<li><span>세무톡</span>예상 세액 -352만원</li>
								</ul>
								<h5><span>-1,783</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>세무기장 소매업</h4>
								<ul>
									<li>업종코드 : 523422 (소매업)</li>
									<li>매출액 : 1억 4,045만원</li>
									<li><span>일반</span>예상 세액 383만원 </li>
									<li><span>세무톡</span>예상 세액 19만원</li>
								</ul>
								<h5><span>-364</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>양도소득세 신고 / 1세대 2주택</h4>
								<ul>
									<li>업종코드 : 552107 (음식업)</li>
									<li>매출액 : 5억 9,352만원</li>
									<li><span>일반</span>예상 세액 1091만원 </li>
									<li><span>세무톡</span>예상 세액 758만원</li>
								</ul>
								<h5><span>-333</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</section>
				<section class=" tabarea case02">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<h4>종합소득세 신고</h4>
								<ul>
									<li>업종코드 : 742104</li>
									<li>수입금액 : 1억 4,582만원</li>
									<li><span>일반</span>예상 세액 1,106만원 </li>
									<li><span>세무톡</span>예상 세액 591만원</li>
								</ul>
								<h5><span>-515</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>종합소득세 신고</h4>
								<ul>
									<li>업종코드 : 940909/940600</li>
									<li>수입금액 : 6,082만원</li>
									<li><span>일반</span>예상 세액 411만원 </li>
									<li><span>세무톡</span>예상 세액 35만원</li>
								</ul>
								<h5><span>-376</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>종합소득세 신고</h4>
								<ul>
									<li>업종코드 : 701201</li>
									<li>수입금액 1억 5,230원</li>
									<li><span>일반</span>예상 세액 452만원 </li>
									<li><span>세무톡</span>예상 세액 267만원</li>
								</ul>
								<h5><span>-185</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>종합소득세 신고</h4>
								<ul>
									<li>업종코드 : 525101</li>
									<li>수입금액 : 4,538만원</li>
									<li><span>일반</span>예상 세액 166만원 </li>
									<li><span>세무톡</span>예상 세액 45만원</li>
								</ul>
								<h5><span>-121</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</section>
			</div>
		</section>

		<section class="compare">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<h2><span>세무톡을<br>모르는 사장님</span><img src="resources/images/compare02.png"></h2>
						<h3>
							<p>그냥 그런 세무서비스 매달 기장료는 꼬박꼬박 나가는데~</p>
							<p>절세가 되고 있는건지 ?<br> 세무 문의하면 답변도 느리고~<br> 챙겨야할 증빙은 왜 이리 많은지~<br> 4대보험 , 두루누리는 어떻게 되고 있는건지~
							</p>
							<p>딱 남들이 하는 만큼만 해주는 애매하고 답답하니</p>
							<p>사업에만 전념하기 힘드네!</p>
						</h3>
					</div>
					<div class="swiper-slide">
						<h1><span>세무톡을<br>아는 사장님</span><img src="resources/images/compare01.png"></h1>
						<dl>
							<dt>
								<h4>사업걱정 끝</h4>
								<h5>매출, 매입, 손익, 카드매출 누락까지 <span>한눈에 보이는 사업현황</span></h5>
							</dt>
							<dt>
								<h4>자료제출 NO</h4>
								<h5>인공지능 AI로 번거롭게 챙기던 세무 증빙자료<span>이젠 따로 챙길 필요 없이 자동수집</span></h5>
							</dt>
							<dt>
								<h4>비용절감 OK</h4>
								<h5>창업초기 부담되는 세무수수료 <span>월 6만원</span></h5>
							</dt>
							<dt>
								<h4>특별한 뉴스톡</h4>
								<h5>정기적으로 사업에 도움되는 <span>정보를 문자, 카톡, 메일로 제공</span></h5>
							</dt>
						</dl>
					</div>
				</div>
			</div>
		</section>

		<section class="decline">
			<ul class="number">
				<li>
					<h1><span>세무비용</span></h1>
					<h2><span>72</span><span>만원 절감</span></h2>
					<h3>연매출 5억미만 개인사업자 기준 월 기장료<br>6만원 부담을 확 줄여드려요</h3>
					<h4><span>바로 [가격] 문의 하기</span></h4>
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
				<li>
					<h1><span>세액공제 감면누락</span></h1>
					<h2><span>95</span><span>% 감소</span></h2>
					<h3>누락된 비용을 꼼꼼히 찾아드려 공제 및<br>감면혜택을 확실히 높여드려요</h3>
					<h4>바로 [세무] 문의 하기</h4>
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
				<li>
					<h1><span>4대보험/노무관리</span></h1>
					<h2><span>70</span><span>% 감소</span></h2>
					<h3>속 썩이던 직원 / 급여관리 알아서 챙겨드리니<br>훌훌 털어버리세요</h3>
					<h4>바로 [노무] 문의 하기</h4>
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
				<li>
					<h1><span>증빙 보관/전송</span></h1>
					<h2><span>90</span><span>% 감소</span></h2>
					<h3>종이 영수증 그때 그때 찍어만 주면 끝<br>따로 챙길 필요 없어요</h3>
					<h4>바로 [증빙] 문의 하기</h4>
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
			</ul>
			<ul class="special">
				<li>
					<div>
						<h1>특별 혜택</h1>
						<h2>사업자 등록대행 & 법인설립 지원 서비스</h2>
						<input type="tel" name="NEW_HP2" id="NEW_HP2" placeholder="핸드폰번호를 입력해주세요"
							onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
						<button type="button" name="action2" id="action2" class='IfdoVirtualPage' data-url='tel_request.html' data-title='전화상담 요청'>문의 / 신청</button>
					</div>
				</li>
				<li>
					<div>
						<h1>특별 혜택</h1>
						<h2>창업자 맞춤형 정책자금 안내 서비스</h2>
						<input type="tel" name="NEW_HP3" id="NEW_HP3" placeholder="핸드폰번호를 입력해주세요"
							onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
						<button type="button" name="action3" id="action3" class='IfdoVirtualPage' data-url='tel_request.html' data-title='전화상담 요청'>문의 / 신청</button>
					</div>
				</li>
			</ul>
		</section>

		<section class="recommendation">
			<h1>세무톡 이런 분께 강력히 권해드립니다</h1>
			<ul>
				<li>
					<h2>신규 창업자</h2>
					<h3>신규사업 오픈 / 스타트업 창업</h3>
					<h4>새로 사업을 시작했는데,<br>세무까지 신경 쓸 여럭이 없는 분<br>들께 창업세무 절세방법을 알려드립니다</h4>
				</li>
				<li>
					<h2>소규모 사업자</h2>
					<h3>직원수 5인 이하 사업장</h3>
					<h4>세무관련 별거 할거 없는데<br>직접 하긴 귀찮고 번거로운 분들께<br>절세 기장을 대행해드립니다</h4>
				</li>
				<li>
					<h2>프리랜서</h2>
					<h3>강사 / 디자이너 / 방송 / IT</h3>
					<h4>종합소득세 신고 때마다 머리가<br>지끈 지끈 아프신 분들께<br>쉽고 편한 절세방법을 알려드립니다</h4>
				</li>
			</ul>
		</section>	

		<section class="review">
			<h1>세무톡 이용후기</h1>
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

		<section class="price">
			<h1>서비스 가격안내</h1>
			<ul>
				<li>
					<h2>개인 사업자</h2>
					<h3>연간 매출액 4억 이하 기준</h3>
				</li>
				<li>
					<span class="pricebg01">건별</span>
					<span>6</span>
					<span>만원</span>
				</li>
				<a></a>
			</ul>
			<a href="sub_price.php" class="allprice">서비스 가격 전체 보기</a>
		</section>

		<section class="provide">
			<h1>상속세 서비스 제공내역</h1>
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
		</section>

		<section class="anywhere">
			<img src="resources/images/anywhereImg.png">
			<h1>전국 어디에서나 쉽고 빠르고 정확하게</h1>
			<h2>세무톡은 방문하지 않으셔도 전문적인 세무업무가
				가능합니다. 지역에 상관없이 편하게 상담받아보세요.</h2>
		</section>

		<section class="best">
			<h1>지금까지 이런 서비스는 없었다</h1>
			<h2>세무톡 스마트 세무회계 서비스 BEST 5</h2>
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide"
						style="background: url('resources/images/bestbg01.png')center top/420px auto no-repeat">
						<ul>
							<h3>실시간 세무 채팅상담</h3>
							<li>친절한 세무 채팅 상담 지원 </li>
							<li>빠른 상담이 가능한 챗봇 시스템 </li>
						</ul>
						<div class="label">
							<span>1</span>BEST
						</div>
					</div>
					<div class="swiper-slide"
						style="background: url('resources/images/bestbg02.png')center top/420px auto no-repeat">
						<ul>
							<h3>편리한 증빙자료 전송</h3>
							<li>컴퓨터에서 채팅창에 파일 전송 가능 </li>
							<li>스마트폰에서 바로 촬영 전송 가능 </li>
						</ul>
						<div class="label">
							<span>2</span>BEST
						</div>
					</div>
					<div class="swiper-slide"
						style="background: url('resources/images/bestbg03.png')center top/420px auto no-repeat">
						<ul>
							<h3>진행사항 자동 알림</h3>
							<li>카톡, SMS를 통해 세무업무 </li>
							<li>처리단계별 친절하게 자동 안내 </li>
						</ul>
						<div class="label">
							<span>3</span>BEST
						</div>
					</div>
					<div class="swiper-slide"
						style="background: url('resources/images/bestbg04.png')center top/420px auto no-repeat">
						<ul>
							<h3>데일리 리포트</h3>
							<li>일일&월간 금융, 재무, 세무현황 </li>
							<li>미수금 내역부터 카드매출 누락까지 안내 </li>
						</ul>
						<div class="label">
							<span>4</span>BEST
						</div>
					</div>
					<div class="swiper-slide"
						style="background: url('resources/images/bestbg05.png')center top/420px auto no-repeat">
						<ul>
							<h3>모바일 뉴스레터</h3>
							<li>세무, 노무, 법률, 경영, 정책 등 <br>사업에 도움을 드리는 맞춤정보 제공 </li>
						</ul>
						<div class="label">
							<span>5</span>BEST
						</div>
					</div>
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-button-next"></div>
				<div class="swiper-button-prev"></div>
			</div>
		</section>

		<section class="benefit">
			<h1>비교불가</h1>
			<ul>
				<li>
					<h2>저렴한 가격</h2>
					<h3>스마트한 세무서비스 일반 세무사무소와 비교가 안됩니다</h3>
					<h4>가격 문의하기</h4>
					<a href="sub_price.php"></a>
				</li>
				<li>
					<h2>실시간 상담</h2>
					<h3>가입없이 클릭 한번으로 바로 상담이 가능합니다.</h3>
					<h4>세무 상담하기</h4>
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
				<li>
					<h2>편리한 자료전송 </h2>
					<h3>스마트폰으로도 바로 전송<br>가능합니다.</h3>
					<h4>자료 전송하기</h4>
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'></a>
				</li>
				<li>
					<h2>맞춤정보 제공</h2>
					<h3>증여세, 카톡, 양도세, 문자로 상속세 등 유용한 정보를 무료로 제공해드립니다.</h3>
					<div>
						<input type="tel" name="NEW_HP4" id="NEW_HP4" placeholder="핸드폰번호를 입력해주세요"
							onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
						<button type="button" name="action4" id="action4">세무소식 무료 구독신청</button>
					</div>
				</li>
			</ul>
		</section>

		<section class="people">
			<h1>70여명의 세무회계 전문가</h1>
			<h2>세무톡은 국세청 33년 경력 신승세무법인의 스마트 세무회계 서비스 브랜드입니다</h2>
			<h3>세무사 이력 전체보기</h3>
			<a href="sub_member.php"></a>
		</section>

		<section class="download">
			<a href="https://play.google.com/store/apps/details?id=com.duzon.android.lulubizpotal&hl=ko"
				class="google">구글플레이 다운로드<img src="resources/images/downwhite.png"></a>
			<a href="https://itunes.apple.com/kr/app/apple-store/id1363039300" class="apple">애플스토어 다운로드<img
					src="resources/images/downblack.png"></a>
		</section>

	<script>

	//메인페이징 첫번째 움직임
	$(window).load(function () {
		$(".bx-pager-item a").eq(0).addClass("active");
	});

	$('.counter').counterUp();

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
		autoplay: { delay: 3000, },
		slidesPerView: 'auto',
		spaceBetween: 10,
		pagination: {
			el: '.case01 .swiper-pagination',
			type: 'fraction',
		},
		navigation: {
			nextEl: '.case01 .swiper-button-next',
			prevEl: '.case01 .swiper-button-prev',
		},
	});

	var swiper = new Swiper('.case02 .swiper-container', {
		slidesPerView: 'auto',
		spaceBetween: 10,
		pagination: {
			el: '.case02 .swiper-pagination',
			type: 'fraction',
		},
		navigation: {
			nextEl: '.case02 .swiper-button-next',
			prevEl: '.case02 .swiper-button-prev',
		},
	});
			
	//전후
	var swiper = new Swiper('.compare .swiper-container', {
			slidesPerView: 'auto',
			spaceBetween: 3,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false,
			},
		});

	var swiper = new Swiper('.review .swiper-container', {
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
		navigation: {
			nextEl: '.review .swiper-button-next',
			prevEl: '.review .swiper-button-prev',
		},

	});

	var swiper = new Swiper('.best .swiper-container', {
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.best .swiper-pagination',
			type: 'fraction',
		},
		navigation: {
			nextEl: '.best .swiper-button-next',
			prevEl: '.best .swiper-button-prev',
		},

	});

	//이런서비스
	$(".best .review-main02").slick({
		infinite: true,
		fade: true
	});

	</script>

<?php include("bottom.php");?>