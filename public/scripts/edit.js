// JavaScript Document

/*
$(document).ready(function(){
	if (document.getElementById("name").value != "") {
		document.getElementById("task_name").value = userId + document.getElementById("name").value;
		//$("#testOutput").html(userId);
	}
});	
*/


$(document).ready(function(){
	
	if (!document.getElementById("complete").checked) {
		$("#datecomplete").hide();
	}
	
});	

function funcToggleDate() {
	$("#datecomplete").toggle();
}

function funcSetOrig(userId) {
  var nameValue = document.getElementById("name").value;
  document.getElementById("orig_name").value = nameValue;
}

function funcSetTask(userId) {
	var origValue = document.getElementById("orig_name").value;
	var nameValue = document.getElementById("name").value;
	if (nameValue != origValue){
		var matchValue = userId + nameValue;
		document.getElementById("task_name").value = matchValue;
		//$("#testOutput").html(nameValue);
	}
}

