
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
			<h1>종합소득세 간편신고 서비스</h1>
		</section>
	</header>

	<section class="stepProcess">
        <ul>
            <li class="on"><span class="stepProcess01"></span><span><em>STEP01</em>기본정보 입력</span></li>
            <li><span class="stepProcess02"></span><span><em>STEP02</em>예상납부세액 확인 </span></li>
            <li><span class="stepProcess03"></span><span><em>STEP03</em>신고의뢰 접수 </span></li>
        </ul>
    </section>

	<!-- step01 -->
    <section class="step01">
        <div class="fL">
            <h1><span>STEP01</span>맞춤정보 제공</h1>
        </div>
        <div class="fR">
            <h1>종합소득세 안내를 위해 아래의 정보를 입력 부탁드립니다</h1>
            <h2>입력하신 정보는 종합소득세 안내 및 신고를 위한 용도로만 사용됩니다.</h2>
            <input type="button" class="grayBtn" value="홈택스 ID/PW 찾기" onClick="window.open('https://www.hometax.go.kr/websquare/websquare.html?w2xPath=/ui/pp/index.xml');">
            <label>홈택스 아이디를 입력해주십시오</label><input type="text" placeholder="홈택스 아이디" id="HTID" name="HTID">
            <label>홈택스 패스워드를 입력해주십시오</label><input type="text" placeholder="홈택스 패스워드" id="HTPW" name="HTPW">
            <input type="button" value="예상 납부세액 및 수수료 확인하러 가기" id="action_insert_HT_info">
            <!-- input type="button" value="종합소득세 안내문 직접 올리기" class="darkblueBtn btn_layer" layer="1"-->
        </div>
    </section>

 <!-- popup -->
    <div class="layer_bg"></div>
    <div class="layer_wrap" layer="1">
        <a class="btn_close" layer="1"></a>
        <div>
            <h1>홈택스 ID / PW 입력이 어려우신 경우
                종합소득세 안내문을 올려주시면 전문가가 검토하여
                카톡으로 납부세액, 환급금, 신고대행 수수료를
                안내해드립니다.
            </h1>
            <input type="button" value="종합소득세 안내문 업로드" id="for_upfile"  >
            <input type="file" id="upfile" name="upfile[]" multiple style="position: absolute; width: 0; height: 0; padding: 0; overflow: hidden;	border: 0;"> 				  
            
            
            <input type="button" class="darkblueBtn" value="검토신청" onclick="javascript:ck_filecnt();">
        </div>
    </div>
    <!-- popup -->
    <input type="hidden" id="TMP_CSTNAME" name="TMP_CSTNAME" >
    <input type="hidden" id="TMP_MOBILE" name="TMP_MOBILE" >
    
    	
    <input type="hidden" id = "STEP1">
    <input type="hidden" id = "STEP2">    
    <input type="hidden" id = "STEP4">
    <input type="hidden" id = "STEP5">
    <input type="hidden" id = "STEP6">
    <input type="hidden" id = "STEP7">
    <input type="hidden" id = "STEP7-1">
    <input type="hidden" id = "STEP8">
    <input type="hidden" id = "STEP9">
    <input type="hidden" id = "xpsrt">
    <input type="hidden" id = "free_flag">
    <input type="hidden" id = "auth_code">
    <input type="hidden" id = "EST_FEE_LOCK">
        

	<?php include("subbottom.php");?>

	<?php include("footer.php");?>



<script>

function ck_filecnt(){
	var action = "select_inc_filecnt";
	var req = new Request();
	var id = "<?=$_POST["CSTID"];?>";		
	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"action.php",
		method:"POST",
		dataType:"json",
		data:{action:action,id:id},
		success:function(data){
			if(data.FILE_CNT>0){
				alert('안내문 검토 후 연락드리도록 하겠습니다. \n감사합니다.');
				window.location.replace('index.php');
			}else{
				alert('업로드된 파일이 없습니다.');
				return false;
			}
			
			
		}
	})
	
}

