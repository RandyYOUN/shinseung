<?php include_once '../kakao/common.php'; ?>
<?php include("../top.php");?>
	<div class="wrap">
	

		<header class="subhead">
			<section class="subnavi">
				<div>
				<?php include("navi.php");?>
				</div>
			</section>

			<section class="subvisual s_pricebg">
			</section>

			<section class="subtext">
				<h1>카톡으로 로그인</h1>
				<h2>세무톡<br>쉽고 편한 세무서비스<br>카톡으로 알림을 받아보세요</h2>
				<button onclick="location.href='<?php echo $KAKAO_OAUTH_URI?>'" style="margin: auto;display: block;"><img alt="" src="resources/images/kakao_login_medium_wide.png"></button>
			</section>
		</header>

		

		<?php include("footer.php");?>
