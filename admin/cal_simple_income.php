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
					<!-- <button name="send_kakao" id="send_kakao">알림톡발송</button> -->
					<button name="save" id="save">저장</button>
				</div>
				<div class="boardwrite2" id="boardwrite2">
    				<table style="padding-bottom:100px;">
    					<tbody>
    					<tr class="">
    						<td class="" style="width: 100px;">이름</td>
    						<td class=""><input type="box" id="cstname"></td>
    						<td class="" style="width: 100px;">핸드폰</td>
    						<td class=""><input type="box" id="mobile"></td>
    					</tr>
    					<tr class="">
    						<td class="" style="width: 100px;">홈택스ID</td>
    						<td class=""><input type="box" id="HT_ID" value=""></td>
    						<td class="" style="width: 100px;">홈택스PW</td>
    						<td class=""><input type="box" id="HT_PW" value=""></td>
    					</tr>
    					
    					<tr>
    						<td style="width:350px;height:auto;vertical-align:baseline;" colspan=4>
            					<button id="EXT_INPUT" name="EXT_INPUT"  style="width:100px;height:35px;margin: 0 0 0 0px;cursor:pointer;display:none;">금액추가</button>
            					<br><br><br>
            					<table style="border:1px; height:auto;text-align:center;" id="insert_ext" >
            						<colgroup>
                                		<col width="120px">
                                		<col width="120px">
                                		<col width="120px">
                                		<col width="120px">
                                	</colgroup>
                            		<thead>
                            		<tr>
                        				<th>총 수입금액(원)</th>
                        				<th>경비율(%)</th>
                        				<th>기납부세액총계(원)</th>
                                        <th>소득공제계(원)</th>
                        			</tr>
                            		
                                	</thead>
                					<tbody id="">
                						<tr>
                							
                							<TD>
                								<input type="box" style="width:150px;height:30px;" id="EXT_PAID" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
                							</TD>
                							<td>
                    							<input type="box" style="width:150px;height:30px;" id="EXT_RATIO" onkeypress="return digit_check(event)">
                							</td>
                							<td>
                    							<input type="box" style="width:150px;height:30px;" id="EXT_ADD_TAX" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
                							</td>
                							<td>
                								
                								<input type="box" style="width:150px;height:30px;" name="DEL_PRICE" id="DEL_PRICE" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
                							</td>
                						</tr>
                						<tr><td colspan=4>
                							<button id="BTN_CAL" name="BTN_CAL"  href="#layer2" class="btn-example" style="width:200px;height:35px;margin: 0 0 0 0;cursor:pointer;">수동계산</button>
                						</td></tr>
            						</tbody>
            					</table>
            					<table style="width:290px;height:auto;text-align:center;">
                					<tbody id="result2">
            						</tbody>
            					</table>
    
    						</td>
    					</tr>
    					</tbody>
    				</table>
    				<br><br><br>
    				
    				
				
				<br><br><br>
				</div>
				
				
				
				<div class="boardwrite">
					
					<table>
						<tbody>
							
							<tr class="">
								<td colspan=2 class="txt_st1">구분</td>
								<td class="txt_st1">종합소득세</td>
								<td class="txt_st1">농어촌특별세</td>
								
							</tr>
							<tr >
								<td colspan=2>납부(환급)할 총세액</td>
								<td><B><label id="STEP9"></label></B></td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=4></td>
								
							</tr>
							<tr class="">
								<td colspan=2 class="">종합소득금액</td>
								<td><label id="STEP1"></label></td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>소득공제계</td>
								<td><label id="STEP2"></label></td>
								<td>0</td>
							</tr>
							<tr class="">
								<td colspan=2>과세표준</td>
								<td><label id="STEP3"></label></td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>세율</td>
								<td style="text-align: center;"><label id="STEP4"></label></td>
								<td>0</td>
								
							</tr>
							<tr class="">
								<td colspan=2>산출세액</td>
								<td><label id="STEP5"></label></td>
								<td>0</td>
							</tr>
							<tr >
								<td colspan=2>세액감면</td>
								<td>0</td>
								<td>0</td>
							</tr>
							<tr class="">
								<td colspan=2>세액공제</td>
								<td><label id="STEP6"></label></td>
								<td>0</td>
							</tr>
							<tr>
								<td rowspan=3>결정세액</td>
								<td class="txt_st1">종합과세<br>(23.-24.-25.)</td>
								<td><label id="STEP7"></label></td>
								<td>0</td>
							</tr>
							<tr>
								<td>분리과세</td>
								<td>0</td>
								<td>0</td>
								
							</tr>
							<tr >
								<td>합계 (26 + 27)</td>
								<td><label id="STEP7"></label></td>
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
								<td><label id="STEP7_1"></label></td>
								<td>0</td>
								
							</tr>
							<tr >
								<td colspan=2>기 납 부 세 액 계</td>
								<td><label id="STEP8"></label></td>
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
				
				

				
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="종합소득세 예상세액계산기">
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


	$('#HT_PW').focusout(function() {
		var HT_ID = $("#HT_ID").val();
		var HT_PW = $("#HT_PW").val();

		if(isEmpty(HT_ID) == false && isEmpty(HT_PW) == false){
			var action = "select_json";

			var input_id = HT_ID;
			var input_pw = HT_PW;
			var year = "2021";
			isloading.start();
			$.ajax({
				url:"../tilko/UnitTest/HomeTax_API_1.php",
				method:"POST",
				dataType:"json",
				data:{action:action,input_id:input_id, input_pw:input_pw,year:year},
				success:function(data){

					if(data.Status == "OK" && data.total_paid != null){

						$('#EXT_PAID').val(addCommas(data.total_paid));
						$('#EXT_RATIO').val(addCommas(data.ext_ratio));
						$('#EXT_ADD_TAX').val(addCommas(Math.ceil(data.add_tax)));
						$('#DEL_PRICE').val(addCommas(data.del_price+1500000));
						//$('#etcIncAmtYn').html(data.etcIncAmtYn);
						CAL_AUTO();
							
						
					}else{
						alert("※로그인실패\n\n1)종합소득세 대상자가 아니거나\n2)법인이거나 \n3)로그인단계에 보안카드가 설정되어있습니다. \n홈택스에 직접 로그인하여 확인이 필요합니다.\n\n홈택스 상세메시지 : ["+data.Message+"]");
					}

					isloading.stop();
				}
			})
		}
		
	});

	$('#save').click(function(){
		var request = new Request();
		
		
		
		var action = "action_insert_tb100010_1";

		//각 엘리먼트들의 데이터 값을 받아온다.
		var CSTNAME = $('#cstname').val();
		var MOBILE = $('#mobile').val();
		var HT_ID= $('#HT_ID').val();
		var HT_PW= $('#HT_PW').val();
		var AMOUNT_PAID = $('#AMOUNT_PAID').val();
		var SIM_RATIO_N = $('#SIM_RATIO_N').val();
		var SIM_RATIO_S = $('#SIM_RATIO_S').val();
		var SEC_CODE = $('#SEC_CODE').val();
		var NPIP = $('#NPIP').val();		
		var EXP_PAY_TAX = $('#EXP_PAY_TAX').val();

		if(cstname !="" && mobile !=""){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{action:action},
				success:function(data){
					console.log(data);
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
	});
	

	//수정
	$('#update').click(function(){
		update_();
	});
	$('#update2').click(function(){
		update_();
	});


	$('#BTN_CAL').on('click', function(e){
		CAL_AUTO();
	});
});


