<?php
include "db_info.php";
include "session_inc.php";
   /* $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
//session_cache_expire(360);
/* session_start();

if($jb_login == false){
	$str = "";
	$str .= '<script>alert("세션이 만료되어 로그인페이지로 이동합니다.");';
	$str .= 'document.location.replace("login.php");</script>';

	echo $str;
} */

?>
	<div class="mgnb">
<?php
if( $jb_login ) {
?>
        <h1><b><?=$username?></b> <?=$depname?></h1>
<?php
				}
?>
        <ul class="gnb">
<?PHP
	if($position_id == "D2009"){
?>
			<li>
                <a href="list_trans.php">양도</a>
            </li>

<?php
		}else{
?>
            <!-- li>
                <a href="list_news.php">뉴스톡</a>
            </li>
            <li>
                <a href="list_smartA.php">SmartA</a>
            </li>
            <li>
                <a href="list_cal.php">조정료계산</a>
            </li>
            <li>
                <a href="list_date.php">세무일정</a>
            </li>
           <li><a href="#none">종합소득세<i></i></a>
                <ul>
                    <li ><a href="list_RPA_simple.php">간편안내</a></li>
                    <li ><a href="list_RPA_reg.php">영업현황</a></li>
                    <li ><a href="list_RPA_acc.php">접수현황</a></li>
                </ul>
            </li>
            <li>
                <a href="list_home.php">주택임대</a>
            </li>
			 <li>
                <a href="list_callback.php">콜백</a>
            </li>
            <li>
                <a href="#none">RPA<i></i></a>
                <ul>
                    <li><a href="list_RPA_inc.php">소득세</a></li>
                    <li><a href="list_RPA_vat.php">부가세</a></li>
                </ul>
            </li>
            <li>
                <a href="#none">WORKS <i></i></a>
                <ul>
                    <li><a href="list_trans.php">양도세</a></li>
                    <li><a href="list_4insu.php">4대보험</a></li>
                </ul>
            </li-->
            <li>
                <a href="#none">DISC체크<i></i></a>
                <ul>
                    <li><a href="list_disc.php">DISC체크</a></li>
                    <!-- li><a href="list_4insu.php">4대보험</a></li-->
                </ul>
            </li>
            <li>
                <a href="#none">WORKS <i></i></a>
                <ul>
                    <li><a href="list_trans.php">재산제세</a></li>
                    <!-- li><a href="list_4insu.php">4대보험</a></li-->
                </ul>
            </li>
<?php
}

if($userid =='1149'){
?>
			<li><a href="list_dev.php">DEV</a></li>
<?php
}
?>        </ul>
        <a class="mGnbClose"><i></i></a>
    </div>




<script>

	/*
		타이틀, 상단메뉴class on작업
	*/
	function top_menu(str){
		var flag = str;

		//document.getElementById( flag ).setAttribute( 'class', 'on' );
		document.getElementById( 'page_title' ).innerHTML = flag;

	}


$(document).ready(function(){
	
	$('#logout').click(
		function(){
			location.href="logout.php";
		}	
	);

});



window.onload = function () {
            if (window.Notification) {
                Notification.requestPermission();
            }
        }
 
 
function calculate() {
            setTimeout(function () {
                notify(str);
            }, 1000);
        }

function notify(str) {
            if (Notification.permission !== 'granted') {
                alert('notification is disabled');
            }
            else {
                var notification = new Notification('Notification title', {
                    icon: 'https://taxtok.kr/admin/images/logo.png',
                    body: str,
                });
 
                notification.onclick = function () {
                    window.open('http://google.com');
                };
            }
        }


	function notify_ck()
	{
		
		var action = "dev";
		var userid="<?= $userid ?>";

			$.ajax({
			url:"select.php",
			method:"POST",
			data:{userid:userid, action:action},
			dataType:"json",
			success:function(data)
			{
				console.log(data);
				if(data.CONTENTS){
					notify(data.CONTENTS);
				}
			}
		})

	}



/*
var timer = setInterval(function(){
        //console.log("Hello!!");
		notify_ck();
    }, 2000)
*/
</script>