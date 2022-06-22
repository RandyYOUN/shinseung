<?php include("top.php");?>


		<section class="subvisual sub_pricebg">
			<h1>종합소득세 간편신고 서비스</h1>
		</section>

		<script type="text/javascript" src="resources/js/SimpleTabs02.js"></script>
		 <!-- step02 -->
        <section class="step02">
            <h1><span>STEP02</span>예상 납부세액 신고대행수수료 확인</h1>
            <div>
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
    
    
        <section class="step02_rolling">
            <h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <h4>세무기장 / 부동산중개업</h4>
                        <ul>
                            <li>업종코드 : 701201 (부동산)</li>
                            <li>매출액 : 1억 80만원</li>
                            <li><span>일반</span>예상 세액 2,128만원 </li>
                            <li><span>세무톡</span>예상 세액 300만원</li>
                        </ul>
                        <h5><span>-1,828</span><span>만원 절세 혜택!</span></h5>
                        <a></a>
                    </div>
                    <div class="swiper-slide">
                        <h4>세무기장 / 서비스업 </h4>
                        <ul>
                            <li>업종코드 : 940500 (서비스)</li>
                            <li>매출액 : 1억 6,047만원</li>
                            <li><span>일반</span>예상 세액 1,431만원 </li>
                            <li><span>세무톡</span>예상 세액 -352만원</li>
                        </ul>
                        <h5><span>-1,783</span><span>만원 절세 혜택!</span></h5>
                        <a></a>
                    </div>
                    <div class="swiper-slide">
                        <h4>세무기장 소매업</h4>
                        <ul>
                            <li>업종코드 : 523422 (소매업)</li>
                            <li>매출액 : 1억 4,045만원</li>
                            <li><span>일반</span>예상 세액 383만원 </li>
                            <li><span>세무톡</span>예상 세액 19만원</li>
                        </ul>
                        <h5><span>-364</span><span>만원 절세 혜택!</span></h5>
                        <a></a>
                    </div>
                    <div class="swiper-slide">
                        <h4>양도소득세 신고 / 1세대 2주택</h4>
                        <ul>
                            <li>업종코드 : 552107 (음식업)</li>
                            <li>매출액 : 5억 9,352만원</li>
                            <li><span>일반</span>예상 세액 1091만원 </li>
                            <li><span>세무톡</span>예상 세액 758만원</li>
                        </ul>
                        <h5><span>-333</span><span>만원 절세 혜택!</span></h5>
                        <a></a>
                    </div>
                </div>
            </div>
        </section>
    
        <section class="step02_rollingTitle">
            <h1>몰라서 더 많은 세금을 내고 있지 않나요? </h1>
            <h2>쉽고, 싸고, 편한 종합소득세 신고 신고 대행을 맡겨주시면 절세 포인트를 찾아 드리고,<br>
                카톡으로 진행사항을 안내해드립니다.</h2>
            <h3>언제, 어디서나 믿고 맡길 수 있는 국세청 33년 경력 신승세무법인! 이미 많은 고객분들이 탁월한 절세혜택을 경험하고 계십니다</h3>
        </section>


		<?php include("bottom.php");?>
		
		


<script>
    var swiper = new Swiper('.step02_rolling .swiper-container', {
        autoplay: { delay: 3000, },
        slidesPerView: 'auto',
        spaceBetween: 10,
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
		var id = req.getParameter("id");		
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"../action.php",
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

	

	function send_kakao(){

		var request = new Request();
		var action = "action_tok_step2";
		var cstid = request.getParameter("id");
		var bizid = request.getParameter("id2");

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../admin/api/send_tok.php", 
			method:"POST",
			data:{cstid:cstid,bizid:bizid,action:action},
			success:function(data){
				console.log(data);
				//location.reload();				
			}
		});
	}



});



</script>		

