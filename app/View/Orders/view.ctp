<div class="orders view">
<h2><?php echo __('Pedido'); ?></h2>
	<dl>
		<dt>Número</dt>
		<dd><?php echo $order['Order']['id']; ?>&nbsp;</dd>
		<dt>Criado em</dt>
		<dd><?php echo $order['Order']['created']; ?>&nbsp;</dd>
		<dt>Modificado em</dt>
		<dd><?php echo $order['Order']['modified']; ?>&nbsp;</dd>
		<dt>Situação</dt>
		<dd><?php echo $order['Situation']['name']; ?>&nbsp;</dd>
		<dt>Valor Total (R$)</dt>
		<dd><?php echo $order['Order']['total_price']; ?>&nbsp;</dd>
		<dt>Entrega</dt>
		<dd><?php echo ($order['Order']['deliver']) ? 'Em cliente' : 'Em loja' ; ?>&nbsp;</dd>
		<dt>Endereço para Entrega</dt>
		<dd><?php echo $order['Order']['address_to_deliver']; ?>&nbsp;</dd>
		<dt>Entregar em</dt>
		<dd><?php echo $order['Order']['deliver_on']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php if ($order['Order']['situation_id'] == '2'): ?>
		<?php echo $this->Html->link(__('Editar Pedido'), array('action' => 'edit', $order['Order']['id'])); ?>
		<?php echo $this->Form->postLink(__('Deletar Pedido'), array('action' => 'delete', $order['Order']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $order['Order']['id']))); ?>
	<?php endif; ?>
	<hr>
</div>
<div class="related">
	<h3><?php echo __('Relação de Produtos'); ?></h3>
	<?php if (!empty($order['Product'])): ?>
	<table class="table table-striped table-bordered table-hover datatable">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Fabricante</th>
				<th>Quantidade</th>
				<th>Valor Unit.</th>
				<th>Valor Total</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($order['Product'] as $product): ?>
				<tr>
					<td><?php echo $product['id']; ?></td>
					<td><?php echo $product['name']; ?></td>
					<td><?php echo $product['manufacturer_id']; ?></td>
					<td><?php echo $product['OrdersProduct']['quantity']; ?></td>
					<td><?php echo $product['OrdersProduct']['unit_price']; ?></td>
					<td><?php echo ($product['OrdersProduct']['unit_price']*$product['OrdersProduct']['quantity']); ?></td>
					<td class="actions">
						<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller' => 'products', 'action' => 'view', $product['id']), array('escape' => false, 'title' => 'ver')); ?>
						&nbsp;
						<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller' => 'products', 'action' => 'edit', $product['id']), array('escape' => false, 'title' => 'editar')); ?>
						&nbsp;
						<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('controller' => 'products', 'action' => 'delete', $product['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['id']), 'escape' => false, 'title' => 'excluir')); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
</div>
<?php debug($order); ?>
