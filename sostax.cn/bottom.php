	
		<section class="bottomLink">
			<div>
				<h1>微信</h1>
				<img src="resources/images/wechat.png">
				<h3>SHINSEUNGIPS</h3>
			</div>
			<h3><span>聊天商谈</span><br>方便快捷的发送凭证资料</h3>
			<img src="resources/images/bottomlinkChat_verC.png">
			<a href="javascript:ChannelIO('show');"></a>
		</section>
		<section class="group">
			<ul>
				<a href="http://sostax.co.kr"  target="_blank"><img src="resources/images/group01.png"></a>
				<a href="http://tax-free.kr" target="_blank"><img src="resources/images/group02.png"></a>
				<a href="http://sostax.kr/out/" target="_blank"><img src="resources/images/group03.png"></a>
				<a href="http://sostax.kr/" target="_blank"><img src="resources/images/group04.png"></a>
			</ul>
		</section>
	</main>

	<footer>
		<h1><img src="resources/images/footerLogo_verC.png"></h1>
		<ul>
			<li>新承IPS</li>
			<li>代表:玄成镐</li>
			<li>个人信息保护负责人:郑惠淑</li>
			<li>营业证号:138-81-40489</li>
			<li>首尔特别市江南区德黑兰路114号驿三大厦14层</li>
			<li>+82-2-3452-1134</li>
		</ul>
		<h3>Copyright(c) 2019 shinseung rights reserved</h3>
		<div><img src="resources/images/20200123_qrcode.jpg" width="100px;"></div>
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
 </script>
</html>
