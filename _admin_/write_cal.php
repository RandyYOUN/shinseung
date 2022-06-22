<?php
include "db_info.php";
include "session_inc.php";
   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
session_start();

if($jb_login == false){
	$str = "";
	$str .= '<script>alert("세션이 만료되어 로그인페이지로 이동합니다.");';
	$str .= 'document.location.replace("login.php");</script>';

	echo $str;
}

include "top.php";

?>		
<div class="wrap">
		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title">종합소득세 예상납부세액 & 수수료 계산기 
				</h1>
			</div>
			
			<div class="conwrap">
				<h2 class="w100"><span style="color:red;">공제항목을 제외한 모든 항목은 수정시 바로 "<b>저장</b>" 됩니다.</span></h2>
				
				<div class="board">
				
				<table style="width:1550px;">
					<tr>
						<td style="width:757px; border-right:0px;text-align:center;">
								<table style="width:1050px;text-align:center;align:center;">
            						<tbody id="result">
                						<colgroup>
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    	</colgroup>
                                		<thead>
                                		<tr>
                                			<th><span style="content: '*'; color:rgb(216, 16, 16); ">*</span>&nbsp;성명</th>
                                			<th><span style="content: '*'; color:rgb(216, 16, 16); ">*</span>&nbsp;핸드폰번호</th>
                                			<th>홈택스ID</th>
                                			<th >홈택스PW</th>
                                            <th>안내유형</th>
                                            <th>지점</th>
                                			<th >상담자</th>
                                		</tr>
                                		
                                    	</thead>
                                    	<tr >
                                			<td>
                                				<div name="CSTNAME" id="CSTNAME" style="width:140px;height:25px;padding-top:8px;"  onclick="javascript:switch_comp(this);" /></div>
                                				<input type="box2" tabindex="1" id="CSTNAME_INPUT" NAME="CSTNAME_INPUT"  style="display: none;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27 || event.keyCode==9)memo_submit(this);">
                                			</td>
                                			<td>
                                				<div name="MOBILE" id="MOBILE" style="width:140px;height:25px;padding-top:8px;"  onclick="javascript:switch_comp(this);" /></div>
                                				<input type="box2" tabindex="2" id="MOBILE_INPUT" NAME="MOBILE_INPUT" style="display: none;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27 || event.keyCode==9)memo_submit(this);">
                                			</td>
                                			<td>
                                				<div name="HOMETAXID" id="HOMETAXID" style="width:140px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this);"  /></div>
                                				<input type="box2" tabindex="3" id="HOMETAXID_INPUT" NAME="HOMETAXID_INPUT" style="display: none;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27 || event.keyCode==9)memo_submit(this);">
                                			</td>
                                			<td>
                                				<div name="HOMETAXPW" id="HOMETAXPW" onclick="javascript:switch_comp(this);" style="width:140px;height:25px;padding-top:8px;"   /></div>
                                				<input type="box2" tabindex="4" id="HOMETAXPW_INPUT" NAME="HOMETAXPW_INPUT" style="display: none;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27 || event.keyCode==9)memo_submit(this);">
                                			</td>
                                			<td>
                                					<div name="INFO_TYPE" id="INFO_TYPE" style="width:140px;height:25px;padding-top:8px;"  onclick="javascript:switch_comp(this);"  /></div>
                                					<input type="box2" tabindex="5" id="INFO_TYPE_INPUT" NAME="INFO_TYPE_INPUT" style="display: none;" onKeypress="javascript:memo_submit(this);">
                                					<!-- select style="align:center;width:100px;height:35px;" id="INFO_TYPE" name="INFO_TYPE" onchange="javascript:modify_option(this);">
                                                        <option value="" selected>선택</option>
                                                        <option value="F">F</option>
                                                        <option value="G">G</option>
                                                        <option value="H">H</option>
                                                    </select-->
                                			</td>
                                			<td>
                            						<select name="REG_BRANCH_INPUT" id="REG_BRANCH_INPUT">
                            							<option value="">지점선택</option>
                            							<option value="D1019">세무톡</option>
                            							<option value="D1003">강남</option>
                            							<option value="D1002">회계본부</option>
                            							<option value="D1014">영업본부</option>
                            							<option value="D1013">세무본부</option>
                            							<option value="D1004">용인</option>
                            							<option value="D1006">안양</option>
                            							<option value="D1007">수원</option>
                            							<option value="D1008">일산</option>
                            							<option value="D1009">부천</option>
                            							<option value="D1010">광주</option>
                            							<option value="D1011">분당</option>
                            							<option value="D1012">기흥</option>
                            							<option value="D1021">동탄</option>
                            						</select>
                                			</td>
                                			<td>
                                				<select id="REGUSER_INPUT" name="REGUSER_INPUT" style="align:center;width:140px;height:35px;" onchange="javascript:modify_option(this);">
                                                </select>
                                                
                                			</td>
                                		</tr>
                                		
            						</tbody>
            					</table><br>
            					<table style="width:1050px;">
            						<tbody id="result">
                						<colgroup>
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    		<col width="150px">
                                    	</colgroup>
                                		<thead>
                                		<tr>
                                			<th>타소득유무</th>
                                			<th>이자</th>
                                			<th>배당</th>
                                			<th>근로 단일</th>
                                			<th >근로 복수</th>
                                            <th>연금</th>
                                			<th >기타</th>
                                		</tr>
                                    	</thead>
                                    	<tr>
                                			<td style="text-align:center;">해당여부</td>
                                			<td>
                                					<select style="align:center;width:100px;height:35px;" id="INTEREST" name="INTEREST" onchange="javascript:modify_option(this);">
                                                        <option value="Y">Y</option>
                                                        <option value="N" selected>N</option>
                                                    </select>
                                			</td>
                                			<td>
                                					<select style="align:center;width:100px;height:35px;" id="ALLOCATION" name="ALLOCATION" onchange="javascript:modify_option(this);">
                                                        <option value="Y">Y</option>
                                                        <option value="N" selected>N</option>
                                                    </select>
                                			</td>
                                			<td>
                                					<select style="align:center;width:100px;height:35px;" id="WORK_SINGLE" name="WORK_SINGLE" onchange="javascript:modify_option(this);">
                                                        <option value="Y">Y</option>
                                                        <option value="N" selected>N</option>
                                                    </select>
                                			</td>
                                			<td>
                                					<select style="align:center;width:100px;height:35px;" id="WORK_PLUR" name="WORK_PLUR" onchange="javascript:modify_option(this);">
                                                        <option value="Y">Y</option>
                                                        <option value="N" selected>N</option>
                                                    </select>
                                			</td>
                                			<td>
                                					<select style="align:center;width:100px;height:35px;" id="INFORMAL" name="INFORMAL" onchange="javascript:modify_option(this);">
                                                        <option value="Y">Y</option>
                                                        <option value="N" selected>N</option>
                                                    </select>
                                			</td>
                                			<td>
                                					<select style="align:center;width:100px;height:35px;" id="ETC" name="ETC" onchange="javascript:modify_option(this);">
                                                        <option value="Y">Y</option>
                                                        <option value="N" selected>N</option>
                                                    </select>
                                			</td>
                                		</tr>
                                		
            						</tbody>
            					</table>
            					<br>
            					<table style="width:1050px;text-align:center;" >
            						<tr>
            							<td  style="width:600px;text-align:center;vertical-align:baseline;">
            									<table style="width:600px;text-align:center;">
                            						<tbody id="result">
                                						<colgroup>
                                                    		<col width="150px">
                                                    		<col width="150px">
                                                    		<col width="75px">
                                                    		<col width="75px">
                                                    		<col width="150px">
                                                    	</colgroup>
                                                		<thead>
                                                		<tr>
                                                			<th>(자동)예상 납부세액</th>
                                                			<th>(자동)예상수수료</th>
                                                			<th colspan=2>알림톡 발송</th>
                                                			<th>진행단계</th>
                                                		</tr>
                                                    	</thead>
                                                    	<tr>
                                                			<td>
                                                				<div name="EXP_PAY_TAX" id="EXP_PAY_TAX"  style="font-weight:bolder; font-size:17px; " /></div>
                                                			</td>
                                                			<td>
                                                				<div name="EST_FEE" id="EST_FEE" style="width:140px;height:25px;padding-top:8px;font-weight:bolder; font-size:17px;" /></div>
                                								
                                                			</td>
                                                			<td >
                                                    			<span id="send_kakao_1_y" style="padding: 0 20px 5px 0px;"><A href="javascript:send_kakao('self_1_A');">발송1</A></span>
                                                    			<span id="send_kakao_1_n" >발송1</span>
                                                			</td>
                                                			<td>
                                                    			<span  id="send_kakao_2_y"><A href="javascript:send_kakao('self_2_A');">발송2</A></span>
                                                    			<span id="send_kakao_2_n">발송2</span>
                                                			</td>
                                                			<td>
                                                					<select style="width:100px;height:35px; text-align:center;" id="PROGRESS" name="PROGRESS" onchange="javascript:modify_option(this);">
                                                                        <option value="" selected>전체</option>
                                                                        <option value="E7201" >등록</option>
                                                                        <option value="E7202" >계산</option>
                                                                        <option value="E7203" >검토</option>
                                                                        <option value="E7204" >부재</option>
                                                                        <option value="E7205" >불가</option>
                                                                        <option value="E7206" >의뢰</option>
                                                                        <option value="E7207" >유력</option>
                                                                        <option value="E7208" >수임</option>
                                                                        <option value="E7209" >환불</option>
                                                                  </select>
                                                			</td>
                                                		</tr>
                            						</tbody>
                            					</table>
                            					<br>
                            					<table style="width:600px;text-align:center;">
                            						<tbody id="result">
                                						<colgroup>
                                                    		<col width="150px">
                                                    		<col width="150px">
                                                    		<col width="75px">
                                                    		<col width="75px">
                                                    		<col width="150px">
                                                    	</colgroup>
                                                		<thead>
                                                		<tr>
                                                			<th>(수동)예상 납부세액</th>
                                                			<th>(수동)예상수수료</th>
                                                			<th colspan=2>알림톡 발송</th>
                                                			<th></th>
                                                		</tr>
                                                    	</thead>
                                                    	<tr>
                                                			<td>
                                                				<div name="EXP_PAY_TAX_SELF" id="EXP_PAY_TAX_SELF"  style="width:140px;height:25px;font-weight:bolder; font-size:17px; " onclick="javascript:switch_comp(this);" /></div>
                                                				<input type="box2" tabindex="3" id="EXP_PAY_TAX_SELF_INPUT" NAME="EXP_PAY_TAX_SELF_INPUT" style="display: none;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27 || event.keyCode==9)memo_submit(this);">
                                                			</td>
                                                			<td>
                                                				<div name="EST_FEE_SELF" id="EST_FEE_SELF" style="width:140px;height:25px;padding-top:8px;font-weight:bolder; font-size:17px;" onclick="javascript:switch_comp(this);"  /></div>
                                								<input type="box2" tabindex="3" id="EST_FEE_SELF_INPUT" NAME="EST_FEE_SELF_INPUT" style="display: none;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27 || event.keyCode==9)memo_submit(this);">
                                                			</td>
                                                			<td >
                                                    			<span id="send_kakao_1_self_y" style="padding: 0 20px 5px 0px;"><A href="javascript:send_kakao('self_1_S');">발송1</A></span>
                                                    			<span id="send_kakao_1_self_n" >발송1</span>
                                                			</td>
                                                			<td>
                                                    			<span  id="send_kakao_2_self_y"><A href="javascript:send_kakao('self_2_S');">발송2</A></span>
                                                    			<span id="send_kakao_2_self_n">발송2</span>
                                                			</td>
                                                			<td></td>
                                                		</tr>
                            						</tbody>
                            					</table>
                            					<BR>
                            					<table style="width:600px;height:400px;text-align:center;">
                            						<tbody id="result">
                                						<colgroup>
                                                    		<col width="600px">
                                                    	</colgroup>
                                                		<thead>
                                                		<tr>
                                                			<th>문서복사용(Ctrl+C)
                                                			</th>
                                                		</tr>
                                                    	</thead>
                                                    	<tr>
                                                			<td id="test_txt"><br><pre>
