<?php include "top.php";?>	
<style>
.txt_st1{    font-size: 15px;
    text-align: left;
    padding: 0px 0 0 32px;
    font-family: 'NanumBarunGothicB';}
.color_st1{
background:#cbe1ec52;
}
.boardwrite tbody tr td {
    border-bottom: 1px solid #e3e3e3;
    padding: 10px 10px;
    text-align:right;
    border-right: 1px solid #e3e3e3;
}

.boardwrite2 tbody tr td {
    border: 1px solid #e3e3e3;
    padding: 10px 10px;
    text-align:right;
}

.boardwrite3 tbody tr td {
    border: 1px solid #e3e3e3;
    padding: 10px 10px;
    text-align:right;
}

.boardwrite3 thead {
    background: #f7f7f7;
    border-top: 1px solid #e6e6e6;
    border-bottom: 1px solid #b6b6b6;
    height:50px;
    border-right: 1px solid #e6e6e6;
}


.boardwrite3 th {
    border-right: 1px solid #e6e6e6;
}


.btn .b_smarta {
    color: #fff;
    background: #be242494;
    border: 0;
    width: 49%;
    height: 50px;

}

.btn .b_wehagot {
    color: #fff;
    background: #116dd0a3;
    border: 0;
    width: 49%;
    height: 50px;
    
}


