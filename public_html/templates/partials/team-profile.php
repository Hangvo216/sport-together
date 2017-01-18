
   <div class="container">
   
	  <div class="team-infomation container" ng-controller="TeamController">
	
	        <!-- Title -->
	        <div class="row">
	            <div class="col-lg-12">
	                <h3>Team Profile</h3>
	            </div>
	        </div>
	        <!-- /.row -->
	
	        <!-- Page Features -->
	       <textarea class="team-description" rows="4" cols="50">
		</textarea>
		<button type="submit" class="btn btn-default" id="save-description">Save</button>
		<div class="create-game-buttons">
			<button type="button" class="btn btn-primary" id="make-game" data-toggle="modal" data-target=".game">tao tran dau</button>
		</div>
		<div class="join-team-buttons">
			<button ng-show="!isCaptain()" type="button" class="btn btn-primary" id="join-team">tham gia doi bong </button>	
		</div>
	</div>
	<?php include(__DIR__ .'/team-statistic.php'); ?>
	<!-- div looking for team -->
	<div class="team-game-container" ng-controller="GameController">
	      <div class="find-team container" ng-repeat="g in findGames" >
				<div class="row">
					<div class="col-md-6 hero-feature">
		                <div class="thumbnail">
		                    <div class="info">
		                    	<label><h3>Looking for Opponent:</h3>
		                    	</label>
		                    	<p> The loai: <span>{{g.game_type}}</span></p>
		                        <p>Doi: <span><a href="#">{{g.team_name}}</a></span></p>
								<p>Field Name <span> {{g.field_name}}</span></p>
								<p>Ngay: <span> {{g.date_played}}</span></p>
								<p>Thoi gian: <span> {{g.time_played}}</span></p>
								<p class="text-right"><span><a href="#"> Chi tiet</a></span></p>
								<button type="submit" class="btn btn-default">Edit </button>
						
		                    </div>
		                </div>
		            </div>
	            </div>
	     </div>
	     
	     <div class="scheduled-game container" ng-repeat="g in scheduledGames" >
	            
				<div class="row">
					<div class="col-md-6 hero-feature">
		                <div class="thumbnail">
		                    <div class="info">
		                    <label><h3>Scheduled Game</h3>
		                    	</label>
		                        <p> The loai: <span>{{g.game_type}}</span></p>
		                        <p>Home Team: <span><a href="#">{{g.home_team_name}}</a></span></p>
		                        <p>Guest Team: <span><a href="#">{{g.guest_team_name}}</a></span></p>
								<p>Field Name <span> {{g.field_name}}</span></p>
								<p>Ngay: <span> {{g.date_played}}</span></p>
								<p>Thoi gian: <span> {{g.time_played}}</span></p>
								<p class="text-right"><span><a href="#"> Chi tiet</a></span></p>
								<button type="submit" class="btn btn-default">Cancel </button>
						
		                    </div>
		                </div>
		            </div>
	            </div>
		</div>
	
		<div class="played-already container"  ng-repeat="g in doneGames" >
	            
				<div class="row">
					<div class="col-md-6 hero-feature">
		                <div class="thumbnail">
		                    <div class="info">
		                    <label><h3>Game Already Played</h3>
		                    	</label>
		                        <p>Type: <span>{{g.game_type}}</span></p>
		                        <p>Home Team: <span><a href="#">{{g.home_team_name}}</a></span></p>
		                        <p>Guest Team: <span><a href="#">{{g.guest_team_name}}</a></span></p>
		                        <p>Field Name <span> {{g.field_name}}</span></p>
								<p>Result <span> {{g.result}}</span></p>
								<p>Ngay: <span> {{g.date_played}}</span></p>
								<p>Thoi gian: <span> {{g.time_played}}</span></p>
								<p class="text-right"><span><a href="#"> Chi tiet</a></span></p>
						
		                    </div>
		                </div>
		            </div>
	            </div>
		</div>

   </div>   
 </div>
 
 <!-- Large modal -->

<div class="modal fade game" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" 
ng-controller="TeamController">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title">Tao tran dau</h4>
      </div>	
      <form name="myForm">
          <div class="form-group">
            <label for="recipient-name" class="control-label">The loai:</label>
            <div class="input-group" >
                       <select name="gameField"class="form-control" name="TypeObj" ng-model="selected.type"
                         ng-options="cg.type for cg in gameType" required>
                       </select>
            </div> 
           	 
          </div>
          
          <div class="form-group">
      		  <label for="field" class="col-sm-4 control-label">Field</label> 
      		  <select class="form-control" name="TypeObj" ng-model="selected.field"
      		     ng-options="gf.name for gf in gameFields" required>
                 <option></option>
              </select>
 		 </div>
 		 <div class="form-group">
            <label for="date" class="control-label">Date:</label>
            <p class="input-group">
         		 <input type="text" class="form-control" uib-datepicker-popup="{{format}}" ng-model="dt" is-open="popup1.opened" 
       			   datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" />
	       	   <span class="input-group-btn">
	      	      <button type="button" class="btn btn-default" ng-click="open1()"><i class="glyphicon glyphicon-calendar"></i></button>
	      	    </span>
        	</p>
          </div>
          <div class="form-group">
            <label for="time" class="control-label">Time:</label>
            <div >
				
				  <uib-timepicker ng-model="gameTime.mytime" ng-change="changed()" hour-step="hstep"
			 	 minute-step="mstep" show-meridian="false"></uib-timepicker>
				</div>
		<!--  <pre class="alert alert-info">Time is: {{gameTime.mytime | date:'shortTime' }}</pre>-->
			
		<!-- 	 <button type="button" class="btn btn-danger" ng-click="clearTime()">Clear</button> -->
			
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Message:</label>
            <textarea class="form-control" ng-model="message" id="message-text"></textarea>
          </div>
        </form>
        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-default" ng-click="createGame(gameTime.mytime)">Tao tran dau</button>
    </div>
  </div>
</div>
 
