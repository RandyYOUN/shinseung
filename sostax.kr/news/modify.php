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

<!-- include libraries(jQuery, bootstrap) -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script> 

<!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>


<script src="summernote.js"></script>


</head>
<body>
<form name="uploadForm" id="uploadForm" method="post" action="upload_process.php"     enctype="multipart/form-data" onsubmit="return formSubmit(this);">

<div class="container box">
<span>
<img src="../news/resources/images/new_logo.png" align="center">
</span>

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

<br/>

<label>카테고리 </label>
<select name="cate" id ="cate" class="form-control">
	<option value="">선택</option>
	<option value="SCH">세무일정</option>
	<option value="LED">장부기장</option>
	<option value="VAT">부가세</option>
	<option value="CIT">종소세</option>
	<option value="TRA">양도세</option>
	<option value="INH">상속세</option>
	<option value="GTX">증여세</option>
	<option value="BEL">종합부동산세</option>
	<option value="THA">절세극장</option>
	<option value="19T">19禁세금</option>
	<option value="TAX">조세</option>
	<option value="LAB">노무</option>
	<option value="FOU">창업</option>
	<option value="OPE">경영</option>
	<option value="MNY">자금</option>
	<option value="PRO">홍보</option>
	<option value="ISS">이슈</option>
</select>

<br/>
<label>글 노출여부 <font color="red">(※기본값 : <b>비노출</b>) </font></label>
<select name="visible" id ="visible" class="form-control">
	<option value="">선택</option>
	<option value="Y">승인</option>
	<option value="N">비노출</option>
</select>

<br/>
<label>리스트용 대표이미지 URL </label>
<input type="file" name="upfile" id="upfile" class="form-control" />
<br>
<div id="img_section"></div>
<input type="hidden" id="img_name" name="img_name">

<br/><br/>

<label>내용</label>
  <textarea id="summernote" name="editordata"></textarea>

<script>
      $('#summernote').summernote({
        placeholder: '내용을 입력해주세요.',
        tabsize: 2,
        height: 400,
		callbacks:{
			onImageUpload : function(files,editor,welEditable){
				console.log('image upload',files);
				sendFile(files[0],editor,welEditable)
			},	
		},
		toolbar: [
			// [groupName, [list of button]]
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['link',['link']],
			['table',['table']],
			['hr',['hr']],
			['picture',['picture']]
		]
});

function sendFile(file,editor,welEditable){
data = new FormData();
data.append('file',file);
$.ajax({
	url:"saveimage.php",
	data:data,
	cache:false,
	contantType:false,
	processData:false,
				type:'POST',
				success:function(data){
					var image = $('<img>'.attr('src',''+data));
					//$('.summernote').summernote('insertNode',image[0]);
					$('#summernote').summernote('editor.insertImage', url);
					editor.insertImage(welEditable,data.url);
				},
				error:function(jqXHR,textStatus,errorThrown){
					console.log(textStatus +' ' +errorThrown);
				}
			});
	  });
</script>

<div align="center">
<!-- 클릭했을 때 user id를 알 수 있게 숨겨 둔다.-->
<input type="hidden" name="id" id="user_id" />
<button type="button" name="action" id="action" class="btn btn-warning">추가</button>
</div>
<?php
//echo $_SERVER['REQUEST_URI'];
echo $PHP_SELF;
?>
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
//			$('#img_url').val(data.IMG_URL);
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


/*파일업로드 : S */
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
				  var source = '<img src ="'+data.files[0]+'" style="width:270px; height:160px" id="img_url" name="img_url">'

				  $("#img_section").html(source);
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
/*파일업로드 : E */


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var subject = $('#subject').val();
		var news_regdate= $('#news_regdate').val();
		var news_reguser= $('#news_reguser').val();
		var news_reguser_comp = $('#news_reguser_comp').val();
		var img_url = $('#img_name').val();
		var cate = $('#cate').val();
		var visible = $('#visible').val();

		var contents =  $('#summernote').summernote('code');
		var id= $('#user_id').val();
		var action = $('#action').text();

		//성과 이름이 올바르게 입력이 되면
		if(subject !='' && contents != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{subject:subject,news_regdate:news_regdate,news_reguser:news_reguser,news_reguser_comp:news_reguser_comp,img_url:img_url,contents:contents,cate:cate,visible:visible,id:id,action:action },
				success:function(data){
					alert(data);
					window.location.href="admin_list.php";
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