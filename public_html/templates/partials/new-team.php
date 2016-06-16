<div class="container" ng-controller="TeamController">
	<p>No team found</p>
	<button>Join team</button>
	<button>Create team</button>
	
	<form role="form">
	  <div class="form-group">
	    <label for="name">Team Name:</label>
	    <input ng-model="teamName" class="form-control" id="name">
	  </div>
	  <div class="form-group">
	    <label for="desc">Description:</label>
	    <input ng-model="description" class="form-control" id="desc">
	  </div>
	 
	  <button type="submit" ng-click="createTeam()" class="btn btn-default">Create New Team</button>
	</form>
</div>
