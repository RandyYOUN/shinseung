<?php
session_start();

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수

$action = $_POST["action"];
//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )


//dev : 시작
if($action == "dev"){
	
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
	$depid =  $_POST["depid"];
	$userid =  $_POST["userid"];
	$s_date1 =  $_POST["s_date1"];
	$s_date2 =  $_POST["s_date2"];
	
	$query_str1 = "";
	$page = $_POST["page"];
	$page_set = 100; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수
	$style_cnt = 0;

	if($depid == "D1016" && $userid !=""){
		$WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
	}

	if($g_option != "ALL"){
		$WHERE_STR .= " AND A.REG_BRANCH = '".$g_option."'  ";
	}else{
		$WHERE_STR .= " ";
	}

	
	if($_POST["s_option"] != ""){
		switch($s_option){
			case "cstname" : 
				$WHERE_STR .= " AND A.CSTNAME like '%".$s_str."%' ";
				break;
			case "owner" : 
				$WHERE_STR .= " AND I.USERNAME like '%".$s_str."%' ";
				break;
			case "progress" : 
				$WHERE_STR .= " AND PROGRESS like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$WHERE_STR .= " AND B.USERNAME like '%".$s_str."%' ";
				break;
			case "mobile" : 
				$WHERE_STR .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
				break;
			case "num" : 
				$WHERE_STR .= " AND A.ID = '".$s_str."' ";
				break;
			case "etc" : 
				$WHERE_STR .= " AND A.ETC LIKE '%".$s_str."%' ";
				break;
			case "deadline" : 
				$WHERE_STR .= " AND A.DEADLINE BETWEEN '".$s_date1."' AND '".$s_date2."' ";
				break;
			default:
				$WHERE_STR ="";
		}	
	}


	$query_cnt = "SELECT count(A.ID) as total FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON A.REGUSER = B.USERID
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			LEFT OUTER JOIN TB750010 AS J ON J.CODE_ = A.PRIO_NUM
			WHERE VISIBLE='Y' ".$WHERE_STR;

	$result_cnt = mysqli_query($connect,$query_cnt) or die(mysqli_error($connect));

	$row = mysqli_fetch_array($result_cnt);

	$total = $row['total']; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치

	$head .= '
			<colgroup>
				<col width="50px">
				<col width="100px">
				<col width="80px">
				<col width="160px">
				<col width="140px">
				<col width="70px">
				<col width="80px">
				<col width="70px">
				<col width="100px">
				<col width="80px">
				<col width="100px">
				<col width="100px">
				<col width="100px">
				<col width="50px">
				<col width="100px">

			</colgroup>
			<thead>
			<tr>
				<th>번호</th>
				<th>우선순위</th>
				<th>진행상태</th>
				<th>납세자명</th>
				<th>납세자연락처</th>
				<th>알림톡</th>
				<th>세목</th>
				<th>접수지점</th>
				<th>접수일</th>
				<th>담당세무사</th>
				<th>신고기한</th>
				<th>신고일</th>
				<th>수수료(원)</th>
				<th>납부</th>
				<th>비고</th>

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
				$query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
				break;
			case "num" : 
				$query_str1 .= " AND A.ID = '".$s_str."' ";
				break;
			case "etc" : 
				$query_str1 .= " AND A.ETC LIKE '%".$s_str."%' ";
				break;
			case "deadline" : 
				$query_str1 .= " AND A.DEADLINE BETWEEN '".$s_date1."' AND '".$s_date2."' ";
				break;
			default:
				$query_str1 ="";
		}	
	}

	if($_POST["g_option"] != "" && $_POST["g_option"] != "ALL"){
		$query_str1 .= " AND A.REG_BRANCH = '".$g_option."'";	
	}

	if($depid == "D1016" && $userid !=""){
		$query_str1 .= " AND A.REGUSER = '".$userid."'  ";
		$query_owner = "SELECT * FROM TB980010 WHERE USERID = '".$userid."';";
	}else{
		$query_owner = "SELECT * FROM TB980010 WHERE DEPID IN ('D1013','D1016');";		
	}


//	$query_owner = "SELECT * FROM TB980010 WHERE DEPID = 'D1013';";
	$result_owner = mysqli_query($connect,$query_owner) or die(mysqli_error($connect));
	$output_owner .= '
	';

	if(mysqli_num_rows($result_owner) >0)
	{
		while($row_owner = mysqli_fetch_array($result_owner)){
			$output_owner.= '<option value="'.$row_owner["USERID"].'">'.$row_owner["USERNAME"].'</option>';	
		}
	}
	$output_owner.= '</select>';


	$procedure = "
	CREATE PROCEDURE SELECT_TRANS()
	BEGIN
		SELECT A.*, B.USERNAME 'REGUSER_',C.VALUE_ 'REG_BRANCH',D.VALUE_ 'PROGRESS_' ,
			E.VALUE_ 'TAX_FLAG',F.VALUE_ 'TRANS_TARGET',G.VALUE_ 'PAY_FLAG_',H.VALUE_ 'DELIVERY_FLAG',DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
			 DATE_FORMAT(A.TRANS_DATE, '%y-%m-%d') 'TRANS_DATE_',
            DATE_FORMAT(A.ACQ_DATE, '%y-%m-%d') 'ACQ_DATE_',
            DATE_FORMAT(A.DEADLINE, '%y-%m-%d') 'DEADLINE_',
			DATE_FORMAT(A.REGDATE, '%y-%m-%d') 'REGDATE_',
            I.USERNAME 'OWNER_',
            format(PRICE+PRICE2,0) 'PRICE_',
            format(TRANS_PRICE,0) 'TRANS_PRICE_',
            format(ACQ_PRICE,0) 'ACQ_PRICE_',
            format(TOTAL_TAX,0) 'TOTAL_TAX_',
            J.VALUE_ 'PRIO_NUM_', 
			FX_MOBILE(A.MOBILE) 'MOBILE',
			DATE_FORMAT(A.REP_DATE, '%y-%m-%d') 'REP_DATE_',
			REPLACE(A.ETC,'\"','') 'ETC_'
			FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON B.USERID = A.REGUSER 
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			LEFT OUTER JOIN TB750010 AS J ON J.CODE_ = A.PRIO_NUM
			WHERE VISIBLE='Y' ".$query_str1." 
			ORDER BY A.REGDATE DESC, A.ID DESC 
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
			$icon_new = "";

			if(mysqli_num_rows($result) >0)
			{

				while($row = mysqli_fetch_array($result)){
					$prog = $row["PROGRESS"];
					$prio = $row["PRIO_NUM"];
					$pay = $row["PAY_FLAG"];
					$owner = $row["OWNER_USER"];
					$regdate = $row["REGDATE"];
					$taxflag = $row["TAX_FLAG"];
					$icon_new = "";
					$date1 = new DateTime("now");
					$date2 = new DateTime($regdate);
					$interval = date_diff($date1, $date2);
					$diff_h = $interval->format('%h');
					$diff_d = $interval->format('%d');

					if($diff_d < 1 && $diff_h < 24){
						$icon_new = "<img src='../resources/images/icons/new.gif' style='width:20px;height:20px;margin:-5px 0 0 3px;'>";
					}

					if($taxflag=="상담"){
						$taxflag_new = "font-weight:600;color:#205fb1;";
					}else{
						$taxflag_new = "";
					}


					if($style_cnt % 2 == 1 ){
						$style = 'style="background:#cbe1ec29;"';						
					}else{
						$style = '';
					}

					switch($prio){
						case "E7101" : $style2="white"; break;
						case "E7102" : $style2="#f0ee57"; break;
						case "E7103" : $style2="#fb9e24;color:white"; break;
						case "E7104" : $style2="#de2519;color:white"; break;
						case "E7105" : $style2="cornflowerblue;color:white"; break;
						default: $style2="white;color:black;"; break;
					}
					
					switch($pay){
						case "E3002" : 
							$style3 ="background-color:#de2519;color:white;";
						break;
						case "E3003" : 
							$style3 ="background-color:#fb9e24;color:white;";
						break;
						default:$style3 ="background-color:white;color:black;";
					}

					
					$style_cnt++;

					$output .= '
					<tr '.$style.' >
						<td style="text-align:center;padding:0px;">'.$row["ID"].'</td>
						<td style="text-align:center;padding:0px;">
							<select style="height:35px;background-color:'.$style2.';" id="prio_'.$row["ID"].'" name="prio_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
						
								$prio == "E7101" ? $output .= '<option value="E7101" style="background-color:white;color:black;" selected>보통</option>' : $output .= '<option style="background-color:white;color:black;"  value="E7101">보통</option>';
								$prio == "E7102" ? $output .= '<option value="E7102" selected style="background-color:#f0ee57;color:black;">중요</option>' : $output .='<option value="E7102" style="background-color:#f0ee57;color:black;">중요</option>';
								$prio == "E7103" ? $output .= '<option value="E7103" style="background-color:#fb9e24;color:white;" selected>긴급</option>' : $output .='<option  style="background-color:#fb9e24;color:white;" value="E7103">긴급</option>';
								$prio == "E7104" ? $output .= '<option style="background-color:#de2519;color:white;" value="E7104" selected>중요긴급</option>' : $output .='<option style="background-color:#de2519;color:white;" value="E7104">중요긴급</option>';
								$prio == "E7105" ? $output .= '<option style="background-color:cornflowerblue;color:white;" value="E7105" selected>우수사례</option>' : $output .='<option value="E7105" style="background-color:cornflowerblue;color:white;">우수사례</option>';
						$output .='</select>
						</td>
						<td >
							<select style="height:35px;" id="prog_'.$row["ID"].'" name="prog_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
						
								$prog == "E5001" ? $output .= '<option value="E5001" selected>접수</option>' : $output .= '<option value="E5001">접수</option>';
								$prog == "E5002" ? $output .= '<option value="E5002" selected>1차검토</option>' : $output .='<option value="E5002">1차검토</option>';
								$prog == "E5003" ? $output .= '<option value="E5003" selected>2차검토</option>' : $output .='<option value="E5003">2차검토</option>';
								$prog == "E5004" ? $output .= '<option value="E5004" selected>3차검토</option>' : $output .='<option value="E5004">3차검토</option>';
								$prog == "E5005" ? $output .= '<option value="E5005" selected>계약해지</option>' : $output .='<option value="E5005">계약해지</option>';
								$prog == "E5006" ? $output .= '<option value="E5006" selected>결제완료</option>' : $output .='<option value="E5006">결제완료</option>';
								$prog == "E5007" ? $output .= '<option value="E5007" selected>최종완료</option>' : $output .='<option value="E5007">최종완료</option>';

						$output .='</select>
						</td>
						<td style="padding:10px;"><span data-tooltip-text="'.$row["CSTNAME"].'" ><a style="'.$taxflag_new.'" href="javascript:go_view('.$row["ID"].');"><b> '.mb_strimwidth($row['CSTNAME'],'0','12','...','utf-8').'</b></a></span>'.$icon_new.'</td>
						<td>'.$row["MOBILE"].'</td>
						<td><a href="javascript:send_kakao('.$row["BIZ_ID"].');">발송</a></td>
						<td style="text-align:center;padding:0px;'.$taxflag_new.'">'.$row["TAX_FLAG"].'</td>
						
						<td style="text-align:center;padding:0px;">'.$row["REG_BRANCH"].'</td>
						
						<td>'.$row["REGDATE_"].'</td>
						<td style="text-align:center;padding:0px;">
						<select id="select_owner_'.$row["ID"].'" name="select_owner_'.$row["ID"].'" onchange="javascript:modify_owner(this);">
							<option value=""></option>
							'.$output_owner.'
							<script>javascript:sel_owner("'.$row["ID"].'","'.$row["OWNER_USER"].'");</script>
						</td>
						
						<td>'.$row["DEADLINE_"].'</td>
						<td>'.$row["REP_DATE_"].'</td>
						
						<td style="text-align:right;">'.$row["PRICE_"].'</td>
						<td style="padding:0px;">
							<select style="height:35px;text-align-last:right; '.$style3.' " id="pay_'.$row["ID"].'" name="pay_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
						
								$pay == "E3001" ? $output .= '<option value="E3001" selected>완납</option>' : $output .= '<option value="E3001">완납</option>';
								$pay == "E3002" ? $output .= '<option value="E3002" selected>미납</option>' : $output .='<option value="E3002">미납</option>';
								$pay == "E3003" ? $output .= '<option value="E3003" selected>일부납부</option>' : $output .='<option value="E3003">일부납부</option>';

						$output .='</select>
						
						</td>
						<td><DIV id="memo_lbl_'.$row["ID"].'" style="width:280px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.mb_strimwidth($row['ETC_'],'0','40','...','utf-8').'</DIV><input style="width:280px; height:25px;display:none;" type="text" id="memo_ip_'.$row["ID"].'" value="'.$row['ETC_'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)memo_submit(this);" ></input></td>
						
					</tr>
					';
				}
			}
			else
			{
				$output .= '
				<tr>
				<td colspan="14" style="text-align:center;">데이터가 없습니다.</td>
				</tr>
				
				';
			}

			echo $head.$output;

		}

	} 
	
}
//dev



if($action == "select_disc_list"){
    
    $head .= '
			<colgroup>
				<col width="100px">
				<col width="200px">
				<col width="100px">
				
        
			</colgroup>
			<thead>
			<tr>
				<th>번호</th>
				<th>이름</th>
				<th>등록일</th>
				
			</tr>
			</thead>
			';
    $procedure = "
	CREATE PROCEDURE SELECT_DISC_LIST()
	BEGIN
		SELECT *
        FROM TB980099 ORDER BY ID DESC;
	END;
	";
    
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_DISC_LIST"))
    {
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL SELECT_DISC_LIST()";
            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
            
            if(mysqli_num_rows($result) >0)
            {
                
                while($row = mysqli_fetch_array($result)){
                    
                    $output .= '
					<tr style="text-align:center; padding:20px 20px 10px 20px;">
                        <td >'.$row["ID"].'</td>
                        <td ><a href="view_disc.php?id='.$row["ID"].'">'.$row["USERNAME"].'</td>
                        <td >'.$row["REGDATE"].'</td>
					</tr>
					';
                }
            }
            else
            {
                $output .= '
				<tr>
				<td colspan="3" style="text-align:center;">데이터가 없습니다.</td>
				</tr>
                    
				';
            }
            
            echo $head.$output;
            
        }
        
    }
    
}



if($action == "select_comp_layer"){
    
    
    $procedure = "
	CREATE PROCEDURE SELECT_COMP_LIST( IN P_CSTID INT(11) )
	BEGIN
		SELECT ID, COMPANY, BIZ_NUM, BIZ_FORM, BIZ_CATE
FROM dbsschina.TB100030 WHERE CSTID = P_CSTID ORDER BY BIZ_REGDATE DESC;
	END;
	";
    
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_COMP_LIST"))
    {
        if(mysqli_query($connect,$procedure))
        {
            $query = "CALL SELECT_COMP_LIST(".$_POST["id"].")";
            $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
            
            if(mysqli_num_rows($result) >0)
            {
                
                while($row = mysqli_fetch_array($result)){
                    
                    $output .= '
					<tr style="text-align:center; padding:20px 20px 10px 20px;">
                        <td >'.$row["ID"].'</td>
                        <td >'.$row["COMPANY"].'</td>
						<td >'.$row["BIZ_NUM"].'</td>
						<td >'.$row["BIZ_FORM"].'</td>
                        <td >'.$row["BIZ_CATE"].'</td>
                        <td ><a href="javascript:input_biz('.$row["ID"].',\''.$row["COMPANY"].'\');">선택</a></td>
					</tr>
					';
                }
            }
            else
            {
                $output .= '
				<tr>
				<td colspan="6" style="text-align:center;">데이터가 없습니다.</td>
				</tr>
                    
				';
            }
            
            echo $output;
            
        }
        
    }

}



// 기존고객 여부 체크 select : 시작
if($action == "select_cst_review"){
    
    $output = array();
    
    
    $procedure = "
		CREATE PROCEDURE SELECT_CST_REVIEW(IN P_CSTNAME VARCHAR(45), P_MOBILE VARCHAR(45) )
		BEGIN
            SELECT * FROM SS_REVIEW WHERE REV_NAME = P_CSTNAME AND REV_HP=REPLACE(P_MOBILE,'-','') ;
		END;
		";
    
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CST_REVIEW"))
    {
        //mysqli_query:DB에 쿼리 전송
        if(mysqli_query($connect,$procedure))
        {
            $query1 = "CALL SELECT_CST_REVIEW('".$_POST["cstname"]."','".$_POST["mobile"]."')";
            $result = mysqli_query($connect,$query1);
            ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
            
            while($row = mysqli_fetch_array($result)){
                $output['REV_CONTENT'] = $row["REV_CONTENT"];
                $output['REV_SCORE'] = $row["REV_SCORE"];
                $output['REV_REGDATE'] = $row["REV_REGDATE"];
            }
            
            echo json_encode($output);
            
        }
        
    }
    
}
// 기존고객 여부 체크 select : 끝



// 기존고객 여부 체크 select : 시작
if($action == "check_cust"){
    
    $output = array();
    
    
    $procedure = "
		CREATE PROCEDURE SELECT_CUST(IN P_CSTNAME VARCHAR(45), P_MOBILE VARCHAR(45) )
		BEGIN
        
            SELECT CSTID FROM TB100020
            WHERE CSTNAME = P_CSTNAME AND REPLACE(MOBILE,'-','') = REPLACE(P_MOBILE,'-','');
        
		END;
		";
    
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CUST"))
    {
        //mysqli_query:DB에 쿼리 전송
        if(mysqli_query($connect,$procedure))
        {
            $query1 = "CALL SELECT_CUST('".$_POST["cstname"]."','".$_POST["mobile"]."')";
            $result = mysqli_query($connect,$query1);
            ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
            
            while($row = mysqli_fetch_array($result)){
                $output['CSTID'] = $row["CSTID"];
            }
            
            echo json_encode($output);
            
        }
        
    }
    
}
// 기존고객 여부 체크 select : 끝


// 종소세 고객 수정클릭시 select
if($action == "select_inc_cst"){
    
    $output = array();
    
        
        $procedure = "
		CREATE PROCEDURE SELECT_TB100020_SIMPLE(IN P_ID int(11))
		BEGIN
            
            SELECT A.HomeTaxID, A.HomeTaxPW, B.REG_BRANCH,A.RESIDENT_ID, A.CSTNAME,
            C.DOUZONE_SVR, C.DOUZONE_CODE, A.REF_BANK, A.REF_ACC, A.MOBILE,B.EST_FEE_SELF,
            #CAL_FEE_CHANGE_DATE(A.CSTID) AS 'CAL_EST_FEE_FN',
            B.DEC_REGUSER, B.SMARTA_REG_SERVER, IFNULL(B.ACC_TAX,0) AS ACC_TAX,
            A.ACC_HOLDER, B.DEL_TYPE_PAYMENT, A.EMAIL, B.DEP_FEE
             FROM TB100020 AS A 
            LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
            LEFT OUTER JOIN TB100030 AS C ON A.CSTID = C.CSTID
            WHERE A.CSTID = P_ID;

		END;
		";
        
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100020_SIMPLE"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_TB100020_SIMPLE('".$_POST["id"]."')";
                $result = mysqli_query($connect,$query1);
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                
                while($row = mysqli_fetch_array($result)){
                    $output['CSTNAME'] = $row["CSTNAME"];
                    $output['MOBILE'] = $row["MOBILE"];
                    $output['HomeTaxID'] = $row["HomeTaxID"];
                    $output['HomeTaxPW'] = $row["HomeTaxPW"];
                    $output['REG_BRANCH'] = $row["REG_BRANCH"];
                    $output['RESIDENT_ID'] = $row["RESIDENT_ID"];
                    $output['DOUZONE_SVR'] = $row["DOUZONE_SVR"];
                    $output['DOUZONE_CODE'] = $row["DOUZONE_CODE"];
                    $output['REF_BANK'] = $row["REF_BANK"];
                    $output['REF_ACC'] = $row["REF_ACC"];
                    $output['EST_FEE_SELF'] = $row["EST_FEE_SELF"];
                    $output['DEC_REGUSER'] = $row["DEC_REGUSER"];
                    $output['SMARTA_REG_SERVER'] = $row["SMARTA_REG_SERVER"];
                    $output['ACC_TAX'] = $row["ACC_TAX"];
                    $output['ACC_HOLDER'] = $row["ACC_HOLDER"];
                    $output['DEL_TYPE_PAYMENT'] = $row["DEL_TYPE_PAYMENT"];
                    $output['EMAIL'] = $row["EMAIL"];
                    $output['DEP_FEE'] = $row["DEP_FEE"];
                    
                }
                
                echo json_encode($output);
                
            }
            
        }
    
}
// 종소세 고객 수정클릭시 select : 끝


/*종합소득세 리스트 select*/
if($action == "select_list_cust"){
    
    //ajax로 넘긴 데이터 값은 "select"
    //값이 존재하면 true를 리턴
    $cst_type = $_POST["cst_type"];
    $g_option = $_POST["g_option"];
    $b_option = $_POST["b_option"];
    $s_str = $_POST["s_str"];
    $footer="";
    
    $query_str1 = "";
    $query_str2 = "";
    $query_desc = " ORDER BY A.CSTID DESC";
    
    $page = $_POST["page"];
    
    $page_set = 12; // 한페이지 줄수
    $block_set = 5; // 한페이지 블럭수
    
    
    if($s_str !=""){
        switch($g_option){
            case "NUM" :
                $query_str1 .= " AND NUMBERING like '%".$s_str."%' ";
                break;
            case "NAME" :
                $query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
                break;
            case "MOBILE" :
                $query_str1 .= " AND RETURN_STR(MOBILE) like '%".$s_str."%' ";
                break;
            case "RESI" :
                $query_str1 .= " AND RESIDENT_ID like '%".$s_str."%' ";
                break;
            default:
                $query_str1 .="";
        }
    }
    
    
    if($b_option != ""){
        $query_str2 .= " AND BRANCH = '".$b_option."' ";
    }
    
    
    
    $query = "SELECT count(1) as total FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	LEFT OUTER JOIN TB300031 AS E ON A.CSTID=E.CSTID
 WHERE 1 = 1 ".$query_str1.$query_str2;
    
    $result = mysqli_query($connect,$query);
    
    if($result)
    {
        $total = $row["total"]; // 전체글수
    }
    $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
    $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
    
    if (!$page) $page = 1; // 현재페이지(넘어온값)
    $block = ceil ($page / $block_set); // 현재블럭(올림함수)
    $limit_idx = ($page - 1) * $page_set; // limit시작위치
    
    
    /*담당자설정*/
    $query_owner = "SELECT * FROM TB980010 WHERE DEC_ID = 'D2200';";
    $result_owner = mysqli_query($connect,$query_owner) or die(mysqli_error($connect));
    $output_owner .= '
	';
    
    if(mysqli_num_rows($result_owner) >0)
    {
        while($row_owner = mysqli_fetch_array($result_owner)){
            $output_owner.= '<option value="'.$row_owner["USERID"].'">'.$row_owner["USERNAME"].'</option>';
        }
    }
    $output_owner.= '</select>';
    /*담당자설정*/
    
    if($cst_type == "A1001"){
        
        $head .= '
		<colgroup>
		<col width="50px">
		<col width="80px">
		<col width="130px">
		<col width="115px">
		<col width="70px">
		<col width="80px">
		<col width="80px">
		<col width="80px">
		<col width="70px">
		<col width="85px">
				<col width="85px">
		<col width="70px">
		<col width="70px">
		<col width="70px">
		<col width="80px">
		<col width="50px">
		<col width="200px">
            
		</colgroup>
		<thead>
		<tr>
			<th>No.</th>
			<th>이름</th>
			<th>주민등록번호</th>
			<th>핸드폰</th>
			<th>접수지점</th>
			<th>접수일</th>
			<th>예상수수료</th>
			<th>입금확인</th>
			<th>수임동의</th>
			<th>홈택스서류</th>
			<th>사용자서류</th>
			<th>신고서<BR>담당자</th>
			<th>서버</th>
			<th>코드</th>
			<th>신고일</th>
			<th>결제</th>
			<th>비고</th>
		</tr>
		</thead>
		';
        
    }else if($cst_type=='A1002'){
        
        $head .= '
		<colgroup>
            
		<col width="50px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="80px">
		<col width="60px">
		<col width="80px">
		<col width="80px">
		<col width="300px">
            
		</colgroup>
		<thead>
		  <tr>
			<th rowspan="2">no</th>
			<th rowspan="2">접수일</th>
			<th colspan="2">기본정보</th>
			<th colspan="3">수수료</th>
			<th colspan="2">홈택스 수임</th>
			<th colspan="2">자료</th>
			<th>회사</th>
			<th colspan="3">전자신고</th>
			<th>납부서</th>
			<th rowspan="2">메모</th>
		  </tr>
		  <tr>
			<td style="border:1px solid #e3e3e3;">상호</td>
			<td>이름</td>
			<td>수수료</td>
			<td>입금금액</td>
			<td>영수증</td>
			<td>요청</td>
			<td>여부</td>
			<td>추출</td>
			<td>첨부</td>
			<td>등록</td>
			<td>신고담당</td>
			<td>요청</td>
			<td>완료</td>
			<td>전송완료</td>
		  </tr>
		</thead>
		';
        
    }else{
        
        $head .= '
		<colgroup>
		<col width="50px">
		<col width="80px">
		<col width="130px">
		<col width="135px">
        <col width="130px">
<col width="70px">
		<col width="270px">
		</colgroup>
		<thead>
		<tr>
			<th>No.</th>
			<th>이름</th>
			<th>주민등록번호</th>
			<th>핸드폰</th>
            <th>등록일</th>
			<th></th>
            <th>비고</th>     
		</tr>
		</thead>
		';
        
    }
    
    
    if(isset($_POST["action"]))
    {
        
        if($cst_type=='A1001' || $cst_type=='A1002'){
            $procedure = "
        	CREATE PROCEDURE SELECT_TB100020_CUST()
        	BEGIN
        	SELECT  A.CSTID AS 'ID', 	DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',	A.CSTNAME,	A.MOBILE,
        	B.COMP_NAME,	B.EXP_PAY_TAX,    B.EST_FEE,	FORMAT(B.EST_FEE,0) AS EST_FEE_ ,	FORMAT(B.DEP_FEE,0) AS DEP_FEE,
        	B.DEP_TYPE,	B.ACC_FLAG,	B.DEADLINE_DATE,	DATE_FORMAT(B.DEADLINE_DATE, '%y-%m-%d') 'DEADLINE_DATE_',
        	B.PAY_TAX,	B.NUM_E_REPORT,	B.REPORT_NUM_INCOME,	B.REPORT_NUM_WETAX,	B.DEL_DATE_PAYMENT,
        	DATE_FORMAT(B.DEL_DATE_PAYMENT, '%y-%m-%d') 'DEL_DATE_PAYMENT_',	B.DEL_TYPE_PAYMENT,
        	B.DEC_REGUSER,	B.MEMO,	B.OVER_FLAG,	B.CST_TYPE,	B.TAX_TYPE,	B.INF_CHANNEL,	B.INF_PATH,	B.INF_GEAR,
        	B.KEYWORD,	B.REG_BRANCH,	B.ACC_PATH,	B.REC_PERSON,	B.REGUSER,	B.SALES_REP,	A.KAKAO_REG,
        	C.DIS_DATE,	C.DIS_REASON,	A.HomeTaxID,	A.HomeTaxPW,    B.SUBM_DATE,    DATE_FORMAT(B.SUBM_DATE, '%y-%m-%d') 'SUBM_DATE_',
            B.SUBM_DATE2,    DATE_FORMAT(B.SUBM_DATE2, '%y-%m-%d') 'SUBM_DATE2_',	C.DOUZONE_SVR,
        	C.DOUZONE_CODE,	A.CSTNAME,	A.RESIDENT_ID,	C.BIZ_NUM,	C.BIZ_FORM,	C.BIZ_CATE,	A.SECTOR_CODE,
        	C.OPENING_DAY,	DATE_FORMAT(C.OPENING_DAY, '%y-%m-%d') 'OPENING_DAY_',	C.CLOSE_DAY,
        	DATE_FORMAT(C.CLOSE_DAY, '%y-%m-%d') 'CLOSE_DAY_',	C.COMP_PHONE,	C.ADDRESS_LEGAL,
        	A.EMAIL,	SELECT_CODE_VALUE_YEAR(A.CSTID,2) AS 'YEAR-1',	SELECT_CODE_VALUE_YEAR(A.CSTID,3) AS 'YEAR-2',
        	SELECT_CODE_VALUE_YEAR(A.CSTID,4) AS 'YEAR-3',    E.EXI_TAX,	B.INCOME_TAX,	B.JIBANG_TAX,
        	B.VAT_TAX,	B.CASH_REC,	A.REF_BANK,	A.REF_ACC,	A.ACC_HOLDER,	B.REC_PERSON_PHONE,
            D.USERNAME AS 'DEC_REGUSER_',    B.ACC_CHECK,    B.CONFIRM_YN,    B.SUBM
        	FROM TB100020 AS A
        	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
        	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
        	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
        	LEFT OUTER JOIN TB300031 AS E ON A.CSTID=E.CSTID                        
        	WHERE 1 = 1 ".$query_str1.$query_str2.$query_desc.
        	" LIMIT $limit_idx, $page_set
        	;
        	END;
        	";
        }else{
            $procedure = "
        	CREATE PROCEDURE SELECT_TB100020_CUST()
        	BEGIN
        	SELECT  CSTID, CSTNAME, MOBILE, EMAIL,RESIDENT_ID, DATE_FORMAT(REGDATE, '%y-%m-%d') 'REGDATE_'
        	FROM TB100020
        	WHERE 1 = 1 ".$query_str1.$query_str2." ORDER BY CSTID DESC ".
        	" LIMIT $limit_idx, $page_set
        	;
        	END;
        	";    
        }
        //users테이블 조회 프로시져를 만든다.
          
        
        
        
        //기존에 프로시져가 존재한다면 지운다.
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100020_CUST"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_TB100020_CUST()";
                
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                $result = mysqli_query($connect,$query1);
                
                
                if($result)
                {
                    
                    $cate_name="";
                    $path = "../tax_income/upload/";
                    
                    while($row = mysqli_fetch_array($result)){
                        
                        if($cst_type == "A1001"){
                            $bran = $row["REG_BRANCH"];
                            $dz_svr = $row["DOUZONE_SVR"];
                            $subm_yn =$row["SUBM"] ;
                            
                            
                            switch($subm_yn){
                                case "Y" : $subm ="<div style='width:50px;background:#3f863f;color:white;'>수임완료</div>"; break;
                                case "N" : $subm ="<div style='width:50px;background:#395adc;color:white;'>미동의</div>";break;
                                case "E" : $subm ="<div style='width:50px;background:#dc3939;color:white;'>에러</div>";break;
                                case "A" : $subm ="<div style='width:50px;background:#dcd139;'>진행중</div>";break;
                                default: $subm ="<a href='javascript:upt_subm(".$row['ID'].");'>요청</a>";
                            }
                            
                            if($row["CONFIRM_YN"] == 'Y'){
                                $confrim_yn ="<div style='width:50px;background:#3f863f;color:white;'>결제완료</div>";
                            }else{
                                $confrim_yn ="<a href='javascript:upt_confirm('".$row['ID']."');'>결제</a>";
                            }
                            
                            
                            if($style_cnt % 2 == 1 ){
                                $style = 'style="background:#b3dac31c;"';
                            }else{
                                $style = '';
                            }
                            $style_cnt++;
                            
                            if($row["ACC_CHECK"] == "Y"){
                                $acc_ck_style = "<div style='width:50px;background:#3f863f;color:white;'>확인완료</div>";
                            }else{
                                $acc_ck_style = "<div style='width:50px;background:#d81b1b;color:white;'>
                                <a style='color:white;' href='javascript:acc_check(".$row["ID"].", \"".$row["CSTNAME"]."\", \"".$row["EST_FEE"]."\"    );'>미확인</a></div>";
                            }
                            
                            $dir = $path.$row["CSTNAME"]."_".$row["MOBILE"]."/";
                            //$dir_ = iconv("UTF-8","CP949",$dir);
                            $LINK = '';
                            
                            if (is_dir($dir)){
                                $LINK = '<a href="javascript:file_pop(\''.$row["ID"].'\')">링크</a>';
                            }
                            
                            
                            $output .= '
							<tr '.$style.'>
							<td>'.$row["ID"].'</td>
							<td>
                                    <a href="view_all_cst.php?id='.$row["ID"].'">'.$row["CSTNAME"].'</a>
                                    <a href="javascript:fn_mod('.$row["ID"].');">수정</a>
                            </td>
							<td>'.$row["RESIDENT_ID"].'</td>
							<td>'.$row["MOBILE"].'</td>
							<td>
							<select style="height:35px;" id="bran_'.$row["ID"].'" name="bran_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $bran == "" ? $output .= '<option value="" selected>선택</option>' : $output .='<option value="">선택</option>';
                            $bran == "D1019" ? $output .= '<option value="D1019" selected>세무톡</option>' : $output .='<option value="D1019">세무톡</option>';
                            $bran == "D1003" ? $output .= '<option value="D1003" selected>강남</option>' : $output .= '<option value="D1003">강남</option>';
                            $bran == "D1004" ? $output .= '<option value="D1004" selected>용인</option>' : $output .='<option value="D1004">용인</option>';
                            $bran == "D1006" ? $output .= '<option value="D1006" selected>안양</option>' : $output .='<option value="D1006">안양</option>';
                            $bran == "D1007" ? $output .= '<option value="D1007" selected>수원</option>' : $output .='<option value="D1007">수원</option>';
                            $bran == "D1008" ? $output .= '<option value="D1008" selected>일산</option>' : $output .='<option value="D1008">일산</option>';
                            $bran == "D1009" ? $output .= '<option value="D1009" selected>부천</option>' : $output .='<option value="D1009">부천</option>';
                            $bran == "D1010" ? $output .= '<option value="D1010" selected>광주</option>' : $output .='<option value="D1010">광주</option>';
                            $bran == "D1011" ? $output .= '<option value="D1011" selected>분당</option>' : $output .='<option value="D1011">분당</option>';
                            $bran == "D1012" ? $output .= '<option value="D1012" selected>기흥</option>' : $output .='<option value="D1012">기흥</option>';
                            $bran == "D1013" ? $output .= '<option value="D1013" selected>세무</option>' : $output .='<option value="D1013">세무</option>';
                            
                            
                            $output .='</select>
							</td>
							<td>'.$row["REGDATE_"].'</td>
							<td>'.$row["EST_FEE_"].'</td>
							<TD>'.$acc_ck_style.'</TD>
							<TD>'.$subm.'</TD>
							<TD>'.$LINK.'</TD>
							<TD>'.$LINK.'</TD>
							<td>
								<select id="select_decuser_'.$row["ID"].'" name="select_decuser_'.$row["ID"].'" onchange="javascript:modify_owner(this);">
								<option value=""></option>
								'.$output_owner.'
								<script>javascript:sel_owner("'.$row["ID"].'","'.$row["DEC_REGUSER"].'");</script>
							</td>
							<td>
								<select style="height:35px;" id="dz_svr_'.$row["ID"].'" name="dz_svr_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $dz_svr == "" ? $output .= '<option value="" selected>선택</option>' : $output .='<option value="">선택</option>';
                            $dz_svr == "1" ? $output .= '<option value="1" selected>1</option>' : $output .='<option value="1">1</option>';
                            $dz_svr == "2" ? $output .= '<option value="2" selected>2</option>' : $output .='<option value="2">2</option>';
                            $dz_svr == "3" ? $output .= '<option value="3" selected>3</option>' : $output .='<option value="3">3</option>';
                            $output .='</select>
							</td>
							<td>
								<DIV id="dzcode_lbl_'.$row["ID"].'" style="width:50px;height:25px;padding-top:8px;" onclick="javascript:switch_dzcode(this)">'.mb_strimwidth($row['DOUZONE_CODE'],'0','40','...','utf-8').'</DIV><input style="width:50px; height:25px;display:none;" type="text" id="dzcode_ip_'.$row["ID"].'" value="'.$row['DOUZONE_CODE'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)dzcode_submit(this);"  maxlength=4></input>
							</td>
							<td>'.$row["DEADLINE_DATE_"].'</td>
							<td>'.$confrim_yn.'</td>
							<td>
								<DIV id="memo_lbl_'.$row["ID"].'" style="width:280px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.mb_strimwidth($row['MEMO'],'0','40','...','utf-8').'</DIV><input style="width:280px; height:25px;display:none;" type="text" id="memo_ip_'.$row["ID"].'" value="'.$row['MEMO'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)memo_submit(this);" ></input>
							</td>
							</tr>';
                        }else if($cst_type=='A1002'){
                            /*부가세영역*/
                            $output .= '
							<tr>
							<td>'.$row["ID"].'</td>
							<td>'.$row["REGDATE_"].'</td>
							<td><a href="view_vat_cst.php?id='.$row["ID"].'">'.$row["COMP_NAME"].'</a></td>
							<td><a href="view_vat_cst.php?id='.$row["ID"].'">'.$row["CSTNAME"].'</a></td>
							<td>'.$row["EST_FEE"].'</td>
							<td>'.$row["DEP_FEE"].'</td>
							<td>'.$row["CASH_REC"].'</td>
							<td>'.$row["SUBM_DATE_"].'</td>
							<td>'.$row["SUBM_DATE2_"].'</td>
							<td>'.$row["EXT_DATE"].'</td>
							<td>'.$row["ATTACH_FILE"].'</td>
							<td>'.$row["CompRegCheck"].'</td>
							<td>'.$row["DEC_REGUSER"].'</td>
							<td>'.$row["REQ_E_REPORT"].'</td>
							<td>'.$row["COMP_DATE_"].'</td>
							<td>'.$row["DEL_DATE_PAYMENT_"].'</span></td>
							<td>'.$row["MEMO"].'</td>
							</tr>';
                        }else{
                            $output .= '
							<tr>
							<td>'.$row["CSTID"].'</td>
							<td><a href="view_all_cst.php?id='.$row["CSTID"].'">'.$row["CSTNAME"].'</a></td>
							<td>'.$row["RESIDENT_ID"].'</td>
                            <td>'.$row["MOBILE"].'</td>						
							<td>'.$row["REGDATE_"].'</td>
                            <td><a href="view_cst_info.php?id='.$row["CSTID"].'">안내문</a></td>
                            <td>'.$row["MEMO"].'</td>
							</tr>';
                            
                        }  // if($cst_type == "종합소득세") 끝
                    }
                }// 네번째 if문 끝
                else
                {
                    $output .= '
					<tr>
					<td colspan="20" align="center">데이터가 없습니다.</td>
					</tr>
					';
                }
                
                echo $head.$output;
                
            }// 세번째 if문 끝
        } // 두번째 if 문 끝
    }//첫번째 if문 끝!
}


