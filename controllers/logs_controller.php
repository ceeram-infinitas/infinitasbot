<?php
/* SVN FILE: $Id$ */
	class LogsController extends AppController {
		var $helpers = array('Calendar');
		var $name = 'Logs';
		function index() {
		}

		function show($year, $month = null, $day = null) {
			if (is_null($month) && is_null($day)) {
				$this->set('year', $year);
				$this->render('calendar');
			}

			if (is_numeric($year) && is_numeric($month) && is_numeric($day)) {
				$this->set('entries', $this->Log->findAll("DATE_FORMAT(time, '%Y %c %e') = '".$year.' '. $month. ' '. $day."'", null, 'Log.time'));
			}
		}
	}
?>