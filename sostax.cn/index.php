<?php include("top.php");?>
	<main>
		<section class="mainVisual">
			<ul>
				<li>
						<img src="resources/images/mainVisual01.jpg" alt="" class="bg" />
						<div>
							<h2>韩国外资公司全方位服务中心</h2>
							<h3>在韩国发展事业 变得更轻松</h3>
							<dl>
								<dd>
									<p><img src="resources/images/mainVicon0101.png"></p>
									<p>注册法人公司</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0102.png"></p>
									<p>注册分公司</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0103.png"></p>
									<p>注册代表处</p>
								</dd>
							</dl>
						</div>
				</li>

				<li>
						<img src="resources/images/mainVisual02.jpg" alt="" class="bg" />
						<div>
							<h2>韩国外资企业一条龙支援中心</h2>
							<h3>卓越的新承IPS提供品质的专业服务</h3>
							<dl>
								<dd>
									<p><img src="resources/images/mainVicon0201.png"></p>
									<p>代理记账</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0202.png"></p>
									<p>税务申报</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0203.png"></p>
									<p>税务筹划</p>
								</dd>
							</dl>
						</div>
				</li>

				<li>
						<img src="resources/images/mainVisual03.jpg" alt="" class="bg" />
						<div>
							<h2>韩国外资企业一条龙支援中心</h2>
							<h3>个性化的人力资源解决方案</h3>
							<dl>
								<dd>
									<p><img src="resources/images/mainVicon0301.png"></p>
									<p>招聘解聘</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0302.png"></p>
									<p>劳动合同签订</p>
								</dd>
								<dd>
									<p><img src="resources/images/mainVicon0303.png"></p>
									<p>劳动派遣</p>
								</dd>
							</dl>
						</div>
				</li>

			</ul>
		</section>

		<section class="counsel">
			<div class="fL">
				<div class="counselList">
					<h2>在线咨询</h2>
					<div id="demo1" class="scroll-text">
						<ul>
							<?php