■ 예상납부세액</pre>
<label name="EXP_PAY_TAX2" id="EXP_PAY_TAX2" /></label> 원<BR><BR><BR>
<pre>
예상 납부세액이 마이너스이면 환급금액입니다. 
예상 납부세액은 사업소득 기준 계산된 세액이며,
[타소득여부]에 따라 실제 신고시에는 다소 상이할 수 있습니다. 


■ 신고대행 수수료 </pre>
<label name="EST_FEE2" id="EST_FEE2" /></label> 원<BR><BR>
<pre>
신고대행 수수료는 서류 검토 후 조정될 수 있습니다. 
이점 양해부탁드립니다


▶ 신고대행을 의뢰하시려면 
아래의 카톡 링크를 클릭하셔서 
♥ 사장님 성함을 적어주십시오. 

신고담당자가 수수료 입금계좌 및 추가 필요서류를 안내해드리겠습니다. 
</pre><BR>
<label name="KAKAO_URL_BRANCH" id="KAKAO_URL_BRANCH" /></label>
<BR><BR>
                                                                
                                                                <br>                             			
                                                			</td>
                                                		</tr>
                            						</tbody>
                            					</table>
            							</td>
            							<td style="width:440px;text-align:center;vertical-align:baseline;">
            									<table style="width:440px;text-align:center;" id="tbl_ext1" name="tbl_ext1">
                            						<tbody id="result">
                                						<colgroup>
                                                    		<col width="145px">
                                                    		<col width="145px">
                                                    		<col width="145px">
                                                    	</colgroup>
                                                		<thead>
                                                		<tr>
                                                			<th colspan=2>구분</th>
                                                			<th>납입액(원)</th>
                                                		</tr>
                                                    	</thead>
                                                    	<tr>
                                                			<td colspan=2>중간예납세액</td>
                                                			<td>
                                                				<label id="EXI_TAX" name="EXI_TAX" style="width:130px;height:25px;padding-top:8px;"   onclick="javascript:switch_comp2(this);"></label>
                                                				<input type="box2" id="EXI_TAX_INPUT" NAME="EXI_TAX_INPUT"  style="width:130px;display: none;" onkeyup="javascript:inputNumberAutoComma(this);">                   					
                                                			</td>
                                                		</tr>
                                                		<tr>
                                                			<td rowspan=3>소득공제항목</td>
                                                			<td>국민연금보험료</td>
                                                			<td>
                                                				<label id="NPIP" name="NPIP" style="width:130px;height:25px;padding-top:8px;"   onclick="javascript:switch_comp2(this);"></label>
                                                				<input type="box2" id="NPIP_INPUT" NAME="NPIP_INPUT"  style="width:130px;display: none;" onkeyup="javascript:inputNumberAutoComma(this);">  
                                                			</td>
                                                		</tr>
                                                		<tr>
                                                			<td>개인연금저축</td>
                                                			<td>
                                                				<label id="PERSON_SAVE" name="PERSON_SAVE" style="width:130px;height:25px;padding-top:8px;"   onclick="javascript:switch_comp2(this);"></label>
                                                				<input type="box2" id="PERSON_SAVE_INPUT" NAME="PERSON_SAVE_INPUT"  style="width:130px;display: none;"  onkeyup="javascript:inputNumberAutoComma(this);">  
                                                			</td>
                                                		</tr>
                                                		<tr>
                                                			<td>노란우산공제</td>
                                                			<td>
                                                				<label id="SMALL_BIZ_DED" name="SMALL_BIZ_DED" style="width:130px;height:25px;padding-top:8px;"   onclick="javascript:switch_comp2(this);"></label>
                                                				<input type="box2" id="SMALL_BIZ_DED_INPUT" NAME="SMALL_BIZ_DED_INPUT"  style="width:130px;display: none;" onkeyup="javascript:inputNumberAutoComma(this);" >  
                                                			</td>
                                                		</tr>
                                                		<tr>
                                                			<td rowspan=2>세액공제항목</td>
                                                			<td>퇴직연금세액공제</td>
                                                			<td>
                                                				<label id="RET_SAVE" name="RET_SAVE" style="width:130px;height:25px;padding-top:8px;"   onclick="javascript:switch_comp2(this);"></label>
                                                				<input type="box2" id="RET_SAVE_INPUT" NAME="RET_SAVE_INPUT"  style="width:130px;display: none;" onkeyup="javascript:inputNumberAutoComma(this);" >  
                                                			</td>
                                                		</tr>
                                                		<tr>
                                                			<td>연금계좌세액공제</td>
                                                			<td>
                                                				<label id="PEN_SAVE" name="PEN_SAVE" style="width:130px;height:25px;padding-top:8px;"   onclick="javascript:switch_comp2(this);"></label>
                                                				<input type="box2" id="PEN_SAVE_INPUT" NAME="PEN_SAVE_INPUT"  style="width:130px;display: none;" onkeyup="javascript:inputNumberAutoComma(this);">
                                                			  
                                                			</td>
                                                		</tr>
                            						</tbody>
                            					</table>
                            						<button name="action_tb300031" id="action_tb300031" style="border:1px; width:440px;height:30px;display:none; background-color:black; color:aliceblue;">공제항목 저장</button>
                            						<br>
                            					<br>
                            					<table style="width:440px;height:400px;">
                            						<tbody id="result">
                                						<colgroup>
                                                    		<col width="400px">
                                                    	</colgroup>
                                                		<thead>
                                                		<tr>
                                                			<th style="text-align:center;">
                                                			<font style="width:50px;margin:5px;">메모</font>
                                                			<button id = "memo_save" name="memo_save" style="border:1px solid;background:#444;color:#fff;width:50px;display:none;">저장</button>
                                                			</th>
                                                			
                                                		</tr>
                                                    	</thead>
                                                    	<tr>
                                                			<td>
                                                				<div id="MEMO" name="MEMO" onclick="javascript:switch_comp(this);" style="width:400px;height:100px;margin:5px;"></div>
                                                				<textarea rows="10" cols="60" id="MEMO_INPUT" name="MEMO_INPUT" style="display: none;margin:5px;" ></textarea>
                                                			</td>
                                                		</tr>
                            						</tbody>
                            					</table><br>
                            					
            							</td>
            						</tr>
            					</table>
						</td>
						<td style="width:350px;height:auto;vertical-align:baseline;">
								<table style="width:290px;height:auto;text-align:center;">
                					<tbody id="result2">
            						</tbody>
            					</table>
            					<br>
            					<button id="EXT_INPUT" name="EXT_INPUT"  style="width:100px;height:35px;margin: 0 0 0 0px;cursor:pointer;display:none;">금액추가</button>
            					<br><br><br>
            					<table style="width:290px;height:auto;text-align:center;display:none;" id="insert_ext" >
            					<colgroup>
                                		<col width="40px">
                                		<col width="120px">
                                		<col width="70px">
                                	</colgroup>
                            		<thead>
                            		<tr>
                            			<th >인적용역</th>
                            			<th >수입금액</th>
                            			<th>경비율</th>
                            		</tr>
                                	</thead>
                					<tbody id="">
                						<tr>
                							<TD>
                								<input type="CHECKBOX" style="width:35px;height:20px;" id="EXT_HUMAN">
                							</TD>
                							<td>
                    							<input type="box" style="width:105px;height:30px;" id="EXT_PAID" onkeyup="javascript:inputNumberAutoComma(this);">
                							</td>
                							<td>
                								<input type="box" style="width:45px;height:30px;" id="EXT_RATIO" onkeypress="return digit_check(event)">
                							</td>
                						</tr>
                						<tr><td colspan=3>
                							<button id="EXT_INSERT" name="EXT_INSERT"  href="#layer2" class="btn-example" style="width:100px;height:35px;margin: 0 0 0 0;cursor:pointer;">저장</button>
                						</td></tr>
            						</tbody>
            					</table>

						</td>
					</tr>
				</table>
