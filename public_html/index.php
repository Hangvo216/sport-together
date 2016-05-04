<!DOCTYPE html>
<html lang="en" ng-app="myApp">


<?php require "header.php"?>
<?php require __DIR__ ."/../config.php"?>
<?php require __DIR__ ."/../TargetViewHelper.php"?>
<?php global $log;
?>

<body ng-controller="PlayerController">
   

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
        <div class="row text-center">
			<div>
            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                   
                    <div class="caption">
                        <h3>Player info</h3>
                        <p>Ten: <span> {{player}}</span></p>
                        <p>Vi tri: <span> hau ve</span> </p>
                        </p>
                    </div>
                </div>
            </div>
            <br />
			
			<div class='create-team' ng-controller="TeamController">
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
		
			
            <div class="col-md-3 col-sm-8 hero-feature">
                <div class="thumbnail">
                    <div class="caption">
                        <h3>Team info</h3>
                        <p>Ten: <span><a href="team-profile.php"> Team</a></span></p>
                        <p>
                        </p>
                    </div>
                </div>
            </div>
            
            </div>
            
            <div class="search">
				<input type="text" class="form-control" placeholder="Tim kiem">
			</div>
			
			<div class="row">
				<div class="col-md-6 hero-feature">
	                <div class="thumbnail">
	                    <div class="info">
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
            
			<div class="row">
				<div class="col-md-6 hero-feature">
	                <div class="thumbnail">
	                    <div class="info">
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

        <!-- /.row -->
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>