/*종합소득세 리스트 select*/
if($action == "select_list_inc"){
    
    //ajax로 넘긴 데이터 값은 "select"
    //값이 존재하면 true를 리턴
    $cst_type = $_POST["cst_type"];
    $g_option = $_POST["g_option"];
    $b_option = $_POST["b_option"];
    $s_str = $_POST["s_str"];
    $footer="";
    
    $query_str1 = "";
    $query_str2 = "";
    $query_desc = " ORDER BY B.REGDATE DESC";
    
    $page = $_POST["page"];
    
    $page_set = 12; // 한페이지 줄수
    $block_set = 5; // 한페이지 블럭수
    
    
    if($s_str !=""){
        switch($g_option){
            case "ID" :
                $query_str1 .= " AND A.CSTID like '%".$s_str."%' ";
                break;
            case "CSTNAME" :
                $query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
                break;
            case "MOBILE" :
                $query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
                break;
            case "RESI" :
                $query_str1 .= " AND A.RESIDENT_ID like '%".$s_str."%' ";
                break;
            case "REGUSER" :
                $query_str1 .= " AND D.USERNAME like '%".$s_str."%' ";
                break;
            case "MEMO" :
                $query_str1 .= " AND B.MEMO like '%".$s_str."%' ";
                break;
            default:
                $query_str1 .="";
        }
    }
    
    
    if($b_option != ""){
        $query_str2 .= " AND BRANCH = '".$b_option."' ";
    }
    
    
    
    $query = "SELECT count(1) as total FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	LEFT OUTER JOIN TB300031 AS E ON A.CSTID=E.CSTID
 WHERE B.CST_TYPE = 'A1001' ".$query_str1.$query_str2;
    
    $result = mysqli_query($connect,$query);
    
    if($result)
    {
        $total = $row["total"]; // 전체글수
    }
    $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
    $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
    
    if (!$page) $page = 1; // 현재페이지(넘어온값)
    $block = ceil ($page / $block_set); // 현재블럭(올림함수)
    $limit_idx = ($page - 1) * $page_set; // limit시작위치
    
    
    /*담당자설정*/
    $query_owner = "SELECT * FROM TB980010 WHERE DEC_ID = 'D2200';";
    $result_owner = mysqli_query($connect,$query_owner) or die(mysqli_error($connect));
    $output_owner .= '
	';
    
    if(mysqli_num_rows($result_owner) >0)
    {
        while($row_owner = mysqli_fetch_array($result_owner)){
            $output_owner.= '<option value="'.$row_owner["USERID"].'">'.$row_owner["USERNAME"].'</option>';
        }
    }
    $output_owner.= '</select>';
    /*담당자설정*/
    
    if($cst_type == "A1001"){
        
        $head .= '
		<colgroup>
		<col width="50px">
		<col width="80px">
		<col width="130px">
		<col width="115px">
		<col width="70px">
		<col width="80px">
		<col width="80px">
		<col width="80px">
		<col width="70px">
		<col width="85px">
		<col width="85px">
		<col width="70px">
		<col width="70px">
		<col width="70px">
		<col width="80px">
		<col width="50px">
		<col width="200px">
            
		</colgroup>
		<thead>
		<tr>
			<th>No.</th>
			<th>이름</th>
			<th>주민등록번호</th>
			<th>핸드폰</th>
			<th>접수지점</th>
			<th>접수일</th>
			<th>예상수수료</th>
			<th>입금확인</th>
			<th>수임동의</th>
			<th>홈택스서류</th>
			<th>사용자서류</th>
			<th>신고서<BR>담당자</th>
			<th>서버</th>
			<th>코드</th>
			<th>신고일</th>
			<th>결제</th>
			<th>비고</th>
		</tr>
		</thead>
		';
        
    }else{
        
        $head .= '
		<colgroup>
            
		<col width="50px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="80px">
		<col width="60px">
		<col width="80px">
		<col width="80px">
		<col width="300px">
            
		</colgroup>
		<thead>
		  <tr>
			<th rowspan="2">no</th>
			<th rowspan="2">접수일</th>
			<th colspan="2">기본정보</th>
			<th colspan="3">수수료</th>
			<th colspan="2">홈택스 수임</th>
			<th colspan="2">자료</th>
			<th>회사</th>
			<th colspan="3">전자신고</th>
			<th>납부서</th>
			<th rowspan="2">메모</th>
		  </tr>
		  <tr>
			<td style="border:1px solid #e3e3e3;">상호</td>
			<td>이름</td>
			<td>수수료</td>
			<td>입금금액</td>
			<td>영수증</td>
			<td>요청</td>
			<td>여부</td>
			<td>추출</td>
			<td>첨부</td>
			<td>등록</td>
			<td>신고담당</td>
			<td>요청</td>
			<td>완료</td>
			<td>전송완료</td>
		  </tr>
		</thead>
		';
        
    }
    
    
    if(isset($_POST["action"]))
    {
        //users테이블 조회 프로시져를 만든다.
        $procedure = "
	CREATE PROCEDURE SELECT_TB100020()
	BEGIN
	SELECT  A.CSTID AS 'ID',
	DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',
	A.CSTNAME,
	A.MOBILE,
	B.COMP_NAME,
	B.EXP_PAY_TAX,
    B.EST_FEE,
	FORMAT(B.EST_FEE,0) AS EST_FEE_ ,
	FORMAT(B.DEP_FEE,0) AS DEP_FEE,
	B.DEP_TYPE,
	B.ACC_FLAG,
	B.DEADLINE_DATE,
	DATE_FORMAT(B.DEADLINE_DATE, '%y-%m-%d') 'DEADLINE_DATE_',
	B.PAY_TAX,
	B.NUM_E_REPORT,
	B.REPORT_NUM_INCOME,
	B.REPORT_NUM_WETAX,
	B.DEL_DATE_PAYMENT,
	DATE_FORMAT(B.DEL_DATE_PAYMENT, '%y-%m-%d') 'DEL_DATE_PAYMENT_',
	B.DEL_TYPE_PAYMENT,
	B.DEC_REGUSER,
	B.MEMO,
	B.OVER_FLAG,
	B.CST_TYPE,
	B.TAX_TYPE,
	B.INF_CHANNEL,
	B.INF_PATH,
	B.INF_GEAR,
	B.KEYWORD,
	B.REG_BRANCH,
	B.ACC_PATH,
	B.REC_PERSON,
	B.REGUSER,
	B.SALES_REP,
	A.KAKAO_REG,
	C.DIS_DATE,
	C.DIS_REASON,
	A.HomeTaxID,
	A.HomeTaxPW,
    B.SUBM_DATE,
    DATE_FORMAT(B.SUBM_DATE, '%y-%m-%d') 'SUBM_DATE_',	
    B.SUBM_DATE2,
    DATE_FORMAT(B.SUBM_DATE2, '%y-%m-%d') 'SUBM_DATE2_',
	C.DOUZONE_SVR,
	C.DOUZONE_CODE,
	A.CSTNAME,
	A.RESIDENT_ID,
	C.BIZ_NUM,
	C.BIZ_FORM,
	C.BIZ_CATE,
	A.SECTOR_CODE,
	C.OPENING_DAY,
	DATE_FORMAT(C.OPENING_DAY, '%y-%m-%d') 'OPENING_DAY_',
	C.CLOSE_DAY,
	DATE_FORMAT(C.CLOSE_DAY, '%y-%m-%d') 'CLOSE_DAY_',
	C.COMP_PHONE,
	C.ADDRESS_LEGAL,
	A.EMAIL,
	SELECT_CODE_VALUE_YEAR(A.CSTID,2) AS 'YEAR-1',
	SELECT_CODE_VALUE_YEAR(A.CSTID,3) AS 'YEAR-2',
	SELECT_CODE_VALUE_YEAR(A.CSTID,4) AS 'YEAR-3',
    E.EXI_TAX,
	B.INCOME_TAX,
	B.JIBANG_TAX,
	B.VAT_TAX,
	B.CASH_REC,
	A.REF_BANK,
	A.REF_ACC,
	A.ACC_HOLDER,
	B.REC_PERSON_PHONE,
    D.USERNAME AS 'DEC_REGUSER_',
    B.ACC_CHECK,
    B.CONFIRM_YN,
    B.SUBM
            
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	LEFT OUTER JOIN TB300031 AS E ON A.CSTID=E.CSTID
            
	WHERE B.CST_TYPE = '".$cst_type."' ".$query_str1.$query_str2.$query_desc.
	" LIMIT $limit_idx, $page_set
	;
	END;
	";
        //기존에 프로시져가 존재한다면 지운다.
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100020"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_TB100020()";
                
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                $result = mysqli_query($connect,$query1);
                
                
                if($result)
                {
                    
                    $cate_name="";
                    $path = "../tax_income/upload/";
                    
                    while($row = mysqli_fetch_array($result)){
                        
                        if($cst_type == "A1001"){
                            $bran = $row["REG_BRANCH"];
                            $dz_svr = $row["DOUZONE_SVR"];
                            $subm_yn =$row["SUBM"] ;
                            
                            
                            switch($subm_yn){
                                case "Y" : $subm ="<div style='width:50px;background:#3f863f;color:white;'>수임완료</div>"; break;
                                case "N" : $subm ="<div style='width:50px;background:#395adc;color:white;'>미동의</div>";break;
                                case "E" : $subm ="<div style='width:50px;background:#dc3939;color:white;'>에러</div>";break;
                                case "A" : $subm ="<div style='width:50px;background:#dcd139;'>진행중</div>";break;
                                default: $subm ="<a href='javascript:upt_subm(".$row['ID'].");'>요청</a>";
                            }
                             
                            if($row["CONFIRM_YN"] == 'Y'){
                                $confrim_yn ="<div style='width:50px;background:#3f863f;color:white;'>결제완료</div>";
                            }else{
                                $confrim_yn ="<a href='javascript:upt_confirm('".$row['ID']."');'>결제</a>";
                            }
                            
                            
                            if($style_cnt % 2 == 1 ){
                                $style = 'style="background:#b3dac31c;"';
                            }else{
                                $style = '';
                            }
                            $style_cnt++;
                            
                            if($row["ACC_CHECK"] == "Y"){
                                $acc_ck_style = "<div style='width:50px;background:#3f863f;color:white;'>확인완료</div>";
                            }else{
                                $acc_ck_style = "<div style='width:50px;background:#d81b1b;color:white;'>
                                <a style='color:white;' href='javascript:acc_check(".$row["ID"].", \"".$row["CSTNAME"]."\", \"".$row["EST_FEE"]."\"    );'>미확인</a></div>";
                            }
                            
                            $dir = $path.$row["CSTNAME"]."_".$row["MOBILE"]."/";
                            //$dir_ = iconv("UTF-8","CP949",$dir);
                            $LINK = '';
                            
                            if (is_dir($dir)){
                                $LINK = '<a href="javascript:file_pop(\''.$row["ID"].'\')">링크</a>';
                            }
                            
                            
                            $output .= '
							<tr '.$style.'>
							<td>'.$row["ID"].'</td>
							<td>
                                    <a href="view_inc_cst.php?id='.$row["ID"].'">'.$row["CSTNAME"].'</a>
                                    <a href="javascript:fn_mod('.$row["ID"].');">수정</a>
                            </td>
							<td>'.$row["RESIDENT_ID"].'</td>
							<td>'.$row["MOBILE"].'</td>
							<td>
							<select style="height:35px;" id="bran_'.$row["ID"].'" name="bran_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $bran == "" ? $output .= '<option value="" selected>선택</option>' : $output .='<option value="">선택</option>';
                            $bran == "D1019" ? $output .= '<option value="D1019" selected>세무톡</option>' : $output .='<option value="D1019">세무톡</option>';
                            $bran == "D1003" ? $output .= '<option value="D1003" selected>강남</option>' : $output .= '<option value="D1003">강남</option>';
                            $bran == "D1004" ? $output .= '<option value="D1004" selected>용인</option>' : $output .='<option value="D1004">용인</option>';
                            $bran == "D1006" ? $output .= '<option value="D1006" selected>안양</option>' : $output .='<option value="D1006">안양</option>';
                            $bran == "D1007" ? $output .= '<option value="D1007" selected>수원</option>' : $output .='<option value="D1007">수원</option>';
                            $bran == "D1008" ? $output .= '<option value="D1008" selected>일산</option>' : $output .='<option value="D1008">일산</option>';
                            $bran == "D1009" ? $output .= '<option value="D1009" selected>부천</option>' : $output .='<option value="D1009">부천</option>';
                            $bran == "D1010" ? $output .= '<option value="D1010" selected>광주</option>' : $output .='<option value="D1010">광주</option>';
                            $bran == "D1011" ? $output .= '<option value="D1011" selected>분당</option>' : $output .='<option value="D1011">분당</option>';
                            $bran == "D1012" ? $output .= '<option value="D1012" selected>기흥</option>' : $output .='<option value="D1012">기흥</option>';
                            $bran == "D1013" ? $output .= '<option value="D1013" selected>세무</option>' : $output .='<option value="D1013">세무</option>';
                            
                            
                            $output .='</select>
							</td>
							<td>'.$row["REGDATE_"].'</td>
							<td>'.$row["EST_FEE_"].'</td>
							<TD>'.$acc_ck_style.'</TD>
							<TD>'.$subm.'</TD>
							<TD>'.$LINK.'</TD>
							<TD>'.$LINK.'</TD>
							<td>
								<select id="select_decuser_'.$row["ID"].'" name="select_decuser_'.$row["ID"].'" onchange="javascript:modify_owner(this);">
								<option value=""></option>
								'.$output_owner.'
								<script>javascript:sel_owner("'.$row["ID"].'","'.$row["DEC_REGUSER"].'");</script>
							</td>
							<td>
								<select style="height:35px;" id="dz_svr_'.$row["ID"].'" name="dz_svr_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $dz_svr == "" ? $output .= '<option value="" selected>선택</option>' : $output .='<option value="">선택</option>';
                            $dz_svr == "1" ? $output .= '<option value="1" selected>1</option>' : $output .='<option value="1">1</option>';
                            $dz_svr == "2" ? $output .= '<option value="2" selected>2</option>' : $output .='<option value="2">2</option>';
                            $dz_svr == "3" ? $output .= '<option value="3" selected>3</option>' : $output .='<option value="3">3</option>';
                            $output .='</select>
							</td>
							<td>
								<DIV id="dzcode_lbl_'.$row["ID"].'" style="width:50px;height:25px;padding-top:8px;" onclick="javascript:switch_dzcode(this)">'.mb_strimwidth($row['DOUZONE_CODE'],'0','40','...','utf-8').'</DIV><input style="width:50px; height:25px;display:none;" type="text" id="dzcode_ip_'.$row["ID"].'" value="'.$row['DOUZONE_CODE'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)dzcode_submit(this);"  maxlength=4></input>
							</td>
							<td>'.$row["DEADLINE_DATE_"].'</td>
							<td>'.$confrim_yn.'</td>
							<td>
								<DIV id="memo_lbl_'.$row["ID"].'" style="width:280px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.mb_strimwidth($row['MEMO'],'0','40','...','utf-8').'</DIV><input style="width:280px; height:25px;display:none;" type="text" id="memo_ip_'.$row["ID"].'" value="'.$row['MEMO'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)memo_submit(this);" ></input>
							</td>
							</tr>';
                        }else{
                            /*부가세영역*/
                            $output .= '
							<tr>
							<td>'.$row["ID"].'</td>
							<td>'.$row["REGDATE_"].'</td>
							<td><a href="view_cst_info.php?id='.$row["ID"].'">'.$row["COMP_NAME"].'</a></td>
							<td><a href="view_cst_info.php?id='.$row["ID"].'">'.$row["CSTNAME"].'</a></td>
							<td>'.$row["EST_FEE"].'</td>
							<td>'.$row["DEP_FEE"].'</td>
							<td>'.$row["CASH_REC"].'</td>
							<td>'.$row["SUBM_DATE_"].'</td>
							<td>'.$row["SUBM_DATE2_"].'</td>
							<td>'.$row["EXT_DATE"].'</td>
							<td>'.$row["ATTACH_FILE"].'</td>
							<td>'.$row["CompRegCheck"].'</td>
							<td>'.$row["DEC_REGUSER"].'</td>
							<td>'.$row["REQ_E_REPORT"].'</td>
							<td>'.$row["COMP_DATE_"].'</td>
							<td>'.$row["DEL_DATE_PAYMENT_"].'</span></td>
							<td>'.$row["MEMO"].'</td>
							</tr>';
                        }  // if($cst_type == "종합소득세") 끝
                    }
                }// 네번째 if문 끝
                else
                {
                    $output .= '
					<tr>
					<td colspan="20" align="center">데이터가 없습니다.</td>
					</tr>
					';
                }
                
                echo $head.$output;
                
            }// 세번째 if문 끝
        } // 두번째 if 문 끝
    }//첫번째 if문 끝!
}



