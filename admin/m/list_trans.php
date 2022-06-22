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
                    <option value="" selected>전체</option>
					<option value="num">번호</option>
					<option value="cstname">납세자명</option>
					<option value="mobile">연락처</option>
                </select>
                <input type="box" placeholder="검색어를 입력해주세요" id="s_str" name="s_str">
                <input type="button" id="btn_search" name="btn_search">                        
            </div>  



            <div class="mainBoard">
                <table>
                    <colgroup>
						<col width="40px">
						<col width="50px">
						<col width="50px">
						<col width="80px">
						<col width="100px">
						<col width="60px">
						<col width="70px">
						<col width="100px">
						<col width="80px">
						<col width="100px">
						<col width="100px">
						<col width="60px">
						<col width="310px">

					</colgroup>
					<thead>
					<tr>
						<th>번호</th>
						<th>우선순위</th>
						<th>진행상태</th>
						<th>납세자명</th>
						<th>납세자연락처</th>
						<th>세목</th>
						<th>접수지점</th>
						<th>접수일</th>
						<th>담당세무사</th>
						<th>신고기한</th>
						<th>수수료(원)</th>
						<th>납부</th>
						<th>비고</th>

					</tr>
					</thead>
                    <tbody ID="result">
                        
                    </tbody>
                </table>
            </div>
			
		
<?php
include "../db_info.php";
 function toString($text){
   return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
}

function unescape($text){
   return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'toString', $text));
}



$s_option = $_GET["s_option"];
$g_option = $_GET["g_option"];
$s_date1 = $_GET["s_date1"];
$s_date2 = $_GET["s_date2"];
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";
$page = $_GET["page"];

if($depth == "D2005" && $userid !=""){
    $WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
}

$QUERY_STR = "&g_option=".$g_option."&b_option=".$_GET["b_option"]."&s_str=".$_GET["s_str"]."&s_date1=".$s_date1."&s_date2=".$s_date2;


$page_set = 100; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


if($s_option != ""){
    switch($s_option){
        case "cstname" :
            $WHERE_STR .= " AND A.CSTNAME like '%".$s_str."%' ";
            break;
        case "owner" :
            $WHERE_STR .= " AND I.USERNAME like '%".$s_str."%' ";
            break;
        case "progress" :
            $WHERE_STR .= " AND PROGRESS like '%".$s_str."%' ";
            break;
        case "reguser" :
            $WHERE_STR .= " AND B.USERNAME like '%".$s_str."%' ";
            break;
        case "mobile" :
            $WHERE_STR .= " AND A.MOBILE like '%".$s_str."%' ";
            break;
        case "num" :
            $WHERE_STR .= " AND A.ID = '".$s_str."' ";
            break;
        case "etc" :
            $WHERE_STR .= " AND A.ETC LIKE '%".$s_str."%' ";
            break;
        case "deadline" :
            $WHERE_STR .= " AND DATE_FORMAT(A.DEADLINE, '%Y-%m-%d') BETWEEN '".$s_date1."' AND '".$s_date2."' AND DATE_FORMAT(A.REGDATE, '%Y-%m-%d') <> '0000-00-00' ";
            break;
        case "rep_date" :
            $WHERE_STR .= " AND DATE_FORMAT(A.REP_DATE, '%Y-%m-%d') BETWEEN '".$s_date1."' AND '".$s_date2."' AND DATE_FORMAT(A.REGDATE, '%Y-%m-%d') <> '0000-00-00'";
            break;
        case "regdate" :
            $WHERE_STR .= " AND DATE_FORMAT(A.REGDATE, '%Y-%m-%d') BETWEEN '".$s_date1."' AND '".$s_date2."'  AND DATE_FORMAT(A.REGDATE, '%Y-%m-%d') <> '0000-00-00' ";
            break;
        default:
            $WHERE_STR ="";
    }
}

if($g_option != "" && $g_option != "ALL"){
    $WHERE_STR .= " AND A.REG_BRANCH = '".$g_option."'";
}

if($depth == "D2005" && $userid !=""){
    $WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
}

$query = "SELECT count(A.ID) as total
			FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON A.REGUSER = B.USERID
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
			WHERE 1=1 ".$WHERE_STR." ORDER BY A.ID DESC ".$STR;


//$QUERY_STR = $query_str1.$query_str2;
//$connect = @mysqli_connect("localhost", "sschina", "Andy4240!@", "dbsschina");
$result = mysqli_query($connect,$query);

$row = mysqli_fetch_array($result);
 
$total = $row["total"]; // 전체글수
  //echo 'total ='.$total ;

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
<input type="hidden" id="page_flag" value="재산제세 상담보고">
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
	var s_option = req.getParameter("s_option");
	//var g_option = req.getParameter("g_option");
	var s_str = req.getParameter("s_str");
	var page = req.getParameter("page");
	var page_flag = document.getElementById("page_flag").value;
	top_menu(page_flag);
	var depid="<?= $depid ?>";


	if (s_option != "") {
		switch (s_option)
		{
			case "cstname" : 	
				$('#s_option').val('cstname').attr('selected','selected');
				break;
			case "mobile" : 	
				$('#s_option').val('mobile').attr('selected','selected');
				break;
			case "num" : 	
				$('#s_option').val('num').attr('selected','selected');
				break;
			default : alert("error");
		}
	} 

	if (s_str != "") {
		$('#s_str').val(req.getParameter("s_str"));;
	} 

	function checkit(){
		var s_option = $('#s_option').val();
		//var g_option = $('#g_option').val();
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
	
	
	$('#ele').focusout(function() {
	  $(this).addClass('hidden');
	});


	$("#s_str").keydown(
		function(key) {
			if (key.keyCode == 13) {
				checkit();
			}
		}
	);


	$('#btn_search').click(
		function() {
			var s_option = $('#s_option').val();
			//var g_option = $('#g_option').val();
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


	$('#new').click(
		function() {
			window.location.href="write_trans.php";
		});



	fetchUser();
	function fetchUser()
	{
		var req = new Request();
		var page = req.getParameter("page");
			
		var action = "select_trans_list";
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();
		var first = "Y";
		var depth="<?= $depthid ?>";
		var userid="<?= $userid ?>";
		var depid="<?= $depid ?>";


		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,s_option:s_option,first:first, page:page,depth:depth,userid:userid,depid:depid},
			success:function(data){
				
				$('#result').html(data);
			}
		})

	}

	
	var select = $('select');
    for (var i = 0; i < select.length; i++) {
        var idxData = select.eq(i).children('option:selected').text();
        select.eq(i).siblings('label').text(idxData);
    }
    select.change(function () {
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });

});





</script>

</html>