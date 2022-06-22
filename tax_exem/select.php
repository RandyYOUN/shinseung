<?php

//최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수
$output = '';

//db연결 본인의 db 정보를 넣어준다!
//$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");
$connect = mysqli_connect("localhost", "sschina", "Andy4240!@","dbsschina","3306");
//( "db.sostax.kr:3306", "sschina", "shinseung1@" )

//ajax로 넘긴 데이터 값은 "select"
//값이 존재하면 true를 리턴
if(isset($_POST["action"]))
{
    
    $action = $_POST["action"];
    
    //부가세 2STEP select : 시작
    if($action == "select_vat_step2" && isset($_POST["bizid"])){
        $output = array();
        
        $procedure = "
			CREATE PROCEDURE SELECT_VAT_STEP2(IN user_id int(100))
			BEGIN
				SELECT *
				FROM dbsschina.TB100024
				WHERE BIZ_ID = user_id;
			END;
			";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_VAT_STEP2"))
        {
            if(mysqli_query($connect, $procedure))
            {
                $query = "CALL SELECT_VAT_STEP2(".$_POST["bizid"].")";
                $result = mysqli_query($connect, $query);
                
                while($row = mysqli_fetch_array($result))
                {
                    $output['OPTION1'] = $row["OPTION1"];
                    $output['OPTION2'] = $row["OPTION2"];
                    $output['OPTION3'] = $row["OPTION3"];
                    $output['OPTION4'] = $row["OPTION4"];
                    $output['OPTION5'] = $row["OPTION5"];
                    $output['OPTION6'] = $row["OPTION6"];
                    $output['OPTION7'] = $row["OPTION7"];
                    $output['OPTION8'] = $row["OPTION8"];
                    $output['OPTION9'] = $row["OPTION9"];
                    $output['OPTION10'] = $row["OPTION10"];
                    $output['OPTION11'] = $row["OPTION11"];
                    
                }
                echo json_encode($output);
            }
        }
    }
    //부가세 2STEP select : 끝
    
    
    //부가세 STEP4 select : 시작
    if($action == "select_vat_step4" && isset($_POST["cstid"])){
        $output = array();
        
        $procedure = "
			CREATE PROCEDURE SELECT_VAT_STEP4(IN user_id int(100))
			BEGIN
				SELECT *
				FROM dbsschina.TB100020
				WHERE CSTID = user_id;
			END;
			";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS SELECT_VAT_STEP4"))
        {
            if(mysqli_query($connect, $procedure))
            {
                $query = "CALL SELECT_VAT_STEP4(".$_POST["cstid"].")";
                $result = mysqli_query($connect, $query);
                
                while($row = mysqli_fetch_array($result))
                {
                    $output['HomeTaxID'] = $row["HomeTaxID"];
                    $output['HomeTaxPW'] = $row["HomeTaxPW"];
                    $output['RESIDENT_ID'] = $row["RESIDENT_ID"];
                    
                }
                echo json_encode($output);
            }
        }
    }
    //부가세 STEP4 select : 끝
    
    
}


?>
