<?php
session_start();

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수

$action = $_POST["action"];
//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )


if($action == "select_trans_prog"){
	$procedure_upt = "
		CREATE PROCEDURE UPT_TRANS_PROGRESS(IN p_id INT, p_val varchar(5))
		BEGIN
			UPDATE TB600010 SET PROGRESS = p_val
			WHERE ID = p_id;
		END;
		";

		
		//기존에 프로시져가 존재한다면 지운다.
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_TRANS_PROGRESS"))
		{
			if(mysqli_query($connect,$procedure_upt))
			{
				$query_upt = "CALL UPT_TRANS_PROGRESS('".$_POST["id"]."','".$_POST["select_val"]."')";
				mysqli_query($connect,$query_upt);
			}
		}
}


//양도소득세 수정시 select : 시작
if($action == "select_trans" && isset($_POST["id"])){
	$output = array();

	$procedure = "
		CREATE PROCEDURE SELECT_MODIFY_TRANS(IN user_id int(100))
		BEGIN
			SELECT A.*, B.USERNAME 'REGUSER_',
            C.CODE_ 'REG_BRANCH',
			C.VALUE_ 'REG_BRANCH_',
			D.CODE_ 'PROGRESS' ,
			D.VALUE_ 'PROGRESS_' ,
			E.CODE_ 'TAX_FLAG',
			E.VALUE_ 'TAX_FLAG_',
			F.CODE_ 'TRANS_TARGET',
			F.VALUE_ 'TRANS_TARGET_',
			G.CODE_ 'PAY_FLAG',
			G.VALUE_ 'PAY_FLAG_',
			H.CODE_ 'DELIVERY_FLAG',
			H.VALUE_ 'DELIVERY_FLAG_',
			DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
			DATE_FORMAT(A.TRANS_DATE, '%Y-%m-%d') 'TRANS_DATE_',
            DATE_FORMAT(A.ACQ_DATE, '%Y-%m-%d') 'ACQ_DATE_',
            DATE_FORMAT(A.DEADLINE, '%Y-%m-%d') 'DEADLINE_',
            A.OWNER_USER 'OWNER_USER',
			I.USERNAME 'OWNER_'
			FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON A.REGUSER = B.USERID
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
            
			WHERE A.ID = user_id;
		END;
		";
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_MODIFY_TRANS"))
		{
			if(mysqli_query($connect, $procedure))
			{
				$query = "CALL SELECT_MODIFY_TRANS(".$_POST["id"].")";
				$result = mysqli_query($connect, $query);

				while($row = mysqli_fetch_array($result))
				{
					$output['CATE'] = $row["CATE"];
					$output['USERNAME'] = $row["USERNAME"];
					$output['REGUSER'] = $row["REGUSER"];
					$output['REGDATE'] = $row["REGDATE"];
					$output['REG_BRANCH'] = $row["REG_BRANCH"];
					$output['REG_BRANCH_'] = $row["REG_BRANCH_"];
					$output['PROGRESS'] = $row["PROGRESS"];
					$output['PROGRESS_'] = $row["PROGRESS_"];
					$output['TAX_FLAG'] = $row["TAX_FLAG"];
					$output['TAX_FLAG_'] = $row["TAX_FLAG_"];
					$output['CSTNAME'] = $row["CSTNAME"];
					$output['MOBILE'] = $row["MOBILE"];
					$output['CST_ADDRESS'] = $row["CST_ADDRESS"];
					$output['TRANS_TARGET'] = $row["TRANS_TARGET"];
					$output['TRANS_TARGET_'] = $row["TRANS_TARGET_"];
					$output['PAY_FLAG'] = $row["PAY_FLAG"];
					$output['PAY_FLAG_'] = $row["PAY_FLAG_"];
					$output['PAY_DATE_'] = $row["PAY_DATE_"];
					$output['PRICE'] = $row["PRICE"];
					$output['MANAGER'] = $row["MANAGER"];
					$output['TRANS_DATE_'] = $row["TRANS_DATE_"];
					$output['ACQ_DATE_'] = $row["ACQ_DATE_"];
					$output['DELIVERY_FLAG'] = $row["DELIVERY_FLAG"];
					$output['CONTENTS'] = $row["CONTENTS"];
					$output['TRANS_PRICE'] = $row["TRANS_PRICE"];
					$output['ACQ_PRICE'] = $row["ACQ_PRICE"];
					$output['DEADLINE_'] = $row["DEADLINE_"];
					$output['TOTAL_TAX'] = $row["TOTAL_TAX"];
					$output['FILE_REAL_STR'] = $row["FILE_REAL_STR"];
					$output['FILE_VIEW_STR'] = $row["FILE_VIEW_STR"];
					$output['REGUSER_'] = $row["REGUSER_"];
					$output['OWNER_'] = $row["OWNER_"];
					$output['OWNER_USER'] = $row["OWNER_USER"];

				}
				echo json_encode($output);
			} 
		} 
}
//양도소득세 수정시 select : 끝


//양도소득세 list select : 시작
if($action == "select_trans_list"){

	$s_option = $_POST["s_option"];
	$g_option = $_POST["g_option"];
	$s_str = $_POST["s_str"];
	$lastid = $_POST["lastid"];
	$first = $_POST["first"];
	$p_id =  $_POST["id"];
	$p_val =  $_POST["select_val"];
	$p_memo =  $_POST["memo"];
	$p_bran =  $_POST["bran"];
	$p_stat =  $_POST["stat"];
	$action2 =  $_POST["action2"];
	$query_str1 = "";
	$page = $_POST["page"];
	$page_set = 12; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수

	$query_cnt = "SELECT count(A.ID) as total FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON A.REGUSER = B.USERID
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER ";

	$result_cnt = mysqli_query($connect,$query_cnt) or die(mysqli_error($connect));


	$row = mysqli_fetch_array($result_cnt);

	$total = $row[total]; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치

	$head .= '
			<colgroup>
				<col width="80px">
				<col width="150px">
				<col width="150px">
				<col width="150px">
				<col width="100px">
				<col width="100px">
				<col width="100px">
				<col width="150px">
				<col width="100px">
				<col width="100px">
				<col width="100px">
				<col width="400px">
				<col width="100px">
			</colgroup>
			<thead>
			<tr>
				<th>번호</th>
				<th>진행상태</th>
				<th>납세자명</th>
				<th>세목</th>
				<th>접수지점</th>
				<th>접수자</th>
				<th>작성일</th>
				<th>납세자연락처</th>
				<th>수수료</th>
				<th>수수료납부</th>
				<th>납부일자</th>
				<th>납세자주소지</th>
				<th>신고기한</th>
			</tr>
			</thead>
			';

	if($_POST["s_option"] != ""){
		switch($s_option){
			case "cstname" : 
				$query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
				break;
			case "owner" : 
				$query_str1 .= " AND I.USERNAME like '%".$s_str."%' ";
				break;
			case "progress" : 
				$query_str1 .= " AND PROGRESS like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$query_str1 .= " AND B.USERNAME like '%".$s_str."%' ";
				break;
			case "mobile" : 
				$query_str1 .= " AND A.MOBILE like '%".$s_str."%' ";
				break;
			case "num" : 
				$query_str1 .= " AND A.NUM = '".$s_str."' ";
				break;
			default:
				$query_str1 ="";
		}	
	}

	if($_POST["g_option"] != ""){
		$query_str1 .= " AND A.REG_BRANCH = '".$g_option."'";	
	}


	$procedure = "
	CREATE PROCEDURE SELECT_TRANS()
	BEGIN
		SELECT A.*, B.USERNAME 'REGUSER_',C.VALUE_ 'REG_BRANCH',D.VALUE_ 'PROGRESS_' ,
			E.VALUE_ 'TAX_FLAG',F.VALUE_ 'TRANS_TARGET',G.VALUE_ 'PAY_FLAG',H.VALUE_ 'DELIVERY_FLAG',DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
			 DATE_FORMAT(A.TRANS_DATE, '%Y-%m-%d') 'TRANS_DATE_',
            DATE_FORMAT(A.ACQ_DATE, '%Y-%m-%d') 'ACQ_DATE_',
            DATE_FORMAT(A.DEADLINE, '%Y-%m-%d') 'DEADLINE_',
            A.OWNER_USER 'OWNER_'
			FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON B.USERID = A.REGUSER 
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			WHERE 1=1 ".$query_str1." 
			ORDER BY A.ID DESC
			LIMIT $limit_idx, $page_set 
			;
	END;
	";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TRANS"))
	{
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL SELECT_TRANS()";
			$result = mysqli_query($connect,$query) or die(mysqli_error($connect));
			$head .= '';
			$prog = "";

			if(mysqli_num_rows($result) >0)
			{

				while($row = mysqli_fetch_array($result)){
					$prog = $row["PROGRESS"];
					$output .= '
					<tr>
					<td>'.$row["NUM"].'</td>
					<td>
						<select style="width:120px;height:35px;" id="'.$row["ID"].'" name="PROGRESS" onchange="javascript:mod_prog(this);">';
					
					$prog == "E5001" ? $output .= '<option value="E5001" selected>접수</option>' : $output .= '<option value="E5001">접수</option>';
					$prog == "E5002" ? $output .= '<option value="E5002" selected>1차검토</option>' : $output .='<option value="E5002">1차검토</option>';
					$prog == "E5003" ? $output .= '<option value="E5003" selected>2차검토</option>' : $output .='<option value="E5003">2차검토</option>';
					$prog == "E5004" ? $output .= '<option value="E5004" selected>3차검토</option>' : $output .='<option value="E5004">3차검토</option>';
					$prog == "E5005" ? $output .= '<option value="E5005" selected>계약해지</option>' : $output .='<option value="E5005">계약해지</option>';
					$prog == "E5006" ? $output .= '<option value="E5006" selected>결제완료</option>' : $output .='<option value="E5006">결제완료</option>';
					$prog == "E5007" ? $output .= '<option value="E5007" selected>최종완료</option>' : $output .='<option value="E5007">최종완료</option>';

					$output .='</select>
					</td>
					<td><a href="view_trans.php?id='.$row["ID"].'"> '.$row["CSTNAME"].'</a></td>
					<td>'.$row["TAX_FLAG"].'</td>
					<td>'.$row["REG_BRANCH"].'</td>
					<td>'.$row["USERNAME"].'</td>
					<td>'.$row["REGDATE_"].'</td>
					<td>'.$row["MOBILE"].'</td>
					<td>'.$row["PRICE"].'</td>
					<td>'.$row["PAY_FLAG"].'</td>
					<td>'.$row["PAY_DATE_"].'</td>
					<td>'.$row["CST_ADDRESS"].'</td>
					<td>'.$row["DEADLINE_"].'</td>


					</tr>
					';
				}
			}
			else
			{
				$output .= '
				<tr>
				<td colspan="5" align="center">데이터가 없습니다.</td>
				</tr>
				<tr><td colspan="5">'.$procedure.'</td></tr>
				';
			}

			echo $head.$output;

		}

	} 


}
//양도소득세 list select : 끝





