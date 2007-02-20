<?php
/* SVN FILE: $Id$ */
class IrcController extends AppController {
	var $name = "Irc";
	var $helpers = array('Javascript', 'Form');
	var $uses = array();
	var $layout = 'client';
	var $colorset = array('Cake' => array(0 => 'DEE3E7', 1 => 'FFFFFF', 2 => '003d4c', 3 => '003d4c', 4 => '2C6877', 5 => '003d4c',
													6 => '003d4c', 7 => '2C6877', 8 => 'FFA34F', 9 => '000000', 10 => 'EFEFEF', 11 => 'FFA34F',
													12 => '599FCB', 13 => '003d4c', 14 => '003d4c', 15 => '003d4c'));
	var $font = array('Dialog', 'SansSerif', 'Serif', 'Monospaced', 'DialogInput', 'Verdana');
	var $size = array(10, 11, 12, 13, 14, 15, 16);
	var $sex = array('--', 'm', 'f');
	var $ageRange = array(18, 65);

	function index() {
		$args = func_get_args();

		$this->layout = 'default';
		$age = $this->__age();
		$font = $this->font;
		$size = $this->size;
		$advanced = null;

		$cookie = $this->Cookie->read('IRC');
		if(!empty($cookie)) {
			$cookie = true;
		}
		if(in_array('advanced', $args)) {
			$advanced = true;
		}
		if(in_array('delete', $args)) {
			$this->Cookie->destroy();
			$this->redirect('/irc', null, true);
		}
		if(in_array('load', $args)) {
			$this->data['Irc'] = $this->Cookie->read('IRC');
		}
		$this->set(compact('font', 'size', 'age', 'sex', 'cookie', 'advanced'));

	}

	function chat() {
		if(isset($this->data['Irc']['save'])) {
			$this->Cookie->write('IRC', array('nick' => $this->data['Irc']['nick'], 'font' => $this->data['Irc']['font'],
														'size' => $this->data['Irc']['size'], 'age' => $this->data['Irc']['age'],
														'sex' => $this->data['Irc']['sex'], 'location' => $this->data['Irc']['location'],
														'smileys' => $this->data['Irc']['smileys']));
		}
		$this->redirect('/irc', null, true);
	}

	function __age() {
		$ages[] = '--';
		for($i = $this->ageRange['0']; $i <= $this->ageRange['1']; $i++) $ages[] = $i;
		return $ages;
	}
}
?>