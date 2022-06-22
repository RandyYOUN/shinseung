<!DOCTYPE html>
<html>

</html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승 RPA</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="shortcut icon" href="images/icon.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


<!-- add summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/lang/summernote-ko-KR.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- codemirror -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>

<script src="js/wf_loading.js" type="text/javascript"></script>
<link href="css/wf_loading.css" rel="stylesheet" type="text/css" />


<body>
	
<?php
include "db_info.php";

include "top.php";

?>	
<br><br><br><br>
	<div class="wrap">
		<div class="mainbg">
			<div class="content">
				<div class="conwrap">

					<h1>신고 안내정보</h1>
    				<div class="btn w100" style="margin:5px 0 15px;text-align:right;">
    					<button name="action1" id="action1" >등록</button>
    					<button name="list" id="list">목록</button>
    				</div>
					<div class="dashwrap" style="width:1390px;">

						<h2>기본정보</h2>
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
											<th>상호(법인명)</td>
											<td><input type="box" name="COMP_NAME" id="COMP_NAME"  /></input></td>
											<th>사업자번호</td>
											<td><input type="box" name="BIZ_ID_NUM" id="BIZ_ID_NUM" /></input></td>
										</tr>
										<tr>
											<th>성명(대표자)</td>
											<td><input type="box" name="CSTNAME" id="CSTNAME" /></input></td>
											<th>주민등록번호(대표자)</td>
											<td><input type="box" name="RESIDENT_ID" id="RESIDENT_ID" /></input></td>
										</tr>
										<tr>
											<th>개업일자</td>
											<td><input type="date" name="OPENING_DAY" id="OPENING_DAY" /></input></td>
											<th>사업자등록일</td>
											<td><input type="date" name="BIZ_REG_DATE" id="BIZ_REG_DATE" /></input></td>
										</tr>
										<tr>
											<th>업태</td>
											<td><input type="box" name="SECTOR" id="SECTOR" /></input></td>
											<th>종목</td>
											<td><input type="box" name="BIZ_CATE" id="BIZ_CATE" /></input></td>
										</tr>
										<tr>
											<th>사업장 소재지</td>
											<td colspan=3><input type="box" name="COMP_ADDRESS" id="COMP_ADDRESS" style="width:600px;" /></input></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<h2>상세정보</h2>
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
											<th>홈택스ID</td>
											<td><input type="box" name="HomeTaxID" id="HomeTaxID"  /></input></td>
											<th>홈택스PW</td>
											<td><input type="box" name="HomeTaxPW" id="HomeTaxPW" /></input></td>
										</tr>
										<tr>
											<th>전화번호</td>
											<td><input type="box" name="COMP_PHONE" id="COMP_PHONE" /></input></td>
											<th>휴대전화번호</td>
											<td><input type="box" name="MOBILE" id="MOBILE" /></input></td>
										</tr>
										<tr>
											<th>이메일</td>
											<td><input type="box" name="EMAIL" id="EMAIL" /></input></td>
											<th>전자고지 신청일</td>
											<td><input type="DATE" name="E_NOTICE_DATE" id="E_NOTICE_DATE" /></input></td>
										</tr>
										<tr>
											<th>더존 서버</td>
											<td><input type="box" name="DOUZONE_SVR" id="DOUZONE_SVR" /></input></td>
											<th>더존 코드</td>
											<td><input type="box" name="DOUZONE_CODE" id="DOUZONE_CODE" /></input></td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>

						<h2>접수정보</h2>
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
											<th>지점</td>
											<td>
													<select name="REG_BRANCH" id ="REG_BRANCH" class="w50" >
                										<option selected value="">선택</option>
                										<option value="D1013">세무</option>
                										<option value="D1002">회계</option>
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
											</td>
											<th>접수일</td>
											<td><input type="date" name="REGDATE" id="REGDATE" /></input></td>
										</tr>
										<tr>
											<th>접수자</td>
											<td>
<?php
								if( $jb_login ) {
									echo '<input type="box"  name="username" id="username" value="'.$username.'" readonly="true" STYLE = "background-color: #e2e2e2;" >
                                                <input type="hidden" name="REGUSER" id="REGUSER" value="'.$userid.'" ';
								}else{
									echo '<input type="box"  name="REGUSER" id="REGUSER" >';
								}
