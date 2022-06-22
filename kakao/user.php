<?PHP 
include_once 'common.php';


// 액세스 토큰이 세션에 있을 경우
if(isset($_SESSION['token'])) {
	$user = postWithToken($KAKAO_USER_URI, $_SESSION['token']);
	$user = json_decode($user, true);
	
	// 세션에 있는 토큰으로 정보 못 가져올 시 세션 지우고 리다이렉트 (다시 토큰 가져오기 위함)
	if( $user['id'] == null ) {
		unset( $_SESSION['token'] );
		header('Location: '.$KAKAO_OAUTH_URI);
	}
	
	
	$id = $user['id'];
	$connected_at = $user['connected_at'];
	$profile_nickname  = $user['kakao_account']['profile']['nickname'];
	$name = $user['kakao_account']['name'];
	$email = $user['kakao_account']['email'];
	$mobile = $user['kakao_account']['phone_number'];
	$age_range = $user['kakao_account']['age_range'];
	$birthyear = $user['kakao_account']['birthyear'];
	$birthday = $user['kakao_account']['birthday'];
	$gender = $user['kakao_account']['gender'];
	/*
	echo 'id = '.$id;
	echo 'connected_at = '.$connected_at;
	echo 'profile_nickname = '.$profile_nickname;
	echo 'name = '.$name;
	echo 'email = '.$email;
	echo 'mobile = '.$mobile;
	echo 'age_range = '.$age_range;
	echo 'birthyear = '.$birthyear;
	echo 'birthday = '.$birthday;
	echo 'gender = '.$gender;
	*/
	session_start();
	$_SESSION['JB_LOGIN'] = TRUE;
	$_SESSION['USERNAME_KAKAO'] = $name;	
	
	
	user_insert($id, $connected_at, $profile_nickname, $name, $email, $mobile, $age_range, $birthyear, $birthday, $gender);
	
	
	header('Location: ../tax_income/index.php');
	// TODO: 유저정보 DB 저장 또는 업데이트
	
} else {
	header('Location: ../tax_income/kakao_login.php');
    //header('Location: localhost/kakao');
}




function user_insert($id, $connected_at, $profile, $name, $email, $phone_number, $age_range, $birthyear, $birthday, $gender){
    $http_host = $_SERVER['HTTP_HOST'];
    
    if($http_host=="localhost")
        $connect = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
    else
        $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
        
            $procedure = "
			CREATE PROCEDURE INSERT_KAKAO_USER(IN P_ID VARCHAR(20),
P_CONNECTED_AT VARCHAR(50),
P_PROFILE VARCHAR(45),
P_NAME VARCHAR(45),
P_EMAIL VARCHAR(200),
P_PHONE_NUMBER VARCHAR(30),
P_AGE_RANGE VARCHAR(20),
P_BIRTHYEAR INT,
P_BIRTHDAY INT,
P_GENDER VARCHAR(20)
 )
			BEGIN
        
				DECLARE TMP_CSTID INT(11);
        
				SELECT CSTID INTO TMP_CSTID FROM TB100020 
                WHERE CSTNAME = P_NAME 
                AND REPLACE(MOBILE,'-','')=REPLACE(P_PHONE_NUMBER,'-','');
        
				
                IF IFNULL(TMP_CSTID,'') <> '' THEN
                    UPDATE TB100020 SET KAKAO_PROFILE = P_PROFILE, CSTNAME = P_NAME, EMAIL=P_EMAIL, MOBILE=P_PHONE_NUMBER, KAKAO_EDTDATE=NOW() 
                    WHERE CSTID = TMP_CSTID;  

                ELSE
                    INSERT INTO TB100020(KAKAO_ID ,KAKAO_CONNECTED_AT , KAKAO_PROFILE, CSTNAME, EMAIL, MOBILE, AGE_RANGE, BIRTHYEAR, BIRTHDAY, GENDER, REGDATE)
                    SELECT P_ID, P_CONNECTED_AT , P_PROFILE, P_NAME, P_EMAIL, P_PHONE_NUMBER, P_AGE_RANGE, P_BIRTHYEAR, P_BIRTHDAY, P_GENDER, NOW();

                END IF;
                
			END
		";
    
    
    try { 
        //기존에 프로시저가 있으면 삭제
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS INSERT_KAKAO_USER"))
        { //위에서 만든 프로시저 실행
            if(mysqli_query($connect,$procedure))
            {
                $query = "CALL INSERT_KAKAO_USER('".$id."','".$connected_at."','".$profile."','".$name."','".$email."','".$phone_number."','".$age_range."','".$birthyear."','".$birthday."','".$gender."')";
                //프로시저 호출$profile
                mysqli_query($connect,$query);
                echo '등록완료';
            }
        }
        
    } catch (Exception $e) {
        echo 'error : ' .$e;
    }
}




?>