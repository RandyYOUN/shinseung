<!DOCTYPE html>
<html>

</html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승세무법인 ADMIN</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

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
<body>
	<div class="wrap">
<?include "top.php";?>		

		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w100"></h2>
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
								<th></th>
								<td></td>
							</tr>
							<tr>
								<th class="w50">우선순위</th>
								<td>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="prio_num" id ="prio_num" class="w50" >
										<option selected value="E7101">보통</option>
										<option value="E7102">중요</option>
										<option value="E7103">긴급</option>
										<option value="E7104">중요긴급</option>
										<option value="E7105">우수사례</option>
									</select>
									</div>
								</td>
								<th class="w50">진행상태</th>
								<td>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="progress" id ="progress" class="w50" >
										<option selected value="E5001">접수</option>
										<option value="E5002">1차 검토</option>
										<option value="E5003">2차 검토</option>
										<option value="E5004">3차 검토</option>
										<option value="E5005">계약 해지</option>
										<option value="E5006">결제 완료</option>
										<option value="E5007">최종 완료</option>
									</select>
									</div>
								</td>
							</tr>
							
							<TR>
							<th>접수지점</th>
								<td>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="reg_branch" id ="reg_branch" class="w50" >
										<?
										if($depid == "D1016"){
										?>
										<option value="D1016">멤버스</option>
										<?	
										}else{
										?>
										<option selected value="D1013">세무</option>
										<option value="D1002">회계</option>
										<option value="D1003">강남</option>
										<option value="D1004">용인</option>
										<option value="D1006">안양</option>
										<option value="D1007">수원</option>
										<option value="D1008">일산</option>
										<option value="D1009">부천</option>
										<option value="D1010">광주</option>
										<option value="D1011">분당</option>
										<option value="D1012">기흥</option>
										<?}?>
									</select>
									</div>
								</td>
							<th>세목</th>
								<td>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="tax_flag" id ="tax_flag" >
										<option selected value="E1001">양도소득세</option>
										<option value="E1002">상속세</option>
										<option value="E1003">증여세</option>
										<option value="E1004">양도/증여</option>
										<option value="E1005">양도/상속</option>
										<option value="E1006">상속/증여</option>
										<option value="E1007">양도/상속/증여</option>
									</select>
									</div>
								</td>
							</tr>
							<TR>
								<TH>납세자 성명</TH>
								<TD>
									<input type="box" class="w50" name="cstname" id="cstname" >
								</TD>
								<TH>납세자 연락처</TH>
								<TD>
									<input type="box" class="w50" name="mobile" id="mobile" >
								</TD>
							</TR>
							<TR>
								<TH>납세자 주소지</TH>
								<TD>
									<input type="box" class="w100" name="cst_address" id="cst_address" >
								</TD>
								<TH>양도대상</TH>
								<TD>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="trans_target" id ="trans_target" >
										<option selected value="E2001">주택</option>
										<option value="E2002">상가</option>
										<option value="E2003">분양권</option>
										<option value="E2004">조합원입주권</option>
										<option value="E2005">토지</option>
										<option value="E2006">주식</option>
									</select>
								</TD>
							</TR>
							<TR>
								<TH>수수료 납부 여부</TH>
								<TD>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="pay_flag" id ="pay_flag" >
										<option selected value="E3001">완납</option>
										<option value="E3002">미납</option>
										<option value="E3003">일부납부</option>
									</select>
								</TD>
								<TH>수수료</TH>
								<TD>
									<input type="text" class="w50" name="price" id="price" numberOnly >
								</TD>
							</TR>
							<TR>
								<TH>수수료 납부일자</TH>
								<TD>
									<input type="date" class="w50" name="pay_date" id="pay_date">
								</TD>
								<TH>번호</TH>
								<TD>
									<input type="box" class="w50" name="num" id="num">
								</TD>
							</TR>
							<TR style="height:100px;">
								<TH></TH>
								<TD colspan=3 style="text-align:center;font-size:17px;">
									<b>아래는 담당 세무사님께서 기록해 주시기 바랍니다. </b>
								</TD>
							</TR>
							<TR>
								<TH>담당세무사</TH>
								<TD>
									<div class="selectbox w50">
									<label for="">선택</label>
									<select name="owner" id ="owner" >
									<option selected value="">선택</option>
