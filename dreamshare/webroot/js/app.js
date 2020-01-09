//////////////////////
// 
// Author: Brian M
// app.js
/////////////////////////
var aUrl;

function init(){
  aUrl = document.URL;
  //alert(window.pageInfo+": "+aUrl);
  document.getElementById('btnSign').onclick = function(){
    //alert("Sign up...");
    window.location = "/users/add"
  };
  document.getElementById('btnFhp').onclick = function(){
    //alert("Find holiday partner...");
    window.location = "/users";
  };
  if(window.pageInfo == "home"){
    document.getElementById('btnSop').onclick = function(){
      //alert("See other partners...");
      //alert(window.pageInfo+": "+aUrl);
      window.location = "/users/all";
    };
  }

}

window.onload = function(){
  init();
};
