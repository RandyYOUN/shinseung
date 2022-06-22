<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Document Settings -->

        <meta charset="utf-8"/>
        <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="" />
        <meta name="description" content="Mad Lemur - A Modern Template for Digital Agencies" />

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="assets/images/ico/favicon.ico"/>

        <!-- Page Title -->
        <title>세무법인신승</title>

        <!-- Plugins -->
        <link rel="stylesheet" href="assets/css/plugins.min.css">

        <!-- Custom css file -->
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
<?php
// Connect DB & CONNECTION STANDARD
$connect = @mysql_connect ( "db.sostax.kr:3306", "sschina", "shinseung1@" ) or die ( "DB접속에러" );
mysql_query ( "SET NAMES UTF8" ); // UTF-8 ENCODING

mysql_query ( "set session character_set_connection=utf8;" );
mysql_query ( "set session character_set_results=utf8;" );
mysql_query ( "set session character_set_client=utf8;" );

// Select DB
@mysql_select_db ( "dbsschina", $connect ) or die ( "DB선택에러" );

// END OF Connect

$result = @mysql_query("SELECT DATE_FORMAT(news_regdate,'%y/%m/%d') as news_regdate, news_subject, news_content,img_src FROM dbsschina.news_info;") or die("SQL error");

?>

    <!-- Wrapper -->
        <div class="wrapper">
        <!-- Header -->
            <nav class="header row auto-hide-header navbar-transparent">
                <div class="header-inner">
                    <div class="logo col-xs-2 col-md-2">
                        <a href="index.html">
                            <img src="assets/images/logo.svg" alt="logo">
                        </a>
                    </div>
                    <div class="mobile-menu-btn col-sm-2 col-md-2">
                        <a href ="#" class="nav-trigger">
                            <span><em aria-hidden="true"></em></span>
                        </a>
                    </div>
                    <!-- Menu -->
                        <div class="menu col-md-8 col-xs-10" id="menu">
                            <ul class="menu_list">
                                <li><a href="#">세무톡</a>
                                    <ul class="sub-menu">
                                        <li><a href="index.html">세무톡</a></li>
                                        <li><a href="home-one-page.html">양도소득세</a></li>
                                        <li><a href="home-portfolio.html">세무기장</a></li>
                                    </ul>
                                </li>
                                <li><a href="about.html">중국톡</a></li>
                                <li><a href="#">신승컨설팅그룹</a>
                                    <ul class="sub-menu">
                                        <li><a href="portfolio-2-col.html">신승세무법인</a></li>
                                        <li><a href="portfolio-3-col.html">신승컨설팅그룹</a></li>
                                        <li><a href="portfolio-4-col.html">신승IPS</a></li>
                                        <li><a href="portfolio-item.html">AI-TAX</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">뉴스톡</a>
                                    <ul class="sub-menu">
                                        <li><a href="blog-sidebar.html">뉴스톡</a></li>
                                        <li><a href="blog-timeline.html">블로그</a></li>
                                        <li><a href="blog-2-col.html">체납톡</a></li>
                                    </ul>
                                </li>
                           </ul>
                        </div>
                    <!-- /Menu -->
                    <div class="menu-right-box col-md-2 hidden-xs">
                        <div class="box-inner">
                            <a href="tel:18993582" class="btn transparent">전화하기</a>
                        </div>
                    </div>
                </div>
            </nav>
        <!-- /Header -->

        <!-- Hero area -->
            <section class="hero-parallax page-heading parallax-slider" style="background-image: url(assets/images/hero-bg.jpg)">
                <div class="ms-hero-copy ms-title">
                    <h1>신승세무법인 뉴스톡</h1>
                    <h3>매주 콕!! 필요한 소식을 전달해드립니다.</h3>
                </div>
                <div class="ellipse-border">
                    <svg version="1.1" id="circle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 380" xml:space="preserve" PreserveAspectRatio="none">
                    <path fill="#fff" d="M0,309c0,0,340,70.8,960,70.8c620,0.2,960-70.8,960-70.8v71H0" transform="translate(0 1)"/>
                    </svg>
                </div>
            </section>
        <!-- /Hero area -->

        <!-- Container -->
            <main class="container">

            <!-- Blog Timeline-->
                <section class="ms-blog">
                    <div class="row">
                        <ul class="ms-grid timeline col-md-12 ">

<?php
while ($row = mysql_fetch_array($result)) {
?>


                            <li class="blog-post ">
                                <div class="timeline-date  col-md-2">
                                    <div class="post-info">
                                        <a href="#"><i class="material-icons">date_range</i><?php echo $row["news_regdate"]?></a>
                                     </div>
                                </div>
                                <div class="col-md-4">
                                <a href="single-post.html">
                                    <img src=" <?php echo $row["img_src"] ?>" alt="blog-image" width="600" height="375">
                                </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="single-post.html">
                                        <h5><?PHP echo $row["news_subject"]?></h5>
                                    </a>
                                    <p>내용 말줄임처리...<br><?php echo $row["news_content"]?></p>
                                    
                                </div>
                            </li>
<?PHP
}
?>
                        </ul>
                        <!--div class="section-button col-md-12 col-sm-12">
                            <ul class="pagination">
                                <li>
                                    <a class="prev-pagination" href="#">
                                        <i class="material-icons">keyboard_arrow_left</i>
                                    </a>
                                </li>
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a class="next-pagination" href="#">
                                        <i class="material-icons">keyboard_arrow_right</i>
                                    </a>
                                </li>
                            </ul>
                        </div-->
                    </div>
                </section>
            <!-- /Blog Timeline-->

            </main>
        <!-- /Container -->  

        <!-- Back to top button -->
            <a href="#" class="back-top btn">
                <i class="material-icons">keyboard_arrow_up</i>
            </a>
        <!-- /Back to top button -->

        <!-- Footer -->
            <footer id="footer" class="ghost-bg">
                <div class="ellipse-border-bottom">
                    <svg version="1.1" id="circle2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1920 71.6" xml:space="preserve">
                    <path fill="#fff" class="st0"
                    d="M1919.9,71.6c0,0-344.1-65.2-964.1-65.2C335.9,6.2-0.1,71.6-0.1,71.6l0-72.2l958.9,0l961.1,0"/>
                    </svg>
                </div>
                <div class="row">
                    <ul class="footer-social-buttons">
                        <li>
                            <a href="#" class="btn btn-just-icon btn-simple btn-twitter">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-just-icon btn-simple btn-facebook">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-just-icon btn-simple btn-dribbble">
                                <i class="fa fa-dribbble"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-just-icon btn-simple btn-google">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn btn-just-icon btn-simple btn-youtube">
                                <i class="fa fa-youtube-play"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="copyright">
                        Copyright © <script>document.write(new Date().getFullYear())</script> Mad Sparrow All Rights Reserved.
                    </div>
                </div>
            </footer>
        <!-- /Footer -->
        </div>
    <!-- /Wrapper -->

    <!-- JS -->
    <!-- jquery-2.1.3.min js -->
        <script type="text/javascript" src='assets/js/jquery-2.1.3.min.js'></script>

    <!-- Plugins -->
        <script type="text/javascript" src='assets/js/plugins.min.js'></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_6tue0EjhSEmvxC0BG251N6w6fYh7r5s"></script>
       
    <!-- Main js -->
        <script type="text/javascript" src="assets/js/main.js"></script>
    </body>
</html>