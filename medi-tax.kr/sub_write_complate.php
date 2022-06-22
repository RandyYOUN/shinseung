<?php
// Connect DB & CONNECTION STANDARD
include "db_info.php";
?>
<!doctype html>
<html>
<head>
	<title>병의원세무지원센터::신승세무법인</title>
	<meta charset="utf-8">
	<meta property="og:type" content="website">
	<meta property="og:title" content="세무톡 - 창업세무상담센터">
	<meta property="og:url" content="http://taxtok.co.kr/">
	<meta property="og:description" content="쉽고 편한 창업 전문 세무상담센터">
	<meta property="og:image" content="resources_/images/sum.jpg">
	<link rel="stylesheet" href="resources_/css/basic.css" />
	<link rel="stylesheet" href="resources_/css/swiper.css">
	<link rel="stylesheet" href="resources_/css/main.css" />
	<link rel="shortcut icon" href="resources_/images/icon.ico">
	<script type="text/javascript" src="resources_/js/libs.js"></script>
	<script type="text/javascript" src="resources_/js/jquery-bxslider.js"></script>
	<script type="text/javascript" src="resources_/js/jquery-slick.js"></script>
	<script type="text/javascript" src="resources_/js/jquery-swiper.js"></script>
	<script type="text/javascript" src="resources_/js/SimpleTabs.js"></script>
	<script type="text/javascript" src="resources_/js/jquery-counterup.js"></script>
	<script type="text/javascript" src="resources_/js/TweenMax.js"></script>
	<script type="text/javascript" src="/path/to/jquery.js"></script>

<!-- 2019.01.06 yes@einvention -->
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KGVV25Z');</script>
<!-- End Google Tag Manager -->

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

<!-- Channel Plugin Scripts -->
<script>
	(function () {
		var w = window;
		if (w.ChannelIO) {
			return (window.console.error || window.console.log || function () { })('ChannelIO script included twice.');
		}
		var d = window.document;
		var ch = function () {
			ch.c(arguments);
		};
		ch.q = [];
		ch.c = function (args) {
			ch.q.push(args);
		};
		w.ChannelIO = ch;
		function l() {
			if (w.ChannelIOInitialized) {
				return;
			}
			w.ChannelIOInitialized = true;
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.async = true;
			s.src = 'https://cdn.channel.io/plugin/ch-plugin-web.js';
			s.charset = 'UTF-8';
			var x = document.getElementsByTagName('script')[0];
			x.parentNode.insertBefore(s, x);
		}
		if (document.readyState === 'complete') {
			l();
		} else if (window.attachEvent) {
			window.attachEvent('onload', l);
		} else {
			window.addEventListener('DOMContentLoaded', l, false);
			window.addEventListener('load', l, false);
		}
	})();
	ChannelIO('boot', {
		"pluginKey": "9c36349c-b1f2-454b-9853-f1d4994800a5"
	});
</script>

<!-- End Channel Plugin -->
<script type="text/javascript">

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

	function none() {
		var test = "1";
	}

	//모바일체크
	var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');

	var request = new Request();

	if (request.getParameter("pc") == "y") {
		var test = "1";
	} else {
		for (var word in mobileKeyWords) {
			if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
				window.location.href = "m/index.php";
				break;
			}
		}
	}


	//쿠키저장 함수
	function setCookie(name, value, expiredays) {
		var todayDate = new Date();
		todayDate.setDate(todayDate.getDate() + expiredays);
		document.cookie = name + "=" + escape(value) + "; path=/; expires=" + todayDate.toGMTString() + ";"
	}
	
	function go_page(num){
		if(num == 0){
			alert("마지막페이지입니다");
		}else if(num == -1){
			alert("첫페이지입니다");
		}else{
			window.location.href="sub_newsview.php?id="+num;
		}
	}


	$(document).ready(function () {
		$("#promotionBanner .btnclose").click(function () {
			//오늘만 보기 체크박스의 체크 여부를 확인 해서 체크되어 있으면 쿠키를 생성한다.
			if ($("#chkday").is(':checked')) {
				setCookie("topPop", "done", 1);
				//alert("쿠키를 생성하였습니다.");

			}
			//팝업창을 위로 애니메이트 시킨다. 혹은 slideUp()
			//$('#promotionBanner').animate({ height: 0 }, 500);
			$('#promotionBanner').slideUp(500);
		});
	});
