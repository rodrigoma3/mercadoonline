<div class="situations form form-group">
<?php echo $this->Form->create('Situation', array('url' => 'add')); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Situação'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nome', 'class' => 'form-control'));
		echo $this->Form->input('description', array('label' => 'Descrição', 'class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
	<?php echo $this->Html->link(__('Listar Situações'), array('action' => 'index')); ?>
</div>
