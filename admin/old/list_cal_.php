<?php
   $ip_ck= $_SERVER["REMOTE_ADDR"];
/*
   if($ip_ck != "183.98.163.168"){
		echo "<script>alert('허용되지 않은 ip입니다');window.location.replace('http://www.naver.com');</script>";
   }
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 ADMIN</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="신승세무법인 ADMIN">
	<meta property="og:url" content="http://taxtok.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="../resources/images/sum2.png">
	<link rel="shortcut icon" href="../resources/images/icon.ico">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
<script type="text/javascript" src="../news/se2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
-->
<!-- Bootstrap -->



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border:1px solid #ccc;
border-radius:5px;
margin-top:100px;


}

</style>


<!-- include libraries(jQuery, bootstrap) -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>


</head>
<body>
<form method="post" onsubmit="return checkit()">

<div class="container box" style="width:1400px;">
<span>
<img src="resources/images/new_logo.png">
</span>
<br><br>
<div>
	<span style="font-size:20px;">
		<a href="http://taxtok.kr/admin/list_cal.php">&nbsp;<b>[조정료계산기]</b>&nbsp;</a>
	</span>
</div>

<br>
<br>
<br><br>
<span style="color:red;"><b>※소수점 이하는 올림처리 됩니다.</b></span>
<table class="table table-bordered" >
<tr>
<th width="15%">
<label style="width:250px;height:70px;font-size:30px;">수입금액 : </label></th>
<th><input type = "text" style="width:500px;height:70px;font-size:30px;"  id="s_str" name="s_str" onKeyup="inputNumberAutoComma(this);" ></input>
</th>
</tr>
<tr>
<th><label style="width:250px;height:70px;font-size:30px;">구분 : </label></th>
<th><label style="font-size:30px;"><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="IND" checked style="width:50px;height:20px;">개인</label>&nbsp;&nbsp;&nbsp;
<label style="font-size:30px;"><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="COR" style="width:50px;height:20px;font-size:30px;">법인</label>
</th>
</tr>
<tr>
<th><label style="width:250px;height:70px;font-size:30px;">가산 : </label></th>
<th><label style="font-size:30px;"><input type="radio" name="rd_ADD" id="rd_ADD" value="0" checked style="width:50px;height:20px;">없음</label>&nbsp;&nbsp;&nbsp;

<label style="font-size:30px;"><input type="radio" name="rd_ADD" id="rd_ADD" value="0.1" style="width:50px;height:20px;">10%</label>&nbsp;&nbsp;&nbsp;
<label style="font-size:30px;"><input type="radio" name="rd_ADD" id="rd_ADD" value="0.2" style="width:50px;height:20px;font-size:30px;">20%</label>&nbsp;&nbsp;&nbsp;
<label style="font-size:30px;"><input type="radio" name="rd_ADD" id="rd_ADD" value="0.5" style="width:50px;height:20px;font-size:30px;">50%</label>
</th>
</tr>


<tr>
<th><label style="width:250px;height:70px;font-size:30px;">1차조정료 : </label></th>
<th><label style="width:650px;height:35px;font-size:30px; color:red;" id="1st_payment"> </label>
<div id = "query1" style="height:35px;font-size:30px;color:gray;"></div>
</th>
</tr>
<tr>
<th><label style="width:250px;height:70px;font-size:30px;">2차조정료 : </label></th>
<th><label style="width:650px;height:35px;font-size:30px;  color:red;" id="2st_payment"> </label>
<div id = "query2" style="height:35px;font-size:30px;color:gray;"></div>
</th>
</tr>
<tr>
	<th>
		<label style="width:250px;height:70px;font-size:30px;">문서복사용(Ctrl+C) </label>
	</th>
	<th>
		<div style="width:650px;" id="copy_doc1"></div>
		<div style="width:650px;" id="copy_doc2"></div>
		<div style="width:650px;" id="copy_doc3"></div>
	</th>
</tr>
</table>

<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<br/><br/><br/><br/><br/><br/> 

<input type="hidden" id="s_sort">
<input type="hidden" id="s_flag">
</div>
</form>
</body>

<script>

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
					case "COR" : st1 = Math.ceil(4660000 + (tmp1*4)/10000);
								st2 = Math.ceil(st1 + (st1 * parseFloat(add)));
								query1 = "계산식 => 4,660,000 + ( " + inputNumberWithComma(String(tmp1))+" x 4 ÷ 10000)" ;
								query2 = "계산식 => "+inputNumberWithComma(st1)+" + ( "+inputNumberWithComma(st1)+" x " +  String(add) + " )";
								gubun_money = 4660000;
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

</body>
</html>