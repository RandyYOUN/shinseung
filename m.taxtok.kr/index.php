<?php include("top.php");?>
	<div class="wrap">

		<div class="mainplay"></div>

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
			<h1>무엇을 도와드릴까요?</h1>
			<h2>클릭하시면 더 빠르게 궁금증을 해결 하실 수 있습니다</h2>

			<ul>
				<li>
					<h3>양도소득세 상속세 증여세<a href="sub_transfertax.php"></a></h3>

					<input type="tel" name="NEW_HP1" id="NEW_HP1" placeholder="핸드폰번호를 입력해주세요"
						onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
					<button type="button" name="action1" id="action1">전화상담 요청</button>
				</li>
				<li>
					<h3>세무기장 신고대행<a href="sub_tax.php"></a></h3>

					<input type="tel" name="NEW_HP2" id="NEW_HP2" placeholder="핸드폰번호를 입력해주세요"
						onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
					<button type="button" name="action2" id="action2">전화상담 요청</button>
				</li>
				<a href="javascript:ChannelIO('show');" class="chatting">채팅상담</a>
			</ul>
		</section>

		<section class="price">
			<h1>서비스 가격안내</h1>
			<ul>
				<li>
					<h2>세무기장</h2>
					<h3>개인사업자 연간 매출액 4억 이하 기준 </h3>
					<div>
						<span class="pricebg01">매월</span>
						<span>6</span>
						<span>만원~</span>
					</div>
					<a></a>
				</li>
				<li>
					<h2>부가세 신고 </h2>
					<h3>개인사업자 기준</h3>
					<div>
						<span class="pricebg02">건별</span>
						<span>10</span>
						<span>만원~</span>
					</div>
					<a></a>
				</li>
				<li>
					<h2>종합소득세 신고 </h2>
					<h3>개인사업자 기준 </h3>
					<div>
						<span class="pricebg03">건별</span>
						<span>5</span>
						<span>만원~</span>
					</div>
					<a></a>
				</li>
				<li>
					<h2>사전 절세컨설팅 </h2>
					<h3>사전 절세방안 검토 및 세액 산출 서비스 기준 </h3>
					<div>
						<span class="pricebg04">건별</span>
						<span>10</span>
						<span>만원</span>
					</div>
					<a></a>
				</li>
				<li>
					<h2>양도세 / 증여세 </h2>
					<h3>고액 절세액 발생시 추가 <br>수수료 별도 협의 </h3>
					<div>
						<span class="pricebg05">건별</span>
						<span>15</span>
						<span>만원~</span>
					</div>
					<a></a>
				</li>
				<li>
					<h2>상속세 </h2>
					<h3>고액 절세액 발생시 추가 <br>수수료 별도 협의 </h3>
					<div>
						<span class="pricebg06">건별</span>
						<span>150</span>
						<span>만원</span>
					</div>
					<a></a>
				</li>
			</ul>
			<a href="sub_price.php" class="allprice">서비스 가격 전체 보기</a>
		</section>

		<section class="addtax">
			<h1><span>혼자서 부과세 신고하시려면 힘드시죠?</span></h1>
			<h2>세무톡이 알아서 해드립니다</h2>
			<h3>상담하러가기</h3>
			<a href="javascript:ChannelIO('show');"></a>
		</section>

		<section class="case">
			<h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
			<div class="tabsWrap">
				<ul class="tabtop">
					<li class="tabmenu active"><span>세무기장</span></li>
					<li class="tabmenu"><span>종합소득세</span></li>
					<li class="tabmenu"><span>양도소득세</span></li>
					<li class="tabmenu"><span>증여세</span></li>
					<li class="tabmenu"><span>상속세</span></li>
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
				<section class=" tabarea case03">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<h4>양도소득세 신고 / 토지</h4>
								<ul>
									<li>양도대상 : 토지</li>
									<li>양도가액 : 5억 6천만원</li>
									<li><span>일반</span>예상 세액 1억 5,739만원 </li>
									<li><span>세무톡</span>예상 세액 1억 3,615만원</li>
								</ul>
								<h5><span>-2,124</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>양도소득세 신고 / 토지</h4>
								<ul>
									<li>양도대상 : 토지</li>
									<li>양도가액 : 2억 4천만원</li>
									<li><span>일반</span>예상 세액 5,113만원 </li>
									<li><span>세무톡</span>예상 세액 3,614만원</li>
								</ul>
								<h5><span>-1,499</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>양도소득세 신고 / 주택</h4>
								<ul>
									<li>양도대상 : 주택</li>
									<li>양도가액 : 4억 7천만원</li>
									<li><span>일반</span>예상 세액 3,834만원 </li>
									<li><span>세무톡</span>예상 세액 2,617만원</li>
								</ul>
								<h5><span>-1,217</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>양도소득세 신고 / 1세대 2주택</h4>
								<ul>
									<li>양도대상 : 토지</li>
									<li>양도가액 : 1억원</li>
									<li><span>일반</span>예상 세액 977만원 </li>
									<li><span>세무톡</span>예상 세액 529만원</li>
								</ul>
								<h5><span>-448</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</section>
				<section class=" tabarea case04">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<h4>증여세 신고 / 분양권 </h4>
								<ul>
									<li>증여대상 : 자금출처 증여추정</li>
									<li>증여재산가액 : 4억원</li>
									<li><span>일반</span>예상 세액 6,800만원 </li>
									<li><span>세무톡</span>예상 세액 0만원</li>
								</ul>
								<h5><span>-6,800</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>증여세 신고 / 아파트 </h4>
								<ul>
									<li>증여대상 : 아파트</li>
									<li>증여재산가액 : 5억원</li>
									<li><span>일반</span>예상 세액 8,760만원 </li>
									<li><span>세무톡</span>예상 세액 6,180만원</li>
								</ul>
								<h5><span>-2,580</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>

							<div class="swiper-slide">
								<h4>증여세 신고 / 분양권 </h4>
								<ul>
									<li>증여대상 : 아파트 분양권</li>
									<li>증여재산가액 : 7억 3천만원</li>
									<li><span>일반</span>예상 세액 4,319만원 </li>
									<li><span>세무톡</span>예상 세액 2,969만원</li>
								</ul>
								<h5><span>-1,350</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>증여세 신고 / 주택 </h4>
								<ul>
									<li>증여대상 : 연립주택</li>
									<li>증여재산가액 : 2억 2천만원</li>
									<li><span>일반</span>예상 세액 1,283만원 </li>
									<li><span>세무톡</span>예상 세액 0만원</li>
								</ul>
								<h5><span>-1,283</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
						</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</section>
				<section class=" tabarea case05">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide">
								<h4>상속세 신고 / 부동산 및 금융자산 </h4>
								<ul>
									<li>상속재산 : 부동산 및 금융자산</li>
									<li>총상속재산가액 : 28억 7,800만원</li>
									<li><span>일반</span>예상 세액 2억 1,018만원 </li>
									<li><span>세무톡</span>예상 세액 1억 3,155만원</li>
								</ul>
								<h5><span>-7,863</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>상속세 신고 / 부동산 및 금융자산 </h4>
								<ul>
									<li>상속재산 : 부동산 및 금융자산</li>
									<li>총상속재산가액 : 18억 4,900만원</li>
									<li><span>일반</span>예상 세액 5,204만원 </li>
									<li><span>세무톡</span>예상 세액 2,779만원</li>
								</ul>
								<h5><span>-2,425</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>

							<div class="swiper-slide">
								<h4>상속세 신고 / 부동산 및 금융자산</h4>
								<ul>
									<li>상속재산 : 부동산 및 금융자산</li>
									<li>총상속재산가액 : 18억 4,900만원</li>
									<li><span>일반</span>예상 세액 5,204만원 </li>
									<li><span>세무톡</span>예상 세액 2,779만원</li>
								</ul>
								<h5><span>-2,425</span><span>만원 절세 혜택!</span></h5>
								<a></a>
							</div>
							<div class="swiper-slide">
								<h4>상속세 신고 / 부동산 및 금융자산 </h4>
								<ul>
									<li>상속재산 : 부동산 및 금융자산</li>
									<li>총상속재산가액 : 13억 2,600만원</li>
									<li><span>일반</span>예상 세액 3,954만원 </li>
									<li><span>세무톡</span>예상 세액 2,756만원</li>
								</ul>
								<h5><span>-1,198</span><span>만원 절세 혜택!</span></h5>
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
					<a href="javascript:ChannelIO('show');"></a>
				</li>
				<li>
					<h2>세무 비서</h2>
					<h3>스마트한 세무회계 비서가 내 손안에 쏙 들어옵니다</h3>
					<h4>자세히 알아보기</h4>
					<a href="sub_smart.php"></a>
				</li>
				<li>
					<h2>맞춤정보 제공</h2>
					<h3>카톡, 문자로 세무, 정책, 사업관련 정보를 제공해드립니다. </h3>
					<div>
						<input type="tel" name="NEW_HP3" id="NEW_HP3" placeholder="핸드폰번호를 입력해주세요"
							onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
						<button type="button" name="action3" id="action3">세무소식 무료 구독신청</button>
					</div>
				</li>
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
	var swiper = new Swiper('.case03 .swiper-container', {
		slidesPerView: 'auto',
		spaceBetween: 10,
		pagination: {
			el: '.case03 .swiper-pagination',
			type: 'fraction',
		},
		navigation: {
			nextEl: '.case03 .swiper-button-next',
			prevEl: '.case03 .swiper-button-prev',
		},
	});

	var swiper = new Swiper('.case04 .swiper-container', {
		slidesPerView: 'auto',
		spaceBetween: 10,
		pagination: {
			el: '.case04 .swiper-pagination',
			type: 'fraction',
		},
		navigation: {
			nextEl: '.case04 .swiper-button-next',
			prevEl: '.case04 .swiper-button-prev',
		},

	});

	var swiper = new Swiper('.case05 .swiper-container', {
		slidesPerView: 'auto',
		spaceBetween: 10,
		pagination: {
			el: '.case05 .swiper-pagination',
			type: 'fraction',
		},
		navigation: {
			nextEl: '.case05 .swiper-button-next',
			prevEl: '.case05 .swiper-button-prev',
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