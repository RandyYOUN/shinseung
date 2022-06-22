
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
			<h1>부가세 간편신고 서비스</h1>
		</section>
	</header>

	<section class="stepProcess">
        <ul>
            <li class="on"><span class="stepProcess01"></span><span><em>STEP01</em>기본정보 입력</span></li>
            <li><span class="stepProcess02"></span><span><em>STEP02</em>수수료</span></li>
            <li><span class="stepProcess03"></span><span><em>STEP03</em>신고대행 의뢰</span></li>
            <li><span class="stepProcess04"></span><span><em>STEP04</em>부가정보 입력</span></li>
            <li><span class="stepProcess05"></span><span><em>STEP05</em>신고대행 의뢰완료</span></li>
        </ul>
    </section>

	    <section class="step01">
        <div class="fL">
            <h1><span>step01</span>기본정보 입력</h1>
        </div>
        <div class="fR">
            <label>신고자 의뢰자명을 입력해 주세요</label><input type="text" placeholder="이름" id="cstname" name="cstname">
            <label>핸드폰 번호를 입력해 주세요</label><input type="text" placeholder="핸드폰" id="mobile" name="mobile">
            <div class="checkbox">
                <input name="check02" id="check01" type="checkbox" value="Y">
                <label for="check01">세무톡 이용약관 및 개인정보처리방침에 동의합니다.<BR>입력하신 정보는 부가세 신고를 위한 용도로만 사용됩니다.</label>
            </div>            
            <input type="button" value="다  음" id="action_step01" name="action_step01">
        </div>
    </section>

	<?php include("subbottom.php");?>

	<?php include("footer.php");?>



<script>
$(document).ready(function(){

	$('#action_step01').click(function(){

		//각 엘리먼트들의 데이터 값을 받아온다.
		var cstname = $('#cstname').val();
		var mobile= $('#mobile').val();
		//var agreement= $("input:checkbox[name=agreement]:checked").length;
		var action = "action_vat_cst";
		var inf_path = "부가톡";
		//alert($("input:checkbox[id='check01']").is(":checked"));

//		alert(agreement);

		if(!$("input:checkbox[id='check01']").is(":checked")){
			alert("약관에 동의하여 주세요.");
			$('#agreement').focus();
			return false;
		}else{
			if(cstname !='' && mobile!= ''){
				$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"action.php", 
					method:"POST",
					data:{cstname:cstname,mobile:mobile,action:action,inf_path:inf_path},
					dataType:"json",
					success:function(data){
						console.log(data);
						//alert(data.CSTID);
						if(data.FLAG_CSTID == "1"){
							location.href="sub_step02.php?id="+data.CSTID+"&id2="+data.BIZ_ID;		
						}else if(data.FLAG_CSTID == "2"){
							alert("기존에 입력된 정보가 있어 해당 정보를 불러옵니다.");
							location.href="sub_step02.php?id="+data.CSTID+"&id2="+data.BIZ_ID;		
						}else{
							alert("작성중 에러가 발생했습니다. 관리자에게 문의하여주세요.");
						}

					}
				});

			}else{
				alert('빈칸을 입력해 주세요');
			}
		}
	}); // [1]끝







});

</script>
