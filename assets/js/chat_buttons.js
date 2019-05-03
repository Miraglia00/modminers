$(document).ready(function() {

	$('#test').click(function(){
		$('.chat-box').css('width', '!important');
		$('.chat-box').toggle('swing');
	});

	$('#test1').click(function(){
		$('.chat-box-1').css('width', '!important');
		$('.chat-box-1').toggle('swing');
	});

	$('#test2').click(function(){
		$('.chat-box-2').css('width', '!important');
		$('.chat-box-2').toggle('swing');
	});
});