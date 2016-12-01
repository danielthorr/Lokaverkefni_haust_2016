var main = function()
{
	$("#login").on("click", function(){
		ShowUserBox("login");
	});
	$(".logIn").find("img").on("click", function(){
		ShowUserBox("login");
	});
	
	$("#signup").on("click", function(){
		ShowUserBox("signup");
	});
	$(".signUp").find("img").on("click", function(){
		ShowUserBox("signup");
	});
	
	function ShowUserBox(clickedOn){
	
	if (clickedOn == "login"){
		var $showElement = $(".logIn");
		var topPos = "-220px";
	}
	else if (clickedOn == "signup"){
		var $showElement = $(".signUp");
		var topPos = "-270px";
	}
	
	if ($showElement.hasClass("activeMsgBox")) {
		$showElement.animate({"top" : topPos}, 160);
		$showElement.removeClass("activeMsgBox");
	}
	else {
		$showElement.animate({"top" : "120px"}, 160);
		$showElement.addClass("activeMsgBox");
	}
	};
};

	/*
var LogIn = function(){
	
	var $login = $(".logIn");
	
	if ($login.hasClass("active")) {
		$login.animate({"top" : "-220px"}, 80);
		$login.removeClass("active");
	}
	else {
		$login.animate({"top" : "120px"}, 80);
		$login.addClass("active");
	}
};*/

$(document).ready(main);