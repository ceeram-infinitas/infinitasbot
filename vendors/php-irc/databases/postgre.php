<?php
/* SVN FILE: $Id$ */
class postgre {

	private $dbIndex;
	private $prefix;
	private $queries = 0;
	private $isConnected = false;
	private $error;

	public function __construct($host, $database, $user, $pass, $prefix, $port = 5432)
	{
		$this->error = true;

		$connect = 	"host=" . $host . " ".
					"port=" . $port . " ".
					"dbname=" . $database . " ".
					"user=" . $user . " ".
					"password=" . $pass;

		$this->error = pg_connect($connect);

		if (!$this->error)
		{
			return;
		}

		$this->prefix = $prefix;
		$this->dbIndex = $this->error;
		$this->isConnected = true;
	}

	public function getError()
	{
		return $this->error === false ? true : false;
		//return (@mysql_error($this->dbIndex));
	}

	public function isConnected()
	{
		return $this->isConnected;
	}

	private function fixVar($id, $values)
	{
		return pg_escape_string($values[intval($id)-1]);
	}

	public function query($query, $values = array())
	{

		if (!is_array($values))
			$values = array($values);

		$query = preg_replace('/\[([0-9]+)]/e', "\$this->fixVar(\\1, &\$values)", $query);

		$this->queries++;

		$data = pg_query($this->dbIndex, $query);

		if (!$data)
		{
			$this->error = $data;
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

		$data = pg_query($query, $this->dbIndex);

		if (!$data)
		{
			$this->error = false;
			return false;
		}

    	return pg_fetch_array($data);
	}


	public function fetchArray($toFetch)
	{
  		return pg_fetch_array($toFetch);
	}

	public function fetchRow($toFetch)
	{
		return pg_fetch_row($toFetch);
	}

	public function close()
	{
		@pg_close($this->dbIndex);
	}

	public function lastID()
	{
		//ehhh. don't use this.
		return null;
	}

	public function numRows($toFetch)
	{
		return pg_num_rows($toFetch);
	}

	public function numQueries()
	{
		return $this->queries;
	}

}

?>

