<?

header("Content-Type: application/x-www-form-urlencoded; charset=UTF-8");
$data = array();
 
if(isset($_GET['files']))//앞에서 주소뒤에 files를 추가했기 떄문에, 확인.
{  
 $error = false; 
 $files = array();
 
 //경로 설정
 $uploaddir = 'upload_others/'.$_GET['flag1'].'/'.$_GET['cstname'].'_'.$_GET['mobile'].'/';
 
 $uploaddir = iconv("UTF-8","cp949",$uploaddir);
 
 //경로확인
 if(!is_dir($uploaddir)){
  //없다면 생성
  mkdir($uploaddir);
 }

 //파일이 여러 개 일 수 있으므로, 각각 저장
 foreach($_FILES as $file)
 {

if(isset($_GET['now'])){
	  if(move_uploaded_file(iconv("UTF-8","cp949",$file['tmp_name']), $uploaddir.$_GET['now'].'_'.iconv("UTF-8","cp949",$file['name'])))
  {
   $files[] = $uploaddir.$_GET['now'].'_'.iconv("UTF-8","cp949",$file['name']);
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

//json_encode후 page1.php의 ajax로 응답 
echo json_encode($data);

?>
