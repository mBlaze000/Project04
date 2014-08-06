// JavaScript Document

/*=======================================================
     Hide / show the completion date
=======================================================*/

// Hides the completion date if the completed box is not checked.

$(document).ready(function(){
	if (!document.getElementById("checkedoff").checked) {
		$("#datecomplete").hide();
	}
});	

// Toggles the visibilityof the completion date when the complete
// box is checked.

function funcToggleDate() {
	$("#datecomplete").toggle();
}

/*=======================================================
     Use hidden fields to check for dupe tasks for user
=======================================================*/

// When the page loads a hidden field is filled with the original 
// value of the name field.

function funcSetOrig(userId) {
  var nameValue = document.getElementById("name").value;
  document.getElementById("orig_name").value = nameValue;
}

// This fuction is run when focus is lost on the name field. 
// It compares the value of the name field to what it was when the 
// page loaded. If it's different the task name is populated.

function funcSetTask(userId) {
	var origValue = document.getElementById("orig_name").value;
	var nameValue = document.getElementById("name").value;
	if (nameValue != origValue){
		var matchValue = userId + nameValue;
		document.getElementById("task_name").value = matchValue;
		//$("#testOutput").html(nameValue);
	}
}

