
<?php include("top.php");?>
<div class="wrap">

	<header class="subhead">
		<section class="subnavi">
			<div>
				<?php include("navi.php");?>
			</div>
		</section>

		<section class="subvisual s_pricebg">
		</section>

		<section class="subtext">
			<h1>종합소득세 간편신고 서비스</h1>
		</section>
	</header>

	<section class="stepProcess">
        <ul>
            <li><span class="stepProcess01"></span><span><em>STEP01</em>기본정보 입력</span></li>
            <li class="on"><span class="stepProcess02"></span><span><em>STEP02</em>예상납부세액 확인 </span></li>
            <li><span class="stepProcess03"></span><span><em>STEP03</em>신고의뢰 접수 </span></li>
        </ul>
    </section>

	<!-- step02 -->
    <section class="step02">
        <div class="fL">
            <h1><span>STEP02</span>예상 납부세액<br> 신고대행수수료<br> 확인</h1>
        </div>
        <div class="fR">
            <h1><strong><font id="CSTNAME" name="CSTNAME"></font></strong><span>님의 종합소득세 신고에 대해 안내드립니다</span></h1>
            <h2>고객님의 카톡으로도 예상납부세액과 신고대행수수료를 안내해드렸습니다.</h2>

            <div class="total">
                <span>예상납부세액</span>
                <span><em><label id="EXP_PAY_TAX" name="EXP_PAY_TAX"></label></em>원</span>
            </div>
            <h3><em>예상 납부세액이 마이너스이면 환급금액입니다. </em>
                예상 납부세액은 홈택스 기초값으로 계산된 세액이며, 부양가족여부, 타소득여부,
                근로소득지급명세서, 원천징수영수증, 부가세신고서, 기부금영수증 등 추가 정보에 따라
                실제 신고시에는 다소 상이할 수 있습니다.
            </h3>

            <div class="total">
                <span>신고대행수수료</span>
                <span><em><label id="EST_FEE" name="EST_FEE"></label></em>원</span>
            </div>
            <h3><em>신고대행 수수료는 서류 검토 후 조정될 수 있습니다. 이점 양해부탁드립니다 </em>
            </h3>

            <div class="btn">
                <input type="button" value="신고 대행 맡기고 절세혜택 받기 " class="bankdelay" id="go_step3" name="go_step3">
            </div>

        </div>

    </section>
    <section class="step02_advertiseWrap">

        <div class="title">
            <h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
            <h2>쉽고, 싸고, 편한 종합소득세 신고 신고 대행을 맡겨주시면 절세 포인트를 찾아 드리고,<br>
                카톡으로 진행사항을 안내해드립니다.</h2>
            <h3>언제, 어디서나 믿고 맡길 수 있는 국세청 33년 경력 신승세무법인! 이미 많은 고객분들이 탁월한 절세혜택을 경험하고 계십니다</h3>
        </div>

        <div class="advertiseCon">
            <div class="advertise">
                <h3><span>2,124만원</span> 절세 혜택!</h3>
                <h4>양도소득세 신고 / 토지 </h4>
                <ul>
                    <li>양도대상 : 토지</li>
                    <li>양도가액 : 5억 6천만원</li>
                    <p class="taxbefore"><span>일반 예상 세액</span><strong class="small">1억 5,739만원 </strong>
                    </p>
                    <p class="taxafter"><span>세무톡 예상 세액</span><strong class="small">1억 3,615만원 </strong>
                    </p>
                </ul>
                <h5>-2,124만원 </h5>
            </div>

            <div class="advertise">
                <h3><span>2,124만원</span> 절세 혜택!</h3>
                <h4>양도소득세 신고 / 토지 </h4>
                <ul>
                    <li>양도대상 : 토지</li>
                    <li>양도가액 : 5억 6천만원</li>
                    <p class="taxbefore"><span>일반 예상 세액</span><strong class="small">1억 5,739만원 </strong>
                    </p>
                    <p class="taxafter"><span>세무톡 예상 세액</span><strong class="small">1억 3,615만원 </strong>
                    </p>
                </ul>
                <h5>-2,124만원 </h5>
            </div>

        </div>

    </section>

	<?php include("subbottom.php");?>

	<?php include("footer.php");?>

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
	
	$("#go_step3").click(
		function(){
			var req = new Request();
			var id = req.getParameter("id");		
			window.location.href="sub_step03.php?id="+id;
		}
	);
	
	fetchUser();
	function fetchUser()
	{

		var action = "select_inc_info";
		var req = new Request();
		var id = request.getParameter("id");		
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"action.php",
			method:"POST",
			dataType:"json",
			data:{action:action,id:id},
			success:function(data){
				$('#CSTNAME').html(data.CSTNAME);
				$('#EXP_PAY_TAX').html(data.EXP_PAY_TAX);
				$('#EST_FEE').html(data.EST_FEE);
			}
		})
	}

	


});


</script>