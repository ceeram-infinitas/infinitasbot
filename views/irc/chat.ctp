<?php /* SVN FILE: $Id$ */ ?>
<table align="center" cellspacing="0" cellpadding="0" style="width: 100%; height: 100%; border: 5px solid #003d4c; background-color: #003d4c;">
	<tr>
		<td align="center">
			<applet codebase="/client/" name="cakephpirc" code="IRCApplet.class" archive="irc.jar,pixx.jar" width="690" height="500">
				<param name="CABINETS" value="irc.cab,securedirc.cab,pixx.cab" />
				<param name="nick" value="Baker???" />
				<param name="name" value="Baker???" />
				<param name="host" value="irc.freenode.net" />
				<!-- May make a custom one at some point -->
				<param name="gui" value="pixx" />
				<param name="port" value="6667">
				<!-- Need to pass password /nickserv identify password -->
				<param name="command1" value="/msg nickserv identify " />
				<param name="command2" value="/join #cakephp" />
				<param name="language" value="english" />
				<param name="quitmessage" value="CakePHP forever!!">
				<!--
				<param name="asl" value="true">
				<param name="aslmale" value="m">
				<param name="aslfemale" value="f">
				<param name="aslunknown" value="x">
				<param name="useinfo" value="false">
				 -->
				<param name="soundbeep" value="snd/bell2.au" />
				<param name="soundquery" value="snd/ding.au" />
				<!--
				<param name="password" value="mysecretpassword">
				-->
				<param name="alternatenick" value="Baker???" />
				<!--
				<param name="languageencoding" value="UnicodeLittle">
				-->
				<param name="authorizedjoinlist" value="none+#cakephp+#cakephp\-support+#cakephp\-dev">
				<param name="authorizedleavelist" value="none+#cakephp+#cakephp\-support+#cakephp\-dev">
				<!--
				<param name="authorizedcommandlist" value="none+me">
				<param name="coding" value="2">
				<param name="lngextension" value="txt">
				<param name="userid" value="Baker???" />
				<param name="autoconnection" value="true">
				<param name="useidentserver" value="false">
				<param name="multiserver" value="false">
				<param name="alternateserver1" value="irc.secondhost.com 6667">
				<param name="serveralias" value="Alias">
				<param name="noasldisplayprefix" value="true">
				-->
				<param name="style:smileys" value="true">
				<!--
				<param name="style:righttoleft" value="true">
				-->
				<!-- Will set from interface -->
				<param name="style:sourcefontrule1" value="all all SansSerif 14" />
				<!--
				<param name="style:backgroundimage" value="true">
				<param name="style:backgroundimage1" value="none+channel none+#cakephp 259 /img/cake.logo.png">
				-->
				<param name="style:bitmapsmileys" value="true">
				<param name="style:smiley1" value=":) img/sourire.gif">
				<param name="style:smiley2" value=":-) img/sourire.gif">
				<param name="style:smiley3" value=":-D img/content.gif">
				<param name="style:smiley4" value=":d img/content.gif">
				<param name="style:smiley5" value=":-O img/OH-2.gif">
				<param name="style:smiley6" value=":o img/OH-1.gif">
				<param name="style:smiley7" value=":-P img/langue.gif">
				<param name="style:smiley8" value=":p img/langue.gif">
				<param name="style:smiley9" value=";-) img/clin-oeuil.gif">
				<param name="style:smiley10" value=";) img/clin-oeuil.gif">
				<param name="style:smiley11" value=":-( img/triste.gif">
				<param name="style:smiley12" value=":( img/triste.gif">
				<param name="style:smiley13" value=":-| img/OH-3.gif">
				<param name="style:smiley14" value=":| img/OH-3.gif">
				<param name="style:smiley15" value=":'( img/pleure.gif">
				<param name="style:smiley16" value=":$ img/rouge.gif">
				<param name="style:smiley17" value=":-$ img/rouge.gif">
				<param name="style:smiley18" value="(H) img/cool.gif">
				<param name="style:smiley19" value="(h) img/cool.gif">
				<param name="style:smiley20" value=":-@ img/enerve1.gif">
				<param name="style:smiley21" value=":@ img/enerve2.gif">
				<param name="style:smiley22" value=":-S img/roll-eyes.gif">
				<param name="style:smiley23" value=":s img/roll-eyes.gif">
				<!--
				<param name="style:floatingasl" value="true">
				<param name="style:floatingaslalpha" value="150">
				<param name="plugin1" value="MyPlugin">
				<param name="soundword1" value="lol snd/lol.au">
				-->
				<param name="fingerreply" value="A lucky CakePHP user">
				<!--
				<param name="fileparameter" value="pjirc.cfg">
				<param name="aslseparatorstring" value="|">
				<param name="allowdccchat" value="false">
				<param name="allowdccfile" value="false">
				<param name="style:linespacing" value="10">
				<param name="style:maximumlinecount" value="256">
				<param name="autorejoin" value="true">
				<param name="init1" value="/newserver Undernet eu.undernet.org">
				-->
				<param name="style:highlightlinks" value="true">
				<!--
				<param name="disablequeries" value="true">
				-->

				<!-- Pixx Parameters -->
				<param name="pixx:color0" value="DEE3E7" /><!-- Button Highlight / Popup & Close Button Text & Higlight / Scrollbar Highlight -->
				<param name="pixx:color1" value="FFFFFF" /><!-- Button Border & Text : ScrollBar Border & arrow : Popup & Close button Border : User List border & Text & icons -->
				<param name="pixx:color2" value="003d4c" /><!-- Popup & Close button shadow -->
				<param name="pixx:color3" value="003d4c" /><!-- Scrollbar shadow -->
				<param name="pixx:color4" value="2C6877" /><!-- Scrollbar de-light (3D Dim colour -->
				<param name="pixx:color5" value="003d4c" /><!-- foreground : Buttons Face : Scrollbar Face -->
				<param name="pixx:color6" value="003d4c" /><!-- background : Header : Scrollbar Track : Footer background -->
				<param name="pixx:color7" value="2C6877" /><!-- selection : Status & Window button active colour -->
				<param name="pixx:color8" value="FFA34F" /><!-- event Color  -->
				<param name="pixx:color9" value="000000" /><!-- close button -->
				<param name="pixx:color10" value="EFEFEF" /><!-- voice icon  -->
				<param name="pixx:color11" value="FFA34F" /><!-- operator icon  -->
				<param name="pixx:color12" value="599FCB" /><!-- halfoperator icon -->

				<param name="pixx:color13" value="003d4c" /><!-- male ASL -->
				<param name="pixx:color14" value="003d4c" /><!-- female ASL -->
				<param name="pixx:color15" value="003d4c" /><!-- unknown ASL -->

				<param name="pixx:helppage" value="http://www.irchelp.org/" />
				<param name="pixx:timestamp" value="true" />
				<param name="highlight" value="true" />
				<param name="pixx:highlightnick" value="true">
				<param name="pixx:highlightcolor" value="5">
				<!--
				<param name="pixx:highlightwords" value="word1 word2 word3">
				-->
				<param name="pixx:showchanlist" value="false" />
				<param name="pixx:showconnect" value="false" />
				<param name="pixx:showabout" value="false" />
				<param name="pixx:showhelp" value="true">
				<!--
				<param name="pixx:nicklistwidth" value="130">
				-->
				<param name="pixx:nickfield" value="true">
				<param name="pixx:styleselector" value="false">
				<param name="pixx:setfontonstyle" value="false">
				<param name="pixx:showclose" value="false">
				<!--
				<param name="pixx:showstatus" value="false">
				<param name="pixx:automaticqueries" value="false">
				-->
				<param name="pixx:configurepopup" value="true" />
				<param name="pixx:popupmenustring1" value="Whois" />
				<param name="pixx:popupmenustring2" value="Query" />
				<param name="pixx:popupmenustring3" value="Ban" />
				<param name="pixx:popupmenustring4" value="Kick + Ban" />
				<param name="pixx:popupmenustring5" value="--" />
				<param name="pixx:popupmenustring6" value="Op" />
				<param name="pixx:popupmenustring7" value="DeOp" />
				<param name="pixx:popupmenustring8" value="HalfOp" />
				<param name="pixx:popupmenustring9" value="DeHalfOp" />
				<param name="pixx:popupmenustring10" value="Voice" />
				<param name="pixx:popupmenustring11" value="DeVoice" />
				<param name="pixx:popupmenustring12" value="--" />
				<param name="pixx:popupmenustring13" value="Ping" />
				<param name="pixx:popupmenustring14" value="Version" />
				<param name="pixx:popupmenustring15" value="Time" />
				<param name="pixx:popupmenustring16" value="Finger" />
				<param name="pixx:popupmenustring17" value="--" />
				<param name="pixx:popupmenustring18" value="DCC Send" />
				<param name="pixx:popupmenustring19" value="DCC Chat" />

				<param name="pixx:popupmenucommand1_1" value="/Whois %1" />
				<param name="pixx:popupmenucommand2_1" value="/Query %1" />
				<param name="pixx:popupmenucommand3_1" value="/mode %2 -o %1" />
				<param name="pixx:popupmenucommand3_2" value="/mode %2 +b %1" />
				<param name="pixx:popupmenucommand4_1" value="/mode %2 -o %1" />
				<param name="pixx:popupmenucommand4_2" value="/mode %2 +b %1" />
				<param name="pixx:popupmenucommand4_3" value="/kick %2 %1" />
				<param name="pixx:popupmenucommand6_1" value="/mode %2 +o %1" />
				<param name="pixx:popupmenucommand7_1" value="/mode %2 -o %1" />
				<param name="pixx:popupmenucommand8_1" value="/mode %2 +h %1" />
				<param name="pixx:popupmenucommand9_1" value="/mode %2 -h %1" />
				<param name="pixx:popupmenucommand10_1" value="/mode %2 +v %1" />
				<param name="pixx:popupmenucommand11_1" value="/mode %2 -v %1" />
				<param name="pixx:popupmenucommand13_1" value="/CTCP PING %1" />
				<param name="pixx:popupmenucommand14_1" value="/CTCP VERSION %1" />
				<param name="pixx:popupmenucommand15_1" value="/CTCP TIME %1" />
				<param name="pixx:popupmenucommand16_1" value="/CTCP FINGER %1" />
				<param name="pixx:popupmenucommand18_1" value="/DCC SEND %1" />
				<param name="pixx:popupmenucommand19_1" value="/DCC CHAT %1" />

				<param name="pixx:mouseurlopen" value="1 2" /><!-- url open -->
				<param name="pixx:nickquery" value="1 2" /><!-- query open -->
				<!--
				<param name="pixx:mousechanneljoin" value="1 2" /><!-- channel joining -->
				<!--
				<param name="pixx:mousenickpopup" value="1 2" /><!-- popup menu on nickname -->
				<!--
				<param name="pixx:mousetaskbarpopup" value="1 2" /><!-- popup menu on the bottom taskbar -->
				<!--
					nickchanged
					nickmodeapply
					modeapply
					topic hanged
					nickquit
					nickkick
					nickpart
					nickjoin
					youjoin
				<param name="pixx:showchannelnickchanged" value="false">
				-->
				<param name="pixx:showdock" value="false">
				<!--
				<param name="pixx:dockingconfig1" value="none+ChanList all undock">
				-->
				<param name="pixx:language" value="pixx-english" />
				<param name="pixx:lngextension" value="lng" />
				<!--
					\b toggle bold
					\u toggle underline
					\o toggle reverse
					\kX,Y toggle color X,Y
				<param name="pixx:nickprefix" value="<\b">
				-->
				<!--
					\b toggle bold
					\u toggle underline
					\o toggle reverse
					\kX,Y toggle color X,Y
				<param name="pixx:nickpostfix" value="\b> ">
				<param name="pixx:scrollspeed" value="20">
				<param name="pixx:leaveonundockedwindowclose" value="true">
				<param name="pixx:leftnickalign" value="true">
				-->
				<param name="pixx:displayentertexthere" value="true">
				<!--
				<param name="pixx:ignoreallmouseevents" value="true">
				<param name="pixx:hideundockedsources" value="true" />
				<param name="pixx:displaychannelmode" value="false">
				-->
			</applet>
		</td>
	</tr>
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
</table>