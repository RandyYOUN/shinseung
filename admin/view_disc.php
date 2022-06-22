<!DOCTYPE html>
<html>

</html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>신승 RPA</title>
	<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="shortcut icon" href="images/icon.ico">

	<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


<!-- add summernote -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/lang/summernote-ko-KR.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- codemirror -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.min.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/blackboard.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/theme/monokai.min.css">
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/codemirror.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/codemirror/5.41.0/mode/xml/xml.min.js"></script>

<script src="js/wf_loading.js" type="text/javascript"></script>
<link href="css/wf_loading.css" rel="stylesheet" type="text/css" />

<style>
.disc_text{height:50px;font-size:20px;text-align:center;padding-top:15px;}
.disc_file{height:50px;font-size:15px;text-align:center;padding-top:15px;color: #337ab7;
    text-decoration: none;}
.disc_img{width: -webkit-fill-available; margin:10px;}
</style>
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

function none() {
	var test = "1";
}

//모바일체크
var mobileKeyWords = new Array('iPhone', 'iPod', 'BlackBerry', 'Android', 'Windows CE', 'Windows CE;', 'LG', 'MOT', 'SAMSUNG', 'SonyEricsson', 'Mobile', 'Symbian', 'Opera Mobi', 'Opera Mini', 'IEmobile');

var request = new Request();
var id = request.getParameter("id")
var cate = request.getParameter("cate")
var link2 = request.getParameter("link2")
var url = window.location.href;

if (request.getParameter("pc") == "y") {
	var test = "1";
} else {
	for (var word in mobileKeyWords) {
		if (navigator.userAgent.match(mobileKeyWords[word]) != null) {
			window.location.href = "m/view_disc.php?id="+id;
			break;
		}
	}
}
</script>
<body>
	
<?php
include "db_info.php";
include "top.php";

$checkArr = array(
    1227,
1136,
1264,
1147,
1117,
1112,
1118,
1116,
1119,
1149,
1130,
1120,
1113,
1198,
1114,
1121,
1115,
1111
);

