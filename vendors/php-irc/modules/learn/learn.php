<?php
/* SVN FILE: $Id$ */
class learn extends module {
	public $title = "Teaching Mod";
	public $author = "PhpNut";
	public $version = "0.1";

	private $myini;

	public function init() {
		$this->myini = new ini("modules/learn/learn.ini");
	}
	public function destroy() {
	}

	private function search($line, $args) {

		//Look up a paste if format is '~show nick'
		if($args['cmd'] == '^show') {
			$data = array($line['fromNick']);
			$query = "SELECT * FROM `pastes` WHERE `nick` = '[1]' ORDER BY `created` DESC;";
			$result = $this->db2->queryFetch($query, $data);

			if(!empty($result['id']) && $result['save'] == 1) {
				$line['toNick'] = $args['arg1'];
				$this->ircClass->privMsg($line['to'], $line['toNick'] . ": http://bin.cakephp.org/saved/" . $result['id']);
			} elseif(!empty($result['id']) && $result['save'] != 1) {
				$line['toNick'] = $args['arg1'];
				$this->ircClass->privMsg($line['to'], $line['toNick'] . ": http://bin.cakephp.org/view/" . $result['id']);
			} else {
				$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": I can't find your last paste. :(");
			}
			return;
		}
		//Adding pastes...
		if($args['cmd'] == '^paste' || $args['cmd'] == '^bin') {
			$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": Paste some code here --> http://bin.cakephp.org/add/" . $line['fromNick']);
			return;
		}
		$oldTerm = substr($line['text'], 1);
		$term = strtolower($oldTerm);
		$value = $this->myini->getIniVal("know", $term);
		$arg = "";

		//Change term if format is '~tell nick about term'
		if($args['cmd'] == '^tell') {
			//Account for missing destination "~tell"
			if(empty($args['arg1'])) {
				$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": Tell who what? :/");
				return;
			}
			//Account for "~tell me ..."
			if(strtolower($args['arg1']) != 'me') {
				$line['toNick'] = $args['arg1'];
			} else {
				$line['toNick'] = $line['fromNick'];
			}
			//Account for missing subject "~tell bob about"
			if(empty($args['arg3'])) {
				$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": Tell " . $line['toNick'] . " about what? :/");
				return;
			}
			$oldTerm = $args['arg3'];
			$arg = $args['arg4'];
			$term = strtolower($oldTerm);

			if($term == 'paste' || $term == 'bin') {
				$this->ircClass->privMsg($line['to'], $line['toNick'] . ": Paste some code here --> http://bin.cakephp.org/add/" . $line['toNick']);
				return;
			}
			$value = $this->myini->getIniVal("know", $term);
		}

		if($value === false) {
			//okay, two possibilities.  one, we really aren't in db, two, we have argument. go backwards looking for
			//term without argument
			$arg = "";
			$term = "";
			$terms = explode(" ", $oldTerm);
			while ($value === false && count($terms) > 0) {
				$arg = trim(array_pop($terms) . " " . $arg);
				$oldTerm = implode(" ", $terms);
				$term = strtolower($oldTerm);
				$value = $this->myini->getIniVal("know", $term);
			}

			if(count($terms) <= 0) {
				$value = false;
			}
		}

		if($value === false) {
			$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": Sorry.. I don't know what that is. :/");
		} else {
			if($arg != "") {
				$value = str_replace("<arg>", $arg, $value);
			}

			if(!empty($line['toNick'])) {
				//tells about
				$this->ircClass->privMsg($line['to'], $line['toNick'] . ": " . $value);
			} elseif(substr($value, 0, 3) != '/me') {
				//other
				$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": " . $value);
			} else {
				//actions
				$this->ircClass->action($line['to'], str_replace('/me ', '', $value));
			}
		}
	}

	private function forget($line, $args) {
		$toForget = trim(substr($args['query'], 6));
		$this->myini->deleteVar("know", strtolower($toForget));
		$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": if I knew it, I don't anymore.");
		$this->myini->writeIni();
	}


	public function learn($line, $args) {
		if(substr($line['text'], 0, 1) == "~") {
			$this->search($line, $args);
			return;
		}
		$myNick = irc::myStrToLower($this->ircClass->getNick());
		$args['cmd'] = str_replace(",", "", $args['cmd']);
		$args['cmd'] = str_replace(";", "", $args['cmd']);
		$args['cmd'] = str_replace(":", "", $args['cmd']);

		if($myNick != $args['cmd']) {
			return;
		}

		if(strtolower($args['arg1']) == "forget" && $args['nargs'] > 1) {
			$this->forget($line, $args);
			return;
		}

		if($args['nargs'] < 3) {
			return;
		}
		$is = strpos($args['query'], " is ");
		$are = strpos($args['query'], " are ");
		$isReally = strpos($args['query'], " is really ");
		$areReally = strpos($args['query'], " are really ");
		$redefine = false;

		if($isReally !== false) {
			$redefine = true;
			$term = substr($args['query'], 0, $isReally);
			$answer = substr($args['query'], $isReally+4+6);
		} elseif($areReally !== false) {
			$redefine = true;
			$term = substr($args['query'], 0, $areReally);
			$answer = substr($args['query'], $areReally+5+6);
		} elseif($is !== false) {
			$term = substr($args['query'], 0, $is);
			$answer = substr($args['query'], $is+4);
		} elseif($are !== false) {
			$term = substr($args['query'], 0, $are);
			$answer = substr($args['query'], $are+5);
		} else {
			return;
		}

		if($term == "" || $answer == "") {
			return;
		}
		$oldTerm = $term;
		$term = strtolower($term);
		//see if it is already exist
		$value = $this->myini->getIniVal("know", $term);

		if($value === false) {
			$this->myini->setIniVal("know",$term,$answer);
			$this->myini->writeIni();
			$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": I'll keep that in mind.");
		} else {
			if($redefine == true) {
				$this->myini->setIniVal("know",$term,$answer);
				$this->myini->writeIni();
				$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": I'll keep that in mind.");
			} else {
				$this->ircClass->privMsg($line['to'], $line['fromNick'] . ": I thought " . $oldTerm . " was " . $value . "... :/");
			}
		}
	}

}
?>