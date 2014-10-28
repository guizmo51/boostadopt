<div  id="ModalDemoCtrl" ng-controller="ModalDemoCtrl">
<nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                <img src="/img/boostTitlewhiteandRed.png" width="160px" />
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="" ng-click="faq()">FAQ</a>
                    </li>
                    <li><a href=""  ng-click="evo()" data-l10n-id="nav-evo">Fonctionnalités</a>
                    </li>
                 <li><a href="" ng-show="connected()"  ng-click="payment()" data-l10n-id="nav-payment">Rechargement</a>
                    </li>
                    <li ng-hide="connected()" ><a href="" ng-click="signinup()"  data-l10n-id="nav-signinup">Sign in / up</a></li>
                    <li ng-show="connected()"><a href="" ng-click="logout()" data-l10n-id="nav-logout">Log out</a></li>
                   
                    <li ng-show="connected()">
                    <a href=""  ng-value="">{{scoreBoost()}}</a>
                    </li>
                    <li ng-show="connected()">
                    <a href=""><span>{{getCredits()}}</span> credits</a>
                    </li>
                    <li style="float: right; padding-right:5px;">
                    <p><span data-l10n-id="nav-trad">Langue</span>  : <br/>
                    <select  onchange="document.webL10n.setLanguage(this.value || this.options[this.selectedIndex].text);">
        
                    <option value="fr">Français</option>
                    <option value="en-US">English</option>
                    </select>
                    </p>
                    </li>
                    
                </ul>
            </div>
           
            <!-- /.navbar-collapse -->
        </div>
       
        <!-- /.container -->
    </nav>
   </div>