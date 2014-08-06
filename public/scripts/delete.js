// JavaScript Document

/*=======================================================
     Confirmation alert for delete
=======================================================*/

function funcDeleteTask(id) {
	
    var btn_ok = confirm("Are you sure you want to delete this task?");
	
    if (btn_ok == true) {
		location.assign(id);
    }
};

