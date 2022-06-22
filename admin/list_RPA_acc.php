	<div class="wrap">
<?php
include "top.php";


?>		

		<div class="content" style="width: 2030px;">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				<div class="boardwrite" style="display:none;" id="boardwrite" name="boardwrite">
					<table style="width:100%">
						<tbody>
							<tr>
								<td style="width:160px;" >
									<h2><i>1. 기본정보</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th style="width:110px;">성명</td>
								<td><input type=box class="w150p" id="CSTNAME" name="CSTNAME"></td>
								<th>핸드폰번호</td>
								<td><input type=box class="w150p" id="MOBILE" name="MOBILE" onkeypress="return digit_check(event,this)"></td>
								<th>접수지점</td>
								<td>
									<div class="selectbox w150p">
										<label for="">선택</label>
										<select name="REG_BRANCH" id ="REG_BRANCH" class="s50" onchange="javascript:ch_branch(this);">
											<option value="D1019" selected>세무톡</option>
											<option value="D1003">강남</option>
											<option value="D1002">회계본부</option>
											<option value="D1014">영업본부</option>
											<option value="D1014">세무본부</option>
                							<option value="D1004">용인</option>
                							<option value="D1006">안양</option>
                							<option value="D1007">수원</option>
                							<option value="D1008">일산</option>
                							<option value="D1009">부천</option>
                							<option value="D1010">광주</option>
                							<option value="D1011">분당</option>
                							<option value="D1012">기흥</option>
                							<option value="D1021">동탄</option>
										</select>
									</div>
								</td>
								<th>신고담당자</td>
								<td>
									<select name="DEC_REGUSER" id ="DEC_REGUSER">
									</select>
								</td>
							</tr>
							
							<tr>
								<td>
									<h2><i>2. 입금확인</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>예상수수료</td>
								<td colspan=7>
									<input type="box" class="w300p" name="EST_FEE" id="EST_FEE" onkeypress="return digit_check(event)">
								</td>
								
							</tr>
							<tr>
								<td>
									<h2><i>3. 영수증 발급</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>입금금액</td>
								<td colspan=7>
									<input type="box" class="w300p" name="DEP_FEE" id="DEP_FEE" onkeypress="return digit_check(event)">
								</td>
								
							</tr>
							<tr>
								<td>
									<h2><i>4. 수임동의/안내문/지급명세서</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>주민번호</td>
								<td colspan=7>
									<input type="box" class="w150p" name="RESIDENT_ID1" id="RESIDENT_ID1" onkeypress="return digit_check(event)">&nbsp;-&nbsp;
									<input type="box" class="w150p" name="RESIDENT_ID2" id="RESIDENT_ID2" onkeypress="return digit_check(event)">
								</td>
								
							</tr>
							<tr>
								<td>
									<h2><i>5. 회사등록</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>서버</td>
								<td colspan=7>
									<div class="selectbox w300p">
										<label for="">선택</label>
										<select name="SMARTA_REG_SERVER" id ="SMARTA_REG_SERVER">
										<option selected="selected">선택</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										</select>
									</div>
								</td>
								
							</tr>
							<tr>
								<td rowspan=2>
									<h2><i>6. 전자신고</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>서버</td>
								<td colspan=3>
									
									<select name="DOUZONE_SVR" id ="DOUZONE_SVR">
										<option value="">선택</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>
								
								</td>
								<th>코드</td>
								<td colspan=3>
									<input type=box class="w300p" name="DOUZONE_CODE" id ="DOUZONE_CODE">
								</td>
								
							</tr>
							<tr>
								<th>환급액</th>
								<td>
									<input type=box class="w150p" name="ACC_TAX" id ="ACC_TAX" onkeypress="return digit_check(event)">
								</td>
								<th>환급은행</th>
								<td>
									<div class="selectbox w150p">
										<label for="">선택</label>
										<select name="REF_BANK" id ="REF_BANK">
											<option value="" selected="selected">선택</option>
											<option value="SC제일은행">SC제일은행</option>
											<option value="경남은행">경남은행</option>
											<option value="광주은행">광주은행</option>
											<option value="국민은행">국민은행</option>
											<option value="기업은행">기업은행</option>
											<option value="NH농협은행">NH농협은행</option>
											<option value="농축협">농축협</option>
											<option value="대구은행">대구은행</option>
											<option value="부산은행">부산은행</option>
											<option value="산립조합">산립조합</option>
											<option value="산업은행">산업은행</option>
											<option value="상호저축은행">상호저축은행</option>
											<option value="새마을금고">새마을금고</option>
											<option value="신용협동조합">신용협동조합</option>
											<option value="수협">수협</option>
											<option value="신한은행">신한은행</option>
											<option value="우리은행">우리은행</option>
											<option value="우체국">우체국</option>
											<option value="전북은행">전북은행</option>
											<option value="제주은행">제주은행</option>
											<option value="카카오뱅크">카카오뱅크</option>
											<option value="케이뱅크">케이뱅크</option>
											<option value="하나은행">하나은행</option>
											<option value="한국씨티은행">한국씨티은행</option>
										</select>
									</div>
								</td>
								<th>환급계좌</td>
								<td>
									<input type=box class="w150p" id="REF_ACC" name="REF_ACC" onkeypress="return digit_check(event)">
								</td>
								<th>계좌주</th>
								<td>
									<input type=box class="w150p" id="ACC_HOLDER" name="ACC_HOLDER">
								</td>
								
							</tr>
							<tr>
								<td>
									<h2><i>7. 납부서 전송</i><!--strong>id/pw 스크래핑</strong--></h2>
								</td>
								<th>전달방법</td>
								<td colspan=3>
									<input type="box" class="w300p" name="DEL_TYPE_PAYMENT" id="DEL_TYPE_PAYMENT">
								</td>
								<th>E-MAIL</td>
								<td colspan=3>
									<input type="box" class="w300p" name="EMAIL" id="EMAIL">
								</td>
								
							</tr>
							
							
						</tbody>
					</table>
				</div>

				<div class="btn w100">
					<button style="cursor:pointer; display:none;" class="b_newadd"   name="action_mod" id="action_mod">수정저장</button>
					<button style="cursor:pointer; display:none;" class="b_newadd"   name="action" id="action">신규저장</button>
					<!-- button style="cursor:pointer;" name="open_div" id="open_div">RPA등록 열기</button-->
					<button style="cursor:pointer; display:none;" name="close_div" id="close_div">닫기</button>
					
				</div>
				
                <div class="search">
        			<div class="selectbox w100p" >
						<label for="">귀속연도</label>
						<select name="y_option" id ="y_option">
							<option value="all">귀속연도-전체</option>
							<option value="2021">2021</option>
							<option value="2020">2020</option>
							<option value="2019">2019</option>
						</select>
					</div>
					
					<div class="selectbox w100p" >
						<label for="">선택</label>
						<select name="g_option" id ="g_option">
							<option value = "">검색조건</option>
							<option value="CSTID">ID</option>
							<option value="CSTNAME" selected>이름</option>
							<option value="MOBILE">핸드폰</option>
							<option value="RESI">주민번호</option>
							<option value="REGUSER">작성자</option>
							<option value="MEMO">메모</option>
						</select>
					</div>
					<input type="box" style="height: 38px;" class="w200p" id="s_str" name="s_str">
					<button class="b_search" id="btn_search" name="btn_search" style="cursor:pointer;">조회</button>
					<button class="b_reset" id="btn_cancel" name="btn_cancel" style="cursor:pointer;">새로고침</button>
					<button class="b_newadd" name="open_div" id="open_div" style="background: #146cc5;color:white;cursor:pointer;">신규등록</button>
					<button class="b_newadd"  name="excel_upload" id="excel_upload" style="cursor:pointer;background-color:#7c42a2;color:white;">대량업로드</button>
                	<button class="b_newadd"  name="excel" id="excel" style="cursor:pointer;background-color:#426921;color:white;">엑셀다운</button>
                	<button class="b_newadd" style="cursor:pointer;" name="btn_acc" id="btn_acc">입금확인</button>
					<button class="b_newadd" style="cursor:pointer;" name="btn_cash" id="btn_cash">현금영수증확인</button>
					<button class="b_newadd"  name="list_kakao_send" id="list_kakao_send" style="cursor:pointer;background-color:#ffdc40;color:black;">알림톡로그</button>
					<button class="b_newadd"  name="list_cst_review" id="list_cst_review" style="cursor:pointer;background-color:#aadc70;color:black;">고객리뷰</button>
					
                </div>
                
				<div class="search">
						
						<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="prog_option" id ="prog_option">
    							<option value="">진행상태-전체</option>
    							<option value="E7227">사전안내</option>
    							<option value="E7228">세액안내</option>
    							<option value="E7229">사전추출</option>
    							<option value="E7216">카톡등록</option>
    							<option value="E7217">입금확인</option>
    							<option value="E7218">현영발행</option>
    							<option value="E7219">수임동의</option>
    							<option value="E7220">자료추출</option>
    							<option value="E7221">회사등록</option>
    							<option value="E7222">자동장부</option>
    							<option value="E7223">신고작성</option>
    							<option value="E7224">전자신고</option>
    							<option value="E7225">완료안내</option>
    							<option value="E7226">해지환불</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="isnew_option" id ="isnew_option">
    							<option value="">신규여부-전체</option>
    							<option value="Y">신규</option>
    							<option value="N">기존</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w150p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="cashreport_option" id ="cashreport_option">
    							<option value="">현금영수증-전체</option>
    							<option value="R">예약</option>
    							<option value="I">실행중</option>
    							<option value="Y">완료</option>
    							<option value="E">에러</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="agree_option" id ="agree_option">
    							<option value="">수임동의-전체</option>
    							<option value="R">예약</option>
    							<option value="I">실행중</option>
    							<option value="Y">완료</option>
    							<option value="E">에러</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="e_option3" id ="e_option3">
    							<option value="">자료추출-전체</option>
    							<option value="R">예약</option>
    							<option value="I">실행중</option>
    							<option value="Y">완료</option>
    							<option value="E">에러</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="reg_option" id ="reg_option">
    							<option value="">회사등록-전체</option>
    							<option value="R">예약</option>
    							<option value="I">실행중</option>
    							<option value="Y">완료</option>
    							<option value="E">에러</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="e_option4" id ="e_option4">
    							<option value="">자동장부-전체</option>
    							<option value="R">예약</option>
    							<option value="I">실행중</option>
    							<option value="H">수동</option>
    							<option value="Y">완료</option>
    							<option value="E">에러</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="e_option1" id ="e_option1">
    							<option value="">파일변환-전체</option>
    							<option value="R">예약</option>
    							<option value="I">실행중</option>
    							<option value="Y">완료</option>
    							<option value="E">에러</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="e_option2" id ="e_option2">
    							<option value="">전자신고-전체</option>
    							<option value="R">예약</option>
    							<option value="I">실행중</option>
    							<option value="Y">완료</option>
    							<option value="E">에러</option>
    						</select>
    					</div>
    					
    					<div class="selectbox w100p" style="background-color:honeydew;">
    						<label for="">선택</label>
    						<select name="login_review_option" id ="login_review_option">
    							<option value="">신고확인-전체</option>
    							<option value="none">미접속</option>
    							<option value="login">접속</option>
    							<option value="review">리뷰</option>
    						</select>
    					</div>
    					
    					
					<div class="search">
						<button style="cursor:pointer; " class="b_newadd"   name="btn_regdate" id="btn_regdate">접수일자</button>
						<button style="cursor:pointer;" class="b_newadd"   name="btn_compdate" id="btn_compdate">신고완료일</button>
					</div>
    				<div class="search">
    					<span id="span_regdate" name="span_regdate" style="display:none;left: 1015px;position: relative;margin: 0px 107px 20px;">
    						<input type="date" class="w200p" id="s_date1_from" name="s_date1_from" style="font-size:13px;width:140px;height:36px;">&nbsp;
    						<font style="margin:0px 10px 0px 10px;">~</font>&nbsp;
    						<input type="date" class="w200p" id="s_date1_to" name="s_date1_to" style="font-size:13px;width:140px;height:36px;">
    					</span>
						
						<span id="span_compdate" name="span_compdate" style="display:none;left: 1110px;position: relative;margin: 0px 105px 20px;">
    						<input type="date" class="w200p" id="s_date2_from" name="s_date2_from" style="font-size:13px;width:140px;height:36px;">&nbsp;
    						<font style="margin:0px 10px 0px 10px;">~</font>&nbsp;
    						<input type="date" class="w200p" id="s_date2_to" name="s_date2_to" style="font-size:13px;width:140px;height:36px;">
    					</span>
    				</div>	
										
				</div>

				<div class="board" style="width:100%;margin-top:25px;">
					<table style="width:2030px;">
						<tbody id="result">
						</tbody>
					</table>
				</div>


