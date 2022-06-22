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
				<a href="http://sostax.co.kr" target="_blank"><img src="resources/images/group01.png"></a>
				<a href="http://tax-free.kr" target="_blank"><img src="resources/images/group02.png"></a>
				<a href="http://sostax.kr/out/" target="_blank"><img src="resources/images/group03.png"></a>
				<a href="http://sostax.kr/" target="_blank"><img src="resources/images/group04.png"></a>
			</ul>
		</section>

		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>대표자 : 변기영</li>
				<li>개인정보보호책임자 : 정혜숙</li>
				<li>대표번호 : 02-3452-0608</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li>서울특별시 강남구 테헤란로4길 6, 1층 117호 (역삼동, 강남역 센트럴 푸르지오 시티)</li>
			</ul>
			<h3>Copyright(c) 2019 shinseung rights reserved</h3>
		</footer>


	</div>




</body>

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


</script>

</html>