//신승ADMIN 멤버수정페이지 select : 시작
if($action == "select_admin_member" && isset($_POST["id"]))
{

	$output = array();
	$procedure = "
		CREATE PROCEDURE ADMIN_MEMBER(IN user_id int(100))
		BEGIN
			SELECT A.*, B.CODE_ AS 'DEPID' FROM dbsschina.TB980010 AS A LEFT OUTER JOIN TB750010 AS B ON A.DEPID = B.CODE_
			WHERE USERID = user_id;
		END;
		";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS ADMIN_MEMBER"))
	{
		if(mysqli_query($connect, $procedure))
		{
			$query = "CALL ADMIN_MEMBER(".$_POST["id"].")";
			$result = mysqli_query($connect, $query);

			while($row = mysqli_fetch_array($result))
			{
				$output['USERNAME'] = $row["USERNAME"];
				$output['ID'] = $row["ID"];
				$output['DEPID'] = $row["DEPID"];			
			}

			echo json_encode($output);
		}
	}
}
//신승ADMIN 멤버수정페이지 select : 끝


//신승ADMIN 멤버리스트 : 시작
if($action == "select_memberlist"){
	$query_str = '';
	$head .= '
			<colgroup>
				<col width="100px">
				<col width="200px">
				<col width="200px">
				<col width="200px">
				<col width="250px">
				<col width="250px">
				<col width="100px">
			</colgroup>
			<thead>
			<tr>
				<th>USERID</th>
				<th>사용자이름</th>
				<th>ID</th>
				<th>소속</th>
				<th>등록일</th>
				<th>수정일</th>
				<th>수정</th>
				</tr>
			</thead>
			';

	$procedure = "
	CREATE PROCEDURE SELECT_ADMIN_MEMBER()
	BEGIN
		SELECT A.*, B.VALUE_ AS 'DEPNAME' FROM dbsschina.TB980010 AS A LEFT OUTER JOIN TB750010 AS B ON A.DEPID = B.CODE_ WHERE 1=1 ".$query_str."
		ORDER BY USERID;
	END;
	";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_ADMIN_MEMBER"))
	{
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL SELECT_ADMIN_MEMBER()";
			$result = mysqli_query($connect,$query);
			$head .= '';

			if(mysqli_num_rows($result) >0)
			{

				while($row = mysqli_fetch_array($result)){

					$output .= '
					<tr>
					<td>'.$row["USERID"].'</td>
					<td>'.$row["USERNAME"].'</td>
					<td>'.$row["ID"].'</td>
					<td>'.$row["DEPNAME"].'</td>
					<td>'.$row["REGDATE"].'</td>
					<td>'.$row["EDTDATE"].'</td>
					<td style="text-align:center;"><a href="reg_member.php?id='.$row["USERID"].'">수정</a></td>
					</tr>
					';
				}
			}
			else
			{
				$output .= '
				<tr>
				<td colspan="5" align="center">데이터가 없습니다.</td>
				</tr>
				';
			}

			echo $head.$output;

		}

	} 


}
//신승ADMIN 멤버리스트 : 끝

//로그인 : 시작
if($action == "login"){
	$id = $_POST["id"];
	$pw = $_POST["pw"];

	$procedure_login = "
	CREATE PROCEDURE LOGIN(IN p_id varchar(45), p_pw varchar(45) )
	BEGIN
		SELECT A.*, B.VALUE_ as 'DEPNAME', B.CODE_ AS 'DEPID' FROM dbsschina.TB980010 as A LEFT OUTER JOIN TB750010 AS B ON A.DEPID=B.CODE_
		WHERE ID=p_id AND PW=PASSWORD(p_pw);
	END;
	";

	
	//기존에 프로시져가 존재한다면 지운다.
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS LOGIN"))
	{
		//mysqli_query:DB에 쿼리 전송
		if(mysqli_query($connect,$procedure_login))
		{
			$query = "CALL LOGIN('".$id."','".$pw."')";

			$result = mysqli_query($connect,$query);
		
			//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
			if(mysqli_num_rows($result) >0)
			{
				while($row = mysqli_fetch_array($result)){
					$_SESSION['USERNAME'] = $row["USERNAME"];
					$_SESSION['USERID'] = $row["USERID"];
					$_SESSION['DEPNAME'] = $row["DEPNAME"];
					$_SESSION['DEPID'] = $row["DEPID"];
				}

				$_SESSION['user_id'] = $id;
				echo 'login_ok';
			}
		}
	}


}
//로그인 : 끝


