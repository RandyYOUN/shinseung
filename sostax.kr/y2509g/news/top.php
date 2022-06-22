<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="utf-8">
	<title>신승차이나컨설팅</title>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="description" content="">
	<meta name="keywords" content="">	
	<link rel="stylesheet" href="resources/css/common.css" />
	<script type="text/javascript" src="resources/js/libs.js"></script>
	<script type="text/javascript" src="resources/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources/js/jquery-scrollbox.js"></script>
	<script type="text/javascript" src="resources/js/jquery-touchSlider.js"></script>
	<script type="text/javascript" src="resources/js/SimpleTabs.js"></script>

	<meta property="og:type" content="website">
    <meta property="og:title" content="한국투자기업지원센터-신승차이나컨설팅">
    <meta property="og:url" content="http://sostax.kr">
    <meta property="og:description" content="원스톱 한국 투자 기업 지원 센터 - 한국에서의 사업이 편해집니다.">
    <meta property="og:image" content="resources/images/meta_img_01.png">

	
</head>

<body>
	<div class="mask"></div>
	<header>
		<section>
			<h1><a href="index.php"><img src="resources/images/logo.png"></a></h1>
			<div>
				<a href="http://sostax.cn" target="_self"><img src="resources/images/langChina.png"></a>
				<a href="http://sostax.kr" target="_self"><img src="resources/images/langKorea.png"></a>
			</div>
			<?php
			  $activePage = basename($_SERVER['PHP_SELF'], ".php");
			?>
			<navi>
				<a href="invest.php" class="<?= ($activePage == 'invest') ? 'active':''; ?>"><span>투자&설립</span></a>
				<a href="tax.php" class="<?= ($activePage == 'tax') ? 'active':''; ?>"><span>세무회계</span></a>
				<a href="labor.php" class="<?= ($activePage == 'labor') ? 'active':''; ?>"><span>노무자문</span></a>
				<a href="company.php" class="<?= ($activePage == 'company') ? 'active':''; ?>"><span>회사소개</span></a>
			</navi>
		</section>
	</header>	
	
	<section class="quick">		
		<div>
			<!--a href="javascript:ChannelIO('show');" class="chatLink" ><span>바로상담</span><span>在线咨询</span><img src="resources/images/quickMan.png"></a-->
			<a class="topBtn">TOP</a>
		<!--	<a class="snsBtn"></a>
			<ul>
				<li></li>
				<li></li>
				<li></li>
			</ul>-->
		</div>
	</section>
	
	