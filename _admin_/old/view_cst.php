<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>crud</title>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
<script type="text/javascript" src="../news/se2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
-->
<!-- Bootstrap -->



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border:1px solid #ccc;
border-radius:5px;
margin-top:100px;


}

</style>

<!-- jquery, bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- codemirror -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>

<!-- add summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/lang/summernote-ko-KR.min.js"></script>



</head>
<body>
<form name="uploadForm" id="uploadForm" method="post" action="upload_process.php"     enctype="multipart/form-data" onsubmit="return formSubmit(this);">

<div class="container box">
	<span>
		<img src="resources/images/new_logo.png" align="center">
	</span>

	<br/><br/>
	<br/><br/>
	<TABLE class="table-responsive"  style="width:100%;" border=1 >
		<TR style="height:40px;">
			<TD COLSPAN=4 style="text-align:center;"><b>종합소득세 신고 안내정보</b></TD>
		</TR>
		<TR style="height:40px;">
			<TD COLSPAN=4 >※신고안내유형 및 기장의무 안내</TD>
		</TR>
		<TR style="height:40px;text-align:center;">
			<TD width="20%">성명</TD>
			<TD width="30%"><label name="CSTNAME" id="CSTNAME"  /></label></TD>
			<TD width="20%">생년월일</TD>
			<TD width="30%"><label name="CST_BIRTH" id="CST_BIRTH" /></label></TD>
		</TR>
		<TR style="height:40px;text-align:center;">
			<TD width="20%">안내유형</TD>
			<TD width="30%"><label name="INFO_TYPE" id="INFO_TYPE" /></label></TD>
			<TD width="20%">ARS개별인증번호</TD>
			<TD width="30%"><label name="ARS_CERT_NUM" id="ARS_CERT_NUM" /></label></TD>
		</TR>
		<TR style="height:40px;text-align:center;">
			<TD width="20%">기장의무</TD>
			<TD width="30%"><label name="DUTY_TYPE" id="DUTY_TYPE" /></TD>
			<TD width="20%">추계시 적용경비율</TD>
			<TD width="30%"><label name="EXP_RATIO" id="EXP_RATIO" /></label></TD>
		</TR>
	</TABLE>


	<br/>

	<table class="table table-bordered" style="width:100%;" >
		<tbody id="result">
		</tbody>
	</table>

	<TABLE class="table-responsive"  style="width:100%;" border=1 >
		<TR style="height:40px;">
			<TD COLSPAN=7>※ 타소득(합산대상) 자료유무</TD>
		</TR>
		<TR style="height:40px;text-align:center;">
			<TD rowspan=2 width="15%" >소득종류</TD>
			<TD rowspan=2 width="15%" >이자</TD>
			<TD rowspan=2 width="15%" >배당</TD>
			<TD colspan=2 width="15%" >근로</TD>
			<TD rowspan=2 width="15%" >연금</TD>
			<TD rowspan=2 width="15%" >기타</TD>
		</TR>
		<TR style="height:40px;text-align:center;">
			<td>단일</td>
			<td>복수</td>
		</tr>
		<TR style="height:40px;text-align:center;">
			<td>해당여부</td>
			<td><label name="INTEREST" id="INTEREST"/></label></td>
			<td><label name="ALLOCATION" id="ALLOCATION" /></label></td>
			<td><label name="WORK_SINGLE" id="WORK_SINGLE" /></label></td>
			<td><label name="WORK_PLUR" id="WORK_PLUR" /></label></td>
			<td><label name="INFORMAL" id="INFORMAL" /></label></td>
			<td><label name="ETC" id="ETC"></label></td>
		</tr>
		<TR style="height:40px;">
			<TD COLSPAN=7> ※ 종교인기타 소득유무 : X </TD>
		</TR>
		<TR style="height:40px;">
			<TD COLSPAN=7> <B>※ 공제 참고자료 </B></TD>
		</TR>
	</TABLE>
	<TABLE class="table-responsive"  style="width:100%;" border=1 >
		<thead>
		  <tr style="height:40px;text-align:center;">
			<th style="height:40px;text-align:center;" colspan="2">구분</th>
			<th style="height:40px;text-align:center;">납입액(부담액)</th>
			<th style="width:350px;height:40px;text-align:center;">공제 가능액</th>
		  </tr>
		</thead>
		<tbody>
		  <tr style="height:40px;">
			<td style="text-align:center;"  colspan="2">중간예납세액(기납부세액)</td>
			<td style="text-align:center;"><label name="EXI_TAX" id="EXI_TAX"/></label></td>
			<td style="text-align:left;" >중간예납세액 전액</td>
		  </tr>
		  <tr style="height:40px;text-align:center;">
			<td style="text-align:center;width:50px;" rowspan="3">소득<br>공제<br>항목</td>
			<td >국민연금보험료</td>
			<td style="text-align:center;"><label name="NPIP" id="NPIP"/></label></td>
			<td style="height:40px;text-align:left;">납부액전액</td>
		  </tr>
		  <tr style="height:40px;text-align:center;">
			<td >개인연금저축</td>
			<td style="text-align:center;"><label name="PERSON_SAVE" id="PERSON_SAVE"/></label></td>
			<td style="height:40px;text-align:left;">납입액의 40%와 72만원 중 적은 금액</td>
		  </tr>
		  <tr style="height:40px;text-align:center;">
			<td >소기업소상공인공제부금<br>(노란우산공제)</td>
			<td style="text-align:center;"><label name="SMALL_BIZ_DED" id="SMALL_BIZ_DED"/></label></td>
			<td style="height:40px;text-align:left;">납입액과 200만원(사업소득 1억원초과),<br>300만원(사업소득 1억원이하), <br>500만원(사업소득 4천만원이하) <br>중 적은 금액</td>
		  </tr>
		  <tr style="height:40px;text-align:center;">
			<td  rowspan="2">세액<br>공제<br>항목</td>
			<td >퇴직연금세액공제</td>
			<td style="text-align:center;"><label name="RET_SAVE" id="RET_SAVE"/></label></td>
			<td style="height:40px;text-align:left;" rowspan="2">[퇴직연금+연금저축(연 400만원 한도)]<br>납입액(연 700만원 한도)의 12%</td>
		  </tr>
		  <tr style="height:40px;text-align:center;">
			<td >연금계좌세액공제</td>
			<td style="text-align:center;"><label name="PEN_SAVE" id="PEN_SAVE"/></label></td>
		  </tr>
		</tbody>
	</TABLE>


<br><br>
	<table class="table table-bordered" style="width:100%;" >
		<tbody id="result2">
		</tbody>
	</table>

	<table class="table table-bordered" style="width:100%;" >
		<tbody id="result3">
		</tbody>
	</table>

	<table class="table table-bordered" style="width:100%;" >
		<tbody id="result4">
		</tbody>
	</table>

	<div align="center">
	<!-- 클릭했을 때 user id를 알 수 있게 숨겨 둔다.-->
		<input type="hidden" id="img_name" name="img_name">
		<input type="hidden" id="file_name" name="file_name">
		<input type="hidden" name="id" id="user_id" />
		<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
		<input type="hidden" name="file_url_tmp" id="file_url_tmp" />
		
	</div>
	
	<br/><br/><br/><br/><br/><br/> 
</div>
</form>
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

	var action = "select";
	var request = new Request();

	var id = request.getParameter("id");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"fetch_view.php",
		method:"POST",
		data:{id:id},
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

	var action = "select";
	var request = new Request();

	var id = request.getParameter("id");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select_view.php",
		method:"POST",
		data:{id:id,flag:flag},
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


</body>
</html>