</script>


<body>
<!-- 2019.01.06 yes@einvention -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KGVV25Z"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

	<section class="quick">
			<div>
				<h1>쉽고 편한 세무톡</h1>
				<h2>무엇을 도와드릴까요?</h2>
			</div>
			<ul>
				<li>쉽고빠른<span></span></li>
				<li>세무상담<span></span></li>
				<li>증빙자료<span></span></li>
				<li>전송가능<span></span></li>
			</ul>
			<a href="http://pf.kakao.com/_vexexkC/chat"></a>
		</section>

		<script>
			//퀵바
			var elem = $(".quick ul").find('li');
			var items = elem.length;
			var index = 0;

			var quickbubble = new TimelineLite();

			function bubbleMoving() {
				setTimeout(function () {
					if (index < items) {
						quickbubble.to(elem.eq(index), 0.5, { opacity: 1, ease: Power2.easeIn, y: -25 })
							.to(elem.eq(index), 1.5, { opacity: 1, ease: Power2.easeIn, y: -25 })
							.to(elem.eq(index), 0.5, { opacity: 0, ease: Power2.easeIn, y: 30 });
						index++;
						bubbleMoving();

					}
					if (index == items) {
						index = 0;
					}
				}, 3000);
			};
			bubbleMoving();

			var quickpop = new TimelineMax({ repeat: -1, repeatDelay: 5, yoyo: true, })
				.delay(2).to($(".quick").find('div'), 0.5, { width: 310, borderRadius: 25, backgroundPosition: "-85px -50px" })
				.to($(".quick div h1"), 0.5, { opacity: 1, x: -40 })
				.to($(".quick div h2"), 0.2, { opacity: 1, x: -40 });

		</script>


				<script>
			//$('.newsview').css("border","1px solid red");
			$('.newsview h4').find('*').css("height","auto");
			$('.newsview h4').find('*').css("width","100%");
			$('.newsview h4').find('img').css("width","auto");
			$('.newsview h4').find('img').css("width","auto");
		</script>


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
			<h1>세무QnA</h1>
			<h2>혁신적인 병의원 세무회계 서비스 세무톡이 선도합니다</h2>
		</section>
	</header>



	<div class="s_news">



		<section class="success">
			<img src="resources/images/success.png">
			<h1>문의사항 등록완료!</h1>
			<h2>정상적으로 등록되었습니다.<br>빠른시간안에 답변드리도록 하겠습니다.</h2>
		</section>

	</div>

<?php 
include "subbottom.php";
include "footer.php";
?>


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

