		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>대표자 : 변기영</li>
				<li>개인정보보호책임자 : 정혜숙</li>
				<li>대표번호 : 1899-3582(세무빨리)</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li> ss11@sostax.co.kr </li>
				<li>서울특별시 강남구 테헤란로4길 6, 1층 117호 (역삼동, 강남역 센트럴 푸르지오 시티)</li>
			</ul>
			<h3>Copyright(c) 2019 shinseung rights reserved</h3>
		</footer>

		
		</div>

</body>


</html>

		<script>
			//지점안내 레이어팝업
			$('.wrap').prepend('<div class="mask"></div>');

			//레이어팝업닫기
			$(".locationPop .close,.videoPop .close,.counselingPop .close ").click(function () {
				$(".locationPop").css("display", "none");
				$(".videoPop").css("display", "none");
				$(".mask").css("display", "none");
				$(".counselingPop").css("display", "none");
				$('.counselingPop').find('span').css("display", "inline-block");
				player.stopVideo();
				//$('.modalVideo ul > a').removeClass('active');			
			});

			//따라다니는 서브네비
			$(window).scroll(function () {

				var mainchange = $('.subvisual').height();

				if ($(this).scrollTop() > mainchange) {
					TweenLite.to('.subnavi', 0.1, { css: { background: "#fff", position: "fixed", width: "100%", paddingTop: "0px", boxShadow: "-1px -2px 9px rgba(230,230,230,.9)" } });
				}
				else {
					TweenLite.to('.subnavi', 0, { css: { background: "none", position: "absolute", paddingTop: "30px", boxShadow: "none" } });
				}

			});

	
	$(document).ready(function () {
		fetchUser();

		function fetchUser() {

			var action = "select";
			//users 리스트를 select.php 에서 받아온다.
			$.ajax({
				url: "select.php",
				method: "POST",
				data: { action: action },
				success: function (data) {
					$('#NEW_HP').val('');
				}
			})

			var request = new Request();	
			var cate = request.getParameter("cate");
			var str_url = window.location.href;
			//alert(str_url );

			if(str_url.indexOf('/sub_news.php') != -1){
				if(cate != ""){
					document.getElementById(cate).setAttribute('class','active');
				}else{
					document.getElementById('ALL').setAttribute('class','active');
				}
			}


		}

		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action1').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP1').val();
			var action = "추가";
			var Q_TYPE = "양도상속증여";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('빈칸을 입력해 주세요');
			}
		});

		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action2').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP2').val();
			var action = "추가";
			var Q_TYPE = "기장";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('빈칸을 입력해 주세요');
			}
		});

		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action3').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP3').val();
			var action = "추가";
			var Q_TYPE = "세무소식구독";

			//성과 이름이 올바르게 입력이 되면
			if (NEW_HP != '') {

				$.ajax({
					//insert page로 위에서 받은 데이터를 넣어준다.
					url: "action.php",
					method: "POST",
					data: { NEW_HP: NEW_HP, action: action, Q_TYPE: Q_TYPE },
					success: function (data) {

						//성공하면 action.php 에서 출력된 데이터가 넘어온다.
						alert(data);

						//입력 후 리스트 다시 갱신
						fetchUser();
					}
				});

			} else {
				alert('빈칸을 입력해 주세요');
			}
		});
	});

</script>

<script>
$(document).ready(function(){
    
   $("a[data-toggle='sns_share']").click(function(e){
		e.preventDefault();
		
		var _this = $(this);
		var sns_type = _this.attr('data-service');
		var href = $(location).attr('href');
		var title = _this.attr('data-title');
		var loc = "";
		var img = $("meta[name='og:image']").attr('content');
		
		if( ! sns_type || !href || !title) return;
		
		if( sns_type == 'facebook' ) {
			loc = 'http://www.facebook.com/sharer/sharer.php?u='+href+'&t='+title;
		}
		else if ( sns_type == 'twitter' ) {
			loc = 'http://twitter.com/home?status='+encodeURIComponent(title)+' '+href;
		}
		else if ( sns_type == 'google' ) {
			loc = 'http://plus.google.com/share?url='+href;
		}
		else if ( sns_type == 'pinterest' ) {
			
			loc = 'http://www.pinterest.com/pin/create/button/?url='+href+'&media='+img+'&description='+encodeURIComponent(title);
		}
		else if ( sns_type == 'kakaostory') {
			loc = 'https://story.kakao.com/share?url='+encodeURIComponent(href);
		}
		else if ( sns_type == 'band' ) {
			loc = 'http://www.band.us/plugin/share?body='+encodeURIComponent(title)+'%0A'+encodeURIComponent(href);
		}
		else if ( sns_type == 'naver' ) {
			loc = "http://share.naver.com/web/shareView.nhn?url="+encodeURIComponent(href)+"&title="+encodeURIComponent(title);
		}
		else {
			return false;
		}
		
		window.open(loc);
		return false;
	});
    
    
});


</script>