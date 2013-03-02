<div class="betDetails form">
<?php echo $this->Form->create('BetDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Bet Detail'); ?></legend>
	<?php
		echo $this->Form->input('person_id');
		echo $this->Form->input('ou_bet', array('type' => 'select', 'options' => $options));
		echo $this->Form->input('amount_of_bet');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
