<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>신승세무법인-세무톡</title>
    <meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="국세청 33년 경력">
	<meta property="og:url" content="http://sostax.co.kr/">
	<meta property="og:description" content="쉽고 편한 세무상담센터">
	<meta property="og:image" content="http://sostax.co.kr/resources/images/sum.png">
	<meta name="description" content="신승세무법인">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
    <link rel="stylesheet" href="https://taxtok.kr/tax_income/resources/css/m_common.css" />
    <script type="text/javascript" src="https://taxtok.kr/tax_income/resources/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="https://taxtok.kr/tax_income/resources/js/common.js"></script>

</head>

<body>
    
    <!-- stepLast -->
    <section class="stepLast">
        <div class="contents">
            <div class="title">
                <h1><span><label id="CSTNAME" name="CSTNAME"></label></span>님<br></h1>
            </div>

            <h1>배송지 정보 상세</h1>
            <div class="conwrap">
            
            </div>
            <ul class="payment">
                <ul class="payment">
                    <li>
                        <h2>수령인</h2>
                        <input type="text" id="CSTNAME_" name="CSTNAME_"   style="width:250px;margin:5px; height:26px;border: 1px solid #e3e3e3;    padding: 5px 15px;">
                    </li>
                    <li>
                        <h2>연락처</h2>
                        <input type="text" id="MOBILE" name="MOBILE" style="width:250px;height:26px;border: 1px solid #e3e3e3;    padding: 5px 15px;">
                    </li>
                    <li style="margin-top: 40px;">
                        <h2>기존 주소</h2>
                        <h3 style="font-size: 18px;">
                        	<b><div id="OLD_ADDRESS" for="OLD_ADDRESS" style="word-break:break-all;width:300px;"></div></b>
                        </h3>
                    </li>
                    <li style="margin-top: 40px;">
                        <h2>신규 주소</h2>
                        <input type="text" id="POSTNUM" name="POSTNUM" placeholder="우편번호" style="margin:5px;height:26px;width:100px; border: 1px solid #e3e3e3;    padding: 5px 15px;">
                        <button class="b_search" style="margin-top:5px;cursor:pointer;background: #aab2ba;    color: white;    cursor: pointer;border: 1px solid #444;        height: 38px;    padding: 10px 15px;    letter-spacing: 0.5px;" onclick="javascript:sample2_execDaumPostcode();">우편번호검색</button>
                        <br>
                        <input type="text" id="ADDR1" name="ADDR1" placeholder="주소" style="width:300px; margin:5px;height:26px;border: 1px solid #e3e3e3;    padding: 5px 15px;">
                        <br>
                        <input type="text" id="ADDR2" name="ADDR2" placeholder="상세주소" style="width:130px; margin:5px;height:26px;border: 1px solid #e3e3e3;    padding: 5px 15px;">
                        <input type="text" id="ADDR3" name="ADDR3" placeholder="참고항목" style="width:110px; margin:5px;height:26px;border: 1px solid #e3e3e3;    padding: 5px 15px;">
                    </li>
                    <li>
                        <button id="btn_save" name="btn_save" class="b_search" style="width:300px; margin:5px;height:38px;cursor:pointer;background: #146cc5;    color: white;    cursor: pointer;border: 1px solid #444;        height: 38px;    padding: 10px 15px;    letter-spacing: 0.5px;    margin: 0 3px 0;">저장</button>
                    </li>
                </ul>
            </ul>
            
        </div>
    </section>
    
    <div id="layer" style="display:none;position:fixed;overflow:hidden;z-index:1;-webkit-overflow-scrolling:touch;">
<img src="//t1.daumcdn.net/postcode/resource/images/close.png" id="btnCloseLayer" style="cursor:pointer;position:absolute;right:-3px;top:-3px;z-index:1" onclick="closeDaumPostcode()" alt="닫기 버튼">
</div>
    
</body>
</html>

<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>


