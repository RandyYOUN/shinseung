				<?php
				  $activePage = basename($_SERVER['PHP_SELF'], ".php");
				?>
				<ul>
					<a href="sub_tax.php">
						<li class="<?= ($activePage == 'sub_tax') ? 'on':''; ?>">세무기장<span></span></li>
					</a>
					<a href="sub_consulting.php">
						<li class="<?= ($activePage == 'sub_consulting') ? 'on':''; ?>">컨설팅<span></span></li>
					</a>
					<a href="sub_investigation.php">
						<li class="<?= ($activePage == 'sub_investigation') ? 'on':''; ?>">세무조사<span></span></li>
					</a>
					<a href="sub_company.php">
						<li class="<?= ($activePage == 'sub_company') ? 'on':''; ?>">신승세무법인<span></span></li>
					</a>
					<!--<a href="sub_news.php">
						<li class="<?= ($activePage == 'sub_news') ? 'on':''; ?>">세무뉴스<span></span></li>
					</a>-->
				</ul>