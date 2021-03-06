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
<br><br><br><input type="button" onclick="window.location.href='list_date.php'" value="??????????????????" / >
<br/><br/>
<br/><br/>
<label>??????</label>
<input type="DATE" name="tax_date" id="tax_date" class="form-control" value="" style="width:150px;" />

<label>????????????</label>
<input type="text" name="tax_content" id="tax_content" class="form-control" style="width:500px;" />


<label><SPAN>?????? ????????????</SPAN> <font color="red">(???????????? : <b>?????????</b>) </font></label>
<select name="visible" id ="visible" class="form-control">
	<option value="">??????</option>
	<option value="Y">??????</option>
	<option value="N" selected>?????????</option>
</select>


<style>
label{
	margin:10px 10px 10px 30px;
}
</style>
<br/><br/>


<div align="center">
<!-- ???????????? ??? user id??? ??? ??? ?????? ?????? ??????.-->
<input type="hidden" name="id" id="user_id" />
<input type="hidden" name="c_cate_id" id="c_cate_id" />
<button type="button" style="align:left;" name="action" id="action" class="btn btn-warning">??????</button>
</div>
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




	//[2] ?????? ?????? ???????????? ??? ???????????? ??????
	$('#action').click(function(){

		var img_url_flag = "";
		//??? ?????????????????? ????????? ?????? ????????????.
		var tax_date = $('#tax_date').val();
		var tax_content= $('#tax_content').val();
		var visible = $('#visible').val();
		//?????? ????????? ???????????? ????????? ??????
		var action = $('#action').text();
		var id = $('#user_id').val();


		if(tax_date !='' && tax_content != ''){

			$.ajax({
			//insert page??? ????????? ?????? ???????????? ????????????.
				url:"action_date.php", 
				method:"POST",
				data:{id:id,tax_date:tax_date,tax_content:tax_content,visible:visible ,action:action },
				success:function(data){
					alert(data);
					window.location.href="list_date.php";
				}
				,error:function(e){//??????
				alert(e+' ,error!! ??????????????? ??????????????????.');
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