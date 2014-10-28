var myApp = angular.module('myApp', ['ui.bootstrap','vr.directives.slider','ngCookies']).service("myService", function(){
});
myApp.factory('User', function() {
    return {
      login: '',
      parrainage_key : '',
      password : '',
      connected : false,
      credits : '',
      status  : function(){return this.connected;}
    };
});

myApp.factory('Meta', function(){
   return {
       
       countries : [],
       regions:[],
       subregions:[]
   } 
});




myApp.controller('mainController', function($scope) { });
myApp.run(function($rootScope, $cookieStore, User, $http, Meta){
    console.log("USER");
    console.log(User);
    
    if(sessionStorage.connected){
        login(sessionStorage.getItem('login'),vernam(sessionStorage.getItem('password'),sessionStorage.getItem('token')), false,sessionStorage.getItem('service') );
        User.connected = true;
    }
    
    //Load region 
  var countries = ['fr','be','ch','lu', 'de'];
  subregions = [];
  regions = [];
    for(g in countries){
       
        
       $http.get('files/regions/'+countries[g]+'.json').then(function(res){
           for(var x in res.data.data){
           
               regions.push({'id':x, 'name': res.data.data[x].name})
             
               for(var i in res.data.data[x].subregions){
                  subregions.push({'name': res.data.data[x].subregions[i], 'id' :i});
               
               }
            
            Meta.subregions[x]= subregions;
            subregions = [];
           }
           
           Meta.regions[res.data.country] = regions;
           regions = [];
            
         
        }); 
        
        
        

    }
   
    
    //Load subregion
    
    
   // Check for cookie 
    
    if($cookieStore.get('login')!==undefined){
        var loginCookie = $cookieStore.get('login');
        if(loginCookie.length > 0){
            
            User.login = $cookieStore.get('login');
            User.password = $cookieStore.get('password');
            User.connected = true;
            User.parrainage_key = $cookieStore.get('parrainage_key');
            User.service = $cookieStore.get('service');
        }
        
        
    }
   
   
});
var FAQModalInstanceCtrl = function($scope, $modalInstance, items){
    $scope.close = function(){
        $modalInstance.close();
    }
};

var ModalEvoInstanceCtrl = function($scope){
    
    
}
var ModalFAQInstanceCtrl = function($scope){
    
    
}
var EvoModalInstanceCtrl = function($scope, $modalInstance, items){
    $scope.close = function(){
        $modalInstance.close();
    }
};

var ModalPaymentInstanceCtrl = function($scope){

    $scope.paypalData = [ {"dev":{"merchant_id":"4UT9WJ7UZ5ALU","url":"https://www.sandbox.paypal.com"}},{"prod":{"merchant_id":"prod","url":"https://www.paypal.com"}}];
    
    
}

var PaymentModalInstanceCtrl = function($scope, $modalInstance, items){
  $scope.mail = items.login;
    
  
    $scope.close = function(){
        $modalInstance.close();
    }
    
};

