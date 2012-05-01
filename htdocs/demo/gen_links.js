var xmlhttp ;

function call_cronlink(){

xmlhttp = GetXmlHttpObject() ;
if (xmlhttp == null) {

alert("the Browser does not support AJAX ") ;
return ;

}
var url = "http://dev1.aculus.com/~bharath/vogoo_interface/vogoo-2.2/vogoo/cronlinks.php" ;
//url=url+"&sid="+Math.random();
xmlhttp.onreadystatechanged = stateChanged ;
xmlhttp.open("GET",url,true);
xmlhttp.send(null) ;

}
function stateChanged(){


}

function GetXmlHttpObject(){

if( window.XMLHttpRequest ){

  // for chrome IE7 and firefox 
  return new XMLHttpRequest() ;
}
if( window.ActiveXObject() ) {

 
  // for IE  
  return new ActiveXObject("Microsoft.XMLHTTP") ;

}


}