<?php

 function toString($text){
   return iconv('UTF-16LE', 'UTF-8', chr(hexdec(substr($text[1], 2, 2))).chr(hexdec(substr($text[1], 0, 2))));
}

function unescape($text){
   return urldecode(preg_replace_callback('/%u([[:alnum:]]{4})/', 'toString', $text));
}

$prog_option = $_GET["prog_option"];
$isnew_option = $_GET["isnew_option"];
$cashreport_option = $_GET["cashreport_option"];
$agree_option = $_GET["agree_option"];
$reg_option = $_GET["reg_option"];
$login_review_option = $_GET["login_review_option"];

$e_option1 = $_GET["e_option1"];
$e_option2 = $_GET["e_option2"];
$e_option3 = $_GET["e_option3"];
$e_option4 = $_GET["e_option4"];
$g_option = $_GET["g_option"];
$y_option = $_GET["y_option"];
$step_name_flag=$_GET["step_name_flag"];
$sort_flag=$_GET["sort_flag"];
//$b_option = unescape($_GET["b_option"]);

$s_date1_from = $_GET["s_date1_from"];
$s_date1_to = $_GET["s_date1_to"];

$s_date2_from = $_GET["s_date2_from"];
$s_date2_to = $_GET["s_date2_to"];

if($y_option==""){
    //$y_option = 2021;
}
$s_str = unescape($_GET["s_str"]);

$query_str1 = "";
$query_str2 = "";
$query_str3 = "";
$query_str4 = "";

$page = $_GET["page"];


$QUERY_STR = "&login_review_option=".$login_review_option."&s_date1_from=".$s_date1_from."&s_date1_to=".$s_date1_to."&s_date2_from=".$s_date2_from."&s_date2_to=".$s_date2_to."&reg_option=".$reg_option."&agree_option=".$agree_option."&cashreport_option=".$cashreport_option."&isnew_option=".$isnew_option."&prog_option=".$prog_option."&e_option1=".$e_option1."&e_option2=".$e_option2."&e_option3=".$e_option3."&e_option4=".$e_option4."&g_option=".$g_option."&s_str=".$_GET["s_str"]."&y_option=".$_GET["y_option"]."&step_name_flag=".$step_name_flag."&sort_flag=".$sort_flag;