<br><br><br><br>				
				</div>

				

				
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	
	
	<input type="hidden" name="id" id="user_id" />
	<input type="hidden" name="reg_branch" id="reg_branch" />
	<input type="hidden" name="copy_txt" id="copy_txt" value=""/>
	<input type="hidden" name="fix_it" id="fix_it" value=""/>

</body>
<script>
function replaceAll(str, searchStr, replaceStr) {

	   return str.split(searchStr).join(replaceStr);
	}


function inputNumberAutoComma(obj) {

    // 콤마( , )의 경우도 문자로 인식되기때문에 콤마를 따로 제거한다.
    var deleteComma = obj.value.replace(/\,/g, "");

    // 콤마( , )를 제외하고 문자가 입력되었는지를 확인한다.
    if(isFinite(deleteComma) == false) {
        alert("문자는 입력하실 수 없습니다.");
        obj.value = "";
        return false;
    }
   
    // 기존에 들어가있던 콤마( , )를 제거한 이 후의 입력값에 다시 콤마( , )를 삽입한다.
    obj.value = inputNumberWithComma(inputNumberRemoveComma(obj.value));
	
	
}

// 천단위 이상의 숫자에 콤마( , )를 삽입하는 함수
function inputNumberWithComma(str) {

    str = String(str);
    return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, "$1,");
}

