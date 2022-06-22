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
				<h3>상담</h3>
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
	<div class="wrap">

		<section class="mainVisual">
			<header>
				<a href="index.php"><img src="resources/images/logo.png"><span class="logotitle">병의원세무지원센터</span></a>
				<a href="#" class="mgnbTop" title="모바일 메뉴 열기">
					<div>
						<span></span>
						<span></span>
						<span></span>
					</div>
				</a>
			</header>


<?php 

//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306") or die ( "DB접속에러" );//url에 action이라는 값이 "추가" 라면
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
?>


		<section class="subvisual sub_newsbg">
			<h1>뉴스톡</h1>
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
					<a href="sub_news.php?cate=GTX" id="GTX">
						<li>증여세</li>
					</a>
					<a href="sub_news.php?cate=INH" id="INH">
						<li>상속세</li>
					</a>
					<a href="sub_news.php?cate=TRA" id="TRA">
						<li>양도세</li>
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
					<!--a href="sub_news.php?cate=LED" id="LED">
						<li>장부기장</li>
					</a>
					<a href="sub_news.php?cate=VAT" id="VAT">
						<li>부가세</li>
					</a>
					<a href="sub_news.php?cate=CIT" id="CIT">
						<li>종소세</li>
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
					</a>
					<a href="sub_news.php?cate=MNY" id="MNY">
						<li>자금</li>
					</a>
					<!--a href="sub_news.php?cate=PRO" id="PRO">
						<li>홍보</li>
					</a>
					<a href="sub_news.php?cate=ISS" id="ISS">
						<li>이슈</li>
					</a-->					
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

empty($_GET["cate"]) ? $CATE = "" : 	$CATE = $_GET["cate"];
empty($_GET["child"]) ? $CHILD = "" : 	$CHILD = $_GET["child"];
empty($_GET["tag"]) ? $TAG = "" : 	$TAG = $_GET["tag"];
empty($_GET["page"]) ? $page = "" : 	$page = $_GET["page"];

$TAG_ARR = explode("@",$TAG);
$TAG_STR = '';

foreach($TAG_ARR as $key){
	if($key != ''){
		$TAG_STR .= "'".$key."',"; 
	}
}


$STR = "";
$STR2 = "";


$page_set = 12; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수
$query_str =  "";

if($CATE != "" and $CATE !="ALL"){
	$STR = " AND CATE =  '".$CATE."' ";
	$query_str .=  "&cate=".$CATE;
}

if($TAG != "" and $TAG !="c_all"){
	//$STR2 = " AND SS_TAG IN ( ".substr($TAG_STR,0,-1).") ";
$STR2 = "AND C_CATE IN ( ".substr($TAG_STR,0,-1)." )";
	$query_str .=  "&tag=".$TAG;
}

$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' AND CATE IN ('SCH','GTX','INH','TRA','QNA','THA','19T') ".$STR.$STR2;
$result = mysqli_query($connect,$query) or die ("쿼리 에러 : ".mysqli_error($connect));
$row = mysqli_fetch_array($result);
 
$total = $row["total"]; // 전체글수
 
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
 
if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
 
$limit_idx = ($page - 1) * $page_set; // limit시작위치



$QUERY = "SELECT *, date_format(NEWS_REGDATE, '%Y-%m-%d') AS REGDATE_, LEFT(REGEXP_REPLACE(CONTENTS_, '<[^>]+>',''),100) AS CONTENTS_, 
(
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
) AS IMG_URL_ FROM dbsschina.SS_NEWS WHERE VISIBLE='Y' AND CATE IN ('SCH','GTX','INH','TRA','QNA','THA','19T') ".$STR.$STR2." ORDER BY NEWS_REGDATE DESC  LIMIT $limit_idx, $page_set ;";

$result = @mysqli_query($connect,$QUERY) or die("SQL error");

while ($row = mysqli_fetch_array($result)) {

?>
					<a href="sub_newsview.php?id=<?php echo $row["ID"]?>">
						<li>
							<div>
								<h3><?php echo $row["NEWS_REGUSER"]?></h3>
								<h4><?php echo $row["REGDATE_"]?></h4>
								<span><img src="<?PHP echo $row["IMG_URL_"]?>"></span>
								<h1><?PHP echo mb_strimwidth($row["SUBJECT"],'0','35','...','utf-8')?></h1>
								<h2><?PHP echo mb_strimwidth($row["CONTENTS_"],'0','90','...','utf-8')?></h2>
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
echo ($prev_page > 0) ? "<a href='?page=$prev_page$query_str' class='prev'>PRVE</a> " : "<a  class='prev'>PRVE</a> ";
?>					
					<span>
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='?page=$i&$query_str'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>

					</span>
<?php 
echo ($next_page <= $total_page) ? "<a href='?page=$next_page$query_str' class='next'>NEXT</a> " : "<a class='next'>NEXT</a> ";
?>
					
				</ul>
			</section>

			<section class="s_newsform">
				<div class="form">
					<h1>양도세 . 상속세 . 증여세 <br> 세무기장 . 부가세 . 종합소득세</h1>					
				</div>
				<a href="http://medi-tax.kr/sub_qnawrite.php" target="_blank">채팅상담</a>

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