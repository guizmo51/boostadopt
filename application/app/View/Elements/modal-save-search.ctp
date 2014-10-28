<div ng-controller="ModalSaveSearchCtrl" >

    <script type="text/ng-template" id="ModalSaveSearchCtrl.html">
        <div class="modal-header">
            <h3>Save search settings</h3>
        </div>
        <div class="modal-body">
		<form role="form">
			<div class="form-group">
    					<label for="searchInputName">Nom de la recherche</label>
    					<input type="text" class="form-control" id="loginInputEmail1" ng-model="modal.searchName" placeholder="Enter name for this search settings">
  								
			</div>
		</form>

        </div>
        <div class="modal-footer">
            <button class="btn btn-primary" ng-click="save(modal)">Save</button>
            <button class="btn btn-warning" ng-click="cancel()">Cancel</button>
        </div>
    </script>

   
</div>