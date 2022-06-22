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
STEP1..<br>
<input type="text" id="cstname" name="cstname" /><br>
<input type="text" id="mobile" name="mobile" /><br>
<input type="checkbox" id="agreement" name="agreement" value="Y" />세무톡 이용약관 및 개인정보처리방침에 동의해주십시오.<br>
<input type="button" id="action" name="action" value="다음" /><br>
<br><br>
</body>
	

<script>
$(document).ready(function(){

	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var cstname = $('#cstname').val();
		var mobile= $('#mobile').val();
//		var agreement= $("input:checkbox[name=agreement]:checked").length;
		var action = "action_vat_cst";

//		alert(agreement);

		if($("input:checkbox[id='agreement']").prop("checked", true)){
			alert("약관에 동의하여 주세요.");
			$('#agreement').focus();
			return false;
		}else{
			if(cstname !='' && mobile!= ''){
				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"action.php", 
					method:"POST",
					data:{cstname:cstname,mobile:mobile,action:action},
					dataType:"json",
					success:function(data){
						console.log(data);
						//alert(data.CSTID);
						if(data.CSTID){
							location.href="index_dev02.php?id="+data.CSTID+"&id2="data.BIZ_ID;		
						}else{
							alert("작성중 에러가 발생했습니다. 관리자에게 문의하여주세요.");
						}

					}
				});

			}else{
				alert('빈칸을 입력해 주세요');
			}
		}
	}); // [1]끝







});

</script>
