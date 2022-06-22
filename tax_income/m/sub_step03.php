<?php include("top.php");?>


		<section class="subvisual sub_pricebg">
			<h1>종합소득세 간편신고 서비스</h1>
		</section>

		<script type="text/javascript" src="resources/js/SimpleTabs02.js"></script>
		
    <!-- step03 -->
    <section class="step03">
        <h1><span>STEP03</span>예상 납부세액 신고대행수수료 확인</h1>
        <div>
            <h1><strong><label id="CSTNAME" name="CSTNAME"></label></strong><span>님의 종합소득세 신고에 대해 안내드립니다</span></h1>
            <h2>고객님의 카톡으로도 예상납부세액과 신고대행수수료를 안내해드렸습니다.</h2>

            <div class="infor">
                <h1>접수정보</h1>
                <ul>
                    <li><strong>접수자 :</strong> <label id="CSTNAME2" name="CSTNAME2"></label></li>
                   <li><strong>연락처 :</strong> <label id="MOBILE" name="MOBILE"></label></li>
                    <li><strong>예상납부세액 : <label id="EXP_PAY_TAX" name="EXP_PAY_TAX"></label> 원</strong></li>
                    <li><strong>신고대행 수수료 : <label id="EST_FEE" name="EST_FEE"></label> 원</strong></li>
                    <li><strong>접수일 :</strong> <label id="REGDATE" name="REGDATE"></label></li>
                </ul>
            </div>

            <div class="infor">
                <h1>* 선택정보</h1>
                <h2>고객님의 주민등록번호를 입력해주시면<BR>접수과정이 조금 더 수월해 집니다.</h2>
                <p><input type="text" placeholder="" id="RESIDENT_ID1" name="RESIDENT_ID1"><span>-</span><input type="password" id="RESIDENT_ID2" name="RESIDENT_ID2"></p>
                <h3>
                    입력하신 정보는 종합소득세 신고를 위한 용도로만 사용됩니다.<br>
                    접수정보를 기초로 절세포인트를 찾아 절세혜택을 드리겠습니다.
                    신고대행 수수료는 서류 검토 후 조정될 수 있습니다. 이점 양해부탁드립니다
                </h3>
            </div>

            <div class="btn">
                <input type="button" value="접수 완료" id="confirm_save" name="confirm_save">
            </div>

            <h3>
                접수완료 버튼 클릭시 카카오톡 채널로 연결되며 신고 담당자가 배정되어 수수료 입금계좌 및 추가 필요서류를 안내해드립니다.
            </h3>

        </div>
    </section>

		<?php include("bottom.php");?>
		
		
		
	
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

	fetchUser();
	function fetchUser()
	{

		var action = "select_inc_info";
		var req = new Request();
		var id = req.getParameter("id");		
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"../action.php",
			method:"POST",
			dataType:"json",
			data:{action:action,id:id},
			success:function(data){
				$('#CSTNAME').html(data.CSTNAME);
				$('#CSTNAME2').html(data.CSTNAME);
				$('#EXP_PAY_TAX').html(data.EXP_PAY_TAX);
				$('#EST_FEE').html(data.EST_FEE);
				$('#MOBILE').html(data.MOBILE);
				$('#RESIDENT_ID1').val(data.RESIDENT_ID1);
				$('#RESIDENT_ID2').val(data.RESIDENT_ID2);
				$('#REGDATE').html(data.REGDATE);
			}
		})
	}


	$("#confirm_save").click(
		function(){

			var action = "save_resident";
			var req = new Request();
			var id = req.getParameter("id");

			var res1 = $('#RESIDENT_ID1').val();
			var res2 = $('#RESIDENT_ID2').val();
/*
			if(res1!="" && res2 != ""){
				$.ajax({
					url:"../action.php",
					method:"POST",
					data:{action:action,id:id, res1:res1, res2:res2 },
					success:function(data){
						console.log(data);
						alert('접수되었습니다.');
						window.location.href="index.php";
					}
				})
			}else{
				alert('주민등록번호를 입력하여주세요.');
				return false;
			}*/
			$.ajax({
				url:"../action.php",
				method:"POST",
				data:{action:action,id:id, res1:res1, res2:res2 },
				success:function(data){
					console.log(data);
					alert('접수되었습니다.');
					window.location.href="index.php";
				}
			})
			
		}
	);



});


</script>

