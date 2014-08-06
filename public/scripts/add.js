// JavaScript Document

/*=======================================================
     Use hidden field to check for dupe task for user
=======================================================*/

// When focus is lost on the name field, a hidden field is filled with 
// the user ID appended with the task name.

function funcSetHidden(userId) {
  var nameValue = userId + document.getElementById("name").value;
  document.getElementById("task_name").value = nameValue;
  //$("#testOutput").html(nameValue);
}
	