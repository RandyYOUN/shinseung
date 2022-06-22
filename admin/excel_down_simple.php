<?php
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
include("db_info.php");

$file_name = "종합소득세_간편안내_".time();
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$file_name .".xls" );
header( "Content-Description: PHP4 Generated Data" );

//$s_option=mysqli_real_escape_string($connect,$_GET["s_option"]);
//$g_option=mysqli_real_escape_string($connect,$_GET["g_option"]);
//$s_str=mysqli_real_escape_string($connect,$_GET["s_str"]);

$cst_type = $_GET["cst_type"];
$g_option = $_GET["g_option"];
$b_option = $_GET["b_option"];
$s_str = $_GET["s_str"];
$userid =  $_GET["userid"];
$SET_YEAR ="2021";
$cst_type = 'A1001';
$query_str1 = "";
$query_str2 = "";
$query_str3 = "";
$query_desc = "  ORDER BY IFNULL(B.EDTDATE,B.REGDATE) DESC, B.REGDATE DESC ";


//$query_desc = " ORDER BY  B.BIZ_ID DESC";

if($s_str !=""){
    switch($g_option){
        case "ID" :
            $query_str1 .= " AND A.CSTID like '%".$s_str."%' ";
            break;
        case "CSTNAME" :
            $query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
            break;
        case "MOBILE" :
            $query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
            break;
        case "RESI" :
            $query_str1 .= " AND A.RESIDENT_ID like '%".$s_str."%' ";
            break;
        case "REGUSER" :
            $query_str1 .= " AND D.USERNAME like '%".$s_str."%' ";
            break;
        case "MEMO" :
            $query_str1 .= " AND B.MEMO like '%".$s_str."%' ";
            break;
        default:
            $query_str1 .="";
    }
}


if($b_option != ""){
    $query_str2 .= " AND B.REG_BRANCH = '".$b_option."' ";
}


$sql = "SELECT
    A.CSTID AS 'ID',
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
    B.BIZ_ID,
	DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',
	A.CSTNAME,
	A.MOBILE,
    B.CST_TYPE_YEAR,
substring( REPLACE(A.MOBILE,'-',''),4) MOBILE_PATH,
	B.COMP_NAME,
            
    B.EXP_PAY_TAX_SELF,
    FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF_ ,
    B.EST_FEE,
    B.EST_FEE_SELF,
	FORMAT(B.EST_FEE_SELF,0) AS EST_FEE_SELF_ ,
    EST_FEE_BF_YEAR(A.CSTID) AS EST_FEE_BF_YEAR,
	FORMAT(B.DEP_FEE,0) AS DEP_FEE,
	B.DEP_TYPE,
	B.ACC_FLAG,
	B.DEADLINE_DATE,
	DATE_FORMAT(B.DEADLINE_DATE, '%y-%m-%d') 'DEADLINE_DATE_',
	B.PAY_TAX,
	B.DEL_DATE_PAYMENT,
	DATE_FORMAT(B.DEL_DATE_PAYMENT, '%y-%m-%d') 'DEL_DATE_PAYMENT_',
	B.DEL_TYPE_PAYMENT,
	B.DEC_REGUSER,
	B.MEMO,
	B.CST_TYPE,
	B.TAX_TYPE,
	B.REG_BRANCH,
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
	B.REGUSER,
    D.USERNAME AS 'DEC_REGUSER_',
    D.USERID ,
    SELECT_PROGRESS(B.BIZ_ID) AS PROGRESS,
            
    NEW_CST_CK(A.CSTID) AS 'NEW_CST_CK',
    
    B.INF_CHANNEL,
	B.INF_PATH,
    A.HomeTaxID,
    A.HomeTaxPW,
    A.SECTOR,
    FORMAT(B.POP_AMOUNT_PAID,0) AS POP_AMOUNT_PAID  ,
    IFNULL(B.EST_FEE_SELF,0) AS EST_FEE_SELF,
    FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF,
    CNT_KAKAO_PROLIST(B.BIZ_ID,'A1001') AS CNT_KAKAO_PROLIST
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100026 AS C ON B.BIZ_ID = C.BIZ_ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	WHERE B.INF_PATH ='종소톡' AND B.CST_TYPE =  '$cst_type'
    AND CST_TYPE_YEAR = $SET_YEAR ".$query_str1.$query_str2.$query_str3.$query_desc.";
	";

//$result = mysql_query($sql);
$result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <td>진행상태</td>
	<td>이름</td>
	<td>핸드폰번호</td>
	<td>유입채널</td>
    <td>신규여부</td>
	<td>홈택스ID</td>
    <td>홈택스PW</td>
    <td>업종</td>
	<td>매출계</td>
    <th >예상세액</td>
    <td>예상수수료</td>
    <th>알림톡</td>
	<td>등록일</td>
    <td>지점</td>
	<td>상담자</td>
	<td>메모</td>
</tr>";

while($row = mysqli_fetch_array($result)){
$EXCEL_STR .= "
   <tr>
       <td>".$row['PROGRESS']."</td>
	   <td>".$row['CSTNAME']."</td>
       <td>".$row['MOBILE']."</td>
<td>".$row['INF_CHANNEL']."</td>       
<td>".$row['NEW_CST_CK']."</td>
<td>".$row['HomeTaxID']."</td>
	   <td>".$row['HomeTaxPW']."</td>
       <td>".$row['SECTOR']."</td>
	   <td>".$row['POP_AMOUNT_PAID']."</td>
       <td>".$row['EXP_PAY_TAX_SELF']."</td>
<td>".$row['EST_FEE_SELF_']."</td>
       <td>".$row['CNT_KAKAO_PROLIST']."</td>
	   <td>".$row['REGDATE_']."</td>
<td>".$row['REG_BRANCH_PATH']."</td>
<td>".$row['DEC_REGUSER']."</td>
<td>".$row['MEMO']."</td>
   </tr>
   ";
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;

?>
