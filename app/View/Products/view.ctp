<div class="products view">
	<div class="col-sm-3">
		<?php echo $this->Html->image('/img/products/'.$product['Product']['id'].'.jpg'); ?>
	</div>
	<div class="col-sm-6">
		<h2><?php echo __($product['Product']['name'], array('alt' => $product['Product']['name'], 'class' => 'product-img')); ?></h2>
		<dl>
			<dt>Código</dt>
			<dd><?php echo $product['Product']['id']; ?>&nbsp;</dd>
			<dt>Fabricante</dt>
			<dd><?php echo $product['Manufacturer']['name']; ?>&nbsp;</dd>
			<dt>Categoria</dt>
			<dd><?php echo $product['Category']['name']; ?>&nbsp;</dd>
			<?php if ($product['Product']['promotion_price'] > 0): ?>
				<dt>De:</dt>
				<dd>R$ <strike><?php echo $product['Product']['price']; ?></strike>&nbsp;</dd>
				<dt>Por:</dt>
				<dd>R$ <?php echo $product['Product']['promotion_price']; ?>&nbsp;</dd>
			<?php else: ?>
				<dt>Preço</dt>
				<dd>R$ <?php echo $product['Product']['price']; ?>&nbsp;</dd>
			<?php endif; ?>
			<dt>Descrição</dt>
			<dd><?php echo $product['Product']['description']; ?>&nbsp;</dd>
		</dl>
	</div>
	<div class="col-sm-3">
		<div class="form form-group">
			<?php if (!isset($cart)) {
				$cart['Cart']['id'] = 0;
			} ?>
			<?php echo $this->Form->create('CartsProduct', array('url' => '/cartsproducts/add')); ?>
			<?php echo $this->Form->input('CartsProduct.product_id', array('type' => 'hidden', 'value' => $product['Product']['id'], 'class' => 'form-control')); ?>
			<?php echo $this->Form->input('CartsProduct.cart_id', array('type' => 'hidden', 'value' => $cart['Cart']['id'], 'class' => 'form-control')); ?>
			<?php echo $this->Form->input('CartsProduct.quantity', array('label' => 'Quantidade', 'class' => 'form-control', 'min' => 1, 'max' => $product['Product']['stock'], 'value' => 1)); ?>
		</div>
		<div class="actions">
			<?php echo $this->Form->end(array('label' => 'Adicionar ao carinho', 'div' => false)); ?>
		</div>
	</div>
</div>
<!-- <div class="actions">
	<?php echo $this->Html->link(__('Adicionar ao carinho'), array('action' => 'add', $product['Product']['id'])); ?>
</div> -->
