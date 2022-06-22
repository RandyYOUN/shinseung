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
session_start();

if($jb_login == false){
	$str = "";
	$str .= '<script>alert("세션이 만료되어 로그인페이지로 이동합니다.");';
	$str .= 'document.location.replace("../login.php");</script>';

	echo $str;
}

?>
    
        <section class="boardTop">
            <h2 id="page_title"></h2>
           



            <div class="mainBoard">
                <table>
						<tbody>
							
							<tr>
								<td class="w70p">작성자</td>
								<td colspan=3 style="text-align: left; padding-left:30px;">
									<label id="username"></label>
								</td>
							</tr>
							<tr>
								<td class="w70p">우선순위</td>
								<td>
									<label id="prio_num"></label>
								</td>
								<td class="w50">진행상태</TD>
								<td>
									<label id="progress"></label>
									 
								</td>
							</tr>
							
							<TR>
							<td>접수지점</TD>
								<td>
									<label id="reg_branch"></label>
								</td>
							<td>세목</TD>
								<td>
									<label id="tax_flag"></label>
								</td>
							</tr>
							<TR>
								<td>납세자<br>성명</TD>
								<TD>
									<label id="cstname"></label>
								</TD>
								<td>납세자<br>연락처</TD>
								<TD>
									<label id="mobile"></label>
								</TD>
							</TR>
							<TR>
								<td>납세자<br>주소지</TD>
								<TD>
									<label id="cst_address"></label>
								</TD>
								<td>양도대상</TD>
								<TD>
									<label id="trans_target"></label>
								</TD>
							</TR>
							<TR>
								<td>수수료<br>납부여부</TD>
								<TD>
									<label id="pay_flag"></label>
								</TD>
								<td>수수료</TD>
								<TD>
									<label id="price"></label>
								</TD>
							</TR>
							<TR>
								<td>수수료<br>납부일자</TD>
								<TD>
									<label id="pay_date"></label>
								</TD>
								<td>번호</TD>
								<TD>
									<label id="num"></label>
								</TD>
							</TR>
							
							<TR style="height:100px;">
								<TD colspan=4 style="text-align:center;font-size:17px;text-align:center;">
									<b>아래는 담당 세무사님께서 기록해 주시기 바랍니다. </b>
								</TD>
							</TR>
							<TR>
								<td>담당세무사</TD>
								<TD>
									<label id="owner"></label>
								</TD>
								<td>신고기한</TD>
								<TD>
									<label id="deadline"></label>
								</TD>
							</TR>
							<TR>
								<td>양도일자</TD>
								<TD>
									<label id="trans_date"></label>
								</TD>
								<td>양도가액</TD>
								<TD>
									<label id="trans_price"></label>
								</TD>
							</TR>
							<TR>
								<td>취득일자</TD>
								<TD>
									<label id="acq_date"></label>
								</TD>
								<td>취득가액</TD>
								<TD>
									<label id="acq_price"></label>
								</TD>
							</TR>
							
							<TR>
								<td>총납부세액</TD>
								<TD>
									<label id="total_tax"></label>
								</TD>
								<td>납부서전달</TD>
								<TD>
									<label id="delivery_flag"></label>
								</TD>
							</TR>
							<TR>
								<td>수수료2</TD>
								<TD>
									<label id="price2"></label>
								</TD>
								<td></TD>
								<TD>
									
								</TD>
							</TR>
							<tr style="height:100px;">
								<td>첨부파일</td>
								<td colspan=3 style="padding:0px;text-align:left;">
									<label id="file_view_str"></label>
								</td>
							</tr>
						
							<tr>
								<td colspan=4 style="padding:15px;text-align:left;">
									<div id="summernote">
										<p>
										
											<br>
										</p>
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
		var action = "select_trans";
		var request = new Request();
		var depid = "<?= $depid ?>";
		var userid = "<?= $userid ?>";
		

		var id = request.getParameter("id");
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"../select.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				//alert(data.first_name);
				//data의 타입은 객체 object
				//한 행에서 수정버튼을 누르면
				//위쪽 입력창의 값이 추가 -> 수정으로 변경되게 만든다.

				console.log(data);
			
				$('#username').html(data.REGUSER_);
				$('#progress').html(data.PROGRESS_);
				$('#reg_branch').html(data.REG_BRANCH_);
				$('#tax_flag').html(data.TAX_FLAG_);
				$('#cstname').html("<b>"+data.CSTNAME+"</b>");
				$('#mobile').html(data.MOBILE);
				$('#cst_address').html(data.CST_ADDRESS);
				$('#trans_target').html(data.TRANS_TARGET_);
				
				if(data.PAY_FLAG == "E3003"){
					$('#pay_flag').html(data.PAY_FLAG_ + " ("+data.OPTION_PRICE+" 원)");
				}else{
					$('#pay_flag').html(data.PAY_FLAG_);
				}
				
				$('#price').html(data.PRICE_);
				$('#price2').html(data.PRICE2_);
				$('#pay_date').html(data.PAY_DATE_);
				$('#trans_date').html(data.TRANS_DATE_);
				$('#trans_price').html(data.TRANS_PRICE_);
				$('#acq_date').html(data.ACQ_DATE_);
				$('#acq_price').html(data.ACQ_PRICE_);
				$('#deadline').html(data.DEADLINE_);
				$('#total_tax').html(data.TOTAL_TAX);
				$('#delivery_flag').html(data.DELIVERY_FLAG_);
				$('#file_real_str').html(data.FILE_REAL_STR);
				$('#owner').html(data.OWNER_);
				$('#num').html(data.NUM);
				$('#prio_num').html(data.PRIO_NUM_);
				$('#rep_num').html(data.REP_NUM);
				$('#rep_date').html(data.REP_DATE_);
				$('#etc').html(data.ETC);
				$('#reg_date').html(data.REGDATE_);
				var file_view_arr = data.FILE_VIEW_STR.split("|");
				var file_real_arr = data.FILE_REAL_STR.split("|");
				var mobile_ =  data.MOBILE.replace(/-/gi, "");

				var file_dir = "../FILE_SVR_1/trans/"+data.CSTNAME+"_"+mobile_+"/";

				for (var i=0;i<file_view_arr.length ;i++ )
				{

					$('#file_view_str').append ("<li><a href='javascript:down(\""+file_real_arr[i]+"\",\""+file_dir+"\");'>" +file_view_arr[i]+"</a></li>");
				}
				
				
//				$('#file_view_str').html("<a href='#'>" + data.FILE_VIEW_STR + "</a>");

				$('#summernote').html( data.CONTENTS);
				
				select_ck();

				var reguser = data.REGUSER;

				if(userid == reguser || depid == "D1000" || depid == "D1014" ){
					document.getElementById("delete").setAttribute('style','display:inline');
				}else{
					document.getElementById("delete").setAttribute('style','display:none');
				}



			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
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