isloading = {
  start: function() {
    if (document.getElementById('wfLoading')) {
      return;
    }
    var ele = document.createElement('div');
    ele.setAttribute('id', 'wfLoading');
    ele.classList.add('loading-layer');
    ele.innerHTML = '<span class="loading-wrap"><span class="loading-text"><span>.</span><span>.</span><span>.</span></span></span>';
    document.body.append(ele);

    // Animation
    ele.classList.add('active-loading');
  },
  stop: function() {
    var ele = document.getElementById('wfLoading');
    if (ele) {
      ele.remove();
    }
  }
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



$(document).ready(function(){

	fetchUser();
	function fetchUser()
	{

		var action = "select_inc_info";
		var id = "<?=$_POST["CSTID"];?>";	
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"action.php",
			method:"POST",
			dataType:"json",
			data:{action:action,id:id},
			success:function(data){
				if(data.HTID || data.HTPW){
					alert("이미 입력된 정보가 있어 해당정보를 불러옵니다.");
					$('#HTID').val(data.HTID);
					$('#HTPW').val(data.HTPW);	
				}
				$('#TMP_CSTNAME').val(data.CSTNAME);
				$('#TMP_MOBILE').val(data.MOBILE);
				
			}
		})
	}

	var timerId = null;
	$('#action_insert_HT_info').click(function(){
		//timerId = setInterval(call_db, 1000);
		//ck_change();

		var id = "<?=$_POST["CSTID"];?>";	
		var HTID = $("#HTID").val();
		var HTPW = $("#HTPW").val();
				
		var action = "action_insert_HT_info";
		isloading.start();
		if(id ==""){
			alert("오류가 발생했습니다. 관리자에게 문의하여 주세요.");
			return false;
		}else{
			if(HTID != "" || HTPW != ""){
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{action:action,id:id,HTID:HTID,HTPW:HTPW}
					 ,success:function(data){
						 ck_change();
					}
				})
			}else{
				//clearInterval(timerId);
				alert("홈택스 정보를 입력해주세요.");
				return false;
			}		
		}

		isloading.stop();
		
	});

	
	function ck_change(){
		var id = "<?=$_POST["CSTID"];?>";	
		
		var action = "select_json";
		var input_id = $("#HTID").val();
		var input_pw = $("#HTPW").val();
		var year = "2021";
		var comp_cnt = 0;
		var total_paid=0;
		
		isloading.start();
		$.ajax({
			url:"../tilko/UnitTest/HomeTax_API_1.php",
			method:"POST",
			dataType:"json",
			data:{action:action,input_id:input_id, input_pw:input_pw ,year:year},
			success:function(data){

				if(data.Status == "OK" && data.total_paid != null){
					total_paid = data.total_paid;
					
					var est_tax = CAL_AUTO(data.total_paid, data.ext_ratio, data.del_price, data.add_tax);

					for(var i=0; i<data.rows_cnt; i++){
						if(data.xpsrt[i].indexOf("단순")>-1)
							$('#xpsrt').val(data.xpsrt);
						else
							$('#xpsrt').val("기준");

						if(data.bmanNm[i] !="" && data.txprDscmNoEncCntn[i] !="")
							comp_cnt ++;
							
					}
					
     				if(comp_cnt > 0)
						$('#free_flag').val("사업자");
     				else
						$('#free_flag').val("프리");


     				var est_fee_tmp = auto_cal_fee(total_paid);
     				
					 
					var action = "update_add_info";
					
					//$('#etcIncAmtYn').html(data.etcIncAmtYn);
					
					$.ajax({
    					url:"action.php",
    					method:"POST",
    					data:{action:action,id:id,total_paid:total_paid, est_tax:est_tax, est_fee_tmp:est_fee_tmp}
    					 ,success:function(data){
    						//clearInterval(timerId);
    						//window.location.href="sub_step02.php?id="+id;
    						
    						//timerId = setInterval(ck_change, 3000);
    						alert("정보가 저장되었습니다. 담당자가 확인 후 빠른시간안에 연락드리겠습니다. 감사합니다.");
    						//timerId = setInterval(ck_change, 3000);
    						window.location.href="index.php";
    					}
    				})
						
					
				}else{
					alert("※로그인실패\n\n1)종합소득세 대상자가 아니거나\n2)법인이거나 \n3)로그인단계에 보안카드가 설정되어있습니다. \n홈택스에 직접 로그인하여 확인이 필요합니다.\n\n홈택스 상세메시지 : ["+data.Message+"]");
				}

				isloading.stop();
			}
		})
	}


	function auto_cal_fee(tax){
		const today = new Date();   
		const date1 = new Date("2022-4-15");
		const date2 = new Date("2022-5-31");
		var xpsrt = $('#xpsrt').val();
		var free_flag = $('#free_flag').val();
		var tax = uncomma(tax.toString());
		var est_fee="";

		//if(today > date1 && today < date2){
		if(today > date1 && today < date2){
			if(xpsrt.indexOf("단순")>-1){ // 단순경비율
				est_fee="55000"; 
			}else{ // 기준경비율

				if(free_flag == "프리"){
					if(tax < 30000000){ // 3천만원미만
						est_fee="88000";
					}else if(tax >= 30000000 && tax < 40000000){ // 4천만원미만
						est_fee="110000";
					}else if(tax >= 40000000 && tax < 50000000){ // 5천만원미만
						est_fee="165000";
					}else if(tax >= 50000000 && tax < 60000000){ // 6천만원미만
						est_fee="220000";
					}else if(tax >= 60000000){ // 6천만원이상
						est_fee="별도협의";
					}
				}else{

					if(tax < 30000000){ // 3천만원미만
						est_fee="143000";
					}else if(tax >= 30000000 && tax < 40000000){ // 4천만원미만
						est_fee="165000";
					}else if(tax >= 40000000 && tax < 50000000){ // 5천만원미만
						est_fee="220000";
					}else if(tax >= 50000000 && tax < 60000000){ // 6천만원미만
						est_fee="275000";
					}else if(tax >= 60000000){ // 6천만원이상
						$('#EST_FEE').val("별도협의");
						est_fee="별도협의";
					} 
				}
					
			}
		}

		return est_fee;
	}


	function send_kakao(){
		var id = "<?=$_POST["CSTID"];?>";	
		var action = "Send_RPA_Reg_Auto1";
		var tmp_flag="A1001";
		

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../admin/api/send_tok.php", 
			method:"POST",
			data:{id:id, action:action,tmp_flag:tmp_flag},
			//dataType:"json",
			success:function(data)
			{
				console.log(data);
				if(data.indexOf("send_ok")>=0){
					window.location.href="sub_step02.php?id="+id;
				}
			}
		});
	}
	

	$('#for_upfile').click(function(){
		var id = "<?=$_POST["CSTID"];?>";			
		
		if(id ==""){
			alert("오류가 발생했습니다. 관리자에게 문의하여 주세요.");
			return false;
		}else{
			$('#upfile').click();
		}
		
	});
		

	/*종합소득세 안내문 업로드 : S */
	$('#upfile').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;
		 var maxSize = 50 * 1024 * 1024;//50MB

		 var id = "<?=$_POST["CSTID"];?>";	

		var cstname = $("#TMP_CSTNAME").val();
		var mobile = $("#TMP_MOBILE").val();

		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		
		var filelist_height = $('.upload-name').height();
		var link2_height = $('.layer_wrap').height();

		if(filelist_height != 35){
			//filelist_height = 35; // 재첨부시 높이값 초기화
		}

		if(link2_height != 570){
//			link2_height = 570; // 재첨부시 높이값 초기화
		}

		fileBuffer = [];
	    const target = document.getElementsByName('files[]');
	    
	    Array.prototype.push.apply(fileBuffer, files);
	    //var html = $('#file_list').html();
	    $.each(files, function(index, file){

			if(file.size <= maxSize){
/*
				const fileName = file.name;
				html += '<span style="color:black;">'+fileName+'</span><br>';
				const fileEx = fileName.slice(fileName.indexOf(".") + 1).toLowerCase();
				filelist_height += 30;
				link2_height += 30;
				$('#file_list').css("height",link2_height+30+"px");
			   
				$('.upload-name').css("height",filelist_height+"px");
				$('.link2').css("height",link2_height+"px");
				$('.upload-name').html(html);
*/
						
				 $.each(files, function(key, value)
				 {
				  data.append(key, value);
				 });

				

				 
				  $.ajax({
							
						 url: 'upload_process.php?files&cstname='+cstname+'&mobile='+mobile, //file을 저장할 소스 주소입니다.
						 type: 'POST',
						 data: data, //위에서 가공한 data를 전송합니다.
						 cache: false,
						 dataType: 'json',
						 processData: false, 
						 contentType: false,
						 beforeSend: function() {

							isloading.start();

						 },complete: function() {

							 //통신이 완료된 후 처리되는 함수
				 			 
							 isloading.stop();
							 

						},
						 success: function(data, textStatus, jqXHR)
						 {
							 console.log('ERRORS: ' + textStatus);
							 //alert('업로드 되었습니다.');
						 },
						 error: function(jqXHR, textStatus, errorThrown)
						 {
						  console.log('ERRORS: ' + textStatus);
						  //alert('업로드 되었습니다.');
						 }
					 });



			}else{
				alert("파일크기가 50M를 넘을 수 없습니다.\n관리자에게 문의하셔주세요.");
				return false;	
			}
	       

	    });
	    alert('업로드 되었습니다.');
	     
	});
	/*종합소득세 안내문 업로드 : E*/
		
		




});



