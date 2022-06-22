<?php include("top.php");?>
	<main>
		<section class="mainVisual">
			<ul>
				<li>
						<img src="resources/images/mainVisual01.jpg" alt="" class="bg" />
						<div>
							<h2>원스톱 한국 투자 기업 지원 센터</h2>
							<h3>한국에서의 사업이 편해집니다</h3>
							<dl>
								<dd>
									<p><img src="resources/images/mainVicon0101.png"></p>
									<p>신규 법인설립</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0102.png"></p>
									<p>지점 설립</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0103.png"></p>
									<p>연락사무소 설치</p>
								</dd>
							</dl>
						</div>
				</li>

				<li>
						<img src="resources/images/mainVisual02.jpg" alt="" class="bg" />
						<div>
							<h2>원스톱 한국 투자 기업 지원 센터</h2>
							<h3>글로벌 세무그룹 신승이 책임집니다</h3>
							<dl>
								<dd>
									<p><img src="resources/images/mainVicon0201.png"></p>
									<p>세무기장</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0202.png"></p>
									<p>세무신고</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0203.png"></p>
									<p>세금절세</p>
								</dd>
							</dl>
						</div>
				</li>

				<li>
						<img src="resources/images/mainVisual03.jpg" alt="" class="bg" />
						<div>
							<h2>원스톱 한국 투자 기업 지원 센터</h2>
							<h3>맞춤형 노무솔루션을 제공합니다</h3>
							<dl>
								<dd>
									<p><img src="resources/images/mainVicon0301.png"></p>
									<p>인력채용</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0302.png"></p>
									<p>근로계약서</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0303.png"></p>
									<p>급여아웃소싱</p>
								</dd>
							</dl>
						</div>
				</li>

			</ul>
		</section>

		<section class="counsel">
			<div class="fL">
				<!--div class="counselList">
					<h2>상담접수</h2>
					<div id="demo1" class="scroll-text">
						<ul>
