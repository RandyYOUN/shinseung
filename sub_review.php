<?php 
include("top.php");
include("db_info.php");
?>
	<div class="wrap">	

		<header class="subhead">
			<section class="subnavi">
				<div>
				<?php include("navi.php");?>
				</div>
			</section>

			<section class="subvisual s_reviewbg">
			</section>

			<section class="subtext">
				<h1>사용자리뷰</h1>
				<h2>혁신적인 세무회계 서비스 세무톡이 선도합니다</h2>
			</section>
		</header>

		<div class="s_review">
			<section class="video">
				<ul>
					<li id="SeeLunDk-oA">
						<img src="resources/images/play.png">
						<h1>방문할 필요없이 세금신고는 기본이고,<br>
							매출 누락까지 꼭 필요한 서비스에요! </h1>
					</li>
					<li id="5Hjhemw-S-Q">
						<img src="resources/images/play.png">
						<h1>영수증 그때 그때 찍어만 주면 알아서 해주니<br>
							마음도 편하고, 손도 편하고, 너무 편해요.</h1>
					</li>
					<li id="tz8GRkpDF1U">
						<img src="resources/images/play.png">
						<h1>일일이말하거나 입력할 필요없이 기장부터<br>
							신고까지 다 알아서 해주니 정말 편해요.</h1>
					</li>
				</ul>
			</section>


			<section class="videoPop">
				<div id="player"></div>
				<p class="close"></p>
			</section>

			<script>
				//세마나영상 레이어팝업
				$('.video li').click(function () {
					player.loadVideoById(this.id);
					$(".mask").fadeIn();
					$(".videoPop").fadeIn();
				});

				var tag = document.createElement('script');

				tag.src = "https://www.youtube.com/iframe_api";
				var firstScriptTag = document.getElementsByTagName('script')[0];
				firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

				var player;
				function onYouTubeIframeAPIReady() {
					player = new YT.Player('player', {
						height: '540',
						width: '960',
						videoId: '',
						events: {
							'onReady': stopVideo
						}
					});
				}
				function onPlayerReady(event) {
					event.target.playVideo();
				}
				function stopVideo() {
					player.stopVideo();
				}
			</script>
<?php
// Connect DB & CONNECTION STANDARD

$CATE = $_GET["cate"];
$CHILD = $_GET["child"];
$TAG = $_GET["tag"];
$TAG_ARR = explode("@",$TAG);
$TAG_STR = '';

foreach($TAG_ARR as $key){
	if($key != ''){
		$TAG_STR .= "'".$key."',"; 
	}
}


$STR = "";
$STR2 = "";

$page = $_GET["page"];

$page_set = 5; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수
$query_str =  "";

if($CATE != "" and $CATE !="ALL"){
	$STR = " AND CATE =  '".$CATE."' ";
	$query_str .=  "&cate=".$CATE;
}

if($TAG != "" and $TAG !="c_all"){
	//$STR2 = " AND SS_TAG IN ( ".substr($TAG_STR,0,-1).") ";
$STR2 = "AND ID IN (SELECT PARENT_ID FROM dbsschina.SS_TAG WHERE CODE IN ( ".substr($TAG_STR,0,-1).") )";
	$query_str .=  "&tag=".$TAG;
}

$query = "SELECT count(ID) as total, round( avg(REV_SCORE),1) AS t_score,TRUNCATE( avg(REV_SCORE),0) AS t_score_star  FROM SS_REVIEW ".$STR.$STR2;
$result = mysqli_query($connect,$query) or die("SQL error");
$row = mysqli_fetch_array($result);
 
$total = $row['total']; // 전체리뷰수
$t_score = $row['t_score']; // 평균 자리수1
$t_score_star = $row['t_score_star']; // 평균 자리수0 

 
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
 
if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
 
$limit_idx = ($page - 1) * $page_set; // limit시작위치

echo $QUERY;

$QUERY = "SELECT *, phone_fn(REV_HP) AS REV_HP_,date_format(REV_REGDATE,'%Y-%m-%d') as REV_REGDATE_ FROM SS_REVIEW ORDER BY REV_REGDATE DESC LIMIT $limit_idx, $page_set ;";

$result = @mysqli_query($connect,$QUERY) or die("SQL error");