// 주택임대 신청 : 시작
if($action == "select_home"){
	$s_option = $_POST["s_option"];
	$g_option = $_POST["g_option"];
	$s_str = $_POST["s_str"];
	$lastid = $_POST["lastid"];
	$first = $_POST["first"];
	$p_id =  $_POST["id"];
	$p_val =  $_POST["select_val"];
	$p_memo =  $_POST["memo"];
	$p_bran =  $_POST["bran"];
	$p_stat =  $_POST["stat"];
	$action2 =  $_POST["action2"];

	$footer="";

	$query_str1 = "";
	$query_str2 = "";
	$query_str4 = "";


	$page = $_POST["page"];

	$page_set = 12; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수


	$query = "SELECT count(ID) as total FROM INCOME_CST WHERE FLAG='HOME' ";

	$result = mysqli_query($connect,$query);


	$row = mysqli_fetch_array($result);

	$total = $row[total]; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치
	$tmp .= "<br>page=".$page."<br>limit_idx=".$limit_idx;
		switch($s_option){
		case "CSTNAME" : 
			$query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
			break;
		case "MOBILE" : 
			$query_str1 .= " AND MOBILE like '%".$s_str."%' ";
			break;
		case "MEMO" : 
			$query_str1 .= " AND MEMO like '%".$s_str."%' ";
			break;
		default:
			$query_str1 ="";
		}

		if($g_option != "0" ){
			$query_str2 = "AND BRANCH = '".$g_option."' ";
		}

		if($lastid != ""){
			$query_str4 = " AND ID < ".$lastid .' ' ;
		}



	if(isset($action2))
	{

		if($action2 == "등록"){
			$procedure_upt = "
				CREATE PROCEDURE upt_HOME(IN p_id INT, p_val INT, p_memo LONGTEXT, p_bran INT, p_stat INT  )
				BEGIN
					UPDATE INCOME_CST SET CONTACT_CNT = p_val, CON_REGDATE = NOW(), MEMO = p_memo, MEMO_REGDATE = NOW(), BRANCH=p_bran, STAT=p_stat WHERE ID = p_id AND FLAG='HOME';
				END;
				";

				
				//기존에 프로시져가 존재한다면 지운다.
				if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS upt_HOME"))
				{
					if(mysqli_query($connect,$procedure_upt))
					{
						$query_upt = "CALL upt_HOME('".$p_id."','".$p_val."','".$p_memo."','".$p_bran."','".$p_stat."')";
						mysqli_query($connect,$query_upt);
					}
				}
		}





	//users테이블 조회 프로시져를 만든다.
	$procedure = "
	CREATE PROCEDURE selectHOME()
	BEGIN
	SELECT 
	*,IFNULL( BRANCH,0) AS BRANCH, IFNULL(STAT,0) STAT, IFNULL(CONTACT_CNT,0) AS CNT_,date_format(REGDATE,'%Y%m%d %H:%i') as REGDATE_ 
	FROM INCOME_CST WHERE FLAG='HOME' ".$query_str1.$query_str2.$query_str4." ORDER BY REGDATE DESC LIMIT $limit_idx, $page_set;
	END;
	";

	//기존에 프로시져가 존재한다면 지운다.
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectHOME"))
	{
		//mysqli_query:DB에 쿼리 전송
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL selectHOME()";

			///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
			$result = mysqli_query($connect,$query);
			$head .= '
			<colgroup>
				<col width="70px">
				<col width="100px">
				<col width="150px">
				<col width="150px">
				<col width="150px">
				<col width="300px">
				<col width="100px">
				<col width="100px">
				<col width="100px">
				<col width="150px">
			</colgroup>
			<thead>
			<tr>
				<th>ID</th>
				<th>이름</th>
				<th>핸드폰번호</th>
				<th>신청일</th>
				<th>보유주택수</th>
				<th>연간임대소득</th>
				<th>공동명의</th>
				<th>전화횟수</th>
				<th>지점</th>
				<th>현황</th>
				<th>메모</th>
				</tr>
			</thead>
			';

			$path = "../tax_income/upload/";
				

			//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
			if(mysqli_num_rows($result) >0)
			{

				$cate_name="";

				while($row = mysqli_fetch_array($result)){

					$msg_id = $row["ID"];
					$dir = $path.$row["CSTNAME"]."/";
					$dir = iconv("UTF-8","cp949",$dir);
					$LINK = '';

					if (is_dir($dir)){
						$LINK = '<a href="javascript:file_pop(\''.$row["ID"].'\')">링크</a>';	
					}


					$output .= '
					<tr>
					<td>'.$row["ID"].'</td>
					<td>'.$row["CSTNAME"].'</td>
					<td>'.$row["MOBILE"].'</td>
					<td>'.$row["REGDATE_"].'</td>
					<td>'.$row["HOME_Q1"].'</td>
					<td>'.$row["HOME_Q2"].'</td>
					<td>'.$row["HOME_Q3"].'</td>
					<td>
						<select style="width:60px;height:35px;" id="'.$row["ID"].'" name="CONTACT_CNT" onchange="javascript:select_cnt(this);">';

						for($i=0; $i <=5; $i++ ){
							if($row["CNT_"] == $i){
								$output.= '<option value="'.$i.'" selected>'.$i.'회</option>';
							}else{
								$output.= '<option value="'.$i.'">'.$i.'회</option>';
							}	
						}

					$output.= '</select>
					</td>
					<td>
					<select style="width:70px;height:35px;" id="bran_'.$row["ID"].'" name="branch" onchange="javascript:select_bran(this);">';

					$selected = "";

						for($i=0; $i <=12; $i++ ){
							
							if($row["BRANCH"] == $i){
								$selected = "selected";
							}else{
								$selected = "";
							}

							switch($i){
								case 0 : $output.= '<option value="0">선택</option>'; break;
								case 10 : $output.= '<option value="10" '.$selected.'>세무</option>';break;
								
								case 11 : $output.= '<option value="11" '.$selected.'>회계</option>';break;
									
								case 1 : $output.= '<option value="1" '.$selected.'>강남</option>'; break;

								case 2 : $output.= '<option value="2" '.$selected.'>용인</option>';break;
								
								case 3 : $output.= '<option value="3" '.$selected.'>안양</option>';break;
								
								case 4 : $output.= '<option value="4" '.$selected.'>수원</option>';break;
								
								case 5 : $output.= '<option value="5" '.$selected.'>일산</option>';break;
								
								case 6 : $output.= '<option value="6" '.$selected.'>부천</option>';break;
								
								case 7 : $output.= '<option value="7" '.$selected.'>광주</option>';break;
								
								case 8 : $output.= '<option value="8" '.$selected.'>분당</option>';break;
								
								case 9 : $output.= '<option value="9" '.$selected.'>기흥</option>';break;
											
								case 12 : $output.= '<option value="12" '.$selected.'>영업</option>';break;
							}
						}

					$output.= '</select>
					</td>
					<td>
					<select style="width:80px;height:35px;" id="stat_'.$row["ID"].'" name="stat" onchange="javascript:select_stat(this);">';

					$selected = "";

						for($i=0; $i <=12; $i++ ){
							
							if($row["STAT"] == $i){
								$selected = "selected";
							}else{
								$selected = "";
							}

							switch($i){
								case 0 : $output.= '<option value="0">선택</option>'; break;
								case 1 : $output.= '<option value="'.$i.'" '.$selected.'>수신부재</option>'; break;
								case 2 : $output.= '<option value="'.$i.'" '.$selected.'>수임확정</option>';break;
								case 3 : $output.= '<option value="'.$i.'" '.$selected.'>수임예상</option>';break;
								case 4 : $output.= '<option value="'.$i.'" '.$selected.'>수임곤란</option>';break;
								case 5 : $output.= '<option value="'.$i.'" '.$selected.'>수임불가</option>';break;
							}
						}

					$output.= '</select>
					</td>
					<td><DIV id="memo_lbl_'.$row["ID"].'" style="width:200px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.$row["MEMO"].'</DIV><input type="text" id="memo_ip_'.$row["ID"].'" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27) {memo_submit(this);}" value="'.$row["MEMO"].'" style="display:none;padding-top:10px;"></input></td>
					</tr>

					';
					}
				}// 네번째 if문 끝
				else
				{
					$output .= '
					<tr>
					<td colspan="10" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}
				echo $head.$output;

			}

		} 

	}

}


// 주택임대 신청 : 끝




