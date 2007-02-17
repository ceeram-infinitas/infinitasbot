<?php
/* SVN FILE: $Id$ */
class commands_mod extends module {

	public $title = "Command list Mod";
	public $author = "Aragno";
	public $version = "0.1";
	public $dontShow = true;


	/**
	 * Send message
	 *
	 * If the message is sent as a pm we pm back else we notice to users channel
	 *
	 * Less clutter
	 *
	 * @param string $to
	 * @param string $msg
	 * @param string $from
	 */
	private function doMessage($to, $msg, $from)
	{
		if ($to == $this->ircClass->getNick())
		{
			$this->ircClass->privMsg($from, $msg);
		}
		else
		{
			$this->ircClass->notice($from, $msg);
		}
	}

	/**
	 * Output a list of commands available to the users
	 *
	 * Based on the dcc_help function
	 *
	 * @param array $line
	 * @param array $args
	 */
    public function priv_commands($line, $args)
    {
		$channel = $line['to'];
		$fromNick = $line['fromNick'];

    	$cmdList = $this->parserClass->getCmdList('priv');
		$sectionList = $this->parserClass->getCmdList('section');

		if ($args['nargs'] > 0)
		{
			$cmd = $args['arg1'];

			if (isset($cmdList[$cmd]))
			{
				$this->doMessage($channel, "Usage: " . $cmd . " " . $cmdList[$cmd]['args'], $fromNick);
				$this->doMessage($channel, "Section: " . $sectionList[$cmdList[$cmd]['section']]['longname'], $fromNick);
				$this->doMessage($channel, "Description: " . $cmdList[$cmd]['help'], $fromNick);
			}
			else
			{
				$this->doMessage($channel, "Invalid Command: " . $line['arg1'],$fromNick);

			}
			return;
		}

		$this->doMessage($channel, "Commands:",$fromNick);

		$sections = array();

		foreach ($cmdList AS $cmd => $cmdData)
		{
			// Older mods without the added info will not display help msg until added
			if ($cmdList[$cmd]['help'] == "")
			{
				continue;
			}

			$sections[$cmdData['section']][] = strtoupper($cmd) . " - " . $cmdData['help'];
		}

		foreach ($sections AS $section => $data)
		{
			$this->doMessage($channel, $sectionList[$section]['longname'],$fromNick);

			foreach ($data AS $cmd)
			{
				$this->doMessage($channel, "-- " . $cmd, $fromNick);
			}
		}

		$this->doMessage($channel, "Use !help <command> for a list of arguments",$fromNick);

    }
}
?>