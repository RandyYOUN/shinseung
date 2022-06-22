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
<form method="post">

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
<input type="text" name="img_url" id="img_url" class="form-control" />



<br/><br/>

<label>내용</label>
  <textarea id="summernote" name="editordata"></textarea>

<script>
      $('#summernote').summernote({
        placeholder: '내용을 입력해주세요.',
        tabsize: 2,
        height: 400
      });
</script>


<div align="center">
<!-- 클릭했을 때 user id를 알 수 있게 숨겨 둔다.-->
<input type="hidden" name="id" id="user_id" />
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

$(document).ready(function(){

fetchUser();
function fetchUser()
{

	var action = "select";
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{action:action},
		success:function(data){
			$('#subject').val('');
			//$('#news_regdate').val('');
			$('#news_reguser').val('');
			$('#news_reguser_comp').val('');
			$('#img_url').val('');
			$('#cate').val('');
			$('#visible').val('N');
			$('#action').text("추가");
			$('#result').html(data);
			var modi_contents = "";
			$('#summernote').summernote('code', modi_contents);
		}
	})
}


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var subject = $('#subject').val();
		var news_regdate= $('#news_regdate').val();
		var news_reguser= $('#news_reguser').val();
		var news_reguser_comp = $('#news_reguser_comp').val();
		var img_url = $('#img_url').val();
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
				data:{subject:subject,news_regdate:news_regdate,news_reguser:news_reguser,news_reguser_comp:news_reguser_comp,contents:contents,img_url:img_url,cate:cate,visible:visible,id:id,action:action },
				success:function(data){

				//성공하면 action.php 에서 출력된 데이터가 넘어온다.
					alert(data);

					//입력 후 리스트 다시 갱신
					fetchUser();
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}

	});

		//[3]수정 버튼을 클릭했을 때 글 내용 로딩 함수
		$(document).on('click', '.update', function(){


		//id속성값을 가져오기 - 클릭한 행의 id 값 - 즉 user_id 값이다.
			var id = $(this).attr("id");
			

			$.ajax(
			{
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
					$('#img_url').val(data.IMG_URL);
					$('#cate').val(data.CATE);
					$('#visible').val(data.VISIBLE);

					//$('#summernote').summernote('code').val(data.CONTENTS);
					var modi_contents = data.CONTENTS;
					$('#summernote').summernote('code', modi_contents);


				},error : function(request, status, error ){
					// 오류가 발생했을 때 호출된다.
					console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}

			});
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