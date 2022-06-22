<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승세무법인 ADMIN</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
<?php
function utf2euc($str) { return iconv("UTF-8","euc-kr//IGNORE", $str); }
include "top.php";
//setlocale(LC_ALL,'ko_KR.CP949');

?>
<br><br><br><br>
	<div class="wrap">
		<div class="mainbg">
			<div class="content">
				<div class="conwrap">

					<h1>종소세 정보</h1>
				<div class="btn w100" style="margin:5px 0 15px;">
					<button name="delete" id="delete">삭제</button>
					<button name="update" id="update" >수정</button>
					<button name="list" id="list">목록</button>
					<button name="info" id="info" style="background-color:green;color:white;">안내문</button>
				</div>
					<div class="dashwrap" style="width:1350px;">

						<h2>고객기본정보</h2>
						<div class="dashcon">
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="200px">
										<col width="150px">
										<col width="200px">
										<col width="150px">
										<col width="200px">
										<col width="150px">
									</colgroup>
									<tbody>
										<tr>
											<th>성명(대표자)</td>
											<td><label name="CSTNAME" id="CSTNAME"  /></label></td>
											<th>핸드폰</td>
											<td><label name="MOBILE" id="MOBILE" /></label></td>
											<th>주민등록번호(대표자)</td>
											<td><label name="RESIDENT_ID" id="RESIDENT_ID" /></label></td>
										</tr>
										<tr>
											<th>신규여부</td>
											<td><label name="NEW_CST_CK" id="NEW_CST_CK" /></label></td>
											<th>카카오채널 등록여부</td>
											<td><label name="KAKAO_REG" id="KAKAO_REG" /></label></td>
											<th>EMAIL</td>
											<td><label name="EMAIL" id="EMAIL" /></label></td>
										</tr>
										<tr>
											<th>홈택스ID</td>
											<td><label name="HomeTaxID" id="HomeTaxID" /></label></td>
											<th>홈택스PW</td>
											<td><label name="HomeTaxPW" id="HomeTaxPW" /></label></td>
											<th>관리등급</td>
											<td><label name="MNG_GRADE" id="MNG_GRADE" /></label></td>
										</tr>
										<tr>
											<th>환급은행</td>
											<td><label name="REF_BANK" id="REF_BANK" /></label></td>
											<th>환금계좌</td>
											<td><label name="REF_ACC" id="REF_ACC" /></label></td>
											<th>계좌주</td>
											<td><label name="ACC_HOLDER" id="ACC_HOLDER" /></label></td>
										</tr>
										<tr>
											<th>더존서버</td>
											<td><label name="DOUZONE_SVR" id="DOUZONE_SVR" /></label></td>
											<th>더존코드</td>
											<td><label name="DOUZONE_CODE" id="DOUZONE_CODE" /></label></td>
											<th>수임여부</td>
											<td><label name="PROGRESS" id="PROGRESS" /></label></td>
										</tr>
										<tr>
											<th>주소</td>
											<td><label name="" id="" /></label></td>
											<th colspan=4><label name="" id="" /></label></tH>
										</tr>
										<tr>
											<th>고객메모</td>
											<td colspan=5><label name="MEMO" id="MEMO" /></label></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

						<h2>종소세 접수정보</h2>
						<div class="dashcon">
							<div class="btn w100" style="margin:5px 0px 15px;">
            					<button name="add_new_job" id="add_new_job">추가</button>
            				</div>
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="100px">
										<col width="100px">
										<col width="100px">
										<col width="100px">
										<col width="100px">
										<col width="100px">
										<col width="100px">
									</colgroup>
									<thead>
                                		<tr>
                                			<th>상호</th>
                                			<th>구분</th>
                                			<th>연도(기수)</th>
                                			<th>수임금액(납입금액)</th>
                                			<th>등록일</th>
                                			<th>마감일</th>
                                			<th>안내문</th>
                                		</tr>
                                		</thead>
									<tbody>
<?php 
$CSTNAME_TMP ="";
$MOBILE_TMP = "";
$procedure = "
	CREATE PROCEDURE SELECT_ALL_JOB_CST( IN P_CSTID INT(11) )
	BEGIN
		SELECT A.CSTNAME, B.COMP_NAME, CODE_TO_STR( B.CST_TYPE ) AS CST_TYPE,FORMAT(B.EST_FEE,0) AS EST_FEE_, 
B.CST_TYPE_YEAR, B.CST_TYPE_SEQ, FORMAT(B.DEP_FEE,0) AS DEP_FEE_ , DATE_FORMAT(B.REGDATE, '%Y-%m-%d') 'REGDATE_' , 
DATE_FORMAT(B.DEADLINE_DATE, '%Y-%m-%d') 'DEADLINE_DATE_',CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
substring( REPLACE(A.MOBILE,'-',''),4) MOBILE_PATH, REPLACE(A.MOBILE,'-','') MOBILE 
FROM TB100020 AS A LEFT OUTER JOIN 
TB100022 AS B ON A.CSTID = B.CSTID
WHERE B.CST_TYPE= 'A1001' AND A.CSTID = P_CSTID ORDER BY B.REGDATE DESC;
	END;
	";
