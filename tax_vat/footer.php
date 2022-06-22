		<section class="customer"  id="customer" name="customer">
			<ul>
				<li>
					<img src="../resources/images/call.png">
					<div>
						<h1>전화상담</h1>
						<h2>평일 오전 10시 ~ 오후 6시</h2>
						<!--h1 style="font-size:22px;padding-top:20px;">부가세 간편안내서비스를 이용해주세요.</h1-->
						<!--h2>검토하여 신속히 답변드리겠습니다. </h2-->
					</div>
					<h3>1899-3582</h3>
				</li>
				<li>
					<div>
						<h1>채팅상담 </h1>
						<h2>쉽고 빠른 전문상담 및 자료 전송까지 OK! </h2>
					</div>
					<a href="javascript:ChannelIO('show');" class='IfdoVirtualPage' data-url='chat_request.html' data-title='채팅상담 요청'>상담하기</a>
				</li>
			</ul>
		</section>
		


		<footer>
			<ul>
				<li>신승세무법인</li>
				<li>대표자 : 변기영</li>
				<li>개인정보보호책임자 : 정혜숙</li>
				<li  id="phone_hide" name="phone_hide">대표번호 : 1899-3582(세무빨리)</li>
				<li>사업자등록번호 : 214-87-25178</li>
				<li> ss11@sostax.co.kr </li>
				<li>서울특별시 강남구 테헤란로 114 14층 (역삼빌딩, 역삼세무서)</li>
			</ul>
			<h3>Copyright(c) 2019 shinseung rights reserved</h3>
		</footer>

		
		</div>
<input type = 'hidden' id = 'tag_str' name='tag_str'></input>

<!-- Start Script for IFDO (부가톡)-->
<script type='text/javascript'>
$(function(){
	$('.IfdoVirtualPage').mousedown(function(e){
		var _data_url = $(this).attr('data-url');
		var _data_title = $(this).attr('data-title');
		if(typeof _NB_PAGE == 'function'){
			_NB_PAGE(_data_url , _data_title);
		}
	});
});
var _NB_gs = 'wlog.ifdo.co.kr'; 
var _NB_MKTCD = 'NVA4202161810';
var _NB_APPVER=''; /* 하이브리드 앱 버전 */
(function(a,b,c,d,e){var f;f=b.createElement(c),g=b.getElementsByTagName(c)[0];f.async=1;f.src=d;
f.setAttribute('charset','utf-8');
g.parentNode.insertBefore(f,g)})(window,document,'script','//script.ifdo.co.kr/jfullscript.js');	
</script>
<!-- End Script for IFDO -->

</body>


</html>
<script>
function hide_time(){
	let today = new Date(); 

	var hour = today.getHours();
	var min = today.getMinutes();


//		if(hour > 0){
//			$('#customer').attr('style', "display:block;");
//			$('#customer_hide').attr('style', "display:hide;");

//		}else{
			$('#customer').attr('style', "display:none;");
			$('#phone_hide').attr('style', "display:none;");
			$('#customer_hide').attr('style', "display:block;");
		
//		}


}

//hide_time();

function closeWinAt00(winName, expiredays) {   
   setCookieAt00( winName, "done" , expiredays);   
   var obj = eval( "window." + winName );  
   obj.style.display = "none";  
}  
// 쿠키 가져오기  
function getCookie( name ) {  
   var nameOfCookie = name + "=";  
   var x = 0;  
   while ( x <= document.cookie.length )  
   {  
       var y = (x+nameOfCookie.length);  
       if ( document.cookie.substring( x, y ) == nameOfCookie ) {  
           if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )  
               endOfCookie = document.cookie.length;  
           return unescape( document.cookie.substring( y, endOfCookie ) );  
       }  
       x = document.cookie.indexOf( " ", x ) + 1;  
       if ( x == 0 )  
           break;  
   }  
   return "";  
}  

// 00:00 시 기준 쿠키 설정하기  
// expiredays 의 새벽  00:00:00 까지 쿠키 설정  
function setCookieAt00( name, value, expiredays ) {   
    var todayDate = new Date();   
    todayDate = new Date(parseInt(todayDate.getTime() / 86400000) * 86400000 + 54000000);  
    if ( todayDate > new Date() )  
    {  
    expiredays = expiredays - 1;  
    }  
    todayDate.setDate( todayDate.getDate() + expiredays );   
     document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";"   
  }  
  


function tag(e){

	var url = window.location.href;
	var name = '@'+e
	//document.getElementById('c_all').setAttribute('class','');
	var tag_str = document.getElementById('tag_str');

	if(url.indexOf(name)>-1){
		//document.getElementById(e).setAttribute('class','');
		tag_str.value = tag_str.value.replace(name,'');
		//url = url.replace('&'+e+'=y','');

	}else{
		//document.getElementById(e).setAttribute('class','active');
		//url += '&'+e+'=y';
		tag_str.value = tag_str.value + name;

	}
	
	if(tag_str.value == ''){
		document.location.replace('sub_news.php?cate=QNA');
	}else{
		document.location.replace('sub_news.php?cate=QNA&tag='+tag_str.value);
	}
}
</script>
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
			
			var request = new Request();	
			var request2 = new Request();
			var cate = request.getParameter("cate");
			var tag = request2.getParameter("tag");
			var str_url = window.location.href;

			if(str_url.indexOf('/sub_news.php') != -1){
				if(cate != ""){
					document.getElementById(cate).setAttribute('class','active');

						if(cate == "QNA"){
							document.getElementById("sub_menu").setAttribute('style','display:block');
							document.getElementById("blank").setAttribute('style','display:none');


							if(tag ==""){
								document.getElementById('c_all').setAttribute('class','active');
							}else{
								document.getElementById('tag_str').value=tag;
								var strArray = tag.split('@');
								//alert(tag.match(/#/g).length);
								for(i=0; i< tag.match(/@/g).length+1; i++){
									if(strArray[i] !=''){
										document.getElementById(strArray[i]).setAttribute('class','active');									
									}


								}


							}

						}else{
							document.getElementById("sub_menu").setAttribute('style','display:none');
							document.getElementById("blank").setAttribute('style','display:block');
						
						}


				}else{
					document.getElementById('ALL').setAttribute('class','active');
					document.getElementById("sub_menu").setAttribute('style','display:none');
					document.getElementById("blank").setAttribute('style','display:block');
				}
			}
		}

		//[2] 추가 버튼 클릭했을 때 작동되는 함수
		$('#action1').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP1').val();
			var action = "추가";
			var Q_TYPE = "부가세";

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
			var Q_TYPE = "등록대행&법인설립지원";

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
			var Q_TYPE = "종소세_정책자금";

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
		$('#action4').click(function () {

			//각 엘리먼트들의 데이터 값을 받아온다.
			var NEW_HP = $('#NEW_HP4').val();
			var action = "추가";
			var Q_TYPE = "구독";

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