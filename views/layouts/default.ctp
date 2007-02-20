<?php /* SVN FILE: $Id$ */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>CakePHP : The PHP Rapid Development Framework :: <?php echo $title_for_layout?></title>
	<?php echo $html->charset();?>
	<link rel="icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php echo $this->webroot;?>favicon.ico" type="image/x-icon" />
	<?php echo $html->css('cake.basic', 'stylesheet', array("media"=>"all" ));?>
	<?php echo $html->css('cake.forms', 'stylesheet', array("media"=>"all" ));?>
<?php
if(isset($javascript)):
	echo $javascript->link('prototype.js');
endif;
?>
</head>
<body class="main" onload="document.login.nick.focus();">
  <div id="container">
		<div id="header">
			<h1 class="logo">
				<a href="http://cakephp.org"></a>
			</h1>
			<div id="navigation">
				<ul>
					<li class="active"><a href="http://cakephp.org"><span>Home</span></a></li>
					<li><a href="http://cakephp.org/downloads/"><span>Downloads</span></a></li>
					<!--<li><a href="#"><span>Screencasts coming soon!</span></a></li>-->
					<li><a href="http://manual.cakephp.org"><span>Manual</span></a></li>
					<li><a href="http://api.cakephp.org/"><span>API</span></a></li>
					<li><a href="http://bakery.cakephp.org"><span>Bakery</span></a></li>
					<li><a href="https://trac.cakephp.org"><span>Trac</span></a></li>
					<li><a href="http://cakeforge.org"><span>CakeForge</span></a></li>
				</ul>
			</div> <!-- #navigation -->
			<?php //echo $this->renderElement('menu')?>
			<h1>IRC Gateway</h1>
		</div> <!-- #header -->
		<div id="content">
				<?php if ($session->check('Message.flash')) $this->controller->Session->flash(); ?>
				<?php echo $content_for_layout?>
				<div class="clear"></div>
		</div> <!-- #content -->
		<div id="footer">
			<p>
				CakePHP : <a href="http://www.cakefoundation.org/pages/copyright/">&copy; 2007 Cake Software Foundation, Inc.</a>
			</p>
			<a href="http://www.cakephp.org/" target="_new">
				<?php echo $html->image('cake.power.png', array('alt'=>"CakePHP : Rapid Development Framework", 'border'=>"0"))?>
			</a>
		</div>
		<?php echo $cakeDebug;?>
	</div> <!-- #container -->
</body>
</html>