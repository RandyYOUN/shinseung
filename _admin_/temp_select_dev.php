<?php
session_start();

// 최종적으로 db에서 가져온 데이터를 가공한 결과 값을 담을 변수

$action = $_POST["action"];
$action_1 = $_POST["action_1"];

// db연결 본인의 db 정보를 넣어준다!
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@", "dbsschina", "3306");
// ( "db.sostax.kr:3306", "sschina", "shinseung1@" )

// 신승ADMIN 멤버리스트 : 시작
if ($action == "select_link") {
    $query_str = '';
    $head .= '
            <div class="board" style="width:300px;">
		         <table style="width:100%;">
		             <tbody>
            			<colgroup>
            				<col style="width: 30px;">
            			</colgroup>
            			<thead>
                			<tr>
            					<th><a href="https://taxtok.kr/admin/quick_link.php" target=_blank>퀵링크</a></th>
                			</tr>
            			</thead>
			 ';

    $procedure = "
            	CREATE PROCEDURE SELECT_ADMIN_MEMBER()
            	BEGIN
            		SELECT 
                           LINK                     #링크주소
                           ,LINK_NAME               #링크이름
                    FROM 
                    	   dbsschina.TB750020       #퀵링크
                    WHERE
                           1 = 1
                           " . $query_str . ";
            	END;
            	   ";

    if (mysqli_query($connect, "DROP PROCEDURE IF EXISTS SELECT_ADMIN_MEMBER")) {
        if (mysqli_query($connect, $procedure)) {
            $query = "CALL SELECT_ADMIN_MEMBER()";
            $result = mysqli_query($connect, $query);
            $head .= '';

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    $output .= '
            					<tr>
                                   <td style="text-align:left;padding-left: 20px;">
                                        <a href="' . $row["LINK"] . '" target=_blank >' . $row["LINK_NAME"] . '</a>
                                   </td>
            					</tr>
            					';
                }

                $output .= '
					       </tbody>
				        </table>
				    </div>
					';
            } else {
                $output .= '
				            <tr>
				                <td colspan="5" align="center">데이터가 없습니다.</td>
				            </tr>
                        </tbody>
				    </table>
				</div>
				            ';
            }

            echo $head . $output;
        }
    }
}

if ($action_1 == "select_link_1") {
    $query_str = '';
    $head .= '
            <div class="board" style="width:800px;">
		         <table style="width:100%;">
		             <tbody>
            			<colgroup>
            				<col style="width: 15px;">
            				<col style="width: 30px;">
            				<col style="width: 50px;">
            				<col style="width: 15px;">
            			</colgroup>
            			<thead>
                			<tr>
                				<th>구분</th>
            					<th>퀵링크</th>
            					<th>설명</th>
            					<th>날짜</th>
                			</tr>
            			</thead>
			 ';
    
    $procedure = "
            	CREATE PROCEDURE SELECT_ADMIN_MEMBER()
            	BEGIN
            		SELECT
                            A.VALUE_                      #구분이름
                           ,B.LINK                        #링크주소
                           ,B.LINK_NAME                   #링크이름
                           ,B.COMMENTS                    #링크설명
                           ,B.REGDATE                     #날짜
                    FROM
                            dbsschina.TB750010 AS A       #구분코드이름
                    	   ,dbsschina.TB750020 AS B       #퀵링크
                    WHERE
                            A.CODE_ = B.FLAG              #구분코드
                            " . $query_str . "
            		ORDER BY ID;
            	END;
            	   ";
    
    if (mysqli_query($connect, "DROP PROCEDURE IF EXISTS SELECT_ADMIN_MEMBER")) {
        if (mysqli_query($connect, $procedure)) {
            $query = "CALL SELECT_ADMIN_MEMBER()";
            $result_1 = mysqli_query($connect, $query);
            $head .= '';
            
            if (mysqli_num_rows($result_1) > 0) {
                
                while ($row = mysqli_fetch_array($result_1)) {
                    
                    $output .= '
            					<tr>
            					   <td>' . $row["VALUE_"] . '</td>
                                   <td style="text-align:left;padding-left: 20px;">
                                        <a href="' . $row["LINK"] . '" target=_blank >' . $row["LINK_NAME"] . '</a>
                                   </td>
            					   <td style="text-align:left;padding-left: 20px;">' . $row["COMMENTS"] . '</td>
            					   <td>' . $row["REGDATE"] . '</td>
            					</tr>
            					';
                }
                
                $output .= '
					       </tbody>
				        </table>
				    </div>
					';
            } else {
                $output .= '
				            <tr>
				                <td colspan="5" align="center">데이터가 없습니다.</td>
				            </tr>
                        </tbody>
				    </table>
				</div>
				            ';
            }
            
            echo $head . $output;
        }
    }
}
// 신승ADMIN 멤버리스트 : 끝

?>
