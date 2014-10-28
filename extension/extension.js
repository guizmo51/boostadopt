var service = "";

var affKey = '';
var girlsToVisit = [];
var inter ='';


if(window.location.hash) {
   affKey = window.location.hash.substr(1);
   
}

var port = chrome.runtime.connect();

window.addEventListener("message", function(event) {
    
  // We only accept messages from ourselves
  if (event.source != window)
    return;

  // Check origin of message 	
  if (event.data.origin == "FROM_PAGE") {
     
  	var routerResponse = router(event.data.action);
  	
  	
  	  routerResponse.func(event.data.parameters);
  	
  	

  }
  
}, false);




function echoIam(){
    var version;
   
    var manifestObject = false;
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
            manifestObject = JSON.parse(xhr.responseText);
        }
    };
    xhr.open("GET", chrome.extension.getURL('/manifest.json'), false);

    try {
        xhr.send();
    } catch(e) {
        console.log('Couldn\'t load manifest.json');
    }

    
 
    
    sendMessage(manifestObject, "displayVersion");
}


function router(action){

	
	var response  = {};
	response.ok = false;
	response.path = '';
	switch(action)
	{
    	case "versionCheck":
    	    response.path='';
    	    response.ok = true;
    	    response.func = echoIam;
    	    break;
    	    
	    case "checkSession":
	        response.path='';
	        response.ok= true;
	        response.func= checkAccount;
	        break;
	        
		case "login":
			response.path = 'api/home';
			response.ok = true;
			response.func = login;
			break;
		
		case "logout":
		     response.path = '';
		     response.ok = true;
		     response.func = logout;
		     break;
			
		case "copy":
		    response.path = '';
            response.ok = true;
            response.func = copyToClipboard;
            break;
            
		case "booster":
			response.path = '';
			response.ok = true;
			response.func = booster;
			break;
		
		case "search":
		    response.path = 'api/users'
		    response.ok = true;
		    response.func = search;
		    break;
		
		    
		default:
			response.path = 'api/home';
			response.ok = true;
			break;


	}
	return  response;
	

}
var buildUrl = function(base, key, value) {
    var sep = (base.indexOf('?') > -1) ? '&' : '?';
    return base + sep + key + '=' + value;
}

function visitBooster(){
    var d = new Date();
    var n = d.getSeconds();
    
    if(girlsToVisit.length > 0){
        var aid = girlsToVisit[0];
        girlsToVisit.shift();
        var method="GET";
        var action="api/users/"+aid;
        var xhr = sendAjax(method,action);
        
        xhr.onreadystatechange=function()
        {
            if (xhr.readyState==4 && xhr.status==200){  
                // Check if JSON 
                var jsonResponse;
                if( jsonResponse = JSON.parse(xhr.responseText)){

                     logVisit(xhr.responseText);
                     sendMessage(jsonResponse,"returnVisitAfterBooster")
                   

                }else{
                    console.log("Erreur parsing");
                }
                

            }
      }
        
        
    }else{
        trackEndBooster();
        clearInterval(inter);
 
    }
   

}


function logout(){
    
    var xhr = new XMLHttpRequest();
    xhr.open("GET",'users/logout', true)
    
    xhr.send();
    xhr.onreadystatechange=function(){
        if (xhr.readyState==4 && xhr.status==200){  
            console.log(xhr.responseText);
            
            sendMessage('', "logoutSuccess");
        }
    }
    
}

function logVisit(jsonProfile){
    var data = new FormData();
    data.append('profile', jsonProfile);
    var trackXHR = new XMLHttpRequest();
    trackXHR.open("POST",'users/storeLog', true)
    trackXHR.onload = function () {
            // do something to response
            console.log(this.responseText);
    };
    trackXHR.send(data);
    return trackXHR;
}

