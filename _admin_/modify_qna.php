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


<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";

$id = $_GET["id"];

$QUERY = "SELECT * FROM dbsschina.SS_QNAS WHERE ID_= $id;";

$result = @mysql_query($QUERY) or die("SQL error");

while ($row = mysql_fetch_array($result)) {

?>
<br/><br/>
<label>??????</label>
<input type="text" name="CSTNAME" id="CSTNAME" class="form-control" disabled  value=""/>

<br/>
<label>?????????</label>
<input type="text" name="PHONE" id="PHONE" class="form-control" disabled value="" />

<br/>
<label>Email </label>
<input type="text" name="EMAIL" id="EMAIL" class="form-control" disabled value="" />


<br/>
<label>????????????</label>
<DIV name="CONTENTS" ID = "CONTENTS">
</DIV>
<?php
}
?>
<br/>

<BR><BR><BR>
<label>????????????</label>
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


<div align="center">
<!-- ???????????? ??? user id??? ??? ??? ?????? ?????? ??????.-->
<input type="hidden" id="img_name" name="img_name">
<input type="hidden" id="file_name" name="file_name">
<input type="hidden" name="id" id="user_id" />
<input type="hidden" name="img_url_tmp" id="img_url_tmp" />
<input type="hidden" name="file_url_tmp" id="file_url_tmp" />
<button type="button" name="action" id="action" class="btn btn-warning">??????</button>
</div>
<?php
//echo $_SERVER['REQUEST_URI'];
echo $PHP_SELF;
?>
<br/><br/>


<!-- ++++++++++++++++++?????? ????????? ?????? ?????????++++++++++++++++++++++++ -->
<!-- select.php?????? ????????? ???????????? ??????????????? ?????????. -->
<div id="result" class="table-responsive">
</div>
<br/><br/><br/><br/><br/><br/> 
</div>
</form>
</body>


<script>

function Request() {
	var requestParam = "";

	//getParameter ??????
	this.getParameter = function (param) {
		//?????? ????????? decoding
		var url = unescape(location.href);
		//??????????????? ?????????, ?????? &???????????? ????????? ????????? ?????????. 
		var paramArr = (url.substring(url.indexOf("?") + 1, url.length)).split("&");

		for (var i = 0; i < paramArr.length; i++) {
			var temp = paramArr[i].split("="); //???????????? ???????????? ??????

			if (temp[0].toUpperCase() == param.toUpperCase()) {
				// ???????????? ????????? ?????? ????????? ??????
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
	$('#action').text("??????");

	var id = request.getParameter("id");
	//users ???????????? select.php ?????? ????????????.
	$.ajax({
		url:"action_qna.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:"json",
		success:function(data)
		{
			//alert(data.first_name);
			//data??? ????????? ?????? object
			//??? ????????? ??????????????? ?????????
			//?????? ???????????? ?????? ?????? -> ???????????? ???????????? ?????????.

			console.log(data);
			
//			$('#action').text("select");
			$('#CSTNAME').val(data.CSTNAME);
			$('#PHONE').val(data.PHONE);
			$('#EMAIL').val(data.EMAIL);
			$('#CONTENTS').html(data.CONTENTS);
			$('#user_id').val(id);
			
			var modi_contents = data.ANSWER;
			$('#summernote').summernote('code', modi_contents);

		},error : function(request, status, error ){
			// ????????? ???????????? ??? ????????????.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}

	//[2] ?????? ?????? ???????????? ??? ???????????? ??????
	$('#action').click(function(){

		//??? ?????????????????? ????????? ?????? ????????????.
		var req = new Request();
		var id = req.getParameter("id");

		var answer =  $('#summernote').summernote('code');
		var action = "??????";
		var phone = $('#PHONE').val();


		if(answer !='' && id != ''){

			$.ajax({
			//insert page??? ????????? ?????? ???????????? ????????????.
				url:"action_qna.php", 
				method:"POST",
				data:{phone:phone,answer:answer,id:id,action:action },
				success:function(data){
					alert(data);
					window.location.href="list_qna.php";
				}
			});

		}else{
			alert('????????? ????????? ?????????');
		}



	});


});



</script>


</body>
</html>