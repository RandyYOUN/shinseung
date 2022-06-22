	
	<section class="customer">
			<!--a href="javascript:ChannelIO('show');"><span>채팅상담</span><span>쉽고 빠른 상담! 자료 전송까지 OK! </span></a-->
			<!--div class="partnership">
				<h1>제휴문의</h1><h1>070-4870-0916</h1>
				<h2>ss11@sostax.co.kr</h2>
				<input type="tel" name="NEW_HP5" id="NEW_HP5" placeholder="핸드폰번호를 입력해주세요"
							onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
						<button type="button" name="action5" id="action5">문의 / 신청</button>
			</div-->
			<div class="callcenter">
				<h1>양도/증여/상속 전화상담</h1>
				<h2>평일 오전 10시 ~ 오후 6시<br>
					토,일,공휴일 휴무
				</h2>
				<h3>1899-9533</h3>
				<a class="call" href="tel:1899-9533">전화걸기</a>
			</div>
			<div class="callcenter">
				<h1>기장/신고 전화상담</h1>
				<h2>평일 오전 10시 ~ 오후 6시<br>
					토,일,공휴일 휴무
				</h2>
				<h3>1899-3582</h3>
				<a class="call" href="tel:1899-3582">전화걸기</a>
			</div>
		</section>

		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>개인정보보호책임자 : 정혜숙 </li>
				<li>대표자 : 변기영</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li>대표번호 : 1899-3582</li>
				<li>ss11@sostax.co.kr </li>
				<li>서울특별시 강남구 테헤란로 114 14층 (역삼빌딩, 역삼세무서)</li>
				<li>Copyright(c) 2019 shinseung rights reserved</li>
			</ul>
		</footer>
	</div>
	<!--wrap-->
	
	<div class="mgnb">
		<a href="index.php">
			<h1><img src="resources/images/logo.png"></h1>
		</a>
		<ul>
			<li class="on">
				<a href="sub_transfertax.php">양도/상속/증여 </a>
			</li>
			<li>
				<a href="sub_tax.php">기장/신고 </a>
			</li>
			<li>
				<a href="sub_review.php">사용자리뷰 </a>
			</li>
			<li>
				<a href="sub_price.php"> 서비스가격 </a>
			</li>
			<li>
				<a href="sub_smart.php"> 스마트세무 </a>
			</li>
			<li>
				<a href="sub_member.php"> 구성원 </a>
			</li>
			<li>
				<a href="sub_news.php">세무뉴스</a>
			</li>
		</ul>
		<a href="javascript:mGnbClose();" class="mGnbClose"><i></i></a>
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


	$(".best .review-main02").slick({
		infinite: true,
		fade: true
	});


	//지점안내 레이어팝업
	$('.wrap').prepend('<div class="mask"></div>');

	//레이어팝업닫기
	$(".locationPop .close,.videoPop .close,.counselingPop .close ").click(function () {
		$(".locationPop").css("display", "none");
		$(".videoPop").css("display", "none");
		$(".mask").css("display", "none");
		$(".counselingPop").css("display", "none");
		$('.counselingPop').find('span').css("display", "inline-block");
		player.stopVideo();
		//$('.modalVideo ul > a').removeClass('active');			
	});

	//모바일오픈
	$(".mgnbTop").click(function () {
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
	};

		//서브구성원 더보기
	$('.member h6').each(function () {

		$(this).click(function () {
			var change = $(this).find('span').html();

			$(this).siblings('.more').slideToggle();
			if ($(this).children().text().match('더보기')) {
				$(this).find('img').css("transform", "rotate(-180deg)");
				$(this).find('span').html(change.replace('더보기', '줄이기'));
			}
			else {
				$(this).find('img').css("transform", "rotate(0deg)");
				$(this).find('span').html(change.replace('줄이기', '더보기'));
			}
		});

	});


		var swiper = new Swiper('.s_review .swiper-container', {
		slidesPerView: 'auto',
		spaceBetween: 10,
		autoplay: {
			delay: 3000,
			disableOnInteraction: false,
		},
		pagination: {
			el: '.s_review .swiper-pagination',
			type: 'fraction',
		},
		navigation: {
			nextEl: '.s_review .swiper-button-next',
			prevEl: '.s_review .swiper-button-prev',
		},

	});


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


		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action1').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP1').val();
			var action = "추가";
			var Q_TYPE = "양도상속증여";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "../action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('핸드론 번호를 입력해 주세요');
			}
		});

		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action2').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP2').val();
			var action = "추가";
			var Q_TYPE = "기장";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "../action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('빈칸을 입력해 주세요');
			}
		});

		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action3').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP3').val();
			var action = "추가";
			var Q_TYPE = "세무소식구독";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "../action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('빈칸을 입력해 주세요');
			}
		});


		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action4').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP4').val();
			var action = "추가";
			var Q_TYPE = "구독";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "../action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('빈칸을 입력해 주세요');
			}
		});


		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action5').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP5').val();
			var action = "추가";
			var Q_TYPE = "제휴문의";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "../action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('빈칸을 입력해 주세요');
			}
		});


	});



</script>

<script>
$(document).ready(function(){
    
   $("a[data-toggle='sns_share']").click(function(e){
		e.preventDefault();
		
		var _this = $(this);
		var sns_type = _this.attr('data-service');
		var href = $(location).attr('href');
		var title = _this.attr('data-title');
		var loc = "";
		var img = $("meta[name='og:image']").attr('content');
		
		if( ! sns_type || !href || !title) return;
		
		if( sns_type == 'facebook' ) {
			loc = 'http://www.facebook.com/sharer/sharer.php?u='+href+'&t='+title;
		}
		else if ( sns_type == 'twitter' ) {
			loc = 'http://twitter.com/home?status='+encodeURIComponent(title)+' '+href;
		}
		else if ( sns_type == 'google' ) {
			loc = 'http://plus.google.com/share?url='+href;
		}
		else if ( sns_type == 'pinterest' ) {
			
			loc = 'http://www.pinterest.com/pin/create/button/?url='+href+'&media='+img+'&description='+encodeURIComponent(title);
		}
		else if ( sns_type == 'kakaostory') {
			loc = 'https://story.kakao.com/share?url='+encodeURIComponent(href);
		}
		else if ( sns_type == 'band' ) {
			loc = 'http://www.band.us/plugin/share?body='+encodeURIComponent(title)+'%0A'+encodeURIComponent(href);
		}
		else if ( sns_type == 'naver' ) {
			loc = "http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(href)+"&title="+encodeURIComponent(title);
		}
		else {
			return false;
		}
		
		window.open(loc);
		return false;
	});
    
    
});


	function go_page(num){
		if(num == 0){
			alert("마지막페이지입니다");
		}else if(num == -1){
			alert("첫페이지입니다");
		}else{
			window.location.href="sub_newsview.php?id="+num;
		}
	}



function down(name,dir){
	//alert(name);
	window.open("down.php?fileurl=../"+dir+"&filename="+name);

	/*
	$.fileDownload(str)
		.done(function(){alert('성공'); })
		.fail(function(){alert('실패'); });
	return false;
	*/
}


</script>
</html>