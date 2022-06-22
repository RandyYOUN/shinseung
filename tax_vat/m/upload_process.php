<pre>
<?

header("Content-Type: text/html; charset=UTF-8");
$data = array();
 
if(isset($_GET['files']))//앞에서 주소뒤에 files를 추가했기 떄문에, 확인.
{  
 $error = false; 
 $files = array();
 $date_ = date("Y_m_d_H_i_s");
 
 //경로 설정

 $id = iconv("UTF-8","cp949",$_GET["id"]);
 $uploaddir = 'upload/'.$id.'/';

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

if(isset($_GET['id'])){
	  if(move_uploaded_file($file['tmp_name'], $uploaddir.$date_.'_'.iconv("UTF-8","cp949",$file['name'])))
  {
   $files[] = $uploaddir.$date_.'_'.iconv("UTF-8","cp949",$file['name']);
  }
  else
  {
      $error = true;
  }

}else{
  if(move_uploaded_file($file['tmp_name'], $uploaddir.iconv("UTF-8","cp949",$file['name'])))
  {
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