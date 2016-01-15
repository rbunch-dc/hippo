$(document).ready(function(){
	$('.follow-button').click(function(){
		// console.log($(this));
		var uid = $(this).attr('uid');
		var buttonToChange = $(this);
		console.log(uid);
		$.ajax({
			url: "process_follow.php",
			type: "post",
			data: {uid:uid},
			success: function(result){
				console.log(result);
				if(result == "Success!"){
					buttonToChange.removeClass('btn-primary');
					buttonToChange.addClass('btn-default');
				}
			}
		});
	})
});