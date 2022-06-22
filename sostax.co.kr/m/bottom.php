
		<section class="call">
			<div>
				<h1>전화상담</h1>
				<h2>평일 오전 10시 ~ 오후 6시<br>토,일,공휴일 휴무</h2>
				<h3><span>강남본점</span>02-3452-0608</h3>
			</div>
			<a href="tel:02-3452-0608">전화걸기</a>
		</section>

		<section class="chat">
			<h1>채팅상담</h1>
			<h2>수임처 상담/세무상담/신규상담</h2>
			<h3>쉽고 빠르게 증빙자료 전송가 가능</h3>
			<h4>상담하러가기</h4>
			<!-- <span class="chat01 animated jello"><img src="resources/images/chat01.png"></span> -->
			<span class="chat01"><img src="resources/images/chat01.png"></span>
			<span class="chat02"><img src="resources/images/chat02.png"></span>
			<span class="chat03"><img src="resources/images/chat03.png"></span>
			<a href="http://pf.kakao.com/_vexexkC/chat"></a>
		</section>

		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>개인정보보호책임자 : 정혜숙 </li>
				<li>대표자 : 변기영</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li>전화번호 : 02-3452-0608</li>
				<li>서울특별시 강남구 테헤란로 114 14층 (역삼빌딩, 역삼세무서)</li>				
				<li>Copyright(c) 2019 shinseung rights reserved</li>
			</ul>
		</footer>
	</div>
	<div class=" mgnb">
				<a href="index.php">
					<h1><img src="resources/images/logo.png"></h1>
				</a>
				<ul>
					<li>
						<a href="sub_tax.php">세무기장</a>
					</li>
					<li>
						<a href="sub_consulting.php">컨설팅</a>
					</li>
					<li>
						<a href="sub_investigation.php">세무조사</a>
					</li>
					<li>
						<a href="sub_company.php">신승세무법인</a>
					</li>
					<li>
						<a href="people.php">세무사소개</a>
					</li>
					<li>
						<a href="sub_news.php">세무뉴스</a>
					</li>
				</ul>
				<a href="javascript:mGnbClose();" class="mGnbClose">모바일 메뉴 닫기</a>
	</div>
<input type = 'hidden' id = 'tag_str' name='tag_str'></input>

</body>


<script>


/*코멘트 기능 글자수제한 스크립트*/
	function fnChkByte(obj) {
		var maxByte = 600; //최대 입력 바이트 수
		var str = obj.value;
		var str_len = str.length;
	
		var rbyte = 0;
		var rlen = 0;
		var one_char = "";
		var str2 = "";
	
		for (var i = 0; i < str_len; i++) {
			one_char = str.charAt(i);
	
			if (escape(one_char).length > 4) {
				rbyte += 2; //한글2Byte
			} else {
				rbyte++; //영문 등 나머지 1Byte
			}
	
			if (rbyte <= maxByte) {
				rlen = i + 1; //return할 문자열 갯수
			}
		}
	
		if (rbyte > maxByte) {
			alert("한글 " + (maxByte / 2) + "자 / 영문 " + maxByte + "자를 초과 입력할 수 없습니다.");
			str2 = str.substr(0, rlen); //문자열 자르기
			obj.value = str2;
			fnChkByte(obj, maxByte);
		} else {
			document.getElementById('byteInfo').innerText = rbyte;
		}
	}
/*코멘트 기능 글자수제한 스크립트 : End*/

function tag(e){

	var url = window.location.href;
	var name = '@'+e
	//document.getElementById('c_all').setAttribute('class','');
	var tag_str = document.getElementById('tag_str');

	if(url.indexOf(name)>-1){
		//document.getElementById(e).setAttribute('class','');
		tag_str.value = tag_str.value.replace(name,'');
		//url = url.replace('&'+e+'=y','');

	}else{
		//document.getElementById(e).setAttribute('class','active');
		//url += '&'+e+'=y';
		tag_str.value = tag_str.value + name;

	}
	
	if(tag_str.value == ''){
		document.location.replace('sub_news.php?cate=QNA');
	}else{
		document.location.replace('sub_news.php?cate=QNA&tag='+tag_str.value);
	}
}
</script>
<script>

	//모바일오픈
	$(".mMenu").click(function () {
		$(".mgnb").css("display", "block");
		$(".mgnb").animate({ right: 0 }, 300);
		$(".wrap").animate({ left: "-80%" }, 300);
		$(".mask").fadeIn(300);
	});

	//모바일네비 닫기
	function mGnbClose() {
		$(".mgnb").animate({ right: "-80%" }, 300);
		$(".mgnb").fadeOut(300);
		$(".wrap").animate({ left: 0 }, 300);
		$(".mask").fadeOut(300);
		$(".kakaoLink").css("display","none");
	};

	//레이어팝업 닫기
	$(".locationPop .close,.videoPop .close ").click(function () {
		$(".locationPop").css("display", "none");
		$(".videoPop").css("display", "none");
		$(".mask").css("display", "none");
		player.stopVideo();
	});

	//세무사소개위치
	$('.subpeopleCon > li').each(function () {
		var peopleH = $(this).find('dl').height() + 80;
		$(this).css("height", peopleH + "px");
	});
	$('.subpeopleCon > ul > li').each(function () {
		var subarr = $(this).children('img').attr('src').replace(/[^0-9]/g, "");
		$(this).attr("id", "people" + subarr);
	});

	//메인롤링 네비아이콘 초기화
	$(document).ready(function () {
		$(".swiper-pagination span").removeClass("swiper-pagination-bullet-active");
	});
	$(window).load(function () {
		$(".swiper-pagination span").eq(0).addClass("swiper-pagination-bullet-active");
	});

	//메인롤링
	var swiper = new Swiper('.mainVisual .swiper-container', {
		speed: 500,
		loop: true,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.mainVisual .swiper-pagination',
			clickable: true,
		},
	})

	//세무일정롤링
	var swiper = new Swiper('.schedule .swiper-container', {
		slidesPerView: 2.2,
		spaceBetween: 2,
		freeMode: true,
		pagination: {
			el: '.schedule .swiper-pagination',
			type: 'progressbar',
			clickable: true,
		},
	});

	//영상롤링
	var swiper = new Swiper('.video .swiper-container', {
		slidesPerView: 'auto',
		autoplay: {
			delay: 6000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.video .swiper-pagination',
			type: 'fraction',
		},
	});


	//리뷰롤링
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

	//절세컬럼/상담사례 게시물 롤링
	$('#column').scrollbox();
	$('#example').scrollbox();

