<!DOCTYPE html>
<html lang="en">


<?php require "header.php"?>
<?php 
global $mysqli;
require_once(__DIR__  . '/../BootstrapDB.php');

$mysqli = new mysqli($fizzyInit['mysqlAddress'], $fizzyInit['mysqlUser'], $fizzyInit['mysqlPass'], $fizzyInit['mysqlDb'], $fizzyInit['mysqlPort']);
// $mysqli = new mysqli('localhost', 'root', 'root', 'sport_together', '8889');

//$mysqli = BootstrapDB::getMYSQLI();
// if ($mysqli->connect_error) {
// 	die("Connection failed: " . $mysqli->connect_error);
// 	echo "AAAAA";
// }else {
// 	echo "Connected successfully";
// 	$result = $mysqli->query("insert into players (player_name, position, int_team_id, day_joined, facebook_id, username) VALUES('Player1','defense','1','02-02-2016',1111,
// 		'helllo') ");
// }


?>
<body>
   

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
                        <p>Ten: <span> Phuong Bui</span></p>
                        <p>Vi tri: <span> hau ve</span> </p>
                        </p>
                    </div>
                </div>
            </div>
            <br />
			
			
		
			
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