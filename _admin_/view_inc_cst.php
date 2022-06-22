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

					<h1>종소세 정보</h1>
				<div class="btn w100" style="margin:5px 0 15px;">
					<button name="delete" id="delete">삭제</button>
					<button name="update" id="update" >수정</button>
					<button name="list" id="list">목록</button>
					<button name="info" id="info" style="background-color:green;color:white;">안내문</button>
				</div>
					<div class="dashwrap" style="width:1550px;">

						<h2>고객기본정보</h2>
						<div class="dashcon">
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="200px">
										<col width="150px">
										<col width="200px">
										<col width="150px">
										<col width="200px">
										<col width="150px">
									</colgroup>
									<tbody>
										<tr>
											<th>성명(대표자)</td>
											<td><label name="CSTNAME" id="CSTNAME"  /></label></td>
											<th>핸드폰</td>
											<td><label name="MOBILE" id="MOBILE" /></label></td>
											<th>주민등록번호(대표자)</td>
											<td><label name="RESIDENT_ID" id="RESIDENT_ID" /></label></td>
										</tr>
										<tr>
											<th>신규여부</td>
											<td><label name="NEW_CST_CK" id="NEW_CST_CK" /></label></td>
											<th>카카오채널 등록여부</td>
											<td><label name="KAKAO_REG" id="KAKAO_REG" /></label></td>
											<th>EMAIL</td>
											<td><label name="EMAIL" id="EMAIL" /></label></td>
										</tr>
										<tr>
											<th>홈택스ID</td>
											<td><label name="HomeTaxID" id="HomeTaxID" /></label></td>
											<th>홈택스PW</td>
											<td><label name="HomeTaxPW" id="HomeTaxPW" /></label></td>
											<th>관리등급</td>
											<td><label name="MNG_GRADE" id="MNG_GRADE" /></label></td>
										</tr>
										<tr>
											<th>환급은행</td>
											<td><label name="REF_BANK" id="REF_BANK" /></label></td>
											<th>환금계좌</td>
											<td><label name="REF_ACC" id="REF_ACC" /></label></td>
											<th>계좌주</td>
											<td><label name="ACC_HOLDER" id="ACC_HOLDER" /></label></td>
										</tr>
										<tr>
											<th>더존서버</td>
											<td><label name="DOUZONE_SVR" id="DOUZONE_SVR" /></label></td>
											<th>더존코드</td>
											<td><label name="DOUZONE_CODE" id="DOUZONE_CODE" /></label></td>
											<th>수임여부</td>
											<td><label name="PROGRESS" id="PROGRESS" /></label></td>
										</tr>
										<tr>
											<th>주소</td>
											<td><label name="" id="" /></label></td>
											<th colspan=4><label name="" id="" /></label></tH>
										</tr>
										<tr>
											<th>고객메모</td>
											<td colspan=5><label name="MEMO" id="MEMO" /></label></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<h2>종소세 접수정보</h2>
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
										<col width="100px">
									</colgroup>
									<thead>
                                		<tr>
                                			<th>상호</th>
                                			<th>구분</th>
                                			<th>연도(기수)</th>
                                			<th>수임금액(납입금액)</th>
                                			<th>등록일</th>
                                			<th>마감일</th>
                                			<th>안내문</th>
                                		</tr>
                                		</thead>
									<tbody>
<?php 
$procedure = "
	CREATE PROCEDURE SELECT_ALL_JOB_CST( IN P_CSTID INT(11) )
	BEGIN
		SELECT B.COMP_NAME, CODE_TO_STR( B.CST_TYPE ) AS CST_TYPE,FORMAT(B.EST_FEE,0) AS EST_FEE_, 
B.CST_TYPE_YEAR, B.CST_TYPE_SEQ, FORMAT(B.DEP_FEE,0) AS DEP_FEE_ , DATE_FORMAT(B.REGDATE, '%Y-%m-%d') 'REGDATE_' , 
DATE_FORMAT(B.DEADLINE_DATE, '%Y-%m-%d') 'DEADLINE_DATE_',CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
substring( REPLACE(A.MOBILE,'-',''),4) MOBILE_PATH
FROM TB100020 AS A LEFT OUTER JOIN 
TB100022 AS B ON A.CSTID = B.CSTID
WHERE B.CST_TYPE= 'A1001' AND A.CSTID = P_CSTID ORDER BY B.REGDATE DESC;
	END;
	";