?>

			<section class="mainreview">
				<h1>진솔한 이용후기와 평가를 해주셔서 감사드립니다. 고객님의 소리를 귀담아 듣고 더 나은 서비스를 만들도록 노력하겠습니다.
				</h1>
				<h2><span class="total">사용자 리뷰</span><strong><?php echo $total?>명</strong><span class="mainstar<?php echo $t_score_star?>"></span><strong><?php echo $t_score?>/5</strong></h2>
				<div class="swiper-container">
					<div class="swiper-wrapper">

						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview01.png">
							<div>
								<span class="star5"></span>
								<h2>지인분들께도 추천드렸어요</h2>
								<h3>저렴한 수수료에 친절하고 빠른 답변까지 게다가 일처리도 신속해서 정말 맘에 쏙 들어요.</h3>
								<h4>어학원 / 김*현 강사님</h4>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview02.png">
							<div>
								<span class="star5"></span>
								<h2>가게하는 분들께 강추합니다</h2>
								<h3>늘 바쁘다 보니 번거로운 세무업무는 정말 손이 안가더라구요. 그런데 이곳에 일을 맡기고부터는 정말 편해졌어요.</h3>
								<h4>카페 / 정*웅 사장님</h4>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview03.png">
							<div>
								<span class="star5"></span>
								<h2>늘 친절해서 정말 좋아요</h2>
								<h3>사업을 하다보면 세무, 노무 관려해서 이것 저것 물어보게 되는데,언제나 친절하게 답변해주시니 부담없이 문의하게 되네요.</h3>
								<h3>무역업 / 서*희 대표님</h3>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview010.png">
							<div>
								<span class="star5"></span>
								<h2>세번 놀라게 하는 세무톡</h2>
								<h3>저렴한수수료에 한번 놀라고 문의사항에 친절하고 빠른 답변에 두번 놀라고 신속한 일처리에 세번 놀랐습니다.</h3>
								<h4>프리랜서 / 차*철 고객님</h4>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview04.png">
							<div>
								<span class="star5"></span>
								<h2>알아서 착착 다 해주니 정말 편해요</h2>
								<h3>일일이 말하거나 입력할 필요 없이 종이 증빙만 찍어 주면 기장부터 신고까지 다 알아서 해주니 이렇게 편할 수가 없어요.</h3>
								<h4>미용실 / 임*녕 원장님</h4>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview05.png">
							<div>
								<span class="star5"></span>
								<h2>사업에만 전념할 수 있어 감사해요</h2>
								<h3>영수증, 기부금내역 등 그때그때 찍어만 주면 알아서 해주시니 마음도 편하고, 손도 편하고, 세무 신경을 딱 끊어도 되니 너무 편해요.</h3>
								<h4>건설업 / 조*훈 대표님</h4>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview06.png">
							<div>
								<span class="star5"></span>
								<h2>세무 때문에 더 이상 고민하지 않아요</h2>
								<h3>세무 신경 쓸 여력이 없었는데, 친절하게 하나하나 알려주시고,꼼꼼히 챙겨주시니 세무업무 다 맡겨놓고 있어요.</h3>
								<h4>도소매업 / 최*일 대표님</h4>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview07.png">
							<div>
								<span class="star5"></span>
								<h2>전문성이 높고 경험이 많아 안심돼요</h2>
								<h3>국세청 33년 경력에 세무법인 설립 20년 많은 세무전문가분이 책임져주시니 정말 안심하고 사업하고 있어요.</h3>
								<h4>복합운송업 / 김*경 이사님</h4>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview08.png">
							<div>
								<span class="star5"></span>
								<h2>믿고 맡길 수 있어서 좋아요</h2>
								<h3>그때 그때 궁금한 것이 있을때 마다 연락하면 늘 친절하게 답변해주시고 세무 뿐만 아니라 노무까지 하나하나 관리해주시니 복잡한 세무 신경 쓸 필요없이
									맘편히
									믿고 맡기고
									있어요. </h3>
								<h4>제조업 / 정*나 대표님</h4>
							</div>
						</div>
						<div class="swiper-slide contents">
							<img src="resources/images/s_mainreview09.png">
							<div>
								<span class="star5"></span>
								<h2>세금이 대폭 축소되는 세무톡</h2>
								<h3>처음으로 세무신고를 세무톡으로 의뢰하였는데 생각보다 쉽고 간단하게 제출 작성이 가능했던 것 같았으며 무엇보다 세금이 이렇게나 대폭 축소할수 있는 기법에 놀라움을 금치 못하였습니다. </h3>
								<h4>부동산업 / 홍*범 고객님</h4>
							</div>
						</div>
					</div>
				</div>

				<div class="swiper-button-next-unique"></div>
				<div class="swiper-button-prev-unique"></div>
			</section>

			<section class="comment">
				<ul>
