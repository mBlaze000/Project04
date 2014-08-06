// JavaScript Document

/*=======================================================
     Choose the selected menu 
=======================================================*/

$(document).ready(function(){

	var thisPage = location.pathname;
	var thisMenu = '#';
	if (thisPage.substr(0, 5) == '/list'){
		if (thisPage.substr(0, 6) == '/list/'){
			thisMenu += thisPage.substr(6);
		} else {
			thisMenu += 'all';
		}
	} else if (thisPage.length > 1) {
		thisMenu += thisPage.substr(1);
	} else {
		thisMenu += 'home';
	}
	$(thisMenu).addClass("active");
	//alert(thisMenu);

});	