while ($row = mysqli_fetch_array($result)) {
?>	
							<li><span><?PHP echo $row["CATE_NAME"]?></span><span><?PHP echo $row["COMPANY"]?></span><span><?PHP echo $row["DD"]?></span></li>
<?}?>
						</ul>
					</div>
				</div>
			</div>

			<div class="fR">
				<div class="counselGo">
					<h2>在线咨询</h2>
					<h3>欢迎来到本网站，请问有什么可以帮您</h3>
					<a href="javascript:ChannelIO('show');"></a>
				</div>
			</div>
		</section>

		<section class="link">
			<div>
				<ul>
					<li>
						<img src="resources/images/linkKorea.png">
						<h2>National Tax Service</h2>
						<h3>[韩国] 国税厅</h3>
						<h4>view</h4>
						<a href="https://www.nts.go.kr/eng/" target="_blank"></a>
					</li>

					<li>
						<img src="resources/images/linkKorea.png">
						<h2>Ministry of Employment</h2>
						<h3>[韩国] 雇佣劳动部</h3>
						<h4>view</h4>
						<a href="http://www.moel.go.kr/english/main.jsp" target="_blank"></a>
					</li>

					<li>
						<img src="resources/images/linkChina.png">
						<h2>Embassy of China</h2>
						<h3>[中韩] 中国大使馆</h3>
						<h4>view</h4>
						<a href="http://kr.china-embassy.org/chn/" target="_blank"></a>
					</li>

					<li>
						<img src="resources/images/linkKorea.png">
						<h2>Ministry of Foreign Affairs</h2>
						<h3>[韩国] 外交部</h3>
						<h4>view</h4>
						<a href="http://www.mofa.go.kr/eng/index.do"  target="_blank"></a>
					</li>

					<li>
						<img src="resources/images/linkKorea.png">
						<h2>Ministry of Trade</h2>
						<h3>[韩国] 产业通商支援部</h3>
						<h4>view</h4>
						<a href="http://english.motie.go.kr/www/main.do"  target="_blank"></a>
					</li>
				</ul>
			</div>
		</section>

		<section class="new">
			<h1>在韩国也可以安心专注经营</h1>
			<h2>新承税务师事务所作为您的得力助手，细心准备各种税务会计有关业务。</h2>
			<ul class="title">
				<li><img src="resources/images/new01.png"><span>注册公司</span></li>
				<li><img src="resources/images/new02.png"><span>税务咨询</span></li>
				<li><img src="resources/images/new03.png"><span>代理记账</span></li>
				<li><img src="resources/images/new04.png"><span>合理避税</span></li>
				<li><img src="resources/images/new05.png"><span>人事咨询</span></li>
			</ul>
			<ul class="qr">
				<span>商务洽谈</span>
				<span>中文在线服务<br>便捷，迅速，正确<br><strong>微信 SHINSEUMGIPS</strong></span>
				<img src="resources/images/qr.png">
			</ul>
			<div>
				<section class="rollingImg">
					 <div class="swiper-container">
						<div class="swiper-wrapper">
						  <div class="swiper-slide" style="background:url('resources/images/rolling01.png');"></div>
						  <div class="swiper-slide" style="background:url('resources/images/rolling02.png');"></div>
						  <div class="swiper-slide" style="background:url('resources/images/rolling03.png');"></div>
						  <div class="swiper-slide" style="background:url('resources/images/rolling04.png');"></div>
						  <div class="swiper-slide" style="background:url('resources/images/rolling05.png');"></div>
						  <div class="swiper-slide" style="background:url('resources/images/rolling06.png');"></div>
						</div>
						<div class="swiper-button-next"></div>
						<div class="swiper-button-prev"></div>
					  </div>
					
				</section>
				<section class="rollingText">
					<ul>
						<li>
							<h1>中国尤尼泰首尔站</h1>
							<h2>中国尤尼泰税务师事务所的 首尔分公司，具备韩国最大 规模的中文服务网络</h2>
						</li>
						<li>
							<h1>多数国税厅出身专家</h1>
							<h2>包括国税厅出身的税务师，新承有多数经验丰富的资深专家为您处理业务</h2>
						</li>
						<li>
							<h1>中文流畅以便沟通</h1>
							<h2>新承拥有多数会中文的税务师，随时可以用中文进行税务咨询以及各种业务</h2>
						</li>
					</ul>
				</section>
			</div>
		</section>

		<section class="allpeople">
			<div>
				<h1>复杂的税务问题都为您自动处理</h1>
				<h2>拥有20多年经验的70多名税务会计以及经营顾问将陪伴您。</h2>
			</div>
		</section>

		<section class="manpower">
			<h1>MAN POWER</h1>
			<h2>韩国唯一！拥有最多中国专家</h2>

			<div class="tabBlock">
					<ul class="tabBlock-tabs">
						<li class="tabBlock-tab is-active">投资&注册</li>
						<li class="tabBlock-tab">税务咨询</li>
						<li class="tabBlock-tab">会计咨询</li>
						<li class="tabBlock-tab">劳务咨询</li>
					</ul>

					<div class="tabBlock-content">
						<p></p>
						<div class="tabBlock-pane">
							<div class="manMain">
								<img src="resources/images/manMain03.png">
								<div class="fR">
									<h1>投资&注册本部</h1>
									<h2>韩贤宇</h2>
									<h3>汉阳大学中文系学士<br>北京大学管理学院硕士<br>中小企业振兴公团前工作<br>中国企业咨询经历18年</h3>
								</div>
							</div>
							<div class="manSub"> 
								<ul>
									<li>
										<img src="resources/images/manpowerSub0301.png">
										<h4>卢凖锡</h4>
										<h5>京畿大学经营学士<br>新事业企划及营销经历19年<br>WEB & APP / 连锁店企划<br>构建税务,劳务,法务全覆盖解决方</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0302.png">
										<h4>玄刚哲</h4>
										<h5>嘉泉大学经营学士<br>专门负责韩国市场调查<br>负责设立韩国法人</h5>
									</li>
								</ul>
							</div><!--touchSlider-->
						</div><!--tabBlock-pane-->

						<div class="tabBlock-pane">
							<div class="manMain">
								<img src="resources/images/manMain02.png">
								<div class="fR">
									<h1>税务咨询本部</h1>
									<h2>黄在润 税务师</h2>
									<h3>
										陆军士官学校毕业<br>
										庆北大学经营学硕士<br>
										前 驻中韩国大使馆 税务合作官<br>
										前 国税厅审查官<br>
										前 中部厅国税审查委员<br>
									</h3>
								</div>
							</div>

							<div id="touchSlider" class="touchSlider">
								<ul>
									<!--li>
										<img src="resources/images/manpowerSub0201.png">
										<h4>沈智贤 税务师</h4>
										<h5>嘉泉大学税务会计学专业<br>中韩税务会计咨询<br>中国法令信息中心税务咨询</h5>
									</li-->
									<li>
										<img src="resources/images/manpowerSub0202.png">
										<h4>毕铭庆 会计师</h4>
										<h5>注册税务师、中国注册会计师、美国注册会计师<br>山东大学会计学专业<br>中国会计及税务咨询经历5年<br>大信会计师事务所青岛分所工作</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0203.png">
										<h4>朴浩烈 税务师</h4>
										<h5>国税厅33年工作<br>国税厅财产税收科、所得税科、附加税科等工作<br>江南、盤浦、城南、水原、安阳税务所工作</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0204.png">
										<h4>全明浩 税务师</h4>
										<h5>国税厅33年工作<br>中部地方国税厅、国税厅调查科等工作<br>华城、西兴税务所工作</h5>
									</li>
								</ul>
							</div><!--touchSlider-->
						</div><!--tabBlock-pane-->
						
						<div class="tabBlock-pane">
							<div class="manMain">
								<img src="resources/images/manMain04.png">
								<div class="fR">
									<h1>会计咨询本部</h1>
									<h2>吴钟锡 会计师</h2>
									<h3>
										注册会计师、注册税务师高丽大学经济学专业<br>
										首尔大学研究生院工商管理硕士<br>
										中国人民大学经济学博士<br>
										中国企业咨询经历22年<br>

									</h3>
								</div>
							</div>

							<div class="manSub">
								<ul>
									<li>
										<img src="resources/images/manpowerSub0208.png">
										<h4>会计师颜长顺</h4>
										<h5>注册会计师<br>法人审计及税务诊断<br>M&A及投资收购咨询<br>企业设立及清算咨询
										<br>企业财务会计咨询<br>税务调整及诚实申报咨询<br>税务会计咨询20年经历</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0206.png">
										<h4>边起英 税务师</h4>
										<h5>檀国大学税务专业毕业<br>韩亚银行工作<br>外资企业税务调查咨询20年<br>长短期节税方案研究<br></h5>
									</li>
									
								</ul>
							</div><!--touchSlider-->
						</div><!--tabBlock-pane-->
						
						<div class="tabBlock-pane">
							<div class="manMain">
								<img src="resources/images/manMain01.jpg">
								<div class="fR">
									<h1>劳务咨询本部</h1>
									<h2>金勇德</h2>
									<h3>中国人民大学经济学博士<br>成均馆大学贸易研究所研究员<br>企业成立、战略咨询</h3>
								</div>
							</div>
							<div class="manSub">
								<ul>
									<li>
										<img src="resources/images/manpowerSub0101.png">
										<h4>郑惠淑 理事</h4>
										<h5>韩国江南大学税务学学士<br>中国法人负责人<br>中国投资咨询20年 经验</h5>
									</li>
									<li>
										<img src="resources/images/manpowerSub0102.png">
										<h4>李正姬 部长</h4>
										<h5>韩国艺术大学文艺创作专业毕业<br>劳务法人共感产灾研究所次长<br>劳务咨询15年</h5>
									</li>
								</ul>
							</div><!--touchSlider-->
						</div><!--tabBlock-pane-->
						
				</div><!--tabBlock-content-->
			</div><!--tabBlock-->
		</section>




		<section class="video">		
			<div id="AfZ_Ob_zcRg">
				<img src="resources/images/videoPlay.png">
				<h2>韩国税务研讨会，面向中国公司工作人员</h2>
				<h3>SHINSEUNG CHINA Seoul Global Business Center</h3>					
			</div>
			<ul>
				<a id="qKzuWk6LuBU">
					<img src="resources/images/videoPlay.png">
					<span>新注册公司相关税务基础知识</span>
				</a>
				<a id="fv6NeNWH368">
					<img src="resources/images/videoPlay.png">
					<span>企业所得税基础</span>
				</a>
				<a id="33hTQeMRSk4">					
					<img src="resources/images/videoPlay.png">
					<span>综合所得税</span>					
				</a>
				<a id="JIMKhSPHGuM">
					<img src="resources/images/videoPlay.png">
					<span>增值税</span>
				</a>
				<a id="lqdfv_T1i78">
					<img src="resources/images/videoPlay.png">
					<span>税务调查</span>
				</a>
				<a id="nE_EDP_lJ9U">
					<img src="resources/images/videoPlay.png">
					<span>代扣代缴和四大保险</span>
				</a>
			</ul>			
		</section>	

		<section class="videoPop">
			<div id="player"></div>
			<p class="close"></p>			
		</section>

		<script>

			//레이어팝업 닫기
			$(".videoPop .close ").click(function() {	
				$(".videoPop").css("display","none");
				$(".mask").css("display","none");	
				player.stopVideo();
			});	

			//세마나영상 레이어팝업
			$('.video ul a, .video div').click(function(){
				player.loadVideoById(this.id);
				$(".mask").css("display","block");
				$(".videoPop").fadeIn();		
			});	

			var tag = document.createElement('script');
		
			tag.src = "https://www.youtube.com/iframe_api";
			var firstScriptTag = document.getElementsByTagName('script')[0];
			firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
		
			var player;
			function onYouTubeIframeAPIReady() {
				player = new YT.Player('player', {
				height: '540',
				width: '960',
				videoId: '',
				events: {
					'onReady': stopVideo
				}
				});
			}		  
			function onPlayerReady(event) {
				event.target.playVideo();
			}  		
			function stopVideo() {
				player.stopVideo();
			}
		</script>

		<section class="onesolution">
			<div>
				<h1>新承IPS提供优质全方位服务</h1>
				<h2>让投资者放心、省心</h2>

				<ul>
					<li>
						<div>
							<h3>公司注册</h3>
						</div>
						<span>
							<h4>注册最适合投资的公司吧!<Br>请即刻确认不同类型最优化的设立方式和外国人投资优惠政策</h4>
							<ol>
								<li>注册前期筹备咨询</li>
								<li>公司注册地址咨询</li>
								<li>公司注册资本金咨询</li>
								<li>公司组织形态咨询</li>
								<li>办理公司注册</li>	
							</ol>
						</span>
					</li>
					<li>
						<div>
							<h3>代理记账和税务申报</h3>
						</div>
						<span>
							<h4>新承IPS是中国领先Uni-TAX的韩国合作方，以广泛的覆盖度和专业知识为基础,提供给优质的服务</h4>
							<ol>
								<li>代理记账</li>
								<li>税务申报和税务调整</li>
								<li>税务筹划方案咨询</li>
								<li>协助税务检查</li>
								<li>收购或兼并实地调查</li>
								<li>公司经营管理咨询</li>
								<li>公司注销咨询</li>
								<li>股权转让评估咨询</li>
							</ol>
						</span>
					</li>
					<li>
						<div>
							<h3>人力资源</h3>
						</div>
						<span>
							<h4>符合韩国劳动法的从人事制度到职员招聘支援综合劳务服务用中文支持</h4>
							<ol>
								<li>根据韩国劳动法制定公司人事管理规定</li>
								<li>根据韩国劳动法制定工资薪金管理规定</li>
								<li>根据韩国劳动法更新公司的人事管理制度</li>
								<li>提供工作人员招聘、解聘咨询服务</li>
								<li>提供劳务派遣服务</li>
								<li>提供灵活的服务方式，电话邮件等均可</li>
								<li>提供细节服务，审查年度津贴等</li>
							</ol>
						</span>
					</li>
				</ul>
			</div>
		</section>
		
		<section class="matrix">
			<h1>新承IPS 阶段性咨询方式</h1>	
			<div class="step0">
				<dl>
					<dd>韩国投资及注册公司</dd>
					<dd>税务会计</dd>
					<dd>劳务咨询</dd>
				</dl>
			</div>

			<div class="step01">
				<h2>事业规划</h2>
				<div>
					<p></p>	
					<h3><span>STEP1</span></h3>
					<i></i>
				</div>
				<dl>
					<dd>
						<ol>
							<li>支援开业前准备  (法人成立咨询)</li>
							<li>企业评价 (M&A企业税务上价值评价)</li>
							<li>选定公司地址</li>
						</ol>
					</dd>
					<dd>
						<ol>
							<li>成立中国投资企业<br>(申报外国人投资企业/法人登录证)</li>
							<li>按照事业规划分析预期收入</li>
						</ol>
						
					</dd>
					<dd>
						<ol>
							<li>协助韩国职员招聘</li>
							<li>提供合同书等劳务需要的材料</li>
							<li>薪酬设计咨询</li>							
						</ol>
					</dd>
				</dl>
			</div>			
			
			<div class="step02">
				<h2>运行</h2>
				<div>
					<p></p>	
					<h3><span>STEP2</span></h3>
					<i></i>
				</div>
				<dl>
					<dd>
						<ol>
							<li>取得投资签证</li>
							<li>韩国法人登记</li>
							<li>外国企业登记</li>
							<li>税务会计咨询</li>
							<li>帮助企业M&A</li>
						</ol>
					</dd>
					<dd>
						<ol>
							<li>代理账簿记账/ 税务申报</li>
							<li>韩国法人财务报告书</li>
							<li>结算业务(税务调整/国际交易明细等有关报告和咨询)</li>
							<li>转移价格和税收条约等 国际税收方面的咨询</li>
							<li>外国人投资的减税申请</li>
						</ol>
					</dd>
					<dd>
						<ol>
							<li>诊断劳务情况</li>
							<li>四大保险处理咨询</li>
							<li>人员培训咨询</li>
							<li>准守韩国劳动法</li>
						</ol>
					</dd>
				</dl>
			</div>								
			
			<div class="step03">
				<h2>结构调整、清算</h2>
				<div>
					<p></p>	
					<h3><span>STEP3</span></h3>	
				</div>
				<dl>
					<dd>						
						<ol>
							<li>法人清算登记</li>
							<li>事业者登录证停业申报</li>
						</ol>						
					</dd>
					<dd>						
						<ol>
							<li>结构调整咨询</li>
							<li>公司出售/ 清算税收咨询</li>
							<li>清算价值评估</li>
							<li>咨询资产处理方案</li>
							<li>审查关于清算收入法人税</li>
							<li>检查对股东的赠与制度</li>
						</ol>
					</dd>
					<dd>
						<ol>
							<li>合法解雇咨询</li>
							<li>人员结构调整</li>
							<li>退休金等问题解决</li>
						</ol>
					</dd>					
				</dl>
			</div>			
			
		</section>		

		<section class="price">
			<div>
				<h1>服务费用报价</h1>
				<ul>
					<li class="priceBuild">
						<h2>韩国注册公司</h2>
						<h3><span>一次</span><span>50</span><span>万韩元~</span></h3>
						<ol>
							<li>介绍外国人投资申报程序</li>
							<li>外国投资法人设立公司注册登记</li>
							<li>事业者注册登记</li>
							<li>外国自然人设立公司注册登录</li>
							<li>服务收费不包括第三方税费</li>
						</ol>
					</li>
					<li class="priceTax">
						<h2>代理记账</h2>
						<h3><span>月</span><span>20</span><span>万韩元~</span></h3>
						<ol>
							<li>安排专业人员记账</li>
							<li>以积极主动的心态提供服务</li>
							<li>外商投资公司减税方法建议</li>
							<li>提供中文财务报告</li>
							<li>使用税务talk APP / WEB</li>
							<li>提供财务资料保管服务</li>
							<li>提供各项税务申报服务</li>
						</ol>
					</li>
					<li class="priceLabor">
						<h2>人力资源咨询</h2>
						<h3><span>一次</span><span>50</span><span>万韩元</span></h3>
						<ol>
							<li>协助韩国职员招聘</li>
							<li>提供劳务合同书等资料</li>
							<li>薪酬设计咨询</li>
							<li>四大保险咨询</li>
							<li>劳动纠纷咨询和处理</li>
						</ol>
					</li>
				</ul>
			</div>
		</section>

		<section class="china">
			<div class="unitax">
				<h1>中国首家AAAAA级税务师事务所</h1>
				<h2>尤尼泰税务师事务所有限公司是经国家税务总局批准，于2009年设立,注册资金人民币5000万元，可在全国范围内跨区域开展业务的大型税务师事务所是中国税务师行业 首家获得最高等级AAAAA级荣誉的税务师事务所。<br>
					公司在全国主要省市均设有服务机构，从业人员1500余人，其中税务师500余人，全年经营收入规模超过4亿元。</h2>
			</div>
			<div class="sh">
				<h3>SINSEUNG<br><span>CHINA CONSULTING MEMBER</span></h3>
				<h4>中国 UNI-TAX (尤尼泰税务师事务所有限公司)<br>新承税务师事务所有限公司是中国尤尼泰税务师
