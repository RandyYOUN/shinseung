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

					<div class="dashwrap" style="width:1390px;">

						<h2>신고안내유형 및 기장의무 안내</h2>
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
											<th>성명</td>
											<td><label name="CSTNAME" id="CSTNAME"  /></label></td>
											<th>생년월일</td>
											<td><label name="CST_BIRTH" id="CST_BIRTH" /></label></td>
										</tr>
										<tr>
											<th>안내유형</td>
											<td><label name="INFO_TYPE" id="INFO_TYPE" /></label></td>
											<th>ARS개별인증번호</td>
											<td><label name="ARS_CERT_NUM" id="ARS_CERT_NUM" /></label></td>
										</tr>
										<tr>
											<th>기장의무</td>
											<td><label name="DUTY_TYPE" id="DUTY_TYPE" /></label></td>
											<th>추계시 적용 경비율</td>
											<td><label name="EXP_RATIO" id="EXP_RATIO" /></label></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<h2>사업장별 수입금액</h2>
						<div class="dashcon">
							<div class="dashboard02">
								<table>
									<colgroup>
										<col width="150px">
										<col width="">
										<col width="150px">
										<col width="">
										<col width="">
										<col width="">
										<col width="">
										<col width="80px">
										<col width="80px">
										<col width="110px">
										<col width="110px">
									</colgroup>
									<thead>
										<tr>
											<th rowspan="2">사업장등록번호</th>
											<th rowspan="2">상호</th>
											<th rowspan="2">수입종류구분코드</th>
											<th rowspan="2">업종코드</th>
											<th rowspan="2">사업형태</th>
											<th rowspan="2">기장의무</th>
											<th rowspan="2">수입금액</th>
											<th colspan="2">기준경비율</th>
											<th colspan="2">단순경비율</th>
										</tr>
										<tr>
											<th>일반</th>
											<th>자가</th>
											<th>일반(기본)</th>
											<th>자가(초과)</th>
										</tr>
									</thead>
									<tbody id="result">
									</tbody>
								</table>
							</div>
						</div>

						<h2>타소득(합산대상) 자료유무</h2>
						<div class="dashcon">
							<div class="dashboard">
								<table>
									<thead>
										<tr>
											<th rowspan="2">소득종류</th>
											<th rowspan="2">이자</th>
											<th rowspan="2">배당</th>
											<th colspan="2">근로</th>
											<th rowspan="2">연금</th>
											<th rowspan="2">기타</th>
										</tr>
										<tr>
											<th>단일</th>
											<th>복수</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>해당여부</th>
											<td><label name="INTEREST" id="INTEREST"/></label></td>
											<td><label name="ALLOCATION" id="ALLOCATION" /></label></td>
											<td><label name="WORK_SINGLE" id="WORK_SINGLE" /></label></td>
											<td><label name="WORK_PLUR" id="WORK_PLUR" /></label></td>
											<td><label name="INFORMAL" id="INFORMAL" /></label></td>
											<td><label name="ETC" id="ETC"></label></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<div class="dashcon">
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="250px">
										<col width="">
									</colgroup>
									<tbody>
										<tr>
											<th>종교인기타 소득유무</td>
											<td><span>X</span></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<h2>공제 참고자료</h2>
						<div class="dashcon">
							<div class="dashboard">
								<table>
									<thead>
										<tr>
											<th colspan="2">구분</th>
											<th>납입액(부담액)</th>
											<th>공제 가능액</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th colspan="2">중간예납세액(기납부세액)</th>
											<td><label name="EXI_TAX" id="EXI_TAX"/></label></td>
											<td>중간예납세액 전액</td>
										</tr>
										<tr>
											<th rowspan="4">소득공제항목</th>
											<td>국민연금보험료</td>
											<td><label name="NPIP" id="NPIP"/></label></td>
											<td>납부액전액</td>
										</tr>
										<tr>
											<td>국민연금보험료</td>
											<td><label name="NPIP" id="NPIP"/></label></td>
											<td>납부액전액</td>
										</tr>
										<tr>
											<td>개인연금저축</td>
											<td><label name="PERSON_SAVE" id="PERSON_SAVE"/></label></td>
											<td>납입액의 40%와 72만원 중 적은 금액</td>
										</tr>
										<tr>
											<td>소기업소상공인공제부금 (노란우산공제)</td>
											<td><label name="SMALL_BIZ_DED" id="SMALL_BIZ_DED"/></label></td>
											<td>납입액과 200만원(사업소득 1억원초과),
												300만원(사업소득 1억원이하),
												500만원(사업소득 4천만원이하)
												중 적은 금액</td>
										</tr>
										<tr>
											<th rowspan="2">세액공제항목</th>
											<td>퇴직연금세액공제</td>
											<td><label name="RET_SAVE" id="RET_SAVE"/></label></td>
											<td rowspan="2">[퇴직연금+연금저축(연 400만원 한도)]
												납입액(연 700만원 한도)의 12%</td>
										</tr>
										<tr>
											<td>연금계좌세액공제</td>
											<td><label name="PEN_SAVE" id="PEN_SAVE"/></label></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<h2>최근 3년간 종합소득세 신고상황 (단위 : 천원)</h2>
						<div class="dashcon">
							<div class="dashboard02">
								<table>
									<colgroup>
										<col width="">
										<col width="">
										<col width="">
										<col width="">
									</colgroup>
									<thead>
										<tr>
											<th>구분</th>
											<th>2016귀속</th>
											<th>2017귀속</th>
											<th>2018귀속</th>
										</tr>
									</thead>
									<tbody id="result2">
									</tbody>
								</table>
							</div>
						</div>

						<h2>2018년 매출액 대비 주요 판관비율 분석(주사업장 기준)(단위: 천원)</h2>
						<div class="dashcon">
							<div class="dashboard02">
								<table>
									<colgroup>
										<col width="">
										<col width="">
										<col width="">
										<col width="">
									</colgroup>
									<thead>
										<tr>
											<th>계정과목</th>
											<th>금액</th>
											<th>당해업체(%)</th>
											<th>업종평균(%)</th>
										</tr>
									</thead>
									<tbody id="result3">
									</tbody>
								</table>
							</div>
						</div>

						<h2>2019년 사업용 신용카드 사용현황분석 (단위: 건원)</h2>
						<div class="dashcon">
							<div class="dashboard02">
								<table>
									<colgroup>
										<col width="">
										<col width="">
										<col width="">
										<col width="">
										<col width="">
										<col width="">
										<col width="">
									</colgroup>
									<thead>
										<tr>
											<th>구분</th>
											<th>합계</th>
											<th>신변잡화구입</th>
											<th>가정용품구입</th>
											<th>업무무관업소이용</th>
											<th>개인적치료</th>
											<th>해외사용액</th>
										</tr>
									</thead>
									<tbody id="result4">
									</tbody>
								</table>
							</div>
						</div>


					</div>
				</div>
			</div>
		</div>

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