var AppCtrl = function($scope, $modal, User, Meta, $cookieStore){
    
    var fieldNeed = ['country', 'region', 'subregion', 'ageMin', 'ageMax', 'count', 'sex'];
    var dataNeed = {};
    var range = [];
    var subregions = Meta.subregions;
    $scope.checkVersion = false;
    $scope.boosterInProgress = false;
    $scope.countries = [{id:"fr", name:"France",show:"adopteunmec.com"}, {id:"be", name:"Belgique",show:"adopteunmec.com"},{id:"ch",name:"Suisse",show:"adopteunmec.com"},{id:"lu",name:"Luxembourg",show:"adopteunmec.com"},{id:"de",name:"Deutschland", show:"adoptaguy.de"}];
    $scope.credits;
    $scope.parrainage_key = User.parrainage_key;
    $scope.items = {};
    $scope.dynamic = 25;
    $scope.boosterMode = '2000';
    $scope.items.girlsDone = [];
    $scope.items.girlsPics = [];
    $scope.callback = function(data){
        $scope.credits = data.boost.User.credits;
        if(data.user.country=="de"){
            $scope.service="adoptaguy.de";
        }else{
            $scope.service="adopteunmec.com";
        }
    };
    
    
    $scope.payment = function(){
                
        
        var modalInstancePayment = $modal.open({
            templateUrl: 'ModalPayment.html',
            controller: 'PaymentModalInstanceCtrl',
            resolve: {
               items: function(){
                 return User;
               }
                
              }
          });
    }
    
    
    $scope.faq = function(){
        
        var modalInstanceFaq = $modal.open({
            templateUrl: 'ModalFAQ.html',
            controller: 'EvoModalInstanceCtrl',
            resolve: {
               items: function(){
                 
               }
                
              }
          });
        
    }
    
    
    $scope.evo = function(){
        var modalInstanceEvo = $modal.open({
            templateUrl: 'ModalEvo.html',
            controller: 'FAQModalInstanceCtrl',
            resolve: {
               items: function(){
                 
               }
                
              }
          });
    }
    
    $scope.checkSession = function(data){
        if(! $scope.boosterInProgress ){
            $scope.credits = data.credits;
        }
        
    }
    
    $scope.parrainageKey = function (){
        return User.parrainage_key;
        
    };
    $scope.connected = function(){
        if(sessionStorage.connected){
            User.connected = true;
            User.parrainage_key = sessionStorage.parrainage_key;
            

            return true;
        }else{
            
            return User.connected;

        }
    }
   
    $scope.setUser = function(data,pwd, stayConnected){
       
        User.login = data.login;
        User.parrainage_key=data.parrainage_key;
        User.connected = true;
        User.password = pwd;
       
        
    }
    

    $scope.setBoosterTime = function (time){
        
        $scope.boosterMode = time;
    }
  
    $scope.addSlide = function(data) {
        $scope.items.girlsPics.push({
          active :  true,
          image: split_img_string(data.cover,2),
          id: data.id,
          pseudo:data.pseudo,
              age:data.age,
                  city:data.city
        });
      };
    
    
    $scope.update = function (fn){
        
        $scope.dynamic = Math.floor(Math.random()*10);
    }
    
    $scope.safeApply = function( fn ) {
        var phase = this.$root.$$phase;
        if(phase == '$apply' || phase == '$digest') {
            if(fn) {
                fn();
            }
        } else {
            this.$apply(fn);
        }
    };
    
    $scope.copyPKEY = function (){
        copyfunc("toto");
    }
    
    $scope.booster = function(girls, customTime){
        $scope.boosterInProgress = true;
    $scope.girls = girls;
        
        
        if($scope.boosterMode=='0000'){
            
            if(parseInt(customTime)){
                $scope.customTime = parseInt(customTime);
            }else{
                $scope.customTime = 2000;
            }
            
        }else{
            $scope.customTime = parseInt($scope.boosterMode);
        }
        var dataGirls = [];
        for(var x in girls){
            dataGirls.push(girls[x].id);
        }
        
        $scope.items.girls = dataGirls;
        booster(dataGirls, $scope.customTime);
        
            var modalInstance = $modal.open({
                templateUrl: 'myModalBooster.html',
                controller: 'BoosterModalInstanceCtrl',
                resolve: {
                   items: function(){
                       return $scope.items;
                   }
                    
                  }
              });
    }
   
    
    $scope.savedSearchSettings = JSON.parse(localStorage.getItem('savedSearchSettings')) || {};
   
    var fieldNeed = ['country', 'region', 'subregion', 'ageMin', 'ageMax', 'count', 'sex'];
    var dataNeed = {};
    var range = [];
    var subregions = Meta.subregions;
    for(var i=18;i<75;i++) {
      range.push(i);
    }
    $scope.range = range;
    $scope.sex = '1';
    $scope.ageMin = '';
    
    $scope.search = {sex:'1'};
    $scope.connected = function(){
        
        return User.connected;
    }
    $scope.setValuesAgeMax = function(ageMin){
        $scope.minAgeMax=ageMin;
    }
    
    $scope.ageMaxSupMin = function(a){
        if(a >= $scope.ageMin){
            return true;
            
        }else{
            return false;
        }
        
    }
    
    
    
    
    $scope.loadSavedSetting = function(data){
      
        var arr  = data.split("|");
        val = JSON.parse(arr[1]);
      
        $scope.search = val;
        $scope.displayRegion(val.country);
        $scope.displaySubRegion(val.region);
    
    }
    
    $scope.deleteSavedSetting = function (data){
        var arr = data.split('|');
        
        var oldItems = JSON.parse(localStorage.getItem('savedSearchSettings')) || [];
        var savedItems = [];
        for(var x in oldItems){
            if(oldItems[x].name == arr[0] && JSON.stringify(oldItems[x].setting) == arr[1]){
            }else{
                savedItems.push({'name': oldItems[x].name, 'setting':oldItems[x].setting})
            }
            
        }
        $scope.savedSearchSettings =  savedItems;
        localStorage.setItem('savedSearchSettings', JSON.stringify(savedItems));
    }
    
    
    $scope.displayRegion = function(country) {
        $scope.regions = Meta.regions[country];
    };
    $scope.saveSearchSeeting = function(search){
        
        var modalInstance = $modal.open({
            templateUrl: 'ModalSaveSearchCtrl.html',
            controller:  ModalInstanceSaveSearchCtrl,
            resolve: {
              items: function () {
                return {'criteria':search,'savedSearchSettings':$scope.savedSearchSettings};
              }
            }
          });
        
    }
    $scope.displaySubRegion = function(region) {
       
        $scope.subregions = Meta.subregions[region];
        
    };
    $scope.submit = function(searchParameters) {
        searchParametersBis=searchParameters;
        searchParametersBis['age[min]']=searchParameters.ageMin;
        searchParametersBis['age[max]']=searchParameters.ageMax;
        
        delete searchParametersBis.ageMin;
        delete searchParametersBis.ageMax;
        
        search(searchParametersBis);
    }
}