?>
											</td>
											<th>상담분야</td>
											<td>
            									<select name="CST_TYPE" id ="CST_TYPE" class="w50" >
                										<option value="A1001">종소세</option>
                										<option selected value="A1002">부가세</option>
            									</select>
            								</td>
										</tr>
										<tr>
											<th>유입경로</td>
											<td><input type="box" name="INF_PATH" id="INF_PATH" /></input></td>
											<th>유입채널</td>
											<td><input type="box" name="INF_CHANNEL" id="INF_CHANNEL" /></input></td>
										</tr>
										<tr>
											<th>UTM Source</td>
											<td><input type="box" name="UTM_S" id="UTM_S" /></input></td>
											<th>UTM Term</td>
											<td><input type="box" name="UTM_T" id="UTM_T" /></input></td>
										</tr>
										<tr>
											<th>UTM Campaign</td>
											<td><input type="box" name="UTM_C" id="UTM_C" /></input></td>
											<th>UTM</td>
											<td><input type="box" name="UTM" id="UTM" /></input></td>
										</tr>
										<tr>
											<th>수수료 조건</td>
											<td colspan=3 style="text-inline:16px;">
												<input type="checkbox" name="OPTION1" id="OPTION1" />  전자세금계산서만 있는 경우</input><br><br>
												<input type="checkbox" name="OPTION2" id="OPTION2" />  신용카드 매입공제 내역이 없는 경우</input><br><br>
												<input type="checkbox" name="OPTION3" id="OPTION3" />  소규모 개인 부가가치세 감면 대상자</input><br><br>
												<input type="checkbox" name="OPTION4" id="OPTION4" />  종이세금계산서 20매 미만</input><br><br>
												<input type="checkbox" name="OPTION5" id="OPTION5" />  홈택스에 등록된 신용카드 매입세액 공제</input><br><br>
												<input type="checkbox" name="OPTION6" id="OPTION6" />  배달&온라인등 매출처 집계 3개 이하인 경우</input>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>


						<h2>RPA</h2>
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
											<th>수수료</td>
											<td><input type="box" name="EST_FEE" id="EST_FEE"  /></input></td>
											<th>입금금액</td>
											<td><input type="box" name="DEP_FEE" id="DEP_FEE" /></input></td>
										</tr>
										<tr>
											<th>결제방법</td>
											<td>
												<select  name="DEP_TYPE" id="DEP_TYPE" style="width: 150px;height:30px; border: 1px solid #d6d6d6;">
													<option value="E3004">계좌이체</option>
													<option value="E3005">카드</option>
													<option value="E3006">현금</option>
												</select>
											</td>
											<th>입금일자</td>
											<td><input type="date" name="DEP_DATE" id="DEP_DATE" /></input></td>
										</tr>
										<tr>
											<th>영수증</td>
											<td>
												<input type="radio" NAME="CASH_REC" value="c" checked>  현금영수증
												<input type="radio" NAME="CASH_REC" value="t">  세금계산서
											</td>
											<th>영수일자</td>
											<td><input type="date" name="CASH_REC_DATE" id="CASH_REC_DATE" /></input></td>
										</tr>
										<tr>
											<th>홈택스 수임동의 요청</td>
											<td><input type="date" name="SUBM_DATE" id="SUBM_DATE" /></input></td>
											<th>홈택스 수임</td>
											<td><input type="date" name="SUBM_DATE2" id="SUBM_DATE2" /></input></td>
										</tr>
										<tr>
											<th>자료추출</td>
											<td colspan=3><label name="EXT_DATE" id="EXT_DATE" /></label></td>
											
										</tr>
										<tr>
											<th>첨부 파일</td>
											<td colspan=3><label name="ATTACH_FILE" id="ATTACH_FILE" /></label></td>
											
										</tr>
										<tr>
											<th>회사등록</td>
											<td><input type="date" name="COMP_REG_DATE" id="COMP_REG_DATE" /></input></td>
											<th>신고서 작성담당</td>
											<td><input type="box" name="DEC_REGUSER" id="DEC_REGUSER" /></input></td>
										</tr>
										<tr>
											<th>전자신고 요청</td>
											<td>
												<input type="radio" name="REQ_E_REPORT" value="Y" checked>전자신고 실행
												<input type="radio" name="REQ_E_REPORT" value="N">신고 미실행
											</td>
											<th>전자신고 요청자</td>
											<td><input type="box" name="REQ_USER" id="REQ_USER" /></input></td>
										</tr>
										<tr>
											<th>전자신고 요청일</td>
											<td><input type="date" name="REQ_DATE" id="REQ_DATE" /></input></td>
											<th>전자신고 완료</td>
											<td><input type="date" name="COMP_DATE" id="COMP_DATE" /></input></td>
										</tr>
										<tr>
											<th>전자신고번호</td>
											<td colspan=3><input type="box" name="NUM_E_REPORT" id="NUM_E_REPORT" /></input></td>
											
										</tr>
										<tr>
											<th>접수증/신고서</td>
											<td><label name="REC_REP" id="REC_REP" /></label></td>
											<th>납부서</td>
											<td><label type="box" name="PAYMENT" id="PAYMENT" /></label></td>
										</tr>
										<tr>
											<th>납부서 전달일</td>
											<td><input type="date" name="DEL_DATE_PAYMENT" id="DEL_DATE_PAYMENT" /></input></td>
											<th>납부서 전달방법</td>
											<td><input type="box" name="DEL_TYPE_PAYMENT" id="DEL_TYPE_PAYMENT" /></input></td>
										</tr>
										<tr>
											<th>납부서 확인일</td>
											<td><input type="date" name="CONF_DATE_PAYMENT" id="CONF_DATE_PAYMENT" /></input></td>
											<th>납부서 다운로드</td>
											<td><input type="date" name="DOWN_PAYMENT" id="DOWN_PAYMENT" /></input></td>
										</tr>
										<tr>
											<th>메모</td>
											<td colspan=3><textarea style="border: 1px solid #d6d6d6; width:900px; height:100px;" name="MEMO" id="MEMO" /></textarea></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
							
							
            				<div class="btn w100" style="margin:5px 0 15px; text-align:right;">
            					<button name="action2" id="action2" >등록</button>
            					<button name="list" id="list2">목록</button>
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


