<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>병의원세무지원센터::신승세무법인</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, user-scalable=yes">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta property="og:type" content="website">
		<meta property="og:title" content="병의원세무지원센터">
		<meta property="og:url" content="http://medi-tax.kr/m/">
		<meta property="og:description" content="대한의사협회 세무회계부문 공식제휴 세무법인">
		<meta property="og:image" content="/resources/images/sum.png">
		<meta name="format-detection" content="telephone=no"/>
		<link rel="stylesheet" href="resources_/css/basic.css">
		<link rel="stylesheet" href="resources_/css/swiper.css">
		<link rel="stylesheet" href="resources_/css/common.css">
		<link rel="stylesheet" href="resources_/css/animate.css">
		<link rel="shortcut icon" href="resources_/images/icon.ico">
		<script type="text/javascript" src="resources_/js/libs.js"></script>
		<script type="text/javascript" src="resources_/js/jquery-swiper.js"></script>
		<script type="text/javascript" src="resources_/js/jquery-scrollbox.js"></script>
		<script type="text/javascript" src="resources_/js/TweenMax.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Anton&display=swap" rel="stylesheet">


<!-- 2019.12.13 einvention -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5S9MNPM');</script>
<!-- End Google Tag Manager -->

<!-- 2019.11.12 einvention -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PGF2JVZ');</script>
<!-- End Google Tag Manager -->

	</head>
<!-- Channel Plugin Scripts -->
<script>
  (function() {
    var w = window;
    if (w.ChannelIO) {
      return (window.console.error || window.console.log || function(){})('ChannelIO script included twice.');
    }
    var d = window.document;
    var ch = function() {
      ch.c(arguments);
    };
    ch.q = [];
    ch.c = function(args) {
      ch.q.push(args);
    };
    w.ChannelIO = ch;
    function l() {
      if (w.ChannelIOInitialized) {
        return;
      }
      w.ChannelIOInitialized = true;
      var s = document.createElement('script');
      s.type = 'text/javascript';
      s.async = true;
      s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
      s.charset = 'UTF-8';
      var x = document.getElementsByTagName('script')[0];
      x.parentNode.insertBefore(s, x);
    }
    if (document.readyState === 'complete') {
      l();
    } else if (window.attachEvent) {
      window.attachEvent('onload', l);
    } else {
      window.addEventListener('DOMContentLoaded', l, false);
      window.addEventListener('load', l, false);
    }
  })();
  ChannelIO('boot', {
    "pluginKey": "9c36349c-b1f2-454b-9853-f1d4994800a5"
  });
</script>

<!-- End Channel Plugin -->
<script type="text/javascript">

	function Request() {
		var requestParam = "";

		//getParameter 펑션
		this.getParameter = function (param) {
			//현재 주소를 decoding
			var url = unescape(location.href);
			//파라미터만 자르고, 다시 &그분자를 잘라서 배열에 넣는다. 
			var paramArr = (url.substring(url.indexOf("?") + 1, url.length)).split("&");

			for (var i = 0; i < paramArr.length; i++) {
				var temp = paramArr[i].split("="); //파라미터 변수명을 담음

				if (temp[0].toUpperCase() == param.toUpperCase()) {
					// 변수명과 일치할 경우 데이터 삽입
					requestParam = paramArr[i].split("=")[1];
					break;
				}
			}
			return requestParam;
		}
	}

</script>
<!-- End Channel Plugin -->
<body>

<!-- 2019.12.13 einvention -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5S9MNPM"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<!-- 2019.11.12 einvention -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PGF2JVZ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->


<section class="mquick">
			<h1>무엇을 도와드릴까요?</h1>
			<h2>전화상담
				<a href="tel:1899-3582"></a>
			</h2>
			<div>
				<h3>채팅상담</h3>
				<img src="resources/images/mquickMan.png" style="width:50% !important;">
			</div>
		<a  href="http://medi-tax.kr/sub_qnawrite.php" target="_blank"></a>
			<ul>
				<li>쉽고빠른<span></span></li>
				<li>세무상담<span></span></li>
				<li>증빙자료<span></span></li>
				<li>전송가능<span></span></li>
			</ul>

		</section>
	<script>
		var man = $(".mquick div").find('img');
	
		var quickMan =  new TimelineMax({repeat:-1, repeatDelay: 3});

		quickMan.delay(2).to(man, 0.2, { y: -10 })
		.to(man, 0.1, {y: 5 })
		.to(man, 0.1, { y: 0 });
		
		var elem = $(".mquick ul").find('li');
		var items = elem.length;
		var index = 0;

		var quickbubble =  new TimelineLite();

		function bubbleMoving() {
			setTimeout(function() {
				if (index < items) {
					quickbubble.to(elem.eq(index), 0.5, {opacity:1, ease: Power2.easeIn, y:-15})
					.to(elem.eq(index), 1.5, {opacity:1, ease: Power2.easeIn, y:-15})
					.to(elem.eq(index), 0.5, {opacity:0, ease: Power2.easeIn, y:30});
					index++;
					bubbleMoving();
					
				}
				if (index == items) {
					index = 0;
					}
				}, 3000);
		};
		bubbleMoving();
		
	</script>
<?php
// Connect DB & CONNECTION STANDARD
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306") or die ( "DB접속에러" );//url에 action이라는 값이 "추가" 라면
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

//$id = $_GET[id];
empty($_GET["id"]) ? $id = "" : $id = $_GET["id"];

if($id != ""){
	
$QUERY ="SELECT *, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_ , 
(
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
) AS IMG_URL_, CATE,ifnull((SELECT MAX(ID) FROM SS_NEWS WHERE ID < $id AND VISIBLE = 'Y'),0) AS PRE, ifnull((SELECT MIN(ID) FROM SS_NEWS WHERE ID > $id AND VISIBLE = 'Y'),0) AS NEXT,ifnull(substring_index(FILE_URL, '.', -1),'down') as FILE_EXT FROM SS_NEWS where ID = $id AND VISIBLE='Y' ORDER BY ID DESC;";
$result = @mysqli_query($connect,$QUERY) or die("SQL error");

}else{
	echo "<script>alert('올바르지 않은접근입니다.'); windwo.history.back();</scipt>";
}


?>
	
	<div class="wrap">


		<header>
			<a href="index.php"><img src="resources/images/logo.png"></a><span class="logotitle">병의원세무지원센터</span>
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
				<a href="javascript:chat_kakao();">채팅상담</a>

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