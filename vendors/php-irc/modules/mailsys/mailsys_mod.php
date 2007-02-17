<?php
/* SVN FILE: $Id$ */
class mailsys extends module {

	public $title = "Mail System Mod with MySQL";
	public $author = "Addramyr";
	public $version = "1.0";

	private $messages;

	public function init() {
		if ($this->db->isConnected()) {
			echo "Compiling Table: mailsys\n";
#			$bloakA = $this->db->query("DROP TABLE IF EXISTS mailsys;", '');
			$blockA = $this->db->query("CREATE TABLE IF NOT EXISTS `mailsys` (
           `msg_id` bigint(11) NOT NULL auto_increment,
           `msg_target` varchar(255) NOT NULL,
           `msg_from` varchar(255) NOT NULL,
           `msg_date` datetime NOT NULL,
           `msg_msg` text NOT NULL,
           `msg_enabled` bigint(11) NOT NULL,
           PRIMARY KEY  (`msg_id`)
           ) ENGINE=MyISAM DEFAULT CHARSET=latin1;", '');
		}

		# If the table is already created then add users to watch list...
		$blockB = $this->db->query("SELECT * FROM mailsys WHERE msg_enabled='[1]';", 1);
		while ($row2 = $this->db->fetchArray($blockB)) {
			extract($row2);
			$this->ircClass->sendRaw("watch +$nick");
		}
		# End add listing....

	}

	public function destroy() {
		# Does Nothing...
	}

	public function command_check($line, $args) {
		$cmd = $args['cmd'];
		switch($cmd) {
			case "send":
				$this->sendMessage($line, $args);
				break;
			default:
				# Ignore.
				break;
		}
	}

	function sendMessage($line, $args) {
		$From = $line['fromNick'];
		$Target = $args['arg1'];
		$Text = $args['query'];
		$Len = strlen($Target) +1;
		$Text = substr($Text, $Len);
		$this->db->query("INSERT INTO mailsys (msg_target, msg_from, msg_date, msg_msg, msg_enabled) VALUES ('".$Target."', '".$From."', NOW(), '".$Text."', 1)");
		$this->ircClass->sendRaw("watch +$Target");
		$this->ircClass->privMsg($From, "Your message is will be sent to ".$Target." when he/she comes online.");
	}

	function userOnline($line, $args) {
		$uInfo = explode(" ",$line['raw']);
		# Access database on selected username...
		$blockB = $this->db->query("SELECT * FROM mailsys WHERE msg_target='[1]';", $uInfo[3]);
		$row2 = $this->db->fetchArray($blockB);
		extract($row2);
		# Check if Message Is Sent?
		if ($msg_enabled == 1) {
			# Remove id from database...
			$this->db->query("UPDATE mailsys SET msg_enabled='0' WHERE msg_target='".$uInfo[3]."'");
 			# Send message to user...
			$this->ircClass->privMsg($uInfo[3], "You have a message from ".$msg_from." on ".$msg_date."");
			$this->ircClass->privMsg($uInfo[3], "Message Follows:");
			$this->ircClass->privMsg($uInfo[3], $msg_msg);
			# Remove user from notify list...
			$this->ircClass->sendRaw("watch -$msg_target");
		} else {
		}
	}
}

?>