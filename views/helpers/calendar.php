<?php

	class CalendarHelper extends AppHelper {
		var $helpers = array('Html');
		
		function generateCalendarForMonth($month, $year) {
			$result = '<table>';
			$result .= $this->getHeaderForMonth($month);
			$result .= $this->getWeekdays();
			$result .= $this->getDays($month, $year);
			$result .= '</table>';
			return $result;
		}
		
		function getHeaderForMonth($month) {
			return '<tr><th colspan="7">'.date('F', mktime(null, null, null, $month)).'</th></tr>';
		}
		
		function getWeekdays() {
			return '<tr><th>M</th><th>T</th><th>W</th><th>T</th><th>F</th><th>S</th><th>S</th></tr>';
		}
		
		function getDays($month, $year) {
			$result = '<tr>';
			$firstWeekDay = date('N', mktime(null, null, null, $month, 1, $year));
			$days = date('t', mktime(null, null, null, $month, 1, $year));
			$cellCounter = 0;
			
			for ($i = 1; $i < $firstWeekDay; $i++) {
				$result .= '<td></td>';
				$cellCounter++;
			}
			
			$offset = $cellCounter;
			
			for ($i = 1; $i <= $days; $i++) {
				$result .= '<td>'.$this->__link($year, $month, $i).'</td>';

				if (($i + $offset) % 7 === 0) {
					$result .= '</tr><tr>';
				}
				$cellCounter++;
			}
			
			$fill = 7 - ($cellCounter % 7);

			for ($i = 1; $i <= $fill; $i++) {
				$result .= '<td></td>';
			}
			
			$result .= '</tr>';
			
			return $result;
		}
		
		function __link($year, $month, $day) {
			$currentDate = mktime(null, null, null, date('m'), date('d'), date('Y'));
			$specifiedDate = mktime(null, null, null, $month, $day, $year);
			
			if ($specifiedDate <= $currentDate) {
				return $this->Html->link($day, '/logs/show/'.$year.'/'.$month.'/'.$day);
			} else {
				return $day;
			}
		}
	}
?>