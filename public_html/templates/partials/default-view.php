<?php require __DIR__ ."/../../../config.php"?>
<?php require TARGETVIEWHELPER?>
<?php global $log;
session_start();
echo 'a';
?>            
            
			
<div class="game-container"  ng-controller="GameController">
	<div class="game-info" ng-repeat="g in allFindGames">	
		<div class="row">
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
