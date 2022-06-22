<?php 
include_once 'top.php';
include_once 'db_info.php';
?>
		<?php $thisPage="sub_news";?> 

		<section class="subvisual bgtax">
			<a href="index.php">
				<h1><img src="resources/images/logo.png"></h1>
			</a>
			<h2>세무뉴스</h2>
		</section>

		<section class="subnavi">
			<?php include_once 'navi.php'; ?>
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
	if($CATE == "SCH"){
		$STR = " AND CATE = 'SCH' AND SITE_GUBUN = 'ALL' "; // 병의원 일정은 빠지게설정
		$query_str .=  "&cate=".$CATE;
	}else{
		$STR = " AND CATE =  '".$CATE."' ";
		$query_str .=  "&cate=".$CATE;
	}	
}

if($TAG != "" and $TAG !="c_all"){
	//$STR2 = " AND SS_TAG IN ( ".substr($TAG_STR,0,-1).") ";
$STR2 = "AND ID IN (SELECT PARENT_ID FROM dbsschina.SS_TAG WHERE CODE IN ( ".substr($TAG_STR,0,-1).") )";
	$query_str .=  "&tag=".$TAG;
}

$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' ".$STR.$STR2;
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_array($result);
 
$total = $row['total']; // 전체글수
 
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
 
if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
 
$limit_idx = ($page - 1) * $page_set; // limit시작위치



$QUERY = "SELECT *, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, LEFT(REGEXP_REPLACE(CONTENTS_, '<[^>]+>',''),100) AS CONTENTS_, (
CASE 
	WHEN IFNULL(IMG_URL ,'') = '' THEN
		CASE 
			WHEN C_CATE = 'c_tra' THEN 'http://taxtok.kr/resources/images/qna_tra.jpg'
            WHEN C_CATE = 'c_inh' THEN 'http://taxtok.kr/resources/images/qna_inh.jpg'
            WHEN C_CATE = 'c_gtx' THEN 'http://taxtok.kr/resources/images/qna_give.jpg'
            WHEN C_CATE = 'c_hos' THEN 'http://taxtok.kr/resources/images/qna_hos.jpg'
			ELSE 'http://taxtok.kr/resources/images/default.png' 
        END
	ELSE IMG_URL 
    END 
) AS IMG_URL_
FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' AND SITE_GUBUN <> 'HOS' ".$STR.$STR2." ORDER BY NEWS_REGDATE DESC  LIMIT $limit_idx, $page_set ;";

//ECHO $QUERY ;
$result = @mysqli_query($connect,$QUERY) or die("SQL error");

