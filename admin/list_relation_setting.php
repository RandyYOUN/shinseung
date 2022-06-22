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

<div class="wrap">
		<div class="content" style="width:1000px;height:300px;">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				
				<div class="search">
					
					<span id="s_date" name="s_date" style="display:none;width:27%;margin:0px 10px 0px 10px;" >
						<input type="date" class="w200p" id="s_date1" name="s_date1" style="font-size:13px;width:135px;height:36px;">&nbsp;
						<font style="margin:0px 10px 0px 10px;">~</font>&nbsp;
						<input type="date" class="w200p" id="s_date2" name="s_date2" style="font-size:13px;width:135px;height:36px;">
					</span>
					<input type="box" class="w200p" id="s_str" name="s_str">
					<button class="b_search" id="btn_search" name="btn_search" >조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel">초기화</button>
					<button class="b_newadd" id="btn_new" name="btn_new">추가</button>
					
					<div class="selectbox w150p">
						<label for="">검색조건</label>
						<select name="s_option" id ="s_option">
							<option value="" selected>검색조건</option>
							<option value="USERNAME">유저명</option>
						</select>
					</div>
				</div>

				
				<div class="board" style="width:100%;">
					
					<table style="width:100%;">
						<tbody id="result"  >
						</tbody>
					</table>
				</div>

	
				<div class="page">
					
<?php 
//echo $query;

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
			</div>
		</div>
		<!-- div class="subcopyright" style="width: 1000px;">Copyright(c) SHINSEUNG copy rights reserved.</div-->
	</div>
	
    <div style="height:1000px;"> </div>

    <!-- 팝업뜰때 배경 -->
    <div id="mask"></div>

    <!--Popup Start -->
    <div id="layerbox" class="layerpop"
        style="width: 700px; height: 350px;">
        <article class="layerpop_area">
        <div class="title">신규 멘토-멘티관계 등록</div>
        <a href="javascript:popupClose();" class="layerpop_close"
            id="layerbox_close"></a> <br>
        <div class="content">
        <table style="width:100%;">
			<tbody id="result"  >  
				<colgroup>
				
				<col width="200px">
				<col width="200px">
				<col width="200px">
				
        	</colgroup>
			<thead>
			<tr>
				<th>멘티</th>
				<th>멘토</th>
                <th></th>
			</tr>
			</thead>
			<tr style="text-align:center; padding:20px 20px 10px 20px;">
                <td >
                	<select style="height:35px;text-align-last:right; " id="list_slave" name="list_slave">
                		<option value=''>선택</option>
                    <?php 
                    $procedure2 = "
                    	CREATE PROCEDURE SELECT_D1013()
                    	BEGIN
                    		SELECT USERNAME,USERID
                            FROM TB980010
                            WHERE DEPID = 'D1013';
                    	END;
                    	";
                    
                    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_D1013"))
                    {
                        if(mysqli_query($connect,$procedure2))
                        {
                            $query_D1013 = "CALL SELECT_D1013()";
                            $result_D1013 = mysqli_query($connect,$query_D1013) or die(mysqli_error($connect));
                            if(mysqli_num_rows($result_D1013) >0)
                            {
                                
                                while($row2 = mysqli_fetch_array($result_D1013)){
                                    $output2 .= '<option value="'.$row2["USERID"].'">'.$row2["USERNAME"].'</option>';
                                }
                                
                                //mysqli_stmt_init( $connect ) ;
                                
                                mysqli_next_result($connect);
                            }
                        }
                    }
                    
                    echo $output2;
                    ?>
					</select>                
                </td>
                <td >
                	<select style="height:35px;text-align-last:right; " id="list_master" name="list_master">
                	<option value=''>선택</option>
                    <?php 
                    echo $output2;
                    ?>
					</select>
                </td>
                <td ><button class="b_newadd" id="btn_new_reg" name="btn_new_reg">등록</button></td>
			</tr>
			</tbody>
		</table>
        
    
        </div>
        </article>
    </div>

	
	
	
	<input type="hidden" id="page_flag" value="재산제세 상담보고">
	<input type="hidden" id="s_sort">
	<input type="hidden" id="s_flag">

</body>

<style>
/*-- POPUP common style S ======================================================================================================================== --*/
#mask {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 999;
    background-color: #000000;
    display: none; }

.layerpop {
    display: none;
    z-index: 1000;
    border: 2px solid #ccc;
    background: #fff;
    cursor: move; }

.layerpop_area .title {
    padding: 10px 10px 10px 10px;
    border: 0px solid #aaaaaa;
    background: #f1f1f1;
    color: #3eb0ce;
    font-size: 1.3em;
    font-weight: bold;
    line-height: 24px; }

.layerpop_area .layerpop_close {
    width: 25px;
    height: 25px;
    display: block;
    position: absolute;
    top: 10px;
    right: 10px;
    background: transparent url('images/btn_exit_off.png') no-repeat; }

.layerpop_area .layerpop_close:hover {
    background: transparent url('images/btn_exit_on.png') no-repeat;
    cursor: pointer; }

