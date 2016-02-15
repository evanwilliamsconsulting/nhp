$(document).ready(function()
{
	window_info = ({ "width" : $(window).width(), "height" : $(window).height()});
/*
	$.ajax({
		type:"POST",
		data:window_info,
		url:"index/setsize",
		success:function(data) {
			//alert(data);
		}
	});
*/
	clickLogin = function()
	{
		$.ajax({
			type:"POST",
			url:"auth/login",
			success: function(data) {
				$("#hidden").html(data);
			}
		});
	}
	clickWordageItemText = function(wordagetextid)
	{
		$.ajax({
			type:"POST",
			url:"/wordage/edit?id=" + wordagetextid,
			success: function(data) {
				var objJSON = JSON.parse(data);
				var theId = "#" + objJSON.id;
				var theWordageText = objJSON.view;
				$(theId).children(".wordage-item-text").html(theWordageText);
			}
		});
	}
});
