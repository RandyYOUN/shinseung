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
.disc_text{width:115px;height:50px;font-size:20px;text-align:center;}
</style>
<body>
	
<?php
include "db_info.php";

include "top.php";

?>	
<br><br><br><br>
	<div class="wrap">
		<div class="mainbg">
			<div class="content">
				<div class="conwrap">

					<h1>퍼스널 프로파일</h1>
    				
					<div class="dashwrap" style="width:1390px;">

						<h2>기본정보</h2>
						<div class="dashcon">
							<div class="dashboard">
								<table>
									<colgroup>
										<col width="100px">
										<col width="200px">
										<col width="200px">
										<col width="200px">
										<col width="200px">
										<col width="100px">
										<col width="100px">
									</colgroup>
									<tbody>
										<tr>
											<th>성명</td>
											<td colspan=6><input style="width: 200px; height:50px; font-size:25px;" type="box" name="username" id="username"  /></input></td>
											
										</tr>
										<tr>
											<th>작성요령</td>
											<td colspan=6>
												각 문항마다 4개의 단어중<br>
												<span style="color:red">자신을 가장 잘 묘사한다고 생각하는 단어</span>의  <span style="color:red">[번호]</span>를  <span style="color:red">최고</span>  칸에 기재해 주십시오. <br>
												<span style="color:blue">자신과 가장 관계없다고 생각되는 단어</span>의 <span style="color:blue">[번호]</span>를  <span style="color:blue">최소</span>  칸에 기재해 주십시오. <br>
												※ 각 문항마다 최고치와 최소치를 <span>각각 1개씩 선택해야 합니다.</span>
											</td>
											
										</tr>
										<tr>
											<th align="center" >NO</td>
											<td align="center">1</td>
											<td align="center">2</td>
											<td align="center">3</td>
											<td align="center">4</td>
											<td align="center">최고</td>
											<td align="center">최소</td>
										</tr>
										<tr>
											<th align="center" >1</td>
											<td >열정적인</td>
											<td >과감한</td>
											<td >치밀한</td>
											<td >만족해하는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_1" name="q_max_1"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_1" name="q_min_1"></td>
										</tr>
										<tr>
											<th align="center" >2</td>
											<td >조심성 있는</td>
											<td >결단력있는</td>
											<td >확신을 주는</td>
											<td >온화한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_2" name="q_max_2"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_2" name="q_min_2"></td>
										</tr>
										<tr>
											<th align="center" >3</td>
											<td >조심성 있는</td>
											<td >정확한</td>
											<td >솔직하게 말하는</td>
											<td >조용한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_3" name="q_max_3"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_3" name="q_min_3"></td>
										</tr>
										<tr>
											<th align="center" >4</td>
											<td >말하기를 좋아하는</td>
											<td >자제력 있는</td>
											<td >관습을 따르는</td>
											<td >쉽게 결론 내리는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_4" name="q_max_4"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_4" name="q_min_4"></td>
										</tr>
										<tr>
											<th align="center" >5</td>
											<td >도전하는</td>
											<td >통찰력 있는</td>
											<td >사교성 있는</td>
											<td >온순한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_5" name="q_max_5"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_5" name="q_min_5"></td>
										</tr>
										<tr>
											<th align="center" >6</td>
											<td >부드러운</td>
											<td >설득력 있는</td>
											<td >겸손한</td>
											<td >독창적인</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_6" name="q_max_6"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_6" name="q_min_6"></td>
										</tr>
										<tr>
											<th align="center" >7</td>
											<td >표현력 있는</td>
											<td >신중한</td>
											<td >주도적인</td>
											<td >잘 받아들이는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_7" name="q_max_7"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_7" name="q_min_7"></td>
										</tr>
										<tr>
											<th align="center" >8</td>
											<td >긍정적인</td>
											<td >세심하게 살피는</td>
											<td >온건한</td>
											<td >참을성이 적은</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_8" name="q_max_8"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_8" name="q_min_8"></td>
										</tr>
										<tr>
											<th align="center" >9</td>
											<td >사려 깊은</td>
											<td >남 의견에 잘 동의하는</td>
											<td >사람들에게 호감을 주는</td>
											<td >자기 주장이 강한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_9" name="q_max_9"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_9" name="q_min_9"></td>
										</tr>
										<tr>
											<th align="center" >10</td>
											<td >용감한</td>
											<td >격려하는</td>
											<td >순응하는</td>
											<td >수줍어하는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_10" name="q_max_10"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_10" name="q_min_10"></td>
										</tr>
										<tr>
											<th align="center" >11</td>
											<td >말이 적은</td>
											<td >호의적인</td>
											<td >의지가 강한</td>
											<td >명랑한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_11" name="q_max_11"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_11" name="q_min_11"></td>
										</tr>
										<tr>
											<th align="center" >12</td>
											<td >남을 격려하는</td>
											<td >친절한</td>
											<td >분별력 있는</td>
											<td >독립심이 강한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_12" name="q_max_12"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_12" name="q_min_12"></td>
										</tr>
										<tr>
											<th align="center" >13</td>
											<td >경쟁심이 있는</td>
											<td >이해심 있는</td>
											<td >즐거운</td>
											<td >자신을 잘 드러내지 않는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_13" name="q_max_13"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_13" name="q_min_13"></td>
										</tr>
										<tr>
											<th align="center" >14</td>
											<td >기준이 높은</td>
											<td >유순한</td>
											<td >확고한</td>
											<td >쾌활한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_14" name="q_max_14"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_14" name="q_min_14"></td>
										</tr>
										<tr>
											<th align="center" >15</td>
											<td >매력적인</td>
											<td >생각이 깊은</td>
											<td >의지가 굳은</td>
											<td >일관되게 행동하는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_15" name="q_max_15"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_15" name="q_min_15"></td>
										</tr>
										<tr>
											<th align="center" >16</td>
											<td >논리적인</td>
											<td >대담한</td>
											<td >충실한</td>
											<td >인기 있는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_16" name="q_max_16"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_16" name="q_min_16"></td>
										</tr>
										<tr>
											<th align="center" >17</td>
											<td >사교적인</td>
											<td >참을성 있는</td>
											<td >자신감 있는</td>
											<td >점잖게 말하는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_17" name="q_max_17"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_17" name="q_min_17"></td>
										</tr>
										<tr>
											<th align="center" >18</td>
											<td >쉽게 따라 해주는</td>
											<td >의욕적인</td>
											<td >철저한</td>
											<td >활기찬</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_18" name="q_max_18"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_18" name="q_min_18"></td>
										</tr>
										<tr>
											<th align="center" >19</td>
											<td >적극적인</td>
											<td >외향적인</td>
											<td >친근한</td>
											<td >갈등을 피하는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_19" name="q_max_19"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_19" name="q_min_19"></td>
										</tr>
										<tr>
											<th align="center" >20</td>
											<td >자긍심 있는</td>
											<td >공감하는</td>
											<td >공평한</td>
											<td >단호한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_20" name="q_max_20"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_20" name="q_min_20"></td>
										</tr>
										<tr>
											<th align="center" >21</td>
											<td >절제력 있는</td>
											<td >관대한</td>
											<td >생동감 있는</td>
											<td >주관이 뚜렷한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_21" name="q_max_21"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_21" name="q_min_21"></td>
										</tr>
										<tr>
											<th align="center" >22</td>
											<td >즉흥적인</td>
											<td >내향적인</td>
											<td >강인한</td>
											<td >느긋한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_22" name="q_max_22"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_22" name="q_min_22"></td>
										</tr>
										<tr>
											<th align="center" >23</td>
											<td >남들과 잘 어울리는</td>
											<td >점잖은</td>
											<td >활력 있는</td>
											<td >너그러운</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_23" name="q_max_23"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_23" name="q_min_23"></td>
										</tr>
										<tr>
											<th align="center" >24</td>
											<td >매력이 넘치는</td>
											<td >일처리방식에 만족해하는</td>
											<td >타인에게 요구가 많은</td>
											<td >기준을 중시하는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_24" name="q_max_24"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_24" name="q_min_24"></td>
										</tr>
										<tr>
											<th align="center" >25</td>
											<td >자기 주장을 하는</td>
											<td >체계적인</td>
											<td >협력적인</td>
											<td >경쾌한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_25" name="q_max_25"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_25" name="q_min_25"></td>
										</tr>
										<tr>
											<th align="center" >26</td>
											<td >유쾌한</td>
											<td >정교한</td>
											<td >직선적인</td>
											<td >침착한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_26" name="q_max_26"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_26" name="q_min_26"></td>
										</tr>
										<tr>
											<th align="center" >27</td>
											<td >변화를 추구하는</td>
											<td >정다운</td>
											<td >호소력 있는</td>
											<td >꼼꼼한</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_27" name="q_max_27"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_27" name="q_min_27"></td>
										</tr>
										<tr>
											<th align="center" >28</td>
											<td >정중한</td>
											<td >새로운 것을 시작하는</td>
											<td >낙천적인</td>
											<td >도움을 주려 하는</td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_max_28" name="q_max_28"></td>
											<td align="center" style="padding:0"><input type="text" class="disc_text" id="q_min_28" name="q_min_28"></td>
										</tr>
										
									</tbody>
								</table>
							</div>
						</div>

						
							
							
            				<div class="btn w100" style="margin:5px 0 15px; text-align:right;">
            					<button name="action" id="action" >등록</button>
            					<button name="list" id="list">목록</button>
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