fetchUser();

function fetchUser()
{

	var depid = "<?=$depid?>";


	if(depid != "" ){
		if(depid == "D1003" || depid == "D1004" || depid == "D1006" || depid == "D1007" || depid == "D1008" || depid == "D1009" || depid == "D1010" || depid == "D1011" || depid == "D1012" ){
			$("#REG_BRANCH").val(depid).attr("selected","selected");
		}
	}
	
	var action = "select_view_vat";
	var request = new Request();

	var id = request.getParameter("id");

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();
	var time = today.getTime();
	var now = yyyy+""+mm+""+dd;
	var cst_type = "A1002";

	$('#REGDATE').val(moment(today).format('YYYY-MM-DD'));

	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,action:action,cst_type:cst_type},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			$('#COMP_NAME').val(data.COMP_NAME);
			$('#CSTNAME').val(data.CSTNAME);
			$('#BIZ_ID_NUM').val(data.BIZ_ID_NUM);
			$('#RESIDENT_ID').val(data.RESIDENT_ID);
			$('#OPENING_DAY').val(data.OPENING_DAY_);
			//$('#OPENING_DAY').val(moment(today).format(OPENING_DAY));
			$('#BIZ_REG_DATE').val(data.BIZ_REG_DATE_);
			$('#SECTOR').val(data.SECTOR);
			$('#BIZ_CATE').val(data.BIZ_CATE);
			$('#COMP_ADDRESS').val(data.COMP_ADDRESS);
			$('#HomeTaxID').val(data.HomeTaxID);
			$('#HomeTaxPW').val(data.HomeTaxPW);
			$('#COMP_PHONE').val(data.COMP_PHONE);
			$('#RESIDENT_ID').val(data.RESIDENT_ID);
			$('#MOBILE').val(data.MOBILE);
			$('#EMAIL').val(data.EMAIL);
			$('#E_NOTICE_DATE').val(data.E_NOTICE_DATE_);
			$('#DOUZONE_SVR').val(data.DOUZONE_SVR);
			$('#DOUZONE_CODE').val(data.DOUZONE_CODE);
			$('#REG_BRANCH').val(data.REG_BRANCH);
			$('#REGDATE').val(data.REGDATE_);
			$('#REGUSER').val(data.REGUSER);
			//$('#CST_TYPE').val(data.CST_TYPE);
			$("#CST_TYPE").val(data.CST_TYPE).prop("selected", true);

			$('#INF_PATH').val(data.INF_PATH);
			$('#INF_CHANNEL').val(data.INF_CHANNEL);
			$('#UTM_S').val(data.UTM_S);
			$('#UTM_T').val(data.UTM_T);
			$('#UTM_C').val(data.UTM_C);
			$('#UTM').val(data.UTM);
			$('#EST_FEE').val(data.EST_FEE);
			$('#DEP_FEE').val(data.DEP_FEE);
			$('#DEP_TYPE').val(data.DEP_TYPE);
			$('input:radio[name=CASH_REC]:input[value=' + data.CASH_REC+ ']').prop("checked", true);
			$('#DEP_DATE').val(data.DEP_DATE_);
			$('#CASH_REC_DATE').val(data.CASH_REC_DATE_);
			$('#SUBM_DATE').val(data.SUBM_DATE_);
			$('#SUBM_DATE2').val(data.SUBM_DATE2_);
			$('#EXT_DATE').val(data.EXT_DATE_);
			$('#ATTACH_FILE').val(data.ATTACH_FILE);
			$('#COMP_REG_DATE').val(data.COMP_REG_DATE_);
			$('#DEC_REGUSER').val(data.DEC_REGUSER);
			$('input:radio[name=REQ_E_REPORT]:input[value=' + data.REQ_E_REPORT + ']').prop("checked", true);

			$('#REQ_USER').val(data.REQ_USER);
			$('#REQ_DATE').val(data.REQ_DATE_);
			$('#COMP_DATE').val(data.COMP_DATE_);
			$('#NUM_E_REPORT').val(data.NUM_E_REPORT);
			$('#REC_REP').val(data.REC_REP);
			$('#PAYMENT').val(data.PAYMENT);
			$('#DEL_TYPE_PAYMENT').val(data.DEL_TYPE_PAYMENT);
			$('#DEL_DATE_PAYMENT').val(data.DEL_DATE_PAYMENT_);
			$('#CONF_DATE_PAYMENT').val(data.CONF_DATE_PAYMENT_);
			$('#DOWN_PAYMENT').val(data.DOWN_PAYMENT_);
			$('#MEMO').val(data.MEMO);
			$('#ERROR').val(data.ERROR);
			$('#tmp_biz_id').val(data.BIZ_ID);

			fetchUser2('TB100024');

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}



