<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승세무법인 ADMIN</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
<?php
include "top.php";
?>
<br><br><br><br>
	<div class="wrap">
		<div class="mainbg">
			<div class="content">
				<div class="conwrap">

					<h1>신고 안내정보</h1>
				<div class="btn w100" style="margin:5px 0 15px;">
					<button name="delete" id="delete">삭제</button>
					<button name="update" id="update" >수정</button>
					<button name="list" id="list">목록</button>
				</div>
					<div class="dashwrap" style="width:1290px;">

						<h2>고객기본정보</h2>
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
											<td><label name="COMP_NAME" id="COMP_NAME"  /></label></td>
											<th>사업자번호</td>
											<td><label name="CST_BIRTH" id="CST_BIRTH" /></label></td>
										</tr>
										<tr>
											<th>성명(대표자)</td>
											<td><label name="CSTNAME" id="CSTNAME" /></label></td>
											<th>주민등록번호(대표자)</td>
											<td><label name="RESIDENT_ID" id="RESIDENT_ID" /></label></td>
										</tr>
										<tr>
											<th>개업일자</td>
											<td><label name="OPENING_DAY" id="OPENING_DAY" /></label></td>
											<th>사업자등록일</td>
											<td><label name="BIZ_REG_DATE" id="BIZ_REG_DATE" /></label></td>
										</tr>
										<tr>
											<th>업태</td>
											<td><label name="SECTOR" id="SECTOR" /></label></td>
											<th>종목</td>
											<td><label name="BIZ_CATE" id="BIZ_CATE" /></label></td>
										</tr>
										<tr>
											<th>사업장 소재지</td>
											<td colspan=3><label name="COMP_ADDRESS" id="COMP_ADDRESS" /></label></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<h2>부가세 접수정보</h2>
						<div class="dashcon">
							<div class="btn w100" style="margin:5px 0px 15px;">
            					<button name="add_new_job" id="add_new_job">추가</button>
            				</div>
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="100px">
										<col width="100px">
										<col width="100px">
										<col width="100px">
										<col width="100px">
										<col width="100px">
									</colgroup>
									<thead>
                                		<tr>
                                			<th>상호</th>
                                			<th>구분</th>
                                			<th>연도(기수)</th>
                                			<th>수임금액(납입금액)</th>
                                			<th>접수일</th>
                                			<th>마감일</th>
                                		</tr>
                                		</thead>
									<tbody>
<?php 
$procedure = "
	CREATE PROCEDURE SELECT_ALL_JOB_CST( IN P_CSTID INT(11) )
	BEGIN
		SELECT COMP_NAME, SELECT_CODE_VALUE( CST_TYPE ) AS CST_TYPE,EST_FEE, 
CST_TYPE_YEAR, CST_TYPE_SEQ, DEP_FEE, DATE_FORMAT(REGDATE, '%Y-%m-%d') 'REGDATE_' , 
DATE_FORMAT(DEADLINE_DATE, '%Y-%m-%d') 'DEADLINE_DATE_'
FROM dbsschina.TB100022 WHERE CST_TYPE='A1002' AND CSTID = P_CSTID ORDER BY REGDATE DESC;
	END;
	";

if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_ALL_JOB_CST"))
{
    if(mysqli_query($connect,$procedure))
    {
        $query = "CALL SELECT_ALL_JOB_CST(".$_GET["id"].")";
        $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
        
        if(mysqli_num_rows($result) >0)
        {
            
            while($row = mysqli_fetch_array($result)){
                
                $output .= '
					<tr>
						<td style="text-align:center;">'.$row["COMP_NAME"].'</td>
						<td style="text-align:center;">'.$row["CST_TYPE"].'</td>
						<td style="text-align:center;">'.$row["CST_TYPE_YEAR"].'('.$row["CST_TYPE_SEQ"].'기)</td>
						<td style="text-align:center;">'.$row["EST_FEE"].'원 ('.$row["DEP_FEE"].'원)</td>
                        <td style="text-align:center;">'.$row["REGDATE_"].'</td>
                        <td style="text-align:center;">'.$row["DEADLINE_DATE_"].'</td>
					</tr>
					';
            }
        }
        else
        {
            $output .= '
				<tr>
				<td colspan="6" style="text-align:center;">데이터가 없습니다.</td>
				</tr>
										    
				';
        }
        
        echo $output;
        
    }
    
}

