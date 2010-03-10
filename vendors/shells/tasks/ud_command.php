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
 * This is the ~ticket command
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
			//return 'Submit your ticket here: http://infinitas.lighthouseapp.com/projects/43419-infinitas/tickets';
		} elseif ($args == 0){// for the ping hook
/*			$HttpSocket = new HttpSocket();
			$xml = new Xml($HttpSocket->get('http://infinitas.lighthouseapp.com/events.atom'));
			$results = $xml->toArray();
			unset($xml, $HttpSocket);
			$i = 0;
			$count = count($results['Feed']['Entry']);
			$tickets = $changesets = array();
			$updated  = Configure::read('updated');
			while($i<$count-27 && $results['Feed']['Entry'][$i]['updated'] != $updated) {
				$result = $results['Feed']['Entry'][$i];
				if(strpos($result['Link']['href'], 'tickets') !== false) {
					$title = str_replace(array('&#147;', '&#148;', '&#x2192;', '#'), array("'", "'" ,'->'), html_entity_decode(strip_tags($result['title']['value'])));
					$content = str_replace(array('&#147;', '&#148;', '&#x2192;', '#'), array("'", "'" ,'->'), html_entity_decode(strip_tags(str_replace('</p><p>', ', ', $result['content']['value']))));
					if(strlen($content)>45) {
						$content = substr($content, 0, 45) . '...';
					}
					if(strpos($result['Author']['name'], 'dogmatic') !== false) {
						$content .= ' By: Infinitas';
					} else {
						$content .= ' By: ' . $result['Author']['name'];
					}
					$link = $result['Link']['href'];
					$tickets[] = array('text' => "Ticket: {$title} : {$content}", 'link' => $link);
					//debug(array('text' => "Ticket: {$title} : {$content}", 'link' => $link));
				} elseif (strpos($result['Link']['href'], 'changesets') !== false) {
					
					//$changesets[] = '';//@todo implement changesets
				}
				$i++;
			}
			Configure::write('updated', $results['Feed']['Entry'][0]['updated']);
			//$return = array('tickets' => array_reverse($tickets));
 			$return = array_reverse($tickets);
			unset($results, $i, $count, $tickets, $updated, $result, $title, $content, $link, $changesets);
			return $return;
*/		}
		// when users type: ~tickets searchkeys
		$term = urlencode(implode(array_splice(func_get_args(), 1), " "));
		$url = 'http://www.urbandictionary.com/define.php?term=' . $term;
		$HttpSocket = new HttpSocket();
		$contents = $HttpSocket->get($url);
		//$url = 'http://www.urbandictionary.com/define.php?term=' . urlencode($term);
        //$contents = @file_get_contents($url);
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
			$contents = $term . ' means: ' . trim(preg_replace('/[\r\n\t ]+/', ' ', $contents));
			/**
			* Not sure why, but this seems to be the magic number for
			* ensuring that the text isn't truncated. The hostmask isn't
			* included in what's sent to the server. The maximum message
			* length should be 510 characters according to the IRC RFC.
			*/
			$max = 445 - strlen($userName) - 1;
			if (strlen($contents) > $max) {
				$contents = substr($contents, 0, $max);
				$end = strrpos($contents, ' ');
				if ($end === false) {
					$end = $max;
				}
				$contents = substr($contents, 0, $end) . '...';
			}
			$out = $userName . ' ' . $contents;

			return $out;
		}


/*		$xml = new Xml($HttpSocket->get('http://infinitas.lighthouseapp.com/tickets.xml?q=' . $searchString));
		$results = $xml->toArray();
		unset($xml, $HttpSocket);
		if(!isset($results['Tickets'])){
			unset($results);
			return "No tickets found.";
		}
		$count = count($results['Tickets']['Ticket']);
		if(isset($results['Tickets']['Ticket'][0])) {
			$out = sprintf("%d tickets found. To see the tickets go to: http://infinitas.lighthouseapp.com/tickets?q=%s", $count, $searchString);
			unset($results, $count, $searchString);
			return $out;
		}
		$out = sprintf("1 ticket found. To see the ticket go to: %s", $results['Tickets']['Ticket']['url']);
		unset($results);
		return $out;
 */
	}
}
?>