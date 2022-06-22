<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>crud</title>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--
<script type="text/javascript" src="../news/se2/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
-->
<!-- Bootstrap -->



<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<style>
body{
margin:0;
padding:0;
background-color:#f1f1f1;
}

.box{
width:750px;
padding:20px;
background-color:#fff;
border:1px solid #ccc;
border-radius:5px;
margin-top:100px;


}

</style>

<!-- jquery, bootstrap -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- codemirror -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>

<!-- add summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/lang/summernote-ko-KR.min.js"></script>


</head>
<body>
<form name="uploadForm" id="uploadForm" method="post" action="upload_process.php"     enctype="multipart/form-data" onsubmit="return formSubmit(this);">



<div class="container box">
<span>
<img src="resources/images/new_logo.png" align="center">
</span>
<br><br><br><input type="button" onclick="window.location.href='list.php'" value="리스트로가기" / >
<br/><br/>
<br/><br/>
<label>제목</label>
<input type="text" name="subject" id="subject" class="form-control" />

<br/>
<label>기사작성자</label>
<input type="text" name="news_reguser" id="news_reguser" class="form-control" />

<br/>
<label>기사작성자 소속 </label>
<input type="text" name="news_reguser_comp" id="news_reguser_comp" class="form-control" />


<br/>
<label>기사작성날짜</label>
<input type="text" name="news_regdate" id="news_regdate" class="form-control" value="<?php echo date("Y-m-d H:i:s",time());?>" />

<style>
label{
	margin:10px 10px 10px 30px;
}
</style>
<br/><br/>


<label><B><SPAN STYLE="font-size:20px;">사이트구분</SPAN></B></label><BR>
<label><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="ALL" checked> 전체</label>
<label><input type="radio" name="rd_GUBUN" id="rd_GUBUN" value="HOS"> 병원톡</label>

<br/><br/>
<br/>
<div id="CATE_ALL" name = "CATE_ALL" style="DISPLAY:block;">
<label><SPAN STYLE="font-size:20px;">카테고리 ALL</SPAN> </label><BR>
<label><input type="radio" name="cate" id="cate" value="SCH" checked> 세무일정</label>
<label><input type="radio" name="cate" id="cate" value="LED"> 장부기장</label>
<label><input type="radio" name="cate" id="cate" value="VAT"> 부가세</label>
<label><input type="radio" name="cate" id="cate" value="CIT"> 종소세</label>
<label><input type="radio" name="cate" id="cate" value="TRA"> 양도세</label>
<label><input type="radio" name="cate" id="cate" value="INH"> 상속세</label>
<label><input type="radio" name="cate" id="cate" value="GTX"> 증여세</label>
<label><input type="radio" name="cate" id="cate" value="QNA"> 상담사례</label>
<label><input type="radio" name="cate" id="cate" value="THA"> 절세극장</label>
<label><input type="radio" name="cate" id="cate" value="19T"> 19禁세금</label>
<label><input type="radio" name="cate" id="cate" value="TAX"> 조세</label>
<label><input type="radio" name="cate" id="cate" value="LAB"> 노무</label>
<label><input type="radio" name="cate" id="cate" value="FOU"> 창업</label>
<label><input type="radio" name="cate" id="cate" value="OPE"> 경영</label>
<label><input type="radio" name="cate" id="cate" value="MNY"> 자금</label>
<label><input type="radio" name="cate" id="cate" value="PRO"> 홍보</label>
<label><input type="radio" name="cate" id="cate" value="ISS"> 이슈</label>
<label><input type="radio" name="cate" id="cate" value="HOM"> 주택임대</label>
</DIV>

