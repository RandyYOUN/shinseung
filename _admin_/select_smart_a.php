<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$head = '';
$output = '';
$CNT = 0;
$i=1;

//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴

$head .= '
<tr>
<th width="10%">서버</th>
<th width="10%">넘버</th>
<th width="10%">이름</th>
<th width="20%">ID</th>
<th width="10%">PW</th>
<th width="10%">소속지점</th>
<th width="5%">사용/미사용</th>
</tr>

';


if(isset($_POST["action"]))
{
	for($i=1;$i<4;$i++){
		$procedure = "
		CREATE PROCEDURE SELECT_SMARTA_SERVER".$i."()
		BEGIN
		SELECT *
		FROM SMART_A_MEMBER WHERE SERVER = ".$i."
		ORDER BY NUMBER
		;
		END;
		";
echo 'i = '.$i ;		
echo $procedure ;

		//기존에 프로시져가 존재한다면 지운다.
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

					while($row = mysqli_fetch_array($result)){

						$output .= '
						<tr>
						<td>'.$row["SERVER"].'</td>
						<td>'.$row["NUMBER"].'</td>
						<td>'.$row["USER_NAME"].'</td>
						<td>'.$row["ID"].'</td>
						<td>'.$row["PW"].'</td>
						<td>'.$row["BRNACH"].'</td>
						<td>'.$row["USER_YN"].'</td>
						</tr>
						';
						$CNT++;
						echo $CNT;
					}

					$output .= '
						<tr>
						<td>소계</td>
						<td>'.$CNT.'</td>
						<td colspan=6></td>
						</tr>
						<tr>
							<td colspan=8>procedure '.$i.' = '.$procedure.'</td>
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
		$CTN=0;

	} // while 끝




	echo $head.$output;
	
}//첫번째 if문 끝!






?>
