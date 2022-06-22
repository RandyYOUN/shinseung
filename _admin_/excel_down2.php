<?
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면

$filename = "양도_".time();

$s_option=mysqli_real_escape_string($connect,$_POST["s_option"]);
$g_option=mysqli_real_escape_string($connect,$_POST["g_option"]);
$s_str=mysqli_real_escape_string($connect,$_POST["s_str"]);
$depth=mysqli_real_escape_string($connect,$_POST["depth"]);
$userid=mysqli_real_escape_string($connect,$_POST["userid"]);

if($_POST["s_option"] != ""){
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
			default:
				$WHERE_STR ="";
		}	
	}

	if($_POST["g_option"] != "" && $_POST["g_option"] != "ALL"){
		$WHERE_STR .= " AND A.REG_BRANCH = '".$g_option."'";	
	}

	if($depth == "D2005" && $userid !=""){
		$WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
	}



$sql = "SELECT 
A.ID 'ID',
K.VALUE_ '분류',
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
format(A.PRICE2,0) '수수료2'
	FROM dbsschina.TB600010 AS A 
	LEFT OUTER JOIN TB980010 AS B ON A.REGUSER = B.USERID
	LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
	LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
	LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
	LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
	LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
	LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
LEFT OUTER JOIN TB750010 AS J ON J.CODE_ = A.PRIO_NUM
LEFT OUTER JOIN TB750010 AS K ON K.CODE_ = A.CATE
WHERE 1=1 ".$WHERE_STR." 
ORDER BY ID DESC;";

$result = mysqli_query($connect,$sql) or die(mysqli_error($connect));

// 칼럼 생성 
	$objPHPExcel->setActiveSheetIndex(0) 
	->setCellValue("A1", "칼럼1") ->setCellValue("B1", "칼럼2") ->setCellValue("C1", "칼럼3") ->setCellValue("D1", "칼럼4") ->setCellValue("E1", "칼럼5") ->setCellValue("F1", "칼럼6") ->setCellValue("G1", "칼럼7") ->setCellValue("H1", "칼럼8"); 
	
	//############################################################################ //############################# 스타일 설정 start ############################# //############################################################################ 

// 첫번째 제목 라인 폰트 bold 
$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true); 
// 첫번째 제목 라인 폰트 배경색 지정 

$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFill()->applyFromArray( array ( 'type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => array ( 'rgb' => 'dadada' ) ) ); 
// 첫번째 제목 라인 border 
$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getBorders()->applyFromArray( array( 'allborders' => array( 'style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array( 'rgb' => '000000' ) ) ) ); 

// 첫번째 제목 라인 스크롤시 고정 처리 

$objPHPExcel->getActiveSheet()->freezePane('A2'); 

//############################################################################ //############################# 스타일 설정 END ############################# //############################################################################ 

// 데이터 삽입 

for ($i=2; $row=mysql_fetch_array($result); $i++) { 
	$objPHPExcel->setActiveSheetIndex(0) 
		->setCellValue("A$i", $row['ID']) 
		->setCellValue("B$i", $row['분류']) 
		->setCellValue("C$i", $row['납세자명']); 
} 

// 칼럼 넓이 지정 - AUTO 

for ($col = 'A'; $col !== 'L'; $col++) {
	$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true); 
	
	} 
	
	// 시트명 설정 
	
	$objPHPExcel->getActiveSheet()->setTitle('point'); 
	
	// 엑셀파일 오픈시 첫번쨰로 보여줄 시트 인덱스 설정 
	
	$objPHPExcel->setActiveSheetIndex(0); 
	
	// 파일의 저장형식이 utf-8일 경우 한글파일 이름은 깨지므로 euc-kr로 변환해준다. 
	
	$filename = iconv("UTF-8", "EUC-KR", "테스트"); 
	
	// Redirect output to a client’s web browser (Excel5) 
	
	header('Content-Type: application/vnd.ms-excel'); header("Content-Disposition: attachment;filename=".$filename.".xls"); header('Cache-Control: max-age=0'); $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); $objWriter->save('php://output'); $xlsData = ob_get_contents(); ob_end_clean(); $response = array( 'status' => 'success', 'url' => "data:application/vnd.ms-excel;base64,".base64_encode($xlsData) ); 
	
	// 성공여부 FILE URL return후 종료 
	
	die(json_encode($response));



?>
