function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}

function validate_matching(){
var str = document.getElementById("signal").value;
var res = str.substring(1, 2);
if ( res == "k")
{return true;}
else
{ //event.preventDefault() in onsubmit event very important to turn on "return false;" //for some browsers
event.preventDefault();
return false;
}}

function showHint() {var username = document.getElementById("username").value;
var pwd = document.getElementById("pwd").value;  
if (pwd != "") {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                 var msg = this.responseText;
                 document.getElementById("txtHint").innerHTML = msg;
}};
        xmlhttp.open("GET", "jobprofile.php?username=" + username+"&pwd="+pwd, true);
        xmlhttp.send();
} 
}


