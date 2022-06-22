
<?php
include "db_info.php";

include "top.php";

?>	
<style>
.dashboard tbody tr th span{margin:0 0px 0 0px; position: relative; }
.dashboard tbody tr th span::before{ content: '*'; position: absolute; left: -10px; top: -5px; color:rgb(216, 16, 16); }
</style>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<br><br><br><br>
	<div class="wrap">
		<div class="mainbg">
			<div class="content">
				<div class="conwrap">

					<h1>접수정보입력</h1>
    				<div class="btn w100" style="margin:5px 0 15px;text-align:right;">
    					<button name="action1" id="action1" >등록</button>
    					<button name="close" id="close">닫기</button>
    				</div>
					<div class="dashwrap" style="width:1290px;">

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
											<td><label name="CSTNAME" id="CSTNAME"  /></label></td>
											<th><span>핸드폰</span></th>
											<td><label name="MOBILE" id="MOBILE"  /></label></td>
											
										</tr>
										<tr>
											<th>접수일</th>
											<td><input type="date" name="REGDATE" id="REGDATE" /></input></td>
											<th>상호</th>
											<td><input type="box" name="COMP_NAME" id="COMP_NAME" href="#layer2" class="btn-example" /></input></td>
										</tr>
										<tr>
											<th>세목</th>
											<td>
													<div class="selectbox s50">
                										<label for="">세목</label>
                										<select name="CST_TYPE" id ="CST_TYPE">
                											<option value="" selected>선택</option>
                											<option value="A1001">종합소득세</option>
                											<option value="A1002">부가세</option>
                											<option value="A1005">면세일반</option>
                											<option value="A1006">면세주택임대</option>
                											<option value="A1007">세무기장</option>
                											<option value="A1008">양도</option>
                											<option value="A1009">상속</option>
                											<option value="A1010">증여</option>
                											<option value="A1011">기타</option>
                										</select>
                									</div>
											</td>
											<th>과세유형</th>
											<td>
													<div class="selectbox s50">
                										<label for="">과세유형</label>
                										<select name="TAX_TYPE" id ="TAX_TYPE">
                											<option value="" selected>선택</option>
                											<option value="A2001">프리랜서</option>
                											<option value="A2002">면세</option>
                											<option value="A2003">간이</option>
                											<option value="A2004">일반</option>
                											<option value="A2005">법인</option>
                										</select>
                									</div>
											</td>
										</tr>
										<tr>
											<th>예상납부세액</th>
											<td><input type="box" name="EXP_PAY_TAX" id="EXP_PAY_TAX" /></input></td>
											<th>예상수수료</th>
											<td><input type="box" name="EST_FEE" id="EST_FEE" /></input></td>
										</tr>
										<tr>
											<th>입금금액</th>
											<td><input type="box" name="DEP_FEE" id="DEP_FEE" /></input></td>
											<th>입금방법</th>
											<td><input type="box" name="DEP_TYPE" id="DEP_TYPE" /></input></td>
										</tr>
										<tr>
											<th>수임여부</th>
											<td>
													<div class="selectbox s50">
                										<label for="">수임여부</label>
                										<select name="ACC_FLAG" id ="ACC_FLAG">
                											<option value="" selected>선택</option>
                											<option value="H1001">문의</option>
                											<option value="H1002">수임</option>
                											<option value="H1003">환불</option>
                											<option value="H1004">해임</option>
                										</select>
                									</div>
											</td>
											<th>마감일자</th>
											<td><input type="date" name="DEADLINE_DATE" id="DEADLINE_DATE" /></input></td>
										</tr>
										<tr>
											<th>납부세액</th>
											<td><input type="box" name="PAY_TAX" id="PAY_TAX" /></input></td>
											<th>홈택스 전자신고</th>
											<td><input type="box" name="NUM_E_REPORT" id="NUM_E_REPORT" /></input></td>
										</tr>
										<tr>
											<th>종합소득세 전자신고</th>
											<td><input type="box" name="REPORT_NUM_INCOME" id="REPORT_NUM_INCOME" /></input></td>
											<th>위택스 전자신고</th>
											<td><input type="box" name="REPORT_NUM_WETAX" id="REPORT_NUM_WETAX" /></input></td>
										</tr>
										<tr>
											<th>서류 전달일</th>
											<td><input type="date" name="DEL_DATE_PAYMENT" id="DEL_DATE_PAYMENT" /></input></td>
											<th>전달방법</th>
											<td><input type="box" name="DEL_TYPE_PAYMENT" id="DEL_TYPE_PAYMENT" /></input></td>
										</tr>
										<tr>
											<th>신고서 작성자</th>
											<td><input type="box" name="DEC_REGUSER" id="DEC_REGUSER" /></input></td>
											<th></th>
											<td></td>
										</tr>
										
										<tr>
											<th>유입채널</th>
											<td>
													<div class="selectbox s50">
                										<label for="">유입채널</label>
                										<select name="INF_CHANNEL" id ="INF_CHANNEL">
                											<option value="" selected>선택</option>
                											<option value="A3001">방문</option>
                											<option value="A3002">지점전화</option>
                											<option value="A3112">광고전화</option>
                											<option value="A3003">채널톡</option>
                											<option value="A3004">종소톡</option>
                											<option value="A3005">임대톡</option>
                											<option value="A3006">창업톡</option>
                											<option value="A3007">부가톡</option>
                											<option value="A3008">신승웹</option>
                											<option value="A3009">양도톡</option>
                											<option value="A3010">증여톡</option>
                											<option value="A3011">상속톡</option>
                										</select>
                									</div>
											</td>
											<th>유입소스</th>
											<td>
													<div class="selectbox s50">
                										<label for="">유입채널</label>
                										<select name="INF_PATH" id ="INF_PATH">
                											<option value="" selected>선택</option>
                											<option value="A3101">네이버</option>
                											<option value="A3102">다음</option>
                											<option value="A3103">구글</option>
                											<option value="A3104">SNS</option>
                											<option value="A3105">카톡</option>
                											<option value="A3106">알림톡</option>
                											<option value="A3107">기타</option>
                										</select>
                									</div>
											</td>
										</tr>
										<tr>
											<th>유입기기</th>
											<td><div class="selectbox s50">
                										<label for="">유입기기</label>
                										<select name="INF_GEAR" id ="INF_GEAR">
                											<option value="" selected>선택</option>
                											<option value="A3201">PC</option>
                											<option value="A3202">MOBILE</option>
                											<option value="A3203">기타</option>
                										</select>
                									</div>
                							</td>
											<th>검색키워드</th>
											<td><input type="box" name="KEYWORD" id="KEYWORD" /></input></td>
										</tr>
										<tr>
											<th>지점</th>
											<td>
													<div class="selectbox s50">
                										<label for="">지점</label>
                										<select name="REG_BRANCH" id ="REG_BRANCH">
                											<option value="" selected>선택</option>
                											<option value="D1019">세무톡</option>
                											<option value="D1003">강남</option>
                    										<option value="D1004">용인</option>
                    										<option value="D1006">안양</option>
                    										<option value="D1007">수원</option>
                    										<option value="D1008">일산</option>
                    										<option value="D1009">부천</option>
                    										<option value="D1010">광주</option>
                    										<option value="D1011">분당</option>
                    										<option value="D1012">기흥</option>
                    										<option value="D1013">세무본부</option>
                										</select>
                									</div>
											</td>
											<th>수임경로</th>
											<td>
													<div class="selectbox s50">
                										<label for="">지점</label>
                										<select name="ACC_PATH" id ="ACC_PATH">
                											<option value="" selected>선택</option>
                											<option value="A4001">온라인</option>
                											<option value="A4002">지점내방</option>
                    										<option value="A4003">방문영업</option>
                    										<option value="A4004">거래처소개</option>
                    										<option value="A4005">지인소개</option>
                    										<option value="A4006">신고대리 전환</option>
                    										<option value="A4007">메일</option>
                    										<option value="A4008">문자</option>
                    										<option value="A4009">카톡</option>
                    										<option value="A4010">SNS</option>
                    										<option value="A4011">브로셔</option>
                    										<option value="A4012">오프라인광고</option>
                    										<option value="A4013">기타</option>
                										</select>
                									</div>
											</td>
										</tr>
										<tr>
											<th>추천인</th>
											<td><input type="box" name="REC_PERSON" id="REC_PERSON" /></input></td>
											<th>추천인연락처</th>
											<td><input type="box" name="REC_PERSON_PHONE" id="REC_PERSON_PHONE" /></input></td>
										</tr>
										<tr>
											<th>접수자</th>
											<td><input type="box" name="REGUSER" id="REGUSER" /></input></td>
											<th>영업담당자</th>
											<td><input type="box" name="SALES_REP" id="SALES_REP" /></input></td>
										</tr>
										<tr>
											<th>비고</th>
											<td colspan=3><textarea name="MEMO" id="MEMO" /></textarea></td>
										</tr>
										
										<tr>
											<th>홈택스수임동의</th>
											<td><input type="box" name="SUBM_DATE2" id="SUBM_DATE2" /></input></td>
											<th>사업자등록번호</th>
											<td><input type="box" name="BIZ_NUM" id="BIZ_NUM" /></input></td>
										</tr>
										
										
									
										<tr>
											<th>현금영수증</th>
											<td colspan=3><input type="box" name="CASH_REC" id="CASH_REC" /></input></td>
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
		
		
	    <div class="dim-layer">
            <div class="dimBg"></div>
            <div id="layer2" class="pop-layer">
                <div class="pop-container">
                    <div class="pop-conts">
                        <!--content //-->
                          <section class="link2" style="height: 570px; margin:0;">
                          		<button style="width:50px;margin:0 0 0 640px; font-size:larger;" type="button" name="close_layer" id="close_layer">X 닫기</button>
                          		
                    			<h1 style="padding:40px 0 40px 0;">등록 회사 리스트</h1>
                    			<div>
                    				<button style="width:150px;margin:0 0 0 560px; font-size:larger;" type="button" name="add_new_comp" id="add_new_comp">신규회사추가</button>
                    			</div><br>
                    			<div class="dashboard1">
								<table>
									<colgroup>
										<col width="50px">
										<col width="100px">
										<col width="150px">
										<col width="70px">
										<col width="70px">
										<col width="70px">
									</colgroup>
									<thead>
                                		<tr>
                                			<th>ID</th>
                                			<th>상호</th>
                                			<th>사업자등록번호</th>
                                			<th>업태</th>
                                			<th>종목</th>
                                			<th>선택</th>
                                		</tr>
                                		</thead>
									<tbody id="result"></tbody>
								</table>
							</div>
                    		</section>
                        <!--// content-->
                    </div>
                </div>
            </div>
        </div>
	
