<?php
include "top.php";
?>
<style>

.transfer { width: 1220px; margin: 80px auto 100px; overflow: hidden; }
.transfer .ty01 table { width: 100%; margin: 0 0 30px 0px; border-top: 2px solid #666;}
.transfer .ty01 table thead tr th { font-size: 18px; line-height: 18px; color: #333; font-weight: bold; text-align: center; padding: 25px 0px 25px 0px; }
.transfer .ty01 table thead tr:nth-child(1) { border-bottom: 1px solid #000; }
.transfer .ty01 table thead tr:nth-child(2) { border-bottom: 1px solid #aaa; }
.transfer .ty01 table thead tr:nth-child(2) th { font-size: 18px; line-height: 18px; color: #333; font-weight: bold; text-align: center; padding: 25px 0px 25px 0px; }
.transfer .ty01 table tbody tr td { font-size: 18px; line-height: 17px; color: #444; text-align: center; padding: 25px 0px 25px 0px; }
.transfer .ty01 table tbody tr td span { display: inline-block; width: 8px; height: 8px; border-radius: 50%; }
.transfer .ty01 table tbody tr:nth-child(2n) { background: #f6f4f4; }
.transfer .ty01 table tbody tr:last-child { border-bottom: 1px solid #d1d1d1; }
.transfer ul { margin: 0 0 70px 50px; }
.transfer ul li { position: relative; font-size: 14px; line-height: 27px; color: #777; padding: 0px 0px 0px 10px; }
.transfer ul li:after { content: ''; position: absolute; left: 0px; top: 15px; width: 2px; height: 2px; background: #777; }
.transfer .pricecolor01 span { border: 3px solid #355a8b; }
.transfer .pricecolor02 span { border: 3px solid #355a8b; }


</style>
<div class="wrap">
		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				
				
				<span style="color:red;"><b>※소수점 이하는 올림처리 됩니다.</b></span>
				<div class="boardwrite">
					<table>
						<tbody>
							<tr>
								<td>
									<h2><i>기준가액 (양도,증여,상속가액)</i></h2>
								</td>
								<td>
									<input type="box" class="w50" name="s_str" id="s_str" onkeyup="javascript:inputNumberAutoComma(this);">
								</td>
							</tr>
							<tr>
								<td>
									<h2><i>구분</i></h2>
								</td>
								<td>
									<label><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="IND" checked><div style="margin:-26px 20px 10px 20px;">양도/증여</div></label>
									<label><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="COR"><div style="margin:-26px 20px 10px 20px;">상속</div></label>
								</td>
							</tr>
							

							<tr>
								<td>
									<h2><i>산출수임료</i></h2>
								</td>
								<td>
									<label style="font-size:20px; color:red;padding:20px;" id="1st_payment"> </label>
									<div id = "query1" style="font-size:20px;color:gray;"></div>
								</td>
							</tr>
						</tbody>
					</table>
			</div>
			<section class="transfer">					
					<div class="ty01">
						<table>
							<colgroup>
								<col width="40%">
								<col width="30%">
								<col width="30%">
							</colgroup>
							<thead>
								<tr class="pricebg03">
									<th>구분 </th>
									<th>자산 총액 </th>
									<th>수수료 (VAT 별도) </th>
								</tr>
							</thead>
							<tbody class="pricecolor02">
								
								<tr>
									<td>양도/증여</td>
									<td>~ 1억원 미만</td>
									<td>200,000</td>
								</tr>
								<tr>
									<td>양도/증여</td>
									<td>1억원 ~ 5억원 미만</td>
									<td>300,000</td>
								</tr>
								<tr>
									<td>양도/증여</td>
									<td>5억원 ~ 10억원 미만</td>
									<td>400,000</td>
								</tr>
								<tr>
									<td>양도/증여</td>
									<td>10억원 ~ 15억원 미만</td>
									<td>500,000</td>
								</tr>
								<tr>
									<td>양도/증여</td>
									<td>15억원 ~ 20억원 미만</td>
									<td>600,000</td>
								</tr>
								<tr>
									<td>양도/증여</td>
									<td>20억원 ~ 50억원 미만</td>
									<td>600,000 + 20억초과액 x 0.05%</td>
								</tr>
								<tr>
									<td>양도/증여</td>
									<td>50억원 ~ 100억원 미만</td>
									<td>2,100,000 + 50억초과액 x 0.04%</td>
								</tr>
								<tr>
									<td>양도/증여</td>
									<td>100억원 초과</td>
									<td>별도협의</td>
								</tr>
							</tbody>
						</table>
						<table>
							<colgroup>
								<col width="40%">
								<col width="30%">
								<col width="30%">
							</colgroup>
							<thead>
								<tr class="pricebg03">
									<th>구분 </th>
									<th>자산 총액 </th>
									<th>수수료 (VAT 별도)</th>
								</tr>
							</thead>

							<tbody class="pricecolor02">
								<tr>
									<td>사전 절세컨설팅 </td>
									<td> </td>
									<td>300,000원</td>
								</tr>
								<tr>
									<td>상속</td>
									<td>~ 1억원 미만 </td>
									<td>1,000,000원</td>
								</tr>
								<tr>
									<td>상속 </td>
									<td>1억원 ~ 3억원 미만 </td>
									<td>1,000,000 + 1억초과액 x 0.5%</td>
								</tr>
								<tr>
									<td>상속 </td>
									<td>3억원 ~ 5억원 미만 </td>
									<td>2,000,000 + 3억초과액 x 0.5%</td>
								</tr>
								<tr>
									<td>상속 </td>
									<td>5억원 ~ 10억원 미만 </td>
									<td>3,000,000 + 5억초과액 x 0.5%</td>
								</tr>
								<tr>
									<td>상속 </td>
									<td>10억원 ~ 30억원 미만 </td>
									<td>5,500,000 + 10억초과액 x 0.4%</td>
								</tr>
								<tr>
									<td>상속 </td>
									<td>30억원 ~ 50억원 미만 </td>
									<td>12,500,000 + 30억초과액 x 0.35%</td>
								</tr>
								<tr>
									<td>상속 </td>
									<td>50억원 ~ 100억원 미만 </td>
									<td>18,500,000 + 50억초과액 x 0.3%</td>
								</tr>

							</tbody>
						</table>
					</div>
				</section>
		</div>

		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="page_flag" value="재산제세 계산기">

</body>

<script>

	var page_flag = document.getElementById("page_flag").value;
	top_menu(page_flag);

	function replaceAll(str, searchStr, replaceStr) {
	  return str.split(searchStr).join(replaceStr);
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


	function cal_1(){
			
			var pay = $("#s_str").val();
			pay = replaceAll(pay,",","");
			pay = parseInt(pay);
			//alert(pay);

			var gubun = $(":radio[id='rd_GUBUN']:checked").val() ;

			var pa1 = $("1st_payment").val() ;

			var st1 = 0; //1차조정료
			var st2 = 0; //2차조정료
			var tmp1 = 0; // 초과차액
			var query1 = ""; //계산식1
			var query2 = ""; //계산식2
			var gubun_money = 0; //금액별 기준금액
			var math = 0; // 금액별 배율
/*
구분 
IND = 양도/증여
COR = 상속
*/

			if(pay < 100000000){ //1억미만

				switch(gubun){
					case "IND" : st1 = 200000;
								query1 = "계산식 => 양도/증여 : 1억 미만 = 200,000원";
								gubun_money = 200000;
								break;
					default:"";
				}

			}else if(pay >= 100000000 && pay < 500000000){ //1억이상 5억미만
				tmp1 = pay - 100000000; // 초과액				
				switch(gubun){
					case "IND" : st1 = 300000;
								query1 = "계산식 => 양도/증여 : 1억이상 5억미만 = 300,000원";
								gubun_money = 300000;
								break;
					default:"";
				}
			}else if(pay >= 500000000 && pay < 1000000000){ //5억이상 10억미만

				switch(gubun){
					case "IND" : st1 = 400000;
								query1 = "계산식 => 양도/증여 : 5억이상 10억미만 = 400,000원";
								gubun_money = 400000;
								break;
					default:"";
				}

			}else if(pay >= 1000000000 && pay < 1500000000){ //10억이상 15억미만
				tmp1 = pay - 1000000000; // 초과액

				switch(gubun){
					case "IND" : st1 = 500000;

								query1 = "계산식 =>  양도/증여 : 5억이상 10억미만 = 500,000원" ;
								gubun_money = 500000;
								break;
					default:"";
				}
			}else if(pay >= 1500000000 && pay < 2000000000){ //15억이상 20억미만
				tmp1 = pay - 1500000000; // 초과액

				switch(gubun){
					case "IND" : st1 = 600000;

								query1 = "계산식 =>  양도/증여 : 15억이상 20억미만 = 600,000원" ;
								gubun_money = 600000;
								break;

					default:"";
				}
			}else if(pay >= 2000000000 && pay < 5000000000){ //30억이상 50억미만
				tmp1 = pay - 2000000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(600000 + (tmp1 * 0.0005));

								query1 = "계산식 => 600,000 + ( " + inputNumberWithComma(String(tmp1))+" x 0.05%)" ;
								gubun_money = 600000;
								break;

					default:"";
				}
			}else if(pay >= 5000000000 && pay < 10000000000){ //50억이상 100억미만
				tmp1 = pay - 5000000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(2100000 + (tmp1 * 0.0004));

								query1 = "계산식 => 2,100,000 + ( " + inputNumberWithComma(String(tmp1))+" x 0.04%)" ;
								gubun_money = 2100000;
								break;

					default:"";
				}
			}else if(pay >= 10000000000 ){ //100억이상

				query1 = "계산식 => 별도협의" ;

			}else{
				$("#1st_payment").text("0원");
			}
			
			var st1_add_vat = inputNumberWithComma(Math.ceil(st1 + (st1 * 0.1)));


			$("#1st_payment").text(inputNumberWithComma(st1)+"원 (vat포함 : "+st1_add_vat+"원)");
			$("#query1").text(query1);



	}



	function cal_2(){
			
			var pay = $("#s_str").val();
			pay = replaceAll(pay,",","");
			pay = parseInt(pay);
			//alert(pay);

			var gubun = $(":radio[id='rd_GUBUN']:checked").val() ;

			var pa1 = $("1st_payment").val() ;

			var st1 = 0; //1차조정료
			var st2 = 0; //2차조정료
			var tmp1 = 0; // 초과차액
			var query1 = ""; //계산식1
			var query2 = ""; //계산식2
			var gubun_money = 0; //금액별 기준금액
			var math = 0; // 금액별 배율
/*
구분 
IND = 양도/증여
COR = 상속
*/

			if(pay < 100000000){ //1억미만

				switch(gubun){
					case "COR" : st1 = 1000000;
								query1 = "계산식 => 상속세 : 1억 미만 = 1,000,000원";
								gubun_money = 200000;
								break;
					default:"";
				}

			}else if(pay >= 100000000 && pay < 300000000){ //1억이상 3억미만
				tmp1 = pay - 100000000; // 초과액				
				switch(gubun){
					case "COR" : st1 = Math.ceil(1000000 + (tmp1 * 0.005));
								query1 = "계산식 => 1,000,000 + ( " + inputNumberWithComma(String(tmp1))+" x 0.5%)" ;
								gubun_money = 1000000;
								break;
					default:"";
				}
			}else if(pay >= 300000000 && pay < 500000000){ //3억이상 5억미만
				tmp1 = pay - 300000000; // 초과액	
				switch(gubun){
					case "COR" : st1 = Math.ceil(2000000 + (tmp1 * 0.005));
								query1 = "계산식 => 2,000,000 + ( " + inputNumberWithComma(String(tmp1))+" x 0.5%)" ;
								gubun_money = 2000000;
								break;
					default:"";
				}

			}else if(pay >= 500000000 && pay < 1000000000){ //5억이상 10억미만
				tmp1 = pay - 500000000; // 초과액

				switch(gubun){
					case "COR" : st1 = Math.ceil(3000000 + (tmp1 * 0.005));
								query1 = "계산식 => 3,000,000 + ( " + inputNumberWithComma(String(tmp1))+" x 0.5%)" ;
								gubun_money = 3000000;
								break;
					default:"";
				}
			}else if(pay >= 1000000000 && pay < 3000000000){ //10억이상 30억미만
				tmp1 = pay - 1000000000; // 초과액

				switch(gubun){
					case "COR" : st1 = Math.ceil(5500000 + (tmp1 * 0.004));
								query1 = "계산식 => 5,500,000 + ( " + inputNumberWithComma(String(tmp1))+" x 0.4%)" ;
								gubun_money = 5500000;
								break;
					default:"";
				}
			}else if(pay >= 3000000000 && pay < 5000000000){ //30억이상 50억미만
				tmp1 = pay - 3000000000; // 초과액

				switch(gubun){
					case "COR" : st1 = Math.ceil(12500000 + (tmp1 * 0.0035));
								query1 = "계산식 => 12,500,000 + ( " + inputNumberWithComma(String(tmp1))+" x 0.35%)" ;
								gubun_money = 12500000;
								break;
					default:"";
				}
			}else if(pay >= 5000000000 && pay < 10000000000){ //50억이상 100억미만
				tmp1 = pay - 5000000000; // 초과액

				switch(gubun){
					case "COR" : st1 = Math.ceil(18500000 + (tmp1 * 0.003));
								query1 = "계산식 => 18,500,000 + ( " + inputNumberWithComma(String(tmp1))+" x 0.3%)" ;
								gubun_money = 18500000;
								break;
					default:"";
				}
			}else if(pay >= 10000000000 ){ //100억이상

				query1 = "계산식 => 별도협의" ;

			}else{
				$("#1st_payment").text("0원");
			}
			
			var st1_add_vat = inputNumberWithComma(Math.ceil(st1 + (st1 * 0.1)));


			$("#1st_payment").text(inputNumberWithComma(st1)+"원 (vat포함 : "+st1_add_vat+"원)");
			$("#query1").text(query1);



	}




$(document).ready(function(){

	$("input[name=rd_GUBUN]").change(function(){

		var gubun = $(":radio[id='rd_GUBUN']:checked").val() ;
		switch(gubun){
			case "COR" : cal_2();
						break;
			case "IND" : cal_1();
						break;
			default:"";
		}

	});

});



</script>

<script type="text/javascript">
    function inputNumberAutoComma(obj) {

		var gubun = $(":radio[id='rd_GUBUN']:checked").val() ;
		switch(gubun){
			case "COR" : cal_2();
						break;
			case "IND" : cal_1();
						break;
			default:"";
		}
        // 콤마( , )의 경우도 문자로 인식되기때문에 콤마를 따로 제거한다.
        var deleteComma = obj.value.replace(/\,/g, "");

        // 콤마( , )를 제외하고 문자가 입력되었는지를 확인한다.
        if(isFinite(deleteComma) == false) {
            alert("문자는 입력하실 수 없습니다.");
            obj.value = "";
            return false;
        }
       
        // 기존에 들어가있던 콤마( , )를 제거한 이 후의 입력값에 다시 콤마( , )를 삽입한다.
        obj.value = inputNumberWithComma(inputNumberRemoveComma(obj.value));
		
		
    }
   
    // 천단위 이상의 숫자에 콤마( , )를 삽입하는 함수
    function inputNumberWithComma(str) {

        str = String(str);
        return str.replace(/(\d)(?=(?:\d{3})+(?!\d))/g, "$1,");
    }

    // 콤마( , )가 들어간 값에 콤마를 제거하는 함수
    function inputNumberRemoveComma(str) {

        str = String(str);
        return str.replace(/[^\d]+/g, "");
    }
</script>

</html>