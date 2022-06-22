
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
            <li><span class="stepProcess02"></span><span><em>STEP02</em>수수료</span></li>
            <li ><span class="stepProcess03"></span><span><em>STEP03</em>신고대행 의뢰</span></li>
            <li class="on"><span class="stepProcess04"></span><span><em>STEP04</em>부가정보 입력</span></li>
            <li><span class="stepProcess05"></span><span><em>STEP05</em>신고대행 의뢰완료</span></li>
        </ul>
    </section>

    <section class="step04">
        <div class="fL">
            <h1><span>step04</span>부가정보 입력</h1>
        </div>
        <div class="fR">
            <h1>부가세 신고대행 의뢰가 접수되었습니다. <br> <br> 

부가세 신고를 위해 아래의 정보를 입력 부탁드립니다.<br> 
아래 입력하신 정보는 부가세 신고를 위한 용도로만 사용됩니다</h1>
            <input type="button" class="graybtn" value="홈택스 ID/PW 찾기" id="find_idpw" name="find_idpw">  
            <div>
                <label>사업자용 홈택스 아이디를 입력해주십시오</label>
                <input type="text" placeholder="홈택스 ID" id="hometax_id" name="hometax_id" maxlenth=20 >
                <label>사업자용 홈택스 패스워드를 입력해주십시오</label>
                <input type="text" placeholder="홈택스 PW" id="hometax_pw" name="hometax_pw"  maxlenth=15>
                <label>고객님의 주민등록번호를 입력해주십시오</label>
                <input type="text"   id="resident_id1" name="resident_id1" maxlength=6 placeholder="주민등록번호1" style="width: 150px;" />  
                -  
                <input type="password" id="resident_id2" name="resident_id2" maxlength=7 placeholder="주민등록번호2" style="width: 150px;" />
            </div>                        
            <input type="button" value="다  음" id="action_step4" name="action_step4">             
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
	var request = new Request();
	var cstid = request.getParameter("id");
	var bizid = request.getParameter("id2");
	// 특수문자 정규식 변수(공백 미포함)
	var replaceChar = /[\{\}\[\]\/?.,;:|\)*~`!^\-+&lt;&gt;@\#$%&amp;\\\=\(\'\"]/gi;
	//정규식
	var replaceNotFullKorean = /[^a-z0-9]/gi;

	fetchUser();
	function fetchUser()
	{
		var request = new Request();
		var cstid = request.getParameter("id");
		var bizid = request.getParameter("id2");
		var action = "select_vat_step4";

		if(cstid =="" || bizid ==""){
			alert('올바르지 않은 경로로 접근하였습니다. 첫등록화면으로 이동합니다.');
			window.location.replace("sub_step01.php");
			return false;
		}

		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{cstid:cstid, action:action},
			dataType:"json",
			success:function(data)
			{
				console.log(data);
				$('#hometax_id').val(data.HomeTaxID);
				$('#hometax_pw').val(data.HomeTaxPW);

				var res_id = data.RESIDENT_ID;
				var res_id1 = res_id.substring(0,6);
				var res_id2 = res_id.substring(6,13);
				$('#resident_id1').val(res_id1);
				$('#resident_id2').val(res_id2);
			//if(data.OPTION1 == 'Y') $('[name=check01]').prop('checked', true);
			

			},error : function(request, status, error ){
				// 오류가 발생했을 때 호출된다.
				console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		})
		
	}

	
	$('#action_step4').click(function(){
		var action = "upt_hometax_idpw";
		var hometax_id = $('#hometax_id').val();
		var hometax_pw = $('#hometax_pw').val();
		var res_id1 = $('#resident_id1').val();
		var res_id2 = $('#resident_id2').val();
		var res_id = ''.concat(res_id1,res_id2);

		if(hometax_id == ""){
				alert("아이디를 입력하여 주세요.");
				hometax_id.focus();
				return false;
			}

		if(hometax_pw == ""){
			alert("패스워드를 입력하여 주세요.");
			hometax_pw.focus();
			return false;
		}

		if(res_id1 == "" || res_id2 ==""){
			alert("주민등록번호를 정확하게 입력하여 주세요.");
			res_id1.focus();
			return false;
		}

		if(hometax_id != "" && hometax_pw != "" && res_id1 !="" & res_id2 != ""){
			$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"action.php", 
					method:"POST",
					data:{action:action,cstid:cstid,hometax_id:hometax_id,hometax_pw:hometax_pw,res_id,res_id},
					success:function(data){
						if(data.replace(" ","")=="입력완료"){
							window.location.href="sub_step05.php?id="+cstid+"&id2="+bizid;
						}else{
							alert("처리도중 오류가 발생하였습니다. 관리자에게 문의하여주세요.");
						}
					}
				});
			}
		
	});

//* 특수문자 제거 *//
	$("#hometax_id").on("focusout", function() {
		var x = $(this).val();
			if (x.length > 0) {
				if (x.match(replaceChar) || x.match(replaceNotFullKorean)) {
					x = x.replace(replaceNotFullKorean, "");
				}
				$(this).val(x);
			}
			}).on("keyup", function() {
				$(this).val($(this).val().replace(replaceNotFullKorean, ""));
    });
/*
	$("#hometax_pw").on("focusout", function() {
		var x = $(this).val();
			if (x.length > 0) {
				if (x.match(replaceChar) || x.match(replaceNotFullKorean)) {
					x = x.replace(replaceChar, "").replace(replaceNotFullKorean, "");
				}
				$(this).val(x);
			}
			}).on("keyup", function() {
				$(this).val($(this).val().replace(replaceNotFullKorean, ""));
    });
*/

   $("input:text[numberOnly]").on("keyup", function() {
      $(this).val($(this).val().replace(/[^0-9]/g,""));
   });
//* 특수문자 제거 *//


	$('#find_idpw').click(function(){
		window.open("https://www.hometax.go.kr/websquare/websquare.html?w2xPath=/ui/pp/index.xml");
	});
	
	

});


</script>
	