/*종합소득세 영업현황 select : 시작*/
if($action == "select_list_reginfo"){
    
    //ajax로 넘긴 데이터 값은 "select"
    //값이 존재하면 true를 리턴
    $cst_type = $_POST["cst_type"];
    $g_option = $_POST["g_option"];
    $b_option = $_POST["b_option"];
    $s_str = $_POST["s_str"];
    $infflag = $_POST["inf_flag"];
    $footer="";
    
    $query_str1 = "";
    $query_str2 = "";
    $query_str3 = "";
    $query_desc = " ORDER BY B.EDTDATE DESC, B.REGDATE DESC";
    
    $page = $_POST["page"];
    
    $page_set = 100; // 한페이지 줄수
    $block_set = 5; // 한페이지 블럭수
    
    if($infflag != ""){
        switch($infflag){
            case "cktk" :
                $query_str3 .= " AND INF_PATH = '채널톡' ";
                break;
            case "iq200" :
                $query_str3 .= " AND INF_PATH = 'IQ200' ";
                break;
            default:
                $query_str3 .="";
        }
    }
    
    
    if($s_str !=""){
        switch($g_option){
            case "ID" :
                $query_str1 .= " AND A.CSTID like '%".$s_str."%' ";
                break;
            case "CSTNAME" :
                $query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
                break;
            case "MOBILE" :
                $query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
                break;
            case "RESI" :
                $query_str1 .= " AND A.RESIDENT_ID like '%".$s_str."%' ";
                break;
            case "REGUSER" :
                $query_str1 .= " AND D.USERNAME like '%".$s_str."%' ";
                break;
            case "MEMO" :
                $query_str1 .= " AND B.MEMO like '%".$s_str."%' ";
                break;
            default:
                $query_str1 .="";
        }
    }
    
    
    if($b_option != ""){
        $query_str2 .= " AND B.REG_BRANCH = '".$b_option."' ";
    }
    
    $query = "SELECT count(1) as total FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON A.CSTID=C.CSTID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	LEFT OUTER JOIN TB300031 AS E ON A.CSTID=E.CSTID
 WHERE B.CST_TYPE = 'A1001' ".$query_str1.$query_str2.$query_str3;
    
    $result = mysqli_query($connect,$query);
    
    if($result)
    {
        $total = $row["total"]; // 전체글수
    }
    $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
    $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
    
    if (!$page) $page = 1; // 현재페이지(넘어온값)
    $block = ceil ($page / $block_set); // 현재블럭(올림함수)
    $limit_idx = ($page - 1) * $page_set; // limit시작위치
    
    
    
    
    $head .= '
		<colgroup>
		<col width="50px">
		<col width="70px">
		<col width="80px">
		<col width="50px">
        <col width="110px">
		<col width="70px">
		<col width="70px">
		<col width="50px">
        <col width="30px">
		<col width="120px">
		<col width="120px">
        <col width="50px">
		<col width="90px">
		<col width="100px">
		<col width="70px">
		<col width="100px">
		<col width="50px">
		<col width="30px">
		<col width="100px">
        <col width="70px">
        <col width="80px">
        <col width="150px">        
		</colgroup>
		<thead>
		<tr>
			<th>ID</th>
			<th>진행상태</th>
			<th>이름</th>
			<th>연도</th>
			<th>핸드폰번호</th>
			<th>유입채널</th>
            <th>신규여부</th>
			<th colspan=2>수동톡1</th>
            <th>매출계</th>
			<th colspan=2>예상세액</th>
			<th>예상수수료</th>
            <th>전년수수료</th>
			<th>입금확인</th>
            <th>입금금액</th>
			<th colspan=2>수동톡2</th>
			<th>등록일</th>
            <th>지점</th>
			<th>상담자</th>
			<th>메모</th>
		</tr>
		</thead>
		';
    
    
    if(isset($_POST["action"]))
    {
        //users테이블 조회 프로시져를 만든다.
        $procedure = "
	CREATE PROCEDURE SELECT_REGINFO()
	BEGIN
	SELECT
    A.CSTID AS 'ID',
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
    B.BIZ_ID,
	DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',
	A.CSTNAME,
	A.MOBILE,
    B.CST_TYPE_YEAR,    
substring( REPLACE(A.MOBILE,'-',''),4) MOBILE_PATH,
	B.COMP_NAME,
	#B.EXP_PAY_TAX,
    #FORMAT(B.EXP_PAY_TAX,0) AS EXP_PAY_TAX_ ,
    B.EXP_PAY_TAX_SELF,
    FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF_ ,
    #B.EST_FEE,
	#FORMAT(B.EST_FEE,0) AS EST_FEE_ ,
    B.EST_FEE_SELF,
	FORMAT(B.EST_FEE_SELF,0) AS EST_FEE_SELF_ ,
    EST_FEE_BF_YEAR(A.CSTID) AS EST_FEE_BF_YEAR,
	FORMAT(B.DEP_FEE,0) AS DEP_FEE,
	B.DEP_TYPE,
	B.ACC_FLAG,
	B.DEADLINE_DATE,
	DATE_FORMAT(B.DEADLINE_DATE, '%y-%m-%d') 'DEADLINE_DATE_',
	B.PAY_TAX,
	B.DEL_DATE_PAYMENT,
	DATE_FORMAT(B.DEL_DATE_PAYMENT, '%y-%m-%d') 'DEL_DATE_PAYMENT_',
	B.DEL_TYPE_PAYMENT,
	B.DEC_REGUSER,
	B.MEMO,
	B.CST_TYPE,
	B.TAX_TYPE,
	B.REG_BRANCH,
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
	B.REGUSER,
    D.USERNAME AS 'DEC_REGUSER_',
    SELECT_PROGRESS(B.BIZ_ID) AS PROGRESS,
    ACC_CK(A.CSTID,A.CSTNAME, B.EST_FEE) AS ACC_CK,
    # FORMAT(ADD_AMOUNT_PAID(A.CSTID),0) AS AMOUNT_PAID_,
    SELECT_AMOUNTPAID_FAST(A.CSTID) AS AMOUNT_PAID_2,
    #FORMAT(CAL_INC(A.CSTID),0) AS 'EXP_PAY_TAX_FN',
    #CAL_FEE_CHANGE_DATE(A.CSTID) AS 'CAL_EST_FEE_FN',
    NEW_CST_CK(A.CSTID) AS 'NEW_CST_CK',
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP01') AS 'KAKAO_SEND_1',
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP02') AS 'KAKAO_SEND_2',
    B.INF_CHANNEL,
	B.INF_PATH
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	WHERE B.CST_TYPE =  '".$cst_type."' ".$query_str1.$query_str2.$query_str3.$query_desc.
	" LIMIT $limit_idx, $page_set
	;
	END;
	";
        
        $hostname=$_SERVER["HTTP_HOST"];
        //기존에 프로시져가 존재한다면 지운다.
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_REGINFO"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_REGINFO()";
                
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                $result = mysqli_query($connect,$query1);
                
                
                if($result)
                {
                    
                    $cate_name="";
                    $path_pay = "../tax_income/upload/2021/";
                    //$path_info = "upload_income/2021/";
                    
                   
                    while($row = mysqli_fetch_array($result)){
                        
                        if($cst_type == "A1001"){
                            $proc = $row["PROGRESS"] ;
                            $acc_ck= $row["ACC_CK"] ;
                            $reguser= $row["REGUSER"] ;
                            $new_cst=$row["NEW_CST_CK"];
                            $bran = $row["REG_BRANCH"];
                            $kakao_1 = $row["KAKAO_SEND_1"];
                            $kakao_2 = $row["KAKAO_SEND_2"];
                            $style_new_cst ="";
                            $FILE_CNT1=0;
                            
                            if ($new_cst=="N"){
                                $style_new_cst="background-color:#c8c8c8;";
                            }
                            
                            if($style_cnt % 2 == 1 ){
                                $style = 'style="background:#b3dac31c;"';
                            }else{
                                $style = '';
                            }
                            $style_cnt++;
                            
                            $DOWN_PATH_PAY = $path_pay.$row["REG_BRANCH_PATH"]."/납부서/".$row["CSTNAME"].$row["MOBILE_PATH"]."/";
                            //$DOWN_PATH_INFO = $path_info.$row["CSTNAME"].$row["MOBILE_PATH"]."/";
                            
                           //$dir1 = iconv("UTF-8","CP949",$DOWN_PATH_PAY);
                            
                            if($hostname=="localhost")
                                $dir1 = $DOWN_PATH_PAY;
                            else
                                $dir1 = iconv("UTF-8","CP949",$DOWN_PATH_PAY);
                                    
                            //$dir2 = iconv("UTF-8","CP949",$DOWN_PATH_INFO);
                            
                            if (is_dir($dir1)){
                                if ($dh = opendir($dir1)){                     //$df = array_diff(scandir($dir),$ignore);
                                    while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
                                        continue;
                                    }else{
                                        $FILE_CNT1++;
                                    }
                                    
                                    }
                                    closedir($dh);
                                }
                            }
                            
                            if($FILE_CNT1 > 0){
                                $DOWN_URL_PAY = "<a href='javascript:open_file_pay(".$row["ID"].");'>파일</a>";
                            }else{
                                $DOWN_URL_PAY = $row["INF_PATH"];
                            }
                            
                            
                            
                            
                            $output .= '
							<tr '.$style.'>
							<td>'.$row["ID"].'</td>
							    
                            <td>
							<select style="height:35px;" id="proc_'.$row["BIZ_ID"].'" name="proc_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $proc == "" ? $output .= '<option value="" selected>전체</option>' : $output .='<option value="">전체</option>';
                            $proc == "E7201" ? $output .= '<option value="E7201" selected>등록</option>' : $output .='<option value="E7201">등록</option>';
                            $proc == "E7202" ? $output .= '<option value="E7202" selected>계산</option>' : $output .= '<option value="E7202">계산</option>';
                            $proc == "E7203" ? $output .= '<option value="E7203" selected>검토</option>' : $output .='<option value="E7203">검토</option>';
                            $proc == "E7204" ? $output .= '<option value="E7204" selected>부재</option>' : $output .='<option value="E7204">부재</option>';
                            $proc == "E7205" ? $output .= '<option value="E7205" selected>불가</option>' : $output .='<option value="E7205">불가</option>';
                            $proc == "E7206" ? $output .= '<option value="E7206" selected>의뢰</option>' : $output .='<option value="E7206">의뢰</option>';
                            $proc == "E7207" ? $output .= '<option value="E7207" selected>유력</option>' : $output .='<option value="E7207">유력</option>';
                            $proc == "E7208" ? $output .= '<option value="E7208" selected>수임</option>' : $output .='<option value="E7208">수임</option>';
                            $proc == "E7209" ? $output .= '<option value="E7209" selected>환불</option>' : $output .='<option value="E7209">환불</option>';
                            
                            $output .='</select>
							</td>
                                
							<td>
                                    <a href="view_inc_cst.php?id='.$row["ID"].'&listflag=reg">'.$row["CSTNAME"].'</a>
                            </td>
                            <td>'.$row["CST_TYPE_YEAR"].'</td>							
                            <td>'.$row["MOBILE"].'</td>
                            <td>'.$DOWN_URL_PAY.'</td>
                            <td><select style="height:35px;'.$style_new_cst.'" id="new_cst_'.$row["ID"].'" name="new_cst_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $new_cst == "" ? $output .= '<option value="" style="background-color:white;" selected>선택</option>' : $output .='<option value="" style="background-color:white;">전체</option>';
                            $new_cst == "Y" ? $output .= '<option value="Y" style="background-color:white;"  selected>신규</option>' : $output .='<option value="Y" style="background-color:white;" >신규</option>';
                            $new_cst == "N" ? $output .= '<option value="N" style="background-color:#c8c8c8;" selected>기존</option>' : $output .= '<option value="N" style="background-color:#c8c8c8;">기존</option>';
                            
                            $output .='</select></td>
                            <td>';
                            $kakao_1 == 0 ?$output.='<a href="javascript:send_kakao(\'self_1\',\''.$row["ID"].'\' ,\''.$row["BIZ_ID"].'\' ,\''.$row["CSTNAME"].'\');">발송</a>' : $output.='발송';
                            
                            $output .='</td>
                            <td>'.$kakao_1.'</td>
                            <td>'.$row["AMOUNT_PAID_2"].'</td>
                            <td>'.$row["EXP_PAY_TAX_SELF_"].'</td>
                            <td><a href="javascript:open_cal(\''.$row["ID"].'\');">계산</a></td>
                            <td>'.$row["EST_FEE_SELF_"].'</td>
                            <td>'.$row["EST_FEE_BF_YEAR"].'</td>
                            <td>
							<select style="height:35px;" id="accck_'.$row["BIZ_ID"].'" name="accck_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $acc_ck == "" ? $output .= '<option value="" selected>선택</option>' : $output .='<option value="">선택</option>';
                            $acc_ck == "Y" ? $output .= '<option value="Y" selected>완납</option>' : $output .='<option value="Y">완납</option>';
                            $acc_ck == "N" ? $output .= '<option value="N" selected>미납</option>' : $output .= '<option value="N">미납</option>';
                            $acc_ck == "R" ? $output .= '<option value="R" selected>환불</option>' : $output .= '<option value="R">환불</option>';
                            
                            $output .='</select>
							</td>
                            <td>'.$row["DEP_FEE"].'</td>
                            <td>';
                            $kakao_2 ==""?$output.='<a href="javascript:send_kakao(\'self_2\',\''.$row["ID"].'\',\''.$row["BIZ_ID"].'\' ,\''.$row["CSTNAME"].'\');">발송</a>' : $output.='발송';
                            $output .='</td>
                            <td>'.$kakao_2.'</td>
							<td>'.$row["REGDATE_"].'</td>
							<td>
		                    <select style="height:35px;" id="bran_'.$row["BIZ_ID"].'" name="bran_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $bran == "" ? $output .= '<option value="" selected></option>' : $output .='<option value=""></option>';
                            $bran == "D1019" ? $output .= '<option value="D1019" selected>세무톡</option>' : $output .='<option value="D1019">세무톡</option>';
                            $bran == "D1003" ? $output .= '<option value="D1003" selected>강남</option>' : $output .= '<option value="D1003">강남</option>';
                            $bran == "D1002" ? $output .= '<option value="D1002" selected>회계본부</option>' : $output .='<option value="D1002">회계본부</option>';
                            $bran == "D1014" ? $output .= '<option value="D1014" selected>영업본부</option>' : $output .='<option value="D1014">영업본부</option>';
                            $bran == "D1013" ? $output .= '<option value="D1013" selected>세무본부</option>' : $output .='<option value="D1013">세무본부</option>';
                            $bran == "D1004" ? $output .= '<option value="D1004" selected>용인</option>' : $output .='<option value="D1004">용인</option>';
                            $bran == "D1006" ? $output .= '<option value="D1006" selected>안양</option>' : $output .='<option value="D1006">안양</option>';
                            $bran == "D1007" ? $output .= '<option value="D1007" selected>수원</option>' : $output .='<option value="D1007">수원</option>';
                            $bran == "D1008" ? $output .= '<option value="D1008" selected>일산</option>' : $output .='<option value="D1008">일산</option>';
                            $bran == "D1009" ? $output .= '<option value="D1009" selected>부천</option>' : $output .='<option value="D1009">부천</option>';
                            $bran == "D1010" ? $output .= '<option value="D1010" selected>광주</option>' : $output .='<option value="D1010">광주</option>';
                            $bran == "D1011" ? $output .= '<option value="D1011" selected>분당</option>' : $output .='<option value="D1011">분당</option>';
                            $bran == "D1012" ? $output .= '<option value="D1012" selected>기흥</option>' : $output .='<option value="D1012">기흥</option>';
                            $bran == "D1021" ? $output .= '<option value="D1021" selected>동탄</option>' : $output .='<option value="D1021">동탄</option>';
                            
                            $output .='</select>
							</td>
                                
							<td>
							<select style="height:35px;" id="reguser_'.$row["BIZ_ID"].'" name="reguser_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                            
                            if($bran == "D1019"){
                                $reguser == "" ? $output .= '<option value="" selected></option>' : $output .='<option value=""></option>';
                                $reguser == "1231" ? $output .= '<option value="1231" selected>신승01</option>' : $output .='<option value="1231">신승01</option>';
                                $reguser == "1232" ? $output .= '<option value="1232" selected>신승02</option>' : $output .='<option value="1232">신승02</option>';
                                $reguser == "1233" ? $output .= '<option value="1233" selected>신승03</option>' : $output .='<option value="1233">신승03</option>';
                                $reguser == "1234" ? $output .= '<option value="1234" selected>신승04</option>' : $output .='<option value="1234">신승04</option>';
                                $reguser == "1235" ? $output .= '<option value="1235" selected>신승05</option>' : $output .='<option value="1235">신승05</option>';
                                $reguser == "1236" ? $output .= '<option value="1236" selected>신승06</option>' : $output .='<option value="1236">신승06</option>';
                                $reguser == "1237" ? $output .= '<option value="1237" selected>신승07</option>' : $output .='<option value="1237">신승07</option>';
                                $reguser == "1238" ? $output .= '<option value="1238" selected>신승08</option>' : $output .='<option value="1238">신승08</option>';
                                $reguser == "1239" ? $output .= '<option value="1239" selected>신승09</option>' : $output .='<option value="1239">신승09</option>';
                                $reguser == "1240" ? $output .= '<option value="1240" selected>신승10</option>' : $output .='<option value="1240">신승10</option>';
                            }elseif ($bran=="D1003"){
                                $reguser == "1117" ? $output .= '<option value="1117" selected>마희숙</option>' : $output .='<option value="1117">마희숙</option>';
                                $reguser == "1131" ? $output .= '<option value="1131" selected>한예주</option>' : $output .='<option value="1131">한예주</option>';
                                $reguser == "1132" ? $output .= '<option value="1132" selected>김지윤</option>' : $output .='<option value="1132">김지윤</option>';
                                $reguser == "1134" ? $output .= '<option value="1134" selected>용아름</option>' : $output .='<option value="1134">용아름</option>';
                                $reguser == "1256" ? $output .= '<option value="1256" selected>김예빈</option>' : $output .='<option value="1256">김예빈</option>';
                                $reguser == "1241" ? $output .= '<option value="1241" selected>강남1</option>' : $output .='<option value="1241">강남1</option>';
                                $reguser == "1242" ? $output .= '<option value="1242" selected>강남2</option>' : $output .='<option value="1242">강남2</option>';
                                $reguser == "1243" ? $output .= '<option value="1243" selected>강남3</option>' : $output .='<option value="1243">강남3</option>';
                                $reguser == "1244" ? $output .= '<option value="1244" selected>강남4</option>' : $output .='<option value="1244">강남4</option>';
                                $reguser == "1245" ? $output .= '<option value="1245" selected>강남5</option>' : $output .='<option value="1245">강남5</option>';
                                $reguser == "1246" ? $output .= '<option value="1246" selected>강남6</option>' : $output .='<option value="1246">강남6</option>';
                                $reguser == "1247" ? $output .= '<option value="1247" selected>강남7</option>' : $output .='<option value="1247">강남7</option>';                                
                            }elseif ($bran=="D1002"){
                                $reguser == "1148" ? $output .= '<option value="1148" selected>김용덕</option>' : $output .='<option value="1148">김용덕</option>';
                                $reguser == "1133" ? $output .= '<option value="1133" selected>이정희</option>' : $output .='<option value="1133">이정희</option>';
                                $reguser == "1154" ? $output .= '<option value="1154" selected>김혜선</option>' : $output .='<option value="1154">김혜선</option>';
                                $reguser == "1248" ? $output .= '<option value="1248" selected>강설옥</option>' : $output .='<option value="1248">강설옥</option>';
                            }elseif ($bran=="D1014"){
                                $reguser == "1147" ? $output .= '<option value="1147" selected>노준석</option>' : $output .='<option value="1147">노준석</option>';
                                $reguser == "1148" ? $output .= '<option value="1148" selected>이정민</option>' : $output .='<option value="1148">이정민</option>';
                                $reguser == "1149" ? $output .= '<option value="1149" selected>윤형덕</option>' : $output .='<option value="1149">윤형덕</option>';
                                $reguser == "1227" ? $output .= '<option value="1227" selected>김선진</option>' : $output .='<option value="1227">김선진</option>';
                            }elseif ($bran=="D1013"){
                                $reguser == "1226" ? $output .= '<option value="1226" selected>김민</option>' : $output .='<option value="1226">김민</option>';
                                $reguser == "1228" ? $output .= '<option value="1228" selected>김규리</option>' : $output .='<option value="1228">김규리</option>';
                                $reguser == "1249" ? $output .= '<option value="1249" selected>홍건호</option>' : $output .='<option value="1249">홍건호</option>';
                                $reguser == "1121" ? $output .= '<option value="1121" selected>최기정</option>' : $output .='<option value="1121">최기정</option>';
                                $reguser == "1220" ? $output .= '<option value="1220" selected>이명진</option>' : $output .='<option value="1220">이명진</option>';
                                $reguser == "1153" ? $output .= '<option value="1153" selected>김진규</option>' : $output .='<option value="1153">김진규</option>';
                                $reguser == "1163" ? $output .= '<option value="1163" selected>한성민</option>' : $output .='<option value="1163">한성민</option>';
                                $reguser == "1164" ? $output .= '<option value="1164" selected>한은진</option>' : $output .='<option value="1164">한은진</option>';
                            }elseif ($bran=="D1004"){
                                $reguser == "1119" ? $output .= '<option value="1119" selected>오선미</option>' : $output .='<option value="1119">오선미</option>';
                                $reguser == "1135" ? $output .= '<option value="1135" selected>노윤솔</option>' : $output .='<option value="1135">노윤솔</option>';
                                $reguser == "1250" ? $output .= '<option value="1250" selected>김정아</option>' : $output .='<option value="1250">김정아</option>';
                            }elseif ($bran=="D1006"){
                                $reguser == "1136" ? $output .= '<option value="1136" selected>김은정</option>' : $output .='<option value="1136">김은정</option>';
                                $reguser == "1160" ? $output .= '<option value="1160" selected>박기령</option>' : $output .='<option value="1160">박기령</option>';
                                $reguser == "1161" ? $output .= '<option value="1161" selected>김지영</option>' : $output .='<option value="1161">김지영</option>';
                                $reguser == "1166" ? $output .= '<option value="1166" selected>안덕현</option>' : $output .='<option value="1166">안덕현</option>';
                            }elseif ($bran=="D1007"){
                                $reguser == "1116" ? $output .= '<option value="1116" selected>오미자</option>' : $output .='<option value="1116">오미자</option>';
                                $reguser == "1257" ? $output .= '<option value="1257" selected>김세화</option>' : $output .='<option value="1257">김세화</option>';
                                $reguser == "1251" ? $output .= '<option value="1251" selected>한지은</option>' : $output .='<option value="1251">한지은</option>';
                            }elseif ($bran=="D1008"){
                                $reguser == "1120" ? $output .= '<option value="1120" selected>이찬희</option>' : $output .='<option value="1120">이찬희</option>';
                                $reguser == "1140" ? $output .= '<option value="1140" selected>김세아</option>' : $output .='<option value="1140">김세아</option>';
                                $reguser == "1141" ? $output .= '<option value="1141" selected>강정민</option>' : $output .='<option value="1141">강정민</option>';
                                $reguser == "1252" ? $output .= '<option value="1252" selected>김미경</option>' : $output .='<option value="1252">김미경</option>';
                            }elseif ($bran=="D1009"){
                                $reguser == "1118" ? $output .= '<option value="1118" selected>신정희</option>' : $output .='<option value="1118">신정희</option>';
                                $reguser == "1142" ? $output .= '<option value="1142" selected>양은경</option>' : $output .='<option value="1142">양은경</option>';
                                $reguser == "1253" ? $output .= '<option value="1253" selected>신솔빈</option>' : $output .='<option value="1253">신솔빈</option>';
                                $reguser == "1155" ? $output .= '<option value="1155" selected>장민경</option>' : $output .='<option value="1155">장민경</option>';
                            }elseif ($bran=="D1010"){
                                $reguser == "1113" ? $output .= '<option value="1113" selected>이해옥</option>' : $output .='<option value="1113">이해옥</option>';
                                $reguser == "1144" ? $output .= '<option value="1144" selected>박혜진</option>' : $output .='<option value="1144">박혜진</option>';
                                $reguser == "1143" ? $output .= '<option value="1143" selected>염해림</option>' : $output .='<option value="1143">염해림</option>';
                            }elseif ($bran=="D1011"){
                                $reguser == "1113" ? $output .= '<option value="1113" selected>이해옥</option>' : $output .='<option value="1113">이해옥</option>';
                                $reguser == "1158" ? $output .= '<option value="1158" selected>유수현</option>' : $output .='<option value="1158">유수현</option>';
                                $reguser == "1145" ? $output .= '<option value="1145" selected>한세빈</option>' : $output .='<option value="1145">한세빈</option>';
                            }elseif ($bran=="D1012"){
                                $reguser == "1115" ? $output .= '<option value="1115" selected>한영순</option>' : $output .='<option value="1115">한영순</option>';
                                $reguser == "1165" ? $output .= '<option value="1165" selected>강지혜</option>' : $output .='<option value="1165">강지혜</option>';
                                $reguser == "1255" ? $output .= '<option value="1255" selected>임봉규</option>' : $output .='<option value="1255">임봉규</option>';
                                $reguser == "1254" ? $output .= '<option value="1254" selected>한유정</option>' : $output .='<option value="1254">한유정</option>';
                            }elseif ($bran=="D1021"){
                                $reguser == "1115" ? $output .= '<option value="1115" selected>정혜숙</option>' : $output .='<option value="1115">정혜숙</option>';
                                $reguser == "1116" ? $output .= '<option value="1116" selected>오미자</option>' : $output .='<option value="1116">오미자</option>';
                            }else{
                                $reguser == "" ? $output .= '<option value="" selected></option>' : $output .='<option value=""></option>';
                            }
                            $output .='</select>
							</td>
							<TD><DIV id="memo_lbl_'.$row["ID"].'" style="width:200px;height:28px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.mb_strimwidth($row['MEMO'],'0','40','...','utf-8').'</DIV><input style="width:200px; height:28px;display:none;" type="text" id="memo_ip_'.$row["ID"].'" value="'.$row['MEMO'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)memo_submit(this);" ></input></TD>';
                            
                        }  // if($cst_type == "종합소득세") 끝
                    }
                }// 네번째 if문 끝
                else
                {
                    $output .= '
					<tr>
					<td colspan="20" align="center">데이터가 없습니다.</td>
					</tr>
					';
                }
                
                echo $head.$output;
                
            }// 세번째 if문 끝
        } // 두번째 if 문 끝
    }//첫번째 if문 끝!
}
/*종합소득세 영업현황 select : 시작*/