$path = "../tax_income/upload/2021/";
if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_ALL_JOB_CST"))
{
    if(mysqli_query($connect,$procedure))
    {
        $query = "CALL SELECT_ALL_JOB_CST(".$_GET["id"].")";
        $result = mysqli_query($connect,$query) or die(mysqli_error($connect));
        
        if(mysqli_num_rows($result) >0)
        {
            
            while($row = mysqli_fetch_array($result)){
                $CSTNAME_TMP = iconv("UTF-8","cp949",$row["CSTNAME"]);
                $MOBILE_TMP = $row["MOBILE"];
                $FILE_CNT1=0;
                $DOWN_PATH_INFO = $path.$row["REG_BRANCH_PATH"]."/안내문/".$row["CSTNAME"].$row["MOBILE_PATH"]."/";
                
                if($hostname=="localhost")
                    $dir1 = $DOWN_PATH_INFO;
                    else
                        $dir1 = iconv("UTF-8","CP949",$DOWN_PATH_INFO);
                        
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
                            $DOWN_URL_INFO = "<a href='javascript:open_file_pay(".$row["ID"].");'>파일</a>";
                        }else{
                            $DOWN_URL_INFO = "";
                        }
                        
                $output .= '
					<tr>
						<td style="text-align:center;">'.$row["COMP_NAME"].'</td>
						<td style="text-align:center;">'.$row["CST_TYPE"].'</td>
						<td style="text-align:center;">'.$row["CST_TYPE_YEAR"].'('.$row["CST_TYPE_SEQ"].'기)</td>
						<td style="text-align:center;">'.$row["EST_FEE_"].'원 ('.$row["DEP_FEE_"].'원)</td>
                        <td style="text-align:center;">'.$row["REGDATE_"].'</td>
                        <td style="text-align:center;">'.$row["DEADLINE_DATE_"].'</td>
                        <td>'.$DOWN_URL_INFO.'</td>
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

?>									
									
										
									</tbody>
								</table>
							</div>
						</div>
						
						
						<h2>접수파일</h2>
						<div class="dashcon">
							
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="100px">
										<col width="100px">
										<col width="100px">
										<col width="100px">
									</colgroup>
									<thead>
                                		<tr>
                                			<th>파일명</th>
                                			<th>용량</th>
                                			<th>업로드날짜</th>
                                			<th></th>
                                		</tr>
                                		</thead>
									<tbody>
<?php 

$dir = "upload_income/2021/".$CSTNAME_TMP."_".$MOBILE_TMP."/";
$down_dir = "/admin/upload_income/2021/".urlencode($CSTNAME_TMP)."_".$MOBILE_TMP."/";
//$down_dir = $path.$row["REG_BRANCH_PATH"]."/안내문/".$row["CSTNAME"].$MOBILE."/" ;
//$dir = iconv("UTF-8","EUC-KR",$dir);

//getFiles($dir);

if (is_dir($dir)){
    if ($dh = opendir($dir)){                     //$df = array_diff(scandir($dir),$ignore);
        while (($file = readdir($dh)) !== false){   if($file == ".." || $file == "."){
            continue;
        }else{
            //echo mb_detect_encoding($file, 'auto'); // 자동 감지
            
            //if($hostname=="localhost")
            $file_name = $file;
            $file_size = number_format(filesize($dir.$file_name)/1024/1024,2);
            $fix_size = sprintf('%0.2f', $file_size);
            //else
            //  $file_name = iconv("EUC-KR","UTF-8",$file);
            
            echo "<tr>
                    <td>".iconv("EUC-KR","UTF-8",$file_name)."</td>
<td>".$fix_size."MB </td>
<td>".date('Y-m-d H:i:s', filemtime($dir.$file_name))."</td>
<td><a href='".$dir.$file_name."' target=_blank>다운로드</a></td>
                    </tr>";
        }
        
        }
        closedir($dh);
    }
}else{
    echo 'no such dir...';
}

?>									
									
										
									</tbody>
								</table>
							</div>
						</div>
						
						
						
						<h2>평가</h2>
						<div class="dashcon">
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="250px">
										<col width="">
										<col width="250px">
										<col width="">
									</colgroup>
									<tbody>
										<tr>
											<th>평점</td>
											<td>
												<input type="radio" id="REV_SCORE" value=5>5
												<input type="radio" id="REV_SCORE" value=4>4
												<input type="radio" id="REV_SCORE" value=3>3
												<input type="radio" id="REV_SCORE" value=2>2
												<input type="radio" id="REV_SCORE" value=1>1
											</td>
											<th>평가일</td>
											<td><label name="REV_REGDATE" id="REV_REGDATE" /></label></td>
										</tr>
										<tr>
											<th>리뷰</td>
											<td colspan=3><label name="REV_CONTENT" id="REV_CONTENT" /></label></td>
											
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>

						
						<div class="btn w100" style="margin:5px 0 15px;">
        					<button name="delete" id="delete">삭제</button>
        					<button name="update2" id="update2" >수정</button>
        					<button name="list" id="list">목록</button>
        				</div>





					</div>
				</div>
			</div>
		</div>
		<br>

		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="tmp_cstname" name="tmp_cstname">
	<input type="hidden" id="tmp_mobile" name="tmp_mobile">
</body>

<script>

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

	$('#info').click(function(){
		var request = new Request();
		var id = request.getParameter("id");
		window.open("view_cst.php?id="+id);
	});


	//수정
	$('#update').click(function(){
		update_();
	});
	$('#update2').click(function(){
		update_();
	});


    	//목록가기
    $('#list').click(function(){
    	go_list();
    });
    $('#list2').click(function(){
    	go_list();
    });

	function go_list(){
		var request = new Request();
		var flag = request.getParameter("listflag");

		switch(flag){
		case 'acc' : window.location.href="list_RPA_acc.php";
		break;
		case 'reg' : window.location.href="list_RPA_reg.php";
		break;
		case 'simple' : window.location.href="list_RPA_simple.php";
		break;
		}
		
	}

	function update_(){
		var request = new Request();
		var id = request.getParameter("id");
		window.location.replace("write_vat_cst.php?id="+id);
	}
		

fetchUser();

function fetchUser()
{

	var action = "select_view_inc";
	var request = new Request();

	var id = request.getParameter("id");
	var step = request.getParameter("step");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			
			$('#CSTNAME').html(data.CSTNAME);
			$('#tmp_cstname').val(data.CSTNAME);
			$('#MOBILE').html(data.MOBILE);
			$('#tmp_mobile').val(data.MOBILE);
			$('#RESIDENT_ID').html(data.RESIDENT_ID);
			$('#EMAIL').html(data.EMAIL);
			$('#HomeTaxID').html(data.HomeTaxID);
			$('#HomeTaxPW').html(data.HomeTaxPW);
			$('#REF_ACC').html(data.REF_ACC);
			$('#REF_BANK').html(data.REF_BANK);
			$('#ACC_HOLDER').html(data.ACC_HOLDER);
			$('#DOUZONE_SVR').html(data.DOUZONE_SVR);
			$('#DOUZONE_CODE').html(data.DOUZONE_CODE);
			$('#MEMO').html(data.MEMO);
			$('#KAKAO_REG').html(data.KAKAO_REG);
			$('#NEW_CST_CK').html(data.NEW_CST_CK);
			$('#MNG_GRADE').html(data.MNG_GRADE);
			$('#PROGRESS').html(data.PROGRESS);
			
			fetchReview();

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})

	if(step=="2"){
		window.open("write_inc_pop.php?id="+id);
		}
}


//fetchUser2('TB100024');
function fetchUser2(flag)
{

	var action = "select_view_vat_ext";
	var request = new Request();

	var cstid = request.getParameter("id");
	var bizid = request.getParameter("id2");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{cstid:cstid,flag:flag, action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			if(flag=="TB100024"){
				console.log(data);
				if(data.OPTION1 =="Y") $('#OPTION1').css('display','block');
				if(data.OPTION2 =="Y") $('#OPTION2').css('display','block');
				if(data.OPTION3 =="Y") $('#OPTION3').css('display','block');
				if(data.OPTION4 =="Y") $('#OPTION4').css('display','block');
				if(data.OPTION5 =="Y") $('#OPTION5').css('display','block');
				if(data.OPTION6 =="Y") $('#OPTION6').css('display','block');
				/*
				if(data.OPTION7 =="Y") $('OPTION7').css('display','');
				if(data.OPTION8 =="Y") $('OPTION8').css('display','');
				if(data.OPTION9 =="Y") $('OPTION9').css('display','');
				if(data.OPTION10 =="Y") $('OPTION10').css('display','');
				if(data.OPTION11 =="Y") $('OPTION11').css('display','');		
				*/
			}			
			//alert(data);

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


function fetchReview()
{

	var action = "select_cst_review";
	var request = new Request();

	var cstname = $("#tmp_cstname").val();
	var mobile = $("#tmp_mobile").val();
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{cstname:cstname,mobile:mobile, action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			$('#REV_CONTENT').html(data.REV_CONTENT);
			$('input[id="REV_SCORE"]:radio[value="'+data.REV_SCORE+'"]').prop('checked',true);
			//$("#REV_SCORE").attr( "disabled","true" );
			 $("input[id=REV_SCORE]").each(function(i) {       //testradio 버튼 전체 disable
	              $(this).attr('disabled', "true");
	          });
	
			$('#REV_REGDATE').html(data.REV_REGDATE);	
			//alert(data);

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


});




function down(name,dir){
	//alert(str);
	window.open("down.php?fileurl="+dir+"&filename="+name);

	/*
	$.fileDownload(str)
		.done(function(){alert('성공'); })
		.fail(function(){alert('실패'); });
	return false;
	*/
}



</script>
</html>