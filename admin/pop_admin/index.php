<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>세무톡 - 쉽고 간편한 세무업무</title>
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta property="og:type" content="website">
	<meta property="og:title" content="세무톡 - 쉽고 간편한 세무업무">
	<meta property="og:image" content="/resources/images/sum.png">
	<meta name="format-detection" content="telephone=no" />
	<link rel="stylesheet" href="resources/css/basic.css">
	<link rel="stylesheet" href="resources/css/common.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

				
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
<style>
.loading-layer {
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(68, 68, 68, 0.3);
    z-index: 11111;
}
.loading-layer .loading-wrap {
    display: table;
    width: 100%;
    height: 100%;
}
.loading-layer .loading-wrap .loading-text {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    color: #fff;
    text-shadow: 2px 3px 2.6px #a2a2a2;
    font-size: 3.8em;
    position: relative;
    top: -20px;
}
.loading-layer.active-loading .loading-wrap .loading-text span:nth-child(1) {
  animation: loading-01 0.82s infinite;
}
.loading-layer.active-loading .loading-wrap .loading-text span:nth-child(2) {
  animation: loading-02 0.82s infinite;
}
.loading-layer.active-loading .loading-wrap .loading-text span:nth-child(3) {
  animation: loading-03 0.82s infinite;
}

@keyframes loading-01 {
  25% {
    color: #000;
  }
  50% {
    color: #fff;
  }
}
@keyframes loading-02 {
  50% {
    color: #000;
  }
  75% {
    color: #fff;
  }
}
@keyframes loading-03 {
  75% {
    color: #000;
  }
  100% {
    color: #fff;
  }
}
</style>
</head>
<body>
	<div class="wrap" id="body_pop">
		<div class="alarm_copy">복사되었습니다</div><!-- 추가 -->
		<div class="alarm_copy2">저장되었습니다</div><!-- 추가 -->
		<section class="top">
			<div class="logo_wrap">
				<a class="logo" href="#"><span>FAQ</span>NOTE</a>
				<a class="setting" href="#"></a>			
			</div>
			<div class="top_gnb">
				<ul>
					<li id="TAB1" value="채널톡" onclick="javascript:change_class(this);"><a>채널톡</a></li>
					<li id="TAB2" value="전화" onclick="javascript:change_class(this);"><a >전화</a></li>
					<li id="TAB3" value="카톡" onclick="javascript:change_class(this);"><a >카톡</a></li>
					<li id="TAB4" value="상담" onclick="javascript:change_class(this);"><a >상담</a></li>
					<li id="TAB5" value="접수" onclick="javascript:change_class(this);"><a >접수</a></li>
					<li id="TAB6" value="자료" onclick="javascript:change_class(this);"><a >자료</a></li>
					<li id="TAB7" value="신고" onclick="javascript:change_class(this);"><a >신고</a></li>
					<li id="TAB8" value="납부" onclick="javascript:change_class(this);"><a >납부</a></li>
<?php 
    $id=mysqli_real_escape_string($connect,$_GET["id"]);
    if($id != ""){
?>
					<li id="TAB_MY" value="MY" onclick="javascript:change_class(this);"><a>MY</a></li>
<?php        
    }
?>					
				</ul>
			</div>
		</section>

		<section class="title">
			<h1 id="h1_text"></h1>
			<!--  h2>수수료 11만원 & 카톡 링크</h2-->
			<a class="menu"></a>
		</section>

		<section class="container">
			<div class="sub_menu on" id="result">
				
			</div>
			
			<div class="sub_menu" id="result_my">
				
			</div>
			

			<div class="contents">
			<div class="mess_tit"></div><!-- 추가 -->
				
				<div class="form_wrap" >
					<div class="tit_toggle" id="sub_title"><span></span></div>
					
					
<!-- 전문상담 영역 :s  -->
					<div id="cst_insert_form" style="display:none;">
						<ul>
						<li>
							<div class="box strike">
								<span class="tit"><b class="required">고객명</b></span>
								<span>
									<input type="text" id="cstname">
								</span>	
							</div>
						</li>
						<li>
							<div class="box strike">
								<span class="tit"><b class="required">연락처</b></span>
								<span>
									<input type="text" id="mobile">
								</span>	
							</div>
						</li>
						<li>
							<div class="box">
								<span class="tit"><b>업종</b></span>
								<span>
									<input type="text" id="sec_type">
								</span>	
							</div>
						</li>
						<li>
							<div class="box">
								<span class="tit"><b>연매출</b></span>
								<span>
									<input type="text" id="total_paid">
								</span>	
							</div>
						</li>
						<li>
							<div class="box">
								<span class="tit"><b>홈택스ID</b></span>
								<span>
									<input type="text" id="hometaxid">
								</span>	
							</div>
						</li>
						<li>
							<div class="box">
								<span class="tit"><b>홈택스PW</b></span>
								<span>
									<input type="text" id="hometaxpw">
								</span>	
							</div>
						</li>
						
						<li>
							<div class="box">
								<span class="tit"><b >수신/참조</b></span>
								<span>
									<select id ="reg_branch" >
										<option value="">선택</option>
										<option value="D1003_1">정혜숙</option>
										<option value="D1003_2">마희숙</option>
										<option value="D1004">용인</option>
										<option value="D1006">안양</option>
										<option value="D1007">수원</option>
										<option value="D1008">일산</option>
										<option value="D1009">부천</option>
										<option value="D1010">광주</option>
										<option value="D1011">분당</option>
										<option value="D1012">기흥</option>
									</select>
								</span>						
							</div>
						</li>
						
						<li>
							<div class="box">
								<span class="tit"><b>유입채널</b></span>
								<span>
									<select id ="inf_channel" >
										<option value="">선택</option>
										<option value="채널톡">채널톡</option>
										<option value="전화">전화</option>
										<option value="카톡채널">카톡채널</option>
										<option value="기타">기타</option>
									</select>
								</span>	
							</div>
						</li>
						
						<li>
							<div class="box">
								<textarea rows="4" id="memo"></textarea>
							</div>
						</li>
												
					</ul>
					<ul>
						<li>
    						<div class="btn_area">
    							<button id="btn_new_cst">저장</button>
    						</div>
    					</li>
					</ul>
					</div>
<!-- 전문상담 영역 :E  -->			
					
						
<!-- 예상세액계산기 영역 :S  -->
    				<div id="cal_form" style="display:none;">
						<ul>
    						<li>
    							<div class="box">
    								<span class="tit"><b >고객명</b></span>
    								<span>
    									<input type="text" id="cstname_cal">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box strike">
    								<span class="tit"><b class="required">연락처</b></span>
    								<span>
    									<input type="text" id="mobile_cal">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>홈택스ID</b></span>
    								<span>
    									<input type="text" id="HT_ID">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>홈택스PW</b></span>
    								<span>
    									<input type="text" id="HT_PW">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box strike">
    								<span class="tit"><b class="required">총수임금액</b></span>
    								<span>
    									<input type="text" id="EXT_PAID" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box strike">
    								<span class="tit"><b class="required">경비율</b></span>
    								<span>
    									<input type="text" id="EXT_RATIO">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box strike">
    								<span class="tit"><b class="required">기납부액</b></span>
    								<span>
    									<input type="text" id="EXT_ADD_TAX" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>소득공제계</b></span>
    								<span>
    									<input type="text" id="DEL_PRICE" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
    								</span>	
    							</div>
    						</li>
    						<li>
							<div class="box_checkbox">
								<span class="tit"><b>타소득</b></span>
								<span class="chek_area">							
									
									<input type="checkbox" name="ynck" id="dvdnIncAmtYn"><label for="dvdnIncAmtYn">배당</label>
									<input type="checkbox" name="ynck" id="intrIncAmtYn"><label for="intrIncAmtYn">이자</label>
									<input type="checkbox" name="ynck" id="erinAmtYn"><label for="erinAmtYn">근로단일</label>
									<input type="checkbox" name="ynck" id="dblErinAmtYn"><label for="dblErinAmtYn">근로복수</label>
									<input type="checkbox" name="ynck" id="pnsnIncAmtYn"><label for="pnsnIncAmtYn">연금</label>
									<input type="checkbox" name="ynck" id="etcIncAmtYn"><label for="etcIncAmtYn">기타</label>
								</span>						
							</div>
						</li>
    											
    					</ul>
    					
    					<ul>
    						<li>
    							<div class="box">
    								<span class="tit"><b>과세표준</b></span>
    								<span>
    									<span id="STEP3" style="padding-left: 10px;"><b></b></span>
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>예상세액</b></span>
    								<span>
    									<span id="EST_TAX" style="padding-left: 10px;"><b></b></span>
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>예상수수료</b></span>
    								<span>
    									<span id="EST_FEE" style="padding-left: 10px;"><b></b></span>
    								</span>	
    							</div>
    						</li>
    					</ul>
    					
    					<ul>
    						<li>
        						<div class="btn_area">
        							<button id="btn_save" class="w50">저장</button>
        							<button disabled style="background:#b0b0b0;" id="btn_kakao" class="w50">발송</button>
        						</div>
        					</li>
    					</ul>
    					<ul>
    						<li>
        						<div class="btn_area">
        							<button id="btn_cal">계산</button>
        						</div>
        					</li>
    					</ul>
					</div>
<!-- 예상세액계산기 영역 :E  -->				
				
