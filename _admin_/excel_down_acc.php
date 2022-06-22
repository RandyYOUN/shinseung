<?php
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면


$file_name = "종합소득세_접수현황_".time();
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$file_name .".xls" );
header( "Content-Description: PHP4 Generated Data" );

$s_option=mysqli_real_escape_string($connect,$_GET["s_option"]);
$g_option=mysqli_real_escape_string($connect,$_GET["g_option"]);
$s_str=mysqli_real_escape_string($connect,$_GET["s_str"]);
$depth=mysqli_real_escape_string($connect,$_GET["depth"]);
$userid=mysqli_real_escape_string($connect,$_GET["userid"]);
$s_date1=mysqli_real_escape_string($connect,$_GET["s_date1"]);
$s_date2=mysqli_real_escape_string($connect,$_GET["s_date2"]);

if($s_option != ""){
		switch($s_option){
			case "cstname" : 
				$WHERE_STR .= " AND A.CSTNAME like '%".$s_str."%' ";
				break;
			case "owner" : 
				$WHERE_STR .= " AND I.USERNAME like '%".$s_str."%' ";
				break;
			case "progress" : 
				$WHERE_STR .= " AND PROGRESS like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$WHERE_STR .= " AND B.USERNAME like '%".$s_str."%' ";
				break;
			case "mobile" : 
				$WHERE_STR .= " AND A.MOBILE like '%".$s_str."%' ";
				break;
			case "num" : 
				$WHERE_STR .= " AND A.ID = '".$s_str."' ";
				break;
			case "etc" : 
				$WHERE_STR .= " AND A.ETC LIKE '%".$s_str."%' ";
				break;
			case "deadline" : 
				$WHERE_STR .= " AND A.DEADLINE BETWEEN '".$s_date1."' AND '".$s_date2."' ";
				break;
			default:
				$WHERE_STR ="";
		}	
	}

	if($g_option != "" && $g_option != "ALL"){
		$WHERE_STR .= " AND A.REG_BRANCH = '".$g_option."'";	
	}

	if($depth == "D2005" && $userid !=""){
		$WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
	}



$sql = "SELECT
    A.CSTID AS 'ID',
	CODE_TO_STR(E.PROGRESS) 'PROGRESS',
	A.CSTNAME 'CSTNAME',
	A.MOBILE 'MOBILE',
NEW_CST_CK(A.CSTID) AS 'NEW_CST_CK',
DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',
FORMAT(B.EXP_PAY_TAX_SELF,0) AS 'EXP_PAY_TAX_SELF_',
FORMAT(B.DEP_FEE,0) AS 'DEP_FEE',
STEP_NAME( F.CashReport ) AS 'CashReport',
STEP_NAME( F.TaxInvoice ) AS 'TaxInvoice',
STEP_NAME( F.HomeTaxConsignment ) AS 'HomeTaxConsignment',
    STEP_NAME( F.SmartAToConvert) AS 'SmartAToConvert',
    STEP_NAME( F.HomeTaxUpload ) AS 'HomeTaxUpload',
    STEP_NAME( F.HomeTaxPrint ) AS 'HomeTaxPrint',
    STEP_NAME( F.HomeTaxNoticeDW ) AS 'HomeTaxNoticeDW',
    STEP_NAME( F.CompRegCheck ) AS 'CompRegCheck',
CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH',
B.DEC_REGUSER 'DEC_REGUSER' ,
C.DOUZONE_SVR 'DOUZONE_SVR',
C.DOUZONE_CODE 'DOUZONE_CODE',
CODE_TO_STR(B.CONFIRM) 'CONFIRM',
B.MEMO 'MEMO'

	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON A.CSTID=C.CSTID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
    LEFT OUTER JOIN TB980010 AS D2 ON D2.USERID = B.REGUSER
    LEFT OUTER JOIN TB100026 AS E ON B.BIZ_ID = E.BIZ_ID
    LEFT OUTER JOIN TB100023 AS F ON B.BIZ_ID = F.BIZ_ID
	WHERE E.PROGRESS IN ('E7208','E7210','E7211','E7212','E7209','E7214','E7213','E7215') 
    AND B.CST_TYPE = 'A1001' ".$WHERE_STR." 
ORDER BY B.REGDATE DESC;";

//$result = mysql_query($sql);
$result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <td>ID</td>
   <td>진행상태</td>
   <td>이름</td>
   <td>핸드폰</td>
   <td>신규여부</td>
   <td>접수일</td>
   <td>예상수수료</td>
   <td>입금금액</td>
   <td>현금영수증</td>
   <td>세금계산서</td>
   <td>수임동의</td>
<td>SmartA변환</td>
<td>홈택스신고</td>
<td>납부서다운로드</td>
<td>안내문다운로드</td>
<td>회사등록</td>
<td>지점</td>
<td>작성자</td>
<td>서버</td>
<td>코드</td>
<td>결재</td>
<td>메모</td>
</tr>";

while($row = mysqli_fetch_array($result)){
$EXCEL_STR .= "
   <tr>
       <td>".$row['ID']."</td>
	   <td>".$row['PROGRESS']."</td>
       <td>".$row['CSTNAME']."</td>
       <td>".$row['MOBILE']."</td>
	   <td>".$row['NEW_CST_CK']."</td>
       <td>".$row['REGDATE_']."</td>
       <td>".$row['EXP_PAY_TAX_SELF_']."</td>
	   <td>".$row['DEP_FEE']."</td>
       <td>".$row['CashReport']."</td>
       <td>".$row['TaxInvoice']."</td>
	   <td>".$row['HomeTaxConsignment']."</td>
       <td>".$row['SmartAToConvert']."</td>
	   <td>".$row['HomeTaxUpload']."</td>
       <td>".$row['HomeTaxPrint']."</td>
       <td>".$row['HomeTaxNoticeDW']."</td>
	   <td>".$row['CompRegCheck']."</td>
       <td>".$row['REG_BRANCH']."</td>
       <td>".$row['DEC_REGUSER']."</td>
	   <td>".$row['DOUZONE_SVR']."</td>
       <td>".$row['DOUZONE_CODE']."</td>
       <td>".$row['CONFIRM']."</td>
	   <td>".$row['MEMO']."</td>
   </tr>
   ";
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;

?>
