$(document).ready(function(){
	var cookieName='MatchPasswords';
	console.log(document.cookie);
	console.log("VAL: "+$.cookie('MatchPasswords'));
	if($.cookie(cookieName) == 'False'){
		alert("Password do not match!");
	}
	else if($.cookie(cookieName) == 'True'){
		alert("Password do match!");
	}
});