<?php

if($depid == "D1016" && $userid !=""){
	$WHERE_STR .= " AND USERID = '".$userid."'  ";
}else{
	$WHERE_STR .= " AND DEPID = 'D1013'  ";
}	

$query = "SELECT USERID,USERNAME FROM TB980010 WHERE 1=1 ".$WHERE_STR." ORDER BY USERNAME;";
$result = mysql_query($query, $connect) or die ("쿼리 에러 : ".mysql_error($connect));

if(mysql_num_rows($result) >0)
{
	while($row = mysql_fetch_array($result))
	{
		$output .= '<option value="'.$row["USERID"].'">'.$row["USERNAME"].'</option>';
	}
}

echo $output ;
mysql_close($connect);

?>

									</select>
									</div>
								</TD>
								<TH>신고기한</TH>
								<TD>
									<input type="date" class="w50" name="deadline" id="deadline">
								</TD>
							</TR>
							<TR>
								<TH>양도일자</TH>
								<TD>
									<input type="date" class="w50" name="trans_date" id="trans_date">
								</TD>
								<TH>양도가액</TH>
								<TD>
									<input type="text" class="w50" name="trans_price" id="trans_price" numberOnly>
								</TD>
							</TR>
							<TR>
								<TH>취득일자</TH>
								<TD>
									<input type="date" class="w50" name="acq_date" id="acq_date">
								</TD>
								<TH>취득가액</TH>
								<TD>
									<input type="text" class="w50" name="acq_price" id="acq_price" numberOnly>
								</TD>
							</TR>
							
							<TR>
								<TH>총납부세액</TH>
								<TD>
									<input type="text" class="w50" name="total_tax" id="total_tax" numberOnly>
								</TD>
								<TH>납부서전달</TH>
								<TD>
									<div class="selectbox w50">
										<label for="">선택</label>
										<select name="delivery_flag" id ="delivery_flag" >
										<option selected value="E4001">지점전달</option>
										<option value="E4002">등기</option>
										<option value="E4001">팩스</option>
										<option value="E4004">메일</option>
										<option value="E4005">미전달</option>
										<option value="E4006">전달</option>
									</select>
									</div>
								</TD>
							</TR>
							<TR>
								<TH>수수료2</TH>
								<TD>
									<input type="text" class="w50" name="price2" id="price2" numberOnly >
								</TD>
								<TH></TH>
								<TD>
									
								</TD>
							</TR>
							<tr style="height:100px;">
								<th>첨부파일</td>
								<td>
									<input type="file" name="upfile_add[]" id="upfile_add" class="w100" multiple style="height:50px;" />
	
								</td>
							</tr>
							<tr style="height:100px;">
								<th></td>
								<td colspan=3>
									<div id="file_del2" name="file_del2" style="display:none;"><a href="javascript:del('file2');"><b>첨부파일삭제</b></a></div>

									<div NAME="ING_FILE" ID = "ING_FILE">
									
									</div>
									<input type="hidden" id="file_name" name="file_name">

								</td>
							</tr>

							<tr>
								<td colspan=4 style="align:center;">
									<div id="summernote"><p><br></p></div>
									  <div class="placeholder">

									  </div>
									<script type="text/javascript">
									$(function() {
									  // index page card list
									  if ($('.card-list').length) {
										var $cardArrow = $('.card-arrow');
										var $cardListInner = $('.card-list-inner');

										$cardListInner.scroll(function () {
										  $cardArrow.addClass('disappear');
										  if ($cardListInner.scrollLeft() < 20) {
											$cardArrow.removeClass('disappear');
										  }
										});
									  }

									  // main summernote with custom placeholder
									  var $placeholder = $('.placeholder');
									  $('#summernote').summernote({
										height: 600,
										codemirror: {
										  mode: 'text/html',
										  htmlMode: true,
										  lineNumbers: true,
										  theme: 'monokai'
										},
										callbacks: {
										  onInit: function() {
											$placeholder.show();
										  },
										  onFocus: function() {
											$placeholder.hide();
										  },
										  onBlur: function() {
											var $self = $(this);
											setTimeout(function() {
											  if ($self.summernote('isEmpty') && !$self.summernote('codeview.isActivated')) {
												$placeholder.show();
											  }
											}, 300);
										  }
										}
									  });
									});
									</script>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>

				<div class="btn w100">
					<button class="b_newadd"  name="action" id="action" style="width:-webkit-fill-available;">추가</button>
					<!-- <button>삭제</button> -->
				</div>

				
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="양도 등록/수정">
	<input type="hidden" id="img_name" name="img_name">
	<input type="hidden" name="id" id="user_id" />
	<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
	<input type="hidden" name="file_view_str" id="file_view_str" />
	<input type="hidden" name="file_real_str" id="file_real_str" />