<?php
while ($row = mysqli_fetch_array($result)) {
?>	
							<li><span><?PHP echo $row["CATE_NAME"]?></span><span><?PHP echo $row["COMPANY"]?></span><span><?PHP echo $row["DD"]?></span></li>
<?}?>
						</ul>
					</div-->
				</div>
			</div>

			<div class="fR">
				<div class="counselGo">
					<h2>지금 바로 상담하기</h2>
					<h3>원활한 채팅 상담을 도와드립니다</h3>
					<a href="javascript:ChannelIO('show');"></a>
				</div>
			</div>
		</section>

		<section class="link">
			<div>
				<ul>
					<li>
						<img src="resources/images/linkKorea.png">
						<h2>National Tax Service</h2>
						<h3>[한국] 국세청</h3>
						<h4>view</h4>
						<a href="https://www.nts.go.kr/eng/" target="_blank"></a>
					</li>

					<li>
						<img src="resources/images/linkKorea.png">
						<h2>Ministry of Employment</h2>
						<h3>[한국] 고용노동부</h3>
						<h4>view</h4>
						<a href="http://www.moel.go.kr/english/main.jsp" target="_blank"></a>
					</li>

					<li>
						<img src="resources/images/linkChina.png">
						<h2>Embassy of China</h2>
						<h3>[주한] 중국대사관</h3>
						<h4>view</h4>
						<a href="http://kr.china-embassy.org/chn/" target="_blank"></a>
					</li>

					<li>
						<img src="resources/images/linkKorea.png">
						<h2>Ministry of Foreign Affairs</h2>
						<h3>[한국] 외교부</h3>
						<h4>view</h4>
						<a href="http://www.mofa.go.kr/eng/index.do"  target="_blank"></a>
					</li>

					<li>
						<img src="resources/images/linkKorea.png">
						<h2>Ministry of Trade</h2>
						<h3>[한국] 산업통상자원부</h3>
						<h4>view</h4>
						<a href="http://english.motie.go.kr/www/main.do"  target="_blank"></a>
					</li>
				</ul>
			</div>
		</section>

		<section class="new">
			<h1>한국에서의 사업이 편해집니다</h1>
			<h2>신승세무사사무소는 당신의 유능한 조수로서 각종 세무회계 관련 업무를 세심하게 준비합니다</h2>
			<ul class="title">
				<li><img src="resources/images/new01.png"><span>법인설립</span>	</li>
				<li><img src="resources/images/new02.png"><span>세무상담</span>	</li>
				<li><img src="resources/images/new03.png"><span>세무기장</span>	</li>
				<li><img src="resources/images/new04.png"><span>세금절세</span>	</li>
				<li><img src="resources/images/new05.png"><span>노무자문</span>	</li>
			</ul>
			<ul class="qr">
				<span>온라인 상담</span>
				<span>중문 온라인서비스<br>간편,신속,정확</span>
				<img src="resources/images/qr.png">
			</ul>
			<div>
				<section class="rollingImg">
					 <div class="swiper-container">
						<div class="swiper-wrapper">
						  <div class="swiper-slide" style="background:url('resources/images/rolling01.png');"></div>
						  <div class="swiper-slide" style="background:url('resources/images/rolling02.png');"></div>
						  <!--div class="swiper-slide" style="background:url('resources/images/rolling03.png');"></div-->
						  <div class="swiper-slide" style="background:url('resources/images/rolling04.png');"></div>
						  <div class="swiper-slide" style="background:url('resources/images/rolling05.png');"></div>
						  <div class="swiper-slide" style="background:url('resources/images/rolling06.png');"></div>
						</div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					  </div>
					
				</section>
				<section class="rollingText">
					<ul>
						<li>
							<h1>중국 유니택스 서울지사</h1>
							<h2>중국 유니택스 서울지사, 국내 최대 규모 중국어 서비스 네트워크 구비하고 있습니다</h2>
						</li>
						<li>
							<h1>국세청 출신 전문가 다수</h1>
							<h2>국세청 출신 세무사를 포함하여, 경험이 풍부한 베테랑 전문가 다수가 당신의 업무를 처리하고 있습니다</h2>
						</li>
						<li>
							<h1>유창한 중국어 의사소통</h1>
							<h2>신승은 중국어를 할 줄 아는 세무사를 다수 보유하고 있어, 언제라도 중국어로 세무 상담 및 각종 업무를 할 수 있습니다</h2>
						</li>
					</ul>
				</section>
			</div>
		</section>

		<section class="allpeople">
			<div>
				<h1>복잡한 세무업무를 알아서 해드립니다</h1>
				<h2>20여년 노하우를 갖춘 70여명의 세무회계 및 경영컨설팅 전문가와 함께 하세요</h2>
			</div>
		</section>

		<section class="manpower">
			<h1>MAN POWER</h1>
			<h2>한국 유일! 최강의 중국 전문 인력을 보유하고 있습니다</h2>

			<div class="tabBlock">
					<ul class="tabBlock-tabs">
						<li class="tabBlock-tab is-active">한국진출전략</li>
						<li class="tabBlock-tab">한국세무자문</li>
						<li class="tabBlock-tab">한국회계자문</li>
						<li class="tabBlock-tab">한국법률노무</li>
					</ul>

					<div class="tabBlock-content">
						<p></p>
						<div class="tabBlock-pane">
							<div class="manMain">
								<img src="resources/images/manMain03.png">
								<div class="fR">
									<h1>한국진출전략 본부</h1>
									<h2>한현우</h2>
									<h3>한양대학교 중문학과 학사<br>북경대학교 경영대학원 석사<br>중소기업흥공단 前근무<br>중국 진출컨설팅경력 18년</h3>
								</div>
							</div>
							<div class="manSub"> 
								<ul>
									<li>
										<img src="resources/images/manpowerSub0301.png">
										<h4>노준석</h4>
										<h5>경기대학교 경영학 학사<br>신사업기획 및 마케팅 경력 19년<br>WEB & APP / 프랜차이즈 기획<br>세무, 노무, 법무 토탈 솔루션 구축</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0302.png">
										<h4>현강철</h4>
										<h5>가천대학교 경영학 학사<br>한국 시장 조사 전담<br>한국법인 설립 담당</h5>
									</li>
								</ul>
							</div><!--touchSlider-->
						</div><!--tabBlock-pane-->

						<div class="tabBlock-pane">
							<div class="manMain">
								<img src="resources/images/manMain02.png">
								<div class="fR">
									<h1>한국세무 본부</h1>
									<h2>황재윤 세무사</h2>
									<h3>
										육군사관학교 졸업<br>
										경북대 경영학 석사<br>
										前 주중한국대사관 세무협력관<br>
										前 국세청 심사 담당관<br>
										前 조세심판원 조사관<br>
										前 중부청 국세심사위원<br>
									</h3>
								</div>
							</div>

							<div id="touchSlider" class="touchSlider">
								<ul>
									<!--li>
										<img src="resources/images/manpowerSub0201.png">
										<h4>심지현 세무사</h4>
										<h5>가천대 세무회계학 전공<br>한국 세법 상담 업무 담당<br>중국법령정보센터 세무 상담</h5>
									</li-->
									<li>
										<img src="resources/images/manpowerSub0202.png">
										<h4>필명경 세무사/회계사</h4>
										<h5>중국 산동대학교 회계학 학사<br>리산회계법인 청도지사 근무<br>중국 청도시 국가자본위원회 감사자문위원</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0203.png">
										<h4>박호열 세무사</h4>
										<h5>국세청 33년 근무<br>국세청 재산제세과 등 근무<br>강남, 반포, 성남, 수원, 안양 세무서 근무<br>前 국세청 소득세과<br>前 국세청 부가세과<br>前 강남, 반포 세무서</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0204.png">
										<h4>전명호 세무사</h4>
										<h5>국세청 38년 근무<br>국세청 조사과 등 근무<br>前 중부지방국세청근무<br>前 화성세무서 재산세과장<br>前 시흥세무서 부가세과장</h5>
									</li>
								</ul>
							</div><!--touchSlider-->
						</div><!--tabBlock-pane-->
						
						<div class="tabBlock-pane">
							<div class="manMain">
								<img src="resources/images/manMain04.png">
								<div class="fR">
									<h1>한국회계 본부</h1>
									<h2>오종석 회계사</h2>
									<h3>
										한국 공인회계사, 한국 세무사<br>
										고려대학교 경제학 전공<br>
										서울대학교 대학원 경영학 석사<br>
										중국인민대학교 경제학 박사<br>
										중국기업 컨설팅경력 22년
									</h3>
								</div>
							</div>

							<div class="manSub">
								<ul>
									<li>
										<img src="resources/images/manpowerSub0208.png">
										<h4>안장순 회계사</h4>
										<h5>공인회계사<br>법인감사 및 세무진단<br>M&A 및 투자인수 자문<br>기업 설립/청산 및 재무회계 자문
										<br>세무조정 및 성실신고 컨설팅<br>세무회계컨설팅 20년 경력</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0206.png">
										<h4>변기영 세무사</h4>
										<h5>단국대학교 세무학 학사<br>하나은행 근무/위드회계법인 근무<br>외국투자기업 세무조사 경력 20년<br>신승세무법인 대표/세무회계 컨설팅 19년<br>
											  주요 계약 세무문제 검토 및 자문<br>절세 장단기 계획 수립</h5>
									</li>	
								</ul>
							</div><!--touchSlider-->
						</div><!--tabBlock-pane-->
						
						<div class="tabBlock-pane">
							<div class="manMain">
								<img src="resources/images/manMain01.jpg">
								<div class="fR">
									<h1>한국법률 본부</h1>
									<h2>김용덕</h2>
									<h3>중국인민대학교 경제학 박사<br>성균관대학교 무역연구소 연구원<br>기업설립 전략컨설팅</h3>
								</div>
							</div>
							<div class="manSub">
								<ul>
									<li>
										<img src="resources/images/manpowerSub0101.png">
										<h4>정혜숙</h4>
										<h5>강남대학교 세무학 학사<br>중국 법인장<br>한국투자 컨설팅 20년 경력</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0102.png">
										<h4>이정희</h4>
										<h5>한국예술대학 문예창작과 학사<br>용역법인공감산재연구소 차장<br>노무&산재 전문상담 15년 경력</h5>
									</li>
								</ul>
							</div><!--touchSlider-->
						</div><!--tabBlock-pane-->
						
				</div><!--tabBlock-content-->
			</div><!--tabBlock-->
		</section>

		<section class="video">		
			<div id="AfZ_Ob_zcRg">
				<img src="resources/images/videoPlay.png">
				<h2>중국기업 실무자 대상 한국세무 세미나</h2>
				<h3>SHINSEUNG CHINA Seoul Global Business Center</h3>				
			</div>
			<ul>
				<a id="qKzuWk6LuBU">
					<img src="resources/images/videoPlay.png">
					<span>신규사업자를 위한 세무기초 지식</span>
				</a>
				<a id="fv6NeNWH368">
					<img src="resources/images/videoPlay.png">
					<span>기업소득세</span>
				</a>
				<a id="33hTQeMRSk4">					
					<img src="resources/images/videoPlay.png">
					<span>종합소득세</span>					
				</a>
				<a id="JIMKhSPHGuM">
					<img src="resources/images/videoPlay.png">
					<span>증치세</span>
				</a>
				<a id="lqdfv_T1i78">
					<img src="resources/images/videoPlay.png">
					<span>세무조사</span>
				</a>
				<a id="nE_EDP_lJ9U">
					<img src="resources/images/videoPlay.png">
					<span>원천징수와 4대보험</span>
				</a>
			</ul>			
		</section>	

		<section class="videoPop">
			<div id="player"></div>
			<p class="close"></p>			
		</section>

		<script>

			//레이어팝업 닫기
			$(".videoPop .close ").click(function() {	
				$(".videoPop").css("display","none");
				$(".mask").css("display","none");	
				player.stopVideo();
			});	

			//세마나영상 레이어팝업
			$('.video ul a, .video div').click(function(){
				player.loadVideoById(this.id);
				$(".mask").css("display","block");
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

		

		<section class="onesolution">
			<div>
				<h1>한국투자 전문 토탈솔루션</h1>
				<h2>한국 투자의 모든 리스크에 대한 토탈솔루션을 원스톱으로 제공 </h2>

				<ul>
					<li>
						<div>
							<h3>중국기업 한국투자 법인설립 자문</h3>
						</div>
						<span>
							<h4>투자에 적합한 회사를 만드세요!<br>유형별로 최적화된 설립 전략과 외국인 투자 혜택을 지금 바로 확인해보세요</h4>
							<ol>
								<li>사전개업 준비 지원 및 법인설립 자문</li>
								<li>인수&합병 기업의 세무상 기업가치 평가</li>
								<li>사업장 입지 선정</li>
								<li>한국비자 취득</li>
								<li>한국 법인설립 등기</li>
								<li>외국인 투자기업 등록</li>
								<li>벤처기업등록지원, 연구소 및 설치업무 자문</li>
							</ol>
						</span>
					</li>
					<li>
						<div>
							<h3>장부기장 및 세무신고</h3>
						</div>
						<span>
							<h4>신승차이나컨설팅은 중국 유니택스 네트워크의 <br>하나인 Member Firm로써 아래 세무 분야에서<br> 종합적이고 전문화된 서비스를 제공하고 있습니다</h4>
							<ol>
								<li>장부기장 대행</li>
								<li>세무 신고 및 세무 조정</li>
								<li>세금회계 및 절세 방안 자문</li>
								<li>M&A 인수관련 세무 실사</li>
								<li>한국지사 내부 감사 및 경영진단 보고</li>
								<li>한국지사 세무조사 대응</li>
								<li>회사매각/ 청산자문</li>
							</ol>
						</span>
					</li>
					<li>
						<div>
							<h3>노무 자문</h3>
						</div>
						<span>
							<h4>한국노동법에 부합하는 인사제도부터 직원 채용<br>지원까지 종합적인 노무 서비스를 중국어로 지원해<br>드립니다</h4>
							<ol>
								<li>한국노동법에 부합하는 인사제도 및 급여 설계</li>
								<li>기업평가(인수&합병 기업의 세무상 기업가치 평가)</li>
								<li>전화, 이메일, 방문 상담을 통한 인사·노무 지원</li>
								<li>서면 의견서 요청 시 의견서 제시</li>
								<li>근로계약서, 도급∙파견 계약서 등 각종 계약서 제정 및 검토</li>
								<li>취업규칙을 최신 법령 및 회사 Policy에 맞게 정비</li>
								<li>연차수당, 연장근로수당 및 퇴직금 등 지급 금액의 적절성 검토</li>
							</ol>
						</span>
					</li>
				</ul>
			</div>
		</section>	
		
		<section class="matrix">
			<h1>신승차이나컨설팅 단계별 컨설팅 매트릭스</h1>		
			<div class="step0">
				<dl>
					<dd>한국투자/법인설립</dd>
					<dd>세무회계</dd>
					<dd>법률노무</dd>
				</dl>
			</div>

			<div class="step01">
				<h2>사업계획</h2>
				<div>
					<p></p>	
					<h3><span>STEP1</span></h3>
					<i></i>
				</div>
				<dl>
					<dd>
						<ol>
							<li>사전개업 준비 지원<span>(법인설립 자문)</span></li>
							<li>기업평가<span>(인수&합병 기업의 세무상 기업가치 평가)</span></li>
							<li>사업장 입지 선정</li>
						</ol>
					</dd>
					<dd>
						<ol>
							<li>중국투자기업 설립<span>(외국인투자기업 신고 /법인설립 자문 및 등록증 발급</span></li>
							<li>사업계획에 따른 수익성 사전분석</li>
						</ol>
						
					</dd>
					<dd>
						<ol>
							<li>직원채용 지원</li>
							<li>계약서 등 노무필요서류 제공</li>
							<li>임금설계 자문</li>							
						</ol>
					</dd>
				</dl>
			</div>			
			
			<div class="step02">
				<h2>사업운영</h2>
				<div>
					<p></p>	
					<h3><span>STEP2</span></h3>
					<i></i>
				</div>
				<dl>
					<dd>
						<ol>
							<li>한국비자 취득</li>
							<li>한국 법인설립 등기</li>
							<li>와국인 투자기업 등록</li>
							<li>회사 세무회계 시스템 운영 자문<span>(벤처기업등록지원, 연구소 및 설치업무 자문)</span></li>
							<li>인수&합병 시 업무 대행<span>(합병절차진행, 재무구조 분석)</span></li>
						</ol>
					</dd>
					<dd>
						<ol>
							<li>장부기장/세무신고 대행</li>
							<li>한국지사 재무보고서(매월/분기/연말보고서 작성 및 자문)</li>
							<li>이전가격 및 조세조약 등 국제조세 대한 자문<span>(정산가격 산출방법 및 신고서 작성/ 사전신청 업무)</span></li>
							<li>회사 세무회계 시스템 운영 자문<span>(벤처기업등록지원, 연구소 및 설치업무 자문)</span></li>
							<li>외국인투자에 대한 조세감면 신청</li>
						</ol>
					</dd>
					<dd>
						<ol>
							<li>노무현황분석</li>
							<li>4대보험처리 자문</li>
							<li>인원교육 자문</li>
							<li>한국노동법 준수</li>
						</ol>
					</dd>
				</dl>
			</div>								
			
			<div class="step03">
				<h2>구조조정 및 EIXT</h2>
				<div>
					<p></p>	
					<h3><span>STEP3</span></h3>	
				</div>
				<dl>
					<dd>						
						<ol>
							<li>법인청산 등기</li>
							<li>사업자등록증 폐업신고</li>
						</ol>						
					</dd>
					<dd>						
						<ol>
							<li>구조조정에 대한 자문</li>
							<li>회사매각/ 청산 세무자문</li>
							<li>실사를 통한 청산가치 산정</li>
							<li>자산 처리방안 자문</li>
							<li>청산소득에 대한 법인세 검토</li>
							<li>주주에 대한 증여의제 검토</li>
						</ol>
					</dd>
					<dd>
						<ol>
							<li>합법적 직원정리 자문</li>
							<li>직원 정리해고 자문 및 지원</li>
							<li>인원구조조정</li>
							<li>퇴직금 문제해결</li>
						</ol>
					</dd>					
				</dl>
			</div>			
			
		</section>

		<section class="price">
			<div>
				<h1>서비스 가격안내</h1>
				<ul>
					<li class="priceBuild">
						<h2>법인설립</h2>
						<h3><span>건당</span><span>30</span><span>만원~</span></h3>
						<ol>
							<li>외국인투자신고절자 안내</li>
							<li>외투법인 회사설립 등기</li>
							<li>사업자등록 진행</li>
							<li>외국인투자기업 등록</li>
						</ol>
					</li>
					<li class="priceTax">
						<h2>세무기장</h2>
						<h3><span>매월</span><span>20</span><span>만원~</span></h3>
						<ol>
							<li>전담 인력 배정</li>
							<li>장부 기장 대행 및 친절 상담</li>
							<li>외투기업 조세감면 지원</li>
							<li>중문 재무보고서 지원</li>
							<li>세무톡 APP / WEB 사용</li>
							<li>증빙자료 전송 및 보관</li>
							<li>신고서 작성 및 세무 신고대행</li>
							<li>외투기업 조세감면 지원</li>
						</ol>
					</li>
					<li class="priceLabor">
						<h2>노무자문 </h2>
						<h3><span>건당</span><span>50</span><span>만원</span></h3>
						<ol>
							<li>인력채용 지원</li>
							<li>한국 노동법  부합한 노동 계약서 작성</li>
							<li>회사 취업규칙 작성</li>
							<li>급여 테이블 작성</li>
							<li>4대 보험 사무 대행</li>
							<li>4대 보험 절세 컨설팅</li>
							<li>노동분쟁 자문 및 지원</li>
						</ol>
					</li>
				</ul>
			</div>
		</section>

		<section class="china">
			<div class="unitax">
				<h1>중국 최초의 AAAAA급 세무사 사무소</h1>
				<h2>유니택스는 국가세무총국의 승인을 거쳐 2009년 자본금 5000만 위안으로 설립, 등록하고 전국 단위의 구역을 넘나들며<br>업무를 진행할 수 있는 대형 세무사 사무소로 중국 세무사 업계 최초로 최고 등급인 AAAAA를 수상하였습니다.<br>
					전국 주요 성시에 1500여명의 종업원과 세무사 500여 명을 포함해 모두 4억 원이 넘는 서비스를 운영하고 있습니다.</h2>
			</div>
			<div class="sh">
				<h3>SINSEUNG<br><span>CHINA CONSULTING MEMBER</span></h3>
				<h4>중국 UNI-TAX (유니택스 세무사사무소 유한공사) 신승세무법인는 중국 유니택스 세무사사무소 유한공사의 서울지사입니다</h4>
			</div>
		</section>

		<section class="korea">
			<div>
				<div>
					<h2>중국과 한국간 쌍방향<br>종합경영컨설팅 서비스 수행</h2>
					<ul>
						<li>신승세무법인</li>
						<!--li>신승회계법인</li-->
						<li>신승법무법인</li>
						<li>신승차이나 컨설팅</li>
					</ul>
					<h3>글로벌 세무전문 그룹 신승세무법인 수도권 15개 지점</h3>
					<h4>신승차이나컨설팅 한국투자기업지원센터는 한국기업의 중국 진출 및 사업 안착에 대한 컨설팅 노하우와 오랜 경험을 바탕으로 한국에 진출코자 하는 중국기업에 대한 한국 투자 및 법인설립,
							한국 세무회계, 한국노무컨설팅을 지원하고 있습니다.<br><br>
							특히, 재한중국기업 90%가 밀집되어있는 수도권 지역에 15개 지점을 운영하고 있어 체계적이고 긴밀하게 지원할 수 있습니다.
					</h4>
				</div>
			</div>
		</section>

		<section class="performance">
			<h1>신승차이나컨설팅 수행실적</h1>
			<h2>다수 중국기업의 한국투자, 법인설립, 세무회계, 노무자문 수행<br>주요 국공기관 및 공단 중국관련 연구용역 수행<br>100여개 주요기업 중국 법률노무 및 세무회계 컨설팅 수행</h2>
			<h3>중국기업</h3>
			<ul>
				<li><img src="resources/images/performance0101.jpg"></li>
				<li><img src="resources/images/performance0102.jpg"></li>
				<li><img src="resources/images/performance0103.jpg"></li>
				<li><img src="resources/images/performance0104.jpg"></li>
				<li><img src="resources/images/performance0105.jpg"></li>
				<li><img src="resources/images/performance0106.jpg"></li>
				<li><img src="resources/images/performance0107.jpg"></li>
				<li><img src="resources/images/performance0108.jpg"></li>
			</ul>
			<h3>한국 국공기관 & 한국기업 </h3>
			<ul>
				<li><img src="resources/images/performance01.jpg"></li>
				<li><img src="resources/images/performance02.jpg"></li>
				<li><img src="resources/images/performance03.jpg"></li>
				<li><img src="resources/images/performance04.jpg"></li>
				<li><img src="resources/images/performance05.jpg"></li>
				<li><img src="resources/images/performance06.jpg"></li>
				<li><img src="resources/images/performance07.jpg"></li>
				<li><img src="resources/images/performance08.jpg"></li>
				<li><img src="resources/images/performance09.jpg"></li>
				<li><img src="resources/images/performance010.jpg"></li>
				<li><img src="resources/images/performance011.jpg"></li>
				<li><img src="resources/images/performance012.jpg"></li>
			</ul>
		</section>

		<section class="catalogue">
			<h1>더 이상 발 품 팔지 마세요</h1>
			<h2>안심하고 사업하실 수 있도록 하나하나 챙겨드립니다 </h2>
			<ul>
				<li>
					<h3>신승차이나컨설팅 브로셔</h3>
					<h4></h4>
					<a href="https://sostax.cn/down/shinseung_consulting_group_ver_1.0.0.pdf" class="cataChina" download ><span>중국어</span> PDF다운로드</a>
					<a href="https://sostax.cn/down/shinseung_consulting_group_ver_old_kor.pdf"><span>한국어</span> PDF다운로드</a>
				</li>
				<li>
					<h3>FAQ 모음집</h3>
					<h4>한국 투자, 법인설립, 법무, 세무회계 노무관련 FAQ 모음집</h4>
					<a href="https://sostax.cn/down/Starting-a_business_in_seoul_Chinese_2015.pdf" class="cataChina"><span>중국어</span> PDF다운로드</a>
					<a href="https://sostax.cn/down/Starting-a_business_in_seoul_Korean_2015.pdf"><span>한국어</span> PDF다운로드</a>
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
<?php include("bottom.php");?>
