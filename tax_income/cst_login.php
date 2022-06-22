<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>신승세무법인-세무톡</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
    <link rel="stylesheet" href="resources/css/common.css" />
    <script type="text/javascript" src="resources/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="resources/js/common.js"></script>
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
var id = request.getParameter("id")
var cate = request.getParameter("cate")
var link2 = request.getParameter("link2")
var url = window.location.href;

if (request.getParameter("pc") == "y") {
	var test = "1";
} else {
	for (var word in mobileKeyWords) {
		if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
    			window.location.href = "m/cst_login.php";
    			break;
		}
	}
}

</script>
</head>

<body>
<form id="frm" name="frm" method="post">
    <!-- main -->
    <section class="stepLastLogin">
        <div class="contents">
            <div>
                <h1>신고처리 현황조회 </h1>
                <input type="text" placeholder="성함을 입력해주세요" id="CSTNAME" name="CSTNAME">
                <input type="text" placeholder="핸드폰번호를 입력해주세요" id="MOBILE" name="MOBILE" maxlength=11>
                <input type="button" value="로그인" id="login" name="login">
                <h2><span>국세청 33년 경력</span></h2>
                <h3>믿고 맡길 수 있는 신승세무법인</h3>
            </div>
        </div>

    </section>
    <!-- main -->
    <input type="hidden" id="CSTID" name="CSTID" value="">
    <input type="hidden" id="year" name="year" value="2021">
</form>


</body>

<script>

$(document).ready(function(){

	$('#login').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var cstname = $('#CSTNAME').val();
		var mobile= $('#MOBILE').val();
		var action = "login_cstname_mobile";

		//성과 이름이 올바르게 입력이 되면
		if(cstname !='' && mobile!= ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				dataType: 'json',
				data:{cstname:cstname,mobile:mobile,action:action},
				success:function(data){
					if(data.CSTID){
						//window.location.href="cst_filelist.php"+data.CSTID;
						$("#CSTID").val(data.CSTID);
						$("#year").val();
						
						$("#frm").attr("action","cst_filelist.php").submit();
					}else{
						alert('로그인에 실패하였습니다. \n이름과 핸드폰번호를 확인하여주세요.');
					}
					
				}
			});

		}else{
			alert('성함과 핸드폰번호를 입력해 주세요');
		}
	}); // [2]끝
	

	$("#CSTNAME").bind("keyup",function(){
    	 re = /[~!@\#$%^&*\()\-=+_']/gi;
    	 blank_ = /^\s+|\s+$/g;
    	  
    	 var temp=$("#CSTNAME").val();
    	 if(re.test(temp)){ //특수문자가 포함되면 삭제하여 값으로 다시셋팅
    	 	$("#CSTNAME").val(temp.replace(re,"")); 
    	 }

    	 if(blank_.test(temp)){ //특수문자가 포함되면 삭제하여 값으로 다시셋팅
     	 	$("#CSTNAME").val(temp.replace(blank_,"")); 
     	 } 
	 });



	$("#MOBILE").bind("keyup",function(){
    	 re = /[~!@\#$%^&*\()\-=+_']/gi;
    	 blank_ = /^\s+|\s+$/g;
    	  
    	 var temp=$("#MOBILE").val();
    	 if(re.test(temp)){ //특수문자가 포함되면 삭제하여 값으로 다시셋팅
    	 	$("#MOBILE").val(temp.replace(re,"")); 
    	 }

    	 if(blank_.test(temp)){ //특수문자가 포함되면 삭제하여 값으로 다시셋팅
     	 	$("#MOBILE").val(temp.replace(blank_,"")); 
     	 } 
	 });
	 


});


	
</script>


</html>