<div class="products index">
	<div class="col-sm-3">
		<div class="left-sidebar">
			<h2>Filtro</h2>
			<div class="panel-group category-products" id="accordian"><!--category-productsr-->
				<!-- foreach na lista de categorias dos produtos em promoção, cada categoria tem uma lista de fabricantes -->
				<?php foreach ($menuLeft as $idCategory => $category): ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordian" href="#<?php echo $idCategory; ?>">
									<span class="badge pull-right"><i class="fa fa-plus"></i></span>
									<?php echo $category['name']; ?>
								</a>
							</h4>
						</div>
						<div id="<?php echo $idCategory; ?>" class="panel-collapse collapse">
							<div class="panel-body">
								<ul>
									<li><a href="/products/category/<?php echo $idCategory; ?>">Todos </a></li>
									<?php foreach ($category['manufacturers'] as $idManufacturer => $nameManufacturer): ?>
										<li><a href="/products/category/<?php echo $idCategory.'/manufacturer/'.$idManufacturer; ?>"><?php echo $nameManufacturer; ?> </a></li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<!-- fim do foreach -->
			</div><!--/category-products-->
		</div>
	</div>

	<div class="col-sm-9 padding-right">
		<div class="features_items"><!--features_items-->
			<h2 class="title text-center"><?php echo $titleProducts; ?></h2>
			<?php if (empty($products)): ?>
				<h4 class="text-center">Nenhum resultado encontrado</h4>
			<?php else: ?>
			<?php foreach ($products as $product): ?>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="img/products/<?php echo $product['Product']['id']; ?>.jpg" alt="<?php echo $product['Product']['name']; ?>" />
								<h4>De: R$ <strike><?php echo $product['Product']['price']; ?></strike></h4>
								<h2>Por: R$ <?php echo $product['Product']['promotion_price']; ?></h2>
								<p><?php echo $product['Product']['name'].' - '.$product['Manufacturer']['name']; ?></p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar ao carinho</a>
							</div>
							<div class="product-overlay">
								<div class="overlay-content text-center">
									<div class="form form-group">
										<?php echo $this->Form->create('CartsProduct', array('url' => '/cartsproducts/add')); ?>
										<?php echo $this->Form->input('CartsProduct.product_id', array('type' => 'hidden', 'value' => $product['Product']['id'], 'class' => 'form-control', 'div' => false)); ?>
										<?php echo $this->Form->input('CartsProduct.cart_id', array('type' => 'hidden', 'value' => (isset($cart)) ? $cart['Cart']['id'] : '', 'class' => 'form-control', 'div' => false)); ?>
										<?php echo $this->Form->input('CartsProduct.quantity', array('label' => 'Quantidade', 'class' => 'form-control', 'min' => 1, 'max' => $product['Product']['stock'], 'value' => 1, 'div' => false)); ?>
										<?php echo $this->Form->end(null); ?>
									</div>
									<h4>De: R$ <strike><?php echo $product['Product']['price']; ?></strike></h4>
									<h2>Por: R$ <?php echo $product['Product']['promotion_price']; ?></h2>
									<p><?php echo $product['Product']['name'].' - '.$product['Manufacturer']['name']; ?></p>
									<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Adicionar ao carinho</a>
								</div>
							</div>
						</div>
						<div class="choose">
							<ul class="nav nav-pills nav-justified">
								<li><a href="/products/view/<?php echo $product['Product']['id']; ?>"><i class="fa fa-plus-square"></i>Mais informações</a></li>
							</ul>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
			<?php endif; ?>

		</div><!--features_items-->
	</div>
</div>
