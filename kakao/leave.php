<?
include_once 'common.php';

$userId = $_GET["user_id"];

// 위 유저 ID로 DB에서 삭제 처리할 것.

$http_host = $_SERVER['HTTP_HOST'];

if($http_host=="localhost")
    $connect = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
else
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
    
$procedure = "
	CREATE PROCEDURE DELETE_KAKAO_USER(IN P_USERID VARCHAR(20) )
	BEGIN
    
		DECLARE TMP_CSTID INT(11);
    
		SELECT CSTID INTO TMP_CSTID FROM TB100020
        WHERE KAKAO_ID = P_USERID;
    
    
        IF IFNULL(TMP_CSTID,'') <> '' THEN
            DELETE FROM TB100020
            WHERE CSTID = TMP_CSTID;
        END IF;
    
	END
";


try {
    //기존에 프로시저가 있으면 삭제
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS DELETE_KAKAO_USER"))
    { //위에서 만든 프로시저 실행
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL DELETE_KAKAO_USER('".$userId."')";
            //프로시저 호출$profile
            mysqli_query($connect,$query);
            echo '삭제완료';
        }
    }
    
} catch (Exception $e) {
    echo 'error : ' .$e;
}

        
?>