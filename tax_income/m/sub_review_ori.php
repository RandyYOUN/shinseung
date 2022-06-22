<?php 
include("top_ori.php");
include("db_info.php");
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

		<section class="subvisual sub_reviewbg">
			<h1>세번 놀는 세무톡 </h1>
		</section>

		<div class="s_review">
			<section class="video">
				<ul>
					<li id="SeeLunDk-oA">
						<img src="resources/images/play.png">
						<h1>방문할 필요없이 세금신고는 기본이고,
							매출 누락까지 꼭 필요한 서비스에요! </h1>
					</li>
					<li id="5Hjhemw-S-Q">
						<img src="resources/images/play.png">
						<h1>영수증 그때 그때 찍어만 주면 알아서 해주니
							마음도 편하고, 손도 편하고, 너무 편해요.</h1>
					</li>
					<li id="tz8GRkpDF1U">
						<img src="resources/images/play.png">
						<h1>일일이말하거나 입력할 피료없이 기장부터
							신고까지 다 알아서 해주니 정말 편해요.</h1>
					</li>
				</ul>
			</section>

			<section class="videoPop">
				<div id="player"></div>
				<p class="close"></p>
			</section>
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
$block_set = 3; // 한페이지 블럭수
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
$result = mysql_query($query, $connect) or die ("쿼리 에러 : ".mysql_error($connect));
$row = mysql_fetch_array($result);
 
$total = $row[total]; // 전체리뷰수
$t_score = $row[t_score]; // 평균 자리수1
$t_score_star = $row[t_score_star]; // 평균 자리수0 
?>

			<section class="s_review" >
				<h1><span class="total">사용자 리뷰</span><strong><?php echo $total?>명</strong><span class="titlestar0<?php echo $t_score_star?>"></span><strong><?php echo $t_score?> /
						5</strong></h1>
				<div class="reviewwrap">
					<div class="swiper-container">
						<div class="swiper-wrapper">
						<div class="swiper-slide">
							<img src="resources/images/review01.png">
							<h2>어학원 / 김*현 강사님</h2>
							<h3>지인분들께도 추천드렸어요</h3>
							<h4>저렴한 수수료에 친절하고 빠른 답변까지 게다가 일처리도 신속해서 정말 맘에 쏙 들어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review02.png">
							<h2>카페 / 정*웅 사장님</h2>
							<h3>가게하는 분들께 강추합니다</h3>
							<h4>늘 바쁘다 보니 번거로운 세무업무는 정말 손이 안가더라구요. 그런데 이곳에 일을 맡기고부터는 정말 편해졌어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review03.png">
							<h2>무역업 / 서*희 대표님</h2>
							<h3>늘 친절해서 정말 좋아요</h3>
							<h4>사업을 하다보면 세무, 노무 관려해서 이것 저것 물어보게 되는데,언제나 친절하게 답변해주시니 부담없이 문의하게 되네요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review010.png">
							<h2>프리랜서 / 차*철 고객님</h2>
							<h3>세번 놀라게 하는 세무톡</h3>
							<h4>저렴한수수료에 한번 놀라고 문의사항에 친절하고 빠른 답변에 두번 놀라고 신속한 일처리에 세번 놀랐습니다.</h4>								
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review04.png">
							<h2>미용실 / 임*녕 원장님</h2>
							<h3>알아서 착착 다 해주니 정말 편해요</h3>
							<h4>일일이 말하거나 입력할 필요 없이 종이 증빙만 찍어 주면 기장부터 신고까지 다 알아서 해주니 이렇게 편할 수가 없어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review05.png">
							<h2>건설업 / 조*훈 대표님</h2>
							<h3>사업에만 전념할 수 있어 감사해요</h3>
							<h4>영수증, 기부금내역 등 그때그때 찍어만 주면 알아서 해주시니 마음도 편하고, 손도 편하고, 세무 신경을 딱 끊어도 되니 너무 편해요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review06.png">
							<h2>도소매업 / 최*일 대표님</h2>
							<h3>세무 때문에 더 이상 고민하지 않아요</h3>
							<h4>세무 신경 쓸 여력이 없었는데, 친절하게 하나하나 알려주시고,꼼꼼히 챙겨주시니 세무업무 다 맡겨놓고 있어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review07.png">
							<h2>복합운송업 / 김*경 이사님</h2>
							<h3>전문성이 높고 경험이 많아 안심돼요</h3>
							<h4>국세청 33년 경력에 세무법인 설립 20년 많은 세무전문가분이 책임져주시니 정말 안심하고 사업하고 있어요.</h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review08.png">
							<h2>제조업 / 정*나 대표님</h2>
							<h3>믿고 맡길 수 있어서 좋아요</h3>
							<h4>그때 그때 궁금한 것이 있을때 마다 연락하면 늘 친절하게 답변해주시고 세무 뿐만 아니라 노무까지 관리해주시니 복잡한 세무 신경 쓸 필요없이 맘편히
								믿고 맡기고 있어요. </h4>
							<a></a>
						</div>
						<div class="swiper-slide">
							<img src="resources/images/review09.png">							
							<h2>부동산업 / 홍*범 고객님</h2>
							<h3>세금이 대폭 축소되는 세무톡</h3>
							<h4>처음으로 세무신고를 세무톡으로 의뢰하였는데 생각보다 쉽고 간단하게 제출 작성이 가능했던 것 같았으며 무엇보다 세금이 이렇게나 대폭 축소할수 있는 기법에 놀라움을 금치 못하였습니다. </h4>							
							<a></a>
						</div>
					</div>
						<div class="swiper-pagination"></div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					</div>
				</div>
			</section>

			<section class="comment" >
				<ul>

