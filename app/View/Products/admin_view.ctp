<div class="products view">
<h2><?php echo __('Produto'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd><?php echo $product['Product']['id']; ?>&nbsp;</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd><?php echo $product['Product']['name']; ?>&nbsp;</dd>
		<dt><?php echo __('Descrição'); ?></dt>
		<dd><?php echo $product['Product']['description']; ?>&nbsp;</dd>
		<dt><?php echo __('Fabricante'); ?></dt>
		<dd><?php echo $this->Html->link($product['Manufacturer']['name'], array('controller' => 'manufacturers', 'action' => 'view', $product['Manufacturer']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Categoria'); ?></dt>
		<dd><?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>&nbsp;</dd>
		<dt><?php echo __('Estoque'); ?></dt>
		<dd><?php echo $product['Product']['stock']; ?>&nbsp;</dd>
		<dt><?php echo __('Preço'); ?></dt>
		<dd><?php echo $product['Product']['price']; ?>&nbsp;</dd>
		<dt><?php echo __('Preço Promocional'); ?></dt>
		<dd><?php echo $product['Product']['promotion_price']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Produto'), array('action' => 'edit', $product['Product']['id'])); ?>
	<?php echo $this->Form->postLink(__('Deletar Produto'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?>
	<?php echo $this->Html->link(__('Listar Produtos'), array('action' => 'index')); ?>
</div>
