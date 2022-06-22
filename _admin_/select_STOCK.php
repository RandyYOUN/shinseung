<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$head = '';
$output = '';

//db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
	
	if($_POST["action"]=="등록")
	{
		$P_S_NAME=mysqli_real_escape_string($connect,$_POST["S_NAME"]);
		$P_S_PRICE=mysqli_real_escape_string($connect,$_POST["S_PRICE"]);
		$P_S_EA=mysqli_real_escape_string($connect,$_POST["S_EA"]);
		$P_S_FLAG=mysqli_real_escape_string($connect,$_POST["S_FLAG"]);

		$procedure = "
		CREATE PROCEDURE insert_STOCK(IN P_S_NAME VARCHAR(500),P_S_PRICE INT(11) , P_S_EA INT(11), P_S_FLAG CHAR(1) )
		BEGIN

			INSERT INTO STOCK(S_NAME, S_PRICE,S_EA, S_BUYSELL) VALUES(P_S_NAME, P_S_PRICE,P_S_EA,P_S_FLAG);

		END
		";

		//기존에 프로시저가 있으면 삭제
		if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insert_STOCK"))
		{ //위에서 만든 프로시저 실행
			if(mysqli_query($connect,$procedure))
			{
			$query = "CALL insert_STOCK('".$P_S_NAME."','".$P_S_PRICE."','".$P_S_EA."','".$P_S_FLAG."')";
			//프로시저 호출
			mysqli_query($connect,$query);
			echo '성공적으로 입력 되었습니다.';
			}
		}

	}

}






$s_str = $_POST["s_str"];

if($s_str !=""){
	$query_str1 .= " AND S_NAME like '%".$s_str."%' ";
}


$query = "SELECT count(CSTID) as total FROM STOCK WHERE 1=1 ";



$head .= '
<colgroup>
<col width="200px">
<col width="200px">
<col width="200px">
<col width="100px">
</colgroup>
<thead>
<tr>
	<th>종목명</th>
	<th>평단가</th>
	<th>수량</th>
	<th>매수/매도</th>
</tr>
</thead>
';


if(isset($_POST["action"]))
{
//users테이블 조회 프로시져를 만든다.
$procedure = "
CREATE PROCEDURE SELECT_STOCK()
BEGIN
SELECT * FROM STOCK where 1=1 ".$query_str1." 
;
END;
";
	//기존에 프로시져가 존재한다면 지운다.
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_STOCK"))
	{
		//mysqli_query:DB에 쿼리 전송
		if(mysqli_query($connect,$procedure))
		{
			$query = "CALL SELECT_STOCK()";

			///mysqli_query:DB에 쿼리 전송 후 결과값을 변수에 담는다
			$result = mysqli_query($connect,$query);


			if(mysqli_num_rows($result) >0)
			{

				$cate_name="";

				while($row = mysqli_fetch_array($result)){

					$output .= '
					<tr>
					<td>'.$row["S_NAME"].'</td>
					<td>'.$row["S_PRICE"].'</td>
					<td>'.$row["S_EA"].'</td>';
					
					if($row["S_BUYSELL"]=="B"){
						$output .= '<td style="color:#FF0000;">매수</td>';
					}else if($row["S_BUYSELL"]=="S"){
						$output .= '<td style="color:#0000FF;">매도</td>';
					}
					
					
				}
			}// 네번째 if문 끝
			else
			{
				$output .= '
				<tr>
				<td colspan="20" align="center">데이터가 없습니다.</td>
				</tr>
				';
			}


			//최종출력!
		/*
			if($first=="Y"){
				echo $head.$output.$footer;
			}else{
				echo $output.$footer;
			}
		*/
			echo $head.$output;

		}// 세번째 if문 끝

	} // 두번째 if 문 끝

}//첫번째 if문 끝!






?>
