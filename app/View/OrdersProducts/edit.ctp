<div class="ordersProducts form">
<?php echo $this->Form->create('OrdersProduct'); ?>
	<fieldset>
		<legend><?php echo __('Edit Orders Product'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('product_id');
		echo $this->Form->input('order_id');
		echo $this->Form->input('quantity');
		echo $this->Form->input('total_price');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('OrdersProduct.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('OrdersProduct.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Orders Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
