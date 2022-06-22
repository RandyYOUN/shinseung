<?php include("top.php");?>


		<section class="subvisual sub_pricebg">
			<h1>서비스가격</h1>
		</section>

		<script type="text/javascript" src="resources/js/SimpleTabs02.js"></script>
		<section class="subcon">
			<div class="subtabsWrap">
				<!--ul class="tabtop1">
					<!--li class="tabmenu active" style="height: 65px;">스마트 세무기장</li-->
					<!--li class="tabmenu active" style="height: 65px;margin:30px 0 0 85px;">프리랜서 수수료</li>
				</ul>
				
				<section class="subtabarea1 s_price" id="s_price4" name="s_price4">
					<div class="ty03">
					<div style="margin:25px 0 5px 235px;font-size:12px;"><b>※ VAT 포함</b></div>
						<table>
							<colgroup>
								<col width="40%">
							</colgroup>
							<thead>
								<tr class="pricebg02">
									<th>연매출(전년도 매출)</th>
									<th>신고대리 수수료</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>단순경비율(E유형)</td>
									<td>55,000원 </td>					
								</tr>
								<tr>
									<td>3천만원 미만</td>
									<td>110,000원</td>
								</tr>
								<tr>
									
									<td>4천만원 미만</td>
									<td>165,000원</td>
								</tr>
								<tr>
									
									<td>5천만원 미만</td>
									<td>220,000원</td>				
								</tr>
								<tr>
									
									<td>6천만원 미만</td>
									<td>275,000원</td>				
								</tr>
								<tr>
									
									<td>6천만원 이상</td>
									<td>별도 상담</td>
								</tr>
								
							</tbody>						
							</table>
					</div>
					<ul>
						<li style="color:red;"><b>타소득 합산 종합소득세 신고시 55,000원 수수료 추가 됩니다.</b></li>
						<li>신고 완료 후 세무조사관 대응업무 (해명 자료 제출 등)는 별도 수수료가 청구됩니다.</li>
					</ul>
				</section-->

				
				<ul class="tabtop" style="text-align-last: center;">
					<!--li class="tabmenu active" style="height: 65px;">스마트 세무기장</li-->
					<li class="tabmenu active" >종합소득세 신고대리</li>
					<!-- li class="tabmenu" >주택임대 신고대행</li-->
				</ul>

				

<?php 
$today = date("Ymd");
//$today = '20210515';

