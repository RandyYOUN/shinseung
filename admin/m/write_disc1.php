<?php
include "../db_info.php";

#include "top.php";
$TITLE = "신승 DISC체크";
?>
<!doctype html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimal-ui, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Sinsheung</title>
    <link href="css/reset.css" rel="stylesheet" data-description="리셋">
    <link href="css/contents.css" rel="stylesheet" data-description="공통">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
	<script type="text/javascript" src="../js/jquery-1.11.2.min.js"></script>
</head>

<body>
    <div id="wrap">
        <div id="content">
            <div class="progress_section">
                <div class="progress_title">
                    <h2>DISK CHECK</h2>
                    <!--h3>응답해주셔서 감사합니다</h3-->
                </div>

                <div class="progress_infor">
                    <div class="no_infor"><span>자신을 잘 묘사하고 있다고</span> 생각하는 단어 1개 선택</div>
                    <div class="yes_infor"><span>자신과 가장 관계 없다고</span> 생각하는 단어 1개 선택</div>
                </div>
<?PHP
	

$QUERY = "SELECT * FROM TB980094 ORDER BY ID";

$result = @mysqli_query($connect,$QUERY) or die("SQL error");
$A = 1;$B = 2;$C = 3;$D = 4;

while ($row = mysqli_fetch_array($result)) {
   //$fx_contents = strip_tags($row["CONTENTS_"]);
   
?>
			<div  id="prog<?php echo $row["ID"]?>" name="prog<?php echo $row["ID"]?>">
                <ul class="progress">
                    <li>
                        <span><?php echo $row["A"]?></span>
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
                    <li>
                        <span><?php echo $row["B"]?></span>
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
                    <li>
                        <span><?php echo $row["C"]?></span>
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
                    <li>
                        <span><?php echo $row["D"]?></span>
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

                <div class="paging">
                    <div class="paging_num"><?php echo $row["ID"]?>/28</div>
                    <button onclick="javascript:go_next(<?php echo $row["ID"]?>);">NEXT</button>
                </div>
			</div>
				
<?PHP
			$A=$A+4;
			$B=$B+4;
			$C=$C+4;
			$D=$D+4;
}
?>
            </div>
        </div>
        <!--// content-->
    </div>
    <!--// wrap-->
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
	var i;
	for(i=2; i<29; i++){
		$("#prog"+i).hide();
	}

	
fetchUser();

function fetchUser()
{

	var step;
	var action = "select_view_disc_test";
	var request = new Request();
	var id = request.getParameter("id");
	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"../select.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:"json",
		success:function(data)
		{
			//alert(data.QUE);
			for(step=0;step<data.length;step++){
				if(data[step].FLAG=="max"){
					$("input[name=q_max_"+data[step].NUM+"]:radio[value='"+data[step].VALUE_+"']").prop("checked", true) ;
				}else{
					$("input[name=q_min_"+data[step].NUM+"]:radio[value='"+data[step].VALUE_+"']").prop("checked", true) ;
				}
			}
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


});

function go_next(num){
	var max = "#q_max_"+num;
	var min = "#q_min_"+num;

	var q_max = $('input[name="'+"q_max_"+num+'"]:checked').val();
	var q_min = $('input[name="'+"q_min_"+num+'"]:checked').val();

	if(typeof q_max =="undefined" || typeof q_min=="undefined"){
		alert("값을 선택해 주세요.");
	}else{
		$("#prog"+num).hide();
		$("#prog"+(num+1)).show();
	
		if(num==28){
			modify_();
		}

	}
}




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

	if(userid != ""){
		if(q_max===q_min){
			alert("같은값을 선택할 수 없습니다.");
			$("input:radio[name="+num_tmp+"]").prop("checked",false);
			return false;
		}else{
			$.ajax({
				url:"../action.php",
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



function modify_(){
	var action = "action_insert_disc_all";
	var request = new Request();
	var id = request.getParameter("id");

	if(id!=""){
		$.ajax({
			url:"../action.php",
			method:"POST",
			dataType:"json",
			data:{action:action,id:id},
			success:function(data){
				//alert(data.TMP_ID);
				//fetchUser();
				window.location.replace("complete_disc.php");
				
			}
		})
	}
}



</script>
</html>​