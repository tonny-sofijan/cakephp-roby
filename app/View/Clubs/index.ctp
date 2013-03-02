<div class="clubs index">
	<h2><?php echo __('Clubs'); ?></h2>
	<div class="search">
		<?php echo $this->Form->create('Club', array('type' => 'GET')); ?>
		<div>
			<?php echo $this->Form->select('c', $options, array('empty' => false, 'id' => 'c')); ?>
			<?php echo $this->Form->input('q', array('label' => false, 'div' => false, 'id' => 'q')) ?>
			<?php echo $this->Form->button('cari', array('type' => 'submit', 'class' => 'submit')); ?>
			<?php echo $this->Form->end(); ?>

			<?php echo $this->Html->link(__('+ Club'), array('action' => 'add'), array('class' => 'linkIco icoAdd')); ?>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('created_date'); ?></th>
			<th><?php echo $this->Paginator->sort('club_name', 'Nama Klub'); ?></th>
			<th><?php echo $this->Paginator->sort('league', 'Liga'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($clubs as $club): ?>
			<tr>
				<td><?php echo h($club['Club']['id']); ?>&nbsp;</td>
				<td><?php echo h($club['Club']['created_date']); ?>&nbsp;</td>
				<td><?php echo h($club['Club']['club_name']); ?>&nbsp;</td>
				<td><?php echo h($club['Club']['league']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $club['Club']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $club['Club']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $club['Club']['id']), null, __('Are you sure you want to delete # %s?', $club['Club']['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
	<p>
		<?php
		echo $this->Paginator->counter(array(
			'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		));
		?>	</p>

	<div class="paging">
		<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
		?>
	</div>
</div>
