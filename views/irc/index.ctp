<?php /* SVN FILE: $Id$ */ ?>
<?php echo $javascript->link('chat'); ?>
<style type="text/css"><!--
	.border {
		background-image: url(../img/back.gif); border: 1px solid #000000;
		background-position: center; background-repeat: no-repeat;
	}
	.layerwindow {
		position: absolute; visibility: hidden; z-index: 6000;
	}
	.invisible {
		visibility: hidden; display: none; color: #FFFFFF;
		background-color: #FFFFFF; z-index: 0;
	}
--></style>
<p>
Please note, you WILL get a security confirmation dialog when you first launch this applet. This is because it has not been digitally signed using an arcane ritual involving sheep and stuff. The main reason this happens is that the applet will be connecting to a server (irc.freenode.org) which is not the server that this web site is hosted on (irc.cakephp.org), so it wants permission to do so. It is a perfectly safe applet to run.
</p>
<div class="invisible"><h1>CakePHP</h1></div>
<script type="text/javascript"><!--
	document.write(JavaCheck());
--></script>
<script type="text/javascript"><!--
	document.write(WriteLayer('Chat Page is loading...'));
--></script>
<?php
	echo $form->create('Irc', array('name'=>'login', 'action'=>'chat', 'onsubmit'=>"return CheckForm('/irc/index/$advanced')"));
?>

				<script type="text/javascript"><!--
					document.writeln('<input type="hidden" name="data[Irc][popupenabled]"  value="1" id="IrcPopupenabled" \/>');
					document.writeln('<input type="hidden" name="data[Irc][jsenabled]"  value="1" id="IrcJsenabled" \/>');
					document.writeln('<input type="hidden" name="data[Irc][layerenabled]"  value="1" id="IrcLayerenabled" \/>');
				--></script>


<?php
	echo $form->input('nick');
	if($advanced):
		echo $form->input('password');

		echo $form->input('channel', array('options' => $channels));
		echo $form->input('server', array('options' => $servers));
		//echo $form->input('style', array('options' => $colorsets));

		echo $form->input('font', array('options' => $fonts));
		echo $form->input('size', array('options' => $sizes));
		echo $form->input('sex', array('options' => $sexes));
		echo $form->input('age', array('options' => $ages));
		echo $form->input('location');
	endif;
		echo $form->input('smileys', array('label'=>'Display Smileys','type'=>'checkbox', 'value'=>'1'));
	if($advanced):

		echo $form->input('save', array('label'=>'Save Settings', 'type'=>'checkbox', 'value'=>'1'));
	endif;
	echo $form->submit('Connect');
?>
</form>

<div class="actions">
	<ul>
	<?php if($cookie && $advanced):?>
		<li><?php echo $html->link('Load Settings', array('action'=>'index/advanced/load')); ?></li>
	<?php endif; ?>
	<?php if($advanced):?>
		<li><?php echo $html->link('Basic Settings', array('action'=>'index')); ?></li>
	<?php else:?>
		<li><?php echo $html->link('Advanced Settings', array('action'=>'index/advanced')); ?></li>
	<?php endif; ?>
	<?php if($cookie && $advanced):?>
		<li><?php echo $html->link('Delete Settings', array('action'=>'index/advanced/delete')); ?></li>
	<?php endif; ?>

	</ul>
</div>