function fetchUser()
{

	var depid = "<?=$depid?>";


	if(depid != "" ){
		if(depid == "D1003" || depid == "D1004" || depid == "D1006" || depid == "D1007" || depid == "D1008" || depid == "D1009" || depid == "D1010" || depid == "D1011" || depid == "D1012" ){
			$("#REG_BRANCH").val(depid).attr("selected","selected");
		}
	}
	
	var action = "select_view_vat";
	var request = new Request();

	var id = request.getParameter("id");

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1;
	var yyyy = today.getFullYear();
	var time = today.getTime();
	var now = yyyy+""+mm+""+dd;
	var cst_type = "A1002";

	$('#REGDATE').val(moment(today).format('YYYY-MM-DD'));

	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"select.php",
		method:"POST",
		data:{id:id,action:action,cst_type:cst_type},
		dataType:"json",
		success:function(data)
		{
			console.log(data);
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}




    
    //[2] 추가 버튼 클릭했을 때 작동되는 함수
    $('#action').click(function(){
    	modify_();
    });
   

    	//목록가기
    $('#list').click(function(){
    	window.location.href="list_RPA_vat.php";
    });


    function modify_(){

    		var request = new Request();
    		var id = request.getParameter("id");
    		var action = "action_insert_disc";
    		var username = $('#username').val();
    		var q_max_1 = $('#q_max_1').val();
    		var q_min_1 = $('#q_min_1').val();
    		var q_max_2 = $('#q_max_2').val();
    		var q_min_2 = $('#q_min_2').val();
    		var q_max_3 = $('#q_max_3').val();
    		var q_min_3 = $('#q_min_3').val();
    		var q_max_4 = $('#q_max_4').val();
    		var q_min_4 = $('#q_min_4').val();
    		var q_max_5 = $('#q_max_5').val();
    		var q_min_5 = $('#q_min_5').val();
    		var q_max_6 = $('#q_max_6').val();
    		var q_min_6 = $('#q_min_6').val();
    		var q_max_7 = $('#q_max_7').val();
    		var q_min_7 = $('#q_min_7').val();
    		var q_max_8 = $('#q_max_8').val();
    		var q_min_8 = $('#q_min_8').val();
    		var q_max_9 = $('#q_max_9').val();
    		var q_min_9 = $('#q_min_9').val();
    		var q_max_10 = $('#q_max_10').val();
    		var q_min_10 = $('#q_min_10').val();
    		var q_max_11 = $('#q_max_11').val();
    		var q_min_11 = $('#q_min_11').val();
    		var q_max_12 = $('#q_max_12').val();
    		var q_min_12 = $('#q_min_12').val();
    		var q_max_13 = $('#q_max_13').val();
    		var q_min_13 = $('#q_min_13').val();
    		var q_max_14 = $('#q_max_14').val();
    		var q_min_14 = $('#q_min_14').val();
    		var q_max_15 = $('#q_max_15').val();
    		var q_min_15 = $('#q_min_15').val();
    		var q_max_16 = $('#q_max_16').val();
    		var q_min_16 = $('#q_min_16').val();
    		var q_max_17 = $('#q_max_17').val();
    		var q_min_17 = $('#q_min_17').val();
    		var q_max_18 = $('#q_max_18').val();
    		var q_min_18 = $('#q_min_18').val();
    		var q_max_19 = $('#q_max_19').val();
    		var q_min_19 = $('#q_min_19').val();
    		var q_max_20 = $('#q_max_20').val();
    		var q_min_20 = $('#q_min_20').val();
    		var q_max_21 = $('#q_max_21').val();
    		var q_min_21 = $('#q_min_21').val();
    		var q_max_22 = $('#q_max_22').val();
    		var q_min_22 = $('#q_min_22').val();
    		var q_max_23 = $('#q_max_23').val();
    		var q_min_23 = $('#q_min_23').val();
    		var q_max_24 = $('#q_max_24').val();
    		var q_min_24 = $('#q_min_24').val();
    		var q_max_25 = $('#q_max_25').val();
    		var q_min_25 = $('#q_min_25').val();
    		var q_max_26 = $('#q_max_26').val();
    		var q_min_26 = $('#q_min_26').val();
    		var q_max_27 = $('#q_max_27').val();
    		var q_min_27 = $('#q_min_27').val();
    		var q_max_28 = $('#q_max_28').val();
    		var q_min_28 = $('#q_min_28').val();
    		
    		
    				
    		if(username !=""){

    			$.ajax({
    			//insert page로 위에서 받은 데이터를 넣어준다.
    				url:"action.php", 
    				method:"POST",
    				data:{action:action,username:username, id:id,q_max_1:q_max_1,q_max_2:q_max_2,q_max_3:q_max_3,q_max_4:q_max_4,q_max_5:q_max_5,q_max_6:q_max_6,q_max_7:q_max_7,q_max_8:q_max_8,q_max_9:q_max_9,q_max_10:q_max_10
        				,q_max_11:q_max_11,q_max_12:q_max_12,q_max_13:q_max_13,q_max_14:q_max_14,q_max_15:q_max_15,q_max_16:q_max_16,q_max_17:q_max_17,q_max_18:q_max_18,q_max_19:q_max_19,q_max_20:q_max_20
        				,q_max_21:q_max_21,q_max_22:q_max_22,q_max_23:q_max_23,q_max_24:q_max_24,q_max_25:q_max_25,q_max_26:q_max_26,q_max_27:q_max_27,q_max_28:q_max_28
        				,q_min_1:q_min_1,q_min_2:q_min_2,q_min_3:q_min_3,q_min_4:q_min_4,q_min_5:q_min_5,q_min_6:q_min_6,q_min_7:q_min_7,q_min_8:q_min_8,q_min_9:q_min_9,q_min_10:q_min_10
        				,q_min_11:q_min_11,q_min_12:q_min_12,q_min_13:q_min_13,q_min_14:q_min_14,q_min_15:q_min_15,q_min_16:q_min_16,q_min_17:q_min_17,q_min_18:q_min_18,q_min_19:q_min_19,q_min_20:q_min_20
        				,q_min_21:q_min_21,q_min_22:q_min_22,q_min_23:q_min_23,q_min_24:q_min_24,q_min_25:q_min_25,q_min_26:q_min_26,q_min_27:q_min_27,q_min_28:q_min_28},
	    				success:function(data){
    					alert(data);
						window.location.href="list_disc.php";	
    				}
    			});

    		}else{
    			alert('필수값을 입력해주세요');
    			if(username == ""){
    				$('#username').focus();
    			}
    		}
    }
        


    
});

</script>
</html>