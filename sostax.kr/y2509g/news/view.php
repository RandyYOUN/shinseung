<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
$id = $_GET[id];

if($id != ""){
	
$result = @mysql_query("SELECT *, date_format(NEWS_REGDATE,'%d') as reg_dd, left( date_format(NEWS_REGDATE,'%M'),3) as reg_MM , (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/y2509g/news/images/tax.png' ELSE IMG_URL END ) AS IMG_URL_ , 
(CASE WHEN CATE_SEG = 'TAX' THEN '세무' 
WHEN CATE_SEG = 'GOV' THEN '정부'
WHEN CATE_SEG = 'MONEY' THEN '세금'
WHEN CATE_SEG = 'ECO' THEN '경제'
ELSE '' END
) AS CATE_NAME FROM SS_NEWS where ID = $id ORDER BY ID DESC;") or die("SQL error");

}else{
	echo "<script>alert('올바르지 않은접근입니다.'); windwo.history.back();</scipt>";
}

?>

<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html> <!--<![endif]-->
<head>

	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="keywords" content="HTML5 Template" />
	<meta name="description" content="Multipress - Responsive Multipurpose HTML5 Template">
	<meta name="author" content="">

	<title>신승세무법인 - 뉴스톡</title>

	<!-- Mobile Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicons -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<link rel="apple-touch-icon" href="img/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png">

	<!-- Web Fonts  -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Bitter:400,400italic,700' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
	<script src="javascript/libs/respond.min.js"></script>
	<![endif]-->

	<!-- CSS -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/location.css">

	<!--[if lt IE 9]>
		<script src="javascript/libs/html5.js"></script>
	<![endif]-->

	<!-- Vendors CSS -->
	<link href="javascript/libs/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />

	<!-- Style Switch -->
	<link rel="stylesheet" type="text/css" href="css/colors/light-blue-black.css" title="light-blue" media="screen" />
	<link rel="shortcut icon" href="resources/images/icon.ico">

	
<script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
$(document).ready(function(){
    
   $("a[data-toggle='sns_share']").click(function(e){
		e.preventDefault();
		
		var _this = $(this);
		var sns_type = _this.attr('data-service');
		var href = $(location).attr('href');
		var title = _this.attr('data-title');
		var loc = "";
		var img = $("meta[name='og:image']").attr('content');
		
		if( ! sns_type || !href || !title) return;
		
		if( sns_type == 'facebook' ) {
			loc = 'http://www.facebook.com/sharer/sharer.php?u='+href+'&t='+title;
		}
		else if ( sns_type == 'twitter' ) {
			loc = 'http://twitter.com/home?status='+encodeURIComponent(title)+' '+href;
		}
		else if ( sns_type == 'google' ) {
			loc = 'http://plus.google.com/share?url='+href;
		}
		else if ( sns_type == 'pinterest' ) {
			
			loc = 'http://www.pinterest.com/pin/create/button/?url='+href+'&media='+img+'&description='+encodeURIComponent(title);
		}
		else if ( sns_type == 'kakaostory') {
			loc = 'https://story.kakao.com/share?url='+encodeURIComponent(href);
		}
		else if ( sns_type == 'band' ) {
			loc = 'http://www.band.us/plugin/share?body='+encodeURIComponent(title)+'%0A'+encodeURIComponent(href);
		}
		else if ( sns_type == 'naver' ) {
			loc = "http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(href)+"&title="+encodeURIComponent(title);
		}
		else {
			return false;
		}
		
		window.open(loc);
		return false;
	});
    
    
});
</script>



</head>
<body>

<!-- ////// HIDDEN PANEL VIWEABLE ONLY ON SMALLER SCREENS ////// -->
<!--TOPBAR START-->

<!--TOPBAR END-->
<!-- ////// HIDDEN PANEL VIWEABLE ONLY ON SMALLER SCREENS ////// -->

<div class="body">

<!-- Top wrap -->
<div id="top-wrap">
	<div class="container">
		<div class="row">
			
	
			

			</div>
		</div>
	</div>
</div>
<!-- Top wrap -->

<!-- Header -->
<header>
	<div class="container header_1">
		<div class="row">

			<!-- Logo -->
			<div class="logo">
				<a class="navbar-brand logo-nav" href="./index.php"><img src="images/newstalk_logo1.png" alt="Multipress"></a>
			</div>

			<!-- Navmenu -->
			
        </div>
	</div>
</header>
<!-- Header -->

<!-- Header Hidden - Show for Mobiles-->

<!-- Header Hidden - Show for Mobiles-->
<?php
while ($row = mysql_fetch_array($result)) {

?>	
	
<!-- Page Header -->
<!--div class="page-head">
	<div class="container no-padding">
		<div class="row">
			<div class="col-md-6">
				<h2><a href="index.php">News</a> <span>> <?php echo $row["CATE_NAME"] ?></span></h2>
			</div>
			
		</div>
	</div>
</div-->
<!-- Page Header -->

<!-- Blog single content -->
<section id="main-content" class="container no-padding">
	<div class="row">
		<div class="col-md-12">
		<!-- Blog content -->
			<div class="col-md-9 blog-post" style="float:none; margin:0 auto";>
				<article>
					<header>
						<div class="post-date"><em><?php echo $row["reg_dd"] ?></em> 
						<span><?php echo $row["reg_MM"] ?></span></div>
						<div class="post-title">
							<h3><?php echo $row["SUBJECT"] ?></h3>
							<span class="meta"><?php echo $row["NEWS_REGUSER"] ?> | <?php echo $row["NEWS_REGUSER_COMP"]?></span>
						</div>
					</header>
					<div class="post-content">
						<img src="<?php echo $row["IMG_URL_"] ?>" class="img-responsive" alt=""/><br><br>
						<p class="excerpt">
							<?php echo $row["CONTENTS"] ?>
					</div>
<?php
}
?>
						<div class="post-share">
							
							<ul class="social-share">
								<li class="twitter"><a href="#" data-toggle="sns_share"  data-service="twitter" data-title="트위터 SNS공유">Twitter</a></li>
								<li class="gplus"><a href="#" data-toggle="sns_share"  data-service="google" data-title="구글 SNS공유">Googleplus</a></li>
								<li class="pinterest"><a href="#" data-toggle="sns_share"  data-service="pinterest" data-title="핀터레스트 SNS공유">Pinterest</a></li>
								<li class="facebook"><a href="#" data-toggle="sns_share"  data-service="facebook" data-title="페이스북 SNS공유">Facebook</a></li>
								<!--li style="margin-left:50px;">목록으로</li-->
							</ul>
						</div>
						<div class="col-md-12 side-widget">							
							<ul class="tags-list"> 
<?php

$result_tag = @mysql_query("SELECT * FROM SS_TAG WHERE PARENT_TABLE='SS_NEWS' AND PARENT_ID = $id;") or die("SQL error");

while ($row = mysql_fetch_array($result_tag)) {


?>
								<li><a href="#"><?php echo $row["SS_TAG"] ?></a></li>
<?php
}
?>
							</ul>
						</div>
				</article>

				<!-- Next / Prev posts -->


				<!-- Post Comments-->
				
				<!-- Search -->
				

				<!-- Accordion -->
				

				<!-- Accordion post content -->
				

					
					
					</div>
				</div>
			</aside>
			<!-- Sidebar-->
		</div>
	</div>
</section>

<!-- Twitterfeed -->
<section class="location">
			<h1>신승세무법인 지점안내</h1>
			<h2>신승세무법인 수도권 15개 지점</h2>			
			<ul>
					<li onclick="locationFun(0)">강남본사</li>
					<li onclick="locationFun(1)">부천지점</li>
					<li onclick="locationFun(2)">용인지점</li>
					<li onclick="locationFun(3)">광주지점</li>
					<li onclick="locationFun(4)">안양지점</li>
					<li onclick="locationFun(5)">분당지점</li>
					<li onclick="locationFun(6)">수원지점</li>
					<li onclick="locationFun(7)">기흥지점</li>
					<li onclick="locationFun(8)">일산지점</li>
						
			</ul>			
		</section>

		<section class="locationPop">
			<h1></h1>
			<h2>
				<li><strong>주소</strong></li>
				<li><strong>위치</strong></li>
				<li><strong>주차</strong></li>
				<li><strong>전화</strong></li>
				<li><strong>팩스</strong></li>
				<li><strong>E-mail</strong></li>
			</h2>
			<a class="chat"><span>채팅상담</span></a><a class="call"><span>전화상담</span></a>
			<p class="close"></p>			
		</section>		
<!-- Twitterfeed -->

<!-- Footer -->
<footer id="footer">
	
</footer>
<!-- Footer -->

</div>

<script>


			$('.body').prepend('<div class="mask"></div>');


			//레이어팝업닫기
			$(".locationPop .close").click(function() {			
				$(".locationPop").css("display","none");	
				$(".mask").css("display","none");
			});		


			locationData = [
				{name: "강남본사",  address: "서울시 강남구 테헤란로4길 6 센트럴 푸르지오시티 119호",  location: "2호선 강남역 1번 출구 역삼세무서 맞은편", park: "센트럴프루지오시티 지하 주차 가능 (무료)", tel:"02-3452-0608", fax:"02-3452-0866", mail:"tax@sostax.co.kr"}, 
				{name: "부천지점",  address: "경기도 부천시 원미구 신흥로 266번길 화령빌딩 102호",  location: "신중동역 6번출구 부천세무서 건너편", park: "건물 뒤 주차장 (무료)",  tel:"032-323-9620", fax:"032-324-9620", mail:"jh0428@sostax.co.kr"},
				{name: "용인지점",  address: "경기도 용인시 처인구 금학로 155 (역북동)",  location: "동부경찰서 밑", park: "사무실 앞 주차장 (무료)", tel:"031-335-0608", fax:"031-335-0708", mail:"osm0505@sostax.co.kr"}, 
				{name: "광주지점",  address: "경기도 광주시 문화로 123(탄벌동) 국제빌딩1층",  location: "경기광주세무서 옆", park: "경기광주 공설운동장 (무료)", tel:"031-763-3077", fax:"031-763-3060", mail:"mhs0814@sostax.co.kr"}, 
				{name: "안양지점",  address: "경기도 안양시 동안구 시민대로 277 108호 (관양동, 세방글로벌시티)",  location: "4호선 평촌역 2번 출구 동안양세무서 맞은편", park: "세방글로벌시티 지하 주차 가능 (2시간 주차권 제공)", tel:"031-387-0806", fax:"031-387-0819", mail:"shinseung3@sostax.co.kr"}, 
				{name: "분당지점",  address: "경기도 성남시 분당구 황새울로311번길 14, 서현리더스빌딩 1층 103호",  location: "분당세무서후문 맞은편", park: "서현리더스빌딩 (주차권 제공)", tel:"031-705-0608", fax:"031-705-0688", mail:"shinseung1@sostax.co.kr"}, 
				{name: "수원지점",  address: "수원시 영통구 청명남로 14번지 1층",  location: "분당선영통역 1번,2번출구 동수원세무서 맞은편", park: "사무실 앞 도로변 공용주차장 (유료)", tel:"031-202-9620~9622", fax:"031-202-9608", mail:"omj110269@sostax.co.kr"}, 
				{name: "기흥지점",  address: "경기도 용인시 기흥구 흥덕2로117번길 15",  location: "기흥세무서 건물내 1층 (무료)", park: "건물내 지하주차", tel:"031-211-0608", fax:"031-213-0688", mail:"shinseung09@sostax.co.kr"}, 
				{name: "일산지점",  address: "경기도 고양시 일산동구 중앙로 1305-30 일산마이다스오피스텔 112호",  location: "3호선 정발산역 2번 출구 고양세무서 맞은편", park: "일산마이다스빌딩 지하 주차 가능 (주차권 제공)", tel:"031-932-0863", fax:"031-932-0869", mail:"lch0216@sostax.co.kr"}, 
				{name: "신사지점",  address: "서울시 강남구 강남대로 150길 9 삼우빌딩 203호",  location: "신사역 3번출구 신한은행 뒷건물", park: "건물 1층 지상주차장 (30분 무료제공)", tel:"02-569-5596", fax:"02-6442-5501", mail:"5695596@hanmail.net"}, 
				{name: "용산지점",  address: "서울시 용산구 서빙고로24길16 1층",  location: "용산세무서 맞은편", park: "용산세무서 이용", tel:"02-3785-2243", fax:"02-3785-2248", mail:"ssin2243@hanmail.net"}, 
				{name: "안산지점",  address: "경기도 안산시 단원구 화랑로358 (고잔동) 110호",  location: "안산세무서 후문 맞은편 1층", park: "안산세무서 주차 가능 (무료)", tel:"031-405-9415,9425", fax:"031-405-9421", mail:"asshinseung@hanmail.net"}, 
				{name: "안산법원지점",  address: "경기도 안산시 광덕서로86, 122호(고잔동,안산법조타운)",  location: "수원지방법원안산지원 맞은편", park: "안산법조타운 지하 주차 가능 (최대 3시간 주차권 지급)", tel:"031-508-3636", fax:"031-508-3638", mail:"ssbeopwon@hanmil.net"}, 
				{name: "시흥지점",  address: "경기도 시흥시 비둘기공원7길 51, 대명프라자 301호",  location: "시흥세무서 대야동민원실 맞은편", park: "대명프라자 건물 내 기계식 주차장 이용 (무료)", tel:"031-311-3360", fax:"031-311-5942", mail:"ss3360@hanmail.net"}, 
				{name: "시흥정왕지점",  address: "경기도 시흥시 봉우재로 23-29 ,101호(정왕동)",  location: "정왕보건지소 맞은편", park: "정왕보건지소 주차가능 (무료)", tel:"031-432-9415", fax:"031-432-9418", mail:"ss4919@hanmail.net"}, 
			];		
	
			var locationFun = function(i){	
				$(".locationPop").find('.chat').css("display","inline-block");	
				$(".locationPop").find('.chat').attr('href','javascript:popup();');
				//$(".locationPop").find('.chat').attr('href','https://tax119.channel.io');

				$(".locationPop").find('.call').css({margin:'15px 0px 0 0',width:'42%'});				
				$(".locationPop").find('li > span').text('');
				$(".locationPop").find('h1').text(locationData[i]["name"]);
				$(".locationPop").find('h1').append('<span>신승세무법인</span>');	
				$(".locationPop").find('h2').find('span').remove();		
				$(".locationPop").find('li').eq(0).append('<span>' + locationData[i]["address"] +'</span>');
				$(".locationPop").find('li').eq(1).append('<span>' + locationData[i]["location"] +'</span>');
				$(".locationPop").find('li').eq(2).append('<span>' + locationData[i]["park"] +'</span>');
				$(".locationPop").find('li').eq(3).append('<span>' + locationData[i]["tel"] +'</span>');
				$(".locationPop").find('li').eq(4).append('<span>' + locationData[i]["fax"] +'</span>');
				$(".locationPop").find('li').eq(5).append('<span>' + locationData[i]["mail"] +'</span>');	
				$(".locationPop").find('.call').attr('href','tel:'+locationData[i]["tel"]);
				

						
				$(".mask").fadeIn();	
				$(".locationPop").fadeIn();	
			};
			var locationChatclear = function(){		
				$(".locationPop").find('.chat').css("display","none");				
				$(".locationPop").find('.call').css({margin:'15px 0 0 5%',width:'90%'});	
			};	


			function popup(){
			window.open("https://sostaxkr.channel.io");
			}

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

</body>
</html>