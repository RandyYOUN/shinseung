<?php
include "db_info.php";
//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$output = '';
$output2 = '
근무시간외 미연락자
';
$report1_cnt = '';
$flag = '';

if($_GET["action"]=="기장")
{
	$Q_TYPE = '기장';
}else if($_GET["action"]=="양도"){
	$Q_TYPE = '양도상속증여';
}else if($_GET["action"]=="종합소득세"){
	$Q_TYPE = '종합소득세';
} 

if(isset($_GET["action"])){

	//db연결 본인의 db 정보를 넣어준다!
    //$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
	//( "db.sostax.kr:3306", "sschina", "shinseung1@" )
		
	//ajax로 넘긴 데이터 값은 "select"
	//값이 존재하면 true를 리턴
	//users테이블 조회 프로시져를 만든다.
	$procedure = "
	CREATE PROCEDURE report1()
	BEGIN
	SELECT *,date_format(REGDATE,'%H%i') ,CASE 	WHEN (date_format(REGDATE,'%H%i') >= 0930 AND date_format(REGDATE,'%H%i') <= 1830) THEN '시간내'    WHEN (date_format(REGDATE,'%H%i') < 0930 OR date_format(REGDATE,'%H%i') > 1830) THEN '시간외'    ELSE ''END AS TIME_FLAG FROM NEW_HP WHERE  date_format(REGDATE,'%Y%m%d') = date_format(NOW(),'%Y%m%d')-1 AND Q_TYPE = '".$Q_TYPE."';
	END;
	";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS report1"))
		{

			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL report1()";
				$result = mysqli_query($connect,$query);

				if(mysqli_num_rows($result) >0)
				{
					while($row = mysqli_fetch_array($result)){
						$flag = $row["TIME_FLAG"];

						if($flag == '시간외'){
							$output2 .= $row["NEW_HP"].', 날짜'.$row["REGDATE"].'
							';
						}else{
							$output .= $row["NEW_HP"].', 날짜'.$row["REGDATE"].'
							';
						}
					}
				}else{
					$output .= '전일 데이터가 없습니다';
				}
			}
		} 
	mysqli_close($connect);



	$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

	$procedure2 = "
	CREATE PROCEDURE report1_cnt()
	BEGIN
	SELECT count(*) AS CNT FROM NEW_HP WHERE  date_format(REGDATE,'%Y%m%d') = date_format(NOW(),'%Y%m%d')-1 AND Q_TYPE = '".$Q_TYPE."';
	END;
	";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS report1_cnt"))
		{ 
			if(mysqli_query($connect,$procedure2))
			{
				$query2 = "CALL report1_cnt()";
				$result2 = mysqli_query($connect,$query2);

				//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
				if(mysqli_num_rows($result2) >0)
				{
					while($row = mysqli_fetch_array($result2)){
						$report1_cnt .= '총'.$row["CNT"].'건의 '.$Q_TYPE.'문의가 있었습니다.
						';
					}
				}else{
					$report1_cnt .= '전일 데이터가 없습니다';
				}
			}
		} 

		/*
		 * 뿌리오 발송API 내부알림
		 */
		$_api_url = 'https://www.ppurio.com/api/send_utf8_json.php';

		/*
		 * 요청값
		 */
		$_param['userid'] = 'shinseung';     // [필수] 뿌리오 아이디
		$_param['callback'] = '18993582';    // [필수] 발신번호 - 숫자만

		if($_GET["action"] == '기장'){
			$_param['phone'] = '01055904957|01066413582|01038484309'; //법인폰/정혜숙
		}else if($_GET["action"] == '양도'){
			$_param['phone'] = '01055904957|01066413582|01022997901'; // 법인폰/이인준
		}else if($_GET["action"] == '종합소득세'){
			$_param['phone'] = '01055904957|01066413582|01038484309'; // 법인폰/정혜숙
		}

		$_param['msg'] = $report1_cnt.$output.$output2;
		$_param['subject'] = '일일결산';

		if(mysqli_num_rows($result) > 0){
			
			$_curl = curl_init();
			curl_setopt($_curl,CURLOPT_URL,$_api_url);
			curl_setopt($_curl,CURLOPT_POST,true);
			curl_setopt($_curl,CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($_curl,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($_curl,CURLOPT_POSTFIELDS,$_param);
			$_result = curl_exec($_curl);
			curl_close($_curl);

			$_result = json_decode($_result);
		
		}

echo 'CNT = '.mysqli_num_rows($result);

	/*
	뿌리오 끝
	*/

}

?>
