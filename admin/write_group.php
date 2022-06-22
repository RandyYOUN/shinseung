<!DOCTYPE html>
<html>

</html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승 RPA</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="shortcut icon" href="images/icon.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


<!-- add summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/lang/summernote-ko-KR.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- codemirror -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>

<script src="js/wf_loading.js" type="text/javascript"></script>
<link href="css/wf_loading.css" rel="stylesheet" type="text/css" />


<body>
	
<?php
include "db_info.php";
include "session_inc.php";
   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('https://www.naver.com');</script>";
   }
*/
session_start();

if($jb_login == false){
	$str = "";
	$str .= '<script>alert("세션이 만료되어 로그인페이지로 이동합니다.");';
	$str .= 'document.location.replace("login.php");</script>';

	echo $str;
}

?>		
<div class="wrap">
		<div class="content" style="width:1000px;height:300px;">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			
			<div class="conwrap">
				<h2 class="w100"></h2>
				<div class="btn w100" style="margin:5px 0 15px;text-align:right;">
					<button name="action1" id="action1" >등록</button>
					<button name="list" id="list">목록</button>
				</div>
				<div class="boardwrite">
					<table>
						<tbody>
							
							<tr>
								<th class="w100">작성자</th>
								<td>
<?php
								if( $jb_login ) {
									echo '<input type="box" class="w50" name="username" id="username" value="'.$username.'" readonly="true" STYLE = "background-color: #e2e2e2;" ><input type="hidden" name="reguser" id="reguser" value="'.$userid.'" ';
								}else{
									echo '<input type="box" class="w50" name="reguser" id="reguser" >';
								}
?>
								</td>
								<th><span>그룹명</span></th>
								<td><input type="box" class="w50" name="group_name" id="group_name"></td>
							</tr>
							<tr>
								<th class="w50">사용여부</th>
								<td>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="use_yn" id ="use_yn" class="w50" >
    										<option selected value="Y">사용</option>
    										<option value="N">미사용</option>
										</select>
									</div>
								</td>
								<TH>비고</TH>
								<TD>
									<textarea id = "etc" rows = "3" cols = "80" style="width:400px;height:70px;"  placeholder="내용을 입력해주세요."></textarea>
								</TD>
							</tr>
							<tr>
								<th>사용할 메뉴</th>
								<td>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="use_menu" id ="use_menu" class="w50" >
    										<option selected value="">선택</option>
    										<option value="E5009">진행상태-검토요청</option>
    										<option value="E5006">진행상태-결재완료</option>
    										<option value="H1001">컨설팅-상</option>
    										<option value="H1002">컨설팅-중</option>
    										<option value="H1003">컨설팅-하</option>
    										<option value="H1004">예상납부세액</option>
										</select>
									</div>
								</td>
								<th></th>
								<td></td>
							</tr>
							
							
						</tbody>
					</table>
				</div>

				<div class="btn w100" style="margin:5px 0 15px; text-align:right;">
					<button name="action2" id="action2" >등록</button>
					<button name="list" id="list2">목록</button>
				</div>

				
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="그룹추가">
	<input type="hidden" id="img_name" name="img_name">
	<input type="hidden" name="id" id="user_id" />
	<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
	<input type="hidden" name="file_view_str" id="file_view_str" />
	<input type="hidden" name="file_real_str" id="file_real_str" />

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

	var depid = "<?=$depid?>";

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();
	var time = today.getTime();
	var now = yyyy+""+mm+""+dd;