while ($row = mysqli_fetch_array($result)) {

?>

					<a href="./sub_newsview.php?id=<?php echo $row["ID"]?>">
						<li><span><img style="width:320px;" src="<?PHP echo $row["IMG_URL_"]?>"></span>
							<div>
								<h1><?PHP echo mb_strimwidth($row["SUBJECT"],'0','38','...','utf-8')?></h1>
								<h2><?PHP echo mb_strimwidth($row["CONTENTS_"],'0','90','...','utf-8')?></h2>
								<h3><?php echo $row["NEWS_REGUSER"]?></h3>
								<h4><?php echo $row["REGDATE_"]?></h4>
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
						<li>강남본사<span>MAP</span></li>
						<li>부천지점<span>MAP</span></li>
						<li>용인지점<span>MAP</span></li>
						<li>광주지점<span>MAP</span></li>
						<li>안양지점<span>MAP</span></li>
						<li>분당지점<span>MAP</span></li>
						<li>수원지점<span>MAP</span></li>
						<li>기흥지점<span>MAP</span></li>
						<li>일산지점<span>MAP</span></li>
						<li>신사지점<span>MAP</span></li>
						<li>용산지점<span>MAP</span></li>
						<li>안산지점<span>MAP</span></li>
						<li>안산법원지점<span>MAP</span></li>
						<li>시흥지점<span>MAP</span></li>
						<li>시흥정왕지점<span>MAP</span></li>
					</ul>
				</div>
			</section>

			

			<script>

				var locationChatclear = function () {
					$(".locationPop").find('.chat').css("display", "none");
				}

				var Location = function () {
					$(".locationCon").find('li').each(function () {
						$(this).on("click", function () {

							//초기화
							$('.locationPop h1, .locationPop h2').html('');
							$(".locationPop").find('.chat').css("display", "block");

							//버튼값 불러오기
							var linkName = $(this).text().replace(/[a-z]/gi, '');

							var locationTitle = ['지점', '주소', '위치', '주차', 'tel', 'fax', 'mail'];

							switch (linkName) {
								case "강남본사":
									locationContents = ["강남본사", "서울시 강남구 테헤란로 114 (역삼동) 역삼빌딩 14층", "2호선 강남역 1번 출구 역삼세무서 맞은편", "센트럴프루지오시티 지하 주차 가능 (무료)", "02-3452-0608", "02-3452-0866", "tax@sostax.co.kr"]
									//alert(0);
									break;

								case "부천지점":
									locationContents = ["부천지점", "경기도 부천시 원미구 신흥로 266번길 화령빌딩 102호", "신중동역 6번출구 부천세무서 건너편", "건물 뒤 주차장 (무료)", "032-323-9620", "032-324-9620", "jh0428@sostax.co.kr"]
									break;

								case "용인지점":
									locationContents = ["용인지점", "경기도 용인시 처인구 금학로 155 (역북동)", "동부경찰서 밑", "사무실 앞 주차장 (무료)", "031-335-0608", "031-335-0708", "osm0505@sostax.co.kr"]
									break;

								case "광주지점":
									locationContents = ["광주지점", "경기도 광주시 문화로 123(탄벌동) 국제빌딩1층", "경기광주세무서 옆", "경기광주 공설운동장 (무료)", "031-763-3077", "031-763-3060", "mhs0814@sostax.co.kr"]
									break;

								case "안양지점":
									locationContents = ["안양지점", "경기도 안양시 동안구 시민대로 277 108호 (관양동, 세방글로벌시티)", "4호선 평촌역 2번 출구 동안양세무서 맞은편", "세방글로벌시티 지하 주차 가능 (2시간 주차권 제공)", "031-387-0806", "031-387-0819", "shinseung3@sostax.co.kr"]
									break;

								case "분당지점":
									locationContents = ["분당지점", "경기도 성남시 분당구 황새울로311번길 14, 서현리더스빌딩 1층 103호", "분당세무서후문 맞은편", "서현리더스빌딩 (주차권 제공)", "031-705-0608", "031-705-0688", "shinseung1@sostax.co.kr"]
									break;

								case "수원지점":
									locationContents = ["수원지점", "수원시 영통구 청명남로 14번지 1층", "분당선영통역 1번,2번출구 동수원세무서 맞은편", "사무실 앞 도로변 공용주차장 (유료)", "031-202-9620~9622", "031-202-9608", "omj110269@sostax.co.kr"]
									break;

								case "기흥지점":
									locationContents = ["기흥지점", "경기도 용인시 기흥구 흥덕2로117번길 15", "기흥세무서 건물내 1층 (무료)", "건물내 지하주차", "031-211-0608", "031-213-0688", "shinseung09@sostax.co.kr"]
									break;

								case "일산지점":
									locationContents = ["일산지점", "경기도 고양시 일산동구 중앙로 1305-30 일산마이다스오피스텔 112호", "3호선 정발산역 2번 출구 고양세무서 맞은편", "일산마이다스빌딩 지하 주차 가능 (주차권 제공)", "031-932-0863", "031-932-0869", "lch0216@sostax.co.kr"]
									break;

								case "신사지점":
									locationContents = ["신사지점", "서울시 강남구 강남대로 150길 9 삼우빌딩 203호", "신사역 3번출구 신한은행 뒷건물", "건물 1층 지상주차장 (30분 무료제공)", "02-569-5596", "02-6442-5501", "5695596@hanmail.net"]
									locationChatclear();
									break;

								case "용산지점":
									locationContents = ["용산지점", "서울시 용산구 서빙고로24길16 1층", "용산세무서 맞은편", "용산세무서 이용", "02-3785-2243", "02-3785-2248", "ssin2243@hanmail.net"]
									locationChatclear();
									break;

								case "안산지점":
									locationContents = ["안산지점", "경기도 안산시 단원구 화랑로358 (고잔동) 110호", "안산세무서 후문 맞은편 1층", "안산세무서 주차 가능 (무료)", "031-405-9415,9425", "031-405-9421", "asshinseung@hanmail.net"]
									locationChatclear();
									break;

								case "안산법원지점":
									locationContents = ["안산법원지점", "경기도 안산시 광덕서로86, 122호(고잔동,안산법조타운)", "수원지방법원안산지원 맞은편", "안산법조타운 지하 주차 가능 (최대 3시간 주차권 지급)", "031-508-3636", "031-508-3638", "ssbeopwon@hanmil.net"]
									locationChatclear();
									break;

								case "시흥지점":
									locationContents = ["시흥지점", "경기도 시흥시 비둘기공원7길 51, 대명프라자 301호", "시흥세무서 대야동민원실 맞은편", "대명프라자 건물 내 기계식 주차장 이용 (무료)", "031-311-3360", "031-311-5942", "ss3360@hanmail.net"]
									locationChatclear();
									break;

								case "시흥정왕지점":
									locationContents = ["시흥정왕지점", "경기도 시흥시 봉우재로 23-29 ,101호(정왕동)", "정왕보건지소 맞은편", "정왕보건지소 주차가능 (무료)", "031-432-9415-7", "031-432-9418", "ss4919@hanmail.net"]
									locationChatclear();
									break;
							}

							//팝업오픈
							$(".mask").fadeIn();
							$(".locationPop").fadeIn();

							$(".locationPop").find('h1').append(locationContents[0] + '<span>신승세무법인</span>');
							for (i = 0; i < locationTitle.length; i++) {
								$(".locationPop").find('h2').append('<li><strong>' + locationTitle[i] + '</strong><span>' + locationContents[i] + '</span></li>');
							}
						})
					})
				}();
			</script>

		</div>
			
		<!--.subconWrap -->
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