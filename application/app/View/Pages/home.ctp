<div id="temp"></div>

<div id="IntroCtrl" >
  <div class="row">
        <div class="col-md-12" data-l10n-id="intro-whats-bis">
	  <h1>Pour choper des filles plus rapidement ... ou pour trouver l'amour </h1>
	</div>
  </div>
  
<div class="row">
  <div class="col-md-4" data-l10n-id="intro-whats">
  	<h2 class="intro-title"><span class="glyphicon glyphicon-heart"></span>&nbsp;Qu'est ce que c'est ?</h2>
  	BoostAdopt est un booster pour le site AdopteUnMec. Il va visiter automatiquement pour vous un nombre prédéfini de profils répondant à vos critères.
  	C'est mathématique cela va vous assurer un plus grand retour sur votre profil et plus d'autorisations d'envois de messages. 
  </div>
  <div class="col-md-2">
  	
  </div>
 <div class="col-md-4">
  <h2 class="intro-title">Présentation vidéo</h2>
  	<iframe width="375" height="275"  src="//www.youtube.com/embed/6ph7K1Y9UZE" frameborder="0" allowfullscreen></iframe>
  </div>
 <div class="col-md-2">
  	
  </div>
</div>
<div class="row">
  <div class="col-md-4">
  	<h2 class="intro-title"><span class="glyphicon glyphicon-group"></span>Parrainage</h2>
  	Parrainez de nouveaux membres en leur fournissant votre lien personnalisé et recevez 250 points à chaque nouvelle inscription !
  	<div class="input-group" ng-show="connected()">
  	<input type="text"  ng-value="parrainageKey()"  class="form-control"  />
  	<span class="input-group-btn">
        <button data-l10n-id="intro-copy-button" id="copy-button" data-clipboard-text="{{parrainage_key}}" class="btn btn-default" type="button">Copy</button>
      </span>
  	</div>
  </div>
  <div class="col-md-4"><h2 class="intro-title"><span class="glyphicon glyphicon-comment"></span>&nbsp;Réseaux sociaux</h2>
  <a href="https://twitter.com/boostadopt" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @boostadopt</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FBoostAdopt&amp;width&amp;layout=standard&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:80px;" allowTransparency="true"></iframe>
  </div>
  <div class="col-md-4"><h2 class="intro-title"><span class="glyphicon glyphicon-chat"></span> A votre écoute</h2> Vous souhaitez voir apparaître une nouvelle fonctionnalité ? vous voulez des crédits supplémentaires ? vous n'aimez pas ce site ? vous l'aimez ? n'hésitez pas : envoyez moi vos commentaires par <a href="mailto:sabrina.webdev@gmail.com">email</a> :)</div>
</div>
<div class="row" ng-hide="checkVersion">
<div class="col-md-12">
<img style="float:left; width:150px;" src="img/chrome-logo.png" />


<p style="margin-top:40px;"><div class="well" style="content-heading;  display : table-cell; float:none; margin-top: 50px;">Important : l'application nécessite l'utilisation du <a href="https://support.google.com/chrome/answer/95346?hl=en" target="_blank" >navigateur Google Chrome</a> ainsi que l'installation et l'activation de <a target="_blank" href="https://chrome.google.com/webstore/detail/extboostadopt/bgfahgcdohfieimbjkkficoionibpipa">l'extension "boostAdopt"</a>. N'hésitez pas à vous rendre dans la FAQ en cas de problème.</div></p>
</div>
</div>
<div class="row" ng-show="connected() && credits<25">
<div class="col-md-12">

<p style="margin-top:40px;"><div class="well" style=""><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;   Il ne vous reste plus beaucoup de crédits. <a href="" ng-click="payment()">Pensez à recharger</a>.</div></p>
</div>
</div>
</div>
<div  ng-show="connected() && checkVersion">
<fieldset>
	<legend data-l10n-id="search-title">Search</legend>
	<label for="countrySearch" data-l10n-id="search-savedSetting-label">Saved search settings</label>
	<div class="input-group"> 
		
