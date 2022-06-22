<?php
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");


set_time_limit(300); 
$file_name = "알림톡로그_".time();
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

$query_desc = " ORDER BY SEND_DATE DESC, SEND_BIZ_ID DESC , SEND_TMP_STEP, VISIBLE ";

if($s_option != ""){
    switch($s_option){
        case "CSTID" :
            $query_str1 .= " AND A.CSTID like '%".$s_str."%' ";
            break;
        case "CSTNAME" :
            $query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
            break;
        case "MOBILE" :
            $query_str1 .= " AND A.MOBILE like '%".$s_str."%' ";
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

if($g_option != "" && $g_option != "ALL"){
    $query_str2 .= " AND A.REG_BRANCH = '".$g_option."'";
}



$sql = "SELECT A.CSTID AS 'CSTID' ,
			B.REG_BRANCH AS 'REG_BRANCH',
            IFNULL(CODE_TO_STR(B.REG_BRANCH),B.REG_BRANCH) AS 'REG_BRANCH_',
            A.CSTNAME ,
            REPLACE(A.MOBILE,'-','') AS 'MOBILE',
            B.INCOME_TAX,B.JIBANG_TAX,
            #(SELECT SEND_DATE FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='AUTO_COMPLATE'  ORDER BY SEND_DATE DESC LIMIT 1) as 'SEND_DATE',
            C.SEND_DATE,
            (SELECT LOG_TIME FROM TB700020 WHERE STEP_NAME = 'LOGIN' AND CSTID = A.CSTID AND LOG <> 'login fail' AND date_format(LOG_TIME,'%Y') = date_format(C.SEND_DATE,'%Y') ORDER BY LOG_TIME DESC LIMIT 1) AS 'LOGIN_DATE',
            (SELECT COUNT(1) FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='SMS발송'  LIMIT 1 ) as 'SMS',
            (SELECT SEND_DATE FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='SMS발송'  LIMIT 1  ) as 'SMS_SEND_DATE',
            (SELECT SELECT_REGUSER(REGUSER) FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='SMS발송' LIMIT 1 ) as 'SMS_SEND_USER',
            B.MEMO,
            CK_REVIEW(A.CSTNAME,A.MOBILE) AS CK_REVIEW
            FROM TB100020 AS A 
            LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
            LEFT OUTER JOIN TB700010 AS C ON B.BIZ_ID=C.SEND_BIZ_ID
            #LEFT OUTER JOIN TB700020 AS D ON A.CSTID = D.CSTID
            WHERE C.SEND_TMP_STEP='AUTO_COMPLATE'
            AND C.VISIBLE='Y'
            AND A.CSTID IN (SELECT CSTID FROM TB700020 WHERE LOG <> 'login fail' GROUP BY CSTID)
            ".$query_str1.$query_str2.$query_desc.";";

//$result = mysql_query($sql);
$result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <th>ID</th>
    <th>지점</th>
    <th>이름</th>
    <th>핸드폰</th>
    <th>리뷰여부</th>
    <th>전자신고1</th>
    <th>전자신고2</th>
    <th>소득세</th>
    <th>지방세</th>
    <th>발송일시</th>
    <th>접속일</th>
    <th>SMS<br>발송건수</th>
    <th>SMS<br>발송시간</th>
    <th>SMS<br>발송유저</th>
    <th>메모</th>
</tr>";

while($row = mysqli_fetch_array($result)){
    $smart = $row["SmartAToConvert"];
    if($smart=='Y')
        $smartA_str = "완료";
        
    $ht_upload = $row["HomeTaxUpload"];
    if($ht_upload=='Y')
        $ht_upload_str = "완료";
        
        
    $EXCEL_STR .= '
   <tr>
       <td>'.$row["CSTID"].'</td>
		<td>'.$row["REG_BRANCH_"].'</td>
        <td>'.$row["CSTNAME"].'</td>
		<td>'.$row["MOBILE"].'</td>
		<td>'.$row["CK_REVIEW"].'</td>
		<td>'.$smartA_str.'</td>
        <td>'.$ht_upload_str.'</td>
        <td>'.$row["INCOME_TAX"].'</td>
        <td>'.$row["JIBANG_TAX"].'</td>
        <td>'.$row["SEND_DATE"].'</td>
        <td>'.$row["LOGIN_DATE"].'</td>
        <TD>'.$row["SMS"].'</td>
        <TD>'.$row["SMS_SEND_DATE"].'</td>
        <TD>'.$row["SMS_SEND_USER"].'</td>
        <TD>'.$row["MEMO"].'</td>
   </tr>
   ';
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;

?>