$page_set = 100; // 한페이지 줄수
$block_set = 5; // 한페이지 블럭수

    if($step_name_flag !="" && $sort_flag != "")
        $query_desc = " ORDER BY IFNULL(F.".$step_name_flag."_REGDATE, F.BIZ_ID) $sort_flag ";
    else
        $query_desc = " ORDER BY IFNULL(B.EDTDATE, B.REGDATE) DESC, B.REGDATE DESC ";
        

	if($s_str !=""){
		switch($g_option){
			case "CSTID" : 
				$query_str1 .= " AND A.CSTID like '%".$s_str."%' ";
				break;
			case "CSTNAME" : 
				$query_str1 .= " AND A.CSTNAME like '%".$s_str."%' ";
				break;
			case "MOBILE" : 
				$query_str1 .= " AND A.MOBILE like '%".$s_str."%' ";
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
	
	if($s_date1_from != "" && $s_date1_to !="")
	    $query_date = " AND (DATE_FORMAT(B.REGDATE, '%Y-%m-%d') BETWEEN '".$s_date1_from."' AND '".$s_date1_to."') ";
	
    if($s_date2_from != "" && $s_date2_to !="")
        $query_date = " AND (DATE_FORMAT(B.REQ_DATE, '%Y-%m-%d') BETWEEN '".$s_date2_from."' AND '".$s_date2_to."') ";


// 	if($b_option != "")
// 		$query_str2 .= " AND REG_BRANCH = '".$b_option."' ";
	
	
	if($prog_option != "")
	    $query_str2 .= " AND E.PROGRESS = '".$prog_option."' ";
	
	if($isnew_option != "")
	    $query_str2 .= " AND NEW_CST_CK(A.CSTID) = '".$isnew_option."' ";
	
	if($e_option1 != "")
	    $query_str3 .= " AND F.SmartAToConvert = '".$e_option1."' ";
	
	if($e_option2 != "")
	    $query_str3 .= " AND F.HomeTaxUpload = '".$e_option2."' ";
	
	if($e_option3 != "")
	    $query_str3 .= " AND F.HomeTaxPrint = '".$e_option3."' ";
	
	if($cashreport_option != "")
	    $query_str3 .= " AND F.CashReport = '".$cashreport_option."' ";
	
	if($agree_option != "")
	    $query_str3 .= " AND F.HomeTaxConsignment = '".$agree_option."' ";
	
	if($reg_option != "")
	    $query_str3 .= " AND F.CompRegCheck = '".$reg_option."' ";
	
	if($e_option4 != "")
	    $query_str4 .= " AND ( F.SmartABookMake = '".$e_option4."' OR F.WehagoBookMake = '".$e_option4."') ";
	
    if($y_option !=""){
        if ($y_option =="all"){
            $y_option_str = " ";
        }else{
            $y_option_str = " AND B.CST_TYPE_YEAR = ".$y_option;
        }
    }
    else{
        $y_option= 2021;
        $y_option_str = " AND B.CST_TYPE_YEAR = ".$y_option;
    }
	
	
    if($login_review_option != "")
        $query_rv .= " AND CK_CNT_LOGIN_REVIEW(A.CSTID,$y_option)";

	
	

$query = "SELECT count(1) as total 
FROM TB100020 AS A
	LEFT OUTER JOIN TB100022 AS B ON A.CSTID=B.CSTID
	LEFT OUTER JOIN TB100030 AS C ON B.COMP_ID=C.ID
	LEFT OUTER JOIN TB980010 AS D ON D.USERID = B.DEC_REGUSER
    LEFT OUTER JOIN TB100026 AS E ON B.BIZ_ID = E.BIZ_ID
    LEFT OUTER JOIN TB100023 AS F ON B.BIZ_ID = F.BIZ_ID
	WHERE E.PROGRESS IN ('E7208','E7216','E7217','E7218','E7219','E7220','E7221','E7222','E7223','E7224','E7225','E7226','E7227','E7228','E7229','E7232','E7230') 
    AND B.CST_TYPE = 'A1001' ". $y_option_str.$query_str1.$query_str2.$query_str3.$query_str4.$query_rv.$query_date.$query_desc;


//$QUERY_STR = $query_str1.$query_str2;

/*
####### PHP VER 7.0 #######
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));

$row = mysqli_fetch_array($result);

$total = $row["total"]; // 전체글수

*/
$result = mysqli_query($connect,$query) or die(mysqli_error($connect));

$row = mysqli_fetch_array($result);

$total = $row["total"]; // 전체글수


 
$total_page = ceil ($total / $page_set); // 총페이지수(올림함수)
$total_block = ceil ($total_page / $block_set); // 총블럭수(올림함수)

if (!$page) $page = 1; // 현재페이지(넘어온값)
$block = ceil ($page / $block_set); // 현재블럭(올림함수)
 
//$limit_idx = ($page - 1) * $page_set; // limit시작위치


// 페이지번호 & 블럭 설정
$first_page = (($block - 1) * $block_set) + 1; // 첫번째 페이지번호
$last_page = min ($total_page, $block * $block_set); // 마지막 페이지번호
 
$prev_page = $page - 1; // 이전페이지
$next_page = $page + 1; // 다음페이지
 
$prev_block = $block - 1; // 이전블럭
$next_block = $block + 1; // 다음블럭
 
// 이전블럭을 블럭의 마지막으로 하려면...
$prev_block_page = $prev_block * $block_set; // 이전블럭 페이지번호
// 이전블럭을 블럭의 첫페이지로 하려면...
//$prev_block_page = $prev_block * $block_set - ($block_set - 1);
$next_block_page = $next_block * $block_set - ($block_set - 1); // 다음블럭 페이지번호
 

?>	
				<div class="page">
					
<?php 

						echo ($prev_block > 0) ? "<a href='$PHP_SELF?page=$prev_block_page$QUERY_STR' class='first'><span class='icon'>처음</span></a>" : "<a  class='first'><span class='icon'>처음</span></a>";
						echo ($prev_page > 0) ? "
						<a href='$PHP_SELF?page=$prev_page$QUERY_STR' class='prev'><span class='icon'>이전</span></a> " : "<a  class='prev'><span class='icon'>이전</span></a> ";
?>	
					<span class="num">
<?php

for ($i=$first_page; $i<=$last_page; $i++) { 
	echo ($i != $page) ? "<a href='$PHP_SELF?page=$i$QUERY_STR'>$i</a> " : "<a class='active'>$i</a> "; 
} 

?>
					</span>
<?php 
					echo ($next_page <= $total_page) ? "<a href='$PHP_SELF?page=$next_page$QUERY_STR' class='next'><span class='icon'>다음</span></a> " : "<a class='next'><span class='icon'>다음</span></a> ";
					echo ($next_block <= $total_block) ? "<a href='$PHP_SELF?page=$next_block_page$QUERY_STR' class='last'><span class='icon'>마지막</span></a>" : "<a class='last'><span class='icon'>마지막</span></a>";
?>

				</div>
			</div>
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="종합소득세 접수현황">
	<input type=hidden id="tmp_cstid" name="tmp_cstid">
</body>

<style>

[data-tooltip-text]:hover {
	position: relative;
}

[data-tooltip-text]:hover:after {
	background-color: #000000;
	background-color: rgba(0, 0, 0, 0.8);

	-webkit-box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);
	-moz-box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);
	box-shadow: 0px 0px 3px 1px rgba(50, 50, 50, 0.4);

	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;

	color: #FFFFFF;
	font-size: 12px;
	content: attr(data-tooltip-text);

  margin-bottom: 10px;
	top: -230%;
	left: 10;    
	padding: 10px 12px;
	position: absolute;
	width: auto;
	min-width: 150px;
	max-width: 500px;
	word-wrap: break-word;

	z-index: 9999;
}

</style>

<script>

var first = "Y";


function Request() {
	var requestParam = "";

	//getParameter 펑션
	this.getParameter = function (param) {
		//현재 주소를 decoding
		var url = unescape(location.href);
		//파라미터만 자르고, 다시 &그분자를 잘라서 배열에 넣는다. 
		var paramArr = (url.substring(url.indexOf("?") + 1, url.length)).split("&");

		for (var i = 0; i < paramArr.length; i++) {
			var temp = paramArr[i].split("="); //파라미터 변수명을 담음

			if (temp[0].toUpperCase() == param.toUpperCase()) {
				// 변수명과 일치할 경우 데이터 삽입
				requestParam = paramArr[i].split("=")[1];
				break;
			}
		}
		return requestParam;
	}
}





