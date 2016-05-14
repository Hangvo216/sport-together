
<div id="graph-date" ng-controller="PeriodButtonController">
  <div id="uib-datepicker-popup" class ="" uib-datepicker-popup ng-model="dateSelected" on-open-focus="false" show-weeks="false"
    close-on-date-selection="false" is-open="calendarOpened" custom-class="getCustomClass(date, mode)"
    date-disabled="getDateDisabled(date, mode)" min-date="minDate" init-date="period.endDate" starting-day="1" show-button-bar="false" ></div>
  <div class="btn-group">
    <label class="btn btn-default" ng-model="period.periodType" uib-btn-radio="'custom'" ng-click='calendarClicked()'><i
      class="glyphicon glyphicon-calendar"></i></label>
  </div>
</div>