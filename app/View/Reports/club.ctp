 
<div class="bets index">
	<h2><?php echo __('Win-Loss per Club'); ?></h2>
	<div class="search">
		<?php echo $this->Form->create('Bet'); ?>
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
			<th>Club Name</th>
			<th class="right">Win</th>
			<th class="right loss">Loss</th>
		</tr>
		<?php $twin = $tloss = 0; ?>
		<?php foreach ($clubs as $club): ?>
			<?php
			$twin += $club['win'];
			$tloss += $club['loss'];
			?>
			<tr>
				<td><?php echo $club['name']; ?>&nbsp;</td>
				<td class="right"><?php echo number_format($club['win'], 0, ',', '.'); ?>&nbsp;</td>
				<td class="right loss"><?php echo number_format($club['loss'], 0, ',', '.'); ?>&nbsp;</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td class="right bold">Total</td>
			<td class="right bold"><?php echo number_format($twin, 0, ',', '.'); ?>&nbsp;</td>
			<td class="right loss bold"><?php echo number_format($tloss, 0, ',', '.'); ?>&nbsp;</td>
		</tr>
	</table>
</div>