// 종합소득세 신청 : 시작
if($action == "select_income")
{
	$s_option = $_POST["s_option"];
	$g_option = $_POST["g_option"];
	$s_str = $_POST["s_str"];
	$lastid = $_POST["lastid"];
	$first = $_POST["first"];
	$p_id =  $_POST["id"];
	$p_val =  $_POST["select_val"];
	$p_memo =  $_POST["memo"];
	$p_bran =  $_POST["bran"];
	$p_stat =  $_POST["stat"];
	$action2 =  $_POST["action2"];

	$footer="";

	$query_str1 = "";
	$query_str2 = "";
	$query_str4 = "";


	$page = $_POST["page"];

	$page_set = 12; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수


	$query = "SELECT count(ID) as total FROM INCOME_CST WHERE FLAG='INCOME' ";

	$result = mysqli_query($connect,$query);


	$row = mysqli_fetch_array($result);

	$total = $row[total]; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치

		switch($s_option){
		case "CSTNAME" : 
			$query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
			break;
		case "MOBILE" : 
			$query_str1 .= " AND MOBILE like '%".$s_str."%' ";
			break;
		case "MEMO" : 
			$query_str1 .= " AND MEMO like '%".$s_str."%' ";
			break;
		default:
			$query_str1 ="";
		}

		if($g_option != "0" ){
			$query_str2 = "AND BRANCH = '".$g_option."' ";
		}

		if($lastid != ""){
			$query_str4 = " AND ID < ".$lastid .' ' ;
		}



	if(isset($action2))
	{

		if($action2 == "등록"){
			$procedure_upt = "
				CREATE PROCEDURE upt_INCOME(IN p_id INT, p_val INT, p_memo LONGTEXT, p_bran INT, p_stat INT  )
				BEGIN
					UPDATE INCOME_CST SET CONTACT_CNT = p_val, CON_REGDATE = NOW(), MEMO = p_memo, MEMO_REGDATE = NOW(), BRANCH=p_bran, STAT=p_stat WHERE ID = p_id;
				END;
				";

				
			//기존에 프로시져가 존재한다면 지운다.
			if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS upt_INCOME"))
			{
				if(mysqli_query($connect,$procedure_upt))
				{
					$query_upt = "CALL upt_INCOME('".$p_id."','".$p_val."','".$p_memo."','".$p_bran."','".$p_stat."')";
					mysqli_query($connect,$query_upt);
				}
			}
		}



		if($action2 == "삭제"){
			$procedure_upt_del = "
				CREATE PROCEDURE UPT_DEL_INCOME(IN p_id INT )
				BEGIN
					UPDATE INCOME_CST SET VISIBLE='N' WHERE ID = p_id;
				END;
				";

				
			//기존에 프로시져가 존재한다면 지운다.
			if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_DEL_INCOME"))
			{
				if(mysqli_query($connect,$procedure_upt_del))
				{
					$query_upt = "CALL UPT_DEL_INCOME('".$p_id."')";
					mysqli_query($connect,$query_upt);
				}
			}
		}




		//users테이블 조회 프로시져를 만든다.
		$procedure = "
		CREATE PROCEDURE selectINCOME()
		BEGIN
		SELECT 
		ID, MOBILE,CSTNAME,QUEST, MEMO,IFNULL( BRANCH,0) AS BRANCH, IFNULL(STAT,0) STAT, IFNULL(CONTACT_CNT,0) AS CNT_,date_format(REGDATE,'%Y%m%d %H:%i') as REGDATE_ 
		FROM INCOME_CST WHERE FLAG='INCOME' AND VISIBLE = 'Y' ".$query_str1.$query_str2.$query_str4." ORDER BY REGDATE DESC LIMIT $limit_idx, $page_set;
		END;
		";

		//기존에 프로시져가 존재한다면 지운다.
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectINCOME"))
		{
		//mysqli_query:DB에 쿼리 전송
		if(mysqli_query($connect,$procedure))
		{
		$query = "CALL selectINCOME()";

		///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
		$result = mysqli_query($connect,$query);
		$head .= '
		<colgroup>
		<col width="100px">
		<col width="100px">
		<col width="150px">
		<col width="300px">
		<col width="150px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="150px">
		<col width="100px">
		</colgroup>
		<thead>
		<tr>
		<th>ID</th>
		<th>이름</th>
		<th>핸드폰번호</th>
		<th>질문</th>
		<th>신청일</th>
		<th>첨부파일</th>
		<th>전화횟수</th>
		<th>지점</th>
		<th>현황</th>
		<th>메모<br>(메모영역 클릭하시면 수정가능)</th>
		<th>삭제</th>
		</tr>
		</thead>
		';

		$path = "../tax_income/upload/";
			

		//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
		if(mysqli_num_rows($result) >0)
		{

			$cate_name="";

			while($row = mysqli_fetch_array($result)){

				$msg_id = $row["ID"];
				$dir = $path.$row["CSTNAME"]."/";
				$dir = iconv("UTF-8","cp949",$dir);
				$LINK = '';

				if (is_dir($dir)){
					$LINK = '<a href="javascript:file_pop(\''.$row["ID"].'\')">링크</a>';	
				}


				$output .= '
				<tr>
				<td style="text-align:center;">'.$row["ID"].'</td>
				<td>'.$row["CSTNAME"].'</td>
				<td>'.$row["MOBILE"].'</td>
				<td>'.$row["QUEST"].'</td>
				<td>'.$row["REGDATE_"].'</td>
				<td>'.$LINK.'</td>
				<td>
					<select style="width:60px;height:35px;" id="'.$row["ID"].'" name="CONTACT_CNT" onchange="javascript:select_cnt(this);">';

					for($i=0; $i <=5; $i++ ){
						if($row["CNT_"] == $i){
							$output.= '<option value="'.$i.'" selected>'.$i.'회</option>';
						}else{
							$output.= '<option value="'.$i.'">'.$i.'회</option>';
						}	
					}

				$output.= '</select>
				</td>
				<td>
				<select style="width:70px;height:35px;" id="bran_'.$row["ID"].'" name="branch" onchange="javascript:select_bran(this);">';

				$selected = "";

					for($i=0; $i <=12; $i++ ){
						
						if($row["BRANCH"] == $i){
							$selected = "selected";
						}else{
							$selected = "";
						}

						switch($i){
							case 0 : $output.= '<option value="0">선택</option>'; break;
							case 1 : $output.= '<option value="'.$i.'" '.$selected.'>강남</option>'; break;
							case 2 : $output.= '<option value="'.$i.'" '.$selected.'>용인</option>';break;
							case 3 : $output.= '<option value="'.$i.'" '.$selected.'>안양</option>';break;
							case 4 : $output.= '<option value="'.$i.'" '.$selected.'>수원</option>';break;
							case 5 : $output.= '<option value="'.$i.'" '.$selected.'>일산</option>';break;
							case 6 : $output.= '<option value="'.$i.'" '.$selected.'>부천</option>';break;
							case 7 : $output.= '<option value="'.$i.'" '.$selected.'>광주</option>';break;
							case 8 : $output.= '<option value="'.$i.'" '.$selected.'>분당</option>';break;
							case 9 : $output.= '<option value="'.$i.'" '.$selected.'>기흥</option>';break;
							case 10 : $output.= '<option value="'.$i.'" '.$selected.'>세무</option>';break;
							case 11 : $output.= '<option value="'.$i.'" '.$selected.'>회계</option>';break;
							case 12 : $output.= '<option value="'.$i.'" '.$selected.'>영업</option>';break;
						}
					}

				$output.= '</select>
				</td>
				<td>
				<select style="width:80px;height:35px;" id="stat_'.$row["ID"].'" name="stat" onchange="javascript:select_stat(this);">';

				$selected = "";

					for($i=0; $i <=12; $i++ ){
						
						if($row["STAT"] == $i){
							$selected = "selected";
						}else{
							$selected = "";
						}

						switch($i){
							case 0 : $output.= '<option value="0">선택</option>'; break;
							case 1 : $output.= '<option value="'.$i.'" '.$selected.'>수신부재</option>'; break;
							case 2 : $output.= '<option value="'.$i.'" '.$selected.'>수임확정</option>';break;
							case 3 : $output.= '<option value="'.$i.'" '.$selected.'>수임예상</option>';break;
							case 4 : $output.= '<option value="'.$i.'" '.$selected.'>수임곤란</option>';break;
							case 5 : $output.= '<option value="'.$i.'" '.$selected.'>수임불가</option>';break;
						}
					}

				$output.= '</select>
				</td>
				<td><DIV id="memo_lbl_'.$row["ID"].'" style="width:200px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.$row["MEMO"].'</DIV><input type="text" id="memo_ip_'.$row["ID"].'" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27) {memo_submit(this);}" value="'.$row["MEMO"].'" style="display:none;padding-top:10px;"></input></td>
				<td><button onclick="javascript:hide(\''.$row["ID"].'\');">X</button></td>
				</tr>

				';
				}//while end
			}
			else
			{
				$output .= '
				<tr>
				<td colspan="10" align="center">데이터가 없습니다.</td>
				</tr>
				';
			}

				echo $head.$output;

			}

		}

	}
}

