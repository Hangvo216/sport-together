<?php echo "AAAA"; ?>
<!-- div looking for team -->
<div class="team-game-container" ng-if="same_team = '1'" ng-controller="TeamController">

<div class="team-game-container" ng-controller="GameController">
	<div class="find-team container" ng-repeat="g in findGames">
		<div class="row">
			<div class="col-md-6 hero-feature">
				<div class="thumbnail">
					<div class="info">
						<label><h5>Looking for Opponent:</h5></label>
						<p>Sân:{{g.field_name}}</p>
						<p>
							<span class="col-md-8">đang tìm đội</span> <span class="col-md-4">{{g.game_type}}</span>
						</p>
						<p>
							<span class="col-md-8">Ngay: {{g.date_played}} {{g.time_played}}</span><span
								class="col-md-4"><a href="#"> Chi tiet</a></span>
						</p>
						<button type="submit" class="btn btn-default">Edit</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="team-game-container" ng-controller="TeamController">
		<div class="scheduled-game container" ng-repeat="g in scheduledGames">
			<div class="row">
				<div class="col-md-6 hero-feature">
					<div class="thumbnail">
						<div class="info">
							<label><h5>Scheduled Game</h5></label>
							<p>Sân:{{g.field_name}}</p>
							<p>
								<span class="col-md-8"><a ng-href="/#/team-view/{{g.int_guest_team}}">{{g.guest_team_name}}</a></span><span
									class="col-md-4">{{g.game_type}}</span>
							</p>
							<p>
								<span class="col-md-8">Ngay: {{g.date_played}} {{g.time_played}}</span><span
									class="col-md-4"><a href="#"> Chi tiet</a></span>
							</p>
							<button type="submit" class="btn btn-default">Cancel</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="team-game-container" ng-ig="teamInfo.other_team=true" ng-controller="TeamController">
		<label><h3>Game Already Played</h3></label>
		<div class="played-already container" ng-repeat="g in doneGames">
			<div class="row">
				<div class="col-md-6 hero-feature">
					<div class="thumbnail">
						<div class="info">
							<span><a href="/#/team-profile/{{g.other_team_id}}">{{g.guest_team_name}}</a></span><span>Sân
								{{g.field_name}}</span>
							<p>
								Kết quả <span> {{g.result}}</span>
							</p>
							<p>
								Ngày: <span> {{g.date_played}}</span><span> {{g.time_played}}</span>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>