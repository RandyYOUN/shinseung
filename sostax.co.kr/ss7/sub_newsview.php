<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
$id = $_GET["id"];

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
) AS IMG_URL_ , CATE,ifnull((SELECT MAX(ID) FROM SS_NEWS WHERE ID < $id AND VISIBLE = 'Y'),0) AS PRE, ifnull((SELECT MIN(ID) FROM SS_NEWS WHERE ID > $id AND VISIBLE = 'Y'),0) AS NEXT,ifnull(substring_index(FILE_URL, '.', -1),'down') as FILE_EXT FROM SS_NEWS where ID = $id AND VISIBLE='Y' ORDER BY ID DESC;") or die("SQL error");

}else{
	echo "<script>alert('올바르지 않은접근입니다.'); windwo.history.back();</scipt>";
}

?>
		<?php include_once 'top.php'; ?>
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

		
<?php
while ($row = mysqli_fetch_array($result)) {

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

	<div class="s_news">

		<section class="newsview">
			<h1><?php echo $row["SUBJECT"] ?></h1>
			<h2><?php echo $row["REGDATE_"] ?></h2>
			<h3><?php echo $row["NEWS_REGUSER"].' '.$row["NEWS_REGUSER_COMP"] ?></h3>
<?php
if($row["FILE_URL"] != "" && $row["FILE_EXT"]){
?>
	<h5><b>첨부파일 :</b><a href="http://taxtok.kr/admin/upload/<?php echo $row["FILE_URL"] ?>" target="_blank">&nbsp;<img width="20px" src="http://taxtok.kr/admin/resources/images/icons/<?php echo $row["FILE_EXT"] ?>.png">&nbsp;<font color="gray"><?php echo $row["FILE_URL"] ?></font></a></h5><br>
<?		
}
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
									locationContents = ["강남본사", "서울시 강남구 테헤란로 114 (역삼동) 역삼빌딩 14층", "2호선 강남역 1번 출구 역삼세무서 맞은편", "센트럴프루지오시티 지하 주차 가능 (무료)", "02-3452-0608", "02-3452-0866", "ss1@sostax.co.kr"]
									//alert(0);
									break;

								case "부천지점":
									locationContents = ["부천지점", "경기도 부천시 원미구 신흥로 266번길 화령빌딩 102호", "신중동역 6번출구 부천세무서 건너편", "건물 뒤 주차장 (무료)", "032-323-9620", "032-324-9620", "ss6@sostax.co.kr"]
									break;

								case "용인지점":
									locationContents = ["용인지점", "경기도 용인시 처인구 금학로 155 (역북동)", "동부경찰서 밑", "사무실 앞 주차장 (무료)", "031-335-0608", "031-335-0708", "ss2@sostax.co.kr"]
									break;

								case "광주지점":
									locationContents = ["광주지점", "경기도 광주시 문화로 123(탄벌동) 국제빌딩1층", "경기광주세무서 옆", "경기광주 공설운동장 (무료)", "031-763-3077", "031-763-3060", "ss7@sostax.co.kr"]
									break;

								case "안양지점":
									locationContents = ["안양지점", "경기도 안양시 동안구 시민대로 277 108호 (관양동, 세방글로벌시티)", "4호선 평촌역 2번 출구 동안양세무서 맞은편", "세방글로벌시티 지하 주차 가능 (2시간 주차권 제공)", "031-387-0806", "031-387-0819", "ss3@sostax.co.kr"]
									break;

								case "분당지점":
									locationContents = ["분당지점", "경기도 성남시 분당구 황새울로311번길 14, 서현리더스빌딩 1층 103호", "분당세무서후문 맞은편", "서현리더스빌딩 (주차권 제공)", "031-705-0608", "031-705-0688", "ss8@sostax.co.kr"]
									break;

								case "수원지점":
									locationContents = ["수원지점", "수원시 영통구 청명남로 14번지 1층", "분당선영통역 1번,2번출구 동수원세무서 맞은편", "사무실 앞 도로변 공용주차장 (유료)", "031-202-9620~9622", "031-202-9608", "ss4@sostax.co.kr"]
									break;

								case "기흥지점":
									locationContents = ["기흥지점", "경기도 용인시 기흥구 흥덕2로117번길 15", "기흥세무서 건물내 1층 (무료)", "건물내 지하주차", "031-211-0608", "031-213-0688", "ss9@sostax.co.kr"]
									break;

								case "일산지점":
									locationContents = ["일산지점", "경기도 고양시 일산동구 중앙로 1305-30 일산마이다스오피스텔 112호", "3호선 정발산역 2번 출구 고양세무서 맞은편", "일산마이다스빌딩 지하 주차 가능 (주차권 제공)", "031-932-0863", "031-932-0869", "ss5@sostax.co.kr"]
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