// 종합소득세 신청 : 끝



//세무일정 등록 : 시작
if($_POST["action"]=="추가" && $_POST["url"]=="taxdate" )
{ //ajax로 넘긴 data를 받아준다.
	$tax_date=mysqli_real_escape_string($connect,$_POST["tax_date"]);
	$tax_content=mysqli_real_escape_string($connect,$_POST["tax_content"]);
	$visible=mysqli_real_escape_string($connect,$_POST["visible"]);
	
	//insert 프로시저 생성
	$procedure = "
	CREATE PROCEDURE insertDates(IN tax_date datetime,tax_content varchar(100), visible varchar(1) )
	BEGIN
		INSERT INTO SS_TAXDATE(TAXDATE,CONTENT,VISIBLE) VALUES(tax_date,tax_content,visible);
	END
	";

	//기존에 프로시저가 있으면 삭제
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertDates"))
	{ //위에서 만든 프로시저 실행
		if(mysqli_query($connect,$procedure))
		{
		$query = "CALL insertDates('".$tax_date ."','".$tax_content."','".$visible."')";
		//프로시저 호출
		mysqli_query($connect,$query);
		echo '성공적으로 입력 되었습니다.';
		}
	}
}
//세무일정 등록 : 끝

//세무일정 수정 : 시작
if($_POST["action"] == "수정" && $_POST["url"]=="taxdate")
{

	$tax_date=mysqli_real_escape_string($connect,$_POST["tax_date"]);
	$tax_content=mysqli_real_escape_string($connect,$_POST["tax_content"]);
	$visible=mysqli_real_escape_string($connect,$_POST["visible"]);

	$procedure = "
	CREATE PROCEDURE updateDates(IN user_id int(111), tax_date datetime,tax_content varchar(100), visible varchar(1) )
	BEGIN
		UPDATE SS_TAXDATE SET TAXDATE = tax_date, CONTENT = tax_content, VISIBLE = visible
		WHERE ID = user_id;
	END;
	";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS updateDates"))
	{
		if(mysqli_query($connect, $procedure))
		{
			$query = "CALL updateDates('".$_POST["id"]."','".$tax_date."','".$tax_content."','".$visible."')";
			mysqli_query($connect, $query);
			echo '수정 되었습니다.';
		}
	}
}
//세무일정 수정 : 끝

//세무일정 삭제 : 시작
if($_POST["action"] == "delete" && $_POST["url"]=="taxdate")
{
	$procedure = "
	CREATE PROCEDURE deleteDate(IN user_id int(100))
	BEGIN
	DELETE FROM SS_TAXDATE WHERE id = user_id;
	END;
	";

	if(mysqli_query($connect, "DROP PROCEDURE IF EXISTS deleteDate"))
	{
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL deleteDate('".$_POST["id"]."')";
			mysqli_query($connect, $query);
			echo '삭제완료';
		}
	}
}
//세무일정 삭제 : 끝

//세무일정 수정페이지 select : 시작
if($action == "select_view_date" && isset($_POST["id"]))
{

	$output = array();
	$procedure = "
		CREATE PROCEDURE whereUser(IN user_id int(100))
		BEGIN
		SELECT * FROM SS_TAXDATE WHERE id = user_id;
		END;
		";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereUser"))
	{
		if(mysqli_query($connect, $procedure))
		{
			$query = "CALL whereUser(".$_POST["id"].")";
			$result = mysqli_query($connect, $query);

			while($row = mysqli_fetch_array($result))
			{
				$output['TAXDATE'] = $row["TAXDATE"];
				$output['CONTENT'] = $row["CONTENT"];
				$output['VISIBLE'] = $row["VISIBLE"];			
			}

			echo json_encode($output);
		}
	}
}
//세무일정 수정페이지 select : 끝

// 세무일정 리스트: 시작
if($action == "select_date" ) 
{
	$lastid = $_POST["lastid"];
	$first = $_POST["first"];
	$footer="";

	$query_str4 = "";

	if($lastid != ""){
		$query_str4 = " AND ID < ".$lastid .' ' ;
	}

	$procedure = "
	CREATE PROCEDURE selectDate()
	BEGIN
	SELECT * FROM SS_TAXDATE WHERE 1=1 ".$query_str4." ORDER BY TAXDATE DESC limit 10;
	END;
	";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectDate"))
	{
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL selectDate()";
			$result = mysqli_query($connect,$query);
			$head .= '';

			if(mysqli_num_rows($result) >0)
			{

				while($row = mysqli_fetch_array($result)){
					$msg_id = $row["ID"];
					$output .= '
					<tr>
					<td>'.$row["TAXDATE"].'</td>
					<td>'.$row["CONTENT"].'</td>
					<td>'.$row["VISIBLE"].'</td>
					<td><button type="button" name="update" id="'.$row["ID"].'" class="update">수정</button></td>
					<td><button type="button" name="delete" id="'.$row["ID"].'" class="delete">삭제</button></td>
					</tr>
					';
				}
			}
			else
			{
				$output .= '
				<tr>
				<td colspan="5" align="center">데이터가 없습니다.</td>
				</tr>
				';
			}

			$footer .= '
			<tr>
			<td colspan="10" align="center" id="hidden_'.$msg_id.'"><div id="more'.$msg_id.'" class="morebox" style="font-weight:bold;
			color:#333333;
			text-align:center;
			border:solid 1px #333333;
			padding:8px;
			margin-top:8px;
			margin-bottom:8px;
			-moz-border-radius: 6px;
			-webkit-border-radius: 6px;">
			<a href="#" id='.$msg_id.' class="more">more</a>
			</div></td>
			</tr>
			';

			if($first=="Y"){
				echo $head.$output.$footer;
			}else{
				echo $output.$footer;
			}

		}

	} 

}//세무일정 리스트 끝


// 스마트A 업데이트 : 시작
if($action == "update_smartA"){ 

	$head = '';
	$output = '';
	$CNT = 0;
	$i=1;

	$p_id =  $_POST["id"];
	$p_pw =  $_POST["pw"];
	$p_branch =  $_POST["branch"];
	$p_useryn =  $_POST["useryn"];
	$p_userid =  $_POST["userid"];
	$p_username =  $_POST["username"];


	$procedure_upt = "
	CREATE PROCEDURE UPT_SMARTA(IN p_id INT, p_pw TEXT, p_branch INT , p_useryn CHAR(1), p_userid varchar(45) , p_username varchar(45) )
	BEGIN
		UPDATE SMARTA_MEMBER SET USER_PW = p_pw, BRANCH = p_branch, USE_YN = p_useryn , USER_ID = p_userid, USER_NAME = p_username 
		WHERE ID = p_id;
	END;
	";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_SMARTA"))
	{
		if(mysqli_query($connect,$procedure_upt))
		{
			$query_upt = "CALL UPT_SMARTA('".$p_id."','".$p_pw."','".$p_branch."','".$p_useryn."','".$p_userid."','".$p_username."')";
			mysqli_query($connect,$query_upt);
		}
	}

	mysqli_close($connect);
} 
// 스마트A 업데이트 : 끝


