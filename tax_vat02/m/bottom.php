	
		<section class="customer" id="customer" name="customer">
			<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'><span>채팅상담</span><span>쉽고 빠른 상담! 자료 전송까지 OK! </span></a>
			<div>
				<h1>전화상담</h1>
				<h2>평일 오전 10시 ~ 오후 6시<br>
					토,일,공휴일 휴무
				</h2>
				<h3>1899-3582</h3>
				<a class="call" href="tel:1899-3582" class='IfdoVirtualPage' data-url='tel_request.html' data-title='전화상담 요청'>전화걸기</a>
			</div>
		</section>

		<section class="customer" id="customer_hide" name="customer_hide" style="display:none;">
			<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'><span>채팅상담</span><span>쉽고 빠른 상담! 자료 전송까지 OK! </span></a>
			<div>
				<h1>전화상담</h1>
				<h2>평일 오전 10시 ~ 오후 6시<br>
					토,일,공휴일 휴무
				</h2>
				<h3>1899-3582</h3>
				<a class="call" href="tel:1899-3582" class='IfdoVirtualPage' data-url='tel_request.html' data-title='전화상담 요청'>전화걸기</a>
			</div>
		</section>

		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>개인정보보호책임자 : 정혜숙 </li>
				<li>대표자 : 변기영</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li  id="phone_hide" name="phone_hide">대표번호 : 1899-3582(세무빨리)</li>
				<li>ss11@sostax.co.kr </li>
				<li>서울특별시 강남구 테헤란로4길 6, 1층 117호 (역삼동, 강남역 센트럴 푸르지오 시티)</li>
				<li>Copyright(c) 2019 shinseung rights reserved</li>
			</ul>
		</footer>
	</div>
	<!--wrap-->
	
	<div class="mgnb">
		<a href="index.php">
			<h1><img src="resources/images/logo.png"><span class="logotitle">부가세 신고전문</span></h1>
		</a>
		<ul>
			<li>
				<a href="sub_review.php">사용자리뷰</a>
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
				<a href="sub_news.php?cate=VAT">세무뉴스</a>
			</li>
		</ul>
		<a href="javascript:mGnbClose();" class="mGnbClose"><i></i></a>
	</div>
<input type = 'hidden' id = 'tag_str' name='tag_str'></input>


<!-- Start Script for IFDO (부가톡)-->
<script type='text/javascript'>
$(function(){
	$('.IfdoVirtualPage').mousedown(function(e){
		var _data_url = $(this).attr('data-url');
		var _data_title = $(this).attr('data-title');
		if(typeof _NB_PAGE == 'function'){
			_NB_PAGE(_data_url , _data_title);
		}
	});
});
var _NB_gs = 'wlog.ifdo.co.kr'; 
var _NB_MKTCD = 'NVA4202161810';
var _NB_APPVER=''; /* 하이브리드 앱 버전 */
(function(a,b,c,d,e){var f;f=b.createElement(c),g=b.getElementsByTagName(c)[0];f.async=1;f.src=d;
f.setAttribute('charset','utf-8');
g.parentNode.insertBefore(f,g)})(window,document,'script','//script.ifdo.co.kr/jfullscript.js');	
</script>
<!-- End Script for IFDO -->

</body>

<script>


function hide_time(){
	let today = new Date(); 

	var hour = today.getHours();
	var min = today.getMinutes();


//		if(hour >= 10 && hour < 17){
//			$('#customer').attr('style', "display:block;");
//			$('#customer_hide').attr('style', "display:none;");

//		}else{
			$('#customer').attr('style', "display:none;");
			$('#customer_hide').attr('style', "display:block;");
			$('#customer_hide').attr('style', "height:130px;");
			$('#phone_hide').attr('style', "display:none;");		
			$('#phone_hide2').attr('style', "display:none;");		
//		}


}

//hide_time();


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

</html>