	<section class="chat">	
		<a href="javascript:ChannelIO('show');">
			<h1>채팅상담</h1>
			<h2>쉽고 빠른 증빙자료 전송</h2>
			<img src="resources/images/chatPerson.png"> 
		</a>
	</section>
	
	<footer>
		<a href="http://sostax.kr/index.php?pc=y">PC버전 보기</a>
		<ul>
			<li>신승차이나컨설팅</li>
			<li>대표자 : 현성호</li>
			<li>개인정보보호책임자 : 정혜숙</li>
			<li>사업자등록번호 : 138-81-40489</li>
			<li>서울특별시 강남구 테헤란로4길 6, 2층 214,215호 (역삼동, 강남역 센트럴 푸르지오 시티) / 02-3452-1134 </li>
			<li>Copyright(c) 2019 shinseung rights reserved</li>
		</ul>
	</footer>
	
</div><!--wrap-->
</body>

<script>
//메인슬라이드 
$(".mainVisual ul").bxSlider({
	auto: true,
	autoControls : false,
	speed : 500,
	pause : 6000,
	pager : true,
	controls : true
});

$(".cc ul").bxSlider({
	auto: true,
	autoControls : false,
	speed : 500,
	pause : 3000,
	pager : true,
	controls : true
});

$('#demo1').scrollbox();
	
//메인아코디언
$(".solution ul").hide();
$(".solution div").click(function()	{		
	$(this).find("img").toggle();
	$(".solution ul").not($(this).next(".solution ul").slideToggle(300)).slideUp();	
});	

$('.manScroll ul li a').click(function(){

	var arr = $(this).children('img').attr('src').replace(/[^0-9]/g,"");
	$(this).attr("href","manpower.php?id=#man"+arr);	

});
	
$('.subMan > ul > li, .subMan > ul > div').each(function(){ 
	var subarr = $(this).children('img').attr('src').replace(/[^0-9]/g,"");
	$(this).attr("id","man"+subarr);
});	  
	
</script>
</html>