<select class="form-control input" ng-model="inputSavedSetting" ng-change="loadSavedSetting(inputSavedSetting)" name="" id="savedSearchSettings" >
<option ng-repeat="settingSaved in savedSearchSettings" value="{{settingSaved.name}}|{{settingSaved.setting}}">{{settingSaved.name}}</option>
</select>
	<span class="input-group-btn">
        <button data-l10n-id="search-savedSetting-load"  ng-click="loadSavedSetting(inputSavedSetting)" class="btn btn-default" type="button">Load</button>
        <button data-l10n-id="search-savedSetting-delete"  ng-click="deleteSavedSetting(inputSavedSetting, inputSavedSetting)" class="btn btn-default" type="button">Delete</button>
        
      </span>
	</div>
	<form role="form" ng-submit="submit(search)">
		<div class="form-group">
			<label for="countrySearch"  data-l10n-id="search-country-label">Country</label>
			<select class="form-control input-lg" ng-model="search.country" name="" id="countrySearch" ng-change="displayRegion(search.country)">
				 <option ng-repeat="country in countries" ng-show="{country.show===service}" data-attribute-x="{{country.show}}" value="{{country.id}}">{{country.name}}</option>
			</select>
		</div>
		<div class="form-group">
			<label for="regionSearch" data-l10n-id="search-region-label">Région</label>
			<select class="form-control input-lg" ng-options="region.id as region.name for region in regions" ng-model="search.region" ng-change="displaySubRegion(search.region)">
				
			</select>
			
		</div>
		<div class="form-group"> 
			<label for="subRegionSearch" data-l10n-id="search-subregion-label">Sub-Region</label>
			<select class="form-control input-lg" ng-options="subregion.id as subregion.name for subregion in subregions" ng-model="search.subregion" name="subregion">
				
			</select>
		</div>
		<div class="form-group"> 
			<label for="minAgeSearch"  data-l10n-id="search-agemin-label">Min age</label>
			<select class="form-control input-lg" id="minAgeSearch" ng-model="search.ageMin" ng-change="setValuesAgeMax(search.ageMin)" name="age[min]">
			<option ng-repeat="n in range" value="{{n}}">{{n}}</option>
			</select>
		</div>
		<div class="form-group"> 
			<label for="maxAgeSearch"  data-l10n-id="search-agemax-label">Max age</label>
			<select  class="form-control input-lg" id="maxAgeSearch"  ng-model="search.ageMax" name="age[min]">
			<option ng-repeat="n in range | filter:ageMaxSupMin" value="{{n}}">{{n}}</option>
			</select>
		</div>
		<div class="form-group"> 
			<label data-l10n-id="search-sex-label" for="sexSearch">Sex</label>
			 <div class="btn-group">
        <button type="button" class="btn btn-primary" ng-model="search.sex" btn-radio="'0'"><span class="glyphicon glyphicon-user"></span>  <span  data-l10n-id="search-sex-man-label">Man</span></button>
        <button type="button" class="btn btn-primary" ng-model="search.sex" btn-radio="'1'"><span class="glyphicon girl"></span> <span  data-l10n-id="search-sex-woman-label">Woman</span></button>
    </div>
		</div>
		<div class="form-group"> 
			<label for="nbResultSearch" data-l10n-id="search-nor">Number of results</label>
			<select class="form-control input-lg" id="nbResultSearch" ng-model="search.count" name="nbResult">
			<option ng-repeat="n in [5,10,25,30,40,50,60,70,80,90,100,110,150]" value="{{n}}">{{n}}</option>
			</select>
		</div>
		<a href="" class="btn btn-primary btn-lg btn-block" ng-click="saveSearchSeeting(search)"><span class="glyphicon glyphicon-floppy-disk"></span> <span data-l10n-id="search-saveSettings">Save search settings </span> </a>
		<button type="submit" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-search"></span> <span data-l10n-id="search-search">Search </span></button>
	</form>


</fieldset>
</div>
<div id="SearchResult" >
<div>
</div>
<fieldset ng-if="girls.length>0">
	<legend>Booster</legend>
	<div ng-repeat="girl in girls" class="item">
	
	<img title="{{pseudo[girl.id]}}, {{girl.age}}ans, {{girl.city}}" ng-click="showProfile({{girl.id}})" src="{{girlsPics[girl.id].medium}}">
	
		
    	
    	<!-- <div>ID : {{girl.id}}</div>
    	<div> Pseudo : {{girl.pseudo}}</div>
    	<div> City : {{girl.city}}</div>
    	<div> Age : {{girl.age}}</div> -->
    	
	</div>
	<fieldset>
		<legend>Options</legend>
		<div>
		<p><span data-l10n-id="booster-warn">Choisissez l'intervalle que vous désirez entre chaque visite. Attention AdopteUnmec peut vous assimiler à un robot si ce délai est inféieur à 1 seconde.</span></p>
			<label for="boosterModeParam">Mode</label>
				<div ng-if="girls.length>0" class="btn-group">
			        <button type="button" class="btn btn-primary" ng-model="boosterMode" btn-radio="'1000'" ng-click="setBoosterTime('1000')">Quick (1s)</button>
			        <button type="button" class="btn btn-primary" ng-model="boosterMode" btn-radio="'2000'" ng-click="setBoosterTime('2000')">Safe (2s)</button>
			        <button type="button" class="btn btn-primary" ng-model="boosterMode" btn-radio="'0000'" ng-click="setBoosterTime('0000')" >Custom</button>
			    </div>
   				<div ng-show="boosterMode == '0000'">
      				<label for="boosterModeCustomParam">Mode</label> : <input placeholder="in milliseconds" type="number" ng-model="customTime"  />
    			</div>
		</div>
	</fieldset>
	<p>&nbsp;</p>
  <p>&nbsp;</p>
	<button ng-if="girls.length>0 && credits>=girls.length" type="button" ng-click="booster(girls,customTime)" class="btn btn-primary btn-lg btn-block"><span class="glyphicon glyphicon-flash"></span> Booster ({{girls.length}})</button>
	</fieldset>

	
	
</div>
<div>



</div>


</script>