<div id="CATE_HOS" name = "CATE_HOS" style="DISPLAY:NONE;">
<label><SPAN STYLE="font-size:20px;">카테고리 병원톡</SPAN> </label><BR>
<label><input type="radio" name="cate" id="cate" value="SCH" checked> 세무일정</label>
<label><input type="radio" name="cate" id="cate" value="TRT"> 세무신고</label>
<label><input type="radio" name="cate" id="cate" value="TIV"> 세무조사</label>
<label><input type="radio" name="cate" id="cate" value="FOU"> 개원</label>
<label><input type="radio" name="cate" id="cate" value="LAB"> 노무</label>
<label><input type="radio" name="cate" id="cate" value="GTX"> 증여세</label>
<label><input type="radio" name="cate" id="cate" value="INH"> 상속세</label>
<label><input type="radio" name="cate" id="cate" value="TRA"> 양도세</label>
<label><input type="radio" name="cate" id="cate" value="QNA"> 상담사례</label>
<label><input type="radio" name="cate" id="cate" value="THA"> 절세극장</label>
<label><input type="radio" name="cate" id="cate" value="19T"> 19禁세금</label>
</DIV>
<BR>

<DIV ID = 'dept2' NAME='dept2' style="visibility:hidden ;">
<table></table>
<label><font color="red">상담사례 2nd 카테고리</font> </label>
<br>
<label><input type="radio" name="c_cate" id ="c_cate" value="c_tra"> 양도세</label>
<label><input type="radio" name="c_cate" id ="c_cate" value="c_inh"> 상속세</label>
<label><input type="radio" name="c_cate" id ="c_cate" value="c_gtx"> 증여세</label>
<label><input type="radio" name="c_cate" id ="c_cate" value="c_btx"> 종합부동산세</label>

</DIV>

<br/><br/><br/>
<label><SPAN STYLE="font-size:20px;">글 노출여부</SPAN> <font color="red">(※기본값 : <b>비노출</b>) </font></label>
<select name="visible" id ="visible" class="form-control">
	<option value="">선택</option>
	<option value="Y">승인</option>
	<option value="N" selected>비노출</option>
</select>

<br/>
<label><SPAN STYLE="font-size:20px;">리스트용 대표이미지</SPAN></label>
<br>
<label><input type="radio" name="img_add" value="file" checked> 이미지파일첨부</label>
&nbsp;
<label><input type="radio" name="img_add" value="url"> 이미지url입력</label>
<br>
<input type="file" name="upfile" id="upfile" multiple class="form-control"  />
<input type="text" name="img_url2" id="img_url2" class="form-control" style="display:none;" />
<div id="file_del" name="file_del" style="display:none;"><a href="javascript:del(file);"><b>첨부파일삭제</b></a></div>

<br>
<div id="img_section"></div>
<input type="hidden" id="img_name" name="img_name">
<br><br>

<label><SPAN STYLE="font-size:20px;">글 본문 첨부파일</SPAN> </label>
<input type="file" name="upfile_add" id="upfile_add" multiple class="form-control" />
<br>
<b>현재첨부된 파일</b>
<br/>
<br/>
<div id="file_del2" name="file_del2" style="display:none;"><a href="javascript:del('file2');"><b>첨부파일삭제</b></a></div>

<a NAME="ING_FILE" ID = "ING_FILE" target="_blank"></a><br>
<input type="hidden" id="file_name" name="file_name">


<br/>
<br/>
<b>현재설정된 이미지</b>
<br/>
<br/>
<div id="img_del" name="img_del" style="display:none;"><a href="javascript:del('image');"><b>대표이미지삭제</b></a></div>
<img NAME="ING_IMG" ID = "ING_IMG" width="600px;"></IMG>



<br/>

<label><SPAN STYLE="font-size:20px;">내용</SPAN></label>
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
      theme: 'monokai',
	   toolbar: [
		// [groupName, [list of button]]
		['Font Style', ['fontname']],
		['style', ['bold', 'italic', 'underline']],
		['font', ['strikethrough']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['paragraph']],
		['height', ['height']],
		['Insert', ['picture']],
		['Insert', ['link']],
		['Misc', ['fullscreen']]
	 ]
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

<div align="center">
<!-- 클릭했을 때 user id를 알 수 있게 숨겨 둔다.-->
<input type="hidden" name="id" id="user_id" />
<input type="hidden" name="c_cate_id" id="c_cate_id" />
<button type="button" name="action" id="action" class="btn btn-warning">추가</button>
</div>
<br/><br/>


