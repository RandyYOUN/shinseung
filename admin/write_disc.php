<?php
include "db_info.php";

#include "top.php";
$TITLE = "신승 DISC체크";
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


isloading = {
  start: function() {
    if (document.getElementById('wfLoading')) {
      return;
    }
    var ele = document.createElement('div');
    ele.setAttribute('id', 'wfLoading');
    ele.classList.add('loading-layer');
    ele.innerHTML = '<span class="loading-wrap"><span class="loading-text"><span>.</span><span>.</span><span>.</span></span></span>';
    document.body.append(ele);

    // Animation
    ele.classList.add('active-loading');
  },
  stop: function() {
    var ele = document.getElementById('wfLoading');
    if (ele) {
      ele.remove();
    }
  }
}


ch_mobile();
function ch_mobile(){
//모바일체크
	var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');

	var request = new Request();
	var id = request.getParameter("id")
	var cate = request.getParameter("cate")
	var url = window.location.href;
	var newurl = "";

	if (request.getParameter("pc") == "y") {
		console.log("pc connect=============");
	} else {
		for (var word in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
				if(url.indexOf("write_disc.php")>0){
					window.location.href = "m/login_disc.php";				
				}
				break;
			}
		}
	}
}

</script>
    
    
<body>
<style>
.disc_text{width:115px;height:50px;font-size:20px;text-align:center;}
</style>
<br><br><br><br>
	<div class="wrap">
		<div class="mainbg">
			<div class="content">
				<div class="conwrap">

					<h1>DISK CHECK</h1>
    				
					<div class="dashwrap" style="width:1390px;">

						<h2></h2>
						<!--div class="btn w100" style="margin:5px 0 15px; text-align:right;">
            					<button name="action1" id="action1" >등록</button>
            					<button name="list1" id="list1">목록</button>
            			</div-->
						<div class="dashcon">
                            <div class="dashboard">
                                <table>
                                    <colgroup>
                                        <col width="250px">
                                        <col width="">
                                        <col width="250px">
                                        <col width="">
                                    </colgroup>
                                    <tbody>
                                        <tr>
                                            <th>성명</th>
                                            <td>
											<input type="box" class="w90" name="username" id="username" onkeypress="javascript:if(event.keycode==13||event.keycode==27||event.keycode==9)submit_basic(this);">
											</input>
											</td>
                                            <th>연락처</th>
                                            <td><input type="box" class="w90" name="mobile" id="mobile" onkeypress="javascript:if(event.keycode==13||event.keycode==27||event.keycode==9)submit_basic(this);" ></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

						<div class="discInfor">
                            <h2 class="y">자신을 잘 묘사한다고 생각하는 단어</h2>
                            <h2 class="n">자신과 가장 관계없다고 생각하는 단어</h2>
                            <h3>각문항마다 4개이 단어 중 자신을 잘 묘사한다고 생각하는 단어 <strong>1개</strong>
                                , 자신과 가장 관계 없다고 생각되는 단어 <strong>1개</strong>를 선택해주세요.</h3>
                        </div>

						<div class="dashcon">
                            <div class="dashboard">
                                <table>
                                    <colgroup>
                                        <col width="100px">
                                        <col width="">
                                        <col width="">
                                        <col width="">
                                        <col width="">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?PHP
	

$QUERY = "SELECT * FROM TB980094 ORDER BY ID";

$result = @mysqli_query($connect,$QUERY) or die("SQL error");
$A = 1;$B = 2;$C = 3;$D = 4;

