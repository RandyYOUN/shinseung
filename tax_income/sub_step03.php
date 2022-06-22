
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
            <li ><span class="stepProcess01"></span><span><em>STEP01</em>기본정보 입력</span></li>
            <li><span class="stepProcess02"></span><span><em>STEP02</em>예상납부세액 확인 </span></li>
            <li class="on"><span class="stepProcess03"></span><span><em>STEP03</em>신고의뢰 접수 </span></li>
        </ul>
    </section>

    <!-- step03 -->
    <section class="step03">
        <div class="fL">
            <h1><span>STEP03</span>신고의뢰 접수 </h1>
        </div>
        <div class="fR">
            <h1><strong><label id="CSTNAME" name="CSTNAME"></label></strong><span>님의 종합소득세 신고에 대해 안내드립니다</span></h1>
            <h2>고객님의 카톡으로도 예상납부세액과 신고대행수수료를 안내해드렸습니다.</h2>

            <div class="infor">
                <h1>접수정보</h1>
                <ul>
                    <li><strong>접수자 :</strong> <label id="CSTNAME2" name="CSTNAME2"></label></li>
                    <li><strong>연락처 :</strong> <label id="MOBILE" name="MOBILE"></label></li>
                    <li><strong>예상납부세액 :</strong> <label id="EXP_PAY_TAX" name="EXP_PAY_TAX"></label></li>
                    <li><strong>신고대행 수수료 :</strong> <label id="EST_FEE" name="EST_FEE"></label></li>
                    <li>접수일 : <label id="REGDATE" name="REGDATE"></label></li>
                </ul>
            </div>

            <div class="infor">
                <h1>* 선택정보</h1>
                <h2>고객님의 주민등록번호를 입력해주시면<BR>접수과정이 조금 더 수월해 집니다.</h2>
                <p><input type="text" placeholder="" id="RESIDENT_ID1" name="RESIDENT_ID1"><span>-</span><input type="password" placeholder="" id="RESIDENT_ID2" name="RESIDENT_ID2"></p>
                <h3>
                    입력하신 정보는 종합소득세 신고를 위한 용도로만 사용됩니다.<br>
                    접수정보를 기초로 절세포인트를 찾아 절세혜택을 드리겠습니다.
                    신고대행 수수료는 서류 검토 후 조정될 수 있습니다. 이점 양해부탁드립니다
                </h3><br><br>
                <h2>추가서류 업로드 (주민등록증 또는 안내문등)</h2>
                <input type="button" value="업로드" href="#layer2" class="btn-example" style="width:90%;height:60px;margin: 5px;    margin-left: 30px;    background-color: #4f5c68;">
            </div>

            <div class="btn">
                <input type="button" value="접수 완료" id="confirm_save" name="confirm_save">
            </div>

            <h3>
                접수완료 버튼 클릭시 카카오톡 채널로 연결되며 신고 담당자가 배정되어 수수료 입금계좌 및 추가 필요서류를 안내해드립니다.
            </h3>

        </div>
    </section>

      
    <div class="dim-layer">
        <div class="dimBg"></div>
        <div id="layer2" class="pop-layer">
            <div class="pop-container">
                <div class="pop-conts">
                    <!--content //-->
                      <section class="link2" style="height: 570px; margin:0;">
                      		
                			<h1 style="padding:40px 0 40px 0;">추가 서류 업로드</h1>
                			<div class="wrapDiv">
                				<h3><strong>[필수]</strong><B>관련 파일을 올려주셔야 검토가 가능합니다.</B></h3>
                
                				<div class="filebox"> 
                				  <label for="upfile"  style="width:510px;">추가 서류 업로드</label> 
                				  <input type="file" id="upfile" name="upfile[]" multiple> 				  
                				  <label class="upload-name" id="file_list" name="file_list" value=""></label>
                				</div>
                
                				<!--h3>근로소득지급명세서, 원천징수영수증, 부가세신고서, 기부금영수증 등 부속서류를 올려주시면 더 정확한 안내가 가능합니다.</h3>
                
                				<div class="filebox"> 
                				  <label for="file"  style="width:510px;">부속서류업로드</label> 
                				  <input type="file" id="file2"> 				  
                				  <input class="upload-name" value="">
                				</div-->
                
                				<button style="width:510px;" type="button" name="close" id="close">완료</button>
                				<br>
                				
                					
                
                			</div>
                			<h4>불편한 부가세신청 <strong>이젠 안녕!</strong></h4>
                			
                		</section>
                    <!--// content-->
                </div>
            </div>
        </div>
    </div>
        
    <style>
    * {
      margin: 0;
      padding: 0;
    }
    
    body {
      margin: 100px;
    }
    
    .pop-layer .pop-container {
      padding: 20px 25px;
    }
    
    .pop-layer p.ctxt {
      color: #666;
      line-height: 25px;
    }
    
    .pop-layer .btn-r {
      width: 100%;
      margin: 10px 0 20px;
      padding-top: 10px;
      border-top: 1px solid #DDD;
      text-align: right;
    }
    
    .pop-layer {
      display: none;
      position: absolute;
      top: 50%;
      left: 50%;
      width: 1440px;
      height: auto;
      background-color: #fff;
      border: 5px solid #3571B5;
      z-index: 10;
    }
    
    .dim-layer {
      display: none;
      position: fixed;
      _position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 100;
    }
    
    .dim-layer .dimBg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: #000;
      opacity: .5;
      filter: alpha(opacity=50);
    }
    
    .dim-layer .pop-layer {
      display: block;
    }
    
    a.btn-layerClose {
      display: inline-block;
      height: 25px;
      padding: 0 14px 0;
      border: 1px solid #304a8a;
      background-color: #3f5a9d;
      font-size: 13px;
      color: #fff;
      line-height: 25px;
    }
    
    a.btn-layerClose:hover {
      border: 1px solid #091940;
      background-color: #1f326a;
      color: #fff;
    }
    </style>
	<?php include("subbottom.php");?>
	<?php include("footer.php");?>

	
