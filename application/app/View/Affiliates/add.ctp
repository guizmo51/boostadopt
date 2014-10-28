<div class="affiliates form">
<?php echo $this->Form->create('Affiliate'); ?>
	<fieldset>
		<legend><?php echo __('Add Affiliate'); ?></legend>
	<?php
		echo $this->Form->input('filleul_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Affiliates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parrain'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