var IntroCtrl = function($scope, User){
    $scope.parrainage_key = User.parrainage_key;
    $scope.checkVersion = false;
    
    $scope.parrainageKey = function (){
        return User.parrainage_key;
        
    };
    $scope.connected = function(){
        if(sessionStorage.connected){
            User.connected = true;
            User.parrainage_key = sessionStorage.parrainage_key;
            return true;
        }else{
            return User.connected;

        }
    }
    $scope.safeApply = function( fn ) {
        var phase = this.$root.$$phase;
        if(phase == '$apply' || phase == '$digest') {
            if(fn) {
                fn();
            }
        } else {
            this.$apply(fn);
        }
    };
    $scope.setUser = function(data,pwd, stayConnected){
       
        User.login = data.login;
        User.parrainage_key=data.parrainage_key;
        User.connected = true;
        User.password = pwd;
        
       
        
    }
    
   
    
    $scope.copyPKEY = function (){
        
        copyfunc("toto");
    }
    
    
    
};

var BoosterModalInstanceCtrl = function ($scope, $modalInstance, items, User){
        
      $scope.modalData = items;
    
      $scope.goNext = function(){
        
      }
     
      $scope.stop = function(){
         $scope.modalData.girlsDone = [];
          $modalInstance.close($scope.editable);

         
      }
      $scope.status = function(){
          if( $scope.modalData.girlsDone.length <  $scope.modalData.girls.length  ){
              return "in progress";
          }else{
              return "finished";
          }
          
      }
      $scope.getActiveSlide = function () {
          return items.girlsPics.filter(function (s) { return s.active; })[0].id;
      };
      
      $scope.ok = function() {
        $modalInstance.close();
      };

      $scope.cancel = function() {
        $modalInstance.dismiss(false);
        boosterCancelled(($scope.modalData.girls.length-$scope.modalData.girlsDone.length));
      };
      $scope.next = function(){
          
         
      }
      $scope.split_img_string = function (img_url, format){
          
          if(img_url){
              img = img_url.split("/");
              var img;
              
              var concat ="";
              var fin = img[(img.length)-1];
              var tab = img.pop();
              img.toString();
              var url = img.join('/');
              url = url+"/thumb"+format+"_"+fin+".jpg";
              
                  return url;
              
              
          }else{
              return null;
          }
          
          
      }
      $scope.User = User;
      $scope.items = {};
      $scope.dynamic = 25;
      $scope.boosterMode = '2500';
      $scope.items.girlsDone = [];
      $scope.items.girlsPics = [];
      $scope.booster = function(girls, customTime){
          $scope.girls = girls;
          
          
          if($scope.boosterMode=='0000'){
              
              if(parseInt(customTime)){
                  $scope.customTime = parseInt(customTime);
              }else{
                  $scope.customTime = 2000;
                  
              }
              
          }else{
              $scope.customTime = parseInt($scope.boosterMode);
          }
          var dataGirls = [];
          for(var x in girls){
              dataGirls.push(girls[x].id);
          }
          $scope.items.girls = dataGirls;
          booster(dataGirls, $scope.customTime);
          
          
              var modalInstance = $modal.open({
                  templateUrl: 'myModalBooster.html',
                  controller: 'BoosterModalInstanceCtrl',
                  resolve: {
                     items: function(){
                         return $scope.items;
                     }
                      
                    }
                });
      }
      
      $scope.showProfile = function(id){
          
         
      }
      
      $scope.setBoosterTime = function (time){
          
          $scope.boosterMode = time;
      }
    
      $scope.addSlide = function(data) {
          $scope.items.girlsPics.push({
            active :  true,
            image: split_img_string(data.cover,2),
            id: data.id,
            pseudo:data.pseudo,
                age:data.age,
                    city:data.city
          });
        };
      
      
      $scope.update = function (fn){
          
          $scope.dynamic = Math.floor(Math.random()*10);
      }
};

