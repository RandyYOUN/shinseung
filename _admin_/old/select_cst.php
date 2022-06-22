<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$output = '';

//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴
$s_option = $_POST["action"];
$sort = $_POST["sort"];
$flag = $_POST["flag"];
$lastid = $_POST["lastid"];
$first = $_POST["first"];
$footer="";

$query_str4 = "";

	if($lastid != ""){
		$query_str4 = " AND ID < ".$lastid .' ' ;
	}

	if($sort != "" && $flag != ""){
		$query_desc = " ORDER BY ".$flag." ".$sort;
	}else{
		$query_desc = " ORDER BY REGDATE DESC";
	}



switch ($s_option){
	case "newfounder" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT *,DATE_FORMAT(REGDATE,'%Y %c/%e') AS REGDATE_ FROM NEW_FOUNDER WHERE 1=1 ".$query_str4.$query_desc." limit 10;
			END;
			";
		$head .= '<span style="font-size:20px;"><b>N지도등록</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="4%"><a href="javascript:sort(\'ID\');">ID</a><span id=\'sort_ID\' style="color:#337ab7;"></span></th>
			<th width="10%"><a href="javascript:sort(\'COMP_NAME\');">회사명</a><span id=\'sort_COMP_NAME\' style="color:#337ab7;"></span></th>
			<th width="10%"><a href="javascript:sort(\'ADDRESS_1\');">주소</a><span id=\'sort_ADDRESS_1\' style="color:#337ab7;"></span></th>
			<th width="18%"><a href="javascript:sort(\'ADDRESS\');">주소상세</a><span id=\'sort_ADDRESS\' style="color:#337ab7;"></span></th>
			<th width="10%"><a href="javascript:sort(\'MOBILE\');">MOBILE</a><span id=\'sort_MOBILE\' style="color:#337ab7;"></span></th>
			<th width="15%"><a href="javascript:sort(\'SECTOR\');">업종</a><span id=\'sort_SECTOR\' style="color:#337ab7;"></span></th>
			<th width="7%"><a href="javascript:sort(\'REGDATE\');">지도등록일</a><span id=\'sort_REGDATE\' style="color:#337ab7;"></span></th>
			</tr>';		
		break;
	case "channel" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT *, replace(substr( B.profile ,INSTR(B.profile,'mobileNumber\': \'+82')+16,13) ,'+82','0') as phone FROM dbsschina.user_chat_guests AS B WHERE B.profile LIKE '%mobileNumber%' ".$query_str4." limit 10;
			END;
			";
		$output .= '<span style="font-size:20px;"><b>채널톡</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="5%">ID</th>
			<th width="10%">고객명</th>
			<th width="10%">MOBILE</th>
			<th width="50%">PROFILE</th>
			</tr>';		
	break;

	case "iq200_3" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT * FROM IQ200_CALL_HISTORY WHERE 1=1 ".$query_str4." order by START_DATE DESC limit 100;
			END;
			";
		$output .= '<span style="font-size:20px;"><b>IQ200 3월</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="5%">전화구분</th>
			<th width="8%">통화시작</th>
			<th width="8%">종료시각</th>
			<th width="8%">통화시간</th>
			<th width="10%">통화구분</th>
			<th width="10%">내선</th>
			<th width="10%">전화번호</th>
			<th width="8%">고객명</th>
			<th width="5%">담당자명</th>
			<th width="10%">상담결과</th>
			<th width="10%">메모</th>
			</tr>';		
	break;

	case "iq200_2" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT * FROM IQ200_CALL_HISTORY_2020_02 WHERE 1=1 ".$query_str4." order by START_DATE DESC limit 10;
			END;
			";
		$output .= '<span style="font-size:20px;"><b>IQ200 2월</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="5%">전화구분</th>
			<th width="8%">통화시작</th>
			<th width="8%">종료시각</th>
			<th width="8%">통화시간</th>
			<th width="10%">통화구분</th>
			<th width="10%">내선</th>
			<th width="10%">전화번호</th>
			<th width="8%">고객명</th>
			<th width="5%">담당자명</th>
			<th width="10%">상담결과</th>
			<th width="10%">메모</th>
			</tr>';		
	break;

	case "callback" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT * FROM NEW_HP WHERE 1=1 ".$query_str4." order by REGDATE DESC limit 10;
			END;
			";
		$output .= '<span style="font-size:20px;"><b>콜백리스트</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="5%">ID</th>
			<th width="10%">핸드폰번호</th>
			<th width="15%">신청일</th>
			<th width="10%">구분</th>
			<th width="10%">사이트</th>
			</tr>';		
	break;

	case "douzone1" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT * FROM dbsschina.sab01 WHERE 1=1 ".$query_str4." limit 10;
			END;
			";
		$output .= '<span style="font-size:20px;"><b>더존거래처1</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="5%">번호</th>
			<th width="5%">코드</th>
			<th width="5%">상호</th>
			<th width="5%">업태</th>
			<th width="5%">구분</th>
			<th width="5%">과세유형</th>
			<th width="5%">사업자등록번호</th>
			<th width="5%">주민(법인등록번호)</th>
			<th width="5%">전화번호</th>
			<th width="5%">사업장관할서</th>
			<th width="5%">담당자명</th>
			<th width="5%">더존메신저ID</th>
			<th width="5%">본점</th>
			<th width="5%">대표자명</th>
			<th width="5%">종목</th>
			<th width="5%">사업장소재지</th>
			<th width="5%">본점(자택)주소</th>
			<th width="5%">주소지관할서</th>
			<th width="5%">담당자연락처</th>
			<th width="5%">주민세납세지</th>
			</tr>';		
	break;

	
	case "douzone2" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT * FROM dbsschina.sab02 WHERE 1=1 ".$query_str4." limit 10;
			END;
			";
		$output .= '<span style="font-size:20px;"><b>더존거래처2</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="5%">번호</th>
			<th width="5%">코드</th>
			<th width="5%">상호</th>
			<th width="5%">업태</th>
			<th width="5%">구분</th>
			<th width="5%">과세유형</th>
			<th width="5%">사업자등록번호</th>
			<th width="5%">주민(법인등록번호)</th>
			<th width="5%">전화번호</th>
			<th width="5%">사업장관할서</th>
			<th width="5%">담당자명</th>
			<th width="5%">더존메신저ID</th>
			<th width="5%">본점</th>
			<th width="5%">대표자명</th>
			<th width="5%">종목</th>
			<th width="5%">사업장소재지</th>
			<th width="5%">본점(자택)주소</th>
			<th width="5%">주소지관할서</th>
			<th width="5%">담당자연락처</th>
			<th width="5%">주민세납세지</th>
			</tr>';		
	break;

	
	case "douzone3" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT * FROM dbsschina.sab03 WHERE 1=1 ".$query_str4." limit 10;
			END;
			";
		$output .= '<span style="font-size:20px;"><b>더존거래처3</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="5%">번호</th>
			<th width="5%">코드</th>
			<th width="5%">상호</th>
			<th width="5%">업태</th>
			<th width="5%">구분</th>
			<th width="5%">과세유형</th>
			<th width="5%">사업자등록번호</th>
			<th width="5%">주민(법인등록번호)</th>
			<th width="5%">전화번호</th>
			<th width="5%">사업장관할서</th>
			<th width="5%">담당자명</th>
			<th width="5%">더존메신저ID</th>
			<th width="5%">본점</th>
			<th width="5%">대표자명</th>
			<th width="5%">종목</th>
			<th width="5%">사업장소재지</th>
			<th width="5%">본점(자택)주소</th>
			<th width="5%">주소지관할서</th>
			<th width="5%">담당자연락처</th>
			<th width="5%">주민세납세지</th>
			</tr>';		
	break;

	case "fran" : 
		$procedure = "
			CREATE PROCEDURE select1()
			BEGIN
			SELECT * FROM dbsschina.FRAN_STORE WHERE 1=1 ".$query_str4." limit 10;
			END;
			";
		$output .= '<span style="font-size:20px;"><b>프랜차이즈</b></span><BR><BR>
			<table class="table table-bordered">
			<tr>
			<th width="5%">영업표지</th>
			<th width="5%">대표자</th>
			<th width="5%">등록번호</th>
			<th width="5%">업종</th>
			<th width="5%">업태</th>
			<th width="5%">대표번호</th>
			<th width="5%">대표팩스</th>
			<th width="5%">주소</th>
			<th width="5%">브랜드수</th>
			<th width="5%">가맹사업개시일</th>
			<th width="5%">가맹점수(2018)</th>
			<th width="5%">신규개점(2018)</th>
			<th width="5%">가입비</th>
			<th width="5%">기준점포면적</th>
			</tr>';		
	break;


	default : "-----error-----";
}











