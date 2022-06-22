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
<body>
	<div class="wrap">
<?include "top_view.php";?>		

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
							
							<!--tr>
								<th class="w50">제목</th>
								<td >
									<label id="subject"></label>
								</td>
								<th ></th>
								<td >
									<label ></label>
								</td>
							</tr-->
							
							<TR>
							<th>작성자</th>
								<td>
									<label id="reguser"></label>
								</td>
							<th ></th>
								<td >
									<label ></label>
								</td>
							</tr>

							<TR>
								<TH>진행상태</TH>
								<TD>
									<label id="progress"></label>
								</TD>
								<TH>접수지점</TH>
								<TD>
									<label id="reg_branch"></label>
								</TD>
							</TR>
							<TR>
								<TH>부서</TH>
								<TD>
									<label id="reg_dept"></label>
								</TD>
								<TH>문의유형</TH>
								<TD>
									<label id="quest_flag"></label>
								</TD>
							</TR>
							<TR>
								<TH>서버</TH>
								<TD>
									<label id="svr_num"></label>
								</TD>
								<TH>코드번호</TH>
								<TD>
									<label id="code_num"></label>
								</TD>
							</TR>
							<TR>

								<TH>사업장 상호</TH>
								<TD>
									<label id="company_name"></label>
								</TD>
							
								<TH>사업장 연락처</TH>
								<TD>
									<label id="company_phone"></label>
								</TD>
							</TR>
							<tr>
								<TH>비고</TH>
								<TD colspan=3>
									<label id="etc"></label>
								</TD>
							</tr>
							
							<tr style="height:100px;">
								<th>첨부파일</td>
								<td>
									<label id="file_view_str"></label>
								</td>
							</tr>

							<tr>
								<td colspan=4>
								<br>
									<div id="summernote" style="padding:5px; margin:5px;">
										<p>
										
											<br>
										</p>
									</div>
									  
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>

				<div class="btn w100">
					<button class="b_newadd"  name="update" id="update" style="width:-webkit-fill-available;">수정</button>
					<!-- <button>삭제</button> -->
				</div>

				
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="4대보험">
	<input type="hidden" id="img_name" name="img_name">
	<input type="hidden" name="id" id="user_id" />
	<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
	<input type="hidden" name="file_view_str" id="file_view_str" />

</body>

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

	var action = "select_4insu";
	var request = new Request();

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
		
			//$('#action').text("수정");
//			$("#username").attr("Readonly",false);
			$('#reguser').html(data.REGUSER_);
//			$("#username").attr("Readonly",true);
			$('#subject').html(data.SUBJECT);
			$('#progress').html(data.PROGRESS_);
			$('#reg_branch').html(data.REG_BRANCH_);
			$('#reg_dept').html(data.REG_DEPT_);
			$('#quest_flag').html(data.QUEST_FLAG_);
			$('#svr_num').html(data.SVR_NUM);
			$('#code_num').html(data.CODE_NUM);
			$('#company_name').html(data.COMPANY_NAME);
			$('#company_phone').html(data.COMPANY_PHONE);
			$('#file_real_str').html(data.FILE_REAL_STR);
			$('#file_view_str').html(data.FILE_VIEW_STR);	
			$('#num').html(data.NUM);
			$('#etc').html(data.ETC);

			if (data.FILE_VIEW_STR )
			{
				var file_view_arr = data.FILE_VIEW_STR.split("|");
				for (var i=0;i<file_view_arr.length ;i++ )
				{
					$('#file_view_str').append ("<li><a href='upload_others/trans/"+file_dir+file_real_arr[i]+"' target=_blank>" +file_view_arr[i]+"</a></li>");
				}
			}

			if(data.FILE_REAL_STR ){
				var file_real_arr = data.FILE_REAL_STR.split("|");
			}
			
			var file_dir = data.CSTNAME+"_"+data.MOBILE+"/";

			
			
			
//			$('#file_view_str').html("<a href='#'>" + data.FILE_VIEW_STR + "</a>");

			$('#summernote').html( data.CONTENTS);
			
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


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#update').click(function(){
		var request = new Request();
		var id = request.getParameter("id");
		window.location.replace("write_4insu.php?id="+id);
	});


		//수정 버튼을 클릭했을 때 작동되는 함수
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



});



</script>


</html>