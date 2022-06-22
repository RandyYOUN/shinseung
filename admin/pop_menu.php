<?php
include "db_info.php";

   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 ADMIN</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="신승세무법인 ADMIN">
	<meta property="og:url" content="https://taxtok.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="resources/images/sum2.png">
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
<script type="text/javascript" src="../news/se2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
-->
<!-- Bootstrap -->



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border-radius:5px;
margin-top:100px;


}

.paging { width: 1400px; margin: 0 auto 100px; }
.paging div { font-size: 0; text-align: center; margin: 30px 0 0 0; }
.paging div a.prev { display: inline-block; width: 52px; font-size: 15px; line-height: 15px; color: #777; font-weight: bold; text-align: right; margin: 0 20px 0 0; padding: 10px 0px 10px 0px; background: url("../images/pagingleft.png") 0px 50% no-repeat; }
.paging div a.prev:hover { color: #444; background: url("../images/pagingleftOn.png") 0px 50% no-repeat; }
.paging div span { display: inline-block; }
.paging div span a { width: 32px; display: inline-block; font-size: 15px; line-height: 15px; color: #999; font-weight: bold; text-align: center; padding: 10px 0px 10px 0px; }
.paging div span a.active { position: relative; width: 32px; display: inline-block; color: #444; }
.paging div span a.active:after { content: ''; position: absolute; left: 0px; bottom: 6px; width: 80%; height: 1px; background: #444; }
.paging div a.next { display: inline-block; width: 52px; font-size: 15px; line-height: 15px; color: #777; font-weight: bold; text-align: left; margin: 0 0 0 20px; padding: 10px 0px 10px 0px; background: url("../images/pagingright.png") 100% 50% no-repeat; }
.paging div a.next:hover { color: #444; background: url("../images/pagingrightOn.png") 100% 50% no-repeat; }


</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 
<!-- add summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/lang/summernote-ko-KR.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


</head>
<body style="font-size:14px;">
<form method="post">
<div class="container box" style="margin:0 0 0 50px;">
<span>
<img src="resources/images/new_logo.png">
</span>
<br><br>

<div class="table-responsive"  style="width:640px;" >

<TABLE class="table table-bordered" style="width:640px;">
	<TR>
		<TD style="width: 100px;"></TD>
		<TD>
			<span id="TAB1" style="cursor: pointer;"> TAB1 </span>
			<span id="TAB2" style="cursor: pointer;"> TAB2 </span>
			<span id="TAB3" style="cursor: pointer;"> TAB3 </span>
			<span id="TAB4" style="cursor: pointer;"> TAB4 </span>
			<span id="TAB5" style="cursor: pointer;"> TAB5 </span>
<?php 
    $id=mysqli_real_escape_string($connect,$_GET["id"]);
    if($id != ""){
?>
			<span id="TAB_MY" style="cursor: pointer;"> My </span>
<?php        
    }
?>			
		</TD>
	</TR>
	<TR>
		<TD style="height: 300px;">
			<div id="result"></div>
			<div id="result_my"></div>
		</TD>
		<TD >
			<b>
				<button type="button" name="action" id="action" class="btn btn-warning">붙복</button>
				<button type="button" name="action_save" id="action_save" class="btn btn-warning" style="display: none;">저장</button>
				<br><br>
				<div id="content"></div>
				
				<input type="box" class="w50" name="menu_subject" id="menu_subject" style="display: none;" placeholder="제목을 입력해주세요.">
				<br><br>
				<div id="summernote" ><p><br></p></div>
    			  <div class="placeholder" style="display: none;" id="placeholder">
    
    			  </div>
    			  
				
			</b>
		</TD>
		
	</TR>
	
</TABLE>




<BR><BR>

</div>
</form>
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


	$('#action').click(function () {
		//alert($('#content').html());
		copyToClipboard($('#content').html());
		alert('복사완료');
	});
	

	$('#TAB1').click(function () {
		$("#BTN_TAB1").css("display","block");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_MY").css("display","none");
	});


	$('#TAB2').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","block");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_MY").css("display","none");
	});

	$('#TAB3').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","block");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_MY").css("display","none");
	});

	$('#TAB4').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","block");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_MY").css("display","none");
	});

	$('#TAB5').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","block");
		$("#BTN_MY").css("display","none");
	});

	$('#TAB_MY').click(function () {
		
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_MY").css("display","block");
		
	});



	$('#action_save').click(function () {
		var request = new Request();
		var id = request.getParameter("id");
		var action = "action_add_memu";
		var contents =  $('#summernote').summernote('code');
		var subject = $("#menu_subject").val();

		//alert(contents + subject);


		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
			method:"POST",
			data:{id:id,action:action,contents:contents, subject:subject},
			success:function(data){
				alert(data);
				window.location.reload();		
				//fetchUser();
				//fetchUser_my();	
			}
		});	
	});

	
	
});



function copyToClipboard(val) {
	  const t = document.createElement("textarea");
	  document.body.appendChild(t);
	  t.value = val;
	  t.select();
	  document.execCommand('copy');
	  document.body.removeChild(t);
}


function copy() {
  copyToClipboard('Hello World');
  console.log('Copied!');
}



function fetchUser_my(){
	var request = new Request();
	var userid = request.getParameter("id");
	var action = "select_menu_pop_my";
	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action, userid:userid},
		success:function(data)
		{
			console.log(data);
			$('#result').append(data);
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


function add_menu(){

	$("#action_save").css("display","block");
	$("#menu_subject").css("display","block");
	$("#action").css("display","none");
	$("#content").css("display","none");

	
	 // index page card list
	  if ($('.card-list').length) {
		var $cardArrow = $('.card-arrow');
		var $cardListInner = $('.card-list-inner');

		$cardListInner.scroll(function () {
		  $cardArrow.addClass('disappear');
		  if ($cardListInner.scrollLeft() < 20) {
			$cardArrow.removeClass('disappear');
		  }
		});
	  }

	  // main summernote with custom placeholder
	  var $placeholder = $('.placeholder');
	  $('#summernote').summernote({
			width:300,
			height: 400,
		codemirror: {
		  mode: 'text/html',
		  htmlMode: true,
		  lineNumbers: true,
		  theme: 'monokai'
		},
		callbacks: {
		  onInit: function() {
			$placeholder.show();
		  },
		  onFocus: function() {
			$placeholder.hide();
		  },
		  onBlur: function() {
			var $self = $(this);
			setTimeout(function() {
			  if ($self.summernote('isEmpty') && !$self.summernote('codeview.isActivated')) {
				//$placeholder.show();
			  }
			}, 300);
		  }
		}
	  });
}

function fetchUser(){
	var action = "select_menu_pop";
	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action},
		success:function(data)
		{
			console.log(data);
			$('#result').html(data);
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


function load_content(obj){
	//alert($(obj).attr("value"));
	var action = "select_content";
	var id = $(obj).attr("value");
	$('#content').html("");
	
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action, id:id},
		success:function(data)
		{
			console.log(data);
			$('#content').html(data);
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}

fetchUser();
fetchUser_my();
</script>


</body>
</html>