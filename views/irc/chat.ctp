<?php /* SVN FILE: $Id$ */ ?>
<table align="center" cellspacing="0" cellpadding="0" style="width: 100%; height: 100%; border: 5px solid #003d4c; background-color: #003d4c;">
	<tr>
		<td align="center">
			<applet codebase="/client/" name="cakephpirc" code="IRCApplet.class" archive="irc.jar,pixx.jar" width="690" height="500">
				<param name="CABINETS" value="irc.cab,securedirc.cab,pixx.cab" />
				<?php foreach ($settings as $key => $value): ?>
				<param name="<?php echo $key;?>" value="<?php echo $value;?>" />
				<?php endforeach; ?>
			</applet>
		</td>
	</tr>
<?php if($smileys): ?>
	<tr><td>
<table align="center" cellspacing="0" cellpadding="0" style="background-color: #003d4c;">
	<tr>
		<td style="background-color: #003d4c;">
			<a href="javascript:smiley(':)')">
			<img src="/client/img/sourire.gif" width="15" height="15" border="0" title=":)" alt=":)" /></a>&nbsp;
		</td>
		<td style="background-color: #003d4c;">
			<a href="javascript:smiley(':D')">
			<img src="/client/img/content.gif" width="15" height="15" border="0" title=":D" alt=":D" /></a>&nbsp;
		</td>
		<td style="background-color: #003d4c;">
			<a href="javascript:smiley(':-O')">
			<img src="/client/img/OH-2.gif" width="15" height="15" border="0" title=":-O" alt=":-O" /></a>&nbsp;
		</td>
		<td style="background-color: #003d4c;">
			<a href="javascript:smiley(':o')">
			<img src="/client/img/OH-1.gif" width="15" height="15" border="0" title=":o" alt=":o" /></a>&nbsp;
		</td>
		<td style="background-color: #003d4c;">
			<a href="javascript:smiley(':P')">
			<img src="/client/img/langue.gif" width="15" height="15" border="0" title=":P" alt=":P" /></a>&nbsp;
		</td>
		<td style="background-color: #003d4c;">
			<a href="javascript:smiley(';)')">
			<img src="/client/img/clin-oeuil.gif" width="15" height="15" border="0" title=";)" alt=";)" /></a>&nbsp;
		</td>
		<td style="background-color: #003d4c;">
			<a href="javascript:smiley(':(')">
			<img src="/client/img/triste.gif" width="15" height="15" border="0" title=":(" alt=":(" /></a>&nbsp;
		</td>
		<td style="background-color: #003d4c;">
			<a href="javascript:smiley(':|')">
			<img src="/client/img/OH-3.gif" width="15" height="15" border="0" title=":|" alt=":|" /></a>&nbsp;
		</td>
	</tr>
</table
		</td>
	</tr>
<?php endif; ?>
</table>