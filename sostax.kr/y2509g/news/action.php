<?php

//url에 action이라는 값이 존재하면
if(isset($_POST["action"]))
{ //db연결
$connect = mysqli_connect("db.sostax.kr", "sschina", "shinseung1@","dbsschina","3306");//url에 action이라는 값이 "추가" 라면
if($_POST["action"]=="추가")
{ //ajax로 넘긴 data를 받아준다.
$subject=mysqli_real_escape_string($connect,$_POST["subject"]);
$news_reguser=mysqli_real_escape_string($connect,$_POST["news_reguser"]);
$news_reguser_comp=mysqli_real_escape_string($connect,$_POST["news_reguser_comp"]);
$news_regdate=mysqli_real_escape_string($connect,$_POST["news_regdate"]);
$content=mysqli_real_escape_string($connect,$_POST["content"]);
$img_url=mysqli_real_escape_string($connect,$_POST["img_url"]);

//참고-mysqli_real_escape_string
//:MySQL로 질의를 전송하기 전에 안전하게 데이터를 만들기 위해 사용
//특수 문자열을 이스케이프하여 mysql_query() 수행시 안전하게 질의할 수 있도록 한다.
/*
, , content varchar(8000)
, , CONTENTS,
,  news_reguser_comp, content 
."','".$news_regdate."','".$news_reguser_comp."','".$content
*/
//insert 프로시저 생성
$procedure = "
CREATE PROCEDURE insertNews(IN subject varchar(200),news_reguser varchar(45),news_regdate datetime,news_reguser_comp varchar(45),content varchar(8000), img_url varchar(500) )
BEGIN
INSERT INTO SS_NEWS(SUBJECT,NEWS_REGUSER, NEWS_REGDATE,NEWS_REGUSER_COMP ,CONTENTS,IMG_URL, REGDATE, REGUSER) VALUES(subject,news_reguser,news_regdate,news_reguser_comp, content,img_url ,now(), 101);
END
";

//기존에 프로시저가 있으면 삭제
if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertNews"))
{ //위에서 만든 프로시저 실행
if(mysqli_query($connect,$procedure))
{
$query = "CALL insertNews('".$subject ."','".$news_reguser."','".$news_regdate."','".$news_reguser_comp."','".$content."','".$img_url."')";
//프로시저 호출
mysqli_query($connect,$query);
echo '성공적으로 입력 되었습니다.';
}
}
}

}


?> 