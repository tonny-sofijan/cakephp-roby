<div class="clubs view">
	<h2><?php echo __('Club'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($club['Club']['id']); ?>
			&nbsp;
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $club['Club']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $club['Club']['id']), null, __('Are you sure you want to delete # %s?', $club['Club']['id'])); ?>
			<?php echo $this->Html->link(__('List'), array('action' => 'index')); ?>
			<?php echo $this->Html->link(__('New'), array('action' => 'add')); ?>
		</dd>
		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($club['Club']['created_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Club Name'); ?></dt>
		<dd>
			<?php echo h($club['Club']['club_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Liga'); ?></dt>
		<dd>
			<?php echo h($club['Club']['league']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