<script>
//우편번호 찾기 화면을 넣을 element
var element_layer = document.getElementById('layer');

function closeDaumPostcode() {
    // iframe을 넣은 element를 안보이게 한다.
    element_layer.style.display = 'none';
}

function sample2_execDaumPostcode() {
    new daum.Postcode({
        oncomplete: function(data) {
            // 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

            // 각 주소의 노출 규칙에 따라 주소를 조합한다.
            // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
            var addr = ''; // 주소 변수
            var extraAddr = ''; // 참고항목 변수

            //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
            if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                addr = data.roadAddress;
            } else { // 사용자가 지번 주소를 선택했을 경우(J)
                addr = data.jibunAddress;
            }

            // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
            if(data.userSelectedType === 'R'){
                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraAddr !== ''){
                    extraAddr = ' (' + extraAddr + ')';
                }
                // 조합된 참고항목을 해당 필드에 넣는다.
                document.getElementById("ADDR3").value = extraAddr;
            
            } else {
                document.getElementById("ADDR3").value = '';
            }

            // 우편번호와 주소 정보를 해당 필드에 넣는다.
            document.getElementById('POSTNUM').value = data.zonecode;
            document.getElementById("ADDR1").value = addr;
            // 커서를 상세주소 필드로 이동한다.
            document.getElementById("ADDR2").focus();

            // iframe을 넣은 element를 안보이게 한다.
            // (autoClose:false 기능을 이용한다면, 아래 코드를 제거해야 화면에서 사라지지 않는다.)
            element_layer.style.display = 'none';
        },
        width : '100%',
        height : '100%',
        maxSuggestItems : 5
    }).embed(element_layer);

    // iframe을 넣은 element를 보이게 한다.
    element_layer.style.display = 'block';

    // iframe을 넣은 element의 위치를 화면의 가운데로 이동시킨다.
    initLayerPosition();
}

// 브라우저의 크기 변경에 따라 레이어를 가운데로 이동시키고자 하실때에는
// resize이벤트나, orientationchange이벤트를 이용하여 값이 변경될때마다 아래 함수를 실행 시켜 주시거나,
// 직접 element_layer의 top,left값을 수정해 주시면 됩니다.
function initLayerPosition(){
    var width = 300; //우편번호서비스가 들어갈 element의 width
    var height = 400; //우편번호서비스가 들어갈 element의 height
    var borderWidth = 5; //샘플에서 사용하는 border의 두께

    // 위에서 선언한 값들을 실제 element에 넣는다.
    element_layer.style.width = width + 'px';
    element_layer.style.height = height + 'px';
    element_layer.style.border = borderWidth + 'px solid';
    // 실행되는 순간의 화면 너비와 높이 값을 가져와서 중앙에 뜰 수 있도록 위치를 계산한다.
    element_layer.style.left = (((window.innerWidth || document.documentElement.clientWidth) - width)/2 - borderWidth) + 'px';
    element_layer.style.top = (((window.innerHeight || document.documentElement.clientHeight) - height)/2 - borderWidth) + 'px';
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


/*코멘트 기능 글자수제한 스크립트*/
	function fnChkByte(obj) {
		var maxByte = 600; //최대 입력 바이트 수
		var str = obj.value;
		var str_len = str.length;
	
		var rbyte = 0;
		var rlen = 0;
		var one_char = "";
		var str2 = "";
	
		for (var i = 0; i < str_len; i++) {
			one_char = str.charAt(i);
	
			if (escape(one_char).length > 4) {
				rbyte += 2; //한글2Byte
			} else {
				rbyte++; //영문 등 나머지 1Byte
			}
	
			if (rbyte <= maxByte) {
				rlen = i + 1; //return할 문자열 갯수
			}
		}
	
		if (rbyte > maxByte) {
			alert("한글 " + (maxByte / 2) + "자 / 영문 " + maxByte + "자를 초과 입력할 수 없습니다.");
			str2 = str.substr(0, rlen); //문자열 자르기
			obj.value = str2;
			fnChkByte(obj, maxByte);
		} 
	}
/*코멘트 기능 글자수제한 스크립트 : End*/




$(document).ready(function(){



	var request = new Request();
	var flag = request.getParameter("flag");

	if(flag=="C"){
		fn_upt_C();
	}else if(flag=="N"){
		fn_upt_N();
	}


	function fn_upt_C(){
		var request = new Request();
		var cstid = request.getParameter("cstid");
		var action = "upt_address_C";

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../action_income.php", 
			method:"POST",
			dataType:"json",
			data:{cstid:cstid,action:action },
			success:function(data){
				if(data.ID){
					alert("탁상용 캘린더는 12월말 배송 예정입니다.\n배송주소를 확인해주셔서 한번더 감사드립니다.");
					window.location.replace("http://sostax.co.kr/");
				}else{
					alert('등록중 에러가 발생했습니다. 잠시후에 다시 시도하여주세요');
					return false;
				}
				
			}
		});

		
	}

	function fn_upt_N(){
		var request = new Request();
		var cstid = request.getParameter("cstid");
		var action = "upt_address_N";

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../action_income.php", 
			method:"POST",
			dataType:"json",
			data:{cstid:cstid,action:action },
			success:function(data){
				if(data.ID){
					alert('탁상용 캘린더 배송을 거절하셨습니다.');
					window.location.replace("http://sostax.co.kr/");
				}else{
					alert('등록중 에러가 발생했습니다. 잠시후에 다시 시도하여주세요');
					return false;
				}
				
			}
		});
	}

	
