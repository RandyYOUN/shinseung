<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>엑셀 대량업로드</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
    <link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="shortcut icon" href="images/icon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="js/wf_loading.js" type="text/javascript"></script>
<link href="css/wf_loading.css" rel="stylesheet" type="text/css" />

<script>


isloading = {
  start: function() {
    if (document.getElementById('wfLoading')) {
      return;
    }
    var ele = document.createElement('div');
    ele.setAttribute('id', 'wfLoading');
    ele.classList.add('loading-layer');
    ele.innerHTML = '<span class="loading-wrap"><span class="loading-text"><span>.</span><span>.</span><span>.</span></span></span>';
    document.body.append(ele);

    // Animation
    ele.classList.add('active-loading');
  },
  stop: function() {
    var ele = document.getElementById('wfLoading');
    if (ele) {
      ele.remove();
    }
  }
}



</script>
<body>
<?php
//echo $_SERVER["DOCUMENT_ROOT"].'/admin/upload/income/Classes/PHPExcel.php';
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면


include $_SERVER["DOCUMENT_ROOT"]."/admin/upload/income/Classes/PHPExcel.php";

$rd_flag=$_POST["rd_flag"];
//echo $rd_flag;
//echo $_SERVER["DOCUMENT_ROOT"]."/admin/upload/income/Classes/PHPExcel.php";


if($rd_flag=="cash_report")
    $rangeArr = range('A','D');
elseif ($rd_flag=="hometax_print")
    $rangeArr = range('A','D');
elseif ($rd_flag=="comp_reg")
    $rangeArr = range('A','D');
elseif ($rd_flag=="smarta")
    $rangeArr = range('A','H');

    
$DateAndTime = date('Ymd_His', time());

//echo $DateAndTime.'_'.rand(1,100);

class MyReadFilter implements PHPExcel_Reader_IReadFilter{
    public function readCell($column, $row, $worksheetName=""){
        global $rangeArr;
        
        if(in_array($column,$rangeArr) ){
            return true;
        }
        return false;
        
    }
}

$filterSubset= new MyReadFilter();

$filename =  $_FILES['excelFile']['name'];


//header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
$data = array();

if(isset($_FILES['excelFile']))//앞에서 주소뒤에 files를 추가했기 떄문에, 확인.
{
    $error = false;
    $files = array();

    $uploaddir = $_SERVER["DOCUMENT_ROOT"].'/admin/upload/income/excel/';

//$uploaddir = iconv("UTF-8","cp949",$uploaddir);

    
    //경로확인
    if(!is_dir($uploaddir)){
        //없다면 생성
        mkdir($uploaddir);
    }
    
    //파일이 여러 개 일 수 있으므로, 각각 저장
    foreach($_FILES as $file)
    {
        
        if(isset($DateAndTime)){
            if(move_uploaded_file($file['tmp_name'], $uploaddir.$DateAndTime.'_'.$file['name']))
            {
                $files[] = $uploaddir.$DateAndTime.'_'.$file['name'];
                $upfile_path = $uploaddir.$DateAndTime.'_'.$file['name'];
            }
            else
            {
                $error = true;
            }
            
        }
    }
    //업로드 성공 여부에 따른 예외처리
    $data = ($error) ? array('error' => '업로드된 파일이 없습니다.') : array('files' => $files);
}
//echo json_encode($data);

//echo $filename;

//$upfile_path = $_SERVER["DOCUMENT_ROOT"]."/admin/upload/income/".$filename;
$path=pathinfo($filename);
$UpFileExt=strtolower($path['extension']);
$inputFileType='';

if($UpFileExt=="xls"){
    $inputFileType = 'Excel5';
}elseif ($UpFileExt=="xlsx"){
    $inputFileType='Excel2007';
}


