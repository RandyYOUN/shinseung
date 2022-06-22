
<?php include("top.php");?>
<script src="resources/js/wf_loading.js" type="text/javascript"></script>
<link href="resources/css/wf_loading.css" rel="stylesheet" type="text/css" />
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
            <li><span class="stepProcess04"></span><span><em>STEP04</em>부가정보 입력</span></li>
            <li class="on"><span class="stepProcess05"></span><span><em>STEP05</em>신고대행 의뢰완료</span></li>
        </ul>
    </section>

   <section class="step05">
        <div class="stepwrap">
            <div class="fL">
                <h1><img src="resources/images/step05Img.png"></h1>
            </div>
            <div class="fR">
                <h1><span>step05</span>신고대행 의뢰완료</h1>
                <span>부가세 신고대행을 맡겨주셔서  감사드립니다.  <br>
                    신고관련 진행사항이나 <br>
					신고서 / 납부서 전달 등의 절차는 <br>
					카카오톡으로 편리하고, 신속하게 안내드리겠습니다</span>
            </div>
        </div>
        
        <div class="all">
            <h1>부가세 신고 이후 진행사항</h1>
            <ul>
                <li>
                    <span>1</span><span>홈택스 수임 동의 요청<br>[카카오톡으로 안내]</span>
                    <input type="button" value="홈택스 수임동의 요령" onclick="javascript:alert('준비중입니다.');">
                </li>
                <li>
                    <span>2</span><span>홈택스 수임 동의 완료시<br>세무 담당자 배정</span>
                </li>
                <li>
                    <span>3</span><span>필요 서류 검토 </span>
                </li>
                <li>
                    <span>4</span><span>필요시 추가 서류 요청<br>[카카오톡으로 안내]</span>
                    <input type="button" value="추가 서류 업로드" href="#layer2" class="btn-example">
                    
                </li>
                <li>
                    <span>5</span><span>부가세 신고 </span>
                </li>
                <li>
                    <span>6</span><span>필요시 추가 서류 요청<br>[카카오톡으로 안내]</span>
                </li>
            </ul>
        </div>
    </section>
    
    <div class="dim-layer">
    <div class="dimBg"></div>
    <div id="layer2" class="pop-layer">
        <div class="pop-container">
            <div class="pop-conts">
                <!--content //-->
                  <section class="link2" style="height: 570px; margin:0;">
                  		<button style="width:50px;margin:0 0 0 1340px; font-size:larger;" type="button" name="close" id="close">X 닫기</button>
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
            
            				<button style="width:510px;" type="button" name="action_commit" id="action_commit">검토신청</button>
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
		}else{
			alert("파일크기가 40M를 넘을 수 없습니다.\n관리자에게 문의하셔주세요.");
			return false;	
		}
       

    });

	 $.each(files, function(key, value)
	 {
	  data.append(key, value);
	 });

	

	 
	  $.ajax({
				
			 url: 'upload_process.php?files&id='+id+'&id2='+id2, //file을 저장할 소스 주소입니다.
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




	
	$('#action_commit').click(function(){

		var request = new Request();
		var action = "action_insert_files";
		var cstid = request.getParameter("id");
		var bizid = request.getParameter("id2");
		
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
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

	<?php include("subbottom.php");?>

	<?php include("footer.php");?>