if ($today >='20210515' && $today < '20210524'){
?>

				
<?php 
}elseif ($today >= '20210524'){
?>	
				
			    
				<section class="subtabarea s_price" id="s_price3" name="s_price3" >
					
					<div class="ty03">
					<div style="margin:25px 0 5px 270px;font-size:12px;"><b>※ VAT 포함</b></div>
						<table>
							<colgroup>
								<col width="40%">
							</colgroup>
							<thead>
								<tr class="pricebg02">
									<th>연매출(전년도 매출)</th>
									<th>프리랜서</th>
									<th>개인사업자</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>단순경비율</td>
									<td>55,000원 </td>
									<td>55,000원 </td>					
								</tr>
								<tr>
									<td>3000만원 미만</td>
									<td>165,000원</td>
									<td>165,000원</td>
								</tr>
								<tr>
									<td>4000만원 미만</td>
									<td>220,000원</td>
									<td>220,000원</td>
								</tr>
								<tr>
									<td>5000만원 미만</td>
									<td>275,000원</td>
									<td>275,000원</td>				
								</tr>
								<tr>
									<td>6000만원 미만</td>
									<td>330,000원</td>
									<td>330,000원</td>				
								</tr>
								<tr>									
									<td>6000만원 이상</td>
									<td>별도 상담</td>
									<td>별도 상담</td>
								</tr>
								<tr>									
									<td>타소득(근로,연금,기타)</td>
									<td>추가 55,000</td>
									<td>추가 55,000</td>
								</tr>
								<tr>									
									<td>타소득(이자,배당)</td>
									<td>추가 110,000</td>
									<td>추가 110,000</td>
								</tr>
								
							</tbody>								
							</table>
					</div>
					<ul>
						<li style="color:red;">i) 타소득 근로의 경우 연말정산 안한 경우 55,000원 추가</li>
						<li style="color:red;"><b>ii) [주택임대] 면세사업장현황신고를 한 경우 110,000원 추가</b></li>
						<li>iii) 골프장 캐디 단체할인가 적용 : 단순경비율 33,000원</li>
						<li>iv) 종합소득세 신고 대행수수료 기준일 : 5월 4일 [VAT 포함]</li>
						<li>v) 신고 완료 후 세무조사관 대응업무 (해명 자료 제출 등)는 <br>별도 수수료가 청구됩니다.</li>
					</ul>
				</section>
				
			    
				<!-- section class="subtabarea s_price" id="s_price3" name="s_price3">
					<div class="ty03">
					<div style="margin:25px 0 5px 235px;font-size:12px;"><b>※ VAT 포함</b></div>
						<table>
							<colgroup>
								<col width="40%">
								<col width="45%">
							</colgroup>
							<thead>
								<tr class="pricebg02">
									<th>구분</th>
									<th>수수료</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td>1~2주택 </td>
									<td>220,000원 </td>					
								</tr>
								<tr>
									<td>3주택 </td>
									<td>330,000원 </td>					
								</tr>
								<tr>
									<td>4주택 </td>
									<td>440,000원 </td>					
								</tr>
								<tr>
									<td>5주택 </td>
									<td>550,000원 </td>					
								</tr>
								<tr>
									<td>10주택 이하</td>
									<td>660,000원</td>
								</tr>
								<tr>
									<td>11주택 이상</td>
									<td>별도협의</td>
								</tr>
								<tr>
									<td>다가구 주택</td>
									<td>호수별로<br>가격 산정</td>
								</tr>
								<tr>
									<td>타소득<br>(근로,연금,기타)</td>
									<td>추가 55,000</td>
								</tr>
								<tr>
									<td>타소득<br>(이자,배당)</td>
									<td>추가 110,000</td>
								</tr>

								<tr>
									<td>사업소득이 있는 경우</td>
									<td>종합소득세<br>수수료 적용</td>				
								</tr>
							</tbody>					
						</table>
					</div>
				</section-->
				

<?php 
}
?>
					
				<!-- ul class="tabtop1">
					<li class="tabmenu active" style="height: 65px;margin:30px 0 0 85px;">주택임대 신고대행 수수료</li>
				</ul>
				
				<section class="subtabarea1 s_price" id="s_price4" name="s_price4">
					<div class="ty03">
					<div style="margin:25px 0 5px 235px;font-size:12px;"><b>※ VAT 포함</b></div>
						<table>
							<colgroup>
								<col width="40%">
								<col width="45%">
							</colgroup>
							<thead>
								<tr class="pricebg02">
									<th>구분</th>
									<th>수수료</th>
								</tr>
							</thead>
							<tbody>
								
								<tr>
									<td>1~2주택 </td>
									<td>220,000원 </td>					
								</tr>
								<tr>
									<td>3주택 </td>
									<td>330,000원 </td>					
								</tr>
								<tr>
									<td>4주택 </td>
									<td>440,000원 </td>					
								</tr>
								<tr>
									<td>5주택 </td>
									<td>550,000원 </td>					
								</tr>
								<tr>
									<td>10주택 이하</td>
									<td>660,000원</td>
								</tr>
								<tr>
									<td>11주택 이상</td>
									<td>별도협의</td>
								</tr>
								<tr>
									<td>다가구 주택</td>
									<td>호수별로<br>가격 산정</td>
								</tr>
								<tr>
									<td>타소득<br>(근로,연금,기타)</td>
									<td>추가 55,000</td>
								</tr>
								<tr>
									<td>타소득<br>(이자,배당)</td>
									<td>추가 110,000</td>
								</tr>

								<tr>
									<td>사업소득이 있는 경우</td>
									<td>종합소득세<br>수수료 적용</td>				
								</tr>
							</tbody>					
						</table>
					</div>
					
				</section-->

			</div>
		</section>

		<?php include("bottom.php");?>