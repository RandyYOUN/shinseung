<?php include("top.php");?>


		<section class="subvisual sub_pricebg">
			<h1>부가세 간편신고 서비스</h1>
		</section>

		<script type="text/javascript" src="resources/js/SimpleTabs02.js"></script>
		<section class="subcon">
			<div class="subtabsWrap">		

				<section class="stepProcess">
					<div>
						<span><em>STEP05</em>부가정보 입력완료</span>
					</div>
				</section>

				<section class="step05">
				<div class="stepwrap">
					<div class="fL">
						<h1><img src="../resources/images/Mstep05Img.png"></h1>
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
							<span>1</span><span>홈택스 수임 동의 요청 [카카오톡으로 안내]</span>
							<input type="button" value="홈택스 수임동의 요령" onclick="javascript:alert('준비중입니다.');">
							<em><img src="../resources/images/step05Arrow.png"></em>
						</li>
						<li>
							<span>2</span><span>홈택스 수임 동의 완료시 세무 담당자 배정</span>
							<em><img src="../resources/images/step05Arrow.png"></em>
						</li>
						<li>
							<span>3</span><span>필요 서류 검토 </span>
							<em><img src="../resources/images/step05Arrow.png"></em>
						</li>
						<li>
							<span>4</span><span>필요시 추가 서류 요청 [카카오톡으로 안내]</span>
							<input type="button" value="추가 서류 업로드" id="action_goupload" name="action_goupload">
							<em><img src="../resources/images/step05Arrow.png"></em>
						</li>
						<li>
							<span>5</span><span>부가세 신고 </span>
							<em><img src="../resources/images/step05Arrow.png"></em>
						</li>
						<li>
							<span>6</span><span>필요시 추가 서류 요청 [카카오톡으로 안내]</span>
						</li>
					</ul>
				</div>
			</section>
				
					

			</div>
		</section>

		<?php include("bottom.php");?>

<Script>
	
$('#action_goupload').click(function(){

	var request = new Request();
	
	var id = request.getParameter("id");
	var id2 = request.getParameter("id2");

	window.location.href="sub_step05_upload.php?id="+id+"&id2="+id2;
	
}); // [2]끝


</script>