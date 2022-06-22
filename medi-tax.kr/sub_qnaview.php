<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
empty($_GET["id"]) ? $id = "" : $id = $_GET["id"];

if($id != ""){
	
$QUERY = "SELECT *,phone_fn(PHONE) AS PHONE_ FROM SS_QNAS where ID_ = $id;";
$result =@mysqli_query($connect,$QUERY) or die("SQL error");


}else{
	echo "<script>alert('올바르지 않은접근입니다.'); windwo.history.back();</scipt>";
}

include "top.php";
?>

<script type="text/javascript">
	$(document).ready(function () {
			$('.newsview h4').find('*').css("height","auto");
			$('.newsview h4').find('*').css("width","100%");
			$('.newsview h4').find('*').css("font-size","16px");
				$('.newsview h4').find('*').css("line-height","26px");
			$('.newsview h4').find('img').css("width","auto");
			$('.newsview h4').find('img').css("display","inline-block");
			$('.newsview h4').find('img').parent().css("text-align","center");
	});
</script>

	<header class="subhead">
		<section class="subnavi">
			<div>
				<?php include "navi.php"; ?>
			</div>
		</section>

		<section class="subvisual s_newsbg">
		</section>

		<section class="subtext">
			<h1>국세청 33년경력</h1>
			<h2>병의원 절세와 세무안전을 책입집니다</h2>
		</section>
	</header>


<?php
while ($row = mysqli_fetch_array($result)) {

?>	
	<div class="s_news">



		<section class="newsview">
			<!--h1>이름 : <?php echo $row["CSTNAME"] ?></h1-->
			<h1><?php echo $row["PHONE_"] ?></h1><br>
			<h2><b>Q. 문의 내용</b></h2><BR>
			<h4>
				<div><?php echo $row["CONTENTS"] ?></div>
			</h4><BR><BR><BR><BR><BR><BR>
			<h2><b>A. 답변 내용</b></h2><BR>
			<h4>
				<div><?php echo $row["ANSWER"] ?></div>
			</h4><BR><BR><BR><BR><BR><BR>
			
		</section>

<?php
}
?>
		<!--section class="s_newsform">
			<img src="resources/images/linkpeople.png">
			<div class="form">
				<h1>양도세 . 상속세 . 증여세 <br> 세무기장 . 부가세 . 종합소득세</h1>
				<button type="button" name="action1" id="action1">전화상담 요청</button>
				<a href="javascript:ChannelIO('show');">채팅상담</a>
			</div>

			<div class="letter">
				<h3>맞춤정보 제공 </h3>
				<h4>정기적으로 카톡 또는 문자로 세무, 정책자금, 사업관련 필요정보를 맞춤제공해드립니다 </h4>
				<input type="tel" name="NEW_HP3" id="NEW_HP3" placeholder="핸드폰번호를 입력해주세요"
					onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
				<button type="button" name="action3" id="action3">세무소식 무료 구독신청</button>
			</div>
		</section-->
	</div>

<?php 
##include "subbottom.php";
include "footer.php";
?>

</html>