// 스마트A 리스트 : 시작
if($action == "select_smartA"){
	$head = '';
	$output = '';
	$CNT = 0;
	$i=1;

	$p_id =  $_POST["id"];
	$p_pw =  $_POST["pw"];
	$p_branch =  $_POST["branch"];
	$p_useryn =  $_POST["useryn"];

	$head .= '
		<colgroup>
		<col width="150px">
		<col width="150px">
		<col width="150px">
		<col width="300px">
		<col width="150px">
		<col width="150px">
		<col width="150px">
		<col width="100px">
		</colgroup>
		<thead>
		<tr>
			<th>서버</th>
			<th>넘버</th>
			<th>사용자명</th>
			<th>ID</th>
			<th>PW</th>
			<th>소속지점</th>
			<th>사용/미사용</th>
			<th>삭제</th>
		</tr>
		</thead>
		';
	
	for($i=1;$i<4;$i++ ){

		$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");

		$procedure = "
		CREATE PROCEDURE SELECT_SMARTA_SERVER".$i."()
		BEGIN
		SELECT *
		FROM SMARTA_MEMBER WHERE SERVER = ".$i."
		ORDER BY NUMBER
		;
		END;
		";
		//procedure1
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_SMARTA_SERVER".$i))
		{
			//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				
				$query = "CALL SELECT_SMARTA_SERVER".$i."()";
				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query);
				if(mysqli_num_rows($result) >0)
				{

					$CNT = 0;

					while($row = mysqli_fetch_array($result)){
						$onwer = "";
						if($row["OWNER_YN"]=="Y"){
							$onwer = "<b><span style='color:red;'>(관리자)</span><b>";
						}
						$output .= '
						<tr>
						<td>'.$row["SERVER"].'</td>
						<td>'.$row["NUMBER"].'</td>
						<td>
							<DIV id="lbl_username_'.$row["ID"].'" style="width:300px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this,\'username\')">'.$row["USER_NAME"].'</DIV><input type="text" id="username_'.$row["ID"].'" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27) {select_insert(this);}" value="'.$row["USER_NAME"].'" style="width:300px;height:25px;8px 10px 0px 68px; display:none;"></input>
							'.$onwer.'
						</td>
						<td>
							<DIV id="lbl_userid_'.$row["ID"].'" style="width:300px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this,\'userid\')">'.$row["USER_ID"].'</DIV><input type="text" id="userid_'.$row["ID"].'" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27) {select_insert(this);}" value="'.$row["USER_ID"].'" style="width:300px;height:25px;8px 10px 0px 68px; display:none;"></input>
						</td>
						<td>
							<DIV id="lbl_pw_'.$row["ID"].'" style="width:200px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this,\'pw\')">'.$row["USER_PW"].'</DIV><input type="text" id="ip_'.$row["ID"].'" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27) {select_insert(this);}" value="'.$row["USER_PW"].'" style="width:200px;height:25px;8px 10px 0px 68px; display:none;"></input>
						</td>
						<td>
							<select style="width:100px;height:35px;" id="bran_'.$row["ID"].'" name="branch" onchange="javascript:select_insert(this);">';

							$selected = "";

							for($i2=0; $i2 <=12; $i2++ ){
								
								if($row["BRANCH"] == $i2){
									$selected = "selected";
								}else{
									$selected = "";
								}

								switch($i2){
									case 0 : $output.= '<option value="0">선택</option>'; break;
										
									case 1 : $output.= '<option value="1" '.$selected.'>강남</option>'; break;

									case 2 : $output.= '<option value="2" '.$selected.'>용인</option>';break;
									
									case 3 : $output.= '<option value="3" '.$selected.'>안양</option>';break;
									
									case 4 : $output.= '<option value="4" '.$selected.'>수원</option>';break;
									
									case 5 : $output.= '<option value="5" '.$selected.'>일산</option>';break;
									
									case 6 : $output.= '<option value="6" '.$selected.'>부천</option>';break;
									
									case 7 : $output.= '<option value="7" '.$selected.'>광주</option>';break;
									
									case 8 : $output.= '<option value="8" '.$selected.'>분당</option>';break;
									
									case 9 : $output.= '<option value="9" '.$selected.'>기흥</option>';break;
												
									case 10 : $output.= '<option value="10" '.$selected.'>세무</option>';break;
									
									case 11 : $output.= '<option value="11" '.$selected.'>회계</option>';break;

									case 12 : $output.= '<option value="12" '.$selected.'>영업</option>';break;

								}
							}

							$output.= '</select>
						
						</td>
						<td>
						<select style="width:100px;height:35px;" id="useryn_'.$row["ID"].'" name="useryn" onchange="javascript:select_insert(this);">';

							$selected = "";
							$YN = "";

								for($j=0; $j <=2; $j++ ){
									
									switch($j){
										case 0 : $YN = "";
										break;
										case 1 : $YN = "Y";
										break;
										case 2 : $YN = "N";
										break;
									}


									if($row["USE_YN"] == $YN){
										$selected = "selected";
									}else{
										$selected = "";
									}

									switch($j){
										case 0 : $output.= '<option value="'.$row["USER_YN"].'">선택</option>'; break;
										case 1 : $output.= '<option value="Y" '.$selected.'>Y</option>';break;
										
										case 2 : $output.= '<option value="N" '.$selected.'>N</option>';break;

									}
								}

							$output.= '</select>
						</td>
						<td>
							<a href="javascript:del(\''.$row["ID"].'\');">삭제</a>
						</td>
						</tr>
						';
						$CNT++;
					}
					$output .= '
						<tr style="background-color:#E6E6E6">
						<td>서버'.$i.'소계</td>
						<td>'.$CNT.'</td>
						<td colspan=6></td>
						</tr>
					';	
				}
				else
				{
					$output .= '
					<tr>
					<td colspan="10" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}
			}
		} 
		mysqli_close($connect);		
	}
	echo $head.$output;
}
// 스마트A 리스트 : 끝

// 종소세 고객 상세 뷰(기본) : 시작
if($action == "select_view" && isset($_POST["id"])){
	
	//빈 배열을 만들고
	$output = array();

	//넘어온 id에 해당하는 row를 출력하는 프로시저 쿼리를 만든다.
	$procedure = "
		CREATE PROCEDURE whereUser(IN user_id int(100))
		BEGIN
			SELECT A.CSTID, A.CSTNAME, A.MOBILE, A.RESIDENT_ID,A.BRANCH, A.SECTOR, A.SECTOR_CODE, 
			B.CST_BIRTH, B.INFO_TYPE, B.ARS_CERT_NUM, B.DUTY_TYPE, B.EXP_RATIO , 
			D.INTEREST, D.ALLOCATION, D.WORK_SINGLE, D.WORK_PLUR, D.INFORMAL, D.ETC,
			E.EXI_TAX, FORMAT(E.NPIP,0) AS NPIP, E.PERSON_SAVE,E.SMALL_BIZ_DED, E.RET_SAVE, E.PEN_SAVE
			FROM TB100020 AS A 
			LEFT OUTER JOIN dbsschina.TB300010 AS B ON A.CSTID = B.CSTID
			LEFT OUTER JOIN dbsschina.TB300030 AS D ON A.CSTID = D.CSTID
			LEFT OUTER JOIN dbsschina.TB300031 AS E ON A.CSTID = E.CSTID
			WHERE A.CSTID = user_id;
		END;
		";
		//기존의 프로시저가 존재한다면 삭제 후
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereUser"))
		{
			//위에서 선언한 프로시저 선언(1)
			if(mysqli_query($connect, $procedure))
			{
			//프로시저 호출(2)
				$query = "CALL whereUser(".$_POST["id"].")";
				$result = mysqli_query($connect, $query);

				while($row = mysqli_fetch_array($result))
				{
					//위에서 만든 배열에 넣어준다.
					$output['CSTNAME'] = $row["CSTNAME"];
					$output['MOBILE'] = $row["MOBILE"];
					$output['RESIDENT_ID'] = $row["RESIDENT_ID"];
					$output['BRANCH'] = $row["BRANCH"];
					$output['SECTOR'] = $row["SECTOR"];
					$output['SECTOR_CODE'] = $row["SECTOR_CODE"];
					$output['CST_BIRTH'] = $row["CST_BIRTH"];
					$output['INFO_TYPE'] = $row["INFO_TYPE"];
					$output['ARS_CERT_NUM'] = $row["ARS_CERT_NUM"];
					$output['DUTY_TYPE'] = $row["DUTY_TYPE"];
					$output['EXP_RATIO'] = $row["EXP_RATIO"];
					$output['INTEREST'] = $row["INTEREST"];
					$output['ALLOCATION'] = $row["ALLOCATION"];
					$output['WORK_SINGLE'] = $row["WORK_SINGLE"];
					$output['WORK_PLUR'] = $row["WORK_PLUR"];
					$output['INFORMAL'] = $row["INFORMAL"];
					$output['ETC'] = $row["ETC"];
					$output['EXI_TAX'] = $row["EXI_TAX"];
					$output['NPIP'] = $row["NPIP"];
					$output['PERSON_SAVE'] = $row["PERSON_SAVE"];
					$output['SMALL_BIZ_DED'] = $row["SMALL_BIZ_DED"];
					$output['RET_SAVE'] = $row["RET_SAVE"];
					$output['PEN_SAVE'] = $row["PEN_SAVE"];

				}


				//json string 형식으로 변환 후 넘겨준다.
				echo json_encode($output);
			}
		}
}
// 종소세 고객 상세 뷰(기본) : 끝


