<?php
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
include("db_info.php");

$file_name = "종합소득세_전문상담_".time();
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$file_name .".xls" );
header( "Content-Description: PHP4 Generated Data" );

set_time_limit(300); 
$SET_YEAR = 2021;
$g_option = $_GET["g_option"];
$userid = $_GET["userid"];
$s_str = $_GET["s_str"];
$inf_channel = $_GET["inf_channel"];
$my_list = $_GET["my_list"];
$userid =  $_GET["userid"];

$query_str1 = "";
$query_str2 = "";
$query_str3 = "";
$query_desc = " ORDER BY B.REGDATE DESC,B.EDTDATE DESC";

$cst_type = 'A1001';

if($inf_channel != ""){
    switch($inf_channel){
        case "ct" :
            $query_str3 .= " AND INF_CHANNEL = '채널톡' ";
            break;
        case "ph" :
            $query_str3 .= " AND INF_CHANNEL = '전화' ";
            break;
        case "cc" :
            $query_str3 .= " AND INF_CHANNEL = '카톡채널' ";
            break;
        case "etc" :
            $query_str3 .= " AND INF_CHANNEL = '기타' ";
            break;
        default:
            $query_str3 .="";
    }
}


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


if($my_list == "my"){
    $query_str_my .= " AND B.DEC_REGUSER = ".$userid." ";
}




$procedure = "
	SELECT
    A.CSTID AS 'ID',
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
    B.BIZ_ID,
	DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',
	A.CSTNAME,
	FX_MOBILE(A.MOBILE) AS MOBILE,
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
	CODE_TO_STR(B.REG_BRANCH),
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
	B.REGUSER,
    D.USERNAME AS 'DEC_REGUSER_',
    D.USERID ,
    CODE_TO_STR(SELECT_PROGRESS(B.BIZ_ID)) AS PROGRESS,
    ACC_CK(A.CSTID,A.CSTNAME, B.EST_FEE) AS ACC_CK,
    
    NEW_CST_CK(A.CSTID) AS 'NEW_CST_CK',
    #CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP01') AS 'KAKAO_SEND_1',
    #CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP02') AS 'KAKAO_SEND_2',
    B.INF_CHANNEL,
	B.INF_PATH,
    A.HomeTaxID,
    A.HomeTaxPW,
    A.SECTOR,
    B.POP_AMOUNT_PAID  ,
    IFNULL(B.EST_FEE_SELF,0) AS EST_FEE_SELF,
    FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF,
    CNT_KAKAO_PROLIST(B.BIZ_ID,'A1001') AS CNT_KAKAO_PROLIST
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100026 AS C ON B.BIZ_ID = C.BIZ_ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	WHERE B.INF_PATH='전문상담' AND B.CST_TYPE =  '".$cst_type."'
    AND CST_TYPE_YEAR = $SET_YEAR ".$query_str1.$query_str2.$query_str3.$query_str_my.$query_desc.";
	
	";

//$result = mysql_query($sql);
$result = mysqli_query($connect,$procedure) or die(mysqli_error($connect));
// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <td>ID</td>
   <td>진행상태</td>
   <td>이름</td>
   <td>핸드폰</td>
    <TD>유입채널</TD>
   <td>신규여부</td>
   <td>홈택스ID</td>
    <td>홈택스PW</td>
    <td>업종</td>
    <td>매출계</td>
   <td>예상세액</td>
   <td>예상수수료</td>
   <td>등록일</td>
<td>지점</td>
<td>상담</td>
<td>메모</td>

</tr>";

while($row = mysqli_fetch_array($result)){
$EXCEL_STR .= "
   <tr>
       <td>".$row['ID']."</td>
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
	   <td>".$row['EST_FEE_SELF']."</td>
       <td>".$row['REGDATE']."</td>
       <td>".$row['REG_BRANCH']."</td>
       <td>".$row['DEC_REGUSER_']."</td>
	   <td>".$row['MEMO']."</td>
   </tr>
   ";
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;

?>
