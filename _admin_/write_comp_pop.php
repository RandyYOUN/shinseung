
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

					<h1>신규회사등록</h1>
    				<div class="btn w100" style="margin:5px 0 15px;text-align:right;">
    					<button name="action1" id="action1" >등록</button>
    					<button name="close1" id="close1">닫기</button>
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
											<th><span>상호</span></th>
											<td><input type="box" name="COMPANY" id="COMPANY" /></input></td>
											<th><span>사업자등록번호</span></th>
											<td><input type="box" name="BIZ_NUM" id="BIZ_NUM" /></input></td>
										</tr>
										
										<tr>
											<th>개업일</th>
											<td><input type="date" name="OPENING_DAY" id="OPENING_DAY" /></input></td>
											<th>폐업일</th>
											<td><input type="date" name="CLOSE_DAY" id="CLOSE_DAY" /></input></td>
										</tr>
										<tr>
											<th>업태</th>
											<td><input type="box" name="BIZ_CATE" id="BIZ_CATE" /></input></td>
											<th>종목</th>
											<td><input type="box" name="BIZ_FORM" id="BIZ_FORM" /></input></td>
										</tr>
										<tr>
											<th>주소(도로명)</th>
											<td><input type="box" name="ADDRESS_LOAD" id="ADDRESS_LOAD" /></input></td>
											<th>주소(행정명)</th>
											<td><input type="box" name="ADDRESS_LEGAL" id="ADDRESS_LEGAL" /></input></td>
										</tr>
										<tr>
											<th>회사연락처</th>
											<td colspan=3><input type="box" name="COMP_PHONE" id="COMP_PHONE" /></input></td>
										</tr>
										<tr>
											<th>더존서버</th>
											<td>
												<div class="selectbox s50">
                										<label for="">서버선택</label>
                										<select name="DOUZONE_SVR" id ="DOUZONE_SVR">
                											<option value="" selected>선택</option>
                											<option value="1">1</option>
                											<option value="2">2</option>
                											<option value="3">3</option>
                										</select>
                									</div>
											</td>
											<th>더존코드</th>
											<td><input type="box" name="DOUZONE_CODE" id="DOUZONE_CODE" /></input></td>
										</tr>
										
										<tr>
											<th>해임날짜</th>
											<td><input type="date" name="DIS_DATE" id="DIS_DATE" /></input></td>
											<th>해임사유</th>
											<td><input type="box" name="DIS_REASON" id="DIS_REASON" /></input></td>
										</tr>
										
										
										
									</tbody>
								</table>
							</div>
						</div>
						
        				<div class="btn w100" style="margin:5px 0 15px; text-align:right;">
        					<button name="action2" id="action2" >등록</button>
        					<button name="close2" id="close2">닫기</button>
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
                          		<button style="width:50px;margin:0 0 0 540px; font-size:larger;" type="button" name="close_layer" id="close_layer">X 닫기</button>
                          		
                    			<h1 style="padding:40px 0 40px 0;">등록 회사 리스트</h1>
                    			<div>
                    				<button style="width:150px;margin:0 0 0 460px; font-size:larger;" type="button" name="add_new_comp" id="add_new_comp">신규회사추가</button>
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
	    
    //[2] 추가 버튼 클릭했을 때 작동되는 함수
    $('#action1').click(function(){
    	modify_();
    });
    $('#action2').click(function(){
    	modify_();
    });


    	//목록가기
    $('#close1').click(function(){
    	window.close();
    });
    $('#close2').click(function(){
    	window.close();
    });
    

    function modify_(){

    		var request = new Request();
    		//var id = request.getParameter("id");
    		var action = "action_comp_insert";

    		//각 엘리먼트들의 데이터 값을 받아온다.
    		var id = request.getParameter("id");
    		var COMPANY = $('#COMPANY').val();
    		var BIZ_NUM = $('#BIZ_NUM').val();
    		var OPENING_DAY = $('#OPENING_DAY').val();
    		var CLOSE_DAY= $('#CLOSE_DAY').val();
    		var BIZ_CATE= $('#BIZ_CATE').val();
    		var BIZ_FORM = $('#BIZ_FORM').val();
    		var ADDRESS_LOAD= $('#ADDRESS_LOAD').val();
    		var ADDRESS_LEGAL = $('#ADDRESS_LEGAL').val();
    		var COMP_PHONE= $('#COMP_PHONE').val();
    		var DOUZONE_SVR = $('#DOUZONE_SVR').val();
    		var DOUZONE_CODE= $('#DOUZONE_CODE').val();
    		var DIS_DATE= $('#DIS_DATE').val();
    		var DIS_REASON= $('#DIS_REASON').val();
    		
			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{action:action, id:id,COMPANY:COMPANY,BIZ_NUM:BIZ_NUM,OPENING_DAY:OPENING_DAY,
					CLOSE_DAY:CLOSE_DAY,BIZ_CATE:BIZ_CATE,BIZ_FORM:BIZ_FORM, ADDRESS_LOAD:ADDRESS_LOAD,
					ADDRESS_LEGAL:ADDRESS_LEGAL,COMP_PHONE:COMP_PHONE, DOUZONE_SVR:DOUZONE_SVR,
					DOUZONE_CODE:DOUZONE_CODE, DIS_DATE:DIS_DATE,DIS_REASON:DIS_REASON   },
					dataType:"json",
				success:function(data){
					
					if(data.BIZID){
						window.location.href="write_inc_pop.php?id="+id+"&cp_ck=y";	
					}else{
    					alert("처리중 오류가 발생하였습니다. 관리자에게 문의하셔주세요");
					}

				}
			});
    }


    
});

</script>
</html>