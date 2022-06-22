<?php
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
include("db_info.php");


$file_name = "종합소득세_접수현황_".time();
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$file_name .".xls" );
header( "Content-Description: PHP4 Generated Data" );
set_time_limit(300); 
$cst_type = $_GET["cst_type"];
$g_option = $_GET["g_option"];
//$b_option = $_POST["b_option"];
$e_option1 = $_GET["e_option1"];
$e_option2 = $_GET["e_option2"];
$e_option3 = $_GET["e_option3"];
$e_option4 = $_GET["e_option4"];
$prog_option = $_GET["prog_option"];
$isnew_option = $_GET["isnew_option"];
$cashreport_option = $_POST["cashreport_option"];
$agree_option = $_GET["agree_option"];
$reg_option = $_GET["reg_option"];
$login_review_option = $_GET["login_review_option"];

//$rpa_test = "Y";//$_POST["rpa_test"];
$year = $_GET["y_option"];

$s_str = $_GET["s_str"];

$s_date1_from = $_GET["s_date1_from"];
$s_date1_to = $_GET["s_date1_to"];

$s_date2_from = $_GET["s_date2_from"];
$s_date2_to = $_POST["s_date2_to"];

$step_name_search=$_GET["step_name_flag"];
$sort = $_GET["sort_flag"];