// 종소세 고객 상세 뷰(확장) : 시작
if($action == "select_view_ext" && isset($_POST["id"])){
	
	if($_POST["flag"]=="TB300020"){
		
		$procedure = "
		CREATE PROCEDURE SELECT_TB300020(IN user_id int(100))
		BEGIN
			SELECT *,FORMAT(AMOUNT_PAID,0) AS AMOUNT_PAID_ ,
			(SELECT REPLACE( DUTY_TYPE ,'대상자','')FROM TB300010 WHERE CSTID = user_id) AS DUTY_TYPE_ 
			FROM TB300020 WHERE CSTID = user_id;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300020"))
		{
		//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB300020(".$_POST["id"].")";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);


				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";
					while($row = mysqli_fetch_array($result)){
						$output .= '
						<tr>
							<td>'.$row["BIZ_NUM"].'</td>
							<td>'.$row["COMPANY"].'</td>
							<td>'.$row["INCOME_TYPE"].'</td>
							<td>'.$row["SEC_CODE"].'</td>
							<td>'.$row["BIZ_FORM"].'</td>
							<td>'.$row["DUTY_TYPE_"].'</td>
							<td>'.$row["AMOUNT_PAID_"].'원</td>
							<td>'.$row["REF_RATIO_N"].'</td>
							<td>'.$row["REF_RATIO_S"].'</td>
							<td>'.$row["SIM_RATIO_N"].'</td>
							<td>'.$row["SIM_RATIO_S"].'</td>
						</tr>

						';
					}
				}
				else
				{
					$output .= '
					<tr>
					<td colspan="11" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

			}

		}
		echo $output;
	} // if($_POST["flag"]=="TB300020"){ ... END



	if($_POST["flag"]=="TB300040"){
	
		$procedure = "
		CREATE PROCEDURE SELECT_TB300040(IN user_id int(100))
		BEGIN
			SELECT (SELECT VALUE_ FROM TB750010 WHERE CODE_ = CODE ) AS CODE_,
			(SELECT VALUE FROM TB300040 WHERE CSTID = user_id AND  YEAR=YEAR(NOW())-2 AND CODE=A.CODE ) AS YEAR_1,
			(SELECT VALUE FROM TB300040 WHERE CSTID = user_id AND  YEAR=YEAR(NOW())-3 AND CODE=A.CODE ) AS YEAR_2,
			(SELECT VALUE FROM TB300040 WHERE CSTID = user_id AND  YEAR=YEAR(NOW())-4 AND CODE=A.CODE ) AS YEAR_3
			 FROM TB300040 AS A WHERE A.CSTID = user_id AND YEAR=YEAR(NOW())-2 ;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300040"))
		{
		//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB300040(".$_POST["id"].")";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);


				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";

					while($row = mysqli_fetch_array($result)){

						$output .= '
						<tr>
							<td>'.$row["CODE_"].'</td>
							<td>'.$row["YEAR_3"].'</td>
							<td>'.$row["YEAR_2"].'</td>
							<td>'.$row["YEAR_1"].'</td>
						</tr>

						';
					}
				}// 네번째 if문 끝
				else
				{
					$output .= '
					<tr>
					<td colspan="4" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

			}

		}
		echo $output;
	} // if($_POST["flag"]=="TB300040"){ ... END





	if($_POST["flag"]=="TB300050"){
	
		$procedure = "
		CREATE PROCEDURE SELECT_TB300050(IN user_id int(100))
		BEGIN
			SELECT (SELECT VALUE_ FROM TB750010 WHERE CODE_ = CODE ) AS CODE_,PRICE,COMP,AVG FROM TB300050 AS A WHERE A.CSTID = user_id ;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300050"))
		{
		//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB300050(".$_POST["id"].")";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);


				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";

					while($row = mysqli_fetch_array($result)){

						$output .= '
						<tr>
							<td>'.$row["CODE_"].'</td>
							<td>'.$row["PRICE"].'</td>
							<td>'.$row["COMP"].'</td>
							<td>'.$row["AVG"].'</td>
						</tr>

						';
					}
				}// 네번째 if문 끝
				else
				{
					$output .= '
					<tr>
					<td colspan="4" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

			}

		}
		echo $output;
	} // if($_POST["flag"]=="TB300050"){ ... END




	if($_POST["flag"]=="TB300060"){
	
		$procedure = "
		CREATE PROCEDURE SELECT_TB300060(IN user_id int(100))
		BEGIN
			SELECT 
			 '건수' AS GUBUN,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1111' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1111 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1112' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1112 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1113' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1113 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1114' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1114 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1115' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1115 ,
			 (SELECT `CASE` FROM TB300060 WHERE `CODE` = 'B1116' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1116 
			 FROM DUAL
			 UNION ALL 
			 SELECT 
			 '금액' AS GUBUN,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1111' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1111 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1112' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1112 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1113' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1113 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1114' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1114 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1115' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1115 ,
			 (SELECT `PAYMENT` FROM TB300060 WHERE `CODE` = 'B1116' AND CSTID = user_id AND YEAR=YEAR(NOW())-1 ) AS B1116 
			 FROM DUAL;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300060"))
		{
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB300060(".$_POST["id"].")";
				$result = mysqli_query($connect,$query1);
				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";
					while($row = mysqli_fetch_array($result)){

						$output .= '
						<tr>
							<td>'.$row["GUBUN"].'</td>
							<td>'.$row["B1111"].'</td>
							<td>'.$row["B1112"].'</td>
							<td>'.$row["B1113"].'</td>
							<td>'.$row["B1114"].'</td>
							<td>'.$row["B1115"].'</td>
							<td>'.$row["B1116"].'</td>
						</tr>
						';
					}
				}
				else
				{
					$output .= '
					<tr>
					<td colspan="7" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

			}

		}
		echo $output;
	}
} 
// 종소세 고객 상세 뷰(확장) : 끝


// 뉴스톡 수정시 조회 : 시작
if($action == "select_modify" && isset($_POST["id"])){
	
	$output = array();

	$procedure = "
		CREATE PROCEDURE whereUser(IN user_id int(100))
		BEGIN
		SELECT * FROM SS_NEWS WHERE id = user_id;
		END;
		";
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereUser"))
		{
			if(mysqli_query($connect, $procedure))
			{
				$query = "CALL whereUser(".$_POST["id"].")";
				$result = mysqli_query($connect, $query);

				while($row = mysqli_fetch_array($result))
				{
					$output['SUBJECT'] = $row["SUBJECT"];
					$output['NEWS_REGUSER'] = $row["NEWS_REGUSER"];
					$output['NEWS_REGDATE'] = $row["NEWS_REGDATE"];
					$output['NEWS_REGUSER_COMP'] = $row["NEWS_REGUSER_COMP"];
					$output['CONTENTS'] = $row["CONTENTS_"];
					$output['IMG_URL'] = $row["IMG_URL"];
					$output['IMG_URL_FLAG'] = $row["IMG_URL_FLAG"];
					$output['FILE_URL'] = $row["FILE_URL"];
					$output['CATE'] = $row["CATE"];
					$output['C_CATE'] = $row["C_CATE"];
					$output['VISIBLE'] = $row["VISIBLE"];
					$output['SITE_GUBUN'] = $row["SITE_GUBUN"];
				}
				echo json_encode($output);
			} 
		} 
}
// 뉴스톡 수정시 조회 : 끝

