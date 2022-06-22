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
		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
			<div class="conwrap">
				<div class="board" style="width:500px;">
					<table style="width:100%;height:100px;">
					<colgroup>
        				<col width="300px">
        			</colgroup>
        			<thead>
        			<tr>
    					<th>멤버목록</th>
    				</tr>
        			</thead>
					<tbody id="result2">
					</tbody>
				</table>
				</div>
			</div>
				<br><br><br><br>
				<div class="board" style="width:500px;">
					<table style="width:100%;">
					<colgroup>
        				<col width="300px">
        			</colgroup>
        			<thead>
        			<tr>
    					<th>검색 및 추가</th>
    				</tr>
        			</thead>
					<tbody id="result2">
					</tbody>
				</table>
				</div>
				<h2 class="w50"></h2>
				<div class="search">
					<input type="box" class="w100p" id="s_str" name="s_str">
					<button class="b_search" id="btn_search" name="btn_search" >조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel">초기화</button>
					<button class="b_newadd"  name="add_member" id="add_member" style="background-color:#4e46467d;color:white;">선택추가</button>
					<div class="selectbox w100p">
						<label for="">검색조건</label>
						<select name="s_option" id ="s_option">
							<option value="" selected>검색조건</option>
							<option value="DEPNAME">소속</option>
							<option value="USERNAME">유저명</option>
							<option value="POSITION">직급</option>
						</select>
					</div>
				</div>
				
				<div class="conwrap">
					<div class="board" style="width:500px;">
						<table style="width:100%;">
    						<colgroup>
                				<col width="50px">
                				<col width="150px">
                				<col width="150px">
                				<col width="150px">
                				
                			</colgroup>
                			<thead>
                			<tr>
                				<th><input type="checkbox" id="checkAll" class="chk"/></th>
                				<th>사용자이름</th>
                				<th>소속</th>
                				<th>직급</th>
                				</tr>
                			</thead>
							<tbody id="result">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
<br>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="page_flag" value="신승ADMIN 사용자리스트">

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

function selectAll(selectAll)  {
  const checkboxes 
       = document.getElementsByName('ck_group');
  
  checkboxes.forEach((checkbox) => {
    checkbox.checked = selectAll.checked;
  })
}


window.onload = function(){
	// 전체 선택 중 한개의 체크박스 선택 해제 시 전체선택 체크박스 해제
    $(".chk").click(function(){
        var total = $("input[name='check[]']").length;
        if($("input[name='check[]']:checked").length == total){
            $("#checkAll").prop("checked", true);
        }else{
            $("#checkAll").prop("checked", false);
        }
    });

};

$(document).ready(function(){

	var request = new Request();
	

	if(document.getElementById("page_flag").value)
		var page_flag = document.getElementById("page_flag").value;

	if(request.getParameter("s_option"))
		var s_option = request.getParameter("s_option");

	if(request.getParameter("s_str"))
		var s_str = unescape(request.getParameter("s_str"));
	
	var id = request.getParameter("id");
	if (s_option != "") {
		switch (s_option)
		{
			case "DEPNAME" : 	
				$('#s_option').val('DEPNAME').attr('selected','selected');
				break;
			case "USERNAME" : 		
				$('#s_option').val('USERNAME').attr('selected','selected');
				break;
			case "POSITION" : 						
				$('#s_option').val('POSITION').attr('selected','selected');
				break;
		}
	}

	if (s_str != "") {
		$('#s_str').val(s_str);
	}

	$('#btn_cancel').click(
		function(){
			window.location.href="?id=&s_option=&s_str=";
		}	
	);

	function checkit(){
		
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();

		if(s_option !="" ){
			window.location.href="?id="+id+"&s_option="+s_option+"&s_str="+escape(s_str);
		}else{
			alert("검색 조건을 설정해주세요");
			if(s_option ==""){
				$('#s_option').focus();
			}else if(s_str ==""){
				$('#s_str').focus();
			}
		}
	}

	$("#s_str").keydown(
		function(key) {
			if (key.keyCode == 13) {
				checkit();
			}
		}
	);


	$('#btn_search').click(
		function() {
			checkit();
		}	
	);  
	
	fetchUser();
	function fetchUser()
	{
		var request = new Request();
		var id = request.getParameter("id");
		var action = "select_memberlist_group";
		var s_option = $('#s_option').val();
		var s_str = $('#s_str').val();
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,id:id,s_option:s_option,s_str:s_str},
			success:function(data){
				$('#result').html(data);
			}
		})


	}

	fetchUser2();
	function fetchUser2()
	{
		var request = new Request();
		var id = request.getParameter("id");
		var action = "select_group_member_list";
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,id:id},
			success:function(data){
				$('#result2').html(data);
			}
		})


	}

	

	$("#checkAll").click(function(){
        if($("#checkAll").is(":checked")){
            $(".chk").prop("checked", true);
        } else {
            $(".chk").prop("checked", false);
        }
    });
 
	$(".chk").click(function(){
        var total = $("input[name='check[]']").length;
        if($("input[name='check[]']:checked").length == total){
            $("#checkAll").prop("checked", true);
        }else{
            $("#checkAll").prop("checked", false);
        }
    });
	
// 	$(document).on('click','.b_newadd',function(){
// 		$("input[name=ck_group]:checked").each(function() {
// 		  console.log($(this).val());
// 		  //alert();
// 		 });
// 	});


	$('#add_member').click(function(){
		var request = new Request();
		var id = request.getParameter("id");
		var userid = "<?=$userid?>";
		var check = new Array();
		
		$("input[name='check[]']:checked").each(function() {
			check.push( $(this).val() );
	   });

	


		var action = "insert_group_member";
		
		if(check !="" && userid != ""){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{id:id,action:action,check:check,userid:userid},
				success:function(data){
					alert(data);
					window.location.href="list_member_group.php?id="+id;			
				}
			});

		}else{
			alert('필수값을 입력해주세요');
		
		}

		
	});



});


var select = $('select');
for (var i = 0; i < select.length; i++) {
    var idxData = select.eq(i).children('option:selected').text();
    select.eq(i).siblings('label').text(idxData);
}
select.change(function () {
    var select_name = $(this).children("option:selected").text();
    $(this).siblings("label").text(select_name);
});


function mem_del(userid){
	var request = new Request();
	var id = request.getParameter("id");
	var action = "delete_group_member";
	
	if(id != "" && userid !=""){

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
			method:"POST",
			data:{id:id,action:action,userid:userid},
			success:function(data){
				alert(data);
				window.location.href="list_member_group.php?id="+id;			
			}
		});

	}else{
		alert('필수값을 입력해주세요');
	
	}
}

</script>

</html>