$query_str1 = "";
$query_str2 = "";
$query_str3 = "";
$query_str4 = "";

    if($step_name_search !="" && $sort != "")
        $query_desc = " ORDER BY IFNULL(F.".$step_name_search."_REGDATE, F.BIZ_ID) $sort ";
    else
        $query_desc = " ORDER BY IFNULL(B.EDTDATE, B.REGDATE) DESC, B.REGDATE DESC ";
        
        
    
    if($s_str !=""){
        switch($g_option){
            case "CSTID" :
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
        
    if($s_date1_from != "" && $s_date1_to !="")
        $query_date = "AND DATE_FORMAT(B.REGDATE, '%Y-%m-%d') BETWEEN '".$s_date1_from."' AND '".$s_date1_to."' ";
        
    if($s_date2_from != "" && $s_date2_to !="")
        $query_date = "AND DATE_FORMAT(B.REQ_DATE, '%Y-%m-%d') BETWEEN '".$s_date2_from."' AND '".$s_date2_to."' ";
        
        
    
    if($prog_option != ""){
        $query_str2 .= " AND E.PROGRESS = '".$prog_option."' ";
    }
    
    if($isnew_option != ""){
        $query_str2 .= " AND NEW_CST_CK(A.CSTID) = '".$isnew_option."' ";
    }
    
    if($e_option1 != ""){
        $query_str3 .= " AND F.SmartAToConvert = '".$e_option1."' ";
    }
    
    if($e_option2 != ""){
        $query_str3 .= " AND F.HomeTaxUpload = '".$e_option2."' ";
    }
    
    if($e_option3 != ""){
        $query_str3 .= " AND F.HomeTaxPrint = '".$e_option3."' ";
    }
    
    if($cashreport_option != ""){
        $query_str3 .= " AND F.CashReport = '".$cashreport_option."' ";
    }
    
    if($agree_option != ""){
        $query_str3 .= " AND F.HomeTaxConsignment = '".$agree_option."' ";
    }
    
    if($reg_option != ""){
        $query_str3 .= " AND F.CompRegCheck = '".$reg_option."' ";
    }
    
    if($login_review_option != "")
        $query_rv .= " AND CK_CNT_LOGIN_REVIEW(A.CSTID,$year) = '".$login_review_option."' ";
        
    
    if($e_option4 != ""){
        $query_str4 .= " AND ( F.SmartABookMake = '".$e_option4."' OR F.WehagoBookMake = '".$e_option4."') ";
    }
    
    if($year != ""){
        $query_year = " AND B.CST_TYPE_YEAR = $year";
    }else{
        $year = 0;
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
    STEP_NAME( F.HomeTaxConsignment ) AS CONSIGN,
    STEP_NAME( F.SmartAToConvert) AS SMARTA,
    STEP_NAME( F.HomeTaxUpload ) AS HT_UPLOAD,
    STEP_NAME( F.HomeTaxPrint ) AS HT_PRINT,
    STEP_NAME( F.CompRegCheck ) AS COMPREG,
    STEP_NAME( F.SmartABookMake ) AS SMARTA_BOOK,
    SELECT_ERROR_MSG(A.CSTID, 'CashReport' ) AS ERROR_MSG_CASH_REPORT,
    SELECT_ERROR_MSG(A.CSTID, 'HomeTaxConsignment' ) AS ERROR_MSG_CONSIGN,
    SELECT_ERROR_MSG(A.CSTID, 'SmartAToConvert' ) AS ERROR_MSG_SMARTA,
    SELECT_ERROR_MSG(A.CSTID, 'HomeTaxUpload' ) AS ERROR_MSG_HT_UPLOAD,    
    SELECT_ERROR_MSG(A.CSTID, 'HomeTaxPrint' ) AS ERROR_MSG_HT_PRINT,
    SELECT_ERROR_MSG(A.CSTID, 'SmartABookMake' ) AS ERROR_MSG_SMARTA_BOOK,    
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH',
    USERID_TO_REGUSER(B.DEC_REGUSER) AS  'DEC_REGUSER' ,
    C.DOUZONE_SVR 'DOUZONE_SVR',
    C.DOUZONE_CODE 'DOUZONE_CODE',
    CODE_TO_STR(B.CONFIRM) 'CONFIRM',
    B.MEMO 'MEMO',
    B.INF_CHANNEL,
    CK_CNT_LOGIN_REVIEW(A.CSTID,$year) AS 'CK_LOGIN_REVIEW',
    (SELECT COUNT(1) FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='AUTO_COMPLATE') AS CNT_KAKAO_SEND
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID 
    LEFT OUTER JOIN TB100023 AS F ON A.CSTID = F.CSTID AND B.BIZ_ID = F.BIZ_ID 	
    LEFT OUTER JOIN TB100030 AS C ON A.CSTID=C.CSTID AND B.BIZ_ID = C.BIZ_ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
    LEFT OUTER JOIN TB980010 AS D2 ON D2.USERID = B.REGUSER
    LEFT OUTER JOIN TB100026 AS E ON B.BIZ_ID = E.BIZ_ID AND E.PROGRESS IN ('E7216','E7217','E7218','E7219','E7220','E7221','E7222','E7223','E7224','E7225','E7226','E7227','E7228','E7229','E7230')
WHERE 1=1
    AND IFNULL(E.PROGRESS ,'') <> ''
    AND B.CST_TYPE = '".$cst_type."' ".$query_date.$query_year.$query_str1.$query_str2.$query_str3.$query_str4.$query_rv.$query_desc;

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
   <td>현금영수증</td>
   <td>현금영수증_에러</td>
   <td>수임동의</td>
   <td>수임동의_에러</td>
   <td>자료추출</td>
   <td>자료추출_에러</td>
   <td>간편장부</td>
   <td>간편장부_에러</td>
   <td>파일변환</td>
   <td>파일변환_에러</td>
   <td>전자신고</td>
   <td>전자신고_에러</td>
<td>지점</td>
<td>작성자</td>
<td>서버</td>
<td>코드</td>
<td>알림톡</td>
<td>신고확인</td>
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
       <td>".$row['CashReport']."</td>
       <td>".$row['ERROR_MSG_CASH_REPORT']."</td>
	   <td>".$row['CONSIGN']."</td>
       <td>".$row['ERROR_MSG_CONSIGN']."</td>
	   <td>".$row['HT_PRINT']."</td>
       <td>".$row['ERROR_MSG_HT_PRINT']."</td>
	   <td>".$row['SMARTA_BOOK']."</td>
       <td>".$row['ERROR_MSG_SMARTA_BOOK']."</td>
       <td>".$row['SMARTA']."</td>
       <td>".$row['ERROR_MSG_SMARTA']."</td>
	   <td>".$row['HT_UPLOAD']."</td>
	   <td>".$row['ERROR_MSG_HT_UPLOAD']."</td>
       <td>".$row['REG_BRANCH']."</td>
       <td>".$row['DEC_REGUSER']."</td>
	   <td>".$row['DOUZONE_SVR']."</td>
       <td>".$row['DOUZONE_CODE']."</td>
       <td>".$row['CNT_KAKAO_SEND']."</td>
       <td>".$row['CK_LOGIN_REVIEW']."</td>
	   <td>".$row['MEMO']."</td>
   </tr>
   ";
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;

?>
