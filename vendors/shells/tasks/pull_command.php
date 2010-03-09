<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright     Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link          http://www.cakefoundation.org/projects/info/cakebot
 * @package       cakebot
 * @subpackage    cakebot
 * @since         cakebot v (1.0)
 * @version       $Revision$
 * @modifiedby    $LastChangedBy$
 * @lastmodified  $Date$
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

//App::import('Core', 'HttpSocket'); // for version 1.3
//App::import('Core', 'Xml');

/**
 * This is the ~ticket command
 *
 *
 * @package       cakebot
 * @subpackage    cakebot.vendors.shells.tasks
 */
class PullCommandTask extends Object {
/**
 * Not implemented
 *
 * @return void
 * @access public
 */
	function startup() {
		//Configure::write('updated', 0);
	}
/**
 * Not implemented
 *
 * @return void
 * @access public
 */
	function initialize() {}
/**
 * Not implemented
 *
 * @return void
 * @access public
 */
	function loadTasks() {}
/**
 * Create the message
 *
 * @param string $userName the username to send this message to
 * @return string the message to send to the user/channel
 * @access public
 */
	function execute($userName = null, $hash = null) {
		$num_args = func_num_args(); 
		if($num_args == 1) {// when user types ~tickets
			return "dogmatic69, please pull the commits from my fork: http://github.com/{$userName}/infinitas/commits/dev";
		} elseif($num_args == 2 && strlen($hash) == 40) {
			return "dogmatic69, please pull this commit: http://github.com/{$userName}/infinitas/commit/{$hash}";
		} elseif ($num_args == 2 && $hash == 'last') {
			$HttpSocket = new HttpSocket();
			$xml = new Xml($HttpSocket->get("http://github.com/feeds/{$userName}/commits/infinitas/dev"));
			$results = $xml->toArray();
			unset($xml, $HttpSocket);
			foreach($results['Feed']['Entry'] as $commit){
				if(strpos(strtolower($commit['Author']['name']), strtolower($userName)) !== false){
					return "dogmatic69, please pull this commit: " . $commit['Link']['href'];
				}
			}
		} elseif ($num_args == 2 && $hash == 'help') {
			return 	"Usage: ~pull, will post pull request for dev branch of your fork. ".
					"~pull last, will post pull request for your last commit. ".
					"~pull <hash>, will post pull request for the commit with this hash";			
		}
	}
}
?>