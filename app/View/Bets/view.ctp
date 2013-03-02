<div class="bets view">
	<h2><?php echo __('Bet'); ?></h2>
	<dl>
		<dt><?php echo __('Actions'); ?></dt>
		<dd>
			<?php #echo h($bet['Bet']['id']); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $bet['Bet']['id'])); ?> 
			<?php echo $this->Form->postLink(__('Del'), array('action' => 'delete', $bet['Bet']['id']), null, __('Are you sure you want to delete # %s?', $bet['Bet']['id'])); ?> 
			<?php echo $this->Html->link(__('List'), array('action' => 'index')); ?> 
			<?php echo $this->Html->link(__('+Bet'), array('controller' => 'bet_details', 'action' => 'add', $bet['Bet']['id'])); ?> 
			<?php echo $this->Html->link(__('+O/U'), array('controller' => 'bet_details', 'action' => 'add_ou', $bet['Bet']['id'])); ?> 
			<?php echo $this->Html->link(__('+Gol'), array('action' => 'goal', $bet['Bet']['id'])); ?> 
		</dd>
		<dt><?php echo __('Home'); ?></dt>
		<dd>
			<?php echo isset($bet['Bet']['result1']) ? ($bet['Bet']['result1']) : ''; ?>
			<?php echo h($bet['Home']['club_name']); ?>
			&nbsp;[
			<?php echo isset($bet['Bet']['handicap1']) ? ('<strong>P</strong>' . $bet['Bet']['handicap1']) : ''; ?>
			<?php echo isset($bet['Bet']['loss1']) ? ('<strong>K</strong>' . $bet['Bet']['loss1']) : ''; ?>
			]
		</dd>
		<dt><?php echo __('Away'); ?></dt>
		<dd>
			<?php echo isset($bet['Bet']['result2']) ? ($bet['Bet']['result2']) : ''; ?>
			<?php echo h($bet['Away']['club_name']); ?>
			&nbsp;[
			<?php echo isset($bet['Bet']['handicap2']) ? ('<strong>P</strong>' . $bet['Bet']['handicap2']) : ''; ?>
			<?php echo isset($bet['Bet']['loss2']) ? ('<strong>K</strong>' . $bet['Bet']['loss2']) : ''; ?>
			]
		</dd>

		<dt><?php echo __('Skor'); ?></dt>
		<dd>
			<?php echo h($bet['Bet']['result1']) . ' : ' . h($bet['Bet']['result2']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Over / Under'); ?></dt>
		<dd>
			<?php echo h($bet['Bet']['over_under']); ?>
			&nbsp;[
			<?php echo isset($bet['Bet']['ou_over_loss']) ? ('<strong>KO</strong>' . $bet['Bet']['ou_over_loss']) : ''; ?>
			<?php echo isset($bet['Bet']['ou_under_loss']) ? ('<strong>KU</strong>' . $bet['Bet']['ou_under_loss']) : ''; ?>
			]
		</dd>
		<dt><?php echo __('Catatan'); ?></dt>
		<dd>
			<?php echo h($bet['Bet']['bet_note']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<br />

<div class="betDetails view">
	<table>
		<tr>
			<th>
				<?php echo isset($bet['Bet']['result1']) ? $bet['Bet']['result1'] : ''; ?>
				<?php echo $bet['Home']['club_name']; ?>
				[
				<?php echo isset($bet['Bet']['handicap1']) ? 'P' . ($bet['Bet']['handicap1']) : ''; ?>
				<?php echo isset($bet['Bet']['loss1']) ? 'K' . ($bet['Bet']['loss1']) : ''; ?>
				]
			</th>
			<th>
				<?php echo isset($bet['Bet']['result2']) ? $bet['Bet']['result2'] : ''; ?>
				<?php echo $bet['Away']['club_name']; ?>
				[
				<?php echo isset($bet['Bet']['handicap2']) ? 'P' . ($bet['Bet']['handicap2']) : ''; ?>
				<?php echo isset($bet['Bet']['loss2']) ? 'K' . ($bet['Bet']['loss2'])  : ''; ?>
				]
			</th>
			<th>
				Over
				[
				<?php echo isset($bet['Bet']['ou_over_loss']) ? 'K' . ($bet['Bet']['ou_over_loss']) : ''; ?>
				]
			</th>
			<th>
				Under
				[
				<?php echo isset($bet['Bet']['ou_under_loss']) ? 'K' . ($bet['Bet']['ou_under_loss']) : ''; ?>
				]
			</th>
			<th class="right">Jumlah</th>
			<?php if (isset($bet['Bet']['result1']) AND isset($bet['Bet']['result2'])): ?>
				<th>W / L</th>
				<th class="right">Setor</th>
			<?php endif; ?>
			<th>Acts</th>
		</tr>

		<?php $thome = $taway = $tover = $tunder = $to = $tu = $total = $tstor = $tw = $tl = 0; ?>
		<?php foreach ($bet['BetDetail'] as $betDetail): ?>
			<?php $total += $betDetail['amount_of_bet']; ?>
			<?php $tstor = ($betDetail['status']); ?>
			<?php
			$wlClass = '';
			if (($betDetail['status'] == "Menang") || ($betDetail['status'] == "Menang 1/2")) {
				$wlClass = 'win';
				$tw += $betDetail['win_loss'];
			} else {
				$wlClass = 'loss';
				$tl += $betDetail['win_loss'];
			}
			?>

			<tr>
				<?php if ($betDetail['club_to_bet'] == $bet['Bet']['home']): ?>
					<?php $thome += $betDetail['amount_of_bet']; ?>
					<td><?php echo $betDetail['Person']['person_first_name'] . ' ' . $betDetail['Person']['person_last_name']; ?></td>
					<td>&times;</td>
					<td>&times;</td>
					<td>&times;</td>
				<?php elseif ($betDetail['club_to_bet'] == $bet['Bet']['away']): ?>
					<?php $taway += $betDetail['amount_of_bet']; ?>
					<td>&times;</td>
					<td><?php echo $betDetail['Person']['person_first_name'] . ' ' . $betDetail['Person']['person_last_name']; ?></td>
					<td>&times;</td>
					<td>&times;</td>
				<?php elseif ($betDetail['ou_bet'] == '1'): ?>
					<?php $to += $betDetail['amount_of_bet']; ?>
					<td>&times;</td>
					<td>&times;</td>
					<td><?php echo $betDetail['Person']['person_first_name'] . ' ' . $betDetail['Person']['person_last_name']; ?></td>
					<td>&times;</td>
				<?php elseif ($betDetail['ou_bet'] == '0'): ?>
					<?php $tu += $betDetail['amount_of_bet']; ?>
					<td>&times;</td>
					<td>&times;</td>
					<td>&times;</td>
					<td><?php echo $betDetail['Person']['person_first_name'] . ' ' . $betDetail['Person']['person_last_name']; ?></td>
				<?php endif; ?>

				<td class="right"><?php echo number_format($betDetail['amount_of_bet'], 1, ',', '.'); ?></td>

				<?php if (isset($bet['Bet']['result1']) AND isset($bet['Bet']['result2'])): ?>
					<td class="<?php echo $wlClass; ?>"><?php echo $betDetail['status']; ?></td>
					<td class="right <?php echo $wlClass; ?>"><?php echo number_format($betDetail['win_loss'], 1, ',', '.'); ?></td>
				<?php endif; ?>
				<td class="actions">
					<?php echo ($betDetail['ou_bet'] == '') ? $this->Html->link(__('Edit'), array('controller' => 'bet_details', 'action' => 'edit', $betDetail['id'])) : $this->Html->link(__('Edit'), array('controller' => 'bet_details', 'action' => 'edit_ou', $betDetail['id'])); ?>
			<?php echo $this->Html->link(__('Delete'), array('controller' => 'bet_details', 'action' => 'delete', $betDetail['id']), null, __('Are you sure you want to delete # %s?', $betDetail['id'])); ?>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td class="right bold"><?php echo number_format($thome, 1, ',', '.'); ?></td>
			<td class="right bold"><?php echo number_format($taway, 1, ',', '.'); ?></td>
			<td class="right bold"><?php echo number_format($to, 1, ',', '.'); ?></td>
			<td class="right bold"><?php echo number_format($tu, 1, ',', '.'); ?></td>
			<td class="right bold"><?php echo number_format($total, 1, ',', '.'); ?></td>
			<?php if (isset($bet['Bet']['result1']) AND isset($bet['Bet']['result2'])): ?>
				<td class="right bold">&nbsp;</td>
				<?php $twl = $tw - $tl; ?>
				<td class="right bold <?php echo ($twl > 0) ? 'win' : 'loss'; ?>"><?php echo ($twl > 0) ? '+ ' . number_format($twl, 1, ',', '.') : number_format($twl, 1, ',', '.'); ?></td>
			<?php endif; ?>
			<td class="right bold">&nbsp;</td>
		</tr>
	</table>
</div>

Klub yang diunggulkan: <strong><?php echo ($thome > $taway) ? $bet['Home']['club_name'] : $bet['Away']['club_name']; ?></strong>.&nbsp;
Selisih <strong>Rp <?php echo number_format(abs($thome - $taway), 1, ',', '.'); ?></strong>
<br />
Over / Under: <strong><?php echo ($to > $tu) ? 'Over' : 'Under'; ?></strong>.&nbsp;
Selisih <strong>Rp <?php echo number_format(abs($to - $tu), 1, ',', '.'); ?></strong>
<br />
