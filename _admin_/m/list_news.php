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
                <h1><a href="main.php">SHINSEUNG</a></h1>
                <h2>
                <a href="#none" class="mgnbOpen"><span></span><span></span><span></span></a>
                </h2>
            </div>
        </header>

        <section class="boardTop">
            <h2 id="page_title"></h2>
            <div class="search"> 
                <select id="s_option" name="s_option">
                    <option value="" selected>선택</option>
                    <option value="id">번호</option>
                    <option value="subject">제목</option>
                    <option value="contents">내용</option>
                    <option value="news_reguser">작성자</option>
                </select>
                <input type="box" placeholder="검색어를 입력해주세요" id="s_str" name="s_str">
                <input type="button" id="btn_search" name="btn_search">                        
            </div>  

            <div class="mainBoard">
                <table>
                    <colgroup>
                        <col width="8%">
						<col width="50%">
                        <col width="10%">
                        <col width="30%">
                    </colgroup>
					<thead>
						<tr>
							<th>번호</th>
							<th>제목</th>
							<th>작성자</th>
							<th>작성일</th>
						</tr>
						</thead>
                    <tbody ID="result">
                        
                    </tbody>
                </table>
            </div>
			
<?php
include "db_info.php";
 function toString($text){
   return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
}

function unescape($text){
   return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'toString', $text));
}


$STR = "";
$s_option = $_GET["s_option"];
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";
$query_desc = "ORDER BY ID DESC";
$page = $_GET["page"];
$QUERY_STR = "&s_option=".$s_option."&s_str=".$_GET["s_str"];


$page_set = 12; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


	switch($s_option){
			case "subject" : 
				$STR .= " AND SUBJECT like '%".$s_str."%' ";
				break;
			case "contents" : 
				$STR .= " AND CONTENTS_ like '%".$s_str."%' ";
				break;
			case "news_reguser" : 
				$STR .= " AND NEWS_REGUSER like '%".$s_str."%' ";
				break;
			case "id" : 
				$STR .= " AND ID = '".$s_str."' ";
				break;
			default:
				$STR .=" ";
			}	

$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' ".$STR;


//$QUERY_STR = $query_str1.$query_str2;

$result = mysql_query($query, $connect) or die ("쿼리 에러 : ".mysql_error($connect));

$row = mysql_fetch_array($result);
 
$total = $row[total]; // 전체글수

 
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
 
$limit_idx = ($page - 1) * $page_set; // limit시작위치


// 페이지번호 & 블럭 설정
$first_page = (($block - 1) * $block_set) + 1; // 첫번째 페이지번호
$last_page = min ($total_page, $block * $block_set); // 마지막 페이지번호
 
$prev_page = $page - 1; // 이전페이지
$next_page = $page + 1; // 다음페이지
 
$prev_block = $block - 1; // 이전블럭
$next_block = $block + 1; // 다음블럭
 
// 이전블럭을 블럭의 마지막으로 하려면...
$prev_block_page = $prev_block * $block_set; // 이전블럭 페이지번호
// 이전블럭을 블럭의 첫페이지로 하려면...
//$prev_block_page = $prev_block * $block_set - ($block_set - 1);
$next_block_page = $next_block * $block_set - ($block_set - 1); // 다음블럭 페이지번호

$QUERY_STR = "&s_option=".$_GET["s_option"]."&s_str=".$_GET["s_str"];
 

?>	
				<div class="page">
					
<?php 

						echo ($prev_block > 0) ? "<a href='$PHP_SELF?page=$prev_block_page$QUERY_STR' class='first'><span class='icon'>처음</span></a>" : "<a  class='first'><span class='icon'>처음</span></a>";
						echo ($prev_page > 0) ? "
						<a href='$PHP_SELF?page=$prev_page$QUERY_STR' class='prev'><span class='icon'>이전</span></a> " : "<a  class='prev'><span class='icon'>이전</span></a> ";
?>	
					<span class="num">
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='$PHP_SELF?page=$i$QUERY_STR'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>
					</span>
<?php 
					echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$QUERY_STR' class='next'><span class='icon'>다음</span></a> " : "<a class='next'><span class='icon'>다음</span></a> ";
					echo ($next_block <= $total_block) ? "<a href='$PHP_SELF?page=$next_block_page$QUERY_STR' class='last'><span class='icon'>마지막</span></a>" : "<a class='last'><span class='icon'>마지막</span></a>";
?>

				</div>
        </section>       

        <h5 class="copyright">COPYRIGHT(c) SHINSEUNG COPY RIGHT RESERVED</h5>  
    </div>
<input type="hidden" id="page_flag" value="뉴스톡">
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
	var s_str = req.getParameter("s_str");

	if (s_option != "") {
		switch (s_option )
		{
			case "subject" : 	
				$('#s_option').val('subject').attr('selected','selected');
				break;
			case "contents" : 		
				$('#s_option').val('contents').attr('selected','selected');
				break;
			case "news_reguser" : 						
				$('#s_option').val('news_reguser').attr('selected','selected');
				break;
			case "id" : 						
				$('#s_option').val('id').attr('selected','selected');
				break;			
			default : alert("error");
		}
	}
	
	if(s_str !=""){
		$('#s_str').val(s_str);
	}


	top_menu(page_flag);

	fetchUser();
	function fetchUser()
	{

		var action = "select_new_m";
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_option:s_option,s_str:s_str },
			success:function(data){
				$('#result').html(data);
			}
		})
	}



	$('#btn_search').click(
		function() {
			var s_option = $('#s_option').val();
			var s_str = $('#s_str').val();

			if(s_option !="" ){
				window.location.href="?s_option="+s_option+"&s_str="+escape(s_str);
			}else{
				alert("검색 조건을 설정해주세요");
				if(s_option ==""){
					$('#s_option').focus();
				}else if(s_str ==""){
					$('#s_str').focus();
				}
			}
		}	
	);

});


</script>

</html>