fetchUser();
fetchUser2('TB300020');
fetchUser2('TB300040');
fetchUser2('TB300050');
fetchUser2('TB300060');

function fetchUser()
{

	var action = "select_view";
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
			$('#CSTNAME').html(data.CSTNAME);
			$('#CST_BIRTH').html(data.CST_BIRTH);
			$('#MOBILE').html(data.MOBILE);
			$('#RESIDENT_ID').html(data.RESIDENT_ID);
			$('#BRANCH').html(data.BRANCH);
			$('#SECTOR').html(data.SECTOR);
			$('#SECTOR_CODE').html(data.SECTOR_CODE);
			$('#INFO_TYPE').html(data.INFO_TYPE);
			$('#ARS_CERT_NUM').html(data.ARS_CERT_NUM);
			$('#DUTY_TYPE').html(data.DUTY_TYPE);
			$('#EXP_RATIO').html(data.EXP_RATIO);
			$('#INTEREST').html(data.INTEREST);
			$('#ALLOCATION').html(data.ALLOCATION);
			$('#WORK_SINGLE').html(data.WORK_SINGLE);
			$('#WORK_PLUR').html(data.WORK_PLUR);
			$('#INFORMAL').html(data.INFORMAL);
			$('#ETC').html(data.ETC);
			$('#EXI_TAX').html(data.EXI_TAX);
			$('#NPIP').html(data.NPIP);
			$('#PERSON_SAVE').html(data.PERSON_SAVE);
			$('#SMALL_BIZ_DED').html(data.SMALL_BIZ_DED);
			$('#RET_SAVE').html(data.RET_SAVE);
			$('#PEN_SAVE').html(data.PEN_SAVE);

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


function fetchUser2(flag)
{

	var action = "select_view_ext";
	var request = new Request();

	var id = request.getParameter("id");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,flag:flag, action:action},
		dataType:"text",
		success:function(data)
		{
			console.log(data);
			if(flag=="TB300020"){
				$('#result').html(data);
			}else if(flag=="TB300040"){
				$('#result2').html(data);
			}else if(flag=="TB300050"){
				$('#result3').html(data);
			}else if(flag=="TB300060"){
				$('#result4').html(data);
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