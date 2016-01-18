$( document ).ready(function() {
	$('.follow-button').click(function(){
		console.log($(this));
		var uid = $(this).attr("uid");
		console.log(uid);
		var dataFollow = $(this).attr("data-follow");
		        $.ajax({
		        	url: "process_follow.php", 
		        	type: "post",
		        	data: {uid:uid, follow_type:dataFollow},
		        	success: function(result){

		        		var buttonToChange = $( "[uid="+uid+"]" );
		        		if((buttonToChange).hasClass("btn-primary")){
		        			//We need to remove btn-primary to change the color of the button
		        			buttonToChange.removeClass("btn-primary");
		        			//Add btn-default to make it grey
		        			buttonToChange.addClass("btn-default");
		        			//Change data-follow to unfollowed
		        			buttonToChange.attr("data-follow", "unfollowed");		        			
		        			//Chnage the button text
		        			buttonToChange.html('UnFollow');
		        		}else{
		        			//Exact opposite of above
		        			buttonToChange.addClass("btn-primary");
		        			buttonToChange.removeClass("btn-default");		        			
		        			buttonToChange.attr("data-follow", "followed");
		        			buttonToChange.html('Follow');
		        		}
	    	    }});		
	})
});