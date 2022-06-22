<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
include "top.php";
?>

<script type="text/javascript">
	$(document).ready(function () {
			$('.newsview h4').find('*').css("height","auto");
			$('.newsview h4').find('*').css("width","100%");
			$('.newsview h4').find('*').css("font-size","16px");
				$('.newsview h4').find('*').css("line-height","26px");
			$('.newsview h4').find('img').css("width","auto");
			$('.newsview h4').find('img').css("display","inline-block");
			$('.newsview h4').find('img').parent().css("text-align","center");
	});
</script>

	<header class="subhead">
		<section class="subnavi">
			<div>
				<?php include "navi.php"; ?>
			</div>
		</section>

		<section class="subvisual s_newsbg">
		</section>

		<section class="subtext">
			<h1>국세청 33년경력</h1>
			<h2>병의원 절세와 세무안전을 책입집니다</h2>
		</section>
	</header>



	<div class="s_news">

		<section class="write">
			<h1>* 핸드폰 번호 필수 입력 <br><br>
			개인정보 보호를 위해 답변 알림 및 답변 페이지 링크가 핸드폰 문자로 발송됩니다. </h1><br>
			<table>
				<colgroup>
					<col width="10%"></col>
					<col width="40%"></col>
					<col width="10%"></col>
					<col width="40%"></col>
				</colgroup>
				<tbody>
					<tr>
						<th>성함</th>
						<td><input type="text"  name="CSTNAME" id="CSTNAME" style="width:250px;"></td>
						<th>핸드폰<span>*</span></th>
						<td><input type="text" name="PHONE" id="PHONE" style="width:250px;" onKeyup="this.value=this.value.replace(/[^0-9]/g,'');"></td>
					</tr>
					<tr>
						<th>이메일</th>
						<td colspan="3"><input type="text" name="EMAIL" id="EMAIL" style="width:500px;"></td>
					</tr>
					<tr>
						<td colspan="4">
						 <textarea id="summernote" name="editordata"></textarea>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="write_div">
				<button class="write_btn" name="action" id="action"><div style="font-size:20px;">전 송</div></button>
			</div>
		</section>

	</div>

<?php 
include "subbottom.php";
include "footer.php";
?>

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


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var CSTNAME = $('#CSTNAME').val();
		var PHONE = $('#PHONE').val();
		var EMAIL= $('#EMAIL').val();
		var contents =  $('#summernote').summernote('code');
		var action = "추가";//$('#action').text();
		var today = new Date();
		var dd = today.getDate();
		var mm = today.getMonth()+1;
		var yyyy = today.getFullYear();
		var time = today.getTime();
		var now = yyyy+""+mm+""+dd+""+time

		//성과 이름이 올바르게 입력이 되면
		if(CSTNAME !='' && PHONE != '' && contents !=''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action_qna.php", 
				method:"POST",
				data:{now:now,CSTNAME:CSTNAME,PHONE:PHONE,EMAIL:EMAIL,contents:contents,action:action },
				success:function(data){
					alert(data);
					window.location.href="sub_write_complate.php";
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}



	});

});



</script>

</html>