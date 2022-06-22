<?php include "top_free.php";?>	
	<div class="wrap">
	

		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w100"></h2>
				<div class="btn w100" style="margin:5px 0 15px;">
					<button name="delete" id="delete">삭제</button>
					<button name="update" id="update" >수정</button>
					<button name="list" id="list">목록</button>
				</div>
				<div class="boardwrite">
					<table>
						<tbody>
							
							<tr class="tr_color">
								<th class="w150p">작성자</th>
								<td>
									<label id="username"></label>
								</td>
								<th>접수일</th>
								<td>
									<label id="reg_date"></label>
								</td>
							</tr>
							<tr style="background:#cbe1ec29;">
								<th class="w150p">우선순위</th>
								<td>
									<label id="prio_num"></label>
								</td>
								<th class="w50">진행상태</th>
								<td>
									<label id="progress"></label>
									
								</td>
							</tr>
							
							<TR class="tr_color">
							<th>접수지점</th>
								<td>
									<label id="reg_branch"></label>
								</td>
							<th>세목</th>
								<td>
									<label id="tax_flag"></label>
								</td>
							</tr>
							<TR style="background:#cbe1ec29;">
								<TH>납세자 성명</TH>
								<TD>
									<label id="cstname"></label>
								</TD>
								<TH>납세자 연락처</TH>
								<TD>
									<label id="mobile"></label>
								</TD>
							</TR>
							<TR class="tr_color">
								<TH>납세자 주소지</TH>
								<TD>
									<label id="cst_address"></label>
								</TD>
								<TH>양도대상</TH>
								<TD>
									<label id="trans_target"></label>
								</TD>
							</TR>
							<TR style="background:#cbe1ec29;">
								<TH>수수료 납부 여부</TH>
								<TD>
									<label id="pay_flag"></label>
									<label id="option_price"></label>
								</TD>
								<TH>수수료</TH>
								<TD>
									<label id="price"></label>
								</TD>
							</TR>
							<TR class="tr_color">
								<TH>수수료 납부일자</TH>
								<TD>
									<label id="pay_date"></label>
								</TD>
								<TH>비고</TH>
								<TD>
									<label id="etc"></label>
								</TD>
							</TR>
							<tr style="height:100px;background:#eccbcb29;"">
								<th>첨부파일</td>
								<td colspan=3>
									<label id="file_view_str"></label>
								</td>
							</tr>
							<TR style="height:100px;">
								<TD colspan=4 style="text-align:center;font-size:17px;text-align:center;">
									<b>아래는 담당 세무사님께서 기록해 주시기 바랍니다. </b>
								</TD>
							</TR>
							<TR class="tr_color">
								<TH>담당세무사</TH>
								<TD>
									<label id="owner"></label>
								</TD>
								
								<TH>납부서전달</TH>
								<TD>
									<label id="delivery_flag"></label>
								</TD>
							</TR>
							<TR style="background:#cbe1ec29;">
								<TH>양도일자</TH>
								<TD>
									<label id="trans_date"></label>
								</TD>
								<TH>양도가액</TH>
								<TD>
									<label id="trans_price"></label>
								</TD>
							</TR>
							<TR class="tr_color">
								<TH>취득일자</TH>
								<TD>
									<label id="acq_date"></label>
								</TD>
								<TH>취득가액</TH>
								<TD>
									<label id="acq_price"></label>
								</TD>
							</TR>
							<TR class="tr_color" style="background:#cbe1ec29;">
								<TH>신고일자</TH>
								<TD>
									<label id="rep_date"></label>
								</TD>
								<TH>총납부세액</TH>
								<TD>
									<label id="total_tax"></label>
								</TD>
							</TR>							
							<TR>
								<TH>신고기한</TH>
								<TD>
									<label id="deadline"></label>
								</TD>
								<TH>컨설팅수수료</TH>
								<TD>
									<label id="price2"></label>
								</TD>
							</TR>
							<TR class="tr_color" style="background:#cbe1ec29;height:100px;">
								<TH>전자신고번호</TH>
								<TD colspan=3>
									<label id="rep_num"></label>
								</TD>
								
							</TR>
							
								
							<tr>
								<td colspan=4 style="padding:30px;">
									<div id="summernote">
										<p>
										
											<br>
										</p>
									</div>
									  
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>

				<div class="btn w100" style="margin:5px 0 15px;">
					<button name="delete" id="delete2">삭제</button>
					<button name="update" id="update2" >수정</button>
					<button name="list" id="list2">목록</button>
				</div>

				
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="재산제세 상담보고">
	<input type="hidden" id="img_name" name="img_name">
	<input type="hidden" name="id" id="user_id" />
	<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
	<input type="hidden" name="file_view_str" id="file_view_str" />
<?php
$s_str = $_GET["s_str"];
?>
</body>


<script src="js/fileDownload.js"></script>
<script>