.boardwrite tbody tr td:first-child{background:white;padding:10px 10px;height:30px;}
</style>	

	<div class="wrap">
	

		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap" style="width: 70%">
				<h2 class="w100"></h2>
				<div class="btn w100" style="margin:5px 0 15px;">
					<button name="delete" id="delete">삭제</button>
					<button name="update" id="update" >수정</button>
					<button name="list" id="list">목록</button>
				</div>
				
				
				<div class="boardwrite3" id="boardwrite3">
					<!-- div>
    					추가 부양가족입력 열기
    				</div-->
    				<br><br><br>
    				<div>
    					<table style="border:1px;width:98%; height:auto; margin:10px;" id="insert_ext_family"  >
    						<colgroup>
                        		<col width="60px">
                        		<col width="50px">
                        		<col width="100px">                       		
                        		<col width="100px">
                        		<col width="30px">
                        		<col width="30px">
                        		<col width="30px">
                        		<col width="30px">
                        		<col width="30px">
                        	</colgroup>
                    		<thead>
                    			
                    			<TH>관계</TH>
                    			<TH>성명</TH>
                    			<TH>주민번호</TH>
                    			<TH>장애인</TH>
                    			<TH>부녀자</TH>
                    			<TH>한부모</TH>
                    			<TH>출산입양</TH>
                    			<TH>취학</TH>
                    			<TH></TH>
                        	</thead>
        					<tbody id="">
        						<tr>
        						
        							<td>
            							<select id="fam_relation" name="fam_relation">
        									<option value="">선택</option>
        									<option value="0">본인</option>
        									<option value="1">소(직계존속)</option>
        									<option value="2">배(직계존속)</option>
        									<option value="3">배우자</option>
        									<option value="4">직계비속자녀</option>
        									<option value="5">직계비속자녀외</option>
        									<option value="6">형제자매</option>
        									<option value="7">수급자</option>
        									<option value="8">위탁아동</option>
        								</select>
        							</td>
        							<td>
        								<input type="text" style="width:66%;height:30px;border: 1px solid #e3e3e3;padding: 5px 15px;" id="fam_name">
        							</td>
        							<TD><input type="text" style="width:87%;height:30px;border: 1px solid #e3e3e3;padding: 5px 15px;" id="fam_resident_id" numberOnly></TD>

        							
        							<TD>
        								<select id="fam_disabled">
        									<option value="">선택</option>
        									<option value="1">장애인복지법에 따른 장애인</option>
        									<option value="2">국가유공자등 근로능력없는 자</option>
        									<option value="3">그밖에 항시 치료를 요하는 중증환자</option>
        								</select>
        							</TD>
        							<TD>
        								<select id="fam_woman">
        									<option value="">선택</option>
        									<option value="1">여</option>
        									<option value="2">부</option>
        								</select>
        							</TD>
        							<TD>
        								<select id="fam_single">
        									<option value="">선택</option>
        									<option value="1">여</option>
        									<option value="2">부</option>
        								</select>
        							</TD>
        							<TD>
        								<select id="fam_birth_adoption">
        									<option value="">선택</option>
        									<option value="1">O</option>
        									<option value="2">X</option>
        								</select>
        							</TD>
        							<TD>
        								<select id="is_school">
        									<option value="">선택</option>
        									<option value="1">여</option>
        									<option value="2">부</option>
        								</select>
        							</TD>
        							<TD></TD>
        						</tr>
        						<tbody id="result3">
    							</tbody>
        						<tr><td colspan=8>
        							<button id="FAM_INSERT" name="FAM_INSERT"  style="width:100px;height:35px;margin: 0 0 0 0;cursor:pointer;">추가</button>
        						</td></tr>
    						</tbody>
    					</table>
    					<table style="border:1px;width:98%; height:auto; margin:10px;" id="insert_ext_family"  >
    						
    						<colgroup>
                        		<col width="60px">
                        		<col width="50px">
                        		<col width="100px">                       		
                        		<col width="100px">
                        		<col width="30px">
                        		<col width="30px">
                        		<col width="30px">
                        		
                        	</colgroup>
        					
    					</table>
    				</div>
				</div>
					
				
				
				<div class="boardwrite">
					
					<table>
						<tbody>
							<tr class="">
								<td colspan=2 class="txt_st1">경비율조정</td>
								<td colspan=2>
									<select id="user_ratio">
    									<option value="100">100%</option>
    									<option value="90">90%</option>
    									<option value="80">80%</option>
    									<option value="70">70%</option>
    								</select>
								</td>
							</tr>
							<tr class="">
								<td colspan=2 class="txt_st1">구분</td>
								<td class="txt_st1">종합소득세</td>
								<td class="txt_st1">농어촌특별세</td>
								
							</tr>
							<tr class="">
								<td colspan=2 class="">종합소득금액</td>
								<td><label id="STEP1"></label></td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>소득공제계</td>
								<td><label id="STEP10"></label></td>
								<td>0</td>
							</tr>
							<tr class="">
								<td colspan=2>과세표준</td>
								<td><label id="STEP2"></label></td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>세율</td>
								<td style="text-align: center;"><label id="STEP3"></label></td>
								<td>0</td>
								
							</tr>
							<tr class="">
								<td colspan=2>산출세액</td>
								<td><label id="STEP4"></label></td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>세액감면</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr class="">
								<td colspan=2>세액공제</td>
								<td><label id="STEP11"></label></td>
								<td>0</td>
							</tr>
							<tr>
								<td rowspan=3>결정세액</td>
								<td class="txt_st1">종합과세<br>(23.-24.-25.)</td>
								<td><label id="STEP5"></label></td>
								<td>0</td>
							</tr>
							<tr>
								<td>분리과세</td>
								<td>0</td>
								<td>0</td>
								
							</tr>
							<tr >
								<td>합계 (26 + 27)</td>
								<td><label id="STEP6"></label></td>
								<td>0</td>
							</tr>
							<tr  >
								<td colspan=2>가산세</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>추가납부세액</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>합 계(26 + 27 + 28)</td>
								<td><label id="STEP7"></label></td>
								<td>0</td>
								
							</tr>
							<tr >
								<td colspan=2>기 납 부 세 액 계</td>
								<td><label id="STEP8"></label></td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>납부(환급)할 총세액</td>
								<td><B><label id="STEP9"></label></B></td>
								<td>0</td>
								
							</tr>
							<!-- tr >
								<td rowspan=2>주 식 매 수<br>납부특례세액</td>
								<td class="txt_st1">차감</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr>
								<td >가산</td>
								<td>0</td>
								<td>0</td>
								
							</tr>
							<tr >
								<td>분납할세액</td>
								<td class="txt_st1">2개월내(-)</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>기한내 납부 할 세액</td>
								<td>0</td>
								<td>0</td>
							</tr -->
						</tbody>
					</table>
				</div>
				 <div class="btn w100">
					<button style="cursor:pointer;" class="b_smarta"   name="btn_SmartA" id="btn_SmartA">스마트A 신고서작성</button>
					<button style="cursor:pointer;" class="b_wehagot"   name="btn_Wehago" id="btn_Wehago">위하고T 신고서작성</button>
				</div>

				<div class="btn w100" style="margin:5px 0 15px;">
					<button name="delete" id="delete2">삭제</button>
					<button name="update" id="update2" >수정</button>
					<button name="list" id="list2">목록</button>
				</div>

				
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="자동간편장부">
	<input type="hidden" id="img_name" name="img_name">
	<input type="hidden" name="id" id="user_id" />
	<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
	<input type="hidden" name="file_view_str" id="file_view_str" />
