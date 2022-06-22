<?php
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면


$file_name = "현금영수증 리스트_".time();
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$file_name .".xls" );
header( "Content-Description: PHP4 Generated Data" );

$s_option=mysqli_real_escape_string($connect,$_GET["s_option"]);
$s_str=mysqli_real_escape_string($connect,$_GET["s_str"]);

$query_desc = " ORDER BY B.CASH_REPORT_REGDATE DESC ";

if($s_option != ""){
    switch($s_option){
        
        case "CSTNAME" :
            $query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
            break;
        case "MOBILE" :
            $query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
            break;
        
        default:
            $query_str1 .="";
    }
	}


	
$sql = "SELECT A.CSTID, A.CSTNAME, A.MOBILE,FORMAT(B.DEP_FEE,0) AS DEP_FEE_ ,B.CASH_REPORT_APP_NUM, B.CASH_REPORT_REGDATE
    FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
    WHERE IFNULL(B.CASH_REPORT_APP_NUM,'') <> '' ".$query_str1.$query_desc.";
	";

//$result = mysql_query($sql);
$result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <td>ID</td>
   <td>이름</td>
   <td>핸드폰</td>
   <td>금액</td>
   <td>발행번호</td>
   <td>발행일</td>
</tr>";

while($row = mysqli_fetch_array($result)){
$EXCEL_STR .= "
   <tr>
       <td>".$row['CSTID']."</td>
       <td>".$row['CSTNAME']."</td>
       <td>".$row['MOBILE']."</td>
       <td>".$row['DEP_FEE_']."</td>
       <td>".$row['CASH_REPORT_APP_NUM']."</td>
	   <td>".$row['CASH_REPORT_REGDATE']."</td>
   </tr>
   ";
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;

?>
