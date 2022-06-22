		<section class="customer">
			<ul>
				<li class="tel">
					<img src="resources/images/customer.png">
					<h1>전화상담</h1>
					<h2>평일 오전 10시 ~ 오후 6시<br>토,일,공휴일 휴무</h2>
					<h3><strong>강남본점</strong>02-3452-0608</h3>
				</li>
				<li>
					<h4>거래처 상담</h4>
					<h5>신규 계약 상담</h5>
					<span>상담하기</span>
					<a href="http://pf.kakao.com/_vexexkC/chat"></a>
				</li>
				<li>
					<h4>세무 상담</h4>
					<h5>양도소득세, 증여상속세 문의</h5>
					<span>상담하기</span>
					<a href=" https://taxtoc.channel.io"> </a> </li> <li>
						<h4>신규 상담</h4>
						<h5>신규 기장 및 신고 문의 </h5>
						<span>상담하기</span>
						<a href="http://pf.kakao.com/_vexexkC/chat"></a>
				</li>
			</ul>
		</section>

		<section class="group">
			<ul>
				<a href="http://medi-tax.kr" target="_blank">
					<h1>신승세무법인</h1>
					<h2>병의원세무지원센터</h2>
				</a>
				<a href="http://tax-free.kr" target="_blank">
					<h1>신승세무법인</h1>
					<h2>체납면책지원센터</h2>
				</a>
				<a href="http://sostax.kr/out/" target="_blank">
					<h1>신승차이나컨설팅</h1>
					<h2>중국진출기업지원센터</h2>
				</a>
				<a href="http://sostax.kr/" target="_blank">
					<h1>신승차이나컨설팅</h1>
					<h2>한국투자기업지원센터</h2>
				</a>
			</ul>
		</section>

		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>대표자 : 변기영</li>
				<li>개인정보보호책임자 : 정혜숙</li>
				<li>대표번호 : 02-3452-0608</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li>서울특별시 강남구 테헤란로 114 14층 (역삼빌딩, 역삼세무서)</li>
			</ul>
			<h3>Copyright(c) 2019 shinseung rights reserved</h3>
		</footer>


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


function closeWinAt00(winName, expiredays) {   
   setCookieAt00( winName, "done" , expiredays);   
   var obj = eval( "window." + winName );  
   obj.style.display = "none";  
}  
  
// 쿠키 가져오기  
function getCookie( name ) {  
   var nameOfCookie = name + "=";  
   var x = 0;  
   while ( x <= document.cookie.length )  
   {  
       var y = (x+nameOfCookie.length);  
       if ( document.cookie.substring( x, y ) == nameOfCookie ) {  
           if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )  
               endOfCookie = document.cookie.length;  
           return unescape( document.cookie.substring( y, endOfCookie ) );  
       }  
       x = document.cookie.indexOf( " ", x ) + 1;  
       if ( x == 0 )  
           break;  
   }  
   return "";  
}  

// 00:00 시 기준 쿠키 설정하기  
// expiredays 의 새벽  00:00:00 까지 쿠키 설정  
function setCookieAt00( name, value, expiredays ) {   
    var todayDate = new Date();   
    todayDate = new Date(parseInt(todayDate.getTime() / 86400000) * 86400000 + 54000000);  
    if ( todayDate > new Date() )  
    {  
    expiredays = expiredays - 1;  
    }  
    todayDate.setDate( todayDate.getDate() + expiredays );   
     document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"   
  }  
  


	$(document).ready(function () {
		fetchUser();

		function fetchUser() {

			var action = "select";
			//users 리스트를 select.php 에서 받아온다.
			$.ajax({
				url: "select.php",
				method: "POST",
				data: { action: action },
				success: function (data) {
					$('#NEW_HP').val('');
				}
			})

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
<script>

	//메인페이징 첫번째 움직임
	$(window).load(function () {
		$(".bx-pager-item a").eq(0).addClass("active");
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

	//리뷰롤링
	$(".review-main").slick({
		autoplay: true,
		infinite: true,
		fade: true,
		asNavFor: '.review-sub,.review-text'
	});

	$(".review-text").slick({
		infinite: true,
		fade: true,
		arrows: false,
		asNavFor: '.review-sub'
	});

	$(".review-sub").slick({
		dots: false,
		infinite: true,
		slidesToShow: 4,
		slidesToScroll: 4,
		focusOnSelect: true,
		asNavFor: '.review-main,.review-text',
		arrows: false,
		variableWidth: true
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

</script>

</html>