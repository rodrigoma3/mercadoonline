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
		echo $this->Html->css('/datatable/1.10.12/css/dataTables.bootstrap');

		echo $this->fetch('meta');
		echo $this->fetch('css');

	?>
</head>
<body>
	<div id="container">
		<header id="header"><!--header-->
			<div class="header_top"><!--header_top-->
				<!-- <div class="container">
					<div class="row">

					</div>
				</div> -->
			</div><!--/header_top-->

			<div class="header-middle"><!--header-middle-->
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="logo pull-left">
								<a href="/products/index">Mercado Online<!--<img src="images/home/logo.png" alt="" />--></a>
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
									<?php } ?>
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
						<div class="col-sm-12">
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
									<li><a href="/admin/sections">Seções</a></li>
									<li><a href="/admin/categories">Categorias</a></li>
									<li><a href="/admin/manufacturers">Fabricantes</a></li>
									<li><a href="/admin/products">Produtos</a></li>
									<?php if (in_array($this->Session->read('Auth.User.role_id'), array('1'))) { ?>
										<li><a href="/admin/situations">Situações</a></li>
										<li><a href="/admin/roles">Funções</a></li>
										<li><a href="/admin/users">Usuários</a></li>
									<?php } ?>
								</ul>
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

			<!-- <div class="footer-widget">

			</div> -->

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
		echo $this->Html->script('/datatable/1.10.12/js/jquery.dataTables');
		echo $this->Html->script('/datatable/1.10.12/js/dataTables.bootstrap');
		echo $this->Html->script('custom');

		echo $this->fetch('script');
	?>
	<script type="text/javascript">
		function checkActive(tag) {
		    var tags = document.querySelectorAll('.mainmenu a');
		    var url = window.location.href;
		    for (i = 0; i < tags.length; i++) {
		        var link = tags[i].href;
		        if (url.indexOf(link) != -1) {
					tags[i].classList.add('active');
				}
		    }
		}
		checkActive();
	</script>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