if($action=="select_list_acc"){
    //ajax로 넘긴 데이터 값은 "select"
    //값이 존재하면 true를 리턴
    $cst_type = $_POST["cst_type"];
    $g_option = $_POST["g_option"];
    $b_option = $_POST["b_option"];
    $e_option1 = $_POST["e_option1"];
    $e_option2 = $_POST["e_option2"];
    $e_option3 = $_POST["e_option3"];
    
    $s_str = $_POST["s_str"];
    $footer="";
    
    $query_str1 = "";
    $query_str2 = "";
    $query_str3 = "";
    $query_desc = " ORDER BY B.EDTDATE DESC, B.BIZ_ID DESC";
    
    $page = $_POST["page"];
    
    $page_set = 100; // 한페이지 줄수
    $block_set = 5; // 한페이지 블럭수
    
    
    if($s_str !=""){
        switch($g_option){
            case "CSTID" :
                $query_str1 .= " AND A.CSTID like '%".$s_str."%' ";
                break;
            case "CSTNAME" :
                $query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
                break;
            case "MOBILE" :
                $query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
                break;
            case "RESI" :
                $query_str1 .= " AND A.RESIDENT_ID like '%".$s_str."%' ";
                break;
            case "REGUSER" :
                $query_str1 .= " AND D.USERNAME like '%".$s_str."%' ";
                break;
            case "MEMO" :
                $query_str1 .= " AND B.MEMO like '%".$s_str."%' ";
                break;
            default:
                $query_str1 .="";
        }
    }
    
    
    if($b_option != "ALL"){
        $query_str2 .= " AND REG_BRANCH = '".$b_option."'  ";
    }else{
        $query_str2 .= " ";
    }
    
    
    if($e_option1 != ""){
        $query_str3 .= " AND F.SmartAToConvert = '".$e_option1."' ";
    }
    
    if($e_option2 != ""){
        $query_str3 .= " AND F.HomeTaxUpload = '".$e_option2."' ";
    }
    
    if($e_option3 != ""){
        $query_str3 .= " AND F.HomeTaxPrint = '".$e_option3."' ";
    }
    
    
    
    $query = "SELECT count(1) as total FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON A.CSTID=C.CSTID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
    LEFT OUTER JOIN TB980010 AS D2 ON D2.USERID = B.REGUSER
    LEFT OUTER JOIN TB100026 AS E ON B.BIZ_ID = E.BIZ_ID
    LEFT OUTER JOIN TB100023 AS F ON B.BIZ_ID = F.BIZ_ID
	WHERE E.PROGRESS IN ('E7208','E7210','E7211','E7212','E7209','E7214','E7213','E7215')
    AND B.CST_TYPE = 'A1001' ".$query_str1.$query_str2.$query_str3;
    
    $result = mysqli_query($connect,$query);
    
    if($result)
    {
        $total = $row["total"]; // 전체글수
    }
    $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
    $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
    
    if (!$page) $page = 1; // 현재페이지(넘어온값)
    $block = ceil ($page / $block_set); // 현재블럭(올림함수)
    $limit_idx = ($page - 1) * $page_set; // limit시작위치
    
    
    
    
    
    $head .= '
		<colgroup>
		<col width="70px">
		<col width="70px">
		<col width="80px">
        <col width="50px">
		<col width="170px">
		<col width="70px">
		<col width="120px">
        <col width="100px">
        <col width="100px">
        <col width="50px">
        <col width="50px">
        <col width="50px">
        <col width="50px">
		<col width="50px">
        <col width="50px">
        <col width="100px">
        <col width="100px">
        <col width="50px">
        <col width="50px">
        <col width="50px">
        <col width="50px">
        <col width="40px">
        <col width="50px">
        <col width="60px">
        <col width="50px">
        <col width="60px">
        <col width="50px">
        <col width="100px">
        <col width="70px">
        <col width="70px">
        <col width="70px">
        <col width="230px">
		</colgroup>
		<thead>
		<tr>
			<th>ID</th>
			<th>진행상태</th>
			<th>이름</th>
            <th></th>
			<th>핸드폰번호</th>
            <th>신규여부</th>
            <th>접수일</th>
			<th>예상수수료</th>
            <th>입금금액</th>
			<th colspan=2>현금영수증</th>
			<th colspan=2>수임동의</th>
            <th colspan=2>홈택스</th>
            <th>안내문</th>
			<th>필수 서류</th>
            <th colspan=2>회사 등록</th>
            <th>지점</th>
			<th>작성자</th>
            <th>서버</th>
            <th>코드</th>
            <th colspan=2>전자신고1</th>
            <th colspan=2>전자신고2</th>
            <th>납부서</th>
            <th colspan=2>알림톡</th>
            <th>결재</th>
			<th>접수메모</th>
		</tr>
		</thead>
		';
    
    
    if(isset($_POST["action"]))
    {
        //users테이블 조회 프로시져를 만든다.
        $procedure = "
	CREATE PROCEDURE SELECT_LIST_ACC()
	BEGIN
	SELECT
    A.CSTID AS 'ID',
    B.BIZ_ID,
	DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',
	A.CSTNAME,
	A.MOBILE,
    substring( REPLACE(REPLACE(RETURN_STR(A.MOBILE),'-',''),' ',''),4) MOBILE_PATH,
	B.COMP_NAME,
	B.EXP_PAY_TAX,
    FORMAT(B.EXP_PAY_TAX,0) AS EXP_PAY_TAX_ ,
    B.EST_FEE,
	FORMAT(B.EST_FEE,0) AS EST_FEE_ ,
    B.EXP_PAY_TAX_SELF,
    FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF_ ,
    B.EST_FEE_SELF,
	FORMAT(B.EST_FEE_SELF,0) AS EST_FEE_SELF_ ,
            
    EST_FEE_BF_YEAR(A.CSTID) AS EST_FEE_BF_YEAR,
	FORMAT(B.DEP_FEE,0) AS DEP_FEE,
	B.DEP_TYPE,
	B.ACC_FLAG,
	B.DEADLINE_DATE,
	DATE_FORMAT(B.DEADLINE_DATE, '%y-%m-%d') 'DEADLINE_DATE_',
	B.PAY_TAX,
	B.NUM_E_REPORT,
	B.REPORT_NUM_INCOME,
	B.REPORT_NUM_WETAX,
	B.DEL_DATE_PAYMENT,
	DATE_FORMAT(B.DEL_DATE_PAYMENT, '%y-%m-%d') 'DEL_DATE_PAYMENT_',
	B.DEL_TYPE_PAYMENT,
	B.DEC_REGUSER,
	B.MEMO,
	B.OVER_FLAG,
	B.CST_TYPE,
	B.TAX_TYPE,
	B.INF_CHANNEL,
	B.INF_PATH,
	B.INF_GEAR,
	B.KEYWORD,
	B.REG_BRANCH,
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
	B.ACC_PATH,
	B.REC_PERSON,
	B.REGUSER,
    D2.USERNAME AS 'REGUSER_',
	B.SALES_REP,
	A.KAKAO_REG,
	C.DIS_DATE,
	C.DIS_REASON,
	A.HomeTaxID,
	A.HomeTaxPW,
    B.SUBM_DATE,
    DATE_FORMAT(B.SUBM_DATE, '%y-%m-%d') 'SUBM_DATE_',
    B.SUBM_DATE2,
    DATE_FORMAT(B.SUBM_DATE2, '%y-%m-%d') 'SUBM_DATE2_',
	C.DOUZONE_SVR,
	C.DOUZONE_CODE,
	A.RESIDENT_ID,
	C.BIZ_NUM,
	C.BIZ_FORM,
	C.BIZ_CATE,
	A.SECTOR_CODE,
	C.OPENING_DAY,
	DATE_FORMAT(C.OPENING_DAY, '%y-%m-%d') 'OPENING_DAY_',
	C.CLOSE_DAY,
	DATE_FORMAT(C.CLOSE_DAY, '%y-%m-%d') 'CLOSE_DAY_',
	C.COMP_PHONE,
	C.ADDRESS_LEGAL,
	A.EMAIL,
	SELECT_CODE_VALUE_YEAR(A.CSTID,2) AS 'YEAR-1',
	SELECT_CODE_VALUE_YEAR(A.CSTID,3) AS 'YEAR-2',
	SELECT_CODE_VALUE_YEAR(A.CSTID,4) AS 'YEAR-3',
	B.INCOME_TAX,
	B.JIBANG_TAX,
	B.VAT_TAX,
	B.CASH_REC,
	A.REF_BANK,
	A.REF_ACC,
	A.ACC_HOLDER,
	B.REC_PERSON_PHONE,
B.DEC_REGUSER,
D.USERNAME AS 'DEC_REGUSER_',
    B.ACC_CHECK,
    B.CONFIRM,
    B.SUBM,
    B.IMP_LEVEL,
    E.PROGRESS,
    DATE_FORMAT(E.EDTDATE, '%y-%m-%d') 'E_EDTDATE',
    DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'B_REGDATE',
    ACC_CK(A.CSTID,A.CSTNAME, B.EST_FEE) AS ACC_CK,
     FORMAT(ADD_AMOUNT_PAID(A.CSTID),0) AS AMOUNT_PAID_,
    #FORMAT(CAL_INC(A.CSTID),0) AS 'EXP_PAY_TAX_FN',
    #CAL_FEE_CHANGE_DATE(A.CSTID) AS 'CAL_EST_FEE_FN',
    NEW_CST_CK(A.CSTID) AS 'NEW_CST_CK',
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP01') AS 'KAKAO_SEND_1',
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP02') AS 'KAKAO_SEND_2',
    STEP_NAME( F.CashReport ) AS CASH_REPORT,
    STEP_NAME( F.HomeTaxConsignment ) AS CONSIGN,
    STEP_NAME( F.SmartAToConvert) AS SMARTA,
    STEP_NAME( F.HomeTaxUpload ) AS HT_UPLOAD,
    STEP_NAME( F.HomeTaxPrint ) AS HT_PRINT,
    #STEP_NAME( F.HomeTaxNoticeDW ) AS HT_DOWNLOAD,
    STEP_NAME( F.CompRegCheck ) AS COMPREG,
    STEP_NAME( F.TaxInvoice ) AS TAXINVOICE,
    SELECT_ERROR_MSG(A.CSTID) AS ERROR_MSG,
    (SELECT COUNT(1) FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='AUTO_COMPLATE') AS CNT_KAKAO_SEND,
    B.RP_SEND_KAKAO
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID  AND CST_TYPE_YEAR = DATE_FORMAT(now(), '%Y')
	LEFT OUTER JOIN TB100030 AS C ON A.CSTID=C.CSTID  AND B.BIZ_ID = C.BIZ_ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
    LEFT OUTER JOIN TB980010 AS D2 ON D2.USERID = B.REGUSER
    LEFT OUTER JOIN TB100026 AS E ON B.BIZ_ID = E.BIZ_ID
    LEFT OUTER JOIN TB100023 AS F ON B.BIZ_ID = F.BIZ_ID
	WHERE E.PROGRESS IN ('E7208','E7210','E7211','E7212','E7209','E7214','E7213','E7215')
    AND B.CST_TYPE = '".$cst_type."' ".$query_str1.$query_str2.$query_str3.$query_desc.
    " LIMIT $limit_idx, $page_set
	;
	END;
	";
        //기존에 프로시져가 존재한다면 지운다.
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_LIST_ACC"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_LIST_ACC()";
                
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                $result = mysqli_query($connect,$query1);
                
                
                if($result)
                {
                    
                    $cate_name="";
                    //$path = "upload_income/2021/";
                    $path = "../tax_income/upload/2021/";
                    
                    
                    while($row = mysqli_fetch_array($result)){
                        
                        if($cst_type == "A1001"){
                            $proc = $row["PROGRESS"] ;
                            //$level = $row["IMP_LEVEL"] ;
                            $acc_ck= $row["ACC_CK"] ;
                            $reguser= $row["DEC_REGUSER"] ;
                            $new_cst=$row["NEW_CST_CK"];
                            $bran = $row["REG_BRANCH"];
                            $kakao_1 = $row["KAKAO_SEND_1"];
                            $kakao_2 = $row["KAKAO_SEND_2"];
                            $cash_report=$row["CASH_REPORT"];
                            $smartA=$row["SMARTA"];
                            $ht_upload=$row["HT_UPLOAD"];
                            $ht_print=$row["HT_PRINT"];
                            //$ht_down=$row["HT_DOWNLOAD"];
                            $compreg=$row["COMPREG"];
                            $taxinvoice=$row["TAXINVOICE"];
                            $consign=$row["CONSIGN"];
                            $confirm=$row["CONFIRM"];
                            $cnt_kakao_send = $row["CNT_KAKAO_SEND"];
                            $cash_style="";
                            $consign_style="";
                            $smarta_style="";
                            $upload_style="";
                            $down_style="";
                            $compreg_style="";
                            $style_new_cst ="";
                            $style_kakao_send ="";
                            $douzone_svr = $row["DOUZONE_SVR"];
                            $douzone_code = $row["DOUZONE_CODE"];
                            $FILE_CNT1=0;
                            $FILE_CNT2=0;
                            
                            
                            //$DOWN_PATH_PAY = $path.$row["CSTNAME"]."_".$row["MOBILE"]."/";
                            $DOWN_PATH_PAY = $path.$row["REG_BRANCH_PATH"]."/납부서/".$row["CSTNAME"].$row["MOBILE_PATH"]."/";
                            $DOWN_PATH_INFO = $path.$row["REG_BRANCH_PATH"]."/안내문/".$row["CSTNAME"].$row["MOBILE_PATH"]."/";
                            /*
                             $DOWN_PATH_PAY = $path_pay.$row["CSTNAME"]."_".$row["MOBILE"]."/";
                             $DOWN_PATH_INFO = $path_info.$row["CSTNAME"]."_".$row["MOBILE"]."/";
                             */
                            //$down_dir = iconv("UTF-8","EUC-KR","../tax_income/upload/".$CSTNAME."_".$MOBILE."/");
                            //$down_dir = "../tax_income/upload/".$row["CSTNAME"]."_".$row["MOBILE"]."/";
                            //$dir1 = iconv("UTF-8","CP949",$DOWN_PATH_PAY);
                            //$dir2 = iconv("UTF-8","CP949",$DOWN_PATH_INFO);
                            //if($hostname=="localhost")
                            $dir1 = $DOWN_PATH_INFO;
                            //else
                            //  $dir1 = iconv("UTF-8","CP949",$DOWN_PATH_INFO);
                            
                            //                            if($hostname=="localhost")
                            $dir2 = $DOWN_PATH_PAY;
                                //                            else
                                //                              $dir2 = iconv("UTF-8","CP949",$DOWN_PATH_PAY);
                                
                                
                                if (is_dir($dir1)){
                                    if ($dh = opendir($dir1)){                     //$df = array_diff(scandir($dir),$ignore);
                                        while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
                                            continue;
                                        }else{
                                            $FILE_CNT1++;
                                        }
                                        
                                        }
                                        closedir($dh);
                                    }
                                }
                                
                                if($FILE_CNT1 > 0){
                                    $DOWN_URL_INFO = "<a href='javascript:open_file_info(".$row["ID"].");'>안내문</a>";
                                }else{
                                    $DOWN_URL_INFO = "";
                                }
                                
                                
                                if (is_dir($dir2)){
                                    if ($dh = opendir($dir2)){                     //$df = array_diff(scandir($dir),$ignore);
                                        while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
                                            continue;
                                        }else{
                                            $FILE_CNT2++;
                                        }
                                        
                                        }
                                        closedir($dh);
                                    }
                                }
                                
                                if($FILE_CNT2 > 0){
                                    $DOWN_URL_PAY = "<a href='javascript:open_file_pay(".$row["ID"].");'>납부서</a>";
                                }else{
                                    $DOWN_URL_PAY = "";
                                }
                                
                                
                                if($cash_report=='에러')$cash_style="style='padding-left:6px;background-color:#d10000;color:white;'";
                                if($cash_report=='예약')$cash_style="style='padding-left:6px;background-color:#007cc5;color:white;'";
                                if($cash_report=='완료')$cash_style="style='padding-left:6px;background-color:green;color:white;'";
                                if($cash_report=='실행중')$cash_style="style='padding-left:6px;background-color:#c57900;color:white;'";
                                
                                if($smartA=='에러')$smarta_style="style='background-color:#d10000;color:white;'";
                                if($smartA=='예약')$smarta_style="style='background-color:#007cc5;color:white;'";
                                if($smartA=='완료')$smarta_style="style='background-color:green;color:white;'";
                                if($smartA=='실행중')$smarta_style="style='background-color:#c57900;color:white;'";
                                
                                if($ht_upload=='에러')$upload_style="style='background-color:#d10000;color:white;'";
                                if($ht_upload=='예약')$upload_style="style='background-color:#007cc5;color:white;'";
                                if($ht_upload=='완료')$upload_style="style='background-color:green;color:white;'";
                                if($ht_upload=='실행중')$upload_style="style='background-color:#c57900;color:white;'";
                                
                                if($ht_print=='에러')$print_style="style='background-color:#d10000;color:white;'";
                                if($ht_print=='예약')$print_style="style='background-color:#007cc5;color:white;'";
                                if($ht_print=='완료')$print_style="style='background-color:green;color:white;'";
                                if($ht_print=='실행중')$print_style="style='background-color:#c57900;color:white;'";
                                
                                if($cnt_kakao_send > 0) $style_kakao_send="style='background-color:green;color:white;text-align:center;padding:0;'";
                                
                                if($compreg=='에러')$compreg_style="style='background-color:#d10000;color:white;'";
                                if($compreg=='예약')$compreg_style="style='background-color:#007cc5;color:white;'";
                                if($compreg=='완료')$compreg_style="style='background-color:green;color:white;'";
                                if($compreg=='실행중')$compreg_style="style='background-color:#c57900;color:white;'";
                                
                                if($consign=='에러')$consign_style="style='background-color:#d10000;color:white;'";
                                if($consign=='예약')$consign_style="style='background-color:#007cc5;color:white;'";
                                if($consign=='완료')$consign_style="style='background-color:green;color:white;'";
                                if($consign=='실행중')$consign_style="style='background-color:#c57900;color:white;'";
                                
                                if($taxinvoice=='에러')$taxinvoice_style="style='background-color:#d10000;color:white;'";
                                if($taxinvoice=='예약')$taxinvoice_style="style='background-color:#007cc5;color:white;'";
                                if($taxinvoice=='완료')$taxinvoice_style="style='background-color:green;color:white;'";
                                if($taxinvoice=='실행중')$taxinvoice_style="style='background-color:#c57900;color:white;'";
                                
                                
                                
                                
                                if ($new_cst=="N"){
                                    $style_new_cst="background-color:#c8c8c8;";
                                }
                                
                                
                                if($style_cnt % 2 == 1 ){
                                    $style = 'style="background:#b3dac31c;"';
                                }else{
                                    $style = '';
                                }
                                $style_cnt++;
                                
                                $dir = $path.$row["CSTNAME"]."_".$row["MOBILE"]."/";
                                //$dir_ = iconv("UTF-8","CP949",$dir);
                                $LINK = '';
                                
                                if (is_dir($dir)){
                                    $LINK = '<a href="javascript:file_pop(\''.$row["ID"].'\')">첨부</a>';
                                }
                                
                                
                                $output .= '
							<tr '.$style.'>
							<td>'.$row["ID"].'</td>
							    
                            <td>
							<select style="height:35px;" id="proc_'.$row["BIZ_ID"].'" name="proc_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                                
                                $proc == "" ? $output .= '<option value="" selected>전체</option>' : $output .='<option value="">전체</option>';
                                $proc == "E7208" ? $output .= '<option value="E7208" selected>수임</option>' : $output .='<option value="E7208">수임</option>';
                                $proc == "E7210" ? $output .= '<option value="E7210" selected>동의</option>' : $output .='<option value="E7210">동의</option>';
                                $proc == "E7211" ? $output .= '<option value="E7211" selected>추출</option>' : $output .='<option value="E7211">추출</option>';
                                $proc == "E7212" ? $output .= '<option value="E7212" selected>검토</option>' : $output .='<option value="E7212">검토</option>';
                                $proc == "E7209" ? $output .= '<option value="E7209" selected>환불</option>' : $output .='<option value="E7209">환불</option>';
                                $proc == "E7214" ? $output .= '<option value="E7214" selected>작성</option>' : $output .='<option value="E7214">작성</option>';
                                $proc == "E7213" ? $output .= '<option value="E7213" selected>완료</option>' : $output .='<option value="E7213">완료</option>';
                                $proc == "E7215" ? $output .= '<option value="E7215" selected>전송</option>' : $output .='<option value="E7215">전송</option>';
                                
                                $output .='</select>
							</td>
                                    
							<td>
                                    <a href="view_inc_cst.php?id='.$row["ID"].'&listflag=acc">'.$row["CSTNAME"].'</a>
                            </td>
                            <TD><a href="javascript:fn_mod('.$row["ID"].');">수정</a></TD>
							<td>'.$row["MOBILE"].'</td>
							    
                            <td><select style="height:35px;'.$style_new_cst.'" id="new_cst_'.$row["BIZ_ID"].'" name="new_cst_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                                
                                $new_cst == "" ? $output .= '<option value="" style="background-color:white;" selected>선택</option>' : $output .='<option value="" style="background-color:white;">전체</option>';
                                $new_cst == "Y" ? $output .= '<option value="Y" style="background-color:white;"  selected>신규</option>' : $output .='<option value="Y" style="background-color:white;" >신규</option>';
                                $new_cst == "N" ? $output .= '<option value="N" style="background-color:#c8c8c8;" selected>기존</option>' : $output .= '<option value="N" style="background-color:#c8c8c8;">기존</option>';
                                
                                $output .='</select></td>
                            <td>'.$row["B_REGDATE"].'</td>
                            <td>'.$row["EST_FEE_SELF_"].'</td>
                            <td>'.$row["DEP_FEE"].'</td><td>';
                                
                                if($cash_report != ''){
                                    
                                    if($cash_report=="에러"){
                                        $output .= '<a href="javascript:cal_RPA(\'step_1\','.$row["ID"].');">요청</a></td>
                                    <td '.$cash_style.'><span data-tooltip-text="'.$row["ERROR_MSG"].'" >'.$cash_report.'</span></td>';
                                    }else{
                                        $output .= '</td><td '.$cash_style.'>'.$cash_report.'</span></td>';
                                    }
                                }else{
                                    $output .= '<a href="javascript:cal_RPA(\'step_1\','.$row["ID"].');">요청</a></td>
                                <td></td>';
                                }
                                
                                
                                if($consign != ''){
                                    $output .= '<td>';
                                    
                                    if($consign=="에러"){
                                        $output .= '<a href="javascript:cal_RPA(\'step_2\','.$row["ID"].');">요청</a></td>
                                    <td '.$consign_style.'><span data-tooltip-text="'.$row["ERROR_MSG"].'" >'.$consign.'</span></td>';
                                    }else{
                                        $output .= '</td><td '.$consign_style.'>'.$consign.'</span></td>';
                                    }
                                }else{
                                    $output .= '<td><a href="javascript:cal_RPA(\'step_2\','.$row["ID"].');">요청</a></td>
                                <td></td>';
                                }
                                
                                
                                
                                if($ht_print != ''){
                                    $output .= '<td>';
                                    if($ht_print=="에러"){
                                        $output .= '<a href="javascript:cal_RPA(\'step_6\','.$row["ID"].');">요청</a></td>
                                    <td '.$print_style.'><span data-tooltip-text="'.$row["ERROR_MSG"].'" >'.$ht_print.'</span></td>';
                                    }else{
                                        $output .= '</td><td '.$print_style.'>'.$ht_print.'</span></td>';
                                    }
                                }else{
                                    $output .= '<td><a href="javascript:cal_RPA(\'step_6\','.$row["ID"].');">요청</a></td>
                                <td></td>';
                                }
                                
                                $output .= '<td '.$down_style.'>'.$DOWN_URL_INFO.'</td>';
                                $output .= '<td>확인</td>';
                                
                                if($compreg != ''){
                                    $output .= '<td>';
                                    if($compreg=="에러"){
                                        $output .= '<a href="javascript:cal_RPA(\'step_3\','.$row["ID"].');">요청</a></td>
                                    <td '.$compreg_style.'><span data-tooltip-text="'.$row["ERROR_MSG"].'" >'.$compreg.'</span></td>';
                                    }else{
                                        $output .= '</td><td '.$compreg_style.'>'.$compreg.'</span></td>';
                                    }
                                }else{
                                    $output .= '<td><a href="javascript:cal_RPA(\'step_3\','.$row["ID"].');">요청</a></td>
                                <td></td>';
                                }
                                
                                $output .= '<td>
		                    <select style="height:35px;" id="bran_'.$row["BIZ_ID"].'" name="bran_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                                
                                $bran == "" ? $output .= '<option value="" selected></option>' : $output .='<option value=""></option>';
                                $bran == "D1019" ? $output .= '<option value="D1019" selected>세무톡</option>' : $output .='<option value="D1019">세무톡</option>';
                                $bran == "D1003" ? $output .= '<option value="D1003" selected>강남</option>' : $output .= '<option value="D1003">강남</option>';
                                $bran == "D1002" ? $output .= '<option value="D1002" selected>회계본부</option>' : $output .='<option value="D1002">회계본부</option>';
                                $bran == "D1014" ? $output .= '<option value="D1014" selected>영업본부</option>' : $output .='<option value="D1014">영업본부</option>';
                                $bran == "D1013" ? $output .= '<option value="D1013" selected>세무본부</option>' : $output .='<option value="D1013">세무본부</option>';
                                $bran == "D1004" ? $output .= '<option value="D1004" selected>용인</option>' : $output .='<option value="D1004">용인</option>';
                                $bran == "D1006" ? $output .= '<option value="D1006" selected>안양</option>' : $output .='<option value="D1006">안양</option>';
                                $bran == "D1007" ? $output .= '<option value="D1007" selected>수원</option>' : $output .='<option value="D1007">수원</option>';
                                $bran == "D1008" ? $output .= '<option value="D1008" selected>일산</option>' : $output .='<option value="D1008">일산</option>';
                                $bran == "D1009" ? $output .= '<option value="D1009" selected>부천</option>' : $output .='<option value="D1009">부천</option>';
                                $bran == "D1010" ? $output .= '<option value="D1010" selected>광주</option>' : $output .='<option value="D1010">광주</option>';
                                $bran == "D1011" ? $output .= '<option value="D1011" selected>분당</option>' : $output .='<option value="D1011">분당</option>';
                                $bran == "D1012" ? $output .= '<option value="D1012" selected>기흥</option>' : $output .='<option value="D1012">기흥</option>';
                                $bran == "D1021" ? $output .= '<option value="D1021" selected>동탄</option>' : $output .='<option value="D1021">동탄</option>';
                                
                                $output .='</select>
							</td>
                                    
							<td>
							<select style="height:35px;" id="reguser_'.$row["BIZ_ID"].'" name="reguser_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                                
                                if($bran == "D1019"){
                                    $reguser == "" ? $output .= '<option value="" selected></option>' : $output .='<option value=""></option>';
                                    $reguser == "1231" ? $output .= '<option value="1231" selected>신승01</option>' : $output .='<option value="1231">신승01</option>';
                                    $reguser == "1232" ? $output .= '<option value="1232" selected>신승02</option>' : $output .='<option value="1232">신승02</option>';
                                    $reguser == "1233" ? $output .= '<option value="1233" selected>신승03</option>' : $output .='<option value="1233">신승03</option>';
                                    $reguser == "1234" ? $output .= '<option value="1234" selected>신승04</option>' : $output .='<option value="1234">신승04</option>';
                                    $reguser == "1235" ? $output .= '<option value="1235" selected>신승05</option>' : $output .='<option value="1235">신승05</option>';
                                    $reguser == "1236" ? $output .= '<option value="1236" selected>신승06</option>' : $output .='<option value="1236">신승06</option>';
                                    $reguser == "1237" ? $output .= '<option value="1237" selected>신승07</option>' : $output .='<option value="1237">신승07</option>';
                                    $reguser == "1238" ? $output .= '<option value="1238" selected>신승08</option>' : $output .='<option value="1238">신승08</option>';
                                    $reguser == "1239" ? $output .= '<option value="1239" selected>신승09</option>' : $output .='<option value="1239">신승09</option>';
                                    $reguser == "1240" ? $output .= '<option value="1240" selected>신승10</option>' : $output .='<option value="1240">신승10</option>';
                                }elseif ($bran=="D1003"){
                                    $reguser == "1117" ? $output .= '<option value="1117" selected>마희숙</option>' : $output .='<option value="1117">마희숙</option>';
                                    $reguser == "1131" ? $output .= '<option value="1131" selected>한예주</option>' : $output .='<option value="1131">한예주</option>';
                                    $reguser == "1132" ? $output .= '<option value="1132" selected>김지윤</option>' : $output .='<option value="1132">김지윤</option>';
                                    $reguser == "1134" ? $output .= '<option value="1134" selected>용아름</option>' : $output .='<option value="1134">용아름</option>';
                                    $reguser == "1256" ? $output .= '<option value="1256" selected>김예빈</option>' : $output .='<option value="1256">김예빈</option>';
                                    $reguser == "1241" ? $output .= '<option value="1241" selected>강남1</option>' : $output .='<option value="1241">강남1</option>';
                                    $reguser == "1242" ? $output .= '<option value="1242" selected>강남2</option>' : $output .='<option value="1242">강남2</option>';
                                    $reguser == "1243" ? $output .= '<option value="1243" selected>강남3</option>' : $output .='<option value="1243">강남3</option>';
                                    $reguser == "1244" ? $output .= '<option value="1244" selected>강남4</option>' : $output .='<option value="1244">강남4</option>';
                                    $reguser == "1245" ? $output .= '<option value="1245" selected>강남5</option>' : $output .='<option value="1245">강남5</option>';
                                    $reguser == "1246" ? $output .= '<option value="1246" selected>강남6</option>' : $output .='<option value="1246">강남6</option>';
                                    $reguser == "1247" ? $output .= '<option value="1247" selected>강남7</option>' : $output .='<option value="1247">강남7</option>';
                                }elseif ($bran=="D1002"){
                                    $reguser == "1148" ? $output .= '<option value="1148" selected>김용덕</option>' : $output .='<option value="1148">김용덕</option>';
                                    $reguser == "1133" ? $output .= '<option value="1133" selected>이정희</option>' : $output .='<option value="1133">이정희</option>';
                                    $reguser == "1154" ? $output .= '<option value="1154" selected>김혜선</option>' : $output .='<option value="1154">김혜선</option>';
                                    $reguser == "1248" ? $output .= '<option value="1248" selected>강설옥</option>' : $output .='<option value="1248">강설옥</option>';
                                }elseif ($bran=="D1014"){
                                    $reguser == "1147" ? $output .= '<option value="1147" selected>노준석</option>' : $output .='<option value="1147">노준석</option>';
                                    $reguser == "1148" ? $output .= '<option value="1148" selected>이정민</option>' : $output .='<option value="1148">이정민</option>';
                                    $reguser == "1149" ? $output .= '<option value="1149" selected>윤형덕</option>' : $output .='<option value="1149">윤형덕</option>';
                                    $reguser == "1227" ? $output .= '<option value="1227" selected>김선진</option>' : $output .='<option value="1227">김선진</option>';
                                }elseif ($bran=="D1013"){
                                    $reguser == "1226" ? $output .= '<option value="1226" selected>김민</option>' : $output .='<option value="1226">김민</option>';
                                    $reguser == "1228" ? $output .= '<option value="1228" selected>김규리</option>' : $output .='<option value="1228">김규리</option>';
                                    $reguser == "1249" ? $output .= '<option value="1249" selected>홍건호</option>' : $output .='<option value="1249">홍건호</option>';
                                    $reguser == "1121" ? $output .= '<option value="1121" selected>최기정</option>' : $output .='<option value="1121">최기정</option>';
                                    $reguser == "1220" ? $output .= '<option value="1220" selected>이명진</option>' : $output .='<option value="1220">이명진</option>';
                                    $reguser == "1153" ? $output .= '<option value="1153" selected>김진규</option>' : $output .='<option value="1153">김진규</option>';
                                    $reguser == "1163" ? $output .= '<option value="1163" selected>한성민</option>' : $output .='<option value="1163">한성민</option>';
                                    $reguser == "1164" ? $output .= '<option value="1164" selected>한은진</option>' : $output .='<option value="1164">한은진</option>';
                                }elseif ($bran=="D1004"){
                                    $reguser == "1119" ? $output .= '<option value="1119" selected>오선미</option>' : $output .='<option value="1119">오선미</option>';
                                    $reguser == "1135" ? $output .= '<option value="1135" selected>노윤솔</option>' : $output .='<option value="1135">노윤솔</option>';
                                    $reguser == "1250" ? $output .= '<option value="1250" selected>김정아</option>' : $output .='<option value="1250">김정아</option>';
                                }elseif ($bran=="D1006"){
                                    $reguser == "1136" ? $output .= '<option value="1136" selected>김은정</option>' : $output .='<option value="1136">김은정</option>';
                                    $reguser == "1160" ? $output .= '<option value="1160" selected>박기령</option>' : $output .='<option value="1160">박기령</option>';
                                    $reguser == "1161" ? $output .= '<option value="1161" selected>김지영</option>' : $output .='<option value="1161">김지영</option>';
                                    $reguser == "1166" ? $output .= '<option value="1166" selected>안덕현</option>' : $output .='<option value="1166">안덕현</option>';
                                }elseif ($bran=="D1007"){
                                    $reguser == "1116" ? $output .= '<option value="1116" selected>오미자</option>' : $output .='<option value="1116">오미자</option>';
                                    $reguser == "1257" ? $output .= '<option value="1257" selected>김세화</option>' : $output .='<option value="1257">김세화</option>';
                                    $reguser == "1251" ? $output .= '<option value="1251" selected>한지은</option>' : $output .='<option value="1251">한지은</option>';
                                }elseif ($bran=="D1008"){
                                    $reguser == "1120" ? $output .= '<option value="1120" selected>이찬희</option>' : $output .='<option value="1120">이찬희</option>';
                                    $reguser == "1140" ? $output .= '<option value="1140" selected>김세아</option>' : $output .='<option value="1140">김세아</option>';
                                    $reguser == "1141" ? $output .= '<option value="1141" selected>강정민</option>' : $output .='<option value="1141">강정민</option>';
                                    $reguser == "1252" ? $output .= '<option value="1252" selected>김미경</option>' : $output .='<option value="1252">김미경</option>';
                                }elseif ($bran=="D1009"){
                                    $reguser == "1118" ? $output .= '<option value="1118" selected>신정희</option>' : $output .='<option value="1118">신정희</option>';
                                    $reguser == "1142" ? $output .= '<option value="1142" selected>양은경</option>' : $output .='<option value="1142">양은경</option>';
                                    $reguser == "1253" ? $output .= '<option value="1253" selected>신솔빈</option>' : $output .='<option value="1253">신솔빈</option>';
                                    $reguser == "1155" ? $output .= '<option value="1155" selected>장민경</option>' : $output .='<option value="1155">장민경</option>';
                                }elseif ($bran=="D1010"){
                                    $reguser == "1113" ? $output .= '<option value="1113" selected>이해옥</option>' : $output .='<option value="1113">이해옥</option>';
                                    $reguser == "1144" ? $output .= '<option value="1144" selected>박혜진</option>' : $output .='<option value="1144">박혜진</option>';
                                    $reguser == "1143" ? $output .= '<option value="1143" selected>염해림</option>' : $output .='<option value="1143">염해림</option>';
                                }elseif ($bran=="D1011"){
                                    $reguser == "1113" ? $output .= '<option value="1113" selected>이해옥</option>' : $output .='<option value="1113">이해옥</option>';
                                    $reguser == "1158" ? $output .= '<option value="1158" selected>유수현</option>' : $output .='<option value="1158">유수현</option>';
                                    $reguser == "1145" ? $output .= '<option value="1145" selected>한세빈</option>' : $output .='<option value="1145">한세빈</option>';
                                }elseif ($bran=="D1012"){
                                    $reguser == "1115" ? $output .= '<option value="1115" selected>한영순</option>' : $output .='<option value="1115">한영순</option>';
                                    $reguser == "1165" ? $output .= '<option value="1165" selected>강지혜</option>' : $output .='<option value="1165">강지혜</option>';
                                    $reguser == "1255" ? $output .= '<option value="1255" selected>임봉규</option>' : $output .='<option value="1255">임봉규</option>';
                                    $reguser == "1254" ? $output .= '<option value="1254" selected>한유정</option>' : $output .='<option value="1254">한유정</option>';
                                }elseif ($bran=="D1021"){
                                    $reguser == "1114" ? $output .= '<option value="1114" selected>정혜숙</option>' : $output .='<option value="1115">정혜숙</option>';
                                    $reguser == "1116" ? $output .= '<option value="1116" selected>오미자</option>' : $output .='<option value="1116">오미자</option>';
                                }else{
                                    $reguser == "" ? $output .= '<option value="" selected></option>' : $output .='<option value=""></option>';
                                }
                                $output .='</select>
							</td>
<td>'.$douzone_svr.'</td>
<td>'.$douzone_code.'</td>';
                                
                                if($smartA != ''){
                                    $output .= '<td>';
                                    if($smartA=="에러"){
                                        $output .= '<a href="javascript:cal_RPA(\'step_4\','.$row["ID"].');">요청</a></td>
                                    <td '.$smarta_style.'><span data-tooltip-text="'.$row["ERROR_MSG"].'" >'.$smartA.'</span></td>';
                                    }elseif($smartA=="완료"){
                                        $output .= '<a href="javascript:cal_RPA(\'step_4\','.$row["ID"].');">재요청</a></td>
                                    <td '.$smarta_style.'>'.$smartA.'</td>';
                                    }else{
                                        $output .= '</td><td '.$smarta_style.'>'.$smartA.'</span></td>';
                                    }
                                }else{
                                    $output .= '<td><a href="javascript:cal_RPA(\'step_4\','.$row["ID"].');">요청</a></td>
                                <td></td>';
                                }
                                
                                if($ht_upload != ''){
                                    $output .= '<td>';
                                    if($ht_upload=="에러"){
                                        $output .= '<a href="javascript:cal_RPA(\'step_5\','.$row["ID"].');">요청</a></td>
                                    <td '.$upload_style.'><span data-tooltip-text="'.$row["ERROR_MSG"].'" >'.$ht_upload.'</span></td>';
                                    }elseif($ht_upload=="완료"){
                                        $output .= '<a href="javascript:cal_RPA(\'step_5\','.$row["ID"].');">재요청</a></td>
                                    <td '.$upload_style.'>'.$ht_upload.'</td>';
                                    }else{
                                        $output .= '</td><td '.$upload_style.'>'.$ht_upload.'</span></td>';
                                    }
                                    
                                }else{
                                    $output .= '<td><a href="javascript:cal_RPA(\'step_5\','.$row["ID"].');">요청</a></td>
                                <td></td>';
                                }
                                
                                $output .= '<td>'.$DOWN_URL_PAY.'</td>';
                                if($ht_upload == '완료'){
                                    if($row["RP_SEND_KAKAO"] == 'Y')
                                        $output .='<td style="background-color:#ffdc40;text-align:center;padding:0;">발송<br>대기</td>';
                                        else
                                            $output .='<td style="text-align:center;padding:0;"><a href="javascript:rp_kakao_send('.$row["BIZ_ID"].')">발송</a></td>';
                                }else{
                                    $output .='<td></td>';
                                }
                                if($cnt_kakao_send>0){
                                    $output .='<td '.$style_kakao_send.'>완료<br>('.$cnt_kakao_send.'건)</td>';
                                }else{
                                    $output .='<td></td>';
                                }
                                //$output .='</td>';
                                
                                
                                If($confirm=="E5102"){
                                    $style_green="background-color:green;color:white;";
                                }else{
                                    $style_green="";
                                }
                                
                                $output .= '<td style=" '.$style_green.' "><select style="height:35px;'.$style_green.'" id="confirm_'.$row["BIZ_ID"].'" name="confirm_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                                $confirm == "" ? $output .= '<option value="" selected>선택</option>' : $output .='<option value="">선택</option>';
                                $confirm== "E5101" ? $output .= '<option value="E5101" selected>미결</option>' : $output .='<option value="E5101">미결</option>';
                                $confirm == "E5102" ? $output .= '<option value="E5102" selected>결재</option>' : $output .= '<option value="E5102">결재</option>';
                                $confirm == "E5103" ? $output .= '<option value="E5103" selected>검토</option>' : $output .= '<option value="E5103">검토</option>';
                                $confirm == "E5104" ? $output .= '<option value="E5104" selected>반려</option>' : $output .= '<option value="E5104">반려</option>';
                                
                                $output .= '</td><TD><DIV id="memo_lbl_'.$row["ID"].'" style="width:200px;height:28px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.mb_strimwidth($row['MEMO'],'0','40','...','utf-8').'</DIV><input style="width:200px; height:28px;display:none;" type="text" id="memo_ip_'.$row["ID"].'" value="'.$row['MEMO'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)memo_submit(this);" ></input></TD>';
                                
                        }  // if($cst_type == "종합소득세") 끝
                    }
                }// 네번째 if문 끝
                else
                {
                    $output .= '
					<tr>
					<td colspan="20" align="center">데이터가 없습니다.</td>
					</tr>
					';
                }
                
                echo $head.$output;
                
            }// 세번째 if문 끝
        } // 두번째 if 문 끝
    }//첫번째 if문 끝!
    
}




