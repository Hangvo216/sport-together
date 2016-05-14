<style>
  .full button span {
    background-color: limegreen;
    border-radius: 32px;
    color: black;
  }
  .partially button span {
    background-color: orange;
    border-radius: 32px;
    color: black;
  }
</style>

   <div class="container" ng-controller="TeamController">

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
	<div class="team-buttons">
		<button type="button" class="btn btn-primary" id="make-game" data-toggle="modal" data-target=".game">tao tran dau</button>

		<button type="submit" class="btn btn-default" id="join-team">tham gia doi bong </button>
	</div>
	
	<!-- div looking for team -->
      <div class="find-team container">
            
			<div class="row">
				<div class="col-md-6 hero-feature">
	                <div class="thumbnail">
	                    <div class="info">
	                    	<label><h3>Dang tim doi banh</h3>
	                    	</label>
	                    	<p class="text-right"> The loai: <span>5 vs 5</span></p>
	                        <p>Doi: <span><a href="#">Sport Together</a></span></p>
							<p>Dia diem: <span> Quan 7</span></p>
							<p>Ngay: <span> April 17</span></p>
							<p>Thoi gian: <span> 3 - 5 pm</span></p>
							<p class="text-right"><span><a href="#"> Chi tiet</a></span></p>
							<button type="submit" class="btn btn-default">Tham gia</button>
					
	                    </div>
	                </div>
	            </div>
            </div>
     </div>
     
     <div class="scheduled-game container">
            
			<div class="row">
				<div class="col-md-6 hero-feature">
	                <div class="thumbnail">
	                    <div class="info">
	                    <label><h3>tran dau sap den</h3>
	                    	</label>
	                        <p class="text-right"> The loai: <span>5 vs 5</span></p>
	                        <p>Doi: <span><a href="#">Sport Together 2</a></span></p>
							<p>Dia diem: <span> Quan 7</span></p>
							<p>Ngay: <span> April 17</span></p>
							<p>Thoi gian: <span> 3 - 5 pm</span></p>
							<p class="text-right"><span><a href="#"> Chi tiet</a></span></p>
							<button type="submit" class="btn btn-default">Tham gia</button>
					
	                    </div>
	                </div>
	            </div>
            </div>
	</div>
	
	<div class="played-already container">
            
			<div class="row">
				<div class="col-md-6 hero-feature">
	                <div class="thumbnail">
	                    <div class="info">
	                    <label><h3>Tran dau da choi</h3>
	                    	</label>
	                        <p class="text-right"> The loai: <span>5 vs 5</span></p>
	                        <p>Doi: <span><a href="#">Sport Together 2</a></span></p>
							<p>Dia diem: <span> Quan 7</span></p>
							<p>Ngay: <span> April 17</span></p>
							<p>Thoi gian: <span> 3 - 5 pm</span></p>
							<p class="text-right"><span><a href="#"> Chi tiet</a></span></p>
							<button type="submit" class="btn btn-default">Tham gia</button>
					
	                    </div>
	                </div>
	            </div>
            </div>
	</div>

      
 </div>
 
 <!-- Large modal -->

<div class="modal fade game" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" ng-controller="TeamController">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title">Tao tran dau</h4>
      </div>	
      <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">The loai:</label>
            <div class="input-group">
                       <select class="form-control" name="TypeObj" ng-model="selected.type"
                         ng-options="cg.type for cg in gameType" required>
                        <option></option>
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
            <p class="input-group" ng-controller= "TeamController">
         		 <input type="text" ng-change="'setDate()" class="form-control" uib-datepicker-popup="{{format}}" ng-model="dt" is-open="popup1.opened" 
       			   datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" />
	       	   <span class="input-group-btn">
	      	      <button type="button" class="btn btn-default" ng-click="open1()"><i class="glyphicon glyphicon-calendar"></i></button>
	      	    </span>
        	</p>
          </div>
          <div class="form-group">
            <label for="time" class="control-label">Time:</label>
            <div ng-controller="TeamController">

			  <uib-timepicker ng-model="mytime" ng-change="update()" hour-step="hstep"
			   minute-step="mstep" show-meridian="ismeridian"></uib-timepicker>
			
			  <pre class="alert alert-info">Time is: {{mytime | date:'shortTime' }}</pre>
			
			  <hr>
			
			  <button type="button" class="btn btn-danger" ng-click="clearTime()">Clear</button>
			
			</div>
          </div>
          <div class="form-group">
            <label for="message" class="control-label">Message:</label>
            <textarea class="form-control" ng-model="message" id="message-text"></textarea>
          </div>
        </form>
        <button type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-default" ng-click="createGame()">Tao tran dau</button>
    </div>
  </div>
</div>
 