$(document).ready(function(){

	var req = new Request();
	var b_use = req.getParameter("b_use");
	//var b_option = req.getParameter("b_option");
	var g_option = req.getParameter("g_option");
	var e_option1 = req.getParameter("e_option1");
	var e_option2 = req.getParameter("e_option2");
	var e_option3 = req.getParameter("e_option3");
	var e_option4 = req.getParameter("e_option4");
	var y_option = req.getParameter("y_option");

	if(y_option == ""){
		y_option = "<?=$y_option?>";
	}

	var prog_option = req.getParameter("prog_option");
	var isnew_option = req.getParameter("isnew_option");
	var cashreport_option = req.getParameter("cashreport_option");
	var agree_option = req.getParameter("agree_option");
	var reg_option = req.getParameter("reg_option");
	var login_review_option = req.getParameter("login_review_option");

	var s_date1_from = req.getParameter("s_date1_from");
	var s_date1_to = req.getParameter("s_date1_to");
	var s_date2_from = req.getParameter("s_date2_from");
	var s_date2_to = req.getParameter("s_date2_to");
	
	var s_str = unescape(req.getParameter("s_str"));
	var page = req.getParameter("page");
	var page_flag = document.getElementById("page_flag").value;
	var step_name_flag =req.getParameter("step_name_flag");
	var sort_flag =req.getParameter("sort_flag");
	 
	top_menu(page_flag);
	var depid="<?= $depid ?>";
	
	
// 	if(depid != "" && b_option =='' ){
// 		if(depid == "D1003" || depid == "D1004" || depid == "D1006" || depid == "D1007" || depid == "D1008" 
// 			|| depid == "D1009" || depid == "D1010" || depid == "D1011" || depid == "D1012" ||  depid == "D1021" ){
// 			b_option = depid;
// 			//var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
// 			//window.location.href=newURL  + "?g_option="+g_option+"&b_option="+escape(b_option)+"&b_use=Y"+b_use+"&s_str="+escape(s_str);
// 		}
// 	}

	if(s_date1_from !="" && s_date1_to !=""){
		$('#s_date1_from').val(s_date1_from);
		$('#s_date1_to').val(s_date1_to);
		show_hide_1();
	}	

	if(s_date2_from !="" && s_date2_to !=""){
		$('#s_date2_from').val(s_date2_from);
		$('#s_date2_to').val(s_date2_to);
		show_hide_2();
	}		

// 	if (b_option != "") {
// 		$('#b_option').val(b_option).prop("selected",true);
// 		var select = $('#b_option');
// 		cal_select(select);
// 	}
	
	if (g_option != "") {
		$('#g_option').val(g_option).prop("selected",true);
		var select = $('#g_option');
		cal_select(select);
	}

	if (y_option != "") {
		$('#y_option').val(y_option).prop("selected",true);
		var select = $('#y_option');
		cal_select(select);
	}

	if (e_option1 != "") {
		$('#e_option1').val(e_option1).prop("selected",true);
		var select = $('#e_option1');
		cal_select(select);
	}

	if (e_option2 != "") {
		$('#e_option2').val(e_option2).prop("selected",true);
		var select = $('#e_option2');
		cal_select(select);
	}

	if (e_option3 != "") {
		$('#e_option3').val(e_option3).prop("selected",true);
		var select = $('#e_option3');
		cal_select(select);
	}
	
	if(e_option4 != "") {
		$('#e_option4').val(e_option4).prop("selected",true);
		var select = $('#e_option4');
		cal_select(select);
	}

	if(agree_option != "") {
		$('#agree_option').val(agree_option).prop("selected",true);
		var select = $('#agree_option');
		cal_select(select);
	}

	if(prog_option != "") {
		$('#prog_option').val(prog_option).prop("selected",true);
		var select = $('#prog_option');
		cal_select(select);
	}

	if(isnew_option != "") {
		$('#isnew_option').val(isnew_option).prop("selected",true);
		var select = $('#isnew_option');
		cal_select(select);
	}

	if(cashreport_option != "") {
		$('#cashreport_option').val(cashreport_option).prop("selected",true);
		var select = $('#cashreport_option');
		cal_select(select);
	}

	if(reg_option != "") {
		$('#reg_option').val(reg_option).prop("selected",true);
		var select = $('#reg_option');
		cal_select(select);
	}

	if(login_review_option != "") {
		$('#login_review_option').val(login_review_option).prop("selected",true);
		var select = $('#login_review_option');
		cal_select(select);
	}	
	
	if (s_str!= "") {
		$('#s_str').val(s_str);
	}



	function cal_select(select){
    	for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
    		var idxData = select.eq(i).children('option:selected').text();
    		select.eq(i).siblings('label').text(idxData);
		}
	}

	$('#login_review_option').on('change',function(){
		var login_review_option = $('#login_review_option option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});
		
	$('#b_option').on('change',function(){
		var b_option = $('#b_option option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});

	$('#y_option').on('change',function(){
		var y_option = $('#y_option option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});


	$('#e_option1').on('change',function(){
		var e_option1 = $('#e_option1 option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});


	$('#e_option2').on('change',function(){
		var e_option2 = $('#e_option2 option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});


	$('#e_option3').on('change',function(){
		var e_option3 = $('#e_option3 option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});


	$('#e_option4').on('change',function(){
		var e_option4 = $('#e_option4 option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});


	$('#prog_option').on('change',function(){
		var prog_option = $('#prog_option option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});

	$('#isnew_option').on('change',function(){
		var isnew_option = $('#isnew_option option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});


	$('#cashreport_option').on('change',function(){
		var cashreport_option = $('#cashreport_option option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});


	$('#agree_option').on('change',function(){
		var agree_option = $('#agree_option option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});


	$('#reg_option').on('change',function(){
		var reg_option = $('#reg_option option:selected').val();
		var newURL = window.location.protocol + "//" + window.location.host + window.location.pathname;
		window.location.href=newURL  + "?login_review_option="+ login_review_option +"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
	});

		

	$('#g_option').on('change',function(){
		var select = $('#g_option');

		for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
			var idxData = select.eq(i).children('option:selected').text();
			select.eq(i).siblings('label').text(idxData);
		}
	});

	fetchUser();
	//fetchUser_opt("진행상태","prog_option");
	//fetchUser_opt("신규여부","isnew_option");
	//fetchUser_opt("현금영수증","cashreport_option");
	
	function fetchUser()
	{

		var action = "select_list_acc";
		//var b_option = $('#b_option').val();
		var g_option = $('#g_option').val();
		var y_option = $('#y_option').val();
		var e_option1 = $('#e_option1').val();
		var e_option2 = $('#e_option2').val();
		var e_option3 = $('#e_option3').val();
		var e_option4 = $('#e_option4').val();
		var prog_option = $('#prog_option').val();
		var isnew_option = $('#isnew_option').val();
		var cashreport_option = $('#cashreport_option').val();
		var agree_option = $('#agree_option').val();
		var reg_option = $('#reg_option').val();
		var login_review_option = $('#login_review_option').val();
		var s_date1_from = $('#s_date1_from').val();
		var s_date1_to = $('#s_date1_to').val();
		var s_date2_from = $('#s_date2_from').val();
		var s_date2_to = $('#s_date2_to').val();
		var s_str = $('#s_str').val();
		var cst_type = "A1001";//종합소득세
		var req = new Request();
		var page = req.getParameter("page");
		var sort_flag = req.getParameter("sort_flag");
		var step_name_flag = req.getParameter("step_name_flag");
		$('#tmp_cstid').val("");
		
		ch_branch();
		isloading.start();
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,s_date1_from:s_date1_from, s_date1_to:s_date1_to,s_date2_from:s_date2_from,s_date2_to:s_date2_to,login_review_option:login_review_option,prog_option:prog_option,isnew_option:isnew_option,cashreport_option:cashreport_option,agree_option:agree_option,reg_option:reg_option, s_str:s_str,g_option:g_option, page:page,cst_type:cst_type,e_option1:e_option1,e_option2:e_option2,e_option3:e_option3, e_option4:e_option4,y_option,y_option,
				step_name_flag:step_name_flag, sort_flag:sort_flag},
			success:function(data){
				$('#result').html(data);
				isloading.stop();
				
			}
		})
	}



// 	function fetchUser_opt(opt,str)
// 	{
// 		var action = "select_option_value_";
// 		$.ajax({
// 			url:"select.php",
// 			method:"POST",
// 			data:{action:action,opt:opt},
// 			success:function(data){
// 				$('#'+str).html(data);

// 				var select = $('#'+str);
// 				for (var i = 0; i < select.length; i++) { // 지점선택값 라벨에 띄우기
// 					var idxData = select.eq(i).children('option:selected').text();
// 					select.eq(i).siblings('label').text(idxData);
// 				}
// 			}
// 		})
// 	}


	

	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var CSTNAME= $('#CSTNAME').val();
		var MOBILE= $('#MOBILE').val();
		var REG_BRANCH= $('#REG_BRANCH').val();
		var DEC_REGUSER= $('#DEC_REGUSER').val();
		var EST_FEE= $('#EST_FEE').val();
		var DEP_FEE= $('#DEP_FEE').val();
		var RESIDENT1 = $('#RESIDENT_ID1').val();
		var RESIDENT2 = $('#RESIDENT_ID2').val();
		var DOUZONE_SVR= $('#DOUZONE_SVR').val();
		var DOUZONE_CODE= $('#DOUZONE_CODE').val();
		var SMARTA_REG_SERVER= $('#SMARTA_REG_SERVER').val();
		var ACC_TAX = $('#ACC_TAX').val();
		var REF_BANK = $('#REF_BANK').val();
		var REF_ACC = $('#REF_ACC').val();
		var ACC_HOLDER = $('#ACC_HOLDER').val();
		var DEL_TYPE_PAYMENT= $('#DEL_TYPE_PAYMENT').val();
		var EMAIL= $('#EMAIL').val();
		var cst_type ="A1001";
		var userid="<?= $userid ?>";
		var action = "action_RPA_acc_insert";
		var cstid = $('#tmp_cstid').val();

		//성과 이름이 올바르게 입력이 되면
		
		if( CSTNAME != "" && MOBILE != "") {

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{CSTNAME:CSTNAME, MOBILE:MOBILE, REG_BRANCH:REG_BRANCH, 
					DEC_REGUSER:DEC_REGUSER,EST_FEE:EST_FEE,DEP_FEE:DEP_FEE,
					RESIDENT1:RESIDENT1 ,RESIDENT2:RESIDENT2, DOUZONE_SVR:DOUZONE_SVR, 
					DOUZONE_CODE:DOUZONE_CODE, SMARTA_REG_SERVER:SMARTA_REG_SERVER,
					ACC_TAX:ACC_TAX,REF_BANK:REF_BANK,REF_ACC:REF_ACC,ACC_HOLDER:ACC_HOLDER,
					DEL_TYPE_PAYMENT:DEL_TYPE_PAYMENT,cst_type:cst_type ,EMAIL:EMAIL,userid:userid,action:action,cstid:cstid },
				success:function(data){
					$('#close_div').click();
					alert(data);

					$('#RESIDENT_ID1').val("");
					$('#RESIDENT_ID2').val("");
					$('#HomeTaxID').val();
					$('#HomeTaxPW').val();
					$("#REG_BRANCH").val("D1019").prop("selected", true);
					ch_branch();
					$("#DEC_REGUSER").val("1231").prop("selected", true);
					
					$('#MOBILE').val();
					$('#CSTNAME').val();
					$('#SERVER').val();
					$('#SMARTA_REG_SERVER').val();
					$('#SERVER_NUM').val();
					$('#REF_BANK').val();
					$('#REF_ACC').val();
					$('#EST_FEE').val();
					$('#DEP_FEE').val();
					$('#DOUZONE_SVR').val();
					$('#DOUZONE_CODE').val();
					$('#ACC_TAX').val();
					$('#ACC_HOLDER').val();
					$('#DEL_TYPE_PAYMENT').val();
					$('#EMAIL').val();
					
					fetchUser();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}
	});		



	

	function checkit(){
		$('#btn_search').click();
	}	



	$("#s_str").keydown(
		function(key) {
			if (key.keyCode == 13) {
				checkit();
			}
		}
	);


	$("#s_date1_from").change(
		function(key) {
			var s_date1_from = $("#s_date1_from").val();
			var s_date1_to = $("#s_date1_to").val();

			if( isEmpty(s_date1_from)==false && isEmpty(s_date1_to) == false ){
				fn_search();
			}
		}
	);


	$("#s_date1_to").change(
		function(key) {

			var s_date1_from = $("#s_date1_from").val();
			var s_date1_to = $("#s_date1_to").val();

			if( isEmpty(s_date1_from)==false && isEmpty(s_date1_to) == false ){
				fn_search();
			}
			
		}
	);



	$('#btn_search').click(
		function() {
			fn_search();
		}	
	);


	$('#btn_regdate').click(
		function() {
			show_hide_1();
		}	
	);


	$('#btn_compdate').click(
			function() {
				show_hide_2();
			}	
		);


	

	$('#excel_upload').click(
		function() {
			var g_option = '';
			//var b_option = '';
			var s_str = '';

			window.open("from_excel_upload.php");
		}	
	);

	$('#btn_cancel').click(
		function() {
			var g_option = '';
			//var b_option = '';
			var y_option = '';
			var e_option1='';
			var e_option2='';
			var e_option3='';
			var e_option4='';
			var s_str = '';
			var step_name_flag = '';
			var sort_flag = '';

			window.location.href="?e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&g_option="+g_option+"&s_str="+s_str+"&page="+page+"&y_option="+y_option+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
		}	
	);
	


	$('#open_div').click(
			function() {
				
				$('#boardwrite').fadeIn(500).show();
				$('#open_div').fadeOut(500).hide();
				$('#close_div').fadeIn(500).show();
				$('#action').fadeIn(500).show();
			}	
		);

	$('#close_div').click(
			function() {
				$('#boardwrite').fadeOut(500).hide();
				$('#close_div').fadeOut(500).hide();
				$('#action').fadeOut(500).hide();
				$('#open_div').fadeIn(500).show();
			}	
		);

	$('#btn_acc').click(
		function() {
			window.open("list_acc.php");
		}	
	);

	$('#btn_cash').click(
			function() {
				window.open("list_cash_report.php");
			}	
		);


	$('#btn_newwrite').click(
			function() {
				window.location.href="write_inc_cst.php";
			}	
		);

	$('#btn_simple').click(
			function() {
				alert('현재 페이지입니다.');
				//window.location.href="write_inc_cst.php";
			}	
		);

	$('#btn_reg').click(
			function() {
				window.location.href="list_RPA_reg.php";
			}	
		);

	$('#btn_acclist').click(
			function() {
				window.location.href="list_RPA_acc.php";
			}	
		);

	$('#excel').click(
		function() {
			var req = new Request();
			var page = req.getParameter("page");
				
			//var action = "select_excel";
			var g_option = $('#g_option').val();
        	var y_option = $('#y_option').val();
        	var e_option1 = $('#e_option1').val();
        	var e_option2 = $('#e_option2').val();
        	var e_option3 = $('#e_option3').val();
        	var e_option4 = $('#e_option4').val();
        	var prog_option = $('#prog_option').val();
        	var isnew_option = $('#isnew_option').val();
        	var cashreport_option = $('#cashreport_option').val();
        	var agree_option = $('#agree_option').val();
        	var reg_option = $('#reg_option').val();
        	var login_review_option = $('#login_review_option').val();
        	var s_date1_from = $('#s_date1_from').val();
        	var s_date1_to = $('#s_date1_to').val();
        	var s_date2_from = $('#s_date2_from').val();
        	var s_date2_to = $('#s_date2_to').val();
        	var s_str = $('#s_str').val();
        	var cst_type = "A1001";//종합소득세
        	var page=1;

			var first = "Y";
			var depth="<?= $depthid ?>";
			var userid="<?= $userid ?>";
			var depid="<?= $depid ?>";
			var go_url = "excel_down_acc.php?login_review_option="+login_review_option+"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag+"&cst_type="+cst_type;

			window.open(go_url);


	});

	$('#action_mod').click(
		function() {
			$('#action').click();			
		}	
	);



	$('#list_kakao_send').click(
		function() {
			window.open("list_kakao_send.php");			
		}	
	);

	$('#list_cst_review').click(
		function() {
			window.open("list_cst_review.php");			
		}	
	);

	//

});


//select 옵션 저장
function modify_option(obj){ 
	var id_tmp = $(obj).attr("id");

	if(id_tmp.indexOf("bran_")>=0){
		ch_branch(obj);
	}
	
	var id = id_tmp.replace("proc_","");
	id = id.replace("bran_","");
	id = id.replace("reguser_","");
	id = id.replace("confirm_","");
	id = id.replace("user_ratio_","");
		
	var proc_id = "proc_"+id;
	var bran_id = "bran_"+id;
	var reguser_id = "reguser_"+id;
	//var confirm_id = "confirm_"+id;
	var user_ratio_id = "user_ratio_"+id;
	
	var proc = $("#"+proc_id).val();
	var branch = $("#"+bran_id).val();
	var reguser = $("#"+reguser_id).val();
	var user_ratio = $("#"+user_ratio_id).val();
	//var confirm = document.getElementById(confirm_id ).value
	var edtuser = <?php echo $userid ?>;
		
	var action = "upt_acc_inc_opt";

	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,proc:proc,reguser:reguser,branch:branch,edtuser:edtuser, user_ratio:user_ratio},
		success:function(data){
			console.log(data);
			fetchUser();
		}
	})

}


function acc_check(id,cstname,est_fee){
	var action = "ck_acc";

	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,cstname:cstname,est_fee:est_fee},
		success:function(data){
			console.log(data);
			alert("업데이트완료");
			fetchUser();
		}
	})
	
}

function switch_comp(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_lbl_","");

	document.getElementById("memo_lbl_"+id).style.display = "none";
	document.getElementById("memo_ip_"+id).style.display = "block";

	document.getElementById("memo_ip_"+id).focus();
}


function memo_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("memo_ip_","");
	var memo_id = "memo_ip_"+id;

	var memo = document.getElementById(memo_id).value;
	var action = "upt_memo_inc";


	if(event.keyCode==13){

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id,memo:memo},
			success:function(data){
				//alert(data);
				fetchUser();
			}
		})
	}

}



function switch_dzcode(obj){ // 메모란 클릭시 입력창 노출함수
	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("dzcode_lbl_","");

	document.getElementById("dzcode_lbl_"+id).style.display = "none";
	document.getElementById("dzcode_ip_"+id).style.display = "block";

	document.getElementById("dzcode_ip_"+id).focus();
}


function dzcode_submit(obj){ // 메모저장

	var id_tmp = $(obj).attr("id");
	var id = id_tmp.replace("dzcode_ip_","");
	var dzcode_id = "dzcode_ip_"+id;

	var dzcode = document.getElementById(dzcode_id).value;
	var action = "upt_dzcode_inc";


	if(event.keyCode==13){

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id,dzcode:dzcode},
			success:function(data){
				//alert(data);
				location.reload();
			}
		})
	}

}



function file_pop(id){
	window.open("list_file.php?id="+id,"_blank","toolbar=no,scrollbars=no,resizable=no,width=500,height=600");
}


function upt_subm(id){
	//var id = $(obj).attr("id");
	
	if(confirm("수임동의 RPA로 등록하시겠습니까?") == true){
		var action = "upt_subm";

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id},
			success:function(data){
				//alert(data);
				location.reload();
			}
		})
			
		}else{
			return;
		}
	}



function upt_confirm(id){
	//var id = $(obj).attr("id");
	var userid = "<?=$userid ?>";

	if(userid == "1149"){

		if(confirm("결제완료 처리하시겠습니까?") == true){
			var action = "upt_confirm";

			$.ajax({
				url:"action.php",
				method:"POST",
				data:{action:action,id:id,userid:userid},
				success:function(data){
					alert("결제처리되었습니다.");
					location.reload();
				}
			})
				
			}else{
				return;
			}

	}else{
		alert("결제가능한 계정이 아닙니다.");
		return;	
	}
	
}

function fn_mod(id){

	$('#boardwrite').css('display','');
	$('#open_div').css('display','none');
	$('#close_div').css('display','');
	$('#action').css('display','');

	var offset = $("#boardwrite").offset();
	var offset_fix= offset.top - 75;
	$("html body").animate({scrollTop:offset_fix},300);
	
	var action = "select_inc_cst";

	if(id != ""){
		$('#action_mod').css('display','');
		$('#action').css('display','none');
		$('#tmp_cstid').val(id);
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id, action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);


			if(data.RESIDENT_ID){
				if(data.RESIDENT_ID.indexOf('-')>0){
					var res = data.RESIDENT_ID.split('-');
					for(var i in res){
						$('#RESIDENT_ID1').val(res[0]);
						$('#RESIDENT_ID2').val(res[1]);
					}
				}else{
					var res = data.RESIDENT_ID.split('-');
					var len = res[0].length;
					if(len == 13){
						$('#RESIDENT_ID1').val(res[0].substr(0,6));
						$('#RESIDENT_ID2').val(res[0].substr(6));
						
					}
				}
			}
			
			
			
			
			$('#HomeTaxID').val(data.HomeTaxID);
			$('#HomeTaxPW').val(data.HomeTaxPW);
			//$('#REG_BRANCH').val(data.REG_BRANCH);
			$("#REG_BRANCH").val(data.REG_BRANCH).prop("selected", true);
			ch_branch();
			$("#DEC_REGUSER").val(data.DEC_REGUSER).prop("selected", true);
			//$('#RESIDENT1').val(data.RESIDENT_ID);
			$('#MOBILE').val(data.MOBILE);
			$('#CSTNAME').val(data.CSTNAME);
			$('#SERVER').val(data.DOUZONE_SVR);
			$('#SMARTA_REG_SERVER').val(data.SMARTA_REG_SERVER);
			$('#SERVER_NUM').val(data.DOUZONE_CODE);
			$('#REF_BANK').val(data.REF_BANK);
			$('#REF_ACC').val(data.REF_ACC);
			$('#EST_FEE').val(data.EST_FEE_SELF);
			//$('#EST_FEE').attr("readonly",true);
			$('#DOUZONE_SVR').val(data.DOUZONE_SVR).prop("selected",true);
			$('#DOUZONE_CODE').val(data.DOUZONE_CODE);
			$('#ACC_TAX').val(data.ACC_TAX);
			$('#ACC_HOLDER').val(data.ACC_HOLDER);
			$('#DEL_TYPE_PAYMENT').val(data.DEL_TYPE_PAYMENT);
			$('#EMAIL').val(data.EMAIL);
			$('#DEP_FEE').val(data.DEP_FEE);
			$('tmp_cstid').val(id);
			
			
			select_ck();

			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})	
	}
	
}



function select_ck(){
	var select = $('select');
    for (var i = 0; i < select.length; i++) {
        var idxData = select.eq(i).children('option:selected').text();
        select.eq(i).siblings('label').text(idxData);
    }
    select.change(function () {
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });
}

function cal_RPA(str,id){
	if(confirm("RPA 동작하시겠습니까?") == true){
	var action = "upt_RPA_step_code";
	
	if(str=="step_1"){
		var step_name = "CashReport";	
	}else if(str=="step_2"){
		var step_name = "HomeTaxConsignment";
	}else if(str=="step_3"){
		var step_name = "CompanyReg";
	}else if(str=="step_4"){
		var step_name = "SmartA";
	}else if(str=="step_5"){
		var step_name = "HT_Upload";
	}else if(str=="step_6"){
		var step_name = "HT_Print";
	}else if(str=="step_A"){
		var step_name = "SmartABookMake";
	}else if(str=="step_T"){
		var step_name = "WehagoBookMake";
	}else if(str=="step_M"){
		var step_name = "Manual_Down";
	}

	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,step_name:step_name},
		success:function(data){
			alert(id+"번의 RPA 작동이 신청되었습니다.");
			fetchUser();
		}
	})
		
	}else{
		return;
	}
}


function rp_kakao_send(id, cstname){

	var action = "action_send_tok_complate";

	if(confirm("'"+cstname+"' 님에게 알림톡을 [발송]하시겠습니까?") == true){
		$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"api/send_tok_v1.php", 
				method:"POST",
				data:{action:action,id:id},
				//dataType:"json",
				success:function(data)
				{
					console.log(data);
					if(data.indexOf("send_ok")>=0){
						alert("전송완료");
						fetchUser();
					}else if(data.indexOf("error:abuse")>=0){
						alert("이미 알림톡이 발송된 사용자입니다.");
						fetchUser();
					}else{
						alert("에러가 발생했습니다. 관리자에게 문의하여주세요.");
						fetchUser();
					}
							
				}
			});
	}	
}





function digit_check(event,obj){
	if(event.keyCode < 48 || event.keyCode > 57) return false;
	obj.value = obj.value.replace(/[\ㄱ-ㅎㅏ-ㅣ가-힣]/g, '');	
}



function ch_branch(){
	
	var branch = $("#REG_BRANCH OPTION:SELECTED").val();

	$("#DEC_REGUSER").empty();
	switch(branch){
	case "D1019" : 
		$("#DEC_REGUSER").append("<option value='1231'>신승01</option>");
		$("#DEC_REGUSER").append("<option value='1232'>신승02</option>");
		$("#DEC_REGUSER").append("<option value='1233'>신승03</option>");
		$("#DEC_REGUSER").append("<option value='1234'>신승04</option>");
		$("#DEC_REGUSER").append("<option value='1235'>신승05</option>");
		$("#DEC_REGUSER").append("<option value='1236'>신승06</option>");
		$("#DEC_REGUSER").append("<option value='1237'>신승07</option>");
		$("#DEC_REGUSER").append("<option value='1238'>신승08</option>");
		$("#DEC_REGUSER").append("<option value='1239'>신승09</option>");
		$("#DEC_REGUSER").append("<option value='1240'>신승10</option>");
		break;
	case "D1003" : 
		$("#DEC_REGUSER").append("<option value='1117'>마희숙</option>");
		$("#DEC_REGUSER").append("<option value='1131'>한예주</option>");
		$("#DEC_REGUSER").append("<option value='1132'>김지윤</option>");
		$("#DEC_REGUSER").append("<option value='1134'>용아름</option>");
		$("#DEC_REGUSER").append("<option value='1256'>김예빈</option>");
		$("#DEC_REGUSER").append("<option value='1241'>강남1</option>");
		$("#DEC_REGUSER").append("<option value='1242'>강남2</option>");
		$("#DEC_REGUSER").append("<option value='1243'>강남3</option>");
		$("#DEC_REGUSER").append("<option value='1244'>강남4</option>");
		$("#DEC_REGUSER").append("<option value='1245'>강남5</option>");
		$("#DEC_REGUSER").append("<option value='1246'>강남6</option>");
		$("#DEC_REGUSER").append("<option value='1247'>강남7</option>");
		break;
	case "D1002" : 
		$("#DEC_REGUSER").append("<option value='1148'>김용덕</option>");
		$("#DEC_REGUSER").append("<option value='1133'>이정희</option>");
		$("#DEC_REGUSER").append("<option value='1154'>김혜선</option>");
		$("#DEC_REGUSER").append("<option value='1248'>강설옥</option>");
		break;
	case "D1014" : 
		$("#DEC_REGUSER").append("<option value='1147'>노준석</option>");
		$("#DEC_REGUSER").append("<option value='1148'>이정민</option>");
		$("#DEC_REGUSER").append("<option value='1149'>윤형덕</option>");
		$("#DEC_REGUSER").append("<option value='1227'>김선진</option>");
		break;
	case "D1013" : 
		$("#DEC_REGUSER").append("<option value='1226'>김민</option>");
		$("#DEC_REGUSER").append("<option value='1228'>김규리</option>");
		$("#DEC_REGUSER").append("<option value='1249'>홍건호</option>");
		$("#DEC_REGUSER").append("<option value='1121'>최기정</option>");
		$("#DEC_REGUSER").append("<option value='1220'>이명진</option>");
		$("#DEC_REGUSER").append("<option value='1153'>김진규</option>");
		$("#DEC_REGUSER").append("<option value='1163'>한성민</option>");
		$("#DEC_REGUSER").append("<option value='1164'>한은진</option>");
		break;
	case "D1004" : 
		$("#DEC_REGUSER").append("<option value='1119'>오선미</option>");
		$("#DEC_REGUSER").append("<option value='1135'>노윤솔</option>");
		$("#DEC_REGUSER").append("<option value='1250'>김정아</option>");
		break;
	case "D1006" : 
		$("#DEC_REGUSER").append("<option value='1136'>김은정</option>");
		$("#DEC_REGUSER").append("<option value='1160'>박기령</option>");
		$("#DEC_REGUSER").append("<option value='1161'>김지영</option>");
		$("#DEC_REGUSER").append("<option value='1166'>안덕현</option>");
		break;
	case "D1007" : 
		$("#DEC_REGUSER").append("<option value='1116'>오미자</option>");
		$("#DEC_REGUSER").append("<option value='1257'>김세화</option>");
		$("#DEC_REGUSER").append("<option value='1251'>한지은</option>");
		break;
	case "D1008" : 
		$("#DEC_REGUSER").append("<option value='1120'>이찬희</option>");
		$("#DEC_REGUSER").append("<option value='1140'>김세아</option>");
		$("#DEC_REGUSER").append("<option value='1141'>강정민</option>");
		$("#DEC_REGUSER").append("<option value='1252'>김미경</option>");
		break;
	case "D1009" : 
		$("#DEC_REGUSER").append("<option value='1118'>신정희</option>");
		$("#DEC_REGUSER").append("<option value='1142'>양은경</option>");
		$("#DEC_REGUSER").append("<option value='1253'>신솔빈</option>");
		$("#DEC_REGUSER").append("<option value='1155'>장민경</option>");
		break;
	case "D1010" : 
		$("#DEC_REGUSER").append("<option value='1113'>이해옥</option>");
		$("#DEC_REGUSER").append("<option value='1144'>박혜진</option>");
		$("#DEC_REGUSER").append("<option value='1143'>염해림</option>");
		break;
	case "D1011" : 
		$("#DEC_REGUSER").append("<option value='1113'>이해옥</option>");
		$("#DEC_REGUSER").append("<option value='1158'>유수현</option>");
		$("#DEC_REGUSER").append("<option value='1145'>한세빈</option>");
		break;
	case "D1012" : 
		$("#DEC_REGUSER").append("<option value='1114'>한영순</option>");
		$("#DEC_REGUSER").append("<option value='1165'>강지혜</option>");
		$("#DEC_REGUSER").append("<option value='1255'>임봉규</option>");
		$("#DEC_REGUSER").append("<option value='1254'>한유정</option>");
		break;
	case "D1021" : 
		$("#DEC_REGUSER").append("<option value='1115'>정혜숙</option>");
		$("#DEC_REGUSER").append("<option value='1116'>오미자</option>");
		break;
	default:$("#DEC_REGUSER").append("<option value=''>선택</option>");
		break;
	}
	//modify_option(id);
}



function ch_branch2(obj){
	
	var id = $(obj).attr("id");
	var id_tmp = id.replace("bran_","");
	var branch = $("select#"+id+" option:selected").val();
	$("#reguser_"+id_tmp).empty();


	switch(branch){
	case "D1019" : 
		$("#DEC_REGUSER").append("<option value='1231'>신승01</option>");
		$("#DEC_REGUSER").append("<option value='1232'>신승02</option>");
		$("#DEC_REGUSER").append("<option value='1233'>신승03</option>");
		$("#DEC_REGUSER").append("<option value='1234'>신승04</option>");
		$("#DEC_REGUSER").append("<option value='1235'>신승05</option>");
		$("#DEC_REGUSER").append("<option value='1236'>신승06</option>");
		$("#DEC_REGUSER").append("<option value='1237'>신승07</option>");
		$("#DEC_REGUSER").append("<option value='1238'>신승08</option>");
		$("#DEC_REGUSER").append("<option value='1239'>신승09</option>");
		$("#DEC_REGUSER").append("<option value='1240'>신승10</option>");
		break;
	case "D1003" : 
		$("#DEC_REGUSER").append("<option value='1117'>마희숙</option>");
		$("#DEC_REGUSER").append("<option value='1131'>한예주</option>");
		$("#DEC_REGUSER").append("<option value='1132'>김지윤</option>");
		$("#DEC_REGUSER").append("<option value='1134'>용아름</option>");
		$("#DEC_REGUSER").append("<option value='1256'>김예빈</option>");
		$("#DEC_REGUSER").append("<option value='1241'>강남1</option>");
		$("#DEC_REGUSER").append("<option value='1242'>강남2</option>");
		$("#DEC_REGUSER").append("<option value='1243'>강남3</option>");
		$("#DEC_REGUSER").append("<option value='1244'>강남4</option>");
		$("#DEC_REGUSER").append("<option value='1245'>강남5</option>");
		$("#DEC_REGUSER").append("<option value='1246'>강남6</option>");
		$("#DEC_REGUSER").append("<option value='1247'>강남7</option>");
		break;
	case "D1002" : 
		$("#DEC_REGUSER").append("<option value='1148'>김용덕</option>");
		$("#DEC_REGUSER").append("<option value='1133'>이정희</option>");
		$("#DEC_REGUSER").append("<option value='1154'>김혜선</option>");
		$("#DEC_REGUSER").append("<option value='1248'>강설옥</option>");
		break;
	case "D1014" : 
		$("#DEC_REGUSER").append("<option value='1147'>노준석</option>");
		$("#DEC_REGUSER").append("<option value='1148'>이정민</option>");
		$("#DEC_REGUSER").append("<option value='1149'>윤형덕</option>");
		$("#DEC_REGUSER").append("<option value='1227'>김선진</option>");
		break;
	case "D1013" : 
		$("#DEC_REGUSER").append("<option value='1226'>김민</option>");
		$("#DEC_REGUSER").append("<option value='1228'>김규리</option>");
		$("#DEC_REGUSER").append("<option value='1249'>홍건호</option>");
		$("#DEC_REGUSER").append("<option value='1121'>최기정</option>");
		$("#DEC_REGUSER").append("<option value='1220'>이명진</option>");
		$("#DEC_REGUSER").append("<option value='1153'>김진규</option>");
		$("#DEC_REGUSER").append("<option value='1163'>한성민</option>");
		$("#DEC_REGUSER").append("<option value='1164'>한은진</option>");
		break;
	case "D1004" : 
		$("#DEC_REGUSER").append("<option value='1119'>오선미</option>");
		$("#DEC_REGUSER").append("<option value='1135'>노윤솔</option>");
		$("#DEC_REGUSER").append("<option value='1250'>김정아</option>");
		break;
	case "D1006" : 
		$("#DEC_REGUSER").append("<option value='1136'>김은정</option>");
		$("#DEC_REGUSER").append("<option value='1160'>박기령</option>");
		$("#DEC_REGUSER").append("<option value='1161'>김지영</option>");
		$("#DEC_REGUSER").append("<option value='1166'>안덕현</option>");
		break;
	case "D1007" : 
		$("#DEC_REGUSER").append("<option value='1116'>오미자</option>");
		$("#DEC_REGUSER").append("<option value='1257'>김세화</option>");
		$("#DEC_REGUSER").append("<option value='1251'>한지은</option>");
		break;
	case "D1008" : 
		$("#DEC_REGUSER").append("<option value='1120'>이찬희</option>");
		$("#DEC_REGUSER").append("<option value='1140'>김세아</option>");
		$("#DEC_REGUSER").append("<option value='1141'>강정민</option>");
		$("#DEC_REGUSER").append("<option value='1252'>김미경</option>");
		break;
	case "D1009" : 
		$("#DEC_REGUSER").append("<option value='1118'>신정희</option>");
		$("#DEC_REGUSER").append("<option value='1142'>양은경</option>");
		$("#DEC_REGUSER").append("<option value='1253'>신솔빈</option>");
		$("#DEC_REGUSER").append("<option value='1155'>장민경</option>");
		break;
	case "D1010" : 
		$("#DEC_REGUSER").append("<option value='1113'>이해옥</option>");
		$("#DEC_REGUSER").append("<option value='1144'>박혜진</option>");
		$("#DEC_REGUSER").append("<option value='1143'>염해림</option>");
		break;
	case "D1011" : 
		$("#DEC_REGUSER").append("<option value='1113'>이해옥</option>");
		$("#DEC_REGUSER").append("<option value='1158'>유수현</option>");
		$("#DEC_REGUSER").append("<option value='1145'>한세빈</option>");
		break;
	case "D1012" : 
		$("#DEC_REGUSER").append("<option value='1114'>한영순</option>");
		$("#DEC_REGUSER").append("<option value='1165'>강지혜</option>");
		$("#DEC_REGUSER").append("<option value='1255'>임봉규</option>");
		$("#DEC_REGUSER").append("<option value='1254'>한유정</option>");
		break;
	case "D1021" : 
		$("#DEC_REGUSER").append("<option value='1115'>정혜숙</option>");
		$("#DEC_REGUSER").append("<option value='1116'>오미자</option>");
		break;
	default:$("#DEC_REGUSER").append("<option value=''>선택</option>");
		break;
	}
	//modify_option(id);
}


function open_file_info(id,year){
	window.open("list_file_info.php?id="+id+"&year="+year);
}

function open_file_pay(id,year){
	window.open("cst_filelist.php?id="+id+"&year="+year);
}


function fetchUser()
{

	var action = "select_list_acc";
	//var b_option = $('#b_option').val();
	var g_option = $('#g_option').val();
	var y_option = $('#y_option').val();
	var e_option1 = $('#e_option1').val();
	var e_option2 = $('#e_option2').val();
	var e_option3 = $('#e_option3').val();
	var e_option4 = $('#e_option4').val();
	var prog_option = $('#prog_option').val();
	var isnew_option = $('#isnew_option').val();
	var cashreport_option = $('#cashreport_option').val();
	var agree_option = $('#agree_option').val();
	var reg_option = $('#reg_option').val();
	var login_review_option = $('#login_review_option').val();
	var s_date1_from = $('#s_date1_from').val();
	var s_date1_to = $('#s_date1_to').val();
	var s_date2_from = $('#s_date2_from').val();
	var s_date2_to = $('#s_date2_to').val();
	var s_str = $('#s_str').val();
	var cst_type = "A1001";//종합소득세
	var req = new Request();
	var page = req.getParameter("page");
	var sort_flag = req.getParameter("sort_flag");
	var step_name_flag = req.getParameter("step_name_flag");
	$('#tmp_cstid').val("");
	
	ch_branch();
	isloading.start();
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action,s_date1_from:s_date1_from, s_date1_to:s_date1_to,s_date2_from:s_date2_from,s_date2_to:s_date2_to,login_review_option:login_review_option,prog_option:prog_option,isnew_option:isnew_option,cashreport_option:cashreport_option,agree_option:agree_option,reg_option:reg_option, s_str:s_str,g_option:g_option, page:page,cst_type:cst_type,e_option1:e_option1,e_option2:e_option2,e_option3:e_option3, e_option4:e_option4,y_option,y_option, sort_flag:sort_flag, step_name_flag:step_name_flag},
		success:function(data){
			$('#result').html(data);
			isloading.stop();
			
		}
	})
}