<style>
.dashboard1 table thead tr th{
    font-family: 'NanumBarunGothicB';
    background: #fbfbfb;
    border-right: 1px solid #e3e3e3;
    border-bottom: 1px solid #e3e3e3;
    padding: 20px 20px 10px 20px;
    text-align: left;
}    
.dashboard1 tbody tr td{
border-bottom: 1px solid #e3e3e3;
    padding: 10px 10px 10px 10px;
    border-right: 1px solid #e3e3e3;
}    
    
    
* {
  margin: 0;
  padding: 0;
}

body {
  margin: 100px;
}

.pop-layer .pop-container {
  padding: 20px 25px;
}

.pop-layer p.ctxt {
  color: #666;
  line-height: 25px;
}

.pop-layer .btn-r {
  width: 100%;
  margin: 10px 0 20px;
  padding-top: 10px;
  border-top: 1px solid #DDD;
  text-align: right;
}

.pop-layer {
  display: none;
  position: absolute;
  top: 50%;
  left: 50%;
  width: 760px;
  height: auto;
  background-color: #fff;
  border: 5px solid #3571B5;
  z-index: 10;
}

.dim-layer {
  display: none;
  position: fixed;
  _position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 100;
}

.dim-layer .dimBg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #000;
  opacity: .5;
  filter: alpha(opacity=50);
}

