<?php include("top.php");?>


		<section class="subvisual sub_pricebg">
			<h1>면세사업장현황 간편신고 서비스</h1>
		</section>

		<script type="text/javascript" src="resources/js/SimpleTabs02.js"></script>
		<section class="subcon">
			<div class="subtabsWrap">		

				<section class="stepProcess">
					<div>
						<span><em>STEP03</em>신고대행 의뢰</span>
					</div>
				</section>

				<section class="step03">
					<div class="fL">
						<h1>신고대행 의뢰</h1>
					</div>
					<div class="fR">
						<h1>면세사업장현황 신고대행을 의뢰해주셔서 감사드리며, 아래의 계좌로 수수료를 입금하신 후 입금 완료 버튼을 클릭해주시면 수수료 입금 확인 후 고객님 정보로 현금영수증 
							또는 세금계산서 발행을 도와드립니다</h1> 
						<div class="total">
							<span>신고대행 수수료</span>
							<span><em id="est_fee" name="est_fee">110,000</em>원</span>
						</div>    
						<h3>신고대행 수수료는 서류 검토 후 조정될 수 있습니다. 이점 양해부탁드립니다</h3>   
						<div class="bank">               
							<div>
								<h2>수수료 입금계좌</h2>
								<span><em>은행명</em>국민은행</span>
								<span><em>계좌주</em>신승세무법인</span>
								<span><em>계좌번호</em><strong>649701-01-124664</strong></span>
							</div>                
						</div> 
					</div>
				</section>
				
					

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
	var request = new Request();
	var cstid = request.getParameter("id");
	var bizid = request.getParameter("id2");
	var estfee = request.getParameter("fee");

	fetchUser();
	function fetchUser()
	{
		if(estfee) $('#est_fee').html(estfee);
	}

	
	$('#action_step3_1').click(function(){
		var action = "upt_vatfee_complate_check";
		var seq = "I";
		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../action.php", 
			method:"POST",
			data:{action:action,seq:seq,bizid:bizid},
			success:function(data){
				if(data.replace(" ","")=="입력완료"){
					window.location.href="sub_step04.php?id="+cstid+"&id2="+bizid;
				}else{
					alert("처리도중 오류가 발생하였습니다. 관리자에게 문의하여주세요.");
				}
				
			}
		});
	}); // [2]끝


	
	$('#action_step3_2').click(function(){
		var action = "upt_vatfee_complate_check";
		var seq = "Y";
		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../action.php", 
			method:"POST",
			data:{action:action,seq:seq,bizid:bizid},
			success:function(data){
				if(data.replace(" ","")=="입력완료"){
					window.location.href="sub_step04.php?id="+cstid+"&id2="+bizid;
				}else{
					alert("처리도중 오류가 발생하였습니다. 관리자에게 문의하여주세요.");
				}
				
				
			}
		});
	}); // [2]끝


});


</script>

