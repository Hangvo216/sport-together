<?php require __DIR__ ."/../../../config.php"?>
<?php require __DIR__ ."/../../../TargetViewHelper.php"?>
<?php global $log;
session_start();


echo"Main-view";
var_dump($_SESSION);

?>

    <!-- Page Content -->
    <div class="container">

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">
                <h3>Dashboard</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center"  ng-controller="PlayerController">
            <div class="col-md-6 hero-feature">
                <div class="thumbnail">
                   
                    <div class="caption">
                        <h3>Player info</h3>
                        <p>Ten: <span> {{playerInfo.player_name}}</span></p>
                        <p>Vi tri: <span>{{playerInfo.position}}</span> </p>
                        
                        </p>
                    </div>
                </div>
            </div>
	
			
			
           <div class="col-md-6 hero-feature" ng-controller="PlayerController">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Team info</h3>
                        <p>Ten : <span><a href="/#/team-profile">{{teamInfo.team_name}}</a></span>
                        <p>Noi dung : <span>{{teamInfo.description}}</span></p>
                        <p>
                        </p>
                    </div>
                </div>
            </div>
            
          </div>
          <div ng-show="!hasTeam()" class='create-team' ng-controller="TeamController">
			<form>
			  <fieldset class="form-group">
			    <label for="team-name">Team name</label>
			    <input type="text" class="form-control" ng-model="teamName" id="team-name" placeholder="Enter team name">
			  </fieldset>
			  <fieldset class="form-group">
			    <label for="description">Description</label>
			    <textarea class="form-control" ng-model="description" id="description" rows="3"></textarea>
			  </fieldset>
			  <button type="submit" class="btn btn-primary" ng-click="createTeam()">Create Team</button>
			</form>
		</div>
            
            <div class="search">
				<input type="text" class="form-control" placeholder="Tim kiem">
			</div>
			
			<div class="game-container"  ng-controller="GameController">
				<div class="game-info" ng-repeat="g in allGames">	
					<div class="row">
						<div class="col-md-2 hero-feature game-info-card">
						</div>
						<div class="col-md-6 hero-feature game-info-card">
			                <div class="thumbnail">
			                    <div class="info">
			                    	<p class="text-right"> The loai: <span>{{g.type}}</span></p>
			                        <p>Doi: <span><a href="#">{{g.team_name}}</a></span></p>
									<p>San: <span> {{g.field_name}}</span></p>
									<p>Ngay: <span> {{g.date_played}}</span></p>
									<p>Thoi gian: <span> {{g.time_played}}</span></p>
									<p>Message: <span> {{g.message}}</span></p>
									<p class="text-right"><span><a href="#"> Chi tiet</a></span></p>
									<button type="submit" class="btn btn-default">Tham gia</button>
							
			                    </div>
			                </div>
			            </div>
			         </div>
			     </div>    
		            
			</div>	

        </div>

        <!-- /.row -->
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Sport Together 2016</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->
    
