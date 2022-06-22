<div>
					<a href="index.php">양도소득세 전문상담센터</a>
					<ul>
						<a href="sub_price.php">
							<li>서비스가격</li>
						</a>
						<a href="sub_member.php">
							<li>구성원</li>
						</a>
						<a href="sub_news.php">
							<li>세무뉴스</li>
						</a>
					</ul>
				</div>


				<script>
				

				//따라다니는 서브네비
				$(window).scroll(function () {

					var subchange = $('.subvisual').height();

					if ($(this).scrollTop() > subchange) {
						TweenLite.to('.subnavi', 0.1, { css: { background: "#fff", position: "fixed", width: "100%", paddingTop: "0px", boxShadow: "-1px -2px 9px rgba(230,230,230,.9)" } });
					}
					else {
						TweenLite.to('.subnavi', 0, { css: { background: "none", position: "absolute", paddingTop: "30px", boxShadow: "none" } });
					}
				});
			</script>