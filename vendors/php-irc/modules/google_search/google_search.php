<?php
/* SVN FILE: $Id$ */
class google_search extends module {

	public $title = "Google Search";
	public $author = "Mad_Clog";
	public $version = "0.1";

	public $max_results = 2;
	public $response_type = 0; // 0 = channel; 1 = query/pm; 2 = notice

	public function init()
	{
		if (!defined('GOOGLE_SEARCH_PATTERN'))
			define('GOOGLE_SEARCH_PATTERN', '#\<h2 class\=r\>\<a href\="([^"]*)" class\=l\>(([^<]|<[^a][^ ])*)\</a\>\</h2\>#i');

		// we can't have more then 10 results
		if ($this->max_results > 10)
			$this->max_results = 10;
	}

	public function destroy()
	{
	}

	public function priv_google($line, $args)
	{
    if ($args['nargs'] < 1)
    {
    	$this->sendMsg($line, $args, 'You need to supply a search string');
    	return;
    }

    $query = 'q='.urlencode($args['query']);
    $getQuery = socket::generateGetQuery($query, 'www.google.com', '/search');
    $this->ircClass->addQuery('www.google.com', 80, $getQuery, $line, $this, 'sendResults');
	}

	public function sendResults($line, $args, $result, $response)
	{
		if ($result == QUERY_SUCCESS) {
			$count = preg_match_all(GOOGLE_SEARCH_PATTERN, $response, $matches, PREG_SET_ORDER);
			if ($count == 0) {
				$this->sendMsg($line, $args, 'Your search - '.BOLD.$args['query'].BOLD.' - did not match any documents.');
				return;
			}

			$numResults = ($count < $this->max_results) ? $count : $this->max_results;

			for ($i = 0;$i < $numResults;$i++)
			{
				$this->sendMsg($line, $args, strip_tags(html_entity_decode($matches[$i][2])).' - '.$matches[$i][1]);
			}
		} else {
			$this->sendMsg($line, $args, 'Google says NO! (server didn\'t respond)');
		}
	}

	public function sendMsg($line, $args, $message)
	{
		switch($this->response_type)
		{
			case 0:
				$this->ircClass->privMsg($line['to'], $message);
			break;

			case 1:
				$this->ircClass->privMsg($line['fromNick'], $message);
			break;

			case 2;
				$this->ircClass->notice($line['fromNick'], $message);
			break;

			default:
				$this->ircClass->privMsg($line['to'], $message);
		}
	}

}

?>