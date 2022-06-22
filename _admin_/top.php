<?php
include "db_info.php";
include "session_inc.php";
   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
//session_cache_expire(360);
//session_start();

$url = $_SERVER['REQUEST_URI'];

//echo "url = ".$url;

if($url != "/admin/list_cal2.php" && $url != "/admin/list_cal.php" ){
	if($jb_login == false){
		$str = "";
		$str .= '<script>alert("세션이 만료되어 로그인페이지로 이동합니다.");';
		$str .= 'document.location.replace("login.php");</script>';
		echo $str;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?=$TITLE?></title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="shortcut icon" href="images/icon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/wf_loading.js" type="text/javascript"></script>
<link href="css/wf_loading.css" rel="stylesheet" type="text/css" />

<script>


isloading = {
  start: function() {
    if (document.getElementById('wfLoading')) {
      return;
    }
    var ele = document.createElement('div');
    ele.setAttribute('id', 'wfLoading');
    ele.classList.add('loading-layer');
    ele.innerHTML = '<span class="loading-wrap"><span class="loading-text"><span>.</span><span>.</span><span>.</span></span></span>';
    document.body.append(ele);

    // Animation
    ele.classList.add('active-loading');
  },
  stop: function() {
    var ele = document.getElementById('wfLoading');
    if (ele) {
      ele.remove();
    }
  }
}

</script>
    
    
<body>
    

		<div id="n_Wrap">
            <a href="#none" class="n_menuHide"></a> 
            <div id="header">                 
                <div class="n_gnbWrap">    
                    <div class="n_gnb">   
                        <a href="main.php"><h1></h1></a>
                        <ul>
<?PHP
	if($depid == "D1016"){
		//class="active"
?>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li>
                                <ul class="gnbSub">
                                    <li ></li>
                                </ul>
                            </li>
							<li id="works"><a href="list_trans.php">웍스</a>
                                <ul class="gnbSub">
                                    <li id="trans"><a href="list_trans.php">재산제세</a></li>
                                    

                                </ul>
                            </li>

<?php
		}else{
?>
                            <li id="news"><a href="list_news.php">뉴스톡</a>
                                <ul class="gnbSub">
                                    <li id="news_"><a href="list_news.php">뉴스톡</a></li>
                                </ul>
                            </li>
                            <li id="smartA"><a href="list_smartA.php">SmartA</a>
                                <ul class="gnbSub">
                                    <li  id="smartA_"><a href="list_smartA.php">SmartA</a></li>
                                </ul>
                            </li>
                            <li id="cal"><a href="list_cal.php">계산기</a>
                                <ul class="gnbSub">
                                    <li id="cal1"><a href="list_cal.php">조정료</a></li>
									<li id="cal2"><a href="list_cal2.php">양도/상속/증여</a></li>
                                </ul>
                            </li>
                            <li id="date"><a href="list_date.php">세무일정</a>
                                <ul class="gnbSub">
                                    <li id="date_"><a href="list_date.php">세무일정</a></li>
                                </ul>
                            </li>
                            <li id="income"><a href="list_RPA_simple.php">종합소득세</a>
                                <ul class="gnbSub">
                                    <li id="simple"><a href="list_RPA_simple.php">간편안내</a></li>
                                    <li id="reg"><a href="list_RPA_reg.php">영업현황</a></li>
                                    <li id="acc"><a href="list_RPA_acc.php">접수현황</a></li>
                                </ul>
                            </li>
                            <li id="home"><a href="list_home.php">주택임대</a>
                                <ul class="gnbSub">
                                    <li id="home_"><a href="list_home.php">주택임대</a></li>
									<li id="exem_"><a href="list_exem.php">면세사업</a></li>
                                </ul>
                            </li>
                            <li id="disc"><a href="list_disc.php">DISC체크</a>
                                <ul class="gnbSub">
                                    <li id="disc_"><a href="list_disc.php">DISC체크</a></li>
                                </ul>
                            </li>
                            <li id="RPA"><a href="list_cust.php">RPA</a>
                                <ul class="gnbSub">
                                    <li id="cust"><a href="list_cust.php">전체고객 리스트</a></li>
                                    <li id="inc"><a href="list_RPA_inc.php">소득세</a></li>
                                    <li id="vat"><a href="list_RPA_vat.php">부가세</a></li>
                                    
                                </ul>
                            </li>
                            <li id="works"><a href="list_trans.php">웍스</a>
                                <ul class="gnbSub">
                                    <li id="trans"><a href="list_trans.php">재산제세</a></li>
                                    <li id="4insu"><a href="list_4insu.php">4대보험</a></li>

                                </ul>
                            </li>
<?php
				
}
				if( $jb_login ) {
?>
                            <li class="mypage">
                                <a href="logout.php">
                                    <span><?=$depname?><br><b><?=$username?></b></span>
                                    <input type="button" value="LOGOUT" >
                                </a>
                                <ul class="gnbSub mypageSub">
                                    <li><a href="reg_member.php?id=<?=$userid?>">마이페이지</a></li>
                                    <?php
				if($userid =='1149'){
?>
                                    <li><a href="list_golf.php">골프장예약RPA</a></li>
									<li><a href="list_dev.php">DEV_list</a></li>
									<li><a href="write_dev.php">DEV_write</a></li>
									<li><a href="list_member.php">멤버리스트</a></li>
									<li><a href="reg_member.php">멤버등록</a></li>
									<li><a href="list_cal_.php">양도계산기</a></li>
<?php
				}
?>
                                </ul>
                            </li>


<?php
				}
?>
                        </ul>  
                        <span class="bg"></span> 
                        <span class="line"></span>                     
                    </div>                    
                </div>
            </div>	






			</ul>
		</div>
	</div>
</div>

<script>
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
/*
//모바일체크..
	var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');

	var request = new Request();
	var id = request.getParameter("id");
	var cate = request.getParameter("cate");
	var url = window.location.href;
	var newurl = "";

	for (var word in mobileKeyWords) {
		if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
			newurl = window.location.protocol + "//taxtok.kr" + window.location.pathname;
			//alert(newurl);
			window.location.href = newurl;			
			break;
		}
	}
*/
//모바일체크
	var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');

	var request = new Request();
	var id = request.getParameter("id")
	var cate = request.getParameter("cate")
	var url = window.location.href;

	if (request.getParameter("pc") == "y") {
		var test = "1";
	} else {
		for (var word in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
//				window.location.href = "m/index.php";
				if(url.indexOf("sub_newsview.php")>0){
					window.location.href = "m/sub_newsview.php?id="+id;				
				}else if(url.indexOf("sub_news.php")>0){
					window.location.href = "m/sub_news.php?cate="+cate;		
				}else{
					window.location.href = "m/index.php";
				}

				break;
			}
		}
	}



	/*
		타이틀, 상단메뉴class on작업
	*/
	function top_menu(str){
		var flag = str;

		//document.getElementById( flag ).setAttribute( 'class', 'on' );
		document.getElementById( 'page_title' ).innerHTML = flag;

		switch(str){
			case "뉴스톡" :		
				document.getElementById('news').setAttribute("class","active");
				document.getElementById('news_').setAttribute("class","active");
			break;
			case "Smart A 멤버리스트" :
				document.getElementById('smartA').setAttribute("class","active");
				document.getElementById('smartA_').setAttribute("class","active");
			break;
			case "조정료계산기" :
				document.getElementById('cal').setAttribute("class","active");
				document.getElementById('cal1').setAttribute("class","active");
			break;
			case "재산제세 계산기" :
				document.getElementById('cal').setAttribute("class","active");
				document.getElementById('cal2').setAttribute("class","active");
			break;
			case "세무일정" :
				document.getElementById('date').setAttribute("class","active");
				document.getElementById('date_').setAttribute("class","active");
			break;
			case "종합소득세 간편안내" :
				document.getElementById('income').setAttribute("class","active");
				document.getElementById('simple').setAttribute("class","active");
			break;
			case "종합소득세 영업현황" :
				document.getElementById('income').setAttribute("class","active");
				document.getElementById('reg').setAttribute("class","active");
			break;
			case "종합소득세 접수현황" :
				document.getElementById('income').setAttribute("class","active");
				document.getElementById('acc').setAttribute("class","active");
			break;
			case "주택임대" :
				document.getElementById('home').setAttribute("class","active");
				document.getElementById('home_').setAttribute("class","active");
			break;
			case "면세사업" :
				document.getElementById('home').setAttribute("class","active");
				document.getElementById('exem_').setAttribute("class","active");
			break;
			case "콜백리스트" :
				document.getElementById('callback').setAttribute("class","active");
				document.getElementById('callback_').setAttribute("class","active");
			break;
			case "RPA 종합소득세" :
				document.getElementById('RPA').setAttribute("class","active");
				document.getElementById('inc').setAttribute("class","active");
				break;
			case "RPA 부가세" :
				document.getElementById('RPA').setAttribute("class","active");
				document.getElementById('vat').setAttribute("class","active");
				break;
			case "양도":
				document.getElementById('works').setAttribute("class","active");
				document.getElementById('trans').setAttribute("class","active");
				break;
			case "4대보험" :
				document.getElementById('works').setAttribute("class","active");
				document.getElementById('4insu').setAttribute("class","active");
				break;
			case "전체고객리스트" :
				document.getElementById('RPA').setAttribute("class","active");
				document.getElementById('cust').setAttribute("class","active");
				break;

			default: "";

		}

	}






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

	function notify(str, id) {
		var username = "<?=$username?>";

		if (Notification.permission !== 'granted') {
			alert('notification is disabled');
		}
		else {
			upt_noti(id);
			var notification = new Notification('Notification title', {
				icon: 'https://taxtok.kr/admin/images/logo.png',
				body: "[알림]"+username+"님에게 새로운 알림. \n\n"+str,
			});

			notification.onclick = function () {
				window.open('http://google.com');
			};
		}
	}



	function upt_noti(id){
		var action = "dev";
		
		
			$.ajax({
			url:"select.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				console.log(data);
				
			}
		})
	}



	function notify_ck()
	{
		
		var action = "notify";
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
					//notify(data.CONTENTS, data.ID);
				}
			}
		})

	}




var timer = setInterval(function(){
        //console.log("Hello!!");
		var userid = "<?=$userid?>";
		if(userid == "1149"){
			//notify_ck();		
		}

    }, 2000)

</script>