?>									
									
										
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
											<td><label name="EST_FEE" id="EST_FEE"  /></label></td>
											<th>입금금액</td>
											<td><label name="DEP_FEE" id="DEP_FEE" /></label></td>
										</tr>
										<tr>
											<th>결제방법</td>
											<td><label name="DEP_TYPE" id="DEP_TYPE" /></label></td>
											<th>입금일자</td>
											<td><label name="DEP_DATE" id="DEP_DATE" /></label></td>
										</tr>
										<tr>
											<th>영수증</td>
											<td>
												<input type="radio" ID="CASH_REC" NAME="CASH_REC" value="c">현금영수증
												<input type="radio" ID="CASH_REC" NAME="CASH_REC" value="t">세금계산서
											</td>
											<th>영수일자</td>
											<td><label name="CASH_REC_DATE" id="CASH_REC_DATE" /></label></td>
										</tr>
										<tr>
											<th>홈택스 수임동의 요청</td>
											<td><label name="SUBM_DATE" id="SUBM_DATE" /></label></td>
											<th>홈택스 수임여부</td>
											<td><label name="SUBM_DATE2" id="SUBM_DATE2" /></label></td>
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
											<td><label name="COMP_REG_DATE" id="COMP_REG_DATE" /></label></td>
											<th>신고서 작성담당</td>
											<td><label name="DEC_REGUSER" id="DEC_REGUSER" /></label></td>
										</tr>
										<tr>
											<th>전자신고 요청</td>
											<td>
												<input type="radio" id="REQ_E_REPORT" name="REQ_E_REPORT">전자신고 실행
												<input type="radio" id="REQ_E_REPORT" name="REQ_E_REPORT">신고 미실행
											</td>
											<th>전자신고 요청자</td>
											<td><label name="REQ_USER" id="REQ_USER" /></label></td>
										</tr>
										<tr>
											<th>전자신고 요청일</td>
											<td><label name="REQ_DATE" id="REQ_DATE" /></label></td>
											<th>전자신고 완료</td>
											<td><label name="COMP_DATE" id="COMP_DATE" /></label></td>
										</tr>
										<tr>
											<th>전자신고번호</td>
											<td colspan=3><label name="NUM_E_REPORT" id="NUM_E_REPORT" /></label></td>
											
										</tr>
										<tr>
											<th>접수증/신고서</td>
											<td><label name="REC_REP" id="REC_REP" /></label></td>
											<th>납부서</td>
											<td><label name="PAYMENT" id="PAYMENT" /></label></td>
										</tr>
										<tr>
											<th>납부서 전달일</td>
											<td><label name="DEL_DATE_PAYMENT" id="DEL_DATE_PAYMENT" /></label></td>
											<th>납부서 전달방법</td>
											<td><label name="DEL_TYPE_PAYMENT" id="DEL_TYPE_PAYMENT" /></label></td>
										</tr>
										<tr>
											<th>납부서 확인일</td>
											<td><label name="CONF_DATE_PAYMENT" id="CONF_DATE_PAYMENT" /></label></td>
											<th>납부서 다운로드</td>
											<td><label name="DOWN_PAYMENT" id="DOWN_PAYMENT" /></label></td>
										</tr>
										<tr>
											<th>메모</td>
											<td colspan=3><label name="MEMO" id="MEMO" /></label></td>
										</tr>
										<tr>
											<th>오류 이력</td>
											<td colspan=3><label name="ERROR" id="ERROR" /></label></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<h2>평가</h2>
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
											<th>평점</td>
											<td>
												<input type="radio">5
												<input type="radio">4
												<input type="radio">3
												<input type="radio">2
												<input type="radio">1
											</td>
											<th>평가일</td>
											<td><label name="CST_BIRTH" id="CST_BIRTH" /></label></td>
										</tr>
										<tr>
											<th>리뷰</td>
											<td colspan=3><label name="INFO_TYPE" id="INFO_TYPE" /></label></td>
											
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>
						<div class="btn w100" style="margin:5px 0 15px;">
        					<button name="delete" id="delete">삭제</button>
        					<button name="update2" id="update2" >수정</button>
        					<button name="list" id="list">목록</button>
        				</div>





					</div>
				</div>
			</div>
		</div>
		<br>

		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
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


	//수정
	$('#update').click(function(){
		update_();
	});
	$('#update2').click(function(){
		update_();
	});


    	//목록가기
    $('#list').click(function(){
    	window.location.href="list_RPA_vat.php";
    });
    $('#list2').click(function(){
    	window.location.href="list_RPA_vat.php";
    });



	function update_(){
		var request = new Request();
		var id = request.getParameter("id");
		window.location.replace("write_vat_cst.php?id="+id);
	}
		

fetchUser();

