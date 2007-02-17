<?php
/* SVN FILE: $Id$ */
class mysql {

	private $dbIndex;
	private $prefix;
	private $queries = 0;
	private $isConnected = false;

	private $user;
	private $pass;
	private $database;
	private $host;
	private $port;

	public function __construct($host, $database, $user, $pass, $prefix, $port = 3306)
	{
		$this->user = $user;
		$this->pass = $pass;
		$this->host = $host;
		$this->database = $database;
		$this->port = $port;

		$db = mysql_connect($host . ":" . $port, $user, $pass);

		if (!$db)
		{
			return;
		}

		$dBase = mysql_select_db($database, $db);

		if (!$dBase)
		{
			return;
		}

		$this->prefix = $prefix;
		$this->dbIndex = $db;
		$this->isConnected = true;
	}

	public function getError()
	{
		return (@mysql_error($this->dbIndex));
	}

	public function isConnected()
	{
		return $this->isConnected;
	}

	//Call by reference switched to function declaration, 05/13/05
	private function fixVar($id, &$values)
	{
		return mysql_real_escape_string($values[intval($id)-1], $this->dbIndex);
	}

	public function query($query, $values = array())
	{

		if (!is_array($values))
			$values = array($values);

		$query = preg_replace('/\[([0-9]+)]/e', "\$this->fixVar(\\1, \$values)", $query);

		$this->queries++;

		$data = mysql_query($query, $this->dbIndex);

		if (!$data)
		{
			return false;
		}

		return $data;
	}


	public function queryFetch($query, $values = array())
	{

		if (!is_array($values))
			$values = array($values);

		$query = preg_replace('/\[([0-9]+)]/e', "\$this->fixVar(\\1, &\$values)", $query);

		$this->queries++;

		$data= mysql_query($query, $this->dbIndex);

		if (!$data)
		{
			return false;
		}

    	return mysql_fetch_array($data);
	}


	public function fetchArray($toFetch)
	{
  		return mysql_fetch_array($toFetch);
	}

	public function fetchRow($toFetch)
	{
		return mysql_fetch_row($toFetch);
	}

	public function close()
	{
		@mysql_close($this->dbIndex);
	}

	public function lastID()
	{
		return mysql_insert_id();
	}

	public function numRows($toFetch)
	{
		return mysql_num_rows($toFetch);
	}

	public function numQueries()
	{
		return $this->queries;
	}

}

?>

