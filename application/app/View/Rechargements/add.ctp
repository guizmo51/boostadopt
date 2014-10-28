<div class="rechargements form">
<?php echo $this->Form->create('Rechargement'); ?>
	<fieldset>
		<legend><?php echo __('Add Rechargement'); ?></legend>
	<?php
		echo $this->Form->input('date');
		echo $this->Form->input('credit_value');
		echo $this->Form->input('credit_before');
		echo $this->Form->input('credit_after');
		echo $this->Form->input('id_transaction');
		echo $this->Form->input('users_id');
		echo $this->Form->input('coupons_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Rechargements'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Coupons'), array('controller' => 'coupons', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Coupons'), array('controller' => 'coupons', 'action' => 'add')); ?> </li>
	</ul>
</div>
