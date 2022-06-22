<!DOCTYPE html>
<html>

</html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승세무법인 ADMIN</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- add summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/lang/summernote-ko-KR.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- codemirror -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>
<body>
	<div class="wrap">
<?include "top.php";?>		

		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				<div class="boardwrite">
					<table>
						<tbody>
							<tr>
								<th>제목</th>
								<td >
									<input type="box" class="w100" name="subject" id="subject">
								</td>
								<th></th>
								<td >
									
								</td>
							</tr>
							<tr>
								<th>기사작성자</th>
								<td>
									<input type="box" class="w50" name="news_reguser" id="news_reguser">
								</td>
								<th>기사작성자 소속</th>
								<td>
									<input type="box" class="w50" name="news_reguser_comp" id="news_reguser_comp">
								</td>
							</tr>
							<tr>
								<th>기사작성날짜</th>
								<td>
									<input type="box" class="w50" name="news_regdate" id="news_regdate" value="<?php echo date("Y-m-d H:i:s",time());?>">
								</td>

								
								<th>사이트구분</th>
								<td>
									<label><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="ALL" checked><div style="margin:-26px 20px 10px 20px;">전체</div></label>
									<label><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="HOS"><div style="margin:-26px 20px 10px 20px;">병원톡</div></label>
								</td>
								
							</tr>
							<tr>
								<th>카테고리</th>
								<td colspan=3>
									<div id="CATE_ALL" name = "CATE_ALL" style="DISPLAY:block;">
									<label><input type="radio" name="cate" id="cate" value="SCH" checked> <div style="margin:-26px 20px 10px 20px;">세무일정</div></label>
									<label><input type="radio" name="cate" id="cate" value="LED"> <div style="margin:-26px 20px 10px 20px;">장부기장</div></label>
									<label><input type="radio" name="cate" id="cate" value="VAT"><div style="margin:-26px 20px 10px 20px;">부가세</div></label>
									<label><input type="radio" name="cate" id="cate" value="CIT"><div style="margin:-26px 20px 10px 20px;">종소세</div></label>
									<label><input type="radio" name="cate" id="cate" value="TRA"><div style="margin:-26px 20px 10px 20px;">양도세</div></label>
									<label><input type="radio" name="cate" id="cate" value="INH"><div style="margin:-26px 20px 10px 20px;">상속세</div></label>
									<label><input type="radio" name="cate" id="cate" value="GTX"><div style="margin:-26px 20px 10px 20px;">증여세</div></label>
									<label><input type="radio" name="cate" id="cate" value="QNA"><div style="margin:-26px 20px 10px 20px;">상담사례</div></label>
									<label><input type="radio" name="cate" id="cate" value="THA"><div style="margin:-26px 20px 10px 20px;">절세극장</div></label>
									<label><input type="radio" name="cate" id="cate" value="19T"><div style="margin:-26px 20px 10px 20px;">19禁세금</div></label>
									<label><input type="radio" name="cate" id="cate" value="TAX"><div style="margin:-26px 20px 10px 20px;">조세</div></label>
									<label><input type="radio" name="cate" id="cate" value="LAB"><div style="margin:-26px 20px 10px 20px;">노무</div></label>
									<label><input type="radio" name="cate" id="cate" value="FOU"><div style="margin:-26px 20px 10px 20px;">창업</div></label>
									<label><input type="radio" name="cate" id="cate" value="OPE"><div style="margin:-26px 20px 10px 20px;">경영</div></label>
									<label><input type="radio" name="cate" id="cate" value="MNY"><div style="margin:-26px 20px 10px 20px;">자금</div></label>
									<label><input type="radio" name="cate" id="cate" value="PRO"><div style="margin:-26px 20px 10px 20px;">홍보</div></label>
									<label><input type="radio" name="cate" id="cate" value="ISS"><div style="margin:-26px 20px 10px 20px;">이슈</div></label>
									<label><input type="radio" name="cate" id="cate" value="HOM"><div style="margin:-26px 20px 10px 20px;">주택임대</div></label>
										
										<DIV ID = 'dept2' NAME='dept2' style="display:none ;">
										<table></table>
										<label><span style="color:red;margin:20px 0px 10px 0px;"><b>상담사례 2nd 카테고리</span> </b></label>
										<br>
										<label><input type="radio" name="c_cate" id ="c_cate" value="c_tra"><div style="margin:-26px 20px 10px 20px;">양도세</div></label>
										<label><input type="radio" name="c_cate" id ="c_cate" value="c_inh"><div style="margin:-26px 20px 10px 20px;">상속세</div></label>
										<label><input type="radio" name="c_cate" id ="c_cate" value="c_gtx"><div style="margin:-26px 20px 10px 20px;">증여세</div></label>
										<label><input type="radio" name="c_cate" id ="c_cate" value="c_btx"><div style="margin:-26px 20px 10px 20px;">종합부동산세</div></label>

										</DIV>

									</DIV>
									<div id="CATE_HOS" name = "CATE_HOS" style="DISPLAY:NONE;">
									<label><input type="radio" name="cate_h" id="cate_h" value="SCH" checked><div style="margin:-26px 20px 10px 20px;">세무일정</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="TRT"><div style="margin:-26px 20px 10px 20px;">세무신고</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="TIV"><div style="margin:-26px 20px 10px 20px;">세무조사</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="FOU"><div style="margin:-26px 20px 10px 20px;">개원</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="LAB"><div style="margin:-26px 20px 10px 20px;">노무</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="GTX"><div style="margin:-26px 20px 10px 20px;">증여세</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="INH"><div style="margin:-26px 20px 10px 20px;">상속세</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="TRA"><div style="margin:-26px 20px 10px 20px;">양도세</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="QNA"><div style="margin:-26px 20px 10px 20px;">상담사례</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="THA"><div style="margin:-26px 20px 10px 20px;">절세극장</div></label>
									<label><input type="radio" name="cate_h" id="cate_h" value="19T"><div style="margin:-26px 20px 10px 20px;">19禁세금</div></label>

									</DIV>
								</td>
							</tr>

						
							<tr>
								<th>
									글 노출여부<br><div style="color:red;margin:5px 0px 5px -20px;font-size:12px;">(※기본값 : <b>비노출</b>) </div>
								</th>
								<td>
									<div class="selectbox s50">
										<label for="">선택</label>
										<select name="visible" id ="visible" class="form-control">
										<option value="Y">승인</option>
										<option selected value="N">비노출</option>
									</select>
									</div>
								</td>
								<th></th>
								<td></td>
							</tr>

							<tr>
								<th>
									리스트용<br>대표이미지
								</th>
								<td>
									<label><input type="radio" name="img_add" value="file" checked ><div style="margin:-26px 20px 10px 20px;">이미지파일첨부</div></label>
									&nbsp;
									<label><input type="radio" name="img_add" value="url"><div style="margin:-26px 20px 10px 20px;">이미지url입력</div></label>
									<br>
									<input type="file" name="upfile" id="upfile" class="w50" />
									<input type="text" name="img_url2" id="img_url2" class="w50" style="display:none;" />
									<div id="img_section"></div>
									<input type="hidden" id="img_name" name="img_name">
							
									
								</td>
								<th>글 본문 첨부파일</td>
								<td>
									<input type="file" name="upfile_add" id="upfile_add" class="w50" />
	
								</td>
							</tr>
							<tr>
								<th>설정된 이미지<br>섬네일</th>
								<td colspan=3>
									<div id="img_del" name="img_del" style="display:none;margin:10px 0 0 10px;color:red;"><a href="javascript:del('image');"><b>대표이미지삭제</b></a></div>
									<img NAME="ING_IMG" ID = "ING_IMG" ></IMG>
									<br>
									


								</td>
							</tr>
							<tr>
								<th>내용</th>
								<td colspan=3>
									<div id="summernote"><p><br></p></div>
									  <div class="placeholder">

									  </div>
									<script type="text/javascript">
									$(function() {
									  // index page card list
									  if ($('.card-list').length) {
										var $cardArrow = $('.card-arrow');
										var $cardListInner = $('.card-list-inner');

										$cardListInner.scroll(function () {
										  $cardArrow.addClass('disappear');
										  if ($cardListInner.scrollLeft() < 20) {
											$cardArrow.removeClass('disappear');
										  }
										});
									  }

									  // main summernote with custom placeholder
									  var $placeholder = $('.placeholder');
									  $('#summernote').summernote({
										height: 600,
										codemirror: {
										  mode: 'text/html',
										  htmlMode: true,
										  lineNumbers: true,
										  theme: 'monokai'
										},
										callbacks: {
										  onInit: function() {
											$placeholder.show();
										  },
										  onFocus: function() {
											$placeholder.hide();
										  },
										  onBlur: function() {
											var $self = $(this);
											setTimeout(function() {
											  if ($self.summernote('isEmpty') && !$self.summernote('codeview.isActivated')) {
												$placeholder.show();
											  }
											}, 300);
										  }
										}
									  });
									});
									</script>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>

				<div class="btn w100">
					<button class="b_newadd"  name="action" id="action" style="width:-webkit-fill-available;">추가</button>
					<!-- <button>삭제</button> -->
				</div>

				
		</div>
		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type=hidden id="page_flag" value="등록/수정">
	<input type="hidden" id="img_name" name="img_name">
	<input type="hidden" id="file_name" name="file_name">
	<input type="hidden" name="id" id="user_id" />
	<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
	<input type="hidden" name="file_url_tmp" id="file_url_tmp" />

