<?php
   $ip_ck= $_SERVER["REMOTE_ADDR"];
 /*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 ADMIN</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="신승세무법인 ADMIN">
	<meta property="og:url" content="https://taxtok.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="../resources/images/sum2.png">
	<link rel="shortcut icon" href="../resources/images/icon.ico">
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
border-radius:5px;
margin-top:100px;

ol.timeline
{
list-style:none
}
ol.timeline li
{
position:relative;
border-bottom:1px #dedede dashed;
padding:8px;
}


</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 


</head>
<body>

<div class="container box" style="width:400px;margin:0 0 0 50px;">
<span>
<img src="resources/images/new_logo.png">
</span>
<br><br>
<form id="uploadForm" method="post" enctype="multipart/form-data" action="excel_upload.php">
<BR>
<table border="1" >
<tbody>
	<colgroup>
		<col width="100px">
		<col width="300px">
		<col width="300px">
	</colgroup>
	<thead>
	<tr style="text-align:center;height:50px;">
		<th style="text-align:center;"></th>
		<th style="text-align:center;">구분</th>
		<th style="text-align:center;">업로드양식</th>
	</tr>
	</thead>
	<tr style="text-align:center;height:50px;">
		<td><input type="radio" name="rd_flag" id="rd_flag" value="cash_report"></td>
		<td>현금영수증</td>
		<td><a href="upload_income/template_upload_cashreport.xlsx">down</a></td>
	</tr>
	<tr style="text-align:center;height:50px;">
		<td><input type="radio" name="rd_flag" id="rd_flag" value="hometax_print"></td>
		<td>홈택스안내문</td>
		<td><a href="upload_income/template_upload_cashreport.xlsx">down</a></td>
	</tr>
	<!-- tr style="text-align:center;height:50px;">
		<td><input type="radio" name="rd_flag" id="rd_flag" value="consign"></td>
		<td>수임동의</td>
		<td><a href="#">down</a></td>
	</tr-->
	<tr style="text-align:center;height:50px;">
		<td><input type="radio" name="rd_flag" id="rd_flag" value="hometax_print"></td>
		<td>홈택스</td>
		<td><a href="upload_income/template_upload_hometax_print.xlsx">down</a></td>
	</tr>
	<tr style="text-align:center;height:50px;">
		<td><input type="radio" name="rd_flag" id="rd_flag" value="comp_reg"></td>
		<td>회사등록</td>
		<td><a href="upload_income/template_upload_comp_reg.xlsx">down</a></td>
	</tr>
	<tr style="text-align:center;height:50px;">
		<td><input type="radio" name="rd_flag" id="rd_flag" value="smarta"></td>
		<td>전자신고1</td>
		<td><a href="upload_income/template_upload_hometax_upload.xlsx">down</a></td>
	</tr>
	<!-- tr style="text-align:center;height:50px;">
		<td><input type="radio" name="rd_flag" id="rd_flag" value="hometax_upload"></td>
		<td>전자신고2</td>
		<td><a href="#">down</a></td>
	</tr-->
	<tr style="text-align:center;height:50px;">
		
		<td colspan=2><input name="excelFile" id="excelFile" type=file style="width:200px;" /></td>
		<td><input type=submit name="action" id="action" value="업로드" style="width:150px;height:45px;background-color:blanchedalmond;color:red;"/></td>
	</tr>
</tbody>
</table>




<br>
	<br>
	
</form>
</div>

</body>
</html>