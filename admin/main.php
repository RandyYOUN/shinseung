
<?php
include "top.php";


if($depthid=="D2005"){
	echo "<script>window.location.href='list_trans.php';</script>";
}

?>        
            <div class="n_mainContentsWrap">
                <div class="n_mainLeftBg"></div>
                <div class="n_mainContents">                   

                    <div class="n_mainLeft">
                        <h1 id="page_title">퀵링크</h1>
                        <div class="n_searchWrap">
                            <div class="n_search"> 
                                <input type="box">
                                <input type="button" value="검색">                        
                            </div> 
                            <!--input type="button" value="add NEW"-->
                        </div>                               

                        <div class="n_quickMain" id= "n_quickMain">
                            

                            <!--div class="n_page">
                                <a href="" class="first"></a>
                                <a href="" class="prev"></a>
                                <span>
                                    <a href="">1</a>
                                    <a href="" class="active">2</a>
                                    <a href="">3</a>
                                    <a href="">4</a>
                                </span>
                                <a href="" class="next"></a>
                                <a href="" class="last"></a>
                            </div-->

                        </div>

                    </div>

                    <div class="n_mainRight">

                        <div class="n_searchWrap">
                            <div class="n_search"> 
                                <select>
                                    <option selected>부서명</option>
                                    <option>1</option>
                                </select>
                                <input type="box" placeholder="검색어를 입력해주세요">
                                <input type="button" value="검색">                        
                            </div> 
                            <!--input type="button" value="add NEW"-->
                        </div> 

                        <div class="n_mainBoard">
                            <table>
                                <colgroup>
                                    <col width="">
                                    <col width="">
                                    <col width="">
                                    <col width="">
                                    <col width="">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>부서명</th>
                                        <th>성명/직급</th>
                                        <th>내선</th>
                                        <th>대표번호</th>
                                        <th>핸드폰번호</th>
                                    </tr>
                                </thead>
                                <tbody ID="result">
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="n_page">
                            <a href="" class="first"></a>
                            <a href="" class="prev"></a>
                            <!--span>
                                <a href="">1</a>
                                <a href="" class="active">2</a>
                                <a href="">3</a>
                                <a href="">4</a>
                                <a href="">5</a>
                            </span-->
                            <a href="" class="next"></a>
                            <a href="" class="last"></a>
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
	<input type="hidden" id="page_flag" value="퀵링크">

</body>

<script>

function pop_menu(){
	var userid = <?php echo $userid;?>;
	window.open("pop_admin/index.php?id="+userid,'메뉴팝업','width=500, height=700, scrollbars=yes, resizable=no, menubar=no,toolbal=no,location=no,alwaysRaised=yes');
}


function popup(url){
	window.open(url,"target=_blank");
}

var first = "Y";


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



function open_pop(){
	alert('1');
}

$(document).ready(function(){

	var req = new Request();
	var page_flag = document.getElementById("page_flag").value;
	top_menu(page_flag);

	fetchUser();
	function fetchUser()
	{

		var id = "<?php echo $userid;?>";
		var action = "select_link";
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action, id:id},
			success:function(data){
				$('#n_quickMain').html(data);
			}
		})
	}



	fetchUser2();
	function fetchUser2()
	{

		var action = "select_member_main";
				
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action},
			success:function(data){
				$('#result').html(data);
			}
		})
	}

});

//pop_menu();
</script>


</html>