//$userid = 9999;
if( ! in_array($userid, $checkArr) ){
?>
		<div class="wrap">
		<div class="mainbg">
			<div class="content">
				<div class="conwrap">

					<h1>관리자 권한이 없습니다.</h1>
				</div>
			</div>
		</div>
		</div>
<?php
}else{
?>		

	
<br><br><br><br>
	<div class="wrap">
		<div class="mainbg">
			<div class="content">
				<div class="conwrap">

					<h1>면접 평가</h1>
    				
					<div class="dashwrap" style="width:1390px;">

						<div class="btn w100" style="margin:5px 0 15px; text-align:right;">
        					<button name="print" id="print">인쇄</button>
        					<button name="action1" id="action1" >수정</button>
        					<button name="list1" id="list1">목록</button>
        				</div>
						<div class="dashcon">
							<div class="dashboard">
								<table >
									<tbody style="text-align: left;">
										<tr style="background:#90daff29;">
											<td style="width:200px;">성명</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="username" name="username"></label>
											</td>
											<td style="width:200px;">연락처</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="mobile" name="mobile"></label>
											</td>
										</tr>
										<tr>
											<td>생년월일/연령</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="birth" name="birth"></label>
												&nbsp;&nbsp;
												<label class="disc_text" id="age" name="age"></label>
											</td>
											<td>경력(유관업무 경력)</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="car_year" name="car_year"></label>
												
												<label class="disc_text" id="car_month" name="car_month"></label>
												
												<label class="disc_text" id="new_begin" name="new_begin" style="margin-left:45px;"></label>
											</td>
										</tr>
										<tr style="background:#90daff29;">
											<td>부서</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="branch" name="branch"></label>
											</td>
											<td>총 직장경력</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="total_car_year" name="total_car_year"></label>
												
												<label class="disc_text" id="total_car_month" name="total_car_month"></label>
												
												<label class="disc_text" id="total_new_begin" name="total_new_begin" style="margin-left:45px;"></label>
											</td>
										</tr>
										<tr>
    										<td colspan=14>
    											<table border=0>
    												<tr>
    													<td colspan=2 style="text-align: center;background-color: #00b0f0; color:white;">그래프1</td>
    													<td colspan=2 style="text-align: center;background-color: #00b0f0; color:white;">그래프2</td>
    													<td colspan=2 style="text-align: center;background-color: #00b0f0; color:white;">그래프3</td>
    													<td rowspan=3 style="width:400px;">
    														    														
    														<div id="개발자형" name="개발자형" style="display:none;"><B>▶ 개발자형(deveioper)   ================</B>
<BR><BR><BR><BR>

정서 : 독자적으로 자신의 욕구를 충족시킨다.<BR><BR>
목표 : 새로운 기회<BR><BR>
타인을 판단하는 기준 : 자신의 기준을 충족시키는 정도<BR><BR>
타인에게 영향을 주는 점 : 독자적으로 문제의 해결책을 찾는다; 개인적으로 힘을 발휘한다.<BR><BR>
조직에의 공헌 : 책임전가를 피한다; 참신하거나 혁신적인 방법으로 문제를 해결한다.<BR><BR>
지나친 점 : 자신의 목적을 달성하기 위해 사람과 상황을 조종한다.<BR><BR>
압력 아래서 : 일을 끝내야 할 때 혼자가 된다; 자신에게 중요한 일을 자신의 뜻대로 하지 못하거나 도전의 문이 막혀버리면 공격적으로 된다.<BR><BR>
두려움 : 지루함; 영향력을 상실하는 것<BR><BR>
효과 증진책 : 인내, 이해; 적극적으로 참여하고 사람들과 협조한다; 업무의 질에 관심을 갖고 업무를 끝까지 철저하게 수행한다.<BR><BR><BR><BR>


개발자형은 개인주의적 경향이 강하다. 이 유형은 항상 새로운 것을 추구한다. 독립심이 상당히 강하기 때문에 독자적인 결과를 내고 싶어 한다. 집단의 구속을 받지 않으면 관습을 얽매이지 않고, 종종 창의적이고 혁신적인 성과를 내기도 한다.<BR><BR>

직선적으로 강인한 행동을 하지만, 사람이나 상황을 선명하게 다룰 수 있다. 그러나 자신의 개인주의적 성향을 제약받는 상황에서 다른 사람과 함께 일하도록 강요받으면, 공격적으로 된다. 자기 중심적이며, 승진과도전의 기회를 매우 중시한다. 또한 다른 사람에 대한 기대수준이 높기 때문에, 어떤 결과가 자신의 기준을 만족시키지 못하면 비판적으로 된다.<BR><BR>

다른 사람의 마음을 이해하려는 노력이 부족하기 때문에 종종 무관심해 보이기도 한다. 다음과 같은 말은 개발자형의 특징을 그대로 보여 준다. “아스피린을 먹어 보십시오. 나도 똑같은 일을 겪었습니다. 어린애처럼 굴지 마십시오. 괜찮아 질겁니다.”             <BR><BR>

    														</div>
    														
    														<div id="결과지향형" name="결과지향형" style="display:none;"><B>결과지향형(result-oriented)  ================</B> 
<BR><BR><BR><BR>
정서 : 자신을 강하게 표현한다; 개인주의적 성향을 솔직하게 보여 준다.<BR><BR>
목표 : 상황을 주도함, 자기가 하는 일을 독자적으로 선택함<BR><BR>
타인을 판단하는 기준 : 과제를 빠르게 성취하는 능력<BR><BR>
타인에게 영향을 주는 점 : 강한 성격, 자기주장<BR><BR>
조직에의 공헌 : “뭔가를 보여 준다”는 식의 태도와 행동<BR><BR>
지나친 점 : 성급함, 승부를 향한 경쟁심<BR><BR>
압력 아래서 : 비판적으로 되고, 남의 흠을 잡는다; 팀에 참여하지 않으려 한다; 타인의 권한을 침해한다.<BR><BR>
두려움 : 다른 사람에게 이용당할지도 모른다는 생각; 일이 빨리 진척되지 않는 것; 다른 사람과 너무 가깝게 되거나 약해보이는 것<BR><BR>
효과 증진책 : 자신의 생각을 분명히 말한다; 문제를 해결할 때, 다른 사람의 의견이나 제안을 구한다.; 다른 사람에게 진심에서 우러나오는 관심을 보인다. 좀 더 인내심을 갖고 겸손해진다.<BR><BR><BR><BR>


결과지향형은 강한 자신감을 드러낸다. 이런 면이 때로는 오만하게 보이기도 한다. 자신의 능력을 테스트하고, 능력을 발전시킨 수 있는 기회를 적극적으로 모색한다. 어려운 업무나 경쟁적인 상황, 특이한 과제나 “중요한” 지위를 좋아한다. 일을 맡을 때나 끝마칠 때 “제가 하겠습니다”. “할 수 있다고 말 했잖아요”라는 식의 자신감 있는 태도를 취한다.<BR><BR>

직접 관리를 하는 일, 시간이 걸리는 세세한 일, 단순 작업 등에 구속되지 않으려 한다. 그룹 활동이나 위원회에 관련되면 쉬지 않고 일한다. 개인적으로 일하기를 선호하나 일상적인 활동을 끝내려고 다른 사람의 지원을 설득한다. 생각을 빨리하고 즉시 행동한다.<BR><BR>

강압적이거나 직선적이기 때문에 사람을 사귀기 어려울지도 모른다. 인내심이 부족하며, 다른 사람의 결점을 찾으려 한다. 이런 이기주의적인 태도는 무례하게 보일 수도 있다. 다만 사람의 말을 제대로 헤아리지 못하기 때문에 차갑고 무뚝뚝하게 보이기도 한다.<BR><BR>

    														</div>
    														
    														<div id="직감형" name="직감형" style="display:none;"><B>▶ 직감형(inspirational)  ================</B> 
<BR><BR><BR><BR>
정서 : 공격을 받아 들인다; 우정이나 사랑 등에 대한 욕구를 무시하는 경향이 있다.<BR><BR>
목표 : 환경이나 사람들을 주도하고 통제한다.<BR><BR>
타인을 판단하는 기준 : 개인적인 장점, 성격, 사회적 힘 들을 어떻게 표현하는 가의 정도<BR><BR>
타인에게 영향을 주는 점 : 사람을 끌어 들인다; 지시나 위협을 하거나, 보상을 준다.<BR><BR>
조직에의 공헌 : 사람을 움직인다; 일을 솔선하여 시도한다, 사람의 능력에 대해 많은 것을 요구한다. 다른 사람이 자신의 요구를 충족시키면 칭찬을 하고 그렇지 못하면 경계를 한다.<BR><BR>
지나친 점 : 목적을 달성하기 위해 수단을 기리지 않는다.<BR><BR>
압력 아래서 : 방법을 짜낸다; 호전적이고 공격적으로 된다.<BR><BR>
두려움 : 너무 부드럽게 보이는 것; 사회적 지위의 상실<BR><BR>
효과 증진책 : 다른 사람을 진심으로 이해한다; 필요하다면 다름 사람의 개인적 발전을 돕는다.<BR><BR>
<BR><BR>
직감형은 다른 사람의 사고방식이나 행동을 의식적으로 변화시키고자 한다. 빈틈없이 사람의 동기를 파악하고 조정해서, 이 사람이 미리 정해 둔 목표를 향해서 행동 하도록 한다.<BR><BR>
<BR><BR>
분명한 목표를 갖고 있지만, 그 목표를 즉각 말하지는 않는다. 다른 사람이 목표를 기꺼이 받아들일 만한 준비가 되어 있을 때에만 원하는 목표를 말한다. 예를 들어, 남들의 인정을 원하는 사람에게는 우정을, 권력을 원하는 사람에게는 권한을, 안정을 필요로 하는 사람에게는 안정된 환경을 제공한다.<BR><BR>
<BR><BR>
이 유형은 다른 사람과 접촉할 때 호감을 주기도 한다. 시간이 걸리는 단순한 일을 할 때 다른 사람을 설득하여 도움을 구한다. 사람들은 이 유형에게 이끌리는 동시에 미묘한 거리감을 느끼기도 한다. “이용당하고 있다”는 느낌이 들 수도 있다. 다른 사람을 두렵게 하거나 위협하는 경우도 있고, 다름 사람의 결정을 무시하는 경우도 있다.<BR><BR>

    														</div>
    														
    														<div id="창조형" name="창조형" style="display:none;"><B>▶ 창조형(creative)  ================</B> 
<BR><BR><BR><BR>
정서 : 공격을 받아 들인다; 표현을 억제한다.<BR><BR>
목표 : 과제를 주도한다; 독자적으로 실적을 올린다.<BR><BR>
타인을 판단하는 기준 : 자신의 개인적인 기준; 업무를 수행할 때 보여주는 아이디어의 진취성<BR><BR>
타인에게 영향을 주는 점 : 업무 또는 과제를 수행할 때 일정한 속도를 유지하고 새로운 방법을 시도한다.<BR><BR>
조직에의 공헌 : 변화를 계획하거나 주도한다.<BR><BR>
지나친 점 : 퉁명스러움; 비판적 태도, 생색을 내는 태도<BR><BR>
압력 아래서 : 단조로운 일에 쉽게 싫증을 낸다; 자신의 능력을 발휘할 기회를 제한받으면 불쾌하게 생각한다; 독립적으로 행동한다.<BR><BR>
두려움 : 남에게 영향력이 없는 것; 업무수행이 자신의 기준에 미치지 못하는 것<BR><BR>
효과 증진책 : 따뜻함; 효과적인 커뮤니케이션; 팀웍; 조직에는 일반적으로 따라야 할 규칙이나 관계가 있다는 인식<BR><BR>
<BR><BR>
창조형의 행동에는 두 개의 대칭적인 힘이 작용하고 있다. 즉, 눈에 띄는 실적을 바라면서 동시에 완벽을 추구한다. 이들의 공격적 측면은 예민한 측면에 의해 완화된다. 결정을 내리기 전에 가능한 해결책을 모두 찾아보려 하기 때문에 신속하게 생각하거나 반응하지 못한다.<BR><BR>
<BR><BR>
과제를 수행할 때 앞을 내다볼 수 있는 능력이 뛰어나기 때문에 실제로 변화를 가져온다. 사소한 결정은 상당히 빠르지만, 큰일을 결정할 때는 상당히 신중하게 된다. 예를 들면, “승진할 수 있을까?”, “전근 갈 것인가?” 등. 연구할 수 있는 자유와 결과를 재조사하고 검토할 수 있는 권한을 원한다. 과제를 완성하기 위하여 때로는 남의 도움을 필요로 하지만, 자신의 일을 방해하는 사람에게는 화를 낸다. 예의나 체면은 신경 쓰지 않는다. 냉랭한 무관심이나 무뚝뚝한 면을 보이기도 한다.<BR><BR>

    														</div>
    														
    														<div id="촉진자형" name="촉진자형" style="display:none;"><B>▶ 촉진자형(promoter)  ================ </B> 
<BR><BR><BR><BR>
정서 : 다른 사람을 쉽게 받아들인다.<BR><BR>
목표 : 다른 사람들에게 인기, 인정받음.<BR><BR>
타인을 판단하는 기준 : 언어 표현 능력<BR><BR>
타인에게 영향을 주는 점 : 타인을 칭찬한다: 기회를 준다; 호의적이다.<BR><BR>
조직에의 공헌 : 긴장을 완화한다; 사람을 격려해 주고 업무를 촉진시킨다.<BR><BR>
지나친 점 : 지나치게 칭찬한다; 지나치게 낙천적이다.<BR><BR>
압력 아래서 : 부주의하고 감상적으로 된다; 일을 완수할 때 짜임새가 없다.<BR><BR>
두려움 : 사회적 인정과 자신의 가치를 상실하는 것.<BR><BR>
효과 증진책 : 시간을 효과적으로 관리한다; 객관성을 유지한다; 긴박감을 갖는다; 감정을 조절한다; 약속과 업무를 끝까지 애행한다.<BR><BR>
<BR><BR>
촉진자형은 일에 도움을 얻을 수 있는 사회적 관계를 많이 갖고 있다. 사람들과 함께 일하길 좋아하고 사교적이기 때문에 사람을 쉽게 사귄다. 고의로 남을 곤란하게 하는 일은 거의 하지 않는다. 사람들과의 관계를 계속 발전시키고 유지할 수 있는 우호적인 환경을 원한다. 언변이 뛰어나기 때문에 효과적으로 자신의 의견을 제안하고, 다른 사람의 열정을 불러일으킨다.<BR><BR> 
<BR><BR>
아는 사람들이 많기 때문에 그들로부터 적절한 도움을 받을 수 있다.<BR><BR> 
<BR><BR>
낙천적이어서 사람들의 능력을 잘못 판단하는 경향이 있다. 또한 모든 사실을 고려하지 않고 성급하게 긍정적인 결론을 내리기도 한다. 다른 사람들에게는 그런 결론에 일관성이 없는 것으로 보일 수도 있다. 주도면밀하고 민주적인 관리를 하면, 이익을 중시하고 객관성을 발전시키는 데 도움이 된다. 시간을 관리하고 계획하는 데 어려움을 겪기도 한다. 업무 완수가 매우 중요하다는 점을 상기하며 대화에 시간을 너무 많이 쓰지 않도록 한다.<BR><BR> 

    														</div>
    														
    														<div id="카운셀러형" name="카운셀러형" style="display:none;"><B>▶ 카운셀러형(counselor)  ================</B> 
<BR><BR><BR><BR>
정서 : 사귀기 쉽다; 감정이 풍부하고 이해심이 많다.<BR><BR>
목표 : 우정을 지키는 것; 사람을 행복하게 해 주는 것<BR><BR>
타인을 판단하는 기준 : 사람의 긍정적인 면을 보고 긍정적으로 수용해 줌<BR><BR>
타인에게 영향을 주는 점 : 개인적인 관계; “오는 사람을 거절하지 않는” 방침<BR><BR>
조직에의 공헌 : 안정되어 있고 행동을 예측할 수 있다; 대인관계의 폭이 넓다; 다름 사람의 마음을 잘 이해한다.<BR><BR>
지나친 점 : 지나치게 관대하다; 간접적인 방법을 취한다.<BR><BR>
압력 아래서 : 지나치게 격의 없고 융통적으로 된다; 사람을 구분하지 않고 누구나 지나치게 신뢰한다.<BR><BR>
두려움 : 다름 사람에게 압력을 주는 것; 해를 끼쳤다고 비난받는 것.<BR><BR>
효과 증진책 : 현실적인 기한을 설정한다; 주도적으로 과제를 수행한다.<BR><BR>
<BR><BR>
카운셀러형은 인간관계에서 발생하는 문제해결에 특히 능숙하다. 온화하며 동정심과 이해심이 많다는 인상을 준다. 다름 사람을 대할 때, 장기적으로 친밀한 관계를 유지하고 싶어 한다. 이러한 접근은 무기력한 사람들에게 효과적이다. 문제에 귀를 기울이며, 소극적인 제안을 하고, 남에게 자신의 의견을 강요하지 않는다. 지나치게 너그럽기 때문에 비생산적인 사람을 참아주는 경향이 너무 많다. 그러나 압력을 받는 경우에는 어려움을 겪기도 한다. 명령이나 요구를 할 때 또는 다른 사람을 야단칠 때 강경한 방법을 거의 사용하지 않는다. “사람이 중요하다” 태도를 지니고 있기 때문에, 업무수행에는 그다지 중점을 두지 않는다. 때로 현실적인 기한을 설정하고 기한 내에 목표를 달성하기 위해 도움을 필요로 한다.<BR><BR>
<BR><BR>
비판을 받으면 모욕을 당했다고 생각하기도 하지만, 대개는 이을 완료한 후에 그 일에 주목이나 찬사 받는  것에 더 관심이 많다. 책임져야 할 위치에 있을 때 타인에게 좋은 작업조건과 구성원들을 인정하려고 노력한다.<BR><BR>

    														</div>
    														
    														<div id="설득형" name="설득형" style="display:none;"><B>▶ 설득형(persuader)  ================</B> 
<BR><BR><BR><BR>
정서 : 사람을 신뢰한다; 열정적이다.<BR><BR>
목표 : 권위와 명성; 지위를 보여줄 수 있는 다양한 상징<BR><BR>
타인을 판단하는 기준 : 언어 표현 능력; 융통성<BR><BR>
타인에게 영향을 주는 점 : 우호적이고 솔직한 태도; 뛰어난 언변<BR><BR>
조직에의 공헌 : 설득을 잘한다. 다른 사람에게 결론을 잘 이끌어 낸다; 책임을 위임한다; 침착하고 자신감이 있다.<BR><BR>
지나친 점 : 지나치게 열정적이고 낙관적이다; 지나치게 설득하려 한다;<BR><BR>
압력 아래서 : 마음이 약해지면서 쉽게 설득 당한다; 좋은 인상을 주고자 할 때는 일을 짜임새 있게 처리한다.<BR><BR>
두려움 : 변화가 없는 환경; 복잡한 관계<BR><BR>
효과 증진책 : 어려운 과제를 수행한다; 업무를 완성하는 데 필요한 중<BR><BR>
<BR><BR>
설득형은 사람들과 같이 혹인 사람들을 통해 일을 한다. 즉, 우호적으로 일을 하면서 동시에 목적을 달성하려고 목적을 달성하려고 적극적으로 노력한다. 적극적으로 사람을 사귀고 여러 유형의 사람들로부터 존경과 신뢰를 얻을 수 있는 능력이 있다. 이 능력은 특히 권위적 위치를 얻고자 할 때 효과적이다.<BR><BR>
<BR><BR>
사람들과 함께 일하고, 도전이 있고, 변화가 풍부하며, 활동적으로 업무를 추진할 수 있는 상황이 이 유형에게 가장 좋은 환경으로 나타난다. 그러나 업무의 결과와 사람들의 잠재력에 대해 지나치게 낙관적으로 생하는 경향이 있다. 또한 자신의 설득력을 과대평가하기도 한다.<BR><BR>
<BR><BR>
반복적이거나 조직화된 일을 피하고 싶어 하는 반면에, 체계적인 분석 자료를 원한다. 세부적인 일에 주목하며 적절한 정보를 얻어갈 때 충동적 행동을 억제할 수 있을 것이다.<BR><BR>

    														</div>
    														
    														<div id="평가자형" name="평가자형" style="display:none;"><B>▶ 평가자형(appraiser)  ================ </B> 
<BR><BR><BR><BR>
정서 : 다른 사람에게 잘 보이려는 욕구가 강하다.<BR><BR>
목표 : 재능있게 일을 수행하여 이기는 것<BR><BR>
타인을 판단하는 기준 : 행동을 선도하는 능력<BR><BR>
타인에게 영향을 주는 점 : 강한 경쟁심<BR><BR>
조직에의 공헌 : 사람을 설득하고 격려하여 목표를 달성한다.<BR><BR>
지나친 점 : 권위나 지위를 간접적으로 사용한다.<BR><BR>
압력 아래서 : 침착성을 잃고, 비판적으로 사용한다.<BR><BR>
두려움 : 패배하는 것, 다른 사람에게 나쁘게 보이는 것<BR><BR>
효과 증진책 : 맡은 일을 직접 끝까지 완수한다; 다른 사람에게 불만을 표현할 때도 그 사람의감정과 생각을 살핀다; 일의 속도를 조절한다.<BR><BR>
<BR><BR>
평가자형은 창의적인 아이디어를 실전에 응용한다. 경쟁심이 강하고 목적을 달성하기 위해서는 직접적인 방법을 사용한다. 그러나 이 유형은 대개 사람들에게 신경을 써주기 때문에, 사람들은 이 유형을 공격적이라기보다는 적극적이라고 보는 경향이 있다. 이들은 다란 사람에게 명령이나 지시를 하기보다는 설득을 하여 일에 몰두하도록 한다. 자신이 제안한 일의 근본적인 이유를 설명하여 주변 사람들의 협력을 이끌어 낸다.<BR><BR> 
<BR><BR>
목표를 달성하는 데 필요한 과정을 사람들이 알기 쉽도록 설명해 준다. 보통 자신이 설정한 계획에 따라 일하는 것을 좋아한다. 그러나 이기는 것에 너무 집착한 나머지, 일이 생각만큼 진척되지 않거나 예상 밖의 수정을 해야 하는 경우, 인내심을 상실해 버리기도 한다.<BR><BR>
<BR><BR>
또한 분석력이 뛰어나고 서슴없이 비판도 한다. 때로는 신랄한 표현을 쓰기도 한다. 좀 더 느긋하게 자신의 페이스를 조정한다면, 상황을 좀 더 효과적으로 관리할 수 있다. 이들에게 도움이 되는 격언이 있다. “당신이 이기는 사람이 있으면, 당신을 이기는 사람도 있다.”<BR><BR>

    														</div>
    														
    														<div id="전문가형" name="전문가형" style="display:none;"><B>▶ 전문가형(spectialist)  ================</B> 
<BR><BR><BR><BR>
정서 : 온화하고, 협조적이다.<BR><BR>
목표 : 현상유지; 질서있는 환경<BR><BR>
타인을 판단하는 기준 : 일차적으로 우정을, 그 다음으로 능력을 고려한다.<BR><BR>
타인에게 영향을 주는 점 : 업무수행 행동의 일관성; 다른 사람과 조화<BR><BR>
조직에의 공헌 : 단기 계획에 능하다. 예측 가능하고 일관성이 있다; 일정한 페이스를 유지한다.<BR><BR>
지나친 점 : 겸손, 위험 회피; 혁신에 소극적으로 저항한다.<BR><BR>
압력 아래서 : 권력자나 그룹의 생각에 따른다.<BR><BR>
두려움 : 변화, 혼란한 상황<BR><BR>
효과 증진책 : 자신의 견해나 생각을 다른 사람과 함께 나눈다; 일의 결과의 피드백에 대하여 자신감을 갖는다; 업무처리에 빠른 지름길을 찾는다.<BR><BR>
<BR><BR>
전문가형은 다른 사람들과 쉽게 친해지며, 그 관계가 오래 지속된다. 온화하고, 자제력이 있으며, 겸손하기 때문에 많은 유형의 사람들과 함께 효과적으로 일을 할 수 있다. 사려가 깊고, 인내심이 강하며, 친구라고 여기는 사람에게는 기꺼이 도움을 준다. 실제로 직장에서도 몇몇 동료와 긴밀한 관계를 유지한기도 한다.<BR><BR>
<BR><BR>
익숙하고 예측 가능한 환경을 유지하려고 노력한다. 전문화된 영역에서 가장 효율적으로 일한다. 정해진 경로를 따라 작업을 계획하며, 업무 수준에 상당히 일관성 있다. 주변에서 그러한 업무 수준을 계속해서 인정해 준다면, 업무 수준을 일정하게 유지할 수 있다.<BR><BR>
<BR><BR>
변화에 적응하는 데 시간이 걸린다. 따라서 미리 적응할 시간을 주면, 자신의 방법을 변화시켜 일정한 업무 수준을 유지할 수 있다. 새로운 업무를 시작하고, 기일에 맞출 수 있는 단기적인 방법을 개발하려면 도움이 필요하다. 다 끝난 업무도 나중에 다시 마무리 짓겠다는 생각에서 한 쪽에 쌓아 높기도 한다. “파일 캐비넷에 있는 낡은 파일은 모두 버려라” 는 충고를 듣도록 한다.

    														</div>
    														
    														<div id="성취자형" name="성취자형" style="display:none;"><B>▶ 성취자형(achiever)  ================</B> 
<BR><BR><BR><BR>
정서 : 의욕적이고 근연하다; 계획한 일을 끝내지 못하면 좌절감을 나타낸다.<BR><BR>
목표 : 개인적 목표가 뚜렷하다. 따라서 조직의 목표가 개인적 목표와 일치하지 않을 때는 개인적 목표를 위해 조직을 떠나기도 한다.<BR><BR>
타인을 판단하는 기준 : 구체적 성과<BR><BR>
타인에게 영향을 주는 점 : 자신의 일에 책임을 진다.<BR><BR>
조직에의 공헌 : 중요한 성과를 가져 올 수 있는 목표를 설정하여 달성한다.<BR><BR>
지나친 점 : 지나치게 자기 의욕적이다; 일에 몰두한다.<BR><BR>
압력 아래서 : 욕구불만이 되기도 하고, 참을성이 없어진다; 일을 남에게 맡기기보다는 자신이 직접 하게 된다.<BR><BR>
두려움 : 다른 사람의 업무 수준이 낮을까봐 두려워한다. 다른 사람과 경쟁한다.<BR><BR>
효과 증진책 : 이것 아니면 저것이라는 양자 택일식 사고 방식을 줄인다; 과제의 우선 순위를 명확하게 하고 대체안을 찾는다.<BR><BR>
<BR><BR>
성취자형은 대개 자신의 절실한 개인적 목표로부터 동기가 유발된다. 따라서 개인적 목표를 우선적으로 생각하기 때문에 그룹의 목표를 무조건적으로 받아들이지는 않는다. 삶의 방향이 분명하고 일에 대한 책임감이 강하다. 또한 일에 강한 흥미를 갖고 있으며, 목표 달성을 위해 계속해서 열심히 노력한다. 이 유형은 자신의 업무를 높게 평가하며, 업무를 올바로 처리하기 위해 직접 그 업무를 처리한다. 일을 다른 사람에 위임하기 보다는 직접 처리한다. 즉, 일을 다른 사람에게 위임하더라도 결과가 만족스럽지 않다면, 그 일을 다시 맡아 처리한다.<BR><BR>
<BR><BR>
이들의 일차적 전제는 “성공한다면 인정을 바라지만, 실패한다면 책임을 진다.”는 것이다. 다른 사람들과의 커뮤니케이션을 증가시키면, “내가 직접 하지 않으면 안된다” 라든가 “공격을 전부 내 것으로 하고 싶다”는 식의 양자 택일식 사로방식을 줄일 수 있다.<BR><BR>
<BR><BR>
성취자형은 자신이 능력을 최대로 발휘하여 일한다는 것을 알고 있으며, 기여한 만큼 인정을 받고 싶어 한다. 기업체인 경우에는 높은 임금을, 기타의 조직인 경우에는 지도자의 지위를 원한다.<BR><BR>

    														</div>
    														
    														<div id="중개자형" name="중개자형" style="display:none;"><B>▶ 중개자형(agent)   ================</B> 
<BR><BR><BR><BR>
정서 : 타인의 호의를 잘 받아 들인다; 타인의 적대적 행위를 거부한다.<BR><BR>
목표 : 타인에게 받아 들여지는 것<BR><BR>
타인을 판단하는 기준 : 관대함과 포용력<BR><BR>
타인에게 영향을 주는 점 : 타인에 대한 이해; 우정<BR><BR>
조직에의 공헌 : 동료나 부하에게 도움이 되는 환경을 조성한다. 타인의 감정과 생각을 이해한다. 업무환경을 조화롭게 만든다; 봉사 정신이 투철하다.<BR><BR>
지나친 점 : 친절<BR><BR>
압력 아래서 : 필요하다면 사실에 입각한 정보나 친분을 이용하여 타인을 설득한다.<BR><BR>
두려움 : 의견차이; 갈등<BR><BR>
효과 증진책 : 자신의 장점과 능력을 인식한다; 결단력과 자기주장; 필요한 때 “아니오”라고 말한다.<BR><BR>
<BR><BR>
중개자형은 업무 상황에서 인간관계 및 업무 양쪽에 관심을 갖는다. 다름 사람의 마음을 잘 이해하고 도움을 주며. 타인의 말을 주의 깊게 듣는다. 이 유형은 타인의 호의를 잘 받아 주기 때문에, 사람들은 이 유형과 함께 있을 때, 자신이 필요한 사람이라고 느끼게 된다. 중개자형은 남을 도우려 한다.<BR><BR>
<BR><BR>
업무를 조직하고 승인된 양식에 따라 처리하는 능력이 탁월하다. 중개자형은 다름 사람이 처리하기 어려워하는 일도 끝까지 완수하는 능력이 뛰어나다.<BR><BR>
<BR><BR>
그러나 타인과의 갈등이나 의견 차이를 두려워한다. 문제의 적극적 해결을 도모하기보다는 참고 단념한다. 공개적인 사람과는 정면으로 대결하기보다는 피하거나 그 사람에 맞추는 경향이 있다. 이 유형은 항상 어떻게 하면 그룹 속에서 조화를 이룰 수 있는가에 관심을 가지면서도 상당한 독립심이 있다.<BR><BR> 

    														</div>
    														
    														<div id="탐구자형" name="탐구자형" style="display:none;"><B>▶ 탐구자형(investigator)  ================ </B> 
<BR><BR><BR><BR>
정서 : 침착하다, 자제력이 있다.<BR><BR>
목표 : 공식적인 지위에서 비롯되는 권력; 지위와 권한<BR><BR>
타인을 판단하는 기준 : 사실적인 정보의 사용<BR><BR>
타인에게 영향을 주는 점 : 의지가 강하고 끈기가 있다.<BR><BR>
조직에의 공헌 : 철저하다, 세부적인 사항에 관심을 갖는다; 단독으로 혹은 소그룹에서 일할 때 뛰어난 능력을 발휘한다.<BR><BR> 
지나친 점 : 무뚝뚝하다; 다른 사람을 의심한다.<BR><BR>
압력 아래서 : 갈등의 원인을 자신의 탓으로 돌리는 경향이 있다; 상처받은 일을 언제까지나 생각한다.<BR><BR>
두려움 : 많은 사람들과 관련되는 것; 추상적이고 관념적인 생각을 설명하는 것<BR><BR>
효과 증진책 : 융통성을 갖는다; 다름 사람을 받아들인다; 다른 사람과 적극적인 관계를 맺는다.<BR><BR>

탐구자형은 객관적이고 분석적이며, 침착하다. 대개 감정을 표면에 나타내지 않고, 설정된 목표를 조용히, 꾸준히, 독자적으로 추진해 간다. 탐구자형은 많은 일을 성공적으로 수행한다. 이것은 능력이 많기 때문이라기보다는 결단력이 강하기 때문이다. 한번 일을 시작하면 목적을 달성하기 위해 결사적으로 노력한다. 따라서 그들의 방향을 바꾸려면, 강제력이 필요하기도 하다. 고집스럽고 자신의 주장을 굽히지 않는다.<BR><BR> 

전문적인 특성을 갖는 어려운 과제를 잘 수행하고, 가정보다 이론을 중시한다. 아이디어를 내놓을 때도 그 아이디어의 구체덕인 산물이 있는 경우 성과가 특히 좋다. 사실에  기초한 자료를 활용해서 정보를 분석하고 결론을 내릴 수 있다. <BR><BR>

혼자 일하는 것을 좋아하고, 다른 사람을 즐겁게 해 주는 데에는 그다지 관심이 없다. 따라서 냉정하고 붙임성이 없으며 사교적이지 못한 사람으로 보이기도 한다. 체계적인 접근을 통해 다른 사람을 보다 이해하기 위한 노력이 필요하다.<BR><BR>

    														</div>
    														
    														<div id="객관주의형" name="객관주의형" style="display:none;"><B>▶ 객관주의형(objective thinker)  ================</B> 
<BR><BR><BR><BR>
정서 : 다른 사람을 공격하거나 공격당하지 않으려 한다.<BR><BR>
목표 : 정확성<BR><BR>
타인을 판단하는 기준 : 논리적으로 생각하는 능력<BR><BR>
타인에게 영향을 주는 점 : 사실에 기초한 자료, 논리적인 주장.<BR><BR>
조직에의 공헌 : 용어, 이슈, 절차, 상황등의 의미를 명확히 정의한다; 정보를 수집한다; 자신 및 다른 사람의 업무 수행을 평가하고 분석한다.<BR><BR>
지나친 점 : 지나치게 분석적이다.<BR><BR>
압력 아래서 : 걱정이 많아진다.<BR><BR>
두려움 : 자신 및 다른 사람의 불합리한 행동; 다른 사람에게 조롱받는 것<BR><BR>
효과 증진책 : 자신을 드러낸다; 감정을 억누르지 않는다; 자신의 의견과 생각을 다른 사람들에게 공개적으로 말한다.<BR><BR>
<BR><BR>
<BR><BR>
객관주의형은 분석 능력이 상당히 뛰어나다. 사실적인 자료를 토대로 결론을 이끌어 내고 행동하는 것을 매우 중요하게 상각한다. 그러나 직관적인 정보와 객관적인 자료를 결합하여 가장 효과적으로 일을 처리하기도 한다. 만일 어떤 일의 과정을 잘 모른다면, 비난을 피하기 위하여 철저한 준비를 한다. 즉, 먼저 독자적으로 기술이나 지식을 연마한 후 그룹 활동에 참가한다.<BR><BR>
<BR><BR>
자신처럼 온화한 환경 속에서 보다 효과적으로 일하는 사람을 선택하고 싶어 한다. 감정을 잘 표현하기 않기 때문에 수줍음을 타는 것처럼 보이기도 한다.<BR><BR>
<BR><BR>
이들은 특히 공격적인 사람을 싫어한다. “옳은” 답을 얻으려고 하기 때문에 애매한 상황에서 의사 결정에 지장을 겪는 경우도 있다. 자신이 실수를 하면, 많은 경우 그 실수를 인정하기보다는 자신의 입장을 옹호해 줄 수 있는 자료를 찾으려고 한다.<BR><BR>

    														</div>
    														
    														<div id="완벽주의형" name="완벽주의형" style="display:none;"><B>▶ 완벽주의형(perfectionist)  ================</B> 
<BR><BR><BR><BR>
정서 : 일을 정확히 처리하는 능력이 있다; 자재력이 있다; 신중하다.<BR><BR>
목표 : 안정되고 예측 가능한 결과 성취<BR><BR>
타인을 판단하는 기준 : 엄격한 기준<BR><BR>
타인에게 영향을 주는 점 : 세부적인 사항에 대한 관심, 일을 정확히 처리하려는 노력<BR><BR>
조직에의 공헌 : 양심적이다; 계속적인 평가를 통ㅎ 기준을 유지한다; 품질관리<BR><BR>
지나친 점 : 실패를 피하기 위해 규정된 절차를 지나치게 엄격히 고수한다; 과거에 알았던 사람이나 사용했던 제품이나 과정에 너무 의존한다.<BR><BR>
압력 아래서 : 빈틈이 없고 외교적 수완을 발휘한다.<BR><BR>
두려움 : 다른 사람과의 적대적인 관계<BR><BR>
효과 증진책 : 역할에 융통성을 갖는다; 독립성과 상호의존성을 갖는다; 자신을 가치있는 사람이라고 믿는다.<BR><BR>
<BR><BR>
<BR><BR>
완벽주의형은 대체적으로 체계적이고 정확하게 생각하며 일한다. 따라서 개인적으로나 업무에서나 정해진 순서를 따르는 경향이 있다; 고지식하며, 세말함과 정확성을 요하는 일을 끝까지 처리한다. 구체적인 사항들 즉, 예상되는 결과가 무엇이며, 시간이 얼마나 소요되는지, 그리고 작업을 어떻게 평가할 것인지 알고자 한다.<BR><BR>
<BR><BR>
중요한 결정을 내릴 수 있지만, 결정을 짓는 과정에서 세세한 것에 너무 얽매인다. 상사의 의견을 듣고 싶어 하지만, 자신이 구체적인 사실을 가지고 있고 결론을 해석하고 이끌어 낼 수 있을 때 위험에 직면하는 용기도 있다.<BR><BR>
<BR><BR>
안전을 보장받고 싶어하며, 개인적으로 주목받기를 원한다. 어릴 때부터 자신의 가치보다는 일을 얼마나 잘하는가로 칭찬받아 왔다. 따라서 사람들이 칭찬을 하면 “이 사람이 나에게 무엇을 원하는가”라는 식으로 생각하는 경향이 있다. 자신의 가치를 진지하게 받아 들인다면, 자신감을 증가시킬 수 있다.<BR><BR>

    														</div>
    														
    														<div id="실천형" name="실천형" style="display:none;"><B>▶ 실천형(practitioner)  ================</B> 
<BR><BR><BR><BR>
정서 : 노력과 전문적인 업무수행 면에서 다른 사람에게 뒤지지 않으려 한다.<BR><BR>
목표 : 자신의 개인적 발전에 대한 강한 욕구<BR><BR>
타인을 판단하는 기준 : 엄격한 자기관리, 자제력; 지위와 자기 향상<BR><BR>
타인에게 영향을 주는 점 : 새로운 기술을 향상시키는 능력과 자신감; 올바른 절차 및 활동을 개발하고 따른다.<BR><BR>
조직에의 공헌 : 업무나 사람들간의 관계에서 발생하는 문제를 능숙하게 해결한다; 전문성이 있는 일에 능하다.<BR><BR>
지나친 점 : 지나치게 자신의 목표를 생각 한다; 다른 사람에게 다소 비현실적인 기대를 한다.<BR><BR>
압력 아래서 : 감정을 억제한다; 비판에 민감해진다.<BR><BR>
두려움 : 다른 사람들이 자신을 너무 쉽게 예측하는 것; 중요한 존재로 인정받지 못하는 것<BR><BR>
효과 증진책 : 공동의 이익을 위해 성의있게 협력한다; 중요한 임무를 적절한 사람에게 위임한다.<BR><BR>
<BR><BR>
실천형은 한 가지 분야에 정통하고자 한다. 어떤 일에서 뛰어나고자 하는 욕구가 강하기 때문에 자신의 업무 능력을 주의 깊게 체크한다. 한 가지 분야에서 일인자가 되는 것이 목표이지만, 다양한 분야에서 지식이 있다는 인상을 준다. 특히 자신의 폭넓은 지식을 피력할 때, 이런 인상을 강하게 한다.<BR><BR>
<BR><BR>
다른 사람과 교제할 때는 상냥하고 편안한 인상을 준다. 그러나 이런 인상은 자신의 업무 영역에서는 즉각 변하는 경향이 있다. 즉, 자신의 일이 최고 수준이라는 평가를 받으려고 일에 몰두한다. 자신 및 타인에 대해 높은 기대를 하며, 실망을 감추지 않고 표현하다.<BR><BR>
<BR><BR>
일의 절차와 자신의 기술 향상에도 협조할 필요가 있다. 또한 다른 사람이 자신이 원하는 대로 일을 처리하지 않더라도 이들의 노력을 인정해 주어야 한다.<BR><BR>

    														</div>
    														
    														<div id="오버쉬프트형" name="오버쉬프트형" style="display:none;"><B>▶ 오버쉬프트형(overshift)  ================</B> 
<BR><BR>
분석을 하기 전에 그래프를 다시 살펴보고, 점수를 계산할 때 틀린 것이 없는지 확인하라. 오버쉬프트형은 4개의 점이 모두 그래프의 위쪽에 위치할 때 나타난다.<BR><BR> 
<BR><BR>
이것은 네가지 행동 경향이 모두 중요하다고 생각하고 있음을 나타낸다. 그 결과 그래프의 모양이 전형적 행동유형에서 공통적으로 나타나는 것과도 일치되지 않는다.<BR><BR>
<BR><BR>
전형적 행동유형은 높은점과  낮은점의 조합을 나타내고 있으나, 오버쉬프트형은 4개의 점이 모두 높게 나타난 것이다. 그래프Ⅲ이 오버쉬프트형이라면 이는 그래프Ⅰ 또는 그래프Ⅱ중 하나를 가지고 해석하는 것이 좋다. 또한 초점을 명료화한 뒤 다시 측정하는 것이 더욱 좋다.

    														</div>
    														
    														<div id="언더쉬프트형" name="언더쉬프트형" style="display:none;"><B>▶ 언더쉬프트형(undershift)  ================</B> 
<BR><BR>
분석을 하기 전에 그래프를 다시 살펴보고 점수를 계산할 때 틀린 것이 없는지 확인하라. 언더쉬프트형은 4개의 점이 모두 그래프 아래쪽에 위치할 때 나타난다.<BR><BR> 
<BR><BR>
이것은 네가지 행동경향이 모두 중요하지 않다고 생각하고 있음을 나타낸다. 어떤 것과도 일치하지 않는다.<BR><BR>
<BR><BR>
전형적 행동유형은 높은점과 낮은점의 조합을 나타내고 있으나 언더쉬프트형은 4개의 점이 모두 낮게 나타난 것이다. 그래프Ⅲ이 언더쉬프트형이라면 그래프Ⅰ 또는 그래프Ⅱ중 하나를 가지고 해석하는 것이 좋다. 또한 초점을 명료화한 뒤 다시 측정하는 것이 더욱 좋다.<BR><BR>
<BR><BR>
탐구자형은 객관적이고 분석적이며, 침착하다. 대개 감정을 표면에 나타내지 않고, 설정된 목표를 조용히, 꾸준히, 독자적으로 추진해 간다. 탐구자형은 많은 일을 성공적으로 수행한다. 이것은 능력이 많기 때문이라기보다는 결단력이 강하기 때문이다. 한번 일을 시작하면 목적을 달성하기 위해 결사적으로 노력한다. 따라서 그들의 방향을 바꾸려면, 강제력이 필요하기도 하다. 고집스럽고 자신의 주장을 굽히지 않는다.<BR><BR> 
<BR><BR>
전문적인 특성을 갖는 어려운 과제를 잘 수행하고, 가정보다 이론을 중시한다. 아이디어를 내놓을 때도 그 아이디어의 구체덕인 산물이 있는 경우 성과가 특히 좋다. 사실에  기초한 자료를 활용해서 정보를 분석하고 결론을 내릴 수 있다. <BR><BR>
<BR><BR>
혼자 일하는 것을 좋아하고, 다른 사람을 즐겁게 해 주는 데에는 그다지 관심이 없다. 따라서 냉정하고 붙임성이 없으며 사교적이지 못한 사람으로 보이기도 한다. 체계적인 접근을 통해 다른 사람을 보다 이해하기 위한 노력이 필요하다.<BR><BR>

    														</div>
    														
    														<div id="중간형" name="중간형" style="display:none;"><B>▶ 중간형(tight)   ================</B> 
<BR><BR>
분석을 하기 전에 그래프를 다시 살펴보고 점수를 계산할 때 틀린 것이 없는지 확인하라. 중간형은 네게의 점이 모두 한 구분란에서 중간지점에 위치할 때 나타난다.<BR><BR>
<BR><BR>
이것은 네 가지 행동 경향이 동일하게 중요하다고 생각하고 있음을 나타낸다. 그 결과 그래프 모양이 전형적 행동유형에서 공통적으로 나타나는 어떤 것과도 일치 되지 않는다.<BR><BR>
<BR><BR>
전형적 행동유형은 높은점과 낮은점의 조합을 나타내고 있으나 중간형은 4개의 점이 모두 중간영역에 위치한 것이다. 그래프Ⅲ이 중간형이라면 그래프Ⅰ 또는 그래프Ⅱ중 하나를 가지고 해석하는 것이 좋다. 또한 초점을 명료화 한 후 다시 측정하는 것이 더욱 좋다.<BR><BR> 

    														</div>
    													</td>
    												</tr>
    												<tr>
    													<td colspan=2 style="margin:0;padding:0;"><img class="disc_img" id="type_g1_img" name="type_g1_img"></img></td>
    													<td colspan=2 style="margin:0;padding:0;"><img class="disc_img" id="type_g2_img" name="type_g2_img"></img></td>
    													<td colspan=2 style="margin:0;padding:0;"><img class="disc_img" id="type_g3_img" name="type_g3_img"></img></td>
    													
    												</tr>
                									<tr>
                										<td colspan=2><label style="line-height: 35px;" id="group_g1" name="group_g1"></label></td>
                										<td colspan=2><label style="line-height: 35px;" id="group_g2" name="group_g2"></label></td>
                										<td colspan=2><label style="line-height: 35px;" id="group_g3" name="group_g3"></label></td>
                									</tr>
    											</table>
    										
    										</td>
    									</tr>
										<tr style="background:#90daff29;">
											<td>평가자</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="eval_userid" name="eval_userid"></label>
											</td>
											<td>면접일</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="interview_date" name="interview_date"></label>
											</td>
										</tr>
										<tr>
											<td>최종학력</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="final_edu" name="final_edu"></label>
											</td>
											<td>최종학교명</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="final_school" name="final_school"></label>
											</td>
										</tr>
										<tr style="background:#90daff29;">
											<td>인상</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="impression" name="impression"></label>
											</td>
											<td>근무 의욕</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="desire" name="desire"></label>
											</td>
										</tr>
										<tr>
											<td>전문 지식</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="knowledge" name="knowledge"></label>
											</td>
											<td>업무 능력</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="ability" name="ability"></label>
											</td>
										</tr>
										<tr style="background:#90daff29;">
											<td>건강 상태</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="physical" name="physical"></label>
											</td>
											<td>종합 평가</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="total_eval" name="total_eval"></label>
											</td>
										</tr>
										<tr>
											<td>희망 연봉</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="hope_money" name="hope_money"></label>&nbsp;&nbsp;
												<label class="disc_text" id="include_sev" name="include_sev"></label>
											</td>
											<td>면접보고(알림톡)</td>
											<td colspan=6 style="text-align: left;">
												<label class="disc_text" id="interview_report" name="interview_report"></label>
											</td>
										</tr>
										<tr style="background:#90daff29;">
											<td>면접 의견</td>
											<td colspan=13 style="text-align: left;">
												<label class="disc_text" id="interview_comment" name="interview_comment"></label>
											</td>
										</tr>
										<tr>
											<td>첨부 파일</td>
											<td colspan=13 style="text-align: left;">
												<label style="text-align: left;" class="disc_file" id="file_view_str" name="file_view_str"></label>

											</td>
										</tr>
    									

										
									</tbody>
								</table>
							</div>
						</div>
						<div class="btn w100" style="margin:5px 0 5px; text-align:right;">
        					<button name="action2" id="action2" >수정</button>
        					<button name="list2" id="list2">목록</button>
        				</div>


						<div class="dashcon">
							<div class="dashboard">
								<table >
									<tbody style="text-align: center;">
										<TR class="tr_color" style="background:#90daff29;height:100px;">
												<TH>진행상태</TH>
												<TD>
												
													<div class="selectbox w50">
														<label for="">선택</label>
														<select name="progress_c" id ="progress_c" class="w50" >
														<option value="H2011">접수</option>
														<option value="H2012">면접</option>
														<option value="H2013">불합격</option>
														<option value="H2014">예비합격</option>
														<option value="H2015">최종합격</option>
														<option value="H2016">근무중</option>
														<option value="H2017">퇴사</option>
													</select>
													</div>
												
												</TD>
												<TH>수신참조</TH>
												<TD>
													<div class="selectbox w50">
														<label for="">선택</label>
														<select style="width:300px;height:35px;" id="reception_c" name="reception_c" >
														<option value="" >선택</option>
														<option value="D2001" >CH</option>
														<option value="D2002" >대표이사</option>
														<option value="D2010" >세무본부장</option>
														<option value="D2005" >지점장</option>
													</select>
													</div>
													<div class="selectbox w50" id="sel_branch" style="display: none;">
                										<label for="">선택</label>
                										<select name="reg_branch" id ="reg_branch" class="w50" >
                										<option selected value="">선택</option>
                										<option value="D1003">강남</option>
                										<option value="D1004">용인</option>
                										<option value="D1006">안양</option>
                										<option value="D1007">수원</option>
                										<option value="D1008">일산</option>
                										<option value="D1009">부천</option>
                										<option value="D1010">광주</option>
                										<option value="D1011">분당</option>
                										<option value="D1012">기흥</option>
                									</select>
                									</div>
												</TD>
											</TR>
											
											<TR class="tr_color" style="">
												<TH rowspan=2>검토의견</TH>
												<TD colspan=3>
													<span style="padding:10px; padding-top:43px; font-size:17px;margin-left:-450px;" ><b><?=$username?></b></span>
													<input type="box" class="w50" name="comment" id="comment" style="height:40px;" >
													<button name="reg_comment" id="reg_comment" style="width:80px;border: 1px solid #fff;background: #444;height: 40px;padding: 10px 15px;letter-spacing: 0.5px;margin: 0 3px 0;color:white;" >등록</button>
												</TD>
											</TR>
											<TR class="tr_color" style="">
												<TD colspan=3 style="padding: 0; margin:0;">
													<div class="board" style="width:100%;">
									
														<table style="width:100%;">
															<tbody id="result_cmt"  >
															<colgroup>
																<col width="50px">
																<col width="200px">
															</colgroup>
															</tbody>
														</table>
													</div>
												</TD>
											</TR>
										</tbody>
									</table>
								</div>
							</div>

            				
						</div>





					</div>
				</div>
			</div>
		</div>
		<br>

		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>
	<input type="hidden" id="tmp_biz_id" name="tmp_biz_id"></input>
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




$(document).ready(function(){


fetchUser();
fetchUser2();
fetchUserC();

function fetchUser()
{

	var action = "select_view_disc";
	var request = new Request();
	var id = request.getParameter("id");
	var step;

	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:"json",
		success:function(data)
		{
			console.log(data.length);
			$('#username').html(data[0].USERNAME);
			$('#mobile').html(data[0].MOBILE);
			$('#branch').html(data[0].BRANCH_);
			if(data[0].CAR_YEAR != null && data[0].CAR_YEAR != 0)
				$('#car_year').html(data[0].CAR_YEAR + "&nbsp;년&nbsp;&nbsp;");

			if(data[0].CAR_MONTH != null && data[0].CAR_MONTH != 0)
				$('#car_month').html(data[0].CAR_MONTH+ "&nbsp;개월");

			if(data[0].TOTAL_CAR_YEAR != null && data[0].TOTAL_CAR_YEAR != 0)
				$('#total_car_year').html(data[0].TOTAL_CAR_YEAR + "&nbsp;년&nbsp;&nbsp;");

			if(data[0].TOTAL_CAR_MONTH != null && data[0].TOTAL_CAR_MONTH != 0)
				$('#total_car_month').html(data[0].TOTAL_CAR_MONTH+ "&nbsp;개월");
			
			if(data[0].NEW_BEGIN == "Y")
				$('#new_begin').html("신입");			
			
			if(data[0].TOTAL_NEW_BEGIN == "Y")
				$('#total_new_begin').html("신입");			
			
			$('#eval_userid').html(data[0].EVAL_USERID_);
			$('#interview_date').html(data[0].INTERVIEW_DATE_);
			$('#final_edu').html(data[0].FINAL_EDU_);
			$('#final_school').html(data[0].FINAL_SCHOOL);
			$('#impression').html(data[0].IMPRESSION_);
			$('#desire').html(data[0].DESIRE_);
			$('#knowledge').html(data[0].KNOWLEDGE_);
			$('#ability').html(data[0].ABILITY_);
			$('#physical').html(data[0].PHYSICAL_);
			$('#total_eval').html(data[0].TOTAL_EVAL_);
			if(data[0].HOPE_MONEY != null && data[0].HOPE_MONEY != 0)
				$('#hope_money').html(data[0].HOPE_MONEY + "&nbsp;만원");
			$('#interview_report').html(data[0].INTERVIEW_REPORT_);
			$('#interview_comment').html(data[0].INTERVIEW_COMMENT);
			$('#progress_c').val(data[0].PROGRESS);
			$('#reception').html(data[0].RECEPTION);

			if(data[0].BIRTH != null && data[0].BIRTH != "0000-00-00")
				$('#birth').html(data[0].BIRTH);

			if(data[0].AGE != null && data[0].AGE != 0)
				$('#age').html("/&nbsp;&nbsp;"+data[0].AGE);
			//$('#hope_money').html(data[0].HOPE_MONEY+"만원");
			if(data[0].INCLUDE_SEV == "Y")
				$('#include_sev').html("(퇴직금포함)");

			
			var mobile_ =  data[0].MOBILE.replace(/-/gi, "");
			var file_dir = "../FILE_SVR_1/disc/"+data[0].USERNAME+"_"+mobile_+"/";

			if(data[0].FILE_REAL_STR != "" && data[0].FILE_REAL_STR != undefined)
				var file_real_arr = data[0].FILE_REAL_STR.split("|");
			
			if(data[0].FILE_VIEW_STR != "" && data[0].FILE_VIEW_STR != undefined){
				var file_view_arr = data[0].FILE_VIEW_STR.split("|");
				for (var i=1;i<file_view_arr.length ;i++ )
				{

					$('#file_view_str').append ("<li><a href='javascript:down(\""+file_real_arr[i]+"\",\""+file_dir+"\");'>" +file_view_arr[i]+"</a></li>");
				}
			}



			

			var select = $('select');
		    for (var i = 0; i < select.length; i++) {
		        var idxData = select.eq(i).children('option:selected').text();
		        select.eq(i).siblings('label').text(idxData);
		    }
		    select.change(function () {
		        var select_name = $(this).children("option:selected").text();
		        $(this).siblings("label").text(select_name);
		    });
					

			
			
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}

	})
}



function fetchUser2()
{

	var action = "select_view_disc_ext2";
	var request = new Request();
	var id = request.getParameter("id");
	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,action:action},
		dataType:"json",
		success:function(data)
		{
			console.log();
			$('#type_g1').html(data.TYPE_G1);
			$('#type_g2').html(data.TYPE_G2);
			$('#type_g3').html(data.TYPE_G3);
			$('#group_g1').html(data.GROUP_G1);
			$('#group_g2').html(data.GROUP_G2);
			$('#group_g3').html(data.GROUP_G3);
			$('#type_g1_img').attr("src","images/disc/"+data.G1_IMAGE+".png");
			$('#type_g2_img').attr("src","images/disc/"+data.G2_IMAGE+".png");
			$('#type_g3_img').attr("src","images/disc/"+data.G3_IMAGE+".png");
			$('#'+data.TYPE_G3).css("display","");
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}




//코멘트등록
$('#reg_comment').click(function(){
	var request = new Request();
	var id = request.getParameter("id");
	var userid = "<?= $userid ?>";
	var comment = $('#comment').val();
	var b_flag = "E1009";

	if(confirm("댓글을 등록 하시겠습니까?"))
	{
	//구분자
		var action = "action_trans_insert_comment";
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id,action:action,comment:comment, userid:userid, b_flag:b_flag},
			success:function(data){
				//리스트 다시 조회
				//fetchUser();
				//alert(data);
				if(data=="success"){
					$('#comment').val("");
					fetchUser();
					fetchUserC();
					//send_kakao(comment);
				}
				//window.location.replace("list_trans.php");
				
			}
		});

		
	}else
	{
		return false;
	}

	
});

