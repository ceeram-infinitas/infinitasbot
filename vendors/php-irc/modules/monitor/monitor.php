<?php
/* SVN FILE: $Id$ */
class monitor extends module {

	public $title = "<title>";
	public $author = "<author>";
	public $version = "<version>";

public function chanmsg($line, $args)
{
	$this->log_to_mysql($line['to'], $line['fromNick'], $line['text']);
}
public function join($line, $args)
{
	$this->log_to_mysql($line['text'], $line['fromNick'], "*JOINS: ".$line['fromNick'] . " (".$line['fromIdent']."@".$line['fromHost'].") has joined " . $line['text']);
}
public function part($line, $args)
{
	$this->log_to_mysql($line['to'], $line['fromNick'], "*PARTS: ".$line['fromNick'] . " (".$line['fromIdent']."@".$line['fromHost'].") has parted " . $line['to']);
}
public function quit($line, $args)
{
	$this->log_to_mysql("", $line['fromNick'], "*QUITS: ".$line['fromNick'] . " (".$line['fromIdent']."@".$line['fromHost'].") has quit IRC");
}
public function nick($line, $args)
{
	$this->log_to_mysql($line['fromNick'], $line['fromNick'], "*NICK: ".$line['fromNick'] . " (".$line['fromIdent']."@".$line['fromHost'].") is now known as " . $line['text']);
}

public function log_to_mysql($channel, $nick, $text)
{
	$data = array($channel, $nick, $text);

	$query = "INSERT INTO logs (time,channel,username,text) VALUES(NOW(), '[1]', '[2]', '[3]')";

	$this->db->query($query, $data);
}
}

?>