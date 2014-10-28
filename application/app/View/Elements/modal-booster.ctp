<div  id="BoosterModal" ng-controller="SearchResultCtrl">

    <script type="text/ng-template" id="myModalBooster.html">
        <div class="modal-header">
            <h3>Booster {{status()}}</h3>
        </div>
        <div class="modal-body">
 <progressbar ng-model="modalData.progressbar" class="progress-striped active" value="(modalData.girlsDone.length/modalData.girls.length)*100" type="{{type}}">
				{{modalData.girlsDone.length}}/{{modalData.girls.length}}
			</progressbar>

			<div style="height: 305px">
    			<carousel interval="-1">
      				<slide ng-repeat="girlPic in modalData.girlsPics" active="girlPic.active">
        				<img ng-src="{{girlPic.image}}" style="margin:auto;">
        				<div class="carousel-caption">
          					<h4>{{girlPic.pseudo}}</h4>
          					<p>{{girlPic.age}} ans, {{girlPic.city}}</p>
        				</div>
					
      				</slide>
					
    			</carousel>
  			</div>
				<div ng-repeat="girl in modalData.girlsDone">
					<div class="table-responsive">
					<table ng-show = "girl.id == getActiveSlide()" class="table table-bordered table-striped" id="profile{{girl.id}}" active="slide.active">
						<tr>
							<td>Pseudo</td>
							<td>{{girl.pseudo}}</td>
						</tr>
						<tr>
							<td>City</td>
							<td>{{girl.city}}</td>	
						</tr> 
						<tr>
							<td>Birthdate / Age</td>
							<td>{{girl.birthdate}} / {{girl.age}}</td>	
						</tr>	
						<tr>
					
							<td colspan="2">
								<carousel interval="-1">
      								<slide ng-repeat="pic in girl.pics" >
										<img ng-src="{{split_img_string(pic,2)}}" style="margin:auto;">
        								
									</slide>
								</carousel>
							</td>
						</tr>
					</table>
					</div>
				</div>
			 			
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning" ng-click="stop()">Stop</button>
        </div>
    </script>

   
</div>