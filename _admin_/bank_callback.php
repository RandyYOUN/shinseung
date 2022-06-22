<!DOCTYPE html>
<html lang="en">
<head>
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
</head>
<body>

</body>

<script>


fetchUser();
function fetchUser()
{
	$.ajax({
		type: 'POST',
		header:{"Content-Type":"application/x-www-form-urlencoded; charset=UTF-8"},
		dataType: 'json',
		url: 'https://openapi.openbanking.or.kr/oauth/2.0/token',
		data: {client_id:'3t5x1o2Qnj92eF83Z3TXsn4h3CAIaqItmqUO8lPT', client_secret:'QiGlb8XC1ygt464voMJTWLa6BVzj1OFHA6AThiAy', scope:'oob',grant_type:'client_credentials'},
		success: function (data) {
			//console.log(data);
			alert(data);
		},
		error: function (request, status, error) {
			alert('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
		}
	});

}

</script>

</body>
</html>