$('#progress_c').change(function(){
	var request = new Request();
	var id = request.getParameter("id");

	var action = "upt_disc_upt_prog";
	var userid = "<?php echo $userid;?>";
	var prog = $("#progress_c").val();

	$.ajax({
		url:"action.php",
		method:"POST",
		data:{action:action,id:id,prog:prog, userid:userid},
		success:function(data){
			console.log(data);
		}
	});
});



$('#sel_branch').change(function(){
	var request = new Request();
	var id = request.getParameter("id");
	var userid = "<?= $userid ?>";
	var add_member = $("#reg_branch").val();
	var action = "action_send_disc_add_member";
	var br_flag = "Y";

	if(confirm("수신참조 그룹에게 알림톡을 발송하시겠습니까?"))
	{
		if(add_member != ""){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"api/send_tok_v1.php", 
				method:"POST",
				data:{id:id,userid:userid,action:action,add_member:add_member, br_flag:br_flag},
				success:function(data){
					console.log(data);
					if(data.indexOf("전송완료")>-1){
						alert("수신참조 번호로 알림톡이 발송되었습니다.");
					}
				}
			});
		}
	}else{
		$("#sel_branch").val("");
	}

	
});




$('#reception_c').change(function(){
	var request = new Request();
	var id = request.getParameter("id");
	var userid = "<?= $userid ?>";
	var add_member = $("#reception_c").val();
	var action = "action_send_disc_add_member";

	if(add_member == 'D2005'){
		$('#sel_branch').css("display","");
		return false;
	}

	
	if(confirm("수신참조 그룹에게 알림톡을 발송하시겠습니까?"))
	{
		if(add_member != ""){

			$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"api/send_tok_v1.php", 
				method:"POST",
				data:{id:id,userid:userid,action:action,add_member:add_member},
				success:function(data){
					console.log(data);
					if(data.indexOf("전송완료")>-1){
						alert("수신참조 번호로 알림톡이 발송되었습니다.");
					}
				}
			});
		}
	}else{
		$("#reception_c").val("");
	}

	
});

    //[2] 추가 버튼 클릭했을 때 작동되는 함수
    $('#action1').click(function(){
	   	modify();
    });
    $('#action2').click(function(){
    	modify();
    });
   

    	//목록가기
    $('#list1').click(function(){
    	window.location.href="list_disc.php";
    });
    $('#list2').click(function(){
    	window.location.href="list_disc.php";
    });

    $('#print').click(function(){
    	var request = new Request();
    	var id = request.getParameter("id");
    	var url = "print_view_disc.php?id="+id;
    	window.open(url, "s", "width= 1440, height= 700, left=0, top=0, resizable=yes, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no").blur();
    	window.focus();
    });


    
});


function modify(){
	var request = new Request();
	var id = request.getParameter("id");
	window.location.href="mod_disc.php?id="+id;
}

function fetchUserC()
{

	var action = "select_comment";

	
	var request = new Request();
	var id = request.getParameter("id");
	var userid = "<?= $userid ?>";
	var b_flag = "E1009";
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id, action:action, userid:userid, b_flag:b_flag},
		success:function(data)
		{
			console.log(data);
			$('#result_cmt').html(data);

		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}

function del_cmt(id){
	var userid = "<?= $userid ?>";
	var action = "action_trans_del_comment";
	var request = new Request();
	var id = request.getParameter("id");
	
	if(confirm("댓글을 삭제 하시겠습니까?"))
	{
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id,action:action, userid:userid},
			success:function(data){
				//리스트 다시 조회
				//fetchUser();
				//alert(data);
				if(data=="success"){
					fetchUserC();
				}
				//window.location.replace("list_trans.php");
				
			}
		});

		
	}else
	{
		return false;
	}
}



function down(name,dir){
	window.open("down_trans.php?fileurl="+dir+"&filename="+name);
}




</script>
</html>


<?php 
}
?>