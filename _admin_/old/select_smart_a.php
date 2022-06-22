<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$head = '';
$output = '';
$CNT = 0;
$i=1;

$p_id =  $_POST["id"];
$p_pw =  $_POST["pw"];
$p_branch =  $_POST["branch"];
$p_useryn =  $_POST["useryn"];

//db연결 본인의 db 정보를 넣어준다!
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴

$head .= '
<tr>
<th width="10%">서버</th>
<th width="10%">넘버</th>
<th width="10%">사용자명</th>
<th width="20%">ID</th>
<th width="10%">PW</th>
<th width="10%">소속지점</th>
<th width="5%">사용/미사용</th>
</tr>

';


if(isset($_POST["action"]))
{
	
		if($_POST["action"] == "등록"){
			$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");

			$procedure_upt = "
			CREATE PROCEDURE UPT_SMARTA(IN p_id INT, p_pw TEXT, p_branch INT , p_useryn CHAR(1) )
			BEGIN
				UPDATE SMARTA_MEMBER SET USER_PW = p_pw, BRANCH = p_branch, USE_YN = p_useryn WHERE ID = p_id;
			END;
			";

			
			//기존에 프로시져가 존재한다면 지운다.
			if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS UPT_SMARTA"))
			{
				if(mysqli_query($connect,$procedure_upt))
				{
					$query_upt = "CALL UPT_SMARTA('".$p_id."','".$p_pw."','".$p_branch."','".$p_useryn."')";
					mysqli_query($connect,$query_upt);
				}
			}

			mysqli_close($connect);

		}
		
		


		for($i=1;$i<4;$i++ ){

			$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");

			$procedure = "
			CREATE PROCEDURE SELECT_SMARTA_SERVER".$i."()
			BEGIN
			SELECT *
			FROM SMARTA_MEMBER WHERE SERVER = ".$i."
			ORDER BY NUMBER
			;
			END;
			";
			//procedure1
			if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_SMARTA_SERVER".$i))
			{
				//mysqli_query:DB에 쿼리 전송
				if(mysqli_query($connect,$procedure))
				{
					
					$query = "CALL SELECT_SMARTA_SERVER".$i."()";
					///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
					$result = mysqli_query($connect,$query);
					if(mysqli_num_rows($result) >0)
					{

						$CNT = 0;

						while($row = mysqli_fetch_array($result)){
							$output .= '
							<tr>
							<td>'.$row["SERVER"].'</td>
							<td>'.$row["NUMBER"].'</td>
							<td>'.$row["USER_NAME"].'</td>
							<td>'.$row["USER_ID"].'</td>
							<td>
								<DIV id="lbl_'.$row["ID"].'" style="width:200px;height:25px;padding-top:8px;" onclick="javascript:switch_comp(this)">'.$row["USER_PW"].'</DIV><input type="text" id="ip_'.$row["ID"].'" onKeypress="javascript:if(event.keyCode==13 || event.keyCode==27) {select_insert(this);}" value="'.$row["USER_PW"].'" style="display:none;padding-top:10px;"></input></td>
							<td>
								<select style="width:100px;height:35px;" id="bran_'.$row["ID"].'" name="branch" onchange="javascript:select_insert(this);">';

								$selected = "";

								for($i2=0; $i2 <=12; $i2++ ){
									
									if($row["BRANCH"] == $i2){
										$selected = "selected";
									}else{
										$selected = "";
									}

									switch($i2){
										case 0 : $output.= '<option value="0">선택</option>'; break;
											
										case 1 : $output.= '<option value="1" '.$selected.'>강남</option>'; break;

										case 2 : $output.= '<option value="2" '.$selected.'>용인</option>';break;
										
										case 3 : $output.= '<option value="3" '.$selected.'>안양</option>';break;
										
										case 4 : $output.= '<option value="4" '.$selected.'>수원</option>';break;
										
										case 5 : $output.= '<option value="5" '.$selected.'>일산</option>';break;
										
										case 6 : $output.= '<option value="6" '.$selected.'>부천</option>';break;
										
										case 7 : $output.= '<option value="7" '.$selected.'>광주</option>';break;
										
										case 8 : $output.= '<option value="8" '.$selected.'>분당</option>';break;
										
										case 9 : $output.= '<option value="9" '.$selected.'>기흥</option>';break;
													
										case 10 : $output.= '<option value="10" '.$selected.'>세무</option>';break;
										
										case 11 : $output.= '<option value="11" '.$selected.'>회계</option>';break;

										case 12 : $output.= '<option value="12" '.$selected.'>영업</option>';break;

									}
								}

								$output.= '</select>
							
							</td>
							<td>
							<select style="width:100px;height:35px;" id="useryn_'.$row["ID"].'" name="useryn" onchange="javascript:select_insert(this);">';

								$selected = "";
								$YN = "";

									for($j=0; $j <=2; $j++ ){
										
										switch($j){
											case 0 : $YN = "";
											break;
											case 1 : $YN = "Y";
											break;
											case 2 : $YN = "N";
											break;
										}


										if($row["USE_YN"] == $YN){
											$selected = "selected";
										}else{
											$selected = "";
										}

										switch($j){
											case 0 : $output.= '<option value="'.$row["USER_YN"].'">선택</option>'; break;
											case 1 : $output.= '<option value="Y" '.$selected.'>Y</option>';break;
											
											case 2 : $output.= '<option value="N" '.$selected.'>N</option>';break;

										}
									}

								$output.= '</select>
							</td>
							</tr>
							';
							$CNT++;
						}
						$output .= '
							<tr style="background-color:#E6E6E6">
							<td>서버'.$i.'소계</td>
							<td>'.$CNT.'</td>
							<td colspan=6></td>
							</tr>
						';

						
					}// 네번째 if문 끝
					else
					{
						$output .= '
						<tr>
						<td colspan="10" align="center">데이터가 없습니다.</td>
						</tr>
						';
					}

					
					


				}// 세번째 if문 끝


			} // 두번째 if 문 끝
			//procedure1
			mysqli_close($connect);		

		}
		

}//첫번째 if문 끝!


echo $head.$output;
	

?>
