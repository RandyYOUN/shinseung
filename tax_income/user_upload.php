<?php include("top.php");?>
<script src="resources/js/wf_loading.js" type="text/javascript"></script>
<link href="resources/css/wf_loading.css" rel="stylesheet" type="text/css" />

	<div class="wrap">
			
		
		

		<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>

		

		<section class="link2" name="link2" id="link2" style="height:800px; margin:0;" >
			<h1>종합소득세 간편 안내서비스 </h1>
			<h2>종합소득세 <b>안내문</B>을 올려 주시면 검토하여 <B>세액, 환급금, 수수료를 안내해드립니다.</B></h2>

			<div class="wrapDiv">
				<input type="text" name="CSTNAME" id="CSTNAME" placeholder="성함을 입력해주세요" style="width:472px;"><BR><BR>
				<input type="text" name="MOBILE" id="MOBILE" placeholder="핸드폰번호를 입력해주세요"
					onKeyup="this.value=this.value.replace(/[^0-9]/g,'');" style="width:472px;"><br><BR>
				<input name="check02" id="check01" type="checkbox" checked value="Y" style="width:15px;">
				<label for="check01">세무톡 이용약관 및 개인정보처리방침에 동의합니다.<BR>입력하신 정보는 종합소득세 신고를 위한 용도로만 사용됩니다.</label>
                
				<h3><strong>[필수]</strong><B>종합소득세 안내문을 올려주셔야 검토가 가능합니다.</B></h3>

				<div class="filebox"> 
				  
				  <label for="upfile"  style="width:510px;">종합소득세 안내문 업로드</label> 
				  <button style="width:510px;display:none;margin-top:20px;" type="button" name="action" id="action" >검토신청</button>
				  <input type="file" id="upfile" name="upfile[]" multiple> 				  
				  <label class="upload-name" value=""></label>
				  		
				</div>
		</section>

		<script>

		

		</script>

<?php
include "../db_info.php";
?>

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





$(document).ready(function(){
	var html = '';
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var cstname = $('#CSTNAME').val();
		var mobile= $('#MOBILE').val();

		if($("input:checkbox[id=check01]").is(":checked") == true) {
				var check01= "Y";
		}else{
				var check01= "N";
		}
		
		
		var action = "등록";

		if(check01 = "Y"){
			if(cstname !='' && mobile!= ''){

				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"../admin/action.php", 
					method:"POST",
					data:{cstname:cstname,mobile:mobile,action:action},
					success:function(data){
						alert(data);
						location.reload();
					}
				});

			}else{
				alert('빈칸을 입력해 주세요');
			}		
		}else{
			alert("개인정보처리방침에 동의하여 주세요.");
			return;
			}
		//성과 이름이 올바르게 입력이 되면
		/*
		*/
	}); // [2]끝
	

	$('#upfile').on('click', function(e){
		var mobile = document.getElementById('MOBILE').value;
		var cstname = document.getElementById('CSTNAME').value;
		
		if(mobile =="" && cstname ==""){
			alert("업로드하시기전 성함과 핸드폰번호 입력이 필요합니다.");
			if(cstname==''){
				document.getElementById('CSTNAME').focus();
			}else if(mobile==''){
				document.getElementById('MOBILE').focus();
			}else{
				document.getElementById('CSTNAME').focus();
			}

			return false;
		}else{
			return true;
		}

	});


/*종합소득세 안내문 업로드 : S */
	$('#upfile').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;

		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		var mobile = document.getElementById('MOBILE').value;
		var cstname = document.getElementById('CSTNAME').value;
		var filelist_height = $('.upload-name').height();
		var link2_height = $('.link2').height();

		if(filelist_height != 35){
			filelist_height = 35; // 재첨부시 높이값 초기화
		}

		if(link2_height != 970){
			link2_height = 970; // 재첨부시 높이값 초기화
		}

		fileBuffer = [];
        const target = document.getElementsByName('files[]');
        
        Array.prototype.push.apply(fileBuffer, files);
        //var html = '';
        $.each(files, function(index, file){
            const fileName = file.name;
            html += '<span style="color:black;">'+fileName+'</span><br>';
            const fileEx = fileName.slice(fileName.indexOf(".") + 1).toLowerCase();
			filelist_height += 30;
			link2_height += 30;

            
           
			$('.upload-name').css("height",filelist_height+"px");
			$('.link2').css("height",link2_height+"px");
			$('.upload-name').html(html);
			$('#action').css("display","");
        });



		 $.each(files, function(key, value)
		 {
		  data.append(key, value);
		 });

		

		 
		  $.ajax({
					
				 url: 'upload_process.php?files&mobile='+mobile+'&cstname='+encodeURI(cstname), //file을 저장할 소스 주소입니다.
				 type: 'POST',
				 data: data, //위에서 가공한 data를 전송합니다.
				 cache: false,
				 dataType: 'json',
				 processData: false, 
				 contentType: false,
				 beforeSend: function() {

                     //통신을 시작할때 처리되는 함수 
                    // 현재 html 문서위에 있는 마우스 커서를 로딩 중 커서로 변경
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

	             },complete: function() {

                     //통신이 완료된 후 처리되는 함수
          
					 var ele = document.getElementById('wfLoading');
					if (ele) {
					  ele.remove();
					}

                },
				 success: function(data, textStatus, jqXHR)
				 {
					 alert(data);
					 
				 },
				 error: function(jqXHR, textStatus, errorThrown)
				 {
				  console.log('ERRORS: ' + textStatus);
				 }
			 });
		
		 
	});
/*종합소득세 안내문 업로드 : E*/


/*부속서류 업로드 : S */
	$('#file2').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;
		 var data = new FormData();
		
		 $.each(files, function(key, value)
		 {
		  data.append(key, value);
		 });

		 
		  $.ajax({
					
				 url: 'upload_process.php?files&mobile='+mobile+'&cstname='+encodeURI(cstname), //file을 저장할 소스 주소입니다.
				 type: 'POST',
				 data: data, //위에서 가공한 data를 전송합니다.
				 cache: false,
				 dataType: 'json',
				 processData: false, 
				 contentType: false,
				 success: function(data, textStatus, jqXHR)
				 {
					 alert(data.error);
				  if(typeof data.error === 'undefined') //에러가 없다면
				  {

			   //저장된 파일의 정보를 통해 위에서 선언한 img_section이란 곳에 추가 할 코드입니다. 										  파일이 1개기 때문에 index가 0입니다.
				  //var source = '<img src ="'+data.files[0]+'" style="width:270px; height:160px" id="img_url" name="img_url">'

				  }
				  else//에러가 있다면
				  {
				   console.log('ERRORS: ' + data.error);
				  }
				 },
				 error: function(jqXHR, textStatus, errorThrown)
				 {
				  console.log('ERRORS: ' + textStatus);
				 }
			 });
	
		 
	});
/*부속서류 업로드 : E*/


});



</script>
