<!doctype html>
<html>

<head>
	<meta charset="utf-8">
    <title>신승세무법인</title>
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>	
	<link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/common.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">	
</head>
<body>
    <div class="loginWrap">
        <section class="login">
            <h1>SHINSEUNG</h1>
            <h2>미래와 경쟁하면 상상이 현실이 됩니다</h2>
            <span>
                <input type="box" placeholder="Username" name="id" id="id">
                 <input type="password" placeholder="Password" name="password" id="password">
                <input type="checkbox"  id="idSaveCheck"><label for="loginid">아이디저장</label>
                <input type="button" value="LOGIN" name="login" id="login">
            </span>            
            <ul>
                <li>아이디/패드워드 문의</li>
                <li>영업본부 윤형덕 차장 #6104</li>
            </ul> 
        </section>
        <h5 class="copyright">COPYRIGHT(c) SHINSEUNG COPY RIGHT RESERVED</h5>  
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
        $("#idSaveCheck").prop("checked", true);
		$("#password").focus();
    } else {
        $("#idSaveCheck").prop("checked", false);
		$("#id").focus();
    }


$("#id").val(userInputId); 
    

		$('#login').click(function(){
			
			if($("#idSaveCheck").is(":checked")){ 
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
				url:"../select.php",
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
				if($("#idSaveCheck").is(":checked")){ 
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
					url:"../select.php",
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



</script>