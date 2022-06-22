		<section class="bottomLink">
			<div>
				<h1>전문상담 <span>02-3452-1134<span></h1>
				<h2>상담가능시간 평일 오전 9시 ~ 오후 6시 / 토,일,공휴일 휴무</h2>
			</div>
			<h3><span>채팅상담</span><br>쉽고 빠른 전문상담 및 자료 전송까지 OK</h3>
			<img src="resources/images/bottomlinkChat.png">
			<a href="javascript:ChannelIO('show');"></a>
		</section>
				
		<section class="group">
			<ul>
				<a href="http://www.sostax.co.kr/" target="_blank">
					<h1>신승세무법인</h1>
					<h2>세무상담센터</h2>
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
				
	</main>

	<footer>
		<h1><a href="index.php"><span>중국진출기업지원센터</span><img src="resources/images/logoFooter.png"><span>신승차이나컨설팅</span></a></h1>
		<ul>
			<li>신승IPS</li>
			<li>대표자:현성호</li>
			<li>개인정보보호책임자:정혜숙</li>
			<li>사업자등록번호:138-81-40489</li>
			<li>서울특별시 강남구 테헤란로 114 14층 (역삼빌딩, 역삼세무서)</li>
			<li>02-3452-1134</li>
		</ul>
		<h3>Copyright(c) 2019 sinseung rights reserved</h3>
		<div><img src="resources/images/20200123_qrcode.jpg" width="90px"></div>
	</footer>

 </body>
<script>

	/*mainVisual*/
	$(".mainVisual ul").bxSlider({
		auto: true,
		autoControls : false,
		speed : 500,
		pause : 6000,
		pager : true,
		controls : true
	});

	$('#demo1').scrollbox();

	$('#touchSlider').touchSlider({
		roll: false,
		view: 2,
		gap: 0
	});

	var swiper = new Swiper('.rollingImg .swiper-container', {
		 autoplay: {
			delay: 3000,
		  },
		effect: 'fade',
		spaceBetween: 30,
		navigation: {
			nextEl: '.rollingImg .swiper-button-next',
			prevEl: '.rollingImg .swiper-button-prev',
		},
	});


	$(".snsBtn").click(function(){		
		 
		$(this).siblings("ul").toggleClass("snsMove");		
		var active = $(this).siblings("ul").hasClass('snsMove');	
		
		if (active) {
			$(this).siblings("ul").removeClass("snsMoveout");
		}else{			
			$(this).siblings("ul").addClass("snsMoveout");			
		}
	});

	$(window).scroll(function() {
		if ($(this).scrollTop() > 1500) {
			$('.topBtn').fadeIn();
		} 
		else {
			$('.topBtn').fadeOut();
		}
	});
	
	$(".topBtn").click(function() {
		$('html, body').animate({scrollTop : 0}, 400);
		return false;
	});
 </script>
 </html>