function fetchUser()
{

	var action = "select_view_vat";
	var request = new Request();

	var id = request.getParameter("id");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			$('#COMP_NAME').html(data.COMP_NAME);
			$('#CSTNAME').html(data.CSTNAME);
			$('#BIZ_ID_NUM').html(data.BIZ_ID_NUM);
			$('#RESIDENT_ID').html(data.RESIDENT_ID);
			$('#OPENING_DAY').html(data.OPENING_DAY);
			$('#BIZ_REG_DATE').html(data.BIZ_REG_DATE);
			$('#SECTOR').html(data.SECTOR);
			$('#BIZ_CATE').html(data.BIZ_CATE);
			$('#COMP_ADDRESS').html(data.COMP_ADDRESS);
			$('#HomeTaxID').html(data.HomeTaxID);
			$('#HomeTaxPW').html(data.HomeTaxPW);
			$('#COMP_PHONE').html(data.COMP_PHONE);
			$('#RESIDENT_ID').html(data.RESIDENT_ID);
			$('#MOBILE').html(data.MOBILE);
			$('#EMAIL').html(data.EMAIL);
			$('#E_NOTICE_DATE').html(data.E_NOTICE_DATE);
			$('#DOUZONE_SVR').html(data.DOUZONE_SVR);
			$('#DOUZONE_CODE').html(data.DOUZONE_CODE);
			$('#REG_BRANCH').html(data.REG_BRANCH);
			$('#REGDATE').html(data.REGDATE);
			$('#REGUSER').html(data.REGUSER);
			$('#CST_TYPE').html(data.CST_TYPE);
			$('#INF_PATH').html(data.INF_PATH);
			$('#INF_CHANNEL').html(data.INF_CHANNEL);
			$('#UTM_S').html(data.UTM_S);
			$('#UTM_T').html(data.UTM_T);
			$('#UTM_C').html(data.UTM_C);
			$('#UTM').html(data.UTM);
			$('#EST_FEE').html(data.EST_FEE);
			$('#DEP_FEE').html(data.DEP_FEE);
			$('#DEP_TYPE').html(data.DEP_TYPE);
			//$('#CASH_REC').html(data.CASH_REC);
			$('input:radio[name=CASH_REC]:input[value=' + data.CASH_REC + ']').attr("checked", true);

			$('#DEP_DATE').html(data.DEP_DATE);
			$('#CASH_REC_DATE').html(data.CASH_REC_DATE);
			$('#SUBM_DATE').html(data.SUBM_DATE);
			$('#SUBM_DATE2').html(data.SUBM_DATE2);
			$('#EXT_DATE').html(data.EXT_DATE);
			$('#ATTACH_FILE').html(data.ATTACH_FILE);
			$('#COMP_REG_DATE').html(data.COMP_REG_DATE);
			$('#DEC_REGUSER').html(data.DEC_REGUSER);
			$('#REQ_E_REPORT').html(data.REQ_E_REPORT);
			$('#REQ_USER').html(data.REQ_USER);
			$('#REQ_DATE').html(data.REQ_DATE);
			$('#COMP_DATE').html(data.COMP_DATE);
			$('#NUM_E_REPORT').html(data.NUM_E_REPORT);
			$('#REC_REP').html(data.REC_REP);
			$('#PAYMENT').html(data.PAYMENT);
			$('#DEL_DATE_PAYMENT').html(data.DEL_DATE_PAYMENT);
			$('#CONF_DATE_PAYMENT').html(data.CONF_DATE_PAYMENT);
			$('#DOWN_PAYMENT').html(data.DOWN_PAYMENT);
			$('#MEMO').html(data.MEMO);
			$('#ERROR').html(data.ERROR);


		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


fetchUser2('TB100024');
function fetchUser2(flag)
{

	var action = "select_view_vat_ext";
	var request = new Request();

	var cstid = request.getParameter("id");
	var bizid = request.getParameter("id2");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{cstid:cstid,flag:flag, action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			if(flag=="TB100024"){
				console.log(data);
				if(data.OPTION1 =="Y") $('#OPTION1').css('display','block');
				if(data.OPTION2 =="Y") $('#OPTION2').css('display','block');
				if(data.OPTION3 =="Y") $('#OPTION3').css('display','block');
				if(data.OPTION4 =="Y") $('#OPTION4').css('display','block');
				if(data.OPTION5 =="Y") $('#OPTION5').css('display','block');
				if(data.OPTION6 =="Y") $('#OPTION6').css('display','block');
				/*
				if(data.OPTION7 =="Y") $('OPTION7').css('display','');
				if(data.OPTION8 =="Y") $('OPTION8').css('display','');
				if(data.OPTION9 =="Y") $('OPTION9').css('display','');
				if(data.OPTION10 =="Y") $('OPTION10').css('display','');
				if(data.OPTION11 =="Y") $('OPTION11').css('display','');		
				*/
			}			
			//alert(data);

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}





});



</script>
</html>