<?php include("top.php");?>


		<section class="subvisual sub_pricebg">
			<h1>부가세 간편신고 서비스</h1>
		</section>

		<script type="text/javascript" src="resources/js/SimpleTabs02.js"></script>
		<section class="subcon">
			<div class="subtabsWrap">		

				
		<section class="link2" style="height:260px;">
			<h1>추가 서류 업로드</h1>
			<h2><strong>[필수]</strong> 관련 파일을 올려주셔야 검토가 가능합니다.</h2>
			<div class="wrapDiv">
				

				<div class="filebox"> 
				  <label for="upfile"  style="width:100%;">추가 서류 업로드</label> 
				  <input type="file" id="upfile" name="upfile[]" multiple> 				  
				  <label class="upload-name" value=""  id="file_list" name="file_list" ></label>
				</div>

				<!--h3>근로소득지급명세서, 원천징수영수증, 부가세신고서, 기부금영수증 등 부속서류를 올려주시면 더 정확한 안내가 가능합니다.</h3>

				<div class="filebox"> 
				  <label for="file"  style="width:100%;">부속서류업로드</label> 
				  <input type="file" id="file"> 				  
				  <input class="upload-name" value="">
				</div-->

				<p></p>
				<button type="button" class="chatting" name="action_commit" id="action_commit">검토신청</button>
			</div>
		</section>
				
			</div>
		</section>

		<?php include("bottom.php");?>

<br><br><br>
<script src="resources/js/wf_loading.js" type="text/javascript"></script>
<link href="resources/css/wf_loading.css" rel="stylesheet" type="text/css" />


<script>


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




$('#upfile').on('click', function(e){
	var request = new Request();

	var id = request.getParameter("id");
	var id2 = request.getParameter("id2");
	
	
	if(id =="" || id2 ==""){
		alert("오류가 발생했습니다. 관리자에게 문의하여 주세요.");
		//isDim ? $('.dim-layer').fadeOut() : $el.fadeOut(); // 닫기 버튼을 클릭하면 레이어가 닫힌다.
		return false;
	}else{
		return true;
	}

});


/*종합소득세 안내문 업로드 : S */
$('#upfile').on('change', function(e){
	//파일들을 변수에 넣고
	 var maxSize = 40 * 1024 * 1024;//40MB
	 var files = e.target.files;
	 var request = new Request();

	var id = request.getParameter("id");
	var id2 = request.getParameter("id2");

	 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
	 var data = new FormData();
	
	var filelist_height = $('.upload-name').height();
	var link2_height = $('.link2').height();

	if(filelist_height != 35){
		//filelist_height = 35; // 재첨부시 높이값 초기화
	}

	if(link2_height != 570){
//		link2_height = 570; // 재첨부시 높이값 초기화
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
						
					 url: '../upload_process.php?files&id='+id+'&id2='+id2, //file을 저장할 소스 주소입니다.
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
/*종합소득세 안내문 업로드 : E*/




	
	$('#action_commit').click(function(){

		var request = new Request();
		var action = "action_insert_files";
		var cstid = request.getParameter("id");
		var bizid = request.getParameter("id2");
		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../action.php", 
			method:"POST",
			data:{cstid:cstid, bizid:bizid,action:action},
			success:function(data){
				alert(data);
				//location.reload();
				window.location.href="index.php";
			}
		});
	}); // [2]끝





</script>