
<?php
include "db_info.php";

include "top.php";

?>	
<style>
.dashboard tbody tr th span{margin:0 0px 0 0px; position: relative; }
.dashboard tbody tr th span::before{ content: '*'; position: absolute; left: -10px; top: -5px; color:rgb(216, 16, 16); }
</style>
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
											<th><span>성명(대표자)</span></th>
											<td><input type="box" name="CSTNAME" id="CSTNAME" /></input></td>
											<th><span>핸드폰</span></th>
											<td><input type="box" name="MOBILE" id="MOBILE" /></input></td>
											
										</tr>
										<tr>
											<th>주민등록번호(대표자)</th>
											<td><input type="box" name="RESIDENT_ID" id="RESIDENT_ID" /></input></td>
											<th>EMAIL</th>
											<td><input type="box" name="EMAIL" id="EMAIL" /></input></td>
										</tr>
										<tr>
											<th>홈택스ID</th>
											<td><input type="box" name="HomeTaxID" id="HomeTaxID" /></input></td>
											<th>홈택스PW</th>
											<td><input type="box" name="HomeTaxPW" id="HomeTaxPW" /></input></td>
										</tr>
										<tr>
											<th>환급은행</th>
											<td>
												<div class="selectbox s50">
            										<label for="">선택</label>
            										<select name="REF_BANK" id ="REF_BANK">
            											<option selected="selected">선택</option>
            											<option value="SC제일은행">SC제일은행</option>
            											<option value="경남은행">경남은행</option>
            											<option value="광주은행">광주은행</option>
            											<option value="국민은행">국민은행</option>
            											<option value="기업은행">기업은행</option>
            											<option value="농협중앙회">농협중앙회</option>
            											<option value="농협회원(지역농협)">농협회원(지역농협)</option>
            											<option value="대구은행">대구은행</option>
            											<option value="부산은행">부산은행</option>
            											<option value="산립조합">산립조합</option>
            											<option value="산업은행">산업은행</option>
            											<option value="상호저축은행">상호저축은행</option>
            											<option value="새마을금고">새마을금고</option>
            											<option value="수협">수협</option>
            											<option value="신한은행">신한은행</option>
            											<option value="우리은행">우리은행</option>
            											<option value="전북은행">전북은행</option>
            											<option value="제주은행">제주은행</option>
            											<option value="카카오뱅크">카카오뱅크</option>
            											<option value="케이뱅크">케이뱅크</option>
            											<option value="하나은행">하나은행</option>
            											<option value="한국씨티은행">한국씨티은행</option>
            										</select>
            									</div>
											</td>
											<th>환금계좌</th>
											<td><input type="box" name="REF_ACC" id="REF_ACC" /></input></td>
										</tr>
										<tr>
											<th>계좌주</th>
											<td><input type="box" name="ACC_HOLDER" id="ACC_HOLDER" /></input></td>
											<th>카카오채널등록여부</th>
											<td>
												<div class="selectbox w50">
            										<label for="">선택</label>
            										<select name="KAKAO_REG" id ="KAKAO_REG" >
            										<option selected value="">선택</option>
            										<option value="Y">Y</option>
            										<option value="N">N</option>
            									</select>
            									</div>
											</td>
										</tr>
										<tr>
											<th>서버(SmartA)</th>
											<td>
													<div class="selectbox s50">
                										<label for="">서버선택</label>
                										<select name="DOUZONE_SVR" id ="DOUZONE_SVR">
                											<option selected="selected">선택</option>
                											<option value="1">1</option>
                											<option value="2">2</option>
                											<option value="3">3</option>
                										</select>
                									</div>
											</td>
											<th>코드(SmartA)</th>
											<td><input type="box" name="DOUZONE_CODE" id="DOUZONE_CODE" /></input></td>
										</tr>
										<tr>
											<th>MEMO</th>
											<td colspan=3><textarea name="MEMO" id="MEMO" cols="90" rows="5" placeholder="사용자기본정보관련 메모" /></textarea></td>
											
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

	//$('#REGDATE').val(moment(today).format('YYYY-MM-DD'));

	
	//users 리스트를 select.php 에서 받아온다.
	/*
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
	*/
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
    	window.location.href="list_RPA_inc.php";
    });
    $('#list2').click(function(){
    	window.location.href="list_RPA_inc.php";
    });


    $('#MOBILE').focusout(function(){
    	var cstname =$('#CSTNAME').val();
    	var mobile =$('#MOBILE').val();
    	var action = "check_cust";

    	if(cstname != "" && mobile != ""){
    		$.ajax({
    			//insert page로 위에서 받은 데이터를 넣어준다.
    				url:"select.php", 
    				method:"POST",
    				data:{action:action, cstname:cstname, mobile:mobile},
    					dataType:"json",
    				success:function(data){
    					//alert(data);

    					if(data.CSTID){
    						alert("이름 : " + cstname + "\n핸드폰: "+mobile+" \n위 정보로 이미 입력된 사용자가 있습니다. \n접수정보 입력화면으로 이동합니다.");
    						window.location.href="view_inc_cst.php?step=2&id="+data.CSTID;
    					}
    				}
    			});
        }
    });


    function modify_(){

    		var request = new Request();
    		//var id = request.getParameter("id");
    		var action = "action_inc_insert";

    		//각 엘리먼트들의 데이터 값을 받아온다.
    		var CSTNAME = $('#CSTNAME').val();
    		var MOBILE= $('#MOBILE').val();
    		var RESIDENT_ID = $('#RESIDENT_ID').val().replace(/-/gi, "");
    		var EMAIL= $('#EMAIL').val();
    		var HomeTaxID = $('#HomeTaxID').val();
    		var HomeTaxPW = $('#HomeTaxPW').val();
    		var REF_BANK = $('#REF_BANK').val();
    		var REF_ACC = $('#REF_ACC').val();
    		var ACC_HOLDER = $('#ACC_HOLDER').val();
    		var DOUZONE_SVR = $('#DOUZONE_SVR').val();
    		var DOUZONE_CODE = $('#DOUZONE_CODE').val();
    		var MEMO = $('#MEMO').val();
    		var KAKAO_REG = $('#KAKAO_REG').val();
    				
    		if(CSTNAME !="" && MOBILE !=""){

    			$.ajax({
    			//insert page로 위에서 받은 데이터를 넣어준다.
    				url:"action.php", 
    				method:"POST",
    				data:{action:action, CSTNAME:CSTNAME, MOBILE:MOBILE,RESIDENT_ID:RESIDENT_ID,EMAIL:EMAIL,
    					HomeTaxID :HomeTaxID , HomeTaxPW:HomeTaxPW, REF_BANK:REF_BANK, REF_ACC:REF_ACC,
    					ACC_HOLDER:ACC_HOLDER, DOUZONE_SVR:DOUZONE_SVR, DOUZONE_CODE:DOUZONE_CODE,
    					MEMO:MEMO,KAKAO_REG:KAKAO_REG},
    					dataType:"json",
    				success:function(data){
    					//alert(data);

    					if(data.CSTID){
    						var con = confirm("기본정보가 입력되었습니다. 접수정보 입력으로 넘어가시겠습니까?");
    						if(con==true){
    							window.location.href="view_inc_cst.php?step=2&id="+data.CSTID;
        						}else{
        							window.location.href="list_RPA_inc.php";	
            					}
 
    					}else{
        					alert("처리중 오류가 발생하였습니다. 관리자에게 문의하셔주세요");
    						//window.location.href="list_RPA_inc.php";			
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