/*종합소득세 접수현황 select : 시작*/
if($action == "select_list_simple"){
    
    //ajax로 넘긴 데이터 값은 "select"
    //값이 존재하면 true를 리턴
    $cst_type = $_POST["cst_type"];
    $g_option = $_POST["g_option"];
    $b_option = $_POST["b_option"];
    $s_str = $_POST["s_str"];
    $footer="";
    
    $query_str1 = "";
    $query_str2 = "";
    $query_desc = " ORDER BY  B.BIZ_ID DESC";
    
    $page = $_POST["page"];
    
    $page_set = 100; // 한페이지 줄수
    $block_set = 5; // 한페이지 블럭수
    
    
    if($s_str !=""){
        switch($g_option){
            case "CSTID" :
                $query_str1 .= " AND A.CSTID like '%".$s_str."%' ";
                break;
            case "CSTNAME" :
                $query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
                break;
            case "MOBILE" :
                $query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
                break;
            case "RESI" :
                $query_str1 .= " AND A.RESIDENT_ID like '%".$s_str."%' ";
                break;
            case "REGUSER" :
                $query_str1 .= " AND D.USERNAME like '%".$s_str."%' ";
                break;
            case "MEMO" :
                $query_str1 .= " AND B.MEMO like '%".$s_str."%' ";
                break;
            default:
                $query_str1 .="";
        }
    }
    
    
    if($b_option != ""){
        $query_str2 .= " AND REG_BRANCH = '".$b_option."' ";
    }
    
    $query = "SELECT count(1) as total FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
	LEFT OUTER JOIN TB300031 AS E ON A.CSTID=E.CSTID
 WHERE B.CST_TYPE = 'A1001' ".$query_str1.$query_str2;
    
    $result = mysqli_query($connect,$query);
    
    if($result)
    {
        $total = $row["total"]; // 전체글수
    }
    $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
    $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
    
    if (!$page) $page = 1; // 현재페이지(넘어온값)
    $block = ceil ($page / $block_set); // 현재블럭(올림함수)
    $limit_idx = ($page - 1) * $page_set; // limit시작위치
    
    
    /*담당자설정*/
    $query_owner = "SELECT * FROM TB980010 WHERE DEC_ID = 'D2200';";
    $result_owner = mysqli_query($connect,$query_owner) or die(mysqli_error($connect));
    $output_owner .= '
	';
    
    if(mysqli_num_rows($result_owner) >0)
    {
        while($row_owner = mysqli_fetch_array($result_owner)){
            $output_owner.= '<option value="'.$row_owner["USERID"].'">'.$row_owner["USERNAME"].'</option>';
        }
    }
    $output_owner.= '</select>';
    /*담당자설정*/
    
        $head .= '
		<colgroup>
		<col width="50px">
		<col width="70px">
		<col width="130px">
		<col width="120px">
        <col width="50px">		
        <col width="50px">
		<col width="50px">
		<col width="30px">
		<col width="120px">
        <col width="80px">
		<col width="50px">
		<col width="80px">
		<col width="70px">
		<col width="60px">
		<col width="50px">
		<col width="30px">
		<col width="150px">
		<col width="70px">
        <col width="80px">
        <col width="150px">
		</colgroup>
		<thead>
		<tr>
			<th>ID</th>
			<th>진행상태</th>
			<th>이름</th>
			<th>핸드폰번호</th>
            <th>신규여부</th>
			<th>안내문</th>
			<th colspan=2>수동톡1</th>
            <th>매출계</th>
			<th colspan=2>예상세액</th>
			<th>예상수수료</th>
			<th>입금확인</th>
			<th>자동톡1</th>
			<th colspan=2>수동톡2</th>
			<th>등록일</th>
			<th>지점</th>
			<th>상담자</th>
			<th>메모</th>
		</tr>
		</thead>
		';
        
    
    if(isset($_POST["action"]))
    {
        //users테이블 조회 프로시져를 만든다.
        $procedure = "
	CREATE PROCEDURE SELECT_TB100020()
	BEGIN
	SELECT  
    A.CSTID AS 'ID',
    B.BIZ_ID,
    CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
    B.REGDATE,	
    DATE_FORMAT(B.REGDATE, '%y-%m-%d') 'REGDATE_',
	A.CSTNAME,
	A.MOBILE,
	B.COMP_NAME,
	B.EXP_PAY_TAX,
    FORMAT(B.EXP_PAY_TAX,0) AS EXP_PAY_TAX_ ,
    B.EST_FEE,
	FORMAT(B.EST_FEE,0) AS EST_FEE_ ,
	FORMAT(B.DEP_FEE,0) AS DEP_FEE,
	B.DEP_TYPE,
	B.ACC_FLAG,
	B.DEADLINE_DATE,
	DATE_FORMAT(B.DEADLINE_DATE, '%y-%m-%d') 'DEADLINE_DATE_',
	B.PAY_TAX,
	B.NUM_E_REPORT,
	B.REPORT_NUM_INCOME,
	B.REPORT_NUM_WETAX,
	B.DEL_DATE_PAYMENT,
	DATE_FORMAT(B.DEL_DATE_PAYMENT, '%y-%m-%d') 'DEL_DATE_PAYMENT_',
	B.DEL_TYPE_PAYMENT,
	B.DEC_REGUSER,
	B.MEMO,
	B.OVER_FLAG,
	B.CST_TYPE,
	B.TAX_TYPE,
	B.INF_CHANNEL,
	B.INF_PATH,
	B.INF_GEAR,
	B.KEYWORD,
	B.REG_BRANCH,
	B.ACC_PATH,
	B.REC_PERSON,
	B.REGUSER,
	B.SALES_REP,
	A.KAKAO_REG,
	C.DIS_DATE,
	C.DIS_REASON,
	A.HomeTaxID,
	A.HomeTaxPW,
    B.SUBM_DATE,
    DATE_FORMAT(B.SUBM_DATE, '%y-%m-%d') 'SUBM_DATE_',
    B.SUBM_DATE2,
    DATE_FORMAT(B.SUBM_DATE2, '%y-%m-%d') 'SUBM_DATE2_',
	C.DOUZONE_SVR,
	C.DOUZONE_CODE,
	A.RESIDENT_ID,
	C.BIZ_NUM,
	C.BIZ_FORM,
	C.BIZ_CATE,
	A.SECTOR_CODE,
	C.OPENING_DAY,
	DATE_FORMAT(C.OPENING_DAY, '%y-%m-%d') 'OPENING_DAY_',
	C.CLOSE_DAY,
	DATE_FORMAT(C.CLOSE_DAY, '%y-%m-%d') 'CLOSE_DAY_',
	C.COMP_PHONE,
	C.ADDRESS_LEGAL,
	A.EMAIL,
	SELECT_CODE_VALUE_YEAR(A.CSTID,2) AS 'YEAR-1',
	SELECT_CODE_VALUE_YEAR(A.CSTID,3) AS 'YEAR-2',
	SELECT_CODE_VALUE_YEAR(A.CSTID,4) AS 'YEAR-3',
	B.INCOME_TAX,
	B.JIBANG_TAX,
	B.VAT_TAX,
	B.CASH_REC,
	A.REF_BANK,
	A.REF_ACC,
	A.ACC_HOLDER,
	B.REC_PERSON_PHONE,
    D.USERNAME AS 'DEC_REGUSER_',
    B.ACC_CHECK,
    B.CONFIRM_YN,
    B.SUBM,
    B.IMP_LEVEL,
    SELECT_PROGRESS(B.BIZ_ID) AS PROGRESS,
    ACC_CK(A.CSTID,A.CSTNAME, B.EST_FEE) AS ACC_CK,
     FORMAT(ADD_AMOUNT_PAID(A.CSTID),0) AS AMOUNT_PAID_,
    SELECT_AMOUNTPAID_FAST(A.CSTID) AS AMOUNT_PAID_2,
    substring( REPLACE(A.MOBILE,'-',''),4) MOBILE_PATH,
    #FORMAT(CAL_INC(A.CSTID),0) AS 'EXP_PAY_TAX_FN',     
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP01') AS 'KAKAO_SEND_1',
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP02') AS 'KAKAO_SEND_2',
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'AUTO_STEP01') AS 'KAKAO_SEND_AUTO1',
    #CAL_FEE_CHANGE_DATE(A.CSTID) AS 'CAL_EST_FEE_FN',
    #CAL_FEE_MONEY(E.AMOUNT_PAID) AS 'CAL_EST_FEE_FN2',
    B.EST_FEE_SELF,
    FORMAT(B.EST_FEE_SELF,0) AS 'EST_FEE_SELF',
    B.EXP_PAY_TAX_SELF,
    FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF_ ,
    NEW_CST_CK(A.CSTID) AS 'NEW_CST_CK'
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER            
    LEFT OUTER JOIN TB100032 AS E ON A.CSTID = E.CSTID          
	WHERE B.INF_PATH ='종소톡' AND B.CST_TYPE = '".$cst_type."' ".$query_str1.$query_str2.$query_desc.
	" LIMIT $limit_idx, $page_set
	;
	END;
	";
        
        $hostname=$_SERVER["HTTP_HOST"];
        //기존에 프로시져가 존재한다면 지운다.
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100020"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_TB100020()";
                
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                $result = mysqli_query($connect,$query1);
                
                
                if($result)
                {
                    
                    $cate_name="";
                    $path = "upload_income/2021/";
                    
                    while($row = mysqli_fetch_array($result)){
                        
                        if($cst_type == "A1001"){
                            $proc = $row["PROGRESS"] ;
                            $level = $row["IMP_LEVEL"] ;
                            $acc_ck= $row["ACC_CK"] ;
                            $bran= $row["REG_BRANCH"] ;
                            $reguser= $row["DEC_REGUSER"] ;
                            $kakao_1 = $row["KAKAO_SEND_1"];
                            $kakao_2 = $row["KAKAO_SEND_2"];
                            $kakao_auto1 = $row["KAKAO_SEND_AUTO1"];
                            $amt_paid1 = $row["AMOUNT_PAID_"];
                            $amt_paid2 = $row["AMOUNT_PAID_2"];
                            $est_paid =  $row["EST_FEE_SELF_"];
                            $new_cst =  $row["NEW_CST_CK"];
                            //$est_fee2 =  $row["EST_FEE_FN2"];
                            $amt_paid = "";
                            $est_paid = "";
                            $acc_style="";
                            
                            
                            if ($new_cst=="N"){
                                $style_new_cst="background-color:#c8c8c8;";
                            }
                            
                            if( ($amt_paid1 == null || $amt_paid1=="") && ($amt_paid2 != ""|| $amt_paid2!=null)){
                                $amt_paid = $amt_paid2;
                            }else{
                                $amt_paid = $amt_paid1;
                            }
                            /*
                            if( ($est_fee1 == null || $est_fee1=="") && ($est_fee2 != ""|| $est_fee2!=null)){
                                $est_paid = $est_fee2;
                            }else{
                                $est_paid = $est_fee1;
                            }
                            */
                            
                            if($style_cnt % 2 == 1 ){
                                $style = 'style="background:#b3dac31c;"';
                            }else{
                                $style = '';
                            }
                            $style_cnt++;
                            
                                                        
                            if($acc_ck == 'Y'){
                                $acc_style="background-color:#b7f337;";
                            }else{
                                $acc_style="";
                            }
                            
                            
                            //CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
                            $FILE_CNT2=0;
                            $DOWN_PATH_INFO = $path.$row["REG_BRANCH_PATH"]."/안내문/".$row["CSTNAME"]."".$row["MOBILE_PATH"]."/";
                            
                            if($hostname=="localhost")
                                $dir2 = $DOWN_PATH_INFO;
                            else
                                $dir2 = iconv("UTF-8","CP949",$DOWN_PATH_INFO);
                                
                            //$dir2 = iconv("UTF-8","CP949",$DOWN_PATH_INFO);
                            
                            
                            if (is_dir($dir2)){
                                if ($dh = opendir($dir2)){                     //$df = array_diff(scandir($dir),$ignore);
                                    while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
                                        continue;
                                    }else{
                                        $FILE_CNT2++;
                                    }
                                    
                                    }
                                    closedir($dh);
                                }
                            }
                            
                            if($FILE_CNT2 > 0){
                                $DOWN_URL_INFO = "<a href='javascript:open_file_info(".$row["ID"].");'>확인</a>";
                            }else{
                                $DOWN_URL_INFO = "";
                            }
                            
                            
                            
                            
                            
                            
                            $output .= '
							<tr '.$style.'>
							<td>'.$row["ID"].'</td>
                            
                            <td>
							<select style="height:35px;" id="proc_'.$row["BIZ_ID"].'" name="proc_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $proc == "" ? $output .= '<option value="" selected>전체</option>' : $output .='<option value="">전체</option>';
                            $proc == "E7201" ? $output .= '<option value="E7201" selected>등록</option>' : $output .='<option value="E7201">등록</option>';
                            $proc == "E7202" ? $output .= '<option value="E7202" selected>계산</option>' : $output .= '<option value="E7202">계산</option>';
                            $proc == "E7203" ? $output .= '<option value="E7203" selected>검토</option>' : $output .='<option value="E7203">검토</option>';
                            $proc == "E7204" ? $output .= '<option value="E7204" selected>부재</option>' : $output .='<option value="E7204">부재</option>';
                            $proc == "E7205" ? $output .= '<option value="E7205" selected>불가</option>' : $output .='<option value="E7205">불가</option>';
                            $proc == "E7206" ? $output .= '<option value="E7206" selected>의뢰</option>' : $output .='<option value="E7206">의뢰</option>';
                            $proc == "E7207" ? $output .= '<option value="E7207" selected>유력</option>' : $output .='<option value="E7207">유력</option>';
                            $proc == "E7208" ? $output .= '<option value="E7208" selected>수임</option>' : $output .='<option value="E7208">수임</option>';
                            $proc == "E7209" ? $output .= '<option value="E7209" selected>환불</option>' : $output .='<option value="E7209">환불</option>';
                            
                            $output .='</select>
							</td>

							<td>
                                    <a href="view_inc_cst.php?id='.$row["ID"].'&listflag=simple">'.$row["CSTNAME"].'</a>
                            </td>
							<td>'.$row["MOBILE"].'</td>
                            <td><select style="height:35px;'.$style_new_cst.'" id="new_cst_'.$row["ID"].'" name="new_cst_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $new_cst == "" ? $output .= '<option value="" style="background-color:white;" selected>선택</option>' : $output .='<option value="" style="background-color:white;">전체</option>';
                            $new_cst == "Y" ? $output .= '<option value="Y" style="background-color:white;"  selected>신규</option>' : $output .='<option value="Y" style="background-color:white;" >신규</option>';
                            $new_cst == "N" ? $output .= '<option value="N" style="background-color:#c8c8c8;" selected>기존</option>' : $output .= '<option value="N" style="background-color:#c8c8c8;">기존</option>';
                            
                            $output .='</select></td>
                            <td>'.$DOWN_URL_INFO.'</td><TD>';
                            $kakao_1 == 0 ?$output.='<a href="javascript:send_kakao(\'self_1\',\''.$row["ID"].'\',\''.$row["BIZ_ID"].'\' ,\''.$row["CSTNAME"].'\');">발송</a>' : $output.='발송';
                            $output.='<td>'.$kakao_1.'</td>
                            <td>'.$amt_paid.'</td>
                            <td>'.$row["EXP_PAY_TAX_SELF_"].'</td>
                            <td><a href="javascript:open_cal(\''.$row["ID"].'\');">계산</a></td>
                            <td>'.$est_paid.'</td>
                            <td>
							<select style="height:35px;'.$acc_style.'" id="accck_'.$row["BIZ_ID"].'" name="accck_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $acc_ck == "" ? $output .= '<option value="" selected>선택</option>' : $output .='<option value="">선택</option>';
                            $acc_ck == "Y" ? $output .= '<option value="Y" selected>완납</option>' : $output .='<option value="Y">완납</option>';
                            $acc_ck == "N" ? $output .= '<option value="N" selected>미납</option>' : $output .= '<option value="N">미납</option>';
                            $acc_ck == "R" ? $output .= '<option value="R" selected>환불</option>' : $output .= '<option value="R">환불</option>';
                            
                            $output .='</select>
							</td><td style="margin: auto; text-align: center;">'.$kakao_auto1.'</td>
                            <TD style="margin: auto; text-align: center;">';
                            $kakao_2 == 0 ?$output.='<a href="javascript:send_kakao(\'self_2\',\''.$row["ID"].'\',\''.$row["BIZ_ID"].'\' ,\''.$row["CSTNAME"].'\');">발송</a>' : $output.='발송';
                            $output.='<td style="margin: auto; text-align: center;">'.$kakao_2.'
                            </td>
							<td>'.$row["REGDATE"].'</td>
                            

                            <td>
							<select style="height:35px;" id="bran_'.$row["BIZ_ID"].'" name="bran_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                            
                            $bran == "" ? $output .= '<option value="" selected>선택</option>' : $output .='<option value="">선택</option>';
                            $bran == "D1019" ? $output .= '<option value="D1019" selected>세무톡</option>' : $output .='<option value="D1019">세무톡</option>';
                            $bran == "D1003" ? $output .= '<option value="D1003" selected>강남</option>' : $output .= '<option value="D1003">강남</option>';
                            $bran == "D1004" ? $output .= '<option value="D1004" selected>용인</option>' : $output .='<option value="D1004">용인</option>';
                            $bran == "D1006" ? $output .= '<option value="D1006" selected>안양</option>' : $output .='<option value="D1006">안양</option>';
                            $bran == "D1007" ? $output .= '<option value="D1007" selected>수원</option>' : $output .='<option value="D1007">수원</option>';
                            $bran == "D1008" ? $output .= '<option value="D1008" selected>일산</option>' : $output .='<option value="D1008">일산</option>';
                            $bran == "D1009" ? $output .= '<option value="D1009" selected>부천</option>' : $output .='<option value="D1009">부천</option>';
                            $bran == "D1010" ? $output .= '<option value="D1010" selected>광주</option>' : $output .='<option value="D1010">광주</option>';
                            $bran == "D1011" ? $output .= '<option value="D1011" selected>분당</option>' : $output .='<option value="D1011">분당</option>';
                            $bran == "D1012" ? $output .= '<option value="D1012" selected>기흥</option>' : $output .='<option value="D1012">기흥</option>';
                            $bran == "D1013" ? $output .= '<option value="D1013" selected>세무</option>' : $output .='<option value="D1013">세무</option>';
                            $bran == "D1021" ? $output .= '<option value="D1021" selected>동탄</option>' : $output .='<option value="D1021">동탄</option>';
                            
                            
                            $output .='</select>
							</td>
							
							<td>
							<select style="height:35px;" id="reguser_'.$row["BIZ_ID"].'" name="reguser_'.$row["BIZ_ID"].'" onchange="javascript:modify_option(this);">';
                            
                            if($bran == "D1019"){
                                $reguser == "" ? $output .= '<option value="" selected></option>' : $output .='<option value=""></option>';
                                $reguser == "1231" ? $output .= '<option value="1231" selected>신승01</option>' : $output .='<option value="1231">신승01</option>';
                                $reguser == "1232" ? $output .= '<option value="1232" selected>신승02</option>' : $output .='<option value="1232">신승02</option>';
                                $reguser == "1233" ? $output .= '<option value="1233" selected>신승03</option>' : $output .='<option value="1233">신승03</option>';
                                $reguser == "1234" ? $output .= '<option value="1234" selected>신승04</option>' : $output .='<option value="1234">신승04</option>';
                                $reguser == "1235" ? $output .= '<option value="1235" selected>신승05</option>' : $output .='<option value="1235">신승05</option>';
                                $reguser == "1236" ? $output .= '<option value="1236" selected>신승06</option>' : $output .='<option value="1236">신승06</option>';
                                $reguser == "1237" ? $output .= '<option value="1237" selected>신승07</option>' : $output .='<option value="1237">신승07</option>';
                                $reguser == "1238" ? $output .= '<option value="1238" selected>신승08</option>' : $output .='<option value="1238">신승08</option>';
                                $reguser == "1239" ? $output .= '<option value="1239" selected>신승09</option>' : $output .='<option value="1239">신승09</option>';
                                $reguser == "1240" ? $output .= '<option value="1240" selected>신승10</option>' : $output .='<option value="1240">신승10</option>';
                            }elseif ($bran=="D1003"){
                                $reguser == "1117" ? $output .= '<option value="1117" selected>마희숙</option>' : $output .='<option value="1117">마희숙</option>';
                                $reguser == "1131" ? $output .= '<option value="1131" selected>한예주</option>' : $output .='<option value="1131">한예주</option>';
                                $reguser == "1132" ? $output .= '<option value="1132" selected>김지윤</option>' : $output .='<option value="1132">김지윤</option>';
                                $reguser == "1134" ? $output .= '<option value="1134" selected>용아름</option>' : $output .='<option value="1134">용아름</option>';
                                $reguser == "1256" ? $output .= '<option value="1256" selected>김예빈</option>' : $output .='<option value="1256">김예빈</option>';
                                $reguser == "1241" ? $output .= '<option value="1241" selected>강남1</option>' : $output .='<option value="1241">강남1</option>';
                                $reguser == "1242" ? $output .= '<option value="1242" selected>강남2</option>' : $output .='<option value="1242">강남2</option>';
                                $reguser == "1243" ? $output .= '<option value="1243" selected>강남3</option>' : $output .='<option value="1243">강남3</option>';
                                $reguser == "1244" ? $output .= '<option value="1244" selected>강남4</option>' : $output .='<option value="1244">강남4</option>';
                                $reguser == "1245" ? $output .= '<option value="1245" selected>강남5</option>' : $output .='<option value="1245">강남5</option>';
                                $reguser == "1246" ? $output .= '<option value="1246" selected>강남6</option>' : $output .='<option value="1246">강남6</option>';
                                $reguser == "1247" ? $output .= '<option value="1247" selected>강남7</option>' : $output .='<option value="1247">강남7</option>';                                
                            }elseif ($bran=="D1002"){
                                $reguser == "1148" ? $output .= '<option value="1148" selected>김용덕</option>' : $output .='<option value="1148">김용덕</option>';
                                $reguser == "1133" ? $output .= '<option value="1133" selected>이정희</option>' : $output .='<option value="1133">이정희</option>';
                                $reguser == "1154" ? $output .= '<option value="1154" selected>김혜선</option>' : $output .='<option value="1154">김혜선</option>';
                                $reguser == "1248" ? $output .= '<option value="1248" selected>강설옥</option>' : $output .='<option value="1248">강설옥</option>';
                            }elseif ($bran=="D1014"){
                                $reguser == "1147" ? $output .= '<option value="1147" selected>노준석</option>' : $output .='<option value="1147">노준석</option>';
                                $reguser == "1148" ? $output .= '<option value="1148" selected>이정민</option>' : $output .='<option value="1148">이정민</option>';
                                $reguser == "1149" ? $output .= '<option value="1149" selected>윤형덕</option>' : $output .='<option value="1149">윤형덕</option>';
                                $reguser == "1227" ? $output .= '<option value="1227" selected>김선진</option>' : $output .='<option value="1227">김선진</option>';
                            }elseif ($bran=="D1013"){
                                $reguser == "1226" ? $output .= '<option value="1226" selected>김민</option>' : $output .='<option value="1226">김민</option>';
                                $reguser == "1228" ? $output .= '<option value="1228" selected>김규리</option>' : $output .='<option value="1228">김규리</option>';
                                $reguser == "1249" ? $output .= '<option value="1249" selected>홍건호</option>' : $output .='<option value="1249">홍건호</option>';
                                $reguser == "1121" ? $output .= '<option value="1121" selected>최기정</option>' : $output .='<option value="1121">최기정</option>';
                                $reguser == "1220" ? $output .= '<option value="1220" selected>이명진</option>' : $output .='<option value="1220">이명진</option>';
                                $reguser == "1153" ? $output .= '<option value="1153" selected>김진규</option>' : $output .='<option value="1153">김진규</option>';
                                $reguser == "1163" ? $output .= '<option value="1163" selected>한성민</option>' : $output .='<option value="1163">한성민</option>';
                                $reguser == "1164" ? $output .= '<option value="1164" selected>한은진</option>' : $output .='<option value="1164">한은진</option>';
                            }elseif ($bran=="D1004"){
                                $reguser == "1119" ? $output .= '<option value="1119" selected>오선미</option>' : $output .='<option value="1119">오선미</option>';
                                $reguser == "1135" ? $output .= '<option value="1135" selected>노윤솔</option>' : $output .='<option value="1135">노윤솔</option>';
                                $reguser == "1250" ? $output .= '<option value="1250" selected>김정아</option>' : $output .='<option value="1250">김정아</option>';
                            }elseif ($bran=="D1006"){
                                $reguser == "1136" ? $output .= '<option value="1136" selected>김은정</option>' : $output .='<option value="1136">김은정</option>';
                                $reguser == "1160" ? $output .= '<option value="1160" selected>박기령</option>' : $output .='<option value="1160">박기령</option>';
                                $reguser == "1161" ? $output .= '<option value="1161" selected>김지영</option>' : $output .='<option value="1161">김지영</option>';
                                $reguser == "1166" ? $output .= '<option value="1166" selected>안덕현</option>' : $output .='<option value="1166">안덕현</option>';
                            }elseif ($bran=="D1007"){
                                $reguser == "1116" ? $output .= '<option value="1116" selected>오미자</option>' : $output .='<option value="1116">오미자</option>';
                                $reguser == "1257" ? $output .= '<option value="1257" selected>김세화</option>' : $output .='<option value="1257">김세화</option>';
                                $reguser == "1251" ? $output .= '<option value="1251" selected>한지은</option>' : $output .='<option value="1251">한지은</option>';
                            }elseif ($bran=="D1008"){
                                $reguser == "1120" ? $output .= '<option value="1120" selected>이찬희</option>' : $output .='<option value="1120">이찬희</option>';
                                $reguser == "1140" ? $output .= '<option value="1140" selected>김세아</option>' : $output .='<option value="1140">김세아</option>';
                                $reguser == "1141" ? $output .= '<option value="1141" selected>강정민</option>' : $output .='<option value="1141">강정민</option>';
                                $reguser == "1252" ? $output .= '<option value="1252" selected>김미경</option>' : $output .='<option value="1252">김미경</option>';
                            }elseif ($bran=="D1009"){
                                $reguser == "1118" ? $output .= '<option value="1118" selected>신정희</option>' : $output .='<option value="1118">신정희</option>';
                                $reguser == "1142" ? $output .= '<option value="1142" selected>양은경</option>' : $output .='<option value="1142">양은경</option>';
                                $reguser == "1253" ? $output .= '<option value="1253" selected>신솔빈</option>' : $output .='<option value="1253">신솔빈</option>';
                                $reguser == "1155" ? $output .= '<option value="1155" selected>장민경</option>' : $output .='<option value="1155">장민경</option>';
                            }elseif ($bran=="D1010"){
                                $reguser == "1113" ? $output .= '<option value="1113" selected>이해옥</option>' : $output .='<option value="1113">이해옥</option>';
                                $reguser == "1144" ? $output .= '<option value="1144" selected>박혜진</option>' : $output .='<option value="1144">박혜진</option>';
                                $reguser == "1143" ? $output .= '<option value="1143" selected>염해림</option>' : $output .='<option value="1143">염해림</option>';
                            }elseif ($bran=="D1011"){
                                $reguser == "1113" ? $output .= '<option value="1113" selected>이해옥</option>' : $output .='<option value="1113">이해옥</option>';
                                $reguser == "1158" ? $output .= '<option value="1158" selected>유수현</option>' : $output .='<option value="1158">유수현</option>';
                                $reguser == "1145" ? $output .= '<option value="1145" selected>한세빈</option>' : $output .='<option value="1145">한세빈</option>';
                            }elseif ($bran=="D1012"){
                                $reguser == "1115" ? $output .= '<option value="1115" selected>한영순</option>' : $output .='<option value="1115">한영순</option>';
                                $reguser == "1165" ? $output .= '<option value="1165" selected>강지혜</option>' : $output .='<option value="1165">강지혜</option>';
                                $reguser == "1255" ? $output .= '<option value="1255" selected>임봉규</option>' : $output .='<option value="1255">임봉규</option>';
                                $reguser == "1254" ? $output .= '<option value="1254" selected>한유정</option>' : $output .='<option value="1254">한유정</option>';
                            }elseif ($bran=="D1021"){
                                $reguser == "1115" ? $output .= '<option value="1115" selected>정혜숙</option>' : $output .='<option value="1115">정혜숙</option>';
                                $reguser == "1116" ? $output .= '<option value="1116" selected>오미자</option>' : $output .='<option value="1116">오미자</option>';
                            }else{
                                $reguser == "" ? $output .= '<option value="" selected></option>' : $output .='<option value=""></option>';
                            }
                            $output .='</select>
							</td>		
							<TD><DIV id="memo_lbl_'.$row["ID"].'" style="width:200px;height:28px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.mb_strimwidth($row['MEMO'],'0','40','...','utf-8').'</DIV><input style="width:200px; height:28px;display:none;" type="text" id="memo_ip_'.$row["ID"].'" value="'.$row['MEMO'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)memo_submit(this);" ></input></TD>';
							
                        }  // if($cst_type == "종합소득세") 끝
                    }
                }// 네번째 if문 끝
                else
                {
                    $output .= '
					<tr>
					<td colspan="20" align="center">데이터가 없습니다.</td>
					</tr>
					';
                }
                
                echo $head.$output;
                
            }// 세번째 if문 끝
        } // 두번째 if 문 끝
    }//첫번째 if문 끝!
}
/*종합소득세 접수현황 select : 시작*/