</script>

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

						var locationTitle = ['지 점', '주 소', '위 치', '주 차', 'Tel', 'Fax', 'Mail'];

						switch (linkName) {
							case "강남본사":
								locationContents = ["강남본사", "서울시 강남구 테헤란로 114 (역삼동) 역삼빌딩 14층", "2호선 강남역 1번 출구 역삼세무서 맞은편", "센트럴프루지오시티 지하 주차 가능 (무료)", "02-3452-0608", "02-3452-0866", "ss1@sostax.co.kr"]
								//alert(0);
								break;

							case "부천지점":
								locationContents = ["부천지점", "경기도 부천시 원미구 신흥로 266번길 화령빌딩 102호", "신중동역 6번출구 부천세무서 건너편", "건물 뒤 주차장 (무료)", "032-323-9620", "032-324-9620", "ss6@sostax.co.kr"]
								break;

							case "용인지점":
								locationContents = ["용인지점", "경기도 용인시 처인구 금학로 155 (역북동)", "동부경찰서 밑", "사무실 앞 주차장 (무료)", "031-335-0608", "031-335-0708", "ss2@sostax.co.kr"]
								break;

							case "광주지점":
								locationContents = ["광주지점", "경기도 광주시 문화로 123(탄벌동) 국제빌딩1층", "경기광주세무서 옆", "경기광주 공설운동장 (무료)", "031-763-3077", "031-763-3060", "ss7@sostax.co.kr"]
								break;

							case "안양지점":
								locationContents = ["안양지점", "경기도 안양시 동안구 시민대로 277 108호 (관양동, 세방글로벌시티)", "4호선 평촌역 2번 출구 동안양세무서 맞은편", "세방글로벌시티 지하 주차 가능 (2시간 주차권 제공)", "031-387-0806", "031-387-0819", "ss3@sostax.co.kr"]
								break;

							case "분당지점":
								locationContents = ["분당지점", "경기도 성남시 분당구 황새울로311번길 14, 서현리더스빌딩 1층 103호", "분당세무서후문 맞은편", "서현리더스빌딩 (주차권 제공)", "031-705-0608", "031-705-0688", "ss8@sostax.co.kr"]
								break;

							case "수원지점":
								locationContents = ["수원지점", "수원시 영통구 청명남로 14번지 1층", "분당선영통역 1번,2번출구 동수원세무서 맞은편", "사무실 앞 도로변 공용주차장 (유료)", "031-202-9620~9622", "031-202-9608", "ss4@sostax.co.kr"]
								break;

							case "기흥지점":
								locationContents = ["기흥지점", "경기도 용인시 기흥구 흥덕2로117번길 15", "기흥세무서 건물내 1층 (무료)", "건물내 지하주차", "031-211-0608", "031-213-0688", "ss9@sostax.co.kr"]
								break;

							case "일산지점":
								locationContents = ["일산지점", "경기도 고양시 일산동구 중앙로 1305-30 일산마이다스오피스텔 112호", "3호선 정발산역 2번 출구 고양세무서 맞은편", "일산마이다스빌딩 지하 주차 가능 (주차권 제공)", "031-932-0863", "031-932-0869", "ss5@sostax.co.kr"]
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

<script>

	$(document).ready(function () {

		fetchUser();
		function fetchUser() {

			var action = "select";
			//users 리스트를 select.php 에서 받아온다.
			
			var request = new Request();	
			var request2 = new Request();
			var cate = request.getParameter("cate");
			var tag = request2.getParameter("tag");
			var str_url = window.location.href;

			if(str_url.indexOf('/sub_news.php') != -1){
				if(cate != ""){
					document.getElementById(cate).setAttribute('class','active');

						if(cate == "QNA"){
							document.getElementById("sub_menu").setAttribute('style','display:block');
							document.getElementById("blank").setAttribute('style','display:none');


							if(tag ==""){
								document.getElementById('c_all').setAttribute('class','active');
							}else{
								document.getElementById('tag_str').value=tag;
								var strArray = tag.split('@');
								//alert(tag.match(/#/g).length);
								for(i=0; i< tag.match(/@/g).length+1; i++){
									if(strArray[i] !=''){
										document.getElementById(strArray[i]).setAttribute('class','active');									
									}


								}


							}

						}else{
							document.getElementById("sub_menu").setAttribute('style','display:none');
							document.getElementById("blank").setAttribute('style','display:block');
						
						}


				}else{
					document.getElementById('ALL').setAttribute('class','active');
					document.getElementById("sub_menu").setAttribute('style','display:none');
					document.getElementById("blank").setAttribute('style','display:block');
				}
			}
		}

	});



</script>
</html>