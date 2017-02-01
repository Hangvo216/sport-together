<?php session_start();?>

<div ng-controller="PlayerController">
      <form name="myForm">
        <div class="form-group">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
         </div>      
          <div class="form-group">
            <label for="position"  class="control-label">Vị trí:</label>
            <input type="text" ng-model="position" class="form-control" id="positionInput" placeholder="position">
          </div>    
        </form>
        <button type="Submit" class="btn btn-default" ng-click=createPlayer()>Save</button>
</div>
 
 
 <div ng-controller="PlayerController">
      <form name="myForm">          
          <div class="form-group">Tạo team:
            <label for="position"  class="control-label">Team</label>
            <input type="text" ng-model="playerInfo.teamName" class="form-control" id="teamInput" placeholder="team">
          </div>    
        </form>
        <button type="Submit" class="btn btn-default" ng-click=createTeam()>Save</button>
</div>



 <div ng-controller="TeamController">
  Hoặc bạn có thể
 Tham gia một team có sẵn, đội bóng đó sẽ nhận được yêu cầu tham gia của bạn
 
      <form name="myForm">          
          <div class="form-group">
            <label for="field" class="control-label">Đội</label> 
      		  <select class="form-control" name="TypeObj" ng-model="teamSelected"
      		     ng-options="t.team_name for t in allTeams track by t.id">
                 <option></option>
              </select>
          </div>    
        </form>
        Currently selected: {{ {selected_allTeams:teamSelected} }}
        <button type="Submit" class="btn btn-default" ng-click=joinTeamRequest()>Save</button>
</div>
