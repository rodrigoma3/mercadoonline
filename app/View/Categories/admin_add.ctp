<div class="categories form form-group">
<?php echo $this->Form->create('Category'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Categoria'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nome', 'class' => 'form-control'));
		echo $this->Form->input('description', array('label' => 'Descrição', 'class' => 'form-control'));
		echo $this->Form->input('section_id', array('label' => 'Seção', 'class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
	<?php echo $this->Html->link(__('Listar Categorias'), array('action' => 'index')); ?>
</div>