function isEmpty(str){
    
    if(typeof str == "undefined" || str == null || str == "")
        return true;
    else
        return false ;
}


function fn_search(){
	//var b_option = $('#b_option').val();
	var g_option = $('#g_option').val();
	var y_option = $('#y_option').val();
	var e_option1 = $('#e_option1').val();
	var e_option2 = $('#e_option2').val();
	var e_option3 = $('#e_option3').val();
	var e_option4 = $('#e_option4').val();
	var prog_option = $('#prog_option').val();
	var isnew_option = $('#isnew_option').val();
	var cashreport_option = $('#cashreport_option').val();
	var agree_option = $('#agree_option').val();
	var reg_option = $('#reg_option').val();
	var login_review_option = $('#login_review_option').val();
	var s_date1_from = $('#s_date1_from').val();
	var s_date1_to = $('#s_date1_to').val();
	var s_date2_from = $('#s_date2_from').val();
	var s_date2_to = $('#s_date2_to').val();
	var s_str = $('#s_str').val();
	var cst_type = "A1001";//종합소득세
	var req = new Request();
	var page = req.getParameter("page");
	var sort_flag = req.getParameter("sort_flag");
	var step_name_flag = req.getParameter("step_name_flag");
	var page=1;

	window.location.href="?login_review_option="+login_review_option+"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
}


