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
								<th>ID</th>
								<td >
									<input type="box" class="w50" name="member_id" id="member_id">
								</td>
								<th>PW</th>
								<td>
									<input type="box" class="w50" name="member_pw" id="member_pw">
								</td>
							</tr>
							<tr>
								<th>직원명</th>
								<td>
									<input type="box" class="w50" name="member_name" id="member_name">
								</td>
								<th>부서</th>
								<td>
									<div class="selectbox s50">
										<label for="">선택</label>
										<select name="depid" id ="depid">
										<option value="">선택</option>
										<option value="D1003">강남</option>
										<option value="D1004">용인</option>
										<option value="D1006">안양</option>
										<option value="D1007">수원</option>
										<option value="D1008">일산</option>
										<option value="D1009">부천</option>
										<option value="D1010">광주</option>
										<option value="D1011">분당</option>
										<option value="D1012">기흥</option>
										<option value="D1002">회계</option>
										<option value="D1013">세무</option>
										<option value="D1014">영업</option>
										<option value="D1000">관리자</option>
									</select>
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
	<input type=hidden id="page_flag" value="사용자 등록/수정">
	<input type="hidden" id="img_name" name="img_name">
	<input type="hidden" id="file_name" name="file_name">
	<input type="hidden" name="id" id="user_id" />
	<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
	<input type="hidden" name="file_url_tmp" id="file_url_tmp" />

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


fetchUser();
function fetchUser()
{

	var action = "select_admin_member";
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
			$('#member_id').val(data.ID);
            $("#member_id").attr("Readonly",true);
			$("#member_id").attr("STYLE","background-color: #e2e2e2;");
			$('#member_name').val(data.USERNAME);			
			$('#depid').val(data.DEPID);

			var select = $('select');
			var str_depid = "";

			switch(data.DEPID){
				case "D1000" : str_depid = "관리자";break;
				case "D1002" : str_depid = "회계";break;
				case "D1003" : str_depid = "강남";break;
				case "D1004" : str_depid = "용인";break;
				case "D1006" : str_depid = "안양";break;
				case "D1007" : str_depid = "수원";break;
				case "D1008" : str_depid = "일산";break;
				case "D1009" : str_depid = "부천";break;
				case "D1010" : str_depid = "광주";break;
				case "D1011" : str_depid = "분당";break;
				case "D1012" : str_depid = "기흥";break;
				case "D1013" : str_depid = "세무";break;
				case "D1014" : str_depid = "영업";break;
				default :  str_depid = "선택";
			}
		    for (var i = 0; i < select.length; i++) {        
				select.eq(i).siblings('label').text(str_depid);
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

		//각 엘리먼트들의 데이터 값을 받아온다.
		var member_id = $('#member_id').val();
		var member_pw = $('#member_pw').val();
		var member_name = $('#member_name').val();
		var depid = $('#depid').val();
		var action = "reg_member";

		//성과 이름이 올바르게 입력이 되면
		if(member_id !='' && member_pw != '' && member_name != '' && depid != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{member_id:member_id,member_pw:member_pw,member_name:member_name,depid:depid,action:action },
				success:function(data){
					alert(data);
					window.location.href="list_member.php";
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}



	});


});



</script>


</html>