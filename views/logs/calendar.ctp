<?php /* SVN FILE: $Id$ */ ?>
<div id="year">
	<?php for ($i = 1; $i <= 12; $i++): ?>
		<div class="month"><?php echo $calendar->generateCalendarForMonth($i, $year); ?></div>
	<?php endfor; ?>
</div>