<pre>
<?

header("Content-Type: text/html; charset=UTF-8");
$data = array();
 
if(isset($_GET['files']))//앞에서 주소뒤에 files를 추가했기 떄문에, 확인.
{  
 $error = false; 
 $files = array();
 
 //경로 설정

 $cstname = iconv("UTF-8","cp949",$_GET["cstname"]);
//  $cstname = $_GET["cstname"];
  $mobile = $_GET["mobile"];
 $uploaddir = '../admin/upload_income/2021/'.$cstname.'_'.$mobile.'/';

 //경로확인
 if(!is_dir($uploaddir )){ 
	 umask(0); 

	 if(!mkdir($uploaddir , 0777, true)){ 
		 print_r(error_get_last()); 
		 return; 
	 } 
  }


 //파일이 여러 개 일 수 있으므로, 각각 저장
 foreach($_FILES as $file)
 {

if(isset($_GET['mobile'])){
	  if(move_uploaded_file($file['tmp_name'], $uploaddir.$_GET['mobile'].'_'.iconv("UTF-8","cp949",$file['name']))) 
  {
   $files[] = $uploaddir.$_GET['mobile'].'_'.iconv("UTF-8","cp949",$file['name']);
//  $files[] = $uploaddir.$_GET['mobile'].'_'.$file['name'];
  }
  else
  {
      $error = true;
  }

}else{
  if(move_uploaded_file($file['tmp_name'], $uploaddir.iconv("UTF-8","cp949",$file['name'])))
//	if(move_uploaded_file($file['tmp_name'], $uploaddir.$file['name']))
  {
//   $files[] = $uploaddir.$file['name'];
   $files[] = $uploaddir.iconv("UTF-8","cp949",$file['name']);
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
</pre>