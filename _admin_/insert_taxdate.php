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
<?include "top.php";?>		

		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				<div class="boardwrite">
					<table>
						<tbody>
							<tr>
								<th>일정</td>
								<td>
									<input type="date" class="w50" name="tax_date" id="tax_date">
								</td>
								<th>노출여부</th>
								<td>
									<div class="selectbox w150p">
										<label for="">선택</label>
										<select name="visible" id ="visible">
											<option value="">선택</option>
											<option value="Y">노출</option>
											<option value="N" selected>비노출</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								
								<th>일정내용</td>
								<td >
									<input type="text" class="w100" name="tax_content" id="tax_content">
								</td>
								<th></td>
								<td >
									
								</td>

							</tr>
						</tbody>
					</table>
					<div  class="search" align="center">
						<!-- 클릭했을 때 user id를 알 수 있게 숨겨 둔다.-->
						<input type="hidden" name="id" id="user_id" />
						<input type="hidden" name="c_cate_id" id="c_cate_id" />

						<button class="b_newadd"  name="action" id="action" style="background-color:#d83506e3;color:white;">추가</button>
					</div>
				</div>

				


			</div>
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="세무일정 등록">
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

	var page_flag = document.getElementById("page_flag").value;
	top_menu(page_flag);

	$("input[name=img_add]").change(function() {	//var chk_radio = document.getElementsByName('img_add');

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




fetchUser();
function fetchUser()
{

	var action = "select_view_date";
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
			console.log(data);
			
			$('#action').text("수정");
			$('#user_id').val(id);
			
			$('#tax_date').val(data.TAXDATE);
			$('#tax_content').val(data.CONTENT);
			$('#visible').val(data.VISIBLE);

			var select = $('select');
			var str_visible = "";

			switch(data.VISIBLE){
				case "Y" : str_visible = "노출";break;
				case "N" : str_visible = "비노출";break;
				default :  str_visible = "선택";
			}
		    for (var i = 0; i < select.length; i++) {        
				select.eq(i).siblings('label').text(str_visible);
			}

			select.change(function () {
				var select_name = $(this).children("option:selected").text();
				$(this).siblings("label").text(select_name);
			});



		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})

    

}



	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		var img_url_flag = "";
		//각 엘리먼트들의 데이터 값을 받아온다.
		var tax_date = $('#tax_date').val();
		var tax_content= $('#tax_content').val();
		var visible = $('#visible').val();
		//성과 이름이 올바르게 입력이 되면
		var action = $('#action').text();
		var id = $('#user_id').val();
		var url = "taxdate";


		if(tax_date !='' && tax_content != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"select.php", 
				method:"POST",
				data:{id:id,tax_date:tax_date,tax_content:tax_content,visible:visible ,action:action, url:url },
				success:function(data){
					alert(data);
					window.location.href="list_date.php";
				}
				,error:function(e){//에러
				alert(e+' ,error!! 개발자에게 문의해주세요.');
			}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}

	});


});



</script>

</html>