function del(str1,str2){

	
	
	document.getElementById(str1).style.display = "none";
	
	document.getElementById("file_name").value = document.getElementById("file_name").value.replace("|"+str1,"");

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




$(document).ready(function(){

	var page_flag = document.getElementById("page_flag").value;

	top_menu(page_flag);

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
	var depid = "<?= $depid ?>";
	var userid = "<?= $userid ?>";
	

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
		
			$('#username').html(data.REGUSER_);
			$('#progress').html(data.PROGRESS_);
			$('#reg_branch').html(data.REG_BRANCH_);
			$('#tax_flag').html(data.TAX_FLAG_);
			$('#cstname').html(data.CSTNAME);
			$('#mobile').html(data.MOBILE);
			$('#cst_address').html(data.CST_ADDRESS);
			$('#trans_target').html(data.TRANS_TARGET_);
			
			if(data.PAY_FLAG == "E3003"){
				$('#pay_flag').html(data.PAY_FLAG_ + " ("+data.OPTION_PRICE+" 원)");
			}else{
				$('#pay_flag').html(data.PAY_FLAG_);
			}
			
			$('#price').html(data.PRICE_);
			$('#price2').html(data.PRICE2_);
			$('#pay_date').html(data.PAY_DATE_);
			$('#trans_date').html(data.TRANS_DATE_);
			$('#trans_price').html(data.TRANS_PRICE_);
			$('#acq_date').html(data.ACQ_DATE_);
			$('#acq_price').html(data.ACQ_PRICE_);
			$('#deadline').html(data.DEADLINE_);
			$('#total_tax').html(data.TOTAL_TAX);
			$('#delivery_flag').html(data.DELIVERY_FLAG_);
			$('#file_real_str').html(data.FILE_REAL_STR);
			$('#owner').html(data.OWNER_);
			$('#num').html(data.NUM);
			$('#prio_num').html(data.PRIO_NUM_);
			$('#rep_num').html(data.REP_NUM);
			$('#rep_date').html(data.REP_DATE_);
			$('#etc').html(data.ETC);
			$('#reg_date').html(data.REGDATE_);
			var file_view_arr = data.FILE_VIEW_STR.split("|");
			var file_real_arr = data.FILE_REAL_STR.split("|");
			var mobile_ =  data.MOBILE.replace(/-/gi, "");

			var file_dir = "../FILE_SVR_1/trans/"+data.CSTNAME+"_"+mobile_+"/";

			for (var i=0;i<file_view_arr.length ;i++ )
			{

				$('#file_view_str').append ("<li><a href='javascript:down(\""+file_real_arr[i]+"\",\""+file_dir+"\");'>" +file_view_arr[i]+"</a></li>");
			}
			
			
//			$('#file_view_str').html("<a href='#'>" + data.FILE_VIEW_STR + "</a>");

			$('#summernote').html( data.CONTENTS);
			
			select_ck();

			var reguser = data.REGUSER;

			if(userid == reguser || depid == "D1000" || depid == "D1014" ){
				document.getElementById("delete").setAttribute('style','display:inline');
			}else{
				document.getElementById("delete").setAttribute('style','display:none');
			}



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
		var mobile_ =  mobile.replace(/-/gi, "");
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
				document.getElementById("file_view_str").value += "|"+file.name;
			}

		}


		$.each(files, function(key, value)
		 {
		  //key는 다른 지정이 없다면 0부터 시작 할것이고, value는 파일 관련 정보입니다.
		  data.append(key, value);
		 });

		 
		  $.ajax({
					
				 url: 'upload_process.php?files&now='+now+'&flag1='+flag1+'&cstname='+cstname+'&mobile='+mobile_, //file을 저장할 소스 주소입니다.
				 type: 'POST',
				 data: data, //위에서 가공한 data를 전송합니다.
				 cache: false,
				 dataType: 'json',
				 processData: false, 
				 contentType: false, 
				 success: function(data, textStatus, jqXHR)
				 {
					 alert(data.error);
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


/*선택한 자식노드값 임시저장*/
$('#c_cate').on('change', function(e){
	document.getElementById("c_cate_id").value = $("#c_cate option:selected").val();
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
		list_();		
	});
	$('#list2').click(function(){
		list_();		
	});


	//삭제
	$('#delete').on('click', function(e){
		delete_();
	});
	$('#delete2').on('click', function(e){
		delete_();
	});

});

function list_(){
	var s_str = "<?=$s_str ?>";
	s_str = encodeURI(s_str);
	var request = new Request();
	var s_option = request.getParameter("s_option");
	var g_option = request.getParameter("g_option");
	//var s_str = request.getParameter("s_str");
	window.location.href="list_trans.php?s_option="+s_option+"&g_option="+g_option+"&s_str="+s_str;
}

function update_(){
	var request = new Request();
	var id = request.getParameter("id");
	window.location.replace("write_trans.php?id="+id);
}


function delete_(){
	var id = request.getParameter("id");

	if(confirm("삭제 하시겠습니까?"))
	{
	//구분자
		var action = "action_trans_delete";
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id,action:action},
			success:function(data){
				//리스트 다시 조회
				//fetchUser();
				alert(data);
				window.location.replace("list_trans.php");
			}
		});

		
	}else
	{
		return false;
	}
}


function down(name,dir){
	//alert(str);
	window.open("down_trans.php?fileurl="+dir+"&filename="+name);

	/*
	$.fileDownload(str)
		.done(function(){alert('성공'); })
		.fail(function(){alert('실패'); });
	return false;
	*/
}

</script>


</html>