// 콤마( , )가 들어간 값에 콤마를 제거하는 함수
function inputNumberRemoveComma(str) {

    str = String(str);
    return str.replace(/[^\d]+/g, "");
}


$('#EXT_INPUT').click(function(){
	$('#insert_ext').show();    
});


function keycheck(evt){
    var keyCode = evt.which?evt.which:event.keyCode;
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


$(document).ready(function(){

	var depid = "<?=$depid?>";
	

	if(depid != "" ){
		if(depid == "D1003" || depid == "D1004" || depid == "D1006" || depid == "D1007" || depid == "D1008" || depid == "D1009" || depid == "D1010" || depid == "D1011" || depid == "D1012" ){
			$("#reg_branch").val(depid);
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

fetchUser();
fetchUser2();

var select = $('select');
    for (var i = 0; i < select.length; i++) {
        var idxData = select.eq(i).children('option:selected').text();
        select.eq(i).siblings('label').text(idxData);
    }
    select.change(function () {
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });




    $("#CSTNAME_INPUT").focusout(
	function(){
			modify_();
			//fetchUser();
			$("#CSTNAME_INPUT").hide();
			$("#CSTNAME").show();
	});

	$("#MOBILE_INPUT").focusout(
	function(){
			modify_();
			//fetchUser();
			$("#MOBILE_INPUT").hide();
			$("#MOBILE").show();
	});

	$("#HOMETAXID_INPUT").focusout(
	function(){
			modify_();
			//fetchUser();
			$("#HOMETAXID_INPUT").hide();
			//$("#HOMETAXID").show();
			document.getElementById("HOMETAXID").style.display="";
	});

	$("#HOMETAXPW_INPUT").focusout(
	function(){
			modify_();
			//fetchUser();
			$("#HOMETAXPW_INPUT").hide();
			$("#HOMETAXPW").show();
	});

	$("#INFO_TYPE_INPUT").focusout(
	function(){
			modify_();
			//fetchUser();
			$("#INFO_TYPE_INPUT").hide();
			$("#INFO_TYPE").show();
	});
	
	$("#EST_FEE_SELF_INPUT").focusout(
	function(){
			modify_();
			//fetchUser();
			$("#EST_FEE_SELF_INPUT").hide();
			$("#EST_FEE_SELF").show();
	});

	$("#EXP_PAY_TAX_SELF_INPUT").focusout(
	function(){
			modify_();
			//fetchUser();
			$("#EXP_PAY_TAX_SELF_INPUT").hide();
			$("#EXP_PAY_TAX_SELF").show();
	});

	
    	
    $("#REG_BRANCH_INPUT").change(
    		function(){
    			var request = new Request();
    			var id = request.getParameter("id");
    			if(id == ""){
    				alert("이름/핸드폰번호를 먼저 입력 후 고객등록이 되어야합니다.");
    				return false;
    			}else{
    				ck_branch();
        			modify_();	
    			}
    			
    		});
    
    $("#REGUSER_INPUT").change(
    		function(){
    			modify_();
    			//fetchUser();
    		});
    		
    $("#memo_save").click(
    		function(){
    			
    			$("#memo_save").hide();
    			
    			modify_();
    			//fetchUser();
    			$("#MEMO_INPUT").hide();
    			$("#MEMO").show();
    		});
    			


	$("#action_tb300031").click(
		function(){

			var EXI_TAX = replaceAll( $('#EXI_TAX_INPUT').val() , ',' , '' );
			var NPIP =  replaceAll( $('#NPIP_INPUT').val(), ',' , '' );
			var PERSON_SAVE = replaceAll( $('#PERSON_SAVE_INPUT').val(), ',' , '' );
			var SMALL_BIZ_DED = replaceAll( $('#SMALL_BIZ_DED_INPUT').val(), ',' , '' );
			var RET_SAVE = replaceAll( $('#RET_SAVE_INPUT').val(), ',' , '' );
			var PEN_SAVE = replaceAll( $('#PEN_SAVE_INPUT').val(), ',' , '' );

			var action = "action_tb300031_insert";
			var request = new Request();
			var id = request.getParameter("id");
			//var con = confirm("공제액 수정 및 저장은 1회만 가능합니다. 주의해서 입력하세요.\n저장하시겠습니까?");

			//if(con){
				if(id != "" ){
					$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
						url:"action.php", 
						method:"POST",
						data:{id:id,action:action,EXI_TAX:EXI_TAX, NPIP:NPIP, PERSON_SAVE:PERSON_SAVE,
							SMALL_BIZ_DED:SMALL_BIZ_DED, RET_SAVE:RET_SAVE, PEN_SAVE:PEN_SAVE  },
						success:function(data){
							console.log(data);
							fetchUser();
							$("#EXI_TAX_INPUT").hide();
							$("#NPIP_INPUT").hide();
							$("#PERSON_SAVE_INPUT").hide();
							$("#SMALL_BIZ_DED_INPUT").hide();
							$("#RET_SAVE_INPUT").hide();
							$("#PEN_SAVE_INPUT").hide();
							$("#EXI_TAX").show();
							$("#NPIP").show();
							$("#PERSON_SAVE").show();
							$("#SMALL_BIZ_DED").show();
							$("#RET_SAVE").show();
							$("#PEN_SAVE").show();
							$("#action_tb300031").hide();
							
							$("#tbl_ext1").css("border","");
							$("#tbl_ext1").css("border-style","");
						}
					});
				}
			//}
	});



	$("#EXT_INSERT").click(
		function(){

			var EXT_PAID= replaceAll($('#EXT_PAID').val(),',','');
			var EXT_RATIO= $('#EXT_RATIO').val();
			var EXT_HUMAN= "";

			if($('input:checkbox[id="EXT_HUMAN"]').is(":checked") == true){
				EXT_HUMAN= "Y";
			}
			
			var action = "action_tb300020_insert";
			var request = new Request();
			var id = request.getParameter("id");
			
			if(id != "" ){
				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"action.php", 
					method:"POST",
					data:{id:id,action:action,EXT_PAID:EXT_PAID,EXT_RATIO:EXT_RATIO ,EXT_HUMAN:EXT_HUMAN },
					success:function(data){
						console.log(data);
						fetchUser();
						fetchUser2();
						$("#EXT_INPUT").show();
						$('#EXT_PAID').val('');
						$('#EXT_RATIO').val('');
						$("#insert_ext").hide();
					}
				});
			}
		
	});

			

});


