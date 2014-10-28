<div class="boosters view">
<h2><?php echo __('Booster'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($booster['Booster']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Debut'); ?></dt>
		<dd>
			<?php echo h($booster['Booster']['date_debut']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Fin'); ?></dt>
		<dd>
			<?php echo h($booster['Booster']['date_fin']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nb Profiles'); ?></dt>
		<dd>
			<?php echo h($booster['Booster']['nb_profiles']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($booster['Users']['id'], array('controller' => 'users', 'action' => 'view', $booster['Users']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Booster'), array('action' => 'edit', $booster['Booster']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Booster'), array('action' => 'delete', $booster['Booster']['id']), null, __('Are you sure you want to delete # %s?', $booster['Booster']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Boosters'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Booster'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
