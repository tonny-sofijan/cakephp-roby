<div class="betDetails form">
<?php echo $this->Form->create('BetDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Bet Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('person_id');
		echo $this->Form->input('club_to_bet', array('type' => 'select', 'options' => $clubToBet));
		echo $this->Form->input('amount_of_bet');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