<?php
 
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
 
if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
 
$limit_idx = ($page - 1) * $page_set; // limit시작위치

echo $QUERY;

$QUERY = "SELECT *, phone_fn(REV_HP) AS REV_HP_ FROM SS_REVIEW ORDER BY REV_REGDATE DESC LIMIT $limit_idx, $page_set ;";

$result = @mysql_query($QUERY) or die("SQL error");




while ($row = mysql_fetch_array($result)) {

?>
					<li>
						<h1><span><?PHP echo $row["REV_CATE"]?></span><strong><?PHP echo $row["REV_HP_"]?></strong><span class="star<?PHP echo $row["REV_SCORE"]?>"></span></h1>
						<h2><?PHP echo $row["REV_CONTENT"]?>
						<span><?PHP echo $row["REV_REGDATE"]?></span></h2>
						<a>더보기</a>
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


				<script>
					$('.comment li').each(function () {

						var textLength = $(this).children('h2').text().length;
						var text = $(this).children('h2').clone().children().remove().end().text();
						var textDate = $(this).children('h2').children('span').html();

						$(this).children('a').css("display", "none");

						// alert(textA);

						if (textLength > 90) {
							$(this).children('a').css("display", "block");
							//$(this).children('h2').css("background", "red");
							$(this).children('h2').html((text.substring(0, 90) + "..." + "<span>" + textDate + "</span>"));
						}

						$(this).children('a').click(function () {

							if ($(this).text().match('더보기')) {
								$(this).siblings('h2').html(text + "<span>" + textDate + "</span>");
								$(this).text('접기');

							}
							else {
								$(this).text('더보기');
								$(this).siblings('h2').html((text.substring(0, 90) + "..." + "<span>" + textDate + "</span>"));
							}
						})
					});

				</script>
				<section class="paging">
					<div>
						<?php 
echo ($prev_page > 0) ? "<a href='$PHP_SELF?page=$prev_page$query_str' class='prev'>PRVE</a> " : "<a  class='prev'>PRVE</a> ";
?>					
					<span>
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='$PHP_SELF?page=$i&flag=review'>$i</a> " : "<a class='active'><b>$i</b></a> "; 
} 

?>
						<!--a href=""><strong>1</strong>/10</a-->
					</span>
<?php 
echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$query_str' class='next'>NEXT</a> " : "<a class='next'>NEXT</a> ";
?>
					</div>
				</section>

				<div class="write">
					<input type="tel" id='phone' name='phone' placeholder="핸드폰번호" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');">
					<select id="select" class="service">
						<option selected>서비스 유형</option>
						<option value="세무기장">세무기장</option>
						<option value="부가세">부가세</option>
						<option value="종합소득세">종합소득세</option>
						<option value="양도세">양도세</option>
						<option value="상속세">상속세</option>
						<option value="증여세">증여세</option>
						<option value="기타">기타</option>
					</select>
					<select id="star" class="starwrite">
						<option selected>별점선택</option>
						<option value="5">★★★★★ 5개</option>
						<option value="4">★★★★☆ 4개</option>
						<option value="3">★★★☆☆ 3개</option>
						<option value="2">★★☆☆☆ 2개</option>
						<option value="1">★☆☆☆☆ 1개</option>
					</select>

					<textarea id='content' name='content' placeholder="사용후기를 입력해주세요(최대300자 입력가능)" onkeyup="fnChkByte(this);"></textarea>
					<button type="button" name="action" id="action">후기 등록</button>
				</div>
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
						height: '330',
						width: '100%',
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


				

$(document).ready(function(){

	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var tel = $('#phone').val();
		var select= $('#select').val();
		var starwrite= $('#star').val();//$('input[name="star"]:checked').val();
		var content= $('#content').val();
		
		//alert(tel);
		var action = "리뷰";

		//성과 이름이 올바르게 입력이 되면
		if(tel !='' && content != ''&& select != ''&& starwrite != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"../action_review.php", 
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


		</div>



<?php include("bottom_ori.php");?>