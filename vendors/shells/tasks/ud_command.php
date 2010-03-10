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

App::import('Core', 'HttpSocket');
App::import('Core', 'Xml');

/**
 * This is the ~ud command
 *
 *
 * @package       cakebot
 * @subpackage    cakebot.vendors.shells.tasks
 */
class UdCommandTask extends Object {
/**
 * Not implemented
 *
 * @return void
 * @access public
 */
	function startup() {}
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
	function execute($userName = null, $query = null) {
		$args = func_num_args(); 
		if($args == 1) {// when user types ~ud
			return 'http://www.urbandictionary.com/';
		} elseif ($args == 0){// for the ping hook
		}
		// when users type: ~ud searchkeys
		$term = urlencode(implode(array_splice(func_get_args(), 1), " "));
		$url = 'http://www.urbandictionary.com/define.php?term=' . $term;
		$HttpSocket = new HttpSocket();
		$contents = $HttpSocket->get($url);

		if ($contents === false) {
			return 'Urban Dictionary is currently inaccessible';
		} elseif (strpos($contents, 'isn\'t defined') !== false) {
			$url = 'http://urbandictionary.com/insert.php?word=' . $term;
			return $term . ' is not defined yet [ ' . $url . ' ]';
		} else {
			$start = strpos($contents, '<div class=\'definition\'>');
			$end = strpos($contents, '<div', $start + 1);
			if ($end === false) {
				$end = strpos($contents, '</div>', $start);
			}
			$contents = substr($contents, $start, $end - $start);
			$contents = html_entity_decode(strip_tags($contents));
			$contents = $term . ' means ' . trim(preg_replace('/[\r\n\t ]+/', ' ', $contents));
			/**
			* Not sure why, but this seems to be the magic number for
			* ensuring that the text isn't truncated. The hostmask isn't
			* included in what's sent to the server. The maximum message
			* length should be 510 characters according to the IRC RFC.
			*/
			$max = 445 - strlen($userName) - 2;
			if (strlen($contents) > $max) {
				$contents = substr($contents, 0, $max);
				$end = strrpos($contents, ' ');
				if ($end === false) {
					$end = $max;
				}
				$contents = substr($contents, 0, $end) . '...';
			}
			$out = $userName . ': ' . $contents;

			return $out;
		}
	}
}
?>