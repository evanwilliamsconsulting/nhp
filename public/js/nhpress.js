$(document).ready(function()
{
	var theTextAreaId;
	var theWordageId;
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
	wordageChangeFunc = function()
	{
		$.ajax({
			type:"POST",
			data: 
				{
				'id':theWordageId,
				'thetext': $("#wordage-edit-textarea").val()
			}, 
			url:"/wordage/change",
			success: function(data) {
				//alert(data);
			}
		});
	}
	clickPictureItem = function(pictureitemid)
        {
	   thePictureId = pictureitemid;
	   $.ajax({
		type:"POST",
		url:"/picture/edit?id=" + pictureitemid,
		success: function(data) {
		var objJSON = JSON.parse(data);
		var thePictureText = objJSON.view	
		var theId = "#hidden";
		$(theId).html(thePictureText);
		}
	    });
	}
	clickWordageItemText = function(wordagetextid)
	{
		theWordageId = wordagetextid;
		$.ajax({
			type:"POST",
			url:"/wordage/edit?id=" + wordagetextid,
			success: function(data) {
				var objJSON = JSON.parse(data);
				var theId = "#" + objJSON.id;
				var theWordageText = objJSON.view;
				theTextAreaId = theId
				$(theId).children(".wordage-item-text").html(theWordageText);
				$(theId).children(".wordage-item-text").jqte({change: wordageChangeFunc});

			}
		});
	}
});
