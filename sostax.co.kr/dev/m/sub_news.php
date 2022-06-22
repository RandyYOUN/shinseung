<?php 
include_once 'top.php'; 
include("db_info.php");

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

	
		<div class="s_news">

			<section class="newsnavi">
				<ul>
					<a href="sub_news.php?cate=ALL" ID="ALL">
						<li>전체</li>
					</a>

					<a href="sub_news.php?cate=SCH" id="SCH">
						<li>세무일정</li>
					</a>
					<a href="sub_news.php?cate=LED" id="LED">
						<li>장부기장</li>
					</a>
					<a href="sub_news.php?cate=VAT" id="VAT">
						<li>부가세</li>
					</a>
					<a href="sub_news.php?cate=CIT" id="CIT">
						<li>종소세</li>
					</a>
					<a href="sub_news.php?cate=TRA" id="TRA">
						<li>양도세</li>
					</a>
					<a href="sub_news.php?cate=INH" id="INH">
						<li>상속세</li>
					</a>
					
					<a href="sub_news.php?cate=GTX" id="GTX">
						<li>증여세</li>
					</a>
					<a href="sub_news.php?cate=QNA" id="QNA">
						<li>상담사례</li>
					</a>
					<a href="sub_news.php?cate=THA" id="THA">
						<li>절세극장</li>
					</a>
					<a href="sub_news.php?cate=19T" id="19T">
						<li>19禁세금</li>
					</a>
					<a href="sub_news.php?cate=TAX" id="TAX">
						<li>조세</li>
					</a>
					<a href="sub_news.php?cate=LAB" id="LAB">
						<li>노무</li>
					</a>
					<a href="sub_news.php?cate=FOU" id="FOU">
						<li>창업</li>
					</a>
					<!--a href="sub_news.php?cate=OPE" id="OPE">
						<li>경영</li>
					</a-->
					<a href="sub_news.php?cate=MNY" id="MNY">
						<li>자금</li>
					</a>
					<!--a href="sub_news.php?cate=PRO" id="PRO">
						<li>홍보</li>
					</a-->
					<a href="sub_news.php?cate=ISS" id="ISS">
						<li>이슈</li>
					</a>					
				</ul>				
				<div id='sub_menu' name='sub_menu' >
					<a href="sub_news.php?cate=QNA" id="c_all">전체</a>
					<a href="javascript:tag('c_tra');" id="c_tra">양도세</a>
					<a href="javascript:tag('c_inh');" id="c_inh">상속세</a>
					<a href="javascript:tag('c_gtx');" id="c_gtx">증여세</a>
					<a href="javascript:tag('c_hos');" id="c_hos">병의원</a>
				</div>
				<div id='blank' name='blank'>
				<br><Br>
				</div>
			</section>
			<section class="newscontents">
				<ul>
			

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

$page_set = 12; // 한페이지 줄수
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

$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' ".$STR.$STR2;
$result = mysql_query($query, $connect) or die ("쿼리 에러 : ".mysql_error($connect));
$row = mysql_fetch_array($result);
 
$total = $row[total]; // 전체글수
 
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
 
if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
 
$limit_idx = ($page - 1) * $page_set; // limit시작위치



$QUERY = "SELECT *, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, LEFT( fnStripTags(CONTENTS_),100) AS CONTENTS_, (
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
) AS IMG_URL_
FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' ".$STR.$STR2." ORDER BY NEWS_REGDATE DESC  LIMIT $limit_idx, $page_set ;";


$result = @mysql_query($QUERY) or die("SQL error");

while ($row = mysql_fetch_array($result)) {

?>

					<a href="sub_newsview.php?id=<?php echo $row["ID"]?>">
						<li>
							<div>
								<h3><?php echo $row["NEWS_REGUSER"]?></h3>
								<h4><?php echo $row["REGDATE_"]?></h4>
								<span><img src="<?PHP echo $row["IMG_URL_"]?>"></span>
								<h1><?PHP echo mb_strimwidth($row["SUBJECT"],'0','35','...','utf-8')?></h1>
								<h2><?PHP echo mb_strimwidth($row["CONTENTS_"],'0','110','...','utf-8')?></h2>
							</div>
						</li>
					</a>
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
			</section>
			<section class="paging">
				<div>
<?php 
echo ($prev_page > 0) ? "<a href='$PHP_SELF?page=$prev_page$query_str' class='prev'>PRVE</a> " : "<a  class='prev'>PRVE</a> ";
?>					
					<span>
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='?page=$i&$query_str'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>
					</span>
<?php 
echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$query_str' class='next'>NEXT</a> " : "<a class='next'>NEXT</a> ";
?>
				</div>
			</section>

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

	
<script>

	$(document).ready(function () {

		fetchUser();
		function fetchUser() {

			var action = "select";
			//users 리스트를 select.php 에서 받아온다.
			$.ajax({
				url: "select.php",
				method: "POST",
				data: { action: action },
				success: function (data) {
					$('#NEW_HP').val('');
				}
			})

			var request = new Request();
			var cate = request.getParameter("cate");
//			alert(cate);

			if(cate){
				document.getElementById(cate).setAttribute('class','active');
			}else{
				document.getElementById('ALL').setAttribute('class','active');
			}
			
		}


		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action3').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP3').val();
			var action = "추가";
			var Q_TYPE = "세무소식구독";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('빈칸을 입력해 주세요');
			}
		});


	});



</script>