<?php


while ($row = mysqli_fetch_array($result)) {

?>

					<li>
						<h1><span><?PHP echo $row["REV_CATE"]?></span><span class="star<?PHP echo $row["REV_SCORE"]?>"></span><strong><?PHP echo $row["REV_HP_"]?></strong></h1>
						<h2><?PHP echo $row["REV_CONTENT"]?>
						<span><?PHP echo $row["REV_REGDATE_"]?></span></h1>
					</li>
<?php } 
// 페이지번호 & 블럭 설정
$first_page = (($block - 1) * $block_set) + 1; // 첫번째 페이지번호
$last_page = min ($total_page, $block * $block_set); // 마지막 페이지번호
 
$prev_page = $page - 1; // 이전페이지
$next_page = $page + 1; // 다음페이지
 
$prev_block = $block - 1; // 이전블럭
$next_block = $block + 1; // 다음블럭
 
// 이전블럭을 블럭의 마지막으로 하려면...
$prev_block_page = $prev_block * $block_set; // 이전블럭 페이지번호
// 이전블럭을 블럭의 첫페이지로 하려면...
//$prev_block_page = $prev_block * $block_set - ($block_set - 1);
$next_block_page = $next_block * $block_set - ($block_set - 1); // 다음블럭 페이지번호
?>
				</ul>
				<div class="paging">
					<div>
<?php 
echo ($prev_page > 0) ? "<a href='$PHP_SELF?page=$prev_page$query_str' class='prev'>PRVE</a> " : "<a  class='prev'>PRVE</a> ";
?>					
					<span>
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='$PHP_SELF?page=$i'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>
						<!--a href=""><strong>1</strong>/10</a-->
					</span>
<?php 
echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$query_str' class='next'>NEXT</a> " : "<a class='next'>NEXT</a> ";
?>
					</div>
				</div>

				<div class="write">
					<input id='phone' name='phone' type="tel" placeholder="핸드폰번호" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
					<select id="select">
						<option selected>서비스 유형</option>
						<option value="세무기장">세무기장</option>
						<option value="부가세">부가세</option>
						<option value="종합소득세">종합소득세</option>
						<option value="양도세">양도세</option>
						<option value="상속세">상속세</option>
						<option value="증여세">증여세</option>
						<option value="증여세">기타</option>
					</select>
					<div class="starwrite">
						<input type="radio" id="star1" name="star" value="1"><label for="star1"><img
								src="resources/images/s_star1.png"></label>
						<input type="radio" id="star2" name="star" value="2"><label for="star2"><img
								src="resources/images/s_star2.png"></label>
						<input type="radio" id="star3" name="star" value="3"><label for="star3"><img
								src="resources/images/s_star3.png"></label>
						<input type="radio" id="star4" name="star" value="4"><label for="star4"><img
								src="resources/images/s_star4.png"></label>
						<input type="radio" id="star5" name="star" value="5" checked><label for="star5"><img
								src="resources/images/s_star5.png"></label>
					</div>
					<textarea id='content' name='content' onkeyup="fnChkByte(this);" placeholder="사용후기를 입력해주세요(최대300자 입력가능)"></textarea>
					<button type="button" name="action" id="action">후기 등록</button>
				</div>
			</section>

		</div>
		<script>
			var swiper = new Swiper('.mainreview .swiper-container', {
				autoplay: false,
				freeMode: false,
				navigation: {
					nextEl: '.mainreview .swiper-button-next-unique',
					prevEl: '.mainreview .swiper-button-prev-unique',
				},
			});



$(document).ready(function(){

	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var tel = $('#phone').val();
		var select= $('#select').val();
		var starwrite= $('input[name="star"]:checked').val();
		var content= $('#content').val();
		
		var action = "리뷰";

		//성과 이름이 올바르게 입력이 되면
		if(tel !='' && content != ''&& select != ''&& starwrite != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action_review.php", 
				method:"POST",
				data:{tel:tel,select:select,starwrite:starwrite,content:content,action:action },
				success:function(data){
					alert(data);
					location.reload();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}
	}); // [2]끝

		


});

		</script>

		<?php include("subbottom3.php");?>

		<?php include("footer.php");?>
