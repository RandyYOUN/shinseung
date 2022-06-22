<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승세무법인 ADMIN</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<body>
<?php
include "top.php";
?>
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
									<h2><i>수임금액</i></h2>
								</td>
								<td>
									<input type="box" class="w50" name="s_str" id="s_str">
								</td>
							</tr>
							<tr>
								<td>
									<h2><i>구분</i></h2>
								</td>
								<td>
									<label><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="IND" checked><div style="margin:-26px 20px 10px 20px;">개인</div></label>
									<label><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="COR"><div style="margin:-26px 20px 10px 20px;">법인</div></label>
								</td>
							</tr>
							<tr>
								<td>
									<h2><i>가산</i></h2>
								</td>
								<td>
									<label><input type="radio" name="rd_ADD" id="rd_ADD" value="0" checked><div style="margin:-26px 20px 10px 20px;">없음</div></label>
									<label><input type="radio" name="rd_ADD" id="rd_ADD" value="0.1"><div style="margin:-26px 20px 10px 20px;">10%</div></label>
									<label><input type="radio" name="rd_ADD" id="rd_ADD" value="0.2"><div style="margin:-26px 20px 10px 20px;">20%</div></label>
									<label><input type="radio" name="rd_ADD" id="rd_ADD" value="0.3"><div style="margin:-26px 20px 10px 20px;">30%</div></label>
									<label><input type="radio" name="rd_ADD" id="rd_ADD" value="0.5"><div style="margin:-26px 20px 10px 20px;">50%</div></label>
								</td>
							</tr>

							<tr>
								<td>
									<h2><i>1차조정료</i></h2>
								</td>
								<td>
									<label style="font-size:20px; color:red;" id="1st_payment"> </label>
									<div id = "query1" style="font-size:20px;color:gray;"></div>
								</td>
							</tr>

							<tr>
								<td>
									<h2><i>2차조정료</i></h2>
								</td>
								<td>
									
									<div id = "query2" style="font-size:20px;color:gray;"></div>
								</td>
							</tr>

							<tr>
								<th>
									<h2><i>문서복사용(Ctrl+C)</i></h2>
								</th>
								<td>
									<div style="width:650px;" id="copy_doc1"></div>
									<div style="width:650px;" id="copy_doc2"></div>
									<div style="width:650px;" id="copy_doc3"></div>
								</td>
							</tr>
						</tbody>
					</table>
				
				
			</div>
		</div>

		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="page_flag" value="조정료계산기">

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


	function cal_test(){
			
			var pay = $("#s_str").val();
			pay = replaceAll(pay,",","");
			pay = parseInt(pay);
			//alert(pay);

			var gubun = $(":radio[id='rd_GUBUN']:checked").val() ;
			var add = $(":radio[id='rd_ADD']:checked").val() ;
			var pa1 = $("1st_payment").val() ;

			var st1 = 0; //1차조정료
			var st2 = 0; //2차조정료
			var tmp1 = 0; // 초과차액
			var query1 = ""; //계산식1
			var query2 = ""; //계산식2
			var gubun_money = 0; //금액별 기준금액
			var math = 0; // 금액별 배율

			if(pay < 100000000){ //1억미만

				switch(gubun){
					case "IND" : st1 = 350000;
								st2 = 350000 + (350000 * parseFloat(add));
								query1 = "계산식 => 개인 : 1억 미만 = 350,000원";
								query2 = "계산식 => 350,000 + ( 350,000 x " +  String(add) + " )";
								gubun_money = 350000;
								break;
					case "COR" : st1 = 450000;
								st2 = 450000 + (450000 * parseFloat(add));
								query1 = "계산식 => 법인 : 1억 미만 = 450,000원";
								query2 = "계산식 => 450,000 + ( 450,000 x " +  String(add) + " )";
								gubun_money = 450000;
								break;
					default:"";
				}

			}else if(pay >= 100000000 && pay < 300000000){ //1억이상 3억미만
				tmp1 = pay - 100000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(350000 + (tmp1*15)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 350,000 + ( " + inputNumberWithComma(String(tmp1))+" x 15 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 350000;
								math = 15;

								break;
					case "COR" : st1 = 400000 + (tmp1*18)/10000;
								st2 = st1 + (st1 * parseFloat(add));
								query1 = "계산식 => 400,000 + ( " + inputNumberWithComma(String(tmp1))+" x 18 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 400000;
								math = 18;
								break;
					default:"";
				}
			}else if(pay >= 300000000 && pay < 500000000){ //3억이상 5억미만
     			tmp1 = pay - 300000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(650000 + (tmp1*12)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 650,000 + ( " + inputNumberWithComma(String(tmp1))+" x 12 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 650000;
								math=12;
								break;
					case "COR" : st1 = Math.ceil(760000 + (tmp1*15)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 760,000 + ( " + inputNumberWithComma(String(tmp1))+" x 15 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 760000;
								math=15;
								break;
					default:"";
				}
			}else if(pay >= 500000000 && pay < 1000000000){ //5억이상 10억미만
				tmp1 = pay - 500000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(890000 + (tmp1*10)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 890,000 + ( " + inputNumberWithComma(String(tmp1))+" x 10 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 890000;
								math=10;
								break;
					case "COR" : st1 = Math.ceil(1060000 + (tmp1*12)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 1,060,000 + ( " + inputNumberWithComma(String(tmp1))+" x 12 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 1060000;
								math=12;
								break;
					default:"";
				}
			}else if(pay >= 1000000000 && pay < 2000000000){ //10억이상 20억미만
				tmp1 = pay - 1000000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(1390000 + (tmp1*7)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 1,390,000 + ( " + inputNumberWithComma(String(tmp1))+" x 7 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 1390000;
								math=7;
								break;
					case "COR" : st1 = Math.ceil(1660000 + (tmp1*10)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 1,660,000 + ( " + inputNumberWithComma(String(tmp1))+" x 10 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 1660000;
								math=10;
								break;
					default:"";
				}
			}else if(pay >= 2000000000 && pay < 5000000000){ //20억이상 50억미만
				tmp1 = pay - 2000000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(2090000 + (tmp1*4)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 2,090,000 + ( " + inputNumberWithComma(String(tmp1))+" x 4 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 2090000;
								math=4;
								break;
					case "COR" : st1 = Math.ceil(2660000 + (tmp1*6)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 2,660,000 + ( " + inputNumberWithComma(String(tmp1))+" x 6 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 2660000;
								math=6;
								break;
					default:"";
				}
			}else if(pay >= 5000000000 && pay < 30000000000){ //50억이상 300억미만
				tmp1 = pay - 5000000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(3290000 + (tmp1*3)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 3,290,000 + ( " + inputNumberWithComma(String(tmp1))+" x 3 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 3290000;
								math=3;
								break;
					case "COR" : st1 = Math.ceil(4460000 + (tmp1*4)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 4,460,000 + ( " + inputNumberWithComma(String(tmp1))+" x 4 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 4460000;
								math=4;
								break;
					default:"";
				}
			}else if(pay >= 30000000000 ){ //300억이상
				tmp1 = pay - 30000000000; // 초과액

				switch(gubun){
					case "IND" : st1 = Math.ceil(10790000 + parseFloat(tmp1*2.5)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 10,790,000 + ( " + inputNumberWithComma(String(tmp1))+" x 2.5 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 10790000;
								math=2.5;
								break;
					case "COR" : st1 = Math.ceil(14460000 + (tmp1*3)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 14,460,000 + ( " + inputNumberWithComma(String(tmp1))+" x 3 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 14460000;
								math=3;
								break;
					default:"";
				}
			}else{
				$("#1st_payment").text("0원");
				$("#2st_payment").text("0원");
			}
			
			var st1_add_vat = inputNumberWithComma(Math.ceil(st1 + (st1 * 0.1)));
			var st2_add_vat = inputNumberWithComma(Math.ceil(st2 + (st2 * 0.1)));

			$("#1st_payment").text(inputNumberWithComma(st1)+"원 (vat포함 : "+st1_add_vat+"원)");
			$("#2st_payment").text(inputNumberWithComma(st2)+"원 (vat포함 : "+st2_add_vat+"원)");
			$("#query1").text(query1);
			$("#query2").text(query2);

			var today = new Date();
			var yyyy = today.getFullYear()-1;
			var per = "";
			switch(add){
				case "0.1" : per = "10%";
				break;
				case "0.2" : per = "20%";
				break;
				case "0.3" : per = "30%";
				break;
				case "0.5" : per = "50%";
				break;
				default: per = "0%";
			}
			gubun_money = inputNumberWithComma(gubun_money);

			var copy_str1 = "(1) "+yyyy+"년 매출액: "+inputNumberWithComma($("#s_str").val())+"원 ";
			var copy_str2= "(2) 개인결산 및 조정수수료 계산내역: "+inputNumberWithComma(st2_add_vat)+"원(VAT포함)";
			var copy_str3="("+gubun_money+"+("+inputNumberWithComma(tmp1)+" x  "+String(math)+"/10,000)x"+per+"="+inputNumberWithComma(st2_add_vat)+"원";

			$("#copy_doc1").text(copy_str1);
			$("#copy_doc2").text(copy_str2);
			$("#copy_doc3").text(copy_str3);



	}





$(document).ready(function(){

	$("input[name=rd_GUBUN]").change(function(){
		cal_test();
	});

	$("input[name=rd_ADD]").change(function(){
		cal_test();
	});


});



</script>

<script type="text/javascript">
    function inputNumberAutoComma(obj) {

		cal_test();
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