<!-- ++++++++++++++++++결과 리스트 출력 테이블++++++++++++++++++++++++ -->
<!-- select.php에서 받아온 데이터를 이곳에다가 붙인다. -->
<div id="result" class="table-responsive">
</div>
<br/><br/><br/><br/><br/><br/> 
</div>
</form>
</body>


<script>

function del(){
	
}

function del(str){

	switch(str){
		case "file":
			document.getElementById("ING_FILE").innerHTML="";
			document.getElementById("ING_FILE").setAttribute('href',"");
			document.getElementById("file_del").style.display = "none";
			document.getElementById("upfile_add").value = "";
			document.getElementById("file_name").value = "";	
		break;
		case "file2":
			document.getElementById("ING_FILE").innerHTML="";
			document.getElementById("ING_FILE").setAttribute('href',"");
			document.getElementById("file_del2").style.display = "none";
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

	$("input[name=img_add]").change(function() {	//var chk_radio = document.getElementsByName('img_add');

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

	var action = "select";
	var request = new Request();

	var id = request.getParameter("id");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"fetch.php",
		method:"POST",
		data:{id:id},
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
			$('#cate').val(data.CATE);
			$('#rd_GUBUN').val(data.SITE_GUBUN)
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
					
				 url: 'upload_process.php?files', //file을 저장할 소스 주소입니다.
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

	  document.getElementById("ING_IMG").setAttribute('src',"http://taxtok.kr/admin/upload/"+image_name);
	  document.getElementById("img_del").style.display = "block";


	});
/*이미지업로드 : E*/

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
					
				 url: 'upload_process.php?files&now='+now, //file을 저장할 소스 주소입니다.
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
	 	  document.getElementById("ING_FILE").setAttribute('href',"http://taxtok.kr/admin/upload/"+file_name);
		  document.getElementById("file_del2").style.display = "block";



	});
/*파일업로드 : E */

/*상담사례 클릭시 자식노드 노출*/

$("input[name=cate]").change(function(){
	//alert($("#cate option:selected").val());
	if($("input:radio[value='QNA']").is(":checked")){
		document.getElementById("dept2").setAttribute('style','visibility:visible');
	}else{
		document.getElementById("dept2").setAttribute('style','visibility:hidden');
	}
});

	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		var img_url_flag = "";
		//각 엘리먼트들의 데이터 값을 받아온다.
		var subject = $('#subject').val();
		var news_regdate= $('#news_regdate').val();
		var news_reguser= $('#news_reguser').val();
		var news_reguser_comp = $('#news_reguser_comp').val();
		var upfile_tmp = $("#upfile").val().replace("C:\\fakepath\\","") ;
		var img_url = "";
		var img_url2 = $('#img_url2').val();;
		var img_url_flag = "";

		if($("input:radio[value='file']").is(":checked") && upfile_tmp!=""){                                
			img_url = "http://taxtok.kr/admin/upload/"+ upfile_tmp ;
			img_url_flag = "F";
		}else if($("input:radio[value='url']").is(":checked") && img_url2 !=""){                                
			img_url = $("#img_url2").val() ;
			img_url_flag = "U";
		}else{
			img_url = "";
		}

		if($('#file_name').val() != ""){
			var file_url = $('#file_name').val();
		}

		var cate =  $('#cate:checked').val() ;//$('#cate').val();
		if(cate =="QNA"){
			var c_cate = $('#c_cate:checked').val();
		}

		var visible = $('#visible').val();

		var contents =  $('#summernote').summernote('code');
		var id= $('#user_id').val();
		var action = $('#action').text();
		var site_gubun = $('#rd_GUBUN:checked').val();


		//성과 이름이 올바르게 입력이 되면
		
		if(subject !='' && contents != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{subject:subject,news_regdate:news_regdate,news_reguser:news_reguser,news_reguser_comp:news_reguser_comp,img_url:img_url,img_url_flag:img_url_flag,file_url:file_url,contents:contents,cate:cate,c_cate:c_cate ,visible:visible,id:id,site_gubun:site_gubun,action:action },
				success:function(data){
					alert(data);
					window.location.href="list.php";
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


</body>
</html>