<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title').' | Mercado Online'; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		// echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom');
		echo $this->Html->css('animate');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('font-awesome');
		echo $this->Html->css('prettyPhoto');
		echo $this->Html->css('price-range');
		echo $this->Html->css('main');
		echo $this->Html->css('responsive');
		echo $this->Html->css('angular-growl');
		echo $this->Html->css('/datatable/1.10.12/css/dataTables.bootstrap');

		echo $this->fetch('meta');
		echo $this->fetch('css');

	?>
</head>
<body>
	<div id="container">
		<header id="header"><!--header-->
			<div class="header_top"><!--header_top-->
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<div class="contactinfo">
								<ul class="nav nav-pills">
									<li><a href=""><i class="fa fa-phone"></i> (54) 3334-1100</a></li>
									<li><a href=""><i class="fa fa-envelope"></i> atendimento@mercadoonline.com.br</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="social-icons pull-right">
								<ul class="nav navbar-nav">
									<li><a href="https://facebook.com/mercadoonline/"><i class="fa fa-facebook"></i></a></li>
									<li><a href="https://twitter.com/mercadoonline/"><i class="fa fa-twitter"></i></a></li>
									<li><a href="https://plus.google.com/mercadoonline/"><i class="fa fa-google-plus"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header_top-->

			<div class="header-middle"><!--header-middle-->
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="logo pull-left">
								<a href="/products">Mercado Online<!--<img src="images/home/logo.png" alt="" />--></a>
							</div>
						</div>
						<!-- <div class="col-sm-3">
							<div class="search_box pull-right">
								<input type="text" placeholder="Search"/>
							</div>
						</div> -->
						<div class="col-sm-8">
							<div class="shop-menu pull-right">
								<ul class="nav navbar-nav">
									<?php if ($this->Session->read('Auth.User')) { ?>
										<li><a href="/users/view/<?php echo $this->Session->read('Auth.User.id'); ?>"><i class="fa fa-user"></i> Minha Conta</a></li>
										<!-- <li><a href="/orders/favorite/<?php echo $this->Session->read('Auth.User.id'); ?>"><i class="fa fa-star"></i> Favoritos</a></li>
										<li><a href="/orders/index/<?php echo $this->Session->read('Auth.User.id'); ?>"><i class="fa fa-crosshairs"></i> Pedidos</a></li> -->
									<?php } ?>
									<li><a href="/carts/<?php echo (isset($cart)) ? $cart['Cart']['id'] : '' ; ?>"><i class="fa fa-shopping-cart"></i> Carrinho</a></li>
									<?php if ($this->Session->read('Auth.User')) { ?>
										<li><a href="/users/logout"><i class="fa fa-sign-out"></i> Sair</a></li>
									<?php }  else { ?>
										<li><a href="/users/login"><i class="fa fa-sign-in"></i> Entrar</a></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header-middle-->

			<div class="header-bottom"><!--header-bottom-->
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="mainmenu pull-left">
								<ul class="nav navbar-nav collapse navbar-collapse">
									<li><a href="/products" class="active">Promoções</a></li>
									<li class="dropdown"><a href="#">Seções<i class="fa fa-angle-down"></i></a>
	                                    <ul role="menu" class="sub-menu">
	                                        <li>
												<!-- <div class="container"> -->
													<div class="row">
													<!-- <div class="col-sm-12"> -->
														<?php
														foreach ($menuTop as $section) { ?>
															<div class="col-sm-3">
																<a href="/products/section/<?php echo $section['Section']['id']; ?>"><h4><?php echo $section['Section']['name']; ?></h4></a>
																<ul>
																	<?php foreach ($section['Category'] as $category) { ?>
																		<li><a href="/products/category/<?php echo $category['id']; ?>"><?php echo $category['name']; ?></a></li>
																	<?php } ?>
																</ul>
															</div>

														<?php } ?>
													</div>
												<!-- </div> -->
											</li>
	                                    </ul>
	                                </li>
									<li><a href="/addresses/addressToDeliver">Entrega</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6 form-group">
							<?php echo $this->Form->create('Product', array('url' => '/products/search', 'type' => 'get')); ?>
							<div class="search_box pull-right input-group">
								<?php echo $this->Form->input('q', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Buscar')); ?>
								<span class="input-group-btn">
									<?php echo $this->Form->button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' => 'btn btn-default')); ?>
									<?php echo $this->Form->end(null); ?>
						    	</span>
							</div>
						</div>
					</div>
				</div>
			</div><!--/header-bottom-->
		</header><!--/header-->

		<div id="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div ng-app="myApp" ng-controller="myCtrl" id="myAngular">
							<div limit-messages="1" growl></div>
						</div>
						<?php echo $this->Flash->render(); ?>

						<?php echo $this->fetch('content'); ?>
					</div>
				</div>
			</div>
		</div>

		<footer id="footer"><!--Footer-->
			<!-- <div class="footer-top">
				<div class="container">

				</div>
			</div> -->

			<div class="footer-widget">
				<div class="container">
					<div class="row">
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Service</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Online Help</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Order Status</a></li>
									<li><a href="#">Change Location</a></li>
									<li><a href="#">FAQ’s</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Quock Shop</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">T-Shirt</a></li>
									<li><a href="#">Mens</a></li>
									<li><a href="#">Womens</a></li>
									<li><a href="#">Gift Cards</a></li>
									<li><a href="#">Shoes</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>Policies</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Terms of Use</a></li>
									<li><a href="#">Privecy Policy</a></li>
									<li><a href="#">Refund Policy</a></li>
									<li><a href="#">Billing System</a></li>
									<li><a href="#">Ticket System</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="single-widget">
								<h2>About Shopper</h2>
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#">Company Information</a></li>
									<li><a href="#">Careers</a></li>
									<li><a href="#">Store Location</a></li>
									<li><a href="#">Affillate Program</a></li>
									<li><a href="#">Copyright</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-3 col-sm-offset-1">
							<div class="single-widget">
								<h2>About Shopper</h2>
								<form action="#" class="searchform">
									<input type="text" placeholder="Your email address" />
									<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
									<p>Get the most recent updates from <br />our site and be updated your self...</p>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>

			<div class="footer-bottom">
				<div class="container">
					<div class="row">
						<p class="pull-left">Copyright © 2016 Mercado Online Ltda. Todos os direitos reservados.</p>
					</div>
				</div>
			</div>

		</footer><!--/Footer-->
	</div>
	<?php
		echo $this->Html->script('jquery');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('html5shiv');
		echo $this->Html->script('jquery.prettyPhoto');
		echo $this->Html->script('jquery.scrollUp.min');
		echo $this->Html->script('main');
		echo $this->Html->script('price-range');
		echo $this->Html->script('angular.min');
		echo $this->Html->script('angular-animate');
		echo $this->Html->script('angular-sanitize');
		echo $this->Html->script('angular-growl');
		echo $this->Html->script('/datatable/1.10.12/js/jquery.dataTables');
		echo $this->Html->script('/datatable/1.10.12/js/dataTables.bootstrap');
		echo $this->Html->script('custom');

		echo $this->fetch('script');
	?>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
