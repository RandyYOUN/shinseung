<?php
if ($_FILES['file']['name']) {
        if (!$_FILES['file']['error']) {
//                $save_dir = $_SERVER['DOCUMENT_ROOT'].'../news/upload/';
                $save_dir = '/upload/';
 
                $file_name = $_FILES['file']['name'];
                $file_tmp_name = $_FILES['file']['tmp_name'];
                $file_size = $_FILES['file']['size'];                 // 업로드한 파일의 크기
                $mimeType = $_FILES['file']['type'];                 // 업로드한 파일의 MIME Type
 
                $real_name = $file_name;     // 원래 파일명(업로드 하기 전 실제 파일명) 
                $ext = explode('.', $real_name);
 
                $file_exe = $ext[1];
 
                $file_time = time();
                $file_name = "Temporary_".$file_time.".".$file_exe;
                $change_file_name = $file_name;                  // 변경된 파일명을 변수에 지정 
                $real_name = addslashes($real_name);            // 업로드 되는 원래 파일명(업로드 하기 전 실제 파일명) 
                $real_size = $file_size;                         // 업로드 되는 파일 크기 (byte)
 
                //파일을 저장할 디렉토리 및 파일명 전체 경로
                $dest_url = $save_dir . iconv("utf-8","euc-kr",$change_file_name);
                 
                //파일을 지정한 디렉토리에 업로드
 
                if(move_uploaded_file($file_tmp_name, $dest_url)) {
                        chmod($dest_url,0664);
                        echo $dest_url;
                } else {
                        die("파일을 지정한 디렉토리에 업로드하는데 실패했습니다.");
                }
        } else {
                echo 'Ooops!  업로드가 다음 오류를 발생 시켰습니다.:  '.$_FILES['file']['error'];
        }
}
?>