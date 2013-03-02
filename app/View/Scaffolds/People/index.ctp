<div class="people index">
	<h2><?php echo __('People'); ?></h2>
	<div class="search">
		<?php echo $this->Form->create('Person'); ?>
		<div>
			<?php echo $this->Form->select('c', $options, array('empty' => false, 'id' => 'c')); ?>
			<?php echo $this->Form->input('q', array('label' => false, 'div' => false, 'id' => 'q')) ?>
			<?php echo $this->Form->button('cari', array('type' => 'submit', 'class' => 'submit')); ?>
			<?php echo $this->Form->end(); ?>

			<?php echo $this->Html->link(__('+ Person'), array('action' => 'add'), array('class' => 'linkIco icoAdd')); ?>
		</div>
	</div>
	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('person_first_name', 'Nama'); ?></th>
			<th><?php echo $this->Paginator->sort('person_downline', 'Downline'); ?></th>
			<th><?php echo $this->Paginator->sort('person_mobile_phone', 'Ponsel'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($people as $idx => $person): ?>
			<tr>
				<td><?php echo $idx + 1; ?>&nbsp;</td>
				<td><?php echo h($person['Person']['person_first_name'] . ' ' . $person['Person']['person_last_name']); ?>&nbsp;</td>
				<td><?php echo h($person['Person']['person_downline']); ?>&nbsp;</td>
				<td><?php echo h($person['Person']['person_mobile_phone']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $person['Person']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $person['Person']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $person['Person']['id']), null, __('Are you sure you want to delete # %s?', $person['Person']['id'])); ?>
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
