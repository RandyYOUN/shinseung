<?php

header("Content-Type: text/html; charset=UTF-8");
$data = array();
 
//if(isset($_GET['files']))//앞에서 주소뒤에 files를 추가했기 떄문에, 확인.
//{  
 $error = false; 
 $files = array();
 
 //경로 설정
 $uploaddir = 'upload/';
 
 //경로확인
 if(is_dir($uploaddir)){
  //없다면 생성
  removeDir($uploaddir);
  echo 'ok';
 }

 function removeDir($target)
    {
        $directory = new RecursiveDirectoryIterator($target,  FilesystemIterator::SKIP_DOTS);
        $files = new RecursiveIteratorIterator($directory, RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if (is_dir($file)) {
                rmdir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($target);
    }
?>
