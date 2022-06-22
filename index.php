<?php include("top.php");?>

	<div class="wrap">
		<section id="promotionBanner" class="popup">
			
				<div class="popContents">
					<a href="javascript:ChannelIO('show');">
					<h1>혼자서 세금신고 하시려면 힘드시죠? </h1>
					<h2>세무톡이 알아서 해드립니다</h2>
					<h3>CLICK</h3>
					</a>
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
				<div>
					<?php include("navi.php");?>					
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


		<section class="price" style="margin:100px 0 0 0;">
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
					<a href="sub_price.php"></a>
				</li>
				<li>
					<h2>부가세 신고 </h2>
					<h3>개인사업자 기준</h3>
					<div>
						<span class="pricebg02">건별</span>
						<span>5</span>
						<span>만원~</span>
					</div>
					<a href="sub_price.php"></a>
				</li>
				<li>
					<h2>종합소득세 신고 </h2>
					<h3>개인사업자 기준 </h3>
					<div>
						<span class="pricebg03">건별</span>
						<span>5</span>
						<span>만원~</span>
					</div>
					<a href="sub_price.php"></a>
				</li>
			</ul>
			<ul>
				<li>
					<h2>사전 절세컨설팅 </h2>
					<h3>사전 절세방안 검토 및 세액 산출 서비스 기준 </h3>
					<div>
						<span class="pricebg04">건별</span>
						<span>10</span>
						<span>만원</span>
					</div>
					<a href="sub_price.php"></a>
				</li>
				<li>
					<h2>양도세 / 증여세 </h2>
					<h3>고액 절세액 발생시 추가 수수료 별도 협의 </h3>
					<div>
						<span class="pricebg05">건별</span>
						<span>15</span>
						<span>만원~</span>
					</div>
					<a href="sub_price.php"></a>
				</li>
				<li>
					<h2>상속세 </h2>
					<h3>고액 절세액 발생시 추가 수수료 별도 협의 </h3>
					<div>
						<span class="pricebg06">건별</span>
						<span>150</span>
						<span>만원</span>
					</div>
					<a href="sub_price.php"></a>
				</li>
			</ul>
		</section>

		<section class="link">
			<h1>무엇을 도와드릴까요? </h1>
			<h2>클릭하시면 더 빠르게 궁금증을 해결 하실 수 있습니다</h2>
			<img src="resources/images/linkpeople.png">
			<ul>
				<li>
					<div>
						<h3>양도소득세/ 상속세 / 증여세</h3>
						<h4>자세히 보기</h4>
						<a href="sub_transfertax.php"></a>
					</div>
					<span>
						<div>
							<input type="text" name="NEW_HP1" id="NEW_HP1" placeholder="핸드폰번호를 입력해주세요"
								onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
							<button type="button" name="action1" id="action1">전화상담 요청</button>
							<a href="javascript:ChannelIO('show');">채팅상담</a>
						</div>
					</span>
				</li>
				<li>
					<div>
						<h3>세무기장 신고대행 </h3>
						<h4>자세히 보기</h4>
						<a href="sub_tax.php"></a>></a>
					</div>
					<span>
						<div>
							<input type="tel" name="NEW_HP2" id="NEW_HP2" placeholder="핸드폰번호를 입력해주세요"
								onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
							<button type="button" name="action2" id="action2">전화상담 요청</button>
							<a href="javascript:ChannelIO('show');">채팅상담</a>
						</div>
					</span>
				</li>
			</ul>
		</section>

		<section class="case">
			<h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
			<h2>이미 많은 고객분들이 세무톡으로 탁월한 절세혜택을 경험하고 계십니다 </h2>
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
							<div class="swiper-slide contents">
								<h3><span>1,828만원</span> 절세 혜택!</h3>
								<h4>세무기장 / 부동산중개업</h4>
								<ul>
									<li>기장의무 : 간편장부대상자</li>
									<li>신고유형 : F 유형 (안내문)</li>
									<li>업종코드 : 701201 (부동산)</li>
									<li>매출액 : 1억 80만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>2,128만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>300만원 </strong></p>
								</ul>
								<h5>-1,828만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>1,783만원</span> 절세 혜택 </h3>
								<h4>세무기장 / 서비스업 </h4>
								<ul>
									<li>기장의무 : 복식부기대상자</li>
									<li>신고유형 : C 유형 (안내문)</li>
									<li>업종코드 : 940500 (서비스)</li>
									<li>매출액 : 1억 6,047만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>1,431만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>-352만원 </strong></p>
								</ul>
								<h5>-1,783만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>364만원</span> 절세 혜택 </h3>
								<h4>세무기장 / 소매업 </h4>
								<ul>
									<li>기장의무 : 간편장부대상자</li>
									<li>신고유형 : D 유형 (안내문)</li>
									<li>업종코드 : 523422 (소매업)</li>
									<li>매출액 : 1억 4,045만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>383만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>19만원 </strong></p>
								</ul>
								<h5>-364만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>333만원</span> 절세 혜택!</h3>
								<h4>세무기장 / 1세대 2주택</h4>
								<ul>
									<li>기장의무 : 복식부기대상자</li>
									<li>신고유형 : A 유형(안내문)</li>
									<li>업종코드 : 552107 (음식업)</li>
									<li>매출액 : 5억 9,352만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>1091만원</strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>758만원</strong></p>
								</ul>
								<h5>-333만원</h5>
								<a></a>
							</div>
						</div>
						<!-- <div class="swiper-pagination"></div> -->
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</section>
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
						<!-- <div class="swiper-pagination"></div> -->
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</section>
				<section class=" tabarea case03">
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
				<section class=" tabarea case04">
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
				<section class=" tabarea case05">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<div class="swiper-slide contents">
								<h3><span>7,863만원</span> 절세 혜택!</h3>
								<h4>상속세 신고 / 부동산 및 금융자산 </h4>
								<ul>
									<li>상속재산 : 부동산 및 금융자산</li>
									<li>총상속재산가액 : 28억 7,800만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong class="small">2억 1,018만원 </strong>
									</p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong class="small">1억 3,155만원 </strong>
									</p>
								</ul>
								<h5>-7,863만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>2,425만원</span> 절세 혜택!</h3>
								<h4>상속세 신고 / 부동산 및 금융자산 </h4>
								<ul>
									<li>상속재산 : 부동산 및 금융자산</li>
									<li>총상속재산가액 : 18억 4,900만원</li>

									<p class="taxbefore"><span>일반 예상 세액</span><strong>5,204만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>2,779만원 </strong></p>
								</ul>
								<h5>-2,425만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>2,425만원</span> 절세 혜택!</h3>
								<h4>상속세 신고 / 부동산 및 금융자산 </h4>
								<ul>
									<li>상속재산 : 부동산 및 금융자산</li>
									<li>총상속재산가액 : 18억 4,900만원</li>

									<p class="taxbefore"><span>일반 예상 세액</span><strong>5,204만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>2,779만원 </strong></p>
								</ul>
								<h5>-2,425만원 </h5>
								<a></a>
							</div>
							<div class="swiper-slide contents">
								<h3><span>1,198만원</span> 절세 혜택!</h3>
								<h4>상속세 신고 / 부동산 및 금융자산 </h4>
								<ul>
									<li>상속재산 : 부동산 및 금융자산</li>
									<li>총상속재산가액 : 13억 2,600만원</li>
									<p class="taxbefore"><span>일반 예상 세액</span><strong>3,954만원 </strong> </p>
									<p class="taxafter"><span>세무톡 예상 세액</span><strong>2,756만원 </strong></p>
								</ul>
								<h5>-1,198만원 </h5>
								<a></a>
							</div>
						</div>
						<!-- <div class="swiper-pagination"></div> -->
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</section>
			</div>
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
					<h3>세무 비서 </h3>
					<h4>스마트한 세무회계 비서가 <br>내 손안에 쏙 들어옵니다</h4>
					<h5>자세히 알아보기</h5>
					<a href="sub_smart.php"></a>
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
include "db_info.php";



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

