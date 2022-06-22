<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
$id = $_GET[id];

if($id != ""){
	
$result = @mysql_query("SELECT *, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_ , (
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
) AS IMG_URL_ , CATE,ifnull((SELECT MAX(ID) FROM SS_NEWS WHERE ID < $id AND VISIBLE = 'Y'),0) AS PRE, ifnull((SELECT MIN(ID) FROM SS_NEWS WHERE ID > $id AND VISIBLE = 'Y'),0) AS NEXT,ifnull(substring_index(FILE_URL, '.', -1),'down') as FILE_EXT FROM SS_NEWS where ID = $id ORDER BY ID DESC;") or die("SQL error");

}else{
	echo "<script>alert('올바르지 않은접근입니다.'); windwo.history.back();</scipt>";
}


include_once 'top.php'; 

?>



		<section class="subpeopleTitle subtaxBg">
			<header>
				<h1><a href="index.php"><img src="resources/images/logo.png"></a></h1>
				<a href="#" class="mMenu" title="모바일 메뉴 열기">
					<span></span>
					<span></span>
					<span></span>
				</a>
			</header>
			<h1>세무뉴스</h1>
			<h2>성공하는 사장님들의 선택</h2>
		</section>

	<?php
while ($row = mysql_fetch_array($result)) {

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
	<div style="font-size:13px;padding:5px;"><b>첨부파일 :</b><a href="http://taxtok.kr/admin/upload/<?php echo $row["FILE_URL"] ?>" target="_blank">&nbsp;<img style="width:20px;" src="http://taxtok.kr/admin/resources/images/icons/<?php echo $row["FILE_EXT"] ?>.png">&nbsp;<font color="gray"><?php echo $row["FILE_URL"] ?></font></a></div><br>
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

			<section class="location">
				<div class="locationCon">
					<h1>신승세무법인 지점안내</h1>
					<h2>글로벌 세무전문 그룹 신승세무법인 수도권 15개 지점</h2>
					<ul>
						<li>강남본사</li>
						<li>부천지점</li>
						<li>용인지점</li>
						<li>광주지점</li>
						<li>안양지점</li>
						<li>분당지점</li>
						<li>수원지점</li>
						<li>기흥지점</li>
						<li>일산지점</li>
						<li>신사지점</li>
						<li>용산지점</li>
						<li>안산지점</li>
						<li>안산법원지점</li>
						<li>시흥지점</li>
						<li>시흥정왕지점</li>
					</ul>
				</div>
			</section>

		</div>

		<?php include_once 'bottom.php'; ?>