while ($row = mysqli_fetch_array($result)) {
   //$fx_contents = strip_tags($row["CONTENTS_"]);
   
?>

					<tr>
						<th><?php echo $row["ID"]?></th>
						<td>
							<ul>
								<li><?php echo $row["A"]?></li>
								<li>
									<div class="radio_wrap">
										<div class="radiobox_y">
											<input type="radio" name="q_max_<?php echo $row["ID"]?>" id="progress<?PHP ECHO $A?>_y" value="1" onclick="javascript:submit(this);">
											<label for="progress<?PHP ECHO $A?>_y">Y</label>
										</div>
										<div class="radiobox_n">
											<input type="radio" name="q_min_<?php echo $row["ID"]?>" id="progress<?PHP ECHO $A?>_n" value="1" onclick="javascript:submit(this);">
											<label for="progress<?PHP ECHO $A?>_n">N</label>
										</div>
									</div>
								</li>
							</ul>
						</td>
						<td>
							<ul>
								<li><?php echo $row["B"]?></li>
								<li>
									<div class="radio_wrap">
										<div class="radiobox_y">
											<input type="radio" name="q_max_<?php echo $row["ID"]?>" id="progress<?PHP ECHO $B?>_y" value="2" onclick="javascript:submit(this);">
											<label for="progress<?PHP ECHO $B?>_y">Y</label>
										</div>
										<div class="radiobox_n">
											<input type="radio" name="q_min_<?php echo $row["ID"]?>" id="progress<?PHP ECHO $B?>_n" value="2" onclick="javascript:submit(this);">
											<label for="progress<?PHP ECHO $B?>_n">N</label>
										</div>
									</div>
								</li>
							</ul>
						</td>
						<td>
							<ul>
								<li><?php echo $row["C"]?></li>
								<li>
									<div class="radio_wrap">
										<div class="radiobox_y">
											<input type="radio" name="q_max_<?php echo $row["ID"]?>" id="progress<?PHP ECHO $C?>_y" value="3" onclick="javascript:submit(this);">
											<label for="progress<?PHP ECHO $C?>_y">Y</label>
										</div>
										<div class="radiobox_n">
											<input type="radio" name="q_min_<?php echo $row["ID"]?>" id="progress<?PHP ECHO $C?>_n" value="3" onclick="javascript:submit(this);">
											<label for="progress<?PHP ECHO $C?>_n">N</label>
										</div>
									</div>
								</li>
							</ul>
						</td>
						<td>
							<ul>
								<li><?php echo $row["D"]?></li>
								<li>
									<div class="radio_wrap">
										<div class="radiobox_y">
											<input type="radio" name="q_max_<?php echo $row["ID"]?>" id="progress<?PHP ECHO $D?>_y" value="4" onclick="javascript:submit(this);">
											<label for="progress<?PHP ECHO $D?>_y">Y</label>
										</div>
										<div class="radiobox_n">
											<input type="radio" name="q_min_<?php echo $row["ID"]?>" id="progress<?PHP ECHO $D?>_n" value="4" onclick="javascript:submit(this);">
											<label for="progress<?PHP ECHO $D?>_n">N</label>
										</div>
									</div>
								</li>
							</ul>
						</td>
					</tr>
<?php 
					$A=$A+4;
					$B=$B+4;
					$C=$C+4;
					$D=$D+4;

					} 
?>
                     
										
                                    </tbody>
                                </table>
                            </div>

                            <div class="btn w100">
                                <button class="b_save" id="action1" name="action1"  onclick="javascript:modify_();">저장</button>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
		<br>

		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="tmp_biz_id" name="tmp_biz_id"></input>
</body>

<script>

function submit2(){


 if($("input:radio[id="+select+"]:checked").prop("checked")){
	$("input:radio[id="+select+"]:checked").prop("checked",true);
 }else{
 	$("input:radio[id="+select+"]:checked").prop("checked",false);
 }

}

