<?php
/* 
 *  This file is part of the Colsys Project.
 * 
 *  (c) Coltrans S.A. - Colmas Ltda.
 */

?>


    <!-- Calendar-specific includes -->

	<link rel="stylesheet" type="text/css" href="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/resources/css/calendar.css" />
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//Ext.calendar.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//templates/DayHeaderTemplate.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//templates/DayBodyTemplate.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//templates/DayViewTemplate.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//templates/BoxLayoutTemplate.js"></script>

    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//templates/MonthViewTemplate.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//dd/CalendarScrollManager.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//dd/StatusProxy.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//dd/CalendarDD.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//dd/DayViewDD.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//EventRecord.js"></script>

	<script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//views/MonthDayDetailView.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//widgets/CalendarPicker.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//WeekEventRenderer.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//views/CalendarView.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//views/MonthView.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//views/DayHeaderView.js"></script>

    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//views/DayBodyView.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//views/DayView.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//views/WeekView.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//widgets/DateRangeField.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//widgets/ReminderField.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//EventEditForm.js"></script>

    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//EventEditWindow.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/src//CalendarPanel.js"></script>

    <!-- App -->
    <link rel="stylesheet" type="text/css" href="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/resources/css/examples.css" />
	<script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/app/calendar-list.js"></script>
    <script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/app/event-list.js"></script>
	<script type="text/javascript" src="http://dev.sencha.com/deploy/ext-3.3-beta1-6976/examples/calendar/app/test-app.js"></script>


  <div style="display:none;">
    <div id="app-header-content">
        <div id="app-logo">
            <div class="logo-top">&nbsp;</div>
            <div id="logo-body">&nbsp;</div>
            <div class="logo-bottom">&nbsp;</div>
        </div>
        <h1>Ext JS Calendar</h1>

        <span id="app-msg" class="x-hidden"></span>
    </div>
    </div>
<script>
    var updateLogoDt = function(){
        document.getElementById('logo-body').innerHTML = new Date().getDate();
    }
    updateLogoDt();
    setInterval(updateLogoDt, 1000);

    //removes the highlight on updated events
    Ext.override(Ext.calendar.CalendarView, {
        doUpdateFx: Ext.emptyFn
    });
</script>