function show_hide_1(){
	if($("#span_regdate").css("display") == "none"){
		$("#btn_regdate").css("background","#ccc");
		$("#btn_regdate").css("color","white");
		$("#span_regdate").show();
		
		$("#btn_compdate").css("background","white");
		$("#btn_compdate").css("color","black");
		$("#span_compdate").hide();
		$("#s_date2_from").val("");
		$("#s_date2_to").val("");
	}else{
		$("#btn_regdate").css("background","white");
		$("#btn_regdate").css("color","black");
		$("#span_regdate").hide();
		$("#s_date1_from").val("");
		$("#s_date1_to").val("");
	}
}


function show_hide_2(){
	if($("#span_compdate").css("display") == "none"){
		$("#btn_compdate").css("background","#ccc");
		$("#btn_compdate").css("color","white");
		$("#span_compdate").show();
		
		$("#btn_regdate").css("background","white");
		$("#btn_regdate").css("color","black");
		$("#span_regdate").hide();
		$("#s_date1_from").val("");
		$("#s_date1_to").val("");
	}else{
		$("#btn_compdate").css("background","white");
		$("#btn_compdate").css("color","black");
		$("#span_compdate").hide();
		$("#s_date2_from").val("");
		$("#s_date2_to").val("");
	}	
}

function sorting(step_name_flag, sort_flag){
	var g_option = $('#g_option').val();
	var y_option = $('#y_option').val();
	var e_option1 = $('#e_option1').val();
	var e_option2 = $('#e_option2').val();
	var e_option3 = $('#e_option3').val();
	var e_option4 = $('#e_option4').val();
	var prog_option = $('#prog_option').val();
	var isnew_option = $('#isnew_option').val();
	var cashreport_option = $('#cashreport_option').val();
	var agree_option = $('#agree_option').val();
	var reg_option = $('#reg_option').val();
	var login_review_option = $('#login_review_option').val();
	var s_date1_from = $('#s_date1_from').val();
	var s_date1_to = $('#s_date1_to').val();
	var s_date2_from = $('#s_date2_from').val();
	var s_date2_to = $('#s_date2_to').val();
	var s_str = $('#s_str').val();
	var cst_type = "A1001";//종합소득세
	var req = new Request();
	var page = req.getParameter("page");
	var page=1;
	
	window.location.href="?login_review_option="+login_review_option+"&s_date1_from="+s_date1_from+"&s_date1_to="+s_date1_to+"&s_date2_from="+s_date2_from+"&s_date2_to="+s_date2_to+"&cashreport_option="+cashreport_option+"&agree_option="+agree_option+"&reg_option="+reg_option+"&isnew_option="+isnew_option+"&prog_option="+prog_option+"&e_option1="+e_option1+"&e_option2="+e_option2+"&e_option3="+e_option3+"&e_option4="+e_option4+"&g_option="+g_option+"&s_str="+escape(s_str)+"&y_option="+escape(y_option)+"&step_name_flag="+step_name_flag+"&sort_flag="+sort_flag;
}


</script>
</html>