function memo_submit(obj){ // 엔터저장
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("_INPUT","");
	
	if(event.keyCode==13 || event.keyCode==9){
	 	modify_();
	 	$(obj).hide();
    	document.getElementById(id).style.display="";
	 	
		}
}

function ck_branch(){

	var request = new Request();
	var id = request.getParameter("id");
	
	var branch = $("#REG_BRANCH_INPUT").val();
	$("#REGUSER_INPUT").empty();
	switch(branch){
	case "D1019" : 
		$("#REGUSER_INPUT").append("<option value='1231'>신승01</option>");
		$("#REGUSER_INPUT").append("<option value='1232'>신승02</option>");
		$("#REGUSER_INPUT").append("<option value='1233'>신승03</option>");
		$("#REGUSER_INPUT").append("<option value='1234'>신승04</option>");
		$("#REGUSER_INPUT").append("<option value='1235'>신승05</option>");
		$("#REGUSER_INPUT").append("<option value='1236'>신승06</option>");
		$("#REGUSER_INPUT").append("<option value='1237'>신승07</option>");
		$("#REGUSER_INPUT").append("<option value='1238'>신승08</option>");
		$("#REGUSER_INPUT").append("<option value='1239'>신승09</option>");
		$("#REGUSER_INPUT").append("<option value='1240'>신승10</option>");
		break;
	case "D1003" : 
		$("#REGUSER_INPUT").append("<option value='1117'>마희숙</option>");
		$("#REGUSER_INPUT").append("<option value='1131'>한예주</option>");
		$("#REGUSER_INPUT").append("<option value='1132'>김지윤</option>");
		$("#REGUSER_INPUT").append("<option value='1134'>용아름</option>");
		$("#REGUSER_INPUT").append("<option value='1256'>김예빈</option>");
		$("#REGUSER_INPUT").append("<option value='1241'>강남1</option>");
		$("#REGUSER_INPUT").append("<option value='1242'>강남2</option>");
		$("#REGUSER_INPUT").append("<option value='1243'>강남3</option>");
		$("#REGUSER_INPUT").append("<option value='1244'>강남4</option>");
		$("#REGUSER_INPUT").append("<option value='1245'>강남5</option>");
		$("#REGUSER_INPUT").append("<option value='1246'>강남6</option>");
		$("#REGUSER_INPUT").append("<option value='1247'>강남7</option>");
		break;
	case "D1002" : 
		$("#REGUSER_INPUT").append("<option value='1148'>김용덕</option>");
		$("#REGUSER_INPUT").append("<option value='1133'>이정희</option>");
		$("#REGUSER_INPUT").append("<option value='1154'>김혜선</option>");
		$("#REGUSER_INPUT").append("<option value='1248'>강설옥</option>");
		break;
	case "D1014" : 
		$("#REGUSER_INPUT").append("<option value='1147'>노준석</option>");
		$("#REGUSER_INPUT").append("<option value='1148'>이정민</option>");
		$("#REGUSER_INPUT").append("<option value='1149'>윤형덕</option>");
		$("#REGUSER_INPUT").append("<option value='1227'>김선진</option>");
		break;
	case "D1013" : 
		$("#REGUSER_INPUT").append("<option value='1226'>김민</option>");
		$("#REGUSER_INPUT").append("<option value='1228'>김규리</option>");
		$("#REGUSER_INPUT").append("<option value='1249'>홍건호</option>");
		$("#REGUSER_INPUT").append("<option value='1121'>최기정</option>");
		$("#REGUSER_INPUT").append("<option value='1220'>이명진</option>");
		$("#REGUSER_INPUT").append("<option value='1153'>김진규</option>");
		$("#REGUSER_INPUT").append("<option value='1163'>한성민</option>");
		$("#REGUSER_INPUT").append("<option value='1164'>한은진</option>");
		break;
	case "D1004" : 
		$("#REGUSER_INPUT").append("<option value='1119'>오선미</option>");
		$("#REGUSER_INPUT").append("<option value='1135'>노윤솔</option>");
		$("#REGUSER_INPUT").append("<option value='1250'>김정아</option>");
		break;
	case "D1006" : 
		$("#REGUSER_INPUT").append("<option value='1136'>김은정</option>");
		$("#REGUSER_INPUT").append("<option value='1160'>박기령</option>");
		$("#REGUSER_INPUT").append("<option value='1161'>김지영</option>");
		$("#REGUSER_INPUT").append("<option value='1166'>안덕현</option>");
		break;
	case "D1007" : 
		$("#REGUSER_INPUT").append("<option value='1116'>오미자</option>");
		$("#REGUSER_INPUT").append("<option value='1257'>김세화</option>");
		$("#REGUSER_INPUT").append("<option value='1251'>한지은</option>");
		break;
	case "D1008" : 
		$("#REGUSER_INPUT").append("<option value='1120'>이찬희</option>");
		$("#REGUSER_INPUT").append("<option value='1140'>김세아</option>");
		$("#REGUSER_INPUT").append("<option value='1141'>강정민</option>");
		$("#REGUSER_INPUT").append("<option value='1252'>김미경</option>");
		break;
	case "D1009" : 
		$("#REGUSER_INPUT").append("<option value='1118'>신정희</option>");
		$("#REGUSER_INPUT").append("<option value='1142'>양은경</option>");
		$("#REGUSER_INPUT").append("<option value='1253'>신솔빈</option>");
		$("#REGUSER_INPUT").append("<option value='1155'>장민경</option>");
		break;
	case "D1010" : 
		$("#REGUSER_INPUT").append("<option value='1113'>이해옥</option>");
		$("#REGUSER_INPUT").append("<option value='1144'>박혜진</option>");
		$("#REGUSER_INPUT").append("<option value='1143'>염해림</option>");
		break;
	case "D1011" : 
		$("#REGUSER_INPUT").append("<option value='1113'>이해옥</option>");
		$("#REGUSER_INPUT").append("<option value='1158'>유수현</option>");
		$("#REGUSER_INPUT").append("<option value='1145'>한세빈</option>");
		break;
	case "D1012" : 
		$("#REGUSER_INPUT").append("<option value='1115'>한영순</option>");
		$("#REGUSER_INPUT").append("<option value='1165'>강지혜</option>");
		$("#REGUSER_INPUT").append("<option value='1255'>임봉규</option>");
		$("#REGUSER_INPUT").append("<option value='1254'>한유정</option>");
		break;
	case "D1021" : 
		$("#REGUSER_INPUT").append("<option value='1115'>정혜숙</option>");
		$("#REGUSER_INPUT").append("<option value='1116'>오미자</option>");
		break;
	default:$("#REGUSER_INPUT").append("<option value=''>선택</option>");
		break;
	}
	
	
}


