<section id="cart_items">
	<div class="container">
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Preço</td>
						<td class="quantity">Quantidade</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php $i = 0; ?>
					<?php foreach ($cartProducts as $cartProduct): ?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="img/products/<?php echo $cartProduct['Product']['id']; ?>.jpg" alt="<?php echo $cartProduct['Product']['name']; ?>"></a>
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $cartProduct['Product']['name'].' - '.$cartProduct['Manufacturer']['name']; ?></a></h4>
								<p>Web ID: <?php echo $cartProduct['Product']['id']; ?></p>
							</td>
							<td class="cart_price">
								<p>R$ <?php echo ($cartProduct['Product']['promotion_price'] > 0) ? $cartProduct['Product']['promotion_price'] : $cartProduct['Product']['price'] ; ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input id="CartsProductId" type="hidden" name="data[<?php echo $i; ?>][CartsProduct][id]" value="<?php echo $cartProduct['CartsProduct']['id']; ?>">
									<a class="cart_quantity_up" href="#"><i class="fa fa-plus"></i></a>
									<input id="CartsProductQuantity" class="cart_quantity_input" type="number" name="data[<?php echo $i; ?>][CartsProduct][quantity]" value="<?php echo $cartProduct['CartsProduct']['quantity']; ?>" max="<?php echo $cartProduct['Product']['stock']; ?>" min="1" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="#"><i class="fa fa-minus"></i></a>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">R$ <?php echo ($cartProduct['Product']['promotion_price'] > 0) ? $cartProduct['Product']['promotion_price']*$cartProduct['CartsProduct']['quantity'] : $cartProduct['Product']['price']*$cartProduct['CartsProduct']['quantity'] ; ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="#"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</section> <!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 pull-right">
				<div class="total_area">
					<ul>
						<li>Total <span class="total_cart"></span></li>
					</ul>
					<a class="btn btn-default update" href="">Atualizar</a>
					<a class="btn btn-default check_out" href="/cartsProducts/checkout">Finalizar pedido</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/#do_action-->
