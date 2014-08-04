// JavaScript Document
/*
$(document).ready(function(){
	if (document.getElementById("name").value != "") {
		document.getElementById("task_name").value = userId + document.getElementById("name").value;
		//$("#testOutput").html(userId);
	}
});	
*/

function funcSetHidden(userId) {
  var nameValue = userId + document.getElementById("name").value;
  document.getElementById("task_name").value = nameValue;
  //$("#testOutput").html(nameValue);
}
	