function modify_(){

		var request = new Request();
		var id = request.getParameter("id");
		var userid = "";
		if(id!=""){
			var action = "action_write_cal_insert";
			userid = "<?=$userid?>";
		}else{
			$('#CSTNAME').html($('#CSTNAME_INPUT').val());
			$('#MOBILE').html($('#MOBILE_INPUT').val());
			var action = "action_write_cal_insert";
		}

		//각 엘리먼트들의 데이터 값을 받아온다.
		var CSTNAME = $('#CSTNAME_INPUT').val();
		var MOBILE = $('#MOBILE_INPUT').val();
		var HOMETAXID = $('#HOMETAXID_INPUT').val();
		var HOMETAXPW = $('#HOMETAXPW_INPUT').val();
		var INFO_TYPE = $('#INFO_TYPE_INPUT').val();
		var REG_BRANCH = $("#REG_BRANCH_INPUT option:selected").val();
		var REGUSER = $("#REGUSER_INPUT option:selected").val();
		var INTEREST = $('#INTEREST option:selected').val();
		var ALLOCATION = $('#ALLOCATION option:selected').val();
		var WORK_SINGLE = $('#WORK_SINGLE option:selected').val();
		var WORK_PLUR = $('#WORK_PLUR option:selected').val();
		var INFORMAL = $('#INFORMAL option:selected').val();
		var ETC = $('#ETC option:selected').val();
		var EXP_PAY_TAX = $('#EXP_PAY_TAX_SELF_INPUT').val();
		var EST_FEE = $('#EST_FEE_SELF_INPUT').val();
		var PROGRESS = $('#PROGRESS option:selected').val();
		var MEMO = $('#MEMO_INPUT').val();
		
		var depid = '<?=$depid?>';

		
		if(CSTNAME !="" && MOBILE != "" ){
			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				dataType: 'json',
				data:{id:id,action:action,CSTNAME:CSTNAME,MOBILE:MOBILE,HOMETAXID:HOMETAXID,HOMETAXPW:HOMETAXPW,
					INFO_TYPE:INFO_TYPE,REG_BRANCH:REG_BRANCH,REGUSER:REGUSER,INTEREST:INTEREST,
					ALLOCATION:ALLOCATION,WORK_SINGLE:WORK_SINGLE,WORK_PLUR:WORK_PLUR,
					INFORMAL:INFORMAL, ETC:ETC, EXP_PAY_TAX:EXP_PAY_TAX, EST_FEE:EST_FEE, PROGRESS:PROGRESS,
					MEMO:MEMO  },
				success:function(data){
					console.log(data);
					if(data.CSTID > 0 && id == "" ){
						location.href="write_cal.php?id="+data.CSTID;
					}else{
						fetchUser();
					}
				}
			});

		}
}