$result = mysqli_query($connect, $QUERY);

while($row = mysqli_fetch_array($result))
{

?>
				<li>
					<a href="../sub_newsview.php?id=<?php echo $row["ID"];?>">
					<h2><?php
					echo mb_strimwidth($row["SUBJECT"],'0','35','...','utf-8');?></h2>
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

$result2 = @mysqli_query($connect ,$QUERY2);

while ($row = mysqli_fetch_array($result2)) {

?>
				<li>
					<a href="../sub_newsview.php?id=<?php echo $row["ID"]?>">
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
/*
				if ($(this).closest('section').hasClass('counseling')) {
					$(this).children('h3').html((textA.substring(0, 40) + "..."));
				}
				if ($(this).closest('section').hasClass('column')) {
					$(this).children('h3').html((textA.substring(0, 40) + "..."));
				}
*/
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
					<img src="resources/images/bestbg04.png" style="left:20px; top:50px;">
					<ul>
						<h5><span>235</span><span>명 사용자 추천</span></h5>
						<h3>언제, 어디서나 사업현황이 한 눈에 보이는</h3>
						<h4>데일리 리포트</h4>
						<li>일일&월간 금융, 재무, 세무현황 </li>
						<li>미수금 내역부터 카드매출 누락까지 안내 </li>
						<div class="label">
							<span>4</span><strong>BEST</strong>
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
							<span>5</span><strong>BEST</strong>
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

		<section class="download">
			<div>
				<h1>지금 다운로드 해보세요<br>세무가 너무 편해집니다</h1>
				<a href="https://play.google.com/store/apps/details?id=com.duzon.android.lulubizpotal&hl=ko"
					class="google">구글플레이 다운로드<span></span></a>
				<a href="https://itunes.apple.com/kr/app/apple-store/id1363039300" class="apple">애플스토어
					다운로드<span></span></a>
			</div>
		</section>

		<section class="customer">
			<ul>
				<li>
					<!--img src="resources/images/call.png">
					<div>
						<h1>전화상담</h1>
						<h2>평일 오전 10시 ~ 오후 6시</h2>
					</div>
					<h3>1899-3582</h3-->
				</li>
				<li>
					<div>
						<h1>채팅상담 </h1>
						<h2>쉽고 빠른 전문상담 및 자료 전송까지 OK! </h2>
					</div>
					<a href="javascript:ChannelIO('show');">상담하기</a>
				</li>
			</ul>
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
			TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/sublogo.png)' });
		}
		else {
			TweenLite.to('.mainnavi', 0, { css: { background: "none", position: "absolute", paddingTop: "30px", boxShadow: "none" } });
			TweenLite.to('.mainnavi ul a li', 0, { css: { color: "#fff" } });
			TweenLite.to('.mainnavi div > a', 0, { backgroundImage: 'url(resources/images/logo.png)' });
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
	var swiper = new Swiper('.case03 .swiper-container', {
		autoplay: false,
		slidesPerView: 4,
		spaceBetween: 30,
		freeMode: true,
		navigation: {
			nextEl: '.case03 .swiper-button-next',
			prevEl: '.case03 .swiper-button-prev',
		},
	});

	var swiper = new Swiper('.case04 .swiper-container', {
		autoplay: false,
		slidesPerView: 4,
		spaceBetween: 30,
		freeMode: true,
		navigation: {
			nextEl: '.case04 .swiper-button-next',
			prevEl: '.case04 .swiper-button-prev',
		},
	});

	var swiper = new Swiper('.case05 .swiper-container', {
		autoplay: false,
		slidesPerView: 4,
		spaceBetween: 30,
		freeMode: true,
		navigation: {
			nextEl: '.case05 .swiper-button-next',
			prevEl: '.case05 .swiper-button-prev',
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

	//이런서비스
	$(".best .review-main02").slick({
		autoplay: true,
		autoplaySpeed: 4000,
		infinite: true,
		speed: 2000,
		fade: true
	});

</script>