<script>


$('.btn-example').click(function(){
    var $href = $(this).attr('href');
    layer_popup($href);
});
function layer_popup(el){

    var $el = $(el);    //레이어의 id를 $el 변수에 저장
    var isDim = $el.prev().hasClass('dimBg'); //dimmed 레이어를 감지하기 위한 boolean 변수

    isDim ? $('.dim-layer').fadeIn() : $el.fadeIn();

    var $elWidth = ~~($el.outerWidth()),
        $elHeight = ~~($el.outerHeight()),
        docWidth = $(document).width(),
        docHeight = $(document).height();

    // 화면의 중앙에 레이어를 띄운다.
    if ($elHeight < docHeight || $elWidth < docWidth) {
        $el.css({
            marginTop: -$elHeight /2,
            marginLeft: -$elWidth/2
        })
    } else {
        $el.css({top: 0, left: 0});
    }

    $el.find('#close').click(function(){
        isDim ? $('.dim-layer').fadeOut() : $el.fadeOut(); // 닫기 버튼을 클릭하면 레이어가 닫힌다.
        return false;
    });

    $('.layer .dimBg').click(function(){
        $('.dim-layer').fadeOut();
        return false;
    });

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
		var req = new Request();
		var id = req.getParameter("id");		
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"action.php",
			method:"POST",
			dataType:"json",
			data:{action:action,id:id},
			success:function(data){
				$('#CSTNAME').html(data.CSTNAME);
				$('#CSTNAME2').html(data.CSTNAME);
				$('#EXP_PAY_TAX').html(data.EXP_PAY_TAX);
				$('#EST_FEE').html(data.EST_FEE);
				$('#MOBILE').html(data.MOBILE);
				$('#RESIDENT_ID1').val(data.RESIDENT_ID1);
				$('#RESIDENT_ID2').val(data.RESIDENT_ID2);
				$('#REGDATE').html(data.REGDATE);
			}
		})
	}





	$('#upfile').on('click', function(e){
		var request = new Request();

		var id = request.getParameter("id");
		var id2 = request.getParameter("id2");
		
		
		if(id =="" || id2 ==""){
			alert("오류가 발생했습니다. 관리자에게 문의하여 주세요.");
			isDim ? $('.dim-layer').fadeOut() : $el.fadeOut(); // 닫기 버튼을 클릭하면 레이어가 닫힌다.
			return false;
		}else{
			return true;
		}

	});


	/*종합소득세 안내문 업로드 : S */
	$('#upfile').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;
		 var request = new Request();
		 var maxSize = 40 * 1024 * 1024;//40MB
		 var cstname = $('#CSTNAME').val();
		 var mobile = $('#MOBILE').val();

		var id = request.getParameter("id");
		
		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		
		var filelist_height = $('.upload-name').height();
		var link2_height = $('.link2').height();

		if(filelist_height != 35){
			//filelist_height = 35; // 재첨부시 높이값 초기화
		}

		if(link2_height != 570){
//			link2_height = 570; // 재첨부시 높이값 초기화
		}

		fileBuffer = [];
	    const target = document.getElementsByName('files[]');
	    
	    Array.prototype.push.apply(fileBuffer, files);
	    var html = $('#file_list').html();
	    $.each(files, function(index, file){

			if(file.size <= maxSize){
				const fileName = file.name;
				html += '<span style="color:black;">'+fileName+'</span><br>';
				const fileEx = fileName.slice(fileName.indexOf(".") + 1).toLowerCase();
				filelist_height += 30;
				link2_height += 30;
				$('#file_list').css("height",link2_height+30+"px");
			   
				$('.upload-name').css("height",filelist_height+"px");
				$('.link2').css("height",link2_height+"px");
				$('.upload-name').html(html);

						
				 $.each(files, function(key, value)
				 {
				  data.append(key, value);
				 });

				

				 
				  $.ajax({
							
						 url: 'upload_process.php?files&id='+id+'&cstname='+cstname+'&mobile='+mobile, //file을 저장할 소스 주소입니다.
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



			}else{
				alert("파일크기가 40M를 넘을 수 없습니다.\n관리자에게 문의하셔주세요.");
				return false;	
			}
	       

	    });

	});
		
	$("#confirm_save").click(
		function(){

			var action = "save_resident";
			var req = new Request();
			var id = req.getParameter("id");

			var res1 = $('#RESIDENT_ID1').val();
			var res2 = $('#RESIDENT_ID2').val();
			/*		
			if(res1!="" && res2 != ""){
				$.ajax({
					url:"../action.php",
					method:"POST",
					data:{action:action,id:id, res1:res1, res2:res2 },
					success:function(data){
						console.log(data);
						alert('접수되었습니다.');
						window.location.href="index.php";
					}
				})
			}else{
				alert('주민등록번호를 입력하여주세요.');
				return false;
			}*/
			$.ajax({
				url:"../action.php",
				method:"POST",
				data:{action:action,id:id, res1:res1, res2:res2 },
				success:function(data){
					console.log(data);
					alert('접수되었습니다.');
					window.location.href="index.php";
				}
			})
		}
	);



});


</script>
	
	
	