<?php /* SVN FILE: $Id$ */ ?>
<link rel="stylesheet" type="text/css" href="/css/chat.css" />
<?php 
	echo $javascript->link('chat');
	echo $javascript->codeBlock('document.write(JavaCheck())');
	//echo $javascript->codeBlock('document.write(WriteLayer("Chat Page is loading..."))');
	
	echo $form->create('Irc', array('name'=>'login', 'action'=>'chat', 'onsubmit'=>"return CheckForm('".$html->url('/irc/index').")"));
?>
	<script type="text/javascript">
		<!--
		document.writeln('<input name="jsenabled" type="hidden" value="1" \/>');
		document.writeln('<input name="popupenabled" type="hidden" value="1" \/>');
		document.writeln('<input name="layerenabled" type="hidden" value="1" \/>');
		-->
	</script>
<?php
	echo $form->input('nickname');
	echo $form->input('password');
	echo $form->input('channel');
	echo $form->input('server');
	
	$styles = array('Cake', 'Default');
	echo $form->input('style');

	$faces = array('SansSerfi','Serif','Monospaced','Verdana');
	echo $form->input('font_face');
	
	$sizes = array('10','12','14','16');
	echo $form->input('font_size');
	
	echo $form->input('sex');
	echo $form->input('age');
	
	echo $form->input('location');
	echo $form->input('smileys', array('type'=>'checkbox', 'value'=>'1'));
	
	echo $form->input('save', array('type'=>'checkbox', 'value'=>'1'));
	
	echo $form->submit('Connect');
	
	
?>