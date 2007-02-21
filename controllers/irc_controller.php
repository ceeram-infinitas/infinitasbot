<?php
/* SVN FILE: $Id$ */
class IrcController extends AppController {
	var $name = "Irc";
	var $helpers = array('Javascript', 'Form');
	var $uses = array();
	var $layout = 'client';
	var $channels = array('#cakephp');
	var $servers = array('irc.freenode.net');
	var $colorset = array('Cake' => array(0 => 'DEE3E7', 1 => 'FFFFFF', 2 => '003d4c', 3 => '003d4c', 4 => '2C6877', 5 => '003d4c',
													6 => '003d4c', 7 => '2C6877', 8 => 'FFA34F', 9 => '000000', 10 => 'EFEFEF', 11 => 'FFA34F',
													12 => '599FCB', 13 => '003d4c', 14 => '003d4c', 15 => '003d4c'));
	var $font = array('Dialog', 'SansSerif', 'Serif', 'Monospaced', 'DialogInput', 'Verdana');
	var $size = array(10, 11, 12, 13, 14, 15, 16);
	var $sex = array('--', 'm', 'f');
	var $ageRange = array(18, 65);
	var $popup = true;
	var $layer = true;
	var $layerMessage = 'Chat client is loading...';

	function index() {
		$args = func_get_args();

		$this->layout = 'default';

		$channels = $this->channels;
		$servers = $this->servers;
		$colorsets = $this->colorset['Cake'];
		$fonts = $this->font;
		$sizes = $this->size;
		$ages = $this->__age();
		$sexes = $this->sex;
		$popup = $this->popup;
		$layer = $this->layer;
		$layerMessage = $this->layerMessage;
		$advanced = null;

		if(in_array('delete', $args)) {
			$this->Cookie->destroy();
			$this->redirect('/irc/index/advanced', null, true);
		}
		$cookie = $this->Cookie->read('IRC');

		if(!empty($cookie)) {
			$cookie = true;
		} else {
			$cookie = false;
		}
		if(in_array('advanced', $args)) {
			$advanced = 'advanced';
		}
		if(in_array('delete', $args)) {
			$this->Cookie->destroy();
			$this->redirect('/irc/index/advanced', null, true);
		}
		if(in_array('load', $args)) {
			$this->data['Irc'] = $this->Cookie->read('IRC');
		}
		$this->set(compact('channels', 'servers', 'colorsets', 'fonts', 'sizes', 'ages', 'sexes',
								'popup', 'layer', 'layerMessage', 'cookie', 'advanced'));

	}

	function chat() {
		if(!empty($this->data)) {
			if(isset($this->data['Irc']['save']) && $this->data['Irc']['save'] === '1') {
				$this->Cookie->write('IRC', array('nick' => $this->data['Irc']['nick'], 'font' => $this->data['Irc']['font'],
															'size' => $this->data['Irc']['size'], 'age' => $this->data['Irc']['age'],
															'sex' => $this->data['Irc']['sex'], 'location' => $this->data['Irc']['location'],
															'smileys' => $this->data['Irc']['smileys']), true, '30 days');
			}
			if(empty($this->data['Irc']['server'])) {
				$this->data['Irc']['server'] = $this->servers[0];
			}
			if(empty($this->data['Irc']['channel'])) {
				$this->data['Irc']['channel'] = $this->channels[0];
			}
			$smileys = null;
			$settings = $this->__buildParams();

			if(!empty($this->data['Irc']['smileys'])) {
				$smileys = true;
			}
			$this->set(compact('settings', 'smileys'));
		} else {
			$this->redirect('/irc', null, true);
		}
	}

	function __age() {
		$ages[] = '--';
		for($i = $this->ageRange['0']; $i <= $this->ageRange['1']; $i++) $ages[] = $i;
		return $ages;
	}

