<a href="index.php">종합소득세 신고전문</a>
					<ul>						
						<a href="sub_review.php">
							<li>사용자리뷰</li>
						</a>
						<a href="sub_price.php">
							<li>서비스가격</li>
						</a>
						<a href="sub_smart.php">
							<li>스마트세무</li>
						</a>
						<a href="sub_member.php">
							<li>구성원</li>
						</a>
						<a href="sub_news.php?cate=CIT">
							<li>세무뉴스</li>
						</a>
<?php 
#include "session_inc.php";
//session_start();

#$jb_login =$_SESSION['JB_LOGIN'];
$username=$_SESSION['USERNAME_KAKAO'];
#echo 'username ='. $username;

if ($username == ""){
?>
		<p class="login">
							<span onclick="location.href='<?php echo $KAKAO_OAUTH_URI?>'">로그인</span>
							<span onclick="javascript:window.location.href='login_kakao.php'">회원가입</span>
						</p>
<?php 
}else{
?>

	 					<p class="logout">
							<strong><b><?php echo $username; ?></b> 님 안녕하세요</strong>
							<span onclick="javascriot:location.href='logout.php'">로그아웃</span>
						</p> 
<?php 
}
?>
						
					</ul>
				