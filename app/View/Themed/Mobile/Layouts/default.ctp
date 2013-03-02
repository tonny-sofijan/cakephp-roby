<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
		<!-- no cache headers -->
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="-1" />
		<meta http-equiv="Cache-Control" content="no-cache" />
		<!-- end no cache headers -->
		<meta name="HandheldFriendly" content="true" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />		
		<?php echo $this->Html->charset(); ?>

        <title><?php echo $title_for_layout; ?></title>

		<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('reset');
		echo $this->Html->css('mstyle');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		?>
    </head>
	<body>
		<div id="container">
			<div id="header">
				<ul id="navigasi">
					<li class="active"><?php echo $this->Html->link(__('Bet'), array('controller' => 'bets', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('Club'), array('controller' => 'clubs', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('People'), array('controller' => 'people', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('Report'), array('controller' => 'reports', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('User'), array('controller' => 'users', 'action' => 'index')); ?> </li>
					<li><?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
				</ul>
			</div>
			<div id="content">

				<?php echo $this->Session->flash(); ?>

				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="footer">
				copyright &copy; 2012, Bola mania.
			</div>
		</div>
		<?php #echo $this->element('sql_dump');  ?>
	</body>
</html>
