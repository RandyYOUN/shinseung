<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
$id = "";

$id = $_GET['id'];

if($id != ""){
	
$result = @mysqli_query($connect,"SELECT *, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_ , (
CASE 
	WHEN IFNULL(IMG_URL ,'') = '' THEN
		CASE 
			WHEN C_CATE = 'c_tra' THEN 'http://taxtok.kr/resources/images/qna_tra.jpg'
            WHEN C_CATE = 'c_inh' THEN 'http://taxtok.kr/resources/images/qna_inh.jpg'
            WHEN C_CATE = 'c_gtx' THEN 'http://taxtok.kr/resources/images/qna_give.jpg'
            WHEN C_CATE = 'c_hos' THEN 'http://taxtok.kr/resources/images/qna_hos.jpg'
			ELSE 'http://taxtok.kr/resources/images/default.jpg' 
        END
	ELSE IMG_URL 
    END 
) AS IMG_URL_, CATE,ifnull((SELECT MAX(ID) FROM SS_NEWS WHERE ID < $id AND VISIBLE = 'Y'),0) AS PRE, ifnull((SELECT MIN(ID) FROM SS_NEWS WHERE ID > $id AND VISIBLE = 'Y'),0) AS NEXT,ifnull(substring_index(FILE_URL, '.', -1),'down') as FILE_EXT FROM SS_NEWS where ID = $id AND VISIBLE='Y' ORDER BY ID DESC;") or die("SQL error");

}else{
	echo "<script>alert('올바르지 않은접근입니다.'); windwo.history.back();</scipt>";
}



include "top.php";
?>
	<div class="wrap">


		<header>
			<a href="index.php"><img src="resources/images/logo.png"></a>
			<a href="#" class="mgnbTop" title="모바일 메뉴 열기">
				<div>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</a>
		</header>

		<section class="subvisual sub_newsbg">
			<h1>뉴스톡</h1>
		</section>
<?php
while ($row = mysqli_fetch_array($result)) {

?>
		<div class="s_news">

			<script type="text/javascript">
				$(document).ready(function () {
						$('.newsview .contents h4 div').find('*').css("height","auto");
						$('.newsview .contents h4 div').find('*').css("width","100%");
						$('.newsview .contents h4 div').find('*').css("font-size","15px");
						$('.newsview .contents h4 div').find('*').css("box-sizing","border-box");
				});
			</script>

			<section class="newsview">
				<div class="contents">
					<h1><?php echo $row["SUBJECT"] ?></h1>
					<h3><?php echo $row["NEWS_REGUSER"].' '.$row["NEWS_REGUSER_COMP"] ?></h3>
					<h2><?php echo $row["REGDATE_"] ?></h2>
					<?php
if($row["FILE_URL"] != "" && $row["FILE_EXT"]){
?>
	<div style="font-size:13px;padding:5px;"><b>첨부파일 :</b><a href="http://taxtok.kr/admin/upload/<?php echo $row["FILE_URL"] ?>" target="_blank">&nbsp;<img width="20px" src="http://taxtok.kr/admin/resources/images/icons/<?php echo $row["FILE_EXT"] ?>.png">&nbsp;<font color="gray"><?php echo $row["FILE_URL"] ?></font></a></div><br>
<?		
}
?>
					<h4>
						<div><?php echo $row["CONTENTS_"] ?></div>
					</h4>
				</div>
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
				<div class="form">
					<h1>양도세 . 상속세 . 증여세 <br> 세무기장 . 부가세 . 종합소득세</h1>					
				</div>
				<a href="javascript:ChannelIO('show');">채팅상담</a>

				<div class="letter">
					<h3>맞춤정보 제공 </h3>
					<h4>정기적으로 카톡 또는 문자로 세무, 정책자금, 사업관련 필요정보를 맞춤제공해드립니다</h4>
					<input type="tel" name="NEW_HP3" id="NEW_HP3" placeholder="핸드폰번호를 입력해주세요"
						onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
					<button type="button" name="action3" id="action3">세무소식 무료 구독신청</button>
				</div>
			</section>
		</div>


		<?php include("bottom.php");?>