</body>

<script>


function del(str){

	switch(str){
		case "file":
			document.getElementById("ING_FILE").innerHTML="";
			document.getElementById("ING_FILE").setAttribute('href',"");
			document.getElementById("file_del").style.display = "none";
			document.getElementById("upfile_add").value = "";
			document.getElementById("file_name").value = "";	
		break;
		case "image":
			document.getElementById("ING_IMG").innerHTML="";
			document.getElementById("ING_IMG").setAttribute('src',"");
			document.getElementById("img_del").style.display = "none";
			document.getElementById("img_url2").value = "";
			document.getElementById("upfile").value = "";
		break;
		default:"";
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

	var page_flag = document.getElementById("page_flag").value;

	top_menu(page_flag);

$("input[name=img_add]").change(function() {	

	if($("input:radio[value='file']").is(":checked")){                                
		document.getElementById('upfile').style.display = "block";
		document.getElementById('img_url2').style.display = "none";
	}else{
		document.getElementById('upfile').style.display = "none";
		document.getElementById('img_url2').style.display = "block";
	}
});



	$("input[name=rd_GUBUN]").change(
		function() {	
			if($("input:radio[value='ALL']").is(":checked")){                                
				document.getElementById('CATE_ALL').style.display = "block";
				document.getElementById('CATE_HOS').style.display = "none";
			}else{
				document.getElementById('CATE_ALL').style.display = "none";
				document.getElementById('CATE_HOS').style.display = "block";
			}
		}
	);



fetchUser();
function fetchUser()
{

	var action = "select_modify";
	var request = new Request();

	var id = request.getParameter("id");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id, action:action},
		dataType:"json",
		success:function(data)
		{
			//alert(data.first_name);
			//data의 타입은 객체 object
			//한 행에서 수정버튼을 누르면
			//위쪽 입력창의 값이 추가 -> 수정으로 변경되게 만든다.

			console.log(data);
			
			$('#action').text("수정");
			$('#user_id').val(id);
			
			$('#subject').val(data.SUBJECT);
			$('#news_reguser').val(data.NEWS_REGUSER);
			$('#news_reguser_comp').val(data.NEWS_REGUSER_COMP);
			$('#news_regdate').val(data.NEWS_REGDATE);

			if(data.IMG_URL2!="" ){
				$('#img_url2').val(data.IMG_URL2);
			}
//			$('#img_url').val(data.IMG_URL);
//			$('#cate').val(data.CATE);

			if(data.SITE_GUBUN =="ALL"){
				document.getElementById('CATE_ALL').style.display = "block";
				document.getElementById('CATE_HOS').style.display = "none";
				$("input:radio[name='cate']:radio[value='"+data.CATE+"']").prop('checked', true); // 선택하기
				$("input:radio[name='rd_GUBUN']:radio[value='ALL']").prop('checked', true);
				
			}else{
				document.getElementById('CATE_ALL').style.display = "none";
				document.getElementById('CATE_HOS').style.display = "block";
				$("input:radio[name='cate_h']:radio[value='"+data.CATE+"']").prop('checked', true); // 선택하기
				$("input:radio[name='rd_GUBUN']:radio[value='HOS']").prop('checked', true);
				
			}
			//$('#rd_GUBUN').val(data.SITE_GUBUN)
			$('#visible').val(data.VISIBLE);


			if(data.C_CATE){
				document.getElementById("dept2").setAttribute('style','display:block');
				$('#c_cate').val(data.C_CATE);

			}
				
			if(data.IMG_URL_FLAG != ""){
				switch (data.IMG_URL_FLAG){
					case "U" : $("input:radio[name='img_add']:radio[value='url']").prop('checked', true); // 선택하기
							 document.getElementById('upfile').style.display = "none";
						     document.getElementById('img_url2').style.display = "block";	
								$('#img_url2').val(data.IMG_URL);

						break;
					case "F" : 
						$("input:radio[name='img_add']:radio[value='file']").prop('checked', true); // 선택하기
				   	         document.getElementById('upfile').style.display = "block";
						     document.getElementById('img_url2').style.display = "none";
						break;
					default:
				}
			}


			if(data.IMG_URL != ""){
//img_url_tmp
				$('#img_url_tmp').val(data.IMG_URL);

			  document.getElementById("ING_IMG").setAttribute('src',data.IMG_URL);
			}
			
			if(data.FILE_URL != ""){
//img_url_tmp
				$('#file_url_tmp').val(data.FILE_URL);

			  document.getElementById("ING_FILE").setAttribute('src',data.FILE_URL);
			  $("#ING_FILE").html(data.FILE_URL);

			}

			
			$('#cate').val(data.CATE);
			$('#visible').val(data.VISIBLE);

			//$('#summernote').summernote('code').val(data.CONTENTS);
			var modi_contents = data.CONTENTS;
			$('#summernote').summernote('code', modi_contents);

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}



/*이미지업로드 : S */
	$('#upfile').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;

		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		 var property = document.getElementById('upfile').files[0];
         var image_name = property.name;

		 document.getElementById('img_name').value = image_name ;


		 //만약 input에 multiple 속성을 추가한다면, 파일을 여러개 선택할 수 있는데, 저는 일단 1개로
		 //그 때의 파일을 배열로 만들어 주기 위한 작업입니다.
		 $.each(files, function(key, value)
		 {
		  //key는 다른 지정이 없다면 0부터 시작 할것이고, value는 파일 관련 정보입니다.
		  data.append(key, value);
		 });

		 
		  $.ajax({
					
				 url: 'upload_process_news.php?files', //file을 저장할 소스 주소입니다.
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

				  //$("#img_section").html(source);
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

	  document.getElementById("ING_IMG").setAttribute('src',"https://taxtok.kr/admin/upload/"+image_name);
	  document.getElementById("img_del").style.display = "block";


	});
/*

/*파일업로드 : S */
	$('#upfile_add').on('change', function(e){
		//파일들을 변수에 넣고
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
		var time = today.getTime();
		var now = yyyy+""+mm+""+dd+""+time
		 var files = e.target.files;

		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		 var property = document.getElementById('upfile_add').files[0];
         var file_name = time+"_"+property.name;

		 document.getElementById('file_name').value = file_name ;


		 //만약 input에 multiple 속성을 추가한다면, 파일을 여러개 선택할 수 있는데, 저는 일단 1개로
		 //그 때의 파일을 배열로 만들어 주기 위한 작업입니다.
		 $.each(files, function(key, value)
		 {
		  //key는 다른 지정이 없다면 0부터 시작 할것이고, value는 파일 관련 정보입니다.
		  data.append(key, value);
		 });

		 
		  $.ajax({
					
				 url: 'upload_process_news.php?files&now='+now, //file을 저장할 소스 주소입니다.
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

				  //$("#img_section").html(source);
				  alert("업로드되었습니다.");
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
	  	  document.getElementById("ING_FILE").innerHTML=file_name;
	 	  document.getElementById("ING_FILE").setAttribute('href',"https://taxtok.kr/admin/upload/"+file_name);
		  document.getElementById("file_del2").style.display = "block";



	});
/*파일업로드 : E */


/*상담사례 클릭시 자식노드 노출*/


$("input[name=cate]").change(function(){
	//alert($("#cate option:selected").val());
	if($("input:radio[value='QNA']").is(":checked")){
		document.getElementById("dept2").setAttribute('style','display:block');
	}else{
		document.getElementById("dept2").setAttribute('style','display:none');
	}
});


/*선택한 자식노드값 임시저장*/
$('#c_cate').on('change', function(e){
	document.getElementById("c_cate_id").value = $("#c_cate option:selected").val();
});

	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var subject = $('#subject').val();
		var news_regdate= $('#news_regdate').val();
		var news_reguser= $('#news_reguser').val();
		var news_reguser_comp = $('#news_reguser_comp').val();
		var visible = $('#visible').val();
		var contents =  $('#summernote').summernote('code');
		var id= $('#user_id').val();
		var action = $('#action').text();
		var site_gubun = $('#rd_GUBUN:checked').val();
		var upfile_tmp = $("#upfile").val().replace("C:\\fakepath\\","") ;
		var img_url = "";
		var img_url2 = $('#img_url2').val();;
		var img_url_flag = "";

		if($("input:radio[value='file']").is(":checked") && upfile_tmp!=""){                                
			img_url = "https://taxtok.kr/admin/upload/"+ upfile_tmp ;
			img_url_flag = "F";
		}else if($("input:radio[value='url']").is(":checked") && img_url2 !=""){                                
			img_url = $("#img_url2").val() ;
			img_url_flag = "U";
		}else{
			img_url = "";
		}

		if($('#file_name').val() != ""){
			var file_url = $('#file_name').val();
		}else{
			var file_url = $("#file_url_tmp").val();
		}


		if(site_gubun =="ALL"){
			var cate =  $('#cate:checked').val() ;//$('#cate').val();
			if(cate =="QNA"){
				var c_cate = $('#c_cate:checked').val();
			}
		}else{
			var cate =  $('#cate_h:checked').val() ;//$('#cate').val();
		}


		//성과 이름이 올바르게 입력이 되면
		if(subject !='' && contents != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{subject:subject,news_regdate:news_regdate,news_reguser:news_reguser,news_reguser_comp:news_reguser_comp,img_url:img_url,img_url_flag:img_url_flag,file_url:file_url,contents:contents,cate:cate,c_cate:c_cate ,visible:visible,id:id,site_gubun:site_gubun,action:action },
				success:function(data){
					alert(data);
					window.location.href="list_news.php";
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}



	});

		//[4]삭제 버튼을 클릭했을 때 작동되는 함수
		$(document).on('click','.delete',function(){

			var id = $(this).attr("id");

			if(confirm("삭제 하시겠습니까?"))
			{
			//구분자
				var action = "delete";
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data){
						//리스트 다시 조회
						fetchUser();
						alert(data);
					}
				});
			}else
			{
				return false;
			}

		});



});



</script>


</html>