<div class="ordersProducts view">
<h2><?php echo __('Orders Product'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ordersProduct['OrdersProduct']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ordersProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $ordersProduct['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Order'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ordersProduct['Order']['id'], array('controller' => 'orders', 'action' => 'view', $ordersProduct['Order']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($ordersProduct['OrdersProduct']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Price'); ?></dt>
		<dd>
			<?php echo h($ordersProduct['OrdersProduct']['total_price']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Orders Product'), array('action' => 'edit', $ordersProduct['OrdersProduct']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Orders Product'), array('action' => 'delete', $ordersProduct['OrdersProduct']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ordersProduct['OrdersProduct']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders Products'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Orders Product'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Orders'), array('controller' => 'orders', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Order'), array('controller' => 'orders', 'action' => 'add')); ?> </li>
	</ul>
</div>
