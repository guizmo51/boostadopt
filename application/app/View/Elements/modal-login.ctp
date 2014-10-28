<div ng-controller="AppCtrl" >

    <script type="text/ng-template" id="myModalContent.html">
        <div class="modal-header">
            <h3 data-l10n-id="login-title">Log in</h3>
        </div>
        <div class="modal-body">
	Important : une fois validé veuillez patienter avant que la connexion s\'établisse. 
<alert ng-repeat="alert in alerts" type="{{alert.type}}" close="closeAlert($index)">{{alert.msg}}</alert>
				<form role="form">
					<div class="form-group">
    					<label for="loginInputEmail1" data-l10n-id="login-email">Email address</label>
    					<input type="email" class="form-control" id="loginInputEmail1" ng-model="user.login" placeholder="Enter email">
  					</div>
					<div class="form-group">
    					<label for="loginInputPassword1">Password</label>
    					<input type="password" class="form-control" id="loginInputPassword1" ng-model="user.password" placeholder="Password" >
  					</div>
					<div class="form-group">
						<label for="loginSelectService">Service</label>
						<select id="loginSelectService" class="selectpicker" ng-model="user.service">
							<option value="AdopteUnMec.com">AdopteUnMec.com</option>
							<option value="adoptauntio.es">adoptauntio.es</option>
							<option value="adottaunragazzo.it">adottaunragazzo.it</option>
							<option value="adoptaguy.de">adoptaguy.de</option>
						</select>
					</div>
			<div class="form-group">
						<label for="loginSelectService">Stay connected</label>
						<input type="checkbox" id="loginStayConnected" ng-model="user.stayConnected"/>
					</div>
				</form>        

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="ok(user)">Sign in/up</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>

   
</div>