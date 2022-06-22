		<div id="n_Wrap">
            <a href="#none" class="n_menuHide"></a> 
            <div id="header">                 
                <div class="n_gnbWrap">    
                    <div class="n_gnb">   
                        <a href="main.php"><h1></h1></a>
                        <ul>
<?PHP
	if($depthid == "D2009"){
		//class="active"
?>
							<li id ="trans" ><a href="list_trans.php">양도</a>
                                <ul class="gnbSub">
                                    <li><a href="list_trans.php">양도</a></li>
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
                            <li id="cal"><a href="list_cal.php">조정계산</a>
                                <ul class="gnbSub">
                                    <li id="cal_"><a href="list_cal.php">조정계산</a></li>
                                </ul>
                            </li>
                            <li id="date"><a href="list_date.php">세무일정</a>
                                <ul class="gnbSub">
                                    <li id="date_"><a href="list_date.php">세무일정</a></li>
                                </ul>
                            </li>
                            <li id="income"><a href="list_income.php">종합소득세</a>
                                <ul class="gnbSub">
                                    <li id="income_"><a href="list_RPA_inc.php">종합소득세</a></li>
                                </ul>
                            </li>
                            <li id="home"><a href="list_home.php">주택임대</a>
                                <ul class="gnbSub">
                                    <li id="home_"><a href="list_home.php">주택임대</a></li>
                                </ul>
                            </li>
                            <li id="callback"><a href="list_callback.php">콜백</a>
                                <ul class="gnbSub">
                                    <li id="callback_"><a href="list_callback.php">콜백</a></li>
                                </ul>
                            </li>
                            <li id="RPA"><a href="">RPA</a>
                                <ul class="gnbSub">
                                    <li id="inc"><a href="list_RPA_inc.php">소득세</a></li>
                                    <li id="vat"><a href="list_RPA_vat.php">부가세</a></li>
                                </ul>
                            </li>
                            <li id="works"><a href="">웍스</a>
                                <ul class="gnbSub">
                                    <li id="trans"><a href="list_trans.php">양도세</a></li>
                                    <li id="4insu"><a href="list_4insu.php">4대보험</a></li>

                                </ul>
                            </li>
<?php
				
}
				if( $jb_login ) {
?>
                            <li class="mypage">
                                <a href="">
                                    <span><?=$depname?><br><b><?=$username?></b></span>
                                    <input type="button" value="LOGOUT" name="logout" id="logout">
                                </a>
                                <ul class="gnbSub mypageSub">
                                    <li><a href="reg_member.php?id=<?=$userid?>">마이페이지</a></li>
                                    <?php
				if($userid =='1149'){
?>
                                    <li><a href="list_dev.php">DEV</a></li>
									<li><a href="list_member.php">멤버리스트</a></li>
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

//모바일체크
	var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');

	var request = new Request();
	var id = request.getParameter("id");
	var cate = request.getParameter("cate");
	var url = window.location.href;

	if (request.getParameter("pc") == "y") {
		var test = "1";
	} else {
		for (var word in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
//				window.location.href = "m/index.php";
				if(url.indexOf("main.php")>0){
					window.location.href = "m/main.php";				
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
				document.getElementById('cal_').setAttribute("class","active");
			break;
			case "세무일정" :
				document.getElementById('date').setAttribute("class","active");
				document.getElementById('date_').setAttribute("class","active");
			break;
			case "종합소득세 신청" :
				document.getElementById('income').setAttribute("class","active");
				document.getElementById('income_').setAttribute("class","active");
			break;
			case "주택임대" :
				document.getElementById('home').setAttribute("class","active");
				document.getElementById('home_').setAttribute("class","active");
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

			default: "";

		}

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