/*계좌리스트*/
if($action == "select_list_back_acc"){
		
	//ajax로 넘긴 데이터 값은 "select"
	//값이 존재하면 true를 리턴
	$g_option = $_POST["g_option"];
	$b_option = $_POST["b_option"];
	$s_str = $_POST["s_str"];
	$footer="";

	$query_str1 = "";
	$query_str2 = "";
	$query_desc = " ORDER BY TMP.ROWNUM DESC ";

	$page = $_POST["page"];

	$page_set = 100; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수


	if($s_str !=""){
		switch($g_option){
			case "NUM" : 
				$query_str1 .= " AND ACC_ID like '%".$s_str."%' ";
				break;
			case "NAME" : 
				$query_str1 .= " AND ACC_NAME like '%".$s_str."%' ";
				break;
			default:
				$query_str1 .="";
			}	
	}
	
	
	if($b_option != ""){
	    $query_str2 .= " AND SWITCH_ACC_BRANCH(ACC_FLAG) = '".$b_option."' ";
	}
	
	


	$query = "SELECT count(1) as total FROM TB100031 WHERE 1=1 ".$query_str1.$query_str2;

	//$row = mysqli_query($connect,$query);
	
	$result =  mysqli_query($connect,$query);
	
	while($row = mysqli_fetch_array($result)){
	    
	    $total = $row["total"]; // 전체글수
	}
	
	
	if($total){
	    
	    
	    $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	    $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
	    
	    if (!$page) $page = 1; // 현재페이지(넘어온값)
	    $block = ceil ($page / $block_set); // 현재블럭(올림함수)
	    $limit_idx = ($page - 1) * $page_set; // limit시작위치
	    
	}
	
	
	
		$head .= '
		<colgroup>
		<col width="70px">
		<col width="200px">
		<col width="200px">
		<col width="300px">
        <col width="300px">
		</colgroup>
		<thead>
		<tr>
			<th>No.</th>
			<th>이름</th>
			<th>입금액</th>
			<th>날짜</th>
            <th>구분</th>
		</tr>
		</thead>
		';


	if(isset($_POST["action"]))
	{
	//users테이블 조회 프로시져를 만든다.
	$procedure = "
	CREATE PROCEDURE SELECT_TB100031()
	BEGIN
    SELECT TMP.*
    FROM (
    SELECT
    @rownum:=@rownum+1 AS ROWNUM, A.*,SWITCH_ACC_BRANCH(A.ACC_FLAG) AS ACC_FLAG_, FORMAT(ACC_FEE,0) AS ACC_FEE_
    FROM dbsschina.TB100031 A, (SELECT @rownum:=0) TMP
    ORDER BY ACC_DATE
    ) AS TMP
    WHERE 1=1 ".$query_str1.$query_str2.$query_desc.
	" LIMIT $limit_idx, $page_set 
	;


	END;
	";
		//기존에 프로시져가 존재한다면 지운다.
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100031"))
		{
			//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB100031()";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);

				if($result)
				{
				    $style_cnt = 0;
					while($row = mysqli_fetch_array($result)){
					    
					    if($style_cnt % 2 == 1 ){
					        $style = 'style="background:#cbe1ec29;"';
					    }else{
					        $style = '';
					    }
					    
					    $style_cnt++;
					    
						$output .= '
						<tr '.$style.'>
						<td>'.$row["ACC_ID"].'</td>
						<td>'.$row["ACC_NAME"].'</td>
						<td>'.$row["ACC_FEE_"].'</td>
						<td>'.$row["ACC_DATE"].'</td>
                        <td style="margin:auto;text-align:center;">'.$row["ACC_FLAG_"].'</td>
						</tr>';
						
					}
				}// 네번째 if문 끝
				else
				{
					$output .= '
					<tr>
					<td colspan="20" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

				echo $head.$output;

			}// 세번째 if문 끝

		} // 두번째 if 문 끝

	}//첫번째 if문 끝!


}










/*계좌리스트*/
if($action == "select_list_kakao_send"){
    
    //ajax로 넘긴 데이터 값은 "select"
    //값이 존재하면 true를 리턴
    $g_option = $_POST["g_option"];
    $b_option = $_POST["b_option"];
    $s_str = $_POST["s_str"];
    $footer="";
    
    $query_str1 = "";
    $query_str2 = "";
    $query_desc = " ORDER BY SEND_DATE DESC, CSTID DESC ";
    
    $page = $_POST["page"];
    
    $page_set = 100; // 한페이지 줄수
    $block_set = 5; // 한페이지 블럭수
    $limit_idx=0;
    $total = 0;
    
    
    if($s_str !=""){
        switch($g_option){
            
            case "NAME" :
                $query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
                break;
            case "MOBILE" :
                $query_str1 .= " AND RETURN_STR(SEND_MOBILE_NUM) like '%".$s_str."%' ";
                break;
            default:
                $query_str1 .="";
        }
    }
    
    
    if($b_option != ""){
        if($b_option!="ALL"){
            $query_str2 .= " AND B.REG_BRANCH = '".$b_option."' ";
        }
    }
    
    $query = "SELECT COUNT(1) AS 'total'  
            FROM TB100020 AS A 
            LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
            LEFT OUTER JOIN TB700010 AS C ON B.BIZ_ID=C.SEND_BIZ_ID
            WHERE C.SEND_TMP_STEP='AUTO_COMPLATE' ".$query_str1.$query_str2;
    
    //$row = mysqli_query($connect,$query);
    
    $result =  mysqli_query($connect,$query);
    
    while($row = mysqli_fetch_array($result)){
        
        $total = $row["total"]; // 전체글수
    }
    
    
    if($total>0){
        
        
        $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
        $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
        
        if (!$page) $page = 1; // 현재페이지(넘어온값)
        $block = ceil ($page / $block_set); // 현재블럭(올림함수)
        $limit_idx = ($page - 1) * $page_set; // limit시작위치
        
    }
    
    
    
    $head .= '
		<colgroup>
    		<col width="70px">
    		<col width="70px">
    		<col width="80px">
            <col width="150px">
<col width="50px">            
<col width="80px">
            <col width="80px">
            <col width="140px">
            <col width="140px">
    		<col width="155px">
    		<col width="155px">
            <col width="70px">
            <col width="70px">
            <col width="70px">
            <col width="150px">
            <col width="80px">
            <col width="150px">
		</colgroup>
		<thead>
		<tr>
			<th>ID</th>
			<th>지점</th>
			<th>이름</th>
            <th>핸드폰</th>
            <th>리뷰</th>
			<th>전자신고1</th>
            <th>전자신고2</th>
            <th>소득세</th>
            <th>지방세</th>
            <th>발송일시</th>
            <th>접속일</th>
            <th>납부서<br>링크</th>
            <th>SMS</th>
            <th>SMS<br>발송건수</th>
            <th>SMS<br>발송시간</th>
            <th>SMS<br>발송유저</th>
            <th>메모</th>
		</tr>
		</thead>
		';
    
    
    if(isset($_POST["action"]))
    {
        //users테이블 조회 프로시져를 만든다.
        $procedure = "
	CREATE PROCEDURE SELECT_KAKAO_SEND_LOG()
	BEGIN
    SELECT A.CSTID AS 'CSTID' ,
			B.REG_BRANCH AS 'REG_BRANCH',
            CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_',
            A.CSTNAME ,
            REPLACE(A.MOBILE,'-','') AS 'MOBILE',
            (SELECT HomeTaxUpload FROM TB100023 WHERE BIZ_ID = B.BIZ_ID) as 'HomeTaxUpload',
            (SELECT SmartAToConvert FROM TB100023 WHERE BIZ_ID = B.BIZ_ID) as 'SmartAToConvert',
            B.INCOME_TAX,B.JIBANG_TAX,
            #(SELECT SEND_DATE FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='AUTO_COMPLATE'  ORDER BY SEND_DATE DESC LIMIT 1) as 'SEND_DATE',
            C.SEND_DATE,
            (SELECT LOG_TIME FROM TB700020 WHERE STEP_NAME = 'LOGIN' AND CSTID = A.CSTID AND LOG <> 'login fail' ORDER BY LOG_TIME DESC LIMIT 1) AS 'LOGIN_DATE',
            (SELECT COUNT(1) FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='SMS발송'  LIMIT 1 ) as 'SMS',
            (SELECT SEND_DATE FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='SMS발송'  LIMIT 1  ) as 'SMS_SEND_DATE',
            (SELECT SELECT_REGUSER(REGUSER) FROM TB700010 WHERE SEND_BIZ_ID = B.BIZ_ID AND SEND_TMP_STEP='SMS발송' LIMIT 1 ) as 'SMS_SEND_USER',
            B.MEMO,
            CK_REVIEW(A.CSTNAME,A.MOBILE) AS CK_REVIEW
            FROM TB100020 AS A 
            LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
            LEFT OUTER JOIN TB700010 AS C ON B.BIZ_ID=C.SEND_BIZ_ID
            #LEFT OUTER JOIN TB700020 AS D ON A.CSTID = D.CSTID
            WHERE C.SEND_TMP_STEP='AUTO_COMPLATE'
            AND C.VISIBLE='Y'
            #AND A.CSTID IN (SELECT CSTID FROM TB700020 WHERE LOG <> 'login fail' GROUP BY CSTID)
            ".$query_str1.$query_str2.$query_desc.
            " LIMIT $limit_idx, $page_set
	;
	
	
	END;
	";
        //기존에 프로시져가 존재한다면 지운다.
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_KAKAO_SEND_LOG"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_KAKAO_SEND_LOG()";
                
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                $result = mysqli_query($connect,$query1);
                
                if($result)
                {
                    $style_cnt = 0;
                    while($row = mysqli_fetch_array($result)){
                        
                        if($style_cnt % 2 == 1 ){
                            $style = 'style="background:#cbe1ec29;"';
                        }else{
                            $style = '';
                        }
                        
                        $smart = $row["SmartAToConvert"];
                        if($smart=='Y')
                            $smartA_str = "완료";
                        
                        $ht_upload = $row["HomeTaxUpload"];
                        if($ht_upload=='Y')
                            $ht_upload_str = "완료";
                            
                        
                        $style_cnt++;
                        
                        $output .= '
						<tr '.$style.'>
						<td>'.$row["CSTID"].'</td>
						<td>'.$row["REG_BRANCH_"].'</td>
                        <td><a href="javascript:window.open(\'view_inc_cst.php?id='.$row["CSTID"].'\');">'.$row["CSTNAME"].'</a></td>
						<td>'.$row["MOBILE"].'</td>
						<td>'.$row["CK_REVIEW"].'</td>
						<td>'.$smartA_str.'</td>
                        <td>'.$ht_upload_str.'</td>
                        <td>'.$row["INCOME_TAX"].'</td>
                        <td>'.$row["JIBANG_TAX"].'</td>
                        <td>'.$row["SEND_DATE"].'</td>
                        <td>'.$row["LOGIN_DATE"].'</td>
                        <td><a href="javascript:window.open(\'cst_filelist.php?id='.$row["CSTID"].'\');">납부서</a></td>
                        <td><a href="javascript:send_sms(\''.$row["CSTID"].'\');">발송</a></td>
                        <TD>'.$row["SMS"].'</td>
                        <TD>'.$row["SMS_SEND_DATE"].'</td>
                        <TD>'.$row["SMS_SEND_USER"].'</td>
                        <TD>'.$row["MEMO"].'</td>
						</tr>';
                        
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
                
                echo $head.$output;
                
            }// 세번째 if문 끝
            
        } // 두번째 if 문 끝
        
    }//첫번째 if문 끝!
    
    
}













/*계좌리스트*/
if($action == "select_list_cash_report"){
    
    //ajax로 넘긴 데이터 값은 "select"
    //값이 존재하면 true를 리턴
    $g_option = $_POST["g_option"];
    $b_option = $_POST["b_option"];
    $s_str = $_POST["s_str"];
    $footer="";
    
    $query_str1 = "";
    $query_str2 = "";
    $query_desc = " ORDER BY B.CASH_REPORT_REGDATE DESC ";
    
    $page = $_POST["page"];
    
    $page_set = 100; // 한페이지 줄수
    $block_set = 5; // 한페이지 블럭수
    
    
    if($s_str !=""){
        switch($g_option){
            case "MOBILE" :
                $query_str1 .= " AND RETURN_STR(MOBILE) like '%".$s_str."%' ";
                break;
            case "NAME" :
                $query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
                break;
            default:
                $query_str1 .="";
        }
    }
    
      
    
    
    $query = "SELECT COUNT(1) AS 'total' FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
            WHERE IFNULL(B.CASH_REPORT_APP_NUM,'') <> '' ".$query_str1.$query_str2;
    
    //$row = mysqli_query($connect,$query);
    
    $result =  mysqli_query($connect,$query);
    
    while($row = mysqli_fetch_array($result)){
        
        $total = $row["total"]; // 전체글수
    }
    
    
    if($total){
        
        
        $total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
        $total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)
        
        if (!$page) $page = 1; // 현재페이지(넘어온값)
        $block = ceil ($page / $block_set); // 현재블럭(올림함수)
        $limit_idx = ($page - 1) * $page_set; // limit시작위치
        
    }
    
    
    
    $head .= '
		<colgroup>
		<col width="70px">
		<col width="200px">
		<col width="200px">
		<col width="300px">
        <col width="300px">
        <col width="300px">
		</colgroup>
		<thead>
		<tr>
			<th>ID.</th>
			<th>이름</th>
			<th>핸드폰</th>
            <th>금액</th>
			<th>발행번호</th>
            <th>발행일</th>
		</tr>
		</thead>
		';
    
    
    if(isset($_POST["action"]))
    {
        //users테이블 조회 프로시져를 만든다.
        $procedure = "
	CREATE PROCEDURE SELECT_CASH_REPORT()
	BEGIN
    SELECT A.CSTID, A.CSTNAME, A.MOBILE,FORMAT(B.DEP_FEE,0) AS DEP_FEE_ ,B.CASH_REPORT_APP_NUM, B.CASH_REPORT_REGDATE 
    FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
    WHERE IFNULL(B.CASH_REPORT_APP_NUM,'') <> '' ".$query_str1.$query_str2.$query_desc.
    " LIMIT $limit_idx, $page_set
	;
	
	
	END;
	";
        //기존에 프로시져가 존재한다면 지운다.
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CASH_REPORT"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_CASH_REPORT()";
                
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                $result = mysqli_query($connect,$query1);
                
                if($result)
                {
                    $style_cnt = 0;
                    while($row = mysqli_fetch_array($result)){
                        
                        if($style_cnt % 2 == 1 ){
                            $style = 'style="background:#cbe1ec29;"';
                        }else{
                            $style = '';
                        }
                        
                        $style_cnt++;
                        
                        $output .= '
						<tr '.$style.'>
						<td>'.$row["CSTID"].'</td>
						<td>'.$row["CSTNAME"].'</td>
						<td>'.$row["MOBILE"].'</td>
						<td>'.$row["DEP_FEE_"].'</td>
                        <td>'.$row["CASH_REPORT_APP_NUM"].'</td>
                        <td>'.$row["CASH_REPORT_REGDATE"].'</td>
						</tr>';
                        
                    }
                }// 네번째 if문 끝
                else
                {
                    $output .= '
					<tr>
					<td colspan="20" align="center">데이터가 없습니다.</td>
					</tr>
					';
                }
                
                echo $head.$output;
                
            }// 세번째 if문 끝
            
        } // 두번째 if 문 끝
        
    }//첫번째 if문 끝!
    
    
}






// RPA 종소세/부가세 리스트 : 시작
if($action == "select_RPA"){
	//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
	$head = '';
	$output = '';

	//ajax로 넘긴 데이터 값은 "select"
	//값이 존재하면 true를 리턴
	$cst_type = $_POST["cst_type"];
	$g_option = $_POST["g_option"];
	$b_option = $_POST["b_option"];
	$s_str = $_POST["s_str"];
	$footer="";

	$query_str1 = "";
	$query_str2 = "";
	$query_desc = " ORDER BY A.CSTID DESC";

	$page = $_POST["page"];

	$page_set = 20; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수


		if($s_str !=""){
			switch($g_option){
				case "NUM" : 
					$query_str1 .= " AND NUMBERING like '%".$s_str."%' ";
					break;
				case "NAME" : 
					$query_str1 .= " AND CSTNAME like '%".$s_str."%' ";
					break;
				case "MOBILE" : 
					$query_str1 .= " AND RETURN_STR(MOBILE) like '%".$s_str."%' ";
					break;
				case "RESI" : 
					$query_str1 .= " AND RESIDENT_ID like '%".$s_str."%' ";
					break;
				default:
					$query_str1 .="";
				}	
		}


		if($b_option != ""){
			$query_str2 .= " AND BRANCH = '".$b_option."' ";
		}



	$query = "SELECT count(1) as total FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B A.CSTID = B.CSTID WHERE 1=1 ".$query_str1.$query_str2;

	$row = mysqli_query($connect,$query);


	//$row = mysqli_fetch_array($result);

	$total = $row["total"]; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치


	if($cst_type == "A1001"){
		
		$head .= '
		<colgroup>
		<col width="60px">
		<col width="50px">
		<col width="70px">
		<col width="110px">
		<col width="170px">
		<col width="170px">
		<col width="240px">
		<col width="50px">
		<col width="50px">
		<col width="50px">
		<col width="100px">
		<col width="150px">
		<col width="170px">
		<col width="150px">
		<col width="150px">
		<col width="150px">
		<col width="150px">

		</colgroup>
		<thead>
		<tr>
			<th>넘버링</th>
			<th>지점</th>
			<th>이름</th>
			<th>HomeTaxID</th>
			<th>핸드폰</th>
			<th>주민번호</th>
			<th>처리시간</th>
			<th>안내문</th>
			<th>신고</th>
			<th>PDF</th>
			<th>오류</th>
			<th>소득금액(단위:원)</th>
			<th>지방세(단위:원)</th>
			<th>납부번호</th>
			<th>지방세납부번호</th>
			<th>환급은행</th>
			<th>계좌</th>
		</tr>
		</thead>
		';

	}else{
		
		$head .= '
		<colgroup>
		
		<col width="50px">
		<col width="100px">
		<col width="100px">
		<col width="100px">
        <col width="80px">
		<col width="150px">
		<col width="70px">
		<col width="100px">
		<col width="100px">
		<col width="60px">
		<col width="60px">
		<col width="60px">
		<col width="60px">
		<col width="60px">
		<col width="80px">
		<col width="80px">
		<col width="80px">
		<col width="80px">
		<col width="80px">
		<col width="300px">
		
		</colgroup>
		<thead>
		  <tr>
			<th rowspan="2">no</th>
			<th rowspan="2">접수일</th>
			<th colspan="3">기본정보</th>
			<th rowspan="2">연락처</th>
			<th rowspan="2">알림톡</th>
			<th colspan="3">수수료</th>
			<th colspan="2">홈택스 수임</th>
			<th colspan="2">자료</th>
			<th>회사</th>
			<th colspan="3">전자신고</th>
			<th>납부서</th>
			<th rowspan="2">메모</th>
		  </tr>
		  <tr>
			<td style="border:1px solid #e3e3e3;">상호</td>
			<td>이름</td>
            <td>유입경로</td>
			<td>수수료</td>
			<td>입금금액</td>
			<td>영수증</td>
			<td>요청</td>
			<td>여부</td>
			<td>추출</td>
			<td>첨부</td>
			<td>등록</td>
			<td>신고담당</td>
			<td>요청</td>
			<td>완료</td>
			<td>전송완료</td>
		  </tr>
		</thead>
		';

	}


	if(isset($_POST["action"]))
	{
	//users테이블 조회 프로시져를 만든다.
	$procedure = "
	CREATE PROCEDURE SELECT_TB100020()
	BEGIN
	SELECT  A.CSTID AS 'ID',
	DATE_FORMAT(B.REGDATE, '%y-%m-%d') AS 'REGDATE_',
	B.COMP_NAME,
	A.CSTNAME,
	FORMAT(B.EST_FEE , 0) AS EST_FEE,
	FORMAT(B.DEP_FEE , 0) AS DEP_FEE,
	B.CASH_REC,
	DATE_FORMAT(B.SUBM_DATE, '%y-%m-%d') 'SUBM_DATE_',
	DATE_FORMAT(B.SUBM_DATE2, '%y-%m-%d') 'SUBM_DATE2_',
	B.EXT_DATE ,
	B.ATTACH_FILE,
	A.CompRegCheck,
	B.DEC_REGUSER,
	B.REQ_E_REPORT,
	DATE_FORMAT(B.COMP_DATE, '%y-%m-%d') 'COMP_DATE_',
	DATE_FORMAT(B.DEL_DATE_PAYMENT, '%y-%m-%d') 'DEL_DATE_PAYMENT_',
	B.MEMO, 
	FX_MOBILE(A.MOBILE) AS MOBILE,
    B.INF_PATH
	FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	WHERE B.CST_TYPE = '".$cst_type."' ".$query_str1.$query_str2.$query_desc.
	" LIMIT $limit_idx, $page_set 
	;
	END;
	";
		//기존에 프로시져가 존재한다면 지운다.
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100020"))
		{
			//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB100020()";

				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
				$result = mysqli_query($connect,$query1);


				if($result)
				{

					$cate_name="";

					while($row = mysqli_fetch_array($result)){

						if($cst_type == "A1001"){
							$output .= '
							<tr>
							<td>'.$row["ID"].'</td>
							<td>'.$row["REGDATE_"].'</td>
							<td><a href="view_cst_info.php?id='.$row["ID"].'">'.$row["COMP_NAME"].'</a></td>
							<td><a href="view_cst_info.php?id='.$row["ID"].'">'.$row["CSTNAME"].'</a></td>
							
							<td>'.$row["EST_FEE"].'</td>
							<td>'.$row["DEP_FEE"].'</td>
							<td>'.$row["CASH_REC"].'</td>
							<td>'.$row["SUBM_DATE_"].'</td>
							<td>'.$row["SUBM_DATE2_"].'</td>
							<td>'.$row["EXT_DATE"].'</td>
							<td>'.$row["ATTACH_FILE"].'</td>
							<td>'.$row["DEC_REGUSER"].'</td>
							<td>'.$row["REQ_E_REPORT"].'</td>
							<td>'.$row["COMP_DATE_"].'</td>
							<td>'.$row["DEL_DATE_PAYMENT_"].'</span></td>
							<td>'.$row["MEMO"].'</td>
							</tr>';
						}else{
							$output .= '
							<tr>
							<td>'.$row["ID"].'</td>
							<td>'.$row["REGDATE_"].'</td>
							<td><a href="view_vat_cst.php?id='.$row["ID"].'">'.$row["COMP_NAME"].'</a></td>
							<td><a href="view_vat_cst.php?id='.$row["ID"].'">'.$row["CSTNAME"].'</a></td>
							<td>'.$row["INF_PATH"].'</td>
                            <td>'.$row["MOBILE"].'</td>
							<td><a href="javascript:send_kakao('.$row["BIZ_ID"].')">발송</a></td>
							<td>'.$row["EST_FEE"].'</td>
							<td>'.$row["DEP_FEE"].'</td>
							<td>'.$row["CASH_REC"].'</td>
							<td>'.$row["SUBM_DATE_"].'</td>
							<td>'.$row["SUBM_DATE2_"].'</td>
							<td>'.$row["EXT_DATE"].'</td>
							<td>'.$row["ATTACH_FILE"].'</td>
							<td>'.$row["CompRegCheck"].'</td>
							<td>'.$row["DEC_REGUSER"].'</td>
							<td>'.$row["REQ_E_REPORT"].'</td>
							<td>'.$row["COMP_DATE_"].'</td>
							<td>'.$row["DEL_DATE_PAYMENT_"].'</span></td>
							<td>'.$row["MEMO"].'</td>
							</tr>';
						}  // if($cst_type == "종합소득세") 끝
					}
				}// 네번째 if문 끝
				else
				{
					$output .= '
					<tr>
					<td colspan="20" align="center">데이터가 없습니다.</td>
					</tr>
					';
				}

				echo $head.$output;

			}// 세번째 if문 끝

		} // 두번째 if 문 끝

	}//첫번째 if문 끝!	
}
// RPA 종소세/부가세 리스트 : 끝


// 종소세 고객 예상납부새액 화면 select : 시작
if($action == "select_cal_info"){
    
    $output = array();

    $procedure = "
	CREATE PROCEDURE SELECT_CAL_INFO(IN user_id int(11) )
	BEGIN
        
    SELECT A.CSTID, A.CSTNAME, A.MOBILE, A.HomeTaxID, A.HomeTaxPW,B.REGUSER, 
    SELECT_REGUSER(B.REGUSER) AS REGUSER_ , C.INFO_TYPE, B.REG_BRANCH,
    IFNULL(D.INTEREST,'N') AS INTEREST,
    IFNULL(D.ALLOCATION,'N') AS ALLOCATION,
    IFNULL(D.WORK_SINGLE,'N') AS WORK_SINGLE,
    IFNULL(D.WORK_PLUR,'N') AS WORK_PLUR,
    IFNULL(D.INFORMAL,'N') AS INFORMAL,
    IFNULL(D.ETC, 'N') AS ETC,
    B.EXP_PAY_TAX,format(B.EXP_PAY_TAX,0) AS EXP_PAY_TAX_ ,B.EST_FEE,FORMAT(B.EST_FEE,0) AS EST_FEE_, E.PROGRESS,B.MEMO,
    B.MEMO, 
    F.EXI_TAX,
    F.NPIP, 
    F.PERSON_SAVE,
    F.SMALL_BIZ_DED,
    F.RET_SAVE,
    F.PEN_SAVE,
    FORMAT(F.EXI_TAX,0) AS EXI_TAX_,
    FORMAT(F.NPIP,0) AS NPIP_, 
    FORMAT(F.PERSON_SAVE,0) AS PERSON_SAVE_,
    FORMAT(F.SMALL_BIZ_DED,0) AS SMALL_BIZ_DED_,
    FORMAT(F.RET_SAVE,0) AS RET_SAVE_,
    FORMAT(F.PEN_SAVE,0) AS PEN_SAVE_,
    FORMAT( CAL_INC(A.CSTID),0) AS 'EXP_PAY_TAX_FN', 
    CAL_FEE_CHANGE_DATE(A.CSTID) AS 'CAL_EST_FEE_FN',
    ADD_AMOUNT_PAID(A.CSTID) AS 'ADD_AMOUNT_PAID' ,
    SELECT_AMOUNTPAID_FAST(A.CSTID) AS 'ADD_AMOUNT_PAID_2' ,
    KAKAO_URL_BRANCH(B.REG_BRANCH) AS 'KAKAO_URL_BRANCH',
    F.FIX_IT,
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP01') AS 'KAKAO_SEND_CNT1',
    CK_KAKAO_SEND_CNT(B.BIZ_ID, REPLACE( A.MOBILE,'-',''), 'A1001', 'STEP02') AS 'KAKAO_SEND_CNT2',
    B.EST_FEE_SELF,
    FORMAT(B.EST_FEE_SELF,0) AS EST_FEE_SELF_,
    B.EXP_PAY_TAX_SELF,
    FORMAT(B.EXP_PAY_TAX_SELF,0) AS EXP_PAY_TAX_SELF_
    FROM TB100020 AS A 
    LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
    LEFT OUTER JOIN TB300010 AS C ON A.CSTID = C.CSTID
    LEFT OUTER JOIN TB300030 AS D ON A.CSTID = D.CSTID AND D.CST_TYPE_YEAR=DATE_FORMAT(now(), '%Y')
    LEFT OUTER JOIN TB100026 AS E ON B.BIZ_ID = E.BIZ_ID
    LEFT OUTER JOIN TB300031 AS F ON A.CSTID = F.CSTID AND F.CST_TYPE_YEAR=DATE_FORMAT(now(), '%Y')
    WHERE A.CSTID = user_id;
	END;
	";
    
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CAL_INFO"))
    {
        //mysqli_query:DB에 쿼리 전송
        if(mysqli_query($connect,$procedure))
        {
            $query1 = "CALL SELECT_CAL_INFO('".$_POST["id"]."')";
            $result = mysqli_query($connect,$query1);
            ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
            
            while($row = mysqli_fetch_array($result)){
                $output['CSTID'] = $row["CSTID"];
                $output['CSTNAME'] = $row["CSTNAME"];
                $output['MOBILE'] = $row["MOBILE"];
                $output['HomeTaxID'] = $row["HomeTaxID"];
                $output['HomeTaxPW'] = $row["HomeTaxPW"];
                $output['REGUSER'] = $row["REGUSER"];
                $output['REG_BRANCH'] = $row["REG_BRANCH"];
                $output['INFO_TYPE'] = $row["INFO_TYPE"];
                $output['INTEREST'] = $row["INTEREST"];
                $output['ALLOCATION'] = $row["ALLOCATION"];
                $output['WORK_SINGLE'] = $row["WORK_SINGLE"];
                $output['WORK_PLUR'] = $row["WORK_PLUR"];
                $output['INFORMAL'] = $row["INFORMAL"];
                $output['ETC'] = $row["ETC"];
                
                $output['EXP_PAY_TAX'] = $row["EXP_PAY_TAX"];
                $output['EXP_PAY_TAX_'] = $row["EXP_PAY_TAX_"];
                $output['EXP_PAY_TAX_FN'] = $row["EXP_PAY_TAX_FN"];
                $output['EXP_PAY_TAX_SELF'] = $row["EXP_PAY_TAX_SELF"];
                $output['EXP_PAY_TAX_SELF_'] = $row["EXP_PAY_TAX_SELF_"];
                
                $output['CAL_EST_FEE_FN'] = $row["CAL_EST_FEE_FN"];
                $output['EST_FEE'] = $row["EST_FEE"];
                $output['EST_FEE_'] = $row["EST_FEE_"];
                $output['EST_FEE_SELF'] = $row["EST_FEE_SELF"];
                $output['EST_FEE_SELF_'] = $row["EST_FEE_SELF_"];
                
                $output['PROGRESS'] = $row["PROGRESS"];
                $output['EXI_TAX'] = $row["EXI_TAX"];
                $output['NPIP'] = $row["NPIP"];
                $output['PERSON_SAVE'] = $row["PERSON_SAVE"];
                $output['SMALL_BIZ_DED'] = $row["SMALL_BIZ_DED"];
                $output['RET_SAVE'] = $row["RET_SAVE"];
                $output['PEN_SAVE'] = $row["PEN_SAVE"];
                
                $output['EXI_TAX_'] = $row["EXI_TAX_"];
                $output['NPIP_'] = $row["NPIP_"];
                $output['PERSON_SAVE_'] = $row["PERSON_SAVE_"];
                $output['SMALL_BIZ_DED_'] = $row["SMALL_BIZ_DED_"];
                $output['RET_SAVE_'] = $row["RET_SAVE_"];
                $output['PEN_SAVE_'] = $row["PEN_SAVE_"];
                
                $output['MEMO'] = $row["MEMO"];
                $output['ADD_AMOUNT_PAID'] = $row["ADD_AMOUNT_PAID"];
                $output['KAKAO_URL_BRANCH'] = $row["KAKAO_URL_BRANCH"];
                
                $output['FIX_IT'] = $row["FIX_IT"];
                //KAKAO_SEND_CNT
                $output['KAKAO_SEND_CNT1'] = $row["KAKAO_SEND_CNT1"];
                $output['KAKAO_SEND_CNT2'] = $row["KAKAO_SEND_CNT2"];
            }
            echo json_encode($output);
        }
    }
}
// 종소세 고객 예상납부새액 화면 select : 끝