function fetchUser2(flag)
{

	var action = "select_view_vat_ext";
	var request = new Request();

	var id = request.getParameter("id");
	var bizid = $('#tmp_biz_id').val();
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,bizid:bizid,flag:flag, action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			if(flag=="TB100024"){
				console.log(data);
				if(data.OPTION1 =="Y") $("input:checkbox[id='OPTION1']").prop("checked", true);
				if(data.OPTION2 =="Y") $("input:checkbox[id='OPTION2']").prop("checked", true);
				if(data.OPTION3 =="Y") $("input:checkbox[id='OPTION3']").prop("checked", true);
				if(data.OPTION4 =="Y") $("input:checkbox[id='OPTION4']").prop("checked", true);
				if(data.OPTION5 =="Y") $("input:checkbox[id='OPTION5']").prop("checked", true);
				if(data.OPTION6 =="Y") $("input:checkbox[id='OPTION6']").prop("checked", true);
				
			}			
			//alert(data);

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
    $('#list').click(function(){
    	window.location.href="list_RPA_vat.php";
    });
    $('#list2').click(function(){
    	window.location.href="list_RPA_vat.php";
    });




    function modify_(){

    		var request = new Request();
    		var id = request.getParameter("id");
    		var bizid = $('#tmp_biz_id').val();
    		var action = "action_vat_insert";

    		//각 엘리먼트들의 데이터 값을 받아온다.
    		var comp_name = $('#COMP_NAME').val();
    		var biz_id_num = $('#BIZ_ID_NUM').val();
    		var cstname= $('#CSTNAME').val();
    		var resident_id = $('#RESIDENT_ID').val().replace(/-/gi, "");
    		var opening_day= $('#OPENING_DAY').val();
    		var biz_reg_date = $('#BIZ_REG_DATE').val();
    		var sector = $('#SECTOR').val();
    		var biz_cate = $('#BIZ_CATE').val();
    		var comp_address = $('#COMP_ADDRESS').val();
    		var hometaxid = $('#HomeTaxID').val();
    		var hometaxpw = $('#HomeTaxPW').val();
    		var comp_phone = $('#COMP_PHONE').val();
    		var mobile = $('#MOBILE').val();
    		var email = $('#EMAIL').val();
    		var e_notice_date = $('#E_NOTICE_DATE').val();
    		var douzone_svr = $('#DOUZONE_SVR').val();
    		var douzone_code = $('#DOUZONE_CODE').val();

    		var reg_branch = $('#REG_BRANCH').val();
    		var regdate = $('#REGDATE').val();
    		var reguser= $('#REGUSER').val();
    		var cst_type = $("#CST_TYPE").val();

    		
    		var inf_path =  "상세입력";
    		var inf_channel =  $('#INF_CHANNEL').val();
    		var utm_s = $('#UTM_S').val();
    		var utm_t = $('#UTM_T').val();
    		var utm_c = $('#UTM_C').val();
    		var utm = $('#UTM').val();

    		for(var i=1; i<7; i++){
    			if($("input[id=OPTION"+i+"]").is(":checked")){
    				$('#OPTION'+i).val("Y");
    			}
    		}
        		
    		var option1= $('#OPTION1').val().replaceAll("on","");
    		var option2= $('#OPTION2').val().replaceAll("on","");
    		var option3= $('#OPTION3').val().replaceAll("on","");
    		var option4= $('#OPTION4').val().replaceAll("on","");
    		var option5= $('#OPTION5').val().replaceAll("on","");
    		var option6= $('#OPTION6').val().replaceAll("on","");

    		var est_fee = $('#EST_FEE').val();
    		var dep_fee = $('#DEP_FEE').val();
    		var dep_type = $('#DEP_TYPE').val();
    		var dep_date = $('#DEP_DATE').val();
    		var cash_rec = $(":input:radio[name=CASH_REC]:checked").val();

    		var cash_rec_date = $('#CASH_REC_DATE').val();
    		var subm_date = $('#SUBM_DATE').val();
    		var subm_date2 = $('#SUBM_DATE2').val();
    		var comp_reg_date = $('#COMP_REG_DATE').val();
    		var dec_reguser = $('#DEC_REGUSER').val();
    		var req_e_report = $("input[name='REQ_E_REPORT']:checked").val();
    		var req_user = $('#REQ_USER').val();
    		var req_date = $('#REQ_DATE').val();
    		var comp_date = $('#COMP_DATE').val();
    		var num_e_report = $('#NUM_E_REPORT').val();
    		var del_date_payment = $('#DEL_DATE_PAYMENT').val();
    		var del_type_payment = $('#DEL_TYPE_PAYMENT').val();
    		var conf_date_payment = $('#CONF_DATE_PAYMENT').val();
    		var down_payment = $('#DOWN_PAYMENT').val();
    		var memo = $('#MEMO').val();
    		
    				
    		if(cstname !="" && mobile !=""){

    			$.ajax({
    			//insert page로 위에서 받은 데이터를 넣어준다.
    				url:"action.php", 
    				method:"POST",
    				data:{action:action, id:id,bizid:bizid, comp_name:comp_name, biz_id_num:biz_id_num,
    					cstname,cstname,resident_id:resident_id,opening_day:opening_day,
    					biz_reg_date:biz_reg_date,sector:sector,biz_cate:biz_cate,comp_address:comp_address,
    					 hometaxid:hometaxid,hometaxpw:hometaxpw,comp_phone:comp_phone,
    					 mobile:mobile,email:email,e_notice_date:e_notice_date,douzone_svr:douzone_svr,
    					 douzone_code:douzone_code, reg_branch:reg_branch, regdate:regdate,
    					 reguser:reguser,cst_type:cst_type,inf_path:inf_path, inf_channel:inf_channel,
    					 utm_s:utm_s, utm_t:utm_t, utm_c:utm_c, utm:utm, option1:option1, option2:option2
    					 , option3:option3, option4:option4, option5:option5, option6:option6,
    					 est_fee:est_fee,dep_fee:dep_fee,dep_type:dep_type, dep_date:dep_date,
    					 cash_rec:cash_rec, cash_rec_date:cash_rec_date, subm_date:subm_date,
    					 subm_date2:subm_date2,comp_reg_date:comp_reg_date, dec_reguser:dec_reguser,
    					 req_date:req_date, comp_date:comp_date, num_e_report:num_e_report,
    					 del_date_payment:del_date_payment, del_type_payment:del_type_payment,
    					 conf_date_payment:conf_date_payment, down_payment:down_payment,
    					 memo:memo, req_user:req_user,req_e_report:req_e_report},
    				success:function(data){
    					//alert(data);

    					if(data.CSTID != ""){
    						//window.location.href="view_trans.php?id="+id;		
							window.location.href="list_RPA_vat.php";	
    					}else{
    						//window.location.href="list_trans.php";			
    					}

    				}
    			});

    		}else{
    			alert('필수값을 입력해주세요');
    			if(cstname == ""){
    				$('#cstname').focus();
    			}
    			if(mobile== ""){
    				$('#mobile').focus();
    			}
    		}
    }
        


    
});

</script>
</html>