<!-- 전화 영역 :S  -->				
					<div id="phone_form" style="display:none;">
						<ul>
    						<li>
    							<div class="box strike">
    								<span class="tit"><b class="required">고객명</b></span>
    								<span>
    									<input type="text" id="cstname_p">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box strike">
    								<span class="tit"><b class="required">연락처</b></span>
    								<span>
    									<input type="text" id="mobile_p">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>업종</b></span>
    								<span>
    									<input type="text" id="sector_p">
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>연매출</b></span>
    								<span>
    									<input type="text" id="total_paid_p">
    								</span>	
    							</div>
    						</li>
    						<li>
							<div class="box_checkbox" style="display: none;">
								<span class="tit"><b>타소득</b></span>
								<span class="chek_area">							
									
									<input type="checkbox" name="ynck2" id="dvdnIncAmtYn_p"><label for="dvdnIncAmtYn_p">배당</label>
									<input type="checkbox" name="ynck2" id="intrIncAmtYn_p"><label for="intrIncAmtYn_p">이자</label>
									<input type="checkbox" name="ynck2" id="erinAmtYn_p"><label for="erinAmtYn_p">근로단일</label>
									<input type="checkbox" name="ynck2" id="dblErinAmtYn_p"><label for="dblErinAmtYn_p">근로복수</label>
									<input type="checkbox" name="ynck2" id="pnsnIncAmtYn_p"><label for="pnsnIncAmtYn_p">연금</label>
									<input type="checkbox" name="ynck2" id="etcIncAmtYn_p"><label for="etcIncAmtYn_p">기타</label>
								</span>						
							</div>
							
							<div class="box">
								<textarea rows="5" cols="30" id="insert_area_p" style="box-sizing: border-box;border: solid 2px #c1c1c1;"></textarea>
							</div>
							
							
							<div class="form_wrap" style="display: none;">
            					<div class="tit_toggle open">예상세액계산<span></span></div>
            					<ul>
            						<li>
            							<div class="box">
            								<span class="tit"><b>홈택스ID</b></span>
            								<span>
            									<input type="text" id="HT_ID_p">
            								</span>	
            							</div>
            						</li>
            						<li>
            							<div class="box">
            								<span class="tit"><b>홈택스PW</b></span>
            								<span>
            									<input type="text" id="HT_PW_p">
            								</span>	
            							</div>
            						</li>
            						<li>
            							<div class="box ">
            								<span class="tit"><b >총수임금액</b></span>
            								<span>
            									<input type="text" id="EXT_PAID_p" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
            								</span>	
            							</div>
            						</li>
            						<li>
            							<div class="box ">
            								<span class="tit"><b >경비율</b></span>
            								<span>
            									<input type="text" id="EXT_RATIO_p">
            								</span>	
            							</div>
            						</li>
            						<li>
            							<div class="box ">
            								<span class="tit"><b >기납부액</b></span>
            								<span>
            									<input type="text" id="EXT_ADD_TAX_p" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
            								</span>	
            							</div>
            						</li>
            						<li>
            							<div class="box">
            								<span class="tit"><b>소득공제계</b></span>
            								<span>
            									<input type="text" id="DEL_PRICE_p" onKeyUp="removeChar(event);inputNumberFormat(this);" onKeyDown="inputNumberFormat(this);">
            								</span>	
            							</div>
            						</li>			
            					</ul>
            				</div>
							
						</li>
    											
    					</ul>
    					
				
        				
    					<ul style="display: none;">
    						<li>
        						<div class="btn_area">
        							<button id="btn_p">계산</button>
        						</div>
        					</li>
    					</ul>
    					
    					<ul>
    						<li style="display: none;">
    							<div class="box">
    								<span class="tit"><b>예상세액</b></span>
    								<span>
    									<span id="EST_TAX_p" style="padding-left: 10px;"><b></b></span>
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>전문상담</b></span>
    								<!-- span>
    									<span id="EST_FEE_p" style="padding-left: 10px;"><b></b></span>
    								</span-->
    								<span>
    									<select id="PRO_FLAG_p">
    											<option SELECTED value="N" >N</option>
                                                <option value="Y" >Y</option>
    									</select>
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b>예상수수료</b></span>
    								<!-- span>
    									<span id="EST_FEE_p" style="padding-left: 10px;"><b></b></span>
    								</span-->
    								<span>
    									<select id="EST_FEE_p">
    											<option value="">선택</option>
                                                <option value="55000" >55,000</option>
                                                <option value="88000" >88,000</option>
                                                <option value="110000" >110,000</option>
                                                <option value="143000" >143,000</option>
                                                <option value="165000" >165,000</option>
                                                <option value="198000" >198,000</option>
                                                <option value="220000" >220,000</option>
                                                <option value="275000" >275,000</option>
                                                <option value="330000" >330,000</option>
                                                <option value="385000" >385,000</option>
                                                <option value="440000" >440,000</option>
                                                <option value="495000" >495,000</option>
                                                <option value="550000" >550,000</option>
                                                <option value="605000" >605,000</option>
                                                <option value="660000" >660,000</option>
                                                <option value="770000" >770,000</option>
                                                <option value="880000" >880,000</option>
                                                <option value="990000" >990,000</option>
                                                <option value="1100000" >1,100,000</option>
                                                <option value="1210000" >1,210,000</option>
                                                <option value="1320000" >1,320,000</option>
                                                <option value="1430000" >1,430,000</option>
                                                <option value="1540000" >1,540,000</option>
                                                <option value="1650000" >1,650,000</option>
                                                <option value="1760000" >1,760,000</option>
                                                <option value="1870000" >1,870,000</option>
                                                <option value="1980000" >1,980,000</option>
                                                <option value="2090000" >2,090,000</option>
                                                <option value="2200000" >2,200,000</option>
                                    			<option value="-9999" >별도협의</option>
                                    			
    									</select>
    								</span>	
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit">알림톡</span>
    								<span>
    									<select id="select_send_kakao">
    										<option value="">선택</option>
    										<option SELECTED value="bizp_2022042114014314053182657">수수료 안내</option>
    										<!-- option value="bizp_2022042113590613488325669">세액  & 수수료 안내</option>
    										<option value="bizp_2022042114030514053585658">예상세액 안내</option-->
    										<option value="bizp_2022042114073514053486659">부재중전화 안내</option>
    										<option value="bizp_2022042114114213488987672">홈택스 안내문 조회방법</option>
    										<option value="bizp_2022042114131114053954660">신고마감임박 안내</option>
    										<option value="bizp_2022042114151414053069663">수수료 조정 안내</option>
    									</select>
    								</span>						
    							</div>
    						</li>
    						<li>
    							<div class="box">
    								<span class="tit"><b >수신/참조</b></span>
    								<span>
    									<select id ="reg_branch_phone" >
    										<option value="">선택</option>    
    										<option value="D1003_1">정혜숙</option>
    										<option value="D1003_2">마희숙</option>
    										<option value="D1004">용인</option>
    										<option value="D1006">안양</option>
    										<option value="D1007">수원</option>
    										<option value="D1008">일산</option>
    										<option value="D1009">부천</option>
    										<option value="D1010">광주</option>
    										<option value="D1011">분당</option>
    										<option value="D1012">기흥</option>
    									</select>
    								</span>						
    							</div>
    						</li>
    						
                			<ul>
                				<li>
                    				<div class="btn_area">
                    					<button id="btn_save_p" class="w50">저장</button>
                    					<button disabled style="background:#b0b0b0;" id="btn_kakao_p" class="w50">발송</button>
                    				</div>
                    			</li>
                			</ul>
                    		
    					</ul>
        				
					</div>
<!-- 전화 영역 :S  -->
				
				</div>
				
				<div class="message">
					
					<div class="link_wrap" >
						<a class="text_copy" id="action">문구복사</a>
						<!-- a class="text_modify">문구수정</a-->
						<input type="box"  name="menu_subject" id="menu_subject" style="display: none;padding: 6px;margin: 5px 0px 0px 3px;" placeholder="요약제목">
						<input type="box"  name="menu_subject2" id="menu_subject2" style="display: none;padding: 6px;margin: 5px 0px 0px 3px;" placeholder="상세제목">
						<input type="hidden" id = "del_id">
						<a class="dot_menu" id="dot_menu" ></a>
					</div>
					<div id="cont" class="cont" style="padding: 15px; white-space: break-spaces;">
											
					</div>
					<textarea rows="10" cols="30" id="insert_area" style="display: none; margin-top:10px;"></textarea>
				</div>
				
				
				<div class="form_wrap" id="btn_area" style="display: none;">
					<div class="btn_area">
						<button id="action_save" class="w50">저장</button>
    					<button id="action_cancel" class="w50">취소</button>
					</div>
				</div>
				
			</div>			

		</section>
	<div style="display: none;" id="cont_ori">
<pre>#{CSTNAME} 고객님
#{FLAG_TYPE_NAME} 신고 문의주셔서 감사드립니다. 

■ 예상납부세액
#{EXP_PAY_TAX} 원
- (마이너스)이면 환급금액입니다. 

■ 신고대행 수수료
#{EST_FEE} 원

▶ 접수방법
신고대행을 의뢰하시려면 아래의 카톡 링크를 클릭하셔서 
♥ ""본인이름"" 과  
인증코드번호 🍀""#{인증코드번호}"" 을 남겨주세요.   

예시) #{CSTNAME} #{인증코드번호}  

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다. 

▶ 카톡링크 
http://pf.kakao.com/_vexexkC/chat

■ 유의사항 
납부세액은 홈택스 기초값으로 계산된 세액이며, 부양가족여부, 타소득여부 등 추가 정보에 따라 실제 신고시에는 상이할 수 있습니다. 
이점 양해 부탁드립니다.</pre></div>	
	</div>
	
<div style="display: none;" id="cont_ori_phone">
<pre>#{CSTNAME} 고객님
#{FLAG_TYPE_NAME} 신고 문의주셔서 감사드립니다. 

■ 예상납부세액
#{EXP_PAY_TAX} 원
- (마이너스)이면 환급금액입니다. 

■ 신고대행 수수료
#{EST_FEE} 원

▶ 접수방법
신고대행을 의뢰하시려면 아래의 카톡 링크를 클릭하셔서 
♥ ""본인이름"" 과  
인증코드번호 🍀""#{인증코드번호}"" 을 남겨주세요.   

예시) #{CSTNAME} #{인증코드번호}  

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다. 

▶ 카톡링크 
http://pf.kakao.com/_vexexkC/chat

■ 유의사항 
납부세액은 홈택스 기초값으로 계산된 세액이며, 부양가족여부, 타소득여부 등 추가 정보에 따라 실제 신고시에는 상이할 수 있습니다. 
이점 양해 부탁드립니다.</pre></div>	


<div style="display: none;" id="cont_tmp1">
<pre>#{CSTNAME} 고객님 (하트)
[세무톡] 신승세무법인입니다. 
종합소득세 신고 문의주셔서 감사드립니다. 

