<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
$id = $_GET['id'];

if($id != ""){
	
$result = @mysqli_query($connect,"SELECT *, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_ , (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/y2509g/news/images/tax.png' ELSE IMG_URL END ) AS IMG_URL_ , CATE,ifnull((SELECT MAX(ID) FROM SS_NEWS WHERE ID < $id AND VISIBLE = 'Y'),0) AS PRE, ifnull((SELECT MIN(ID) FROM SS_NEWS WHERE ID > $id AND VISIBLE = 'Y'),0) AS NEXT FROM SS_NEWS where ID = $id ORDER BY ID DESC; ") or die("SQL error");

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
			<h1>세무뉴스</h1>
			<h2>혁신적인 세무회계 서비스 세무톡이 선도합니다</h2>
		</section>
	</header>


<?php
while ($row = mysqli_fetch_array($result)) {

?>	
	<div class="s_news">



		<section class="newsview">
			<h1><?php echo $row["SUBJECT"] ?></h1>
			<h2><?php echo $row["REGDATE_"] ?></h2>
			<h3><?php echo $row["NEWS_REGUSER"].' '.$row["NEWS_REGUSER_COMP"] ?></h3>
<?php
//if($row["FILE_URL"] != "" && $row["FILE_EXT"]){
?>
	<h5><b>첨부파일 :</b><a href="javascript:down('<?php echo $row["FILE_URL"] ?>','admin/upload/');" >&nbsp;<img width="20px" src="http://taxtok.kr/admin/resources/images/icons/<?php echo $row["FILE_EXT"] ?>.png">&nbsp;<font color="gray"><?php echo $row["FILE_URL"] ?></font></a></h5><br>
<?		
//}
?>
			<h4>
				<?php echo $row["CONTENTS_"] ?>
			</h4>
			<div class="sns">
				<a href="#" data-toggle="sns_share"  data-service="facebook" data-title="페이스북 SNS공유" class="facebook"></a>
				<a href="#" data-toggle="sns_share"  data-service="google" data-title="구글 SNS공유" class="google"></a>
				<a href="#" data-toggle="sns_share"  data-service="pinterest" data-title="핀터레스트 SNS공유" class="pinterest"></a>
				<a href="#" data-toggle="sns_share"  data-service="twitter" data-title="트위터 SNS공유" class="tweeter"></a>
			</div>
		</section>

		<section class="newslist">
			<a href="javascript:go_page(<?php echo $row["PRE"]?>);" class="prev">PREV</a>
			<a href="javascript:go_page(<?php echo $row["NEXT"]?>);" class="next">NEXT</a>
			<a href="sub_news.php" class="btnlist">LIST</a>
		</section>
<?php
}
?>
		<section class="s_newsform">
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
		</section>
	</div>

<?php 
include "subbottom.php";
include "footer.php";
?>

</html>