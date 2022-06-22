		<?php include_once 'top.php'; ?>

		<section class="subpeopleTitle subcompanyBg">
			<header>
				<h1><a href="index.php"><img src="resources/images/logo.png"></a></h1>
				<a href="#" class="mMenu" title="모바일 메뉴 열기">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</header>
			<h1>신승세무법인</h1>
			<h2>국세청 33년 경력</h2>
		</section>

		<section class="locationPop">
			<h1></h1>
			<h2></h2>
			<div>
				<a href="http://pf.kakao.com/_RQLxkT/chat" target="_blank" class="chat"><span>채팅상담</span></a><a
					class="call"><span>전화상담</span></a>
			</div>
			<p class="close"></p>
		</section>

		<section class="subcon">
			<section class=" tabarea">
				<h1>대표 인사말</h1>
				<div class="ceo">
					<h3>맘편히 믿고 맡길 수 있는<br>신승세무법인을<br>만들어 가고 있습니다<p>CEO 변기영</p>
					</h3>
					<img src="resources/images/subceo.png" alt="">
				</div>

				<h4>
					<p></p>신승세무법인은 “고객의 성공이 곧 신승의 성공”이라는 사훈 아래 2000년 설립되어 지금까지 정도를 걸으며 혁신을 이뤄내 오직 신승만의 힘으로 굴지의 세무전문가그룹으로
					우뚝
					성장하였습니다.</p>
					<p>20여년간 세무회계 분야에서 컨설팅해온 풍부한 경험과 탁월한 전문지식을 갖춘 70여명의 세무회계 전문가가 성공적인 사업 운영을 위한 원스톱 서비스를 지원해드리고 있습니다.
					</p>
				</h4>
				<h1>회사현황</h1>
				<img src="resources/images/subcompany01.png" alt="">

				<h2>주소</h2>
				<h4>수원시 영통구 청명남로 14번지 1층
				</h4>

				<h2>지점</h2>
				<div class="locationCon">
					<ul>
						<li>강남본사</li>
						<li>부천지점</li>
						<li>용인지점</li>
						<li>광주지점</li>
						<li>안양지점</li>
						<li>분당지점</li>
						<li style="border-color: red;">수원지점</li>
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


				<script>

					var locationChatclear = function () {
						$(".locationPop").find('.chat').css("display", "none");
					}

					var Location = function () {
						$(".locationCon").find('li').each(function () {
							$(this).on("click", function () {

								//초기화
								$('.locationPop h1, .locationPop h2').html('');
								$(".locationPop").find('.chat').css("display", "inline-block");

								//버튼값 불러오기
								var linkName = $(this).text().replace(/[a-z]/gi, '');

								var locationTitle = ['지점', '주소', '위치', '주차', 'tel', 'fax', 'mail'];

								switch (linkName) {
									case "강남본사":
										locationContents = ["강남본사", "서울시 강남구 테헤란로 114 (역삼동) 역삼빌딩 14층", "2호선 강남역 1번 출구 역삼세무서 맞은편", "센트럴프루지오시티 지하 주차 가능 (무료)", "02-3452-0608", "02-3452-0866", "tax@sostax.co.kr"]
										//alert(0);
										break;

									case "부천지점":
										locationContents = ["부천지점", "경기도 부천시 원미구 신흥로 266번길 화령빌딩 102호", "신중동역 6번출구 부천세무서 건너편", "건물 뒤 주차장 (무료)", "032-323-9620", "032-324-9620", "jh0428@sostax.co.kr"]
										break;

									case "용인지점":
										locationContents = ["용인지점", "경기도 용인시 처인구 금학로 155 (역북동)", "동부경찰서 밑", "사무실 앞 주차장 (무료)", "031-335-0608", "031-335-0708", "osm0505@sostax.co.kr"]
										break;

									case "광주지점":
										locationContents = ["광주지점", "경기도 광주시 문화로 123(탄벌동) 국제빌딩1층", "경기광주세무서 옆", "경기광주 공설운동장 (무료)", "031-763-3077", "031-763-3060", "mhs0814@sostax.co.kr"]
										break;

									case "안양지점":
										locationContents = ["안양지점", "경기도 안양시 동안구 시민대로 277 108호 (관양동, 세방글로벌시티)", "4호선 평촌역 2번 출구 동안양세무서 맞은편", "세방글로벌시티 지하 주차 가능 (2시간 주차권 제공)", "031-387-0806", "031-387-0819", "shinseung3@sostax.co.kr"]
										break;

									case "분당지점":
										locationContents = ["분당지점", "경기도 성남시 분당구 황새울로311번길 14, 서현리더스빌딩 1층 103호", "분당세무서후문 맞은편", "서현리더스빌딩 (주차권 제공)", "031-705-0608", "031-705-0688", "shinseung1@sostax.co.kr"]
										break;

									case "수원지점":
										locationContents = ["수원지점", "수원시 영통구 청명남로 14번지 1층", "분당선영통역 1번,2번출구 동수원세무서 맞은편", "사무실 앞 도로변 공용주차장 (유료)", "031-202-9620~9622", "031-202-9608", "omj110269@sostax.co.kr"]
										break;

									case "기흥지점":
										locationContents = ["기흥지점", "경기도 용인시 기흥구 흥덕2로117번길 15", "기흥세무서 건물내 1층 (무료)", "건물내 지하주차", "031-211-0608", "031-213-0688", "shinseung09@sostax.co.kr"]
										break;

									case "일산지점":
										locationContents = ["일산지점", "경기도 고양시 일산동구 중앙로 1305-30 일산마이다스오피스텔 112호", "3호선 정발산역 2번 출구 고양세무서 맞은편", "일산마이다스빌딩 지하 주차 가능 (주차권 제공)", "031-932-0863", "031-932-0869", "lch0216@sostax.co.kr"]
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
									$(".locationPop").find('.call').attr('href', 'tel:' + locationContents[4]);
								}
							})
						})
					}();
				</script>

				<h2>구성원</h2>
				<div class="submember">
					<ul>
						<li>
							변호사<span>2</span>
						</li>
						<li>
							회계사<span>2</span>
						</li>
						<li>
							세무사<span>18</span>
						</li>
						<li>
							컨설턴트<span>52</span>
						</li>
					</ul>
				</div>

				<h2>조직도</h2>
				<div class="organization">
					<ul>
						<li>
							<dl>
								<dt>경영지원본부</dt>
							</dl>
						</li>
						<li>
							<dl>
								<dt>재산제세본부</dt>
								<dd>양도</dd>
								<dd>증여</dd>
								<dd>상속</dd>
								<dd>자금출처</dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt>세무조사본부</dt>
								<dd>기업진단</dd>
								<dd>세무조사대응</dd>
								<dd>모의세무조사</dd>
								<dd>조세심판청구</dd>
							</dl>
						</li>
						<li>
							<dl>
								<dt>세무기장본부</dt>
								<dd>장부기장 대행</dd>
								<dd>세무 조정</dd>
								<dd>젤세방안 자문</dd>
								<dd>결산 신고</dd>
							</dl>
						</li>
					</ul>
				</div>

				<!-- h1>오시는길</h1>
				<img src="resources/images/subcompany02.png" alt="">
				<img src="resources/images/submap.png" alt=""-->
			</section>
		</section>

		<?php include_once 'bottom.php'; ?>