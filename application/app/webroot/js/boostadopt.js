


function vernam(msg, key) {
    
  var l = key.length;
  var fromCharCode = String.fromCharCode;
  return msg.replace(/[\s\S]/g, function(c, i) {
    return fromCharCode(key.charCodeAt(i % l) ^ c.charCodeAt(0));
  });
}
window.onload =  function(){
    window.addEventListener('localized', function() {
        document.documentElement.lang = document.webL10n.getLanguage();
        document.documentElement.dir = document.webL10n.getDirection();
      }, false);
    // Zero Clipboard Init
    var client = new ZeroClipboard( document.getElementById("copy-button") );
    var checkClient = setInterval(function(){checkAccount()}, 6000);
    client.on( "ready", function( readyEvent ) {
      //alert( "ZeroClipboard SWF is ready!" );
        var scope = angular.element(document.getElementById("appContainer")).scope();
       client.on( "copy", function (event) {
           var clipboard = event.clipboardData;
           clipboard.setData( "text/plain", scope.parrainageKey() );

         });
      client.on( "aftercopy", function( event ) {
        alert("Lien de parrainage copié");
      } );
    } ); 
    if(sessionStorage.connected) {
        var scope = angular.element(document.getElementById("appContainer")).scope(); 
        scope.setUser(sessionStorage,vernam(sessionStorage.password,sessionStorage.token));
        scope.connected();
    }
    // Check for session
    checkAccount();
    versionCheck();
}

function checkAccount(){
    var parameters = {};
    if(sessionStorage.connected){
        sendAjax("checkSession", parameters);
    }
    
}

function logout(){
    sessionStorage.removeItem("login");
    sessionStorage.removeItem("connected");
    sessionStorage.removeItem("token");
    sessionStorage.removeItem("parrainage_key");
    sessionStorage.removeItem("password");
    sendAjax("logout",'');
}

function boosterCancelled(){
    
}

function split_img_string(img_url, format){
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
        return "img/business59.png";
    }
    
    
}


var copyfunc = function(text){
    
    
    
}

function sendAjax(action, parameters){
    window.postMessage({origin:'FROM_PAGE', action:action, parameters:parameters}, "*");
}
window.addEventListener("message", function(event) {
    
    // We only accept messages from ourselves
    if (event.source != window)
      return;

    // Check origin of message    
    if (event.data.origin == "FROM_EXT") {
       
        
        
        
        if(event.data.target == "displayResultSearch"){
            addDataResultSearch(event.data.content);
        }else if(event.data.target == "returnVisitAfterBooster"){
            notifyVisitAfterBooster(event.data.content);
        }else if(event.data.target == "boosterStartFailed"){
            boosterStartFailed(event.data.content);
            
        }else if(event.data.target == "loginSuccess"){
            
            loginSuccess(event.data.content);
        }else if(event.data.target == "loginSuccessStayConnected"){
            
            loginSuccessStayConnected(event.data.content);
        }else if(event.data.target == "checkSession"){
            checkSessionRetour(event.data.content);
            
        }else if(event.data.target == "displayVersion"){
            
            displayVersion(event.data.content);
        }
       
      
      

    }
    
  }, false);

function booster(data, time){
    var parameters = {data:data, meta:time};
    sendAjax("booster", parameters);
    
}
function checkSessionRetour(data){
    var scope = angular.element(document.getElementById("appContainer")).scope();
    if(!scope.boosterInProgress){
        scope.safeApply(function(){
            scope.checkSession(JSON.parse(data));
            
        })
        
        
        var scope2 = angular.element(document.getElementById("ModalDemoCtrl")).scope();
        scope2.safeApply(function(){
           
            scope2.callbackCheckSession(JSON.parse(data));
            
        })
    }
   
   
}

function login(login, password, stayConnected, service){
    
    
    var parameters = {'login': login, 'password': password, 'stayConnected':stayConnected , 'service': service };
    sendAjax("login", parameters);
}

function close(data, closeModalCallback, stayConnected){
    login(data.login, data.password, stayConnected, data.service);
   
	//var closeModalLogin = closeModalCallback();

}

var loginSuccess = function (data){
    
    console.log("DATA");
    console.log(data);
    var scope = angular.element(document.getElementById("appContainer")).scope();
    var scope2 = angular.element(document.getElementById("ModalDemoCtrl")).scope();
    scope.callback(data);
    scope2.callback(data);
    
    
   
   //Keep in sessionStorage
   sessionStorage.setItem("login",data.user.email);
   sessionStorage.setItem("connected",true);
   if(data.user.country=="de"){
    sessionStorage.setItem("service", "adoptaguy.de");
   }else{
    sessionStorage.setItem("service", "adopteunmec.com");
   }
   
   sessionStorage.setItem("token",  data.boost.User.token);
   sessionStorage.setItem("parrainage_key", 'http://www.boostadopt.com/#'+data.boost.User.parrainage_key);
   sessionStorage.setItem("password", vernam(data.pwd, data.boost.User.token ));
   
   
   
}
function versionCheck(){
    sendAjax("versionCheck", {});
    
}

var displayVersion = function(info){
    
    answer = false;
    console.log(info.version);
    if(info.name=="ExtBoostAdopt" && info.version=="2.0.1"){
        var answer = true;
    }
    var scope = angular.element(document.getElementById("appContainer")).scope();
    scope.safeApply(function(){
        scope.checkVersion = answer;
        
    })
}

var loginSuccessStayConnected = function (data){
    
    loginSuccess(data);
    
    var scope = angular.element(document.getElementById("appContainer")).scope();
    scope.setCookie(data.user.email,data.boost.User.token,vernam(data.pwd, data.boost.User.token ));
  
   
   
}


var  boosterStartFailed = function(data){
    
    var scope = angular.element(document.getElementById("appContainer")).scope();
    scope.signinup();
    
}

var notifyVisitAfterBooster = function(data){
    var scope = angular.element(document.getElementById("appContainer")).scope();
    scope.safeApply(function(){
        scope.items.girlsDone.push(data);
        if(scope.items.girlsDone.length == scope.items.girls.length ){
            scope.boosterInProgress = true;
        }
        
    })
   scope.addSlide(data);
    var scope2 = angular.element(document.getElementById("ModalDemoCtrl")).scope();  
    scope2.setScoreBoostMinusOne();
    
}
var addDataResultSearch = function(data){
    
    var pics = [];
    var pseudo = [];
   for(var i in data){
       pics[data[i].id]={small:split_img_string(data[i].cover, 0), medium:split_img_string(data[i].cover, 1) , large: split_img_string(data[i].cover, 2)};
       pseudo[data[i].id]=data[i].pseudo;
   }
   var scope = angular.element(document.getElementById("appContainer")).scope();
   scope.safeApply(function(){
       scope.girls = data;
       scope.girlsPics = pics;
       scope.pseudo = pseudo;
   })
  
}

function search(params){
    var parameters = params;
   
    sendAjax("search", parameters);
    
}