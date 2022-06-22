
<?php
include "top.php";
?>
<div class="wrap">
		<div class="content">
			<div class="navi">
			</div>
			<div class="contitle w50">
				<h1 id="page_title"></h1>
			</div>
			<div class="conwrap">
				<h2 class="w50"></h2>
				<div class="search">
				<button type="button" name="new" id="new" class="b_newadd">신규등록</button>
				</div>
					<div class="board" style="width:1300px;">
						<table style="width:100%;">
							<tbody id="result">
								<colgroup>
								<col width="210px">
								<col width="450px">
								<col width="210px">
								<col width="210px">
								<col width="210px">
								</colgroup>
								<thead>
								<tr>
									<th>세무일정날짜</th>
									<th>내용</th>
									<th>노출</th>
									<th>수정</th>
									<th>삭제</th>
								</tr>
								</thead>
							</tbody>
						</table>
						
					</div>
					
				</div>
				
			</div>
		</div>

		<div class="subcopyright">Copyright(c) SHINSEUNG copy rights reserved.</div>
	</div>


	<input type="hidden" id="page_flag" value="세무일정">
	<input type="hidden" id="s_sort">
	<input type="hidden" id="s_flag">
</body>

<script>


var first = "Y";


$(document).ready(function(){

	var page_flag = document.getElementById("page_flag").value;

	top_menu(page_flag);


	fetchUser();
	function fetchUser()
	{
	
		var action = "select_date";
		var first = "Y";

		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,first:first},
			success:function(data){
				//$('#action').text("추가");
				$('#result').html(data);
			}
		})

	}

	$(document).on('click', '.update', function(){
		var id = $(this).attr("id");
		window.open("insert_taxdate.php?id="+id);
	});


	$(document).on('click','.delete',function(){

		var id = $(this).attr("id");
		var action = "delete";
		var url = "taxdate";

		if(confirm("삭제 하시겠습니까?"))
		{
		//구분자
		var action = "delete";
			$.ajax({
				url:"select.php",
				method:"POST",
				data:{id:id,action:action, url:url},
				success:function(data){
					//리스트 다시 조회
					fetchUser();
					alert(data);
				}
			});
		}else
		{
			return false;
		}

	});


	$(document).on('click','.b_newadd',function(){
		window.location.href="insert_taxdate.php";
	});

	$(document).on('click','.more',function(){

		var action = "select_date";
		var first = "N";
		var lastid = $(this).attr("id");//more버튼용id값가져오기

		$("#more"+lastid).html('<img src="https://demos.9lessons.info/moreajax.gif" />');

		var offset = $("#more"+lastid).offset();//more버튼위치셋팅
		
		//users 리스트를 select.php 에서 받아온다.
		$.ajax({
			url:"select.php",
			method:"POST",
			data:{action:action,first:first,lastid:lastid},
			success:function(data){
				//$('#action').text("추가");
				$('#result').append(data);
				$("#more"+lastid).remove(); 
				//removing old more button
				$("#hidden_"+lastid).css("display","none");//more버튼으로 생기는 tr을 가리기
				$('html').animate({scrollTop : offset.top}, 50);
			}
		})

	});

	$(document).on('click','.go_top',function(){

		var offset = $("#new_beta").offset();
		$('html').animate({scrollTop : offset.top}, 200);

	});


});


</script>


</html>