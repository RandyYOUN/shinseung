<?php
include "db_info.php";

   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
?>
<script>

	/*
		타이틀, 상단메뉴class on작업
	*/
	function top_menu(str){
		var flag = str;

		//document.getElementById( flag ).setAttribute( 'class', 'on' );
		document.getElementById( 'page_title' ).innerHTML = flag;
	}

</script>
<div class="topwrap">
	<div class="topline"></div>
	<div class="top">
		<div class="toplogo"><a href="main.html"><img src="images/logo.png"></a></div>
		<div class="gnbwrap">
			<ul>
				<li>
					<a href="list_news.php">뉴스톡</a>
				</li>
				<li>
					<a>병의원QnA</a>
					<div>
						<ul>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a>조정료계산</a>
					<div>
						<ul>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
							<li><a href="">User</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a>세무일정</a>
				</li>
				<li>
					<a>고객리스트's </a>
				</li>
				<li>
					<a>주택임대 </a>
				</li>
				<li>
					<a>종합소득세 신청 </a>
				</li>
				<li>
					<a>콜백리스트</a>
				</li>
				<li id="RPA">
					<a>RPA</a>
					<div>
						<ul>
							<li><a href="list_RPA_inc.php">종합소득세</a></li>
							<li><a href="list_RPA_vat.php">부가세</a></li>
						</ul>
					</div>
				</li>
				<li>
					<a>Dev</a>
				</li>
			</ul>
		</div>
	</div>
</div>