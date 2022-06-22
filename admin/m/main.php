<!doctype html>
<html>

<head>
	<meta charset="utf-8">
    <title>신승 RPA</title>	
    <script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>	
	<link rel="stylesheet" href="css/basic.css">
    <link rel="stylesheet" href="css/common.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">	
</head>
<body>
    <div class="mask"></div>
    <div class="wrap">
        <header>
            <div>
                <h1 ><a href="main.php">SHINSEUNG</a></h1>
                <h2>
                <a href="#none" class="mgnbOpen"><span></span><span></span><span></span></a>
                </h2>
            </div>
            <section class="boardTop">
                <h1 id="page_title">퀵링크</h1>
                <div class="search"> 
                    <select name="s_option" id ="s_option">
                        <option selected value="">선택</option>
                        <option value="F1001">보고</option>
                        <option value="F1002">면접</option>
                        <option value="F1003">회의록</option>
                        <option value="F1004">설문</option>
						<option value="F1005">FAQ</option>
						<option value="F1006">데이터</option>
                    </select>
                    <input type="box" placeholder="검색어를 입력해주세요" id="s_str1">
                    <input type="button" id="btn_search1" name="btn_search1">                        
                </div>  
    
                <div class="quickBoard" id="n_quickMain" name="n_quickMain">
                    
                </div>
            </section>
        </header>

        <section class="boardTop">
            <h2 >연락망</h2>
            <div class="search"> 
                <select name="d_option" id ="d_option">
                    <option value="" selected>선택</option>
                    <option value="username" >이름</option>
                    <option value="depname" >부서</option>
                    <option value="phone" >번호</option>
                </select>
                <input type="box" placeholder="검색어를 입력해주세요" id="s_str2">
                <input type="button" id="btn_search2" name="btn_search2">                        
            </div>  

            <div class="mainBoard">
                <table>
                    <colgroup>
                        <col width="15%">
                        <col width="">
                        <col width="45%">
                    </colgroup>
                    <tbody ID="result">
                        
                    </tbody>
                </table>
            </div>
        </section>       

        <h5 class="copyright">COPYRIGHT(c) SHINSEUNG COPY RIGHT RESERVED</h5>  
    </div>

    <?PHP
	include "top.php";
	?>


    
    <script>
    $(document).ready(function(){

        //모바일오픈
        $(".mgnbOpen").on("click",function(){

            $(".mgnb").css("display", "block");
            $(".mgnb").animate({ right: 0 }, 300);
            $(".wrap").animate({ left: "-80%" }, 300);
            $(".mask").fadeIn(300);
            
        });

        $(".mGnbClose").on("click",function(){
            $(".mgnb").animate({ right: "-80%" }, 300);
            $(".mgnb").fadeOut(300);
            $(".wrap").animate({ left: 0 }, 300);
            $(".mask").fadeOut(300);
        })
        
        $(".gnb a").next("ul").css("display","none");
        $(".gnb a").on("click",function(){
            var $this = $(this);
            $this.next("ul").slideToggle();
            $this.parent("li").toggleClass("active");
        });


        
        
    });
	
	
    </script>

	<input type="hidden" id="page_flag" value="퀵링크">

</body>

<script>


var first = "Y";


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

	var req = new Request();
	var page_flag = document.getElementById("page_flag").value;
	var s_option = req.getParameter("s_option");
	var d_option = req.getParameter("d_option");
	var s_str1= req.getParameter("s_str1");
	var s_str2= req.getParameter("s_str2");
	var s_switch= req.getParameter("s_switch");
	top_menu(page_flag);

	
	if(s_option !=""){
		$('#s_option').val(s_option).attr('selected','selected');
	}
	
	if (d_option != "") {
		switch (d_option)
		{
			case "username" : 	
				$('#d_option').val('username').attr('selected','selected');
				break;
			case "depname" : 		
				$('#d_option').val('depname').attr('selected','selected');
				break;
			case "phone" : 						
				$('#d_option').val('phone').attr('selected','selected');
				break;
			default : alert("error");
		}
	}

	if(s_str1 !=""){
		$('#s_str1').val(s_str1);
	}

	if(s_str2 !=""){
		$('#s_str2').val(s_str2);
	}

	if(s_switch != ""){
		var offset = $("#s_str2").offset();
        $('html, body').animate({scrollTop : offset.top+500}, 100);
	}

	$('#btn_search1').click(
		function() {
			var s_option = $('#s_option').val();
			var s_str1 = $('#s_str1').val();
			var d_option = $('#d_option').val();
			var s_str2 = $('#s_str2').val();
			var s_switch = "";

			if(s_option !="" ){
				window.location.href="?s_option="+s_option+"&d_option="+d_option+"&s_str1="+escape(s_str1)+"&s_str2="+escape(s_str2);
			}else{
				alert("검색 조건을 설정해주세요");
				if(s_option ==""){
					$('#s_option').focus();
				}else if(s_str1 ==""){
					$('#s_str1').focus();
				}
			}
		}	
	);


	$('#btn_search2').click(
		function() {
			var s_option = $('#s_option').val();
			var s_str1 = $('#s_str1').val();
			var d_option = $('#d_option').val();
			var s_str2 = $('#s_str2').val();
			var s_switch = "s2";

			if(d_option !="" ){
				window.location.href="?s_option="+s_option+"&d_option="+d_option+"&s_str1="+escape(s_str1)+"&s_str2="+escape(s_str2)+"&s_switch="+s_switch;
			}else{
				alert("검색 조건을 설정해주세요");
				if(d_option ==""){
					$('#s_option').focus();
				}else if(s_str2 ==""){
					$('#s_str2').focus();
				}
			}
		}	
	);


	fetchUser();
	function fetchUser()
	{

		var action = "select_link";
		var s_option = $('#s_option').val();
		var s_str1 = $('#s_str1').val();
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action, s_option:s_option,s_str1:s_str1},
			success:function(data){
				$('#n_quickMain').html(data);
			}
		})
	}



	fetchUser2();
	function fetchUser2()
	{

		var action = "select_member_main_m";
		var d_option = $('#d_option').val();
		var s_str2 = $('#s_str2').val();
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action, d_option:d_option, s_str2:s_str2},
			success:function(data){
				$('#result').html(data);
			}
		})
	}

});


</script>

</html>