</body>

<script>
function del(str1,str2){

	document.getElementById(str1).style.display = "none";
	
	document.getElementById("file_name").value = document.getElementById("file_name").value.replace("|"+str1,"");

	document.getElementById("file_view_str").value = document.getElementById("file_view_str").value.replace("|"+str2,"");

}


function del2(str1,str2){

	document.getElementById(str1).style.display = "none";
	
	document.getElementById("file_real_str").value = document.getElementById("file_real_str").value.replace("|"+str1,"");

	document.getElementById("file_view_str").value = document.getElementById("file_view_str").value.replace("|"+str2,"");

}



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

function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
 
//모든 콤마 제거
function removeCommas(x) {
    if(!x || x.length == 0) return "";
    else return x.split(",").join("");
}


$(document).ready(function(){

	var page_flag = document.getElementById("page_flag").value;

	top_menu(page_flag);

	$("#mobile").on("keyup", function() { // 핸드폰 숫자만입력
	 $(this).val($(this).val().replace(/[^0-9]/g,""));
	});



$("input:text[numberOnly]").on("focus", function() {
    var x = $(this).val();
    x = removeCommas(x);
    $(this).val(x);
}).on("focusout", function() {
    var x = $(this).val();
    if(x && x.length > 0) {
        if(!$.isNumeric(x)) {
            x = x.replace(/[^0-9]/g,"");
        }
        x = addCommas(x);
        $(this).val(x);
    }
}).on("keyup", function() {
    $(this).val($(this).val().replace(/[^0-9]/g,""));
});





$("input[name=img_add]").change(function() {	

	if($("input:radio[value='file']").is(":checked")){                                
		document.getElementById('upfile').style.display = "block";
		document.getElementById('img_url2').style.display = "none";
	}else{
		document.getElementById('upfile').style.display = "none";
		document.getElementById('img_url2').style.display = "block";
	}
});



	$("input[name=rd_GUBUN]").change(
		function() {	
			if($("input:radio[value='ALL']").is(":checked")){                                
				document.getElementById('CATE_ALL').style.display = "block";
				document.getElementById('CATE_HOS').style.display = "none";
			}else{
				document.getElementById('CATE_ALL').style.display = "none";
				document.getElementById('CATE_HOS').style.display = "block";
			}
		}
	);

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

fetchUser();
function fetchUser()
{

	var action = "select_trans";
	var request = new Request();
	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();
	var time = today.getTime();
	var now = yyyy+""+mm+""+dd;

	var id = request.getParameter("id");
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
			
			$('#action').text("수정");
			$("#username").attr("Readonly",false);
			$('#username').val(data.REGUSER_);
			$("#username").attr("Readonly",true);
			$('#progress').val(data.PROGRESS);
			$('#reg_branch').val(data.REG_BRANCH);
			$('#tax_flag').val(data.TAX_FLAG);
			$('#cstname').val(data.CSTNAME);
			$('#mobile').val(data.MOBILE);
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

			if(data.FILE_REAL_STR){
				var file_view_arr = data.FILE_VIEW_STR.split("|");
				var file_real_arr = data.FILE_REAL_STR.split("|");

				var file_dir = data.CSTNAME+"_"+data.MOBILE+"/";

				for (var i=0;i<file_view_arr.length ;i++ )
				{
					if(file_view_arr[i].length>0){
						$('#ING_FILE').append("<li id='"+file_real_arr[i]+"'><a href='upload_others/trans/"+file_dir+file_real_arr[i]+"' target=_blank>" +file_view_arr[i]+"</a>&nbsp;&nbsp;&nbsp;<b><a href=\"javascript:del2('"+file_real_arr[i]+"','"+file_view_arr[i]+"');\">삭제</a></b></li>");					
					}

				}
			}


			var modi_contents = data.CONTENTS;
			$('#summernote').summernote('code', modi_contents);
			
			select_ck();


		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}



/*파일업로드 : S */
	$('#upfile_add').on('change', function(e){
		//파일들을 변수에 넣고
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
		var time = today.getTime();
		var now = yyyy+""+mm+""+dd;
        var files = e.target.files;
        var file;
		var file_real_str="";
		var file_view_str = "";
		var data = new FormData();
		//var property = document.getElementById('upfile_add').files[0];
        //var file_name = document.getElementById("file_name").value;
		var cstname = document.getElementById('cstname').value;
		var mobile = document.getElementById('mobile').value;
		var flag1 = "trans";

		if(cstname =="" || mobile ==""){
			alert('업로드를 위해서는 납세자성명과 연락처가필요합니다');
			
			if (cstname =="" && mobile =="")
			{
				document.getElementById('cstname').focus();
			}
			if (cstname !="" && mobile =="")
			{
				document.getElementById('mobile').focus();
			}
			if (cstname =="" && mobile !="")
			{
				document.getElementById('cstname').focus();
			}
			del('file2');

			return false;
		}
            
		for (var i = 0; i < files.length; i++) {
			
			file = files[i];

			if(document.getElementById("ING_FILE").innerHTML.indexOf(file.name) < 0){
				document.getElementById("ING_FILE").innerHTML += "<li id='"+now+"_"+file.name+"'>"+ file.name + "&nbsp;<a href=\"javascript:del('"+now+"_"+file.name+"','"+file.name+"')\">삭제</a></li>";				
				document.getElementById("file_name").value += "|"+now+"_"+file.name;
				document.getElementById("file_real_str").value += "|"+now+"_"+file.name;
				document.getElementById("file_view_str").value += "|"+file.name;
			}

		}


		$.each(files, function(key, value)
		 {
		  //key는 다른 지정이 없다면 0부터 시작 할것이고, value는 파일 관련 정보입니다.
		  data.append(key, value);
		 });

		 
		  $.ajax({
					
				 url: 'upload_process.php?files&now='+now+'&flag1='+flag1+'&cstname='+cstname+'&mobile='+mobile, //file을 저장할 소스 주소입니다.
				 type: 'POST',
				 data: data, //위에서 가공한 data를 전송합니다.
				 cache: false,
				 dataType: 'json',
				 processData: false, 
				 contentType: false, 
				 success: function(data, textStatus, jqXHR)
				 {
					  console.log(data);
				  if(typeof data.error === 'undefined') //에러가 없다면
				  {

			   //저장된 파일의 정보를 통해 위에서 선언한 img_section이란 곳에 추가 할 코드입니다. 										  파일이 1개기 때문에 index가 0입니다.
				  //var source = '<img src ="'+data.files[0]+'" style="width:270px; height:160px" id="img_url" name="img_url">'

				  //$("#img_section").html(source);
				  alert("업로드되었습니다.");
				  }
				  else//에러가 있다면
				  {
				   console.log('ERRORS: ' + data.error);
				  }
				 },
				 error: function(jqXHR, textStatus, errorThrown)
				 {
				  console.log('ERRORS: ' + textStatus);
				 }
			 });



	});
/*파일업로드 : E */


	/*상담사례 클릭시 자식노드 노출*/
	$("input[name=cate]").change(function(){
		//alert($("#cate option:selected").val());
		if($("input:radio[value='QNA']").is(":checked")){
			document.getElementById("dept2").setAttribute('style','display:block');
		}else{
			document.getElementById("dept2").setAttribute('style','display:none');
		}
	});
	/*상담사례 클릭시 자식노드 노출*/


	/*선택한 자식노드값 임시저장*/
	$('#c_cate').on('change', function(e){
		document.getElementById("c_cate_id").value = $("#c_cate option:selected").val();
	});
	/*선택한 자식노드값 임시저장*/


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		var request = new Request();
		var id = request.getParameter("id");
		if(id!=""){
			var action = "action_trans_update";
		}else{
			var action = "action_trans_insert";
		}

		//각 엘리먼트들의 데이터 값을 받아온다.
		var progress = $('#progress').val();
		var contents =  $('#summernote').summernote('code');
		var reguser= $('#reguser').val();
		var reg_branch = $('#reg_branch').val();
		var tax_flag = $('#tax_flag').val();
		var cstname = $('#cstname').val();
		var mobile = $('#mobile').val();
		var cst_address = $('#cst_address').val();
		var trans_target = $('#trans_target').val();
		var pay_flag = $('#pay_flag').val();
		var pay_date = $('#pay_date').val();
		var price =  $('#price').val().replace(/,/g,'');
		var price2 =  $('#price2').val().replace(/,/g,'');
		var trans_date = $('#trans_date').val();
		var acq_date = $('#acq_date').val();
		var delivery_flag = $('#delivery_flag').val();
		var trans_price = $('#trans_price').val().replace(/,/g,'');
		var acq_price = $('#acq_price').val().replace(/,/g,'');
		var deadline = $('#deadline').val();
		var total_tax = $('#total_tax').val().replace(/,/g,'');
		var file_real_str = $('#file_real_str').val();
		var file_view_str = $('#file_view_str').val();

		var depid = '<?=$depid?>';

		if(depid == "D1016"){// 멤버스
			var cate = 'E6002'; // 멤버스양도		
		}else{
			var cate = 'E6001'; // 양도
		}
		
		var owner = $('#owner').val();
		var num = $('#num').val();
		var prio_num = $('#prio_num').val();
		


		if(progress !='' && contents != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{id:id,progress:progress,reguser:reguser,reg_branch:reg_branch,tax_flag:tax_flag,cstname:cstname, mobile:mobile,cst_address:cst_address,trans_target:trans_target,pay_flag:pay_flag,pay_date:pay_date,price:price,price2:price2,trans_date:trans_date,acq_date:acq_date,delivery_flag:delivery_flag,trans_price:trans_price,acq_price:acq_price,deadline:deadline,total_tax:total_tax,contents:contents, action:action, file_real_str:file_real_str, file_view_str:file_view_str, cate:cate, owner:owner, num:num, prio_num:prio_num },
				success:function(data){
					alert(data);
					if(id != ""){
						window.location.href="view_trans.php?id="+id;			
					}else{
						window.location.href="list_trans.php";			
					}

				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}



	});

		//[4]삭제 버튼을 클릭했을 때 작동되는 함수
		$(document).on('click','.delete',function(){

			var id = $(this).attr("id");

			if(confirm("삭제 하시겠습니까?"))
			{
			//구분자
				var action = "delete";
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data){
						//리스트 다시 조회
						fetchUser();
						alert(data);
					}
				});
			}else
			{
				return false;
			}

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



</script>


</html>