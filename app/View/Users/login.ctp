<div class="col-sm-4 col-sm-offset-1">
	<div class="users form login-form form-group"><!--login form-->
		<?php echo $this->Flash->render('auth'); ?>
		<?php echo $this->Form->create('User'); ?>
				<h2><?php echo __('Entre com sua conta'); ?></h2>
			<?php
				echo $this->Form->input('username', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Nome de Usuário'));
				echo $this->Form->input('password', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Senha'));
			?>
		<?php echo $this->Form->end(array('label' => 'Entrar', 'class' => 'btn btn-default')); ?>
	</div><!--/login form-->
</div>
<div class="col-sm-1">
	<h2 class="or">OU</h2>
</div>
<div class="col-sm-4">
	<div class="signup-form"><!--sign up form-->
		<?php echo $this->Form->create('User', array('url' => 'add')); ?>
				<h2><?php echo __('Cadastre-se!'); ?></h2>
			<?php
				echo $this->Form->input('cpf', array('label' => false, 'class' => 'form-control', 'placeholder' => 'CPF'));
				echo $this->Form->input('email', array('label' => false, 'class' => 'form-control', 'placeholder' => 'Email'));
			?>
		<?php echo $this->Form->end(array('label' => 'Cadastre-se', 'class' => 'btn btn-default')); ?>
	</div><!--/sign up form-->
</div>