// 특수문자 정규식 변수(공백 미포함)
	var replaceChar = /[\{\}\[\]\/?.,;:|\)*~`!^\-+&lt;&gt;@\#$%&amp;\\\=\(\'\"]/gi;
 
	// 완성형 아닌 한글 정규식
	var replaceNotFullKorean = /[ㄱ-ㅎㅏ-ㅣ]/gi;
	

	if(depid != "" ){
		if(depid == "D1003" || depid == "D1004" || depid == "D1006" || depid == "D1007" || depid == "D1008" || depid == "D1009" || depid == "D1010" || depid == "D1011" || depid == "D1012" ){
			$("#reg_branch").val(depid).attr("selected","selected");
		}
	}


fetchUser();
function fetchUser()
{

	var action = "select_group";
	var request = new Request();
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();
	var time = today.getTime();
	var now = yyyy+""+mm+""+dd;

	var id = request.getParameter("id");
	if(id != ""){
		//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id, action:action},
		dataType:"json",
		success:function(data)
		{
			//alert(data.first_name);
			//data의 타입은 객체 object
			//한 행에서 수정버튼을 누르면
			//위쪽 입력창의 값이 추가 -> 수정으로 변경되게 만든다.

			console.log(data);
			
			$('#action1').text("수정");
			$('#action2').text("수정");
			$("#username").attr("Readonly",false);
			$('#username').val(data.REGUSER_);
			$("#username").attr("Readonly",true);
			$('#progress').val(data.PROGRESS);
			$('#reg_branch').val(data.REG_BRANCH);
			$('#tax_flag').val(data.TAX_FLAG);
			$('#cstname').val(data.CSTNAME);
			$('#mobile').val(data.MOBILE.replace(/-/gi, ""));
			$('#cst_address').val(data.CST_ADDRESS);
			$('#trans_target').val(data.TRANS_TARGET);
			$('#pay_flag').val(data.PAY_FLAG);
			$('#price').val(data.PRICE_);
			$('#price2').val(data.PRICE2_);
			$('#pay_date').val(data.PAY_DATE_);
			$('#trans_date').val(data.TRANS_DATE_);
			$('#trans_price').val(data.TRANS_PRICE_);
			$('#acq_date').val(data.ACQ_DATE_);
			$('#acq_price').val(data.ACQ_PRICE_);
			$('#deadline').val(data.DEADLINE_);
			$('#total_tax').val(data.TOTAL_TAX);
			$('#delivery_flag').val(data.DELIVERY_FLAG);
			$('#file_real_str').val(data.FILE_REAL_STR);
			$('#file_view_str').val(data.FILE_VIEW_STR);
			$('#owner').val(data.OWNER_USER);
			$('#num').val(data.NUM);
			$('#prio_num').val(data.PRIO_NUM);
			$('#rep_num').val(data.REP_NUM);
			$('#rep_date').val(data.REP_DATE_);
			$('#reg_date').val(data.REGDATE_);
			$('#option_price').val(data.OPTION_PRICE);
			$('#etc').val(data.ETC);
			
			
			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})	
	}

	
}





	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action1').click(function(){
		modify_();
	});
	$('#action2').click(function(){
		modify_();
	});

	
		//목록가기
	$('#list').click(function(){
		window.location.href="list_kakao_send_option.php";
	});
	$('#list2').click(function(){
		window.location.href="list_kakao_send_option.php";
	});


var select = $('select');
    for (var i = 0; i < select.length; i++) {
        var idxData = select.eq(i).children('option:selected').text();
        select.eq(i).siblings('label').text(idxData);
    }
    select.change(function () {
        var select_name = $(this).children("option:selected").text();
        $(this).siblings("label").text(select_name);
    });

});


function modify_(){

		var request = new Request();
		var id = request.getParameter("id");
		if(id!=""){
			var flag = "U";
		}else{
			var flag = "I";
		}

		//각 엘리먼트들의 데이터 값을 받아온다.
		var group_name = $('#group_name').val();
		var reguser= $('#reguser').val();
		var use_yn = $('#use_yn').val();
		var use_menu = $('#use_menu').val();
		var etc =  $('#etc').val();
		var action = "action_group";
		
		if(group_name !=""){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{id:id,action:action,group_name:group_name,reguser:reguser,use_yn:use_yn,etc:etc,flag:flag,use_menu:use_menu},
				success:function(data){
					alert(data);
					window.location.href="list_kakao_send_option.php";			
				}
			});

		}else{
			alert('필수값을 입력해주세요');
			if(group_name == ""){
				$('#group_name').focus();
			}
		}
}


</script>


</html>