<div class="affiliates form">
<?php echo $this->Form->create('Affiliate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Affiliate'); ?></legend>
	<?php
		echo $this->Form->input('parrain_id');
		echo $this->Form->input('filleul_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Affiliate.parrain_id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Affiliate.parrain_id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Affiliates'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parrain'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
