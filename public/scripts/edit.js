// JavaScript Document

$(document).ready(function(){
	
	if (!document.getElementById("complete").checked) {
		$("#datecomplete").hide();
	}
});	

function funcToggleDate() {
	$("#datecomplete").toggle();
}