<?php
$s_str = $_GET["s_str"];
?>
</body> 


<script src="js/fileDownload.js"></script>
<script>


function del(str1,str2){

	
	
	document.getElementById(str1).style.display = "none";
	
	document.getElementById("file_name").value = document.getElementById("file_name").value.replace("|"+str1,"");

	document.getElementById("file_view_str").value = document.getElementById("file_view_str").value.replace("|"+str2,"");

}


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
 


function select_ck(){
	var select = $('select');
    for (var i = 0; i < select.length; i++) {
        var idxData = select.eq(i).children('option:selected').text();
        select.eq(i).siblings('label').text(idxData);
    } 
    select.change(function () {
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });
}

//모든 콤마 제거
function removeCommas(x) {
    if(!x || x.length == 0) return "";
    else return x.split(",").join("");
}

function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


$(document).ready(function(){

	$("input:text[numberOnly]").on("focus", function() {
	    var x = $(this).val();
	    x = removeCommas(x);
	    $(this).val(x);
	}).on("focusout", function() {
	    var x = $(this).val();
	    if(x && x.length > 0) {
	        if(!$.isNumeric(x)) {
	            x = x.replace(/[^0-9]/g,"");
	        }
	        //x = addCommas(x);
	        $(this).val(x);
	    }
	}).on("keyup", function() {
	    $(this).val($(this).val().replace(/[^0-9]/g,""));
	});

	

	var page_flag = document.getElementById("page_flag").value;

	top_menu(page_flag);

	fetchUser_ratio();
	
	


	//수정
	$('#update').click(function(){
		update_();
	});
	$('#update2').click(function(){
		update_();
	});

	//목록가기
	$('#list').click(function(){
		list_();		
	});
	$('#list2').click(function(){
		list_();		
	});


	//삭제
	$('#delete').on('click', function(e){
		delete_();
	});
	$('#delete2').on('click', function(e){
		delete_();
	});

	$('#btn_SmartA').on('click', function(e){
		cal_RPA("step_A");
	});

	$('#btn_Wehago').on('click', function(e){
		cal_RPA("step_T");
	});

	$('#fam_single').on('change', function(e){
		dual_ck("s");
	});
	$('#fam_woman').on('change', function(e){
		dual_ck("w");
	});

	$('#user_ratio').on('change', function(e){
		save_ratio();
	});

	


	$('#FAM_INSERT').on('click', function(e){
		var request = new Request();
		var id = request.getParameter("id");
		var action = "insert_family";

		if(id!=""){
			var fam_relation = $("#fam_relation").val();
			var fam_name = $("#fam_name").val();
			var fam_resident_id = $("#fam_resident_id").val();
			var fam_disabled = $("#fam_disabled").val();
			var fam_woman = $("#fam_woman").val();
			var fam_single = $("#fam_single").val();
			var is_school = $("#is_school").val();
			var fam_birth_adoption = $("#fam_birth_adoption").val();
			
			$.ajax({
	    		url:"action.php",
	    		method:"POST",
	    		data:{action:action,id:id,fam_relation:fam_relation,fam_name:fam_name, fam_resident_id:fam_resident_id,fam_disabled:fam_disabled,fam_woman:fam_woman, fam_single:fam_single, is_school:is_school,fam_birth_adoption:fam_birth_adoption},
	    		success:function(data){
	    			alert("입력되었습니다.");
	    			fetchUser();
	    			fetchUser_fam();
	    			setBlank();
	    		}
	    	})
		}else{
			alert('고객정보 등록 후 사용할수 있습니다.');
		}
	});


		

});

