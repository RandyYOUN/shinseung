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
                <h1><a href="write_money.php">입력화면</a></h1>
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
					<option value="cstname">사용자</option>
					<option value="value">사용처</option>
                </select>
                <input type="box" placeholder="검색어를 입력해주세요" id="s_str" name="s_str">
                <input type="button" id="btn_search" name="btn_search">                        
            </div>  

			<div class="mainBoard">
                <table>
                    <colgroup>
						<col width="100px">
						<col width="100px">
					</colgroup>
					<thead>
					<tr>
						<th>월간통계</th>
						<th>주간통계</th>
					</tr>
					</thead>
                    <tbody ID="result2">
                        
                    </tbody>
                </table>
            </div>

            <div class="mainBoard">
                <table>
                    <colgroup>
						<col width="40px">
						<col width="40px">
						<col width="60px">
						<col width="50px">
						<col width="40px">
						<col width="60px">
						<col width="70px">
						<col width="45px">
						
					</colgroup>
					<thead>
					<tr>
						<th>번호<BR>(삭제)</th>
						<th>지출<BR>구분</th>
						<th>변동<br>구분</th>
						<th>사용인</th>
						<th>카드/<BR>현금</th>
						<th>날짜</th>
						<th>사용처</th>
						<th>금액</th>
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
$s_str = unescape($_GET["s_str"]);
$page = $_GET["page"];
$QUERY_STR = "&s_option=".$s_option."&s_str=".$_GET["s_str"];

$page_set = 100; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수


if($s_option != ""){
    switch($s_option){
        case "cstname" :
            $WHERE_STR .= " AND CODE_TO_USERNAME(INSERT_USER) like '%".$s_str."%' ";
            break;
        case "value_" :
            $WHERE_STR .= " AND VALUE_ like '%".$s_str."%' ";
            break;
        case "num" :
            $WHERE_STR .= " AND ID = '".$s_str."' ";
            break;
        default:
            $WHERE_STR ="";
    }
}


$query = "SELECT count(ID) as total
			FROM dbsschina.TB750020_Y 
			WHERE 1=1 ".$WHERE_STR." ORDER BY ID DESC ";

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
<input type="hidden" id="page_flag" value="">
</body>

<script>

function switch_comp(obj){ // 금액란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	
	$("#"+id_tmp).css("display","none");
	$("#"+id_tmp+"_ip").css("display","");

	$("#"+id_tmp+"_ip").focus();
}


function switch_comp_rev(obj){ // 금액란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	var id_tmp2 = id_tmp.replace("_ip","");
	
	$("#"+id_tmp).css("display","none");
	$("#"+id_tmp2).css("display","");
	

}





function money_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("value_lbl_","");
	id = id.replace("money_lbl_","");
	id = id.replace("dept_lbl_","");
	id = id.replace("date_lbl_","");
	id = id.replace("_ip","");

	
	var value = $("#"+id_tmp).val();
	var flag = "";

	if(id_tmp.indexOf("money") > -1){
		flag = "MONEY";
	}else if(id_tmp.indexOf("value") > -1){
		flag = "VALUE";
	}else if(id_tmp.indexOf("insert_user") > -1){
		flag = "USER";
	}else if(id_tmp.indexOf("date") > -1){
		flag = "DATE";
	}
	
	
	var action = "upt_money_opt";



	$.ajax({
		url:"../action.php",
		method:"POST",
		data:{action:action,id:id,value:value, flag:flag},
		success:function(data){
			//alert(data);
			console.log(data);
			if(data=="ok"){
				fetchUser();
				fetchUser2();
			}
			
		}
	})
	

}




function modify_option(obj){ //현황 저장
 	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("value_lbl_","");
	id = id.replace("money_lbl_","");
	id = id.replace("dept_lbl_","");
	id = id.replace("code_lbl_","");
	id = id.replace("pay_lbl_","");
	id = id.replace("user_lbl_","");
	id = id.replace("_ip","");

	var value_id = "#value_lbl_"+id + "_ip";
	var value = $(value_id).val();

	var dept_id = "#dept_lbl_"+id + "_ip";
	var dept = $(dept_id).val();

	var code_id = "#code_lbl_"+id + "_ip";
	var code = $(code_id).val();

	var money_id = "#money_lbl_"+id + "_ip";
	var money = $(money_id).val();

	var pay_id = "#pay_lbl_"+id + "_ip";
	var pay = $(pay_id).val();

	var user_id = "#user_lbl_"+id + "_ip";
	var user = $(user_id).val();
	
	
	
	var action = "upt_money_select";
//	alert("id : "+ id + " = "+obj.value);

	//users 리스트를 select.php 에서 받아온다.
	
	$.ajax({
		url:"../action.php",
		method:"POST",
		data:{action:action,id:id, dept:dept, value:value,code:code,money:money, pay:pay, user:user},
		success:function(data){
			console.log(data);
			if(data=="ok"){
				//window.location.reload();

				fetchUser();
				fetchUser2();
			}
		}
	})

}




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
			case "value" : 	
				$('#s_option').val('value').attr('selected','selected');
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


	

	fetchUser();
	fetchUser2();
	
	
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


function del(str){
	var id = str;
	var action = "del_money";
	var conf = confirm(str+"번을 삭제하시겠습니까?");

	if(conf){
		$.ajax({
			url:"../action.php",
			method:"POST",
			data:{action:action,id:id},
			success:function(data){

				fetchUser();
				fetchUser2();
			}
		})
	}
		
}


function fetchUser()
{
	var req = new Request();
	var page = req.getParameter("page");
		
	var action = "select_money_list";
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


function fetchUser2()
{
	var req = new Request();
	var page = req.getParameter("page");
		
	var action = "select_week_total";
	
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action},
		success:function(data){
			
			$('#result2').html(data);
		}
	})

}



</script>

</html>