.layerpop_area .content {
    width: 96%;    
    margin: 2%;
    color: #828282; }
/*-- POPUP common style E --*/



[data-tooltip-text]:hover {
	position: relative;
}

[data-tooltip-text]:hover:after {
	background-color: #000000;
	background-color: rgba(0, 0, 0, 0.8);

	-webkit-box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);
	-moz-box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);
	box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);

	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;

	color: #FFFFFF;
	font-size: 12px;
	content: attr(data-tooltip-text);

  margin-bottom: 10px;
	top: -230%;
	left: 100;    
	padding: 10px 12px;
	position: absolute;
	width: auto;
	min-width: 100px;
	max-width: 400px;
	word-wrap: break-word;

	z-index: 9999;
}

</style>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script> 

<script language=JavaScript charset='utf-8'>

function wrapWindowByMask() {
    //화면의 높이와 너비를 구한다.
    var maskHeight = $(document).height(); 
    var maskWidth = $(window).width();

    //문서영역의 크기 
    console.log( "document 사이즈:"+ $(document).width() + "*" + $(document).height()); 
    //브라우저에서 문서가 보여지는 영역의 크기
    console.log( "window 사이즈:"+ $(window).width() + "*" + $(window).height());        

    //마스크의 높이와 너비를 화면 것으로 만들어 전체 화면을 채운다.
    $('#mask').css({
        'width' : maskWidth,
        'height' : maskHeight
    });

    //애니메이션 효과
    //$('#mask').fadeIn(1000);      
    $('#mask').fadeTo("slow", 0.5);
}

function popupOpen() {
    $('.layerpop').css("position", "absolute");
    //영역 가운에데 레이어를 뛰우기 위해 위치 계산 
    $('.layerpop').css("top",(($(window).height() - $('.layerpop').outerHeight()) / 2) + $(window).scrollTop());
    $('.layerpop').css("left",(($(window).width() - $('.layerpop').outerWidth()) / 2) + $(window).scrollLeft());
    $('.layerpop').draggable();
    $('#layerbox').show();
}

function popupClose() {
    $('#layerbox').hide();
    $('#mask').hide();
}

function goDetail() {

    /*팝업 오픈전 별도의 작업이 있을경우 구현*/ 

    popupOpen(); //레이어 팝업창 오픈 
    wrapWindowByMask(); //화면 마스크 효과 
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
	var s_str = unescape(req.getParameter("s_str"));
	var page = req.getParameter("page");
	var page_flag = document.getElementById("page_flag").value;
	//top_menu(page_flag);
	var depid="<?= $depid ?>";
	var t_option = req.getParameter("t_option");

	if(depid != "" ){
		if(depid == "D1003" || depid == "D1004" || depid == "D1006" || depid == "D1007" || depid == "D1008" || depid == "D1009" || depid == "D1010" || depid == "D1011" || depid == "D1012" ){
			g_option = depid;
		}
	}


	if (s_option != "") {
		switch (s_option)
		{
			case "GROUP_NAME" : 	
				$('#s_option').val('GROUP_NAME').attr('selected','selected');
				break;
			case "USERNAME" : 		
				$('#s_option').val('USERNAME').attr('selected','selected');
				break;
			//default : alert("error");
		}
	} 

	
	if (s_str != "") {
		$('#s_str').val(s_str);
	} 

		
	$('#btn_cancel').click(
		function(){
			window.location.href="?s_option=&s_str=";
		}	
	);


	$('#btn_new').click(
		function(){
			//window.location.href="?s_option=&s_str=";
			goDetail('테스트');
		}	
	);


	$('#btn_new_reg').click(
		function(){
			var list_master = $('#list_master').val();
			var list_slave = $('#list_slave').val();
			var userid = '<?php echo $userid?>';
			
			var action = "action_insert_relation";
			
			if(list_master !="" && list_slave != ""){

				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"action.php", 
					method:"POST",
					data:{action:action,list_master:list_master,list_slave:list_slave,userid:userid},
					success:function(data){
						alert(data);
						window.location.href="list_relation_setting.php";			
					}
				});

			}else{
				alert('필수값을 입력해주세요');
			
			}
		}	
	);


	function checkit(){
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
	function fetchUser()
	{
		var req = new Request();
		var page = req.getParameter("page");
			
		var action = "select_list_relation_setting";
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();
		var depth="<?= $depthid ?>";
		var userid="<?= $userid ?>";
		var depid="<?= $depid ?>";


		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_str:s_str,s_option:s_option, page:page,depth:depth,userid:userid,depid:depid},
			success:function(data){
				console.log(data);
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



function del_relation(id){
	var action = "action_delete_relation";
	
		$.ajax({
	//insert page로 위에서 받은 데이터를 넣어준다.
		url:"action.php", 
		method:"POST",
		data:{action:action,id:id},
		success:function(data){
			alert(data);
			window.location.href="list_relation_setting.php";			
		}
	});

	
}

</script>

</html>  