事务所的首尔分公司。</h4>
			</div>
		</section>

		<section class="korea">
			<div>
				<div>
					<h2>中韩双边综合咨询</h2>
					<ul>
						<li>新承税务法人</li>
						<li>新承会计法人</li>
						<li>新承法务法人</li>
						<li>新承中国咨询</li>
					</ul>
					<h3>新承集团在韩国首都圈已设立15个分支机构</h3>
					<h4>新承IPS外资企业服务中心是以服务外资公司为中心，能分别为韩国驻中国公司和中国驻韩国公司提供专业化的服务，我们在中、韩两国都有着丰富的咨询经验，能胜任的解决代理记账、税务申报和应对、人力资源和法律等专业问题<br><br>
							过去的几十年中，在信任和理解的基础上，与客户建立紧密的关系，新承IPS期待热忱为新老客户继续服务</h4>
				</div>
			</div>
		</section>

		<section class="performance">
			<h1>新承IPS 客户</h1>
			<!--<h2>多数中国企业的韩国投资/设立法人/税务会计/劳务咨询业务<br>主要政府和公共单位及企业的中国相关委托研究工作<br>百余家重点企业履行中国法律劳务和税务会计咨询职责</h2>-->
			<h3>中国企业</h3>
			<ul>
				<li><img src="resources/images/performance0101.jpg"></li>
				<li><img src="resources/images/performance0102.jpg"></li>
				<li><img src="resources/images/performance0103.jpg"></li>
				<li><img src="resources/images/performance0104.jpg"></li>
				<li><img src="resources/images/performance0105.jpg"></li>
				<li><img src="resources/images/performance0106.jpg"></li>
				<li><img src="resources/images/performance0107.jpg"></li>
				<li><img src="resources/images/performance0108.jpg"></li>
			</ul>
			<h3>韩国 机关单位 & 一般企业 </h3>
			<ul>
				<li><img src="resources/images/performance01.jpg"></li>
				<li><img src="resources/images/performance02.jpg"></li>
				<li><img src="resources/images/performance03.jpg"></li>
				<li><img src="resources/images/performance04.jpg"></li>
				<li><img src="resources/images/performance05.jpg"></li>
				<li><img src="resources/images/performance06.jpg"></li>
				<li><img src="resources/images/performance07.jpg"></li>
				<li><img src="resources/images/performance08.jpg"></li>
				<li><img src="resources/images/performance09.jpg"></li>
				<li><img src="resources/images/performance010.jpg"></li>
				<li><img src="resources/images/performance011.jpg"></li>
				<li><img src="resources/images/performance012.jpg"></li>
			</ul>
		</section>

		<section class="catalogue">
			<h1>找到新承您不用再走冤枉路</h1>
			<h2>我们将细心安排准备，让您更安心地专注于事</h2>
			<ul>
				<li>
					<h3>新承IPS宣传册</h3>
					<h4></h4>
					<a href="https://sostax.cn/down/shinseung_consulting_group_ver_1.0.0.pdf" class="cataChina" download><span>中文</span>PDF 下载</a>
					<a href="https://sostax.cn/down/shinseung_IPS_company_imformation_kor.pdf"><span>韩文</span>PDF 下载</a>
				</li>
				<li>
					<h3>FAQ 整理</h3>
					<h4>韩国投资、注册公司、法务、税务会计、劳务有关 FAQ 整理</h4>
					<a href="https://sostax.cn/down/Starting-a_business_in_seoul_Chinese_2015.pdf" class="cataChina"><span>中文</span>PDF 下载</a>
					<a href="https://sostax.cn/down/Starting-a_business_in_seoul_Korean_2015.pdf"><span>韩文</span>PDF 下载</a>
				</li>
			</ul>
		</section>
		<section class="anywhere">
			<h1>新承税务师事务所无需访问</h1>
			<h2>不管在哪个地区都可以迅速、准确、轻松<br>地进行专业的税务有关业务，且便于咨询。
				<img src="resources/images/anywhereImg.png">
			</h2>
		</section>
<?php include("bottom.php");?>