// 뉴스톡 리스트 : 시작
if($action == "select"){
	$head = '';
	$output = '';
	 
	$s_option = $_POST["s_option"];
	$g_option = $_POST["g_option"];
	$c_option = $_POST["c_option"];
	$s_str = $_POST["s_str"];
	$sort = $_POST["sort"];
	$flag = $_POST["flag"];
	$lastid = $_POST["lastid"];
	$first = $_POST["first"];
	$footer="";

	$query_str1 = " WHERE ";
	$query_str2 = "";
	$query_str3 = "";
	$query_str4 = "";
	$query_desc = "ORDER BY ID DESC";

	$page = $_POST["page"];

	$page_set = 12; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수


	$query = "SELECT count(ID) as total FROM SS_NEWS  WHERE VISIBLE='Y' ";

	$result = mysqli_query($connect,$query);


	$row = mysqli_fetch_array($result);

	$total = $row[total]; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치


	if($s_str !=""){
		switch($s_option){
			case "subject" : 
				$query_str1 .= " SUBJECT like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$query_str1 .= " NEWS_REGUSER like '%".$s_str."%' ";
				break;
			case "comp" : 
				$query_str1 .= " NEWS_REGUSER_COMP like '%".$s_str."%' ";
				break;
			case "contents" : 
				$query_str1 .= " CONTENTS_ like '%".$s_str."%' ";
				break;
			default:
				$query_str1 .=" 1 = 1 ";
			}	
	}else{
		$query_str1 .=" 1 = 1 ";
	}

	switch($g_option){
		case "ALL" : 
			$query_str2 .= " AND 2 = 2 ";
			break;
		case "HOS" : 
			$query_str2 .= " AND SITE_GUBUN = 'HOS' ";
			break;
		default:
			$query_str2 .= " ";
	}


	if($c_option != ""){
		$query_str3 = "	AND CATE = '".$c_option."' ";
	}

	if($sort != "" && $flag != ""){
		$query_desc = "ORDER BY ".$flag." ".$sort;
	}

	if($lastid != ""){
		$query_str4 = " AND ID < ".$lastid .' ' ;
	}



	$head .= '
		<colgroup>
		<col width="100px">
		<col width="350px">
		<col width="150px">
		<col width="200px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		</colgroup>
		<thead>
		<tr>
			<th><a href="javascript:sort(\'id\');">ID</a><span id=\'sort_id\' style="color:#337ab7;"></span></th>
			<th><a href="javascript:sort(\'subject\');">제목</a><span style="color:#337ab7;" id=\'sort_subject\'></span></th>
			<th><a href="javascript:sort(\'news_reguser\');">기사작성자</a><span style="color:#337ab7;" id=\'sort_news_reguser\'></span></th>
			<th><a href="javascript:sort(\'news_regdate\');">기사작성일</a><span  style="color:#337ab7;"id=\'sort_news_regdate\'></span></th>
			<th><a href="javascript:sort(\'news_reguser_comp\');">소속</a><span style="color:#337ab7;"id=\'sort_news_reguser_comp\'></span></th>
			<th><a href="javascript:sort(\'site_gubun\');">사이트</a><span style="color:#337ab7;"id=\'sort_site_gubun\'></span></th>
			<th><a href="javascript:sort(\'cate\');">카테고리</a><span style="color:#337ab7;"id=\'sort_cate\'></span></th>
			<th><a href="javascript:sort(\'visible\');">노출여부</a><span style="color:#337ab7;" id=\'sort_visible\'></span></th>
			<th>수정</th>
		</tr>
		</thead>
		';

	if(isset($_POST["action"]))
	{
		$procedure = "
		CREATE PROCEDURE selectNews()
		BEGIN
		SELECT * FROM SS_NEWS ".$query_str1.$query_str2.$query_str3.$query_str4.$query_desc."
		LIMIT $limit_idx, $page_set ;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectNews"))
		{
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL selectNews()";
				$result = mysqli_query($connect,$query);

				if(mysqli_num_rows($result) >0)
				{

					$cate_name="";

					while($row = mysqli_fetch_array($result)){


					$gubun = $row["SITE_GUBUN"];
					$cate_ = $row["CATE"];
					$msg_id = $row["ID"];

					switch($gubun){
						case "ALL" : $gubun_name = "전체"; break;
						case "HOS" : $gubun_name = "병원톡"; break;
						default : $gubun_name = ""; 
					}

					if($gubun == "ALL"){
						switch($cate_ ){
							case 'SCH' : $cate_name = "세무일정"; break;
							case 'LED' : $cate_name = "장부기장"; break;
							case 'VAT' : $cate_name = "부가세"; break;
							case 'CIT' : $cate_name = "종소세"; break;
							case 'TRA' : $cate_name = "양도세"; break;
							case 'INH' : $cate_name = "상속세"; break;
							case 'GTX' : $cate_name = "증여세"; break;
							case 'THA' : $cate_name = "절세극장"; break;
							case 'TAX' : $cate_name = "조세"; break;
							case 'LAB' : $cate_name = "노무";break;
							case 'FOU' : $cate_name = "창업";break;
							case 'OPE' : $cate_name = "경영";break;
							case 'MNY' : $cate_name = "자금";break;
							case 'PRO' : $cate_name = "홍보";break;
							case 'ISS' : $cate_name = "이슈";break;

							case 'LAW' : $cate_name = "법률";break;
							case 'OP2' : $cate_name = "운영";break;
							case 'EDU' : $cate_name = "교육";break;
							case 'HEA' : $cate_name = "건강";break;
							case 'CUL' : $cate_name = "문화";break;
							case 'FAQ' : $cate_name = "FAQ";break;
							case '19T' : $cate_name = "19禁세금";break;
							case 'QNA' : $cate_name = "상담사례";break;
							case 'HOM' : $cate_name = "주택임대";break;
							default : $cate_name = "";
						} 
					}else{
						switch($cate_ ){
							case 'SCH' : $cate_name = "세무일정"; break;
							case 'TRT' : $cate_name = "세무신고"; break;
							case 'TIV' : $cate_name = "세무조사"; break;
							case 'FOU' : $cate_name = "개원";break;
							case 'LAB' : $cate_name = "노무";break;
							case 'GTX' : $cate_name = "증여세"; break;
							case 'INH' : $cate_name = "상속세"; break;
							case 'TRA' : $cate_name = "양도세"; break;
							case 'QNA' : $cate_name = "상담사례";break;
							case 'THA' : $cate_name = "절세극장"; break;
							case '19T' : $cate_name = "19禁세금";break;

							default : $cate_name = "";
						} 
					} 

					$output .= '
					<tr>
					<td>'.$row["ID"].'</td>
					<td style="text-align:left;">&nbsp;&nbsp;<a href=\'/admin_newsview.php?id='.$row["ID"].'\' target=\'_blank\'>'.$row["SUBJECT"].'</a></td>
					<td>'.$row["NEWS_REGUSER"].'</td>
					<td>'.$row["NEWS_REGDATE"].'</td>
					<td>'.$row["NEWS_REGUSER_COMP"].'</td>
					<td>'.$gubun_name.'</td>
					<td>'.$cate_name.'</td>
					<td>'.$row["VISIBLE"].'</td>
					<td><button type="button" name="update" id="'.$row["ID"].'" class="update">수정</button></td>
					<!--td><button type="button" name="delete" id="'.$row["ID"].'" class="delete">삭제</button></td-->
					</tr>

					';
				} 
			} 	
		} 
		else
		{
			$output .= '
			<tr>
			<td colspan="10" align="center">데이터가 없습니다.</td>
			</tr>
			';
		} 
		echo $head.$output;
	} 
	}

} 
// 뉴스톡 리스트 : 끝

?>
