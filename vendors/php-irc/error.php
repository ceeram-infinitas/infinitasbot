<?php
/* SVN FILE: $Id$ */
class ConnectException extends Exception {

 	private $exceptionTime = 0;

	function __construct($message)
	{
		parent::__construct($message);
		$this->exceptionTime = time();
	}

	function getTime()
	{
		return $this->exceptionTime;
	}
}


class SendDataException extends Exception {

 	private $exceptionTime = 0;

	function __construct($message)
	{
		parent::__construct($message);
		$this->exceptionTime = time();
	}

	function getTime()
	{
		return $this->exceptionTime;
	}
}



class ConnectionTimeout extends Exception {

 	private $exceptionTime = 0;

	function __construct($message)
	{
		parent::__construct($message);
		$this->exceptionTime = time();
	}

	function getTime()
	{
		return $this->exceptionTime;
	}
}



class ReadException extends Exception {

 	private $exceptionTime = 0;

	function __construct($message)
	{
		parent::__construct($message);
		$this->exceptionTime = time();
	}

	function getTime()
	{
		return $this->exceptionTime;
	}
}

?>
