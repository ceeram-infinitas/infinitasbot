<?php /* SVN FILE: $Id$ */ ?>
	<span class="notice">
		Your database configuration file is
		<?php
			$filePresent = null;
			if(file_exists(CONFIGS.'database.php')):
				echo 'present';
				$filePresent = true;
			else:
				echo 'NOT present';
			endif;
		?>
	</span>
</p>
<?php if (!empty($filePresent)):
 	uses('model' . DS . 'connection_manager');
	$db = &ConnectionManager::getInstance();
 	$connected = $db->getDataSource('default');
?>
<p>
	<span class="notice">
		Cake
		<?php if($connected->isConnected()):
		 		echo ' is able to';
			else:
				echo ' is not able to';
			endif;
		?>
		connect to the database.
	</span>
</p>
<?php endif;?><h2>Sweet, "Cakebot" got Baked by CakePHP!</h2>
<h3>Editing this Page</h3>
<p>
To change the content of this page, edit: /project/cakebot/views/pages/home.ctp.<br />
To change its layout, edit: /project/cakebot/views/layouts/default.ctp.<br />
You can also add some CSS styles for your pages at: /project/cakebot/webroot/css/.
</p>
