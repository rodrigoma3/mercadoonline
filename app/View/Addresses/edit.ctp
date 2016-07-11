<div class="addresses form form-group">
<?php echo $this->Form->create('Address'); ?>
	<fieldset>
		<legend><?php echo __('Editar Endereço'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('cep', array('label' => 'CEP', 'class' => 'form-control'));
		echo $this->Form->input('address', array('label' => 'Endereço', 'class' => 'form-control'));
		echo $this->Form->input('neighborhood', array('label' => 'Bairro', 'class' => 'form-control'));
		echo $this->Form->input('city', array('label' => 'Cidade', 'class' => 'form-control'));
		echo $this->Form->input('state', array('label' => 'Estado', 'class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
	<?php echo $this->Form->postLink(__('Deletar'), array('action' => 'delete', $this->Form->value('Address.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Address.id')))); ?>
</div>
