import $ from 'jquery';
$( document ).ready(function() {
	// Open all topics drawer
	$('button.all-topics').click(function(){
		if($('.all-topics-row').is(':visible')){
			$('.all-topics-row').hide(400);
			$('button.all-topics .fa').removeClass('fa-chevron-up');
			$('button.all-topics .fa').addClass('fa-chevron-down');
		}
		else {
			$('.all-topics-row').show(400);
			$('button.all-topics .fa').removeClass('fa-chevron-down');
			$('button.all-topics .fa').addClass('fa-chevron-up');
		}
	});
    	
}); 