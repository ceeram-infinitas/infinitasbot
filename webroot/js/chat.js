// SVN FILE: $Id$
function SendIt(string) {
	document.cakephpirc.sendString(string);
	document.cakephpirc.requestSourceFocus();
}
function smiley(symbol) {
	document.cakephpirc.setFieldText(document.cakephpirc.getFieldText()+symbol+' ');
	document.cakephpirc.requestSourceFocus();
}
function CheckForm(redirect) {
	if ($('IrcChannel') && !CheckFormData($('IrcChannel').chan, 'Please type a Channel')) {
		return false;
	}
	if ($('IrcServer') && !CheckFormData($('IrcServer').host, 'Please type an IRC Server!')) {
		return false;
	}

	if ($('IrcSave') && $('IrcSave').checked && document.cookie) {
		if (!confirm('Overwrite old settings?')) return false;
	}
	var nick = $('IrcNick');
	if (nick.value == '') {
		var default_nick = 'Baker';
		nick.value = default_nick+Math.round(Math.random()*1001);
	}
	if ($('IrcLayerenabled').value) {
		LoadLayer('400', '200');
	}
	if ($('IrcPopupenabled').value) {
		document.login.target = 'mypopup';
		OpenPopup('700', '530');
		window.setTimeout('window.location.href = \''+redirect+'\'', 10000);
	}
	return true;
}
function CheckFormData(inp, msg) {
	if (inp) {
		if (inp.value == '') {
			alert(msg);
			inp.focus();
			return false;
		}
		else return true;
	}
	return true;
}
function WriteLayer(message) {
	var html = '<div id="layerwindow" class="layerwindow">\n';
		html += '\t<table width="400" cellspacing="0" cellpadding="0" class="border"><tr>\n';
		html += '\t\t<td align="center" height="100"><h2>'+message+'<\/h2><\/td>\n';
		html += '\t<\/tr><\/table>\n';
		html += '<\/div>\n';

	return html;
}
function LoadLayer(x, y) {
	var divwidth  = x;
	var divheight = y;
	var browserwidth  = window.innerWidth || document.body.clientWidth;
	var browserheight = window.innerHeight || document.body.clientHeight;
	var leftpx = (browserwidth-divwidth)/2;
	var toppx  = (browserheight-divheight)/2;
	document.getElementById('layerwindow').style.top  = Math.round(toppx)+'px';
	document.getElementById('layerwindow').style.left = Math.round(leftpx)+'px';
	document.getElementById('layerwindow').style.visibility = 'visible';
}
function OpenPopup(x, y) {
	var values  = 'width='+x+', height='+y+', left=0, top=0,'
	values += 'dependent=no, hotkeys=no, resizable=yes, scrollbars=no, menubar=no';
	var url = '/irc/chat';
	window.open(url, 'mypopup', values);
}
function JavaCheck() {
	var html = '<table width="100%" cellspacing="0" cellpadding="0" class="footer">\n';
	var status = 'Disabled';
	if (navigator.javaEnabled()) status = 'Enabled';
	html += '\t<tr><td align="right">\n';
	html += '\t\tJava Status:&nbsp;<span style="color: red;">'+status+'<\/span>\n';
	if (status == 'Disabled') {
		html += '\t\t<br>Get it at <a href="http://java.com" target="_blank">java.com<\/a>\n';
	}
	html += '\t<\/td><\/tr>\n';
	html += '<\/table>\n';
	return html;
}