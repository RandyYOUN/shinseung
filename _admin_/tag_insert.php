<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
$id = $_GET[id];

if($id != ""){
	
$result = @mysql_query("SELECT *, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_ , (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/y2509g/news/images/tax.png' ELSE IMG_URL END ) AS IMG_URL_ , CATE,ifnull((SELECT MAX(ID) FROM SS_NEWS WHERE ID < $id AND VISIBLE = 'Y'),0) AS PRE, ifnull((SELECT MIN(ID) FROM SS_NEWS WHERE ID > $id AND VISIBLE = 'Y'),0) AS NEXT FROM SS_NEWS where ID = $id AND VISIBLE='Y' ORDER BY ID DESC;") or die("SQL error");

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
			<h1>뉴스톡</h1>
			<h2>혁신적인 세무회계 서비스 세무톡이 선도합니다</h2>
		</section>
	</header>
<Br>
<Br>
<b>현재설정된 태그</b>
						<div align=''>							
							<ul> 
<?php

$result_tag = @mysql_query("SELECT * FROM SS_TAG WHERE PARENT_TABLE='SS_NEWS' AND PARENT_ID = $id;") or die("SQL error");

while ($row = mysql_fetch_array($result_tag)) {


?>
								<li>tag명 :<?php echo $row["SS_TAG"] ?></li>
								<li>code :<?php echo $row["CODE"] ?></li>
<?php
}
?>
							</ul>
						</div>
<br>
						<div>
						
태그명 : <input type="text" name="tag_text" id="tag_text" /><Br>
코드값 : <input type="text" name="tag_code" id="tag_code" /><br>

<!-- 클릭했을 때 user id를 알 수 있게 숨겨 둔다.-->
<input type="hidden" name="id_tag" id="id_tag"  value="<?php echo $_GET[id] ?>" />
<button type="button" name="action" id="action">추가</button>
</div>


<?php
while ($row = mysql_fetch_array($result)) {

?>	
	<div class="s_news">



		<section class="newsview">
			<h1><?php echo $row["SUBJECT"] ?></h1>
			<h2><?php echo $row["REGDATE_"] ?></h2>
			<h3><?php echo $row["NEWS_REGUSER"].' '.$row["NEWS_REGUSER_COMP"] ?></h3>
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
		

<script>

$(document).ready(function(){

fetchUser();
function fetchUser()
{

var action = "select";
//users 리스트를 select.php 에서 받아온다.
$.ajax({
url:"select.php",
method:"POST",
data:{action:action},
success:function(data){
$('#tag').val('');
$('#id').val('');
$('#action').text("추가");
$('#result').html(data);
}
})
}

//추가 버튼 클릭했을 때 작동되는 함수
$('#action').click(function(){
	


//각 엘리먼트들의 데이터 값을 받아온다.
var tag_text = $('#tag_text').val();
var id_tag= $('#id_tag').val();
var action = $('#action').text();
var tag_code = $('#tag_code').val();


//성과 이름이 올바르게 입력이 되면
if(tag_text !='' ){

$.ajax({
//insert page로 위에서 받은 데이터를 넣어준다.
url:"action_tag.php", 
type:"POST",
data:{tag_text:tag_text,tag_code:tag_code,id_tag:id_tag,action:action },
success:function(data){

//성공하면 action.php 에서 출력된 데이터가 넘어온다.
//alert(data);

//입력 후 리스트 다시 갱신
//fetchUser();
location.reload();
},
	error:function(request,status,error){
        alert("code = "+ request.status + " message = " + request.responseText + " error = " + error); // 실패 시 처리
       },
     complete : function(data) {
                 //  실패했어도 완료가 되었을 때 처리
        }
});

}else{
alert('빈칸을 입력해 주세요');
}
});

});
</script>

<!-- JavaScript -->
<script src="javascript/jquery.js"></script>
<script src="javascript/libs/rs-plugin/js/jquery.themepunch.plugins.min.js"></script>
<script src="javascript/libs/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
<script src="javascript/libs/rslider/view.home.js"></script>
<script src="javascript/bootstrap.js"></script>
<script src="javascript/main.js"></script>
<script src="javascript/jquery.foundation.forms.js"></script>
<script src="javascript/jquery.mobilemenu.js"></script>
<script src="javascript/jquery.animateNumber.js"></script>
<script src="javascript/jquery.appear.js"></script>
<script src="javascript/progressbar.js"></script>
<script src="javascript/libs/carousel/caroufredsel.js"></script> 
<script src="javascript/libs/isotope/jquery.isotope.min.js"></script>
<script src="javascript/libs/audioplayer/mediaelement-and-player.min.js"></script>
<script src="javascript/libs/mscrollbar/mCustomScrollbar.min.js"></script>
<script src="javascript/libs/owlcarousel/owl.carousel.js"></script>
<script src="javascript/libs/bxslider/jquery.bxslider.js"></script>
<script src="javascript/libs/flexslider/jquery.flexslider.js"></script>
<script src="javascript/libs/enscroll/enscroll-0.4.0.min.js"></script>
<script src="javascript/jquery-ui.js"></script>
<script src="php/twitter/jquery.tweet.js"></script>
<script src="javascript/theme.js"></script>

</html>