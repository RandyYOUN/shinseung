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
<img src="../news/se2/workspace/static/newstalk_logo1.png">


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
<input type="hidden" name="id" id="101" />
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
$('#action').text("추가");
$('#result').html(data);
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
var content =  $('#summernote').summernote('code');
var id= $('#user_id').val();
var action = $('#action').text();


//성과 이름이 올바르게 입력이 되면
if(subject !='' && content != ''){

$.ajax({
//insert page로 위에서 받은 데이터를 넣어준다.
url:"action.php", 
method:"POST",
data:{subject:subject,news_regdate:news_regdate,news_reguser:news_reguser,news_reguser_comp:news_reguser_comp,content:content,img_url:img_url,action:action },
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

});



</script>



</body>
</html>