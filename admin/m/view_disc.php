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
<?php
include "../db_info.php";
include "../session_inc.php";
   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
//session_cache_expire(360);

?>
<style>
.disc_img_text{background-color: #00b0f0;
    width: 90%;
    text-align: center;
    color: white;
    font-size: 25px;}
.disc_img{width: 90%;}
.disc_people{    font-size: 20px;
    width: 90%;
    border: ridge;
    margin: 5px 0px 5px 0;}    
</style>    
        <section class="boardTop">
            <h2 id="page_title"></h2>
           



            <div class="mainBoard">
                <table>
						<tbody>
							
							<tr>
								<td class="w100p">성명</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="username"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">연락처</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="mobile"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">생일/연령</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="birth"></label>
									<label id="age"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">부서</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="branch"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">경력</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label class="disc_text" id="car_year" name="car_year"></label>
												
									<label class="disc_text" id="car_month" name="car_month"></label>
									
									<label class="disc_text" id="new_begin" name="new_begin" style="margin-left:45px;"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">총경력</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label class="disc_text" id="total_car_year" name="total_car_year"></label>
												
									<label class="disc_text" id="total_car_month" name="total_car_month"></label>
									
									<label class="disc_text" id="total_new_begin" name="total_new_begin" style="margin-left:45px;"></label>
								</td>
							</tr>
							
							<tr>
								
								<td colspan=4 style="text-align: left; padding-left:30px;">
									<div id="grap1_text" class="disc_img_text">그래프1</div>
									<img id="type_g1_img" class="disc_img"></img>
									<div class="disc_people" id="group_g1" name="group_g1"></div>
								</td>
							</tr>
							<tr>
								<td colspan=4 style="text-align: left; padding-left:30px;">
									<div id="grap2_text" class="disc_img_text">그래프2</div>
									<img id="type_g2_img" class="disc_img"></img>
									<div class="disc_people" id="group_g2" name="group_g2"></div>
								</td>
							</tr>
							<tr>
								
								<td colspan=4 style="text-align: left; padding-left:30px;">
									<div id="grap3_text" class="disc_img_text">그래프3</div>
									<img id="type_g3_img" class="disc_img"></img>
									<div class="disc_people" id="group_g3" name="group_g3"></div>
								</td>
							</tr>
							<tr>
								<td class="w70p">평가자</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="eval_userid"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">면접일</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="interview_date"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">최종학력</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="final_edu"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">최종학교명</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="final_school"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">인상</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="impression"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">근무의욕</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="desire"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">전문지식</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="knowledge"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">업무능력</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="ability"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">건강상태</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="physical"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">종합평가</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="total_eval"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">희망연봉</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="hope_money"></label>
								</td>
							</tr>
							
							<tr>
								<td class="w70p">면접의견</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="interview_comment" name="interview_comment"></label>
								</td>
							</tr>
							
							<tr>
								<td class="w70p">첨부파일</td>
								<td colspan=3 style="text-align: left;">
									<label id="file_view_str"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">진행상태</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<div class="selectbox w50">
										<select name="progress_c" style="width: 100px;" id ="progress_c" class="w50" onchange="javascript:modiy_progress();" >
										<option value="H2011">접수</option>
										<option value="H2012">면접</option>
										<option value="H2013">불합격</option>
										<option value="H2014">예비합격</option>
										<option value="H2015">최종합격</option>
										<option value="H2016">근무중</option>
										<option value="H2017">퇴사</option>
									</select>
									</div>
								</td>
							</tr>
							<tr>
								<td class="w70p">수신참조</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<div class="selectbox w50">
    									<select style="width:100px;" id="reception_c" name="reception_c" >
    									<option value="" >선택</option>
    									<option value="D2001" >CH</option>
    									<option value="D2002" >대표이사</option>
    									<option value="D2010" >세무본부장</option>
    									<option value="D2005" >지점장</option>
    								</select>
    								</div>
    								<div class="selectbox w50" id="sel_branch" style="display: none;">
										<select name="reg_branch" id ="reg_branch" class="w50" style="width:100px;">
										<option selected value="">선택</option>
										<option value="D1003">강남</option>
										<option value="D1004">용인</option>
										<option value="D1006">안양</option>
										<option value="D1007">수원</option>
										<option value="D1008">일산</option>
										<option value="D1009">부천</option>
										<option value="D1010">광주</option>
										<option value="D1011">분당</option>
										<option value="D1012">기흥</option>
									</select>
									</div>
								</td>
							</tr>
							<tr>
								<td class="w70p">검토의견</td>
								<td colspan=3 style="text-align: left; padding-left:15px;">
									
									<input type="box" class="w65" name="comment" id="comment" style="height:40px;" >
									<button name="reg_comment" id="reg_comment" style="width:60px;border: 1px solid #fff;background: #444;height: 44px;padding: 10px 15px;letter-spacing: 0.5px;margin: 0 3px 0;color:white;" >등록</button>
								</td>
							</tr>
							<tr>
								<td colspan=4 style="text-align: left;">
									<div class="board" style="width:100%;">
										<table style="width:100%;text-align: left;">
											<tbody id="result_cmt"  >
											<colgroup>
												<col width="30%">
												<col width="70%">
											</colgroup>
											</tbody>
										</table>
									</div>
								</td>
							</tr>
							
							
							
							
							
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
<input type="hidden" id="page_flag" value="면접평가">
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



	$('#reception_c').change(function(){
		var request = new Request();
		var id = request.getParameter("id");
		var userid = "<?= $userid ?>";
		var add_member = $("#reception_c").val();
		var action = "action_send_disc_add_member";

		if(add_member == 'D2005'){
			$('#sel_branch').css("display","");
			return false;
		}

		
		if(confirm("수신참조 그룹에게 알림톡을 발송하시겠습니까?"))
		{
			if(add_member != ""){

				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"../api/send_tok_v1.php", 
					method:"POST",
					data:{id:id,userid:userid,action:action,add_member:add_member},
					success:function(data){
						console.log(data);
						if(data.indexOf("전송완료")>-1){
							alert("수신참조 번호로 알림톡이 발송되었습니다.");
						}
					}
				});
			}
		}else{
			$("#reception_c").val("");
		}

		
	});
	

	$('#progress_c').change(function(){
		var request = new Request();
		var id = request.getParameter("id");

		var action = "upt_disc_upt_prog";
		var userid = "<?php echo $userid;?>";
		var prog = $("#progress_c").val();

		$.ajax({
			url:"../action.php",
			method:"POST",
			data:{action:action,id:id,prog:prog, userid:userid},
			success:function(data){
				console.log(data);
			}
		});
	});



	$('#sel_branch').change(function(){
		var request = new Request();
		var id = request.getParameter("id");
		var userid = "<?= $userid ?>";
		var add_member = $("#reg_branch").val();
		var action = "action_send_disc_add_member";
		var br_flag = "Y";

		if(confirm("수신참조 그룹에게 알림톡을 발송하시겠습니까?"))
		{
			if(add_member != ""){

				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"../api/send_tok_v1.php", 
					method:"POST",
					data:{id:id,userid:userid,action:action,add_member:add_member, br_flag:br_flag},
					success:function(data){
						console.log(data);
						if(data.indexOf("전송완료")>-1){
							alert("수신참조 번호로 알림톡이 발송되었습니다.");
						}
					}
				});
			}
		}else{
			$("#sel_branch").val("");
		}

		
	});


	
	
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


	//코멘트등록
	$('#reg_comment').click(function(){
		var request = new Request();
		var id = request.getParameter("id");
		var userid = "<?= $userid ?>";
		var comment = $('#comment').val();
		var b_flag = "E1009";

		if(confirm("댓글을 등록 하시겠습니까?"))
		{
		//구분자
			var action = "action_trans_insert_comment";
			$.ajax({
				url:"../action.php",
				method:"POST",
				data:{id:id,action:action,comment:comment, userid:userid, b_flag:b_flag},
				success:function(data){
					//리스트 다시 조회
					//fetchUser();
					//alert(data);
					if(data=="success"){
						$('#comment').val("");
						fetchUser();
						fetchUserC();
						//send_kakao(comment);
					}
					//window.location.replace("list_trans.php");
					
				}
			});

			
		}else
		{
			return false;
		}

		
	});

	

	fetchUser();
	fetchUser2();
	fetchUserC();

	function fetchUser()
	{

		var action = "select_view_disc";
		var request = new Request();
		var id = request.getParameter("id");
		var step;

		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"../select.php",
			method:"POST",
			data:{id:id,action:action},
			dataType:"json",
			success:function(data)
			{
				console.log(data.length);
				$('#username').html(data[0].USERNAME);
				$('#mobile').html(data[0].MOBILE);
				$('#branch').html(data[0].BRANCH_);
				if(data[0].CAR_YEAR != null && data[0].CAR_YEAR != 0)
					$('#car_year').html(data[0].CAR_YEAR + "&nbsp;년&nbsp;&nbsp;");

				if(data[0].CAR_MONTH != null && data[0].CAR_MONTH != 0)
					$('#car_month').html(data[0].CAR_MONTH+ "&nbsp;개월");

				if(data[0].TOTAL_CAR_YEAR != null && data[0].TOTAL_CAR_YEAR != 0)
					$('#total_car_year').html(data[0].TOTAL_CAR_YEAR + "&nbsp;년&nbsp;&nbsp;");

				if(data[0].TOTAL_CAR_MONTH != null && data[0].TOTAL_CAR_MONTH != 0)
					$('#total_car_month').html(data[0].TOTAL_CAR_MONTH+ "&nbsp;개월");
				
				if(data[0].NEW_BEGIN == "Y")
					$('#new_begin').html("신입");			
				
				if(data[0].TOTAL_NEW_BEGIN == "Y")
					$('#total_new_begin').html("신입");			
				
				$('#eval_userid').html(data[0].EVAL_USERID_);
				$('#interview_date').html(data[0].INTERVIEW_DATE_);
				$('#final_edu').html(data[0].FINAL_EDU_);
				$('#final_school').html(data[0].FINAL_SCHOOL);
				$('#impression').html(data[0].IMPRESSION_);
				$('#desire').html(data[0].DESIRE_);
				$('#knowledge').html(data[0].KNOWLEDGE_);
				$('#ability').html(data[0].ABILITY_);
				$('#physical').html(data[0].PHYSICAL_);
				$('#total_eval').html(data[0].TOTAL_EVAL_);
				if(data[0].HOPE_MONEY != null && data[0].HOPE_MONEY != 0)
					$('#hope_money').html(data[0].HOPE_MONEY + "&nbsp;만원");
				$('#interview_report').html(data[0].INTERVIEW_REPORT_);
				$('#interview_comment').html(data[0].INTERVIEW_COMMENT);
				$('#progress_c').val(data[0].PROGRESS);
				$('#reception').html(data[0].RECEPTION);

				if(data[0].BIRTH != null && data[0].BIRTH != "0000-00-00")
					$('#birth').html(data[0].BIRTH);

				if(data[0].AGE != null && data[0].AGE != 0)
					$('#age').html("/&nbsp;&nbsp;"+data[0].AGE);
				//$('#hope_money').html(data[0].HOPE_MONEY+"만원");
				if(data[0].INCLUDE_SEV == "Y")
					$('#include_sev').html("(퇴직금포함)");

				if(data[0].FILE_VIEW_STR != "" && data[0].FILE_VIEW_STR != undefined)
					var file_view_arr = data[0].FILE_VIEW_STR.split("|");

				if(data[0].FILE_REAL_STR != "" && data[0].FILE_REAL_STR != undefined)
					var file_real_arr = data[0].FILE_REAL_STR.split("|");
				
				var mobile_ =  data[0].MOBILE.replace(/-/gi, "");
				var file_dir = "../FILE_SVR_1/disc/"+data[0].USERNAME+"_"+mobile_+"/";

				for (var i=0;i<file_view_arr.length ;i++ )
				{

					$('#file_view_str').append ("<li><a href='javascript:down(\""+file_real_arr[i]+"\",\""+file_dir+"\");'>" +file_view_arr[i]+"</a></li>");
				}

				
				
				
			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}

		})
	}



	function fetchUser2()
	{

		var action = "select_view_disc_ext2";
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
				console.log();
				$('#type_g1').html(data.TYPE_G1);
				$('#type_g2').html(data.TYPE_G2);
				$('#type_g3').html(data.TYPE_G3);
				$('#group_g1').html(data.GROUP_G1);
				$('#group_g2').html(data.GROUP_G2);
				$('#group_g3').html(data.GROUP_G3);
				$('#type_g1_img').attr("src","images/disc/"+data.G1_IMAGE+".png");
				$('#type_g2_img').attr("src","images/disc/"+data.G2_IMAGE+".png");
				$('#type_g3_img').attr("src","images/disc/"+data.G3_IMAGE+".png");
				$('#'+data.REP_TYPE).css("display","");
			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})
	}




	function fetchUserC()
	{

		var action = "select_comment";
		var request = new Request();
		var id = request.getParameter("id");
		var userid = "<?= $userid ?>";
		var b_flag = "E1009";
		var mobile_flag="m";
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"../select.php",
			method:"POST",
			data:{id:id, action:action, userid:userid, b_flag:b_flag, mobile_flag:mobile_flag},
			success:function(data)
			{
				console.log(data);
				$('#result_cmt').html(data);

			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})
	}

	function del_cmt(id){
		var userid = "<?= $userid ?>";
		var action = "action_trans_del_comment";
		
		if(confirm("댓글을 삭제 하시겠습니까?"))
		{
			$.ajax({
				url:"../action.php",
				method:"POST",
				data:{id:id,action:action, userid:userid},
				success:function(data){
					//리스트 다시 조회
					//fetchUser();
					//alert(data);
					if(data=="success"){
						fetchUserC();
					}
					//window.location.replace("list_trans.php");
					
				}
			});

			
		}else
		{
			return false;
		}
	}



	function down(name,dir){
		window.open("../down_trans.php?fileurl="+dir+"&filename="+name);
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




function down(name,dir){
	//alert(str);
	window.open("../down_trans.php?fileurl="+dir+"&filename="+name);

	/*
	$.fileDownload(str)
		.done(function(){alert('성공'); })
		.fail(function(){alert('실패'); });
	return false;
	*/
}


</script>

</html>