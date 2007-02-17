<?php
/* SVN FILE: $Id$ */
class timers {

	//Local variables
	private $timerStack = array();	//list of all timers indexed by name

	//External Classes
	private $procQueue;
	private $socketClass;
	private $ircClass;

	//Private list of reserved php-irc timer names (please do not
	//use these names)
	private $reserved = array(	"listening_timer_[0-9]*",
								"check_nick_timer",
								"check_channels_timer",
								"check_ping_timeout_timer",
						);

	public function __construct()
	{
		$this->time = time();
		$this->timerStack = array();
	}

	public function setSocketClass($class)
	{
		$this->socketClass = $class;
	}

	public function setIrcClass($class)
	{
		$this->ircClass = $class;
	}

	public function setProcQueue($class)
	{
		$this->procQueue = $class;
	}

	public static function getMicroTime()
	{
		return microtime(true);
	}

	public function getTimers()
	{
		return $this->timerStack;
	}

	public function handle($timer)
	{
		$microTime = self::getMicroTime();

		if (!isset($this->timerStack[$timer->name]))
		{
			return false;
		}

		if ($this->timerStack[$timer->name] !== $timer)
		{
			return false;
		}

		$timer->lastTimeRun = $microTime;
		$timer->nextRunTime = $microTime + $timer->interval;

		if ($timer->class != null)
		{
			$theFunc = $timer->func;
			$status = $timer->class->$theFunc($timer->args);
		}
		else
		{
			$theFunc = $timer->func;
			$status = $theFunc($timer->args);
		}

		if ($status != true)
		{
			$this->removeTimer($timer->name);
		}
		else
		{
			$this->procQueue->addQueue($this->ircClass, $this, "handle", $timer, $timer->interval);
		}

		return false;
	}

	public function removeAllTimers()
	{
		foreach ($this->timerStack AS $timer)
		{
			$this->removeTimer($timer->name);
		}
	}


	public function addTimer($name, $class, $function, $args, $interval, $runRightAway = false)
	{
		if (trim($name) == "")
		{
			return false;
		}

		if (isset($this->timerStack[$name]))
		{
			return false;
		}

		$newTimer = new timer;

		$newTimer->name = $name;
		$newTimer->class = $class;
		$newTimer->func = $function;
		$newTimer->args = $args;
		$newTimer->interval = $interval;
		$newTimer->removed = false;

		if ($runRightAway == false)
		{
			$newTimer->lastTimeRun = $this->getMicroTime();
			$newTimer->nextRunTime = $this->getMicroTime() + $interval;
			$tInterval = $interval;
		}
		else
		{
			$newTimer->lastTimeRun = 0;
			$newTimer->nextRunTime = $this->getMicroTime();
			$tInterval = 0;
		}

		$this->procQueue->addQueue($this->ircClass, $this, "handle", $newTimer, $tInterval);

		$this->timerStack[$newTimer->name] = $newTimer;

		return $name;
	}

	/* Remove the current timer from both the list and stack, changed in 2.1.2, can only call by
	 * timer name now.
	 */
	public function removeTimer($name)
	{
		if (!isset($this->timerStack[$name]))
		{
			return false;
		}

		//Set removed flag,
		$this->timerStack[$name]->removed = true;

		//Remove from stack
		unset($this->timerStack[$name]->args);
		unset($this->timerStack[$name]->class);
		unset($this->timerStack[$name]);

		return true;
	}

}

?>