■ 예상세액
#{EXP_PAY_TAX} 원
- (마이너스)이면 환급금액입니다. 

■ 신고대행 수수료
#{EST_FEE} 원  (부가세 포함)

▶ 접수방법
신고대행을 의뢰하시려면 
아래의 (카톡) 카톡 채팅창에 

♥ 【본인이름】과  
♥ 인증코드번호 
【#{인증코드번호}】을 남겨주세요.   

예시) #{CSTNAME}   #{인증코드번호}

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다. 

■ 유의사항 
예상납부세액은 홈택스 기초값으로 계산된 세액이며, 부양가족여부, 타소득여부 등 추가 정보에 따라 실제 신고시에는 상이할 수 있습니다. 
또한, 신고대행수수료는 서류 검토 후 조정될 수 있습니다. 
이점 양해 부탁드립니다.</pre></div>	
	

<div style="display: none;" id="cont_tmp2">
<pre>#{CSTNAME} 고객님 (하트)
[세무톡] 신승세무법인입니다. 
종합소득세 신고 문의주셔서 감사드립니다. 

■ 신고대행 수수료
#{EST_FEE} 원  (부가세 포함)

▶ 접수방법
신고대행을 의뢰하시려면 
아래의 (카톡) 카톡 채팅창에 

♥ 【본인이름】과  
♥ 인증코드번호 
【#{인증코드번호}】을 남겨주세요.   

예시) #{CSTNAME}   #{인증코드번호}

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다. 

■ 유의사항 
신고대행수수료는 서류 검토 후 조정될 수 있습니다. 
이점 양해 부탁드립니다.</pre></div>	



<div style="display: none;" id="cont_tmp3">
<pre>#{CSTNAME} 고객님 (하트)
[세무톡] 신승세무법인입니다. 
종합소득세 신고 문의주셔서 감사드립니다. 

■ 예상납부세액
#{EXP_PAY_TAX} 원
- (마이너스)이면 환급금액입니다. 
예상납부세액은 실제 납부금액과는 차이가 있습니다. 

▶ 접수방법
신고대행을 의뢰하시려면 
아래의 (카톡) 카톡 채팅창에 

♥ 【본인이름】과  
♥ 인증코드번호 
【#{인증코드번호}】을 남겨주세요.   

예시) #{CSTNAME}   #{인증코드번호}

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다. 

■ 유의사항 
예상납부세액은 홈택스 기초값으로 계산된 세액이며, 부양가족여부, 타소득여부 등 추가 정보에 따라 실제 신고시에는 상이할 수 있습니다.</pre></div>	
	


<div style="display: none;" id="cont_tmp4">
<pre>#{CSTNAME} 고객님 (하트)
[세무톡] 신승세무법인입니다. 
종합소득세 신고 문의주셔서 감사드립니다. 

상담 폭주로 인해 상담이 지연되는 점 양해부탁드립니다. 

▶ 빠른 상담안내 
빠른 상담을 원하시면 
아래의 (카톡) 카톡 채팅창에 

♥ 【본인이름】과  
♥ 인증코드번호 
【#{인증코드번호}】을 남겨주세요.   

예시) #{CSTNAME}   #{인증코드번호}

담당자가 신고관련 자세한 상담 및 필요서류, 처리절차 등을 안내해드리겠습니다.</pre></div>	


<div style="display: none;" id="cont_tmp5">
<pre>#{CSTNAME} 고객님 (하트)
[세무톡] 신승세무법인입니다. 
종합소득세 신고 문의주셔서 감사드립니다. 

홈택스에서 종합소득세 안내문을 조회하여 PDF파일로 다운받아 전달 부탁드립니다. 

(하트) 홈택스 안내문 조회방법

홈택스 로그인
> 조회/발급 
> 세금신고납부 
> 종합소득세 신고도움 서비스 
> [기본사항]과 [신고 참고자료]를 

조회가 어려우시면 저희가 조회하여 안내드리겠습니다. 
홈택스 아이디 / 패스워드를 알려주십시오. 

▶ 빠른 상담을 원하시면 
아래의 카톡 채팅창에 
♥ 【본인이름】 과  
♥ 인증코드번호 
【#{인증코드번호}】을 남겨주세요.   

예시) #{CSTNAME}   #{인증코드번호}</pre></div>	



<div style="display: none;" id="cont_tmp6">
<pre>[신고 및 납부기간]
#{REGDATE} 

미신고시 가산세가 부과되오니 꼭 신고하시길 안내드립니다. 
========================

#{CSTNAME} 고객님 (하트)
[세무톡] 신승세무법인입니다. 
종합소득세 신고 및 납부기간이 [임박]하여 안내올립니다. 


▶ 접수방법
신고대행을 의뢰하시려면 
아래의 (카톡) 카톡 채팅창에 

♥ 【본인이름】과  
♥ 인증코드번호 
【#{인증코드번호}】을 남겨주세요.   

예시) #{CSTNAME}   #{인증코드번호}

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다.</pre></div>	



<div style="display: none;" id="cont_tmp7">
<pre>#{CSTNAME} 고객님
[세무톡] 신승세무법인입니다. 
종합소득세 신고 대행 수수료가 아래와 같이 조정되어 안내드립니다. 

■ 조정 신고대행 수수료
#{EST_FEE} 원 (부가세 포함)

▶ 접수방법
신고대행을 의뢰하시려면 
아래의 (카톡) 카톡 채팅창에 

♥ 【본인이름】과  
♥ 인증코드번호 
【#{인증코드번호}】을 남겨주세요.   

예시) #{CSTNAME}   #{인증코드번호}

신고담당자가 수수료 입금계좌 및 필요서류를 안내해드리겠습니다.</pre></div>	
							
	
<input type="hidden" id = "STEP1">
<input type="hidden" id = "STEP2">

<input type="hidden" id = "STEP4">
<input type="hidden" id = "STEP5">
<input type="hidden" id = "STEP6">
<input type="hidden" id = "STEP7">
<input type="hidden" id = "STEP7-1">
<input type="hidden" id = "STEP8">
<input type="hidden" id = "STEP9">
<input type="hidden" id = "xpsrt">
<input type="hidden" id = "free_flag">
<input type="hidden" id = "auth_code">
<input type="hidden" id = "EST_FEE_LOCK">
</body>

<script>

isloading = {
  start: function() {
    if (document.getElementById('wfLoading')) {
      return;
    }
    var ele = document.createElement('div');
    ele.setAttribute('id', 'wfLoading');
    ele.classList.add('loading-layer');
    ele.innerHTML = '<span class="loading-wrap"><span class="loading-text"><span>.</span><span>.</span><span>.</span></span></span>';
    document.body.append(ele);

    // Animation
    ele.classList.add('active-loading');
  },
  stop: function() {
    var ele = document.getElementById('wfLoading');
    if (ele) {
      ele.remove();
    }
  }
}

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


function removeChar(event) { 
	event = event || window.event; 
	var keyID = (event.which) ? event.which : event.keyCode; 
	if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 ) { 
		return; 
	} else { //숫자만 입력 
		event.target.value = event.target.value.replace(/[^0-9]/g, ""); 
	} 
}

function inputNumberFormat(obj) { 
	obj.value = comma(obj.value); 
}


function comma(obj) { 
	var regx = new RegExp(/(-?\d+)(\d{3})/); 
	var bExists = obj.indexOf(".", 0); 
	var strArr = obj.split('.'); 
	while (regx.test(strArr[0])) { 
		strArr[0] = strArr[0].replace(regx, "$1,$2"); 
	} 

	if (bExists > -1) { 
		obj = strArr[0] + "." + strArr[1]; 
	} else { 
		obj = strArr[0]; 
	} 

	return obj; 
}

