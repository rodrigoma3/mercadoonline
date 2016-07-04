<div class="products index">
	<h2><?php echo __('Produtos'); ?></h2>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Fabricante</th>
				<th>Categoria</th>
				<th>Estoque</th>
				<th>Preço</th>
				<th>Preço promocional</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($products as $product): ?>
			<tr>
				<td><?php echo $product['Product']['id']; ?></td>
				<td><?php echo $product['Product']['name']; ?></td>
				<td><?php echo $product['Product']['description']; ?></td>
				<td>
					<?php echo $this->Html->link($product['Manufacturer']['name'], array('controller' => 'manufacturers', 'action' => 'view', $product['Manufacturer']['id'])); ?>
				</td>
				<td>
					<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>
				</td>
				<td><?php echo $product['Product']['stock']; ?></td>
				<td><?php echo $product['Product']['price']; ?></td>
				<td><?php echo $product['Product']['promotion_price']; ?></td>
				<td class="actions">
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $product['Product']['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $product['Product']['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
<div class="actions">
		<?php echo $this->Html->link(__('Novo Produto'), array('action' => 'add')); ?>
</div>