if(isset($_POST["action"]))
{

	//기존에 프로시져가 존재한다면 지운다.
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS select1"))
	{
		//mysqli_query:DB에 쿼리 전송
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL select1()";

			///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
			$result = mysqli_query($connect,$query);


			//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
			if(mysqli_num_rows($result) >0)
			{

				$cate_name="";

				while($row = mysqli_fetch_array($result)){

					switch ($s_option){
						case "newfounder" : 
							$output .= '
							<tr>
							<td>'.$row["ID"].'</td>					<td>'.$row["COMP_NAME"].'</td>
							<td>'.$row["ADDRESS_1"].'</td>
							<td>'.$row["ADDRESS"].'</td>
							<td>'.$row["MOBILE"].'</td>
							<td>'.$row["SECTOR"].'</td>
							<td>'.$row["REGDATE_"].'</td>
							</tr>';					
						break;
						case "channel" : 
							$output .= '
							<tr>
							<td>'.$row["id"].'</td>					<td>'.$row["name"].'</td>
							<td>'.$row["phone"].'</td>
							<td>'.$row["profile"].'</td>
							</tr>';					
						break;
						case "iq200_2" : 
							$output .= '
							<tr>
							<td>'.$row["GUBUN"].'</td>				<td>'.$row["START_DATE"].'</td>
							<td>'.$row["END_DATE"].'</td>
							<td>'.$row["DUR_TIME"].'</td>
							<td>'.$row["SE_RE"].'</td>
							<td>'.$row["INTRA"].'</td>
							<td>'.$row["MOBILE"].'</td>
							<td>'.$row["CSTNAME"].'</td>
							<td>'.$row["MANAGER"].'</td>
							<td>'.$row["RESULT"].'</td>
							<td>'.$row["MEMO"].'</td>
							</tr>';					
						break;
						case "iq200_3" : 
							$output .= '
							<tr>
							<td>'.$row["GUBUN"].'</td>						<td>'.$row["START_DATE"].'</td>
							<td>'.$row["END_DATE"].'</td>
							<td>'.$row["DUR_TIME"].'</td>
							<td>'.$row["SE_RE"].'</td>
							<td>'.$row["INTRA"].'</td>
							<td>'.$row["MOBILE"].'</td>
							<td>'.$row["CSTNAME"].'</td>
							<td>'.$row["MANAGER"].'</td>
							<td>'.$row["RESULT"].'</td>
							<td>'.$row["MEMO"].'</td>
							</tr>';					
						break;
						case "callback" : 
							$output .= '
							<tr>
							<td>'.$row["ID"].'</td>
							<td>'.$row["NEW_HP"].'</td>
							<td>'.$row["REGDATE"].'</td>
							<td>'.$row["Q_TYPE"].'</td>
							<td>'.$row["GUBUN"].'</td>
							</tr>';					
						break;
						case "douzone1" : 
							$output .= '
							<tr>
							<td>'.$row["﻿번호"].'</td>
							<td>'.$row["코드"].'</td>
							<td>'.$row["상호"].'</td>
							<td>'.$row["업태"].'</td>
							<td>'.$row["구분"].'</td>
							<td>'.$row["과세유형"].'</td>
							<td>'.$row["사업자등록번호"].'</td>
							<td>'.$row["주민(법인등록번호)"].'</td>
							<td>'.$row["전화번호"].'</td>
							<td>'.$row["사업장관할서"].'</td>
							<td>'.$row["담당자명"].'</td>
							<td>'.$row["더존메신저ID"].'</td>
							<td>'.$row["본점"].'</td>
							<td>'.$row["대표자명"].'</td>
							<td>'.$row["종목"].'</td>
							<td>'.$row["사업장소재지"].'</td>
							<td>'.$row["본점(자택)주소"].'</td>
							<td>'.$row["주소지관할서"].'</td>
							<td>'.$row["담당자연락처"].'</td>
							<td>'.$row["주민세납세지"].'</td>
							</tr>';					
						break;
						case "douzone2" : 
							$output .= '
							<tr>
							<td>'.$row["﻿번호"].'</td>
							<td>'.$row["코드"].'</td>
							<td>'.$row["상호"].'</td>
							<td>'.$row["업태"].'</td>
							<td>'.$row["구분"].'</td>
							<td>'.$row["과세유형"].'</td>
							<td>'.$row["사업자등록번호"].'</td>
							<td>'.$row["주민(법인등록번호)"].'</td>
							<td>'.$row["전화번호"].'</td>
							<td>'.$row["사업장관할서"].'</td>
							<td>'.$row["담당자명"].'</td>
							<td>'.$row["더존메신저ID"].'</td>
							<td>'.$row["본점"].'</td>
							<td>'.$row["대표자명"].'</td>
							<td>'.$row["종목"].'</td>
							<td>'.$row["사업장소재지"].'</td>
							<td>'.$row["본점(자택)주소"].'</td>
							<td>'.$row["주소지관할서"].'</td>
							<td>'.$row["담당자연락처"].'</td>
							<td>'.$row["주민세납세지"].'</td>
							</tr>';					
						break;
						case "douzone3" : 
							$output .= '
							<tr>
							<td>'.$row["﻿번호"].'</td>
							<td>'.$row["코드"].'</td>
							<td>'.$row["상호"].'</td>
							<td>'.$row["업태"].'</td>
							<td>'.$row["구분"].'</td>
							<td>'.$row["과세유형"].'</td>
							<td>'.$row["사업자등록번호"].'</td>
							<td>'.$row["주민(법인등록번호)"].'</td>
							<td>'.$row["전화번호"].'</td>
							<td>'.$row["사업장관할서"].'</td>
							<td>'.$row["담당자명"].'</td>
							<td>'.$row["더존메신저ID"].'</td>
							<td>'.$row["본점"].'</td>
							<td>'.$row["대표자명"].'</td>
							<td>'.$row["종목"].'</td>
							<td>'.$row["사업장소재지"].'</td>
							<td>'.$row["본점(자택)주소"].'</td>
							<td>'.$row["주소지관할서"].'</td>
							<td>'.$row["담당자연락처"].'</td>
							<td>'.$row["주민세납세지"].'</td>
							</tr>';					
						break;
						case "fran" : 
							$output .= '
							<tr>
							<td>'.$row["COMP_NAME"].'</td>
							<td>'.$row["OWNER"].'</td>
							<td>'.$row["REG_NUM"].'</td>
							<td>'.$row["SECTOR1"].'</td>
							<td>'.$row["SECTOR2"].'</td>
							<td>'.$row["PHONE"].'</td>
							<td>'.$row["FAX"].'</td>
							<td>'.$row["ADDRESS"].'</td>
							<td>'.$row["BRAND_CNT"].'</td>
							<td>'.$row["START_DATE"].'</td>
							<td>'.$row["AFF_SCORE_2018"].'</td>
							<td>'.$row["NEW_AFF_2018"].'</td>
							<td>'.$row["REG_PAY"].'</td>
							<td>'.$row["AREA"].'</td>
							</tr>';					
						break;
					default : "-----error-----";
					}

				}
			}// 네번째 if문 끝
			else
			{
				$output .= '
				<tr>
				<td colspan="9" align="center">데이터가 없습니다.</td>
				</tr>
				';
			}

			$output .= '</table> <script>sort_onload();</script>';

			//최종출력!
			echo $output;

		}// 세번째 if문 끝

	} // 두번째 if 문 끝

}//첫번째 if문 끝!





?>
