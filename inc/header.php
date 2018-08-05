<header>
	<!-- top Header -->
	<div id="top-header">
		<div class="container">
			<div class="pull-left">
				<?php

				if (isset($_SESSION['login'])) {
					$login = $_SESSION['login'];
					$customer_name = get_customer_by_login($login)->name;

					echo "<span>Добро пожаловать  в OPTIMUM BEAUTY   :    </span>" . $customer_name . "<span></span>";
					echo "<span>   :    </span>" . $_SESSION['login'] . "<span></span>";
				} else {
					echo "<b>Добро пожаловать Гость</b>";
				}

				?>

			</div>
			<div class="pull-right">
				<ul class="header-top-links">
					<?php

					if (!isset($_SESSION['login'])) {
						echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='#' class='text-uppercase' style='color:#fff;'>Войти</a></buuton>";
					} else {
						echo "<button style='width:100px;' background:#800080; border-radius:5px;' class='btn next-btn'><a href='logout.php' class='text-uppercase' style='color:#fff;'>Выити</a></buuton>";

					}

					?>

				</ul>
			</div>
		</div>
	</div>
	<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="optimum_beauty.php">
							<img src="./img/logo.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<div class="input-group">
                           <span class="input-group-addon">Пойск</span>
                           <input type="text" name="search_text" id="search_text" placeholder="Search by Product Details" class="form-control" style="width: 600px; float: left;" />
                        </div>
					</div>
					<!-- /Search -->
					
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong >Личный кабинет <i class="fa fa-caret-down"></i></strong>
							</div>
							
							
							<ul class="custom-menu">
								<li><a href="customer/my_account.php"><i class="fa fa-user-o"></i> личный кабинет</a></li>
								
								<li><a href="checkout.php"><i class="fa fa-check"></i> Checkout</a></li>
								<li><a href="customer_login.php"><i class="fa fa-unlock-alt"></i> Выйти</a></li>
								
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty"></span>
								</div>
								<strong class="text-uppercase">Мой заказы:</strong>
								<br>
								<span></span>
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										
									</div>
									<div class="shopping-cart-btns">
										<a href="cart.php"><button class="main-btn">заказы</button></a>
										<button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button>


									</div>
								</div>
							</div>
						</li>
						<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
			
		</div>
		<!-- container -->
	</header>