function CAL_AUTO(){
	var total_money =  $("#EXT_PAID").val() ;
	var ratio = 100- $("#EXT_RATIO").val() ;
	var result_step1 = Math.round(uncomma(total_money) * (ratio/100)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step2 = $("#DEL_PRICE").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step3 = ( uncomma(result_step1) - uncomma(result_step2) ).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step8 = $("#EXT_ADD_TAX").val();
	
	

	//alert(result_step1);
	$("#STEP1").html(result_step1);
	$("#STEP2").html(result_step2);
	
	if(uncomma(result_step3) < 0){
		result_step3 = 0;
		$("#STEP3").html("0");
		$("#STEP6").html("0");
	}else{
		$("#STEP3").html(result_step3);
		$("#STEP6").html("70,000");
	}

	cal_tax_avr(uncomma(result_step1) - uncomma(result_step2));
	cal_step3_new(uncomma(result_step3.toString()));
	

	var result_step7 = (uncomma( $("#STEP5").html() ) -uncomma( $("#STEP6").html() ) ).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') ;
	if(uncomma(result_step7) < 0){
		result_step7 = 0;
	}
	$("#STEP7").html( result_step7 );
	$("#STEP7_1").html( result_step7 );
	$("#STEP8").html( result_step8 );


	if(result_step7!=0)
		var result_step9 = uncomma(result_step7) - uncomma( $("#EXT_ADD_TAX").val() );
	else
		var result_step9 = result_step7 - uncomma( $("#EXT_ADD_TAX").val() );
	
	$("#STEP9").html( result_step9.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') );
}

function isEmpty(str){
    
    if(typeof str == "undefined" || str == null || str == "")
        return true;
    else
        return false ;
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

function removeChar(event) { 
	event = event || window.event; 
	var keyID = (event.which) ? event.which : event.keyCode; 
	if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 ) { 
		return; 
	} else { //숫자만 입력 
		event.target.value = event.target.value.replace(/[^0-9]/g, ""); 
	} 
}

function comma(obj) { 
	var regx = new RegExp(/(-?\d+)(\d{3})/); 
	var bExists = obj.indexOf(".", 0); 
	var strArr = obj.split('.'); 
	while (regx.test(strArr[0])) { 
		strArr[0] = strArr[0].replace(regx, "$1,$2"); 
	} 

	if (bExists > -1) { 
		obj = strArr[0] + "." + strArr[1]; 
	} else { 
		obj = strArr[0]; 
	} 

	return obj; 
}

function uncomma(str) { 
	str = "" + str.replace(/,/gi, ''); 
	str = str.replace(/(^\s*)|(\s*$)/g, ""); 
	return (new Number(str));//문자열을 숫자로 반환 
}

function inputNumberFormat(obj) { 
	obj.value = comma(obj.value); 
}

function cal_tax_avr(P_TOTAL){

	if(P_TOTAL <= 12000000){
		$("#STEP4").html("6%");
	}else if(P_TOTAL > 12000000 && P_TOTAL <= 46000000){
		$("#STEP4").html("15%");
	}else if(P_TOTAL > 46000000 && P_TOTAL <= 88000000){
		$("#STEP4").html("24%");
	}else if(P_TOTAL > 88000000 && P_TOTAL <= 150000000){
		$("#STEP4").html("35%");
	}else if(P_TOTAL > 150000000 && P_TOTAL <= 300000000){
		$("#STEP4").html("38%");
	}else if(P_TOTAL > 300000000 && P_TOTAL <= 500000000){
		$("#STEP4").html("40%");
	}else if(P_TOTAL > 500000000 && P_TOTAL <= 1000000000){
		$("#STEP4").html("42%");
	}else if(P_TOTAL > 1000000000 ){
		$("#STEP4").html("45%");
	}	
}


function cal_step3_new(TOTAL3){
	if( TOTAL3 <= 12000000 ){
		$("#STEP5").html( TOTAL3 * 6 /100 );
	}else if(TOTAL3 > 12000000 && TOTAL3 <= 46000000){
		$("#STEP5").html( (TOTAL3 * 15/100)  - 1080000 );
	}else if(TOTAL3 > 88000000 && TOTAL3 <= 150000000){
		$("#STEP5").html( ( TOTAL3 * 24/100 ) - 5220000 );
	}else if(TOTAL3 > 88000000 && TOTAL3 <= 150000000 ){
		$("#STEP5").html( ( TOTAL3 * 35 /100 ) - 14900000 );
	}else if(TOTAL3 > 150000000 && TOTAL3 <= 300000000 ){
		$("#STEP5").html( ( TOTAL3 *  38 /100 ) - 19400000 );
	}else if( TOTAL3 > 300000000 && TOTAL3 <= 500000000 ){
		$("#STEP5").html( ( TOTAL3 * 40 /100 ) - 25400000 );
	}else if( TOTAL3 > 500000000 && TOTAL3 <= 1000000000 ){
		$("#STEP5").html( TOTAL5 = ( TOTAL3 * 42 /100 ) - 35400000 );
	}else if( TOTAL3 > 1000000000  ){
		$("#STEP5").html( ( TOTAL3 * 45 /100 ) - 65400000 );
	}

	//.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
	$("#STEP5").html( Math.ceil($("#STEP5").html()).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') );
}


</script>


</html>