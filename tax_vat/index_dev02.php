<!doctype html>
<html>
<head>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-WZ6LQ7D');</script>
<!-- End Google Tag Manager -->
	<title>세무톡 - 부가세 신고전문</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="세무톡 - 부가세 신고전문센터">
	<meta property="og:description" content="쉽고 편한 부가세 신고">
	<meta property="og:image" content="resources/images/sum_vat.jpg">
	<link rel="stylesheet" href="resources/css/basic.css" />
	<link rel="stylesheet" href="resources/css/swiper.css">
	<link rel="stylesheet" href="resources/css/main.css" />

	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>

	</head>
	<body>
<br><br>
STEP2..<br>
<input type="checkbox" id="option1" name="option1" value="" />option1<br>
<input type="checkbox" id="option2" name="option2" value="" />option2<br>
<input type="checkbox" id="option3" name="option3" value="" />option3<br>
<input type="checkbox" id="option4" name="option4" value="" />option4<br>
<input type="checkbox" id="option5" name="option5" value="" />option5<br>
<input type="checkbox" id="option6" name="option6" value="" />option6<br>
<input type="checkbox" id="option7" name="option7" value="" />option7<br>
<input type="checkbox" id="option8" name="option8" value="" />option8<br>
<input type="checkbox" id="option9" name="option9" value="" />option9<br>
<input type="checkbox" id="option10" name="option10" value="" />option10<br>
<input type="checkbox" id="option11" name="option11" value="" />option11<br>

<label>예상수수료 : </label>
<label id="est_fee" name="est_fee"></label> 원<br>
<input type="checkbox" id="agreement" name="agreement" value="" />신고대행 수수료는 서류 검토 후 조정될 수 있습니다. 이점 양해부탁드립니다.<br>
<br><br>
<input type="button" id="action2" name="action2" value="다음" /><br>
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

			if(data.OPTION1 == 'Y') $('[name=option1]').prop('checked', true);
			if(data.OPTION2 == 'Y') $('[name=option2]').prop('checked', true);
			if(data.OPTION3 == 'Y') $('[name=option3]').prop('checked', true);
			if(data.OPTION4 == 'Y') $('[name=option4]').prop('checked', true);
			if(data.OPTION5 == 'Y') $('[name=option5]').prop('checked', true);
			if(data.OPTION6 == 'Y') $('[name=option6]').prop('checked', true);
			if(data.OPTION7 == 'Y') $('[name=option7]').prop('checked', true);
			if(data.OPTION8 == 'Y') $('[name=option8]').prop('checked', true);
			if(data.OPTION9 == 'Y') $('[name=option9]').prop('checked', true);
			if(data.OPTION10 == 'Y') $('[name=option10]').prop('checked', true);
			if(data.OPTION11 == 'Y') $('[name=option11]').prop('checked', true);
			if(data.AGREEMENT == 'Y') $('[name=agreement]').prop('checked', true);

			cal_option();

			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})
		
	}
	
	
	$('#action2').click(function(){

		var request = new Request();
		var action = "action_vat_option_insert";
		var cstid = request.getParameter("id");
		var bizid = request.getParameter("id2");

		for(var i=1; i<11; i++){
			
			if($("input[id=option"+i+"]").is(":checked")){
				$('#option'+i).val("Y");
			}
		}

		var option1 = $('#option1').val();
		var option2 = $('#option2').val();
		var option3 = $('#option3').val();
		var option4 = $('#option4').val();
		var option5 = $('#option5').val();
		var option6 = $('#option6').val();
		var option7 = $('#option7').val();
		var option8 = $('#option8').val();
		var option9 = $('#option9').val();
		var option10 = $('#option10').val();
		var option10 = $('#option11').val();

		if($("input[id=agreement]").is(":checked")){
			var agreement = "Y";
		}

		var est_fee =  $('#est_fee').html();



//		alert(agreement);


		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
			method:"POST",
			data:{option1:option1,option2:option2,option3:option3,option4:option4,option5:option5,option5:option5,option6:option6,option7:option7,option8:option8,option9:option9,option10:option10,option11:option11,bizid:bizid,action:action,agreement:agreement,est_fee:est_fee},
			success:function(data){
				alert(data);
				//location.reload();
				window.location.href="index_dev03.php?id="+cstid+"&id2="+bizid+"&fee="+est_fee;
			}
		});
	}); // [2]끝


	$('#option1').click(function(){
		cal_option();
	});		

	$('#option2').click(function(){
		cal_option();
	});		

	$('#option3').click(function(){
		cal_option();
	});		

	$('#option4').click(function(){
		cal_option();
	});		

	$('#option5').click(function(){
		cal_option();
	});		

	$('#option6').click(function(){
		cal_option();
	});		

	$('#option7').click(function(){
		cal_option();
	});		

	$('#option8').click(function(){
		cal_option();
	});		

	$('#option9').click(function(){
		cal_option();
	});		

	$('#option10').click(function(){
		cal_option();
	});		

	$('#option11').click(function(){
		cal_option();
	});		

	function cal_option(){
		//alert(obj);
	   
		var ck=0;
		for(var j=1;j<11;j++){
			if($("#option"+j).is(":checked")) ck = j;
		}

		//alert(ck);
		if(ck<1) $('#est_fee').html("110,000");
		if(ck > 0 && ck<3) $('#est_fee').html("55,000");
		if(ck > 2 && ck < 8) $('#est_fee').html("110,000");
		if(ck > 7 ) $('#est_fee').html("165,000");

	}

});


</script>
