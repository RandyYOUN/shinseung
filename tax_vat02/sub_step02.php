
<?php include("top.php");?>
<div class="wrap">

	<header class="subhead">
		<section class="subnavi">
			<div>
				<?php include("navi.php");?>
			</div>
		</section>

		<section class="subvisual s_pricebg">
		</section>

		<section class="subtext">
			<h1>부가세 간편신고 서비스</h1>
		</section>
	</header>

	<section class="stepProcess">
        <ul>
            <li ><span class="stepProcess01"></span><span><em>STEP01</em>기본정보 입력</span></li>
            <li class="on"><span class="stepProcess02"></span><span><em>STEP02</em>수수료</span></li>
            <li><span class="stepProcess03"></span><span><em>STEP03</em>신고대행 의뢰</span></li>
            <li><span class="stepProcess04"></span><span><em>STEP04</em>부가정보 입력</span></li>
            <li><span class="stepProcess05"></span><span><em>STEP05</em>신고대행 의뢰완료</span></li>
        </ul>
    </section>
<section class="step02T">
	<div class="ty01">
				<table>
							<colgroup>
								<col width="33%">
							</colgroup>
							<thead>
								<tr class="pricebg02">
									<th>구분</th>
									<th>수수료(VAT 포함)</th>
									<th>비고</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>기본</td>
									<td>110,000원</td>
									<td  style="text-align: left; padding-left:10px;">
										- 부가가치세 신고대리 기본 수수료
									</td>					
								</tr>
								<tr>
									<td>간편</td>
									<td>55,000원</td>
									<td  style="text-align: left;padding-left:10px;">
										- 매출, 매입 전자세금계산서만 있는 경우
									</td>					
								</tr>
								<tr>
									<td>특수</td>
									<td>165,000원</td>
									<td  style="text-align: left;padding-left:10px;">
										- 배달대행 & 온라인쇼핑몰 매출 거래처가<br><font style="color:blue;">4개 이상인 경우</font><br>
										- 임대사업자 중 임차대상이<font style="color:blue;"> 4개 이상인 경우</font><br>
										- 홈택스에 미등록된 신용카드 매입세액 <br>공제를 원하는 경우<br>
										- 해외 영세매출이 있는 경우<br>
										- 법인사업자인 경우
									</td>					
								</tr>
								
							</tbody>
				</table>
				<!--ul>
					<li style="color:red;"><b>타소득 합산 종합소득세 신고시 55,000원 수수료 추가 됩니다.</b></li>
					<li>신고 완료 후 세무조사관 대응업무 (해명 자료 제출 등)는 별도 수수료가 청구됩니다.</li>
				</ul-->

			</div>
			</section>

    <section class="step02">
        <div class="fL">
            <h1><span>step02</span>수수료</h1>
        </div>
        	<div class="fR">
							<h1>아래의 해당하시는 항목에 체크해주십시오</h1>
							<div class="checkbox">
								<input name="check01" id="check01" type="checkbox" value="">
								<label for="check01">전자세금계산서만 있는 경우 </label>
							</div> 
							<div class="checkbox">
								<input name="check02" id="check02" type="checkbox" value="">
								<label for="check02">신용카드 매입공제 내역 없는 경우 </label>
							</div>
							<div class="checkbox">
								<input name="check03" id="check03" type="checkbox" value="">
								<label for="check03">소규모 개인 부가가치세 감면 대상자</label>
							</div>
							<div class="checkbox">
								<input name="check04" id="check04" type="checkbox" value="">
								<label for="check04">종이세금계산서 20매 미만</label>
							</div>
							<div class="checkbox">
								<input name="check05" id="check05" type="checkbox" value="">
								<label for="check05">홈택스에 등록된 신용카드 매입세액 공제</label>
							</div>   
							<div class="checkbox">
								<input name="check06" id="check06" type="checkbox" value="">
								<label for="check06">배달&온라인등 매출처 집계 3개 이하인 경우 </label>
							</div> 
							<div class="checkbox">
								<input name="check07" id="check07" type="checkbox" value="">
								<label for="check07">의제매입세액 공제가 있는 경우</label>
							</div> 
							<div class="checkbox">
								<input name="check08" id="check08" type="checkbox" value="">
								<label for="check08">홈택스에 미등록된 신용카드 매입세액 공제</label>
							</div> 
							<div class="checkbox">
								<input name="check09" id="check09" type="checkbox" value="">
								<label for="check09">배달&온라인등 매출처 집계 4개 이상인 경우</label>
							</div> 
							<div class="checkbox">
								<input name="check10" id="check10" type="checkbox" value="">
								<label for="check10">임대사업자 중 임차대상이 4개 이상인 경우</label>
							</div> 
							<div class="checkbox">
								<input name="check11" id="check11" type="checkbox" value="">
								<label for="check11">해외 영세매출등 작업이 복잡한 경우</label>
							</div> 
							<div class="total">
								<span>신고대행 수수료</span>
								<span><em id="est_fee" name="est_fee">110,000</em>원</span>
							</div>    
							<h3>신고대행 수수료는 서류 검토 후 조정될 수 있습니다. 이점 양해부탁드립니다</h3>    
							<input type="button" value="다  음" id="action" name="action">
						</div>
    </section> 

	<?php include("subbottom.php");?>

	<?php include("footer.php");?>

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
		var request = new Request();
		var cstid = request.getParameter("id");
		var bizid = request.getParameter("id2");
		var action = "select_vat_step2";

		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{bizid:bizid, action:action},
			dataType:"json",
			success:function(data)
			{
				console.log(data);

			if(data.OPTION1 == 'Y') $('[name=check01]').prop('checked', true);
			if(data.OPTION2 == 'Y') $('[name=check02]').prop('checked', true);
			if(data.OPTION3 == 'Y') $('[name=check03]').prop('checked', true);
			if(data.OPTION4 == 'Y') $('[name=check04]').prop('checked', true);
			if(data.OPTION5 == 'Y') $('[name=check05]').prop('checked', true);
			if(data.OPTION6 == 'Y') $('[name=check06]').prop('checked', true);
			if(data.OPTION7 == 'Y') $('[name=check07]').prop('checked', true);
			if(data.OPTION8 == 'Y') $('[name=check08]').prop('checked', true);
			if(data.OPTION9 == 'Y') $('[name=check09]').prop('checked', true);
			if(data.OPTION10 == 'Y') $('[name=check10]').prop('checked', true);
			if(data.OPTION11 == 'Y') $('[name=check11]').prop('checked', true);

			cal_option();

			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})
		
	}
	
	
	$('#action').click(function(){

		var request = new Request();
		var action = "action_vat_option_insert";
		var cstid = request.getParameter("id");
		var bizid = request.getParameter("id2");

		for(var i=1; i<10; i++){
			
			if($("input[id=check0"+i+"]").is(":checked")){
				$('#check0'+i).val("Y");
			}
		}
		if($("input[id=check10]").is(":checked")) $('#check10').val("Y");
		if($("input[id=check11]").is(":checked")) $('#check11').val("Y");
			

		var option1 = $('#check01').val();
		var option2 = $('#check02').val();
		var option3 = $('#check03').val();
		var option4 = $('#check04').val();
		var option5 = $('#check05').val();
		var option6 = $('#check06').val();
		var option7 = $('#check07').val();
		var option8 = $('#check08').val();
		var option9 = $('#check09').val();
		var option10 = $('#check10').val();
		var option11 = $('#check11').val();

		var est_fee =  $('#est_fee').html();



//		alert(agreement);


		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
			method:"POST",
			data:{option1:option1,option2:option2,option3:option3,option4:option4,option5:option5,option5:option5,option6:option6,option7:option7,option8:option8,option9:option9,option10:option10,option11:option11,bizid:bizid,action:action,est_fee:est_fee},
			success:function(data){
				console.log(data);
				//location.reload();
				if(data.replace(" ","")=="입력완료"){
					window.location.href="sub_step03.php?id="+cstid+"&id2="+bizid+"&fee="+est_fee;
				}else{
					alert("처리도중 오류가 발생하였습니다. 관리자에게 문의하여주세요.");
				}
				
			}
		});
		
		
	}); // [2]끝


	$('#check01').click(function(){
		cal_option();
	});		

	$('#check02').click(function(){
		cal_option();
	});		

	$('#check03').click(function(){
		cal_option();
	});		

	$('#check04').click(function(){
		cal_option();
	});		

	$('#check05').click(function(){
		cal_option();
	});		

	$('#check06').click(function(){
		cal_option();
	});		

	$('#check07').click(function(){
		cal_option();
	});		

	$('#check08').click(function(){
		cal_option();
	});		

	$('#check09').click(function(){
		cal_option();
	});		

	$('#check10').click(function(){
		cal_option();
	});		

	$('#check11').click(function(){
		cal_option();
	});		

	function cal_option(){
		//alert(obj);
	   
		var ck=0;
		for(var j=1;j<10;j++){
			if($("#check0"+j).is(":checked")) ck = j;
		}
		if($("#check10").is(":checked")) ck = 10;
		if($("#check11").is(":checked")) ck = 11;

		//alert(ck);
		if(ck<1) $('#est_fee').html("110,000");
		if(ck > 0 && ck<3) $('#est_fee').html("55,000");
		if(ck > 2 && ck < 8) $('#est_fee').html("110,000");
		if(ck > 7 ) $('#est_fee').html("165,000");

	}

});


</script>