function switch_comp(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	//var id_tmp2 = $(obj+"_INPUT").attr("id");

	
	var id = id_tmp+"_INPUT";
	var request = new Request();
	var cstid = request.getParameter("id");

	if(cstid ==""){
		if(id_tmp == "CSTNAME" || id_tmp == "MOBILE"){
			$(obj).hide();
	    	document.getElementById(id).style.display="";
	    	document.getElementById(id).focus();

		}else{
			if(document.getElementById("CSTNAME_INPUT").value=="전화문의고객"){
    	    	$(obj).hide();
    	    	document.getElementById(id).style.display="";
    	    	document.getElementById(id).focus();
			}else{
				alert("이름/핸드폰번호를 먼저 입력 후 고객등록이 되어야합니다.");
				return false;
			}
		}
		//alert("이름/핸드폰번호를 먼저 입력 후 고객등록이 되어야합니다.");
		//return false;
	}else{

		if(id_tmp != "CSTNAME" || id_tmp != "MOBILE"){
	    	$(obj).hide();
	    	document.getElementById(id).style.display="";
	    	document.getElementById(id).focus();
		}else{
			alert("이름/핸드폰번호를 먼저 입력 후 고객등록이 되어야합니다.");
			return false;
		}

		if(id=="MEMO_INPUT"){
			$("#memo_save").show();
			$("#MEMO").hide();
			$("#MEMO_INPUT").show();
		}	
	}
	
	
}






function switch_comp2(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	//var id_tmp2 = $(obj+"_INPUT").attr("id");
	//var fix_it = $("#fix_it").val();

	//inputNumberAutoComma(obj);
	var request = new Request();
	var cstid = request.getParameter("id");
	if(cstid== ""){
		alert("이름/핸드폰번호를 먼저 입력 후 고객등록이 되어야합니다.");
		return false;
	}else{
		
			var id = id_tmp+"_INPUT";
			var cstid = request.getParameter("id");

			if(id_tmp == "CSTNAME" || id_tmp == "MOBILE"){
				if(cstid != ""){
					if(document.getElementById("CSTNAME_INPUT").value=="전화문의고객"){
		    	    	$(obj).hide();
		    	    	document.getElementById(id).style.display="";
		    	    	document.getElementById(id).focus();
					}
				}else{
					$(obj).hide();
			    	document.getElementById(id).style.display="";
			    	document.getElementById(id).focus();
				}
				
				
			}else{
				$(obj).hide();
				document.getElementById(id).style.display="";
		    	document.getElementById(id).focus();
			}
			
			$("#action_tb300031").show();
			$("#tbl_ext1").css("border","black");
			$("#tbl_ext1").css("border-style","ridge");
			
		
	}

	


}





//select 옵션 저장
function modify_option(obj){ 
	var request = new Request();
	var cstid = request.getParameter("id");
	if(cstid== ""){
		alert("이름/핸드폰번호를 먼저 입력 후 고객등록이 되어야합니다.");
		return false;
	}else{
		modify_();
	}
	
}


function fetchUser()
{

	var action = "select_cal_info";
	var request = new Request();
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();
	var time = today.getTime();
	var now = yyyy+""+mm+""+dd;

	var id = request.getParameter("id");

	
	if(id != ""){
		//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id, action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			
			$('#CSTNAME').html(data.CSTNAME);
			$('#CSTNAME_INPUT').val(data.CSTNAME);
			$('#CSTID').html(data.CSTID);
			$('#MOBILE').html(data.MOBILE);
			$('#MOBILE_INPUT').val(data.MOBILE);
			$('#HOMETAXID').html(data.HomeTaxID);
			$('#HOMETAXPW').html(data.HomeTaxPW);
			$('#HOMETAXID_INPUT').val(data.HomeTaxID);
			$('#HOMETAXPW_INPUT').val(data.HomeTaxPW);
			$('#REG_BRANCH_INPUT').val(data.REG_BRANCH).attr("selected","selected");
			ck_branch();
			$('#REGUSER_INPUT').val(data.REGUSER).attr("selected","selected");
			$('#INFO_TYPE').html(data.INFO_TYPE);
			$('#INFO_TYPE_INPUT').val(data.INFO_TYPE);
			$("#INTEREST").val(data.INTEREST).attr("selected","selected");
			$("#ALLOCATION").val(data.ALLOCATION).attr("selected","selected");
			$("#WORK_SINGLE").val(data.WORK_SINGLE).attr("selected","selected");
			$("#WORK_PLUR").val(data.WORK_PLUR).attr("selected","selected");
			$("#INFORMAL").val(data.INFORMAL).attr("selected","selected");
			$("#ETC").val(data.ETC).attr("selected","selected");
			$('#EXP_PAY_TAX').html(data.EXP_PAY_TAX_FN);
			$('#EST_FEE').html(data.CAL_EST_FEE_FN);
			$('#EXP_PAY_TAX2').html(data.EXP_PAY_TAX_SELF);
			$('#EST_FEE2').html(data.EST_FEE_SELF);

			$('#EXP_PAY_TAX_SELF').html(data.EXP_PAY_TAX_SELF_);
			$('#EXP_PAY_TAX_SELF_INPUT').val(data.EXP_PAY_TAX_SELF);
			$('#EST_FEE_SELF').html(data.EST_FEE_SELF_);
			$('#EST_FEE_SELF_INPUT').val(data.EST_FEE_SELF);
			
			$("#PROGRESS").val(data.PROGRESS).attr("selected","selected");
			$('#EXI_TAX').html(data.EXI_TAX_);
			$('#NPIP').html(data.NPIP_);
			$('#PERSON_SAVE').html(data.PERSON_SAVE_);
			$('#SMALL_BIZ_DED').html(data.SMALL_BIZ_DED_);
			$('#RET_SAVE').html(data.RET_SAVE_);
			$('#PEN_SAVE').html(data.PEN_SAVE_);
			$('#EXI_TAX_INPUT').val(data.EXI_TAX);
			$('#NPIP_INPUT').val(data.NPIP);
			$('#PERSON_SAVE_INPUT').val(data.PERSON_SAVE);
			$('#SMALL_BIZ_DED_INPUT').val(data.SMALL_BIZ_DED);
			$('#RET_SAVE_INPUT').val(data.RET_SAVE);
			$('#PEN_SAVE_INPUT').val(data.PEN_SAVE);
			if(data.MEMO){
				$('#MEMO').html(data.MEMO.replace(/(?:\r\n|\r|\n)/g, '<br />'));
				$('#MEMO').css("height","auto");
			}else{
				$('#MEMO').css("height","100px");
				}
			
			$('#MEMO_INPUT').val(data.MEMO);
			$('#ADD_AMOUNT_PAID').val(data.ADD_AMOUNT_PAID);
			$('#KAKAO_URL_BRANCH').html(data.KAKAO_URL_BRANCH);
			$('#fix_it').val(data.FIX_IT);
			if(data.KAKAO_SEND_CNT1>0){
				$('#send_kakao_1_y').hide();
				$('#send_kakao_1_self_y').hide();
				$('#send_kakao_1_n').show();
				$('#send_kakao_1_self_n').show();
			}else{
				$('#send_kakao_1_y').show();
				$('#send_kakao_1_n').hide();
				$('#send_kakao_1_self_y').show();
				$('#send_kakao_1_self_n').hide();
			}
			
			if(data.KAKAO_SEND_CNT2>0){
				$('#send_kakao_2_y').hide();
				$('#send_kakao_2_n').show();
				$('#send_kakao_2_self_y').hide();
				$('#send_kakao_2_self_n').show();
			}else{
				$('#send_kakao_2_y').show();
				$('#send_kakao_2_n').hide();
				$('#send_kakao_2_self_y').show();
				$('#send_kakao_2_self_n').hide();
			}
			
			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})	
	}
}