if(file_exists($upfile_path) && $inputFileType ){
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(false);
    $objReader->setReadFilter($filterSubset);
    $objPHPExcel = $objReader->load($upfile_path);
    $objPHPExcel->setActiveSheetIndex(0);
    
    $objWorksheet = $objPHPExcel->getActiveSheet();
    $rowIterator = $objWorksheet->getRowIterator();
    
    
    
    foreach ($rowIterator as $row) {
        
        $cellIterator = $row->getCellIterator();
        
        $cellIterator->setIterateOnlyExistingCells(false);
        
    }
    
    
    
    $maxRow = $objWorksheet->getHighestRow();
    
    
    
    // echo $maxRow . "<br>";
    
    echo "<script>isloading.start();</script>";
    
    for ($i = 2 ; $i <= $maxRow ; $i++) {
        
        
        if($rd_flag=="cash_report"){
            
            $p_cstname = $objWorksheet->getCell('A' . $i)->getValue(); // A열
            $p_mobile = $objWorksheet->getCell('B' . $i)->getValue(); // B열
            $p_dep_fee = $objWorksheet->getCell('C' . $i)->getValue(); // C열
            $p_reg_branch = $objWorksheet->getCell('D' . $i)->getValue(); // D열
            
            $p_cstname  = addslashes($p_cstname);
            $p_mobile  = addslashes($p_mobile);
            $p_dep_fee  = addslashes($p_dep_fee);
            $p_reg_branch  = addslashes($p_reg_branch);
            
            if($rd_flag != "" && $p_cstname != "" && $p_mobile != "" && $p_dep_fee != "" && $p_reg_branch != "" ){
                $query = "CALL RPA_INSERT_DATE_CASHREPORT('".$rd_flag."','".$p_cstname."','".$p_mobile."','".$p_dep_fee."','".$p_reg_branch."',101 )";
                mysqli_query($connect,$query);
            }
        }elseif ($rd_flag=="hometax_print"){
            
            $p_cstname = $objWorksheet->getCell('A' . $i)->getValue(); // A열
            $p_mobile = $objWorksheet->getCell('B' . $i)->getValue(); // B열
            $p_resi = $objWorksheet->getCell('C' . $i)->getValue(); // C열
            $p_reg_branch = $objWorksheet->getCell('D' . $i)->getValue(); // H열
            
            $p_cstname  = addslashes($p_cstname);
            $p_mobile  = addslashes($p_mobile);
            $p_resi  = addslashes($p_resi);
            $p_reg_branch  = addslashes($p_reg_branch);
            
            if($rd_flag != "" && $p_cstname != "" && $p_mobile != "" && $p_resi != "" && $p_reg_branch != ""  ){
                $query = "CALL RPA_INSERT_HOMETAXPRINT('".$rd_flag."','".$p_cstname."','".$p_mobile."','".$p_resi."','".$p_reg_branch."',101 )";
                //$e = "Insert";
                mysqli_query($connect,$query);
                //echo $query;
            }
        }elseif ($rd_flag=="comp_reg"){
            
            $p_cstname = $objWorksheet->getCell('A' . $i)->getValue(); // A열
            $p_mobile = $objWorksheet->getCell('B' . $i)->getValue(); // B열
            $p_ins_svr = $objWorksheet->getCell('C' . $i)->getValue(); // D열
            $p_reg_branch = $objWorksheet->getCell('D' . $i)->getValue(); // H열
            
            $p_cstname  = addslashes($p_cstname);
            $p_mobile  = addslashes($p_mobile);
            $p_ins_svr  = addslashes($p_ins_svr);
            $p_reg_branch  = addslashes($p_reg_branch);
            
            
            if($rd_flag != "" && $p_cstname != "" && $p_mobile != "" && $p_ins_svr != ""  ){
                $query = "CALL RPA_INSERT_DATE_COMPREG('".$rd_flag."','".$p_cstname."','".$p_mobile."','".$p_ins_svr."','".$p_reg_branch."',101 )";
                //$e = "Insert";
                mysqli_query($connect,$query);
                //echo $query;
            }
        }elseif ($rd_flag=="smarta"){
            
            $p_cstname = $objWorksheet->getCell('A' . $i)->getValue(); // A열
            $p_mobile = $objWorksheet->getCell('B' . $i)->getValue(); // B열
            $p_resi = $objWorksheet->getCell('C' . $i)->getValue(); // C열
            $p_dz_svr = $objWorksheet->getCell('D' . $i)->getValue(); // D열
            $p_dz_code = $objWorksheet->getCell('E' . $i)->getValue();  // E열
            $p_ref_bank = $objWorksheet->getCell('F' . $i)->getValue(); // F열
            $p_ref_acc = $objWorksheet->getCell('G' . $i)->getValue(); // G열
            $p_reg_branch = $objWorksheet->getCell('H' . $i)->getValue(); // H열
            
            $p_cstname  = addslashes($p_cstname);
            $p_mobile  = addslashes($p_mobile);
            $p_resi  = addslashes($p_resi);
            $p_dz_svr  = addslashes($p_dz_svr);
            $p_dz_code  = addslashes($p_dz_code);
            $p_ref_bank  = addslashes($p_ref_bank);
            $p_ref_acc  = addslashes($p_ref_acc);
            $p_reg_branch  = addslashes($p_reg_branch);
            
            
            if($rd_flag != "" && $p_cstname != "" && $p_mobile != "" && $p_resi != "" && $p_dz_svr != "" && $p_dz_code != "" ){
                $query = "CALL RPA_INSERT_DATE_SMARTA('".$rd_flag."','".$p_cstname."','".$p_mobile."','".$p_resi."','".$p_dz_svr."','".$p_dz_code."','".$p_ref_bank."','".$p_ref_acc."','".$p_reg_branch."',101 )";
                //$e = "Insert";
                mysqli_query($connect,$query);
                //echo $query;
            }
        }
        
    }
    $maxRow_str=$maxRow-1;
   
    echo "<script>isloading.stop();</script>";
    echo "<br>".$maxRow_str." Data inserting finished !<br>";
     //echo '</table>';
        
}else{
    echo '<br>error!!!<br>';
    
}

?>


</body>

