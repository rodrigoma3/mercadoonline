<div class="manufacturers view">
<h2><?php echo __('Fabricante'); ?></h2>
	<dl>
		<dt><?php echo __('ID'); ?></dt>
		<dd><?php echo $manufacturer['Manufacturer']['id']; ?>&nbsp;</dd>
		<dt><?php echo __('Nome'); ?></dt>
		<dd><?php echo $manufacturer['Manufacturer']['name']; ?>&nbsp;</dd>
		<dt><?php echo __('CNPJ'); ?></dt>
		<dd><?php echo $manufacturer['Manufacturer']['cnpj']; ?>&nbsp;</dd>
	</dl>
</div>
<div class="actions">
	<?php echo $this->Html->link(__('Editar Fabricante'), array('action' => 'edit', $manufacturer['Manufacturer']['id'])); ?>
	<?php echo $this->Form->postLink(__('Deletar Fabricante'), array('action' => 'delete', $manufacturer['Manufacturer']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $manufacturer['Manufacturer']['id']))); ?>
	<?php echo $this->Html->link(__('Listar Fabricante'), array('action' => 'index')); ?>
</div>
<legend></legend>
<div class="related">
	<h3><?php echo __('Produtos Relacionados'); ?></h3>
	<?php if (!empty($manufacturer['Product'])): ?>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
		<thead>
			<tr>
				<th>#</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Categoria</th>
				<th>Ações</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($manufacturer['Product'] as $product): ?>
			<tr>
				<td><?php echo $product['id']; ?></td>
				<td><?php echo $product['name']; ?></td>
				<td><?php echo $product['description']; ?></td>
				<td><?php echo $product['category_id']; ?></td>
				<td>
					<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('controller' => 'products', 'action' => 'view', $product['id']), array('escape' => false, 'title' => 'ver')); ?>
					&nbsp;
					<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller' => 'products', 'action' => 'edit', $product['id']), array('escape' => false, 'title' => 'editar')); ?>
					&nbsp;
					<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('controller' => 'products', 'action' => 'delete', $product['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['id']), 'escape' => false, 'title' => 'deletar')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>
</div>
