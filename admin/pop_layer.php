<?php
include "db_info.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>신승세무법인 ADMIN</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="신승세무법인 RPA">
	<meta property="og:url" content="https://taxtok.co.kr/">
	<meta property="og:description" content="국세청경력 33년, 수도권 15지점">
	<meta property="og:image" content="http://taxtok.kr/resources/images/sum2.png">
	<link rel="shortcut icon" href="resources/images/icon.ico">
	<script src="https://code.jquery.com/jquery-3.5.1.js" ></script>


<style>

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
  width: 410px;
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

</head>
<body >
<!--문의유형 레이어 -->
				<div class="dim-layer">
					<div class="dimBg"></div>
					<div id="layer2" class="pop-layer">
						<div class="pop-container">
							<div class="pop-conts">
								<!--content //-->
								<p class="ctxt mb20">
<?php
/*문의유형 레이어 : S*/
	$query_qst = "SELECT * FROM TB750010 WHERE CODE_ BETWEEN 'G1001' AND 'G1027';";

	$result_qst = mysql_query($query_qst, $connect) or die ("쿼리 에러 : ".mysql_error($connect));
	if(mysql_num_rows($result_qst) >0)
	{

		while($row_qst = mysql_fetch_array($result_qst)){
			echo '<label><input type="radio" name="cate" id="cate" value="'.$row_qst['CODE_'].'"> '.$row_qst['VALUE_'].'</label><BR>';
		}
	}
/*문의유형 레이어 : E*/
?>									
								</p>

								<div class="btn-r">
									<a href="#" class="btn-layerClose" id="btn-layerClose">Close</a>
								</div>
								<!--// content-->
							</div>
						</div>
					</div>
				</div>
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


var req = new Request();
var id = req.getParameter("id");
var str = req.getParameter("str");

function layer_popup(str){
	

	var $el = $("#layer2");        //레이어의 id를 $el 변수에 저장
	var isDim = $el.prev().hasClass('dimBg');   //dimmed 레이어를 감지하기 위한 boolean 변수

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

	$("input:radio[name='cate']:radio[value='"+str+"']").prop('checked', true); // 선택하기

	$el.find('a.btn-layerClose').click(function(){
		isDim ? $('.dim-layer').fadeOut() : $el.fadeOut(); // 닫기 버튼을 클릭하면 레이어가 닫힌다.
		return false;
	});

	$('.layer .dimBg').click(function(){
		$('.dim-layer').fadeOut();
		return false;
	});
}

layer_popup(str);

$(document).ready(function(){


	/*선택한 자식노드값 임시저장*/

	$("input[name=cate]").change(function(){
		var cate=$("input[name='cate']:checked").val();
		var action = "upt_4insu_qst";

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action,id:id,cate:cate},
			success:function(data){
				console.log(data);
				//alert(data);
				opener.document.location.reload();
				self.close();
				//alert("저장완료");

			}
		})

	});

	$('#btn-layerClose').click(
		function() {
			self.close();
		}	
	);



});



</script>
</body>
</html>