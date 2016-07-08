<div class="products form form-group">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Adicionar Produto'); ?></legend>
	<?php
		echo $this->Form->input('name', array('label' => 'Nome', 'class' => 'form-control'));
		echo $this->Form->input('description', array('label' => 'Descrição', 'class' => 'form-control'));
		echo $this->Form->input('manufacturer_id', array('label' => 'Fabricante', 'class' => 'form-control'));
		echo $this->Form->input('category_id', array('label' => 'Categoria', 'class' => 'form-control'));
		echo $this->Form->input('stock', array('label' => 'Estoque', 'class' => 'form-control', 'min' => '0'));
		echo $this->Form->input('price', array('label' => 'Preço', 'step' => '0.01', 'min' => '0', 'class' => 'form-control'));
		echo $this->Form->input('promotion_price', array('label' => 'Preço Promocional', 'step' => '0.01', 'min' => '0', 'class' => 'form-control'));
	?>
	</fieldset>
</div>
<div class="actions">
	<?php echo $this->Form->end(array('label' => 'Salvar', 'div' => false)); ?>
	<?php echo $this->Html->link(__('Listar Produtos'), array('action' => 'index')); ?>
</div>