function fetchUser2()
{

	var action = "select_write_cal_ext";
	var request = new Request();
	var id = request.getParameter("id");

	
	if(id != ""){
		//users 리스트를 select.php 에서 받아온다.
		$("#EXT_INPUT").show();
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id, action:action},
		success:function(data)
		{
			console.log(data);
			
			$('#result2').html(data);

			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})	
	}
}


function del_ext(idx){
	var action = "action_tb300020_delete";
	var request = new Request();
	var id = request.getParameter("id");
	var con = confirm("삭제하시겠습니까?");

	if(con){
		if(id != "" ){
			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{id:id,action:action,idx:idx  },
				success:function(data){
					console.log(data);
					fetchUser();
					fetchUser2();
				}
			});
		}
	}
}

function digit_check(evt){
	if(evt.key === '.' 
	     || evt.key === '-'
	     || evt.key >= 0 && evt.key <= 9) {
	    return true;
	  }
	  
	  return false;
}



function send_kakao(flag){

	var request = new Request();
	var id = request.getParameter("id");
	var cstname = $("#CSTNAME").html();
	var tmp_flag = "A1001";
	
	if(flag=="self_1_A"){
		var yn = confirm("자동계산된 알림톡1을 "+cstname+'님에게 발송하시겠습니까?');

		if(yn){
			
			var action = "Send_RPA_Reg_Self1";
			var tmp_flag2="자동계산";

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"api/send_tok.php", 
				method:"POST",
				data:{id:id, action:action,tmp_flag:tmp_flag,tmp_flag2:tmp_flag2},
				//dataType:"json",
				success:function(data)
				{
					console.log(data);
					if(data.indexOf("send_ok")>=0){
						alert("전송완료");
						fetchUser();
						fetchUser2();
					}else if(data.indexOf("error:abuse")>=0){
						alert("이미 해당 알림톡이 발송된 사용자입니다.");
						fetchUser();
						fetchUser2();
					}else{
						alert("에러가 발생했습니다. 관리자에게 문의하여주세요.");
						fetchUser();
						fetchUser2();
					}
							
				}
			});
			
		}else{
			return false;
		}
	}else if(flag=="self_2_A"){
		var yn = confirm("자동계산된 알림톡2을 "+cstname+'님에게 발송하시겠습니까?');

		if(yn){
			
			var action = "Send_RPA_Reg_Self2";
			var tmp_flag2="자동계산";

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"api/send_tok.php", 
				method:"POST",
				data:{id:id, action:action,tmp_flag:tmp_flag,tmp_flag2:tmp_flag2},
				//dataType:"json",
				success:function(data)
				{
					console.log(data);
					if(data.indexOf("send_ok")>=0){
						alert("전송완료");
						fetchUser();
						fetchUser2();
					}else if(data.indexOf("error:abuse")>=0){
						alert("이미 해당 알림톡이 발송된 사용자입니다.");
						fetchUser();
						fetchUser2();
					}else{
						alert("에러가 발생했습니다. 관리자에게 문의하여주세요.");
						fetchUser();
						fetchUser2();
					}
							
				}
			});
			
		}else{
			return false;
		}
		
	}else if(flag=="self_1_S"){
		var yn = confirm("수동입력한 알림톡1을 "+cstname+'님에게 발송하시겠습니까?');

		if(yn){
			
			var action = "Send_RPA_Reg_Self1";
			var tmp_flag2="수동계산";

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"api/send_tok.php", 
				method:"POST",
				data:{id:id, action:action, tmp_flag:tmp_flag, tmp_flag2:tmp_flag2},
				//dataType:"json",
				success:function(data)
				{
					console.log(data);
					if(data.indexOf("send_ok")>=0){
						alert("전송완료");
						fetchUser();
						fetchUser2();
					}else if(data.indexOf("error:abuse")>=0){
						alert("이미 해당 알림톡이 발송된 사용자입니다.");
						fetchUser();
						fetchUser2();
					}else{
						alert("에러가 발생했습니다. 관리자에게 문의하여주세요.");
						fetchUser();
						fetchUser2();
					}
							
				}
			});
			
		}else{
			return false;
		}
		
	}else if(flag=="self_2_S"){
			var yn = confirm("수동입력한 알림톡2을 "+cstname+'님에게 발송하시겠습니까?');

	if(yn){
		
		var action = "Send_RPA_Reg_Self2";
		var tmp_flag2="수동계산";

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"api/send_tok.php", 
			method:"POST",
			data:{id:id, action:action, tmp_flag:tmp_flag, tmp_flag2:tmp_flag2},
			//dataType:"json",
			success:function(data)
			{
				console.log(data);
				if(data.indexOf("send_ok")>=0){
					alert("전송완료");
					fetchUser();
					fetchUser2();
				}else if(data.indexOf("error:abuse")>=0){
					alert("이미 해당 알림톡이 발송된 사용자입니다.");
					fetchUser();
					fetchUser2();
				}else{
					alert("에러가 발생했습니다. 관리자에게 문의하여주세요.");
					fetchUser();
					fetchUser2();
				}
						
			}
		});
		
	}else{
		return false;
	}
	
} 	
}



</script>


</html>