var SearchResultCtrl = function ($scope, $modal, User){
   $scope.User = User;
    $scope.items = {};
    $scope.dynamic = 25;
    $scope.boosterMode = '2000';
    $scope.items.girlsDone = [];
    $scope.items.girlsPics = [];
    $scope.booster = function(girls, customTime){
      
        $scope.girls = girls;
        
        
        if($scope.boosterMode=='0000'){
            
            if(parseInt(customTime)){
                $scope.customTime = parseInt(customTime);
            }else{
                $scope.customTime = 2000;
               
            }
            
        }else{
            $scope.customTime = parseInt($scope.boosterMode);
        }
        var dataGirls = [];
        for(var x in girls){
            dataGirls.push(girls[x].id);
        }
       
        $scope.items.girls = null;
        $scope.items.girls = dataGirls;
        booster(dataGirls, $scope.customTime);
        
        
            var modalInstance = $modal.open({
                templateUrl: 'myModalBooster.html',
                controller: 'BoosterModalInstanceCtrl',
                resolve: {
                   items: function(){
                       return $scope.items;
                   }
                    
                  }
              });
    }
    
    $scope.showProfile = function(id){
        
    }
    
    $scope.setBoosterTime = function (time){
        
        $scope.boosterMode = time;
    }
  
    $scope.addSlide = function(data) {
        $scope.items.girlsPics.push({
          active :  true,
          image: split_img_string(data.cover,2),
          id: data.id,
          pseudo:data.pseudo,
              age:data.age,
                  city:data.city
        });
      };
    
    
    $scope.update = function (fn){
        
        $scope.dynamic = Math.floor(Math.random()*10);
    }
    
    $scope.safeApply = function( fn ) {
        var phase = this.$root.$$phase;
        if(phase == '$apply' || phase == '$digest') {
            if(fn) {
                fn();
            }
        } else {
            this.$apply(fn);
        }
    };
};