fetchUser();
function fetchUser()
{

	
	var action = "select_cst_info_address";
	$.ajax({
		url:"../action_income.php",
		method:"POST",
		dataType:"json",
		data:{action:action,id:"<?php echo $_GET["cstid"]?>"},
		success:function(data){
			if(data.CSTID){
				
				$("#CSTNAME").html(data.CSTNAME);
				$("#CSTNAME_").val(data.CSTNAME);
				//$("#CSTNAME_").attr("Readonly",true);
				$("#MOBILE").val(data.MOBILE);
				//$("#MOBILE").attr("Readonly",true);
				//$("#POSTNUM").val(data.POST_NUM);
				$("#OLD_ADDRESS").html("(" + data.POST_NUM + ") " + data.ADDRESS1 + " " +data.ADDRESS2);
				//$("#ADDR2").val(data.ADDRESS2);

			}
		}
	})
}

	

$('#btn_save').click(function(){

	//각 엘리먼트들의 데이터 값을 받아온다.
	var request = new Request();
	var cstid = request.getParameter("cstid");
	var cstname = $("#CSTNAME_").val();
	var mobile = $("#MOBILE").val();
	var postnum= $("#POSTNUM").val();
	var address = $('#ADDR1').val() + ' ' + $("#ADDR2").val()+ ' ' + $("#ADDR3").val();
	
	var action = "upt_cst_address";

	//성과 이름이 올바르게 입력이 되면
	if(cstname != ''&& mobile != '' && cstid != '' && $('#ADDR1').val() != "" &&  $("#ADDR2").val()!= "" && postnum != ""){

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../action_income.php", 
			method:"POST",
			dataType:"json",
			data:{cstid:cstid,cstname:cstname,mobile:mobile,postnum:postnum,address:address,action:action },
			success:function(data){
				if(data.ID){
					alert('배송주소가 변경되었습니다.\n탁상용 캘린더는 12월말 배송 예정입니다.\n감사합니다. ');
					window.location.replace("http://sostax.co.kr/");
				}else{
					alert('등록중 에러가 발생했습니다. 잠시후에 다시 시도하여주세요');
					return false;
				}
				
			}
		});

	}else{
		alert('빈칸을 입력해 주세요');
	}
}); // [2]끝



});
</script>