//  종소세 고객 예상납부새액 화면 수임금액,단순경비율일반 : 시작
if ($action == "select_write_cal_ext") {
    
    $head .= '
		<colgroup>
    		<col width="50px">
    		<col width="125px">
    		<col width="70px">
            <col width="50px">
    	</colgroup>
		<thead>
		<tr style="text-align:center;">
			<th>구분</th>
			<th>수입금액(원)</th>
			<th>단순경비율<br>일반(%)</th>
            <th></th>
		</tr>
    	</thead>
		';
    
    
    if(isset($_POST["action"]))
    {
        //users테이블 조회 프로시져를 만든다.
        $procedure = "
	CREATE PROCEDURE SELECT_TB300020_EXT( IN P_ID INT(11) )
	BEGIN
            
    SELECT TB_IDX AS IDX, FORMAT(AMOUNT_PAID,0) AS AMOUNT_PAID, SIM_RATIO_N
, FORMAT(ADD_AMOUNT_PAID(P_ID),0) AS 'ADD_AMOUNT_PAID', EXT_YN, EXT_HUMAN
    FROM TB300020 WHERE CSTID = P_ID AND CST_TYPE_YEAR =DATE_FORMAT(now(), '%Y') 
	;
	
	
	END;
	";
        //기존에 프로시져가 존재한다면 지운다.
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB300020_EXT"))
        {
            //mysqli_query:DB에 쿼리 전송
            if(mysqli_query($connect,$procedure))
            {
                $query1 = "CALL SELECT_TB300020_EXT('".$_POST["id"]."')";
                
                ///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
                $result = mysqli_query($connect,$query1);
                $count = mysqli_num_rows($result);
                $cnt_i = 0;
                
                
                if($count>0)
                {
                    while($row = mysqli_fetch_array($result)){
                        $ext_yn = $row["EXT_YN"];
                        $ext_human = $row["EXT_HUMAN"];
                        $btn_del="<span style='align:right; width:50px;'><a href='javascript:del_ext(\"".$row["IDX"]."\")'>삭제</a></span>";
                        
                        $output .= '
							<tr>
							<td style="text-align:center;">'.$row["IDX"].'</td>
							<td>'.$row["AMOUNT_PAID"];
                        if($ext_human=='Y'){
                            $output .= '<BR><B>(인적공제)</B>';
                        }
							
                        $output .= '</td>
							<td>'.$row["SIM_RATIO_N"].'</td>
                            <td>';
                        if($ext_yn=="Y") $output .= '&nbsp;&nbsp;'.$btn_del;
                        $output .= '</td></tr>';
                        
                        $cnt_i ++;
                        
                        if($cnt_i ==$count){
                            $output .= '
							<tr>
							<td style="text-align:center;background-color:#e6e6e6;">총계</td>
							<td>'.$row["ADD_AMOUNT_PAID"].'</td>
                            <TD></TD>
                            <TD></TD>
							</tr>';
                        }
                        
                    }
                }// 네번째 if문 끝
                else
                {
                    $output .= '
					<tr>
					<td colspan="4" style="text-align:center;">데이터가 없습니다.</td>
					</tr>
					';
                }
                
                echo $head.$output;
                
            }// 세번째 if문 끝
            
        } // 두번째 if 문 끝
        
    }//첫번째 if문 끝!
    
}
// 종소세 고객 예상납부새액 화면 수임금액,단순경비율일반 : 끝




// 종소세 고객 상세 뷰(확장) : 시작
if($action == "select_view_vat_ext"){

	$output = array();

	if($_POST["flag"]=="TB100024"){
		
		$procedure = "
		CREATE PROCEDURE SELECT_TB100024(IN user_id int(11), bizid int(11) )
		BEGIN

            DECLARE TMP_BIZID INT(11);
            
            IF IFNULL(bizid,0)=0 THEN
                SELECT BIZ_ID INTO TMP_BIZID FROM TB100022
                WHERE CSTID = user_id
                AND CST_TYPE_YEAR = DATE_FORMAT(now(), '%Y')
                AND CST_TYPE_SEQ = '1' ;
                SELECT * FROM TB100024 WHERE BIZ_ID = TMP_BIZID;
            ELSE 
			    SELECT * FROM TB100024 WHERE BIZ_ID = bizid;
            END IF;
		END;
		";

		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_TB100024"))
		{
		//mysqli_query:DB에 쿼리 전송
			if(mysqli_query($connect,$procedure))
			{
				$query1 = "CALL SELECT_TB100024('".$_POST["cstid"]."','".$_POST["bizid"]."')";
				$result = mysqli_query($connect,$query1);
				///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다

				while($row = mysqli_fetch_array($result)){
					$output['OPTION1'] = $row["OPTION1"];
					$output['OPTION2'] = $row["OPTION2"];
					$output['OPTION3'] = $row["OPTION3"];
					$output['OPTION4'] = $row["OPTION4"];
					$output['OPTION5'] = $row["OPTION5"];
					$output['OPTION6'] = $row["OPTION6"];
				}

				echo json_encode($output);

			}

		}
	} // if($_POST["flag"]=="TB100024"){ ... END
	
} 
// 종소세 고객 상세 뷰(확장) : 끝



// 부가세 고객 상세 뷰(기본) : 시작
if($action == "select_view_disc" && isset($_POST["id"])){
    
    //빈 배열을 만들고
    $output = array();
    
    //넘어온 id에 해당하는 row를 출력하는 프로시저 쿼리를 만든다.
    $procedure = "
		CREATE PROCEDURE SELECT_VIEW_DISC(IN user_id int(100))
		BEGIN
			SELECT 
                *
			FROM TB980099
			WHERE ID = user_id;
		END;
		";
    //기존의 프로시저가 존재한다면 삭제 후
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_VIEW_DISC"))
    {
        //위에서 선언한 프로시저 선언(1)
        if(mysqli_query($connect, $procedure))
        {
            //프로시저 호출(2)
            $query = "CALL SELECT_VIEW_DISC(".$_POST["id"].")";
            $result = mysqli_query($connect, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                //위에서 만든 배열에 넣어준다.
                $output['ID'] = $row["ID"];
                $output['USERNAME'] = $row["USERNAME"];
                $output['REGDATE'] = $row["REGDATE"];
                $output['Q1_MAX'] = $row["Q1_MAX"];
                $output['Q1_MIN'] = $row["Q1_MIN"];
                $output['Q2_MAX'] = $row["Q2_MAX"];
                $output['Q2_MIN'] = $row["Q2_MIN"];
                $output['Q3_MAX'] = $row["Q3_MAX"];
                $output['Q3_MIN'] = $row["Q3_MIN"];
                $output['Q4_MAX'] = $row["Q4_MAX"];
                $output['Q4_MIN'] = $row["Q4_MIN"];
                $output['Q5_MAX'] = $row["Q5_MAX"];
                $output['Q5_MIN'] = $row["Q5_MIN"];
                $output['Q6_MAX'] = $row["Q6_MAX"];
                $output['Q6_MIN'] = $row["Q6_MIN"];
                $output['Q7_MAX'] = $row["Q7_MAX"];
                $output['Q7_MIN'] = $row["Q7_MIN"];
                $output['Q8_MAX'] = $row["Q8_MAX"];
                $output['Q8_MIN'] = $row["Q8_MIN"];
                $output['Q9_MAX'] = $row["Q9_MAX"];
                $output['Q9_MIN'] = $row["Q9_MIN"];
                $output['Q10_MAX'] = $row["Q10_MAX"];
                $output['Q10_MIN'] = $row["Q10_MIN"];
                $output['Q11_MAX'] = $row["Q11_MAX"];
                $output['Q11_MIN'] = $row["Q11_MIN"];
                $output['Q12_MAX'] = $row["Q12_MAX"];
                $output['Q12_MIN'] = $row["Q12_MIN"];
                $output['Q13_MAX'] = $row["Q13_MAX"];
                $output['Q13_MIN'] = $row["Q13_MIN"];
                $output['Q14_MAX'] = $row["Q14_MAX"];
                $output['Q14_MIN'] = $row["Q14_MIN"];
                $output['Q15_MAX'] = $row["Q15_MAX"];
                $output['Q15_MIN'] = $row["Q15_MIN"];
                $output['Q16_MAX'] = $row["Q16_MAX"];
                $output['Q16_MIN'] = $row["Q16_MIN"];
                $output['Q17_MAX'] = $row["Q17_MAX"];
                $output['Q17_MIN'] = $row["Q17_MIN"];
                $output['Q18_MAX'] = $row["Q18_MAX"];
                $output['Q18_MIN'] = $row["Q18_MIN"];
                $output['Q19_MAX'] = $row["Q19_MAX"];
                $output['Q19_MIN'] = $row["Q19_MIN"];
                $output['Q20_MAX'] = $row["Q20_MAX"];
                $output['Q20_MIN'] = $row["Q20_MIN"];
                $output['Q21_MAX'] = $row["Q21_MAX"];
                $output['Q21_MIN'] = $row["Q21_MIN"];
                $output['Q22_MAX'] = $row["Q22_MAX"];
                $output['Q22_MIN'] = $row["Q22_MIN"];
                $output['Q23_MAX'] = $row["Q23_MAX"];
                $output['Q23_MIN'] = $row["Q23_MIN"];
                $output['Q24_MAX'] = $row["Q24_MAX"];
                $output['Q24_MIN'] = $row["Q24_MIN"];
                $output['Q25_MAX'] = $row["Q25_MAX"];
                $output['Q25_MIN'] = $row["Q25_MIN"];
                $output['Q26_MAX'] = $row["Q26_MAX"];
                $output['Q26_MIN'] = $row["Q26_MIN"];
                $output['Q27_MAX'] = $row["Q27_MAX"];
                $output['Q27_MIN'] = $row["Q27_MIN"];
                $output['Q28_MAX'] = $row["Q28_MAX"];
                $output['Q28_MIN'] = $row["Q28_MIN"];
                
                
            }
            
            
            //json string 형식으로 변환 후 넘겨준다.
            echo json_encode($output);
        }
    }
}
// 부가세 고객 상세 뷰(기본) : 끝




// 부가세 고객 상세 뷰(기본) : 시작
if($action == "select_view_vat" && isset($_POST["id"])){
	
	//빈 배열을 만들고
	$output = array();

	//넘어온 id에 해당하는 row를 출력하는 프로시저 쿼리를 만든다.
	$procedure = "
		CREATE PROCEDURE SEL_VIEW_VAT(IN user_id int(100))
		BEGIN
			SELECT A.CSTID 'CSTID', B.BIZ_ID 'BIZ_ID', B.COMP_NAME 'COMP_NAME', A.CSTNAME 'CSTNAME', A.RESIDENT_ID 'RESIDENT_ID',
			B.BIZ_ID_NUM 'BIZ_ID_NUM', A.OPENING_DAY 'OPENING_DAY',
            DATE_FORMAT(A.OPENING_DAY, '%Y-%m-%d') 'OPENING_DAY_', 
            A.BIZ_REG_DATE, DATE_FORMAT(A.BIZ_REG_DATE, '%Y-%m-%d') 'BIZ_REG_DATE_',
			A.BIZ_CATE, A.COMP_ADDRESS, A.HomeTaxID, A.HomeTaxPW, A.COMP_PHONE, A.MOBILE, A.EMAIL, 
            A.E_NOTICE_DATE, DATE_FORMAT(A.E_NOTICE_DATE, '%Y-%m-%d') 'E_NOTICE_DATE_',
			A.DOUZONE_SVR,A.DOUZONE_CODE,B.REG_BRANCH, 
            B.REGDATE, DATE_FORMAT(A.REGDATE, '%Y-%m-%d') 'REGDATE_',
            B.REGUSER, 
            (SELECT VALUE_ FROM TB750010 WHERE CODE_ = B.CST_TYPE ) 'CST_TYPE',  
            B.INF_PATH, B.INF_CHANNEL, 
			B.UTM_S, B.UTM_C, B.UTM_T, B.UTM, B.EST_FEE, B.DEP_FEE, B.DEP_TYPE, 
            B.DEP_DATE, DATE_FORMAT(B.DEP_DATE, '%Y-%m-%d') 'DEP_DATE_',
            B.CASH_REC, B.CASH_REC_DATE, DATE_FORMAT(B.CASH_REC_DATE, '%Y-%m-%d') 'CASH_REC_DATE_',
   			B.SUBM_DATE, DATE_FORMAT(B.SUBM_DATE, '%Y-%m-%d') 'SUBM_DATE_', 
            B.SUBM_DATE2,  DATE_FORMAT(B.SUBM_DATE2, '%Y-%m-%d') 'SUBM_DATE2_',
            B.EXT_DATE, DATE_FORMAT(B.EXT_DATE, '%Y-%m-%d') 'EXT_DATE_', 
            B.COMP_REG_DATE, DATE_FORMAT(B.COMP_REG_DATE, '%Y-%m-%d') 'COMP_REG_DATE_', 
            B.DEC_REGUSER, B.REQ_E_REPORT, B.REQ_USER, B.ATTACH_FILE,
			B.REQ_DATE, DATE_FORMAT(B.REQ_DATE, '%Y-%m-%d') 'REQ_DATE_',
            B.COMP_DATE, DATE_FORMAT(B.COMP_DATE, '%Y-%m-%d') 'COMP_DATE_',
            B.NUM_E_REPORT, B.REC_REP, B.PAYMENT, 
            B.DEL_DATE_PAYMENT, DATE_FORMAT(B.DEL_DATE_PAYMENT, '%Y-%m-%d') 'DEL_DATE_PAYMENT_',
            B.DEL_TYPE_PAYMENT, 
            B.CONF_DATE_PAYMENT,	DATE_FORMAT(B.CONF_DATE_PAYMENT, '%Y-%m-%d') 'CONF_DATE_PAYMENT_',
            B.DOWN_PAYMENT, DATE_FORMAT(B.DOWN_PAYMENT, '%Y-%m-%d') 'DOWN_PAYMENT_',
            B.MEMO, B.ERROR, A.SECTOR
			FROM TB100020 AS A 
			LEFT OUTER JOIN TB100022 AS B ON A.CSTID =B.CSTID
			LEFT OUTER JOIN TB100024 AS C ON B.BIZ_ID=C.BIZ_ID
			WHERE A.CSTID = user_id;
		END;
		";
		//기존의 프로시저가 존재한다면 삭제 후
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SEL_VIEW_VAT"))
		{
			//위에서 선언한 프로시저 선언(1)
			if(mysqli_query($connect, $procedure))
			{
			//프로시저 호출(2)
				$query = "CALL SEL_VIEW_VAT(".$_POST["id"].")";
				$result = mysqli_query($connect, $query);

				while($row = mysqli_fetch_array($result))
				{
					//위에서 만든 배열에 넣어준다.
					$output['CSTID'] = $row["CSTID"];
					$output['BIZ_ID'] = $row["BIZ_ID"];
					$output['COMP_NAME'] = $row["COMP_NAME"];
					$output['CSTNAME'] = $row["CSTNAME"];
					$output['BIZ_ID_NUM'] = $row["BIZ_ID_NUM"];
					$output['RESIDENT_ID'] = $row["RESIDENT_ID"];
					$output['OPENING_DAY'] = $row["OPENING_DAY"];
					$output['OPENING_DAY_'] = $row["OPENING_DAY_"];
					$output['BIZ_REG_DATE'] = $row["BIZ_REG_DATE"];
					$output['BIZ_REG_DATE_'] = $row["BIZ_REG_DATE_"];
					$output['SECTOR'] = $row["SECTOR"];
					$output['BIZ_CATE'] = $row["BIZ_CATE"];
					$output['COMP_ADDRESS'] = $row["COMP_ADDRESS"];
					$output['HomeTaxID'] = $row["HomeTaxID"];
					$output['HomeTaxPW'] = $row["HomeTaxPW"];
					$output['COMP_PHONE'] = $row["COMP_PHONE"];
					$output['MOBILE'] = $row["MOBILE"];
					$output['EMAIL'] = $row["EMAIL"];
					$output['E_NOTICE_DATE'] = $row["E_NOTICE_DATE"];
					$output['E_NOTICE_DATE_'] = $row["E_NOTICE_DATE_"];
					$output['DOUZONE_SVR'] = $row["DOUZONE_SVR"];
					$output['DOUZONE_CODE'] = $row["DOUZONE_CODE"];
					$output['REG_BRANCH'] = $row["REG_BRANCH"];
					$output['REGDATE'] = $row["REGDATE"];
					$output['REGDATE_'] = $row["REGDATE_"];
					$output['REGUSER'] = $row["REGUSER"];
					$output['CST_TYPE'] = $row["CST_TYPE"];
					$output['INF_PATH'] = $row["INF_PATH"];
					$output['INF_CHANNEL'] = $row["INF_CHANNEL"];
					$output['UTM_S'] = $row["UTM_S"];
					$output['UTM_T'] = $row["UTM_T"];
					$output['UTM_C'] = $row["UTM_C"];
					$output['UTM'] = $row["UTM"];
					$output['EST_FEE'] = $row["EST_FEE"];
					$output['DEP_FEE'] = $row["DEP_FEE"];
					$output['DEP_TYPE'] = $row["DEP_TYPE"];
					$output['DEP_DATE'] = $row["DEP_DATE"];
					$output['DEP_DATE_'] = $row["DEP_DATE_"];
					$output['CASH_REC'] = $row["CASH_REC"];
					$output['CASH_REC_DATE'] = $row["CASH_REC_DATE"];
					$output['CASH_REC_DATE_'] = $row["CASH_REC_DATE_"];
					$output['SUBM_DATE'] = $row["SUBM_DATE"];
					$output['SUBM_DATE2'] = $row["SUBM_DATE2"];
					$output['SUBM_DATE_'] = $row["SUBM_DATE_"];
					$output['SUBM_DATE2_'] = $row["SUBM_DATE2_"];
					$output['EXT_DATE'] = $row["EXT_DATE"];
					$output['EXT_DATE_'] = $row["EXT_DATE_"];
					$output['ATTACH_FILE'] = $row["ATTACH_FILE"];
					$output['COMP_REG_DATE'] = $row["COMP_REG_DATE"];
					$output['COMP_REG_DATE_'] = $row["COMP_REG_DATE_"];
					$output['DEC_REGUSER'] = $row["DEC_REGUSER"];
					$output['REQ_E_REPORT'] = $row["REQ_E_REPORT"];
					$output['REQ_USER'] = $row["REQ_USER"];
					$output['REQ_DATE'] = $row["REQ_DATE"];
					$output['REQ_DATE_'] = $row["REQ_DATE_"];
					$output['COMP_DATE'] = $row["COMP_DATE"];
					$output['COMP_DATE_'] = $row["COMP_DATE_"];
					$output['NUM_E_REPORT'] = $row["NUM_E_REPORT"];
					$output['REC_REP'] = $row["REC_REP"];
					$output['PAYMENT'] = $row["PAYMENT"];
					$output['DEL_DATE_PAYMENT'] = $row["DEL_DATE_PAYMENT"];
					$output['DEL_DATE_PAYMENT_'] = $row["DEL_DATE_PAYMENT_"];
					$output['DEL_TYPE_PAYMENT'] = $row["DEL_TYPE_PAYMENT"];
					$output['CONF_DATE_PAYMENT'] = $row["CONF_DATE_PAYMENT"];
					$output['CONF_DATE_PAYMENT_'] = $row["CONF_DATE_PAYMENT_"];
					$output['DOWN_PAYMENT'] = $row["DOWN_PAYMENT"];
					$output['DOWN_PAYMENT_'] = $row["DOWN_PAYMENT_"];
					$output['MEMO'] = $row["MEMO"];
					$output['ERROR'] = $row["ERROR"];


				}


				//json string 형식으로 변환 후 넘겨준다.
				echo json_encode($output);
			}
		}
}
// 부가세 고객 상세 뷰(기본) : 끝



// 부가세 고객 상세 뷰(기본) : 시작
if($action == "select_view_inc" && isset($_POST["id"])){
    
    //빈 배열을 만들고
    $output = array();
    
    //넘어온 id에 해당하는 row를 출력하는 프로시저 쿼리를 만든다.
    $procedure = "
		CREATE PROCEDURE SEL_VIEW_INC(IN user_id int(100))
		BEGIN
			SELECT A.CSTID, A.CSTNAME, A.RESIDENT_ID, A.HomeTaxID, A.HomeTaxPW,A.MOBILE,A.EMAIL,
            D.DOUZONE_SVR, D.DOUZONE_CODE, A.MEMO, A.KAKAO_REG, A.REF_BANK, A.REF_ACC, A.ACC_HOLDER,
            NEW_CST_CK_STR(A.CSTID) AS 'NEW_CST_CK',A.MNG_GRADE,  CODE_TO_STR( SELECT_PROGRESS(B.BIZ_ID)) AS PROGRESS
            FROM TB100020 AS A 
            LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
            LEFT OUTER JOIN TB100025 AS C ON A.CSTID = C.CSTID
            LEFT OUTER JOIN TB100030 AS D ON A.CSTID = D.CSTID
			WHERE A.CSTID = user_id;
		END;
		";
    //기존의 프로시저가 존재한다면 삭제 후
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SEL_VIEW_INC"))
    {
        //위에서 선언한 프로시저 선언(1)
        if(mysqli_query($connect, $procedure))
        {
            //프로시저 호출(2)
            $query = "CALL SEL_VIEW_INC(".$_POST["id"].")";
            $result = mysqli_query($connect, $query);
            
            while($row = mysqli_fetch_array($result))
            {
                //위에서 만든 배열에 넣어준다.
                $output['CSTID'] = $row["CSTID"];
                $output['CSTNAME'] = $row["CSTNAME"];
                $output['RESIDENT_ID'] = $row["RESIDENT_ID"];
                $output['HomeTaxID'] = $row["HomeTaxID"];
                $output['HomeTaxPW'] = $row["HomeTaxPW"];
                $output['MOBILE'] = $row["MOBILE"];
                $output['EMAIL'] = $row["EMAIL"];
                $output['DOUZONE_SVR'] = $row["DOUZONE_SVR"];
                $output['DOUZONE_CODE'] = $row["DOUZONE_CODE"];
                $output['MEMO'] = $row["MEMO"];
                $output['KAKAO_REG'] = $row["KAKAO_REG"];
                $output['REF_BANK'] = $row["REF_BANK"];
                $output['REF_ACC'] = $row["REF_ACC"];
                $output['ACC_HOLDER'] = $row["ACC_HOLDER"];
                $output['NEW_CST_CK'] = $row["NEW_CST_CK"];
                $output['MNG_GRADE'] = $row["MNG_GRADE"];
                $output['PROGRESS'] = $row["PROGRESS"];
                
                
                
            }
            
            
            //json string 형식으로 변환 후 넘겨준다.
            echo json_encode($output);
        }
    }
}
// 종소세 고객 상세 뷰(기본) : 끝





//golf : 시작
if($action == "select_golf_reserv"){
	
	
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
	$depth =  $_POST["depth"];
	$userid =  $_POST["userid"];
	$s_date1 =  $_POST["s_date1"];
	$s_date2 =  $_POST["s_date2"];
	
	$query_str1 = "";
	$page = $_POST["page"];
	$page_set = 10; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수
	$style_cnt = 0;

	$head .= '
			<colgroup>
				<col width="100px">
				<col width="200px">
				<col width="200px">
				<col width="500px">
			</colgroup>
			<thead>
			<tr>
				<th>번호</th>
				<th>날짜</th>
				<th>예약상태</th>
				<th>에러내용</th>
			</tr>
			</thead>
			';


	$procedure = "
	CREATE PROCEDURE SELECT_GOLF()
	BEGIN
		SELECT ID,DATE_FORMAT(RESERV_DATE, '%Y-%m-%d') 'RESERV_DATE', 
		(
			CASE FLAG 
			WHEN '1' THEN '대기중'
			WHEN '2' THEN '처리완료'
			WHEN '3' THEN '오류'
			ELSE '' END
		)AS FLAG, ERROR_CONTENT
		FROM GOLF_RESERVATION;
	END;
	";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_GOLF"))
	{
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL SELECT_GOLF()";
			$result = mysqli_query($connect,$query) or die(mysqli_error($connect));
			
			if(mysqli_num_rows($result) >0)
			{

				while($row = mysqli_fetch_array($result)){

					$output .= '
					<tr>
						<td style="text-align:center;">'.$row["ID"].'</td>
						<td style="text-align:center;">'.$row["RESERV_DATE"].'</td>
						<td style="text-align:center;">'.$row["FLAG"].'</td>
						<td style="text-align:center;">'.$row["ERROR_CONTENT"].'</td>
					</tr>
					';
				}
			}
			else
			{
				$output .= '
				<tr>
				<td colspan="3" style="text-align:center;">데이터가 없습니다.</td>
				</tr>
				
				';
			}

			echo $head.$output;

		}

	} 


	
}
//golf


//notify : 시작
if($action == "notify"){

	$output = array();
	$p_id=$_POST["userid"];
	
	$query = "CALL SELECT_NOTIFY(".$p_id.")";
	$result = mysqli_query($connect, $query);

	while($row = mysqli_fetch_array($result))
	{
		$output['CONTENTS'] = $row["CONTENTS"];
		$output['ID'] = $row["ID"];
	}
	echo json_encode($output);
	
}
//notify


// 메인 > 멤버리스트 : 시작
if ($action == "select_member_main") {
    $query_str = '';
    $head .= '<ul>';

    $procedure = "
            	CREATE PROCEDURE SELECT_ADMIN_MEMBER()
            	BEGIN
            		SELECT A.*, B.VALUE_ 'DEPNAME', C.VALUE_ 'POSITION' from TB980010 AS A 
					LEFT OUTER JOIN TB750010 AS B ON A.DEPID = B.CODE_
					LEFT OUTER JOIN TB750010 AS C ON A.POSITION_ID = C.CODE_
					WHERE DEPID NOT IN ('D1000','D1999','D1016')
					AND USERID NOT IN(1167,1168,1169,1171,1175)
					ORDER BY DEPID, INNER_PHONE
					;

            	END;
            	   ";

    if (mysqli_query($connect, "DROP PROCEDURE IF EXISTS SELECT_ADMIN_MEMBER")) {
        if (mysqli_query($connect, $procedure)) {
            $query = "CALL SELECT_ADMIN_MEMBER()";
            $result = mysqli_query($connect, $query);
            $head .= '';

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    $output .= '
            					<tr>
                                        <td>'.$row['DEPNAME'].'</td>
                                        <td>'.$row['USERNAME'].'';

										/* 직급없는사람 괄호 처리*/
										$row['POSITION'] != '' ? $output .= '('.$row['POSITION'].')' : $output .='';
										/**/
										$output .= '</td>
                                        <td>'.$row['INNER_PHONE'].'</td>
                                        <td>'.$row['OUTER_PHONE'].'</td>
                                        <td>'.$row['MOBILE'].'</td>
                                </tr>
            					';
                }

                $output .= '</ul>';
            } else {
                $output .= '
				            <tr>
				                <td colspan="5" align="center">데이터가 없습니다.</td>
				            </tr>
                        </tbody>
				    </table>
				</div>
				            ';
            }

            echo $head . $output;
        }
    }
}
// 메인 > 멤버리스트 : 끝

// 메인 > 링크 : 시작
if ($action == "select_link") {
    $query_str = '';
    $head .= '<ul>';

    $procedure = "
            	CREATE PROCEDURE SELECT_MAIN_LINK()
            	BEGIN
            		SELECT 
                            A.VALUE_ ,                     #구분이름
                            SELECT_HEAD_FLAG(A.VALUE_) 'FLAG'
                           ,B.LINK                        #링크주소
                           ,B.LINK_NAME                   #링크이름
                           ,B.COMMENTS                    #링크설명
                           ,B.REGDATE                     #날짜
                    FROM 
                            dbsschina.TB750010 AS A       #구분코드이름
                    	   ,dbsschina.TB750020 AS B       #퀵링크
                    WHERE
                            A.CODE_ = B.FLAG    
            		ORDER BY FLAG;
            	END;
            	   ";

    if (mysqli_query($connect, "DROP PROCEDURE IF EXISTS SELECT_MAIN_LINK")) {
        if (mysqli_query($connect, $procedure)) {
            $query = "CALL SELECT_MAIN_LINK()";
            $result = mysqli_query($connect, $query);
            $head .= '';

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    $output .= '
            					<li>
                                    <span class="'.$row['FLAG'].'">'.$row['VALUE_'].'</span>
                                    <a href="javascript:popup(\''.$row['LINK'].'\');" >'.$row['LINK_NAME'].'</a>
                                </li>
            					';
                }

                $output .= '</ul>';
            } else {
                $output .= '
				            <tr>
				                <td colspan="5" align="center">데이터가 없습니다.</td>
				            </tr>
                        </tbody>
				    </table>
				</div>
				            ';
            }

            echo $head . $output;
        }
    }
}
// 메인 > 링크 : 끝