.dim-layer .pop-layer {
  display: block;
}

a.btn-layerClose {
  display: inline-block;
  height: 25px;
  padding: 0 14px 0;
  border: 1px solid #304a8a;
  background-color: #3f5a9d;
  font-size: 13px;
  color: #fff;
  line-height: 25px;
}

a.btn-layerClose:hover {
  border: 1px solid #091940;
  background-color: #1f326a;
  color: #fff;
}
</style>
	
	
	<input type="hidden" id="tmp_biz_id" name="tmp_biz_id"></input>
</body>

<script>

function input_biz(id,comp_name ){

$('#tmp_biz_id').val(id);
$('#COMP_NAME').val(comp_name);
$('.dim-layer').fadeOut();

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

	function layer_popup(el){

	    var $el = $(el);    //레이어의 id를 $el 변수에 저장
	    var isDim = $el.prev().hasClass('dimBg'); //dimmed 레이어를 감지하기 위한 boolean 변수

	    isDim ? $('.dim-layer').fadeIn() : $el.fadeIn();

	    var $elWidth = ~~($el.outerWidth()),
	        $elHeight = ~~($el.outerHeight()),
	        docWidth = $(document).width(),
	        docHeight = $(document).height();

	    // 화면의 중앙에 레이어를 띄운다.
	    if ($elHeight < docHeight || $elWidth < docWidth) {
	        $el.css({
	            marginTop: -$elHeight /2,
	            marginLeft: -$elWidth/2
	        })
	    } else {
	        $el.css({top: 0, left: 0});
	    }

	    $el.find('#close_layer').click(function(){
	        isDim ? $('.dim-layer').fadeOut() : $el.fadeOut(); // 닫기 버튼을 클릭하면 레이어가 닫힌다.
	        return false;
	    });

	    $('.layer .dimBg').click(function(){
	        $('.dim-layer').fadeOut();
	        return false;
	    });

	}


	
fetchUser();

function fetchUser()
{
	
	var action = "select_inc_cst";
	var request = new Request();
	var id = request.getParameter("id");
	var cp_ck = request.getParameter("cp_ck");
	var today = new Date();   
	var year = today.getFullYear(); // 년도
	var month = today.getMonth() + 1;  // 월
	var date = today.getDate();  // 날짜
	var day = today.getDay();  // 요일
	var today = year + '-' + month + '-' + date;

	$('#REGDATE').val(moment(today).format('YYYY-MM-DD')); // 접수일 default값

	if(cp_ck=="y"){
		var action = "select_comp_layer";
        var request = new Request();
		var id = request.getParameter("id");

		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,id:id},
			success:function(data){
				$('#result').html(data);
			}
		})

        
    	  $('.dim-layer').fadeIn();
		}

	if(id!=""){
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{id:id,action:action},
			dataType:"json",
			success:function(data)
			{
				console.log(data);
				
				$('#CSTNAME').html(data.CSTNAME);
				$('#MOBILE').html(data.MOBILE);
				
				
			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})
	}
		
}


    
    //[2] 추가 버튼 클릭했을 때 작동되는 함수
    $('#action1').click(function(){
    	modify_();
    });
    $('#action2').click(function(){
    	modify_();
    });


    	//목록가기
    $('#close').click(function(){
    	window.close();
    });
    $('#close').click(function(){
    	window.close();
    });

    $('#COMP_NAME').focusin(function(){
        var action = "select_comp_layer";
        var request = new Request();
		var id = request.getParameter("id");

		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,id:id},
			success:function(data){
				$('#result').html(data);
			}
		})

        
    	  var $href = $(this).attr('href');
  	    layer_popup($href);
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


    $('#add_new_comp').click(function(){
    	 var request = new Request();
 		var id = request.getParameter("id");
         
    	window.location.href="write_comp_pop.php?id="+id;
    });

    

    function modify_(){

    		var request = new Request();
    		//var id = request.getParameter("id");
    		var action = "action_inc_insert_ex1";

    		//각 엘리먼트들의 데이터 값을 받아온다.
    		var id = request.getParameter("id");
    		var REGDATE = $('#REGDATE').val();
    		var COMP_NAME = $('#COMP_NAME').val();
    		var EXP_PAY_TAX = $('#EXP_PAY_TAX').val();
    		var EST_FEE = $('#EST_FEE').val();
    		var DEP_FEE = $('#DEP_FEE').val();
    		var DEP_TYPE = $('#DEP_TYPE').val();
    		var ACC_FLAG = $('#ACC_FLAG').val();
    		var DEADLINE_DATE = $('#DEADLINE_DATE').val();
    		var PAY_TAX = $('#PAY_TAX').val();
    		var NUM_E_REPORT = $('#NUM_E_REPORT').val();
    		var REPORT_NUM_INCOME = $('#REPORT_NUM_INCOME').val();
    		var REPORT_NUM_WETAX = $('#REPORT_NUM_WETAX').val();
    		var DEL_DATE_PAYMENT = $('#DEL_DATE_PAYMENT').val();
    		var DEL_TYPE_PAYMENT = $('#DEL_TYPE_PAYMENT').val();
    		var DEC_REGUSER = $('#DEC_REGUSER').val();
    		var CST_TYPE = $('#CST_TYPE').val();
    		var TAX_TYPE = $('#TAX_TYPE').val();
    		var INF_CHANNEL = $('#INF_CHANNEL').val();
    		var INF_PATH = $('#INF_PATH').val();
    		var INF_GEAR = $('#INF_GEAR').val();
    		var KEYWORD = $('#KEYWORD').val();
    		var REG_BRANCH = $('#REG_BRANCH').val();
    		var ACC_PATH = $('#ACC_PATH').val();
    		var REC_PERSON = $('#REC_PERSON').val();
    		var REC_PERSON_PHONE = $('#REC_PERSON_PHONE').val();
    		var REGUSER = $('#REGUSER').val();
    		var SALES_REP = $('#SALES_REP').val();
    		var MEMO = $('#MEMO').val();
    		
    		var SUBM_DATE2 = $('#SUBM_DATE2').val();
    		
    		var CASH_REC = $('#CASH_REC').val();
    		var tmp_biz_id = $('#tmp_biz_id').val();
    		var now = new Date();
    		var CST_TYPE_YEAR = now.getFullYear();
    		var CST_TYPE_SEQ = '1';
    					
    		
			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{action:action, id:id,REGDATE:REGDATE,COMP_NAME:COMP_NAME,
					EXP_PAY_TAX :EXP_PAY_TAX , EST_FEE:EST_FEE, DEP_FEE:DEP_FEE, DEP_TYPE:DEP_TYPE,
					ACC_FLAG:ACC_FLAG,DEADLINE_DATE:DEADLINE_DATE,PAY_TAX:PAY_TAX,
					NUM_E_REPORT:NUM_E_REPORT,REPORT_NUM_INCOME:REPORT_NUM_INCOME,
					REPORT_NUM_WETAX:REPORT_NUM_WETAX,DEL_DATE_PAYMENT:DEL_DATE_PAYMENT,
					DEL_TYPE_PAYMENT:DEL_TYPE_PAYMENT,DEC_REGUSER:DEC_REGUSER,
					CST_TYPE:CST_TYPE,TAX_TYPE:TAX_TYPE,INF_CHANNEL:INF_CHANNEL,
					INF_PATH:INF_PATH,INF_GEAR:INF_GEAR,KEYWORD:KEYWORD,REG_BRANCH:REG_BRANCH,
					ACC_PATH:ACC_PATH,REC_PERSON:REC_PERSON,REC_PERSON_PHONE:REC_PERSON_PHONE,
					REGUSER:REGUSER,SALES_REP:SALES_REP,MEMO:MEMO,SUBM_DATE2:SUBM_DATE2,
					CASH_REC:CASH_REC,tmp_biz_id:tmp_biz_id,
					CST_TYPE_YEAR:CST_TYPE_YEAR, CST_TYPE_SEQ:CST_TYPE_SEQ },
					dataType:"json",
				success:function(data){
					
					if(data.BIZID){
						window.location.href="view_all_cst.php?id="+id;	
					}else{
    					alert("처리중 오류가 발생하였습니다. 관리자에게 문의하셔주세요");
					}

				}
			});
    }


    
});

</script>
</html>