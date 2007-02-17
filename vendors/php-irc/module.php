<?php
/* SVN FILE: $Id$ */
abstract class module {

	public $title = "<title>";
	public $author = "<author>";
	public $version = "<version>";
	public $dontShow = false;

	public $ircClass;
	public $dccClass;
	public $timerClass;
	public $parserClass;
	public $socketClass;
	public $db;

	public function __construct()
	{
		//Nothing here...
	}

	public function __destruct()
	{
		$this->ircClass = null;
		$this->dccClass = null;
		$this->timerClass = null;
		$this->parserClass = null;
		$this->socketClass = null;
		$this->db = null;
		$this->db2 = null;
		//Nothing here
	}

	public final function __setClasses($ircClass, $dccClass, $timerClass, $parserClass,
																	$socketClass, $db, $db2)
	{
		$this->ircClass = $ircClass;
		$this->dccClass = $dccClass;
		$this->timerClass = $timerClass;
		$this->parserClass = $parserClass;
		$this->socketClass = $socketClass;
		$this->db = $db;
		$this->db2 = $db2;
	}

	public final function getModule($modName)
	{
		$mods = $this->parserClass->getCmdList("file");

		if ($mods === false)
		{
			return false;
		}

		if (isset($mods[$modName]))
		{
			return $mods[$modName]['class'];
		}

		return false;
	}

	public function handle($chat, $args)
	{
	}

	public function connected($chat)
	{
	}

	public function main($line, $args)
	{
    	$port = $this->dccClass->addChat($line['fromNick'], null, null, false, $this);

	    if ($port === false)
	    {
	      $this->ircClass->notice($line['fromNick'], "Error starting chat, please try again.", 1);
	    }
	}

	public function init()
	{
		//Global.. this needs to be overwritten
	}

	public function destroy()
	{
		//Global.. this needs to be overwritten
	}

}

?>
