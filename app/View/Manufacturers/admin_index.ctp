<div class="manufacturers index">
	<h2><?php echo __('Fabricantes'); ?></h2>
	<table class="table table-striped table-bordered table-hover" id="dataTables">
	<thead>
	<tr>
		<th>#</th>
		<th>Nome</th>
		<th>CNPJ</th>
		<th>Ações</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($manufacturers as $manufacturer): ?>
	<tr>
		<td><?php echo $manufacturer['Manufacturer']['id']; ?></td>
		<td><?php echo $manufacturer['Manufacturer']['name']; ?></td>
		<td><?php echo $manufacturer['Manufacturer']['cnpj']; ?></td>
		<td class="actions">
			<?php echo $this->Html->link('<i class="fa fa-eye"></i>', array('action' => 'view', $manufacturer['Manufacturer']['id']), array('escape' => false, 'title' => 'ver')); ?>
			&nbsp;
			<?php echo $this->Html->link('<i class="fa fa-pencil"></i>', array('action' => 'edit', $manufacturer['Manufacturer']['id']), array('escape' => false, 'title' => 'editar')); ?>
			&nbsp;
			<?php echo $this->Form->postLink('<i class="fa fa-trash"></i>', array('action' => 'delete', $manufacturer['Manufacturer']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $manufacturer['Manufacturer']['id']), 'escape' => false, 'title' => 'deletar')); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>
<div class="actions">
		<?php echo $this->Html->link(__('Novo Fabricante'), array('action' => 'add')); ?>
</div>
