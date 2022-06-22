	<section class="chat">	
		<a href="javascript:ChannelIO('show');">
			<h1>聊天商谈</h1>
			<h2>方便快捷的发送凭证资料</h2>
			<img src="resources/images/chatPerson.png"> 
		</a>
	</section>
	
	<footer>
		<a href="http://sostax.cn/index.php?flag_mo=n">PC版</a>
		<ul>
			<li>新承IPS</li>
			<li>代表:玄成镐</li>
			<li>个人信息保护负责人 : 郑惠淑</li>
			<li>营业证号 : 138-81-40489</li>
			<li>+82-2-3452-1134</li>
			<li>首尔特别市江南区德黑兰路114号驿三大厦14层</li>
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
	
$('.subMan > ul > li,.subMan > ul > div').each(function(){ 
	var subarr = $(this).children('img').attr('src').replace(/[^0-9]/g,"");
	$(this).attr("id","man"+subarr);

});	
	
</script>
</html>
