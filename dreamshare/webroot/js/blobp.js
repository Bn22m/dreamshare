///////////////////////////////
// @Author: Brian M
// blobp.js
/////////////////////////////////

//alert("blobp");
var dstart;
var sstart;
var session50;
var xx;
var xb;
var xt;
var start;
var nn = 0;
var p = true;
var blogx = true;
var btime;
var divn = 5;
var divnn = 0;
var divnShow = true;
var divx;

function init() {
  //alert("init...");
  btime = 10 * (1000*12)
  dstart = new Date();
  sstart = dstart.getTime();
  session50 = sstart + btime;
  xx = document.getElementById("lblTime");
  xb = document.getElementById("btnTime");
  xt = document.getElementById("btnX");
  xb.innerText = session50;
  xb.onclick = function(){ pause(); };
  xt.onclick = function(){ reset(); };
}

function ptime(xn){
  var xnt = new Date(xn);
  var h = xnt.getHours() - 2;
  var mn = xnt.getMinutes();
  var sec = xnt.getSeconds();
  var msec = xnt.getMilliseconds();
  xb.innerText = xn+" <> "+ h +":"+mn+":"+sec+":"+msec;
  var xs = (60 - sec);
  xt.innerText = "Exit ["+xs+"]";
  if(xs > 56){
    xt.style = "color: yellow";
    xt.style = "background-color: aqua";
  }
  else if(xs > 52){
    xt.innerText = "Online ["+xs+"]";
    xt.style = "color: brown";
    xt.style = "background-color: tomato";
  }
  else {
    xt.style = "color: green";
    xt.style = "background-color: springgreen";
  }

  if(sec % 10 == 0){
    divShow(sec);
  }

}

function cstart(){
  var d2start = new Date();
  var s2start = d2start.getTime();
  var xn = (session50 - s2start);
  ptime(xn)
  if(xn < 0){
    stop();
  }
  else{
    start = setTimeout(cstart, 100);
  }
}

function stop(){
  //alert(n);
  clearTimeout(start);
  nn++;
  if(nn > 10){
    //alert(n);
    //window.location= "/activities";
    //reset();
    reset();
  }
  else{
    //alert(n);
    cstart();
  }
}

function pause(){
  if(p){
    p = false;
    clearTimeout(start);
    xx.style = "background-color: white";
    xb.style = "color: gold";
  }
  else{
    p = true;
    cstart();
    xx.style = "background-color: gold";
    xb.style = "background-color: green";
  }
}

function reset(){
  exit();
}

function exit(){
  //alert("exit");
  console.log("Blog exit");
  window.location= "/activities";
}

function divShow(dxy) {
  if(dxy == 10){
    divnShow = false;
  }
  if(dxy == 50){
    //divnShow = true;
  }
  if(divnShow){
    divx = document.getElementById("divBlogV"+dxy);
    if(divx != null){
      divx.style.display = "none";
      console.log("#x "+dxy+": "+divn);
      divn--;
      divnn++;
    }
  }
  if(!divnShow){
      divx = document.getElementById("divBlogV"+dxy);
      if(divx != null){
        divx.style.display = "block";
        console.log("#y "+dxy+": "+divnn);
        divnn--;
        divn++;
      }
  }
}

window.onload = function(){
  console.log("Blog...@100");
  //alert("##@ 100 blobp");
  init();
  cstart();
  blogx = false;
}

if (blogx){
  console.log("Blog....@200");
  //alert("##@ 200 blobp");
  init();
  cstart();
  blogx = false;
}