//4대보험 수정시 select : 시작
if($action == "select_4insu" && isset($_POST["id"])){
	$output = array();

	$procedure = "
		CREATE PROCEDURE SELECT_MODIFY_4INSU(IN user_id int(100))
		BEGIN
			SELECT A.*, B.USERNAME 'REGUSER_',C.VALUE_ 'REG_BRANCH_',D.VALUE_ 'PROGRESS_',
			DATE_FORMAT(A.REGDATE, '%Y-%m-%d') 'REGDATE_',
			E.USERNAME 'EDTUSER_',DATE_FORMAT(A.EDTDATE, '%Y-%m-%d') 'EDTDATE_',
            F.VALUE_ 'REG_DEPT_',G.VALUE_ 'QUEST_FLAG_' 
			FROM dbsschina.TB600020 AS A 
			LEFT OUTER JOIN TB980010 AS B ON B.USERID = A.REGUSER 
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB980010 AS E ON E.USERID = A.EDTUSER 
            LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.REG_DEPT 
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.QUEST_FLAG
			WHERE A.ID = user_id;
		END;
		";
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_MODIFY_4INSU"))
		{
			if(mysqli_query($connect, $procedure))
			{
				$query = "CALL SELECT_MODIFY_4INSU(".$_POST["id"].")";
				$result = mysqli_query($connect, $query);

				while($row = mysqli_fetch_array($result))
				{
					$output['CATE'] = $row["CATE"];
					$output['REGUSER'] = $row["REGUSER"];
					$output['REGUSER_'] = $row["REGUSER_"];
					$output['REGDATE'] = $row["REGDATE"];
					$output['REGDATE_'] = $row["REGDATE_"];
					$output['EDTUSER'] = $row["EDTUSER"];
					$output['EDTDATE'] = $row["EDTDATE"];
					$output['EDTUSER'] = $row["EDTUSER_"];
					$output['EDTDATE'] = $row["EDTDATE_"];
					$output['REG_BRANCH'] = $row["REG_BRANCH"];
					$output['REG_BRANCH_'] = $row["REG_BRANCH_"];
					$output['PROGRESS'] = $row["PROGRESS"];
					$output['PROGRESS_'] = $row["PROGRESS_"];
					$output['SUBJECT'] = $row["SUBJECT"];
					$output['SUBJECT'] = $row["SUBJECT"];
					$output['REG_DEPT'] = $row["REG_DEPT"];
					$output['REG_DEPT_'] = $row["REG_DEPT_"];
					$output['QUEST_FLAG'] = $row["QUEST_FLAG"];
					$output['QUEST_FLAG_'] = $row["QUEST_FLAG_"];
					$output['SVR_NUM'] = $row["SVR_NUM"];
					$output['CODE_NUM'] = $row["CODE_NUM"];
					$output['COMPANY_NAME'] = $row["COMPANY_NAME"];
					$output['COMPANY_PHONE'] = $row["COMPANY_PHONE"];
					$output['FILE_REAL_STR'] = $row["FILE_REAL_STR"];
					$output['FILE_VIEW_STR'] = $row["FILE_VIEW_STR"];
					$output['NUM'] = $row["NUM"];
					$output['CONTENTS'] = $row["CONTENTS"];
					$output['ETC'] = $row["ETC"];

				}
				echo json_encode($output);
			} 
		} 
}
//4대보험 수정시 select : 끝


//4대보험 list select : 시작
if($action == "select_4insu_list"){
	
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
	$depth =  $_POST["depth"];
	$userid =  $_POST["userid"];
	
	$query_str1 = "";
	$page = $_POST["page"];
	$page_set = 20; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수

	if($depth == "D2005" && $userid !=""){
		$WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
	}

	if($g_option != "ALL"){
		$WHERE_STR .= " AND A.REG_BRANCH = '".$g_option."'  ";
	}else{
		$WHERE_STR .= " ";
	}

	$query_cnt = "SELECT count(A.ID) as total FROM dbsschina.TB600020 AS A 
			LEFT OUTER JOIN TB980010 AS B ON B.USERID = A.REGUSER 
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB980010 AS E ON E.USERID = A.EDTUSER 
            LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.REG_DEPT 
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.QUEST_FLAG
			WHERE 1=1 ".$WHERE_STR;

	$result_cnt = mysqli_query($connect,$query_cnt) or die(mysqli_error($connect));


	$row = mysqli_fetch_array($result_cnt);

	$total = $row['total']; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치

	$head .= '
			<colgroup>
				<col width="50px">
				<col width="80px">
				<col width="80px">
				<col width="200px">
				<col width="150px">
				<col width="60px">
				<col width="60px">
				<col width="120px">
				<col width="80px">
				<col width="80px">
				<col width="110px">
				<col width="150px">
			</colgroup>
			<thead>
			<tr>
				<th>번호</th>
				<th>우선순위</th>
				<th>진행상태</th>
				<th>사업장상호</th>
				<th>문의유형</th>
				<th>서버</th>
				<th>코드번호</th>
				<th>연락처</th>
				<th>접수지점</th>
				<th>접수자</th>
				<th>접수일</th>
				<th>비고</th>
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
				$query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
				break;
			case "num" : 
				$query_str1 .= " AND A.NUM = '".$s_str."' ";
				break;
			default:
				$query_str1 ="";
		}	
	}

	if($_POST["g_option"] != "" && $_POST["g_option"] != "ALL"){
		$query_str1 .= " AND A.REG_BRANCH = '".$g_option."'";	
	}

	if($depth == "D2005" && $userid !=""){
		$query_str1 .= " AND A.REGUSER = '".$userid."'  ";
	}

	$procedure = "
	CREATE PROCEDURE SELECT_4INSU()
	BEGIN
		SELECT A.*, B.USERNAME 'REGUSER_',C.VALUE_ 'REG_BRANCH_', D.VALUE_ 'PROGRESS_',
			DATE_FORMAT(A.REGDATE, '%Y-%m-%d') 'REGDATE_',
			E.USERNAME 'EDTUSER_',DATE_FORMAT(A.EDTDATE, '%Y-%m-%d') 'EDTDATE_',
            F.VALUE_ 'REG_DEPT_',G.VALUE_ 'QUEST_FLAG_' 
			FROM dbsschina.TB600020 AS A 
			LEFT OUTER JOIN TB980010 AS B ON B.USERID = A.REGUSER 
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB980010 AS E ON E.USERID = A.EDTUSER 
            LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.REG_DEPT 
            LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.QUEST_FLAG
			WHERE 1=1 ".$query_str1." 
			ORDER BY A.ID DESC
			LIMIT $limit_idx, $page_set 
			;
	END;
	";

	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_4INSU"))
	{
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL SELECT_4INSU()";
			$result = mysqli_query($connect,$query) or die(mysqli_error($connect));
			$head .= '';
			$prog = "";
			$layer = "";

			if(mysqli_num_rows($result) >0)
			{

				while($row = mysqli_fetch_array($result)){
					$prog = $row["PROGRESS"];
					$prio = $row["PRIO_NUM"];

					if($style_cnt % 2 == 1 ){
						$style = 'style="background:#cbe1ec29;"';						
					}else{
						$style = '';
					}
					$style_cnt++;

					$output .= '
					<tr '.$style.'>
						<td style="text-align:center;padding:0px;"><a href="view_4insu.php?id='.$row["ID"].'" >'.$row["NUM"].'</a></td>
						<TD>
							<select style="height:35px;" id="prio_'.$row["ID"].'" name="prio_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
						
								$prio == "E7101" ? $output .= '<option value="E7101" selected>보통</option>' : $output .= '<option value="E7101">보통</option>';
								$prio == "E7102" ? $output .= '<option value="E7102" selected>중요</option>' : $output .='<option value="E7102">중요</option>';
								$prio == "E7103" ? $output .= '<option value="E7103" selected>긴급</option>' : $output .='<option value="E7103">긴급</option>';
								$prio == "E7104" ? $output .= '<option value="E7104" selected>중요긴급</option>' : $output .='<option value="E7104">중요긴급</option>';
								$prio == "E7105" ? $output .= '<option value="E7105" selected>우수사례</option>' : $output .='<option value="E7105">우수사례</option>';
						$output .='</select>
						</td>
						<td >
							<select style="height:35px;" id="prog_'.$row["ID"].'" name="PROGRESS" onchange="javascript:modify_option(this);">';
						
								$prog == "E7001" ? $output .= '<option value="E7001" selected>접수</option>' : $output .= '<option value="E7001">접수</option>';
								$prog == "E7005" ? $output .= '<option value="E7005" selected>인지</option>' : $output .='<option value="E7005">인지</option>';
								$prog == "E7002" ? $output .= '<option value="E7002" selected>검토</option>' : $output .='<option value="E7002">검토</option>';
								$prog == "E7004" ? $output .= '<option value="E7004" selected>보류</option>' : $output .='<option value="E7004">보류</option>';
								$prog == "E7003" ? $output .= '<option value="E7003" selected>완료</option>' : $output .='<option value="E7003">완료</option>';
						$output .='</select>
						</td>
						
						<td ><a href="view_4insu.php?id='.$row["ID"].'" >'.$row["COMPANY_NAME"].'</a></TD>
						<td ><a href="javascript:popup_(\''.$row["ID"].'\',\''.$row["QUEST_FLAG"].'\')" class="btn-example">'.$row["QUEST_FLAG_"].'</a></TD>
						<td >'.$row["SVR_NUM"].'</TD>
						<td >'.$row["CODE_NUM"].'</TD>
						<td >'.$row["COMPANY_PHONE"].'</TD>
						<td >'.$row["REG_BRANCH_"].'</TD>
						<td >'.$row["REGUSER_"].'</TD>
						<td >'.$row["REGDATE_"].'</TD>
						<td >'.$row["ETC"].'</TD>
										
					</tr>
					';

				}
			}
			else
			{
				$output .= '
				<tr>
				<td colspan="13" style="text-align:center;">데이터가 없습니다.</td>
				</tr>
				
				';
			}

			echo $head.$output.$layer;

		}

	} 



}
//4대보험 list select : 끝


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
			I.USERNAME 'OWNER_',
            format(PRICE,0) 'PRICE_',
			format(PRICE2,0) 'PRICE2_',
            format(TRANS_PRICE,0) 'TRANS_PRICE_',
            format(ACQ_PRICE,0) 'ACQ_PRICE_',
			A.NUM,
            J.VALUE_ 'PRIO_NUM_',
			FX_MOBILE(A.MOBILE) 'MOBILE',
			DATE_FORMAT(A.REP_DATE, '%Y-%m-%d') 'REP_DATE_',
			DATE_FORMAT(A.REGDATE, '%Y-%m-%d') 'REGDATE_',
			A.REP_NUM
			FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON A.REGUSER = B.USERID
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
            LEFT OUTER JOIN TB750010 AS J ON J.CODE_ = A.PRIO_NUM
			WHERE VISIBLE='Y' AND A.ID = user_id;
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
					$output['REGDATE_'] = $row["REGDATE_"];
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
					$output['PRICE_'] = $row["PRICE_"];
					$output['PRICE2_'] = $row["PRICE2_"];
					$output['MANAGER'] = $row["MANAGER"];
					$output['TRANS_DATE_'] = $row["TRANS_DATE_"];
					$output['ACQ_DATE_'] = $row["ACQ_DATE_"];
					$output['DELIVERY_FLAG'] = $row["DELIVERY_FLAG"];
					$output['DELIVERY_FLAG_'] = $row["DELIVERY_FLAG_"];
					$output['CONTENTS'] = $row["CONTENTS"];
					$output['TRANS_PRICE_'] = $row["TRANS_PRICE_"];
					$output['ACQ_PRICE_'] = $row["ACQ_PRICE_"];
					$output['DEADLINE_'] = $row["DEADLINE_"];
					$output['TOTAL_TAX_'] = $row["TOTAL_TAX_"];
					$output['FILE_REAL_STR'] = $row["FILE_REAL_STR"];
					$output['FILE_REAL_STR_'] = mb_convert_encoding($row["FILE_REAL_STR"],"UTF-8","EUC-KR");
					$output['FILE_VIEW_STR'] = $row["FILE_VIEW_STR"];
					$output['REGUSER_'] = $row["REGUSER_"];
					$output['OWNER_'] = $row["OWNER_"];
					$output['OWNER_USER'] = $row["OWNER_USER"];
					$output['NUM'] = $row["NUM"];
					$output['PRIO_NUM'] = $row["PRIO_NUM"];
					$output['PRIO_NUM_'] = $row["PRIO_NUM_"];
					$output['REP_DATE_'] = $row["REP_DATE_"];
					$output['REP_NUM'] = $row["REP_NUM"];
					$output['ETC'] = $row["ETC"];
					$output['OPTION_PRICE'] = $row["OPTION_PRICE"];

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
	$depid =  $_POST["depid"];
	$userid =  $_POST["userid"];
	$s_date1 =  $_POST["s_date1"];
	$s_date2 =  $_POST["s_date2"];
	
	$query_str1 = "";
	$page = $_POST["page"];
	$page_set = 100; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수
	$style_cnt = 0;

	if($depid == "D1016" && $userid !=""){
		$WHERE_STR .= " AND A.REGUSER = '".$userid."'  ";
	}

	if($g_option != "ALL"){
		$WHERE_STR .= " AND A.REG_BRANCH = '".$g_option."'  ";
	}else{
		$WHERE_STR .= " ";
	}

	
	if($_POST["s_option"] != ""){
		switch($s_option){
			case "cstname" : 
				$WHERE_STR .= " AND A.CSTNAME like '%".$s_str."%' ";
				break;
			case "owner" : 
				$WHERE_STR .= " AND I.USERNAME like '%".$s_str."%' ";
				break;
			case "progress" : 
				$WHERE_STR .= " AND PROGRESS like '%".$s_str."%' ";
				break;
			case "reguser" : 
				$WHERE_STR .= " AND B.USERNAME like '%".$s_str."%' ";
				break;
			case "mobile" : 
				$WHERE_STR .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
				break;
			case "num" : 
				$WHERE_STR .= " AND A.ID = '".$s_str."' ";
				break;
			case "etc" : 
				$WHERE_STR .= " AND A.ETC LIKE '%".$s_str."%' ";
				break;
			case "deadline" : 
				$WHERE_STR .= " AND A.DEADLINE BETWEEN '".$s_date1."' AND '".$s_date2."' ";
				break;
			default:
				$WHERE_STR ="";
		}	
	}


	$query_cnt = "SELECT count(A.ID) as total FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON A.REGUSER = B.USERID
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			LEFT OUTER JOIN TB750010 AS J ON J.CODE_ = A.PRIO_NUM
			WHERE VISIBLE='Y' ".$WHERE_STR;

	$result_cnt = mysqli_query($connect,$query_cnt) or die(mysqli_error($connect));

	$row = mysqli_fetch_array($result_cnt);

	$total = $row["total"]; // 전체글수
	$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
	$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

	if (!$page) $page = 1; // 현재페이지(넘어온값)
	$block = ceil ($page / $block_set); // 현재블럭(올림함수)
	$limit_idx = ($page - 1) * $page_set; // limit시작위치

	$head .= '
			<colgroup>
				<col width="50px">
				<col width="100px">
				<col width="80px">
				<col width="160px">
				<col width="140px">
				<col width="80px">
				<col width="70px">
				<col width="100px">
				<col width="80px">
				<col width="100px">
				<col width="100px">
				<col width="100px">
				<col width="50px">
				<col width="100px">

			</colgroup>
			<thead>
			<tr>
				<th>번호</th>
				<th>우선순위</th>
				<th>진행상태</th>
				<th>납세자명</th>
				<th>납세자연락처</th>
				<th>세목</th>
				<th>접수지점</th>
				<th>접수일</th>
				<th>담당세무사</th>
				<th>신고기한</th>
				<th>신고일</th>
				<th>수수료(원)</th>
				<th>납부</th>
				<th>비고</th>

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
				$query_str1 .= " AND RETURN_STR(A.MOBILE) like '%".$s_str."%' ";
				break;
			case "num" : 
				$query_str1 .= " AND A.ID = '".$s_str."' ";
				break;
			case "etc" : 
				$query_str1 .= " AND A.ETC LIKE '%".$s_str."%' ";
				break;
			case "deadline" : 
				$query_str1 .= " AND A.DEADLINE BETWEEN '".$s_date1."' AND '".$s_date2."' ";
				break;
			default:
				$query_str1 ="";
		}	
	}

	if($_POST["g_option"] != "" && $_POST["g_option"] != "ALL"){
		$query_str1 .= " AND A.REG_BRANCH = '".$g_option."'";	
	}

	if($depid == "D1016" && $userid !=""){
		$query_str1 .= " AND A.REGUSER = '".$userid."'  ";
		$query_owner = "SELECT * FROM TB980010 WHERE USERID = '".$userid."';";
	}else{
		$query_owner = "SELECT * FROM TB980010 WHERE DEPID IN ('D1013','D1016');";		
	}


//	$query_owner = "SELECT * FROM TB980010 WHERE DEPID = 'D1013';";
	$result_owner = mysqli_query($connect,$query_owner) or die(mysqli_error($connect));
	$output_owner .= '
	';

	if(mysqli_num_rows($result_owner) >0)
	{
		while($row_owner = mysqli_fetch_array($result_owner)){
			$output_owner.= '<option value="'.$row_owner["USERID"].'">'.$row_owner["USERNAME"].'</option>';	
		}
	}
	$output_owner.= '</select>';


	$procedure = "
	CREATE PROCEDURE SELECT_TRANS()
	BEGIN
		SELECT A.*, B.USERNAME 'REGUSER_',C.VALUE_ 'REG_BRANCH',D.VALUE_ 'PROGRESS_' ,
			E.VALUE_ 'TAX_FLAG',F.VALUE_ 'TRANS_TARGET',G.VALUE_ 'PAY_FLAG_',H.VALUE_ 'DELIVERY_FLAG',DATE_FORMAT(A.PAY_DATE, '%Y-%m-%d') 'PAY_DATE_',
			 DATE_FORMAT(A.TRANS_DATE, '%y-%m-%d') 'TRANS_DATE_',
            DATE_FORMAT(A.ACQ_DATE, '%y-%m-%d') 'ACQ_DATE_',
            DATE_FORMAT(A.DEADLINE, '%y-%m-%d') 'DEADLINE_',
			DATE_FORMAT(A.REGDATE, '%y-%m-%d') 'REGDATE_',
            I.USERNAME 'OWNER_',
            format(PRICE+PRICE2,0) 'PRICE_',
            format(TRANS_PRICE,0) 'TRANS_PRICE_',
            format(ACQ_PRICE,0) 'ACQ_PRICE_',
            format(TOTAL_TAX,0) 'TOTAL_TAX_',
            J.VALUE_ 'PRIO_NUM_', 
			FX_MOBILE(A.MOBILE) 'MOBILE',
			DATE_FORMAT(A.REP_DATE, '%y-%m-%d') 'REP_DATE_',
			REPLACE(A.ETC,'\"','') 'ETC_'
			FROM dbsschina.TB600010 AS A 
			LEFT OUTER JOIN TB980010 AS B ON B.USERID = A.REGUSER 
			LEFT OUTER JOIN TB750010 AS C ON C.CODE_ = A.REG_BRANCH
			LEFT OUTER JOIN TB750010 AS D ON D.CODE_ = A.PROGRESS
			LEFT OUTER JOIN TB750010 AS E ON E.CODE_ = A.TAX_FLAG
			LEFT OUTER JOIN TB750010 AS F ON F.CODE_ = A.TRANS_TARGET
			LEFT OUTER JOIN TB750010 AS G ON G.CODE_ = A.PAY_FLAG
			LEFT OUTER JOIN TB750010 AS H ON H.CODE_ = A.DELIVERY_FLAG
            LEFT OUTER JOIN TB980010 AS I ON I.USERID = A.OWNER_USER
			LEFT OUTER JOIN TB750010 AS J ON J.CODE_ = A.PRIO_NUM
			WHERE VISIBLE='Y' ".$query_str1." 
			ORDER BY A.REGDATE DESC, A.ID DESC 
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
			$icon_new = "";

			if(mysqli_num_rows($result) >0)
			{

				while($row = mysqli_fetch_array($result)){
					$prog = $row["PROGRESS"];
					$prio = $row["PRIO_NUM"];
					$pay = $row["PAY_FLAG"];
					$owner = $row["OWNER_USER"];
					$regdate = $row["REGDATE"];
					$taxflag = $row["TAX_FLAG"];
					$icon_new = "";
					$date1 = new DateTime("now");
					$date2 = new DateTime($regdate);
					$interval = date_diff($date1, $date2);
					$diff_h = $interval->format('%h');
					$diff_d = $interval->format('%d');

					if($diff_d < 1 && $diff_h < 24){
						$icon_new = "<img src='../resources/images/icons/new.gif' style='width:20px;height:20px;margin:-5px 0 0 3px;'>";
					}

					if($taxflag=="상담"){
						$taxflag_new = "font-weight:600;color:#205fb1;";
					}else{
						$taxflag_new = "";
					}


					if($style_cnt % 2 == 1 ){
						$style = 'style="background:#cbe1ec29;"';						
					}else{
						$style = '';
					}

					switch($prio){
						case "E7101" : $style2="white"; break;
						case "E7102" : $style2="#f0ee57"; break;
						case "E7103" : $style2="#fb9e24;color:white"; break;
						case "E7104" : $style2="#de2519;color:white"; break;
						case "E7105" : $style2="cornflowerblue;color:white"; break;
						default: $style2="white;color:black;"; break;
					}
					
					switch($pay){
						case "E3002" : 
							$style3 ="background-color:#de2519;color:white;";
						break;
						case "E3003" : 
							$style3 ="background-color:#fb9e24;color:white;";
						break;
						default:$style3 ="background-color:white;color:black;";
					}

					
					$style_cnt++;

					$output .= '
					<tr '.$style.' >
						<td style="text-align:center;padding:0px;">'.$row["ID"].'</td>
						<td style="text-align:center;padding:0px;">
							<select style="height:35px;background-color:'.$style2.';" id="prio_'.$row["ID"].'" name="prio_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
						
								$prio == "E7101" ? $output .= '<option value="E7101" style="background-color:white;color:black;" selected>보통</option>' : $output .= '<option style="background-color:white;color:black;"  value="E7101">보통</option>';
								$prio == "E7102" ? $output .= '<option value="E7102" selected style="background-color:#f0ee57;color:black;">중요</option>' : $output .='<option value="E7102" style="background-color:#f0ee57;color:black;">중요</option>';
								$prio == "E7103" ? $output .= '<option value="E7103" style="background-color:#fb9e24;color:white;" selected>긴급</option>' : $output .='<option  style="background-color:#fb9e24;color:white;" value="E7103">긴급</option>';
								$prio == "E7104" ? $output .= '<option style="background-color:#de2519;color:white;" value="E7104" selected>중요긴급</option>' : $output .='<option style="background-color:#de2519;color:white;" value="E7104">중요긴급</option>';
								$prio == "E7105" ? $output .= '<option style="background-color:cornflowerblue;color:white;" value="E7105" selected>우수사례</option>' : $output .='<option value="E7105" style="background-color:cornflowerblue;color:white;">우수사례</option>';
						$output .='</select>
						</td>
						<td >
							<select style="height:35px;" id="prog_'.$row["ID"].'" name="prog_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
						
								$prog == "E5001" ? $output .= '<option value="E5001" selected>접수</option>' : $output .= '<option value="E5001">접수</option>';
								$prog == "E5002" ? $output .= '<option value="E5002" selected>1차검토</option>' : $output .='<option value="E5002">1차검토</option>';
								$prog == "E5003" ? $output .= '<option value="E5003" selected>2차검토</option>' : $output .='<option value="E5003">2차검토</option>';
								$prog == "E5004" ? $output .= '<option value="E5004" selected>3차검토</option>' : $output .='<option value="E5004">3차검토</option>';
								$prog == "E5005" ? $output .= '<option value="E5005" selected>계약해지</option>' : $output .='<option value="E5005">계약해지</option>';
								$prog == "E5006" ? $output .= '<option value="E5006" selected>결제완료</option>' : $output .='<option value="E5006">결제완료</option>';
								$prog == "E5007" ? $output .= '<option value="E5007" selected>최종완료</option>' : $output .='<option value="E5007">최종완료</option>';

						$output .='</select>
						</td>
						<td style="padding:10px;"><span data-tooltip-text="'.$row["CSTNAME"].'" ><a style="'.$taxflag_new.'" href="javascript:go_view('.$row["ID"].');"><b> '.mb_strimwidth($row['CSTNAME'],'0','12','...','utf-8').'</b></a></span>'.$icon_new.'</td>
						<td>'.$row["MOBILE"].'</td>
						<td style="text-align:center;padding:0px;'.$taxflag_new.'">'.$row["TAX_FLAG"].'</td>
						
						<td style="text-align:center;padding:0px;">'.$row["REG_BRANCH"].'</td>
						
						<td>'.$row["REGDATE_"].'</td>
						<td style="text-align:center;padding:0px;">
						<select id="select_owner_'.$row["ID"].'" name="select_owner_'.$row["ID"].'" onchange="javascript:modify_owner(this);">
							<option value=""></option>
							'.$output_owner.'
							<script>javascript:sel_owner("'.$row["ID"].'","'.$row["OWNER_USER"].'");</script>
						</td>
						
						<td>'.$row["DEADLINE_"].'</td>
						<td>'.$row["REP_DATE_"].'</td>
						
						<td style="text-align:right;">'.$row["PRICE_"].'</td>
						<td style="padding:0px;">
							<select style="height:35px;text-align-last:right; '.$style3.' " id="pay_'.$row["ID"].'" name="pay_'.$row["ID"].'" onchange="javascript:modify_option(this);">';
						
								$pay == "E3001" ? $output .= '<option value="E3001" selected>완납</option>' : $output .= '<option value="E3001">완납</option>';
								$pay == "E3002" ? $output .= '<option value="E3002" selected>미납</option>' : $output .='<option value="E3002">미납</option>';
								$pay == "E3003" ? $output .= '<option value="E3003" selected>일부납부</option>' : $output .='<option value="E3003">일부납부</option>';

						$output .='</select>
						
						</td>
						<td><DIV id="memo_lbl_'.$row["ID"].'" style="width:280px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.mb_strimwidth($row['ETC_'],'0','40','...','utf-8').'</DIV><input style="width:280px; height:25px;display:none;" type="text" id="memo_ip_'.$row["ID"].'" value="'.$row['ETC_'].'" style="display:none;padding-top:10px;" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27)memo_submit(this);" ></input></td>
						
					</tr>
					';
				}
			}
			else
			{
				$output .= '
				<tr>
				<td colspan="14" style="text-align:center;">데이터가 없습니다.</td>
				</tr>
				
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
			SELECT A.*, B.CODE_ AS 'DEPID' 
			, C.VALUE_ 'POSITION' 
			, C.CODE_ 'POSITION_ID' 
			FROM dbsschina.TB980010 AS A 
			LEFT OUTER JOIN TB750010 AS B ON A.DEPID = B.CODE_
			LEFT OUTER JOIN TB750010 AS C ON A.POSITION_ID = C.CODE_
			WHERE USERID = user_id
			AND DEPID NOT IN ('D1000','D1999')
			AND USERID NOT IN(1167,1168,1169,1171,1175)
			;
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
				$output['POSITION'] = $row["POSITION"];
				$output['POSITION_ID'] = $row["POSITION_ID"];
				$output['INNER_PHONE'] = $row["INNER_PHONE"];
				$output['OUTER_PHONE'] = $row["OUTER_PHONE"];
				$output['MOBILE'] = $row["MOBILE"];
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
				<th>직급</th>
				<th>등록일</th>
				<th>수정일</th>
				<th>수정</th>
				</tr>
			</thead>
			';

	$procedure = "
	CREATE PROCEDURE SELECT_ADMIN_MEMBER()
	BEGIN
		SELECT A.*, B.VALUE_ AS 'DEPNAME' 
		, C.VALUE_ 'POSITION' 
		FROM dbsschina.TB980010 AS A 
		LEFT OUTER JOIN TB750010 AS B ON A.DEPID = B.CODE_ 
		LEFT OUTER JOIN TB750010 AS C ON A.POSITION_ID = C.CODE_
		WHERE 1=1 ".$query_str."
		AND DEPID NOT IN ('D1000','D1999')
		AND USERID NOT IN(1167,1168,1169,1171,1175)
		ORDER BY DEPID, INNER_PHONE;
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
					<td>'.$row["POSITION"].'</td>
					<td>'.$row["REGDATE"].'</td>
					<td>'.$row["EDTDATE"].'</td>
					<td style="text-align:center;"><a href="reg_member_admin.php?id='.$row["USERID"].'">수정</a></td>
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
					$_SESSION['DEPTH_ID'] = $row["DEPTH_ID"];
					$_SESSION['POSITION_ID'] = $row["POSITION_ID"];
				}

				$_SESSION['user_id'] = $id;
				echo 'login_ok';
			}
		}
	}


}
//로그인 : 끝



// 면세사업장현황신고 신청 : 시작
if($action == "select_exem"){
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

	$footer="";

	$query_str1 = "";
	$query_str2 = "";
	$query_str4 = "";


	$page = $_POST["page"];

	$page_set = 12; // 한페이지 줄수
	$block_set = 5; // 한페이지 블럭수


	$query = "SELECT COUNT(1) AS total
FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
WHERE B.CST_TYPE = 'A1004' ";

	$result = mysqli_query($connect,$query) or die(mysqli_error($connect));

	$row = mysqli_fetch_array($result);


	$total = $row["total"]; // 전체글수
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
			$query_str1 .= " AND RETURN_STR(MOBILE) like '%".$s_str."%' ";
			break;
		
		default:
			$query_str1 ="";
		}

		


	//users테이블 조회 프로시져를 만든다.
	$procedure = "
	CREATE PROCEDURE SELECT_EXEM()
	BEGIN
	SELECT *
	,date_format(B.REGDATE,'%Y-%m-%d %H:%i') as REGDATE_
	,FX_MOBILE(A.MOBILE) AS MOBILE_
	,FORMAT(EST_FEE, 0) AS EST_FEE_
	FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B ON A.CSTID = B.CSTID
	WHERE B.CST_TYPE = 'A1004' ".$query_str1.$query_str2.$query_str4." ORDER BY A.REGDATE DESC LIMIT $limit_idx, $page_set;
	END;
	";

	//기존에 프로시져가 존재한다면 지운다.
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_EXEM"))
	{
		//mysqli_query:DB에 쿼리 전송
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL SELECT_EXEM()";

			///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
			$result = mysqli_query($connect,$query);
			$head .= '
			<colgroup>
				<col width="70px">
				<col width="100px">
				<col width="150px">
				<col width="150px">
				<col width="150px">
			</colgroup>
			<thead>
			<tr>
				<th>ID</th>
				<th>이름</th>
				<th>핸드폰번호</th>
				<th>신청일</th>
				<th>수수료</th>
				</tr>
			</thead>
			';

			//mysqli_num_rows 함수는 리절트 셋(result set)의 총 레코드 수를 반환한다.
			if(mysqli_num_rows($result) >0)
			{

				while($row = mysqli_fetch_array($result)){

					$output .= '
					<tr>
					<td>'.$row["CSTID"].'</td>
					<td>'.$row["CSTNAME"].'</td>
					<td>'.$row["MOBILE_"].'</td>
					<td>'.$row["REGDATE_"].'</td>
					<td>'.$row["EST_FEE_"].'</td>
					</tr>

					';
				} //WHILE 끝
			}// IF 끝
			else
			{
				$output .= '
				<tr>
				<td colspan="12" align="center">데이터가 없습니다..</td>
				</tr>
				';
			}
			
			echo $head.$output;

			

		} 

	}

}
// 면세사업장현황신고 신청 : 끝



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

	$total = $row['total']; // 전체글수
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
			$query_str1 .= " AND RETURN_STR(MOBILE) like '%".$s_str."%' ";
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

	$total = $row['total']; // 전체글수
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
			$query_str1 .= " AND RETURN_STR(MOBILE) like '%".$s_str."%' ";
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
if($action == "select_news_list"){
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

	$total = $row['total']; // 전체글수
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