$(document).ready(function(){


	$("input:text[numberOnly]").on("focus", function() {
	    var x = $(this).val();
	    x = removeCommas(x);
	    $(this).val(x);
	}).on("focusout", function() {
	    var x = $(this).val();
	    if(x && x.length > 0) {
	        if(!$.isNumeric(x)) {
	            x = x.replace(/[^0-9]/g,"");
	        }
	        //x = addCommas(x);
	        $(this).val(x);
	    }
	}).on("keyup", function() {
	    $(this).val($(this).val().replace(/[^0-9]/g,""));
	});


	
	$(".sub_menu ul li a strong").on('click',function(){
		copyToClipboard($('#cont').html());
		$(".alarm_copy").show().delay(1000).fadeOut();
	})//추가

	$(".tit_toggle").on('click',function(){
		
		if($(this).next().is(":visible")){
			$(this).removeClass('open');
			$(this).addClass('close');
			$(this).siblings().slideUp();
		}

		else{
			$(this).removeClass('close');
			$(this).addClass('open');
			$(this).siblings().slideDown();
		}
	})
	
	
	if($(".sub_menu").hasClass("on")){			
			$(".contents").removeClass('wide');
			$('.menu').addClass("off");
		}
		else{
			$(".contents").addClass('wide');
			$('.menu').removeClass('off');
			

		}

	$('.menu').on("click",function(){	
		if($(".sub_menu").hasClass("on")){				
			$(".sub_menu").removeClass('on');
			$(".contents").addClass('wide');
			$(this).removeClass('off');
			$("#insert_area").attr("cols","43");
		}
		else{
			$(".sub_menu").addClass('on');
			$(".contents").removeClass('wide');
			$(this).addClass('off');
			$("#insert_area").attr("cols","30");
		}
	})
	


	
	$('#action').click(function () {
		//alert($('#content').html());
		copyToClipboard($('#cont').html());
		//alert('복사완료');
		$(".alarm_copy").show().delay(1000).fadeOut();
	});


	
	
	$('#TAB1').click(function () {
		
		$("#BTN_TAB1").css("display","block");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_TAB6").css("display","none");
		$("#BTN_TAB7").css("display","none");
		$("#BTN_TAB8").css("display","none");
		$("#BTN_MY").css("display","none");
		resize("TAB1");
		open_left();
		
	});


	$('#TAB2').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","block");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_TAB6").css("display","none");
		$("#BTN_TAB7").css("display","none");
		$("#BTN_TAB8").css("display","none");
		$("#BTN_MY").css("display","none");
		resize("TAB2");
		close_left();
	
	});

	$('#TAB3').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","block");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_TAB6").css("display","none");
		$("#BTN_TAB7").css("display","none");
		$("#BTN_TAB8").css("display","none");
		$("#BTN_MY").css("display","none");
		resize("TAB3");
		open_left();
		
	});

	$('#TAB4').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","block");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_TAB6").css("display","none");
		$("#BTN_TAB7").css("display","none");
		$("#BTN_TAB8").css("display","none");
		$("#BTN_MY").css("display","none");
		resize("TAB4");
		open_left();
		
	});

	$('#TAB5').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","block");
		$("#BTN_TAB6").css("display","none");
		$("#BTN_TAB7").css("display","none");
		$("#BTN_TAB8").css("display","none");
		$("#BTN_MY").css("display","none");
		resize("TAB5");
		open_left();
	});

	$('#TAB6').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_TAB6").css("display","block");
		$("#BTN_TAB7").css("display","none");
		$("#BTN_TAB8").css("display","none");
		$("#BTN_MY").css("display","none");
		resize("TAB6");
		open_left();
	});

	$('#TAB7').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_TAB6").css("display","none");
		$("#BTN_TAB7").css("display","block");
		$("#BTN_TAB8").css("display","none");
		$("#BTN_MY").css("display","none");
		resize("TAB7");
		open_left();
	});

	$('#TAB8').click(function () {
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_TAB6").css("display","none");
		$("#BTN_TAB7").css("display","none");
		$("#BTN_TAB8").css("display","block");
		$("#BTN_MY").css("display","none");
		resize("TAB8");
		open_left();
	});

	$('#TAB_MY').click(function () {
		
		$("#BTN_TAB1").css("display","none");
		$("#BTN_TAB2").css("display","none");
		$("#BTN_TAB3").css("display","none");
		$("#BTN_TAB4").css("display","none");
		$("#BTN_TAB5").css("display","none");
		$("#BTN_TAB6").css("display","none");
		$("#BTN_TAB7").css("display","none");
		$("#BTN_TAB8").css("display","none");
		$("#BTN_MY").css("display","block");
		resize("TAB_MY");
		open_left();
	});



	$('#HT_PW').focusout(function() {
		cal_btn_click();
	});

	$('#HT_PW_p').focusout(function() {
		cal_btn_click_p();
	});
	

	$('#btn_cal').click(function () {
		cal_btn_click();
	});

	$('#btn_p').click(function () {
		cal_btn_click_p();
	});


	$('#btn_save').click(function () {
		var cstname = $("#cstname_cal").val();
		var mobile = $("#mobile_cal").val();
		var hometaxid = $("#HT_ID").val();
		var hometaxpw = $("#HT_PW").val();
		var total_paid = $("#EXT_PAID").val();
		var est_tax = uncomma($("#EST_TAX").html());
		var est_fee = uncomma($("#EST_FEE").html());
		var action = "action_tok_cst_save";
		var request = new Request();
		var userid = request.getParameter("id");

		if($("#EST_FEE").html() == "별도협의")
			est_fee=-9999;
		
		if(cstname !="" && mobile !=""){
			$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"../action.php", 
					method:"POST",
					data:{userid:userid,action:action,cstname:cstname, mobile:mobile, total_paid:total_paid, 
						hometaxid:hometaxid, hometaxpw:hometaxpw, est_tax:est_tax, est_fee:est_fee},
					success:function(data){
						alert(data);
						$(".alarm_copy2").show().delay(1000).fadeOut();
						//window.location.reload();
						//clear();
						$("#btn_kakao").css("background","#4052B1");
						$("#btn_kakao").removeAttr("disabled");
								
					}
				});
		}else{
			if(cstname == "")
				alert("임시저장시에는 고객명을 넣어야합니다.");
			else
				alert("필수값이 누락되었습니다.");			
		}
			
	});



	$('#btn_save_p').click(function () {
		var request = new Request();
		var cstname = $("#cstname_p").val();
		var mobile = $("#mobile_p").val();
		var hometaxid = $("#HT_ID_p").val();
		var hometaxpw = $("#HT_PW_p").val();
		var sector = $("#sector_p").val();
		var total_paid = $("#total_paid_p").val();
		var dvdnIncAmtYn = "N";
		var intrIncAmtYn = "N";
		var dblErinAmtYn = "N";
		var erinAmtYn = "N";
		var pnsnIncAmtYn = "N";
		var etcIncAmtYn = "N";
		var memo = $("#insert_area_p").val();
		var est_tax = uncomma($("#EST_TAX_p").val());
		var est_fee = uncomma($("#EST_FEE_p").val());
		var reg_branch = $("#reg_branch_phone").val();
		var action = "action_phone_cst_save_p";
		var userid = request.getParameter("id");
		var pro_flag = $("#PRO_FLAG_p").val();

		if($("#dvdnIncAmtYn_p").is(":checked")) dvdnIncAmtYn = "Y";
		if($("#intrIncAmtYn_p").is(":checked")) intrIncAmtYn = "Y";
		if($("#dblErinAmtYn_p").is(":checked")) dblErinAmtYn = "Y";
		if($("#erinAmtYn_p").is(":checked")) erinAmtYn = "Y";
		if($("#pnsnIncAmtYn_p").is(":checked")) pnsnIncAmtYn = "Y";
		if($("#etcIncAmtYn_p").is(":checked")) etcIncAmtYn = "Y";
			
		if($("#EST_FEE").html() == "별도협의")
			est_fee=-9999;

		var reg_branch = $("#select_send_kakao").val();
		if(cstname !="" && mobile !="" ){
			$.ajax({
				//insert page로 위에서 받은 데이터를 넣어준다.
					url:"../action.php", 
					method:"POST",
					data:{cstname:cstname, mobile:mobile, hometaxid:hometaxid, hometaxpw:hometaxpw, sector:sector, 
						total_paid:total_paid, dvdnIncAmtYn:dvdnIncAmtYn, intrIncAmtYn:intrIncAmtYn, dblErinAmtYn:dblErinAmtYn, 
						erinAmtYn:erinAmtYn, pnsnIncAmtYn:pnsnIncAmtYn, etcIncAmtYn:etcIncAmtYn, memo:memo, est_tax:est_tax, 
						est_fee:est_fee, action:action, userid:userid,reg_branch:reg_branch, pro_flag:pro_flag},
					success:function(data){
						//alert(data);
						send_kakao_branch_p(reg_branch);
						$(".alarm_copy2").show().delay(1000).fadeOut();
						//window.location.reload();
						//clear();
						$("#btn_kakao_p").css("background","#4052B1");
						$("#btn_kakao_p").removeAttr("disabled");		
					}
				});
		}else{
			alert("필수값이 누락되었습니다.");

			if(cstname == "")
				$("#cstname_p").focus();
			else{
				if(mobile == ""){
					$("#mobile_p").focus();
				}else{
					$("#select_send_kakao").focus();
				}
			}
						
		}
			
	});

	


	
	
	$('#btn_new_cst').click(function () {
		var cstname = $("#cstname").val();
		var mobile = $("#mobile").val();
		var sec_type = $("#sec_type").val();
		var total_paid = $("#total_paid").val();
		var hometaxid = $("#hometaxid").val();
		var hometaxpw = $("#hometaxpw").val();
		var inf_channel = $("#inf_channel").val();
		var reg_branch = $("#reg_branch").val();
		var memo = $("#memo").val();
		var action = "action_tok_cst_save";
		var request = new Request();
		var userid = request.getParameter("id");
		var est_tax = 0;
		var est_fee = 0;
		
		$.ajax({
			//insert page로 위에서 받은 데이터를 넣어준다.
				url:"../action.php", 
				method:"POST",
				data:{userid:userid,action:action,cstname:cstname, mobile:mobile, sec_type:sec_type, total_paid:total_paid,
					hometaxid:hometaxid, hometaxpw:hometaxpw, reg_branch:reg_branch,memo:memo,est_tax:est_tax,est_fee:est_fee,inf_channel:inf_channel},
				success:function(data){
					if(reg_branch!="")
						send_kakao_branch(reg_branch);
					
					alert(data);
					window.location.reload();		
				}
			});	
	});


	

	$('#action_save').click(function () {
		var request = new Request();
		var id = request.getParameter("id");
		var action = "action_add_memu";
		var contents =  $('#insert_area').val();
		var subject = $("#menu_subject").val();
		var subject2 = $("#menu_subject2").val();

		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../action.php", 
			method:"POST",
			data:{id:id,action:action,contents:contents, subject:subject, subject2:subject2},
			success:function(data){
				alert(data);
				window.location.reload();		
				//fetchUser();
				//fetchUser_my();	
			}
		});	
	});


	$('#action_cancel').click(function () {
		$('#cont').html("");
		$('#menu_subject').css('display','none');
		$('#menu_subject2').css('display','none');
		$('#insert_area').css('display','none');
		$('#btn_area').css('display','none');
		$('#action').css('display','block');
		$('#cont').css('display','block');
	});


	$('#btn_kakao').click(function () {
		kakao_send();
	});

	$('#btn_kakao_p').click(function () {
		kakao_send_p();
	});

	$('#dvdnIncAmtYn').change(function(){ //사업소득 외 합산대상 타소득자료 우무 - 배당
		add_cal_1();
		
	});

	$('#intrIncAmtYn').change(function(){ // 사업소득 외 합산대상 타소득자료 우무 - 이자
		add_cal_1();
		
	});

	$('#dblErinAmtYn').change(function(){
		add_cal_1();
	});

	$('#erinAmtYn').change(function(){
		add_cal_1();
	});

	$('#pnsnIncAmtYn').change(function(){
		add_cal_1();
	});

	$('#etcIncAmtYn').change(function(){
		add_cal_1();
	});

	$('#dvdnIncAmtYn_p').change(function(){ //사업소득 외 합산대상 타소득자료 우무 - 배당
		add_cal_2();
		
	});

	$('#intrIncAmtYn_p').change(function(){ // 사업소득 외 합산대상 타소득자료 우무 - 이자
		add_cal_2();
		
	});

	$('#dblErinAmtYn_p').change(function(){
		add_cal_2();
	});

	$('#erinAmtYn_p').change(function(){
		add_cal_2();
	});

	$('#pnsnIncAmtYn_p').change(function(){
		add_cal_2();
	});

	$('#etcIncAmtYn_p').change(function(){
		add_cal_2();
	});

	$('#EST_FEE_p').change(function(){
		auto_fee_p()();
	});


	

	$('#select_send_kakao').change(function(){
		

		var flag = $("#select_send_kakao").val();
		var tmp_cont = "";
		var cstname = $("#cstname_p").val();
		var exp_pay_tax = $("#EST_TAX_p").html();
		var est_fee = addCommas( $("#EST_FEE_p").val() );
		var cstname = $("#cstname_p").val();
		var auth_code = $('#auth_code').val();
		var regdate = "~ 2022년 5월 31일 (화)";
		var content = ""; 

		switch(flag){
		case 'bizp_2022042113590613488325669' : 
			content = $("#cont_tmp1").html();
			content = content.replace(/#{CSTNAME}/g,cstname);
			content = content.replace("#{EXP_PAY_TAX}",exp_pay_tax);
			content = content.replace("#{EST_FEE}",est_fee);
			content = content.replace(/#{인증코드번호}/g,auth_code);
			
		break;
		case 'bizp_2022042114014314053182657' : 
			content = $("#cont_tmp2").html();
			content = content.replace(/#{CSTNAME}/g,cstname);
			content = content.replace("#{EST_FEE}",est_fee);
			content = content.replace(/#{인증코드번호}/g,auth_code);
			
		break;
		case 'bizp_2022042114030514053585658' : 
			content = $("#cont_tmp3").html();
			content = content.replace(/#{CSTNAME}/g,cstname);
			content = content.replace("#{EXP_PAY_TAX}",exp_pay_tax);
			content = content.replace(/#{인증코드번호}/g,auth_code);
			
		break;
		case 'bizp_2022042114073514053486659' : 
			content = $("#cont_tmp4").html();
			content = content.replace(/#{CSTNAME}/g,cstname);
			content = content.replace(/#{인증코드번호}/g,auth_code);

		break;
		case 'bizp_2022042114114213488987672' : 
			content = $("#cont_tmp5").html();
			content = content.replace(/#{CSTNAME}/g,cstname);
			content = content.replace(/#{인증코드번호}/g,auth_code);
			
		break;
		case 'bizp_2022042114131114053954660' : 
			content = $("#cont_tmp6").html();
			content = content.replace(/#{CSTNAME}/g,cstname);
			content = content.replace(/#{인증코드번호}/g,auth_code);
			content = content.replace(/#{REGDATE}/g,regdate);
			
		break;
		case 'bizp_2022042114151414053069663' : 
			content = $("#cont_tmp2").html();
			content = content.replace(/#{CSTNAME}/g,cstname);
			content = content.replace("#{EST_FEE}",est_fee);
			content = content.replace(/#{인증코드번호}/g,auth_code);
			
		break;
		}

		content = content.replace("<pre>","");
		content = content.replace("</pre>","");
		$("#cont").html(content);
			
	});

	
	
	

	
	
});


function add_cal_1(){
	var est_fee = uncomma($('#EST_FEE_LOCK').val());
	var num = $('input[name="ynck"]:checked').length;
	var total = 0;

	total += (num*55000)+est_fee;

	if( $('#dblErinAmtYn').prop('checked')  )
		total += 55000;

	if( $('#dvdnIncAmtYn').prop('checked')  )
		total += 55000;

	if( $('#intrIncAmtYn').prop('checked')  )
		total += 55000;
	
	$('#EST_FEE').html(addCommas(total))
	
}



function add_cal_2(){
	var est_fee = uncomma($('#EST_FEE_LOCK').val());
	var num = $('input[name="ynck2"]:checked').length;
	var total = 0;

	total += (num*55000)+est_fee;

	if( $('#dblErinAmtYn_p').prop('checked')  )
		total += 55000;

	if( $('#dvdnIncAmtYn_p').prop('checked')  )
		total += 55000;

	if( $('#intrIncAmtYn_p').prop('checked')  )
		total += 55000;
	
	
	$('#EST_FEE_p').html(addCommas(total))
	
}


function clear(){
	$('#cstname_cal').val('');
	$('#mobile_cal').val('');
	$('#HT_ID').val('');
	$('#HT_PW').val('');
	$('#EXT_PAID').val('');
	$('#EXT_RATIO').val('');
	$('#EXT_ADD_TAX').val('');
	$('#DEL_PRICE').val('');
	$('#STEP3').html('');
	$('#EST_TAX').html('');
	$('#EST_FEE').html('');
	$('#cstname_p').val('');
	$('#mobile_p').val('');
	$('#HT_ID_p').val('');
	$('#HT_PW_p').val('');
	$('#EXT_PAID_p').val('');
	$('#EXT_RATIO_p').val('');
	$('#EXT_ADD_TAX_p').val('');
	$('#DEL_PRICE_p').val('');
	$('#STEP3_p').html('');
	$('#EST_TAX_p').html('');
	$('#EST_FEE_p').html('');

	$('#STEP1').val('');
	$('#STEP2').val('');
	$('#STEP4').val('');
	$('#STEP5').val('');
	$('#STEP6').val('');
	$('#STEP7').val('');
	$('#STEP7-1').val('');
	$('#STEP8').val('');
	$('#STEP9').val('');
	$('#xpsrt').val('');
	$('#free_flag').val('');
	$('#auth_code').val('');
	$('#EST_FEE_LOCK').val('');
	
}


function resize(flag){
  var vwidth = 0;
  var vheight = 0;

  if(flag == "TAB_MY")
  	$("#dot_menu").attr("href","javascript:del_my_meny();");
  else
    $("#dot_menu").removeAttr("href");

  

  if(flag=="")
	  flag="TAB1";

  	switch(flag){
  	case "TAB1" : 
  	  	vwidth = 600;
  	  	vheight = 1400;
  	  	break;
  	case "TAB2" : 
  	  	vwidth = 600;
  	  	vheight = 1700;
  	  	break;
  	case "TAB3" : 
  	  	vwidth = 600;
  	  	vheight = 1950;
  	  	break;
  	case "TAB4" : 
  	  	vwidth = 600;
  	  	vheight = 800;
  	  	break;
  	case "TAB5" : 
  	  	vwidth = 600;
  	  	vheight = 1850;
  	  	break;
  	case "TAB6" : 
  	  	vwidth = 600;
  	  	vheight = 1450;
  	  	break;
  	case "TAB7" : 
  	  	vwidth = 600;
  	  	vheight = 1550;
  	  	break;
  	case "TAB8" : 
  	  	vwidth = 600;
  	  	vheight = 750;
  	  	break;
  	case "TAB_MY" : 
  	  	vwidth = 600;
  	  	vheight = 1000;
  	  	break;
  	  	  	
  	}

  	
    

	//resize
	window.resizeTo( vwidth, vheight );
	
}

function isEmpty(str){
    
    if(typeof str == "undefined" || str == null || str == "")
        return true;
    else
        return false ;
}


function addCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function change_class_menu(obj){
	//var id = $(obj).attr("id");
	var parents = $(obj).parents().attr("id");
	//alert(parents);
	$("#"+parents).children().removeClass("on");
	$(obj).addClass("on");
}

function change_class(obj){
	var id = $(obj).attr("id");
	var text = $(obj).attr("value");

	$('#h1_text').html(text);
	
	$("#TAB1").removeClass("on");
	$("#TAB2").removeClass("on");
	$("#TAB3").removeClass("on");
	$("#TAB4").removeClass("on");
	$("#TAB5").removeClass("on");
	$("#TAB6").removeClass("on");
	$("#TAB7").removeClass("on");
	$("#TAB8").removeClass("on");
	$("#TAB_MY").removeClass("on");

	$(obj).addClass("on");

	
	
}

function copyToClipboard(val) {
	  const t = document.createElement("textarea");
	  document.body.appendChild(t);
	  t.value = val;
	  t.select();
	  document.execCommand('copy');
	  document.body.removeChild(t);
}


function fetchUser_my(){
	var request = new Request();
	var userid = request.getParameter("id");
	var action = "select_menu_pop_my";
	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"../select.php",
		method:"POST",
		data:{action:action, userid:userid},
		success:function(data)
		{
			console.log(data);
			$('#result').append(data);
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


function add_menu(){

	$("#btn_area").css("display","block");
	$("#menu_subject").css("display","block");
	$("#menu_subject2").css("display","block");
	$("#insert_area").css("display","block");
	$("#btn_area").css("display","block");
	$("#action").css("display","none");
	$("#cont").css("display","none");
	$('#cst_insert_form').css("display","none");
	$('#cal_form').css("display","none");
	$('#div_btn1').css("display","none");
	$('#div_btn2').css("display","none");
	$('#div_btn3').css("display","none");
	$('#div_cal').css("display","none");
	
	 
}

function fetchUser(){
	var action = "select_menu_pop";
	
	//users 리스트를 select.php 에서 받아온다.
	$.ajax({
		url:"../select.php",
		method:"POST",
		data:{action:action},
		success:function(data)
		{
			console.log(data);
			$('#result').html(data);
			$("#TAB1").addClass("on");
			$('#h1_text').html("채널톡");
			fetchUser_my();
			resize("TAB1");
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}

function cp_content(id){
	var action = "select_content";
	//var id = $(obj).attr("value");
	//$('#cont').html("");
	
	$.ajax({
		url:"../select.php",
		method:"POST",
		dataType:"json",
		data:{action:action, id:id},
		success:function(data)
		{
			console.log(data);
			//$('#cont').html(data);
			copyToClipboard(data.CONTENT);
			//alert('복사완료');
			$(".alarm_copy").show().delay(1000).fadeOut();
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}


function load_content(obj){
	//alert($(obj).attr("value"));
	change_class_menu(obj);
	var action = "select_content";
	var id = $(obj).attr("value");
	$('#cont').html("");
	$('#menu_subject').css('display','none');
	$('#menu_subject2').css('display','none');
	$('#insert_area').css('display','none');
	$('#btn_area').css('display','none');
	$('#action').css('display','block');
	$('#cont').css('display','block');
	
	$.ajax({
		url:"../select.php",
		method:"POST",
		dataType:"json",
		data:{action:action, id:id},
		success:function(data)
		{
			console.log(data);
			$('#cont').html(data.CONTENT);
			$('#sub_title').html(data.SUBJECT);
			$('#del_id').val(data.ID);

			if(data.ID == "7"){ // 전문상담
				$('#cst_insert_form').css("display","block");
				$('#div_btn1').css("display","block");

				$('#cal_form').css("display","none");
				$('#div_btn2').css("display","none");
				$('#div_btn3').css("display","none");
				$('#div_cal').css("display","none");
			}else if(data.ID =="8"){ // 에상세액게산기
				$('#cal_form').css("display","block");
				$('#div_btn2').css("display","block");
				$('#div_btn3').css("display","block");
				$('#div_cal').css("display","block");

				$('#cst_insert_form').css("display","none");
				$('#div_btn1').css("display","none");
			}else{ // 그외
				$('#cst_insert_form').css("display","none");
				$('#cal_form').css("display","none");
				$('#div_btn1').css("display","none");
				$('#div_btn2').css("display","none");
				$('#div_btn3').css("display","none");
				$('#div_cal').css("display","none");
			}
				
			
		},error : function(request, status, error ){
			// 오류가 발생했을 때 호출된다.
			console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
		}
	})
}

function del_my_meny(){
	
	var id = $('#del_id').val();
	var subject = $('#sub_title').html();
	var action = "action_mymenu_del";

	if(id != ""){
		if(window.confirm("'" +subject + "' 메뉴를 삭제하시겠습니까?")){
			
			$.ajax({
				url:"../action.php",
				method:"POST",
				data:{action:action, id:id},
				success:function(data)
				{
					console.log(data);
					alert(data);


					window.location.reload();
										
					
				},error : function(request, status, error ){
					// 오류가 발생했을 때 호출된다.
					console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			})
		}
	}
}

function uncomma(str) { 
	str = "" + str.replace(/,/gi, ''); 
	str = str.replace(/(^\s*)|(\s*$)/g, ""); 
	return (new Number(str));//문자열을 숫자로 반환 
}


function auto_cal_fee(tax){
	const today = new Date();   
	const date1 = new Date("2022-4-15");
	const date2 = new Date("2022-5-20");
	var xpsrt = $('#xpsrt').val();
	var free_flag = $('#free_flag').val();
	var tax = uncomma(tax.toString());

	//if(today > date1 && today < date2){
	if(today > date1 && today < date2){
		if(xpsrt.indexOf("단순")>-1){
			$('#EST_FEE').html("55,000"); // 단순경비율
			$('#auth_code').val("0551"); // 인증코드
		}else{

			if(free_flag == "프리"){
				if(tax < 30000000){ // 3천만원미만
					$('#EST_FEE').html("88,000");
					$('#auth_code').val("0881"); // 인증코드
				}else if(tax >= 30000000 && tax < 40000000){ // 4천만원미만
					$('#EST_FEE').html("110,000");
					$('#auth_code').val("1101"); // 인증코드
				}else if(tax >= 40000000 && tax < 50000000){ // 5천만원미만
					$('#EST_FEE').html("165,000");
					$('#auth_code').val("1651"); // 인증코드
				}else if(tax >= 50000000 && tax < 60000000){ // 6천만원미만
					$('#EST_FEE').html("220,000");
					$('#auth_code').val("2201"); // 인증코드
				}else if(tax >= 60000000){ // 6천만원이상
					$('#EST_FEE').html("별도협의");
					$('#auth_code').val("0011"); // 인증코드
				}
			}else{

				if(tax < 30000000){ // 3천만원미만
					$('#EST_FEE').html("143,000");
					$('#auth_code').val("1431"); // 인증코드
				}else if(tax >= 30000000 && tax < 40000000){ // 4천만원미만
					$('#EST_FEE').html("165,000");
					$('#auth_code').val("1651"); // 인증코드
				}else if(tax >= 40000000 && tax < 50000000){ // 5천만원미만
					$('#EST_FEE').html("220,000");
					$('#auth_code').val("2201"); // 인증코드
				}else if(tax >= 50000000 && tax < 60000000){ // 6천만원미만
					$('#EST_FEE').html("275,000");
					$('#auth_code').val("2751"); // 인증코드
				}else if(tax >= 60000000){ // 6천만원이상
					$('#EST_FEE').html("별도협의");
					$('#auth_code').val("0011"); // 인증코드
				} 
			}
				
		}
	}

	cal_add_fee();
}




function auto_cal_fee_p(tax){
	const today = new Date();   
	const date1 = new Date("2022-4-15");
	const date2 = new Date("2022-5-31");
	var xpsrt = $('#xpsrt').val();
	var free_flag = $('#free_flag').val();
	var tax = uncomma(tax.toString());

	//if(today > date1 && today < date2){
	if(today > date1 && today < date2){
		if(xpsrt.indexOf("단순")>-1){
			$('#EST_FEE_p').html("55,000"); // 단순경비율
			$('#auth_code').val("0552"); // 인증코드
		}else{

			if(free_flag == "프리"){
				if(tax < 30000000){ // 3천만원미만
					$('#EST_FEE_p').html("88,000");
					$('#auth_code').val("0882"); // 인증코드
				}else if(tax >= 30000000 && tax < 40000000){ // 4천만원미만
					$('#EST_FEE_p').html("110,000");
					$('#auth_code').val("1102"); // 인증코드
				}else if(tax >= 40000000 && tax < 50000000){ // 5천만원미만
					$('#EST_FEE_p').html("165,000");
					$('#auth_code').val("1652"); // 인증코드
				}else if(tax >= 50000000 && tax < 60000000){ // 6천만원미만
					$('#EST_FEE_p').html("220,000");
					$('#auth_code').val("2202"); // 인증코드
				}else if(tax >= 60000000){ // 6천만원이상
					$('#EST_FEE_p').html("별도협의");
					$('#auth_code').val("0012"); // 인증코드
				}
			}else{

				if(tax < 30000000){ // 3천만원미만
					$('#EST_FEE_p').html("143,000");
					$('#auth_code').val("1432"); // 인증코드
				}else if(tax >= 30000000 && tax < 40000000){ // 4천만원미만
					$('#EST_FEE_p').html("165,000");
					$('#auth_code').val("1652"); // 인증코드
				}else if(tax >= 40000000 && tax < 50000000){ // 5천만원미만
					$('#EST_FEE_p').html("220,000");
					$('#auth_code').val("2202"); // 인증코드
				}else if(tax >= 50000000 && tax < 60000000){ // 6천만원미만
					$('#EST_FEE_p').html("275,000");
					$('#auth_code').val("2752"); // 인증코드
				}else if(tax >= 60000000){ // 6천만원이상
					$('#EST_FEE_p').html("별도협의");
					$('#auth_code').val("0012"); // 인증코드
				} 
			}
				
		}
	}

	cal_add_fee_p();
}


function auto_fee_p(){

	var est_fee = $('#EST_FEE_p').val();

	switch(est_fee){
	case '55000' : 
		$('#auth_code').val("0552"); // 인증코드
	break;
	case '88000' : 
		$('#auth_code').val("0882"); // 인증코드
	break;
	case '110000' : 
		$('#auth_code').val("1102"); // 인증코드
	break;
	case '143000' : 
		$('#auth_code').val("1432"); // 인증코드
	break;
	case '165000' : 
		$('#auth_code').val("1652"); // 인증코드
	break;
	case '198000' : 
		$('#auth_code').val("1982"); // 인증코드
	break;
	case '220000' : 
		$('#auth_code').val("2202"); // 인증코드
	break;
	case '275000' : 
		$('#auth_code').val("2752"); // 인증코드
	break;
	case '330000' : 
		$('#auth_code').val("3302"); // 인증코드
	break;
	case '385000' : 
		$('#auth_code').val("3852"); // 인증코드
	break;
	case '440000' : 
		$('#auth_code').val("4402"); // 인증코드
	break;
	case '495000' : 
		$('#auth_code').val("4952"); // 인증코드
	break;
	case '550000' : 
		$('#auth_code').val("5502"); // 인증코드
	break;
	case '605000' : 
		$('#auth_code').val("6052"); // 인증코드
	break;
	case '660000' : 
		$('#auth_code').val("6602"); // 인증코드
	break;
	case '770000' : 
		$('#auth_code').val("7702"); // 인증코드
	break;
	case '880000' : 
		$('#auth_code').val("8802"); // 인증코드
	break;
	case '990000' : 
		$('#auth_code').val("9902"); // 인증코드
	break;
	case '1100000' : 
		$('#auth_code').val("11002"); // 인증코드
	break;
	case '1200000' : 
		$('#auth_code').val("12002"); // 인증코드
	break;
	case '1300000' : 
		$('#auth_code').val("13002"); // 인증코드
	break;
	case '1400000' : 
		$('#auth_code').val("14002"); // 인증코드
	break;
	case '1500000' : 
		$('#auth_code').val("15002"); // 인증코드
	break;
	case '1600000' : 
		$('#auth_code').val("16002"); // 인증코드
	break;
	case '1700000' : 
		$('#auth_code').val("17002"); // 인증코드
	break;
	case '1800000' : 
		$('#auth_code').val("18002"); // 인증코드
	break;
	case '1900000' : 
		$('#auth_code').val("19002"); // 인증코드
	break;
	case '2000000' : 
		$('#auth_code').val("20002"); // 인증코드
	break;
	case '2100000' : 
		$('#auth_code').val("21002"); // 인증코드
	break;
	case '2200000' : 
		$('#auth_code').val("22002"); // 인증코드
	break;
	case '-9999' : 
		$('#auth_code').val("0012"); // 인증코드
	break;
	default:
		$('#auth_code').val("0012"); // 인증코드
	break;

	}

}
function cal_add_fee(){

	if($('#EST_FEE').html() != "별도협의"){
		var est_fee_tmp1 = uncomma($('#EST_FEE').html());
		$('#EST_FEE_LOCK').val( $('#EST_FEE').html() );
		var add_fee = 0;

		if($('#dvdnIncAmtYn').is(':checked') && $('#intrIncAmtYn').is(':checked') )
			add_fee += 220000;
		
		if($('#dblErinAmtYn').is(':checked')) add_fee += 55000;
		
		if($('#erinAmtYn').is(':checked')) add_fee += 55000;
		
		if($('#pnsnIncAmtYn').is(':checked')) add_fee += 55000;
		
		if($('#etcIncAmtYn').is(':checked')) add_fee += 55000;
		
		
		$('#EST_FEE').html( addCommas(est_fee_tmp1+add_fee) );
		

	}
}


function cal_add_fee_p(){

	if($('#EST_FEE_p').html() != "별도협의"){
		var est_fee_tmp1 = uncomma($('#EST_FEE_p').html());
		$('#EST_FEE_LOCK').val( $('#EST_FEE_p').html() );
		var add_fee = 0;

		if($('#dvdnIncAmtYn_p').is(':checked') && $('#intrIncAmtYn_p').is(':checked') )
			add_fee += 220000;
		
		if($('#dblErinAmtYn_p').is(':checked')) add_fee += 55000;
		
		if($('#erinAmtYn_p').is(':checked')) add_fee += 55000;
		
		if($('#pnsnIncAmtYn_p').is(':checked')) add_fee += 55000;
		
		if($('#etcIncAmtYn_p').is(':checked')) add_fee += 55000;
		
		
		$('#EST_FEE_p').html( addCommas(est_fee_tmp1+add_fee) );
		

	}
}



function CAL_AUTO(){
	var total_money =  $("#EXT_PAID").val() ;
	auto_cal_fee(total_money);
	var ratio = 100- $("#EXT_RATIO").val() ;
	var result_step1 = Math.round(uncomma(total_money) * (ratio/100)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step2 = $("#DEL_PRICE").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step3 = ( uncomma(result_step1) - uncomma(result_step2) ).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step8 = $("#EXT_ADD_TAX").val();
	var result_step9 = 0;
	

	//alert(result_step1);
	$("#STEP1").val(result_step1);
	$("#STEP2").val(result_step2);
	
	if(uncomma(result_step3) < 0){
		result_step3 = 0;
		$("#STEP3").html("0");
		$("#STEP6").val("0");
	}else{
		$("#STEP3").html(result_step3);
		$("#STEP6").val("70,000");
	}

	cal_tax_avr(uncomma(result_step1) - uncomma(result_step2));
	cal_step3_new(uncomma(result_step3.toString()));
	

	var result_step7 = (uncomma( $("#STEP5").val() ) - uncomma( $("#STEP6").val() ) ).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') ;
	if(uncomma(result_step7) < 0)
		result_step7 = 0;
	
	$("#STEP7").val( result_step7 );
	$("#STEP7_1").val( result_step7 );
	$("#STEP8").val( result_step8 );


	if(uncomma(result_step7.toString()) > 0)
		result_step9 = uncomma(result_step7) - uncomma( $("#EXT_ADD_TAX").val() );
	else
		result_step9 = 0 - uncomma( $("#EXT_ADD_TAX").val());
	
	$("#EST_TAX").html( result_step9.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') );

	reload_content();
}




function CAL_AUTO_p(){
	var total_money =  $("#EXT_PAID_p").val() ;
	auto_cal_fee_p(total_money);
	var ratio = 100- $("#EXT_RATIO_p").val() ;
	var result_step1 = Math.round(uncomma(total_money) * (ratio/100)).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step2 = $("#DEL_PRICE_p").val().toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step3 = ( uncomma(result_step1) - uncomma(result_step2) ).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
	var result_step8 = $("#EXT_ADD_TAX_p").val();
	var result_step9 = 0;
	

	//alert(result_step1);
	$("#STEP1").val(result_step1);
	$("#STEP2").val(result_step2);
	
	if(uncomma(result_step3) < 0){
		result_step3 = 0;
		$("#STEP3").html("0");
		$("#STEP6").val("0");
	}else{
		$("#STEP3").html(result_step3);
		$("#STEP6").val("70,000");
	}

	cal_tax_avr(uncomma(result_step1) - uncomma(result_step2));
	cal_step3_new(uncomma(result_step3.toString()));
	

	var result_step7 = (uncomma( $("#STEP5").val() ) - uncomma( $("#STEP6").val() ) ).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') ;
	if(uncomma(result_step7) < 0)
		result_step7 = 0;
	
	$("#STEP7").val( result_step7 );
	$("#STEP7_1").val( result_step7 );
	$("#STEP8").val( result_step8 );


	if(uncomma(result_step7.toString()) > 0)
		result_step9 = uncomma(result_step7) - uncomma( $("#EXT_ADD_TAX_p").val() );
	else
		result_step9 = 0 - uncomma( $("#EXT_ADD_TAX_p").val());
	
	$("#EST_TAX_p").html( result_step9.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') );

	reload_content_p();
}





function reload_content(){
	var content = $("#cont_ori").html();
	var cstname = $("#cstname_cal").val();
	var flag_type_name ="종합소득세";
	var exp_pay_tax = $("#EST_TAX").html();
	var est_fee=$("#EST_FEE").html();
	var auth_code = $('#auth_code').val(); // 인증코드

	content = content.replace(/#{CSTNAME}/g,cstname);
	content = content.replace("#{FLAG_TYPE_NAME} ",flag_type_name);
	content = content.replace("#{EXP_PAY_TAX}",exp_pay_tax);
	content = content.replace("#{EST_FEE}",est_fee);
	content = content.replace(/#{인증코드번호}/g,auth_code);

	$("#cont").html(content);
	
}




function reload_content_p(){
	var content = $("#cont_ori").html();
	var cstname = $("#cstname_p").val();
	var flag_type_name ="종합소득세";
	var exp_pay_tax = $("#EST_TAX_p").html();
	var est_fee= addCommas($("#EST_FEE_p").val());
	var auth_code = $('#auth_code').val(); // 인증코드

	content = content.replace(/#{CSTNAME}/g,cstname);
	content = content.replace("#{FLAG_TYPE_NAME} ",flag_type_name);
	content = content.replace("#{EXP_PAY_TAX}",exp_pay_tax);
	content = content.replace("#{EST_FEE}",est_fee);
	content = content.replace(/#{인증코드번호}/g,auth_code);

	$("#cont").html(content);
	
}



function cal_tax_avr(P_TOTAL){

	if(P_TOTAL <= 12000000){
		$("#STEP4").val("6%");
	}else if(P_TOTAL > 12000000 && P_TOTAL <= 46000000){
		$("#STEP4").val("15%");
	}else if(P_TOTAL > 46000000 && P_TOTAL <= 88000000){
		$("#STEP4").val("24%");
	}else if(P_TOTAL > 88000000 && P_TOTAL <= 150000000){
		$("#STEP4").val("35%");
	}else if(P_TOTAL > 150000000 && P_TOTAL <= 300000000){
		$("#STEP4").val("38%");
	}else if(P_TOTAL > 300000000 && P_TOTAL <= 500000000){
		$("#STEP4").val("40%");
	}else if(P_TOTAL > 500000000 && P_TOTAL <= 1000000000){
		$("#STEP4").val("42%");
	}else if(P_TOTAL > 1000000000 ){
		$("#STEP4").val("45%");
	}	
}


function cal_step3_new(TOTAL3){
	if( TOTAL3 <= 12000000 ){
		$("#STEP5").val( TOTAL3 * 6 /100 );
	}else if(TOTAL3 > 12000000 && TOTAL3 <= 46000000){
		$("#STEP5").val( (TOTAL3 * 15/100)  - 1080000 );
	}else if(TOTAL3 > 88000000 && TOTAL3 <= 150000000){
		$("#STEP5").val( ( TOTAL3 * 24/100 ) - 5220000 );
	}else if(TOTAL3 > 88000000 && TOTAL3 <= 150000000 ){
		$("#STEP5").val( ( TOTAL3 * 35 /100 ) - 14900000 );
	}else if(TOTAL3 > 150000000 && TOTAL3 <= 300000000 ){
		$("#STEP5").val( ( TOTAL3 *  38 /100 ) - 19400000 );
	}else if( TOTAL3 > 300000000 && TOTAL3 <= 500000000 ){
		$("#STEP5").val( ( TOTAL3 * 40 /100 ) - 25400000 );
	}else if( TOTAL3 > 500000000 && TOTAL3 <= 1000000000 ){
		$("#STEP5").val( TOTAL5 = ( TOTAL3 * 42 /100 ) - 35400000 );
	}else if( TOTAL3 > 1000000000  ){
		$("#STEP5").val( ( TOTAL3 * 45 /100 ) - 65400000 );
	}

	//.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',')
	$("#STEP5").val( Math.ceil($("#STEP5").val()).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',') );
}

function cal_btn_click(){
	var cstname = $("#cstname_cal").val();
	var mobile = $("#mobile_cal").val();
	var HT_ID = $("#HT_ID").val();
	var HT_PW = $("#HT_PW").val();
	var EXT_PAID = $("#EXT_PAID").val();
	var EXT_RATIO = $("#EXT_RATIO").val();
	var EXT_ADD_TAX = $("#EXT_ADD_TAX").val();
	var DEL_PRICE = $("#DEL_PRICE").val();
	var comp_cnt = 0;
	
	if(HT_ID !="" && HT_PW !="" ){
		if(isEmpty(HT_ID) == false && isEmpty(HT_PW) == false){

			var action = "select_json";
			var input_id = HT_ID;
			var input_pw = HT_PW;
			var year = "2021";
			isloading.start();
			$.ajax({
				url:"../../tilko/UnitTest/HomeTax_API_1.php",
				method:"POST",
				dataType:"json",
				data:{action:action,input_id:input_id, input_pw:input_pw,year:year},
				success:function(data){

					if(data.Status == "OK" && data.total_paid != null){

						$('#EXT_PAID').val(addCommas(data.total_paid));
						$('#EXT_RATIO').val(addCommas(data.ext_ratio));
						$('#EXT_ADD_TAX').val(addCommas(data.add_tax));
						$('#DEL_PRICE').val(addCommas(data.del_price+1500000));
						$('#xpsrt').val(data.xpsrt);

						ck_checkbox("dvdnIncAmtYn", data.dvdnIncAmtYn);
						ck_checkbox("intrIncAmtYn", data.intrIncAmtYn);
						ck_checkbox("dblErinAmtYn", data.dblErinAmtYn);
						ck_checkbox("erinAmtYn", data.erinAmtYn);
						ck_checkbox("pnsnIncAmtYn", data.pnsnIncAmtYn);
						ck_checkbox("etcIncAmtYn", data.etcIncAmtYn);

						
						for(var i=0; i<data.rows_cnt; i++){
							//if(data.xpsrt[i] == "단순")
							if(data.bmanNm[i] !="" && data.txprDscmNoEncCntn[i] !="")
								comp_cnt ++;
						}

						if(comp_cnt > 0)
							$('#free_flag').val("사업자");
						else
							$('#free_flag').val("프리");

						
						//$('#etcIncAmtYn').html(data.etcIncAmtYn);
						CAL_AUTO();
							
						
					}else{
						alert("※로그인실패\n\n1)종합소득세 대상자가 아니거나\n2)법인이거나 \n3)로그인단계에 보안카드가 설정되어있습니다. \n홈택스에 직접 로그인하여 확인이 필요합니다.\n\n홈택스 상세메시지 : ["+data.Message+"]");
					}

					isloading.stop();
				}
			})
		}
	}

	if(EXT_PAID !="" && EXT_RATIO != "" && EXT_ADD_TAX !="" && DEL_PRICE !="" ){
		CAL_AUTO();
	}
}



function cal_btn_click_p(){
	var cstname = $("#cstname_p").val();
	var mobile = $("#mobile_p").val();
	var HT_ID = $("#HT_ID_p").val();
	var HT_PW = $("#HT_PW_p").val();
	var EXT_PAID = $("#EXT_PAID_p").val();
	var EXT_RATIO = $("#EXT_RATIO_p").val();
	var EXT_ADD_TAX = $("#EXT_ADD_TAX_p").val();
	var DEL_PRICE = $("#DEL_PRICE_p").val();
	var comp_cnt = 0;
	
	if(HT_ID !="" && HT_PW !="" && (EXT_PAID =="" && EXT_RATIO == "" && EXT_ADD_TAX =="" && DEL_PRICE =="") ){
		if(isEmpty(HT_ID) == false && isEmpty(HT_PW) == false){

			var action = "select_json";
			var input_id = HT_ID;
			var input_pw = HT_PW;
			var year = "2021";
			isloading.start();
			$.ajax({
				url:"../../tilko/UnitTest/HomeTax_API_1.php",
				method:"POST",
				dataType:"json",
				data:{action:action,input_id:input_id, input_pw:input_pw,year:year},
				success:function(data){

					if(data.Status == "OK" && data.total_paid != null){

						$('#EXT_PAID').val(addCommas(data.total_paid));
						$('#EXT_RATIO').val(addCommas(data.ext_ratio));
						$('#EXT_ADD_TAX').val(addCommas(data.add_tax));
						$('#DEL_PRICE').val(addCommas(data.del_price+1500000));
						$('#xpsrt').val(data.xpsrt);

						ck_checkbox("dvdnIncAmtYn", data.dvdnIncAmtYn);
						ck_checkbox("intrIncAmtYn", data.intrIncAmtYn);
						ck_checkbox("dblErinAmtYn", data.dblErinAmtYn);
						ck_checkbox("erinAmtYn", data.erinAmtYn);
						ck_checkbox("pnsnIncAmtYn", data.pnsnIncAmtYn);
						ck_checkbox("etcIncAmtYn", data.etcIncAmtYn);

						
						for(var i=0; i<data.rows_cnt; i++){
							//if(data.xpsrt[i] == "단순")
							if(data.bmanNm[i] !="" && data.txprDscmNoEncCntn[i] !="")
								comp_cnt ++;
						}

						if(comp_cnt > 0)
							$('#free_flag').val("사업자");
						else
							$('#free_flag').val("프리");

						
						//$('#etcIncAmtYn').html(data.etcIncAmtYn);
						CAL_AUTO();
							
						
					}else{
						alert("※로그인실패\n\n1)종합소득세 대상자가 아니거나\n2)법인이거나 \n3)로그인단계에 보안카드가 설정되어있습니다. \n홈택스에 직접 로그인하여 확인이 필요합니다.\n\n홈택스 상세메시지 : ["+data.Message+"]");
					}

					isloading.stop();
				}
			})
		}
	}else{
		CAL_AUTO_p();
	}

}



function ck_checkbox(id, flag){

	if(flag=="O"){
		if(!$("#"+id).is(":checked"))
			$('#'+id).prop('checked', true);
	}else{
		$('#'+id).prop('checked', false);
	}
	
}

function kakao_send(){
	var action = "MENUPOP_CAL_KAKAO_SEND";
	var cstname = $("#cstname_cal").val();
	var mobile = $("#mobile_cal").val();
	var flag_type_name ="종합소득세";
	var exp_pay_tax = $("#EST_TAX").html();
	var est_fee=$("#EST_FEE").html();
	var auth_code = $('#auth_code').val(); // 인증코드

	if(confirm(mobile + " 번호로 알림톡을 발송하시겠습니까?") == true){
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../api/send_tok_v1.php", 
			method:"POST",
			data:{cstname :cstname  ,mobile:mobile,action:action, flag_type_name:flag_type_name, exp_pay_tax:exp_pay_tax,est_fee:est_fee, auth_code:auth_code},
			success:function(data){
				console.log(data);
				if(data.indexOf("전송완료") > -1){
					alert("알림톡이 발송되었습니다.");
					window.location.reload();
				}else{
					alert("오류가 발생했습니다. 관리자에게 문의하여 주세요.");
				}
				
			}
		});
	}	
}


function kakao_send_p(){
	var action = "MENUPOP_CAL_KAKAO_SEND_P";
	var cstname = $("#cstname_p").val();
	var mobile = $("#mobile_p").val();
	var flag_type_name ="종합소득세";
	var exp_pay_tax = $("#EST_TAX_p").html();
	var est_fee=$("#EST_FEE_p").val();
	var auth_code = $('#auth_code').val(); // 인증코드
	var tmp_id = $('#select_send_kakao').val();
	var req = new Request();
	var userid = req.getParameter("id");
	
	if(confirm(mobile + " 번호로 알림톡을 발송하시겠습니까?") == true){
		$.ajax({
		//insert page로 위에서 받은 데이터를 넣어준다.
			url:"../api/send_tok_v1.php", 
			method:"POST",
			data:{cstname :cstname  ,mobile:mobile,action:action, flag_type_name:flag_type_name, exp_pay_tax:exp_pay_tax,est_fee:est_fee, auth_code:auth_code,tmp_id:tmp_id,userid:userid},
			success:function(data){
				console.log(data);
				if(data.indexOf("전송완료") > -1){
					alert("알림톡이 발송되었습니다.");
					window.location.reload();
				}else{
					alert("오류가 발생했습니다. 관리자에게 문의하여 주세요.");
				}
				
			}
		});
	}	
}



function close_left(){
	$(".sub_menu").removeClass('on');
	$(".contents").addClass('wide');
	$(this).removeClass('off');
	$("#insert_area").attr("cols","43");
	$("#phone_form").css("display","block");
	$("#cal_form").css("display","none");
}

function open_left(){
	$(".sub_menu").addClass('on');
	$(".contents").removeClass('wide');
	$(this).addClass('off');
	$("#insert_area").attr("cols","30");
	$("#phone_form").css("display","none");
}



function send_kakao_branch(branch){
	var action = "MENUPOP_KAKAO_SEND_BRANCH";
	var cstname = $("#cstname").val();
	var mobile = $("#mobile").val();
	var sec_type = $("#sec_type").val();
	var total_paid = $("#total_paid").val();
	var hometaxid = $("#HT_ID").val();
	var hometaxpw = $("#HT_PW").val();
	var memo = $("#memo").val();
	var req = new Request();
	var userid = req.getParameter("id");
	var inf_channel = "채널톡_전문상담";
	var branch = $("#reg_branch").val();
		
	$.ajax({
	//insert page로 위에서 받은 데이터를 넣어준다.
		url:"../api/send_tok_v1.php", 
		method:"POST",
		data:{cstname :cstname,mobile:mobile,action:action, sec_type:sec_type, total_paid:total_paid, hometaxid:hometaxid, hometaxpw:hometaxpw, inf_channel:inf_channel,memo:memo, userid:userid,branch:branch},
		success:function(data){
			console.log(data);
		}
	});
}


function send_kakao_branch_p(branch){
	var action = "MENUPOP_KAKAO_SEND_BRANCH";
	var cstname = $("#cstname_p").val();
	var mobile = $("#mobile_p").val();
	var sec_type = $("#sector_p").val();
	var total_paid = $("#total_paid_p").val();
	var hometaxid = $("#HT_ID_p").val();
	var hometaxpw = $("#HT_PW_p").val();
	var memo = $("#memo").val();
	var req = new Request();
	var userid = req.getParameter("id");
	var inf_channel = "채널톡_전문상담";
	var branch = $("#reg_branch_phone").val();
		
	$.ajax({
	//insert page로 위에서 받은 데이터를 넣어준다.
		url:"../api/send_tok_v1.php", 
		method:"POST",
		data:{cstname :cstname,mobile:mobile,action:action, sec_type:sec_type, total_paid:total_paid, hometaxid:hometaxid, hometaxpw:hometaxpw, inf_channel:inf_channel,memo:memo, userid:userid,branch:branch},
		success:function(data){
			console.log(data);
		}
	});
}



fetchUser();



</script>


</html>