fetchUser();
function fetchUser()
{

	var action = "select";
	var request = new Request();

	var id = request.getParameter("id");
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"fetch.php",
		method:"POST",
		data:{id:id},
		dataType:"json",
		success:function(data)
		{
			//alert(data.first_name);
			//data의 타입은 객체 object
			//한 행에서 수정버튼을 누르면
			//위쪽 입력창의 값이 추가 -> 수정으로 변경되게 만든다.

			console.log(data);
			
			$('#action').text("수정");
			$('#user_id').val(id);
			
			$('#subject').val(data.SUBJECT);
			$('#news_reguser').val(data.NEWS_REGUSER);
			$('#news_reguser_comp').val(data.NEWS_REGUSER_COMP);
			$('#news_regdate').val(data.NEWS_REGDATE);
//			$('#img_url').val(data.IMG_URL);
			$('#cate').val(data.CATE);
			$('#visible').val(data.VISIBLE);

			//$('#summernote').summernote('code').val(data.CONTENTS);
			var modi_contents = data.CONTENTS;
			$('#summernote').summernote('code', modi_contents);

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


/*파일업로드 : S */
	$('#upfile').on('change', function(e){
		//파일들을 변수에 넣고
		 var files = e.target.files;

		 //post방식으로 보내야하기 때문에 form을 생성해줍니다.
		 var data = new FormData();
		 var property = document.getElementById('upfile').files[0];
         var image_name = property.name;

		 document.getElementById('img_name').value = image_name ;


		 //만약 input에 multiple 속성을 추가한다면, 파일을 여러개 선택할 수 있는데, 저는 일단 1개로
		 //그 때의 파일을 배열로 만들어 주기 위한 작업입니다.
		 $.each(files, function(key, value)
		 {
		  //key는 다른 지정이 없다면 0부터 시작 할것이고, value는 파일 관련 정보입니다.
		  data.append(key, value);
		 });

		 
		  $.ajax({
					
				 url: 'upload_process.php?files', //file을 저장할 소스 주소입니다.
				 type: 'POST',
				 data: data, //위에서 가공한 data를 전송합니다.
				 cache: false,
				 dataType: 'json',
				 processData: false, 
				 contentType: false, 
				 success: function(data, textStatus, jqXHR)
				 {
					 alert(data.error);
				  if(typeof data.error === 'undefined') //에러가 없다면
				  {

			   //저장된 파일의 정보를 통해 위에서 선언한 img_section이란 곳에 추가 할 코드입니다. 										  파일이 1개기 때문에 index가 0입니다.
				  var source = '<img src ="'+data.files[0]+'" style="width:270px; height:160px" id="img_url" name="img_url">'

				  $("#img_section").html(source);
				  }
				  else//에러가 있다면
				  {
				   console.log('ERRORS: ' + data.error);
				  }
				 },
				 error: function(jqXHR, textStatus, errorThrown)
				 {
				  console.log('ERRORS: ' + textStatus);
				 }
			 });

	});
/*파일업로드 : E */

/*상담사례 클릭시 자식노드 노출*/

$('#cate').on('change', function(e){
	//alert($("#cate option:selected").val());
	if($("#cate option:selected").val()=="QNA"){
		document.getElementById("dept2").setAttribute('style','display:block');
	}else{
		document.getElementById("dept2").setAttribute('style','display:none');
	}
});
/*선택한 자식노드값 임시저장*/
$('#c_cate').on('change', function(e){
	document.getElementById("c_cate_id").value = $("#c_cate option:selected").val();
});


	//[2] 추가 버튼 클릭했을 때 작동되는 함수
	$('#action').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var subject = $('#subject').val();
		var news_regdate= $('#news_regdate').val();
		var news_reguser= $('#news_reguser').val();
		var news_reguser_comp = $('#news_reguser_comp').val();
		var img_url = $('#img_name').val();
		var cate = $('#cate').val();
		var c_cate = $('#c_cate_id').val();
		var visible = $('#visible').val();

		var contents =  $('#summernote').summernote('code');
		var id= $('#user_id').val();
		var action = $('#action').text();

		//성과 이름이 올바르게 입력이 되면
		if(subject !='' && contents != ''){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"action.php", 
				method:"POST",
				data:{subject:subject,news_regdate:news_regdate,news_reguser:news_reguser,news_reguser_comp:news_reguser_comp,img_url:img_url,contents:contents,cate:cate,c_cate:c_cate ,visible:visible,id:id,action:action },
				success:function(data){
					alert(data);
					window.location.href="admin_list.php";
				}
			});

		}else{
			alert('빈칸을 입력해 주세요');
		}



	});

		//[4]삭제 버튼을 클릭했을 때 작동되는 함수
		$(document).on('click','.delete',function(){

			var id = $(this).attr("id");

			if(confirm("삭제 하시겠습니까?"))
			{
			//구분자
				var action = "delete";
				$.ajax({
					url:"action.php",
					method:"POST",
					data:{id:id,action:action},
					success:function(data){
						//리스트 다시 조회
						fetchUser();
						alert(data);
					}
				});
			}else
			{
				return false;
			}

		});



});



</script>

</html>