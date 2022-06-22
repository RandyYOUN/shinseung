<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="utf-8">
    <title>신승세무법인-세무톡</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1" />
    <link rel="stylesheet" href="../tax_income/resources/css/common.css" />
    <script type="text/javascript" src="../tax_income/resources/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="../tax_income/resources/js/common.js"></script>

</head>

<body>
    <!-- stepLast -->
    <section class="stepLast">
        <div class="contents">
            <div class="title">
                <h1><span><label id="CSTNAME" name="CSTNAME"></label></span>님<br>종합소득세 신고가 완료되었습니다</h1>
            </div>

            <h1>납부내역</h1>
            <ul class="payment">
                <li>
                    <h2>소득세 : <label id="INCOME_TAX" name="INCOME_TAX"></label>원</h2>
                    <h3>홈택스 전자신고번호 : <label id="REPORT_NUM_INCOME" name="REPORT_NUM_INCOME"></label></h3>
                </li>
                <li>
                    <h2>지방세 : <label id="JIBANG_TAX" name="JIBANG_TAX"></label>원</h2>
                    <h3>위택스 전자신고번호 : <label id="REPORT_NUM_WETAX" name="REPORT_NUM_WETAX"></label></h3>
                </li>
                <span>납부금액이 마이너스면 환급금액입니다</span>
            </ul>
<h1>접수증, 신고서, 납부서 확인</h1>
            <ul class="receipt">
                <li>
<?php

//db연결 본인의 db 정보를 넣어준다!
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
$http_host = $_SERVER['HTTP_HOST'];
if($http_host=="localhost")
    $connect = mysqli_connect("182.162.143.216", "sschina", "Andy4240!@","dbsschina","3306");
else
    $connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");

    
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )
$id = $_GET["id"];
$year = $_GET["year"];
$year_path = $year+1;
$path_info = "../tax_income/upload/$year_path/";
$path_pay  = "../tax_income/upload/$year_path/";

if(isset($id))
{
	$procedure = "
		CREATE PROCEDURE SELECT_CST_FILELIST()
		BEGIN
			SELECT *,
            CODE_TO_STR(B.REG_BRANCH) AS 'REG_BRANCH_PATH',
            substring( REPLACE( RETURN_STR(A.MOBILE),'-',''),4) AS 'MOBILE_PATH'
            FROM TB100020 AS A LEFT OUTER JOIN TB100022 AS B
            ON A.CSTID = B.CSTID 
			WHERE B.CST_TYPE_YEAR=$year AND B.CST_TYPE='A1001' 
			AND A.CSTID = '".$id."';
		END;
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_CST_FILELIST"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
				$query = "CALL SELECT_CST_FILELIST()";
				//프로시저 호출
				$result = mysqli_query($connect,$query);

				if(mysqli_num_rows($result) >0)
				{					
					while($row = mysqli_fetch_array($result)){
					    $iconv_cstname =$row["CSTNAME"];
						$MOBILE = $row["MOBILE_PATH"];
						
						//$dir_info = $path_info.$row["REG_BRANCH_PATH"]."/안내문/".$iconv_cstname.$MOBILE."/";
						$dir_pay = $path_pay."강남/납부서/".$iconv_cstname.$MOBILE."/";

/*
						if (is_dir($dir_info)){                              
						    if ($dh = opendir($dir_info)){                     //$df = array_diff(scandir($dir),$ignore);
						        while (($file = readdir($dh)) !== false){   
    				                if($file == ".." || $file == "."){
    									continue;
    	     						}else{
    	     						    echo "<a href='".$dir_info.$file . "' target=_blank>".$file."</a>";        		
    								}
    
    							}                                           
							closedir($dh);                              
						  }                                             
						}else{
							echo '';
						}
						*/
						if (is_dir($dir_pay)){
						    if ($dh = opendir($dir_pay)){                     //$df = array_diff(scandir($dir),$ignore);
						        while (($file = readdir($dh)) !== false){
						            if($file == ".." || $file == "."){
						                continue;
						            }else{
						                echo "<a href='".$dir_pay.$file . "' target=_blank>".$file."</a>";
						            }
						            
						        }
						        closedir($dh);
						    }
						}else{
						    echo '';
						} 
					}
				}

			}
		}

}