$(document).ready(function(){


fetchUser();

function fetchUser()
{

	var step;
	var action = "select_view_disc_test";
	var request = new Request();
	var id = request.getParameter("id");
	
	if(id != ""){
		$('#b_save').val("수정");
		$('#b_save').html("수정");
//		$('#action2').val("수정");
//		$('#action2').html("수정");
		$('#REP_FLAG_LABEL').css("display","inline-table");
		$('#REP_FLAG').css("display","inline-table");
	}

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data.length);
			$('#username').val(data[0].USERNAME);
			$('#username').attr("disabled","true");
			$('#mobile').val(data[0].MOBILE);
			$('#mobile').attr("disabled","true");
			$('#b_option').val(data[0].BRANCH);

			
			//alert(data.QUE);
			for(step=0;step<data.length;step++){
				if(data[step].FLAG=="max"){
					$("input[name=q_max_"+data[step].NUM+"]:radio[value='"+data[step].VALUE_+"']").prop("checked", true) ;
//					$('#q_max_'+data[step].NUM).prop("checked");
					//$('#q_max_'+data[step].NUM).val(data[step].VALUE_);
					//$('#d_max_'+data[step].NUM).html(data[step].DISC);
				}else{
					$("input[name=q_min_"+data[step].NUM+"]:radio[value='"+data[step].VALUE_+"']").prop("checked", true) ;
					//$('#q_min_'+data[step].NUM).prop("checked");
					//$('#q_min_'+data[step].NUM).val(data[step].VALUE_);
					//$('#d_min_'+data[step].NUM).html(data[step].DISC);
				}
			}
			$('#d_max_val').html(data.D_MAX_CNT);
			
			
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}




    
    //[2] 추가 버튼 클릭했을 때 작동되는 함수
    $('#action1').click(function(){
    	modify_();
    });
    $('#action2').click(function(){
    	modify_();
    });
   

    	//목록가기
    $('#list1').click(function(){
    	window.location.href="list_disc.php";
    });
    $('#list2').click(function(){
    	window.location.href="list_disc.php";
    });


function modify_(){
	var action = "action_insert_disc_all";
	var username = $('#username').val();
	var mobile = $('#mobile').val();
	var branch = $('#b_option').val();


	var rep_flag = '';

	if($("#REP_FLAG").is(":checked")){
		rep_flag = 'Y';
	}
	
	var request = new Request();
	var id = request.getParameter("id");


	if(username !="" && mobile !="" && branch!=""){
		$.ajax({
			url:"action.php",
			method:"POST",
			dataType:"json",
			data:{action:action,username:username, id:id, mobile:mobile,branch:branch,rep_flag:rep_flag},
			success:function(data){
				//alert(data.TMP_ID);
				//fetchUser();
				window.location.href="view_disc.php?id="+data.TMP_ID;
				
			}
		})
	}
}

    


    $('#username').focusout(function() {
    	submit_basic();
	});

    $('#mobile').focusout(function() {
    	submit_basic();
	});

    $('#b_option').on('change',function(){
    	submit_basic();
	});

	
});



function submit(obj){ // 메모저장
	var request = new Request();
	var userid = request.getParameter("id");
	var username = $('#username').val();
	var mobile = $('#mobile').val();
	var branch = $('#b_option').val();

	
	var num_tmp = $(obj).attr("name");
	var num = num_tmp.replace("q_max_","");
	var num = num.replace("q_min_","");
	var flag = "";
	var value = "";
	var action = "action_insert_disc"
		
	if(num_tmp.indexOf("max")>=0){
		flag = "max";
	}else{
		flag = "min";
	}
	value = $('input[name="'+num_tmp+'"]:checked').val();

var q_max = $('input[name="'+"q_max_"+num+'"]:checked').val();
var q_min = $('input[name="'+"q_min_"+num+'"]:checked').val();

	if(username !="" && mobile !=""){
		if(q_max===q_min){
			alert("같은값을 선택할 수 없습니다.");
			$("input:radio[name="+num_tmp+"]").prop("checked",false);
			return false;
		}else{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{action:action,userid:userid,num:num,flag:flag,value:value,username:username,mobile:mobile},
				success:function(data){
					//alert(data);
					//fetchUser();
				}
			})
		}
	}else{
		alert("기존정보를 입력하여 주세요");
		$("input:radio[name="+num_tmp+"]").prop("checked",false);
		$('#username').focus();
	}


}


function submit_basic(){ // 기본정보저장

	var action = "action_insert_disc_basic";
	var username = $('#username').val();
	var mobile = $('#mobile').val();
	var request = new Request();
	var id = request.getParameter("id");


	if(username !="" && mobile !=""){
		$.ajax({
			url:"action.php",
			method:"POST",
			dataType:"json",
			data:{action:action,username:username, id:id, mobile:mobile},
			success:function(data){
				//alert(data.TMP_ID);
				//fetchUser();
				
			}
		})
	}
	

}

function keyevent(obj){
	var replaceNotInt = /[^1-4]/gi;

	var x = $(obj).val();
    if (x.length > 0) {
        if (x.match(replaceNotInt)) {
           x = x.replace(replaceNotInt, "");
        }
        $(obj).val(x);
    }
}



</script>
</html>