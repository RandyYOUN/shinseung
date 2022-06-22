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

	<title>뉴스톡</title>

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

	<!--[if lt IE 9]>
		<script src="javascript/libs/html5.js"></script>
	<![endif]-->

	<!-- Vendors CSS -->
	<link href="javascript/libs/isotope/isotope.css" rel="stylesheet"/>
	<link href="javascript/libs/audioplayer/mediaelementplayer.min.css" rel="stylesheet" />
	<link href="javascript/libs/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" />


	<!-- Style Switch -->
	<link rel="stylesheet" type="text/css" href="css/colors/light-blue-black.css" title="light-blue" media="screen" />

	<link rel="shortcut icon" href="resources/images/icon.ico">

</head>
<body>

<!-- ////// HIDDEN PANEL VIWEABLE ONLY ON SMALLER SCREENS ////// -->
<!--TOPBAR START-->


</div>
<!--TOPBAR END-->
<!-- ////// HIDDEN PANEL VIWEABLE ONLY ON SMALLER SCREENS ////// -->

<div class="body">

<!-- Top wrap -->

<!-- Header -->
<!-- Header -->
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
<!-- Header -->

<!-- Header Hidden - Show for Mobiles-->

<!-- Header Hidden - Show for Mobiles-->


<!-- Blog content wrap -->
<!--section id="portfolio">
	<div class="col-md-12 no-padding">
	     <!-- Start Filter -->
		<!--ul class="folio-filter xtra" data-option-key="filter">
			<li><a class="selected" href="#filter" data-option-value="*"><span></span>전체</a></li>
			<li><a href="#filter" data-option-value=".TAX"><span></span>세무</a></li>
			<li><a href="#filter" data-option-value=".ECO"><span></span>경제</a></li>
			<li><a href="#filter" data-option-value=".MONEY"><span></span>세금</a></li>
			<li><a href="#filter" data-option-value=".GOV"><span></span>정부</a></li>
	    	</ul>
		<!-- End Filter -->
		<!--div class="space15"></div>
	</div-->
<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
	
$result = @mysql_query("SELECT *, date_format(NEWS_REGDATE, '%d') AS DATE_D, left(date_format(NEWS_REGDATE, '%M'),3) AS DATE_M, date_format(NEWS_REGDATE, '%Y') AS DATE_Y, LEFT( fnStripTags(CONTENTS),100) AS CONTENTS_, (CASE WHEN IFNULL(IMG_URL ,'') = '' THEN 'http://sostax.kr/y2509g/news/images/tax.png' ELSE IMG_URL END ) AS IMG_URL_    FROM dbsschina.SS_NEWS ORDER BY NEWS_REGDATE DESC ;") or die("SQL error");


?>

	<div class="blog-home-inner">
		<div class="container">
			<div id="folio" class="isotope col-md-12 no-padding">
<?php
while ($row = mysql_fetch_array($result)) {

?>					
				
				<div class="folio-item col-md-3 isotope-item <?PHP echo $row["CATE_SEG"]?> ">
					<div class="blog-main">
						<div class="blog-thumb">
							<img src=" <?PHP echo $row["IMG_URL_"]?>" alt=""/>
						</div>
						<div class="blog-info">
							<div class="blog-desc">
								<a href="./view.php?id=<?php echo $row["ID"]?>"><h4><?PHP echo $row["SUBJECT"]?></h4></a>
								<div class="post1-date"><?PHP echo $row["DATE_D"]." ". $row["DATE_M"]." ".$row["DATE_Y"]?></div>
								<P><?PHP echo $row["CONTENTS_"]?>...</p>
								<a href="./view.php?id=<?php echo $row["ID"]?>" class="rmore">자세히보기</a>
							</div>
						</div>
					</div>
				</div>
<?php } ?>
				

			
		</div>
	</div>
</div>
</section>
<!-- Blog content -->

<!-- Twitterfeed -->
<!-- Twitterfeed -->

<!-- Footer -->
<!-- Footer -->


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