$path = "../tax_income/upload/2021/";
if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_ALL_JOB_CST"))
{
    if(mysqli_query($connect,$procedure))
    {
        $query = "CALL SELECT_ALL_JOB_CST(".$_GET["id"].")";
        $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
        
        if(mysqli_num_rows($result) >0)
        {
            
            while($row = mysqli_fetch_array($result)){
                $FILE_CNT1=0;
                $DOWN_PATH_INFO = $path.$row["REG_BRANCH_PATH"]."/안내문/".$row["CSTNAME"].$row["MOBILE_PATH"]."/";
                
                if($hostname=="localhost")
                    $dir1 = $DOWN_PATH_INFO;
                    else
                        $dir1 = iconv("UTF-8","CP949",$DOWN_PATH_INFO);
                        
                        if (is_dir($dir1)){
                            if ($dh = opendir($dir1)){                     //$df = array_diff(scandir($dir),$ignore);
                                while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
                                    continue;
                                }else{
                                    $FILE_CNT1++;
                                }
                                
                                }
                                closedir($dh);
                            }
                        }
                        
                        if($FILE_CNT1 > 0){
                            $DOWN_URL_INFO = "<a href='javascript:open_file_pay(".$row["ID"].");'>파일</a>";
                        }else{
                            $DOWN_URL_INFO = "";
                        }
                        
                $output .= '
					<tr>
						<td style="text-align:center;">'.$row["COMP_NAME"].'</td>
						<td style="text-align:center;">'.$row["CST_TYPE"].'</td>
						<td style="text-align:center;">'.$row["CST_TYPE_YEAR"].'('.$row["CST_TYPE_SEQ"].'기)</td>
						<td style="text-align:center;">'.$row["EST_FEE_"].'원 ('.$row["DEP_FEE_"].'원)</td>
                        <td style="text-align:center;">'.$row["REGDATE_"].'</td>
                        <td style="text-align:center;">'.$row["DEADLINE_DATE_"].'</td>
                        <td>'.$DOWN_URL_INFO.'</td>
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
												<input type="radio" id="REV_SCORE" value=5>5
												<input type="radio" id="REV_SCORE" value=4>4
												<input type="radio" id="REV_SCORE" value=3>3
												<input type="radio" id="REV_SCORE" value=2>2
												<input type="radio" id="REV_SCORE" value=1>1
											</td>
											<th>평가일</td>
											<td><label name="REV_REGDATE" id="REV_REGDATE" /></label></td>
										</tr>
										<tr>
											<th>리뷰</td>
											<td colspan=3><label name="REV_CONTENT" id="REV_CONTENT" /></label></td>
											
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>

						<!-- h2>상세정보</h2>
						<div class="dashcon">
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="200px">
										<col width="150px">
										<col width="200px">
										<col width="150px">
										<col width="200px">
										<col width="150px">
									</colgroup>
									<tbody>
										<tr>
											<th>상담 진행상태</td>
											<td><label name="PROGRESS" id="PROGRESS"  /></label></td>
											<th>상담자(영업담당자)</td>
											<td><label name="" id=""  /></label></td>
											<th>1.예상세액계산</td>
											<td><A href="write_cal.php">계산</A></td>
										</tr>
										<tr>
											<th>전년도 매출합계</td>
											<td><label name="" id="" /></label></td>
											<th>예상납부세액</td>
											<td><label name="EXP_PAY_TAX_SELF" id="EXP_PAY_TAX_SELF" /></label></td>
											<th>예상수수료</td>
											<td><label name="EST_FEE_SELF" id="EST_FEE_SELF" /></label></td>
										</tr>
										<tr>
											<th>수동톡1</th>
											<td><a href="">발송</a><label name="" id="" /></label></td>
											<th>자동톡1</th>
											<td><label name="" id="" /></label></td>
											<th>수동톡2</th>
											<td><a href="">발송</a><label name="" id="" /></label></td>
										</tr>
										<tr>
											<th>유입채널</th>
											<td><label name="INF_CHANNEL" id="INF_CHANNEL" /></label></td>
											<th>유입소스</th>
											<td><label name="INF_PATH" id="INF_PATH" /></label></td>
											<th>유입기기</th>
											<td><label name="INF_GEAR" id="INF_GEAR" /></label></td>
										</tr>
										<tr>
											<th>중요도</th>
											<td><label name="INF_CHANNEL" id="INF_CHANNEL" /></label></td>
											<th>검색키워드</th>
											<td colspan=3><label name="INF_PATH" id="INF_PATH" /></label></td>
											
										</tr>
										<tr>
											<th>상담메모</th>
											<td colspan=5><label name="MEMO" id="MEMO" /></label></td>
										</tr>
										
										<tr>
											<th>접수 진행상태</td>
											<td><label name="PROGRESS" id="PROGRESS"  /></label></td>
											<th>접수지점</td>
											<td></td>
											<th>2.입금확인</td>
											<td><label name="" id="" /></label></td>
										</tr>
										<tr>
											<th>입금금액</td>
											<td><label name="" id=""  /></label></td>
											<th>결제방법</td>
											<td></td>
											<th>입금일자</td>
											<td><label name="" id="" /></label></td>
										</tr>
										<tr>
											<th>입금메모</th>
											<td colspan=5><label name="MEMO" id="MEMO" /></label></td>
										</tr>
										
										<tr>
											<th>영수증 방급방법</td>
											<td>
												<input type="radio" ID="CASH_REC" NAME="CASH_REC" value="c">현금영수증
												<input type="radio" ID="CASH_REC" NAME="CASH_REC" value="t">세금계산서
											</td>
											<th>영수증 방급일자</td>
											<td><label name="CASH_REC_DATE" id="CASH_REC_DATE" /></label></td>
											<th>3.영수증 방급요청</td>
											<td><a href="">요청</a></td>
										</tr>
										
										<tr>
											<th>홈택스 자료추출일</td>
											<td><label name="" id="" /></label></td>
											<th>지급명세서 수량</td>
											<td><label name="" id="" /></label></td>
											<th>5.자료추출 요청</td>
											<td><a href="">요청</a></td>
										</tr>
										
										<tr>
											<th>자료추출</td>
											<td colspan=5><label name="" id="" /></label></td>
										</tr>
										
										<tr>
											<th>첨부파일</td>
											<td colspan=5><label name="" id="" /></label></td>
										</tr>
										
										<tr>
											<th>더존 회사등록 여부</td>
											<td><label name="" id="" /></label></td>
											<th>회사등록일자</td>
											<td><label name="" id="" /></label></td>
											<th>6.회사등록 요청</td>
											<td><a href="">요청</a></td>
										</tr>
										
										<tr>
											<th>신고서 작성담당</td>
											<td><label name="" id="" /></label></td>
											<th>작성담당 배정일</td>
											<td><label name="" id="" /></label></td>
											<th>배정담당</td>
											<td></td>
										</tr>
										
										<tr>
											<th>신고서 검토결과</td>
											<td><label name="" id="" /></label></td>
											<th>신고서 결재일</td>
											<td><label name="" id="" /></label></td>
											<th>신고서 결재담당</td>
											<td></td>
										</tr>
										
										<tr>
											<th>전자신고 요청자</td>
											<td><label name="" id="" /></label></td>
											<th>전자신고 요청일</td>
											<td><label name="" id="" /></label></td>
											<th>7.전자신고 요청</td>
											<td><a href="">요청</a></td>
										</tr>
										
										<tr>
											<th>홈택스 전자신고번호</td>
											<td colspan=5><label name="" id="" /></label></td>
										</tr>
										
										<tr>
											<th>홈택스 접수증 / 신고서</td>
											<td><label name="" id="" /></label></td>
											<th>홈택스 납부서</td>
											<td><label name="" id="" /></label></td>
											<th>홈택스 납부서 다운로드</td>
											<td></td>
										</tr>
										<tr>
											<th>위택스 전자신고번호</td>
											<td colspan=5><label name="" id="" /></label></td>
										</tr>
										<tr>
											<th>위택스 접수증 / 신고서</td>
											<td><label name="" id="" /></label></td>
											<th>위택스 납부서</td>
											<td><label name="" id="" /></label></td>
											<th>위택스 납부서 다운로드</td>
											<td></td>
										</tr>
										
										<tr>
											<th>납부서 전송방법</td>
											<td><label name="" id="" /></label></td>
											<th>납부서 전송일</td>
											<td><label name="" id="" /></label></td>
											<th>8. 납부서 전송 요청</td>
											<td><a href="">요청</a></td>
										</tr>
										
										
										
										<tr>
											<th>홈택스 수임여부</td>
											<td>
												<input type="radio" ID="CASH_REC" NAME="CASH_REC" value="c">현금영수증
												<input type="radio" ID="CASH_REC" NAME="CASH_REC" value="t">세금계산서
											</td>
											<th>홈택스 방급일자</td>
											<td><label name="CASH_REC_DATE" id="CASH_REC_DATE" /></label></td>
											<th>4.수임동의요청</td>
											<td><a href="">요청</a></td>
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
						</div-->

						
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
	<input type="hidden" id="tmp_cstname" name="tmp_cstname">
	<input type="hidden" id="tmp_mobile" name="tmp_mobile">
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

	$('#info').click(function(){
		var request = new Request();
		var id = request.getParameter("id");
		window.open("view_cst.php?id="+id);
	});


	//수정
	$('#update').click(function(){
		update_();
	});
	$('#update2').click(function(){
		update_();
	});


    	//목록가기
    $('#list').click(function(){
    	go_list();
    });
    $('#list2').click(function(){
    	go_list();
    });

	function go_list(){
		var request = new Request();
		var flag = request.getParameter("listflag");

		switch(flag){
		case 'acc' : window.location.href="list_RPA_acc.php";
		break;
		case 'reg' : window.location.href="list_RPA_reg.php";
		break;
		case 'simple' : window.location.href="list_RPA_simple.php";
		break;
		}
		
	}

	function update_(){
		var request = new Request();
		var id = request.getParameter("id");
		window.location.replace("write_vat_cst.php?id="+id);
	}
		

fetchUser();

function fetchUser()
{

	var action = "select_view_inc";
	var request = new Request();

	var id = request.getParameter("id");
	var step = request.getParameter("step");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			
			$('#CSTNAME').html(data.CSTNAME);
			$('#tmp_cstname').val(data.CSTNAME);
			$('#MOBILE').html(data.MOBILE);
			$('#tmp_mobile').val(data.MOBILE);
			$('#RESIDENT_ID').html(data.RESIDENT_ID);
			$('#EMAIL').html(data.EMAIL);
			$('#HomeTaxID').html(data.HomeTaxID);
			$('#HomeTaxPW').html(data.HomeTaxPW);
			$('#REF_ACC').html(data.REF_ACC);
			$('#REF_BANK').html(data.REF_BANK);
			$('#ACC_HOLDER').html(data.ACC_HOLDER);
			$('#DOUZONE_SVR').html(data.DOUZONE_SVR);
			$('#DOUZONE_CODE').html(data.DOUZONE_CODE);
			$('#MEMO').html(data.MEMO);
			$('#KAKAO_REG').html(data.KAKAO_REG);
			$('#NEW_CST_CK').html(data.NEW_CST_CK);
			$('#MNG_GRADE').html(data.MNG_GRADE);
			$('#PROGRESS').html(data.PROGRESS);
			
			fetchReview();

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})

	if(step=="2"){
		window.open("write_inc_pop.php?id="+id);
		}
}


//fetchUser2('TB100024');
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


function fetchReview()
{

	var action = "select_cst_review";
	var request = new Request();

	var cstname = $("#tmp_cstname").val();
	var mobile = $("#tmp_mobile").val();
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{cstname:cstname,mobile:mobile, action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			$('#REV_CONTENT').html(data.REV_CONTENT);
			$('input[id="REV_SCORE"]:radio[value="'+data.REV_SCORE+'"]').prop('checked',true);
			//$("#REV_SCORE").attr( "disabled","true" );
			 $("input[id=REV_SCORE]").each(function(i) {       //testradio 버튼 전체 disable
	              $(this).attr('disabled', "true");
	          });
	
			$('#REV_REGDATE').html(data.REV_REGDATE);	
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