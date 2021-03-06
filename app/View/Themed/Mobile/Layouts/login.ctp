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
        echo $this->fetch('script');
        ?>
    </head>
    <body>
        
        <!-- begin container -->
        <div id="container">
			
            <div id="loginWrapper">
                <?php echo $this->fetch('content'); ?>
                
                <?php echo $this->Session->flash(); ?>
            </div>
            
        </div>
        <!-- end container -->
        
    </body>
</html>