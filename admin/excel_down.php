<?php
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");


$file_name = "양도_".time();
header( "Content-type: application/vnd.ms-excel" );
header( "Content-type: application/vnd.ms-excel; charset=utf-8");
header( "Content-Disposition: attachment; filename = ".$file_name .".xls" );
header( "Content-Description: PHP4 Generated Data" );

$s_option=mysqli_real_escape_string($connect,$_GET["s_option"]);
$g_option=mysqli_real_escape_string($connect,$_GET["g_option"]);
$t_option=mysqli_real_escape_string($connect,$_GET["t_option"]);
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
	
	if($t_option != "" && $t_option != "ALL"){
	    $WHERE_STR .= " AND I.USERNAME = '".$g_option."'";
	}

	if($depth == "D2005" && $userid !=""){
		$WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
	}



$sql = "SELECT 
A.ID 'ID',
B.USERNAME '작성자',
A.REGDATE '접수일',
J.VALUE_ '우선순위',
D.VALUE_ '진행상태' ,
C.VALUE_ '접수지점',
E.VALUE_ '세목',
A.CSTNAME '납세자명',
FX_MOBILE(A.MOBILE) '납세자 연락처',
A.CST_ADDRESS '납세자 주소지',
F.VALUE_ '양도대상', 
G.VALUE_ '수수료납부여부',
format(A.PRICE,0) '수수료1',
DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') '수수료 납부일자',
A.ETC '비고',
A.FILE_REAL_STR '첨부파일',
I.USERNAME '담당세무사',
DATE_FORMAT(A.DEADLINE, '%Y-%m-%d') '신고기한',
DATE_FORMAT(A.TRANS_DATE, '%Y-%m-%d') '양도일자',
format(A.TRANS_PRICE,0) '양도가액',
DATE_FORMAT(A.ACQ_DATE, '%Y-%m-%d') '취득일자',
format(A.ACQ_PRICE,0) '취득가액',
DATE_FORMAT(A.REP_DATE, '%Y-%m-%d') '신고일자',
A.REP_NUM '전자신고번호',
A.TOTAL_TAX '총납부세액',
H.VALUE_ '납부서전달',			
format(A.PRICE2,0) '수수료2',
CODE_TO_STR(A.PATH_INFO) '유입채널'
FROM dbsschina.TB600010 AS A 
LEFT OUTER JOIN TB980010 AS B ON B.USERID = A.REGUSER 
LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
LEFT OUTER JOIN TB750010 AS J ON J.CODE_ = A.PRIO_NUM
WHERE VISIBLE='Y' ".$WHERE_STR." 
ORDER BY A.REGDATE DESC, A.ID DESC ;";

//$result = mysql_query($sql);
$result = mysqli_query($connect,$sql) or die(mysqli_error($connect));
// 테이블 상단 만들기
$EXCEL_STR = "
<table border='1'>
<tr>
   <td>ID</td>
   <td>분류</td>
   <td>작성자</td>
   <td>접수일</td>
   <td>우선순위</td>
   <td>진행상태</td>
   <td>접수지점</td>
   <td>세목</td>
   <td>납세자명</td>
   <td>납세자 연락처</td>
   <td>납세자 주소지</td>
   <td>양도대상</td>
   <td>수수료 납부여부</td>
   <td>수수료1</td>
   <td>수수료 납부일자</td>
   <td>비고</td>
   <td>첨부파일</td>
   <td>담당세무사</td>
   <td>신고기한</td>
   <td>양도일자</td>
   <td>양도가액</td>
   <td>취득일자</td>
   <td>취득가액</td>
   <td>신고일자</td>
   <td>전자신고번호</td>
   <td>총납부세액</td>
   <td>납부서전달</td>
   <td>수수료2</td>
<td>유입채널</td>
</tr>";

while($row = mysqli_fetch_array($result)){
$EXCEL_STR .= "
   <tr>
       <td>".$row['ID']."</td>
	   <td>".$row['분류']."</td>
       <td>".$row['작성자']."</td>
       <td>".$row['접수일']."</td>
	   <td>".$row['우선순위']."</td>
       <td>".$row['진행상태']."</td>
       <td>".$row['접수지점']."</td>
	   <td>".$row['세목']."</td>
       <td>".$row['납세자명']."</td>
       <td>".$row['납세자 연락처']."</td>
	   <td>".$row['납세자 주소지']."</td>
       <td>".$row['양도대상']."</td>
       <td>".$row['수수료 납부여부']."</td>
	   <td>".$row['수수료1']."</td>
       <td>".$row['수수료 납부일자']."</td>
       <td>".$row['비고']."</td>
	   <td>".$row['첨부파일']."</td>
       <td>".$row['담당세무사']."</td>
       <td>".$row['신고기한']."</td>
	   <td>".$row['양도일자']."</td>
       <td>".$row['양도가액']."</td>
       <td>".$row['취득일자']."</td>
	   <td>".$row['취득가액']."</td>
       <td>".$row['신고일자']."</td>
       <td>".$row['전자신고번호']."</td>
   	   <td>".$row['총납부세액']."</td>
       <td>".$row['납부서전달']."</td>
       <td>".$row['수수료2']."</td>
        <td>".$row['유입채널']."</td>
   </tr>
   ";
}

$EXCEL_STR .= "</table>";

echo "<meta content=\"application/vnd.ms-excel; charset=UTF-8\" name=\"Content-type\"> ";
echo $EXCEL_STR;

?>