function isEmpty(value){

    if(value == null || value.length === 0) {
           return "";
     } else{
            return value;
     }
}

function isEmptyNum(value){

    if(value == null || value.length === 0) {
           return 0;
     } else{
            return value;
     }
}



function uncomma(str) { 
	str = "" + str.replace(/,/gi, ''); 
	str = str.replace(/(^\s*)|(\s*$)/g, ""); 
	return (new Number(str));//문자열을 숫자로 반환 
}

//모든 콤마 제거
function removeCommas(x) {
  if(!x || x.length == 0) return "";
  else return x.split(",").join("");
}

function addCommas(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



function CAL_AUTO(total_money, ratio, del_price, add_tax){
	var total_money =  total_money;
	var ratio = 100 - ratio ;
	var result_step1 = Math.round(total_money * (ratio/100));
	var result_step2 = isEmptyNum(del_price);
	var result_step3 = result_step1 - result_step2 ;
	var result_step8 = add_tax;
	
	$("#STEP1").val(result_step1);
	$("#STEP2").val(result_step2);
	
	if(result_step3 < 0){
		result_step3 = 0;
		$("#STEP3").val("0");
		$("#STEP6").val("0");
	}else{
		$("#STEP3").val(result_step3);
		$("#STEP6").val("70000");
	}

	cal_tax_avr(result_step1 - result_step2);
	cal_step3_new(result_step3);
	

	var result_step7 = $("#STEP5").val() - $("#STEP6").val();
	if(result_step7 < 0) result_step7 = 0;
	
	$("#STEP7").val( result_step7 );
	$("#STEP7_1").val( result_step7 );
	$("#STEP8").val( result_step8 );

	
	var result_step9 = result_step7 - add_tax ;
	return result_step9 ;
}


function cal_tax_avr(P_TOTAL){

	if(P_TOTAL <= 12000000){
		$("#STEP4").val("6%");
	}else if(P_TOTAL > 12000000 && P_TOTAL <= 46000000){
		$("#STEP4").val("15%");
	}else if(P_TOTAL > 46000000 && P_TOTAL <= 88000000){
		$("#STEP4").val("24%");
	}else if(P_TOTAL > 88000000 && P_TOTAL <= 150000000){
		$("#STEP4").val("35%");
	}else if(P_TOTAL > 150000000 && P_TOTAL <= 300000000){
		$("#STEP4").val("38%");
	}else if(P_TOTAL > 300000000 && P_TOTAL <= 500000000){
		$("#STEP4").val("40%");
	}else if(P_TOTAL > 500000000 && P_TOTAL <= 1000000000){
		$("#STEP4").val("42%");
	}else if(P_TOTAL > 1000000000 ){
		$("#STEP4").val("45%");
	}	
}


function cal_step3_new(TOTAL3){
	if( TOTAL3 <= 12000000 ){
		$("#STEP5").val( TOTAL3 * 6 /100 );
	}else if(TOTAL3 > 12000000 && TOTAL3 <= 46000000){
		$("#STEP5").val( (TOTAL3 * 15/100)  - 1080000 );
	}else if(TOTAL3 > 88000000 && TOTAL3 <= 150000000){
		$("#STEP5").val( ( TOTAL3 * 24/100 ) - 5220000 );
	}else if(TOTAL3 > 88000000 && TOTAL3 <= 150000000 ){
		$("#STEP5").val( ( TOTAL3 * 35 /100 ) - 14900000 );
	}else if(TOTAL3 > 150000000 && TOTAL3 <= 300000000 ){
		$("#STEP5").val( ( TOTAL3 *  38 /100 ) - 19400000 );
	}else if( TOTAL3 > 300000000 && TOTAL3 <= 500000000 ){
		$("#STEP5").val( ( TOTAL3 * 40 /100 ) - 25400000 );
	}else if( TOTAL3 > 500000000 && TOTAL3 <= 1000000000 ){
		$("#STEP5").val( TOTAL5 = ( TOTAL3 * 42 /100 ) - 35400000 );
	}else if( TOTAL3 > 1000000000  ){
		$("#STEP5").val( ( TOTAL3 * 45 /100 ) - 65400000 );
	}

	//.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
	$("#STEP5").html( Math.ceil($("#STEP5").html()).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') );
}


</script>