var ModalDemoCtrl = function ($scope, $modal, $log, User,$cookieStore, Meta) {
  
    $scope.getCredits = function(){
        
        return $scope.credits;
    }
  $scope.setCookie = function(){
     
      $cookieStore.put('login', User.login);
      $cookieStore.put('parrainage_key', User.parrainage_key);
      $cookieStore.put('password',  User.password);
      
  }
  
  $scope.setScoreBoost = function(score){
     
      $scope.credits = score;
  }
  $scope.setScoreBoostMinusOne = function(){
      $scope.credits = $scope.credits-1;
  }
  $scope.callbackCheckSession = function(data){
      $scope.credits = data.credits;
  }
  
  $scope.callback = function(data){
      User.login = data['boost'].User.login;
      User.credits = ''+data['boost'].User.credits+'';

      User.connected = true;
      User.parrainage_key='http://www.boostadopt.com/#'+data['boost'].User.parrainage_key;
      $scope.setScoreBoost(User.credits);
    
  }
  
 
  $scope.safeApply = function( fn ) {
      var phase = this.$root.$$phase;
      if(phase == '$apply' || phase == '$digest') {
          if(fn) {
              fn();
          }
      } else {
          this.$apply(fn);
      }
  };
  
  $scope.signinup = function () {
   
  var modalInstance = $modal.open({
      templateUrl: 'myModalContent.html',
      controller: ModalInstanceCtrl,
      resolve: {
        items: function () {
          return $scope.items;
        }
      }
    });
  
  }
  
  $scope.logout = function(){
      logout();

      User.connected = false;
      if($cookieStore.get('login')!==undefined){
          
          var loginCookie = $cookieStore.get('login');
          if(loginCookie.length > 0){
              
              $cookieStore.remove('login');
              $cookieStore.remove('service');
              $cookieStore.remove('password');
              $cookieStore.remove('parrainage_key');
          }
          
      }
      
      
  }
 
   
  

}




var ModalSaveSearchCtrl = function(){
    
    
}

var ModalInstanceSaveSearchCtrl = function($scope, $modalInstance, items){
    
    $scope.criteria = items.criteria;
    $scope.savedSearchSettings = [];
    $scope.savedSearchSettings.push(items.savedSearchSettings);
    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
      };
      $scope.save = function(criteria) {
        
          var oldItems = JSON.parse(localStorage.getItem('savedSearchSettings')) || [];
          oldItems.push({'name': criteria.searchName, 'setting':$scope.criteria});
          $scope.savedSearchSettings.push({'name': criteria.searchName, 'setting':$scope.criteria});
          localStorage.setItem('savedSearchSettings', JSON.stringify(oldItems));
          $modalInstance.close();
         
          
      };
}

var ModalInstanceCtrl = function ($scope, $modalInstance, items, User) {
  $scope.user = {login: "", password:""};
  $scope.items = items;
  $scope.selected = {
    item: $scope.items[0]
  };
 
 
 $scope.callback = function(data){
     $modalInstance.close();
     $scope.setUser()
 }
  $scope.ok = function(user) {
      if(user != undefined && user.login != undefined && user.password != undefined){
          close(user, $modalInstance.close(), user.stayConnected);
      } else {
          $scope.alerts = [ ];
          $scope.alerts.push({type: 'danger', msg: "Missing informations. Please try again"});
          $scope.login = '';
      }
      
	  
  };
  $scope.closeModal = function (){
     
  }
  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
};

function AccordionCtrl($scope) {
  $scope.oneAtATime = true;

  $scope.groups = [
    {
      title: 'Dynamic Group Header - 1',
      content: 'Dynamic Group Body - 1'
    },
    {
      title: 'Dynamic Group Header - 2',
      content: 'Dynamic Group Body - 2'
    }
  ];

  $scope.items = ['Item 1', 'Item 2', 'Item 3'];

  $scope.addItem = function() {
    var newItemNo = $scope.items.length + 1;
    $scope.items.push('Item ' + newItemNo);
  };

  $scope.status = {
    isFirstOpen: true,
    isFirstDisabled: false
  };
}