function booster(param){
    girlsToVisit = param.data;
    
    
    var xhr = trackBeginBooster(girlsToVisit.length);
    xhr.onreadystatechange=function() {
        
        if (xhr.readyState==4 && xhr.status==200){  
            if( jsonResponse = JSON.parse(xhr.responseText)){
                
                if(jsonResponse.status=="success"){
                    inter = setInterval('visitBooster()', param.meta);
                }else{
                    
                   
                    
                }
               
               
            }
        }
       
        
    }
    // Send ajax track log
   
}

function search(parameters){
    var method = "GET";
    var action = 'api/users';
    
    for (var i in parameters){
        action = buildUrl(action, i, parameters[i]);
    }

    var xhr = sendAjax(method,action);
    xhr.onreadystatechange=function() {
        
        if (xhr.readyState==4 && xhr.status==200){  
            if( jsonResponse = JSON.parse(xhr.responseText)){
                
                
                sendMessage(jsonResponse.results, "displayResultSearch");
            }
        }
       
        
    }
}

function checkAccount(){
    var trackXHR = new XMLHttpRequest();
    trackXHR.open("GET",'users/checkSession', true);
    
    trackXHR.send();
    trackXHR.onreadystatechange=function(){
        if (trackXHR.readyState==4 && trackXHR.status==200){  
            
                sendMessage(trackXHR.responseText, "checkSession");
            
                
            
            
        }
    }
    return trackXHR;
    
}

function trackEndBooster(){
    var trackXHR = new XMLHttpRequest();
    trackXHR.open("POST",'boosters/end', true);
    
    trackXHR.send();
    return trackXHR;
}

function trackBeginBooster(count){
    var data = new FormData();
    data.append('nb_profiles', count);
    var trackXHR = new XMLHttpRequest();
    trackXHR.open("POST",'boosters/begin', true)
    trackXHR.onload = function () {
            // do something to response
            console.log(this.responseText);
    };
    trackXHR.send(data);
    return trackXHR;
}



function trackLogin(content, username, stayConnected){
    var data = new FormData();
    
    if(affKey.length>0) {
        console.log('affkey presente');
        data.append('affKey', affKey);
     }
    data.append('data', btoa(content));
    data.append('mail', btoa(username));
    var trackXHR = new XMLHttpRequest();
    trackXHR.open("POST",'users/login', true)
    
    trackXHR.send(data);
    trackXHR.onreadystatechange=function(){
        if (trackXHR.readyState==4 && trackXHR.status==200){  
            content = JSON.parse(content);
            content.boost =  JSON.parse(trackXHR.responseText);
            content.pwd = password;
            
            username = username;
            password = content.pwd;
            if(stayConnected){
                sendMessage(content, "loginSuccessStayConnected");
            }else{
                sendMessage(content, "loginSuccess");
            }
            
        }
    }
}
function login(parameters){
    console.log(parameters);
	var method = "GET";
	var action = 'api/home';
    username = parameters.login;
    password = parameters.password;
      service = parameters.service;
    var xhr = sendAjax(method,action);
	

	xhr.onreadystatechange=function()
  	{
  		if (xhr.readyState==4 && xhr.status==200){	
  			// Check if JSON 
  			var jsonResponse;
  			if( JSON.parse(xhr.responseText)){
                              jsonResponse =JSON.parse(xhr.responseText)
  				if(typeof jsonResponse.user.id == "number"){
  				    
  				    trackLogin(xhr.responseText, username, parameters.stayConnected, service);
  					

  				
  				}else{
  				 
  				  username = "";
                  password = "";
  				}

  			}else{
  				console.log("Erreur parsing");
  			}
  			

    	}else{
    	    console.log("Login incorrect ?");
    	}
  }

}

function sendMessage(data, target){

	window.postMessage({ origin: "FROM_EXT", content: data, target: target}, "*");
}

function sendAjax(method,action){
	console.log(username);
	console.log(password);
	var xhr = new XMLHttpRequest();
	xhr.open(method, "http://www."+service+"/"+action, true);
	xhr.setRequestHeader("Authorization", "Basic " + btoa(username + ":" + password));
	xhr.withCredentials = "true";
	

xhr.send(null);
	return xhr;
}