?>
                </li>
                <li>
                    <span>납부서를 꼭 확인해주십시오</span>
                </li>
            </ul>

            <!-- h1>사용후기 </h1>
            <ul class="review">
                <li>
                    <label><input type="radio" id="star1" value="1" name="review"><img src="images/star.png"></label>
                    <label><input type="radio" id="star2" value="2" name="review"><img src="images/star.png"><img
                            src="images/star.png"></label>
                    <label><input type="radio" id="star3" value="3" name="review"><img src="images/star.png"><img src="images/star.png"><img
                            src="images/star.png"></label>
                    <label><input type="radio" id="star4" value="4" name="review"><img src="images/star.png"><img src="images/star.png"><img
                            src="images/star.png"><img src="images/star.png"></label>
                    <label><input type="radio" id="star5" value="5" name="review"><img src="images/star.png"><img src="images/star.png"><img
                            src="images/star.png"><img src="images/star.png"><img src="images/star.png"></label>
                </li>
                <li>
                    <textarea style="font-size:12px;" id='content' name='content'  onkeyup="fnChkByte(this);"></textarea>
                    <button  name="action" id="action">확인</button>
                </li>
                <span>고객님의 소리를 귀담아 듣고 더 나은 서비스를 만들도록 노력하겠습니다</span>
            </ul-->
        </div>
    </section>
    
</body>
</html>

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


/*코멘트 기능 글자수제한 스크립트*/
	function fnChkByte(obj) {
		var maxByte = 600; //최대 입력 바이트 수
		var str = obj.value;
		var str_len = str.length;
	
		var rbyte = 0;
		var rlen = 0;
		var one_char = "";
		var str2 = "";
	
		for (var i = 0; i < str_len; i++) {
			one_char = str.charAt(i);
	
			if (escape(one_char).length > 4) {
				rbyte += 2; //한글2Byte
			} else {
				rbyte++; //영문 등 나머지 1Byte
			}
	
			if (rbyte <= maxByte) {
				rlen = i + 1; //return할 문자열 갯수
			}
		}
	
		if (rbyte > maxByte) {
			alert("한글 " + (maxByte / 2) + "자 / 영문 " + maxByte + "자를 초과 입력할 수 없습니다.");
			str2 = str.substr(0, rlen); //문자열 자르기
			obj.value = str2;
			fnChkByte(obj, maxByte);
		} 
	}
/*코멘트 기능 글자수제한 스크립트 : End*/




$(document).ready(function(){

fetchUser();
function fetchUser()
{

	
	var action = "select_cst_info_simple";
	$.ajax({
		url:"../tax_income/action.php",
		method:"POST",
		dataType:"json",
		data:{action:action,cstid:"<?php echo $_GET["id"]?>",year:"<?php echo $_GET["year"]?>"},
		success:function(data){
			if(data.CSTID){
				
				if(data.NUM_FLAG_INCOME =="음")
					$("#INCOME_TAX").css("color","red");
				else
					$("#INCOME_TAX").css("color","black");

				if(data.NUM_FLAG_JI =="음")
					$("#JIBANG_TAX").css("color","red");
				else
					$("#JIBANG_TAX").css("color","black");

				$("#CSTNAME").html(data.CSTNAME);
				$("#INCOME_TAX").html(data.INCOME_TAX);
				$("#JIBANG_TAX").html(data.JIBANG_TAX);
				$("#REPORT_NUM_INCOME").html(data.REPORT_NUM_INCOME);
				$("#REPORT_NUM_WETAX").html(data.REPORT_NUM_WETAX);

			}
		}
	})
}

	

$('#action').click(function(){

	//각 엘리먼트들의 데이터 값을 받아온다.
	
	var cate= "종합소득세";
	var cstname = "<?php echo $_POST["CSTNAME"]?>";
	var mobile = "<?php echo $_POST["MOBILE"]?>";
	var score= $('input[name="review"]:checked').val();
	var content= $('#content').val();
	
	var action = "insert_inc_review_pop";

	//성과 이름이 올바르게 입력이 되면
	if(content != ''&& score != ''){

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"action.php", 
			method:"POST",
			dataType:"json",
			data:{mobile:mobile,cate:cate,score:score,content:content,action:action, cstname:cstname },
			success:function(data){
				if(data.ID){
					alert('정성스러운 리뷰남겨주셔서 감사합니다.');
					window.location.replace("https://taxtok.kr");
				}else{
					alert('등록중 에러가 발생했습니다. 잠시후에 다시 시도하여주세요');
					return false;
				}
				
			}
		});

	}else{
		alert('빈칸을 입력해 주세요');
	}
}); // [2]끝



});
</script>