	function __buildParams() {
		$settings['nick'] =  ife($this->data['Irc']['nick'], $this->data['Irc']['nick'], 'Baker???');

		if(!empty($this->data['Irc']['name'])) {
			$settings['name']  = $this->data['Irc']['name'];
		} elseif (empty($this->data['Irc']['age'])) {
			$settings['name']  = 'CakePHP IRC Web User';
		} else {
			$settings['name']  = $this->data['Irc']['age'].'/'.$this->data['Irc']['sex'].'/'.$this->data['Irc']['location'];
		}

		$settings['host'] = $this->data['Irc']['server'];
		$settings['gui'] = 'pixx';
		$settings['port'] = '6667';

		$password = null;
		if(!empty($this->data['Irc']['password'])) {
			$password = $this->data['Irc']['password'];
		}

		$settings['command1'] = '/msg nickserv identify ' . $password;
		$settings['command2'] = '/join ' . $this->data['Irc']['channel'];
		$settings['language'] = 'english';
		$settings['quitmessage'] = 'CakePHP forever!!';
/**
		$settings['asl'] = 'true';
		$settings['aslmale'] = 'm';
		$settings['aslfemale'] = 'f';
		$settings['aslunknown'] = 'x';
		$settings['useinfo'] = 'false';
*/
		$settings['soundbeep'] = 'snd/bell2.au';
		$settings['soundquery'] = 'snd/ding.au';
/**
		$settings['password'] = 'mysecretpassword';
*/
		$settings['alternatenick'] = $settings['nick'] . '???';
/**
		$settings['languageencoding'] = 'UnicodeLittle';
*/
		$settings['authorizedjoinlist'] = 'none+#cakephp+#cakephp\-support+#cakephp\-dev';
		$settings['authorizedleavelist'] = 'none+#cakephp+#cakephp\-support+#cakephp\-dev';
/**
		$settings['authorizedcommandlist'] = 'none+me';
		$settings['coding'] = '2';
		$settings['lngextension'] = 'txt';
		$settings['userid'] = 'Baker???';
		$settings['autoconnection'] = 'true';
		$settings['useidentserver'] = 'false';
		$settings['multiserver'] = 'false';
		$settings['alternateserver1'] = 'irc.secondhost.com 6667';
		$settings['serveralias'] = 'Alias';
		$settings['noasldisplayprefix'] = 'true';
*/
/**
		$settings['style:righttoleft'] = 'true';
*/
		if(isset($this->data['Irc']['size'])) {
			$settings['style:sourcefontrule1'] = "all all " . $this->font[$this->data['Irc']['font']] . " " . $this->size[$this->data['Irc']['size']];
		} else {
			$settings['style:sourcefontrule1'] = "all all " . $this->font[0]. " " . $this->size[2];
		}
/**
$settings['style:backgroundimage'] = 'true';
$settings['style:backgroundimage1'] = 'none+channel none+#cakephp 259 /img/cake.logo.png';
*/
		if($this->data['Irc']['smileys'] === '1') {
			$settings['style:smileys'] = 'true';
			$settings['style:bitmapsmileys'] = 'true';
			$settings['style:smiley1'] = ':) img/sourire.gif';
			$settings['style:smiley2'] = ':-) img/sourire.gif';
			$settings['style:smiley3'] = ':-D img/content.gif';
			$settings['style:smiley4'] = ':d img/content.gif';
			$settings['style:smiley5'] = ':-O img/OH-2.gif';
			$settings['style:smiley6'] = ':o img/OH-1.gif';
			$settings['style:smiley7'] = ':-P img/langue.gif';
			$settings['style:smiley8'] = ':p img/langue.gif';
			$settings['style:smiley9'] = ';-) img/clin-oeuil.gif';
			$settings['style:smiley10'] = ';) img/clin-oeuil.gif';
			$settings['style:smiley11'] = ':-( img/triste.gif';
			$settings['style:smiley12'] = ':( img/triste.gif';
			$settings['style:smiley13'] = ':-| img/OH-3.gif';
			$settings['style:smiley14'] = ':| img/OH-3.gif';
			$settings['style:smiley15'] = ':\'( img/pleure.gif';
			$settings['style:smiley16'] = ':$ img/rouge.gif';
			$settings['style:smiley17'] = ':-$ img/rouge.gif';
			$settings['style:smiley18'] = '(H) img/cool.gif';
			$settings['style:smiley19'] = '(h) img/cool.gif';
			$settings['style:smiley20'] = ':-@ img/enerve1.gif';
			$settings['style:smiley21'] = ':@ img/enerve2.gif';
			$settings['style:smiley22'] = ':-S img/roll-eyes.gif';
			$settings['style:smiley23'] = ':s img/roll-eyes.gif';
		}
/**
		$settings['style:floatingasl'] = 'true';
		$settings['style:floatingaslalpha'] = '150';
		$settings['plugin1'] = 'MyPlugin';
		$settings['soundword1'] = 'lol snd/lol.au';
*/
		$settings['fingerreply'] = 'A lucky CakePHP user';
/**
		$settings['fileparameter'] = 'pjirc.cfg';
		$settings['aslseparatorstring'] = '|';
		$settings['allowdccchat'] = 'false';
		$settings['allowdccfile'] = 'false';
		$settings['style:linespacing'] = '10';
		$settings['style:maximumlinecount'] = '256';
		$settings['autorejoin'] = 'true';
		$settings['init1'] = '/newserver Undernet eu.undernet.org';
*/
		$settings['style:highlightlinks'] = 'true';
/**
		$settings['disablequeries'] = 'true';
*/
		foreach ($this->colorset['Cake'] as $key => $value) {
			$settings['pixx:color'.$key] = $value;
		}

		$settings['pixx:helppage'] = 'http://www.irchelp.org/';
		$settings['pixx:timestamp'] = 'true';
		$settings['highlight'] = 'true';
		$settings['pixx:highlightnick'] = 'true';
		$settings['pixx:highlightcolor'] = '5';
/**
		$settings['pixx:highlightwords'] = 'word1 word2 word3';
*/
		$settings['pixx:showchanlist'] = 'false';
		$settings['pixx:showconnect'] = 'false';
		$settings['pixx:showabout'] = 'false';
		$settings['pixx:showhelp'] = 'true';
/**
		$settings['pixx:nicklistwidth'] = '130';
*/
		$settings['pixx:nickfield'] = 'true';
		$settings['pixx:styleselector'] = 'false';
		$settings['pixx:setfontonstyle'] = 'false';
		$settings['pixx:showclose'] = 'false';
/**
		$settings['pixx:showstatus'] = 'false';
		$settings['pixx:automaticqueries'] = 'false';
*/
		$settings['pixx:configurepopup'] = 'true';
		$settings['pixx:popupmenustring1'] = 'Whois';
		$settings['pixx:popupmenustring2'] = 'Query';
		$settings['pixx:popupmenustring3'] = 'Ban';
		$settings['pixx:popupmenustring4'] = 'Kick + Ban';
		$settings['pixx:popupmenustring5'] = '--';
		$settings['pixx:popupmenustring6'] = 'Op';
		$settings['pixx:popupmenustring7'] = 'DeOp';
		$settings['pixx:popupmenustring8'] = 'HalfOp';
		$settings['pixx:popupmenustring9'] = 'DeHalfOp';
		$settings['pixx:popupmenustring10'] = 'Voice';
		$settings['pixx:popupmenustring11'] = 'DeVoice';
		$settings['pixx:popupmenustring12'] = '--';
		$settings['pixx:popupmenustring13'] = 'Ping';
		$settings['pixx:popupmenustring14'] = 'Version';
		$settings['pixx:popupmenustring15'] = 'Time';
		$settings['pixx:popupmenustring16'] = 'Finger';
		$settings['pixx:popupmenustring17'] = '--';
		$settings['pixx:popupmenustring18'] = 'DCC Send';
		$settings['pixx:popupmenustring19'] = 'DCC Chat';
		$settings['pixx:popupmenucommand1_1'] = '/Whois %1';
		$settings['pixx:popupmenucommand2_1'] = '/Query %1';
		$settings['pixx:popupmenucommand3_1'] = '/mode %2 -o %1';
		$settings['pixx:popupmenucommand3_2'] = '/mode %2 +b %1';
		$settings['pixx:popupmenucommand4_1'] = '/mode %2 -o %1';
		$settings['pixx:popupmenucommand4_2'] = '/mode %2 +b %1';
		$settings['pixx:popupmenucommand4_3'] = '/kick %2 %1';
		$settings['pixx:popupmenucommand6_1'] = '/mode %2 +o %1';
		$settings['pixx:popupmenucommand7_1'] = '/mode %2 -o %1';
		$settings['pixx:popupmenucommand8_1'] = '/mode %2 +h %1';
		$settings['pixx:popupmenucommand9_1'] = '/mode %2 -h %1';
		$settings['pixx:popupmenucommand10_1'] = '/mode %2 +v %1';
		$settings['pixx:popupmenucommand11_1'] = '/mode %2 -v %1';
		$settings['pixx:popupmenucommand13_1'] = '/CTCP PING %1';
		$settings['pixx:popupmenucommand14_1'] = '/CTCP VERSION %1';
		$settings['pixx:popupmenucommand15_1'] = '/CTCP TIME %1';
		$settings['pixx:popupmenucommand16_1'] = '/CTCP FINGER %1';
		$settings['pixx:popupmenucommand18_1'] = '/DCC SEND %1';
		$settings['pixx:popupmenucommand19_1'] = '/DCC CHAT %1';
		$settings['pixx:mouseurlopen'] = '1 2'; // url open
		$settings['pixx:nickquery'] = '1 2'; // query open
/**
		$settings['pixx:mousechanneljoin'] = '1 2'; //channel joining
		$settings['pixx:mousenickpopup'] = '1 2'; // popup menu on nickname
		$settings['pixx:mousetaskbarpopup'] = '1 2'; // popup menu on the bottom taskbar

		$settings['pixx:showchannelnickchanged'] = 'false';
		$settings['pixx:showchannelnickmodeapply'] = 'false';
		$settings['pixx:showchannelmodeapply'] = 'false';
		$settings['pixx:showchanneltopic hanged'] = 'false';
		$settings['pixx:showchannelnickquit'] = 'false';
		$settings['pixx:showchannelnickkick'] = 'false';
		$settings['pixx:showchannelnickpart'] = 'false';
		$settings['pixx:showchannelnickjoin'] = 'false';
		$settings['pixx:showchannelyoujoin'] = 'false';
*/
		$settings['pixx:showdock'] = 'false';
/**
		$settings['pixx:dockingconfig1'] = 'none+ChanList all undock';
*/
		$settings['pixx:language'] = 'pixx-english';
		$settings['pixx:lngextension'] = 'lng';
/**
 * /\b toggle bold
 * \u toggle underline
 * \o toggle reverse
 * \kX,Y toggle color X,Y
 */
	$settings['pixx:nickprefix'] = '<\b';
	$settings['pixx:nickpostfix'] = '\b> ';
/**
		$settings['pixx:scrollspeed'] = '20';
		$settings['pixx:leaveonundockedwindowclose'] = 'true';
		$settings['pixx:leftnickalign'] = 'true';
*/
		$settings['pixx:displayentertexthere'] = 'true';
/**
		$settings['pixx:ignoreallmouseevents'] = 'true';
		$settings['pixx:hideundockedsources'] = 'true';
		$settings['pixx:displaychannelmode'] = 'false';
*/
		return $settings;
	}
}
?>