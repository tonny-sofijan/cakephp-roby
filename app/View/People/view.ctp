<div class="people view">
	<h2><?php echo __('Person'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?>	</dt>
		<dd>
			<?php echo h($person['Person']['id']); ?>
			&nbsp;
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $person['Person']['id'])); ?> 
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $person['Person']['id']), null, __('Are you sure you want to delete # %s?', $person['Person']['id'])); ?> 
			<?php echo $this->Html->link(__('List'), array('action' => 'index')); ?> 
			<?php echo $this->Html->link(__('New'), array('action' => 'add')); ?> 
		</dd>
		<dt><?php echo __('Nama'); ?></dt>
		<dd>
			<?php echo h($person['Person']['person_first_name'] . ' ' . $person['Person']['person_last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alamat'); ?></dt>
		<dd>
			<?php echo h($person['Person']['person_downline']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($person['Person']['person_email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ponsel'); ?></dt>
		<dd>
			<?php echo h($person['Person']['person_mobile_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Catatan'); ?></dt>
		<dd>
			<?php echo h($person['Person']['person_note']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Terdaftar'); ?></dt>
		<dd>
			<?php echo h($person['Person']['created_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<br />
<div class="personBets index">
	<h3><?php echo __('Daftar Taruhan'); ?></h3>
	<div class="search">
		<?php echo $this->Form->create('BetDetail'); ?>
		<div>
			<?php echo $this->Form->input('fdate', array('type' => 'date', 'label' => false, 'div' => false)); ?>
			&nbsp;s/d&nbsp;
			<?php echo $this->Form->input('tdate', array('type' => 'date', 'label' => false, 'div' => false)); ?>
			<?php echo $this->Form->button('cari', array('type' => 'submit', 'class' => 'submit')); ?>
			<?php echo $this->Form->end(); ?>
		</div>
	</div>

	<table cellpadding="0" cellspacing="0">
		<tr>
			<th><?php echo $this->Paginator->sort('created_date', 'Tanggal'); ?></th>
			<th><?php echo $this->Paginator->sort('club_to_bet', 'Klub'); ?></th>
			<th><?php echo $this->Paginator->sort('amount_of_bet', 'Jumlah'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('win_loss', 'W / L'); ?></th>
		</tr>
		<?php $taob = $tw = $tl = 0; ?>
		<?php foreach ($betDetails as $betDetail): ?>
			<?php $taob += $betDetail['BetDetail']['amount_of_bet']; ?>
			<?php
			$wlClass = '';
			if (($betDetail['BetDetail']['status'] == "Menang") || ($betDetail['BetDetail']['status'] == "Menang 1/2")) {
				$wlClass = 'win';
				$tw += $betDetail['BetDetail']['win_loss'];
			} else {
				$wlClass = 'loss';
				$tl += $betDetail['BetDetail']['win_loss'];
			}
			?>
			<tr>
				<td>
					<?php echo $this->Html->link($betDetail['Bet']['created_date'], array('controller' => 'bets', 'action' => 'view', $betDetail['Bet']['id'])); ?>
				</td>
				<td>
					<?php echo isset($betDetail['Club']['club_name']) ? $this->Html->link($betDetail['Club']['club_name'], array('controller' => 'clubs', 'action' => 'view', $betDetail['BetDetail']['club_to_bet'])) : 'Over/Under'; ?>
				</td>
				<td><?php echo number_format($betDetail['BetDetail']['amount_of_bet'], 1, ',', '.'); ?>&nbsp;</td>
				<td class="<?php echo $wlClass; ?>"><?php echo h($betDetail['BetDetail']['status']); ?>&nbsp;</td>
				<td class="<?php echo $wlClass; ?>"><?php echo number_format($betDetail['BetDetail']['win_loss'], 1, ',', '.'); ?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="bold"><?php echo number_format($taob, 1, ',', '.'); ?>&nbsp;</td>
			<td>&nbsp;</td>
			<td class="<?php echo (($tw - $tl) > 0) ? 'win' : 'loss' ?>">&plusmn; <strong><?php echo number_format(abs($tw - $tl), 1, ',', '.'); ?></strong>&nbsp;</td>
		</tr>
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

<br />
Total Menang: <strong><?php echo number_format($tw, 0, ',', '.') ?></strong>
<br />
Total Kalah: <strong><?php echo number_format($tl, 0, ',', '.') ?></strong>
