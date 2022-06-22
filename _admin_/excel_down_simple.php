<?php
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면


$file_name = "종합소득세_간편안내_".time();
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$file_name .".xls" );
header( "Content-Description: PHP4 Generated Data" );

$s_option=mysqli_real_escape_string($connect,$_GET["s_option"]);
$g_option=mysqli_real_escape_string($connect,$_GET["g_option"]);
$s_str=mysqli_real_escape_string($connect,$_GET["s_str"]);


$query_desc = " ORDER BY  B.BIZ_ID DESC";

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



$sql = "SELECT  
    A.CSTID AS 'ID',
    B.BIZ_ID,
    B.REGDATE,	
    DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',
	A.CSTNAME,
	A.MOBILE,
	B.EXP_PAY_TAX,
    FORMAT(B.EXP_PAY_TAX,0) AS EXP_PAY_TAX_ ,
    B.EST_FEE,
	FORMAT(B.EST_FEE,0) AS EST_FEE_ ,
	FORMAT(B.DEP_FEE,0) AS DEP_FEE,
	B.DEC_REGUSER,
	B.MEMO,
	B.INF_PATH,
	B.KEYWORD,
	CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH',
	SELECT_REGUSER(B.DEC_REGUSER) AS 'DEC_REGUSER',
    CODE_TO_STR(SELECT_PROGRESS(B.BIZ_ID)) AS PROGRESS,
    B.EST_FEE_SELF,
    FORMAT(B.EST_FEE_SELF,0) AS 'EST_FEE_SELF',
    B.EXP_PAY_TAX_SELF,
    FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF_ ,
    NEW_CST_CK(A.CSTID) AS 'NEW_CST_CK'
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
    LEFT OUTER JOIN TB100032 AS E ON A.CSTID = E.CSTID          
	WHERE B.INF_PATH ='종소톡' AND B.CST_TYPE = 'A1001' ".$query_str1.$query_str2.$query_desc.";
	";

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
   <td>매출계</td>
   <td>예상세액</td>
   <td>예상수수료</td>
   <td>등록일</td>
   <td>지점</td>
   <td>상담자</td>
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
<td>".$row['AMOUNT_PAID_']."</td>
	   <td>".$row['EXP_PAY_TAX_SELF_']."</td>
       <td>".$row['EST_FEE_SELF_']."</td>
	   <td>".$row['REGDATE']."</td>
       <td>".$row['REG_BRANCH']."</td>
       <td>".$row['DEC_REGUSER']."</td>
	   <td>".$row['MEMO']."</td>
   </tr>
   ";
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;

?>