function save_ratio(){
	var request = new Request();
	var id = request.getParameter("id");
	var action = "update_user_ratio";

	if(id!=""){
		var user_ratio = $("#user_ratio").val();
		
		$.ajax({
    		url:"action.php",
    		method:"POST",
    		data:{action:action,id:id,user_ratio:user_ratio},
    		success:function(data){
				if(data == "ok"){
					fetchUser_ratio();
					fetchUser();
				}
				else{
					alert("에러발생");
				}
					
    		}
    	})
	}else{
		alert('에러발생');
	}
	
}

function setBlank(){
	$("#fam_relation").val("");
	$("#fam_name").val("");
	$("#fam_resident_id").val("");
	$("#fam_disabled").val("");
	$("#fam_woman").val("");
	$("#fam_single").val("");
	$("#is_school").val("");
	$("#fam_birth_adoption").val("");
	
}

function dual_ck(str){
	var woman = $('#fam_woman').val();
	var single = $('#fam_single').val();

	if(woman == "1" && single == "1" ){
		alert("부녀자공제와 한부모 공제는 중복 공제되지 않습니다. 확인 후 입력바랍니다.");
		if(str == "w")
			$('#fam_woman').val("");
		else
			$('#fam_single').val("");
	}
}


function list_(){
	var s_str = "<?=$s_str ?>";
	s_str = encodeURI(s_str);
	var request = new Request();
	var s_option = request.getParameter("s_option");
	var g_option = request.getParameter("g_option");
	var t_option = request.getParameter("t_option");
	var s_date1 = request.getParameter("s_date1");
	var s_date2 = request.getParameter("s_date2");
	var s_str = unescape(request.getParameter("s_str"));
	//var s_str = request.getParameter("s_str");
	//window.location.href="list_trans.php?&t_option="+t_option+"&s_option="+s_option+"&g_option="+g_option+"&s_str="+escape(s_str)+"&s_date1="+s_date1+"&s_date2="+s_date2;
}

function del(str){
	var request = new Request();
	var cstid = request.getParameter("id");
	var action = "del_family";
	
	if(confirm("삭제하시겠습니까?") == true){
    
    	$.ajax({
    		url:"action.php",
    		method:"POST",
    		data:{action:action,cstid:cstid,str:str},
    		success:function(data){
    			fetchUser_ratio();
    			fetchUser();
    			
    		}
    	})
		
	}else{
		return;
	}
}



function fetchUser_ratio()
{

	var action = "select_ratio";
	var request = new Request();
	var id = request.getParameter("id");
	
	if(id != null && id!=""){
		$.ajax({
			url:"select.php",
			method:"POST",
			dataType:"json",
			data:{id:id, action:action},
			success:function(data)
			{
				$('#user_ratio').val(data.USER_RATIO);
				fetchUser();
				
			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})

	}else{
		$('#boardwrite2').css("display","");
	}
	
}


function fetchUser()
{

	var action = "select_income_cal";
	
	var depid = "<?= $depid ?>";
	var userid = "<?= $userid ?>";
	
	var request = new Request();
	var id = request.getParameter("id");
	
	
	var user_ratio = $("#user_ratio").val();
	//var id = 13737;
	//users 리스트를 select.php 에서 받아온다.
	
	if(id != null && id!=""){
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{id:id, action:action, user_ratio:user_ratio},
			dataType:"json",
			success:function(data)
			{
				//alert(data.first_name);
				//data의 타입은 객체 object
				//한 행에서 수정버튼을 누르면
				//위쪽 입력창의 값이 추가 -> 수정으로 변경되게 만든다.

				console.log(data);
				$('#boardwrite2').css("display","none");
			
				$('#STEP1').html(data.STEP1);
				$('#STEP2').html(data.STEP2);
				$('#STEP3').html(data.STEP4);
				$('#STEP4').html(data.STEP3);
				$('#STEP5').html(data.STEP5);
				$('#STEP6').html(data.STEP6);
				$('#STEP7').html(data.STEP6);
				$('#STEP8').html(data.STEP8);
				$('#STEP9').html(data.STEP9);
				$('#STEP10').html(data.STEP10);
				$('#STEP11').html(data.STEP11);
				
				

			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})

	}else{
		$('#boardwrite2').css("display","");
	}
	
}


</script>


</html>