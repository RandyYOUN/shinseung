<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승 CRM</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="shortcut icon" href="images/icon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
	<div class="n_loginWrap">	
        <div class="n_login">
            <div class="n_loginSidebg"></div>

            <div class="n_loginContents">
                <h1>SHINSEUNG</h1>
                <h2>미래와 경쟁하면 상상이 현실이 됩니다</h2>
                <input type="box" placeholder="Username" name="id" id="id">
                <input type="password" placeholder="Password" name="password" id="password" onkeypress="caps_lock(event);">
                <input type="checkbox" id="loginid"><label for="loginid" >아이디저장</label>
				<p id="capslock" style="background-color:red;color:white;position:relative; border:2px solid #003b83; width:300px; bottom:0px; display:none"> 
					&nbsp;<b>CapsLock</b> 키가 눌려있습니다.&nbsp;
				</p>
                <input type="button" value="LOGIN" name="login" id="login">
                <ul>
                    <li>아이디/패드워드 문의</li>
                    <li>영업본부 윤형덕 차장<br>#6104</li>
                </ul> 
                <h5>COPYRIGHT(c) SHINSEUNG COPY RIGHT RESERVED</h5>               
            </div>           

        </div>      
        
	</div>
</body>

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




$(document).ready(function(){
	var userInputId = getCookie("userInputId");
    var setCookieYN = getCookie("setCookieYN");

if(setCookieYN == 'Y') {
        $("#loginid").prop("checked", true);
		$("#password").focus();
    } else {
        $("#loginid").prop("checked", false);
		$("#id").focus();
    }


$("#id").val(userInputId); 
    
		$('#login').click(function(){
			
			if($("#loginid").is(":checked")){ 
				var userInputId = $("#id").val();
				setCookie("userInputId", userInputId, 60); 
				setCookie("setCookieYN", "Y", 60);
			} else {
				deleteCookie("userInputId");
				deleteCookie("setCookieYN");
			}

			var id = $('#id').val();
			var pw = $('#password').val();
			var action = "login";

			$.ajax({
				url:"select.php",
				method:"POST",
				data:{id:id,pw:pw,action:action},
				success:function(data){

					if(data!="login_ok"){
						alert('로그인실패');
					}else{
						window.location.replace("main.php");
					}
				},
				error: function (request, status, error) {
					alert('로그인ERROR!\n [code]: '+request.status+"\n"+'[message]: '+request.responseText+"\n"+'[error]: '+error);
				}
			});
		

		});

 

	$("#password").keydown(
		function(key) {
			if (key.keyCode == 13) {
				if($("#loginid").is(":checked")){ 
					var userInputId = $("#id").val();
					setCookie("userInputId", userInputId, 60); 
					setCookie("setCookieYN", "Y", 60);
				} else {
					deleteCookie("userInputId");
					deleteCookie("setCookieYN");
				}

				var id = $('#id').val();
				var pw = $('#password').val();
				var action = "login";

				$.ajax({
					url:"select.php",
					method:"POST",
					data:{id:id,pw:pw,action:action},
					success:function(data){

						if(data!="login_ok"){
							alert('로그인실패');
						}else{
							window.location.replace("main.php");
						}
					},
					error: function (request, status, error) {
						alert('로그인ERROR!\n [code]: '+request.status+"\n"+'[message]: '+request.responseText+"\n"+'[error]: '+error);
					}
				});
			}
		}
	);

});

function setCookie(cookieName, value, exdays){
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var cookieValue = escape(value) + ((exdays==null) ? "" : "; expires=" + 
    exdate.toGMTString());
    document.cookie = cookieName + "=" + cookieValue;
}

//쿠키값 Delete
function deleteCookie(cookieName){
    var expireDate = new Date();
    expireDate.setDate(expireDate.getDate() - 1);
    document.cookie = cookieName + "= " + "; expires=" + expireDate.toGMTString();
}

//쿠키값 가져오기
function getCookie(cookie_name) {
    var x, y;
    var val = document.cookie.split(';');
    
    for (var i = 0; i < val.length; i++) {
        x = val[i].substr(0, val[i].indexOf('='));
        y = val[i].substr(val[i].indexOf('=') + 1);
        x = x.replace(/^\s+|\s+$/g, ''); // 앞과 뒤의 공백 제거하기
        
        if (x == cookie_name) {
          return unescape(y); // unescape로 디코딩 후 값 리턴
        }
    }
}

function caps_lock(e) {
		var keyCode = 0;
		var shiftKey = false;
		keyCode = e.keyCode;
		shiftKey = e.shiftKey;
		if (((keyCode >= 65 && keyCode <= 90) && !shiftKey)
				|| ((keyCode >= 97 && keyCode <= 122) && shiftKey)) {
			show_caps_lock();
			setTimeout("hide_caps_lock()", 3500);
		} else {
			hide_caps_lock();
		}
	}

function show_caps_lock() {
	 $("#capslock").show();
}

function hide_caps_lock() {
	 $("#capslock").hide();
}

</script>

</html>