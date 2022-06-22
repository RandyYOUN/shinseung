<?php

//db연결
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");


//url을 통해 id 값이 존재하면
if(isset($_POST["id"]))
{

//빈 배열을 만들고
$output = array();

//넘어온 id에 해당하는 row를 출력하는 프로시저 쿼리를 만든다.
$procedure = "
	CREATE PROCEDURE whereUser(IN user_id int(100))
	BEGIN
	SELECT * FROM SS_TAXDATE WHERE id = user_id;
	END;
	";
	//기존의 프로시저가 존재한다면 삭제 후
	if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereUser"))
	{
		//위에서 선언한 프로시저 선언(1)
		if(mysqli_query($connect, $procedure))
		{
		//프로시저 호출(2)
			$query = "CALL whereUser(".$_POST["id"].")";
			$result = mysqli_query($connect, $query);

			while($row = mysqli_fetch_array($result))
			{
			//위에서 만든 배열에 넣어준다.
			$output['TAXDATE'] = $row["TAXDATE"];
			$output['CONTENT'] = $row["CONTENT"];
			$output['VISIBLE'] = $row["VISIBLE"];
			
			}


			//json string 형식으로 변환 후 넘겨준다.
			echo json_encode($output);
		}
	}

}
?>