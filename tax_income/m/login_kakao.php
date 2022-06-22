<?php include_once '../../kakao/common.php'; ?>
<?php include("top.php");?>


		<section class="subvisual sub_pricebg">
			<h1></h1>
		</section>

		<script type="text/javascript" src="resources/js/SimpleTabs02.js"></script>
		<section class="subcon">
			<div class="subtabsWrap">
				
				<section class="subtabarea1 s_price" id="s_price4" name="s_price4">
					<section class="subtext">
        				<h1 style="text-align: center;margin: auto;display: block;">카톡으로 로그인</h1>
        				<h2 style="text-align: center;margin: auto;display: block;margin-bottom: 50px;">세무톡<br>쉽고 편한 세무서비스<br>카톡으로 알림을 받아보세요</h2>
        				<button onclick="location.href='<?php echo $KAKAO_OAUTH_URI?>'" style="margin: auto;display: block;"><img alt="" src="resources/images/kakao_login_medium_wide.png"></button>
        			</section>
					
				</section>

			</div>
		</section>

		<?php include("bottom.php");?>